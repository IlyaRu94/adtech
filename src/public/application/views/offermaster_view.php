<?php
$print='<section class="section">
    <h1 class="section__h1">Подробная информация об оффере</h1>
    <div class="section__table">
        <div class="table__row">
            <div class="table__th">Название оффера</div>
            <div class="table__td">'.$data->offername.'</div>
        </div>
        <div class="table__row">
            <div class="table__th">Тема оффера</div>
            <div class="table__td">'.$data->offertheme.'</div>
        </div>
        <div class="table__row">
            <div class="table__th">id оффера</div>
            <div class="table__td">'.$data->offerid.'</div>
        </div>
        <div class="table__row">
            <div class="table__th">url оффера</div>
            <div class="table__td">'.$data->offerurl.'</div>
        </div>
        <div class="table__row">
            <div class="table__th">Стоимость перехода</div>
            <div class="table__td">'.$data->offerprice.' руб. (Комиссия за вывод средств: 20%)</div>
        </div>
        <div class="table__row">
            <div class="table__th">Имя рекламодателя</div>
            <div class="table__td">'.$data->offeradvertname.' (id:'.$data->offeruserid.')</div>
        </div>
        <div class="table__row">
            <div class="table__th">Реферальный url</div>
            <div class="table__td">'.$data->masterurl.'</div>
        </div>
    </div>';
    if(!empty($data->stat)){
    $print.='<div class="section__errors">';
    if($data->stat=="access_granted") {
        $print.='<p class="section__errors_green">'.$data->msg.'</p>';
         }else{
        $print.='<p class="section__errors_red">'.$data->msg.'</p>';
        }
    $print.='</div>';
    }

if(isset($data->offer_balance)){
$print.='
	<form class="section__form" action="'.$_SERVER['REQUEST_URI'].'" method="post">
		<legend class="form__item">Статистика по офферу</legend>
		<div class="form__item">
			<button class="form__submit" name="date" value="1">День</button>
			<button class="form__submit" name="date" value="2">Месяц</button>
			<button class="form__submit" name="date" value="3">Год</button>
			<button class="form__submit" name="date" value="0">Все время</button>
		</div>
	</form>
    <div class="section__block">
		<p class="block__item">
			Получено денег за оффер: '.$data->offer_balance.' руб (С учетом комиссии: 20%).
		</p>
		<p class="block__item">
			Количество кликов по офферу: '.$data->offer_click.'
		</p>
	</div>
    <form  class="section__form" action="/offermaster/delete" method="post">
		<button class="form__submit" name="del" value="'.$data->offerid.'">Отписаться от оффера</button>
	</form>';
}
$print.='</section>';

if (empty($_SESSION['json'])&&empty($_POST['json'])){
	echo $print;
}else{
	$out=(object) array();
	$out->block=array('.section');
	$out->html=array($print);
	echo json_encode($out);
	$_SESSION['json']='0';
    exit;
}
