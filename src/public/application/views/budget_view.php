<section class="section">
	<h1 class="section__h1">Статистика и бюджет системы</h1>
	<div class="section__block">
		<p class="block__item">
			Заработок платформы: <?php echo $data->balance_platform; ?> руб.
		</p>
		<p class="block__item">
			Общая сумма денежного оборота: <?php echo $data->balance; ?> руб.
		</p>
		<p class="block__item">
			Количество кликов: <?php echo $data->count; ?>
		</p>
	</div>
	<div class="section__block-info">
		<h2 class="block-info__h2">Расшифровка статусов</h2>
		<p class="block-info__item">5 - Ссылка выдана, переход совершен </p>
		<p class="block-info__item">4 - Мастер заблокирован администратором, переход не совершен, ссылка не выдана, деньги не начислены</p>
		<p class="block-info__item">3 - Рекламодатель заблокирован администратором, переход не совершен, ссылка не выдана, деньги не начислены</p>
		<p class="block-info__item">2 - Оффер отсутствует в списке мастера, мастер отписан от оффера, переход не совершен, ссылка не выдана, деньги не начислены</p>
		<p class="block-info__item">1 - Оффер деактивирован рекламодателем, переход не совершен, ссылка не выдана, деньги не начислены</p>
	</div>
	<div class="section__table">
<?php if(!empty($data->all)){ ?>
		<div class="table__row">
			<div class="table__id">id записи</div>
			<div class="table__masteruserid">id Мастера</div>
			<div class="table__date">Дата</div>
			<div class="table__status">Статус</div>
			<div class="table__url">Реферальный хэш url</div>
			<div class="table__offerid">id оффера</div>
			<div class="table__price">Цена клика</div>
		</div>
<?php foreach($data->all as $key=>$val){ ?>
		<div class="table__row">
	<?php foreach($val as $k=>$v){
			if($k=='date'){ echo '<div class="table__date">'.date('d.m.Y H:i:s', $v).'</div>'; continue;}
			echo '<div class="table__'.$k.'">'.$v.'</div>';
		} ?>
		</div>
	<?php } 
	}else{ ?>
		<div class="table__row">Записи не найдены</div>
	<?php } ?>
		</div>
	<form class="section__form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
		<div class="form__nav">
		<?php
				if(($data->prevpage!=='')&&(($data->nextpage)!==1)){echo '<button name="page" class="form-nav__item" value="'.$data->prevpage.'">Предыдущая</button>';}
				if(!empty($data->nextpage)){echo '<button name="page" class="form-nav__item" value="'.$data->nextpage.'">Следующая</button>';}
		?>
		</div>
		<legend class="form__item">Фильтр</legend>
		<div class="form__item">
			<label for="date" class="form__label">Отображать за последние (дней)</label>
			<input type="number" class="form__input" name="date" min="0" id="date" value="<?php echo (!empty($_POST['date'])?$_POST['date']:''); ?>"> 
		</div>
		<div class="form__item">
			<label for="url" class="form__label">Реферальный хэш url</label>
			<input type="text" class="form__input" name="url" id="url" value="<?php echo (!empty($_POST['url'])?$_POST['url']:''); ?>">
		</div>
		<div class="form__item">
			<label for="masteruserid" class="form__label">id мастера</label>
			<input type="number" class="form__input" min="0" name="masteruserid" id="masteruserid" value="<?php echo (!empty($_POST['masteruserid'])?$_POST['masteruserid']:''); ?>">
		</div>
		<div class="form__item">
			<label for="offerid" class="form__label">id Оффера</label>
			<input type="number" class="form__input" min="0" name="offerid" id="offerid" value="<?php echo (!empty($_POST['offerid'])?$_POST['offerid']:''); ?>">
		</div>
		<div class="form__item">
			<label for="price" class="form__label">Цена перехода дороже</label>
			<input type="text" class="form__input" name="price" id="price" step="0.01" min="0" placeholder="0,00" value="<?php echo (!empty($_POST['price'])?$_POST['price']:''); ?>">
		</div>
		<div class="form__item">
			<label for="status" class="form__label">Статус</label>
			<select class="form__input" name="status" id="status">
				<option value="<?php echo (!empty($_POST['status'])?$_POST['status']:''); ?>"><?php echo (!empty($_POST['status'])?$_POST['status']:''); ?></option>
				<option value="0">0 - Все статусы</option>
				<option value="5">5 - Ссылка выдана, переход совершен</option>
				<option value="4">4 - Мастер заблокирован администратором</option>
				<option value="3">3 - Рекламодатель заблокирован администратором</option>
				<option value="2">2 - Оффер отсутствует в списке мастера</option>
				<option value="1">1 - Оффер деактивирован рекламодателем</option>
			</select>
		</div>
		<div class="form__item-center">
			<input type="submit" class="form__submit" value="Найти" name="btn">
		</div>
	</form>
</section>