<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 4/2/2018
     * Time: 4:10 PM
     */
    
    require_once 'core/init.php';
    
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey(STRIPE_PRIVATE);

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
    $token = $_POST['stripeToken'];
    //Get the rest if post data
    $full_name = sanitize($_POST['full_name']);
    $email = sanitize($_POST['email']);
    $street = sanitize($_POST['street']);
    $street2 = sanitize($_POST['street2']);
    $city = sanitize($_POST['city']);
    $zip_code = sanitize($_POST['zip_code']);
    $country = sanitize($_POST['country']);
    $state = sanitize($_POST['state']);
    $tax = sanitize($_POST['tax']);
    $sub_total = sanitize($_POST['sub_total']);
    $grand_total = sanitize($_POST['grand_total']);
    $cart_id = sanitize($_POST['cart_id']);
    $users_id = sanitize($_POST['users_id']);
    $description = sanitize($_POST['description']);
    $charge_amount = number_format($grand_total,2)*100;
    $metadata = array(
      "cart_id" => $cart_id,
      "tax" => $tax,
      "sub_total" => $sub_total,
    );

// Charge the user's card:
    try {
        $charge = \Stripe\Charge::create(array(
            "amount" => $charge_amount,
            "currency" => CURRENCY,
            "description" => $description,
            "source" => $token,
            "receipt_email" => $email,
            "metadata" => $metadata
        ));
        
        //adjust inventroy
        $itemQ = $db->query("select * from cart where id = '{$cart_id}'");
        $iresult = mysqli_fetch_assoc($itemQ);
        $items = json_decode($iresult['items'],true);
        foreach ($items as $item){
            $newSizes = array();
            $item_id = $item['id'];
            $productQ = $db->query("select sizes from products where id = '{$item_id}'");
            $product = mysqli_fetch_assoc($productQ);
            $sizes = sizesToArray($product['sizes']);
            foreach ($sizes as $size){
                if ($size['size'] == $item['size']){
                    $q = $size['quantity'] - $item['quantity'];
                    $t = $size['threshold'];
                    $newSizes[] = array('size' => $size['size'], 'quantity' => $q,  'threshold' => $t);
                }else{
                    $newSizes[] = array('size' => $size['size'], 'quantity' => $size['quantity'], 'threshold' => $size['threshold']);
                }
            }
            $sizeString = sizesToString($newSizes);
            $db->query("update products set sizes = '{$sizeString}' where id = '{$item_id}'");
        }
        
        // update cart
        $db->query("update cart set paid=1 where id='{$cart_id}'");
        $db->query("insert into transactions
    (charge_id,cart_id,users_id,full_name,email,street,street2,city,zip_code,country,state,sub_total,tax,grand_total,description,txn_type)
    values('$charge->id','$cart_id','$users_id','$full_name','$email','$street','$street2','$city','$zip_code','$country','$state','$sub_total','$tax','$grand_total','$description','$charge->object')");
    
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
        setcookie(CART_COOKIE,'',1,"/",$domain,false);
        include 'includes/head.php';
        include 'includes/top.php';
        include 'includes/navigation.php';
        ?>
            <h1 class="text-center text-success">Thank You!!!</h1>
        <p class="text-center text-primary">Your card has been successfully charged <?=  money($grand_total);?>.
            you have been email reciept. please check your spam folder if it is not your inbox.Additionally you can print
            this page as a receipt.
        </p>
    
        <p class="text-center text-primary">Your Receipt Number is: <strong><?=$cart_id;?></strong></p>
        <p class="text-center text-primary">Your Order Shipped in This Address!</p>
    
        <address class="text-center text-primary">
            <?=$full_name;?><br>
            <?=$street;?>
            <?=(($street2 != '')?$street2.'<br>':'');?>
            <?=$city.','.$state.','.$zip_code;?>
            <?=$country;?>
        </address>
        <?php
        include 'includes/footer.php';
        }catch (\Stripe\Error\Card $e){
            echo $e;
        }
    ?>