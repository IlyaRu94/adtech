<section class="section">
	<h1 class="section__h1">О нас</h1>
	<div class="section__info">
		<p class="section-info__p">SF-AdTech — удобный сервис для автоматизации маркетинга. Мы помогаем повышать продажи товаров, работ, услуг.</p>
		<p class="section-info__p">Также с SF-AdTech можно:</p>
		<ul class="section-info__ul">
			<li class="section-info-ul__item">привлечь посетителей на свой сайт</li>
			<li class="section-info-ul__item">популяризировать свой ресурс среди Web-мастеров и разработчиков</li>
			<li class="section-info-ul__item">Web-мастера и разработчики могут заработать, размещая офферы на различных площадках</li>
		</ul>
		<p class="section-info__p">Мы работаем в России и Беларуси, поэтому все возможности SF-AdTech можно использовать без ограничений.</p>
	</div>
	<h2 class="section__h2">Контакты</h2>
	<img src="/images/SF-AdTech2.jpg" width="350" align="right">
<?php
		foreach($data as $row){
			echo '<ul class="table-list"><li class="table-list__item">Партнер: '.$row['name'].'</li><li class="table-list__item">Адрес: '.$row['adress'].'</li><li class="table-list__item">Email: '.$row['email'].'</li></ul>';
		}
?>
	<h2 class="section__h2">Как работает сервис</h2>
	<div class="section__servis">
		<p class="section-servis__p">Серверы SF-AdTech находятся на территории России. Мы выкупили права на программное обеспечение у зарубежных поставщиков, а часть компонентов заменили на локальные разработки.</p>
	</div>
</section>