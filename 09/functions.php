<?php
require_once('simple_html_dom.php');

//セクションチェック
function sessChk(){
	if(!$_SESSION['sess_id']){
		header("Location: signin.php");
		exit;
	}
}

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

//ブロック取得
function getLifeFlg($sender_id, $db) {
	$sql = "SELECT life_flg FROM gs_user_table WHERE id=:sender";
	$statement = $db->prepare($sql);
	$statement->bindValue(':sender', $sender_id, PDO::PARAM_INT);
	$statement->execute();
	$row = $statement->fetch();
	return $row['life_flg'];
}

//XSS対策
function escape($s) {
	return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

//ユーザーか否か
function isSignin()
{
	if (!isset($_SESSION['user_id'])) {
		// 変数に値がセットされていない場合
		return false;
	} else {
		return true;
	}
}

//Amazonのページのみに対応
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

//ブックマーク表示リストの作成
function setItemView($pdo, $stmt){
	$view = '';
	//Selectデータの数だけ自動でループしてくれる
	while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
		$life = getLifeFlg($result['sender'], $pdo);
		if($result['display'] == 1 && $life == 0){
			$view .= '<div id="book_item'.$result["id"].'" class="book_item">';
			$view .= '<a href="'.$result["url"].'" target="_blank"><img class="book_img" src="'.$result["img_url"].'"></a>';
			$view .= '『<a href="'.$result["url"].'" target="_blank">'.$result["title"].
				'</a>』<div class="point">'.$result["point"].'  <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-top:14px;"></span></div>';
			if(isSignin()){
				if($result['sender'] == $_SESSION['user_id'] ){
					$view .= '<a class="btn remove_button" onclick="remove_data('.$result["id"].')" href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="padding-top:3px;"></span>削除</a>';
					$view .= '<a class="btn edit_button" href="edit.php?arg='.$result["id"].'"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="padding-top:3px;"></span>編集</a>';
				}else{
					$view .= '<a class="good_button btn" href="good.php?arg='.$result["id"].'"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="padding-top:3px;"></span>いいね！</a>';
				}
				$view .= '<a class="comment_button btn" href="comment.php?arg='.$result["id"].'"><span class="glyphicon glyphicon-comment" aria-hidden="true" style="padding-top:3px;"></span>コメントする</a>';
			}
			$sender_name = getNickName($result['sender'], $pdo);
			$view .= '<p>'.$result["comment"].'( ★'.$sender_name.'さん / '.$result["indate"].'）</p>';
			$view .= '<hr style="border:none;border-top:1px dashed #f0bdaa;">';
			$view .= '<p>'.$result["other_comment"].'</p>';
			$view .= "</div>";
		}
	}
	return $view;
}
?>
