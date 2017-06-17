<?php
require_once 'init.php';

// セッション変数を全て解除する
$_SESSION = array();

//Cookieに保存してたSessionIDの保存期間を過去にして破棄
if (isset($_COOKIE[session_name()])){
	setcookie(session_name(), '', time()-42000, '/');
}

// セッションの破壊
session_destroy();

$signin_url = "signin.php";
header("Location: {$signin_url}");
?>