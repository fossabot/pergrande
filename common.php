<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Fcommon.php
 * �쐬���t�F	   2009/06/01
 * �ŏI�X�V���F	   2008/06/01
 * �v���O���������F���ʃ��W���[��
 * �ύX����
 * �ύX����		�ύX�Җ�			����
 * 2009/06/01	�g��				�V�K�쐬
*************************************************************** */

//db�ڑ�������
	require('./config.php');
	ob_start ("ob_gzhandler");

//�Z�L�����e�B�`�F�b�N
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
 sql���s�pFunction�i�j
 �����F	$sql	���s�pSQL
 �Ԃ�l�F���R�[�h�Z�b�g
*/ //**************************************************************************
Function exSQL($sql,$conn){

	$conn->query('SET NAMES sjis');
	$rs = $conn->query($sql);

	return $rs;
}
/******************************************************************************
 �Z�L�����e�B�pFunction�i�j
 �����F	$user_id	���[�U�[��
 		$passWord	�p�X���[�h
 		$conn		�ڑ�������
 �Ԃ�l�F�Z�L�����e�B�\���敪
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
 �Z�L�����e�B�pFunction�i�j
 �����F	$str		�Ώە�����
 �Ԃ�l�F�Í�������������
*/ //**************************************************************************
Function rot13encrypt ($str) {
    return str_rot13(base64_encode($str));
}
/******************************************************************************
 �Z�L�����e�B�pFunction�i�j
 �����F	$str		�Í�������������
 �Ԃ�l�F����������������
*/ //**************************************************************************
Function rot13decrypt ($str) {
    return base64_decode(str_rot13($str));
}

/******************************************************************************
 ���ʃw�b�_�[Function�i�j
 �����F	�Ȃ�
 �Ԃ�l�F�w�b�_�[������html
*/ //**************************************************************************
Function GetHeader($user_id,$conn){

	$HeaderHtml ="";
	$HeaderHtml ="<html>";
	$HeaderHtml =$HeaderHtml."<head>";
	$HeaderHtml =$HeaderHtml."<META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=Shift_JIS'>";
	$HeaderHtml =$HeaderHtml."<link rel='stylesheet' type='text/css' href='css/style.css'>";

	$HeaderHtml =$HeaderHtml."<title>�ƌv��V�X�e��</title>";
	$HeaderHtml =$HeaderHtml."</head>";
	$HeaderHtml =$HeaderHtml."<body>";
	$HeaderHtml =$HeaderHtml."<div id='container'>";
	$HeaderHtml =$HeaderHtml."	<div id='header'>";
	$HeaderHtml =$HeaderHtml."		<br>";
	$HeaderHtml =$HeaderHtml."	</div>";

	$HeaderHtml =$HeaderHtml."	<div id='content'>";
	$HeaderHtml =$HeaderHtml."		<div id='center'>";

	$HeaderHtml =$HeaderHtml."	<div id='banner'>";
	$HeaderHtml =$HeaderHtml."		<h1><strong>�g���@�ƌv��V�X�e��-Pergrande-(���O�C�����[�U�[�F";

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
	$HeaderHtml =$HeaderHtml."				<h1>���j���[</h1>";
	$HeaderHtml =$HeaderHtml."				<a href='index001.php'>�Ɖ�</a>�@";
	$HeaderHtml =$HeaderHtml."				<a href='insert003.php'>�����o�^</a>�@";
	$HeaderHtml =$HeaderHtml."				<a href='total001.php'>�W�v</a>�@";
	if($user_grade ==0){
		$HeaderHtml =$HeaderHtml."				<a href='setting001.php'>�ݒ�</a>�@";
	}
	$HeaderHtml =$HeaderHtml."				<a href='logout001.php'>���O�A�E�g</a>�@";
	$HeaderHtml =$HeaderHtml."			<hr>";
	$HeaderHtml =$HeaderHtml."			<table border=0>";
	$HeaderHtml =$HeaderHtml."				<tr>";
	$HeaderHtml =$HeaderHtml."					<td width='630'>";
	return $HeaderHtml;

}
/******************************************************************************
 ���ʃt�b�^�[Function�i�j
 �����F	�Ȃ�
 �Ԃ�l�F�t�b�^�[������html
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
 ���t�擾�p
 �����F	$sql�@			�擾�p��SQL
 		$returnWord		SQL�ɋL�ڂ̕Ԃ�l
 		$comm�@			�c�a�ڑ�������
 �Ԃ�l�F���ʕ�����
*/ //**************************************************************************
Function GetChkDate($sql,$returnWord,$conn){
	
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
		$return_word=$row[$returnWord];
	}

	return $return_word;

}
/******************************************************************************
 * �N�����w�肵�Č����������߂�֐�
 * $year �N
 * $month ��
*/ //**************************************************************************
Function getMonthEndDay($year,$month){
    //mktime�֐��œ��t��0�ɂ���ƑO���̖������w�肵�����ƂɂȂ�܂�
    //$month + 1 �����Ă��܂����A����13���̂悤�Ȓl�ɂȂ��Ă������ŕ␳����܂�
    $dt = mktime(0, 0, 0, $month + 1, 0, $year);
    return date("d", $dt);
}

/******************************************************************************
 * �N�����Ɖ��Z������n������An�����O�̓��t�����߂�
 * $year �N
 * $month ��
 * $day ��
 * $addMonths ���Z���B�}�C�i�X�w���n�����O���ݒ�\
*/ //**************************************************************************
Function computeMonth($year,$month,$day,$addMonths){
    $month += $addMonths;
    $endDay = getMonthEndDay($year, $month);
    if($day > $endDay) $day = $endDay;
    $dt = mktime(0, 0, 0, $month, $day, $year);//���K��
    return date("Y-m-d", $dt);
}
/******************************************************************************
 * �d��p�̒ǉ�html
 * $top Y���W
 * $left X���W
 * $addMonths �d��ɕK�v�ȃp�[�c�ǉ��L�ڕ�
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
		<td class="cal"><a href="JavaScript:suu(hkazu,'7')">�V</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'8')">�W</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'9')">�X</a></td>
		<td class="cal"><a href="JavaScript:ennzann(hkazu,'/')">��</a></td>
		<td class="cal"><a href="JavaScript:hoka(hkazu,'ce')">CE</a></td>
		</tr>
		<tr align="center">
		<td class="cal"><a href="JavaScript:suu(hkazu,'4')">�S</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'5')">�T</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'6')">�U</a></td>
		<td class="cal"><a href="JavaScript:ennzann(hkazu,'*')">�~</a></td>
		<td class="cal"><a href="JavaScript:hoka(hkazu,'+-');">+/-</a></td>
		</tr>
		<tr align="center">
		<td class="cal"><a href="JavaScript:suu(hkazu,'1')">�P</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'2')">�Q</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'3')">�R</a></td>
		<td class="cal"><a href="JavaScript:ennzann(hkazu,'-')">�|</a></td>
		<td class="cal"><a href="JavaScript:hoka(hkazu,'*/*');"> �� </a></td>
		</tr>
		<tr align="center">
		<td class="cal"><a href="JavaScript:suu(hkazu,'0')">�O</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'00')">00</a></td>
		<td class="cal"><a href="JavaScript:suu(hkazu,'.')">�D</a></td>
		<td class="cal"><a href="JavaScript:ennzann(hkazu,'+')">�{</a></td>
		<td class="cal"><a href="JavaScript:ennzann(hkazu,'');">��</a></td>
		</tr>
		<tr>
		<td colspan=5 align="right" class="link">
			<a href="JavaScript:TextBack1(0)" class="link2">�L�����Z��</a>�@<a href="JavaScript:TextBack1(1)" class="link2">���f</a></td>
		</tr>
		</table>
</table>
</form>
</div>
<?php
}
?>
