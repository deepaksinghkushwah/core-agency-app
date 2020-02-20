<?php

namespace app;

include 'config.php';
$db = new \classes\Database(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$id = $db->link->real_escape_string($_REQUEST['id']);
$sql = "SELECT * FROM `profile` WHERE id = $id";

$res = $db->link->query($sql);
$user = null;
$data = $res->fetch_object();
$user = [
    'firstname' => $data->firstname,
    'lastname' => $data->lastname,
    'image' => $data->image,
    'id' => $data->id,
    'about' => $data->about,
];


echo $twig->render("model-profile.html", ['user' => $user]);
