<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  家計簿システム
 * プログラムＩＤ：select001
 * 作成日付：	   2011/04/01
 * 最終更新日：	   2011/04/01
 * プログラム説明：更新検索一覧表示
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2009/06/01	紅雷				新規作成
*************************************************************** */

//共通function読み込み
	require('./common.php');
/*
引数
user_id		ユーザーＩＤ[クッキー情報]
date		該当日付
*/
?>
<html>
		<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=Shift_JIS">
			<script src="HolidayChk.js" language="JavaScript"></script>
			<script src="calendarlay.js" language="JavaScript"></script>
		<title>家計簿システム</title>
		<meta name="viewport" content="width=device-width, user-scalable=no" />
<style>
input.day{width:28pt;height:30pt;background:#FFFFFF; border:1 solid #336666; border-left:1 solid #336666;}
input.detailbutton{background:#FFFFFF; border:1 solid #336666; border-left:1 solid #336666;}
div.title{font-size:9pt;font-weight:bold;color: #FFFFFF;height: 10pt;background-color: #009999}
input.hojobutton{width:70pt;height:20pt;background:#FFFFFF; border:1 solid #336666; border-left:1 solid #336666;}
body{font-size:9pt}
td{font-size:9pt}
th{font-size:9pt}
</style>

		</head>
<body>
<div class="title">　紅雷 家計簿システム -Pergrande-（スマフォ用）</div>
		<h4>照会(<?php print(substr($_REQUEST["date"],0,4)."年".substr($_REQUEST["date"],5,2)."月".substr($_REQUEST["date"],8,2)."日");?>)</h4>
<form>
<b>収入</b>
<br>

<?php
//収入を取得
$sql="select a.indexnumber,a.money,b.kategori_name,a.detail from kat_inoutdata a,kam_kategori b where a.user_id='".$_COOKIE['user_id'].
	"' and DATE_FORMAT(a.date,'%Y-%m-%d')='".$_REQUEST["date"]."' and a.inoutflg='1' and a.kategori=b.kategori  and del_flg='0' ".
	"order by indexnumber";
$rs = exSQL($sql,$conn);
//件数が0の場合、ヘッダを表示しない
if($rs->num_rows==0){
	print("データなし<br>");
}else{
//ヘッダー情報の表示
print("<table border=1 cellpadding='2' cellspacing='0' >");
print("<tr>");
print("<th bgcolor='#FFFFCC' width='50px'>種別</th>");
print("<th bgcolor='#FFFFCC' width='50px'>金額</th>");
print("<th bgcolor='#FFFFCC' width='140px'>メモ</th>");
print("<th bgcolor='#FFFFCC' width='35px'>　</th>");
$total_money=0;
	while($row = $rs->fetch_assoc()){
			$indexnumber=$row["indexnumber"];
			$money=$row["money"];
			$kategori=$row["kategori_name"];
			$detail=$row["detail"];
				print("<tr>");
				print("<td>".$kategori."</td>");
				print("<td align='right'>".number_format($money)."</td>");
				print("<td>".$detail."</td>");
				print("<td><input class='detailbutton' type='button' value='変更' onclick=\"location.href='update001.php?indexnumber=".$indexnumber."&date=".$_REQUEST["date"]."';\"></td>");
				print("</tr>");
				$total_money=$total_money + $money;
	}
	//合計値の表示
				print("<tr>");
				print("<td colspan=2 bgcolor='#FFEFD5'>合計</td>");
				print("<td colspan=2  bgcolor='#FFEFD5' align='right'>￥".number_format($total_money)."</td>");
				print("</tr>");

}
?>
</table>
<br>
<form><input class="detailbutton" type="button" value="収入を追加" onclick="location.href='insert001.php?inout=1&date=<?php print($_REQUEST["date"]); ?>';">
<br><br>
<b>支出</b>
<br>
<?php
//収入を取得
$sql="select a.indexnumber,a.money,b.kategori_name,a.detail from kat_inoutdata a,kam_kategori b where a.user_id='".$_COOKIE['user_id'].
	"' and DATE_FORMAT(a.date,'%Y-%m-%d')='".$_REQUEST["date"]."' and a.inoutflg='0' and a.kategori=b.kategori  and del_flg='0' ".
	"order by indexnumber";
$rs = exSQL($sql,$conn);
if($rs->num_rows==0){
	print("データなし<br>");
}else{
//ヘッダー情報の表示
print("<table border=1 cellpadding='2' cellspacing='0' >");
print("<tr>");
print("<th bgcolor='#FFFFCC' width='50px'>種別</th>");
print("<th bgcolor='#FFFFCC' width='50px'>金額</th>");
print("<th bgcolor='#FFFFCC' width='140px'>メモ</th>");
print("<th bgcolor='#FFFFCC' width='35px'>　</th>");
$total_money=0;
	while($row = $rs->fetch_assoc()){
			$indexnumber=$row["indexnumber"];
			$money=$row["money"];
			$kategori=$row["kategori_name"];
			$detail=$row["detail"];
				print("<tr>");
				print("<td>".$kategori."</td>");
				print("<td align='right'>".number_format($money)."</td>");
				print("<td>".$detail."</td>");
				print("<td><input class='detailbutton' type='button' value='変更' onclick=\"location.href='update001.php?indexnumber=".$indexnumber."&date=".$_REQUEST["date"]."';\"></td>");
				print("</tr>");
				//合計値の算出
				$total_money=$total_money + $money;
	}
//合計値の表示
				print("<tr>");
				print("<td colspan=2 bgcolor='#FFEFD5'>合計</td>");
				print("<td colspan=2  bgcolor='#FFEFD5' align='right'>￥".number_format($total_money)."</td>");
				print("</tr>");
}
?>
</table>
<br>
<input class="detailbutton" type="button" value="支出を追加" onclick="location.href='insert001.php?inout=0&date=<?php print($_REQUEST["date"]); ?>';">
<br>
<br>
<input class="detailbutton" type="button" value="戻る" onclick="location.href='index001.php?check_month=<?php print($_REQUEST["date"]);?>'">
</form>