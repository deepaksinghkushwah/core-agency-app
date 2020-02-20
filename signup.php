<?php

include 'config.php';
$db = new \classes\Database(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$msg = "";
$msgType = "";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = in_array($_POST['role'], [3,4]) ? $_POST['role'] : 3;
    $db->link->query("SELECT * FROM `user` WHERE username = '".$username."' OR email = '".$email."'");
    if($db->link->affected_rows > 0){
        $msg = "Username or email already registered, please choose another";
        $msgType = "danger";
    } else {
        $db->link->query("INSERT INTO `user` SET username = '$username', email = '$email', password = '$password', role = '$role'");
        if($db->link->insert_id > 0){
            $msg = "You are registered successfully";
            $msgType = "success";
        } else {
            echo $db->link->error;
        }
    }    
}
echo $twig->render("signup.html",['msg' => $msg, 'msgType' => $msgType]);
