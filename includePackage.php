<?php
//以下为测试公众号用
//define('APP_ID','wx03393af10613da23');
//define('APP_SECRET','40751854901cc489eddd055538224e8a');
//define('WEIXIN_ID','gh_964192c927cb');
//define('MCH_ID','now is null');
//define('KEY','now is null');
//define("TOKEN", "godlee");
//define('DOMAIN',"mmzrb");
//define('NOTIFY_URL',"now is null");
//define("DB_NAME","gshop_db");
//define("DB_USER","gshopUser");
//define("DB_PSW","cT9vVpxBLQaFQYrh");
//$mypath = $_SERVER['DOCUMENT_ROOT'] . '/'.DOMAIN;   //用于直接部署



////以下为测试号专用
define('APP_ID','wx03393af10613da23');
define('APP_SECRET','40751854901cc489eddd055538224e8a');
define('WEIXIN_ID','gh_964192c927cb');
define('MCH_ID','now is null');
define('KEY','now is null');
define('ADMIN','hll');
define('PASSWORD','admin');
define("TOKEN", "godlee");
define('DOMAIN',"/gnc_qr");
define('NOTIFY_URL',"now is null");
define('DB_IP','localhost');
define("DB_NAME","gd_gnc");
define("DB_USER","gd_gnc");
define("DB_PSW","XKDBjCtqYwh83yA9");
$mypath = $_SERVER['DOCUMENT_ROOT'] .DOMAIN;   //用于直接部署
//$template_key_order='XpZKkl2LFqxN95XpKFRKcR7Dxu1Nh9ZCj3ILRzrbMUY';//模板网购成功通知
//$template_key_express='OWQiu_I2B-ZpxPDMrJpxU0al1fNN-onZE7uGeUTtcks';//模板快递物流提醒
//$template_key_gainshare='Z_GWJKcBIwvjItkjjiUlQMZCX8CLb9PQR2CQ_HvDujU';//佣金分配提醒
//$template_key_readyShip='WVCFi95PeBWyppGfzu5dUflTzfTUu7zaCCT-2nwxVAQ';//订单待发货提醒

include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
include_once $mypath . '/includes/gnc_qr.php';
include_once $mypath .'/wechat/interfaceHandler.php';
header("Content-Type:text/html; charset=utf-8");