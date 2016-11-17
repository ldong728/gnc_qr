<?php


class oauth{
    private $oauthType;
    private $diract;

    public function __construct($oauthType='snsapi_base',$direct=''){
        $this->oauthType=$oauthType;
        $this->diract=$direct;
    }
    public function getOauth(){
        $state=$this->diract? $this->diract :'none';
        $url='https://open.weixin.qq.com/connect/oauth2/authorize?'
            .'appid='.APP_ID
            .'&redirect_uri='.urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['ORIG_PATH_INFO'])
            .'&response_type=code&scope='.$this->oauthType
            .'&state='.$state
            .'#wechat_redirect';
//             mylog($url);
        header('location: '.$url);
//            mylog(getArrayInf($_SERVER));
    }


}