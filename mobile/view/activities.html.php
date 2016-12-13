<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="stylesheet/channel.css?t=<?php echo rand(1000,9999)?>"/>
    <!--    --><?php //include_once 'templates/jssdkIncluder.php' ?>
</head>

<body>
<?php include 'templates/nav.php'?>
<div class="wrap ac_wrap">
    <div class="channel_name">公司活动</div>

    <?php foreach($activities as $row):?>
    <div class="ac_block">
        <div class="ac_time">
            <?php echo date('Y-m-d',$row['art_add_time'])?>
        </div>
        <div class="title">
            <?php echo $row['art_title'] ?>
        </div>
        <img src="../<?php echo $row['art_img']?>">
        <div class="intro">
            <?php echo $row['art_short_text']?>
        </div>
        <a href="<?php echo $row['url']?$row['url']:'?channel=activty_detail&id='.$row['art_id']?>">
        <div class="link">
            <span>阅读原文</span>
        </div>
        </a>

    </div>
    <?php endforeach ?>


</div>
</body>