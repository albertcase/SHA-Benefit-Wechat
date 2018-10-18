<?php

class Weixin{

	private $_TOKEN = 'benefit';
	private $_appid = 'wx8eda6064464a3a06';
	private $_secret = '814c07bad66c8764ae40582ce36441dd';
	private $_eventKey = array('A1','B1','C1','C2','B2','B4','A2');
	private $_db = null;
	private $_fromUsername = null;
	private $_toUsername = null;

	public function __construct()
	{
		if( $this->_db===null)
			$this->_db = Yii::app()->db;
		
		
	}

	public function valid($echoStr)
    {
       if($this->checkSignature()){
        	return $echoStr;
        	
        }
    }

    public function responseMsg($postStr)
    {
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $this->_fromUsername=$fromUsername = $postObj->FromUserName;
                $this->_toUsername=$toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $msgType = $postObj->MsgType;
                $time = time();
				if($msgType=='text'){
					//return $this->sendService($fromUsername, $toUsername);
                	$this->systemLog($postStr,$fromUsername,$msgType);
                	$sql = "SELECT * FROM same_wmenu_event WHERE keyword=:keyword ORDER BY id DESC";
                	$command = $this->_db->createCommand($sql);
                	$command->bindParam(':keyword',$keyword,PDO::PARAM_STR);
                	$rs = $command->select()->queryAll();
                	if(!$rs){		    	
			        	$sql="SELECT * FROM `same_wmenu_event` WHERE instr( :keyword, keyword ) >0 and mohu=1";
                		$command = $this->_db->createCommand($sql);
                		$command->bindParam(':keyword',$keyword,PDO::PARAM_STR);
                		$rsLike=$command->select()->queryAll();
                		if($rsLike){
                			$rs=$rsLike;
                		}else{
                			return $this->sendService($fromUsername, $toUsername);
                		}
                	}
                	if(in_array($rs[0]['content'], $this->_eventKey)){
                		$sql = "SELECT B.* FROM `same_wmenu` A left join same_wmenu_event B ON A.id=B.mid WHERE A.`eventkey`='".$rs[0]['content']."' ORDER BY id DESC";
						$rs = $this->_db->createCommand($sql)->select()->queryAll();
						if($rs[0]['msgtype']=='text'){
	                		return $this->sendMsgForText($fromUsername, $toUsername, $time, "text", $rs[0]['content']);
	                	}else if($rs[0]['msgtype']=='news'){
	                		$data = array();

	                		for($i=0;$i<count($rs);$i++){
	                			if($rs[$i]['msgtype']!='news'){
	                				continue;
	                			}
	                			if (strstr($rs[$i]['picUrl'], "http")) {
	                				$data[] = array('title'=>$rs[$i]['title'],'description'=>$rs[$i]['description'],'picUrl'=>$rs[$i]['picUrl'],'url'=>$rs[$i]['url']); 
	                			} else {
	                				$data[] = array('title'=>$rs[$i]['title'],'description'=>$rs[$i]['description'],'picUrl'=>Yii::app()->request->hostInfo.'/'.Yii::app()->request->baseUrl.'/'.$rs[$i]['picUrl'],'url'=>$rs[$i]['url']); 
	                			}
	                		}
	                		return $this->sendMsgForNews($fromUsername, $toUsername, $time, $data);
	                	}else if($rs[0]['msgtype']=='pic'){
                			return $this->sendMsgForImage($fromUsername, $toUsername, $time, "image", $rs[0]['content']);
                		}else{
	                		return $this->sendService($fromUsername, $toUsername);
	                	}
                	}
                	if($rs[0]['msgtype']=='text'){
                		$rs[0]['content'] = str_replace("{openid}", $fromUsername, $rs[0]['content']);
                		return $this->sendMsgForText($fromUsername, $toUsername, $time, "text", $rs[0]['content']);
                	}else if($rs[0]['msgtype']=='news'){
                		$data = array();

                		for($i=0;$i<count($rs);$i++){
                			if($rs[$i]['msgtype']!='news'){
                				continue;
                			}
                			if (strstr($rs[$i]['picUrl'], "http")) {
	                				$data[] = array('title'=>$rs[$i]['title'],'description'=>$rs[$i]['description'],'picUrl'=>$rs[$i]['picUrl'],'url'=>$rs[$i]['url']); 
	                			} else {
	                				$data[] = array('title'=>$rs[$i]['title'],'description'=>$rs[$i]['description'],'picUrl'=>Yii::app()->request->hostInfo.'/'.Yii::app()->request->baseUrl.'/'.$rs[$i]['picUrl'],'url'=>$rs[$i]['url']); 
	                			}
                			
                		}
                		return $this->sendMsgForNews($fromUsername, $toUsername, $time, $data);
                	}else if($rs[0]['msgtype']=='pic'){
                		return $this->sendMsgForImage($fromUsername, $toUsername, $time, "image", $rs[0]['content']);
                	}
                	
				}else if($msgType=='event'){
					$event = strtolower($postObj->Event);
					$eventKey = $postObj->EventKey;
					if($event=='click'){
						$sql = "SELECT B.* FROM `same_wmenu` A left join same_wmenu_event B ON A.id=B.mid WHERE A.`eventkey`='{$eventKey}' ORDER BY id";
						$rs = $this->_db->createCommand($sql)->select()->queryAll();
						$this->systemLog($postStr,$fromUsername,$msgType,$event,$eventKey);				 	
	                	if($rs[0]['msgtype']=='text'){
	                		return $this->sendMsgForText($fromUsername, $toUsername, $time, "text", $rs[0]['content']);
	                	}else if($rs[0]['msgtype']=='news'){
	                		$data = array();

	                		for($i=0;$i<count($rs);$i++){
	                			if($rs[$i]['msgtype']!='news'){
	                				continue;
	                			}
	                			
	                			if (strstr($rs[$i]['picUrl'], "http")) {
	                				$data[] = array('title'=>$rs[$i]['title'],'description'=>$rs[$i]['description'],'picUrl'=>$rs[$i]['picUrl'],'url'=>$rs[$i]['url']); 
	                			} else {
	                				$data[] = array('title'=>$rs[$i]['title'],'description'=>$rs[$i]['description'],'picUrl'=>Yii::app()->request->hostInfo.'/'.Yii::app()->request->baseUrl.'/'.$rs[$i]['picUrl'],'url'=>$rs[$i]['url']); 
	                			}
	                		}
	                		return $this->sendMsgForNews($fromUsername, $toUsername, $time, $data);
	                	}else if($rs[0]['msgtype']=='pic'){
                			return $this->sendMsgForImage($fromUsername, $toUsername, $time, "image", $rs[0]['content']);
                		}
					}else if($event=='subscribe'){
						if($eventKey){
							$ticket=$postObj->Ticket;
						}else{
							$ticket="";
						}
						$this->sceneLog($fromUsername,1,$ticket);
						$this->systemLog($postStr,$fromUsername,'news',$event,$eventKey);
						return $this->sendMsgForSubscribe($fromUsername, $toUsername, $time, "text");
					}else if($event=='view'){
						$this->systemLog($postStr,$fromUsername,$msgType,$event,$eventKey);
						return;
					}else if($event=='location'){
						$this->systemLog($postStr,$fromUsername,$msgType,$event);
						return;
					}else if($event=='scan'){
						$ticket=$postObj->Ticket;
						$this->sceneLog($fromUsername,2,$ticket);
						$this->systemLog($postStr,$fromUsername,$msgType,$event,$eventKey);
						return;
					}
				}else if($msgType=='location'){
					$this->systemLog($postStr,$fromUsername,$msgType);
					//LBS
					$x = $postObj->Location_X;
					$y = $postObj->Location_Y;

					$baidu = file_get_contents("http://api.map.baidu.com/geoconv/v1/?coords={$y},{$x}&from=3&to=5&ak=Z5FOXZbjH3AEIukiiRTtD7Xy");
					$baidu = json_decode($baidu, true);
					$lat = $baidu['result'][0]['x'];
					$lng = $baidu['result'][0]['y'];
					$squares = $this->returnSquarePoint($lng,$lat,1000);
					$latbig = $squares['right-bottom']['lat'] > $squares['left-top']['lat'] ? $squares['right-bottom']['lat'] : $squares['left-top']['lat'];
					$latsmall = $squares['right-bottom']['lat'] > $squares['left-top']['lat'] ? $squares['left-top']['lat'] : $squares['right-bottom']['lat'];
					$lngbig = $squares['left-top']['lng'] > $squares['right-bottom']['lng'] ? $squares['left-top']['lng'] : $squares['right-bottom']['lng'];
					$lngsmall = $squares['left-top']['lng'] > $squares['right-bottom']['lng'] ? $squares['right-bottom']['lng'] : $squares['left-top']['lng'];
					$info_sql = "select * from `same_store` where lat<>0 and (lat between {$latsmall} and {$latbig}) and (lng between {$lngsmall} and {$lngbig}) limit 10";
					$rs = Yii::app()->db->createCommand($info_sql)->queryAll();
					if(!$rs){
						return $this->sendMsgForText($fromUsername, $toUsername, $time, "text", '很抱歉，您的附近没有门店');
					}
					$datas = array();
					$data = array();
            		for($i=0;$i<count($rs);$i++){
            			$meter = $this->getDistance($lat,$lng,$rs[$i]['lat'],$rs[$i]['lng']);
            			$meters = "(距离约" . $meter ."米)";
            			$datas[$meter] = array('title'=>$rs[$i]['name'].$meters,'description'=>$rs[$i]['name'],'picUrl'=>Yii::app()->request->hostInfo.$rs[$i]['picUrl'],'url'=>Yii::app()->request->hostInfo.'/site/store?id='.$rs[$i]['id']); 
            			//$datas[$meter] = array('title'=>$rs[$i]['name'].$meters,'description'=>$rs[$i]['name'],'picUrl'=>Yii::app()->request->hostInfo.'/'.Yii::app()->request->baseUrl.'/'.$rs[$i]['picUrl'],'url'=>Yii::app()->request->hostInfo.'/site/store?id='.$rs[$i]['id']); 
            		}
					ksort($datas);
					$i=0;
					foreach($datas as $value){
						$data[$i] = $value;
						$i++;
					}
            		return $this->sendMsgForNews($fromUsername, $toUsername, $time, $data);
				}else if($msgType=='image'){
					$this->systemLog($postStr,$fromUsername,$msgType);
					return;
				}else if($msgType=='voice'){
					$this->systemLog($postStr,$fromUsername,$msgType);
					return;
				}else if($msgType=='video'){
					$this->systemLog($postStr,$fromUsername,$msgType);
					return;
				}else if($msgType=='link'){
					$this->systemLog($postStr,$fromUsername,$msgType);
					return;
				}


				

        }else {
        	return "";
        	exit;
        }
    }
    
    private function sceneLog($openid,$type,$ticket)
    {
    	try{
	    	$sql = "INSERT INTO scenelog SET openid=:openid,type=:type,ticket=:ticket,timeint=:timeint";
			$command=$this->_db->createCommand($sql);
			$command->bindParam(":openid",$openid,PDO::PARAM_STR);
			$command->bindParam(":type",$type,PDO::PARAM_STR);
			$command->bindParam(":ticket",$ticket,PDO::PARAM_STR);
			$command->bindParam(":timeint",time(),PDO::PARAM_STR);
			$command->execute();
		}catch(Exception $e){
			print_r($e);
			return;
		}

    }
    private function systemLog($content,$openid,$msgtype,$event=null,$eventkey=null)
    {
    	try{
	    	$sql = "INSERT INTO same_getlog SET content=:content,openid=:openid,msgtype=:msgtype,event=:event,eventkey=:eventkey,timeint=:timeint";
			$command=$this->_db->createCommand($sql);
			$command->bindParam(":content",$content,PDO::PARAM_STR);
			$command->bindParam(":openid",$openid,PDO::PARAM_STR);
			$command->bindParam(":msgtype",$msgtype,PDO::PARAM_STR);
			$command->bindParam(":event",$event,PDO::PARAM_STR);
			$command->bindParam(":eventkey",$eventkey,PDO::PARAM_STR);
			$command->bindParam(":timeint",time(),PDO::PARAM_STR);
			$command->execute();
		}catch(Exception $e){
			print_r($e);
			return;
		}

    }

    private function sendMsgForText($fromUsername, $toUsername, $time, $msgType, $contentStr)
    {
    	$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";
	    return sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
	}

	private function sendMsgForImage($fromUsername, $toUsername, $time, $msgType, $contentStr)
    {
    	$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Image>
						<MediaId><![CDATA[%s]]></MediaId>
						</Image>
						</xml>";
	    return sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
	}

	private function sendMsgForNews($fromUsername, $toUsername, $time, $data)
    {

    	$xmlTpl = '<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<ArticleCount>%s</ArticleCount>
					<Articles>';
		try{

			$xml = sprintf($xmlTpl, $fromUsername, $toUsername, $time, 'news', count($data));
		}catch(Exception $e){
			print_r($e);
		}
		
		for($i=0;$i<count($data);$i++){
			$xmlxmlTpl1 = '<item>
					<Title><![CDATA[%s]]></Title> 
					<Description><![CDATA[%s]]></Description>
					<PicUrl><![CDATA[%s]]></PicUrl>
					<Url><![CDATA[%s]]></Url>
					</item>';
			$xml .= sprintf($xmlxmlTpl1, $data[$i]["title"], $data[$i]["description"], $data[$i]["picUrl"], $data[$i]["url"]);
		}

		$xml .= '</Articles></xml>';
					
		return $xml;	
    }
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = $this->_TOKEN;;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

	public function getAccessToken()
	{

		$time=file_get_contents("upload/access_token_time.txt");
		$access_token=file_get_contents("upload/access_token.txt");
		if (time() >= $time){
			$rs = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->_appid.'&secret='.$this->_secret);
			$rs = json_decode($rs,true);
			if(isset($rs['access_token'])){
				$time = time() + $rs['expires_in'];
				$access_token = $rs['access_token'];		
				$fp = fopen("upload/access_token_time.txt", "w");
				fwrite($fp, $time);
				fclose($fp);
				$fp = fopen("upload/access_token.txt", "w");
				fwrite($fp, $access_token);
				fclose($fp);
				return $rs['access_token'];
			}else{
				throw new Exception($rs['errcode']);
			}
		}
		return $access_token;
		
	}

	public function getpublictoken()
	{
		$array=array();
		$array['app_id'] = $this->_appid;
		$time=file_get_contents("upload/access_token_time.txt");
		$access_token=file_get_contents("upload/access_token.txt");
		if (time() >= $time){
			$rs = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->_appid.'&secret='.$this->_secret);
			$rs = json_decode($rs,true);
			if(isset($rs['access_token'])){
				$time = time() + $rs['expires_in'];
				$access_token = $rs['access_token'];		
				$fp = fopen("upload/access_token_time.txt", "w");
				fwrite($fp, $time);
				fclose($fp);
				$fp = fopen("upload/access_token.txt", "w");
				fwrite($fp, $access_token);
				fclose($fp);
				$array['expires_in'] = $rs['expires_in'];
				$array['access_token'] = $rs['access_token'];		
			}else{
				throw new Exception($rs['errcode']);
			}
		} else {
			$array['expires_in'] = $time-time();
			$array['access_token'] = $access_token;	
		}
		return json_encode($array);
	}

	public function getpublicticket()
	{
		$array=array();
		$array['app_id'] = $this->_appid;
		$time=file_get_contents("upload/js_ticket_time.txt");
		$access_token=file_get_contents("upload/js_ticket.txt");
		if (time() >= $time){
			$access_token = $this->getAccessToken();
			$ticketfile = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi");
			$ticketfile = json_decode($ticketfile, true);
			$ticket = $ticketfile['ticket'];
			$time = time() + $ticketfile['expires_in'];
			$fp = fopen("upload/js_ticket_time.txt", "w");
			fwrite($fp, $time);
			fclose($fp);
			$fp = fopen("upload/js_ticket.txt", "w");
			fwrite($fp,$ticket);
			fclose($fp);
			$array['expires_in'] = $ticketfile['expires_in'];
			$array['js_ticket'] = $ticketfile['ticket'];		
		} else {
			$array['expires_in'] = $time-time();
			$array['js_ticket'] = $access_token;	
		}
		return json_encode($array);
	}

	public function getJsSDK($url)
	{

		$time=file_get_contents("upload/js_ticket_time.txt");
		$ticket=file_get_contents("upload/js_ticket.txt");
		if (time() >= $time){
			$access_token = $this->getAccessToken();
			$ticketfile = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi");
			$ticketfile = json_decode($ticketfile, true);
			$ticket = $ticketfile['ticket'];
			$time = time() + $ticketfile['expires_in'];
			$fp = fopen("upload/js_ticket_time.txt", "w");
			fwrite($fp, $time);
			fclose($fp);
			$fp = fopen("upload/js_ticket.txt", "w");
			fwrite($fp,$ticket);
			fclose($fp);
		}
		$str = '1234567890abcdefghijklmnopqrstuvwxyz';
		$noncestr = '';
		for($i=0;$i<8;$i++){
			$randval = mt_rand(0,35);
			$noncestr .= $str[$randval];
		}
		$ticketstr="jsapi_ticket=". $ticket ."&noncestr=". $noncestr ."&timestamp=". $time ."&url=". $url;
		$sign = sha1($ticketstr);
		return json_encode(array("appid" => $this->_appid,"time" => $time, "noncestr" => $noncestr, "sign" => $sign, "url" => $url));	
	}

	public function createMenu($data)
	{
		$access_token = $this->getAccessToken();
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;

		// $menu = array("button"=>array(
		// 		array('name'=>'吃货活动','sub_button'=>array(array('type'=>'click','name'=>'食命必达','key'=>'A1'))),
		// 		array('name'=>'区域口味','sub_button'=>array(array('type'=>'click','name'=>'七种口味','key'=>'B1'))),
		// 		array('name'=>'营长公告','sub_button'=>array(array('type'=>'click','name'=>'最新活动','key'=>'C1'),array('type'=>'click','name'=>'获奖名单','key'=>'C2'),))),
		// 	);

		
		$this->dataPost($this->decodeUnicode(json_encode($data)),$url);
		return true;
	}

	public function getqrcode($sceneid)
	{
		$access_token = $this->getAccessToken();
		$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
		$post_data ='{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$sceneid.'}}}';	
		$ch=curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
		print $output;
	}

	public function sendService($fromUsername, $toUsername){
		$textTpl = "<xml>
					     <ToUserName><![CDATA[%s]]></ToUserName>
					     <FromUserName><![CDATA[%s]]></FromUserName>
					     <CreateTime>%s</CreateTime>
					     <MsgType><![CDATA[transfer_customer_service]]></MsgType>
					</xml>";
	    return sprintf($textTpl, $fromUsername, $toUsername, time());
	}

	public function sendMsgForSubscribe($fromUsername, $toUsername, $time, $msgType)
	{
		//查询是否有欢迎语句
		$sql="select * from same_wmenu_event where event='subscribe' and msgtype='text'";
		$rs=$this->_db->createCommand($sql)->select()->queryRow();
		$contentStr=$rs['content'];
		$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";
	    return sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
	}

	private function dataPost($post_string, $url) 
	{
		$context = array (
				'http' => array ('method' => "POST", 
				'header' => "Content-type: application/x-www-form-urlencoded\r\n User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) \r\n Accept: */*", 
				'content' => $post_string ));

		$stream_context = stream_context_create ($context);

		$data = file_get_contents ($url, FALSE, $stream_context);
		$rs = json_decode($data,true);
		if($rs['errcode']!=0)
			throw new Exception($rs['errcode']);
		return true;;
	}

	private function decodeUnicode($str) { 

		return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', create_function( '$matches', 'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");' ), $str);
	}

	public function getpagebyid($id){
		$sql="SELECT * FROM trio_wechat_page where id=".$id;
		$rs=$this->_db->createCommand($sql)->select()->queryRow();
		return $rs;
	}

	public function getOauth()
	{
		$callback=Yii::app()->request->hostInfo.'/'.Yii::app()->request->baseUrl.'/weixin/callback';
		$rs = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->_appid.'&redirect_uri='.$callback.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
		return $rs;
		
	}

	public function getOauth2()
	{
		$callback=Yii::app()->request->hostInfo.'/'.Yii::app()->request->baseUrl.'/weixin/callback2';
		$rs = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->_appid.'&redirect_uri='.$callback.'&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
		return $rs;
		
	}

	public function getOauthCRM($scope)
	{
		$callback=Yii::app()->request->hostInfo.'/'.Yii::app()->request->baseUrl.'/weixin/callbackcrm';
		$rs = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->_appid.'&redirect_uri='.$callback.'&response_type=code&scope='.$scope.'&state=STATE#wechat_redirect';
		return $rs;
		
	}

	public function getOauthAccessToken($code){
		$rs = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?code='.$code.'&grant_type=authorization_code&appid='.$this->_appid.'&secret='.$this->_secret);
		$rs = json_decode($rs,true);
		if(isset($rs['access_token'])){
			return $rs;
		}

		throw new Exception($rs['errcode']);

		return;
	}

	public function sendTemplate($openid) {
		$data = array();
		$data['first']['value'] = '恭喜你获得两位好友的补刀，贝玲妃邀请你到专柜体验“贝”氏修眉的超级服务！';
        $data['first']['color'] = '#000000';
        $data['keyword1']['value'] = 'Benefit Brow';
        $data['keyword1']['color'] = '#000000';
        $data['keyword2']['value'] = date("Y-m-d");
        $data['keyword2']['color'] = '#000000';
        $data['remark']['value'] = '活动详情：2人同行，可同时免费体验眉型塑造服务或2人同行，如果一人购买修眉服务，另一人可免费体验修唇服务。快来与亲爱的修眉师愉快约定吧~';
        $data['remark']['color'] = '#000000';
        $template_id = '7jUlb0EaMErEtzJkPAkJndXg0Xb3Mu6El9U_p06x4fM';
        $url = 'http://benefitbrow.samesamechina.com/site/form';
        $topcolor = '#000000';
        $access_token = $this->getAccessToken();
	    $http_data = array();
	    $http_data['touser'] = $openid;
	    $http_data['template_id'] = $template_id;
	    $http_data['url'] = $url;
	    $http_data['topcolor'] = $topcolor;
	    $http_data['data'] = $data;
	    $http_data = json_encode($http_data);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $http_data);
		$result = curl_exec($curl);
		curl_close($curl);
		$result = json_decode($result,true);
		if($result['errcode']==0){
			return 1;
		}
		return 0;
	}

	//获取周围坐标
   public function returnSquarePoint($lng, $lat,$distance = 0.5){
         $earthRadius = 6378138;
        $dlng =  2 * asin(sin($distance / (2 * $earthRadius)) / cos(deg2rad($lat)));
        $dlng = rad2deg($dlng);
        $dlat = $distance/$earthRadius;
        $dlat = rad2deg($dlat);
        return array(
                       'left-top'=>array('lat'=>$lat + $dlat,'lng'=>$lng-$dlng),
                       'right-top'=>array('lat'=>$lat + $dlat, 'lng'=>$lng + $dlng),
                       'left-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng - $dlng),
                       'right-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng + $dlng)
        );
   }
   //计算两个坐标的直线距离
    
   public function getDistance($lat1, $lng1, $lat2, $lng2){      
          $earthRadius = 6378138; //近似地球半径米
          // 转换为弧度
          $lat1 = ($lat1 * pi()) / 180;
          $lng1 = ($lng1 * pi()) / 180;
          $lat2 = ($lat2 * pi()) / 180;
          $lng2 = ($lng2 * pi()) / 180;
          // 使用半正矢公式  用尺规来计算
        $calcLongitude = $lng2 - $lng1;
          $calcLatitude = $lat2 - $lat1;
          $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);  
       $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
          $calculatedDistance = $earthRadius * $stepTwo;
          return round($calculatedDistance);
   }
}