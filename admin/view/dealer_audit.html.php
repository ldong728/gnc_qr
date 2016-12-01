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
            <th>上级经销商</th>
            <th>用户名</th>
            <th>用户手机</th>
            <th>用户微信</th>
            <th>用户密码</th>
            <th>操作</th>
        </tr>
        <?php foreach($dealerList as $row):?>
            <tr><td><?php echo $row['s_name']?></td>
                <td class="ipt-toggle" id="<?php echo $row['use_id']?>" data-tbl="gd_users"data-col="use_username" data-index="use_id"><?php echo $row['use_username']?></td>
                <td class="ipt-toggle" id="<?php echo $row['use_id']?>" data-tbl="gd_users"data-col="use_phone" data-index="use_id"><?php echo $row['use_phone']?></td>
                <td class="ipt-toggle" id="<?php echo $row['use_id']?>" data-tbl="gd_users"data-col="use_wx_id" data-index="use_id"><?php echo $row['use_wx_id']?></td>
                <td>**********</td>
                <td>
                    <a class="inner_btn pass" id="del<?php echo $row['use_id']?>">通过</a>
                    <a class="inner_btn delete" id="del<?php echo $row['use_id']?>">删除</a>
                </td>
            </tr>
        <?php endforeach?>

    </table>
    <aside class="paging"><?php if($page>0):?><a href="index.php?<?php echo $getStr?>&page=<?php echo $page-1?>">上一页</a><?php endif ?><a href="index.php?<?php echo $getStr?>&page=<?php echo $page+1?>">下一页</a></aside>




    <div class="space"></div>
</section>

<script>
    $('.pass').click(function(){

        var id=this.id.slice(3);
        var data={pms:pms,method:'audit',id:id};
        $.post('ajax_request.php',data,function(re){
           var value=eval('('+re+')');
            if(value.errcode==0){
                showToast('已通过');
            }else{
                showToast(value.errmsg);
            }
        });
    });
    $('.delete').click(function(){
        var id=this.id.slice(3);
        var data={pms:pms,method:'delete_audit',id:id};
        $.post('ajax_request.php',data,function(re){
            var value=eval('('+re+')');
            if(value.errcode==0){
                showToast('已删除');
            }else{
                showToast(value.errmsg);
            }
        });

    })

</script>