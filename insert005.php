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
inout　		0：支出、1：収入

set_date	設定日(0〜9)
kategori	種別(0〜9)
money		金額(0〜9)
detail		メモ(0〜9)
*/

for($i=0;$i<11;$i++){
//設定日が空の場合処理しない
if($_REQUEST["set_date".$i]==""){
	continue;
}

$CNT=0;
//設定日が同一のレコード数を検索
	$sql="SELECT count(*) CNT FROM kat_inoutdata WHERE user_id='".$_COOKIE['user_id']."' and date='".$_REQUEST["set_date".$i]."'";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
        $CNT=$row["CNT"];
	}
//該当数＋１をindexnumberに設定する
	$CNT +=1;

//データをＤＢに登録
	$sql="INSERT INTO kat_inoutdata VALUES('".$_COOKIE['user_id']."','".$_REQUEST["set_date".$i]."','".$CNT.
	"','".$_REQUEST["money".$i]."','".$_REQUEST["kategori".$i]."','".$_REQUEST["detail".$i]."','".$_REQUEST["inout"]."','0')";
	$rs = exSQL($sql,$conn);
}

//画面遷移
	header("location: insert004.php?insert_into=1&inout=".$_REQUEST["inout"]);
?>
