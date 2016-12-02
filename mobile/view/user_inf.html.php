<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="stylesheet/user.css"/>
<!--    --><?php //include_once 'templates/jssdkIncluder.php' ?>
</head>

<body class="age_bg">
<div class="nav_hd">
    <div class="title">
        ZamanGoz
    </div>
    <a href="./" class="home">
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
            代理级别：<?php echo $userInf['rank_name']?>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="age_wrap age_pro_act">
    <a href="?module=sub_dealer_list&p_id=<?php echo $userInf['use_id']?>" class="agents clearfix">下级代理 <span class="f_r">&gt;</span></a>
    <a href="?module=alter_password" class="age_pro_pw clearfix">修改密码 <span class="f_r">&gt;</span></a>
</div>
<div class="age_wrap">
    <a href="?module=logout" class="age_pro_logout">退出登录</a>
</div>


</body>


<script>


//    wx.ready(function () {
//            wx.scanQRCode(
//            );
//        }
//    );


</script>