<?php
require_once 'init.php';

$bookID = $_GET['arg'];

//1.  DB接続します
$pdo = connectDb();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=".$bookID);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
	//execute（SQL実行時にエラーがある場合）
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);

}else{
	//Selectデータの数だけ自動でループしてくれる
	while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
		$view .= '<form method="post" action="set.php">
		<div class="jumbotron">
			<fieldset>
				<legend>ブックマーク編集</legend>
					<input type="number" name="id" value="'.$result['id'].'" hidden>
					<label>タイトル：<input class="textbox" type="text" name="title" value="'.$result['title'].'"></label><br>
					<label>URL：<input class="textbox" type="text" name="url" value="'.$result['url'].'"></label><br>
					<label>コメント：<textArea name="comment" rows="4" cols="80">'.$result['comment'].'</textArea></label><br>
					<input id="submit_button" type="submit" value="変更">
				</fieldset>
			</div>
		</form>';
	}

}
?>


<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ブックマーク編集</title>
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
			<?=$view?>
		</div>
		<!-- Main[End] -->
	</body>

</html>
