function gotoPin(i) {
	var $pin = document.getElementsByClassName('pin');
	Common.addClass($pin[i],'current');
}
;(function(){
	var ua = navigator.userAgent.toLowerCase();
	var Common = {
		queryString:function(){

			var query_string = {};
			var query = window.location.search.substring(1);
			var vars = query.split("&");
			for (var i=0;i<vars.length;i++) {
				var pair = vars[i].split("=");
				// If first entry with this name
				if (typeof query_string[pair[0]] === "undefined") {
					query_string[pair[0]] = decodeURIComponent(pair[1]);
					// If second entry with this name
				} else if (typeof query_string[pair[0]] === "string") {
					var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
					query_string[pair[0]] = arr;
					// If third or later entry with this name
				} else {
					query_string[pair[0]].push(decodeURIComponent(pair[1]));
				}
			}
			return query_string;

		},
		msgBox:function(msg,long){
			if(long){
				$('body').append('<div class="ajaxpop msgbox minwidthbox"><div class="loading">'+msg+'</div></div>');
			}else{
				$('body').append('<div class="ajaxpop msgbox"><div class="loading"><div class="icon-loading"></div>'+msg+'</div></div>');
			}
		},
		errorMsg : {
			add:function(ele,msg){
				if(!ele.parent().parent().find('.error').length){
					ele.parent().parent().append('<div class="error">'+msg+'</div>');
				}else{
					ele.parent().parent().find('.error').html(msg);
				}

			},
			remove:function(ele){
				if(ele.parent().parent().find('.error').length){
					ele.parent().parent().find('.error').remove();
				}
			}
		},
		alertBox:{
			add:function(msg){
				$('body').append('<div class="alertpop msgbox"><div class="inner"><div class="msg">'+msg+'</div><div class="btn-alert-ok">关闭</div></div></div>');
			},
			remove:function(){
				$('.alertpop').remove();
			}
		},
		popupBox:{
			add:function(msg){
				$('body').append('<div class="msgbox popup"><div class="overlay"></div><div class="inner"><div class="msg">'+msg+'</div><div class="btn-close">关闭</div></div></div>');
			},
			remove:function(){
				$('.popup').remove();
			}
		},
		prizeBox:function(answer){
			var self = this;
			if(!$('.msgbox').length){
				if(answer == 'yes'){
					var yesHtml = '<div class="prizebox"><div class="line line-1"></div>' +
						'<h3>恭喜你获得了<br>防麻瓜眉笔试用装！</h3>'+
						'<p class="des">麻瓜画眉必备,勾勒五角型眉笔</p>'+
						'<div class="line line-2"></div>'+
						'<div class="pen"><img src="/app-nowtowow/images/meibi.png"></div>'+
						'<div class="btn btn-prize"><a href="form.html">填写申领信息</a></div>'+
						'<p class="tips">*防麻瓜眉笔试用装会尽快到你身边哦！</p></div>';
					self.popupBox.add(yesHtml);

				}else{
					var noHtml = '<div class="prizebox"><div class="line line-1"></div>' +
						'<p class="des">很遗憾</p>'+
						'<h3>没有申领到防麻瓜眉笔哦...</h3>'+
						'<div class="line line-2"></div>'+
						'<div class="pen"><img src="/app-nowtowow/images/meibi.png"></div>'+
						'<p class="tips">*查看更多适合自己的眉妆产品吧</p>' +
						'<div class="btn btn-prize"><a href="http://www.benefitcosmetics.com/cn/zh-hans/brows" target="_blank">去官网</a></div>'+
						'</div>';
					self.popupBox.add(noHtml);
				}
			}

		},
		goInfoPage:function(){
			window.location.href = 'form.html';
		},


	};

	this.Common = Common;

}).call(this);

$(document).ready(function(){
	var enable = true;
	$('.kol-lists').on('touchstart','.showpop',function(e){
		console.log($(this).attr('href'));
		if($(this).attr('href')=='#'){
			e.preventDefault();
			if(!enable) return;
			enable = false;
			var popHtml = '<div class="waitppop">' +
				'<div class="line line-1"></div>'+
				'<h3>美妆博主还没开始直播哦，<span class="wt">请耐心等待哦！</span></h3>'+
				'<div class="line line-2"></div>'+
				'</div>';
			Common.alertBox.add(popHtml);
			enable = true;
		}


	});
	$(document).on('touchstart', '.btn-alert-ok',function(e){
		$(this).parent().parent().remove();

	});
	$(document).on('touchstart','.btn-close' ,function(){
		$(this).parent().parent().remove();
	});
});