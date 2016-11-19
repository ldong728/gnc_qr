<!doctype html>
<html>
<head>
    <?php include 'templates/header.php'?>
    <link rel="stylesheet" href="stylesheet/user.css"/>
    <script src="../js/lazyload.js"></script>
</head>
<body>
<div class="age_login">
    <form id="form_user_login" method="post" action="?login=1&diract=<?php echo $diract?>">
        <input name="cmd" type="hidden" value="user_login"/>
        <input class="txt" name="username" type="text" placeholder="代理帐号" />
        <input class="txt" name="password" type="password" placeholder="密码" />
        <input class="bt" type="submit" value="登录" />
    </form>
</div>
</body>
</html>