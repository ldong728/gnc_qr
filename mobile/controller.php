<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/28
 * Time: 15:14
 */
include_once '../includePackage.php';
session_start();
if (isset($_SESSION['openId'])) {
    if (isset($_GET['module'])) {
        if (isUserLogin($_GET['module'])) {
            switch ($_GET['module']) {
                case 'qr_book';
                    $subDealer=pdoQuery('gd_users',null,array('use_parent_id'=>$_SESSION['userId']),'limit 20');
                    include 'view/qr_scanner.html.php';
                    break;
                case 'qr_query':

                    include 'view/qr_query.html.php';
                    break;
            }
        } else {
            $diract=$_GET['module'];
            include 'view/login.html.php';
            exit;
        }

    }
    if (isset($_GET['login'])) {
        $where=array('use_username'=>$_POST['username'],'use_password'=>md5($_POST['password']));
        $query=pdoQuery('gd_users',array('use_id'),$where,' limit 1');
        $inf=$query->fetch();
        if($inf){
            $_SESSION['userId']=$inf['use_id'];
            pdoUpdate('gd_users',array('use_openid'=>$_SESSION['openId']),$where);
            mylog('openid update');
            header('location: ?module='.$_GET['diract']);
        }else{
            $diract=$_GET['module'];
            include 'view/login.html.php';
        }
    }
    if(isset($_GET['register'])){

    }

}

