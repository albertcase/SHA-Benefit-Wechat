$(document).ready(function(){

//    for menu
    $('.icon-menu').on('touchstart', function(){
        $(this).parent().find('.subnav').toggleClass('show');
    });

// for in kol list
    var inHtml = '';
    for(var i in superJson){

        inHtml = inHtml + ((superJson[i].link=='#')?'':'<li class="item '+(superJson[i].class?superJson[i].class:'')+'">'+
        '<div class="pic">'+
        '<a href="'+superJson[i].link+'">'+
        '<img src="'+superJson[i].imgsrc+'" alt=""/>'+
        '</a>'+
        '<span class="icon-ing">直播中</span>'+
        '</div>'+
        '<div class="name">'+superJson[i].name+
        '</div>'+
        '<div class="link">'+
        '<a href="'+superJson[i].link+'">'+
        '点击这里'+
        '</a>'+
        '</div>'+
        '</li>');
    }
    $('.super-lists-100').html(inHtml);





});