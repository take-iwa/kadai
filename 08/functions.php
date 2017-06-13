<?php
require_once('simple_html_dom.php');

//DB接続
function connectDb() {
	try {
		return new PDO(DSN, DB_USER, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	} catch (PDOException $e) {
		exit('データベースに接続できませんでした。'.$e->getMessage());
	}
}

//ユーザーID取得
function getUserId($email, $password, $db) {
	$sql = "SELECT id, lpw FROM gs_user_table WHERE email = :email";
	$statement = $db->prepare($sql);
	$statement->bindValue(':email', $email, PDO::PARAM_STR);
	$statement->execute();
	$row = $statement->fetch();
	if (password_verify($password, $row['lpw'])) {
		return $row['id'];
	} else {
		return false;
	}
}

//ニックネーム取得
function getNickName($sender_id, $db) {
	$sql = "SELECT lid FROM gs_user_table WHERE id=:sender";
	$statement = $db->prepare($sql);
	$statement->bindValue(':sender', $sender_id, PDO::PARAM_INT);
	$statement->execute();
	$row = $statement->fetch();
	return $row['lid'];
}

//管理者権限取得
function getAdminFlg($sender_id, $db) {
	$sql = "SELECT kanri_flg FROM gs_user_table WHERE id=:sender";
	$statement = $db->prepare($sql);
	$statement->bindValue(':sender', $sender_id, PDO::PARAM_INT);
	$statement->execute();
	$row = $statement->fetch();
	return $row['kanri_flg'];
}

//XSS対策
function escape($s) {
	return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

function isSignin()
{
	if (!isset($_SESSION['user_id'])) {
		// 変数に値がセットされていない場合
		return false;
	} else {
		return true;
	}
}

function scrapAmazonPage($url){
	//ウェブページのデータを読み込み
	
	$html = file_get_html($url);
	$img_tag = "";
	
	$book_img_elem = $html -> find('div[class="a-section"] img',0);
	$book_img_url = $book_img_elem->src;
	$html -> clear();
	unset($html);
	
	return $book_img_url;
}
?>
