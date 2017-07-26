<?php
require_once 'classes/DataBase.php';

    if (!empty($_POST['login']) && (!empty($_POST['password']))) {
        $login = htmlspecialchars(stripslashes($_POST['login']));
        $password = htmlspecialchars(stripslashes($_POST['password']));
        $objDb = new DataBase;  
  
       //шифруем пароль пользователя
       // $salt1 = '#3@as';
       // $salt2 = 'fdy!@';
       //$password = hash('ripemd128', "$salt1$password$salt2");

        $user_id = getUser($objDb, $login, $password);
            
        if (isset($_POST['sign_in'])) { 
            //если вход:
            //проверяем пользователя по базе
            if ($user_id) { 
                sessionStart($login, $user_id);
                header('Location: manager.php');
            } else {
                die("<p>Пользователь c таким логином/паролем не зарегистрирован!  <a href='login.php'> Зарегистрироваться</a></p>");
            }
        } elseif (isset($_POST['register'])) { 
            //если регистрация:
            //проверяем пользователя по базе
            if ($user_id) { 
                die("<p>Пользователь с таким именем уже существует!  <a href='login.php'>Зарегистрироваться</a></p>");
            } else {
                //добавляем нового пользователя в базу
                registerNewUser($objDb, $login, $password);
                $user_id = getUser($objDb, $login, $password);
                sessionStart($login, $user_id);
                header('Location: manager.php');
            } 
        }
    } else {
        die("<p>Вы не авторизованы!  <a href='login.php'>Войти/Зарегистрироваться</a></p>");
    }

function getUser($objDb, $login, $password) {   
    //ищем пользователя в таблице пользователей
    $data = $objDb->selectUser($login, $password);
    if (empty($data)) {
        return FALSE;//пользователь не зарегистрирован или логин/пароль введен неверно
    } else {
        return $data['id'];
    }
}

function sessionStart($login, $user_id) {
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['user_id'] = $user_id;
}

function registerNewUser($objDb, $login, $password) {
    if ((!ctype_space($login)) || (!ctype_space($password))) {
        $objDb->insertUser($login, $password);
    } else {
        die("<p style='color: red;'>Некорретный ввод логина/пароля!<a href='login.php'>Войти/Зарегистрироваться/Войти</a></p>");
    }
}

?>