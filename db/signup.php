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

//入力データ取得&パスワードのハッシュ化
$id = $_POST['id'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//DB情報読込
require('db_config.php');

try{
	//DB接続
	$pdo = new PDO($dsn, $db_user, $db_pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	//SQL文
	$sql = "INSERT INTO kadai03_users(id, password) VALUES(:id, :password)";
	$prepare = $pdo->prepare($sql);
	$prepare->bindValue(':id', $id);
	$prepare->bindValue(':password', $password);

	//SQL実行
	$prepare->execute();
	
	header('Location: index.php');
	exit;
}catch(PDOException $e){
	$errorCode = $e->errorInfo[1];
	if($errorCode == 1062){
		$_SESSION['error'] = '指定されたIDは既に利用されています。';
	}else{
		$_SESSION['error'] = $e->getMessage();
	}
	header('Location: index.php');
}