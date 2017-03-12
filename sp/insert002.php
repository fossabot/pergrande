<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  家計簿システム
 * プログラムＩＤ：insert002
 * 作成日付：	   2009/06/01
 * 最終更新日：	   2008/06/01
 * プログラム説明：登録実行画面
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2009/06/01	紅雷				新規作成
*************************************************************** */
//共通function読み込み
	require('./common.php');
/*
引数
user_id		ユーザーＩＤ[クッキー情報]
set_date	設定日
kategori	種別
money		金額
detail		メモ
inout　		0：支出、1：収入

*/
//設定日が同一のレコード数を検索
	$sql="SELECT count(*) CNT FROM kat_inoutdata WHERE user_id='".$_COOKIE['user_id']."' and date='".$_REQUEST["set_date"]."'";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
        $CNT=$row["CNT"];
	}
//該当数＋１をindexnumberに設定する
	$CNT +=1;
	
//データをＤＢに登録
	$sql="INSERT INTO kat_inoutdata VALUES('".$_COOKIE['user_id']."','".$_REQUEST["set_date"]."','".$CNT.
	"','".$_REQUEST["money"]."','".$_REQUEST["kategori"]."','".$_REQUEST["detail"]."','".$_REQUEST["inout"]."','0')";
	$rs = exSQL($sql,$conn);
//画面遷移
	header("location: select001.php?date=".$_REQUEST["set_date"]);

?>
