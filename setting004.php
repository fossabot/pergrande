<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Fsetting004
 * �쐬���t�F	   2009/10/21
 * �ŏI�X�V���F	   2008/10/21
 * �v���O���������F�J�e�S���ҏW���
 * �ύX����
 * �ύX����		�ύX�Җ�			����
 * 2009/10/21	�g��				�V�K�쐬
*************************************************************** */
//����function�ǂݍ���
	require('./common.php');
//���ʃw�b�_�̕\��
echo GetHeader($user_id,$conn);

?>
<script language="javascript">
	/* *************************************
	 �X�VFunction
	 �����F�@�Ȃ�
	 �Ԃ�l�F�Ȃ�
	*/ //***********************************
	function update(obj){
		//�X�V���[�h�����y�[�W�Ɉڑ�����i1:�o�^�@2:�ύX�j
		document.kategori_in.update_mode.value=obj;
		document.kategori_in.submit();
	}
</script>
<h4>�J�e�S���ҏW</h4><p>
<FORM method="post" name="kategori_in" action="setting005.php">
<table>
<tr><td>
�J�e�S����</td><td>�F<INPUT size="28" value="" maxlength="28" type="text" name="kategori_name" >
</td></tr><tr><td>
���x</td><td>�F�@�x�o<INPUT value="0" type="radio" name="inout" >�@����<INPUT value="1" type="radio" name="inout" >
</td></tr><tr><td>
</tr>
</table>
<p>
<INPUT size="28" value="�@�o�@�^�@" type="button" onclick="update(1)">�@
<INPUT size="28" value="�@�X�@�V�@" type="button" onclick="update(2)">�@
<INPUT size="28" value="�@�߁@��@" type="button" onclick="location.href='setting001.php'">�@
<INPUT size="0" value="" maxlength="28" type="text" name="dummy" style="visibility:hidden;">
<INPUT value="" type="hidden" name="update_mode">
<p>
<?php
//�J�e�S���ꗗ���擾
	$sql="select kategori,kategori_name,inoutflg,order_no from kam_kategori order by inoutflg,order_no,kategori";
	$rs = exSQL($sql,$conn);

//�w�b�_��\��
	print("<table bgcolor='white' border='0' cellpadding='0' cellspacing='10' style='margin:0pt'><tr><td valign='top'>");

	print("<table bgcolor='white' border='1' cellpadding='2' cellspacing='0' style='margin:0pt'>");
	print("<tr><th bgcolor='#FFFFCC' align='center' width='90'>�J�e�S����</th>");
	print("<th bgcolor='#FFFFCC' align='center' width='40'>���x</th>");
	print("<th bgcolor='#FFFFCC' align='center' width='40'>����</th>");
	print("<th bgcolor='#FFFFCC' align='center' width='32'>�폜</th></tr>");

//�ϐ��̏�����
$rec_cnt=0;
$kategori="";
$kategori_name="";
$inoutflgbefore=0;
$inoutflg=0;
$order_no=0;

//���e�̎擾�ƕ\��
	while($row = $rs->fetch_assoc()){
		$kategori=$row["kategori"];
		$kategori_name=$row["kategori_name"];
		//�P���O�̃t���O��ێ�
		$inoutflgbefore=$inoutflg;
		$inoutflg=$row["inoutflg"];
		$order_no=$row["order_no"];
		//���x�Ńe�[�u���𕪂���
		if($inoutflgbefore <> $inoutflg){
			print("</table>");
			print("</td><td valign='top'>");
			print("<table bgcolor='white' border='1' cellpadding='2' cellspacing='0' style='margin:0pt'>");
			print("<tr><th bgcolor='#FFFFCC' align='center' width='90'>�J�e�S����</th>");
			print("<th bgcolor='#FFFFCC' align='center' width='40'>���x</th>");
			print("<th bgcolor='#FFFFCC' align='center' width='40'>����</th>");
			print("<th bgcolor='#FFFFCC' align='center' width='32'>�폜</th></tr>");
			
		}
		print("<input type='hidden'name='kategori".$rec_cnt."'value='".$kategori."'>".
		"<tr><td><input type='text'name='kategori_name".$rec_cnt."'value='".$kategori_name."'>");
		
		print("</td><td><select name='inoutflg".$rec_cnt."'>");
		print("<option value='0'");
		if($inoutflg=="0"){print(" selected");}
		print(">�x�o");
		
		print("<option value='1'");
		if($inoutflg=="1"){print(" selected");}
		print(">����");
		print("</sclect>");
		
//		print("</td><td><input type='text'name='order_no".$rec_cnt."'value='".$order_no."'></td></tr>");
		print("</td><td><select name='order_no".$rec_cnt."'>");
		print("<option value=''>");
		for($j=1;$j<100;$j++){
			print("<option value='".$j."'");
		if($order_no==$j){print(" selected");}
		print(">".$j);
		}
		print("</sclect>");
		
		print("</td><td align='center'>");
		print("<input type='checkbox'name='delflg".$rec_cnt."'value='1'>");
		print("</td></tr>");
		$rec_cnt =$rec_cnt + 1;
	}
print("</table>");
print("</td></tr></table>");


print("<INPUT value='".$rec_cnt."' type='hidden' name='update_cnt'>");

?>
</form>
<?php
//���ʃt�b�^�̕\��
echo GetFooter();
?>