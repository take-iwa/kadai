ブックマークアプリ＋ユーザー管理
====================
第７回の課題にユーザー管理を追加。　＞＞＞＞　　　提出時は、ブランチ「08_v1.2」<br>
ブックマークの追加と自分のブックマークの編集・削除ができます。<br>
(削除といっても対象レコードの"display"カラムの値をfalseにして表示させていないだけで、実際のデータとしては消してません。)<br>
登録時に入力されたURLのページから画像URLを取得しており、一覧表示では書籍のサムネイル画像が見られます。<br>
<br>
他の人のブックマークには、いいね！とコメントが投稿できます。<br>
<br>
管理者でサインインした場合(email / password = aaa@aaa.us / aaaa)、ユーザー管理者画面に入れます。<br>
※管理者指定は、DBを直接お願いします・・・。<br>
ユーザー管理画面では、ユーザーのブロック/解除が行えます。削除はしません。<br>
ブロックされたユーザーのブックマークは非表示になり、ユーザーはログインできなくなります。<br>
<hr>
自分のXAMPP環境にデータベース「gs_db08」を作ってDBフォルダ内の"gs_bm_table.sql"と"gs_user_talbe.sql"を流し込んでお使いください。<br>

