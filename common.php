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
	require('./config.php');
	ob_start ("ob_gzhandler");

//セキュリティチェック
	$user_id="";
	if(isset($_COOKIE['user_id'])){
		$user_id=$_COOKIE['user_id'];
		$passWord=$_COOKIE['passWord'];
	}
	$CNT=SecChk($user_id,$passWord,$conn);

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
 引数：	$user_id	ユーザー名
 		$passWord	パスワード
 		$conn		接続文字列
 返り値：セキュリティ表示区分
*/ //**************************************************************************
Function SecChk($user_id,$passWord,$conn){
	$CNT=0;
	if($user_id==""){
		return $CNT;
	}
	$sql="SELECT count(*) CNT FROM kam_user WHERE user_id='".$user_id."' AND user_pass='".$passWord."'";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
        $CNT=$row["CNT"];
	}
	return $CNT;
}
/******************************************************************************
 セキュリティ用Function（）
 引数：	$str		対象文字列
 返り値：暗号化した文字列
*/ //**************************************************************************
Function rot13encrypt ($str) {
    return str_rot13(base64_encode($str));
}
/******************************************************************************
 セキュリティ用Function（）
 引数：	$str		暗号化した文字列
 返り値：復号化した文字列
*/ //**************************************************************************
Function rot13decrypt ($str) {
    return base64_decode(str_rot13($str));
}

/******************************************************************************
 共通ヘッダーFunction（）
 引数：	なし
 返り値：ヘッダー部分のhtml
*/ //**************************************************************************
Function GetHeader($user_id,$conn){

	$HeaderHtml ="";
	$HeaderHtml ="<html>";
	$HeaderHtml =$HeaderHtml."<head>";
	$HeaderHtml =$HeaderHtml."<META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=Shift_JIS'>";
	$HeaderHtml =$HeaderHtml."<link rel='stylesheet' type='text/css' href='css/style.css'>";

	$HeaderHtml =$HeaderHtml."<title>家計簿システム</title>";
	$HeaderHtml =$HeaderHtml."</head>";
	$HeaderHtml =$HeaderHtml."<body>";
	$HeaderHtml =$HeaderHtml."<div id='container'>";
	$HeaderHtml =$HeaderHtml."	<div id='header'>";
	$HeaderHtml =$HeaderHtml."		<br>";
	$HeaderHtml =$HeaderHtml."	</div>";

	$HeaderHtml =$HeaderHtml."	<div id='content'>";
	$HeaderHtml =$HeaderHtml."		<div id='center'>";

	$HeaderHtml =$HeaderHtml."	<div id='banner'>";
	$HeaderHtml =$HeaderHtml."		<h1><strong>紅雷　家計簿システム-Pergrande-(ログインユーザー：";

	$sql="SELECT user_name,user_grade FROM kam_user WHERE user_id='".$user_id."'";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
        $user_name=$row["user_name"];
		$user_grade=$row["user_grade"];
	}
	$HeaderHtml =$HeaderHtml.$user_name;

	$HeaderHtml =$HeaderHtml.")</strong></h1>";
	$HeaderHtml =$HeaderHtml."	</div>";
	$HeaderHtml =$HeaderHtml."			<div class='content02'>";
	$HeaderHtml =$HeaderHtml."				<h1>メニュー</h1>";
	$HeaderHtml =$HeaderHtml."				<a href='index001.php'>照会</a>　";
	$HeaderHtml =$HeaderHtml."				<a href='insert003.php'>複数登録</a>　";
	$HeaderHtml =$HeaderHtml."				<a href='total001.php'>集計</a>　";
	if($user_grade ==0){
		$HeaderHtml =$HeaderHtml."				<a href='setting001.php'>設定</a>　";
	}
	$HeaderHtml =$HeaderHtml."				<a href='logout001.php'>ログアウト</a>　";
	$HeaderHtml =$HeaderHtml."			<hr>";
	$HeaderHtml =$HeaderHtml."			<table border=0>";
	$HeaderHtml =$HeaderHtml."				<tr>";
	$HeaderHtml =$HeaderHtml."					<td width='630'>";
	return $HeaderHtml;

}
/******************************************************************************
 共通フッターFunction（）
 引数：	なし
 返り値：フッター部分のhtml
*/ //**************************************************************************

Function GetFooter(){
?>
</td></tr>
</table>
					</td>
				</tr>
			</table>
			</div>
			<div id='footer'>
			All Rights Reserved, Copyright(C) korai 2011
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php
}
/******************************************************************************
 日付取得用
 引数：	$sql　			取得用のSQL
 		$returnWord		SQLに記載の返り値
 		$comm　			ＤＢ接続文字列
 返り値：結果文字列
*/ //**************************************************************************
Function GetChkDate($sql,$returnWord,$conn){
	
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
		$return_word=$row[$returnWord];
	}

	return $return_word;

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
 * 電卓用の追加html
 * $top Y座標
 * $left X座標
 * $addMonths 電卓に必要なパーツ追加記載分
*/ //**************************************************************************
Function calview($top,$left){
?>
<script type="text/javascript" src="js/cal.js" ></script>
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
