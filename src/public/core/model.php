<?php
    require_once 'rb.php';
	R::setup('mysql:host=mysql:3306;dbname=adtech', 'user1', 's123');
	    try{
        $db = new PDO('mysql:host=mysql:3306;dbname=adtech','user1','s123');
    } catch(PDOException $e){
        echo $e->getmessage();
    }
class Model
{
	// метод выборки данных
	public function get_data()
	{
		// todo
	}
}
