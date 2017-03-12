<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  家計簿システム
 * プログラムＩＤ：delete002
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
inout　		0：支出、1：収入
rtnindex	戻り先確認用(0:明細 1:月次集計 2:年次集計)
*/	
//データをＤＢに登録
	$sql="update kat_inoutdata set del_flg=1 ".
		"where user_id='".$_COOKIE['user_id']."' and DATE_FORMAT(date,'%Y/%m/%d')='".$_REQUEST["date"]."' and indexnumber='".$_REQUEST["indexnumber"]."' and inoutflg='".$_REQUEST["inoutflg"]."'";
	$rs = exSQL($sql,$conn);
$rtnindex = $_REQUEST["rtnindex"];
//画面遷移
	if($rtnindex==0){
		header("location: select001.php?date=".substr($_REQUEST["date"],0,4).substr($_REQUEST["date"],5,2).substr($_REQUEST["date"],8,2));
	}else if($rtnindex==1){
		header("location: total003.php?date=".substr($_REQUEST["date"],0,4).substr($_REQUEST["date"],5,2)."&kategori=".$_REQUEST["kategori"]);
	}else if($rtnindex==2){
		header("location: total005.php?date=".substr($_REQUEST["date"],0,4)."&kategori=".$_REQUEST["kategori"]);
	}else{
		header("location: select001.php?date=".substr($_REQUEST["date"],0,4).substr($_REQUEST["date"],5,2).substr($_REQUEST["date"],8,2));
	}
?>
