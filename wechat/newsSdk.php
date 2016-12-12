<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2016/12/12
 * Time: 16:27
 */
include_once 'interfaceHandler.php';
class newsSdk {

    public function __construct(){

    }

    public static function getMediaList($type, $offset)
    {
        $request = array('type' => $type, 'offset' => $offset, 'count' => 20);
        $json = interfaceHandler::getHandler()->postArrayByCurl('https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=ACCESS_TOKEN', $request);
        return json_decode($json, true);
    }

}