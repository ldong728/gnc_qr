<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/11/3
 * Time: 23:20
 */

function printView($addr,$title='abc',$subPath='/admin'){
    $mypath= $GLOBALS['mypath'];
    mylog($title.$subPath);
    include $mypath.$subPath.'/templates/header.html.php';
    mylog($mypath.$subPath.'/templates/header.html.php');
    include $mypath.'/'.$addr;
    include $mypath.$subPath.'/templates/footer.html.php';
}
function getProvince($pro){
    $datafile = 'config/province.inc.php';
    if(file_exists($datafile)){
        $config = include($datafile);
        return $config[$pro];
    }
}
function printViewMobile($addr,$title='abc',$hasInput=false){

    $mypath= $GLOBALS['mypath'];
    if($hasInput){
        include $mypath.'/mobile/templates/headerJs.html.php';

    }else{
        include $mypath.'/mobile/templates/header.html.php';
    }
//    echo 'header OK';

    include $mypath.'/'.$addr;
    include $mypath.'/mobile/templates/footer.html.php';
}
function getCity($pro,$city){
    $datafile = 'config/city.inc.php';
    if(file_exists($datafile)){
        $config = include($datafile);
        $province_id=$pro;
        if($province_id != ''){
            $citylist = array();
            if(is_array($config[$province_id]) && !empty($config[$province_id])){
                $citys = $config[$province_id];
                return $citys[$city];
            }
        }
    }
}
function getArea($pro,$city,$area){
    $datafile = 'config/area.inc.php';
    if(file_exists($datafile)){
        $config = include($datafile);
        $province_id = $pro;
        $city_id = $city;
        if($province_id != '' && $city_id != ''){
            $arealist = array();
            if(isset($config[$province_id][$city_id]) && is_array($config[$province_id][$city_id]) && !empty($config[$province_id][$city_id])){
                $areas = $config[$province_id][$city_id];
                return $areas[$area];
            }
        }
    }
}
function isUserLogin($direct){
    if(!isset($_SESSION['userId'])){
        $query=pdoQuery('gd_users',array('use_id'),array('use_openid'=>$_SESSION['openId']),' limit 1');
        if($userid=$query->fetch){
            $_SESSION['userId']=$userid['use_id'];
            return true;
        }

        return false;
    }else{
        return true;
    }
}





/**双向证书验证CURL
 * @param $url
 * @param $vars
 * @param int $second
 * @param array $aHeader
 * @return bool|mixed
 */
function curl_post_ssl($url, $vars, $second = 30, $aHeader = array())
{
    $ch = curl_init();
    //超时时间
    curl_setopt($ch, CURLOPT_TIMEOUT, $second);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //这里设置代理，如果有的话
    //curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
    //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    //以下两种方式需选择一种

    //第一种方法，cert 与 key 分别属于两个.pem文件
    //默认格式为PEM，可以注释
    curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
    curl_setopt($ch, CURLOPT_SSLCERT, '../cert/apiclient_cert.pem');
    //默认格式为PEM，可以注释
//    curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
    curl_setopt($ch, CURLOPT_SSLKEY, '../cert/apiclient_key.pem');
    curl_setopt($ch, CURLOPT_CAINFO, '../cert/rootca.pem');

    //第二种方式，两个文件合成一个.pem文件
//    curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');

    if (count($aHeader) >= 1) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
    }

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
    $data = curl_exec($ch);
    if ($data) {
        curl_close($ch);
        return $data;
    } else {
        $error = curl_errno($ch);
        echo "call faild, errorCode:$error\n";
        curl_close($ch);
        return false;
    }
}
