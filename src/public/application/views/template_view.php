<?php
$jsonsess=(!empty($_SESSION['json'])?$_SESSION['json']:'');
if (empty($jsonsess)&&empty($_POST['json'])){ ?>
<!DOCTYPE html> 
<html lang="ru"> 
<head> 
    <meta charset="utf-8"> 
    <title>Главная</title> 
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <script src="/js/script.js"></script>
</head> 
    <body class="page">
        <header class="page__header">
            <img class="logo" src="/images/SF-AdTech3.png" style="width: 300px; height: 30px;">
            <?php } $menu='<nav class="nav">
                <ul class="nav__ul">
                        <li class="nav__item"><a href="/">Главная</a></li>
                        <li class="nav__item"><a href="/contacts">Контакты</a></li>';
                        if(!empty($_SESSION["auth"])){
                            $menu.='<li class="nav__item"><a href="/admin/">Админка</a></li>';
                            if($_SESSION["role"]=='admin'){
                                $menu.='<li class="nav__item"><a href="/budget/">Статистика и бюджет</a></li>';
                                $menu.='<li class="nav__item"><a href="/edituser/">Пользователи</a></li>';
                            }
                            $menu.='<li class="nav__item">'.$_SESSION["runame"].' ('.$_SESSION["user"].') <a href="/admin/logout">Выход</a></li>';
                        }else{
                            $menu.='<li class="nav__item"><a href="/login">Вход</a></li>';
                        }   
                $menu.='</ul>
            </nav>';?>
            <?php if (empty($jsonsess)&&empty($_POST['json'])){
                echo $menu; 
            ?>
        </header>
        <main class="page__main">
            <?php } ?>
            <?php include 'application/views/'.$content_view; ?>
            <?php if (empty($jsonsess)&&empty($_POST['json'])){ ?>
        </main>
        <footer class="page__footer">
            <div class="footer__item">Приложение SF-AdTech</div>
            <div class="footer__item">Рушнов И.А. 2023</div>
        </footer>
    </body> 
</html>
<?php } ?>