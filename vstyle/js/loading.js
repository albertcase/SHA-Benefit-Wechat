var LoadingImg = [
    baseUrl + "/vstyle/imgs/arr_l.jpg",
    baseUrl + "/vstyle/imgs/arr_r.jpg",
    baseUrl + "/vstyle/imgs/arr.png",
    baseUrl + "/vstyle/imgs/attention_btn.png",
    baseUrl + "/vstyle/imgs/mask.png",
    baseUrl + "/vstyle/imgs/pup1.png",
    baseUrl + "/vstyle/imgs/pup2.png",
    baseUrl + "/vstyle/imgs/pup3.png",

    baseUrl + "/vstyle/imgs/attention_qrcode.png",
    baseUrl + "/vstyle/imgs/budao_btn.png",
    baseUrl + "/vstyle/imgs/budao_text.png",

    baseUrl + "/vstyle/imgs/form_bg.jpg",
    baseUrl + "/vstyle/imgs/form_text.png",
    baseUrl + "/vstyle/imgs/iknow_btn.jpg",

    baseUrl + "/vstyle/imgs/index_4s.jpg",
    baseUrl + "/vstyle/imgs/index.jpg",
    baseUrl + "/vstyle/imgs/inside_bg.jpg",
    baseUrl + "/vstyle/imgs/inside_bg2.jpg",

    baseUrl + "/vstyle/imgs/iwantplay_btn.png",
    baseUrl + "/vstyle/imgs/kk.png",
    baseUrl + "/vstyle/imgs/logo.png",
    baseUrl + "/vstyle/imgs/logo2.png",

    baseUrl + "/vstyle/imgs/mblame.png",
    baseUrl + "/vstyle/imgs/moreBtn.png",
    baseUrl + "/vstyle/imgs/p1.png",
    baseUrl + "/vstyle/imgs/p2.png",
    baseUrl + "/vstyle/imgs/p3.png",
    baseUrl + "/vstyle/imgs/p4.png",
    baseUrl + "/vstyle/imgs/p5.png",
    baseUrl + "/vstyle/imgs/photoFrame.png",

    baseUrl + "/vstyle/imgs/qrcode.png",
    baseUrl + "/vstyle/imgs/queren_btn.jpg",
    baseUrl + "/vstyle/imgs/r_con.png",
    baseUrl + "/vstyle/imgs/r_footer.png",
    baseUrl + "/vstyle/imgs/r_head.png",
    baseUrl + "/vstyle/imgs/replay_btn.jpg",
    baseUrl + "/vstyle/imgs/scissorhand.png",
    baseUrl + "/vstyle/imgs/share.jpg",

    baseUrl + "/vstyle/imgs/shareBtn.jpg",
    baseUrl + "/vstyle/imgs/sharePrompt.png",
    baseUrl + "/vstyle/imgs/shrek.png",
    baseUrl + "/vstyle/imgs/slogan.png",
    baseUrl + "/vstyle/imgs/spiderMan.png",
    baseUrl + "/vstyle/imgs/spro.png",
    baseUrl + "/vstyle/imgs/submit_btn.png",
    baseUrl + "/vstyle/imgs/upload_btn.png",

    baseUrl + "/vstyle/imgs/xk.png",
    baseUrl + "/vstyle/imgs/xl_icon.png",
    baseUrl + "/vstyle/imgs/xuxian.png",

    baseUrl + "/vstyle/imgs/complete/kk_0.png",
    baseUrl + "/vstyle/imgs/complete/kk_1.png",
    baseUrl + "/vstyle/imgs/complete/kk_2.png",

    baseUrl + "/vstyle/imgs/complete/mblame_0.png",
    baseUrl + "/vstyle/imgs/complete/mblame_1.png",
    baseUrl + "/vstyle/imgs/complete/mblame_2.png",

    baseUrl + "/vstyle/imgs/complete/scissorhand_0.png",
    baseUrl + "/vstyle/imgs/complete/scissorhand_1.png",
    baseUrl + "/vstyle/imgs/complete/scissorhand_2.png",

    baseUrl + "/vstyle/imgs/complete/shrek_0.png",
    baseUrl + "/vstyle/imgs/complete/shrek_1.png",
    baseUrl + "/vstyle/imgs/complete/shrek_2.png",

    baseUrl + "/vstyle/imgs/complete/spiderMan_0.png",
    baseUrl + "/vstyle/imgs/complete/spiderMan_1.png",
    baseUrl + "/vstyle/imgs/complete/spiderMan_2.png",

];


/* 图片加载 */
function LoadFn ( arr , fn , fn2){
        var loader = new PxLoader();
        for( var i = 0 ; i < arr.length; i ++)
        {
            loader.addImage(arr[i]);
        };
        
        loader.addProgressListener(function(e) {
                var percent = Math.round( e.completedCount / e.totalCount * 100 );
                if(fn2) fn2(percent)
        }); 
        
        
        loader.addCompletionListener( function(){
            if(fn) fn();    
        });
        loader.start(); 
}


function loading(allAmg){
    LoadFn(allAmg , function (){

        $("img").each(function(){ 
            $(this).attr("src",$(this).attr("sourcesrc"));
        })

        $(".loading").hide();

        $("#dreambox").animate({"opacity": 1});
        
    } , function (p){
        //console.log(p);
    });
}



loading(LoadingImg);

