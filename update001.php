<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Fupdate001
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
<script language="JavaScript">
	function numberCheck(){
		if(document.update001.money.value.match(/[^0-9]+/)){
			alert("���z�ɂ͔��p������ݒ肵�Ă�������");
			return false
		}
		return true
	}
	//�E�B���h�E�\���A��\�����[�`��
	function TextBox1(){
		obj = update001.money
		hkazu.hyouji.value = obj.value;
		tsuu =hkazu.hyouji.value;
		TextB1.style.visibility = "visible";
	}
	function TextBack1(obj){
		if(obj==1){
			update001.money.value=hkazu.hyouji.value;
		}
		TextB1.style.visibility = "hidden";
		flag = false;
	}

</script>
<?php
//�����ɍ��v����f�[�^���擾
	$sql="SELECT DATE_FORMAT(date,'%Y/%m/%d') date,kategori,money,detail,inoutflg,indexnumber FROM kat_inoutdata ".
	"WHERE user_id='".$_COOKIE['user_id']."' AND DATE_FORMAT(date,'%Y%m%d') = '".$_REQUEST["date"]."' AND indexnumber ='".$_REQUEST["indexnumber"]."'";

	$rs = exSQL($sql,$conn);

//�f�[�^�̎擾
	while($row = $rs->fetch_assoc()){
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
����ύX���܂�<br>
<form method="post" name="update001" onSubmit="return numberCheck()" action="update002.php">
<table>
<tr><td>
�ݒ��</td><td><?php print($ddate); ?></td><td>
</td></tr>
<tr><td>
��@��</td><td>
<select name="kategori">
<option value="">
<?php

$sql="SELECT kategori,kategori_name FROM kam_kategori WHERE inoutflg='".$inoutflg."' order by order_no";
$rs = exSQL($sql,$conn);
while($row = $rs->fetch_assoc()){
	if($kategori==$row["kategori"]){
        print("<option value='".$row["kategori"]."' selected>".$row["kategori_name"]);
	}else{
        print("<option value='".$row["kategori"]."'>".$row["kategori_name"]);
	}
}
?>
</select>
</td></tr>
<tr><td>
���z</td><td>
<input type="text" name="money" value="<?php print($money); ?>">�@<input type="button" name ="calButton" value="�d��" onclick="TextBox1()">
</td></tr>
<tr><td>
����</td><td><input type="text" name="detail" value="<?php print($detail); ?>" size="70">
</td></tr>
</table>
<p>
<input type="submit" value="�@�ρ@�X�@">�@
<input type="button" value="�@�߁@��@"  onclick="history.back(-1)">�@

<?php
print("<INPUT TYPE='HIDDEN' NAME='inoutflg' VALUE='".$inoutflg."'>");
print("<INPUT TYPE='HIDDEN' NAME='indexnumber' VALUE='".$indexnumber."'>");
print("<INPUT TYPE='HIDDEN' NAME='date' VALUE='".$ddate."'>");
print("<INPUT TYPE='HIDDEN' NAME='rtnindex' VALUE='".$_REQUEST["rtnindex"]."'>");

?>
</form>
<?php
//�d��̌Ăяo��
echo calview(270,220);
//���ʃt�b�^�̕\��
echo GetFooter();
?>