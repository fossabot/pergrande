<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Fselect001
 * �쐬���t�F	   2009/06/01
 * �ŏI�X�V���F	   2008/06/01
 * �v���O���������F�X�V�����ꗗ�\��
 * �ύX����
 * �ύX����		�ύX�Җ�			����
 * 2009/06/01	�g��				�V�K�쐬
*************************************************************** */

//����function�ǂݍ���
	require('./common.php');
/*
����
user_id		���[�U�[�h�c[�N�b�L�[���]
date		�Y�����t
*/
//���ʃw�b�_�̕\��
echo GetHeader($user_id,$conn);

?>

		<h4>�Ɖ�(<?php print(substr($_REQUEST["date"],0,4)."�N".substr($_REQUEST["date"],4,2)."��".substr($_REQUEST["date"],6,2)."��");?>)</h4>
<form>
<b>����</b>
<br>

<?php
//�������擾
$sql="select a.indexnumber,a.money,b.kategori_name,a.detail from kat_inoutdata a,kam_kategori b where a.user_id='".$_COOKIE['user_id'].
	"' and DATE_FORMAT(a.date,'%Y%m%d')='".$_REQUEST["date"]."' and a.inoutflg='1' and a.kategori=b.kategori and del_flg='0' ".
	"order by indexnumber";
	$rs = exSQL($sql,$conn);
//������0�̏ꍇ�A�w�b�_��\�����Ȃ�
if($rs->num_rows==0){
	print("�f�[�^�Ȃ�<br>");
}else{
//�w�b�_�[���̕\��
print("<table border=1 cellpadding='2' cellspacing='0' >");
print("<tr>");
print("<th bgcolor='#FFFFCC' width='35px'>���</th>");
print("<th bgcolor='#FFFFCC' width='50px'>���z</th>");
print("<th bgcolor='#FFFFCC' width='160px'>����</th>");
print("<th bgcolor='#FFFFCC' width='35px'>�@</th>");
print("<th bgcolor='#FFFFCC' width='35px'>�@</th>");
$total_money=0;
	while($row = $rs->fetch_assoc()){
			$indexnumber=$row["indexnumber"];
			$money=$row["money"];
			$kategori=$row["kategori_name"];
			$detail=$row["detail"];
				print("<tr>");
				print("<td nowrap>".$kategori."</td>");
				print("<td align='right'>".number_format($money)."</td>");
				print("<td>".$detail."</td>");
				print("<td><input type='button' value='�ύX' onclick=\"location.href='update001.php?indexnumber=".$indexnumber."&date=".$_REQUEST["date"]."&rtnindex=0';\"></td>");
				print("<td><input type='button' value='�폜' onclick=\"location.href='delete001.php?indexnumber=".$indexnumber."&date=".$_REQUEST["date"]."&rtnindex=0';\"></td>");
				print("</tr>");
				$total_money=$total_money + $money;
	}
	//���v�l�̕\��
				print("<tr>");
				print("<td colspan=2 bgcolor='#FFEFD5'>���v</td>");
				print("<td colspan=3  bgcolor='#FFEFD5' align='right'>\\".number_format($total_money)."</td>");
				print("</tr></table>");

}
?>
<br>
<form><input type="button" value="������ǉ�" onclick="location.href='insert001.php?inout=1&date=<?php print($_REQUEST["date"]); ?>';">
<br><br>
<b>�x�o</b>
<br>
<?php
//�������擾
$sql="select a.indexnumber,a.money,b.kategori_name,a.detail from kat_inoutdata a,kam_kategori b where a.user_id='".$_COOKIE['user_id'].
	"' and DATE_FORMAT(a.date,'%Y%m%d')='".$_REQUEST["date"]."' and a.inoutflg='0' and a.kategori=b.kategori  and del_flg='0' ".
	"order by indexnumber";
$rs = exSQL($sql,$conn);
if($rs->num_rows==0){
	print("�f�[�^�Ȃ�<br>");
}else{
//�w�b�_�[���̕\��
print("<table border=1 cellpadding='2' cellspacing='0' >");
print("<tr>");
print("<th bgcolor='#FFFFCC' width='35px'>���</th>");
print("<th bgcolor='#FFFFCC' width='50px'>���z</th>");
print("<th bgcolor='#FFFFCC' width='160px'>����</th>");
print("<th bgcolor='#FFFFCC' width='35px'>�@</th>");
print("<th bgcolor='#FFFFCC' width='35px'>�@</th>");
$total_money=0;
	while($row = $rs->fetch_assoc()){
			$indexnumber=$row["indexnumber"];
			$money=$row["money"];
			$kategori=$row["kategori_name"];
			$detail=$row["detail"];
				print("<tr>");
				print("<td nowrap>".$kategori."</td>");
				print("<td align='right'>".number_format($money)."</td>");
				print("<td>".$detail."</td>");
				print("<td><input type='button' value='�ύX' onclick=\"location.href='update001.php?indexnumber=".$indexnumber."&date=".$_REQUEST["date"]."&rtnindex=0';\"></td>");
				print("<td><input type='button' value='�폜' onclick=\"location.href='delete001.php?indexnumber=".$indexnumber."&date=".$_REQUEST["date"]."&rtnindex=0';\"></td>");
				print("</tr>");
				//���v�l�̎Z�o
				$total_money=$total_money + $money;
	}
//���v�l�̕\��
				print("<tr>");
				print("<td colspan=2 bgcolor='#FFEFD5'>���v</td>");
				print("<td colspan=3  bgcolor='#FFEFD5' align='right'>\\".number_format($total_money)."</td>");
				print("</tr></table>");
}
?>

<br>
<input type="button" value="�x�o��ǉ�" onclick="location.href='insert001.php?inout=0&date=<?php print($_REQUEST["date"]); ?>';">
<br>
<br>
<input type="button" value="�߂�" onclick="location.href='index001.php?check_month=<?php print(substr($_REQUEST["date"],0,4)."-".substr($_REQUEST["date"],4,2)."-".substr($_REQUEST["date"],6,2));?>'">
</form>
<?php
//���ʃt�b�^�̕\��
echo GetFooter();

?>