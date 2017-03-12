<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  家計簿システム(ペルグランテ)
 * プログラムＩＤ：index
 * 作成日付：	   2009/06/01
 * 最終更新日：	   2012/04/06
 * プログラム説明：家計簿システムトップ画面
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2009/06/01	紅雷				新規作成
 * 2012/04/06	紅雷				当日日付の取得にSQL使っていたものを削除
*************************************************************** */

//共通function読み込み
	require('./common.php');

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
		$sql="select money,inoutflg from kat_inoutdata where user_id='".$_COOKIE['user_id']."' and DATE_FORMAT(date,'%Y%m')='".$strToday_wm."' and del_flg='0'";
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

//共通ヘッダの表示
echo GetHeader($user_id,$conn);

?>
					<h4>照会(<?php print(substr($strToday_wm,0,4)."年".substr($strToday_wm,4,2)."月");?>)</h4>

<table width="100%" cellpadding="0" cellspacing="0" >
	<tr>
		<td>月次収支：<?php print($monthMoney);?>円　(収入：<?php print($inMoneyT);?>円　支出：<?php print($outMoneyT);?>円)</td>
		<td align="right"><a href="index001.php?check_month=<?php print($beforeMonth);?>">＜前月</a>　<a href="index001.php?check_month=<?php print($nextMonth);?>">翌月＞</a></td>
	</tr>
</table>
		<table bgcolor="white" width="100%" border="1" cellpadding="2" cellspacing="0" style="margin:0pt">
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
$day_count=0;
$L_Loop_Count=0;
$F_Loop_Count=$strStartWeek-1;
$week_Count =1; //週カウント用
$chk_cnt=0;
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
							print("<td>&nbsp</td>");
							
						}
					}
				}else{
					print("<tr>");
					$week_Count =$week_Count +1;
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
					if($strSystemDay==$day_count && $strToday_wm==$strSystemDay_wm){
						print("<td bgcolor='#D3E9F7'>");
						print("<b><a class='blocklink_today' href='select001.php?date=");
					}else{
						print("<td>");
						print("<b><a class='blocklink' href='select001.php?date=");
					}
					print($strToday_wm.sprintf("%02d",$day_count)."'>".
					$day_count.
					"</a>\n");
				//収支の合算値を取得
					$sql="select money,inoutflg from kat_inoutdata where user_id='".$_COOKIE['user_id']."' and DATE_FORMAT(date,'%Y%m%d')='".$strToday_wm.sprintf("%02d",$day_count)."'  and del_flg='0'";
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
				//カンマ区切りに変換
					$outMoneyT=number_format($outMoneyT);
					$inMoneyT=number_format($inMoneyT);

					print("<table width=100%><tr><td>入</td><td align='right' nowrap>".$inMoneyT."円</td></tr>");
					print("<tr><td>出</td><td align='right' nowrap>".$outMoneyT."円</td></tr></table>\n");
					print("</td>");
				}
				//最終週の終わり後のブランクを設定
				if($strToay_lastDay==$day_count){
					$Loop_Count=7-$Loop_Count;
//					print($Loop_Count);
						for($j=0;$j<$Loop_Count;$j++){
							print("<td>&nbsp</td>");
					}
				}
				
			if($F_Loop_Count!=7){
				print("</tr>\n");
			}
		}
	}

//共通フッタの表示
echo GetFooter();

?>
