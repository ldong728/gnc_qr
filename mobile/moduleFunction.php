<?php

function sub_dealer_list(){
    $rank=pdoQuery('gd_user_rank',null,null,' where rank>'.$_SESSION['user_rank']. ' order by rank asc');
    $subList=pdoQuery('gd_user_view',null,array('use_parent_id'=>$_GET['p_id']),' order by use_reg_time desc');
    include 'view/sub_dealer_list.html.php';
    exit;

}
function audit_confirm(){
    mylog(getArrayInf($_GET));
    $id=$_GET['id'];
    $verify=pdoQuery('gd_users',array('use_id'),array('use_openid'=>$_SESSION['openId'],'use_grade'=>'0'),' limit 1');
    if($verify->fetch()){
        $userInf=array();
        $list=array();
        $inf=pdoQuery('gd_root_audit_view',null,array('use_note'=>'audit'),null);
        foreach ($inf as $row) {
            if($id==$row['use_id'])$userInf=$row;
            else$list[]=$row;
        }
        $userStatus=count($userInf);
        if($userStatus==0&&count($list)==0){
            header('location: controller.php?module=user_inf');
        }else{
            include 'view/dealer_audit.html.php';
            exit;
        }


    }
    echo "audit ok";
    exit;
}

function alter_password(){
    echo 'temp';
    exit;
}

function logout(){

}