<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 3/6/2018
     * Time: 12:03 AM
     */
    
    
    require_once 'core/init.php';
    if (isset($_GET['users_id'])) {
        $users_id = $_GET['users_id'];
        $users_id = sanitize($_POST['users_id']);
    
    }
        $path = 'images/saved_images/webcam' . date('YmdHis') . rand(383, 1000) . '.jpg';
    
        move_uploaded_file($_FILES['webcam']['tmp_name'], $path);
    
        $sql = "INSERT INTO trial(users_id,image) VALUES('$users_id','" . $path . "')";
        $db->query($sql);
   
    
    