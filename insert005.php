<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Finsert002
 * �쐬���t�F	   2009/06/01
 * �ŏI�X�V���F	   2008/06/01
 * �v���O���������F�o�^���s���
 * �ύX����
 * �ύX����		�ύX�Җ�			����
 * 2009/06/01	�g��				�V�K�쐬
*************************************************************** */
//����function�ǂݍ���
	require('./common.php');
/*
����
user_id		���[�U�[�h�c[�N�b�L�[���]
inout�@		0�F�x�o�A1�F����

set_date	�ݒ��(0�`9)
kategori	���(0�`9)
money		���z(0�`9)
detail		����(0�`9)
*/

for($i=0;$i<11;$i++){
//�ݒ������̏ꍇ�������Ȃ�
if($_REQUEST["set_date".$i]==""){
	continue;
}

$CNT=0;
//�ݒ��������̃��R�[�h��������
	$sql="SELECT count(*) CNT FROM kat_inoutdata WHERE user_id='".$_COOKIE['user_id']."' and date='".$_REQUEST["set_date".$i]."'";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
        $CNT=$row["CNT"];
	}
//�Y�����{�P��indexnumber�ɐݒ肷��
	$CNT +=1;

//�f�[�^���c�a�ɓo�^
	$sql="INSERT INTO kat_inoutdata VALUES('".$_COOKIE['user_id']."','".$_REQUEST["set_date".$i]."','".$CNT.
	"','".$_REQUEST["money".$i]."','".$_REQUEST["kategori".$i]."','".$_REQUEST["detail".$i]."','".$_REQUEST["inout"]."','0')";
	$rs = exSQL($sql,$conn);
}

//��ʑJ��
	header("location: insert004.php?insert_into=1&inout=".$_REQUEST["inout"]);
?>
