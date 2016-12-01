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
        ZamanGoz
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
            $.post('ajax.php',{action:'query',data:result},function(re){
                var value=eval('('+re+')');
                if(0==value.errcode){
                    resultOut(value.data);
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
            $.post('ajax.php',{action:'clear_session'},function(re){
                    wx.closeWindow();
            });
        }

    }
    wx.ready(function(){
            wx.scanQRCode(
               myScan
            );
        }

    );

    function resultOut(data){
        $('.recorder_list').empty();
        $.each(data,function(k,v){
            var content='<li style="width: 93%">'+
                '<div class="pic f_l" style="width: 25%"><img src="'+ v.from_img+'"></div>'+
            '<div class="con f_r">'+
            '<div class="title">时间：'+ v.update_time+'</div>'+
            '<div class="sn">发货方：'+v.from_name+'</div>'+
            '<div class="sn">收货方：'+ v.to_name+'</div>'+
                '<div class="pic f_r" style="width: 25%"><img src="'+ v.to_img+'"></div>'+
            '</div>'+
            '<div class="clear"></div>'+
            '</li>';
            $('.recorder_list').append(content);
        })
    }

</script>