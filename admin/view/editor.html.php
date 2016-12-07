<?php
$mode = isset($GLOBALS['notice']) ? $GLOBALS['notice'] : 1;
$mode = isset($GLOBALS['mode']) ? $GLOBALS['mode'] : $mode;
$inf = isset($GLOBALS['inf']) ? $GLOBALS['inf'] : false;
$jmCate = isset($GLOBALS['jmCate']) ? $GLOBALS['jmCate'] : array();
$jmSCate = isset($GLOBALS['jmSCate']) ? $GLOBALS['jmSCate'] : array();
$f_id=isset($GLOBALS['f_id'])?$GLOBALS['f_id'] : -1;
global $articleInf;
?>


<script src="js/ajaxfileupload.js"></script>
<div class="block">
    <div class="head" style="width: 98%;"><span><?php echo $_SESSION['pms'][$_GET['menu']]['sub'][$_GET['sub']]['name']?></span></div>
    <div class="main">
        <form id="form_add_goods" method="post" action="?/goods/index.html">
            <input name="cmd" type="hidden" value="add_or_edit_goods">
            <table class="table">
                <tbody>
                <tr >
                    <td width="120px">标题：</td>
                    <td><input name="goo_title" type="text" class="text" maxlength="200" value=""></td>
                </tr>
                <tr>
                    <td>图片</td>
                    <td>
                        <span id="show_pic_1"></span>
                        <img class="uploadImg" id="title_demo" style="max-width: 70px;height: auto;display: <?php echo $articleInf ? 'block':'none'?>" <?php echo $articleInf ? 'src="../'.$articleInf['art_img'].'"':''?>/>
                        <input type="file" id="title-img-up" name="title-img-up" style="display: none">
                        <input type="hidden" name="title_img" id="title_name" <?php echo $articleInf? 'value="'.$articleInf['title_img'].'"':''?>/>
                        &nbsp;&nbsp;&nbsp;推荐尺寸：700 * 460
                    </td>
                </tr>
                <tr>

                    <td>产品描述：</td>
                    <td>
                        <div class="editor">
                            <script type="text/javascript">
                                var ue = UE.getEditor('editor');
                            </script>
                            <!-- GOODUO -->
                        </div>
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
</div>

                    <label class="uploadImg blank" <?php echo $articleInf ?'style="display:none"': 'style="display:inline-block"'?>>
                        <span>插入图片</span>
                    </label>

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