<?php
//ログインユーザーチェック
session_start();
if(!isset($_SESSION['id'])){
	$_SESSION['error'] = 'ログインしてください。';
	header('Location: index.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mypage</title>
</head>
<body>
	<h1>マイページ</h1>
	<p>ようこそ。</p>
	<a href="logout.php">logout</a><br>
	<a href="index.php">index</a>
</body>
</html>