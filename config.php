<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  設定用ファイル
 * プログラムＩＤ：config.php
 * 作成日付：	   2009/06/01
 * 最終更新日：	   2009/06/01
 * プログラム説明：MYSQLとの接続文字列を設定する
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2009/06/01	紅雷				新規作成
 *************************************************************** */
$my_user="kakeibo";
$my_pass="kakeibo";
$my_host="localhost";
$my_conectDB="kakeibo";
$conn = new mysqli($my_host,$my_user,$my_pass,$my_conectDB);

