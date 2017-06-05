<?php
//1.  DB接続します
try {
	$pdo = new PDO('mysql:dbname=gs_db08;charset=utf8;host=localhost','root','maruiwa7701');
} catch (PDOException $e) {
	exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
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
		$view .= "<p>";
		$view .= '『<a href="'.$result["url"].'" target="_blank">'.$result["title"].'</a>』　';
		$view .= $result["comment"]."（";
		$view .= $result["indate"]."）";
		$view .= "</p>";
	}

}
?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ブックマーク表示</title>
		<link rel="stylesheet" href="css/range.css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body id="main">
		<!-- Head[Start] -->
		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">データ登録＜＜</a>
					</div>
				</div>
			</nav>
		</header>
		<!-- Head[End] -->

		<!-- Main[Start] -->
		<div>
			<div class="container jumbotron"><?=$view?></div>
		</div>
		<!-- Main[End] -->

	</body>
</html>
