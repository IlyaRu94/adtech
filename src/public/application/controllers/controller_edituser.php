<?php
class Controller_Edituser extends Controller {
	public $view;
	public $model;
	
	function __construct(){
		$this->view = new View();
	}
	
	function action_index()	{
		if($_SESSION['role']=='admin'){
			$data=(object) array();
			$data->all=(((new Model_User_All())->allUser()));
			$this->view->generate('edituser_view.php', 'template_view.php', $data);
		}else{
			if(!empty($_POST['json'])){$_SESSION['json']='1';}
			header('Location:/404/');
		}
	}
	function action_edit($id)	{
		$data=(object) array();
		if($_SESSION['role']=='admin'){
			if(!empty($id)){//если не передан id или он не корректный - создадим нового пользователя
				$filterid=(new postFilter(array('id'=>$id)))->checkNum();
				if(!empty($filterid) ){	$id =0;	}else{
					$data->one=(new Model_User_one($id))->oneUser();
				}
			}else{$id=0;}
				if(isset($_POST['tkn']) && $_POST['tkn']==$_SESSION['tkn']){
				if(!empty($_POST['login']) && !empty($_POST['name']) && isset($_POST['balance']) && (!empty($_POST['password'])||(!empty($id)))){
					$filterpost=(new postFilter(array('login'=>$_POST['login'])))->checkPost();
					$filternum=(new postFilter(array('balance'=>$_POST['balance'])))->checkNum();
					if(empty($filterpost) && empty($filternum) )	{
						$login = $_POST['login'];
						$password ='';
						if(!empty($_POST['password'])){
							$filterpass=(new postFilter(array('password'=>$_POST['password'])))->checkPost();
							if(empty($filterpass) ){
								$password =$_POST['password'];
							}
						}

						$balance=$_POST['balance'];
						$name =(new postClear($_POST['name']))->clear();
						$active=(!empty($_POST['active']) && $_POST['active']==1) ? 1 : 0;
						$is_admin=(!empty($_POST['is_admin']) && $_POST['is_admin']==1) ? 1 : 0;
						(new Model_Edituser($id,$login,$password,$balance,$active,$is_admin,$name))->edit();//изменяем
						$data->one=(object) array('id'=>$id,'login'=>$login,'balance'=>$balance,'active'=>$active,'is_admin'=>$is_admin,'name'=>$name);
						$data->status='Успешно';
					}else{$data->status='В полях есть недопустимые символы';}
				}else {
					$data->status= 'Поля не должны быть пустыми';
				}
			}
			$token = hash('gost-crypto', random_int(0,999999));
			$_SESSION["tkn"] = $token;
			$this->view->generate('edituser_view.php', 'template_view.php', $data);
		}else{
			if(!empty($_POST['json'])){$_SESSION['json']='1';}
			header('Location:/404/');
		}
	}


	function action_delete()	{
		if(!empty($_POST['del']) && empty((new postFilter(array('del'=>$_POST['del'])))->checkNum())){
			if(!empty($_SESSION['userid']) && $_SESSION['role']=='admin' ){
				(new Model_User_one($_POST['del']))->delUser();
				if(!empty($_POST['json'])){$_SESSION['json']='1';}
				header('Location:/edituser/');
			}else{
				if(!empty($_POST['json'])){$_SESSION['json']='1';}
				header('Location:/404/');
			}
		}else{
			if(!empty($_POST['json'])){$_SESSION['json']='1';}
			header('Location:/404/');
		}
	}


}
?>