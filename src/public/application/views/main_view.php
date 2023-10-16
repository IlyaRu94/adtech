<?$print='<section class="section">
    <h1 class="section__h1">SF-adtech</h1> 
    <div class="section__info">
        <div class="section-info__item">
            <img class="section-info-item__img" src="/images/screen_sf-adtech.jpg">
            <p class="section-info-item__p">SF-adtech — Уникальная платформа, для размещения офферов, в которой каждый пользователь выбирает для себя сам, быть сегодня Рекламодателем или Мастером.<br>На платформе для ролей мастер и рекламодатель один лицевой счет.<br>При нехватке денег, рекламодатель всегда может войти на потрал как мастер, взять несколько офферов партнеров и тем самым заработать. </p>
        </div>
        <div class="section-info__item">
            <p class="section-info-item__p">Прозрачная система оплаты. За вывод средств со счета, комиссия составляет всего 20%. Никаких скрытых платежей! Статистику по переходам и количество мастеров, подписанных на оффер можно посмотреть в разрезе за день, месяц, год и все время</p>
            <img class="info-item__img" src="/images/screen_sf_ad_master.jpg">
        </div>
        <div class="section-info__item">
            <p class="info-item__p">Все рассчеты просты. Если переход по ссылке был осуществлен - будет произведена оплата. В любых спорных ситуациях всегда за более делатьной статистикой можно обратиться к администратору.</p>
        </div>
        <div class="section-info__item">
            <div class="section-info__img">
                <img class="img__item" src="/images/screen_admin_sf-adtech.jpg" width="80%" height="auto" >
            </div>
        </div>
        <div class="section-info__item">
            <p class="info-item__p">SF-adtech — команда первоклассных специалистов в области продвижения сайтов с многолетним опытом... </p>
        </div>
    </div>
</section>';

if (empty($_SESSION['json'])&&empty($_POST['json'])){
	echo $print;
}else{
	$out=(object) array();
	$out->block=array('.section');
	$out->html=array($print);
    if(empty($_SESSION['auth'])){//Обновим меню, вдруг у нас выход был или 404
        $out->block[]='.nav';
        $out->html[]=$menu;
    }
    echo json_encode($out);
    $_SESSION['json']='0';
    exit;
}
