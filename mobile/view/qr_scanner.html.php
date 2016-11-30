<head>
    <?php include 'templates/header.php' ?>
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
    <a href="./" class="home">
        <span>&lt;</span>
    </a>
</div>
<div class="sub_age dealer_list" style="display: none">
    <ul class="clearfix">
        <?php foreach ($subDealer as $row): ?>
            <li class="dealer" id="<?php echo $row['use_id'] ?>" style="cursor: pointer">
                <div class="pic f_l"><img src="<?php echo $row['use_img'] ?>"></div>
                <div class="con f_r">
                    <div class="title"><?php echo $row['use_username'] ?></div>
                    <div class="sn"><?php echo $row['use_phone'] ?></div>
                </div>
                <div class="clear"></div>
            </li>
        <?php endforeach ?>
    </ul>
    <div class="page_link">
        <div class="in">
            <span>共1页</span>
            <span>第1页</span>
        </div>
    </div>
</div>
<div class="qr_list" style="display: none">
    <div class="qr_content">

    </div>
    <div>共<span id="total_count"></span>条记录</div>
    <div class="button_area">
        <button id="ship">发货</button>
        <button id="scan">继续扫描</button>
    </div>

</div>


</body>

<script>

    var resultList = {};
    $('.dealer').click(function () {
        var id = $(this).attr('id');
        var tNumber = objLengh(resultList);
        if (0 != tNumber) {
            $.post('ajax.php', {action: 'booking', touser: id, data: resultList}, function (data) {
//                alert(data);
//                var value=eval('('+data+')');
//                if(null!=value.data){
//                }
                alert('上传成功');
                resultList = {};
            });
        } else {
            alert(resultList.toString());
            alert('已确认');
        }
    });
    $('#scan').click(function(){
        wx.scanQRCode(bactchScan);
    })
    $('#ship').click(function(){
        $('.qr_list').hide();
        var tNumber = objLengh(resultList);
        if (tNumber > 0) {
            $('.dealer_list').show();
        } else {
            wx.closeWindow();
        }
    })
</script>

<script>

    var bactchScan = {
        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
        scanType: ["qrCode"], // 可以指定扫二维码还是一维码，默认二者都有
        success: function (res) {
            var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
            resultList[hex_md5(result)] = result;
            var tNumber = objLengh(resultList);
            $('#total_count').text(tNumber);
            $('.qr_list').show();
            $('.qr_content').empty();
            $.each(resultList,function(k,v){
                var content='<div>'+v+'</div>';
                $('.qr_content').append(content);
            });


//            if (confirm('已扫描' + tNumber + '个二维码，是否继续扫描？')) {
//                wx.scanQRCode(bactchScan);
//            }
//            else {
//                if (tNumber > 0) {
//                    $('.dealer_list').show();
//                } else {
//                    wx.closeWindow();
//                }
//            }
        },
        cancel: function (res) {
            var tNumber = objLengh(resultList);
            if (tNumber > 0) {
                $('.dealer_list').show();
            } else {
                wx.closeWindow();
            }
        }
    }
    var scan = {
        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
        scanType: ["qrCode"], // 可以指定扫二维码还是一维码，默认二者都有
        success: function (res) {
            var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
            resultList[res.resultStr] = res.resultStr;
            alert(res.resultStr);
            setTimeout(function () {
                wx.scanQRCode(bactchScan)
            }, 500);
        },
        cancel: function (res) {
            $.post('ajax.php', {action: 'booking', data: resultList}, function (data) {
                alert(data);
            })
            alert(resultList);
        }

    }
    wx.ready(function () {
            wx.scanQRCode(
                bactchScan
            );
        }
    );
</script>
