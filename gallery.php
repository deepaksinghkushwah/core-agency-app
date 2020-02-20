<?php

include 'config.php';
$db = new \classes\Database(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if (isset($_POST['submit'])) {
    $image = $_FILES['image'];
    if ($image['tmp_name'] != '') {
        $ext = substr($image['name'], strrpos($image['name'], '.') + 1);        
        if (!in_array($ext, ALLOWED_EXT)) {            
            $_SESSION['msg']['danger'][] = "Invalid image type";
        } else {
            $newName = time() . '.' . $ext;
            if (move_uploaded_file($image['tmp_name'], ROOT_PATH . '/images/gallery/' . $newName)) {
                $sql = "INSERT INTO `gallery` SET `image` = '$newName', `user_id` = '".$_SESSION['user']['id']."'";
                $db->link->query($sql);                
                $_SESSION['msg']['success'][] = "Gallery image uploaded";
                header('location: gallery.php');
                exit;
            }
        }
    }    
}
$sql = "SELECT * FROM gallery where user_id = '".$_SESSION['user']['id']."'";
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

echo $twig->render("gallery.html",['images' => $images]);
