<?php
class Controller_Redirect extends Controller {
	public $view;
	public $model;
	
	function __construct()	{
		$this->view = new View();
	}
	
	function action_index()	{//Заглушка
		header('Location:/404/');
	}

	function action_url($url){
		if(!empty($url)&&(empty((new postFilter(array('url'=>$url)))->checkPost()))){
			$status=0;$offerid='0';$master_user_id='0';$offer_real_url='';$offer_price=0;
			$search_offer_master=((new Model_Redirect('',$url))->redirectCheckMaster());
			if($search_offer_master->status==1){
				$status=1;//оффер в списке мастера найден (Ошибка: не активен в общем списке офферов)
				$offerid=$search_offer_master->offerid;
				$master_user_id=$search_offer_master->master_user_id;
				$search_offer=((new Model_Redirect($offerid,$url))->redirectCheckOffer());
				if($search_offer->status==2){
					if($search_offer->active==1){
						$status=2;//оффер найден и активен (ошибка: оффер отсутствует в списке мастера)
						$offer_real_url=$search_offer->url;//реальный url
						$userid_answer=$search_offer->userid;//id рекламщика
						//сюда начисление денюшек кинуть, но из другой модели
						$status_users_price=((new Model_Offerprice($offerid,$userid_answer,$master_user_id,''))->setBalance());//перечисляем деньги и смотрим статус
						if($status_users_price==5){
							$status=5;
							$offer_price=$search_offer->price;//добавляем стоимость перехода в список кликов
						}else{
							$status=$status_users_price;//записываем остальные статусы в таблицу
						}
					}
				}
			}
			Controller_Redirect::savestatus ($offerid,$url,$status,$master_user_id,$offer_real_url,$offer_price);//сохраняем все, что происходит с урлом
		}else{
			header('Location:/404/');
		}
	}

function savestatus ($offerid,$url,$status,$master_user_id,$redirect_url,$offer_price){
	$save_offer=((new Model_Redirect($offerid,$url,$status,$master_user_id,$offer_price))->redirectSave());
if($status==5){
	header('Location:'.$redirect_url);
	//print_r( '.'. $redirect_url .'.');
}else{
	header('Location:/404/');
}
}


}
?>