<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/28
 * Time: 15:14
 */
include_once '../includePackage.php';
session_start();
if(isset($_SESSION['openId'])){
    if(isset($_GET['module'])){
        switch($_GET['module']){
            case 'qr_book';
                if(isUserLogin($_GET['module'])){
                    include 'view/qr_scanner.html.php';
                }else{
                    include 'view/login.html.php';
                }
                break;
        }
    }
    if(isset($_GET['qr_book'])){


        include 'view/qr_scanner.html.php';
    }
    if(isset($_GET['qr_query'])){

    }
    if(isset($_GET['login'])){

    }

}

