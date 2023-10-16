<?php
require_once 'model_filter.php';
require_once 'model_offerprice.php';
class Model_Redirect extends Model{
	private $master_user_id;
	private $url;
	private $status;
	private $offerid;
	private $offer_price;


	public function __construct($offerid='0',$url,$status='0',$master_user_id='0',$offer_price='0'){//добавить мастер и дату//добавить странички
		  $this->master_user_id = $master_user_id;
		  $this->url = $url;
		  $this->status = $status;
		  $this->offerid = $offerid;
		  $this->offer_price = $offer_price;
		}

	//при перехоте по ссылке сохраняем дату, время, статус, ид ссылки мастера и количество кликов
	public function redirectSave(){
		$offeradd=(object) array();
		$offeradd = R::dispense('click'); //передаем название таблицы click
		$offeradd->date = time();
		$offeradd->masteruserid= $this->master_user_id;
		$offeradd->status=$this->status;
		$offeradd->url=$this->url;
		$offeradd->price=$this->offer_price;
		$offeradd->offerid=$this->offerid;
		R::store($offeradd); // сохраняем объект в таблице
	}

	// при переходе по ссылке проверяем, есть ли оффер в списке мастера
	public function redirectCheckMaster(){
		$search_offer=(object) array();
		$get_master_offer=R::findOne('masteroffer', "masterurl = ?",[$this->url]);//смотрим в таблице masteroffer есть ли такой url
		if(!empty($get_master_offer)){//если найдено - вернем id мастера и id offera
			$search_offer->master_user_id=$get_master_offer->userid;//id мастера
			$search_offer->offerid=$get_master_offer->offerid;
			$search_offer->status=1;//оффер в списке мастера найден
			return $search_offer;
		}
	}
	public function redirectCheckOffer(){//получаем статус активности оффера, стоимость и его прямой урл
		$search_offer=(object) array();
		$get_master_offer=R::findOne('adoffer', "id = ?",[$this->offerid]);//смотрим в таблице adoffer есть ли такой id
		if(!empty($get_master_offer)){//если найдено - вернем active, url и price 
			$search_offer->price=$get_master_offer->price;
			$search_offer->active=$get_master_offer->active;
			$search_offer->url=$get_master_offer->url;//реальный url
			$search_offer->userid=$get_master_offer->userid;//id рекламщика
			$search_offer->status=2;//оффер в общем списке найден
			return $search_offer;
		}
	}

}