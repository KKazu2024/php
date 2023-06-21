<?php
//URL直打ちチェック
if(!isset($_GET['id'])){
	header('Location: index.php');
  	exit;
}

require_once('product.php');
$id = $_GET['id'];

//削除処理
deleted($id);

session_start();
$_SESSION['success'] = '商品を削除しました。';
header('Location: index.php');