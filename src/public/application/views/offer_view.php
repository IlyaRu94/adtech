<?php $print='<section class="section">
	<h1 class="section__h1">Страница создания и редактирования оффера</h1>
	<form class="section__form" action="'.$_SERVER['REQUEST_URI'].'" method="post">
		<legend class="form__item">Заполните информацию об оффере</legend>
		<div class="form__item">
			<label for="offername" class="form__label">Имя</label>
			<input type="text" class="form__input" name="offername" id="offername" value="'.$data->offername.'">
		</div>
		<div class="form__item">
			<label for="offerprice" class="form__label">Цена</label>
			<input type="number" class="form__input" step="0.01" min="0" placeholder="0,00" name="offerprice" id="offerprice" value="'.$data->offerprice.'">
		</div>
		<div class="form__item">
			<label for="offertheme" class="form__label">Тема</label>
			<input type="text" class="form__input" name="offertheme" id="offertheme" value="'.$data->offertheme.'">
		</div>
		<div class="form__item">
			<label for="offerurl" class="form__label">url</label>
			<input type="text" class="form__input"  name="offerurl" id="offerurl" value="'.$data->offerurl.'" >
		</div>';
		if($_SESSION['role']=='admin'){
			$print.='<div class="form__item">
				<label for="userid" class="form__label">id пользователя</label>
				<input type="text" id="userid" class="form__input" name="userid" value="'.((empty($data->userid))?$_SESSION['userid']:$data->userid).'" >
			</div>';
		}
		$print.='<div class="form__item-center">
			<label for="offeractive" class="form__label">Активный</label>
			<input type="checkbox" id="offeractive" name="offeractive" value="1" '.(($data->offeractive=='1')?'checked':'').' >
		</div>';

		$print.='<div class="form__item-center">
			<input type="hidden" name="tkn" class="form__input" id="tkn" value="'.$_SESSION["tkn"].'">
			<input type="submit" class="form__submit" value="Сохранить" name="btn">
		</div>
	</form><div class="section__result"></div>';
	$err='';
	if(!empty($data->msg)){
		$err.='<div class="section__errors">
			<p class="section__errors_white">'.$data->msg.'</p>
		</div>';
	}
	$print.=$err;
if(!empty($data->offername)){
$print.='
	<form class="section__form" action="'.$_SERVER['REQUEST_URI'].'" method="post">
		<legend class="form__item">Статистика по офферу</legend>
		<div class="form__item">
			<button class="form__submit" name="date" value="1">День</button>
			<button class="form__submit" name="date" value="2">Месяц</button>
			<button class="form__submit" name="date" value="3">Год</button>
			<button class="form__submit" name="date" value="0">Все время</button>
		</div>
	</form>';
	$print.='<div class="section__block">
		<p class="block__item">
			Израсходовано денег на оффер за период: '.$data->offer_balance.' руб.
		</p>
		<p class="block__item">
			Количество кликов по офферу: '.$data->offer_click.'
		</p>
		<p class="block__item">
			Количество мастеров, использующих оффер: '.$data->offer_master_count.'
		</p>
	</div>
	<form  class="section__form" action="/offer/delete" method="post">
		<button class="form__submit" name="del" value="'.$data->offerid.'">Удалить оффер</button>
	</form>';
}
$print.='</section>';

if (empty($_SESSION['json'])&&empty($_POST['json'])){
	echo $print;
}else{
	$out=(object) array();
	$out->block=array('.section');
	$out->html=array($print);
	if(!empty($err)){
		$out->block=array('.section__result','#tkn');
		$out->html=array('<div class="section__result">'.$err.'</div>','<input type="hidden" name="tkn" id="tkn" class="form__input" value="'.$_SESSION["tkn"].'">');
	}
	echo json_encode($out);
	$_SESSION['json']='0';
    exit;
}
