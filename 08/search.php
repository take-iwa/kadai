<?php
require_once('init.php');

// 検索ワード取得
$word = $_POST['word'];

//1.  DB接続します
$pdo = connectDb();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE title LIKE '%".$word."%'");
//ここにバインド変数の追加　WHERE 使うー。
$status = $stmt->execute();

//３．データ表示
if($status==false){
	//execute（SQL実行時にエラーがある場合）
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);

}else{
	$view = setItemView($pdo, $stmt);
}
?>


	<!DOCTYPE html>
	<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ブックマーク検索</title>
		<link rel="stylesheet" href="css/range.css">
		<script src="./js/jquery-2.1.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="./js/sweetalert.min.js"></script>
		<script src="./js/bookmark.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="./css/sweetalert.css">
		<link href="css/style.css" rel="stylesheet">
		<link rel="shortcut icon" href="./img/favicon.ico">
	</head>

	<body id="main">
		<!-- Head[Start] -->
		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">データ一覧＜＜</a>
					</div>
				</div>
			</nav>
		</header>
		<!-- Head[End] -->

		<!-- Main[Start] -->
		<div>
			<div>
				<p>検索ワード：『<?=$word?>』</p>
			</div>
			<div class="container jumbotron">
				<?=$view?>
			</div>
		</div>
		<!-- Main[End] -->

	</body>

	</html>
