<?php

class question
{
  private $sql;
  private $request;
  private $session;
  private $draw = false;
  private $affect = '10';//0~100
  private $total = '28';//total

  public function __construct(){
    $this->sql = new database();
    $this->request = new uprequest();
    $this->session = new Session();
  }

  public function submitdata(){
    $data = array(
      array('key' => 'answers' ,'type'=> 'post' ,'regtype'=> 'json'),
    );
    $func = function($value) {
      return implode(",",$value);
    };
    if(!$keys = $this->request->comfirmKeys($data))
      return '11'; /*data formate error*/
    if(!is_array($keys))
        $keys = array();
    if(!isset($keys['answers']))
      return '11'; /*not have any any answers*/
    $input = json_decode($keys['answers'],true);
    $input = array_map($func, $input);
    $user = uniqid();
    $input['sessionid'] = $user;
    if($this->sql->insertData($input ,'benefit_question')){
      $total = intval(file_get_contents('upload/totalluck.text'));
      if(mt_rand(0,100) <= $this->affect && $this->draw && $total < $this->total){
        // file_put_contents('upload/totalluck.text', $total+1);
        $fp = fopen("upload/totalluck.text", "w");
        fwrite($fp, $total+1);
        fclose($fp);
        $this->session->set('luckly', $user);
        return $user;
      }
        return '12'; /*data instart success but not get the gift*/
    }
    return '13';/*data insert error*/
  }

  public function luckierinfo(){
    $data = array(
      array('key' => 'sessionid' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'user' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'telphone' ,'type'=> 'post' ,'regtype'=> 'telphone'),
      array('key' => 'address' ,'type'=> 'post' ,'regtype'=> 'text'),
    );
    if(!$keys = $this->request->comfirmKeys($data))
      return '11'; /*data formate error*/
    if(isset($keys['sessionid']) && $this->session->has('luckly') &&$this->session->get('luckly') == $keys['sessionid']){
      if($this->sql->insertData($keys ,'benefit_userinfo')){
          $this->session->delkey('luckly');
          return '12'; /*userinfo update success*/
      }
      return '13';/* error insert*/
    }
    return '14';/* error submit*/
  }

  public function test(){
    return $_POST['answers'];
    return $this->request->post('answers');
    // $func = function($value) {
    //   return implode(",",$value);
    // };
    // // print_r(array_map($func, $data));
    // return array_map($func, $data);
    // // return 'aaaaaaa';
  }
}
