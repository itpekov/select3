<?php
$paramsPath = 'db_params.php';
$params = include($paramsPath);

function ConnectAsPDO()
{
	try {
		$paramsPath = 'db_params.php';
		$params = include($paramsPath);

		$connection = new PDO("mysql:dbname={$params['dbname']};host={$params['host']};charset={$params['charset']}", $params['user'], $params['password']);

		return $connection;
	}
	catch ( PDOException $e) {
		echo "Невозможно установить соединение с базой данных";
		exit();
	}
}
