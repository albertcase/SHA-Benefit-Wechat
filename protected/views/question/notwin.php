<div class="wechatpup"></div>

<div class="page bg" id="index">
    <div class="model"></div>
    <div class="con">
        <div class="frameBg">
            <img src="/vstyle/imgs/question/bg_t.png" width="100%" />
            <div class="frameBg_con">
                <img src="/vstyle/imgs/question/thanks.png" />
            </div>
            <img src="/vstyle/imgs/question/bg_b.png" width="100%" />
        </div>
    </div>
</div>

<div class="footer">
    <a href="javascript:;" class="share_btn"></a>
    <img src="/vstyle/imgs/question/footer_share.png" width="100%" />
</div>

<script type="text/javascript">
    $(".share_btn").click(function(){
        $(".wechatpup").show();
    })

    $(".wechatpup").click(function(){
        $(".wechatpup").hide();
    })

    document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
</script>

