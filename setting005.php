<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2010
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Fsetting005
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
	$sql="select max(kategori)+1 max_kategori from kam_kategori";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
        $max_kategori=$row["max_kategori"];
	}

	//db�ɃC���T�[�g����
	$sql="insert into kam_kategori values('".$max_kategori."','".$_REQUEST['kategori_name']."','".$_REQUEST['inout']."','99')";
	$rs = exSQL($sql,$conn);
//print("sql".$sql."<br>");
}else if($_REQUEST['update_mode']=="2"){

	for($i=0;$i<$update_cnt;$i++){
		if($_REQUEST['delflg'.$i]=="1"){
			$sql="delete from kam_kategori where kategori='".$_REQUEST['kategori'.$i]."'";
		}else{
			$sql="update kam_kategori set kategori_name='".$_REQUEST['kategori_name'.$i].
			"',inoutflg='".$_REQUEST['inoutflg'.$i]."',order_no='".$_REQUEST['order_no'.$i]."'".
			" where kategori='".$_REQUEST['kategori'.$i]."'";
		}
	$rs = exSQL($sql,$conn);
	}
}
//��ʑJ��
print("<META HTTP-EQUIV='Refresh' CONTENT ='0 ; URL=setting004.php'>");
//��ʑJ��
	header("location:setting004.php");

?>
