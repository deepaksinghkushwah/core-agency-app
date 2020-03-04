<?php

namespace app;

include 'config.php';
$db = new \classes\Database(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$id = $db->link->real_escape_string($_REQUEST['id']);
$sql = "SELECT * FROM `profile` WHERE user_id = $id";

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

$sql = "SELECT * FROM gallery where user_id = '$id'";
$res  =$db->link->query($sql);
$images = null;
if($db->link->affected_rows > 0){
    while($data = $res->fetch_object()){
        $images[] = [            
            'id' => $data->id,
            'image' => $data->image,
        ];
    }
}


echo $twig->render("model-profile.html", ['user' => $user,'images' => $images]);
