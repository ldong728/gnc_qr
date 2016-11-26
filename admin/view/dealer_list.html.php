<?php
$dealerList=$GLOBALS['dealerList'];
$page=$GLOBALS['page'];
$num=$GLOBALS['num'];
$getStr=$GLOBALS['getStr']
?>

<section>
    <h2>
        <strong>经销商列表</strong>
    </h2>
    <table class="table">
        <tr>
            <th>用户名</th>
            <th>用户手机</th>
            <th>用户微信</th>
            <th>用户密码</th>
            <th>操作</th>
        </tr>
        <?php foreach($dealerList as $row):?>
            <tr>
                <td class="ipt-toggle" id="<?php $row['use_id']?>" data-tbl="gd_users"data-col="use_username" data-index="use_id"><?php echo $row['use_username']?></td>
                <td class="ipt-toggle" id="<?php $row['use_id']?>" data-tbl="gd_users"data-col="use_phone" data-index="use_id"><?php echo $row['use_phone']?></td>
                <td class="ipt-toggle" id="<?php $row['use_id']?>" data-tbl="gd_users"data-col="use_wx_id" data-index="use_id"><?php echo $row['use_wx_id']?></td>
                <td>**********</td>
                <td>

                </td>
            </tr>
        <?php endforeach?>

    </table>
    <aside class="paging"><?php if($page>0):?><a href="index.php?<?php echo $getStr?>&page=<?php echo $page-1?>">上一页</a><?php endif ?><a href="index.php?<?php echo $getStr?>&page=<?php echo $page+1?>">下一页</a></aside>




    <div class="space"></div>
</section>

<script>
    $('.singleReflash').click(function(){
        var media_id=$(this).attr('id').slice(3);
        $.post('ajax_request.php',{reflashSingleNews:1,media_id:media_id},function(data){
            location.reload(true);
        });
    });
    $('#cateFilter').change(function(){
        var id=$(this).val();
        if(id<0){
            window.location.href='index.php?news=1&newslist=1';
        }else{
            window.location.href='index.php?news=1&newslist=1&category='+id;
        }

    });
    $('.sendNotice').click(function(){
        var id=$(this).attr('id').slice(3);
        $.post('ajax_request.php',{sendNotice:1,newsId:id},function(data){
            var id=data;
            window.location.href='index.php?sendNotice='+id+'&notice_id='+id

        })
    });
    $('.reflash').click(function(){
        alert('reflash');
        $.post('ajax_request.php',{reflashNews:1},function(data){
            if(data=='ok'){
                location.reload(true);
            }

        })
    });
    $('.changeCategory').change(function(){
        var news_id=$(this).attr('id').slice(3);
        var category=$(this).val();
        $.post('ajax_request.php',{changeCategory:1,newsId:news_id,category:category},function(data){
            if(data=='ok')showToast('设置完成')
        });
    });
    $('.delete').click(function(){
        var media_id=$(this).attr('id');
        var source=$(this).data('source');
        if(confirm('确定要删除此条图文信息吗？')){
            $.post('ajax_request.php',{deleteNews:1,media_id:media_id,source:source},function(data){
                location.reload(true);
            })
        }
        alert(source);
    });
    $('.addToTitle').change(function(){
        var v =$(this).prop('checked');
        var newsid=$(this).val();
        $.post('ajax_request.php',{setTitle:1,newsid:newsid,stu:v},function(data){
            if(data=='ok'){
                if(v){
                    showToast('已设置');
                }else{
                    showToast('已取消');
                }
            }
        });

    });

</script>