<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/2
 * Time: 15:04
 */
include_once 'interfaceHandler.php';


class templateMsg {
    private $msg;
    public function __construct(){
    }

//    private function getIdList

    public function createTmplateMsg(array $msg){
        $temp=array();
        foreach ($msg as $k => $v) {
            if(!isset($v[1]))$v[1]='#000000';
            $temp[$k]=array('value'=>$v[0],'color'=>$v[1]);
        }
        $this->msg=$temp;
        return $this;
    }
    public function sendTmplateMsg($openId,$tmpId,$url){
        if(isset($this->msg)){
            $fullMsg=array(
                'touser'=>$openId,
                'template_id'=>$tmpId,
                'url'=>$url,
                'data'=>$this->msg
            );
            mylog(json_encode($fullMsg,JSON_UNESCAPED_UNICODE));
            $response=interfaceHandler::getHandler()->postArrayByCurl('https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=ACCESS_TOKEN',$fullMsg);
            return $response;
        }
    }
} 