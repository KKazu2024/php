<?php
session_start();
$error_message = '';
//エラーチェック
if(isset($_SESSION['error'])){
	//エラーメッセージの設定
	$error_message = $_SESSION['error'];
	unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>
<body>
	<h1>課題No.03 Login</h1>
	<output style="color:red"><?php echo $error_message ?></output>
	<h2>新規ユーザー登録</h2>
	<form action="signup.php" method="post">
		ID<br><input type="text" name="id"><br>
		Password<br><input type="password" name="password"><br>
		<input type="submit" value="signup"><hr>
	</form>
	<?php
	if(isset($_SESSION['id'])){
		echo "<p><a href='mypage.php'>mypage</a></p>";
		echo "<p><a href='logout.php'>logout</a></p>";
		exit;
	}
	?>
	<h2>ログイン</h2>
	<form action="login.php" method="post">
		ID<br><input type="text" name="id"><br>
		Password<br><input type="password" name="password"><br>
		<input type="submit" value="login">
	</form>
</body>
</html>