<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Fupdate002
 * �쐬���t�F	   2009/06/01
 * �ŏI�X�V���F	   2008/06/01
 * �v���O���������F�ύX���s���
 * �ύX����
 * �ύX����		�ύX�Җ�			����
 * 2009/06/01	�g��				�V�K�쐬
*************************************************************** */
//����function�ǂݍ���
	require('./common.php');
/*
����
user_id		���[�U�[�h�c[�N�b�L�[���]
date		�ݒ��
kategori	���
money		���z
detail		����
inout�@		0�F�x�o�A1�F����

*/	
//�f�[�^���c�a�ɓo�^
	$sql="update kat_inoutdata set money='".$_REQUEST["money"]."',kategori='".$_REQUEST["kategori"]."',detail='".$_REQUEST["detail"]."' ".
		"where user_id='".$_COOKIE['user_id']."' and date='".$_REQUEST["date"]."' and indexnumber='".$_REQUEST["indexnumber"]."' and inoutflg='".$_REQUEST["inoutflg"]."'";
	$rs = exSQL($sql,$conn);

//��ʑJ��
	header("location: select001.php?date=".$_REQUEST["date"]);

?>
