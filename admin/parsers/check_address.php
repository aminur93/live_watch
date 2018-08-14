<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 4/2/2018
     * Time: 2:50 PM
     */
    
    require_once $_SERVER['DOCUMENT_ROOT'].'/final_project/core/init.php';
    $name = sanitize($_POST['full_name']);
    $email = sanitize($_POST['email']);
    $street = sanitize($_POST['street']);
    $street2 = sanitize($_POST['street2']);
    $city = sanitize($_POST['city']);
    $zip_code = sanitize($_POST['zip_code']);
    $country = sanitize($_POST['country']);
    $state = sanitize($_POST['state']);
    
    $erros = array();
    $required = array(
        'full_name' => 'Full Name',
        'email' => 'Email',
        'street' => 'Street Address',
        'city' => 'City',
        'zip_code' => 'Zip Code',
        'country' => 'Country',
        'state' => 'State'
    );
    
    //check if all required fields are fill out
    
    foreach ($required as $f => $d){
        if (empty($_POST[$f]) || $_POST[$f] == ''){
            $erros[] = $d.' is required.';
        }
    }
    
    //check if valid email address
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $erros[] = 'Plese Enter a valid email';
    }
    
    if (!empty($erros)){
        echo display_errors($erros);
    }else{
        echo 'passed';
    }