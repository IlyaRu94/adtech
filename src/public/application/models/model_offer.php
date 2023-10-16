<?php
require_once 'model_filter.php';
require_once 'model_offerprice.php';
class Model_Offer extends Model{
	private $name;
	private $price;
	private $theme;
	private $url;
	private $userid;
	private $id;
	private $active;
	private $page;
	private $limit;

	public function __construct($offername, $offerprice, $offertheme, $offerurl, $userid, $active, $offerid='', $page=0, $limit=5){//добавить мастер и дату//добавить странички
		  $this->name = $offername;
		  $this->price = $offerprice;
		  $this->theme = $offertheme;
		  $this->url = $offerurl;
		  $this->userid = $userid;
		  $this->id = $offerid;
		  $this->active = $active;
		  $this->page = (int)$page;
		  $this->limit = (int)$limit;
		}
	public function setOffer()	{
		
		$stat=(object) array();
		$offeradd=(object) array();
		$offeradd = R::dispense('adoffer'); //передаем название таблицы users
		if(!empty($this->id)){//Для редактированания существующего 
			$offeradd->id=$this->id;
		}
		$offeradd->name = $this->name;
		$offeradd->theme = $this->theme;
		$offeradd->price = $this->price;
		$offeradd->url = $this->url;
		$offeradd->active = $this->active;
		$offeradd->userid = $this->userid;
		$offeradd->date=time();
		R::store($offeradd); // сохраняем объект $offer в таблице
		$stat->status= '1';
		$stat->msg='Выполнено';
		return $stat;
	}

	public function getOffer()	{
		$paramtodb = array();
		$requesttodb = '';
		$getoffer=(object) array();
		//переберем массив $this для формирования запроса к базе данных

		foreach($this as $key=>$val){
			if(!empty($val)){
				if($key=='page'||$key=='limit'){continue;}
				if($key=='userid'||$key=='id'){
					$paramtodb[]="$key = '$val'";
				}else{
					$paramtodb[]="$key LIKE '%$val%'";
				}
			}
		}
		$requesttodb=implode(' and ',$paramtodb);
		if(!empty($this->id)){//если задан id - будет только 1 вариант
			$getoffer->item=R::findOne('adoffer', $requesttodb);
		}else{
			$getoffer->item=R::findAll('adoffer', $requesttodb . '  ORDER BY id DESC  LIMIT '.($this->page).', ' .$this->limit );
			$getoffer->count=R::count('adoffer', $requesttodb);
		}
		if($getoffer->item){
			return $getoffer;
		}
		return false;
	}

}

class Model_Offer_count extends Model{//простейшая моделька для вывода количества подписчиков
	private $id;
	private $userid;
	public function __construct($offerid,$userid=''){
		$this->id = $offerid;
		$this->userid = $userid;
	}
public function getOfferCount()	{
	$find = R::count('masteroffer', 'offerid = ? ',[$this->id ]);//Считаем количество подписчиков
	return $find;
}

public function getOfferDelete()	{
	$find_id = (object) array();
	$find = R::findOne('adoffer', 'id = ? and userid = ?',[$this->id, $this->userid]);//ищем по иду офферта ид записи
	$find_id=(!empty($find->id))?$find->id:'';
	if($_SESSION['role']=='admin'){$find_id=$this->id;}//подставим $this->id вместо find id для того, чтобы админ мог удалить оффер
	$delete = R::load('adoffer', $find_id); //удаляем
	R::trash($delete);
}

}
