<head>
    <?php include 'templates/header.php'?>
    <!--    <link rel="stylesheet" href="stylesheet/order.css"/>-->
    <link rel="stylesheet" href="stylesheet/user.css"/>
    <?php include_once 'templates/jssdkIncluder.php' ?>
</head>

<body class="age_bg">
<div class="nav_hd">
<!--    <a href="javascript:history.back(-1)" class="back clearfix">-->
<!--        <span class="f_l">&lt;</span>返回-->
<!--    </a>-->
    <div class="title">
    </div>
<!--    <a href="./" class="home">-->
<!--        <span>&lt;</span>-->
<!--    </a>-->
</div>
<div class="sub_age">
    <ul class="clearfix recorder_list">
    </ul>

</div>


</body>


<script>

    var myScan={
        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
        scanType: ["qrCode"], // 可以指定扫二维码还是一维码，默认二者都有
        success: function (res) {
            var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
            $.post('ajax.php',{action:'verify',data:result},function(re){
                var value=eval('('+re+')');
                if(0==value.errcode){
                    if(confirm('您查询的该商品为正品，点击确定关闭网页')){
                        wx.closeWindow();
                    }else{
                        wx.scanQRCode(
                            myScan
                        )
                    }
                }else{
                    if(confirm('错误：'+value.errmsg+',是否继续')){
                        wx.scanQRCode(
                            myScan
                        )
                    }else{
                        wx.closeWindow();
                    }
                }
            });
        },
        cancel: function(res){

        }

    }
    wx.ready(function(){
            wx.scanQRCode(
                myScan
            );
        }

    );


</script>