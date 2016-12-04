<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="stylesheet/user.css?t="<?php echo rand(1000,9999)?>"/>
    <!--    --><?php //include_once 'templates/jssdkIncluder.php' ?>
</head>

<body class="age_bg">
<div class="nav_hd">
    <div class="title">
        ZamanGoz
    </div>
    <a href="" class="home">
        <span></span>
    </a>
</div>
<!-- GOODUO -->

<div class="age_wrap age_pro_title">
    <div class="pic f_l">
        <img src="<?php echo $userInf['use_img']?>">
    </div>
    <div class="con f_r">
        <div class="title">
            <?php echo $userInf['use_username']?>
        </div>
        <div class="sn">
            申请级别：<?php echo $userInf['rank_name']?>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="age_wrap">
    <a  class="age_pro_logout" id="pass" data-id="<?php echo $userInf['use_id']?>">通过审核</a>
    <a  class="age_pro_logout" id="notPass" data-id="<?php echo $userInf['use_id']?>">驳回并删除</a>
</div>
<div class="sub_age">
    <ul class="clearfix">
        <?php foreach($list as $row):?>
            <li>
                <div class="pic f_l"><img src="<?php echo $row['use_img']?>"></div>
                <div class="con f_r">
                    <div class="title"><?php echo $row['use_username']?></div>
                    <div class="sn">代理级别：<?php echo $row['rank_name']?></div>
                </div>
                <div class="clear"></div>
            </li>
        <?php endforeach ?>
    </ul>
    <div class="page_link">
        <!--        <div class="in">-->
        <!--            <span>共1页</span>-->
        <!--            <span>第1页</span>-->
        <!--        </div>-->
    </div>
    <!-- GOODUO -->
</div>


</body>


<script>
    $('#pass').click(function(){
       var id=$(this).data('id');
        $.post('ajax.php',{action:'dealer_audit',data:{id:id}},function(re){
            var data=eval('('+re+')');
            if(data.errcode==0){
                location.reload(true);
            }else{
//                showToast(data.errmsg);
            }

        });
    });
    $('#notPass').click(function(){
        var id=$(this).data('id');
        $.post('ajax.php',{action:'dealer_delete',data:{id:id}},function(re){
            var data=eval('('+re+')');
            if(data.errcode==0){
                location.reload(true);
            }else{
//                showToast(data.errmsg);
            }

        });
    });

</script>