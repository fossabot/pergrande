<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2011
 * �v���O�������F  �ƌv��V�X�e��
 * �v���O�����h�c�Finsert001
 * �쐬���t�F	   2011/04/01
 * �ŏI�X�V���F	   2011/04/01
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
?>
<html>
		<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=Shift_JIS">
<style>
input.day{width:28pt;height:30pt;background:#FFFFFF; border:1 solid #336666; border-left:1 solid #336666;}
input.detailbutton{background:#FFFFFF; border:1 solid #336666; border-left:1 solid #336666;}
div.title{font-size:9pt;font-weight:bold;color: #FFFFFF;height: 10pt;background-color: #009999}
input.hojobutton{width:70pt;height:20pt;background:#FFFFFF; border:1 solid #336666; border-left:1 solid #336666;}
body{font-size:9pt}
td{font-size:10pt;margin: 0px;padding: 0px;background:#FFFFFF;}
a.blocklink{background:#FFFFFF;text-decoration:none;color:#336666;display:block;width:100%;height:100%;}
td.link{background:#336666;color:#FFFFFF;}
a.link2{background:#336666;text-decoration:none;color:#FFFFFF;width:100%;height:100%;}
a{
	background:#FFFFFF;
	text-decoration:none;
	color:#336666;
}

input.calDisp{
	background:#FFFFFF; 
	border:1 solid #336666; 
	border-left:1 solid #336666;
	font-size:14pt;
}
td.cal{
	font-size:13pt;
	margin: 0px;
	padding: 0px;
	width:30pt;
	height:30pt;
	background:#FFFFFF;
	text-align: center;
	vertical-align: center;
}

</style>

<meta name="viewport" content="width=device-width, user-scalable=no" />
<script language="JavaScript">
	function numberCheck(){
		if(document.insert001.money.value.match(/[^0-9]+/)){
			alert("���z�ɂ͔��p������ݒ肵�Ă�������");
			return false
		}
		return true
	}
	function lightInput(obj){

		switch(obj){
		  case 1: document.insert001.kategori.value="10";document.insert001.detail.value="�ς�炸";break;
		  case 2: document.insert001.kategori.value="1";document.insert001.detail.value="���ݕ�";break;
		  case 3: document.insert001.kategori.value="1";document.insert001.detail.value="�H���̔�������";break;
		  case 4: document.insert001.kategori.value="17";document.insert001.detail.value="�ƒ�";document.insert001.money.value="80000";break;
		}
	}
	//�E�B���h�E�\���A��\�����[�`��
	function TextBox1(){
		obj = insert001.money
		hkazu.hyouji.value = insert001.money.value;
		tsuu =hkazu.hyouji.value;
		TextB1.style.visibility = "visible";
	}
	function TextBack1(){
		if(obj==1){
			insert001.money.value=hkazu.hyouji.value;
		}
		TextB1.style.visibility = "hidden";
		flag = false;
	}

</script>
		<title>�ƌv��V�X�e��</title>
		</head>
<body>
<div class="title">�@�g�� �ƌv��V�X�e�� -Pergrande-�i�X�}�t�H�p�j</div>
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
<tr><td nowrap>
�ݒ��</td><td valign="center"><?php print(substr($_REQUEST["date"],0,4)."�N".substr($_REQUEST["date"],5,2)."��".substr($_REQUEST["date"],8,2)."��");?></td><td>
<input type="hidden" name="set_date" value="<?php print($_REQUEST["date"]); ?>">
</td></tr>
<tr><td nowrap>
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
<tr><td nowrap>
���z</td><td>
<input type="text" name="money" value="">�@<input class="detailbutton" type="button" name ="calButton" value="�d��" onclick="TextBox1()">
</td></tr>
<tr><td>
����</td><td><input type="text" name="detail" size="25" value="">
</td></tr>
</table>
<p>
<input class="detailbutton" type="submit" value="�@�o�@�^�@">�@
<input class="detailbutton" type="button" value="�@�߁@��@"  onclick="location.href='select001.php?date=<?php print($_REQUEST["date"]); ?>'">
<?php
print("<INPUT TYPE='HIDDEN' NAME='inout' VALUE='".$_REQUEST['inout']."'>");

?>
<?php 
if($_REQUEST['inout']==1){
print("<p><b>���͕⏕�{�^��(����)</b><br>");
print("<input class='hojobutton' type ='button' value='�� ��' onclick='javascript:lightInput(1)'>�@");
}else{
print("<p><b>���͕⏕�{�^��(�x�o)</b><br>");
print("<input class='hojobutton' type ='button' value='���ݕ�' onclick='javascript:lightInput(2)'>�@");
print("<input class='hojobutton' type ='button' value='�H���̔�������' onclick='javascript:lightInput(3)'>�@");
print("<input class='hojobutton' type ='button' value='�ƒ�' onclick='javascript:lightInput(4)'><br>");

}
?>
</form>
<?php
echo calview(140,50);
?>
</body>
</html>