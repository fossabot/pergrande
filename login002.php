<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  ���O�C�����
 * �v���O�����h�c�Flogin001
 * �쐬���t�F	   2009/06/01
 * �ŏI�X�V���F	   2008/06/01
 * �v���O���������F�ƌv��V�X�e�����O�C���F�؉��
 * �ύX����
 * �ύX����		�ύX�Җ�			����
 * 2009/06/01	�g��				�V�K�쐬
*************************************************************** */

//�A�N�Z�X�ڑ�������
	require('./common.php');

/*���N�G�X�g���擾����ϐ�
username ���[�U�[ID
password�@�p�X���[�h
*/

$passWord=rot13encrypt($_REQUEST['password']);
echo $_REQUEST['username'];
echo $passWord."<br>";

$sql="SELECT count(*) CNT FROM kam_user WHERE login_id='".$_REQUEST['username']."' AND user_pass='".$passWord."'";
$rs = exSQL($sql,$conn);
while($row = $rs->fetch_assoc()){
        $CNT=$row["CNT"];
}
//echo $sql;
if($CNT>0){
	//user_id�̎擾
$sql="SELECT user_id FROM kam_user WHERE login_id='".$_REQUEST['username']."' AND user_pass='".$passWord."'";
$rs = exSQL($sql,$conn);
while($row = $rs->fetch_assoc()){
        $user_id=$row["user_id"];
}

//���[�U�[�p�X�̓u���E�U�I���܂ŗL���ɂ��Ƃ��i���Ԗ��ݒ�̏ꍇ�u���E�U������I���ɂȂ�j
		setcookie("user_id",$user_id);
		setcookie("passWord",$passWord);

//��ʑJ��
	header("location: index001.php");
}else{
//��ʑJ��
	header("location: login001.php");
}

?>
