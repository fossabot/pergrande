<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Fsetting002
 * �쐬���t�F	   2009/10/21
 * �ŏI�X�V���F	   2008/10/21
 * �v���O���������F���[�U�[�Ǘ����
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
	function update(obj){
		//�X�V���[�h�����y�[�W�Ɉڑ�����i1:�o�^�@2:�ύX�j
		document.ip_in.update_mode.value=obj;

		document.ip_in.submit();
	}
</script>

		</head>
<h4>���[�U�[�Ǘ�</h4><p>
<FORM method="post" name="ip_in" action="setting003.php">
<table>
<tr><td>
���O�C���h�c</td><td>�F<INPUT size="28" value="" maxlength="28" type="text" name="input_id" >
</td></tr><tr><td>
�p�X���[�h</td><td>�F<INPUT size="28" value="" maxlength="28" type="text" name="input_pass" ><br>
</td></tr><tr><td>
���[�U�[��</td><td>�F<INPUT size="28" value="" maxlength="28" type="text" name="input_username" ><br>
</td></tr><tr><td>
�����@�@�@</td><td>�F<select name='input_kgn'><option value=0>�Ǘ���<option value=1 selected>��ʃ��[�U�[</select>
</td></tr>
</table>
<p>
<INPUT size="28" value="�@�o�@�^�@" type="button" onclick="update(1)">�@
<INPUT size="28" value="�@�X�@�V�@" type="button" onclick="update(2)">�@
<INPUT size="28" value="�@�߁@��@" type="button" onclick="location.href='setting001.php'">�@
<INPUT size="0" value="" maxlength="28" type="text" name="dummy" style="visibility:hidden;">
<INPUT value="" type="hidden" name="update_mode">
<p>
<?php
//�o�^�҈ꗗ���擾
	$sql="select user_id,login_id,user_pass,user_name,user_grade from kam_user";

	$rs = exSQL($sql,$conn);

//�w�b�_��\��
	print("<table bgcolor='white' border='1' cellpadding='2' cellspacing='0' style='margin:0pt'>");
	print("<tr><th bgcolor='#FFFFCC' align='center' width='90'>���O�C����</th>");
	print("<th bgcolor='#FFFFCC' align='center' width='90' >�p�X���[�h</th>");
	print("<th bgcolor='#FFFFCC' align='center' width='90' >���[�U�[��</th>");
	print("<th bgcolor='#FFFFCC' align='center' width='30pt' >����</th>");
	print("<th bgcolor='#FFFFCC' align='center' width='30pt' >�폜</th></tr>");

//���e�̎擾�ƕ\��
$rec_cnt=0;
	while($row = $rs->fetch_assoc()){
		$user_id=$row["user_id"];
		$login_id=$row["login_id"];
		$user_pass=rot13decrypt($row["user_pass"]);
		$user_name=$row["user_name"];
		$user_grade=$row["user_grade"];
		
		print("<input type='hidden'name='user_id".$rec_cnt."'value='".$user_id."'>".
		"<tr><td><input type='text'name='login_id".$rec_cnt."'value='".$login_id."'>".
		"</td><td><input type='text' name='user_pass".$rec_cnt."'value='".$user_pass."'>".
		"</td><td><input type='text' name='user_name".$rec_cnt."'value='".$user_name."'>");
		
		print("</td><td><select name='user_grade".$rec_cnt."'>");
		print("<option value='0'");
		if($user_grade=="0"){print(" selected");}
		print(">�Ǘ���");
		
		print("<option value='1'");
		if($user_grade=="1"){print(" selected");}
		print(">��ʃ��[�U�[");
		print("</sclect>");
		
		print("</td><td><input type='checkbox'name='delflg".$rec_cnt."'value='1'></td></tr>");
		$rec_cnt =$rec_cnt + 1;
	}


print("<INPUT value='".$rec_cnt."' type='hidden' name='update_cnt'>");

?>
</form>
<?php
//���ʃt�b�^�̕\��
echo GetFooter();

?>