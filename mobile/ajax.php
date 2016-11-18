<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/26
 * Time: 13:09
 */
include_once '../includePackage.php';;
session_start();
mylog("ajax arrive");
if(isset($_SESSION['openId'])) {
    mylog('sessionok');
//    if(isset())
    if(isset($_POST['action'])&&$_POST['action']=='booking'){
        mylog(json_encode($_POST['data'],JSON_UNESCAPED_UNICODE));
        echo 'well done';
    }

}
