<?php

$db = mysqli_connect('localhost', 'root', '', 'watch');
if (mysqli_connect_errno()){
    echo 'Database Connecton Failed With Following Error: '.  mysqli_connect_error();
}
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/final_project/config.php';
require_once BASEURL.'helpers/helpers.php';
require BASEURL.'vendor/autoload.php';

    $cart_id = '';
    if (isset($_COOKIE[CART_COOKIE])){
        $cart_id = sanitize($_COOKIE[CART_COOKIE]);
    }
    
    $users_id = '';
    if (isset($_SESSION['CBuser'])){
        $users_id = sanitize($_SESSION['CBuser']);
    }
    
    if (isset($_SESSION['SBuser'])) {
        $user_id = $_SESSION['SBuser'];
        $query = $db->query("select * from users where id='$user_id'");
        $user_data = mysqli_fetch_assoc($query);
        $fn = explode(' ', $user_data['full_name']);
        $user_data['first'] = $fn[0];
        $user_data['last'] = $fn[1];
    }
    
    if (isset($_SESSION['CBuser'])){
        $users_id = $_SESSION['CBuser'];
        $query = $db->query("select * from customer_user where id = '$users_id'");
        $customer_data = mysqli_fetch_assoc($query);
    }
    
    if(isset($_SESSION['success_flash'])){
        echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
        unset($_SESSION['success_flash']);
        
    }
    
    if(isset($_SESSION['error_flash'])){
        echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
        unset($_SESSION['error_flash']);
        
    }

