<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Fdelete001
 * �쐬���t�F	   2009/06/01
 * �ŏI�X�V���F	   2008/06/01
 * �v���O���������F���ύX���
 * �ύX����
 * �ύX����		�ύX�Җ�			����
 * 2009/06/01	�g��				�V�K�쐬
*************************************************************** */
//����function�ǂݍ���
	require('./common.php');
/*
����
user_id		���[�U�[�h�c[�N�b�L�[���]
date		���t
indexnumber	�C���f�b�N�X
rtnindex	�߂��m�F�p(0:���� 1:�����W�v 2:�N���W�v)
*/
//���ʃw�b�_�̕\��
echo GetHeader($user_id,$conn);

?>
<?php
//�����ɍ��v����f�[�^���擾
	$sql="SELECT DATE_FORMAT(date,'%Y/%m/%d') date,kategori,money,detail,inoutflg,indexnumber FROM kat_inoutdata ".
	"WHERE user_id='".$_COOKIE['user_id']."' AND DATE_FORMAT(date,'%Y%m%d') = '".$_REQUEST["date"]."' AND indexnumber ='".$_REQUEST["indexnumber"]."'";

	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
//�f�[�^�̎擾
//�ϐ��̏�����
		$ddate="";
		$kategori="";
		$money ="";
		$detail="";
		$indexnumber="";

//�擾
		$ddate=$row["date"];
		$kategori=$row["kategori"];
		$money=$row["money"];
		$detail=$row["detail"];
		$inoutflg=$row["inoutflg"];
		$indexnumber=$row["indexnumber"];
	}

?>
		<h4>�ύX<?php 
if($inoutflg==0){
print("(�x�o)");
}else{
print("(����)");
}
?>
</h4>
�����폜���܂�<br>
<form method="post" name="delete001" action="delete002.php">
<table border=1>
<tr><td>
�ݒ��</td><td><?php print($ddate); ?></td></tr>
<tr><td>
��@��</td><td>
<?php

$sql="SELECT kategori,kategori_name FROM kam_kategori WHERE inoutflg='".$inoutflg."' order by order_no";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
		if($kategori==$row["kategori"]){
        	print($row["kategori_name"]);
		}
	}
?>
</td></tr>
<tr><td>
���z</td><td>
<?php print($money); ?>
</td></tr>
<tr><td>
����</td><td><?php print($detail); ?>
</td></tr>
</table>
<p>
<input type="submit" value="�@��@���@">�@
<input type="button" value="�@�߁@��@"  onclick="history.back(-1)">�@

<?php
print("<INPUT TYPE='HIDDEN' NAME='inoutflg' VALUE='".$inoutflg."'>");
print("<INPUT TYPE='HIDDEN' NAME='indexnumber' VALUE='".$indexnumber."'>");
print("<INPUT TYPE='HIDDEN' NAME='date' VALUE='".$ddate."'>");
print("<INPUT TYPE='HIDDEN' NAME='rtnindex' VALUE='".$_REQUEST["rtnindex"]."'>");

?>
</form>
<?php
//���ʃt�b�^�̕\��
echo GetFooter();
?>