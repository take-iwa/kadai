<?php
require_once('init.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if ((isset($_POST['user_name']) && $_POST['user_name'] !== '') && 
			(isset($_POST['screen_name']) && $_POST['screen_name'] !== '') && 
			(isset($_POST['email']) && $_POST['email'] !== '')) {

		// 送信された値を変数に代入
		$user_name = $_POST['user_name'];
		$screen_name = $_POST['screen_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// 接続関数を変数に代入
		$db = connectDb();

		if($password != ''){
			$hash = password_hash($password, PASSWORD_DEFAULT);

			$sql = 'UPDATE gs_user_table SET name=:name, lid=:lid, email=:email, lpw=:password WHERE id='.$_SESSION['user_id'];

			$statement = $db->prepare($sql);

			$statement->bindValue(':name', $user_name, PDO::PARAM_STR);
			$statement->bindValue(':lid', $screen_name, PDO::PARAM_STR);
			$statement->bindValue(':email', $email, PDO::PARAM_STR);
			$statement->bindValue(':password', $hash, PDO::PARAM_STR);

			if($statement->execute()) {
				$index_url = "index.php";
				header("Location: {$index_url}");
				exit;
			} else {
				echo "登録に失敗しました。";
			}
		}else{
			//パスワード以外
			$sql = 'UPDATE gs_user_table SET name=:name, lid=:lid, email=:email WHERE id='.$_SESSION['user_id'];

			$statement = $db->prepare($sql);

			$statement->bindValue(':name', $user_name, PDO::PARAM_STR);
			$statement->bindValue(':lid', $screen_name, PDO::PARAM_STR);
			$statement->bindValue(':email', $email, PDO::PARAM_STR);

			if($statement->execute()) {
				$index_url = "index.php";
				header("Location: {$index_url}");
				exit;
			} else {
				echo "登録に失敗しました。";
			}
		}

	} else {
		echo "値が入力されていません";
	}
}
?>