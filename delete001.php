<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  家計簿システム
 * プログラムＩＤ：delete001
 * 作成日付：	   2009/06/01
 * 最終更新日：	   2008/06/01
 * プログラム説明：情報変更画面
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2009/06/01	紅雷				新規作成
*************************************************************** */
//共通function読み込み
	require('./common.php');
/*
引数
user_id		ユーザーＩＤ[クッキー情報]
date		日付
indexnumber	インデックス
rtnindex	戻り先確認用(0:明細 1:月次集計 2:年次集計)
*/
//共通ヘッダの表示
echo GetHeader($user_id,$conn);

?>
<?php
//条件に合致するデータを取得
	$sql="SELECT DATE_FORMAT(date,'%Y/%m/%d') date,kategori,money,detail,inoutflg,indexnumber FROM kat_inoutdata ".
	"WHERE user_id='".$_COOKIE['user_id']."' AND DATE_FORMAT(date,'%Y%m%d') = '".$_REQUEST["date"]."' AND indexnumber ='".$_REQUEST["indexnumber"]."'";

	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
//データの取得
//変数の初期化
		$ddate="";
		$kategori="";
		$money ="";
		$detail="";
		$indexnumber="";

//取得
		$ddate=$row["date"];
		$kategori=$row["kategori"];
		$money=$row["money"];
		$detail=$row["detail"];
		$inoutflg=$row["inoutflg"];
		$indexnumber=$row["indexnumber"];
	}

?>
		<h4>変更<?php 
if($inoutflg==0){
print("(支出)");
}else{
print("(収入)");
}
?>
</h4>
情報を削除します<br>
<form method="post" name="delete001" action="delete002.php">
<table border=1>
<tr><td>
設定日</td><td><?php print($ddate); ?></td></tr>
<tr><td>
種　別</td><td>
<?php

$sql="SELECT kategori,kategori_name FROM kam_kategori WHERE inoutflg='".$inoutflg."' order by order_no";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
		if($kategori==$row["kategori"]){
        	print($row["kategori_name"]);
		}
	}
?>
</td></tr>
<tr><td>
金額</td><td>
<?php print($money); ?>
</td></tr>
<tr><td>
メモ</td><td><?php print($detail); ?>
</td></tr>
</table>
<p>
<input type="submit" value="　削　除　">　
<input type="button" value="　戻　る　"  onclick="history.back(-1)">　

<?php
print("<INPUT TYPE='HIDDEN' NAME='inoutflg' VALUE='".$inoutflg."'>");
print("<INPUT TYPE='HIDDEN' NAME='indexnumber' VALUE='".$indexnumber."'>");
print("<INPUT TYPE='HIDDEN' NAME='date' VALUE='".$ddate."'>");
print("<INPUT TYPE='HIDDEN' NAME='rtnindex' VALUE='".$_REQUEST["rtnindex"]."'>");

?>
</form>
<?php
//共通フッタの表示
echo GetFooter();
?>