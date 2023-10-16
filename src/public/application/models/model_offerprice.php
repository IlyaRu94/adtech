<?php
class Model_Offerprice extends Model{
	private $id;
	private $user_id;
	private $master_user_id;
	private $date;


	public function __construct($offer_id,$user_id=0,$master_user_id=0,$date=0){
		  $this->id = $offer_id;
		  $this->user_id = $user_id;
		  $this->master_user_id = $master_user_id;
		  $this->date = $date;
		}
		// начислим денюшку мастеру и спишем с рекламодателя
		public function setBalance(){
			$price_offer= Model_Offerprice::getOfferPrice();//стоимость оффера
			if(!empty($price_offer->active==1)){
				$get_user_ad=R::findOne('users', "id = ?",[$this->user_id]);//найдем рекламщика
				if(!empty($get_user_ad->active)){
					$get_user_ad->balance=($get_user_ad->balance) - ($price_offer->price);//вычтем цену оффера за переход
					if($get_user_ad->balance < 0){//Если денег нет - выкидываем ошибку, ничего не делаем
						return 0;
					}
					if($this->user_id==$this->master_user_id){//для дурачков, которые будут свои же офферы  через платформу толкать, просто удержим у них 20% и все
						$get_user_ad->balance=($get_user_ad->balance) + ($price_offer->price / 100 * 80);//закинем мастеру деньжат с удержанием процента
						R::store($get_user_ad);
						return 5;//все получили денюшки, все прошло хорошо.
					}
					$get_user_master=R::findOne('users', "id = ?",[$this->master_user_id]);//найдем мастера
					if(!empty($get_user_master->active)){
						$get_user_master->balance=($get_user_master->balance) + ($price_offer->price / 100 * 80);//закинем мастеру деньжат с удержанием процента
						R::store($get_user_ad);
						R::store($get_user_master);
						return 5;//все получили денюшки, все прошло хорошо.
					} return 4;//мастер заблокирован
				} return 3;//рекламщик заблокирован
			} return 2;//оффер не активный
		}
	public function getOfferbalance()	{
		$offerbalance=(object) array();
		$getofferprice=(object) array();
		if(!empty($this->master_user_id)){
			$getoffercount=R::count('click', "masteruserid= ? and offerid = ? and status = ? and date > ? ",[$this->master_user_id,$this->id,5,$this->date]);//считаем кол-во переходов для мастера
			$getofferprice=(int)R::getCell('SELECT SUM(price) FROM click WHERE masteruserid= ? and offerid = ? and status = ? and date > ? ',[$this->master_user_id,$this->id,5,$this->date])/100*80;// суммируем в бд и находим процент
		}else{
			$getoffercount=R::count('click', "offerid = ? and status = ? and date > ? ",[$this->id,5,$this->date]);//Считаем общее кол-во переходов по офферту
			$getofferprice=(int)R::getCell('SELECT SUM(price) FROM click WHERE offerid = ? and status = ? and date > ? ',[$this->id,5,$this->date]);// суммируем в бд
		}
		$offerbalance->status=1;
		$offerbalance->count=$getoffercount;
		$offerbalance->balance=$getofferprice;
		return $offerbalance;
	}
	//найдем по иду стоимость оффера и ее вернем
	public function getOfferPrice()	{
		$get_offer_price_return=(object) array();
		$get_offer_price=R::findOne('adoffer', "id = ?",[$this->id]);//смотрим в общей базе офферов есть ли такой
		if(!empty($get_offer_price)){
			$get_offer_price_return->price=$get_offer_price->price;
			$get_offer_price_return->active=$get_offer_price->active;
			return $get_offer_price_return;
		}
	}



}
