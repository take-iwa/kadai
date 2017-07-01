<?php
require_once 'init.php';

//セクションチェック
sessChk();
?>


	<!DOCTYPE html>
	<html lang="ja">

	<head>
		<meta charset="UTF-8">
		<title>ブックマーク</title>
		<script src="./js/jquery-2.1.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="./ckeditor/ckeditor.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link rel="shortcut icon" href="./img/favicon.ico">
	</head>

	<body>

		<!-- Head[Start] -->
		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header"><a class="navbar-brand" href="index.php">＞＞データ一覧</a></div>
				</div>
			</nav>
		</header>
		<!-- Head[End] -->

		<!-- Main[Start] -->
		<form method="post" action="insert.php">
			<div class="jumbotron">
				<fieldset>
					<legend>ブックマーク</legend>
					<label>タイトル：<input class="textbox" type="text" name="title"></label><br>
					<label>URL：<input class="textbox" type="text" name="url"></label><br>
					<!--
					<label>コメント：<textArea name="comment" rows="4" cols="80"></textArea></label><br>
					-->
					<label>コメント：<textarea name="comment" id="editor1" rows="10" cols="80">
						コメントをどうぞ！
						</textarea></label><br>
					<script>
						// Replace the <textarea id="editor1"> with a CKEditor
						// instance, using default configuration.
						CKEDITOR.replace('editor1');

					</script>
					<input class="submit_button" type="submit" value="登録">
				</fieldset>
			</div>
		</form>
		<!-- Main[End] -->


	</body>

	</html>
