<?php
// セッションの初期化
session_start();

// セッション変数を全て解除する
$_SESSION = [];

// セッションを切断するにはセッションクッキーも削除する。
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 最終的に、セッションを破壊する
session_destroy();

//リダイレクト
header('Location: index.php');