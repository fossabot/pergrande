<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2012
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Finsert004
 * �쐬���t�F	   2012/04/01
 * �ŏI�X�V���F	   2012/04/01
 * �v���O���������F���o�^���(�����ꊇ�p)
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
*/

//���ʃw�b�_�̕\��
echo GetHeader($user_id,$conn);

if(isset($_REQUEST['insert_into'])){
	print("�o�^�������܂���<br>");
}

print("<h4>�����o�^");
if($_REQUEST['inout']==0){
	print("(�x�o)");
}else{
	print("(����)");
}
	print("</h4>");

?>
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/date.js" ></script>
<script type="text/javascript" src="js/jquery.datePicker.min.js" ></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/datePicker.css">
<script type="text/javascript">
$(
function(){
	$('.date-pick').datePicker();
	$('.date-pick').dpSetStartDate("1900/01/01");
}
);
</script>
<form method="post" name="insert004"  onSubmit="return numberCheck()" action="insert005.php">
<table bgcolor="white" width="100%" border="1" cellpadding="0" cellspacing="0" style="margin:0pt">
<tr>
		<td bgcolor="#FFFFCC" align="center"  width="10pt" >No</td>
		<td bgcolor="#FFFFCC" align="center"  width="160pt" >�ݒ��</td>
		<td bgcolor="#FFFFCC" align="center"  width="90pt" >��@��</td>
		<td bgcolor="#FFFFCC" align="center"  width="90pt" >���z</td>
		<td bgcolor="#FFFFCC" align="center"  width="90pt" >����</td>
</tr>
<?php

//�v���_�E���̍��ڂ��擾
$strOptionText="";
$sql="SELECT kategori,kategori_name FROM kam_kategori WHERE inoutflg='".$_REQUEST['inout']."' order by order_no";
$rs = exSQL($sql,$conn);
while($row = $rs->fetch_assoc()){
        $strOptionText=$strOptionText."<option value='".$row["kategori"]."'>".$row["kategori_name"];
}

for($i=0;$i<10;$i++){
?>
<tr>
<td align="center" ><?php print($i+1);?></td>
<td align="center" valign="center" nowrap><input type="text" name="set_date<?php print($i);?>" size="100pt" value="" class="date-pick" /></td>
<td>
<select name="kategori<?php print($i);?>">
<option value="">
<?php
echo $strOptionText;
?>
</select>
</td>
<td>
<input type="text" name="money<?php print($i);?>" value="" size="10pt">
</td>
<td><input type="text" name="detail<?php print($i);?>" size="30pt">
</td></tr>
<?php
} //for
?>
</table>
<br>
<div align="center">
<input type="submit" value="�@�o�@�^�@">�@
<input type="button" value="�@�߁@��@"  onclick="location.href='./insert003.php'">�@
<?php
print("<INPUT TYPE='HIDDEN' NAME='inout' VALUE='".$_REQUEST['inout']."'>");
?>
</div>
</form>
<?php
//���ʃt�b�^�̕\��
echo GetFooter();
?>