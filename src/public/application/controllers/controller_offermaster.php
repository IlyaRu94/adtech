<?php
class Controller_Offermaster extends Controller {
	public $view;
	public $model;
	
	function __construct()	{
		$this->view = new View();
	}
	
	function action_index()	{
		$data=(object) array();
		if(!empty($_SESSION['userid'])  && ($_SESSION['role']=='master' || $_SESSION['role']=='admin') ){
			if(!empty($_POST['json'])){$_SESSION['json']='1';}
			header('Location:/admin/');
		}else{
			if(!empty($_POST['json'])){$_SESSION['json']='1';}
			header('Location:/404/');
		}
	}

	function action_add($param){
		$data=(object) array();
		if(!empty($_SESSION['userid'])  && ($_SESSION['role']=='master' || $_SESSION['role']=='admin') && empty((new postFilter(array('offerid'=>$param)))->checkNum())	 ){
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
			//проверка на существование и активность оффера
			$user_id=($_SESSION['role']=='admin')?'':$_SESSION['userid'];
			$offerdb=((new Model_Offermaster($param,$_SESSION['userid']))->getOffer());//проверили на существование, если существует - подгрузили массив
			if($offerdb->status=='1' || $offerdb->status=='2'){//если все ок
				if($offerdb->status=='1' && $_SESSION['role']!=='admin'){
					$createoffer= (new Model_Offermaster($param,$_SESSION['userid']))->setOffer();//добавили
					$data->msg=$createoffer->msg;
					$data->stat='access_granted';
					$data->masterurl='http://'.$_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'].'/redirect/url/'.$createoffer->url;
				}else{
					$data->msg=$offerdb->msg;
					$data->stat='access_granted';
					$data->masterurl='http://'.$_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'].'/redirect/url/'.$offerdb->offertouser->masterurl;
					$offer_click_price=(new Model_Offerprice ($param,0,$_SESSION['userid'],$datetime))->getOfferbalance();
					if($offer_click_price->status=1){
						$data->offer_balance=$offer_click_price->balance;
						$data->offer_click=$offer_click_price->count;
					}
				}
				$data->offerid=$offerdb->offer->id;
				$data->offerprice=$offerdb->offer->price;
				$data->offername=$offerdb->offer->name;
				$data->offerurl=$offerdb->offer->url;
				$data->offeruserid=$offerdb->offer->userid;
				$data->offeradvertname=$offerdb->advertname;
				$data->offertheme=$offerdb->offer->theme;
			}else{
				$data->stat='access_denied';
				$data->msg=$offerdb->msg;
			}
			$this->view->generate('offermaster_view.php', 'template_view.php', $data);	
		}else{
			if(!empty($_POST['json'])){$_SESSION['json']='1';}
			header('Location:/404/');
		}
	}


	function action_delete()	{
		$data=(object) array();
		if(!empty($_POST['del']) && empty((new postFilter(array('del'=>$_POST['del'])))->checkNum())){
			if(!empty($_SESSION['userid'])  && ($_SESSION['role']=='master' || $_SESSION['role']=='admin') ){
				(new Model_Offermaster($_POST['del'],$_SESSION['userid']))->getOfferDelete();
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
