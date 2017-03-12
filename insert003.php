<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2012
 * プログラム名：  家計簿システム
 * プログラムＩＤ：insert003
 * 作成日付：	   2012/04/01
 * 最終更新日：	   2012/04/01
 * プログラム説明：情報登録画面(複数一括用)
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2009/06/01	紅雷				新規作成
*************************************************************** */
//共通function読み込み
	require('./common.php');
//共通ヘッダの表示
echo GetHeader($user_id,$conn);

?>
<h4>複数登録</h4><p>
<a href="./insert004.php?inout=1">収入登録</a></p>
<a href="./insert004.php?inout=0">支出登録</a></p>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php
//共通フッタの表示
echo GetFooter();
?>