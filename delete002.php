<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Fdelete002
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
inout�@		0�F�x�o�A1�F����
rtnindex	�߂��m�F�p(0:���� 1:�����W�v 2:�N���W�v)
*/	
//�f�[�^���c�a�ɓo�^
	$sql="update kat_inoutdata set del_flg=1 ".
		"where user_id='".$_COOKIE['user_id']."' and DATE_FORMAT(date,'%Y/%m/%d')='".$_REQUEST["date"]."' and indexnumber='".$_REQUEST["indexnumber"]."' and inoutflg='".$_REQUEST["inoutflg"]."'";
	$rs = exSQL($sql,$conn);
$rtnindex = $_REQUEST["rtnindex"];
//��ʑJ��
	if($rtnindex==0){
		header("location: select001.php?date=".substr($_REQUEST["date"],0,4).substr($_REQUEST["date"],5,2).substr($_REQUEST["date"],8,2));
	}else if($rtnindex==1){
		header("location: total003.php?date=".substr($_REQUEST["date"],0,4).substr($_REQUEST["date"],5,2)."&kategori=".$_REQUEST["kategori"]);
	}else if($rtnindex==2){
		header("location: total005.php?date=".substr($_REQUEST["date"],0,4)."&kategori=".$_REQUEST["kategori"]);
	}else{
		header("location: select001.php?date=".substr($_REQUEST["date"],0,4).substr($_REQUEST["date"],5,2).substr($_REQUEST["date"],8,2));
	}
?>
