<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Ftotal001
 * �쐬���t�F	   2009/08/24
 * �ŏI�X�V���F	   2008/08/24
 * �v���O���������F�W�v�������
 * �ύX����
 * �ύX����		�ύX�Җ�			����
 * 2009/06/01	�g��				�V�K�쐬
*************************************************************** */
//����function�ǂݍ���
	require('./common.php');

/*
����
user_id			���[�U�[�h�c[�N�b�L�[���]
check_month		�`�F�b�N���錎��
*/
//���t���̎擾
$intTodayYearSQL="SELECT DATE_FORMAT(now(),'%Y') a";
$intTodayYear=GetChkDate($intTodayYearSQL,"a",$conn); //dd �����i���j

//�w��̔N���������ꍇ�͂��̌��̏����擾
if(isset($_REQUEST['check_year'])){
	$intTodayYear=$_REQUEST['check_year'];
}

$nextYear=$intTodayYear+1; //���N
$beforeYear=$intTodayYear-1; //�O�N

//���ʃw�b�_�̕\��
echo GetHeader($user_id,$conn);

?>
<table width="100%" cellpadding="0" cellspacing="0" >
	<tr>
		<td align="left"><b>�W�v(<?php print($intTodayYear."�N");?>)</b></td>

		<td align="right"><a href="total004.php?check_year=<?php print($beforeYear);?>">���O�N</a>�@<a href="total004.php?check_year=<?php print($nextYear);?>">���N��</a></td>
	</tr>
</table>
<div algn="center">
<table><tr><td valign="top">
<br>
<b>����</b>
<br>
<?php
//�����̏W�v�����擾
$sql="select kategori,".
	"(select a.kategori_name from kam_kategori a where a.kategori=kat_inoutdata.kategori and a.inoutflg=kat_inoutdata.inoutflg) k_name,".
	"sum(money) money,inoutflg from kat_inoutdata where user_id='".$_COOKIE['user_id'].
	"' and DATE_FORMAT(date,'%Y')='".$intTodayYear."' and inoutflg='1' group by kategori,inoutflg order by inoutflg,kategori";
	$rs = exSQL($sql,$conn);
print("<table border=1 cellpadding='2' cellspacing='0' >");
print("<tr>");
print("<th bgcolor='#FFFFCC' width='50px' nowrap>��ʖ�</th>");
print("<th bgcolor='#FFFFCC' width='150px'>���v���z</th>");
print("<th bgcolor='#FFFFCC' width='40px'>����</th>");
print("<th bgcolor='#FFFFCC' width='40px'>���׏W�v</th>");
$total_money=0;
	while($row = $rs->fetch_assoc()){
				print("<tr>");
				print("<td nowrap>".$row["k_name"]."</td>");
				print("<td align='right'>".number_format($row["money"])."</td>");
				print("<td><input type='button' value='����' onclick=\"location.href='total005.php?kategori=".$row["kategori"]."&date=".$intTodayYear."';\"></td>");
				print("<td><input type='button' value='���׏W�v' onclick=\"location.href='total006.php?kategori=".$row["kategori"]."&date=".$intTodayYear."';\"></td>");
				print("</tr>");
				$total_money=$total_money + $row["money"];
}
	//���v�l�̕\��
				print("<tr>");
				print("<td bgcolor='#FFEFD5'>���v</td>");
				print("<td colspan=3  bgcolor='#FFEFD5' align='right'>\\".number_format($total_money)."</td>");
				print("</tr></table>");

?>
</td><td>&nbsp&nbsp&nbsp&nbsp
</td><td>
<br>
<b>�x�o</b>
<br>
<?php

$sql="select kategori,".
	"(select a.kategori_name from kam_kategori a where a.kategori=kat_inoutdata.kategori and a.inoutflg=kat_inoutdata.inoutflg) k_name,".
	"sum(money) money,inoutflg from kat_inoutdata where user_id='".$_COOKIE['user_id'].
	"' and DATE_FORMAT(date,'%Y')='".$intTodayYear."' and inoutflg='0' group by kategori,inoutflg order by inoutflg,kategori";
	$rs = exSQL($sql,$conn);
print("<table border=1 cellpadding='2' cellspacing='0' >");
print("<tr>");
print("<th bgcolor='#FFFFCC' width='50px' nowrap>��ʖ�</th>");
print("<th bgcolor='#FFFFCC' width='150px'>���v���z</th>");
print("<th bgcolor='#FFFFCC' width='40px'>����</th>");
print("<th bgcolor='#FFFFCC' width='40px'>���׏W�v</th>");
$total_money=0;
	while($row = $rs->fetch_assoc()){
				print("<tr>");
				print("<td nowrap>".$row["k_name"]."</td>");
				print("<td align='right'>".number_format($row["money"])."</td>");
				print("<td><input type='button' value='����' onclick=\"location.href='total005.php?kategori=".$row["kategori"]."&date=".$intTodayYear."';\"></td>");
				print("<td><input type='button' value='���׏W�v' onclick=\"location.href='total006.php?kategori=".$row["kategori"]."&date=".$intTodayYear."';\"></td>");
				print("</tr>");
				$total_money=$total_money + $row["money"];
}
	//���v�l�̕\��
				print("<tr>");
				print("<td bgcolor='#FFEFD5'>���v</td>");
				print("<td colspan=3  bgcolor='#FFEFD5' align='right'>\\".number_format($total_money)."</td>");
				print("</tr></table>");

?>
</td></tr></table>
</div>
<br>
<?php
//���ʃt�b�^�̕\��
echo GetFooter();

?>