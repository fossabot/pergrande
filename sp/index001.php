<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2011
 * �v���O�������F  �ƌv��V�X�e��(�X�}�[�g�t�H���p)
 * �v���O�����h�c�Fsm_index
 * �쐬���t�F	   2011/03/23
 * �ŏI�X�V���F	   2011/03/23
 * �v���O���������F�ƌv��index(���O�C����ʂɑJ��)
 * �ύX����
 * �ύX����		�ύX�Җ�			����
 * 2011/03/23	�g��				�V�K�쐬
*************************************************************** */
//����function�ǂݍ���
	require('./common.php');

/*
����
user_id			���[�U�[�h�c[�N�b�L�[���]
check_month		�`�F�b�N���錎��
*/
//���t���̎擾
//����
$strSystemDay =date("d"); //dd �����i���j
$strSystemDay_wm=date("Ym"); //yyyymm�@���N��

//�w��̌����������ꍇ�͂��̌��̏����擾
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

$nextMonth=computeMonth(substr($strToday_wm,0,4),substr($strToday_wm,4,2),1,1); //������1��
$beforeMonth=computeMonth(substr($strToday_wm,0,4),substr($strToday_wm,4,2),1,-1); //�O����1��

//�����̗j�����擾
$strStartWeek = date("w",mktime(0, 0, 0, substr($strToday_wm,4,2), 1, substr($strToday_wm,0,4)));

	//������ςȂ̎��x�̍��Z�l���擾
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

	//�����̎��x���v�Z
		$monthMoney=$inMoneyT-$outMoneyT;
	//�J���}��؂�ɕϊ�
		$outMoneyT=number_format($outMoneyT);
		$inMoneyT=number_format($inMoneyT);
		$monthMoney=number_format($monthMoney);
?>
<html>
<head>
<title>�g�� �ƌv��V�X�e�� -Pergrande-</title>
<script language="JavaScript">
/*���t�̃{�^�������������ꍇ
@param obj1 �Ώۓ��t
@param obj2 ����
@param obj3 �x�o
*/
function putDayButton(obj1,obj2,obj3){
//	alert(obj1 + " " + obj2 + " " + obj3)
	document.getElementById("inoutDate").innerText="���x(" + obj1 +")";
	document.getElementById("indata").innerText= obj2+"�~";
	document.getElementById("outdata").innerText=obj3 +"�~";
	//���t��hidden���ڂ�ݒ�̏�A�{�^����L���ɂ���
	submitForm.date.value=obj1
	submitForm.detail.disabled  =false;
	submitForm.indata.disabled  =false;
	submitForm.outdata.disabled  =false;
}
/**
�f�[�^�ݒ��ʂɑJ��
param obj 1:���ׁ@2:�����̒ǉ� 3:�x�o�̒ǉ�
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
	<tr><td><b><?php print(substr($strToday_wm,0,4)."�N".substr($strToday_wm,4,2)."��");?></b><br>���x:<?php print($monthMoney);?>(��:��<?php print($inMoneyT);?>�@�o:��<?php print($outMoneyT);?>) </td>
	<td align="right"><a href="index001.php?check_month=<?php print($beforeMonth);?>">��</a>�@<a href="index001.php?check_month=<?php print($nextMonth);?>">��</a></td>
	</tr>
</table>
<table width="100%"  border=1 cellpadding="2" cellspacing="0" style="margin:0pt">
		<tr><td bgcolor="#FFFFCC" align="center" width="14%" width="90" style="color:red">��</td>
		<td bgcolor="#FFFFCC" align="center" width="14%" width="90" >��</td>
		<td bgcolor="#FFFFCC" align="center" width="14%" width="90" >��</td>
		<td bgcolor="#FFFFCC" align="center" width="14%" width="90" >��</td>
		<td bgcolor="#FFFFCC" align="center" width="14%" width="90" >��</td>
		<td bgcolor="#FFFFCC" align="center" width="14%" width="90" >��</td>
		<td bgcolor="#FFFFCC" align="center" width="14%" width="90" style="color:blue">�y</td>
		</tr>
<?php
//�ϐ��̏�����
$i=0;
$chk_cnt=0;
$day_count=0;
$L_Loop_Count=0;
$F_Loop_Count=$strStartWeek-1;
	for($i=0;$i<7;$i++){
		if($strToay_lastDay-$day_count > 0){
				$chk_cnt=$chk_cnt + 1;
				//�ŏ��̂P�T�Ԃ̃X�^�[�g�ʒu�O�̃u�����N��ݒ�
				if($i==0){
					$F_Loop_Count+=1;
					//���j���������̏ꍇ�ȊO�����̏��������s
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
				//���t�ƌ�����\��
				for($j=1;$j<$Loop_Count+1;$j++){
					$day_count=$day_count+1;
				//���x�̍��Z�l���擾
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
				//�\�������̍\�z
					print("<td>");

					if($strSystemDay==$day_count && $strToday_wm==$strSystemDay_wm){
						print("<input type='button' name='day' value='".$day_count."' class='today' onclick=\"putDayButton('".$targetDate."','".$inMoneyT."','".$outMoneyT."')\">");
					}else{
						print("<input type='button' name='day' value='".$day_count."' class='day' onclick=\"putDayButton('".$targetDate."','".$inMoneyT."','".$outMoneyT."')\">");
					}
					print("</td>");
				}
				//�ŏI�T�̏I����̃u�����N��ݒ�
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
<td>�����F</td><td align="right"><div id="indata"></div></td>
</tr>
<tr>
<td>�x�o�F</td><td align="right"><div id="outdata"></div></td>
</tr>
<tr>
<td colspan=2>
<input type="hidden" value="" name="date">
<input type="hidden" value="" name="inout">
<input type="button" value="�@���@�ׁ@" name="detail" class="detailbutton" onclick="submitData(1)" disabled>
<input type="button" value="�����@�ǉ�" name="indata" class="detailbutton" onclick="submitData(2)" disabled>
<input type="button" value="�x�o�@�ǉ�" name="outdata" class="detailbutton" onclick="submitData(3)" disabled>
</form >
</td>
</tr>
</table>
</body>
</html>