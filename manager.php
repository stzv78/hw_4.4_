<?php
require_once 'classes/DataBase.php';
session_start();

//авторизованный пользователь
$user = $_SESSION['login'];
$user_id = $_SESSION['user_id'];

$objDb = new DataBase;


if (isset($_POST['action'])) {
	$action = isset($_POST['action']) ? 'create': "";
    $name = $_POST['name'];
	} else {
        $_GET['name'] = isset($_GET['name']) ? filter_input(INPUT_GET, 'name', FILTER_SANITIZE_SPECIAL_CHARS) : '';
        $_GET['field'] = isset($_GET['field']) ? filter_input(INPUT_GET, 'field', FILTER_SANITIZE_SPECIAL_CHARS) : '';
        $_GET['type'] = isset($_GET['type']) ? filter_input(INPUT_GET, 'type', FILTER_SANITIZE_SPECIAL_CHARS) : 'NULL';
        $_GET['rename'] = isset($_GET['rename']) ? filter_input(INPUT_GET, 'rename', FILTER_SANITIZE_SPECIAL_CHARS) : 'NULL';
        $_GET['newType'] = isset($_GET['newType']) ? filter_input(INPUT_GET, 'newType', FILTER_SANITIZE_SPECIAL_CHARS) : 'NULL';
        $action = isset($_GET['action']) ? filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS) : '';
    }
    
switch ($action) {
    case 'create':
        //создаем таблицу 
        if (!ctype_space($name)){
            $objDb->createTable($name);
            } else {
            echo "<p style='color: red;'>Некорретный ввод имени таблицы!</p>";
        }
        break;
    case 'dropColumn':
        //удалить стоблец
        $objDb->dropColumn($_GET['name'], $_GET['field']);
        break;
    case 'editColumnType':
        //изменяем тип поля
        $objDb->editColumnType($_GET['name'], $_GET['field'], $_GET['newType']);
        break;
    case 'renameColumn':
        //переименовываем столбец
        $objDb->renameColumn($_GET['name'], $_GET['field'], $_GET['rename'], $_GET['type']);
        break;
}

//получаем список всех таблиц в БД
$tableList = $objDb->showTables();

//выводим список таблиц
if ($tableList) {
    include_once "tmpl.php";
    } else {
    echo '<h4>Нет таблиц в базе данных " '. $objDb->dbname . '":</h4>';
}
?>