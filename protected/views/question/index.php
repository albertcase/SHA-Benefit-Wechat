<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/js/PxLoader.js"></script>

<div class="page bg" id="index">
    <div class="model"></div>
    <div class="con">
        <div class="frameBg">
            <img src="" sourcesrc="/vstyle/imgs/question/bg_t.png" width="100%" />
            <div class="frameBg_con">
                <img src="" sourcesrc="/vstyle/imgs/question/theme.png" />
            </div>
            <img src="" sourcesrc="/vstyle/imgs/question/bg_b.png" width="100%" />
        </div>
    </div>
</div>

<div class="footer">
    <a href="list"></a>
    <img src="" sourcesrc="/vstyle/imgs/question/footer_start.png" width="100%" />
</div>



<script type="text/javascript">
    $(".loading").show();
    var LoadingImg = [
        "/vstyle/imgs/question/bg_b.png",
        "/vstyle/imgs/question/bg_c.png",
        "/vstyle/imgs/question/bg_t.png",
        "/vstyle/imgs/question/bg.jpg",
        "/vstyle/imgs/question/bg2.jpg",

        "/vstyle/imgs/question/chose_icon.png",
        "/vstyle/imgs/question/footer_lottery.png",
        "/vstyle/imgs/question/footer_next.png",
        "/vstyle/imgs/question/footer_share.png",
        "/vstyle/imgs/question/footer_start.png",

        "/vstyle/imgs/question/footer_submit.png",
        "/vstyle/imgs/question/form_title.png",
        "/vstyle/imgs/question/head.jpg",
        "/vstyle/imgs/question/model.png",
        "/vstyle/imgs/question/q_title.png",

        "/vstyle/imgs/question/success_tips.png",
        "/vstyle/imgs/question/thanks.png",
        "/vstyle/imgs/question/theme.png",
        "/vstyle/imgs/question/wechat_tips.png",
        "/vstyle/imgs/question/share.jpg",
        "/vstyle/imgs/question/q/1.png",

        "/vstyle/imgs/question/q/2.png",
        "/vstyle/imgs/question/q/3.png",
        "/vstyle/imgs/question/q/4.png",
        "/vstyle/imgs/question/q/5.png",
        "/vstyle/imgs/question/q/6.png",
        "/vstyle/imgs/question/q/7.png",
        "/vstyle/imgs/question/q/8.png",

        "/vstyle/imgs/question/q/9.png",
        "/vstyle/imgs/question/q/10.png",
        "/vstyle/imgs/question/q/11.png",
        "/vstyle/imgs/question/q/12.png",
        "/vstyle/imgs/question/q/13.png",
        "/vstyle/imgs/question/q/14.png",
        "/vstyle/imgs/question/q/15.png",

        "/vstyle/imgs/question/q/16.png",
        "/vstyle/imgs/question/q/17.png",
        "/vstyle/imgs/question/q/18.png",

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

        } , function (p){
            //console.log(p);
        });
    }



    loading(LoadingImg);

    document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
</script>