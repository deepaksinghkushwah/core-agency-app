<?php
namespace app;
include 'config.php';
$db = new \classes\Database(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT * FROM `profile` WHERE id > 0";
$searchStr = "";
if(isset($_REQUEST['q'])){
    $searchStr = $db->link->real_escape_string($_REQUEST['q']);
    $sql .= " AND (firstname like '%$searchStr%' OR lastname like '%$searchStr%' )";
}

//\classes\Flash::addFlash("Hello", "success");
//\classes\Flash::addFlash("There", "primary");
//\classes\Flash::addFlash("song", "secondary");

$res  =$db->link->query($sql);
$users = null;
if($db->link->affected_rows > 0){
    while($data = $res->fetch_object()){
        $users[] = [
            'firstname' => $data->firstname,
            'lastname' => $data->lastname,
            'image' => $data->image,
            'id' => $data->id,
        ];
    }
}
echo $twig->render("index.html",['users' => $users, 'searchStr' => $searchStr]);