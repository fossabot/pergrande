<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  家計簿システム
 * プログラムＩＤ：total002
 * 作成日付：	   2009/06/01
 * 最終更新日：	   2008/06/01
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
date		該当年
*/
//共通ヘッダの表示
echo GetHeader($user_id,$conn);

?>
		<h4>照会(<?php print($_REQUEST["date"]."年");?>)</h4>
<form>

<b>明細</b><input type="button" value="戻る" onclick="location.href='total004.php?check_year=<?php print($_REQUEST["date"]);?>'">
<br>

<?php
//収入を取得
$sql="select a.indexnumber,a.money,b.kategori_name,a.detail,DATE_FORMAT(a.date,'%Y/%m/%d')date,a.inoutflg from kat_inoutdata a,kam_kategori b where a.user_id='".$_COOKIE['user_id'].
	"' and DATE_FORMAT(a.date,'%Y')='".$_REQUEST["date"]."' and a.kategori=b.kategori and a.kategori='".$_REQUEST["kategori"]."'".
	" and del_flg='0' order by date,indexnumber";
	$rs = exSQL($sql,$conn);
//件数が0の場合、ヘッダを表示しない
if($rs->num_rows==0){
	print("データなし<br>");
}else{
//ヘッダー情報の表示
print("<table border=1 cellpadding='2' cellspacing='0' >");
print("<tr>");
print("<th bgcolor='#FFFFCC' width='35px'>種別</th>");
print("<th bgcolor='#FFFFCC' width='35px'>日付</th>");
print("<th bgcolor='#FFFFCC' width='160px'>メモ</th>");
print("<th bgcolor='#FFFFCC' width='35px'>収支</th>");
print("<th bgcolor='#FFFFCC' width='50px'>金額</th>");
print("<th bgcolor='#FFFFCC' width='50px'>&nbsp</th>");
$total_money=0;
	while($row = $rs->fetch_assoc()){
			$indexnumber=$row["indexnumber"];
			$money=$row["money"];
			$kategori=$row["kategori_name"];
			$detail=$row["detail"];
			$inoutflg=$row["inoutflg"];
			if($inoutflg==0){
				$inoutflg="支出";
			}else{
				$inoutflg="収入";
			}
			$date=$row["date"];
			$dateFmt = str_replace("/","",$row["date"]);
				print("<tr>");
				print("<td nowrap>".$kategori."</td>");
				print("<td nowrap>".$date."</td>");
				print("<td nowrap>".$detail."</td>");
				print("<td>".$inoutflg."</td>");
				print("<td align='right'>".number_format($money)."</td>");
				print("<td><input type='button' value='変更' onclick=\"location.href='update001.php?indexnumber=".$indexnumber."&date=".$dateFmt."&rtnindex=2';\"></td>");
				print("</tr>");
				$total_money=$total_money + $money;
	}
	//合計値の表示
				print("<tr>");
				print("<td colspan=2 bgcolor='#FFEFD5'>合計</td>");
				print("<td colspan=4  bgcolor='#FFEFD5' align='right'>\\".number_format($total_money)."</td>");
				print("</tr>");

}
?>
</table>
</form>

<?php
//共通フッタの表示
echo GetFooter();

?>