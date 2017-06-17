<?php
require_once 'init.php';

if (isSignin()) {
	$index_url = 'index.php';
	header("Location: {$index_url}");
	exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = '';
	$email = $_POST['email'];
	$password = $_POST['password'];
	$db = connectDb();

	if (!$user_id = getUserId($email, $password, $db)) {
		$error = 'パスワードとメールアドレスが正しくありません';
	} else if (empty($error)) {
		if($life_flg = getLifeFlg($user_id, $db)){
			$error = 'アカウントがブロックされています';
		}else{
			session_regenerate_id(true);
			$_SESSION['user_id'] = $user_id;
			$_SESSION['sess_id'] = session_id();
			$index_url = "index.php";
			header("Location: {$index_url}");
			exit;
		}
	}
}
?>

	<!DOCTYPE html>
	<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>signin - Bookmark</title>
		<script src="./js/jquery-2.1.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/signin.css" rel="stylesheet">
		<script src="assets/js/ie-emulation-modes-warning.js"></script>
		<link rel="shortcut icon" href="./img/favicon.ico">
	</head>

	<body>
		<div id="main" class="container">
			<div class="row">
				<div class="col-md-4 col-md-push-4">
					<img src="./img/bookmarker.png" alt="bookmark">
					<h1 hidden>サインイン</h1>
					<form action="signin.php" method="POST">
						<div class="form-group">
							<label for="inputEmail" style="padding:0;">メールアドレス</label>
							<input type="email" class="form-control" id="inputEmail" name="email" value="">
						</div>
						<div class="form-group">
							<label for="inputPassword" style="padding:0;">パスワード</label>
							<input type="password" class="form-control" id="inputPassword" name="password">
							<!-- エラーメッセージを表示する段落<p>を追記 -->
							<p>
								<?php if (isset($error)) { print escape($error); }?>
							</p>
						</div>
						<button type="submit" class="btn btn-primary">サインイン</button>
					</form>
					<p>新規登録は<a href="./signup.php">こちら</a></p>
				</div>
			</div>
		</div>
	</body>

	</html>
