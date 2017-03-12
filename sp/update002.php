<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  家計簿システム
 * プログラムＩＤ：update002
 * 作成日付：	   2009/06/01
 * 最終更新日：	   2008/06/01
 * プログラム説明：変更実行画面
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2009/06/01	紅雷				新規作成
*************************************************************** */
//共通function読み込み
	require('./common.php');
/*
引数
user_id		ユーザーＩＤ[クッキー情報]
date		設定日
kategori	種別
money		金額
detail		メモ
inout　		0：支出、1：収入

*/	
//データをＤＢに登録
	$sql="update kat_inoutdata set money='".$_REQUEST["money"]."',kategori='".$_REQUEST["kategori"]."',detail='".$_REQUEST["detail"]."' ".
		"where user_id='".$_COOKIE['user_id']."' and date='".$_REQUEST["date"]."' and indexnumber='".$_REQUEST["indexnumber"]."' and inoutflg='".$_REQUEST["inoutflg"]."'";
	$rs = exSQL($sql,$conn);

//画面遷移
	header("location: select001.php?date=".$_REQUEST["date"]);

?>
