<?php
require_once 'init.php';

//セクションチェック
sessChk();

//1.  DB接続します
$pdo = connectDb();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=".$_SESSION['user_id']);
$status = $stmt->execute();

//３．データ表示
$name = "";
$nickname = '';
$email = '';
if($status==false){
	//execute（SQL実行時にエラーがある場合）
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);

}else{
	//Selectデータの数だけ自動でループしてくれる
	while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
		$name = $result['name'];
		$nickname = $result['lid'];
		$email = $result['email'];
	}
}
?>


<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>プロフィール編集</title>
		<link rel="stylesheet" href="css/range.css">
		<script src="./js/jquery-2.1.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="./js/sweetalert.min.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link rel="shortcut icon" href="./img/favicon.ico">
	</head>

	<body id="main">
		<!-- Head[Start] -->
		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">ブックマーク一覧＜＜</a>
					</div>
				</div>
			</nav>
		</header>
		<!-- Head[End] -->

		<!-- Main[Start] -->
		<div>
			<!-- フォーム部分 -->
			<h1>プロフィール編集</h1>
			<form action="./update_profile.php" method="POST">
				<!-- ユーザ名 -->
				<div class="form-group">
					<label for="userName" style="padding:0;">ユーザ名（必須）</label>
					<input type="text" class="form-control" id="userName" name="user_name" placeholder="3文字以上15文字以下" required value="<?=$name?>"/>
				</div>
				<!-- ユーザID -->
				<div class="form-group">
					<label for="screenName" style="padding:0;">ニックネーム（必須）</label>
					<input type="text" class="form-control" id="screenName" name="screen_name" placeholder="3文字以上15文字以下" required value="<?=$nickname?>"/>
				</div>
				<!-- メールアドレス -->
				<div class="form-group">
					<label for="email" style="padding:0;">メールアドレス（必須）</label>
					<input type="email" class="form-control" id="email" name="email" required value="<?=$email?>"/>
				</div>
				<!-- パスワード -->
				<div class="form-group">
					<label for="password" style="padding:0;">新しいパスワード（任意）</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="4文字以上8文字以下"/>
				</div>
				<!-- 更新ボタン -->
				<button type="submit" class="btn btn-primary">更新</button>
			</form>
		</div>
		<!-- Main[End] -->
	</body>

</html>
