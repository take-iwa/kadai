<?php
require_once 'init.php';

//セクションチェック
sessChk();

//1.  DB接続します
$pdo = connectDb();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
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
		$view .= '<tr id="user_item'.$result["id"].'" class="user_item">';
		$view .= '<td style="padding-left:30px;">'.$result["name"].'</td><td>'.$result["lid"].'</td><td>'.$result['email'].'</td><td>';
		$view .= '<a id="block_'.$result["id"].'" class="btn ';
		if($result["life_flg"] == 0){
			$view .= 'btn-danger"';
		}else{
			$view .= 'btn-success"';
		}
		$view .= ' onclick="block_user('.$result["id"].','.$result["life_flg"].')" href="#"><span class="glyphicon ';
		if($result["life_flg"] == 0){
			$view .= 'glyphicon-ban-circle"';
		}else{
			$view .= 'glyphicon glyphicon-ok-circle"';
		}
		$view .= ' aria-hidden="true" style="padding-top:3px;"></span>';
		if($result["life_flg"] == 0){
			$view .= 'ブロック';
		}else{
			$view .= 'ブロック解除';
		}
		$view .= '</a></td><td>';
		if($result["kanri_flg"]){
			$view .= '<span class="glyphicon glyphicon-tower" aria-hidden="true" style="color:#000;padding-top:8px;"></span> 管理者';
		}else{
			$view .= '<span class="glyphicon glyphicon-user" aria-hidden="true" style="color:#000;padding-top:8px;"></span> 一般ユーザ';
		}
		$view .= '</td></tr>';
	}

}
?>


	<!DOCTYPE html>
	<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ユーザー管理</title>
		<link rel="stylesheet" href="css/range.css">
		<script src="./js/jquery-2.1.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="./js/sweetalert.min.js"></script>
		<script src="./js/bookmark.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="./css/sweetalert.css">
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
		<h1 style="padding-left:20px;">ユーザーリスト</h1>
		<table class="table table-striped">
			<tr>
				<th class="name" style="padding-left:30px;">ユーザー名</th>
				<th class="nickname">ニックネーム</th>
				<th class="email">Eメールアドレス</th>
				<th style="width:200px;">操作</th>
				<th>権限</th>
			</tr>
			<?=$view?>
		</table>
		<!-- Main[End] -->
	</body>

	</html>
