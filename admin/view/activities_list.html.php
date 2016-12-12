<?php
global $page,$num,$list,$count,$getStr;
?>

<div class="main">
    <table class="table sheet">
        <tbody><tr class="h">
            <td>图片</td>
            <td>名称</td>
            <td>显示</td>
            <td>优先级</td>
            <td width="150px">操作</td>
        </tr>
        <?php foreach($list as $row):?>
            <tr>
                <td><img src="../<?php echo $row['art_img']?>" style="width: 90px"> </td>
                <td class="ipt-toggle" id="<?php echo $row['art_id']?>" data-tbl="gd_article"data-col="art_title" data-index="art_id"><?php echo $row['art_title']?></td>
                <td><input class="show_switch" id="show<?php echo $row['art_id']?>" type="checkbox" <?php echo $row['art_show']? 'checked':''?>></td>
                <td class="ipt-toggle" id="<?php echo $row['art_id']?>" data-tbl="gd_article"data-col="art_index" data-index="art_id"><?php echo $row['art_index']?></td>
                <td>
                    <a href="controller.php?<?php echo $getStr?>&get_editor=<?php echo $row['art_id']?>&rediract=1">[修改]</a>
                    <a class="delete" id="dele<?php echo $row['art_id']?>">[删除]</a>
                </td>
            </tr>
        <?php endforeach ?>

        <tr>
            <td colspan="5">
                <div class="page_link">
                    <div class="in">
                        <span>共<?php echo $page+1?>页</span>
                        <span>第<?php echo number_format($count/$num,0)+1?>页</span>
                        <input type="hidden" name="url" value="?/service/mod-user_sheet/page-1/index.html">
                        <input class="text" type="number" style="width:30px" name="page" id="page" value="1">
                        <input class="button" type="button" id="jump" value="跳转">
                    </div>
                </div>
                <!-- GOODUO -->
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <div class="page_link">
                    <input type="button" id="add_photo" value="添加">
                </div>
                <!-- GOODUO -->
            </td>
        </tr>
        </tbody></table>
</div>
<script>
    var url='?'+'<?php echo $getStr?>';
    $('.show_switch').change(function(){
        var id=this.id.slice(4);
        var show=$(this).prop('checked')?1:0;
        altTable('gd_article','art_show',show,'art_id',id,function(){
        });
    })
    $('#jump').click(function(){
        var page= $('#page').val()-1;
        if(page>-1){
            location.href=url+'&page='+page;
        }else{
            alert('页数错误')
        }
    });
    $('#add_photo').click(function(){
        location.href='controller.php'+url+'&get_editor=0&rediract=1';
    });
    $('.delete').click(function(){

        var id=this.id.slice(4);
        deleteRecord('gd_article',{art_id:id},function(){
            location.reload(true);
        })
    });


</script>