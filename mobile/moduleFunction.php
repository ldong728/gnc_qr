<?php

function sub_dealer_list(){
    mylog(getArrayInf($_SESSION));
    $rank=pdoQuery('gd_user_rank',null,null,' where rank>'.$_SESSION['user_rank']. ' order by rank asc');
    $subList=pdoQuery('gd_user_view',null,array('use_parent_id'=>$_GET['p_id']),' order by use_reg_time desc');
    include 'view/sub_dealer_list.html.php';
    exit;

}
function audit_confirm(){
    echo "audit ok";
    exit;
}

function alter_password(){
    echo 'temp';
    exit;
}

function logout(){

}