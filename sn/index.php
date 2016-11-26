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
        $f=substr(md5($n.$nonc.SN_KEY),0,1);
        $sn=$f.$n.$nonc;
        $insert[]=array('code'=>$sn);
        $output[$i+$offset]=$sn;
//        echo $sn.'</br>';
    }
    pdoBatchInsert('gd_qr_tbl',$insert);
    include 'view/toExcel.php';
    exit;
}
if(isset($_POST['sn'])){
    $sn=$_POST['sn'];
    echo 'ok';
    echo snPreVerify($sn)?'yes':'no';
    exit;

}


include 'view/tmpView.html.php';