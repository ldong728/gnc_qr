<?php
include_once '../includePackage.php';


$lengh=31;
$category='02';
$offset=800;
$mainOffset=0;
if(isset($_POST['creator_v3'])){
    $subNumber=substr($_POST['sub_num']+1000,1);
    $cat=substr($_POST['cate']+100,1);
    for($i=0;$i<$_POST['main_num'];$i++){
        $index=(string)($mainOffset+$i);
        $len=strlen($index);
        $nonc=getRandStr(7-$len);
        $mstr='03'.$subNumber.$cat.$index.$nonc;
        $mmd5=md5($mstr.SN_KEY);
        $vf=$mmd5[0];
        $ve=$mmd5[31];
        $mstr=$vf.$mstr.$ve;
        if(snPreVerify($mstr)){
            echo $mstr.'</br>';
            for($j=0;$j<$_POST['sub_num'];$j++){
                $index=(string)($j);
                $len=strlen($index);
                $nonc=getRandStr(14-$len);
                $sstr=$index.$nonc;
                $smd5=md5($sstr.SN_KEY);
                $sstr=$mstr.$smd5[0].$sstr.$ve;
                if(snPreVerify($sstr)){
                    echo $sstr.'</br>';
                }else{
                    echo 'sub error</br>';
                }
            }
        }else{
            echo 'errror</br>';
        }

    }

    exit;
}
if(isset($_POST['num'])){

    for($i=0;$i<$_POST['num'];$i++){
        $n=$category.(string)($offset+$i);//
        $placehold=strlen($n);//获取分类加编号的
        $nonc=getRandStr($lengh-$placehold);
        $preSn=$n.$nonc.SN_KEY;
        $md5=md5($preSn);
        $f=substr($md5,0,1);
        $sn=$f.$n.$nonc;
        if(snPreVerify($sn)){
//        $insert[]=array('code'=>$sn);

        $output[$i+$offset]=$sn;
        }else{

        }

    }
//    pdoBatchInsert('gd_qr_tbl',$insert);//
//    echo getArrayInf($output);
    include 'view/toExcel.php';
    exit;
}
if(isset($_POST['sn'])){
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