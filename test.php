<?php 
if (strstr("/upload/img/20151231/170458-115.jpg", "http")) {
	//$data[] = array('title'=>$rs[$i]['title'],'description'=>$rs[$i]['description'],'picUrl'=>$rs[$i]['picUrl'],'url'=>$rs[$i]['url']); 
	echo 1;
} else {
	echo 2;
	//$data[] = array('title'=>$rs[$i]['title'],'description'=>$rs[$i]['description'],'picUrl'=>Yii::app()->request->hostInfo.'/'.Yii::app()->request->baseUrl.'/'.$rs[$i]['picUrl'],'url'=>$rs[$i]['url']); 
}
?>
