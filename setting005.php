<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2010
 * プログラム名：  家計簿システム
 * プログラムＩＤ：setting005
 * 作成日付：	   2009/10/21
 * 最終更新日：	   2008/10/21
 * プログラム説明：DB更新画面
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2009/10/21	紅雷				新規作成
*************************************************************** */
//共通function読み込み
	require('./common.php');
/*
引数
input_id	ログインＩＤ
input_pass	パスワード
input_kgn	権限（0:管理者　1:一般ユーザー）
update_mode	更新モード（1:登録　2:更新）
*/
$update_cnt=$_REQUEST['update_cnt'];


if($_REQUEST['update_mode']=="1"){
	//登録時まずはuseridの最大値+1を取得
	$sql="select max(kategori)+1 max_kategori from kam_kategori";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
        $max_kategori=$row["max_kategori"];
	}

	//dbにインサートする
	$sql="insert into kam_kategori values('".$max_kategori."','".$_REQUEST['kategori_name']."','".$_REQUEST['inout']."','99')";
	$rs = exSQL($sql,$conn);
//print("sql".$sql."<br>");
}else if($_REQUEST['update_mode']=="2"){

	for($i=0;$i<$update_cnt;$i++){
		if($_REQUEST['delflg'.$i]=="1"){
			$sql="delete from kam_kategori where kategori='".$_REQUEST['kategori'.$i]."'";
		}else{
			$sql="update kam_kategori set kategori_name='".$_REQUEST['kategori_name'.$i].
			"',inoutflg='".$_REQUEST['inoutflg'.$i]."',order_no='".$_REQUEST['order_no'.$i]."'".
			" where kategori='".$_REQUEST['kategori'.$i]."'";
		}
	$rs = exSQL($sql,$conn);
	}
}
//画面遷移
print("<META HTTP-EQUIV='Refresh' CONTENT ='0 ; URL=setting004.php'>");
//画面遷移
	header("location:setting004.php");

?>
