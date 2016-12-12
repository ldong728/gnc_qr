<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="stylesheet/channel.css?t=<?php echo rand(1000,9999)?>"/>
    <link rel="stylesheet" href="stylesheet/mobile-index-swiper.min.css"/>
    <link rel="stylesheet" href="stylesheet/myswiper.css"/>
    <script src="../js/swiper.min.js"></script>
    <!--    --><?php //include_once 'templates/jssdkIncluder.php' ?>
</head>

<body>
<?php include 'templates/nav.php'?>
<div class="wrap good_wrap">

    <div class="banner content">
        <div class="channel_name">
            EVIL EYE
        </div>
        <div class="swiper-container" id="ad-swiper">
            <div class="swiper-wrapper" style="width: 4368px; height: 60vw">
                <?php foreach ($imgList as $row): ?>
                    <div class="swiper-slide">
                        <img class="swiper-img swiper-lazy" data-src="../<?php echo $row ?>"/>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="pg_container">
            <div class="swiper-pagination" id="ad-pagination" style="margin: 0 auto; position: relative"></div>
        </div>

    </div>
    <div class="good_nav">产品介绍</div>
    <div class="content detail">
        <?php echo $goodsInf['art_text']?>
    </div>




</div>


</body>


<script>
    var swiper = new Swiper('#ad-swiper', {
        pagination: '#ad-pagination',
        paginationClickable: true,
        autoplay: 5000,
        lazyLoading: true,
        loop: true
    });
</script>