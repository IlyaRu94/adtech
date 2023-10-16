<?php
class Controller_Register extends Controller {
	public $view;
	public $model;
	
	function __construct(){
		$this->view = new View();
	}
	
	function action_index()	{
		$sms=(object) array();
		$sms->login_status="access_denied";
		if(isset($_POST['tkn']) && $_POST['tkn']==$_SESSION['tkn']){
			$filter=new postFilter(array('password'=>$_POST['password'],'login'=>$_POST['login']));
			$filterpost=$filter->checkPost();
			if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['runame']) && empty($filterpost) )	{
				$login = $_POST['login'];
				$password =$_POST['password'];
				$runame =(new postClear($_POST['runame']))->clear();
				$user=new User($login,$password,$runame);
				$infouser=$user->setRegisterUser();
				if(($infouser->status)=='1'){
					$sms->sms= $infouser->msg;
					$sms->login_status="access_granted";
					//header('Refresh: 2; url=/');
				}else{
					$sms->sms= $infouser->msg;
				}
			}else{
				$sms->sms=  'Поле ' .implode(',',$filterpost). ' должно быть длиннее 3х символов и содержать только буквы, цифры и -.@_ символы';
			}
		}
			$token = hash('gost-crypto', random_int(0,999999));
			$_SESSION["tkn"] = $token;
			$this->view->generate('register_view.php', 'template_view.php', $sms);	
	}
}
?>