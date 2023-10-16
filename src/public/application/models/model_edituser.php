<?php
require_once 'model_user.php';
require_once 'model_filter.php';
class Model_Edituser extends Model
{

	private $login;
	private $name;
	private $is_admin;
	private $id;
	private $password;
	private $balance;
	private $active;
	public function __construct($id,$login,$password='',$balance,$active,$is_admin,$name){
		$this->login = $login;
		$this->password = $password;
		$this->name = $name;
		$this->is_admin = $is_admin;
		$this->id = $id;
		$this->password = $password;
		$this->balance = $balance;
		$this->active = $active;
	}
	public function edit(){
		$user = R::dispense('users'); //передаем название таблицы users	
		if(!empty($this->id)){
			$user->id= $this->id;
			$user->password =(new Model_User_one($this->id))->oneUser()->password;
		}
		$user->login = $this->login;
		if(!empty($this->password)){//если есть пароль - заменим, если нет - добавим старый
			$user->password = password_hash($this->password,PASSWORD_DEFAULT);
		}
		$user->balance = $this->balance;
		$user->is_admin = $this->is_admin;
		$user->name = $this->name;
		$user->active=$this->active;
		R::store($user); // сохраняем объект $user в таблице
	}
}

class Model_User_All{
	public function allUser(){
	$userAcc=R::findAll('users');
	return $userAcc;
	}
}

class Model_User_one{
	private $id;
	public function __construct($id)
	{
		$this->id=$id;
	}
	public function oneUser(){
	$userAcc=R::findOne('users',"id = $this->id");
	return $userAcc;
	}
	public function delUser(){
		$delete = R::load('users', $this->id); //удаляем
		R::trash($delete);
		}
}
