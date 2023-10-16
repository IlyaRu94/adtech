<?php
require_once 'model_filter.php';
require_once 'model_offerprice.php';
class Model_Offermaster extends Model{
	private $id;
	private $userid;
	private $page;
	private $offer_name;
	private $offer_theme;
	private $limit;

	public function __construct($offerid,$userid,$page='0',$limit=5,$offer_name='',$offer_theme=''){//добавить мастер и дату//добавить странички
		  $this->id = $offerid;
		  $this->userid = $userid;
		  $this->page = $page;
		  $this->offer_name = $offer_name;
		  $this->offer_theme = $offer_theme;
		  $this->limit = $limit;
		}

	public function setOffer()	{
		
		$stat=(object) array();
		$offeradd=(object) array();
		$offeradd = R::dispense('masteroffer'); //передаем название таблицы users
		$offeradd->offerid = $this->id;
		$offeradd->userid = $this->userid;
		$offeradd->masterurl = hash('gost-crypto', random_int(0,999999));
		R::store($offeradd); // сохраняем объект $offer в таблице
		$stat->url=$offeradd->masterurl;//вернем созданный урл
		$stat->status= '1';
		$stat->msg='offer добавлен';
		return $stat;
	}

	public function getOffer()	{
		$get_offer=R::findOne('adoffer', "id = ?",[$this->id]);//смотрим в общей базе оффером есть ли такой
		$get_offer_master=R::findOne('masteroffer', "offerid = ? and userid = ?",[$this->id,$this->userid]);//смотрим в списке пользователя есть ли такой
		if(!empty($get_offer)&&($get_offer->active=='1')){//проверка оффера в обшем списке
			//найдем создателя оффера и возьмем у него инфу: name и active
			$get_offerr_advert=R::findOne('users', "id = ?",[$get_offer->userid]);//смотрим в общей базе оффером есть ли такой
			if($get_offerr_advert->active==1){			
				if(empty($get_offer_master)){//проверка оффера в списке пользователя
					return Model_Offermaster::getStatusOffer($get_offerr_advert->name,'Оффер найден и активен',$get_offer,'1','');//статус 1 - можно добавлять
				}
				return Model_Offermaster::getStatusOffer($get_offerr_advert->name,'Оффер в Вашем списке',$get_offer,'2',$get_offer_master);//статус 2 обозначает, что в списке пользователя есть оффер
			}
			return Model_Offermaster::getStatusOffer($get_offerr_advert->name,'Создатель оффера заблокирован. Выплаты приостановлены.','','0','');//статус 0, оффер нельзя добавить, стоит проинформировать мастера оффера
		}
		return Model_Offermaster::getStatusOffer('','Оффер был деактивирован или несуществует.','','0','');//статус 0, оффер нельзя добавить
	}

	public function getOfferAll()	{//вывод всех офферов мастера
		$offerid=[];
		$get_offer=(object) array();
		$get_offer_master=R::find('masteroffer', "userid = $this->userid");//смотрим у пользователя offer
		foreach($get_offer_master as $val){
			$offerid[]=$val->offerid;
		}
		$offeridstr=implode(',',$offerid);
		if(!empty($offeridstr)){
			$like='';
			if(!empty($this->offer_name)){$like.=' AND name like '.$this->offer_name;}
			if(!empty($this->offer_theme)){$like.=' AND theme like '.$this->offer_theme;}
			$get_offer->item=R::find('adoffer', 'id IN ('.$offeridstr.') '.$like.'  ORDER BY id DESC  LIMIT '.($this->page).','.$this->limit);//смотрим в общей базе оффером есть ли такой
			$get_offer->count=R::count('adoffer', 'id IN ('.$offeridstr.')');
		}
		if($get_offer){
			return $get_offer;
		}
		return false;
	}

	public function getOfferDelete()	{
		$find = R::findOne('masteroffer', 'offerid = ? and userid = ?',[$this->id, $this->userid]);//ищем по иду офферта ид записи
		$delete = R::load('masteroffer', $find->id); //удаляем
		R::trash($delete);
	}


	private function getStatusOffer($advertname,$msg,$get_offer,$status,$get_offer_master){
		$offer=(object) array();
		$offer->advertname=$advertname;
		$offer->msg=$msg;
		$offer->offer=$get_offer;
		$offer->status=$status;
		$offer->offertouser=$get_offer_master;
		return $offer;

	}


}