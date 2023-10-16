<?php $print='<section class="section">
<h1 class="section__h1">Страница регистрации</h1>
<form class="section__form" action="'.$_SERVER['REQUEST_URI'].'" method="post">
	<legend class="form__item">Регистрация</legend>
	<div class="form__item-center">
		<label for="login" class="form__label">Логин</label>
		<input type="text" class="form__input" name="login" id="login">
	</div>
	<div class="form__item-center">
		<label for="password" class="form__label">Пароль</label>
		<input type="password" class="form__input" name="password" id="password">
	</div>
	<div class="form__item-center">
		<label for="runame" class="form__label">Никнейм</label>
		<input type="text" class="form__input" name="runame" id="runame">
	</div>
	<div class="form__item-center">
		<input type="hidden" name="tkn" id="tkn" class="form__input" value="'.$_SESSION["tkn"].'">
		<input type="submit" class="form__submit" value="Зарегистрироваться" name="btn">
	</div>
	<div class="form__item-center">
		<a class="form__a" href="/login">Войти</a>
	</div>
</form><div class="section__result"></div>';

$err='';
if(!empty($data->sms)){
	$err.='<div class="section__errors">';
	if($data->login_status=="access_granted") {
		$err.='<p class="section__errors_green">'.$data->sms.'</p>';
		 } else { $err.='<p class="section__errors_red">'.$data->sms.'</p>'; }
		$err.='</div>';
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
	}