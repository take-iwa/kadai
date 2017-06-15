<?php
require_once('init.php');

if(!$_SESSION['user_id']){
	header("Location: signin.php");
	exit;
}

//1.  DB接続します
$pdo = connectDb();

$_SESSION['nickname'] = getNickName($_SESSION['user_id'], $pdo);
$_SESSION['kanri_flg'] = getAdminFlg($_SESSION['user_id'], $pdo);

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
		$life = getLifeFlg($result['sender'], $pdo);
		if($result['display'] == 1 && $life == 0){
			if($result['sender'] == $_SESSION['user_id'] ){
				$view .= '<div id="book_item'.$result["id"].'" class="book_item">';
				$view .= '<a href="'.$result["url"].'" target="_blank"><img class="book_img" src="'.$result["img_url"].'"></a>';
				$view .= '『<a href="'.$result["url"].'" target="_blank">'.$result["title"].
					'</a>』<div class="point">'.$result["point"].'  <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-top:14px;"></span></div><a class="btn remove_button" onclick="remove_data('.$result["id"].
					')" href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="padding-top:3px;"></span>削除</a><a class="btn edit_button" href="edit.php?arg='.$result["id"].
					'"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="padding-top:3px;"></span>編集</a>
					<a class="comment_button btn" href="comment.php?arg='.$result["id"].'"><span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-top:3px;"></span>コメントする</a>';
				$view .= '<p>'.$result["comment"].'( ★'.$_SESSION['nickname'].' / '.$result["indate"].'）</p>';
				$view .= '<hr style="border:none;border-top:1px dashed #f0bdaa;">';
				$view .= '<p>'.$result["other_comment"].'</p>';
				$view .= "</div>";
			}else{
				$other_sender = getNickName($result['sender'], $pdo);
				$view .= '<div id="book_item'.$result["id"].'" class="book_item">';
				$view .= '<a href="'.$result["url"].'" target="_blank"><img class="book_img" src="'.$result["img_url"].'"></a>';
				$view .= '『<a href="'.$result["url"].'" target="_blank">'.$result["title"].'</a>』<div class="point">'.$result["point"].'  <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-top:14px;"></span></div>';
				$view .= '<a class="good_button btn" href="good.php?arg='.$result["id"].'"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-top:3px;"></span>いいね！</a>';
				$view .= '<a class="comment_button btn" href="comment.php?arg='.$result["id"].'"><span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-top:3px;"></span>コメントする</a>';
				$view .= '<p>'.$result["comment"].'( ★'.$other_sender.'さん / '.$result["indate"].'）</p>';
				$view .= '<hr style="border:none;border-top:1px dashed #f0bdaa;">';
				$view .= '<p>'.$result["other_comment"].'</p>';
				$view .= "</div>";
			}
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
		<title>みんなのブックマークリスト</title>
		<script src="./js/jquery-2.1.3.min.js"></script>
		<link rel="stylesheet" href="css/range.css">
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
						<a class="navbar-brand" href="#"><img src="./img/bookmarker.png" alt="bookmark" width="150px" style="margin:-20px 5px 0 0;"></a>
						<a class="navbar-brand" href="input.php" style="margin-top:3px;">ブックマーク登録＜＜</a>
						<form class="navbar-form navbar-left" role="search" method="post" action="search.php">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="タイトル検索" name="word">
								<input class="submit_button search_btn" type="submit" value="検索">
							</div>
						</form>
						<div class="nav navbar-nav navbar-right">
							<p style="color:#f8f8f8;">ようこそ
								<?=$_SESSION['nickname']?>さん　<span></span>
									<?php
									//管理者の場合、ユーザー管理画面へのリンク表示
									if($_SESSION['kanri_flg']){
										echo '<a href="./admin.php" style="color:#f8f8f8"><span class="glyphicon glyphicon-tower" aria-hidden="true" style="color:#f8f8f8;padding-top:8px;"></span> 管理画面　</a>';
									}
								?>
										<a href="./profile.php" style="color:#f8f8f8"><span class="glyphicon glyphicon-user" aria-hidden="true" style="color:#f8f8f8;padding-top:8px;"></span> プロフィール　</a>
										<a href="./signout.php" style="color:#f8f8f8">
											<span class="glyphicon glyphicon-log-out" aria-hidden="true" style="color:#f8f8f8;padding-top:8px;"></span> サインアウト
										</a>
							</p>
						</div>
					</div>
				</div>
			</nav>
		</header>
		<!-- Head[End] -->
		
		<!-- Top_Img -->
		<div class="top_img">
		</div>
		<!-- Top_Img[End] -->

		<!-- Main[Start] -->
		<div id="book_list">
			<div class="container jumbotron">
				<?=$view?>
			</div>
		</div>
		<!-- Main[End] -->

	</body>

	</html>
