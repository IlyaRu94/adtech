<?php
$err='';
if(!empty($data->login_status)){
$err.='<div class="section__errors">';
if($data->login_status=="access_granted") {
	$err.='<p class="section__errors_green">'.$data->sms.'</p>';
	 } else { $err.='<p class="section__errors_red">'.$data->sms.'</p>'; }
$err.='</div>';
}
if(!empty($_POST['json']) && !empty($err)){ // Если есть json в запросе и есть ошибка - выдадим ее как json объект
	$out=(object) array();
	$out->block=array('.section__result','#tkn');
	$out->html=array('<div class="section__result">'.$err.'</div>','<input type="hidden" name="tkn" id="tkn" class="form__input" value="'.$_SESSION["tkn"].'">');
	echo json_encode($out);
}else{
?>
<section class="section">
	<h1 class="section__h1">Страница авторизации</h1>
	<form class="section__form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
		<legend class="form__item">Авторизация</legend>
		<div class="form__item-center">
			<label for="login" class="form__label">Логин</label>
			<input type="text" class="form__input" name="login" id="login">
		</div>
		<div class="form__item-center">
			<label for="password" class="form__label">Пароль</label>
			<input type="password" class="form__input" name="password" id="password">
		</div>
		<div class="form__item-center">
			<label for="role" class="form__label">Роль</label>
			<select class="form__input" name="role" id="role">
			<option value="advert">Рекламодатель</option>
			<option value="master">Мастер</option>
			</select>
		</div>
		<div class="form__item-center">
			<input type="hidden" name="tkn" id="tkn" class="form__input" value="<?php echo $_SESSION["tkn"]; ?>">
			<input type="submit" class="form__submit" value="Войти" name="btn">
		</div>
		<div class="form__item-center">
			<a class="form__a" href="/register">Зарегистрироваться</a>
		</div>
		<div id="result"></div>
	</form>
	<div class="section__result"><?php echo $err; ?></div>
</section>
<?php } ?>