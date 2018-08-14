<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/final_project/');
define('CART_COOKIE', 'aminurgthhriyakhan');
define('CART_COOKIE_EXPIRE', time() + (86400 *30));
define('TAXRATE',0.087); //sales tax rate will be change able

define('CURRENCY','USD');
define('CHECKOUTMODE', 'TEST'); //change test ot live when will you live mode

if (CHECKOUTMODE == 'TEST'){
    define('STRIPE_PRIVATE','sk_test_TaqN6g3XckcHLyDYvFR3ZSSR');
    define('STRIPE_PUBLIC','pk_test_x04rVJt4saDAcvbFTvk0Q2xU');
}

if (CHECKOUTMODE == 'LIVE'){
    define('STRIPE_PRIVATE','');
    define('STRIPE_PUBLIC','');
}




