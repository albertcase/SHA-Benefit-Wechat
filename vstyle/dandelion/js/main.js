var m = {
	init: function(){
        var self = this;
        // 视频输出事件
        // $(".vposter").on("click", function(){
        // 	var vsrc = $(this).attr("data-url"),
        // 		vposterImg = $(this).attr("data-img");
        //     self.video("#vplay", vsrc, vposterImg);
        // });
  },
	video: function(a, b, c){  //视频函数
		var self = this;
    	var videoWidth = $("#vplay").css("width"), 
    		videoHeight = $("#vplay").css("height"),
            _video = document.createElement("VIDEO");

      		_video.setAttribute("width", videoWidth);
      		_video.setAttribute("height", videoHeight);
      		_video.setAttribute("controls", "controls");
      		_video.setAttribute("src", b);
      		_video.setAttribute("poster", c);
      		_video.setAttribute("webkit-playsinline", "webkit-playsinline");
      		

          $.when($(a).html(_video)).done(function() {
              _video.play();

              self.eventTester(_video, "play");
              //self.eventTester(_video, "pause");
              self.eventTester(_video, "ended");
              //self.eventTester(_video, "error");
          })
	},
	eventTester: function(m, e){  //视频事件
        var self = this;
        m.addEventListener(e, function(){  
            if(e === "play"){
                $("#vplay").css({"visibility":"visible"});
                $(".vposter").css({"visibility":"hidden"});
            }else{
                $(".vposter").css({"visibility":"visible"});
                $("#vplay").css({"visibility":"hidden"});

                if(e === "error"){
                    self.formErrorTips("视频加载出错");
                    $("#vplay").html("");
                }
            }
        });  
    },
    formErrorTips: function(alertNodeContext){  //错误提示弹层
        var alertInt;
        clearTimeout(alertInt);
        if($(".alertNode").length > 0){
            $(".alertNode").html(alertNodeContext);
        }else{
            var alertNode = document.createElement("div");
                alertNode.setAttribute("class","alertNode");
                alertNode.innerHTML = alertNodeContext;
                document.body.appendChild(alertNode);

        }
        alertInt = setTimeout(function(){
            $(".alertNode").remove();
        },3000);
    },
    txVideoFun: function(n){

        var vidArr = ["x0308hpn9ev", "l0308yjl5z7", "n0308bnv692"],
            tvp_video,
            videoWidth = parseInt($(".videoCon").css("width"), 10),
            videoHeight = parseInt($(".videoCon").css("height"), 10);

            tvp_video = new tvp.VideoInfo(); 
            tvp_video.setVid(vidArr[n]);
            player = new tvp.Player(); 
            player.create({
              width: videoWidth + 'px',
              height: videoHeight + 'px',
              video: tvp_video,
              pic: "/vstyle/dandelion/img/s"+parseInt(n+1, 10)+"/poster.jpg",
              modId: "vplay", //mod_player是刚刚在页面添加的div容器 autoplay:true
                oninited: function () {
                    //播放器在视频载入完毕触发
                },
                onplaying: function () {
                    //播放器真正开始播放视频第一帧画面时
                    $(".vposter").css({"visibility": "hidden"});
                    $("#vplay").css({"visibility": "visible"});
                },
                onpause: function () {
                    //播放器触发暂停时，目前只针对HTML5播放器有效
                },
                onresume: function () {
                    //暂停后继续播放时触发
                },
                onallended: function () {
                    //播放器播放完毕时
                    $(".vposter").css({"visibility": "visible"});
                    $("#vplay").css({"visibility": "hidden"});
                },
                onfullscreen: function (isfull) {
                    //onfullscreen(isfull) 播放器触发全屏/非全屏时，参数isfull表示当前是否是全屏
                }
            });

            $(".vposter").on("click", function(){
                player.play();
                _hmt.push(['_trackEvent', 'video', 'look' + n]);
            });

    }
}