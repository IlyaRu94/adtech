<section class="section">
    <h1 class="section__h1">Подробная информация об оффере</h1>
    <div class="section__table">
        <div class="table__row">
            <div class="table__th">Название оффера</div>
            <div class="table__td"><?php echo $data->offername; ?></div>
        </div>
        <div class="table__row">
            <div class="table__th">Тема оффера</div>
            <div class="table__td"><?php echo $data->offertheme; ?></div>
        </div>
        <div class="table__row">
            <div class="table__th">id оффера</div>
            <div class="table__td"><?php echo $data->offerid; ?></div>
        </div>
        <div class="table__row">
            <div class="table__th">url оффера</div>
            <div class="table__td"><?php echo $data->offerurl; ?></div>
        </div>
        <div class="table__row">
            <div class="table__th">Стоимость перехода</div>
            <div class="table__td"><?php echo $data->offerprice; ?> руб. (Комиссия за вывод средств: 20%)</div>
        </div>
        <div class="table__row">
            <div class="table__th">Имя рекламодателя</div>
            <div class="table__td"><?php echo $data->offeradvertname; ?> (id:<?php echo $data->offeruserid; ?>)</div>
        </div>
        <div class="table__row">
            <div class="table__th">Реферальный url</div>
            <div class="table__td"><?php echo $data->masterurl; ?></div>
        </div>
    </div>

<?php if(!empty($data->stat)){ ?>
    <div class="section__errors">
    <?php if($data->stat=="access_granted") { ?>
        <p class="section__errors_green"><?php echo $data->msg; ?></p>
        <?php }else{ ?>
        <p class="section__errors_red"><?php echo $data->msg; ?></p>
        <?php } ?>
    </div>
<?php } 
if(isset($data->offer_balance)){ ?>
	<form class="section__form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
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
			Получено денег за оффер: <?php echo $data->offer_balance; ?> руб (С учетом комиссии: 20%).
		</p>
		<p class="block__item">
			Количество кликов по офферу: <?php echo $data->offer_click; ?>
		</p>
	</div>
    <form  class="section__form" action="/offermaster/delete" method="post">
		<button class="form__submit" name="del" value="<?php echo $data->offerid; ?>">Отписаться от оффера</button>
	</form>
<?php } ?>
</section>