<!-- 弹窗代码 -->
<div class="pup_share"></div>


<div id="inside">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/inside_bg2.jpg" width="100%" />
	<div class="section" id="result">

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

		<a href="javascript:;" onclick="_hmt.push(['_trackEvent', 'btn', '找人来补刀']);" class="btn shareBtn">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/shareBtn.jpg" width="100%" />
		</a>

		<div class="listcon">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/<?php echo $result['type']?>.png" width="100%" />
		</div>
		




	</div>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/js/public.js"></script>
<script type="text/javascript">
	var shareData = {
	        title: 'Benefit',
	        desc: '闺蜜欠“修理”，快来补刀！',
	        link: window.location.host + "/site/complete?id=<?php echo $result['id']?>",
	        imgUrl: 'http://' + window.location.host + '/vstyle/imgs/share.jpg',
	        shareCallback: function(){
	            window.location.href = "/site/qrcode";
	        }
	};


	$(".shareBtn").click(function(){
		$(".pup_share").fadeIn();
	})

	$(".pup_share").bind("touchstart", function(){
		$(".pup_share").hide();
	})

</script>