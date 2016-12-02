<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="stylesheet/user.css"/>
    <!--    --><?php //include_once 'templates/jssdkIncluder.php' ?>
</head>

<body class="age_bg">
<div class="nav_hd">
    <div class="title">
        Zaman Goz
    </div>
    <a href="./" class="home">
        <span></span>
    </a>
</div>
<!-- GOODUO -->
<div class="age_wrap">
    <div class="reg_tab" id="reg_login">
        <ul  class="ealer_input" style="display: none">
                <li>
                    <div class="title">
                        姓名
                    </div>
                    <div>
                        <input class="txt" name="real_name" type="text" placeholder="请填写">
                    </div>
                </li>
                <li>
                    <div class="title">
                        微信号
                    </div>
                    <div>
                        <input class="txt" name="wx_id" type="text" placeholder="请填写">
                    </div>
                </li>
                <li>
                    <div class="title">
                        手机号
                    </div>
                    <div>
                        <input class="txt" name="phone" type="text" placeholder="请填写">
                    </div>
                </li>
                                <li>
                    <div class="title">
                        所在地区
                    </div>
                    <div>
                        <select name="region_1" class="txt" onchange="get_region(this.value,'region_0_2')">
                            <option value="0">请选择</option>
                            <option value="110001">北京市</option><option value="119999">天津市</option><option value="130000">河北省</option><option value="140000">山西省</option><option value="150000">内蒙古自治区</option><option value="210000">辽宁省</option><option value="220000">吉林省</option><option value="230000">黑龙江省</option><option value="309999">上海市</option><option value="320000">江苏省</option><option value="330000">浙江省</option><option value="340000">安徽省</option><option value="350000">福建省</option><option value="360000">江西省</option><option value="370000">山东省</option><option value="410000">河南省</option><option value="420000">湖北省</option><option value="430000">湖南省</option><option value="440000">广东省</option><option value="450000">广西壮族自治区</option><option value="460000">海南省</option><option value="499999">重庆市</option><option value="510000">四川省</option><option value="520000">贵州省</option><option value="530000">云南省</option><option value="540000">西藏自治区</option><option value="610000">陕西省</option><option value="620000">甘肃省</option><option value="630000">青海省</option><option value="640000">宁夏回族自治区</option><option value="650000">新疆维吾尔自治区</option><option value="710000">台湾省</option><option value="810000">香港特别行政区</option><option value="820000">澳门特别行政区</option>
                        </select>&nbsp;&nbsp;

                    </div>
                </li>
                <li>
                    <input class="bt" type="button" value="确定" onclick="submit_register()">
                </li>
        </ul>
    </div>

    <a href="?module=logout" class="age_pro_logout add_sub">添加下级代理</a>
</div>
<script>

</script>
<div class="sub_age">
    <ul class="clearfix">
        <?php foreach($subList as $row):?>
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


    //    wx.ready(function () {
    //            wx.scanQRCode(
    //            );
    //        }
    //    );


</script>