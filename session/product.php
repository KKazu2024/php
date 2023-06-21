<?php
//DB接続
function dbConnect() {
	//DB接続情報
	$dsn = 'mysql:host=localhost;dbname=ph24;charset=utf8mb4';
	$db_user = 'root';
	$db_pass = '';

	//接続
	$pdo = new PDO($dsn, $db_user, $db_pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	return $pdo;
}

//全件取得
function getAll() {
	//DB接続
	$pdo = dbConnect();

	//SQL文
	$sql = "SELECT * FROM kadai04_products WHERE deleted_at IS NULL";

	//SQL実行
	return $pdo->query($sql);
}

//ID指定取得
function getOne($id) {
	//DB接続
	$pdo = dbConnect();

	//SQL文
	$sql = "SELECT * FROM kadai04_products WHERE id = :id AND deleted_at IS NULL";
	$prepare = $pdo->prepare($sql);
	$prepare->bindValue(':id', $id);

	//SQL実行
	$prepare->execute();

	//抽出結果の取得
	return $prepare->fetch(PDO::FETCH_ASSOC);
}

//新規登録
function entry($name, $price) {
	//DB接続
	$pdo = dbConnect();

	//SQL文
	$sql = "INSERT INTO kadai04_products(name, price) VALUES(:name, :price)";
	$prepare = $pdo->prepare($sql);
	$prepare->bindValue(':name', $name);
	$prepare->bindValue(':price', $price);

	//SQL実行
	$prepare->execute();
}

//削除(論理)
function deleted($id) {
	//DB接続
	$pdo = dbConnect();

	//SQL文
	$sql = "UPDATE kadai04_products SET deleted_at = NOW() WHERE id = :id";
	$prepare = $pdo->prepare($sql);
	$prepare->bindValue(':id', $id);

	//SQL実行
	$prepare->execute();
}

//更新
function update($id, $name, $price) {
	//DB接続
	$pdo = dbConnect();

	//SQL文
	$sql = "UPDATE kadai04_products SET name = :name, price = :price WHERE id = :id";
	$prepare = $pdo->prepare($sql);
	$prepare->bindValue(':id', $id);
	$prepare->bindValue(':name', $name);
	$prepare->bindValue(':price', $price);

	//SQL実行
	$prepare->execute();
}
?>