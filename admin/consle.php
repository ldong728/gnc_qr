<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/29
 * Time: 10:50
 */
include_once '../includePackage.php';
session_start();


if (isset($_SESSION['login']) && DOMAIN == $_SESSION['login']) {
    if (isset($_GET['createNews'])) {
        $id = $_POST['id'];
        $title = addslashes(trim($_POST['title']));
        $digest = addslashes(trim($_POST['digest']));
        $title_img = isset($_POST['title_img']) ? $_POST['title_img'] : 'img/0.jpg';
        $content = addslashes($_POST['content']);
        if ($title != '' && $content != '') {
            switch ($_GET['createNews']) {
                case '1': {//创建图文
                    $value = array('title' => $title, 'digest' => $digest, 'title_img' => $title_img, 'content' => $content, 'source' => 'local', 'media_id' => 'local' . time() . rand(100, 999), 'create_time' => time());
                    if ($id > 0) $value['id'] = $id;
                    pdoInsert('news_tbl', $value, 'update');
                    header('location:index.php?newslist=1');
                    exit;
                    break;
                }
                case '2': {//创建通知
                    $sendNow = $_POST['sendNow'];
                    $value = array('title' => $title, 'intro' => $digest, 'title_img' => $title_img, 'inf' => $content, 'create_time' => time());
                    if ($id > 0) $value['id'] = $id;
                    $notice_id = pdoInsert('notice_tbl', $value, 'update');
                    if ($sendNow == '0') {
                        header('location:index.php?newslist=1');
                    } else {
                        header('location:index.php?sendNotice=' . $notice_id . '&notice_id=' . $notice_id);
                    }
                    exit;
                    break;
                }
                case '3': {
                    $cate = $_POST['jm_cate'] ? $_POST['jm_cate'] : -1;
                    $value = array('category' => $cate, 'title' => $title, 'title_img' => $title_img, 'content' => $content, 'create_time' => time());
                    if ($id > 0) $value['id'] = $id;
//                              mylog(json_encode($value));
//                              mylog($id);
                    pdoInsert('jm_news_tbl', $value, 'update');
                    header('location:index.php?jm=1&jm_list=1');
                    exit;
                    break;

                }
            }


        } else {
            header('location:index.php?newslist=1');
            exit;
        }
        exit;

    }
    if (isset($_GET['getNotice'])) {//在预览框架中显示
        $css = '<style type="text/css">'
            . 'img {max-width:100%;}'
            . '</style>';

        $noticeId = $_GET['getNotice'];
        if ($noticeId == -1) {
            echo '预览';
            exit;
        }
        $notice = pdoQuery('notice_tbl', array('inf'), array('id' => $noticeId), ' limit 1');
        $notice = $notice->fetch();
        echo $css;
        echo $notice['inf'];
        exit;
    }
    if (isset($_GET['userdetail'])) {
        $openid = $_GET['userdetail'];
        $userinf = getUserInf($openid);
        $groupid = $userinf['groupid'];
        $markquery = pdoQuery('user_mark_view', null, array('openid' => $openid), null);
        $markStr = '';
        foreach ($markquery as $row) {
            $markStr .= ($row['notice_id'] . ',');
            $markList[] = $row;
        }
        if (isset($markList)) $markList = array();
        $markStr = rtrim($markStr, ',');
        $str = $markStr != '' ? ' and id not in(' . $markStr . ')' : '';
        $unmarkQuery = pdoQuery('notice_tbl', array('title', 'create_time'), array('situation' => 1, 'groupid' => $groupid), $str);
        $unmarkList = $unmarkQuery->fetchAll();
        $bbsTopic = pdoQuery('bbs_topic_tbl', array('count(*) as count'), array('open_id' => $openid), ' limit 1');
        $bbsTopic = $bbsTopic->fetch();
        $bbsReply = pdoQuery('bbs_reply_tbl', array('count(*) as count'), array('openid' => $openid), 'limit 1');
        $bbsReply = $bbsReply->fetch();
        $stdTest = pdoQuery('std_user_score_tbl', null, array('openid' => $openid), ' limit 5');
        $stdTest = $stdTest->fetchAll();
        printAdminView('admin/view/user_detail.html.php', '详细信息');

    }

    //公众号操作
    if (isset($_GET['wechat'])) {
        include_once '../wechat/serveManager.php';

        if (isset($_GET['createButton'])) {
            deleteButton();
//            createButtonTemp();
            $url = 'http://' . $_SERVER['HTTP_HOST'] . DOMAIN . '/wechat/?oauth=snsapi_base&diract=';
//            $button1sub1 = array('name' => '微官网', 'type' => 'view', 'url' => 'http://admin88.winjubao.com/weixinpl/weixin_inter/menu_index.php?customer_id=413');
//            $button1sub2 = array('name' => '品牌介绍', 'type' => 'view', 'url' =>'http://admin88.winjubao.com/weixin/plat/app/Html/413/953692/about.html?fromuser=null&wxref=mp.weixin.qq.com');
//            $button1sub3 = array('name' => '时尚态度', 'type' => 'view', 'url' =>'http://admin88.winjubao.com/weixin/plat/app/Html/413/953692/Detail_32.php?single_id=10288&C_id=413&fromuser=null&wxref=mp.weixin.qq.com');
//            $button1sub4 = array('name' => '细节展示', 'type' => 'view', 'url' => 'http://admin88.winjubao.com/weixin/plat/app/Html/413/953692/diy413_4922.html?fromuser=null&wxref=mp.weixin.qq.com');
//            $button2sub3 = array('name' => '经销商入口', 'type' => 'view', 'url'=>$url . 'log_check');
            $button2sub1 = array('name' => '防伪验证', 'type' => 'view', 'url' => $url . 'qr_verify');
//            $button2sub2 = array('name' => '渠道回溯', 'type' => 'view', 'url' => $url . 'qr_query');
            $button2sub3 = array('name' => '发货扫描', 'type' => 'view', 'url' => $url . 'qr_book');
//            $button3=array('name'=>'个人中心','type'=>'view','url'=>$url.'user_inf');
//            $button2sub4 = array('name' => '我要参赛', 'type' => 'view', 'url' =>'http://admin88.winjubao.com/weixin/plat/app/Html/413/953692/Detail_32.php?single_id=10314&C_id=413&fromuser=null&wxref=mp.weixin.qq.com');
//            $button2sub5 = array('name' => '我要投票', 'type' => 'click', 'key' =>'wsy_413_16759');
//            $button3sub1 = array('name' => '联系我们', 'type' => 'view', 'url' => 'http://admin88.winjubao.com/weixin/plat/app/Html/413/953692/contact.html?fromuser=null&wxref=mp.weixin.qq.com');
//            $button3sub2 = array('name' => '意见反馈', 'type' => 'view', 'url' =>'http://admin88.winjubao.com/weixinpl/liuyan/show_liuyan.php?customer_id=413&fromuser=null&wxref=mp.weixin.qq.com');
//            $button3sub3 = array('name' => '买家秀展', 'type' => 'view', 'url' =>'http://admin88.winjubao.com/weixin/plat/app/Html/413/953692/diy413_4923.html?fromuser=null&wxref=mp.weixin.qq.com');
//            $button3sub4 = array('name' => '每月一课', 'type' => 'view', 'url' => $url . '&cate=4');
//            $button3sub5 = array('name' => '每月一课', 'type' => 'view', 'url' => $url . '&cate=4');
//            $button1 = array('name' => '关于我们', 'sub_button' => array($button1sub1, $button1sub2, $button1sub3, $button1sub4));
//            $button2 = array('name' => '功能菜单', 'sub_button' => array($button2sub1, $button2sub3));
//            $button3 = array('name' => '联系我们', 'sub_button' => array($button3sub1, $button3sub2));
//            $mainButton = array('button' => array($button1, $button2, $button3), 'matchrule' => array('group_id' => $row['id']));
            $mainButton = array('button' => array($button2sub3, $button2sub1));
            $jsondata = json_encode($mainButton, JSON_UNESCAPED_UNICODE);
            echo createButton($jsondata);
            exit;
        }
        if (isset($_GET['createUniButton'])) {
            $url = 'http://' . $_SERVER['HTTP_HOST'] . DOMAIN . '/wechat/?oauth=snsapi_base&diract=';
            $button2sub1 = array('name' => '防伪验证', 'type' => 'view', 'url' => $url . 'qr_verify');
            $button2sub3 = array('name' => '发货扫描', 'type' => 'view', 'url' => $url . 'qr_book');
            $button3=array('name'=>'个人中心','type'=>'view','url'=>$url.'user_inf');
            $mainButton = array('button' => array($button2sub3, $button2sub1, $button3), 'matchrule' => array('tag_id' => 100));

//            $mainButton = array('button' => array($button1, $button2, $button3));
            $jsondata = json_encode($mainButton, JSON_UNESCAPED_UNICODE);
            echo createUniButton($jsondata);
            exit;
        }
        if (isset($_GET['getMenuInf'])) {
            echo getUserButton();
            exit;
        }
        if (isset($_GET['test'])) {
            include_once '../wechat/usersdk.php';
            echo json_encode(usersdk::getTaglist(), JSON_UNESCAPED_UNICODE);

//            $data=curlTest();
//            $data = sendKFMessage('o_Luwt9OgYENChNK0bBZ4b1tl5hc', '你好');
//            echo $data;
            exit;
        }

    }

    exit;
}
header('location:index.php');

exit;

