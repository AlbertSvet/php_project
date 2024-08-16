<?php

session_start();
require_once __DIR__ . '/model/db.php';
require_once __DIR__ . '/model/functions.php';
require_once __DIR__ . '/vendor/autoload.php';

$titel = 'Авторизация';
// проверка авторизован ли пользователь. если авторизован тогда редирект на маил
if (check_auth()) {
    redirect('mail.php');
}

if($_POST) {
     $mass = [];
    foreach ($_POST as $key => $value) {
      
       $mass[$key] = trim($value);
     
    }
    Valitron\Validator::lang('ru'); // меняем язык ошибок 
    $v = new Valitron\Validator($mass);

    $v->labels([ // меняем лейблы ошибок
        'name' => 'Имя',
        'email' => 'Электронная почта',
        'password' => 'Пароль'
    ]);

    $v->rules([
        'required' => ['email', 'password'],
        'email' => 'email',
    ]);
    
    
    if($v->validate()) {
        if(login($mass)){
            redirect('mail.php');
            die;
        }
    }else{
        $_SESSION['errors'] = get_erorrs($v->errors());
        
    }
   
   
}


require_once __DIR__ . '/views/login.tpl.php';