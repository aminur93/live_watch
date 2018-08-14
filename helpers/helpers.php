<?php
ob_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function display_errors($errors){
    $display = '<ul class="bg-danger">';
    foreach ($errors as $error){
        $display .='<li class="text-danger">'.$error.'</li>';
    }
    $display .= '</ul>';
    return $display;
}

function sanitize($dirty){
    return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

function money($number){
    return '$'.  number_format($number, 2);
}

function login($user_id){
    $_SESSION['SBuser'] = $user_id;
    global $db;
    $date = date("Y-m-d H:i:s");
    $db->query("update users set last_login = '$date' where id='$user_id'");
    $_SESSION['success_flash'] = 'You Are Log In';
    header('Location: index.php');
}

function customerLogin($customer_id){
    $_SESSION['CBuser'] = $customer_id;
    global $db;
    $date = date("Y-m-d H:i:s");
    $db->query("update customer_user set last_login = '$date' where id ='{$customer_id}'");
    $_SESSION['success_flash'] = 'You Are Log in';
    header('Location: cart.php');
}
    
    function is_logged_in(){
        if (isset($_SESSION['SBuser']) && $_SESSION['SBuser'] > 0) {
            return true;
        }
        return false;
    }
    
    function login_error_redirect($url = 'login.php'){
        $_SESSION['error_flash'] = 'You must be logged into access that page';
        header('Location: '.$url);
    }
    
    function permission_error_redirect($url = 'login.php'){
       $_SESSION['error_flash'] = 'You dont have to permission access into that page';
       header('Location: '.$url);
    }
    
    function has_permission($permission = 'admin'){
    global $user_data;
       $permissions = explode(',', $user_data['permissions']);
       if (in_array($permission,$permissions,true)){
           return true;
       }
       return false;
    }
    
    function pretty_date($date){
       return date("M d, Y h:i A", strtotime($date));
    }
    
    function get_category($child_id){
       global $db;
       $id = sanitize($child_id);
       $sql = "select p.id as 'pid', p.category as 'parent', c.id as 'cid', c.category as 'child'
               from categories c
               INNER JOIN categories p
               ON c.parent = p.id
               where c.id = '$id'";
       $result = $db->query($sql);
       $category = mysqli_fetch_assoc($result);
       return $category;
    }
    
    function sizesToArray($string){
       $sizesArray = explode(',',$string);
       $returnArray = array();
       foreach ($sizesArray as $size){
           $s = explode(':',$size);
           $returnArray[] = array('size' => $s[0], 'quantity' => $s[1], 'threshold' => $s[2]);
       }
       return $returnArray;
    }
    
    function sizesToString($sizes){
       $sizeString = '';
       foreach ($sizes as $size){
           $sizeString .= $size['size'].':'.$size['quantity'].':'.$size['threshold'].',';
       }
       $trimmed = rtrim($sizeString, ',');
       return $trimmed;
    }
    