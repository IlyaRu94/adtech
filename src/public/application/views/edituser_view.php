<?php
$print='<section class="section">
		<h1 class="section__h1">Управление пользователями</h1>';
if(!empty($data->all)){
$print.='<div class="section__add-offer"><a href="/edituser/edit/" class="add-offer__a" >Добавить пользователя</a></div>
		<div class="section__table">
		<div class="table__row">
			<div class="table__btn">Кнопки</div>
			<div class="table__btn"></div>
			<div class="table__id">id польз.</div>
			<div class="table__login">Логин</div>
			<div class="table__balance">Баланс</div>
			<div class="table__active">Актив.</div>
			<div class="table__is_admin">Админ</div>
			<div class="table__ip">ip посл. входа</div>
			<div class="table__name">Никнейм</div>
			<div class="table__datetime">Дата посл. входа</div>
		</div>';
	foreach($data->all as $key=>$val){
		$print.='<div class="table__row">';
		foreach($val as $k=>$v){
			if($k=='password'){continue;}
			if($k=='is_admin'||$k=='active'){
				$print.='<div class="table__'.$k.'">'.(($v==0)?'нет':'да').'</div>';
				continue;
			}
			if($k=='id'){
				$print.='<div class="table__btn"><a href="/edituser/edit/'. $v.'">Изменить</a></div>
				<form class="table__btn" action="/edituser/delete" method="post">
					<button class="table-form__button" name="del" value="'. $v.'">Удалить</button>
				</form>';
			} 
			if($k=='datetime'){
				$print.='<div class="table__datetime">'.date('d.m.Y H:i:s', $v).'</div>'; continue;
			}
			$print.='<div class="table__'.$k.'">'.$v.'</div>';
		}
		$print.='</div>';
	}
	$print.='</div>';
}else{
	$print.='<form class="section__form" action="/edituser/edit/'.(!empty($data->one->id)?$data->one->id:'').'" method="post">
		<legend class="form__item">Введите данные пользователя</legend>
			<div class="form__item">
				<label for="login" class="form__label">Логин</label>
				<input type="text" class="form__input" name="login" id="login" value="'.(!empty($data->one->login)?$data->one->login:'').'">
			</div>
			<div class="form__item">
				<label for="password" class="form__label">Пароль</label>
				<input type="password" class="form__input" name="password" id="password" value="">
			</div>
			<div class="form__item">
				<label for="balance" class="form__label">Баланс лицевого счета</label>
				<input type="number" step="0.01" min="0" placeholder="0,00" class="form__input" name="balance" id="balance" value="'.(!empty($data->one->balance)?$data->one->balance:0).'">
			</div>
			<div class="form__item">
				<label for="name" class="form__label">Никнейм пользователя</label>
				<input type="text" class="form__input" name="name" id="name" value="'.(!empty($data->one->name)?$data->one->name:'').'">
			</div>
			<div class="form__item">
				<label for="active" class="form__label">Аккаунт активирован</label>
				<select class="form__input" name="active" id="active">
					<option value="'.(!empty($data->one->active)?$data->one->active:0).'">'.(!empty($data->one->active)?'Да':'Нет').'</option>
					<option value="0">0 - Нет</option>
					<option value="1">1 - Да</option>
				</select>
			</div>
			<div class="form__item">
				<label for="is_admin" class="form__label">Назначить администратором</label>
				<select class="form__input" name="is_admin" id="is_admin">
					<option value="'.(!empty($data->one->is_admin)?$data->one->is_admin:0).'">'.(!empty($data->one->is_admin)?'Да':'Нет').'</option>
					<option value="0">0 - Нет</option>
					<option value="1">1 - Да</option>
				</select>
			</div>
			<div class="form__item-center">
				<input type="hidden" name="tkn" class="form__input" id="tkn" value="'.$_SESSION['tkn'].'">
				<input type="submit" class="form__submit" value="Сохранить" name="btn">
			</div>
		</form>
		<div class="section__result"></div>';
		$err='';
	if(!empty($data->status)) {
		$err.='<div class="section__errors">
			<p class="section__errors_white">'.$data->status.'</p>
		</div>';
	}
}

$print.=$err;
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