<?php

class guestadmin
{
  private $sql;
  private $request;

  public function __construct(){
    $this->sql = new database();
    $this->request = new uprequest();
  }

  public function getpage(){
    $data = array(
      array('key' => 'sex' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'firstname' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'secondname' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'ddata' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'dtime' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'contacttype' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'contact' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'product' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'brandname' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'numb' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'one' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'status' ,'type'=> 'post' ,'regtype'=> 'text'),
    );
    if(!$keys = $this->request->uselykeys($data))
      return '11'; /*data formate error*/
    if(!is_array($keys))
        $keys = array();
    $numb = isset($keys['numb'])?$keys['numb']:'1';
    $one = isset($keys['one'])?$keys['one']:'10';
    unset($keys['numb']);
    unset($keys['one']);
    // return $this->sql->getpage($numb ,$one ,$keys ,array(),'same_order' );
    return $this->sql->Reggetpage($numb ,$one ,$keys ,array(),'same_order' );
  }

  public function comfirmbespk(){
    $data = array(
      array('key' => 'id' ,'type'=> 'post' ,'regtype'=> 'number'),
    );
    if(!$keys = $this->request->comfirmKeys($data))
      return '11'; /*data formate error*/
    if($this->sql->Sqlupdate('same_order',array('status'=>'1'),'id=:id',array(':id' => $keys['id']))){
      return '12'; /*data instart success*/
    }
    return '13';/*data insert error*/
  }

  public function getcount(){
    $data = array(
      array('key' => 'sex' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'firstname' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'secondname' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'contacttype' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'contact' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'product' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'brandname' ,'type'=> 'post' ,'regtype'=> 'text'),
      array('key' => 'status' ,'type'=> 'post' ,'regtype'=> 'text'),
    );
    if(!$keys = $this->request->uselykeys($data))
      return '11'; /*data formate error*/
    if(!is_array($keys))
      $keys = array();
    return array('count' => $this->sql->Reggetcount('same_order',$keys));
  }
}
