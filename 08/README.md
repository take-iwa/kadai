ブックマークアプリ＋ユーザー管理
====================
第７回の課題にユーザー管理を追加。<br>
ブックマークの追加と自分のブックマークの編集・削除ができます。<br>
(削除といっても対象レコードの"display"カラムの値をfalseにして表示させていないだけで、実際のデータとしては消してません。)<br>
<br>
他の人のブックマークには、いいね！とコメントが投稿できます。<br>
自分のXAMPP環境にデータベース「gs_db08」を作ってDBフォルダ内の"gs_bm_table.sql"と"gs_user_talbe.sql"を流し込んでお使いください。<br>
<br>
登録時に入力されたURLのページから画像URLを取得しており、一覧表示では書籍のサムネイル画像が見られます。