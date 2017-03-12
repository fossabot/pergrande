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
//当日
$strSystemDay =date("d"); //dd 当日（日）
$strSystemDay_wm=date("Ym"); //yyyymm　当年月

//指定の月があった場合はその月の情報を取得
if(isset($_REQUEST['check_month'])){
	$year=substr($_REQUEST['check_month'],0,4);
	$month=substr($_REQUEST['check_month'],5,2);
	$targetDay=computeMonth($year,$month,1,0);
	$strToday=1;
	$strToday_wm=$year.$month;
	$strToay_lastDay=date("t",mktime(0, 0, 0, $month, 1, $year));
}else{
	$strToday=$strSystemDay;
	$strToday_wm=$strSystemDay_wm;
	$strToay_lastDay=date("t");
}

$nextMonth=computeMonth(substr($strToday_wm,0,4),substr($strToday_wm,4,2),1,1); //翌月の1日
$beforeMonth=computeMonth(substr($strToday_wm,0,4),substr($strToday_wm,4,2),1,-1); //前月の1日

//共通ヘッダの表示
echo GetHeader($user_id,$conn);

?>
<table width="100%" cellpadding="0" cellspacing="0" >
	<tr>
		<td align="left"><b>集計(<?php print(substr($strToday_wm,0,4)."年".substr($strToday_wm,4,2)."月");?>)</b></td>

		<td align="right"><a href="total002.php?check_month=<?php print($beforeMonth);?>">＜前月</a>　<a href="total002.php?check_month=<?php print($nextMonth);?>">翌月＞</a></td>
	</tr>
</table>
<div align="center">
<table><tr><td valign="top">
<br>
<b>収入</b>
<br>
<?php
//月次の集計情報を取得
$sql="select kategori,".
	"(select a.kategori_name from kam_kategori a where a.kategori=kat_inoutdata.kategori and a.inoutflg=kat_inoutdata.inoutflg) k_name,".
	"sum(money) money,inoutflg from kat_inoutdata where user_id='".$_COOKIE['user_id'].
	"' and DATE_FORMAT(date,'%Y%m')='".$strToday_wm."' and inoutflg='1' and del_flg='0' group by kategori,inoutflg order by inoutflg,kategori";
$rs = exSQL($sql,$conn);
print("<table border=1 cellpadding='2' cellspacing='0' >");
print("<tr>");
print("<th bgcolor='#FFFFCC' width='50px' nowrap>種別名</th>");
print("<th bgcolor='#FFFFCC' width='150px'>合計金額</th>");
print("<th bgcolor='#FFFFCC' width='40px'>明細</th>");
print("<th bgcolor='#FFFFCC' nowrap>明細集計</th>");
$total_money=0;
while($row = $rs->fetch_assoc()){
				print("<tr>");
				print("<td nowrap>".$row["k_name"]."</td>");
				print("<td align='right'>".number_format($row["money"])."</td>");
				print("<td><input type='button' value='明細' onclick=\"location.href='total003.php?kategori=".$row["kategori"]."&date=".$strToday_wm."';\"></td>");
				print("<td><input type='button' value='明細集計' onclick=\"location.href='total007.php?kategori=".$row["kategori"]."&date=".$strToday_wm."';\"></td>");
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
	"' and DATE_FORMAT(date,'%Y%m')='".$strToday_wm."' and inoutflg='0' and del_flg='0' group by kategori,inoutflg order by inoutflg,kategori";
$rs = exSQL($sql,$conn);
print("<table border=1 cellpadding='2' cellspacing='0' >");
print("<tr>");
print("<th bgcolor='#FFFFCC' width='50px' nowrap>種別名</th>");
print("<th bgcolor='#FFFFCC' width='150px'>合計金額</th>");
print("<th bgcolor='#FFFFCC' width='40px'>明細</th>");
print("<th bgcolor='#FFFFCC' nowrap>明細集計</th>");
$total_money=0;
while($row = $rs->fetch_assoc()){
				print("<tr>");
				print("<td nowrap>".$row["k_name"]."</td>");
				print("<td align='right'>".number_format($row["money"])."</td>");
				print("<td><input type='button' value='明細' onclick=\"location.href='total003.php?kategori=".$row["kategori"]."&date=".$strToday_wm."';\"></td>");
				print("<td><input type='button' value='明細集計' onclick=\"location.href='total007.php?kategori=".$row["kategori"]."&date=".$strToday_wm."';\"></td>");
				print("</tr>");
				$total_money=$total_money + $row["money"];
}
	//合計値の表示
				print("<tr>");
				print("<td bgcolor='#FFEFD5'>合計</td>");
				print("<td colspan=3  bgcolor='#FFEFD5' align='right'>\\".number_format($total_money)."</td>");
				print("</tr></table>");


?>
</td></tr>
</table>
</div>

<br>
<?php
//共通フッタの表示
echo GetFooter();

?>