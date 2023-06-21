<?php
//URL直打ちチェック
if(!isset($_GET['id'])){
	header('Location: index.php');
  	exit;
}
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
	<h2>商品編集ページ</h2>
	<?php
	require_once('product.php');
	$id = $_GET['id'];

	//指定取得
	$product = getOne($id);

	//出力
	echo "<b>商品ID </b>{$product['id']}<br>";
	echo "<form action='update.php' method='post'>";
	echo "<input type='hidden' name='id' value='{$product['id']}'>";
	echo "<b>商品名 </b><input type='text' name='name' value='{$product['name']}'><br>";
	echo "<b>単価 </b><input type='text' name='price' value='{$product['price']}'><br>";
	echo "<input type='submit' value='更新'>";
	echo "</form><br>";
	?>
	<a href="index.php">戻る</a>
</body>
</html>