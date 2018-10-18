<div id="inside">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/form_bg.jpg" width="100%" />
	<div class="section" id="store">

		<div class="logo logo2">
			<a href="javascript:;">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/logo2.png" width="100%" />
			</a>
		</div>


		<div class="store_con">
			<dl>
				<dd>
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/xk.png" width="100%" />
				</dd>
				<dt>
					<h2><?php echo $store['name'];?></h2>
					<p>
						<em>地址：</em>
						<span>
							<?php echo $store['address'];?>
						</span>
					</p>
					<p>
						<em>电话：</em>
						<span>
							<a class="telNumber" onclick="_hmt.push(['_trackEvent', 'link', '拨打电话号码']);" href="tel:<?php echo $store['telphone'];?>"> <i><?php echo $store['telphone'];?></i> (点击拨打电话)</a> 
						</span>
					</p>
				</dt>
			</dl>
			
		</div>




	</div>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/js/public.js"></script>
