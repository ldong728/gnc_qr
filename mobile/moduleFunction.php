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

function index(){
    $channelList=pdoQuery('gd_channel',null,array('cha_show'=>'1'),' limit 6');
    $article=pdoQuery('gd_article',array('art_img'),array('art_channel_id'=>-1),' limit 1');
    $article=$article->fetch();
    $channelList=$channelList->fetchAll();
    include 'view/index.html.php';
}
function customer_photo(){
    $cha_id=$_GET['cha_id'];

    $article=pdoQuery('gd_article',array('art_id','art_img'),array('art_channel_id'=>$cha_id,'art_show'=>'1'),' order by art_index desc');
    $article=$article->fetchAll();
    include 'view/customer_photo.html.php';
}
function goods(){
    $goodsInf=pdoQuery('gd_article',null,array('art_channel_id'=>$_GET['cha_id']),'order by art_index desc limit 1');
    $goodsInf=$goodsInf->fetch();
    $imgList=explode(',',$goodsInf['art_more_img']);
    include 'view/goods.html.php';
}

function about(){
    $cha_id=$_GET['cha_id'];
    $aboutInf=pdoQuery('gd_article_view',null,array('art_channel_id'=>$cha_id), ' limit 1');
    $aboutInf=$aboutInf->fetch();
    include 'view/about.html.php';


//    echo '跳转到这里';
}
function activities(){
    $cha_id=$_GET['cha_id'];
    $activities=pdoQuery('gd_article_view',null,array('art_channel_id'=>$cha_id),null);
    $activities=$activities->fetchAll();
//    $news = getMediaList('news', 0, $newsNum - $localNum);
//    foreach ($news['item'] as $row) {
//        $media_id = $row['media_id'];
//        $title_img = 'img/' . $media_id . '.jpg';
//        $title = $row['content']['news_item'][0]['title'];
//        $digest = $row['content']['news_item'][0]['digest'];
//        $content = $row['content']['news_item'][0]['content'];
//        $url = $row['content']['news_item'][0]['url'];
//        $create_time = $row['content']['update_time'];
//        if (!file_exists('../' . $title_img)) {
//            $img = getFromUrl($row['content']['news_item'][0]['thumb_url']);
//            file_put_contents('../' . $title_img, $img);
//        }
//        $value[] = array('media_id' => $media_id, 'title' => addslashes($title), 'digest' => addslashes($digest), 'title_img' => $title_img, 'content' => addslashes($content), 'url' => $url, 'create_time' => $create_time);
//    }
    include 'view/activities.html.php';

}
function goods_verify(){
    header('location: '.'http://' . $_SERVER['HTTP_HOST'] . DOMAIN . '/wechat/?oauth=snsapi_base&diract=qr_verify');
}
function dealer_verify(){
    header('location: '.'http://' . $_SERVER['HTTP_HOST'] . DOMAIN . '/wechat/?oauth=snsapi_base&diract=user_inf');
}
function activty_detail(){
    $inf=pdoQuery('gd_article',array('art_text'),array('art_id'=>$_GET['id']),' limit 1');
    $inf=$inf->fetch();
    include 'view/activity_detail.html.php';
}

function alter_password(){
    echo 'temp';
    exit;
}

function logout(){

}
