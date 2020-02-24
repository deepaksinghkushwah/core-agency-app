<?php

include 'config.php';
$newName = null;
$db = new \classes\Database(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (isset($_POST['submit'])) {
    $firstname = $db->link->real_escape_string($_POST['firstname']);
    $lastname = $db->link->real_escape_string($_POST['lastname']);
    $image = $_FILES['image'];
    $about = $db->link->real_escape_string($_POST['about']);
    $ext = substr($image['name'], strrpos($image['name'], '.') + 1);
    $allowedExt = ['png', 'jpg', 'jpeg', 'gif'];
    if ($image['tmp_name'] != '') {
        if (!in_array($ext, ALLOWED_EXT)) {
            $_SESSION['msg']['danger'][] = "Invalid image type";
        } else {
            $newName = time() . '.' . $ext;
            //exit(ROOT_PATH);
            if (move_uploaded_file($image['tmp_name'], ROOT_PATH . '/images/profiles/' . $newName)) {
                $_SESSION['msg']['success'][] = "Image uploaded";
            }
        }
    }

    $res = $db->link->query("SELECT * FROM `profile` WHERE user_id = '" . $_SESSION['user']['id'] . "'");
    if ($db->link->affected_rows > 0) {
        if ($newName == null) {
            $newName = $res->fetch_object()->image;
        }
        $sql = "UPDATE `profile` SET "
                . "firstname = '$firstname', "
                . "lastname = '$lastname', "
                . "about = '$about', "
                . "user_id = '" . $_SESSION['user']['id'] . "', "
                . "image = '$newName' "
                . "WHERE user_id = '" . $_SESSION['user']['id'] . "'";
    } else {
        if ($newName == null) {
            $newName = 'noimg.jpg';
        }
        $sql = "INSERT INTO "
                . "`profile` SET "
                . "firstname = '$firstname', "
                . "lastname = '$lastname', "
                . "about = '$about', "
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
        'about' => $obj->about,
    ];
}
echo $twig->render("profile.html", ['profile' => $profile]);
