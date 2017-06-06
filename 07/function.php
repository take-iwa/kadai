<?php
require_once('simple_html_dom.php');

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
