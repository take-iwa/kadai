// 削除アラート表示
function remove_data(book_id) {
	swal({
			title: "本当にいいんですか？",
			text: "ただし、削除してもDB上にはデータ残ります。",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "いいよ!",
			closeOnConfirm: false
		},
		function () {
			sendRequest(book_id);
			swal({
					title: "削除しました!",
					text: "削除したけど、一応DB上には残ってるからね！",
					confirmButtonText: "OK!",
					closeOnConfirm: false
				},
				function () {
					location.reload();
				});
		});
}

// サーバー側とデータを通信するための機能を持つAPIを取得
function createXmlHttpRequest() {
	var xmlhttp = null;
	if (window.ActiveXObject) {
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e2) {}
		}
	} else if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

// 送信リクエスト
function sendRequest(book_id) {
	var xmlhttp = createXmlHttpRequest();
	if (xmlhttp != null) {
		xmlhttp.open("POST", "./remove.php", false);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlhttp.send('id=' + book_id);

	}
}
