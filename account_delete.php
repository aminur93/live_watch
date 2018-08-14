<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 5/5/2018
     * Time: 2:41 AM
     */
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete_id = (int)$_GET['delete'];
        $delete_id = sanitize($delete_id);
        $sql = "delete from customer_user where id = '$delete_id'";
        $db->query($sql);
        header('Location: index.php');
    }