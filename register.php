<?php

session_start();
require_once __DIR__ . '/model/db.php';
require_once __DIR__ . '/model/functions.php';
require_once __DIR__ . '/vendor/autoload.php';

$titel = 'Регистрация';

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
        'required' => ['name', 'email', 'password'],
        'email' => 'email',
        'lengthMin' => [
            ['password', 4]
        ],
        'lengthMax' => [
            ['name',20],
            ['email',20]
        ]
    ]);
    
    // обработка обычного POST запроса Так же у самой формы должны быть указан атрибут метод POST и у кнопки submit
    if($v->validate()) {
        if(register($mass)){
            redirect('login.php');
            die;
        }
    }else{
            
        $_SESSION['errors'] = get_erorrs($v->errors());
        // dump($v->errors());
        
    }
// ========================================================
    // обработка AJAX запроса 
    // if ($v->validate()) {
    //     if (register($mass)) {
                    // можно вернуть текстовый ответ 
                    // echo 'Регистрация успешна';
    //         // можно  вернуть JSON-ответ для успешной регистрации
    //         echo json_encode(['status' => 'success', 'redirect' => 'login.php']);
    //         die;
    //     }
    // } else {
    //     // можно вернуть текстовый ответ
    //     // echo 'Ошибка рег';

    //     // Возвращаем JSON-ответ с ошибками
    //     // записываем ошибки в сессию
    //     $_SESSION['errors'] = get_erorrs($v->errors());
    //     // отправляем редирект адрес той же страницы для того чтобы перезагрузить страницу, чтобы показать выводи ошибок из массива SESSION        
    //     echo json_encode(['status' => 'error', 'redirect' => 'register.php']);
        
    //      // можно вернуть JSON-объект с ошибками для обработки их на клиенте
    //     //  echo json_encode(['status' => 'error', 'errors' => $v->errors()]);
    //     die;
   
    // }
   
   
}
// dump($name);
require_once __DIR__ . '/views/register.tpl.php';