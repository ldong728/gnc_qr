<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="stylesheet/channel.css?t=<?php echo rand(1000,9999)?>"/>
    <script src="../js/lazyload.js"></script>
        <?php include_once 'templates/jssdkIncluder.php' ?>
</head>

<body>
<?php include 'templates/nav.php'?>
<div class="photo_wrap">
    <div class="channel_name">买家照片</div>
    <div class="photo_container">
        <div class="img_block f_l">
        <?php foreach($article as $k=>$row):?>
            <?php if(1==$k%2):?>

            <div class="shadow detail"style="cursor: pointer">
                <img class="lazy-l" data-original-height="100%" data-original-width="100%" data-original="../<?php echo $row['art_img']?>" src="images/no_img.gif">
            </div>

            <?php endif ?>
        <?php endforeach ?>
        </div>
        <script>
            $("img.lazy-l").lazyload();
        </script>
        <div class="img_block f_l">
        <?php foreach($article as $k=>$row):?>
            <?php if(0==$k%2):?>

                    <div class="shadow detail"style="cursor: pointer">
                        <img class="lazy-r" data-original-height="100%" data-original-width="100%" data-original="../<?php echo $row['art_img']?>" src="images/no_img.gif">
                    </div>

            <?php endif ?>
        <?php endforeach ?>
        </div>
        <script>
            $("img.lazy-r").lazyload();
        </script>
    </div>
    <div class="hidden_layer">
        <img class="img_detail">
    </div>
</div>
    <script>
        $('.detail').click(function(){
            var img =$(this).children('img').get(0);
            wx.previewImage({
                current: img.src, // 当前显示图片的http链接
                urls: [img.src] // 需要预览的图片http链接列表
            });
//            $('.img_detail').attr('src',img.src);
//            $('.hidden_layer').fadeIn('fast');
        })
        $('.hidden_layer').click(function(){
            $(this).fadeOut('fast');
        })
    </script>

</body>