<?php
include_once '../includePackage.php';


$lengh=31;
$category='01';
$offset=10000;
if(isset($_POST['num'])){

    for($i=0;$i<$_POST['num'];$i++){
        $n=$category.(string)($offset+$i);//
        $placehold=strlen($n);//获取分类加编号的
        $nonc=getRandStr($lengh-$placehold);
        $preSn=$n.$nonc.SN_KEY;
        $md5=md5($preSn);
        $f=substr($md5,0,1);
        $sn=$f.$n.$nonc;
        $vr=snPreVerify($sn)? 'match': 'not match';
        $insert[]=array('code'=>$sn);
        $output[$i+$offset]=$sn;
        echo $sn.':  '.$vr.'</br>';
    }
    pdoBatchInsert('gd_qr_tbl',$insert);//
    include 'view/toExcel.php';
    exit;
}
if(isset($_POST['sn'])){
    echo 'post';
    $sn=$_POST['sn'];
    $list=pdoQuery('gd_qr_tbl',array('code'),null,null);
    $count=0;
    $matchCount=0;
    foreach ($list as $row) {
//        echo 'loop';
        $count++;
        if(snPreVerify($row['code'])){
            $matchCount++;
            echo $matchCount.' of '.$count.':  '.$row['code'].'</br>';
        }
    }

//    echo 'ok';
//    echo snPreVerify($sn)?'yes':'no';
    exit;

}


include 'view/tmpView.html.php';