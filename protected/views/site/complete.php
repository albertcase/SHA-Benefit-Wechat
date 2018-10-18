<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/js/public.js"></script>

<div id="inside">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/inside_bg2.jpg" width="100%" />
	<div class="section" id="complete">

		<div class="logo">
			<a href="javascript:;">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/logo.png" width="100%" />
			</a>
		</div>

		<div class="slogan">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/slogan.png" width="100%" />
		</div>

	
		<div class="photoFrame">

			<div id="imgPreview">
		        <div class="imgBox">
		            <div class="shell" data-id="<?php echo $result['id']?>" data-status="<?php echo $result['status']?>" data-type="<?php echo $result['type']?>">
		            	<img src="<?php echo Yii::app()->request->baseUrl."/". $result['image']; ?>" width="100%" />
		            </div>
		        </div>
		    </div>

			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/photoFrame.png" width="100%" />
		</div>
		
		<?php if($result['uid']!=$_SESSION['weixin_info_id']) {?>
		<!-- 不是自己 -->

		<div class="budaoPup"></div>

		<script type="text/javascript">
			shareData = {
			        title: 'Benefit',
			        desc: '闺蜜欠“修理”，快来补刀！',
			        link: window.location.host + "/site/complete?id=<?php echo $result['id']?>",
			        imgUrl: 'http://' + window.location.host + '/vstyle/imgs/share.jpg',
			        shareCallback: function(){
			            console.log("分享成功");
			        }
			};
		</script>


		<a href="javascript:;" class="<?php echo $result['status']>=2 ? "budao carryout" : "budao"?>">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/budao_btn.png" width="100%" />
			<div class="hands">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/hands.png" width="100%" />
			</div>
		</a>

		<div class="budao_text">
			<em><?php echo $result['name']?></em> 邀你帮 <i>TA</i> 解决“燃眉之急”
		</div>

		<a href="/" onclick="_hmt.push(['_trackEvent', 'btn', '我也要玩']);" class="btn iwantplay_btn">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/iwantplay_btn.png" width="100%" />
		</a>
		<?php } else {?>
		<!-- 是自己 -->
		<script type="text/javascript">
			shareData = {
			        title: 'Benefit',
			        desc: '闺蜜欠“修理”，快来补刀！',
			        link: window.location.host + "/site/complete?id=<?php echo $result['id']?>",
			        imgUrl: 'http://' + window.location.host + '/vstyle/imgs/share.jpg',
			        shareCallback: function(){
			            console.log("分享成功");
			        }
			};
		</script>
		
		<a href="/" onclick="_hmt.push(['_trackEvent', 'btn', '再玩一次']);" class="btn replay_btn">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/replay_btn.jpg" width="100%" />
		</a>
		<?php }?>

		<div class="listcon">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/complete/<?php echo $result['type']?>_hands.png" id="groping" width="100%" />
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/complete/<?php echo $result['type']?>_<?php if($result['status']>2){echo 2;}else{ echo $result['status'];}?>.png" id="finallyWork" width="100%" />
		</div>
		




	</div>
</div>


<script type="text/javascript">

	var animationListener = function(){
			$("#groping").removeClass("slideA");
			//console.log('do something');
		}

	var anim = document.getElementById("groping");
	anim.addEventListener("webkitAnimationEnd", animationListener, false);

	// $(".shareBtn").click(function(){
	// 	$(".pup_share").fadeIn();
	// })

	// $(".pup_share").bind("touchstart", function(){
	// 	$(".pup_share").hide();
	// })

	var ctype,curBudaoNum,ballotPushData,imgNum;
	$(".budao").click(function(){

		$("#groping").addClass("slideA");

		if($(this).hasClass("carryout")){
			$(".budaoPup").addClass("bdPup3").fadeIn();
			_hmt.push(['_trackEvent', 'btn', '补刀按钮----结束']);
		}else{
			if($(this).hasClass("hover")) return false;	
			$(".budao").addClass("hover");
			ctype = $(".shell").attr("data-type");
			curBudaoNum = parseInt($(".shell").attr("data-status"));
			ballotPushData = {
				"id": $(".shell").attr("data-id")
			}; 

			ajaxfun("POST", "/api/ballot", ballotPushData, "json", ballotCallback);
			_hmt.push(['_trackEvent', 'btn', '补一刀按钮']);
		}
		
	})


	

	function ballotCallback(data){
		if(data.code == 1){
			curBudaoNum = curBudaoNum + 1;
			curBudaoNum > 2 ? imgNum = 2:imgNum = curBudaoNum;

			$("#finallyWork").attr({"src": baseUrl + "/vstyle/imgs/complete/"+ctype+"_"+imgNum+".png"});
			$(".shell").attr("data-status", curBudaoNum);
			
			$(".budaoPup").addClass("bdPup1").fadeIn();
			$(".hands").fadeOut().remove();
		}else if(data.code == 3){
			$(".budaoPup").addClass("bdPup2").fadeIn();
		}else if(data.code == 4){
			$(".budaoPup").addClass("bdPup3").fadeIn();
			//$(".budao").removeClass("hover");
		}else{
			$(".budao").removeClass("hover");
		}
	}

	$(".budaoPup").click(function(){
		$(this).hide();
	})

</script>
