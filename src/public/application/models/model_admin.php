<?php
require_once 'model_offer.php';
require_once 'model_offermaster.php';
class Model_Admin extends Model{
	private $user;
	  public function __construct($user){
		  $this->user = $user;
		}
	public function getBlockUser()	{	// проверка на блокировку пользователя
		$userAcc=R::findOne('users', "login = ? ", [$this->user]);
        if($userAcc->active==1)  {
			$userAcc->datetime=time();
			$userAcc->ip=$_SERVER['REMOTE_ADDR'];
			R::store($userAcc); // сохраняем дату и ip последней активности
			return $userAcc;
		}
	}
}