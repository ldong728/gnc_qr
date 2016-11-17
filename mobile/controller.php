<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/28
 * Time: 15:14
 */
include_once '../includePackage.php';
session_start();
if(isset($_SESSION['openId'])){
    if(isset($_GET['card_mall'])){
        include_once '../wechat/interfaceHandler.php';
        include_once '../wechat/cardsdk.php';
        $card=new cardsdk();
//        $cardList=array('pubtTty4wq9YW_hDjKptg65LTnY0','pubtTt1tt5H0Xn1hvaQ2jLaYK7iA','pubtTtxxhsxjGKHHuEWnrXVdpvcg');
        $cardid='pubtTtwIDpuhWcvKtOW0e9Dj01Ig';
//        foreach ($cardList as $row) {
//            $cardInfList[$row]=json_encode($card->getCardExt($_SESSION['openId'],$row));
//        }
        for($i=0;$i<3;$i++){
            $cardInfList[]=array('id'=>$cardid,'ext'=>json_encode($card->getCardExt($_SESSION['openId'],$cardid)));
        }
        include 'view/get_card_view.html.php';
        exit;
    }
    if(isset($_GET['qr_book'])){
        include 'view/qr_scanner.html.php';
    }

}

