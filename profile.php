<?php

include 'config.php';
$db = new \classes\Database(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $image = $_FILES['image'];
    $ext = substr($image['name'], strrpos($image['name'], '.') + 1);
    $allowedExt = ['png', 'jpg', 'jpeg', 'gif'];
    if (!in_array($ext, $allowedExt)) {
        $_SESSION['msg']['danger'][] = "Invalid image type";
    } else {
        $newName = time() . '.' . $ext;
        //exit(ROOT_PATH);
        if (move_uploaded_file($image['tmp_name'], ROOT_PATH . '/images/profiles/' . $newName)) {
            $_SESSION['msg']['success'][] = "Image uploaded";
        }
        $res = $db->link->query("SELECT * FROM `profile` WHERE user_id = '" . $_SESSION['user']['id'] . "'");
        if ($db->link->affected_rows > 0) {
            $sql = "UPDATE `profile` SET "
                    . "firstname = '$firstname', "
                    . "lastname = '$lastname', "
                    . "user_id = '" . $_SESSION['user']['id'] . "', "
                    . "image = '$newName' "
                    . "WHERE user_id = '".$_SESSION['user']['id']."'";
        } else {
            $sql = "INSERT INTO "
                    . "`profile` SET "
                    . "firstname = '$firstname', "
                    . "lastname = '$lastname', "
                    . "user_id = '" . $_SESSION['user']['id'] . "', "
                    . "image = '$newName'";
        }
        $db->link->query($sql);
        if ($db->link->insert_id > 0) {
            $_SESSION['msg']['success'][] = "Profile updated";
            header('location: profile.php');
            exit;
        }
    }
}

$profile = [
    'firstname' => '',
    'lastname' => '',
    'image' => '',
];

$res = $db->link->query("SELECT * FROM `profile` WHERE user_id = '" . $_SESSION['user']['id'] . "'");
if ($db->link->affected_rows > 0) {
    $obj = $res->fetch_object();
    $profile = [
        'firstname' => $obj->firstname,
        'lastname' => $obj->lastname,
        'image' => $obj->image,
    ];
}
echo $twig->render("profile.html", ['profile' => $profile]);
