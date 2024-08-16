<?php

$db_config = [ // конфигурация базы данных для подключения к ней 
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'db_name' => 'guestbook',
];

$db_options = [
    // PDO это класс, он поможет нам общаться с базой данных 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // эта строка кода говорит о том что Мы просим возвращать данные в видео ассиотивного массива. Если этого не написать данные будут возвращены сразу в нескольких форматах. 
    //PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // эта запись нужна для php 7 
];

// подключение к базе данных 
$dsn = "mysql:dbname={$db_config['db_name']};host={$db_config['host']};charset=utf8";

$db = new PDO($dsn, $db_config['user'], $db_config['password'], $db_options);
