<?php
require_once('init.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if ((isset($_POST['user_name']) && $_POST['user_name'] !== '') && 
			(isset($_POST['screen_name']) && $_POST['screen_name'] !== '') && 
			(isset($_POST['email']) && $_POST['email'] !== '') && 
			(isset($_POST['password']) && $_POST['password'] !== '')) {

		// 送信された値を変数に代入
		$user_name = $_POST['user_name'];
		$screen_name = $_POST['screen_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// 接続関数を変数に代入
		$db = connectDb();

		$hash = password_hash($password, PASSWORD_DEFAULT);

		$sql = 'INSERT INTO gs_user_table (id, name, lid, email, lpw, kanri_flg, life_flg) 
      VALUES (NULL, :user_name, :screen_name, :email, :password, 0, 0)';

		$statement = $db->prepare($sql);

		$statement->bindValue(':screen_name', $screen_name, PDO::PARAM_STR);
		$statement->bindValue(':user_name', $user_name, PDO::PARAM_STR);
		$statement->bindValue(':email', $email, PDO::PARAM_STR);
		$statement->bindValue(':password', $hash, PDO::PARAM_STR);

		if($statement->execute()) {
			$signin_url = "signin.php";
			header("Location: {$signin_url}");
			exit;
		} else {
			//TODO:アラート
			//echo '<script type="text/javascript">
      //    sweetAlert("Error", "登録に失敗しました。", "error");
      //</script>';
		}
		
	} else {
		//TODO:アラート
		//echo '<script type="text/javascript">
    //      sweetAlert("Error", "値が入力されていません", "error");
    //  </script>';
	}
}
?>

	<!DOCTYPE html>
	<html lang="ja">

	<head>
		<meta charset="UTF-8">
		<title>ブックマーカー</title>
		<script src="./js/jquery-2.1.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/signin.css" rel="stylesheet">
		<script src="assets/js/ie-emulation-modes-warning.js"></script>
		<script src="./js/sweetalert.min.js"></script>
		<link rel="stylesheet" href="./css/sweetalert.css">
		<link rel="shortcut icon" href="./img/favicon.ico">
	</head>

	<body>
		<div id="main" class="container">
			<div class="row">
				<div class="col-md-4 col-md-push-4">
					<img src="./img/bookmarker.png" alt="bookmark">
					<h1>新規登録</h1>
					<!-- フォーム部分 -->
					<form action="./signup.php" method="POST">
						<!-- ユーザ名 -->
						<div class="form-group">
							<label for="userName" style="padding:0;">ユーザ名（必須）</label>
							<input type="text" class="form-control" id="userName" name="user_name" placeholder="3文字以上15文字以下" required/>
						</div>
						<!-- ユーザID -->
						<div class="form-group">
							<label for="screenName" style="padding:0;">ニックネーム（必須）</label>
							<input type="text" class="form-control" id="screenName" name="screen_name" placeholder="3文字以上15文字以下" required/>
						</div>
						<!-- メールアドレス -->
						<div class="form-group">
							<label for="email" style="padding:0;">メールアドレス（必須）</label>
							<input type="email" class="form-control" id="email" name="email" required/>
						</div>
						<!-- パスワード -->
						<div class="form-group">
							<label for="password" style="padding:0;">パスワード（必須）</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="4文字以上8文字以下" required/>
						</div>
						<!-- 新規登録ボタン -->
						<button type="submit" class="btn btn-primary">新規登録</button>
					</form>
					<!-- ログイン画面へのリンク -->
					<p>ログインは<a href="./signin.php">こちら</a></p>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</body>

	</html>
