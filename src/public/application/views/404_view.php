<?php $print='<section class="section">
    <h1 class="section__h1">404</h1>
    <h3 class="section__h3">Как Вы сюда попали?</h3>
    <a class="section__a" href="/">Перейти на главную</a>
</section>';


if (empty($_SESSION['json'])&&empty($_POST['json'])){
	echo $print;
}else{
    header('Content-Type', 'application/json');
	$out=(object) array();
	$out->block=array('.section');
	$out->html=array($print);
    if(empty($_SESSION['auth'])){
        $out->block[]='.nav';
        $out->html[]=$menu;
        $_SESSION['menu']='';
    }
    echo json_encode($out);
    $_SESSION['json']='0';
    exit;
}