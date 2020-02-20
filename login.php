<?php

include 'config.php';
$db = new \classes\Database(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (isset($_SESSION['isLoggedIn'])) {
    header('location: index.php');
    exit;
}
$msg = "";
$msgType = "";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $res = $db->link->query("SELECT * FROM `user` WHERE username = '$username' AND password = '$password'");
    if ($db->link->affected_rows > 0) {
        $obj = $res->fetch_object();
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['user'] = [
            'email' => $obj->email,
            'username' => $obj->username,
            'id' => $obj->id,
            'role' => $obj->role,
        ];
        header('location: index.php');
        exit;
    } else {
        $msg = "Invalid username or password";
        $msgType = "danger";
    }
}

echo $twig->render("login.html", ['msg' => $msg, 'msgType' => $msgType]);
