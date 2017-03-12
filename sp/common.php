<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * プログラム名：  家計簿システム
 * プログラムＩＤ：common.php
 * 作成日付：	   2009/06/01
 * 最終更新日：	   2008/06/01
 * プログラム説明：共通モジュール
 * 変更履歴
 * 変更日時		変更者名			説明
 * 2009/06/01	紅雷				新規作成
*************************************************************** */

//db接続文字列
	require('../config.php');
	ob_start ("ob_gzhandler");

//セキュリティチェック
	$user_id="";
	if(isset($_COOKIE['user_id'])){
		$user_id=$_COOKIE['user_id'];
	}
	$CNT=SecChk($user_id,$conn);

	if($CNT>0){

	}else{
		header("location: login001.php");
	}
/******************************************************************************
 sql実行用Function（）
 引数：	$sql	実行用SQL
 返り値：レコードセット
*/ //**************************************************************************
Function exSQL($sql,$conn){

	$conn->query('SET NAMES sjis');
	$rs = $conn->query($sql);

	return $rs;
}

/******************************************************************************
 セキュリティ用Function（）
 引数：	$username	ユーザー名
 		$password	パスワード
 		$conn		接続文字列
 返り値：セキュリティ表示区分
*/ //**************************************************************************
Function SecChk($user_id,$conn){
	$CNT=0;
	if($user_id==""){
		return $CNT;
	}
	$sql="SELECT count(*) CNT FROM kam_user WHERE user_id='".$user_id."'";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
        $CNT=$row["CNT"];
	}
	return $CNT;
}
/******************************************************************************
 * 年月を指定して月末日を求める関数
 * $year 年
 * $month 月
*/ //**************************************************************************
Function getMonthEndDay($year,$month){
    //mktime関数で日付を0にすると前月の末日を指定したことになります
    //$month + 1 をしていますが、結果13月のような値になっても自動で補正されます
    $dt = mktime(0, 0, 0, $month + 1, 0, $year);
    return date("d", $dt);
}

/******************************************************************************
 * 年月日と加算月からnヶ月後、nヶ月前の日付を求める
 * $year 年
 * $month 月
 * $day 日
 * $addMonths 加算月。マイナス指定でnヶ月前も設定可能
*/ //**************************************************************************
Function computeMonth($year,$month,$day,$addMonths){
    $month += $addMonths;
    $endDay = getMonthEndDay($year, $month);
    if($day > $endDay) $day = $endDay;
    $dt = mktime(0, 0, 0, $month, $day, $year);//正規化
    return date("Y-m-d", $dt);
}
/******************************************************************************
 共通ヘッダーFunction_モバイル用（）
 引数：	なし
 返り値：ヘッダー部分のhtml
*/ //**************************************************************************
Function GetHeaderMov(){
	$HeaderHtml ="<style>";
	$HeaderHtml =$HeaderHtml."input.day{width:28pt;height:30pt;background:#FFFFFF; border:1 solid #336666; border-left:1 solid #336666;}";
	$HeaderHtml =$HeaderHtml."input.today{width:28pt;height:30pt;background:#D3E9F7; border:1 solid #336666; border-left:1 solid #336666;}";
	$HeaderHtml =$HeaderHtml."input.detailbutton{background:#FFFFFF; border:1 solid #336666; border-left:1 solid #336666;width:70pt}";
	$HeaderHtml =$HeaderHtml."div.title{font-size:9pt;font-weight:bold;color: #FFFFFF;height: 10pt;background-color: #009999}";
	$HeaderHtml =$HeaderHtml."input.hojobutton{width:70pt;height:20pt;background:#FFFFFF; border:1 solid #336666; border-left:1 solid #336666;}";
	$HeaderHtml =$HeaderHtml."body{font-size:9pt}";
	$HeaderHtml =$HeaderHtml."td{font-size:10pt}";
	$HeaderHtml =$HeaderHtml."";
	$HeaderHtml =$HeaderHtml."</style>";
	$HeaderHtml =$HeaderHtml."<meta name=\"viewport\" content=\"width=device-width, user-scalable=no\" />";
	$HeaderHtml =$HeaderHtml."</head>";
	$HeaderHtml =$HeaderHtml."<body><form name=\"dayFrom\">";
	$HeaderHtml =$HeaderHtml."<div class=\"title\">　紅雷 家計簿システム -Pergrande-（スマフォ用）</div>";
	return $HeaderHtml;

}
/******************************************************************************
 * 電卓用の追加html
 * $top Y座標
 * $left X座標
 * $addMonths 電卓に必要なパーツ追加記載分
*/ //**************************************************************************
Function calview($top,$left){
?>
<script type="text/javascript" src="../js/cal.js" ></script>
<DIV ID="TextB1" style="position:absolute;top:<?php echo $top; ?>;left:<?php echo $left; ?>;visibility:hidden;z-index:0;">
<form name="hkazu">
<table cellpadding="2">
	<tr ><td align="right">
		<table border="1" cellspacing=0>
		<tr>
		<td colspan=5><input type="text" name="hyouji" size="22" maxlength="22" class="calDisp"></td>
		</td></tr>
		<tr align="center">
		<td class="cal"><a href="JavaScript:suu(hkazu,'7')">７</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'8')">８</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'9')">９</a></td>
		<td class="cal"><a href="JavaScript:ennzann(hkazu,'/')">÷</a></td>
		<td class="cal"><a href="JavaScript:hoka(hkazu,'ce')">CE</a></td>
		</tr>
		<tr align="center">
		<td class="cal"><a href="JavaScript:suu(hkazu,'4')">４</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'5')">５</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'6')">６</a></td>
		<td class="cal"><a href="JavaScript:ennzann(hkazu,'*')">×</a></td>
		<td class="cal"><a href="JavaScript:hoka(hkazu,'+-');">+/-</a></td>
		</tr>
		<tr align="center">
		<td class="cal"><a href="JavaScript:suu(hkazu,'1')">１</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'2')">２</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'3')">３</a></td>
		<td class="cal"><a href="JavaScript:ennzann(hkazu,'-')">－</a></td>
		<td class="cal"><a href="JavaScript:hoka(hkazu,'*/*');"> √ </a></td>
		</tr>
		<tr align="center">
		<td class="cal"><a href="JavaScript:suu(hkazu,'0')">０</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'00')">00</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'.')">．</a></td>
		<td class="cal"><a href="JavaScript:ennzann(hkazu,'+')">＋</a></td>
		<td class="cal"><a href="JavaScript:ennzann(hkazu,'');">＝</a></td>
		</tr>
		<tr>
		<td colspan=5 align="right" class="link">
			<a href="JavaScript:TextBack1(0)" class="link2">キャンセル</a>　<a href="JavaScript:TextBack1(1)" class="link2">反映</a></td>
		</tr>
		</table>
</table>
</form>
</div>
<?php
}
?>
