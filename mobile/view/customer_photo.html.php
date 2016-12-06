<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="stylesheet/channel.css?t=<?php echo rand(1000,9999)?>"/>
    <!--    --><?php //include_once 'templates/jssdkIncluder.php' ?>
</head>

<body>
<div class="nav_hd">
    <div class="title">
    </div>
    <a href="" class="home">
        <span></span>
    </a>
</div>
<div class="wrap">
    <div class="channel_name">买家照片</div>
    <div class="photo_container">
        <?php foreach($article as $row):?>
        <div class="img_block f_l">
            <div class="shadow">
                <img src="<?php echo $row['art_img']?>">
            </div>

        </div>

        <?php endforeach ?>
    </div>

</div>

</body>