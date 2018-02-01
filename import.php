<?php
require_once('Db.php');

// Была нажата кнопка установить
if (isset( $_REQUEST['install'])) {
    
    // Соединение с сервером
    $db = mysqli_connect($params['host'], $params['user'], $params['password']) or die('Ошибка подключения к MySQL серверу: ' . mysql_error());

    // Временная переменная для хранения строки файла
    $templine = '';
    // Читаем файл
    $lines = file($params['dbFileName']);
    // Проход построчно
    foreach ($lines as $line) {
        // пропускаем комментарии
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Добавляем строку к запросу
        $templine .= $line;
        // Если ; то это конец запроса
        if (substr(trim($line), -1, 1) == ';') {
            // Запрос к БД
            mysqli_query($db,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error() . '<br /><br />');
            // Стираем временную строку
            $templine = '';
        }
    }
}

// Переходим на страницу с формами
header("Location: view.php");