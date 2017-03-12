<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2012
 * プログラム名：  家計簿システム
 * プログラムＩＤ：insert004
 * 作成日付：	   2012/04/01
 * 最終更新日：	   2012/04/01
 * プログラム説明：情報登録画面(複数一括用)
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
*/

//共通ヘッダの表示
echo GetHeader($user_id,$conn);

if(isset($_REQUEST['insert_into'])){
	print("登録完了しました<br>");
}

print("<h4>複数登録");
if($_REQUEST['inout']==0){
	print("(支出)");
}else{
	print("(収入)");
}
	print("</h4>");

?>
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/date.js" ></script>
<script type="text/javascript" src="js/jquery.datePicker.min.js" ></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/datePicker.css">
<script type="text/javascript">
$(
function(){
	$('.date-pick').datePicker();
	$('.date-pick').dpSetStartDate("1900/01/01");
}
);
</script>
<form method="post" name="insert004"  onSubmit="return numberCheck()" action="insert005.php">
<table bgcolor="white" width="100%" border="1" cellpadding="0" cellspacing="0" style="margin:0pt">
<tr>
		<td bgcolor="#FFFFCC" align="center"  width="10pt" >No</td>
		<td bgcolor="#FFFFCC" align="center"  width="160pt" >設定日</td>
		<td bgcolor="#FFFFCC" align="center"  width="90pt" >種　別</td>
		<td bgcolor="#FFFFCC" align="center"  width="90pt" >金額</td>
		<td bgcolor="#FFFFCC" align="center"  width="90pt" >メモ</td>
</tr>
<?php

//プルダウンの項目を取得
$strOptionText="";
$sql="SELECT kategori,kategori_name FROM kam_kategori WHERE inoutflg='".$_REQUEST['inout']."' order by order_no";
$rs = exSQL($sql,$conn);
while($row = $rs->fetch_assoc()){
        $strOptionText=$strOptionText."<option value='".$row["kategori"]."'>".$row["kategori_name"];
}

for($i=0;$i<10;$i++){
?>
<tr>
<td align="center" ><?php print($i+1);?></td>
<td align="center" valign="center" nowrap><input type="text" name="set_date<?php print($i);?>" size="100pt" value="" class="date-pick" /></td>
<td>
<select name="kategori<?php print($i);?>">
<option value="">
<?php
echo $strOptionText;
?>
</select>
</td>
<td>
<input type="text" name="money<?php print($i);?>" value="" size="10pt">
</td>
<td><input type="text" name="detail<?php print($i);?>" size="30pt">
</td></tr>
<?php
} //for
?>
</table>
<br>
<div align="center">
<input type="submit" value="　登　録　">　
<input type="button" value="　戻　る　"  onclick="location.href='./insert003.php'">　
<?php
print("<INPUT TYPE='HIDDEN' NAME='inout' VALUE='".$_REQUEST['inout']."'>");
?>
</div>
</form>
<?php
//共通フッタの表示
echo GetFooter();
?>