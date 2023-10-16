<?php
class Controller_Admin extends Controller {
	public $view;
	public $model;

	function __construct()	{
		$this->view = new View();
	}
	
	function action_index()	{
		//по умолчанию, показываем 25 последних своих оффертов, остальные
		$page=((!empty($_POST['page'])) && empty((new postFilter(array('page'=>$_POST['page'])))->checkNum()))?$_POST["page"]:0;
		$offername = (!empty($_POST['offername'])) ? (new postClear($_POST['offername']))->clear() : '';
		$offertheme =(!empty($_POST['offertheme'])) ? (new postClear($_POST['offertheme']))->clear() : '';
		$itemlimit=5;
		$user_active_and_balance_info=(new Model_Admin($_SESSION['user']))->getBlockUser();
		if ( $_SESSION['auth'] == "1" && $user_active_and_balance_info->active==1 ){//проверка на авторизованность и на то, что юзер не блокирован, чтобы можно было выкинуть из сессии в момент активности
			switch ($_SESSION['role']){
				case 'master':
					$offertdb=((new Model_Offermaster('',$_SESSION['userid'],$page*$itemlimit,$itemlimit,$offername,$offertheme))->getOfferAll());
					Controller_Admin::constructRequest($offertdb,'Мастер','offermaster/add','Подробнее',$page,$itemlimit,'search',$user_active_and_balance_info->balance);
				break;
				case 'advert':
					$offertdb=(new Model_Offer($offername,'',$offertheme,'',$_SESSION['userid'],'','',($page*$itemlimit),$itemlimit))->getOffer();
					Controller_Admin::constructRequest($offertdb,'Рекламодатель','offer/edit','Изменить',$page,$itemlimit,'search',$user_active_and_balance_info->balance);
				break;
				case 'admin':
					$offertdb=(new Model_Offer($offername,'',$offertheme,'','','','',($page*$itemlimit),$itemlimit))->getOffer();
					Controller_Admin::constructRequest($offertdb,'Администратор','offer/edit','Изменить',$page,$itemlimit,'index',$user_active_and_balance_info->balance);
					//Controller_Admin::constructRequest($offertdb,'Мастер','offermaster/add','Подробнее',$page,$itemlimit,'search',$user_active_and_balance_info->balance);
				break;
			}
			
		}else{
			if(!empty($_POST['json'])){$_SESSION['json']='1';}
			header('Location:/404/');
		}
	}


	function action_search(){//поиск, пагинация и добавление новых офферов
		$user_active_and_balance_info=(new Model_Admin($_SESSION['user']))->getBlockUser();
		if ( $_SESSION['auth'] == "1" && $user_active_and_balance_info->active==1 ){
			$page=((!empty($_POST['page'])) && empty((new postFilter(array('page'=>$_POST['page'])))->checkNum()))?$_POST["page"]:0;
			$itemlimit=5;
			$offername = (!empty($_POST['offername'])) ? (new postClear($_POST['offername']))->clear() : '';
			$offertheme =(!empty($_POST['offertheme'])) ? (new postClear($_POST['offertheme']))->clear() : '';
			$offertdb=(new Model_Offer($offername,'',$offertheme,'','','','',($page*$itemlimit),$itemlimit))->getOffer();
			if($_SESSION['role']=='master'){
				$nameRole='Мастер';$parturl='offermaster/add';$parurlname='Добавить';
			}else{
				$nameRole='Рекламодатель';$parturl='offer/edit';$parurlname='Подробнее';
			}
			Controller_Admin::constructRequest($offertdb,$nameRole,$parturl,$parurlname,$page,$itemlimit,'index',$user_active_and_balance_info->balance);
		}
	}

	private function constructRequest($offertdb,$nameRole,$parturl,$parurlname,$page,$itemlimit,$formaction,$balance){
		$data = (object) array();
		$data->login=$_SESSION['user'];
		$data->table=$offertdb->item;
		$data->balance=$balance;
		$data->count=$offertdb->count;
		$data->nameRole=$nameRole;
		$data->parturl=$parturl;
		$data->parturlname=$parurlname;
		$data->formaction=$formaction;
		$data->nextpage=((($page+1)*$itemlimit)>=$data->count)?'':($page+1);
		$data->prevpage=((($itemlimit)>=$data->count))?'':($page-1);
		$this->view->generate('admin_view.php', 'template_view.php', $data);
	}
	
	function action_logout(){
		session_unset(); 
		session_destroy();
		header('Location:/');
	}
}
?>
