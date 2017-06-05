<?php
//1. POSTデータ取得
$id = $_POST['id'];

//2. DB接続します
try {
	$pdo = new PDO('mysql:dbname=gs_db08;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
	exit('DbConnectError:'.$e->getMessage());
}


//３．データ更新SQL作成
$stmt = $pdo->prepare('UPDATE gs_bm_table SET display=0 WHERE id='.$id);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
	//SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
	$error = $stmt->errorInfo();
	exit("QueryError:".$error[2]);
}else{
	//５．select.phpへリダイレクト
	header("Location: select.php");
	exit;

}
?>
