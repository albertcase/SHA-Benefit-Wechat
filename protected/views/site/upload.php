<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/js/swiper.min.js"></script>

<div class="loading">
	<div class="spinner">
		<div class="bounce1"></div>
		<div class="bounce2"></div>
		<div class="bounce3"></div>
		<p>正在加载中，请耐心等待。</p>
	</div>
</div>


<div id="inside">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/inside_bg.jpg" id="uploadBg" width="100%" />
	<div class="section" id="upload">
		
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
		        <div class="imgBox opacity_8">
		            <div class="shell"></div>
		        </div>
		    </div>

			<input type="file" accept="image/jpeg" onclick="_hmt.push(['_trackEvent', 'input', '文件上传区域点击']);" name="fileInput" id="fileInput" />
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/photoFrame.png" width="100%" />
		</div>

		<a href="javascript:;" class="btn upload_btn" style="display:inline-block;">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/upload_btn.png" width="100%" />
		</a>
		<a href="javascript:;" class="btn qrUpload_btn">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/qrUpload_btn.png" width="100%" />
		</a>

		<div class="listcon listChange">
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

		<a href="javascript:;" class="btn queren_btn">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/queren_btn.jpg" width="100%" />
		</a>

	</div>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/js/public.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/js/dist/lrz.bundle.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/js/ocanvas.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/js/main.js"></script>



<script type="text/javascript">
	

	var saveimgPushData = {
			"image": "",
			"type": ""
		}

	document.getElementById("fileInput").addEventListener('change', function () {
	    $(".loading").show();
	    var that = this;
	    lrz(that.files[0], {
	    	width: "900",
	        quality: 1
	    })
	        .then(function (rst) {
	            var img        = new Image(),
	                div        = document.getElementById('imgPreview');
	            img.onload = function () {
	                imgCreat(rst.base64); 
	                $("#fileInput").hide();
	            };

	            img.src = rst.base64;

	            return rst;
	        });
	});


	function toFixed2 (num) {
	    return parseFloat(+num.toFixed(2));
	}

	$(".upload_btn").click(function(){
		_hmt.push(['_trackEvent', 'btn', '点击上传按钮']);
		
		document.getElementById("fileInput").click('change');
	})

	$(".qrUpload_btn").click(function(){
		_hmt.push(['_trackEvent', 'btn', '确认上传按钮']);

		imgCanvas.removeChild(imgPic2);
		//var photoSrc = $("#photoCanvas")[0].toDataURL("image/png", 1.0).replace("data:image/png;base64,", "");
		var photoSrc = $("#photoCanvas")[0].toDataURL({format:"png", quality: 1}).replace("data:image/png;base64,", "");
		saveimgPushData["image"] = photoSrc;

		$("#uploadBg").attr("src", baseUrl+"/vstyle/imgs/inside_bg2.jpg");
		$(this).hide();
		$(".queren_btn").css("display","inline-block");
		$(".imgBox").removeClass("opacity_8");
		$(".listChange").show();

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
	})

	

	$(".queren_btn").click(function(){
		var choseVal = $(".swiper-slide-active").attr("data-val");
		saveimgPushData["type"] = choseVal;
		//console.log(saveimgPushData);
		$(this).addClass("disabled").append("<span>正在提交...<span>");

		ajaxfun("POST", "/api/saveimg", saveimgPushData, "json", saveimgCallback);
		
	})

	function saveimgCallback(data){
		if(data.code == 1){
			window.location.href = "/site/result?id="+data.msg
		}else{
			alert(data.msg);
		}

		$(".queren_btn").removeClass("disabled").find("span").remove();
		//console.log(data);
	}



</script>