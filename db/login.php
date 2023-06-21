<?php
session_start();
//URL直打ちチェック
if(!isset($_POST['id'],$_POST['password'])){
	$_SESSION['error'] = 'ログインしてください。';
	header('Location: index.php');
  exit;
}

//必須入力チェック
if($_POST['id'] == '' || $_POST['password'] == ''){
	$_SESSION['error'] = 'ID及びPasswordは必須入力です。';
	header('Location: index.php');
	exit;
}

//入力データ取得
$id = $_POST['id'];
$password = $_POST['password'];

//DB情報読込
require('db_config.php');

try{
	//DB接続
  	$pdo = new PDO($dsn, $db_user, $db_pass);
  	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  	//SQL文
  	$sql = "SELECT * FROM kadai03_users WHERE id = :id";
  	$prepare = $pdo->prepare($sql);
  	$prepare->bindValue(':id', $id);

  	//SQL実行
 	$prepare->execute();
	$user = $prepare->fetch(PDO::FETCH_ASSOC);

	//承認
	$success = false;
	if(password_verify($password, $user['password'])){
		$success = true;
	}

	//画面遷移
	if($success){
		$_SESSION['id'] = $_POST['id'];
		header('Location: mypage.php');
		exit;
	}else{
		$_SESSION['error'] = 'IDまたはPasswordが不正です。';
		header('Location: index.php');
		exit;
	}
}catch(PDOException $e){
	$_SESSION['error'] = $e->getMessage();
	header('Location: index.php');
}