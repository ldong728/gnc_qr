<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="stylesheet/index_temp.css"/>
    <link rel="stylesheet" href="stylesheet/mobile-index-swiper.min.css"/>
    <link rel="stylesheet" href="stylesheet/myswiper.css"/>
    <script src="../js/swiper.min.js"></script>
</head>

<body>
<?php include 'templates/nav.php'?>
<?php include_once 'templates/jssdkIncluder.php'?>
<div class="wrap">
    <div class="img">
        <a target="_blank" href="../xiong.jpg">
            <img src="../image/bc6cd3e37ccbf3396740a11ccc03dc37.png" alt="Ballade" width="100%" height="100%">
        </a>
    </div>
    <div class="table ">
        <?php for($i=0;$i<3;$i++):?>
            <a href="?channel=<?php echo $channelList[$i]['cha_code']?>&cha_id=<?php echo $channelList[$i]['cha_id']?>" class="visited"><div class="table_1 border_size1"><?php echo $channelList[$i]['cha_name']?></div></a>
        <?php endfor ?>
        </div>
    <div class="table ">
        <?php for($i=3;$i<6;$i++):?>
            <a href="?channel=<?php echo $channelList[$i]['cha_code']?>&cha_id=<?php echo $channelList[$i]['cha_id']?>" class="visited"><div class="table_1 border_size1"><?php echo $channelList[$i]['cha_name']?></div></a>
        <?php endfor ?>
    </div>



    <script>
        var url='<?php echo $url ?>';
        var tltitle='<?php echo $config['timeLineTitle']?>';
        var amtitle='<?php echo $config['appMessageTitle']?>';
        var desc='<?php echo $config['appMessageDesc']?>';
        wx.ready(function() {
            wx.onMenuShareTimeline({
                title: tltitle, // 分享标题
                link: url, // 分享链接
                imgUrl: '<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.DOMAIN.'/img/logo.jpg'?>', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            wx.onMenuShareAppMessage({
                title: amtitle, // 分享标题
                desc: desc, // 分享描述
                link: url, // 分享链接
                imgUrl: '<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.DOMAIN.'/img/logo.jpg'?>', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            wx.hideMenuItems({
                menuList: [
                    "menuItem:copyUrl",
                    "menuItem:originPage",
                    "menuItem:openWithQQBrowser",
                    "menuItem:openWithSafari",
                    "menuItem:share:weiboApp",
                    "menuItem:share:qq"
                ] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
            });
        });

    </script>



    <div class="toast"></div>
</div>
<script>
    var swiper = new Swiper('#ad-swiper', {
        pagination: '#ad-pagination',
        paginationClickable: true,
        autoplay: 5000,
        lazyLoading: true,
        loop: true
    });
</script>
<script>
    $('.search-button').click(function(){
        var key=$('.search-box').val()
        window.location.href='controller.php?search='+key;
    });
    $('.sdp-button').click(function(){
        window.location.href='controller.php?sdp=1&sdp_signup=1';
    });
</script>
<script>
    var scale=<?php echo $_SESSION['sdp']['level']>0?1:0?>;
    if(scale==0){
        $('.sdp-inf-header').css('display','block');
        $('.sdp-inf-header').html('<a href="#bottom">加盟微客，分享佣金</a>');
    }
    $(document).on('click','.sdp-inf-header',function(){
        $(this).fadeOut();
    });


</script>

</body>

