<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 3/3/2018
     * Time: 8:00 PM
     */
    require_once $_SERVER['DOCUMENT_ROOT'].'/final_project/core/init.php';
    $mode = sanitize($_POST['mode']);
    $edit_id = sanitize($_POST['edit_id']);
    $edit_size = sanitize($_POST['edit_size']);
    
    $cartQ = $db->query("select * from cart where id = '{$cart_id}'");
    $result = mysqli_fetch_assoc($cartQ);
    $items = json_decode($result['items'],true);
    $update_items = array();
    $domain = (($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);
    
    if ($mode == 'removeone'){
        foreach ($items as $item){
            if ($item['id'] == $edit_id && $item['size'] == $edit_size){
                $item['quantity'] = $item['quantity']-1;
            }
            if ($item['quantity'] > 0){
                $update_items[] = $item;
            }
        }
    }
    
    if ($mode == 'addone'){
        foreach ($items as $item){
            if ($item['id'] == $edit_id && $item['size'] == $edit_size){
                $item['quantity'] = $item['quantity']+1;
            }
            $update_items[] = $item;
        }
    }
    
    if (!empty($update_items)){
        $json_update = json_encode($update_items);
        $db->query("update cart set items = '{$json_update}' where id = '{$cart_id}'");
        $_SESSION['success_flash'] = 'Your Shopping cart has been upated';
    }
    
    if (empty($update_items)){
        $db->query("delete from cart where id='{$cart_id}'");
        setcookie(CART_COOKIE,'',1,"/",$domain,false);
    }