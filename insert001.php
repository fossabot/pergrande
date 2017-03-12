<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  家計簿システム
 * プログラムＩＤ：insert001
 * 作成日付：	   2009/06/01
 * 最終更新日：	   2008/06/01
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
//共通ヘッダの表示
echo GetHeader($user_id,$conn);

?>
<script language="JavaScript">
	function numberCheck(){
		if(document.insert001.money.value.match(/[^0-9]+/)){
			alert("金額には半角数字を設定してください");
			return false
		}
		return true
	}
	//ウィンドウ表示、非表示ルーチン
	function TextBox1(){
		obj = insert001.money
		hkazu.hyouji.value = insert001.money.value;
		tsuu =hkazu.hyouji.value;
		TextB1.style.visibility = "visible";
	}
	function TextBack1(obj){
		if(obj==1){
			insert001.money.value=hkazu.hyouji.value;
		}
		TextB1.style.visibility = "hidden";
		flag = false;
	}

</script>
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
<tr><td>
設定日</td><td valign="center"><?php print(substr($_REQUEST["date"],0,4)."年".substr($_REQUEST["date"],4,2)."月".substr($_REQUEST["date"],6,2)."日");?></td><td>
<input type="hidden" name="set_date" value="<?php print($_REQUEST["date"]); ?>">
</td></tr>
<tr><td>
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
<tr><td>
金額</td><td>
<input type="text" name="money" value="">　<input type="button" name ="calButton" value="電卓" onclick="TextBox1()">
</td></tr>
<tr><td>
メモ</td><td><input type="text" name="detail" size="70">
</td></tr>
</table>
<p>
<input type="submit" value="　登　録　">　
<input type="button" value="　戻　る　"  onclick="history.back(-1)">　
<?php
print("<INPUT TYPE='HIDDEN' NAME='inout' VALUE='".$_REQUEST['inout']."'>");
?>
</form>


<?php
//電卓の呼び出し
echo calview(250,220);
//共通フッタの表示
echo GetFooter();
?>