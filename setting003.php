<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Fsetting003
 * �쐬���t�F	   2009/10/21
 * �ŏI�X�V���F	   2008/10/21
 * �v���O���������FDB�X�V���
 * �ύX����
 * �ύX����		�ύX�Җ�			����
 * 2009/10/21	�g��				�V�K�쐬
*************************************************************** */
//����function�ǂݍ���
	require('./common.php');
/*
����
input_id	���O�C���h�c
input_pass	�p�X���[�h
input_kgn	�����i0:�Ǘ��ҁ@1:��ʃ��[�U�[�j
update_mode	�X�V���[�h�i1:�o�^�@2:�X�V�j
*/
$update_cnt=$_REQUEST['update_cnt'];

if($_REQUEST['update_mode']=="1"){
	//�o�^���܂���userid�̍ő�l+1���擾
	$sql="select max(user_id)+1 max_id from kam_user";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
        $max_id=$row["max_id"];
	}
	$i = strlen($max_id);
	$user_id ="0000000000".(string)$max_id;
	$user_id = substr($user_id, $i, 10);

	//db�ɃC���T�[�g����
	$sql="insert into kam_user values('".$user_id."','".$_REQUEST['input_id']."','".rot13encrypt($_REQUEST['input_pass'])."','".$_REQUEST['input_username']."','".$_REQUEST['update_mode']."')";
	$rs = exSQL($sql,$conn);

}else if($_REQUEST['update_mode']=="2"){

	for($i=0;$i<$update_cnt;$i++){
		if($_REQUEST['delflg'.$i]=="1"){
			$sql="delete from kam_user where user_id='".$_REQUEST['user_id'.$i]."'";
		}else{
			$sql="update kam_user set login_id='".$_REQUEST['login_id'.$i].
			"',user_pass='".rot13encrypt($_REQUEST['user_pass'.$i])."',user_name='".$_REQUEST['user_name'.$i]."',user_grade='".$_REQUEST['user_grade'.$i].
			"' where user_id='".$_REQUEST['user_id'.$i]."'";
		}
		$rs = exSQL($sql,$conn);
	}
}

//��ʑJ��
header("location: setting002.php");
?>
