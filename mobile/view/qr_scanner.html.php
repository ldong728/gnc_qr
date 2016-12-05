<head>
    <?php include 'templates/header.php' ?>
    <!--    <link rel="stylesheet" href="stylesheet/order.css"/>-->
    <link rel="stylesheet" href="stylesheet/user.css"/>
    <?php include_once 'templates/jssdkIncluder.php' ?>
    <style>
        .qr_content {
            width: 80%;
            height: 200px;
            margin: 20px auto;
            font-size: 22px;
            font-weight: 700;
            line-height: 180px;
            text-align: center;
            color: #78340f;
        }
       #total_count {
           font-size: 45px;
           font-weight: 800;
       }
        .scan_count {

        }
        .button_area {
            width: 80%;
            margin: 0 auto;
            /*align-content: center;*/
        }

        .button_area button {
            box-sizing: border-box;
            width: 100%;
            margin-top: 20px;
            height: 50px;
            font-size: 16px;
        }
    </style>
</head>

<body class="age_bg">
<div class="nav_hd">
<!--    <a href="javascript:history.back(-1)" class="back clearfix">-->
<!--        <span class="f_l">&lt;</span>返回-->
<!--    </a>-->

    <div class="title">
    </div>

</div>
<div class="sub_age dealer_list" style="display: none">
    <ul class="clearfix">
        <?php foreach ($subDealer as $row): ?>
            <li class="dealer" id="<?php echo $row['use_id'] ?>" data-name="<?php echo $row['use_username']?>" style="cursor: pointer">
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
    <div class="qr_content" >
        已扫描 <span id="total_count"></span> 件
    </div>
<!--    <div class="scan_count">共<span id="total_count"></span>条记录</div>-->
    <div class="button_area">
        <button id="scan">继续扫描</button>
        <button id="ship">发货</button>
    </div>

</div>


</body>

<script>

    var resultList = {};
    $('.dealer').click(function () {
        var id = $(this).attr('id');
        var name=$(this).data('name');
        var tNumber = objLengh(resultList);
        if (0 != tNumber) {
            if(confirm('确定发货给'+name+'?')){
                $.post('ajax.php', {action: 'booking', touser: id, data: resultList}, function (data) {
                    alert('发货成功');
                    resultList = {};
                });
            }
        } else {
//            alert(resultList.toString());
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
//            $('.qr_content').empty();
            $.each(resultList,function(k,v){
                var content='<div>'+v+'</div>';
//                $('.qr_content').append(content);
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
