<?php
$word = $_POST['word'];

//1.  DB接続します
try {
	$pdo = new PDO('mysql:dbname=gs_db08;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
	exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE title LIKE '%".$word."%'");
//ここにバインド変数の追加　WHERE 使うー。
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
		if($result['display'] == 1){
			$view .= '<div id="book_item'.$result["id"].'" class="book_item">';
			$view .= '『<a href="'.$result["url"].'" target="_blank">'.$result["title"].
				'</a>』<a class="remove_button" onclick="remove_data('.$result["id"].
				')" href="#">削除</a><a class="edit_button" href="edit.php?arg='.$result["id"].
				'">編集</a>';
			$view .= '<p>'.$result["comment"]."（";
			$view .= $result["indate"]."）</p>";
			$view .= "</div>";
		}
	}

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
		<script src="./js/bootstrap.min.js"></script>
		<script src="./js/jquery-2.1.3.min.js"></script>
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
						<a class="navbar-brand" href="select.php">データ一覧＜＜</a>
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
