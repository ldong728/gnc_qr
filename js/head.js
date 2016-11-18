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