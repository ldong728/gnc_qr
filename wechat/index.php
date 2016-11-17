<?php
include_once '../includePackage.php';
include_once $GLOBALS['mypath'].'/wechat/interfaceHandler.php';
include_once $GLOBALS['mypath'].'/wechat/wechat.php';
include_once $GLOBALS['mypath'].'/wechat/reply.php';
include_once $GLOBALS['mypath'].'/wechat/oauth.php';
include_once $GLOBALS['mypath'].'/wechat/serveManager.php';
session_start();
//createButtonTemp();


if(isset($_GET['oauth'])){
    //getparam:oauth&diract
    $diract=isset($_GET['diract'])?$_GET['diract'] : 'none';
    $oauth=new oauth($_GET['oauth'],$diract);
    $_SESSION['oauthType']=$_GET['oauth'];
    $oauth->getOauth();
    exit;
}
mylog(getArrayInf($_GET));
mylog(getArrayInf($_SESSION));
if(isset($_GET['state'])&&isset($_SESSION['oauthType'])){
//    mylog('oauthType');
    if(isset($_GET['code'])){
        $userId=getOauthToken($_GET['code']);
        $_SESSION['openId']=$userId['openid'];
        if('snsapi_userinfo'==$_SESSION['oauthType']){
            //TODO 获取用户数据的操作
        }else{
            $_SESSION['userInf']=getUnionId($_SESSION['openId']);
        }
        switch($_GET['state']){
            case 'qr_book':
                header('location:../mobile/controller.php?qr_book=1');
                break;
            default:
//                mylog('default');
                header('location: ../mobile/controller.php?card_mall=1');
                break;
        }
    }else{

        //TODO 无法获取openid
    }
}


