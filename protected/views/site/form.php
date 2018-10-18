<div id="inside">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/form_bg.jpg" width="100%" />
	<div class="section" id="qrcode">

		<div class="logo logo2">
			<a href="javascript:;">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/logo2.png" width="100%" />
			</a>
		</div>


		<div class="form_con">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/form_text.png" width="70%" />
			<div class="formArea">
				<ul>
					<li>
						<span>预约城市：</span>
						<select name="city" class="select_city">
							<option>请选择</option>
						</select>
					</li>
					<li>
						<span>预约店铺：</span>
						<select name="store" class="select_store"></select>
					</li>
				</ul>
			</div>
		</div>

		<a href="javascript:;" onclick="_hmt.push(['_trackEvent', 'btn', '提交预约']);" class="btn submit_btn">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/submit_btn.png" width="100%" />
		</a>



	</div>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/js/public.js"></script>

<script type="text/javascript">
	var finishPushData = {
		"id": ""
	}

	ajaxfun("GET", "/api/storelist", "", "json", storelistCallback);

	var cityArr = [];
	var storeArr = [];
	function storelistCallback(data){

		if(data.code == 1){

			$.map(data.msg, function(v, k){

				if(cityArr.indexOf(v.city) == "-1"){
					cityArr.push(v.city);
					$(".select_city").append("<option>"+v.city+"</option>");
				}
				
			})

			$(".select_city").change(function(){
				var _curCity = $("select[name='city'] option:selected").text();
				storeFun(_curCity, data.msg);
			})

		}else{
			alert(data.msg);
		}


	}


	function storeFun(curcity, data){
		var storeOptionHtml = $.map(data, function(v, k){
			if(curcity == v.city){
				return "<option value='"+v.id+"'>"+v.name+"</option>";
			}
		}).join("");

		$(".select_store").html("<option>请选择</option>"+storeOptionHtml);
	}

	function checkForm(_this){

		var city = $("select[name='city'] option:selected").text(); 
		var store = $("select[name='store'] option:selected").text(); 

		if(city == "请选择"){
			alert("请选择预约的城市")
		}else if(store == "请选择"){
			alert("请选择预约的店铺");
		}else{
			_this.addClass("disabled").append("<span>正在提交...<span>");
			finishPushData["id"] = $("select[name='store']").val();
			//console.log(finishPushData["id"]);
			ajaxfun("POST", "/api/finish", finishPushData, "json", finishCallback);
		}

		
		

		function finishCallback(data){
			if(data.code == 1){
				//console.log(finishPushData["id"]);
				window.location.href = "/site/store?id="+finishPushData["id"];
			}else{
				alert(data.msg);
			}

			_this.removeClass("disabled").find("span").remove();
		}
	}

	$(".submit_btn").click(function(){
		checkForm($(this));
	})



</script>