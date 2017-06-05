<?php
// ファイル書き込み
function writeCsvFile($str, $path){
	$file = fopen($path,"a");
	flock($file, LOCK_EX);
	fputs($file, $str);
	flock($file, LOCK_UN);
	fclose($file);

	return true;
}

//ファイル読み込み
function readCsvFile($path){
	try {
		$file = new SplFileObject($path);
		$file->setFlags(
			SplFileObject::READ_CSV |
			SplFileObject::READ_AHEAD |
			SplFileObject::SKIP_EMPTY |
			SplFileObject::DROP_NEW_LINE
		);
	} catch (RuntimeException $e) {
		throw $e;
	}

	//ファイル内のデータループ
	$res = [];
	if (empty($file) == FALSE){
		foreach ($file as $v){
			$res[] = $v;
		}
	}

	return $res;
}

//データ集計
//TODO:もっとデータの抽象化.追加が超面倒臭い...
function aggregateData($dataArray){
	
	//集計データ初期化
	$resArrayList = array(
		'user_list' => array(),
		'たい焼き' => array(
			'頭' => 0,
			'しっぽ' => 0,
			'はら' => 0,
			'ひれ' => 0,
			'中身' => 0,
			'側面' => 0,
			'食べない' => 0,
			'その他' => 0,
			'自由欄' => "その他回答："
		),
		'あんこ' => array(
			'こしあん' => 0,
			'つぶあん' => 0,
			'しろあん' => 0,
			'くりあん' => 0,
			'嫌い' => 0,
			'その他' => 0,
			'自由欄' => "その他回答："
		),
		'おむすび' => array(
			'サケ' => 0,
			'梅干し' => 0,
			'ツナマヨ' => 0,
			'おかか' => 0,
			'明太子' => 0,
			'こんぶ' => 0,
			'パン派です' => 0,
			'その他' => 0,
			'自由欄' => "その他回答："
		),
		'目玉焼き' => array(
			'ソース' => 0,
			'しょうゆ' => 0,
			'塩' => 0,
			'ケチャップ' => 0,
			'何もかけない' => 0,
			'嫌い' => 0,
			'その他' => 0,
			'自由欄' => "その他回答："
		),
		'トマト' => array(
			'そのまま' => 0,
			'塩' => 0,
			'ドレッシング' => 0,
			'砂糖' => 0,
			'マヨネーズ' => 0,
			'嫌い' => 0,
			'その他' => 0,
			'自由欄' => "その他回答："
		)
	);

	/* 0:name,
		 1:mail,
		 2:age,
		 3:address,
		 4:taiyaki,
		 5:takoyaki_text,
		 6:anko,
		 7:anko_text,
		 8:omusubi,
		 9:omusubi_text,
		 10:medamayaki,
		 11:medamayaki_text,
		 12:tomato,
		 13:tomato_text
	*/

	$firstFlg = true;
	foreach($dataArray as $key => $row){
		//最初の行はカラム名
		if($firstFlg == true){
			$firstFlg = false;
			continue;
		}
		if(is_array($row)){
			$name = "";
			$mail = "";
			$age = "";
			$address = "";
			foreach ($row as $colum => $value) {
				switch ($colum) {
					case 0:
						// name
						$name = $value;
						break;
					case 1:
						// mail
						$mail = $value;
						break;
					case 2:
						// age
						$age = $value;
						break;
					case 3:
						// address
						$address = $value;
						array_push($resArrayList['user_list'], array('name' => $name, 'mail' => $mail, 'age' => $age, 'address' => $address));
						break;
					case 4:
						// taiyaki
						foreach ($resArrayList['たい焼き'] as $kotae => &$count) {
							if($kotae == $value)$count++;
						}
						unset($count);
						break;
					case 5:
						// takoyaki_text
						if($value !== "")$resArrayList['たい焼き']['自由欄'] .= " ".$value."(".$address."っ子".$age."さい),";
						break;
					case 6:
						// anko
						foreach ($resArrayList['あんこ'] as $kotae => &$count) {
							if($kotae == $value)$count++;
						}
						unset($count);
						break;
					case 7:
						// anko_text
						if($value !== "")$resArrayList['あんこ']['自由欄'] .= " ".$value."(".$address."っ子".$age."さい),";
						break;
					case 8:
						// omusubi
						foreach ($resArrayList['おむすび'] as $kotae => &$count) {
							if($kotae == $value)$count++;
						}
						unset($count);
						break;
					case 9:
						// omusubi_text
						if($value !== "")$resArrayList['おむすび']['自由欄'] .= " ".$value."(".$address."っ子".$age."さい),";
						break;
					case 10:
						// medamayaki
						foreach ($resArrayList['目玉焼き'] as $kotae => &$count) {
							if($kotae == $value)$count++;
						}
						unset($count);
						break;
					case 11:
						// medamayaki_text
						if($value !== "")$resArrayList['目玉焼き']['自由欄'] .= " ".$value."(".$address."っ子".$age."さい),";
						break;
					case 12:
						// tomato
						foreach ($resArrayList['トマト'] as $kotae => &$count) {
							if($kotae == $value)$count++;
						}
						unset($count);
						break;
					case 13;
						// 13:tomato_text(最後)
						if($value !== "")$resArrayList['トマト']['自由欄'] .= " ".$value."(".$address."っ子".$age."さい),";
						break;
				}
			}
		}
	}

	return $resArrayList;
}

//問いごとの表示用データ取得
function getDataForDisplay($toiArray){
	$resDispArray = array('ans' => array(), 'num' => array(), 'txt' => "");
	foreach($toiArray as $ans => $num){
		if($ans !== "自由欄"){
			$resDispArray['ans'][] = $ans;
			$resDispArray['num'][] = $num;
		}else{
			$resDispArray['txt'] = mb_substr($num, 0, -1, "UTF-8");
		}
	}
	return $resDispArray;
}

//javaScriptへのデータ受け渡し用
function json_safe_encode($data){
	$resData = json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
	//return str_replace('"',"'",$resData);
	return $resData;
}

?>
