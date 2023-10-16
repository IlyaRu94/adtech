<?php
class postFilter extends Model
{

  	private $post;
		public function __construct($post){
			$this->post = $post;
		}
	public function checkPost(){
		$error=[];
		foreach($this->post as $postkey=>$postval){
			if(((mb_strlen($postval))<3) || !(preg_match("/^[-.@_А-Яа-я\w]+$/u", $postval))){
				$error[]=$postkey;
			}
		}
		return $error;
	}
	public function checkNum(){
		$error=[];
		foreach($this->post as $postkey=>$postval){
			if(((mb_strlen($postval))<1) || !(preg_match("/^[.\d]+$/u", $postval))){
				$error[]=$postkey;
			}
		}
		return $error;
	}
	public function checkUrl(){
		$error=[];
		foreach($this->post as $postkey=>$postval){
			if(((mb_strlen($postval))<3) || !(preg_match("#^[:\/\?\-._А-Яа-я\w]+$#u", $postval))){
				$error[]=$postkey;
				echo $postval;
			}
		}
		return $error;
	}
}

class postClear extends Model{
	private $post;
	public function __construct($post){
		$this->post = $post;
	}
	public function clear(){
		$clear=preg_replace("/[^\p{L}0-9\!\.\-_\s\?,:*\+;\(\)]/ui", "", $this->post);
		return $clear;
	}
}