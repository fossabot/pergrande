<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��(�y���O�����e)
 * �v���O�����h�c�Findex
 * �쐬���t�F	   2009/06/01
 * �ŏI�X�V���F	   2012/04/06
 * �v���O���������F�ƌv��V�X�e���g�b�v���
 * �ύX����
 * �ύX����		�ύX�Җ�			����
 * 2009/06/01	�g��				�V�K�쐬
 * 2012/04/06	�g��				�������t�̎擾��SQL�g���Ă������̂��폜
*************************************************************** */

//����function�ǂݍ���
	require('./common.php');

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

	//�����̎��x���v�Z
		$monthMoney=$inMoneyT-$outMoneyT;
	//�J���}��؂�ɕϊ�
		$outMoneyT=number_format($outMoneyT);
		$inMoneyT=number_format($inMoneyT);
		$monthMoney=number_format($monthMoney);

//���ʃw�b�_�̕\��
echo GetHeader($user_id,$conn);

?>
					<h4>�Ɖ�(<?php print(substr($strToday_wm,0,4)."�N".substr($strToday_wm,4,2)."��");?>)</h4>

<table width="100%" cellpadding="0" cellspacing="0" >
	<tr>
		<td>�������x�F<?php print($monthMoney);?>�~�@(�����F<?php print($inMoneyT);?>�~�@�x�o�F<?php print($outMoneyT);?>�~)</td>
		<td align="right"><a href="index001.php?check_month=<?php print($beforeMonth);?>">���O��</a>�@<a href="index001.php?check_month=<?php print($nextMonth);?>">������</a></td>
	</tr>
</table>
		<table bgcolor="white" width="100%" border="1" cellpadding="2" cellspacing="0" style="margin:0pt">
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
$day_count=0;
$L_Loop_Count=0;
$F_Loop_Count=$strStartWeek-1;
$week_Count =1; //�T�J�E���g�p
$chk_cnt=0;
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
				//���t�ƌ�����\��
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
				//���x�̍��Z�l���擾
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
				//�J���}��؂�ɕϊ�
					$outMoneyT=number_format($outMoneyT);
					$inMoneyT=number_format($inMoneyT);

					print("<table width=100%><tr><td>��</td><td align='right' nowrap>".$inMoneyT."�~</td></tr>");
					print("<tr><td>�o</td><td align='right' nowrap>".$outMoneyT."�~</td></tr></table>\n");
					print("</td>");
				}
				//�ŏI�T�̏I����̃u�����N��ݒ�
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

//���ʃt�b�^�̕\��
echo GetFooter();

?>
