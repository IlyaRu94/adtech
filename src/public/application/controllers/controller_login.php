<?php
class Controller_Login extends Controller {
	public $view;
	public $model;
	
	function __construct()	{
		$this->view = new View();
	}
	
	function action_index()	{
		$data = (object) array();

		if(isset($_POST['tkn']) && $_POST['tkn']==$_SESSION['tkn']){
			$filter=new postFilter($_POST);
			$filterpost=$filter->checkPost();
			if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['role']) && empty($filterpost) ) {
				$login = $_POST['login'];
				$password =$_POST['password'];
				$role =$_POST['role']=='advert' ? 'advert' : 'master';
				$user=new User($login,$password,'','');
				$infouser=$user->getCheckUser();
				if($infouser->auth=='1'){
					$data->login_status = "access_granted";
					$data->sms=$infouser->sms;
					$_SESSION['auth']=$infouser->auth;
					$_SESSION['user']=$infouser->user;
					$_SESSION['runame']=$infouser->name;
					$_SESSION['userid']=$infouser->userid;
					$_SESSION['role']=(!empty($infouser->is_admin))?'admin':$role;//если человек помечен в базе как админ - заменим ему роль на админскую
					if(!empty($_POST['json'])){$_SESSION['json']='1';}
					$_SESSION['menu']='update';
					//header('Refresh: 2; url=/admin/');
						
						header('Location:/admin/');
				}else{
					$data->sms=$infouser->sms . ' ' .implode(',',$filterpost);
					$data->login_status = "access_denied";
					session_unset();
				}
			} else{ 
				$data->login_status = "access_denied"; $data->sms= 'Поле ' .implode(',',$filterpost). ' должно быть длиннее 3х символов и содержать только буквы, цифры и -.@_ символы';
			}
		}
			$token = hash('gost-crypto', random_int(0,999999));
			$_SESSION["tkn"] = $token;
			$this->view->generate('login_view.php', 'template_view.php', $data);
	}
}
?>