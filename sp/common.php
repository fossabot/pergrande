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
	require('../config.php');
	ob_start ("ob_gzhandler");

//�Z�L�����e�B�`�F�b�N
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
 �����F	$username	���[�U�[��
 		$password	�p�X���[�h
 		$conn		�ڑ�������
 �Ԃ�l�F�Z�L�����e�B�\���敪
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
 ���ʃw�b�_�[Function_���o�C���p�i�j
 �����F	�Ȃ�
 �Ԃ�l�F�w�b�_�[������html
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
	$HeaderHtml =$HeaderHtml."<div class=\"title\">�@�g�� �ƌv��V�X�e�� -Pergrande-�i�X�}�t�H�p�j</div>";
	return $HeaderHtml;

}
/******************************************************************************
 * �d��p�̒ǉ�html
 * $top Y���W
 * $left X���W
 * $addMonths �d��ɕK�v�ȃp�[�c�ǉ��L�ڕ�
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
