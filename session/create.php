<?php
session_start();
$error_message = '';
$message = '';
//エラーチェック
if(isset($_SESSION['error'])){
	$error_message = $_SESSION['error'];
	unset($_SESSION['error']);
}
//完了チェック
if(isset($_SESSION['success'])){
	$message = $_SESSION['success'];
	unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>商品登録</title>
</head>
<body>
	<h1>課題No.04 CRUD</h1>
	<output style="color:red"><?php echo $error_message ?></output>
	<output><?php echo $message ?></output>
	<h2>商品登録ページ</h2>
	<form action="store.php" method="post">
		<b>商品名 </b><input type="text" name="name"><br>
		<b>単価 </b><input type="text" name="price"><br>
		<input type="submit" value="登録">
	</form>
	<a href="index.php">戻る</a>
</body>
</html>