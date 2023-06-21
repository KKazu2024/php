<?php
session_start();
$message = '';
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
	<title>課題No.04</title>
</head>
<body>
	<h1>課題No.04 CRUD</h1>
	<output><?php echo $message ?></output>
	<h2>商品一覧ページ</h2>
	<a href="create.php">新規作成</a>
	<?php
	require_once('product.php');

	//全件取得
	$stmt = getAll();

	echo "<table>";
	echo "<tr><th>商品ID</th><th>商品名</th><th>詳細</th><th>削除</th><th>編集</th></tr>";
	foreach($stmt as $product) {
		echo "<tr>";
		echo "<td>{$product['id']}</td>";
    	echo "<td>{$product['name']}</td>";
		echo "<td><a href='show.php?id={$product['id']}'>詳細<a></td>";
		echo "<td><a href='destroy.php?id={$product['id']}'>削除<a></td>";
		echo "<td><a href='edit.php?id={$product['id']}'>編集<a></td>";
		echo "</tr>";
	}
	echo "</table>";
	?>
</body>
</html>