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
        $touser=$_POST['touser'];
        foreach ($_POST['data'] as $row) {
            pdoInsert('gd_qr_tbl',array('code'=>$row,'user_id'=>$touser),'update');
            pdoInsert('gd_qr_recode',array('code'=>$row,'from_id'=>$_SESSION['userId'],'to_id'=>$touser));
        }

        mylog(json_encode($_POST['data'],JSON_UNESCAPED_UNICODE));
        echo 'well done';
    }

}
