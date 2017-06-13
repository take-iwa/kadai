<?php
require_once('init.php');

//1. POSTデータ取得
$id = $_GET['arg'];

//2. DB接続します
$pdo = connectDb();

//３．データ更新SQL作成
$stmt = $pdo->prepare('SELECT point FROM gs_bm_table WHERE id='.$id);
$status = $stmt->execute();

$point=0;
if($status==false){
	//execute（SQL実行時にエラーがある場合）
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);

}else{
	while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$point = $row['point'] + 1;
	}
}

$stmt = $pdo->prepare('UPDATE gs_bm_table SET point='.$point.' WHERE id='.$id);
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
?>