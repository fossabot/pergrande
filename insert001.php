<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Finsert001
 * �쐬���t�F	   2009/06/01
 * �ŏI�X�V���F	   2008/06/01
 * �v���O���������F���o�^���
 * �ύX����
 * �ύX����		�ύX�Җ�			����
 * 2009/06/01	�g��				�V�K�쐬
*************************************************************** */
//����function�ǂݍ���
	require('./common.php');
/*
����
inout�@0�F�x�o�A1�F����
date		�Y�����t
*/
//���ʃw�b�_�̕\��
echo GetHeader($user_id,$conn);

?>
<script language="JavaScript">
	function numberCheck(){
		if(document.insert001.money.value.match(/[^0-9]+/)){
			alert("���z�ɂ͔��p������ݒ肵�Ă�������");
			return false
		}
		return true
	}
	//�E�B���h�E�\���A��\�����[�`��
	function TextBox1(){
		obj = insert001.money
		hkazu.hyouji.value = insert001.money.value;
		tsuu =hkazu.hyouji.value;
		TextB1.style.visibility = "visible";
	}
	function TextBack1(obj){
		if(obj==1){
			insert001.money.value=hkazu.hyouji.value;
		}
		TextB1.style.visibility = "hidden";
		flag = false;
	}

</script>
<?php 
if(isset($_REQUEST['insert_into'])){
print("�o�^�������܂���<br>");
}

print("<h4>�o�^");
if($_REQUEST['inout']==0){
print("(�x�o)");
}else{
print("(����)");
}
?>
		</h4>
<form method="post" name="insert001"  onSubmit="return numberCheck()" action="insert002.php">
<table border=0>
<tr><td>
�ݒ��</td><td valign="center"><?php print(substr($_REQUEST["date"],0,4)."�N".substr($_REQUEST["date"],4,2)."��".substr($_REQUEST["date"],6,2)."��");?></td><td>
<input type="hidden" name="set_date" value="<?php print($_REQUEST["date"]); ?>">
</td></tr>
<tr><td>
��@��</td><td>
<select name="kategori">
<option value="">
<?php

$sql="SELECT kategori,kategori_name FROM kam_kategori WHERE inoutflg='".$_REQUEST['inout']."' order by order_no";

$rs = exSQL($sql,$conn);
while($row = $rs->fetch_assoc()){
        print("<option value='".$row["kategori"]."'>".$row["kategori_name"]);
}
?>
</select>
</td></tr>
<tr><td>
���z</td><td>
<input type="text" name="money" value="">�@<input type="button" name ="calButton" value="�d��" onclick="TextBox1()">
</td></tr>
<tr><td>
����</td><td><input type="text" name="detail" size="70">
</td></tr>
</table>
<p>
<input type="submit" value="�@�o�@�^�@">�@
<input type="button" value="�@�߁@��@"  onclick="history.back(-1)">�@
<?php
print("<INPUT TYPE='HIDDEN' NAME='inout' VALUE='".$_REQUEST['inout']."'>");
?>
</form>


<?php
//�d��̌Ăяo��
echo calview(250,220);
//���ʃt�b�^�̕\��
echo GetFooter();
?>