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
set_date	�ݒ��
kategori	���
money		���z
detail		����
inout�@		0�F�x�o�A1�F����

*/
//�ݒ��������̃��R�[�h��������
	$sql="SELECT count(*) CNT FROM kat_inoutdata WHERE user_id='".$_COOKIE['user_id']."' and date='".$_REQUEST["set_date"]."'";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
        $CNT=$row["CNT"];
	}
//�Y�����{�P��indexnumber�ɐݒ肷��
	$CNT +=1;
	
//�f�[�^���c�a�ɓo�^
	$sql="INSERT INTO kat_inoutdata VALUES('".$_COOKIE['user_id']."','".$_REQUEST["set_date"]."','".$CNT.
	"','".$_REQUEST["money"]."','".$_REQUEST["kategori"]."','".$_REQUEST["detail"]."','".$_REQUEST["inout"]."','0')";
	$rs = exSQL($sql,$conn);
//��ʑJ��
	header("location: select001.php?date=".$_REQUEST["set_date"]);

?>
