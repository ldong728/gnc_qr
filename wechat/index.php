<?php
include_once '../includePackage.php';
include_once $GLOBALS['mypath'].'/wechat/interfaceHandler.php';
include_once $GLOBALS['mypath'].'/wechat/wechat.php';
include_once $GLOBALS['mypath'].'/wechat/reply.php';
include_once $GLOBALS['mypath'].'/wechat/oauth.php';
include_once $GLOBALS['mypath'].'/wechat/serveManager.php';
session_start();
//createButtonTemp();


if(isset($_GET['oauth'])&&!isset($_SESSION['openId'])){
    //getparam:oauth&diract
    $diract=urlencode(str_replace('diract=','',strchr($_SERVER['QUERY_STRING'],'diract=')));//保存diract参数后的所有参数并传递
    if($diract=='')$diract='none';
    $oauth=new oauth($_GET['oauth'],$diract);
    $_SESSION['oauthType']=$_GET['oauth'];
    $oauth->getOauth();
    exit;
}elseif(isset($_SESSION['openId'])){
    $diract=str_replace('diract=','',strchr($_SERVER['QUERY_STRING'],'diract='));
    header('location:../mobile/controller.php?module='.$diract);
}
//mylog(getArrayInf($_GET));
//mylog(getArrayInf($_SESSION));
if(isset($_GET['state'])&&isset($_SESSION['oauthType'])){
//    mylog('oauthType');
    if(isset($_GET['code'])){
        $userId=getOauthToken($_GET['code']);
        $_SESSION['openId']=$userId['openid'];
        if('snsapi_userinfo'==$_SESSION['oauthType']){
            //TODO 获取用户数据的操作
        }else{
//            $_SESSION['userInf']=getUnionId($_SESSION['openId']);
        }
        switch($_GET['state']){
            case 'none':
//                header('location: ../mobile/controller.php?card_mall');
                exit;
                break;
            default:
//                mylog(urldecode($_GET['state']));
                header('location:../mobile/controller.php?module='.urldecode($_GET['state']));
                break;
        }
    }else{

        //TODO 无法获取openid
    }
    exit;
}


