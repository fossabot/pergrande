<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  家計簿システム
 * プログラムＩＤ：setting004
 * 作成日付：	   2009/10/21
 * 最終更新日：	   2008/10/21
 * プログラム説明：カテゴリ編集画面
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2009/10/21	紅雷				新規作成
*************************************************************** */
//共通function読み込み
	require('./common.php');
//共通ヘッダの表示
echo GetHeader($user_id,$conn);

?>
<script language="javascript">
	/* *************************************
	 更新Function
	 引数：　なし
	 返り値：なし
	*/ //***********************************
	function update(obj){
		//更新モードを次ページに移送する（1:登録　2:変更）
		document.kategori_in.update_mode.value=obj;
		document.kategori_in.submit();
	}
</script>
<h4>カテゴリ編集</h4><p>
<FORM method="post" name="kategori_in" action="setting005.php">
<table>
<tr><td>
カテゴリ名</td><td>：<INPUT size="28" value="" maxlength="28" type="text" name="kategori_name" >
</td></tr><tr><td>
収支</td><td>：　支出<INPUT value="0" type="radio" name="inout" >　収入<INPUT value="1" type="radio" name="inout" >
</td></tr><tr><td>
</tr>
</table>
<p>
<INPUT size="28" value="　登　録　" type="button" onclick="update(1)">　
<INPUT size="28" value="　更　新　" type="button" onclick="update(2)">　
<INPUT size="28" value="　戻　る　" type="button" onclick="location.href='setting001.php'">　
<INPUT size="0" value="" maxlength="28" type="text" name="dummy" style="visibility:hidden;">
<INPUT value="" type="hidden" name="update_mode">
<p>
<?php
//カテゴリ一覧を取得
	$sql="select kategori,kategori_name,inoutflg,order_no from kam_kategori order by inoutflg,order_no,kategori";
	$rs = exSQL($sql,$conn);

//ヘッダを表示
	print("<table bgcolor='white' border='0' cellpadding='0' cellspacing='10' style='margin:0pt'><tr><td valign='top'>");

	print("<table bgcolor='white' border='1' cellpadding='2' cellspacing='0' style='margin:0pt'>");
	print("<tr><th bgcolor='#FFFFCC' align='center' width='90'>カテゴリ名</th>");
	print("<th bgcolor='#FFFFCC' align='center' width='40'>収支</th>");
	print("<th bgcolor='#FFFFCC' align='center' width='40'>順序</th>");
	print("<th bgcolor='#FFFFCC' align='center' width='32'>削除</th></tr>");

//変数の初期化
$rec_cnt=0;
$kategori="";
$kategori_name="";
$inoutflgbefore=0;
$inoutflg=0;
$order_no=0;

//内容の取得と表示
	while($row = $rs->fetch_assoc()){
		$kategori=$row["kategori"];
		$kategori_name=$row["kategori_name"];
		//１こ前のフラグを保持
		$inoutflgbefore=$inoutflg;
		$inoutflg=$row["inoutflg"];
		$order_no=$row["order_no"];
		//収支でテーブルを分ける
		if($inoutflgbefore <> $inoutflg){
			print("</table>");
			print("</td><td valign='top'>");
			print("<table bgcolor='white' border='1' cellpadding='2' cellspacing='0' style='margin:0pt'>");
			print("<tr><th bgcolor='#FFFFCC' align='center' width='90'>カテゴリ名</th>");
			print("<th bgcolor='#FFFFCC' align='center' width='40'>収支</th>");
			print("<th bgcolor='#FFFFCC' align='center' width='40'>順序</th>");
			print("<th bgcolor='#FFFFCC' align='center' width='32'>削除</th></tr>");
			
		}
		print("<input type='hidden'name='kategori".$rec_cnt."'value='".$kategori."'>".
		"<tr><td><input type='text'name='kategori_name".$rec_cnt."'value='".$kategori_name."'>");
		
		print("</td><td><select name='inoutflg".$rec_cnt."'>");
		print("<option value='0'");
		if($inoutflg=="0"){print(" selected");}
		print(">支出");
		
		print("<option value='1'");
		if($inoutflg=="1"){print(" selected");}
		print(">収入");
		print("</sclect>");
		
//		print("</td><td><input type='text'name='order_no".$rec_cnt."'value='".$order_no."'></td></tr>");
		print("</td><td><select name='order_no".$rec_cnt."'>");
		print("<option value=''>");
		for($j=1;$j<100;$j++){
			print("<option value='".$j."'");
		if($order_no==$j){print(" selected");}
		print(">".$j);
		}
		print("</sclect>");
		
		print("</td><td align='center'>");
		print("<input type='checkbox'name='delflg".$rec_cnt."'value='1'>");
		print("</td></tr>");
		$rec_cnt =$rec_cnt + 1;
	}
print("</table>");
print("</td></tr></table>");


print("<INPUT value='".$rec_cnt."' type='hidden' name='update_cnt'>");

?>
</form>
<?php
//共通フッタの表示
echo GetFooter();
?>