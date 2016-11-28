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
                    $subDealer = pdoQuery('gd_users', null, array('use_parent_id' => $_SESSION['userId']), 'limit 20');
                    include 'view/qr_scanner.html.php';
                    break;
                case 'qr_query':
                    include 'view/qr_query.html.php';
                    break;
                case 'qr_verify':
                    include 'view/qr_query.html.php';
                    break;
            }
            exit;
        }
        if('qr_verify'==$_GET['module']){
            include 'view/qr_verify.html.php';
            exit;
        }
        $diract = $_GET['module'];
        include 'view/login.html.php';
        exit;


    }
    if (isset($_GET['login'])) {
        $where = array('use_usephone' => $_POST['userphone'], 'use_password' => md5($_POST['password']));
        $query = pdoQuery('gd_users', array('use_id'), $where, ' limit 1');
        $inf = $query->fetch();
        if ($inf) {
            include_once '../wechat/usersdk.php';
            $_SESSION['userId'] = $inf['use_id'];
            pdoUpdate('gd_users', array('use_openid' => $_SESSION['openId']), $where);
            $user=new usersdk($_SESSION['openID']);
            $user->addTag(100);//添加经销商标签
            mylog('openid update');
            header('location: ?module=' . $_GET['diract']);
        } else {
            $diract = $_GET['diract'];
            include 'view/login.html.php';
        }
    }
    if (isset($_GET['register'])) {

    }

}

