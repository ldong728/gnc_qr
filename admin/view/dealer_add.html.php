<?php
//$mode = isset($GLOBALS['notice']) ? $GLOBALS['notice'] : 1;
//$mode = isset($GLOBALS['mode']) ? $GLOBALS['mode'] : $mode;
$inf = isset($GLOBALS['inf']) ? $GLOBALS['inf'] : false;
//$jmCate = isset($GLOBALS['jmCate']) ? $GLOBALS['jmCate'] : array();
//$jmSCate = isset($GLOBALS['jmSCate']) ? $GLOBALS['jmSCate'] : array();
//$f_id=isset($GLOBALS['f_id'])?$GLOBALS['f_id'] : -1;
//
?>


<style>
    .newsInput li {
        margin-bottom: 20px;
    }
</style>

<script src="js/ajaxfileupload.js"></script>
<section>
    <div class="page_title"><h2>新建/修改经销商</h2></div>
    <input type="hidden" name="id" value="<?php echo $inf ? $inf['id'] : -1 ?>"/>
    <section style="padding-left: 120px">
        <ul class="newsInput">
            <li>
                <span class="item_name" style="display:inline-block;width:120px">手机号码:</span>
                <input type="text" class="userinf textbox textbox_225" placeholder="请输手机号码"
                       name="use_phone" <?php echo $inf ? 'value="' . $inf['use_phone'] . '"' : '' ?>/>
            </li>
            <li>
                <span class="item_name" style="display:inline-block;width:120px">微信号:</span>
                <input type="text" class="userinf textbox textbox_225" placeholder="请输入经销商微信号"
                       name="use_wx_id" <?php echo $inf ? 'value="' . $inf['use_real_name'] . '"' : '' ?>/>
            </li>
            <li>
                <span class="item_name" style="display:inline-block;width:120px">用户名:</span>
                <input type="text" class="userinf textbox textbox_225" placeholder="请输入经销商用户名"
                       name="use_username" <?php echo $inf ? 'value="' . $inf['use_real_name'] . '"' : '' ?>/>
            </li>
            <li>
                <span class="item_name" style="display:inline-block;width:120px">密码:</span>
                <input type="text" class="userinf textbox textbox_225" placeholder="请输入密码"
                       name="use_password" <?php echo $inf ? 'value="' . $inf['use_real_name'] . '"' : '' ?>/>
            </li>


        </ul>
    </section>
    <section style="padding-left: 120px">
        <input type="button" class="link_btn" value="创建/修改" onclick="submit()"/>
    </section>


</section>
<div class="space"></div>
<script>

    function submit() {
        var data={data:{}};
        $('.userinf').each(function (k, v) {
//            alert(v.value);
            data.data[v.name]= v.value;
        });
        data['pms']=pms;
        data['method']='add_dealer';
        $.post('ajax_request.php',data,function(re){
            showToast(re);
//            alert(ra);
        });
    }

</script>
<script>
    $('.f_select').change(function () {
        var f_id = $(this).val();
        $('.s_select').css('display', 'none');
        $('.s_select').removeAttr('name');
        $('#sub' + f_id).attr('name', 'jm_cate');
        $('#sub' + f_id).show();
    });
</script>
<script>
    $('.send').click(function () {
        $('#sendNow').val(1);
        $('form').submit();
    });
</script>