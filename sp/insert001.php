<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2011
 * プログラム名：  家計簿システム
 * プログラムＩＤ：insert001
 * 作成日付：	   2011/04/01
 * 最終更新日：	   2011/04/01
 * プログラム説明：情報登録画面
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2009/06/01	紅雷				新規作成
*************************************************************** */
//共通function読み込み
	require('./common.php');
/*
引数
inout　0：支出、1：収入
date		該当日付
*/
?>
<html>
		<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=Shift_JIS">
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
<script language="JavaScript">
	function numberCheck(){
		if(document.insert001.money.value.match(/[^0-9]+/)){
			alert("金額には半角数字を設定してください");
			return false
		}
		return true
	}
	function lightInput(obj){

		switch(obj){
		  case 1: document.insert001.kategori.value="10";document.insert001.detail.value="変わらず";break;
		  case 2: document.insert001.kategori.value="1";document.insert001.detail.value="飲み物";break;
		  case 3: document.insert001.kategori.value="1";document.insert001.detail.value="食料の買い込み";break;
		  case 4: document.insert001.kategori.value="17";document.insert001.detail.value="家賃";document.insert001.money.value="80000";break;
		}
	}
	//ウィンドウ表示、非表示ルーチン
	function TextBox1(){
		obj = insert001.money
		hkazu.hyouji.value = insert001.money.value;
		tsuu =hkazu.hyouji.value;
		TextB1.style.visibility = "visible";
	}
	function TextBack1(){
		if(obj==1){
			insert001.money.value=hkazu.hyouji.value;
		}
		TextB1.style.visibility = "hidden";
		flag = false;
	}

</script>
		<title>家計簿システム</title>
		</head>
<body>
<div class="title">　紅雷 家計簿システム -Pergrande-（スマフォ用）</div>
<?php 
if(isset($_REQUEST['insert_into'])){
print("登録完了しました<br>");
}

print("<h4>登録");
if($_REQUEST['inout']==0){
print("(支出)");
}else{
print("(収入)");
}
?>
		</h4>
<form method="post" name="insert001"  onSubmit="return numberCheck()" action="insert002.php">
<table border=0>
<tr><td nowrap>
設定日</td><td valign="center"><?php print(substr($_REQUEST["date"],0,4)."年".substr($_REQUEST["date"],5,2)."月".substr($_REQUEST["date"],8,2)."日");?></td><td>
<input type="hidden" name="set_date" value="<?php print($_REQUEST["date"]); ?>">
</td></tr>
<tr><td nowrap>
種　別</td><td>
<select name="kategori">
<option value="">
<?php

$sql="SELECT kategori,kategori_name FROM kam_kategori WHERE inoutflg='".$_REQUEST['inout']."' order by order_no";
$rs = exSQL($sql,$conn);
while($row = $rs->fetch_assoc()){
        print("<option value='".$row["kategori"]."'>".$row["kategori_name"]);
}
?>
</select>
</td></tr>
<tr><td nowrap>
金額</td><td>
<input type="text" name="money" value="">　<input class="detailbutton" type="button" name ="calButton" value="電卓" onclick="TextBox1()">
</td></tr>
<tr><td>
メモ</td><td><input type="text" name="detail" size="25" value="">
</td></tr>
</table>
<p>
<input class="detailbutton" type="submit" value="　登　録　">　
<input class="detailbutton" type="button" value="　戻　る　"  onclick="location.href='select001.php?date=<?php print($_REQUEST["date"]); ?>'">
<?php
print("<INPUT TYPE='HIDDEN' NAME='inout' VALUE='".$_REQUEST['inout']."'>");

?>
<?php 
if($_REQUEST['inout']==1){
print("<p><b>入力補助ボタン(収入)</b><br>");
print("<input class='hojobutton' type ='button' value='給 料' onclick='javascript:lightInput(1)'>　");
}else{
print("<p><b>入力補助ボタン(支出)</b><br>");
print("<input class='hojobutton' type ='button' value='飲み物' onclick='javascript:lightInput(2)'>　");
print("<input class='hojobutton' type ='button' value='食料の買い込み' onclick='javascript:lightInput(3)'>　");
print("<input class='hojobutton' type ='button' value='家賃' onclick='javascript:lightInput(4)'><br>");

}
?>
</form>
<?php
echo calview(140,50);
?>
</body>
</html>