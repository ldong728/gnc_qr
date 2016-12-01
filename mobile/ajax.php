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
//        $re=array('errcode'=>0,'errmsg'=>'ok');
        switch($_POST['action']){
            case 'booking':
                $data=array();
                $touser=$_POST['touser'];
                foreach ($_POST['data'] as $row) {
                    if(canShip($row,$_SESSION['userId'])){
                        pdoInsert('gd_qr_tbl',array('code'=>$row,'user_id'=>$touser),'update');
                        pdoInsert('gd_qr_recorder',array('code'=>$row,'from_id'=>$_SESSION['userId'],'to_id'=>$touser));
                        $data['success'][]=$row;
                    }else{
                        $data['false'][]=$row;
                    }
                }
//                $re['data']=$data;
                echo ajaxBack($data);
                break;
            case 'query':
                $qr=$_POST['data'];
                if(snPreVerify($qr)){//初筛，看sn是否符合生成算法要求
//                    mylog($qr);
                    $recorde=pdoQuery('qr_recorder_view',null,array('code'=>$qr),' order by update_time desc');
                    foreach ($recorde as $row) {
                        $dealerList[]=$row['from_id'];
                        $toDealerList[]=$row['to_id'];
                        $recodeList[]=$row;
                    }
                    if(isset($recodeList)){//是否在数据数据记录中
                        if(in_array($_SESSION['userId'],$dealerList)||in_array($_SESSION['userId'],$toDealerList)||0==$_SESSION['userId']){//是否为自己渠道发货
                            echo ajaxBack($recodeList);
                        }else{
                            echo ajaxBack(null,1,'无权限');
                        }
                    }else{
                        echo ajaxBack(null,2,'无记录');
                    }
                }else{
                    echo ajaxBack(null,3,'非法格式');
                }
                break;
            case 'verify':
                $openId=$_SESSION['openId'];
                $qr=$_POST['data'];
                if(snPreVerify($qr)){//合法
                    $inf=pdoQuery('gd_qr_tbl',array('verify'),array('code'=>$qr),' limit 1');
                    if($verifyNum=$inf->fetch()){//有记录
                        if(0==$verifyNum['verify']){//未验证
                            $userVerifyCount=pdoQuery('gd_qr_verify_count_view',array('count'),array('open_id'=>$_SESSION['openId']),' limit 1');
                            $count=$userVerifyCount->fetch();
                            if(!$count||$count['count']<3){//发起验证的用户的验证次数
                                pdoUpdate('gd_qr_tbl',array('verify'=>1),array('code'=>$qr));
                                $record=pdoInsert('gd_qr_verify_recorder',array('open_id'=>$_SESSION['openId'],'code'=>$qr));
                                echo ajaxBack(array('id'=>$record));
                            }else{
                                echo ajaxBack(null,1,'该用户发起验证次数超过限制，请联系管理员');
                            }
                        }else{
                            echo ajaxBack(null,2,'此验证码已作废，请联系销售商');
                        }
                    }else{
                        echo ajaxBack(null,3,'无销售记录');
                    }
                }else{
                    echo  ajaxBack(null,4,'非正品');
                }
                break;
            case 'clear_session':
//                session_unset();
//                echo ajaxBack();
                break;
        }
        exit;

    }



}
