<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 2/26/2018
     * Time: 1:52 AM
     */
    require_once $_SERVER['DOCUMENT_ROOT'].'/final_project/core/init.php';
    unset($_SESSION['SBuser']);
    header('Location: login.php');