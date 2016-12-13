<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/20
 * Time: 11:44
 */
include_once '../includePackage.php';
header('location: http://' . $_SERVER['HTTP_HOST'] . DOMAIN . '/wechat/?oauth=snsapi_base&diract=index');
exit;