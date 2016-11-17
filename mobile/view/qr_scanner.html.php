<head>
    <?php include 'templates/header.php'?>
    <!--    <link rel="stylesheet" href="stylesheet/order.css"/>-->
</head>

<body>

</body>
<?php include_once 'templates/jssdkIncluder.php' ?>

<script>
    var resultList=[];
    var bactchScan={
        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
        scanType: ["qrCode"], // 可以指定扫二维码还是一维码，默认二者都有
        success: function (res) {
                    var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                    resultList.push(result);

                    setTimeout(function(){
                        wx.scanQRCode(bactchScan)
                    },600);

                },
        cancel: function(res){
            $.post('ajax.php',{action:'booking',data:resultList},function(data){
                alert(data);
            })
            alert(resultList);
        }

    }
    wx.ready(function(){
            wx.scanQRCode(
                bactchScan
            );
        }

    );

</script>