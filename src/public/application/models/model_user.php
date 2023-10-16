<?php
class User{
  private $user;
  private $pass;
  private $name;
  private $is_admin;
    public function __construct($user, $pass,$name,$is_admin=0){
        $this->user = $user;
        $this->pass = $pass;
        $this->name = $name;
        $this->is_admin = $is_admin;
      }

      public function setRegisterUser(){    
        $stat=(object) array();
        if( User::getCheckUser()->found =='1')  {
          $stat->status= '0';
          $stat->msg='Пользователь существует, придумайте другой логин или авторизуйтесь';
          return $stat;
        }else{
          $user = R::dispense('users'); //передаем название таблицы users	
          $user->login = $this->user;
          $user->password = password_hash($this->pass,PASSWORD_DEFAULT);
          $user->balance = '0';
          $user->is_admin = $this->is_admin;
          $user->ip = $_SERVER['REMOTE_ADDR'];
          $user->datetime = time();
          $user->name = $this->name;
          R::store($user); // сохраняем объект $user в таблице
          $stat->status= '1';
          $stat->msg='Новый пользователь создан. Дождитесь активации аккаунта администратором';
          return $stat;
        }
      }

      public function getCheckUser(){
        $userAcc=R::findOne('users', "login = ? ", [$this->user]);
        if($userAcc)  {
          if (password_verify ($this->pass,$userAcc->password)) {
            if($userAcc->active==1)  {
              if($userAcc->is_admin==1)  {
                return User::returnRequest($userAcc->login,$userAcc->id,true,true,'Авторизация прошла успешно',$userAcc->name,$userAcc->is_admin);
              }
              return User::returnRequest($userAcc->login,$userAcc->id,true,true,'Авторизация прошла успешно',$userAcc->name);
            }
            return User::returnRequest('','',true,false,'Пользователь заблокирован, обратитесь к администратору','');
          }
          return User::returnRequest('','',true,false,'Неверный логин или пароль','');
        }
        return User::returnRequest('','',false,false,'Пользователь не найден','');
      }

      private function returnRequest($user,$userid,$found,$auth,$sms,$name,$is_admin=0){
        $userdb=(object) array();
        $userdb->user=$user;
        $userdb->is_admin=$is_admin;
        $userdb->userid=$userid;
        $userdb->name=$name;
        $userdb->found=$found;
        $userdb->auth=$auth;
        $userdb->sms=$sms;
        return $userdb;
      }
}

?>