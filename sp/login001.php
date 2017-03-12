<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2011
 * プログラム名：  ログイン画面
 * プログラムＩＤ：login001
 * 作成日付：	   2011/03/23
 * 最終更新日：	   2011/03/23
 * プログラム説明：家計簿システムログイン画面
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2011/03/23	紅雷				新規作成
*************************************************************** */

?>
<html>
<head>
<title>紅雷 家計簿システム -Pergrande-</title>
<link rel='stylesheet' type='text/css' href='style.css'>
<meta name="viewport" content="width=device-width, user-scalable=no" />
</head>
<body>
<form method="post" name="login001" action="login002.php">
<div class="title">　紅雷 家計簿システム -Pergrande-（スマフォ用）</div>
<table>
<tr>
<td><b>ログイン画面</b></td>
</tr>
<tr>
<td>ユーザーID</td><td><input type="text" name ="username" class="detail"></td>
</tr>
<tr>
<td>パスワード</td><td><input type="password" name ="password"  class="detail"></td>
</tr>
<tr><td colspan=2 align="center"><br>
<input type="submit" value="ログイン" class="detail">
</td></tr>
</table>
</form>

</body>
</html>