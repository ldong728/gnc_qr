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
    if(isset($_POST['action'])){
        $re=array('errcode'=>0,'errmsg'=>'ok');
        switch($_POST['action']){
            case 'booking':
                $touser=$_POST['touser'];
                foreach ($_POST['data'] as $row) {
//                    verifySN();
                    pdoInsert('gd_qr_tbl',array('code'=>$row,'user_id'=>$touser),'update');
                    pdoInsert('gd_qr_recorder',array('code'=>$row,'from_id'=>$_SESSION['userId'],'to_id'=>$touser));
                }

//                mylog(json_encode($_POST['data'],JSON_UNESCAPED_UNICODE));
                echo 'well done';
                break;
            case 'query':
                $qr=$_POST['data'];
                $recorde=pdoQuery('qr_recorder_view',null,array('code'=>$qr),' order by update_time desc');
                foreach ($recorde as $row) {
                    $dealerList[]=$row['from_id'];
                    $recodeList[]=$row;
                }
                if(isset($recodeList)){
                    mylog();
                    if(in_array($_SESSION['userId'],$dealerList)||0==$_SESSION['userId']){
                        $re['data']=$recodeList;
                    }else{
                        $re['errcode']=9;
                        $re['errmsg']='无权限';
                    }
                }else{
                    $re['errcode']=1;
                    $re['errmsg']='无记录';
                }
                echo json_encode($re);
                break;
        }

    }



}
