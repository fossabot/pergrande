<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Ftotal002
 * �쐬���t�F	   2013/01/08
 * �ŏI�X�V���F	   2013/01/08
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
date		�Y���N��
*/
//���ʃw�b�_�̕\��
echo GetHeader($user_id,$conn);

?>
		<h4>�Ɖ�(<?php print(substr($_REQUEST["date"],0,4)."�N".substr($_REQUEST["date"],4,2)."��");?>)</h4>
<form>

<b>���׏W�v</b><input type="button" value="�߂�" onclick="location.href='total002.php?check_month=<?php print(substr($_REQUEST["date"],0,4)."-".substr($_REQUEST["date"],4,2)."-".substr($_REQUEST["date"],6,2));?>'">
<br>

<?php
//�������擾
$sql="select sum(a.money) money,b.kategori_name,a.detail,a.inoutflg from kat_inoutdata a,kam_kategori b where a.user_id='".$_COOKIE['user_id'].
	"' and DATE_FORMAT(a.date,'%Y%m')='".$_REQUEST["date"]."' and a.kategori=b.kategori and a.kategori='".$_REQUEST["kategori"]."'".
	"group by b.kategori_name,a.detail,a.inoutflg";

	$rs = exSQL($sql,$conn);
//������0�̏ꍇ�A�w�b�_��\�����Ȃ�
if($rs->num_rows==0){
	print("�f�[�^�Ȃ�<br>");
}else{
//�w�b�_�[���̕\��
print("<table border=1 cellpadding='2' cellspacing='0' >");
print("<tr>");
print("<th bgcolor='#FFFFCC' width='50px'>��ʖ�</th>");
print("<th bgcolor='#FFFFCC' width='160px'>����</th>");
print("<th bgcolor='#FFFFCC' width='50px'>���z</th>");
$total_money=0;
	while($row = $rs->fetch_assoc()){
			$money=$row["money"];
			$kategori=$row["kategori_name"];
			$detail=$row["detail"];
			$inoutflg=$row["inoutflg"];
			if($inoutflg==0){
				$inoutflg="�x�o";
			}else{
				$inoutflg="����";
			}
				print("<tr>");
				print("<td nowrap>".$kategori."</td>");
				print("<td nowrap>".$detail."</td>");
				print("<td align='right'>\\".number_format($money)."</td>");
				print("</tr>");
				$total_money=$total_money + $money;
	}
	//���v�l�̕\��
				print("<tr>");
				print("<td colspan=2 bgcolor='#FFEFD5'>���v</td>");
				print("<td colspan=4  bgcolor='#FFEFD5' align='right'>\\".number_format($total_money)."</td>");
				print("</tr>");

}
?>
</table>
</form>

<?php
//���ʃt�b�^�̕\��
echo GetFooter();

?>