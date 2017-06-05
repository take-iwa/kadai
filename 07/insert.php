<?php
//1. POSTデータ取得
$title = $_POST["title"];
$url = $_POST["url"];
$comment = $_POST["comment"];


//2. DB接続します
try {
	$pdo = new PDO('mysql:dbname=gs_db08;charset=utf8;host=localhost','root','maruiwa7701');
} catch (PDOException $e) {
	exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, title, url, comment,
indate )VALUES(NULL, :title, :url, :comment, sysdate())");
//セキュリティ対策(":〇〇" ・・・ バインド変数と言う)
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
	//SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
	$error = $stmt->errorInfo();
	exit("QueryError:".$error[2]);
}else{
	//５．index.phpへリダイレクト
	header("Location: index.php");
	exit;

}
?>
