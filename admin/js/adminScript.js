$('input').attr('onkeypress',"if(event.keyCode == 13) return false;");//屏蔽回车键
function showToast(str){
    $('.toast').empty();
    $('.toast').append(str)
    $('.toast').fadeIn('fast')
    var t = setTimeout('$(".toast").fadeOut("slow")', 800);
}
function loading(){
    $('.loading').show();
}
function stopLoading(){
    $('.loading').hide();
}

//例：<div class="ipt-toggle" id="row id" data-tbl="table name"data-col="col name" data-index="index col">
$('.ipt-toggle').dblclick(function () {
    var id = $(this).attr('id');
    var value = $.trim($(this).text());

    var content = '<input type="text" class="ipt"id="ipt' + id + '"value="' + value + '"/>';
    $(this).html(content)
});
//例：<div class="ipt-area-toggle" id="row id" data-tbl="table name"data-col="col name" data-index="index col">
$('.ipt-area-toggle').dblclick(function () {
    var id = $(this).attr('id');
    var value = $.trim($(this).text());
    var content = '<textarea class="ipt"id="ipt' + id + '">'+value+'</textarea>';
    $(this).html(content)
});
$(document).on('change', '.ipt', function () {
    console.log('change');
    var input = $(this);
    var value = $(this).val();
    var id = $(this).attr('id').slice('3');
    var index = $(this).parent().data('index');
    var tbl = $(this).parent().data('tbl');
    var col = $(this).parent().data('col');
    var replace = $(this).parent().data('replace');
    if (replace) {
        index = col;
        id = replace;
    }
    var altValue={
        alteTblVal: 1,
        tbl: tbl,
        col: col,
        value: value,
        index: index,
        id: id,
        pms:pms

    };
    //$.each(altValue,function(k,v){
    //   console.log(k+': '+v);
    //});
    $.post('ajax_request.php',altValue , function (data) {
        if(data)data=eval('('+data+')');
        if (data.errcode == 0) {
            input.parent().text(value);
            input.remove();
        }else{
            //alert(data);
        }
    })
});
document.on('focusout','ipt',function(){

});