<?php
global $articleInf;
?>



<script src="js/ajaxfileupload.js"></script>
<div class="block">
    <div class="head" style="width: 98%;"><span><?php echo $_SESSION['pms'][$_GET['menu']]['sub'][$_GET['sub']]['name']?></span></div>
    <div class="main">
        <form id="form_add_goods" method="post" action="controller.php?menu=<?php echo $_GET['menu']?>&sub=<?php echo $_GET['sub']?>&edit_article=1&rediract=<?php echo $_GET['rediract']?>">
            <!--            <input name="cmd" type="hidden" value="add_or_edit_goods">-->
            <?php echo $articleInf? '<input type="hidden" name="art_id" value="'.$articleInf['art_id'].'">' : ''?>
            <?php echo $_GET['cha_id'] ? '<input type="hidden" name="art_channel_id" value="'.$_GET['cha_id'].'">' : ''?>
            <?php echo $_GET['cat_id'] ? '<input type="hidden" name="art_cat_id" value="'.$_GET['cat_id'].'">' : ''?>
            <table class="table">
                <tbody>
                <tr >
                    <td width="120px">标题：</td>
                    <td><input name="art_title" type="text" class="text" maxlength="200" <?php echo $articleInf? 'value="'.$articleInf['art_title'].'"':''?>></td>
                </tr>
                <tr>
                    <td>图片</td>
                    <td>
                        <span id="show_pic_1"></span>
                        <img class="uploadImg" id="title_demo" style="padding: 0; max-width: 70px;height: auto;display: <?php echo $articleInf ? 'block':'none'?>" <?php echo $articleInf ? 'src="../'.$articleInf['art_img'].'"':''?>/>

                        <label class="uploadImg blank" <?php echo $articleInf ?'style="display:none"': 'style="display:inline-block"'?>>
                            <span>插入图片</span>
                        </label>
                        <img class="uploadImg" id="title_demo" style="padding: 0; max-width: 70px;height: auto;display: <?php echo $articleInf ? 'block':'none'?>" <?php echo $articleInf ? 'src="../'.$articleInf['art_img'].'"':''?>/>

                        <input type="hidden" name="art_more_img" id="title_name" <?php echo $articleInf? 'value="'.$articleInf['art_more_img'].'"':''?>/>
                        &nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
                <tr>

                    <td>正文：</td>
                    <td>
                        <script id="container" name="art_text" type="text/plain"></script>
                        <!-- 配置文件 -->
                        <script type="text/javascript" src="../ueditor/ueditor.config.js"></script>
                        <!-- 编辑器源码文件 -->
                        <script type="text/javascript" src="../ueditor/ueditor.all.js"></script>
                        <!-- 实例化编辑器 -->
                        <script type="text/javascript">
                            var ue = UE.getEditor('container');
                        </script>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="bt_row">
                            <input class="button" type="submit" value="提交">
                        </div>
                    </td>
                </tr>
                </tbody></table>
        </form>
    </div>
    <input type="file" id="title-img-up" name="title-img-up" style="display: none">
</div>

<script>
    $(document).on('click', '.uploadImg', function () {
        $('#title-img-up').click();
    });
    $(document).on('change', '#title-img-up', function () {
        $.ajaxFileUpload({
            url: 'upload.php',
            secureuri: false,
            fileElementId: $(this).attr('id'), //文件上传域的ID
            dataType: 'json', //返回值类型 一般设置为json
            success: function (v, status) {
                if ('SUCCESS' == v.state) {
//                                var content = '<a href="#"class="delete-front-img"id="'+ v.id+'"><img src="../'+ v.url+'"/></a>';
//                                $('.front-img-upload').before(content);
                    $('#title_demo').attr('src', '../' + v.url);
                    $('#title_demo').fadeIn('fast');
                    $('.blank').hide();
                    $('#title_name').val(v.url);
                } else {
                    showToast(v.state);
                }
            },//服务器成功响应处理函数
            error: function (d) {
                alert('error');
            }
        });
    });
</script>
<div class="space"></div>
<script>
    $('.send').hide();
    ue.ready(function(){
        $('.send').show();
        var mode=<?php echo $mode ?>;
        var id=<?php echo $articleInf['id']? $articleInf['id']:'false' ?>;
        if(id){
            $.post('ajax_request.php',{getNews:1,id:id,mode:mode},function(data){
                ue.setContent(data);
            })
        }
    })

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
<script>
    ue.ready(function(){
        var id=<?php echo $articleInf['art_id']? $articleInf['art_id']:'false' ?>;
        if(id){
            $.post('ajax_request.php',{pms:pms,method:'get_article',id:id},function(data){
                var re=eval('('+data+')')
                if(0==re.errcode){
                    ue.setContent(re.data);
                }
            })
        }
    })
</script>