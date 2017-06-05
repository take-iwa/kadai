<?php
	$title ="G's食癖アンケート";
	
	//データファイルの存在確認
	$filePath = "./data/data.csv";
	if( !file_exists($filePath) ){
		//ファイル作成
		touch( $filePath );
		//ファイルのパーティションの変更
		chmod( $filePath, 0666 );
		//見出し行を追加
		$file = fopen($filePath,"a");
		flock($file, LOCK_EX);
		fwrite($file, "name,mail,age,address,taiyaki,takoyaki_text,anko,anko_text,omusubi,omusubi_text,medamayaki,medamayaki_text,tomato,tomato_text\n");
		flock($file, LOCK_UN);
		fclose($file);
	}
	
?>
	<html lang="jp">

	<head>
		<meta charset="utf-8">
		<title>
			<?php echo $title; ?>
		</title>
		<link rel="icon" href="./img/favicon.ico">
		<link rel="stylesheet" type="text/css" href="./css/style.css">
	</head>

	<body>
		<img id="top_img" src="./img/cook.jpg" alt="logo" />
		<h1>
			<?=$title?>
		</h1>
		<br>
		<form action="output_data.php" method="post">
			<p>ご協力お願いします。サンプル数が命です。</p>
			<p class="repletion">※こちらの情報は、食癖アンケート以外には使用いたしません。</p>
			<div id="profile">
				<p class="question">お名前は？<span>*</span><input class="input_box" type="text" name="name" required></p>
				<p class="question">メールアドレスは？<input class="input_box" type="email" name="mail"></p>
				<p class="question">年れいは？<span>*</span><input class="input_box" type="number" name="age" max="90" min="13" required></p>
				<p class="question">
					<td>出身は？<span>*</span></td>
					<td>
						<select class="input_box" name="address" size="1" required>
					<option value="北海道">北海道</option>
					<option value="青森">青森</option>
					<option value="岩手">岩手</option>
					<option value="秋田">秋田</option>
					<option value="山形">山形</option>
					<option value="宮城">宮城</option>
					<option value="福島">福島</option>
					<option value="群馬">群馬</option>
					<option value="栃木">栃木</option>
					<option value="茨城">茨城</option>
					<option value="千葉">千葉</option>
					<option value="東京">東京</option>
					<option value="埼玉">埼玉</option>
					<option value="神奈川">神奈川</option>
					<option value="山梨">山梨</option>
					<option value="新潟">新潟</option>
					<option value="長野">長野</option>
					<option value="静岡">静岡</option>
					<option value="富山">富山</option>
					<option value="岐阜">岐阜</option>
					<option value="愛知">愛知</option>
					<option value="三重">三重</option>
					<option value="石川">石川</option>
					<option value="福井">福井</option>
					<option value="滋賀">滋賀</option>
					<option value="京都">京都</option>
					<option value="大阪">大阪</option>
					<option value="奈良">奈良</option>
					<option value="和歌山">和歌山</option>
					<option value="兵庫">兵庫</option>
					<option value="香川">香川</option>
					<option value="徳島">徳島</option>
					<option value="愛媛">愛媛</option>
					<option value="高知">高知</option>
					<option value="鳥取">鳥取</option>
					<option value="岡山">岡山</option>
					<option value="島根">島根</option>
					<option value="広島">広島</option>
					<option value="山口">山口</option>
					<option value="福岡">福岡</option>
					<option value="佐賀">佐賀</option>
					<option value="大分">大分</option>
					<option value="長崎">長崎</option>
					<option value="宮崎">宮崎</option>
					<option value="熊本">熊本</option>
					<option value="鹿児島">鹿児島</option>
					<option value="沖縄">沖縄</option>
					<option value="外国">外国</option>
				</select>
					</td>
				</p>
			</div>
			<br>
			<p>ここからが問いです。それでは、どうぞ。</p>
			<div id="questionnaire">
				<div>
					<p class="question">Q１. たいやき はどっちから食べる？</p>
					<label>
					<input class="radio" type="radio" name="taiyaki" value="頭"><span class="radio-icon"></span>頭
				</label>
					<label>
					<input class="radio" type="radio" name="taiyaki" value="しっぽ"><span class="radio-icon"></span>しっぽ
				</label>
					<label>
					<input class="radio" type="radio" name="taiyaki" value="はら"><span class="radio-icon"></span>はら
				</label>
					<label>
					<input class="radio" type="radio" name="taiyaki" value="ひれ"><span class="radio-icon"></span>ひれ
				</label>
					<label>
					<input class="radio" type="radio" name="taiyaki" value="中身"><span class="radio-icon"></span>中身
				</label>
					<label>
					<input class="radio" type="radio" name="taiyaki" value="側面"><span class="radio-icon"></span>側面
				</label>
					<label>
					<input class="radio" type="radio" name="taiyaki" value="食べない"><span class="radio-icon"></span>食べない
				</label>
					<br>
					<label>
					<input class="radio" type="radio" name="taiyaki" value="その他"><span class="radio-icon"></span>その他
				</label> ( <input class="sonota_text" type="text" name="takoyaki_text"> )
				</div>
				<br>
				<div>
					<p class="question">Q2. あんこ といえば？</p>
					<label>
					<input class="radio" type="radio" name="anko" value="こしあん"><span class="radio-icon"></span>こしあん
				</label>
					<label>
					<input class="radio" type="radio" name="anko" value="つぶあん"><span class="radio-icon"></span>つぶあん
				</label>
					<label>
					<input class="radio" type="radio" name="anko" value="しろあん"><span class="radio-icon"></span>しろあん
				</label>
					<label>
					<input class="radio" type="radio" name="anko" value="くりあん"><span class="radio-icon"></span>くりあん
				</label>
					<label>
					<input class="radio" type="radio" name="anko" value="嫌い"><span class="radio-icon"></span>嫌い
				</label>
					<br>
					<label>
					<input class="radio" type="radio" name="anko" value="その他"><span class="radio-icon"></span>その他
				</label> ( <input class="sonota_text" type="text" name="anko_text"> )
				</div>
				<br>
				<div>
					<p class="question">Q3. コンビニのおむすびの具 と言えば？</p>
					<label>
					<input class="radio" type="radio" name="omusubi" value="サケ"><span class="radio-icon"></span>サケ
				</label>
					<label>
					<input class="radio" type="radio" name="omusubi" value="梅干し"><span class="radio-icon"></span>梅干し
				</label>
					<label>
					<input class="radio" type="radio" name="omusubi" value="ツナマヨ"><span class="radio-icon"></span>ツナマヨ
				</label>
					<label>
					<input class="radio" type="radio" name="omusubi" value="おかか"><span class="radio-icon"></span>おかか
				</label>
					<label>
					<input class="radio" type="radio" name="omusubi" value="明太子"><span class="radio-icon"></span>明太子
				</label>
					<label>
					<input class="radio" type="radio" name="omusubi" value="こんぶ"><span class="radio-icon"></span>こんぶ
				</label>
					<label>
					<input class="radio" type="radio" name="omusubi" value="パン派"><span class="radio-icon"></span>パン派です
				</label>
					<br>
					<label>
					<input class="radio" type="radio" name="omusubi" value="その他"><span class="radio-icon"></span>その他
				</label> ( <input class="sonota_text" type="text" name="omusubi_text"> )
				</div>
				<br>
				<div>
					<p class="question">Q4. 目玉焼き には、何をかけますか？</p>
					<label>
					<input class="radio" type="radio" name="medamayaki" value="ソース"><span class="radio-icon"></span>ソース
				</label>
					<label>
					<input class="radio" type="radio" name="medamayaki" value="しょうゆ"><span class="radio-icon"></span>しょうゆ
				</label>
					<label>
					<input class="radio" type="radio" name="medamayaki" value="塩"><span class="radio-icon"></span>塩
				</label>
					<label>
					<input class="radio" type="radio" name="medamayaki" value="ケチャップ"><span class="radio-icon"></span>ケチャップ
				</label>
					<label>
					<input class="radio" type="radio" name="medamayaki" value="何もかけない"><span class="radio-icon"></span>何もかけない
				</label>
					<label>
					<input class="radio" type="radio" name="medamayaki" value="嫌い"><span class="radio-icon"></span>嫌い
				</label>
					<br>
					<label>
					<input class="radio" type="radio" name="medamayaki" value="その他"><span class="radio-icon"></span>その他
				</label> ( <input class="sonota_text" type="text" name="medamayaki_text"> )
				</div>
				<br>
				<div>
					<p class="question">Q5. では、トマト には、何をかけますか？</p>
					<label>
					<input class="radio" type="radio" name="tomato" value="そのまま"><span class="radio-icon"></span>そのまま
				</label>
					<label>
					<input class="radio" type="radio" name="tomato" value="塩"><span class="radio-icon"></span>塩
				</label>
					<label>
					<input class="radio" type="radio" name="tomato" value="ドレッシング"><span class="radio-icon"></span>ドレッシング
				</label>
					<label>
					<input class="radio" type="radio" name="tomato" value="砂糖"><span class="radio-icon"></span>砂糖
				</label>
					<label>
					<input class="radio" type="radio" name="tomato" value="マヨネーズ"><span class="radio-icon"></span>マヨネーズ
				</label>
					<label>
					<input class="radio" type="radio" name="tomato" value="嫌い"><span class="radio-icon"></span>嫌い
				</label>
					<br>
					<label>
					<input class="radio" type="radio" name="tomato" value="その他"><span class="radio-icon"></span>その他
				</label> ( <input class="sonota_text" type="text" name="tomato_text"> )
				</div>
			</div>
			<br>
			<div>
				<p>ご協力 ありがとうございました！</p>
				<input id="submit_button" type="submit" value="送信して結果を見る">
			</div>
		</form>
	</body>

	</html>
