<?php
require_once('Db.php');


// проверка соединения с базой данных 

try {
    $connection = new PDO("mysql:host={$params['host']};charset={$params['charset']}", $params['user'], $params['password']);
}
catch ( PDOException $e) {
    echo "Невозможно установить соединение с базой данных";
    exit();
}

// проверка наличия текстового sql-файла

if (!file_exists($params['dbFileName'])) {
    // Файл с данными отсутствует
    echo "Файл БД ".$params['dbFileName']." не обнаружен";    
}
else {
    // Файл БД найден
    echo "Файл БД обнаружен и готов к установке";
    ?>
    <form method="post" action="import.php">
        <input type="submit" name="install" value="Установить">
    </form>
    <?php
}

?>
