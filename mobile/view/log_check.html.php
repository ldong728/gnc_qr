<head>
    <?php include 'templates/header.php'?>
    <!--    <link rel="stylesheet" href="stylesheet/order.css"/>-->
    <link rel="stylesheet" href="stylesheet/user.css"/>
    <?php include_once 'templates/jssdkIncluder.php' ?>
</head>

<body class="age_bg">
<div class="nav_hd">
    <a href="javascript:history.back(-1)" class="back clearfix">
        <span class="f_l">&lt;</span>返回
    </a>
    <div class="title">
        潮品贸易
    </div>

</div>
<div class="sub_age">

</div>


</body>


<script>
    wx.ready(function() {
            alert('此微信号已与经销商账户绑定，请关闭公众号对话并重新进入');
            wx.closeWindow();
        }
    );


</script>