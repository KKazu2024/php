<?php
session_start();
//URL直打ちチェック
if(!isset($_POST['name'],$_POST['price'])){
	header('Location: index.php');
	exit;
}

//必須入力チェック
if($_POST['name'] == '' || $_POST['price'] == ''){
	$_SESSION['error'] = '※商品名及び単価は必須入力です。';
	header('Location: create.php');
	exit;
}

//正規表現チェック
if(!preg_match("/^[0-9]+$/", $_POST['price'])){
	$_SESSION['error'] = '※単価は半角数字で入力してください。';
	header('Location: create.php');
	exit;
}

require_once("product.php");
$name = $_POST['name'];
$price = $_POST['price'];

//指定取得
entry($name, $price);

$_SESSION['success'] = '商品の登録が完了しました。';
header('Location: create.php');
