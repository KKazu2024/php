<?php
//URL直打ちチェック
if(!isset($_GET['id'])){
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
	<title>商品詳細</title>
</head>
<body>
	<h1>課題No.04 CRUD</h1>
	<h2>商品詳細ページ</h2>
	<?php
	require_once('product.php');
	$id = $_GET['id'];

	//指定取得
	$product = getOne($id);

	//出力
	echo "<table>";
	echo "<tr><th>商品ID</th><td>{$product['id']}</td></tr>";
	echo "<tr><th>商品名</th><td>{$product['name']}</td></tr>";
	echo "<tr><th>単価</th><td>{$product['price']}</td></tr>";
	echo "<tr><th>登録日時</th><td>{$product['created_at']}</td></tr>";
	echo "<tr><th>更新日時</th><td>{$product['updated_at']}</td></tr>";
	echo "</table>";
	?>
	<a href="index.php">戻る</a>
	
</body>
</html>