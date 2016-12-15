<!DOCTYPE html>
<html lang="cn">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>序列号生成器</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <style>
        dt {
            cursor: pointer;
        }
        .border {
            border: 1px solid #ddd;
            margin-bottom: 30px;
        }
        .border .title {
            font-size: 17px;
            text-align: center;
            font-weight: 600;
        }
    </style>

</head>
<body>
<div class="border">
    <div class="title">生成器版本1</div>
    <form action="?" method="post">
        <input type="hidden" name="creator_v2">
        <input type="number" name="num">
        <input type="submit" value="生成">
    </form>
</div>

<div class="border">
    <div class="title">生成器版本3</div>
    <form action="?" method="post">
        <input type="hidden" name="creator_v3">
        <input type="number" name="cat" placeholder="分类">
        <input type="number" name="main_num" placeholder="大码数量">
        <input type="number" name="sub_num" placeholder="小码数量">

        <input type="submit" value="生成">
    </form>
</div>


<form action="?" method="post">
    <input type="text" name="sn">
    <input type="submit" value="验证">
</form>




</body>

</html>