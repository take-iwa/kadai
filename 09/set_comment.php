<?php
require_once('init.php');

//セクションチェック
sessChk();

//1. POSTデータ取得
$comment = $_POST["comment"];
$bookID = $_POST['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$error = '';
	$comment = $_POST['comment'];
	$pdo = connectDb();

	

	$stmt = $pdo->prepare('SELECT other_comment FROM gs_bm_table WHERE id='.$bookID);
	$status = $stmt->execute();

	$other_comment='';
	if($status==false){
		//execute（SQL実行時にエラーがある場合）
		$error = $stmt->errorInfo();
		exit("ErrorQuery:".$error[2]);

	}else{
		while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$other_comment = $row['other_comment'].'<br>'.$comment.'( '.$_SESSION['nickname'].'さん )';
		}
	}

	//３．データ更新SQL作成
	$stmt = $pdo->prepare('UPDATE gs_bm_table SET other_comment=:comment WHERE id='.$bookID);
	//セキュリティ対策(":〇〇" ・・・ バインド変数と言う)
	$stmt->bindValue(':comment', $other_comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
	$status = $stmt->execute();

	//４．データ登録処理後
	if($status==false){
		//SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
		$error = $stmt->errorInfo();
		exit("QueryError:".$error[2]);
	}else{
		//５．select.phpへリダイレクト
		header("Location: index.php");
		exit;

	}
}
?>