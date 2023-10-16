<?php
class Controller_Budget extends Controller {
	public $view;
	public $model;
	
	function __construct(){
		$this->view = new View();
	}
	
	function action_index()	{
		if($_SESSION['role']=='admin'){
			$data=(object) array();
			$date =Controller_Budget::getPost('date','checkNum()',0);
			if(!empty($date)){
				$date=time()-$date*60*60*24;//за последние Х дней
			}
			$url =Controller_Budget::getPost('url','checkPost()','');
			$status =Controller_Budget::getPost('status','checkNum()','');
			$masteruserid =Controller_Budget::getPost('masteruserid','checkNum()','');
			$offerid =Controller_Budget::getPost('offerid','checkNum()','');
			$price =Controller_Budget::getPost('price','checkNum()','');
			$page=((!empty($_POST['page'])) && empty((new postFilter(array('page'=>$_POST['page'])))->checkNum()))?$_POST["page"]:0;
			$itemlimit=5;
			$budget=(((new Model_Budget($date,$url,$status,$masteruserid,$offerid,$price,$page*$itemlimit,$itemlimit))->getStat()));
			$data->all=$budget->arr;
			$data->balance_platform=$budget->balance_platform;
			$data->balance=$budget->balance;
			$data->count=$budget->count;
			$data->nextpage=((($page+1)*$itemlimit)>=$data->count)?'':($page+1);
			$data->prevpage=((($itemlimit)>=$data->count))?'':($page-1);
			$this->view->generate('budget_view.php', 'template_view.php', $data);
		}else{
			if(!empty($_POST['json'])){$_SESSION['json']='1';}
			header('Location:/404/');
		}
	}

	function getPost($var,$param,$default){
			if(!empty($_POST[$var]) && empty((new postFilter(array($var=>$_POST[$var])))->$param)){
				return $_POST[$var];
			}return $default;
			
	}


}
?>