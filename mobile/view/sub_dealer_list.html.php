<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="stylesheet/user.css"/>
    <!--    --><?php //include_once 'templates/jssdkIncluder.php' ?>
</head>

<body class="age_bg">
<?php include 'templates/nav.php'?>
<!-- GOODUO -->
<div class="age_wrap">
    <div class="reg_tab" id="reg_login" style="display: none">
        <ul  class="dealer_input" >
                <li>
                    <div class="title">
                        姓名
                    </div>
                    <div>
                        <input class="txt" id="use_username" type="text" placeholder="请填写">
                    </div>
                </li>
                <li>
                    <div class="title">
                        微信号
                    </div>
                    <div>
                        <input class="txt" id="use_wx_id" type="text" placeholder="请填写">
                    </div>
                </li>
                <li>
                    <div class="title">
                        手机号
                    </div>
                    <div>
                        <input class="txt" id="use_phone" type="tel" placeholder="请填写" maxlength="11">
                    </div>
                </li>
            <li>
                <div class="title">
                   密码
                </div>
                <div>
                    <input class="txt" id="use_password" type="text" placeholder="请填写">
                </div>
            </li>

                                <li>
                    <div class="title">
                        经销商级别
                    </div>
                    <div>
                        <select name="region_1" class="txt" id="use_rank">
                            <?php foreach($rank as $row):?>
                            <option value="<?php echo $row['rank']?>"><?php echo $row['name']?></option>
                            <?php endforeach ?>
                        </select>&nbsp;&nbsp;

                    </div>
                </li>
                <li>
                    <input class="bt" type="button" id="submit" value="确定" onclick="submit()">
                </li>
        </ul>
    </div>

    <a class="age_pro_logout add_sub"<?php echo $_GET['p_id']!=$_SESSION['userId'] ? 'style="display:none"':''?>>添加下级代理</a>
</div>
<script>
    function submit() {

        var data={data:{}};
        $('.txt').each(function (k, v) {
            data.data[v.id]= v.value;
        });
        data.data['use_rank']=$('#use_rank').find("option:selected").val();
        data['action']='add_dealer';
        $.post('ajax.php',data,function(re){
            var data=eval('('+re+')');
            if(data.errcode==0){
                location.reload(true);
            }else{
//                showToast(data.errmsg);
            }

        });
    }
    $('.add_sub').click(function(){
        $('#reg_login').slideDown();
    });

</script>
<div class="sub_age">
    <ul class="clearfix">
        <?php foreach($subList as $row):?>
            <a href="?module=user_inf&user_id=<?php echo $row['use_id']?>">
        <li>
            <div class="pic f_l"><img src="<?php echo $row['use_img']?>"></div>
            <div class="con f_r">
                <div class="title"><?php echo $row['use_username']?></div>
                <div class="sn">代理级别：<?php echo $row['rank_name']?></div>
            </div>
            <div class="clear"></div>
        </li>
            </a>
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