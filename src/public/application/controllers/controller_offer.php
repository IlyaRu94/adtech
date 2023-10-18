<?php
class Controller_Offer extends Controller {
	public $view;
	public $model;
	
	function __construct()	{
		$this->view = new View();
	}
	
	function action_index()	{
		$data=(object) array();
		if(!empty($_SESSION['userid'])  && ($_SESSION['role']=='advert' || $_SESSION['role']=='admin') ){
			Controller_Offer::offerToDB($data);
		}else{
			if(!empty($_POST['json'])){$_SESSION['json']='1';}
			header('Location:/404/');
		}
	}

	function action_edit($param){
		$data=(object) array();
		if(!empty($_SESSION['userid'])  && ($_SESSION['role']=='advert' || $_SESSION['role']=='admin') ){
			$datetime=0;
			if(!empty($_POST['date'])){//для отображения кликов и заработка за периоды
				switch($_POST['date']){
					case 1:
						$datetime=time()-60*60*24;//день
					break;
					case 2:
						$datetime=time()-60*60*24*30;//месяц
					break;
					case 3:
						$datetime=time()-60*60*24*30*12;//год
					break;
					default: 
						$datetime=0;
					break;
				}
			}
			$user_id=($_SESSION['role']=='admin')?'':$_SESSION['userid'];//Для админа ид - пустота
			$offerdb=((new Model_Offer('','','','',$user_id,'',$param))->getOffer())->item;
			if(!empty($offerdb)){
				$data->offerurl=$offerdb->url;
				$data->offername=$offerdb->name;
				$data->offertheme=$offerdb->theme;
				$data->offerprice=$offerdb->price;
				if($_SESSION['role']=='admin'){$data->userid=$offerdb->userid;}
				$data->offeractive=$offerdb->active;
				$data->offerid = $param;
				$offer_click_price=(new Model_Offerprice ($param,$user_id,0,$datetime))->getOfferbalance();
				if($offer_click_price->status=1){
					$data->offer_balance=$offer_click_price->balance;
					$data->offer_click=$offer_click_price->count;
				}
				$offer_master_count=(new Model_Offer_count($param))->getOfferCount();
				$data->offer_master_count=(!empty($offer_master_count))?$offer_master_count:0;
				Controller_Offer::offerToDB($data);
			}else{
				if(!empty($_POST['json'])){$_SESSION['json']='1';}
				header('Location:/404/');
			}
		}else{
			if(!empty($_POST['json'])){$_SESSION['json']='1';}
			header('Location:/404/');
		}
	}

private function offerToDB($data){
	$offerid=((!empty($data->offerid)) ? $data->offerid : '');
	if(isset($_POST['tkn']) && $_POST['tkn']==$_SESSION['tkn']){
		if(!empty($_POST['offername']) && !empty($_POST['offertheme']) && !empty($_POST['offerurl']) && !empty($_POST['offerprice']) )	{
			if(empty((new postFilter(array('offerurl'=>$_POST['offerurl'])))->checkUrl()) && empty((new postFilter(array('offerprice'=>$_POST['offerprice'])))->checkNum())	)	{
				$data->offerurl=$offerurl= $_POST['offerurl'];
				$data->offerprice=$offerprice= $_POST['offerprice'];
				$data->offeractive=$offeractive= ($_POST['offeractive']=='1')?'1':'0';
				$data->offername=$offername = (new postClear($_POST['offername']))->clear();
				$data->offertheme=$offertheme =(new postClear($_POST['offertheme']))->clear();
				$data->userid=$userid=($_SESSION['role']=='admin')?$_POST['userid']:$_SESSION['userid'];
				$createoffer= new Model_Offer($offername,$offerprice,$offertheme,$offerurl,$userid,$offeractive,$offerid);
				$offer=$createoffer->setOffer();
				$data->msg=$offer->msg;
			}else{
				$data->msg='Поля содержат недопустимые значения';
			}
		}else{$data->msg='Заполните все поля';}
	}
	$token = hash('gost-crypto', random_int(0,999999));
	$_SESSION["tkn"] = $token;
	//$data = $this->model->get_data();
	$this->view->generate('offer_view.php', 'template_view.php', $data);	

}


function action_delete()	{
	if(!empty($_POST['del']) && empty((new postFilter(array('del'=>$_POST['del'])))->checkNum())){
		if(!empty($_SESSION['userid'])  && ($_SESSION['role']=='advert'  || $_SESSION['role']=='admin') ){
			(new Model_Offer_count($_POST['del'],$_SESSION['userid']))->getOfferDelete();
			if(!empty($_POST['json'])){$_SESSION['json']='1';}
			header('Location:/admin/');
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