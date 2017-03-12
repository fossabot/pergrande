<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  家計簿システム
 * プログラムＩＤ：update001
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
*/

?>
<html>
		<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=Shift_JIS">
			<script src="HolidayChk.js" language="JavaScript"></script>
			<script src="calendarlay.js" language="JavaScript"></script>

<script language="JavaScript">
	function numberCheck(){
		if(document.update001.money.value.match(/[^0-9]+/)){
			alert("金額には半角数字を設定してください");
			return false
		}
		return true
	}
	//ウィンドウ表示、非表示ルーチン
	function TextBox1(){
		obj = update001.money
		hkazu.hyouji.value = update001.money.value;
		tsuu =hkazu.hyouji.value;
		TextB1.style.visibility = "visible";
	}
	function TextBack1(obj){
		if(obj==1){
			update001.money.value=hkazu.hyouji.value;
		}
		TextB1.style.visibility = "hidden";
		flag = false;
	}

</script>
<style>
input.day{width:28pt;height:30pt;background:#FFFFFF; border:1 solid #336666; border-left:1 solid #336666;}
input.detailbutton{background:#FFFFFF; border:1 solid #336666; border-left:1 solid #336666;}
div.title{font-size:9pt;font-weight:bold;color: #FFFFFF;height: 10pt;background-color: #009999}
input.hojobutton{width:70pt;height:20pt;background:#FFFFFF; border:1 solid #336666; border-left:1 solid #336666;}
body{font-size:9pt}
td{font-size:10pt;margin: 0px;padding: 0px;background:#FFFFFF;}
a.blocklink{background:#FFFFFF;text-decoration:none;color:#336666;display:block;width:100%;height:100%;}
td.link{background:#336666;color:#FFFFFF;}
a.link2{background:#336666;text-decoration:none;color:#FFFFFF;width:100%;height:100%;}
a{
	background:#FFFFFF;
	text-decoration:none;
	color:#336666;
}

input.calDisp{
	background:#FFFFFF; 
	border:1 solid #336666; 
	border-left:1 solid #336666;
	font-size:14pt;
}
td.cal{
	font-size:13pt;
	margin: 0px;
	padding: 0px;
	width:30pt;
	height:30pt;
	background:#FFFFFF;
	text-align: center;
	vertical-align: center;
}

</style>
<meta name="viewport" content="width=device-width, user-scalable=no" />

		<title>家計簿システム</title>
		</head>
<body>
<div class="title">　紅雷 家計簿システム -Pergrande-（スマフォ用）</div>
<?php
//条件に合致するデータを取得
	$sql="SELECT DATE_FORMAT(date,'%Y/%m/%d') date,kategori,money,detail,inoutflg,indexnumber FROM kat_inoutdata ".
	"WHERE user_id='".$_COOKIE['user_id']."' AND date = '".$_REQUEST["date"]."' AND indexnumber ='".$_REQUEST["indexnumber"]."'  and del_flg='0' ";

$rs = exSQL($sql,$conn);
//データの取得
	while($row = $rs->fetch_assoc()){
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
情報を変更します<br>
<form method="post" name="update001" onSubmit="return numberCheck()" action="update002.php">
<table>
<tr><td>
設定日</td><td><?php print($ddate); ?></td><td>
</td></tr>
<tr><td>
種　別</td><td>
<select name="kategori">
<option value="">
<?php

$sql="SELECT kategori,kategori_name FROM kam_kategori WHERE inoutflg='".$inoutflg."' order by order_no";
$rs = exSQL($sql,$conn);
//$rs = mysql_query($sql,$conn);
while($row = $rs->fetch_assoc()){
	if($kategori==$row["kategori"]){
        print("<option value='".$row["kategori"]."' selected>".$row["kategori_name"]);
	}else{
        print("<option value='".$row["kategori"]."'>".$row["kategori_name"]);
	}
}
?>
</select>
</td></tr>
<tr><td>
金額</td><td>
<input type="text" name="money" value="<?php print($money); ?>">　<input class="detailbutton" type="button" name ="calButton" value="電卓" onclick="TextBox1()">
</td></tr>
<tr><td>
メモ</td><td><input type="text" name="detail" value="<?php print($detail); ?>" size="25">
</td></tr>
</table>
<p>
<input class="detailbutton" type="submit" value="　変　更　">　
<input class="detailbutton" type="button" value="　戻　る　"  onclick="location.href='select001.php?date=<?php print($_REQUEST["date"]); ?>'">

<?php
print("<INPUT TYPE='HIDDEN' NAME='inoutflg' VALUE='".$inoutflg."'>");
print("<INPUT TYPE='HIDDEN' NAME='indexnumber' VALUE='".$indexnumber."'>");
print("<INPUT TYPE='HIDDEN' NAME='date' VALUE='".$_REQUEST["date"]."'>");

?>
</form>
<?php
echo calview(140,50);
?>

</body>
</html>