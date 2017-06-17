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

// ブロック確認アラート表示
function block_user(user_id, life) {
	if (life == 0) {
		swal({
				title: "本当にいいんですか？",
				text: "ブロック解除もできます。",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "いいよ!",
				closeOnConfirm: false
			},
			function () {
				sendBlockRequest(user_id, 1);
				swal({
						title: "ブロックしました!",
						text: "該当ユーザーのブックマークも表示されなくなります。",
						confirmButtonText: "OK!",
						closeOnConfirm: false
					},
					function () {
						tglBlockButton(user_id, life);
						location.reload();
					});

			});
	} else {
		sendBlockRequest(user_id, 0);
		swal({
				title: "ブロック解除しました!",
				text: "該当ユーザーのブックマークも表示されます。",
				confirmButtonText: "OK!",
				closeOnConfirm: false
			},
			function () {
				tglBlockButton(user_id, life);
				location.reload();
			});
	}
}


// ブロック送信リクエスト
function sendBlockRequest(user_id, block) {
	var xmlhttp = createXmlHttpRequest();
	if (xmlhttp != null) {
		xmlhttp.open("POST", "./remove_user.php", false);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlhttp.send('id=' + user_id + '&block=' + block);
	}
}

function tglBlockButton(user_id, flg) {
	if (!flg) {
		$('#block_' + user_id).html('<span class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="padding-top:3px;"></span>ブロック解除').removeClass("btn-danger").addClass("btn-success");
	} else {
		$('#block_' + user_id).html('<span class="glyphicon glyphicon-ban-circle" aria-hidden="true" style="padding-top:3px;"></span>ブロック').removeClass("btn-success").addClass("btn-danger");
	}
}
