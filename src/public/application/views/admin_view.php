<?php
$print='<section class="section">
    <div class="section__block">
        <h1 class="section__h1">Панель администрирования</h1>
        <div class="section__info">
            <div class="info__item">Вошли как: '.$data->nameRole.'</div>
            <div class="info__item">Ваш баланс: '.$data->balance.' руб</div>
        </div>
    </div>';
    if($_SESSION['role']!=='master'){$print.='<div class="section__add-offer"><a href="/offer/" class="add-offer__a" >Создать оффер</a></div>';}
    $print.='<form class="section__form" action="'.$_SERVER['REQUEST_URI'].'" method="post">
        <div class="form__item">
            <input type="text" name="offername" class="form__input" value="'. ((!empty($_POST['offername'])) ? (new postClear($_POST['offername']))->clear() : '').'" placeholder="Название оффера">
            <input type="text" name="offertheme" class="form__input" value="'.((!empty($_POST['offertheme'])) ? (new postClear($_POST['offertheme']))->clear() : '').'" placeholder="Тема оффера">
            <input type="submit" name="search" class="form__submit" value="Найти">
        </div>
        <div class="form__nav">';
            if(($data->prevpage!=='')&&(($data->nextpage)!==1)){$print.='<button name="page" class="form-nav__item" value="'.$data->prevpage.'">Предыдущая</button>';}
            if(!empty($data->nextpage)){$print.='<button name="page" class="form-nav__item" value="'.$data->nextpage.'">Следующая</button>';}
        $print.='</div>
    </form>';
    $print.='<div class="section__table">
        <div class="table__row">
            <div class="table__btn">Действия</div>
            <div class="table__id">id</div>
            <div class="table__name">Название</div>
            <div class="table__theme">Тема</div>
            <div class="table__price">Цена</div>
            <div class="table__url">URL</div>';
            if($_SESSION['role']=='admin'){$print.='<div class="table__userid">id автора</div>';}
            $print.='<div class="table__date">Дата</div>
            <div class="table__active">Статус</div>
        </div>';
    if(!empty($data->table)){ foreach($data->table as $item){
        $print.='<div class="table__row">';
            foreach($item as $key=>$value){ 
                if($key=='id'){$print.='<div class="table__btn">';if($item->userid==$_SESSION['userid']||$_SESSION['role']!=='advert'){$print.='<a href="/'.$data->parturl.'/'.$value.'">'.$data->parturlname.'</a>';}$print.='</div>';}
                if($key=='active'){$print.='<div class="table__active">'.(($value==1)?'Актив':'<span style="color:red;">Не акт</span>').'</div>'; continue;}
                if($key=='date'){$print.='<div class="table__date">'.date('d.m.Y', $value).'</div>'; continue;}
                if($key=='userid'){if($_SESSION['role']=='admin'){$print.='<div class="table__userid">'.$value.'</div>';} continue;}
                $print.='<div class="table__'.$key.'">'.$value.'</div>';
            }
            $print.='</div>';
    }}else{$print.='<div class="table__row">Нет ни одного оффера</div>';} 
    $print.='</div>';
        if($_SESSION['role']!=='admin'){$print.='<form action="/admin/'.$data->formaction.'" class="section__form" method="post">
            <button name="userid" class="form__submit" value="1">'.(($data->formaction=='search')?'Показать все офферы':'Показать мои офферы').'</button>
        </form>';
        }
$print.='</section>';


if (empty($_SESSION['json'])&&empty($_POST['json'])){
	echo $print;
}else{
	$out=(object) array();
	$out->block=array('.section');
	$out->html=array($print);
    if($_SESSION['menu']=='update'){//посмотрим referer, если он со страницы login - обновим меню
        $out->block[]='.nav';
        $out->html[]=$menu;
        $_SESSION['menu']='';
    }
    echo json_encode($out);
    $_SESSION['json']='0';
    exit;
}
