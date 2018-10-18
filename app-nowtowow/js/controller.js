$(document).ready(function(){

//    for menu
    $('.icon-menu').on('touchstart', function(){
        $(this).parent().find('.subnav').toggleClass('show');
    });

// for in kol list
    var inHtml = '';
    for(var i in inJson){
        inHtml = inHtml + '<li class="item">'+
            '<div class="pic">'+
            '<a class="showpop" href="'+inJson[i].link+'">'+
            '<img src="'+inJson[i].imgsrc+'" alt=""/>'+
                '</a>'+
            '<span class="icon-ing">直播中</span>'+
            '</div>'+
            '<div class="name">'+inJson[i].name+
            '</div>'+
            '<div class="link showpop">'+
            '<a class="showpop" href="'+inJson[i].link+'">'+
            '点击这里'+
            '</a>'+
            '</div>'+
            '</li>';
    }
    $('.in-lists').html(inHtml);

    // for super kol list
    var mzHtml = '';
    for(var i in mzJson){
        mzHtml = mzHtml + '<li class="item">'+
            '<div class="pic">'+
            '<a class="showpop" href="'+mzJson[i].link+'">'+
            '<img src="'+mzJson[i].imgsrc+'" alt=""/>'+
                '</a>'+
            '<span class="icon-ing">直播中</span>'+
            '</div>'+
            '<div class="name">'+mzJson[i].name+
            '</div>'+
            '<div class="link showpop">'+
            '<a class="showpop" href="'+mzJson[i].link+'">'+
            '点击这里'+
            '</a>'+
            '</div>'+
            '</li>';
    };
    $('.super-lists').html(mzHtml);





});