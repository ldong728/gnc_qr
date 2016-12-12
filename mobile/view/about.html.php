<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="stylesheet/channel.css?t=<?php echo rand(1000,9999)?>"/>
    <!--    --><?php //include_once 'templates/jssdkIncluder.php' ?>
</head>

<body>
<?php include 'templates/nav.php'?>
<div class="wrap about_wrap">
    <div class="channel_name">
        公司简介
    </div>
    <div class="img_container">
        <img src="../<?php echo $aboutInf['art_img']?>">
    </div>
    <div class="content_container">
        <?php echo $aboutInf['art_text']?>
    </div>



</div>


</body>


<script>


    //    wx.ready(function () {
    //            wx.scanQRCode(
    //            );
    //        }
    //    );


</script>