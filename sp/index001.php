<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2011
 * プログラム名：  家計簿システム(スマートフォン用)
 * プログラムＩＤ：sm_index
 * 作成日付：	   2011/03/23
 * 最終更新日：	   2011/03/23
 * プログラム説明：家計簿index(ログイン画面に遷移)
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2011/03/23	紅雷				新規作成
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

//初日の曜日を取得
$strStartWeek = date("w",mktime(0, 0, 0, substr($strToday_wm,4,2), 1, substr($strToday_wm,0,4)));

	//しょっぱなの収支の合算値を取得
		$sql="select money,inoutflg from kat_inoutdata where user_id='".$_COOKIE['user_id']."' and DATE_FORMAT(date,'%Y%m')='".$strToday_wm."'  and del_flg='0' ";
		$rs = exSQL($sql,$conn);
		$inMoneyT=0;
		$inMoney=0;
		$outMoneyT=0;
		$outMoney=0;
		while($row = $rs->fetch_assoc()){
			if($row["inoutflg"]=="1"){
				$inMoney=$row["money"];
				$inMoneyT += $inMoney;
			}else{
				$outMoney=$row["money"];
				$outMoneyT += $outMoney;
			}
		}

	//月次の収支を計算
		$monthMoney=$inMoneyT-$outMoneyT;
	//カンマ区切りに変換
		$outMoneyT=number_format($outMoneyT);
		$inMoneyT=number_format($inMoneyT);
		$monthMoney=number_format($monthMoney);
?>
<html>
<head>
<title>紅雷 家計簿システム -Pergrande-</title>
<script language="JavaScript">
/*日付のボタンを押下した場合
@param obj1 対象日付
@param obj2 収入
@param obj3 支出
*/
function putDayButton(obj1,obj2,obj3){
//	alert(obj1 + " " + obj2 + " " + obj3)
	document.getElementById("inoutDate").innerText="収支(" + obj1 +")";
	document.getElementById("indata").innerText= obj2+"円";
	document.getElementById("outdata").innerText=obj3 +"円";
	//日付のhidden項目を設定の上、ボタンを有効にする
	submitForm.date.value=obj1
	submitForm.detail.disabled  =false;
	submitForm.indata.disabled  =false;
	submitForm.outdata.disabled  =false;
}
/**
データ設定画面に遷移
param obj 1:明細　2:収入の追加 3:支出の追加
*/

function submitData(obj){
//	alert(obj)

	if(obj==1){
		document.submitForm.action="select001.php";
	}else if(obj==2){
		document.submitForm.inout.value="1"
		document.submitForm.action="insert001.php";
	}else if(obj==3){
		document.submitForm.inout.value="0"
		document.submitForm.action="insert001.php";
	}

	submitForm.submit();
}

</script>
<?php
echo GetHeaderMov();
?>
<table width="100%" cellpadding="0" cellspacing="0" >
	<tr><td><b><?php print(substr($strToday_wm,0,4)."年".substr($strToday_wm,4,2)."月");?></b><br>収支:<?php print($monthMoney);?>(入:￥<?php print($inMoneyT);?>　出:￥<?php print($outMoneyT);?>) </td>
	<td align="right"><a href="index001.php?check_month=<?php print($beforeMonth);?>">＜</a>　<a href="index001.php?check_month=<?php print($nextMonth);?>">＞</a></td>
	</tr>
</table>
<table width="100%"  border=1 cellpadding="2" cellspacing="0" style="margin:0pt">
		<tr><td bgcolor="#FFFFCC" align="center" width="14%" width="90" style="color:red">日</td>
		<td bgcolor="#FFFFCC" align="center" width="14%" width="90" >月</td>
		<td bgcolor="#FFFFCC" align="center" width="14%" width="90" >火</td>
		<td bgcolor="#FFFFCC" align="center" width="14%" width="90" >水</td>
		<td bgcolor="#FFFFCC" align="center" width="14%" width="90" >木</td>
		<td bgcolor="#FFFFCC" align="center" width="14%" width="90" >金</td>
		<td bgcolor="#FFFFCC" align="center" width="14%" width="90" style="color:blue">土</td>
		</tr>
<?php
//変数の初期化
$i=0;
$chk_cnt=0;
$day_count=0;
$L_Loop_Count=0;
$F_Loop_Count=$strStartWeek-1;
	for($i=0;$i<7;$i++){
		if($strToay_lastDay-$day_count > 0){
				$chk_cnt=$chk_cnt + 1;
				//最初の１週間のスタート位置前のブランクを設定
				if($i==0){
					$F_Loop_Count+=1;
					//日曜日が初日の場合以外ここの処理を実行
					if($F_Loop_Count!=7){
						print("<tr>");
						for($j=1;$j<$F_Loop_Count+1;$j++){
							print("<td><br></td>");
							
						}
					}
				}else{
					print("<tr>");
				}
				if($i==0){
					$Loop_Count = 7 - $F_Loop_Count;
				}else if($strToay_lastDay-($day_count + 7) < 0){
						$Loop_Count=$strToay_lastDay-$day_count;
						$L_Loop_Count=6-$strToay_lastDay-$day_count;
				}else{
					$Loop_Count =7;
				}
				//日付と件数を表示
				for($j=1;$j<$Loop_Count+1;$j++){
					$day_count=$day_count+1;
				//収支の合算値を取得
					$sql="select money,inoutflg from kat_inoutdata where user_id='".$_COOKIE['user_id']."' and DATE_FORMAT(date,'%Y%m%d')='".$strToday_wm.sprintf("%02d",$day_count)."'  and del_flg='0' ";
					$rs = exSQL($sql,$conn);
					$inMoneyT=0;
					$inMoney=0;
					$outMoneyT=0;
					$outMoney=0;
					while($row = $rs->fetch_assoc()){
						if($row["inoutflg"]=="1"){
							$inMoney=$row["money"];
							$inMoneyT += $inMoney;
						}else{
							$outMoney=$row["money"];
							$outMoneyT += $outMoney;
						}
					}
					$outMoneyT=number_format($outMoneyT);
					$inMoneyT=number_format($inMoneyT);
					$targetDate = substr($strToday_wm,0,4)."-".substr($strToday_wm,4,2)."-".sprintf("%02d",$day_count);
				//表示部分の構築
					print("<td>");

					if($strSystemDay==$day_count && $strToday_wm==$strSystemDay_wm){
						print("<input type='button' name='day' value='".$day_count."' class='today' onclick=\"putDayButton('".$targetDate."','".$inMoneyT."','".$outMoneyT."')\">");
					}else{
						print("<input type='button' name='day' value='".$day_count."' class='day' onclick=\"putDayButton('".$targetDate."','".$inMoneyT."','".$outMoneyT."')\">");
					}
					print("</td>");
				}
				//最終週の終わり後のブランクを設定
				if($strToay_lastDay==$day_count){
					$Loop_Count=7-$Loop_Count;
						for($j=0;$j<$Loop_Count;$j++){
							print("<td><br></td>");
					}
				}
				
			if($F_Loop_Count!=7){
				print("</tr>\n");
			}
		}
	}
?>
</table>
</form>

<form name="submitForm" method="post">
<table>
<tr><td><b><div id="inoutDate"></div></b></td><td><br></td></tr>
<tr>
<td>収入：</td><td align="right"><div id="indata"></div></td>
</tr>
<tr>
<td>支出：</td><td align="right"><div id="outdata"></div></td>
</tr>
<tr>
<td colspan=2>
<input type="hidden" value="" name="date">
<input type="hidden" value="" name="inout">
<input type="button" value="　明　細　" name="detail" class="detailbutton" onclick="submitData(1)" disabled>
<input type="button" value="収入　追加" name="indata" class="detailbutton" onclick="submitData(2)" disabled>
<input type="button" value="支出　追加" name="outdata" class="detailbutton" onclick="submitData(3)" disabled>
</form >
</td>
</tr>
</table>
</body>
</html>