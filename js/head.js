var gnc={
    showToast:function(str){
        $('.toast').empty();
        $('.toast').append(str)
        $('.toast').fadeIn('fast')
        var t = setTimeout('$(".toast").fadeOut("slow")', 800);
        return t;
    },
    loading:function(){
        $('.loading').show();
    },
    stopLoading:function(){
        $('.loading').hide();
    },
    objLengh:function(obj){
        var count=0;
        $.each(obj,function(k,v){
            count++;
        });
        return count;
    }
}
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
function objLengh(obj){
    var count=0;
    $.each(obj,function(k,v){
        count++;
    });
    return count;
}