<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/css/swiper.min.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/js/swiper.min.js"></script>

<div id="inside">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/inside_bg2.jpg" width="100%" />
	<div class="section" id="list">

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
		            <div class="shell">
		            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/place.jpg" width="100%" />
		            </div>
		        </div>
		    </div>

			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/photoFrame.png" width="100%" />
		</div>

		<a href="javascript:;" class="btn queren_btn">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/queren_btn.jpg" width="100%" />
		</a>

		<div class="listcon">
			<!-- Swiper -->
		    <div class="swiper-container">
		        <div class="swiper-wrapper">
		            <div class="swiper-slide" data-val="kk">
		            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/kk.png" width="100%" />
		            </div>
		            <div class="swiper-slide" data-val="scissorhand">
		            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/scissorhand.png" width="100%" />
		            </div>
		            <div class="swiper-slide" data-val="mblame">
		            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/mblame.png" width="100%" />
		            </div>
		            <div class="swiper-slide" data-val="shrek">
		            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/shrek.png" width="100%" />
		            </div>
		            <div class="swiper-slide" data-val="spiderMan">
		            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/spiderMan.png" width="100%" />
		            </div>
		        </div>
				<!-- Add Arrows -->
		        <div class="swiper-button-next">
		        	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/arr_r.jpg" width="100%" />
		        </div>
		        <div class="swiper-button-prev">
		        	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/arr_l.jpg" width="100%" />
		        </div>
		    </div>
		</div>
		




	</div>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/js/public.js"></script>

<!-- Initialize Swiper -->
<script type="text/javascript">
	var swiper = new Swiper('.swiper-container', {
	    pagination: '.swiper-pagination',
	    nextButton: '.swiper-button-next',
	    prevButton: '.swiper-button-prev',
	    spaceBetween: 30,
	    effect : 'fade',
		fade: {
		  crossFade: true,
		},
		loop: true
	});

	$(".queren_btn").click(function(){
		var choseVal = $(".swiper-slide-active").attr("data-val");
		console.log(choseVal);
	})

</script>
