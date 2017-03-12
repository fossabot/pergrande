<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  家計簿システム
 * プログラムＩＤ：total001
 * 作成日付：	   2009/08/24
 * 最終更新日：	   2008/08/24
 * プログラム説明：集計初期画面
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2009/06/01	紅雷				新規作成
*************************************************************** */
//共通function読み込み
	require('./common.php');

/*
引数
user_id			ユーザーＩＤ[クッキー情報]
check_month		チェックする月次
*/
//日付情報の取得
$intTodayYearSQL="SELECT DATE_FORMAT(now(),'%Y') a";
$intTodayYear=GetChkDate($intTodayYearSQL,"a",$conn); //dd 当日（日）

//指定の年があった場合はその月の情報を取得
if(isset($_REQUEST['check_year'])){
	$intTodayYear=$_REQUEST['check_year'];
}

$nextYear=$intTodayYear+1; //翌年
$beforeYear=$intTodayYear-1; //前年

//共通ヘッダの表示
echo GetHeader($user_id,$conn);

?>
<table width="100%" cellpadding="0" cellspacing="0" >
	<tr>
		<td align="left"><b>集計(<?php print($intTodayYear."年");?>)</b></td>

		<td align="right"><a href="total004.php?check_year=<?php print($beforeYear);?>">＜前年</a>　<a href="total004.php?check_year=<?php print($nextYear);?>">翌年＞</a></td>
	</tr>
</table>
<div algn="center">
<table><tr><td valign="top">
<br>
<b>収入</b>
<br>
<?php
//月次の集計情報を取得
$sql="select kategori,".
	"(select a.kategori_name from kam_kategori a where a.kategori=kat_inoutdata.kategori and a.inoutflg=kat_inoutdata.inoutflg) k_name,".
	"sum(money) money,inoutflg from kat_inoutdata where user_id='".$_COOKIE['user_id'].
	"' and DATE_FORMAT(date,'%Y')='".$intTodayYear."' and inoutflg='1' group by kategori,inoutflg order by inoutflg,kategori";
	$rs = exSQL($sql,$conn);
print("<table border=1 cellpadding='2' cellspacing='0' >");
print("<tr>");
print("<th bgcolor='#FFFFCC' width='50px' nowrap>種別名</th>");
print("<th bgcolor='#FFFFCC' width='150px'>合計金額</th>");
print("<th bgcolor='#FFFFCC' width='40px'>明細</th>");
print("<th bgcolor='#FFFFCC' width='40px'>明細集計</th>");
$total_money=0;
	while($row = $rs->fetch_assoc()){
				print("<tr>");
				print("<td nowrap>".$row["k_name"]."</td>");
				print("<td align='right'>".number_format($row["money"])."</td>");
				print("<td><input type='button' value='明細' onclick=\"location.href='total005.php?kategori=".$row["kategori"]."&date=".$intTodayYear."';\"></td>");
				print("<td><input type='button' value='明細集計' onclick=\"location.href='total006.php?kategori=".$row["kategori"]."&date=".$intTodayYear."';\"></td>");
				print("</tr>");
				$total_money=$total_money + $row["money"];
}
	//合計値の表示
				print("<tr>");
				print("<td bgcolor='#FFEFD5'>合計</td>");
				print("<td colspan=3  bgcolor='#FFEFD5' align='right'>\\".number_format($total_money)."</td>");
				print("</tr></table>");

?>
</td><td>&nbsp&nbsp&nbsp&nbsp
</td><td>
<br>
<b>支出</b>
<br>
<?php

$sql="select kategori,".
	"(select a.kategori_name from kam_kategori a where a.kategori=kat_inoutdata.kategori and a.inoutflg=kat_inoutdata.inoutflg) k_name,".
	"sum(money) money,inoutflg from kat_inoutdata where user_id='".$_COOKIE['user_id'].
	"' and DATE_FORMAT(date,'%Y')='".$intTodayYear."' and inoutflg='0' group by kategori,inoutflg order by inoutflg,kategori";
	$rs = exSQL($sql,$conn);
print("<table border=1 cellpadding='2' cellspacing='0' >");
print("<tr>");
print("<th bgcolor='#FFFFCC' width='50px' nowrap>種別名</th>");
print("<th bgcolor='#FFFFCC' width='150px'>合計金額</th>");
print("<th bgcolor='#FFFFCC' width='40px'>明細</th>");
print("<th bgcolor='#FFFFCC' width='40px'>明細集計</th>");
$total_money=0;
	while($row = $rs->fetch_assoc()){
				print("<tr>");
				print("<td nowrap>".$row["k_name"]."</td>");
				print("<td align='right'>".number_format($row["money"])."</td>");
				print("<td><input type='button' value='明細' onclick=\"location.href='total005.php?kategori=".$row["kategori"]."&date=".$intTodayYear."';\"></td>");
				print("<td><input type='button' value='明細集計' onclick=\"location.href='total006.php?kategori=".$row["kategori"]."&date=".$intTodayYear."';\"></td>");
				print("</tr>");
				$total_money=$total_money + $row["money"];
}
	//合計値の表示
				print("<tr>");
				print("<td bgcolor='#FFEFD5'>合計</td>");
				print("<td colspan=3  bgcolor='#FFEFD5' align='right'>\\".number_format($total_money)."</td>");
				print("</tr></table>");

?>
</td></tr></table>
</div>
<br>
<?php
//共通フッタの表示
echo GetFooter();

?>