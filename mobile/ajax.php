<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/26
 * Time: 13:09
 */
include_once '../includePackage.php';;
session_start();

if(isset($_SESSION['openId'])) {
//    if(isset())
    if(isset($_POST['booking'])){
        mylog($_POST['data']);
        echo 'well done';
    }

}
