<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 5/1/2018
     * Time: 1:38 AM
     */
    require_once $_SERVER['DOCUMENT_ROOT'].'/final_project/core/init.php';
    unset($_SESSION['CBuser']);
    unset($_COOKIE[CART_COOKIE]);
    session_destroy($_SESSION['CBuser']);
    header('Location: index.php');