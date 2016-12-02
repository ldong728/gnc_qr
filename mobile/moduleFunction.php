<?php

function sub_dealer_list(){

    $subList=pdoQuery('gd_user_view',null,array('use_parent_id'=>$_GET['p_id']),' order by use_reg_time desc');
    include 'view/sub_dealer_list.html.php';
    echo 'test';
    exit;

}

function alter_password(){
    echo 'temp';
    exit;
}

function logout(){

}