<?php

class SiteController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */

	public function actionIndex()
	{
		if(!isset($_SESSION['weixin_info_id'])){
			Header("Location:/weixin/oauth?callback=/");
			exit;
		}
		$this->render('index');
	}


	/* sha-benefit-brow */

	public function actionUpload()
	{
		$this->render('upload');
	}

	public function actionChose()
	{
		$this->render('chose');
	}

	public function actionComplete($id)
	{
		if(!isset($_SESSION['weixin_info_id'])){
			Header("Location:/weixin/oauth?callback=".urlencode("/site/complete?id=".intval($id)));
			exit;
		}
		$sql = "select a.*,b.nickname as name from same_image a left join same_weixin_info b on a.uid=b.id where a.id = ".intval($id);
		$result = Yii::app()->db->createCommand($sql)->queryRow();
		$this->render('complete', array('result' => $result));
	}

	public function actionForm()
	{
		if(!isset($_SESSION['weixin_info_id'])){
			Header("Location:/weixin/oauth?callback=".urlencode("/site/form"));
			exit;
		}
		$this->render('form');
	}

	public function actionList()
	{
		$this->render('list');
	}

	public function actionQrcode()
	{
		$this->render('qrcode');
	}

	public function actionResult($id)
	{
		if(!isset($_SESSION['weixin_info_id'])){
			Header("Location:/weixin/oauth?callback=".urlencode("/site/result?id=".intval($id)));
			exit;
		}
		$sql = "select a.*,b.nickname as name from same_image a left join same_weixin_info b on a.uid=b.id where a.id = ".intval($id);
		$result = Yii::app()->db->createCommand($sql)->queryRow();
		$this->render('result', array('result' => $result));
	}

	public function actionTest()
	{
		$this->render('test');
	}

	public function actionStore($id)   //actionStore($id)
	{
		$sql = "select * from same_store where id = ".intval($id);
		$store = Yii::app()->db->createCommand($sql)->queryRow();
		$this->render('store', array('store' => $store));
		//$this->render('store');
	}




	public function actionSpring()
	{
		$this->render('spring');
	}

	public function actionProduct(){
		$this->render('product');
	}

	public function actionFounder(){
		$this->render('founder');
	}

	public function actionHistory(){
		$this->render('history');
	}

	public function actionScan()
	{
		$this->renderPartial('scan');
	}

	// public function actionStore($id)
	// {
	// 	$sql = "select * from same_store where id = ".intval($id);
	// 	$store = Yii::app()->db->createCommand($sql)->queryRow();
	// 	$this->render('store', array('store' => $store));
	// }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}



	/* dandelion */
	public function actionDandelion($page = 'index'){
		$this->layout = '//layouts/dangelion';
		$this->render('dandelion',  array('page' => $page));
	}


}