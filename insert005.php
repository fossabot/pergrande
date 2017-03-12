<?php
/* ****************************************************************
 * All Rights Reserved, Copyright(C) korai 2009
 * ƒvƒƒOƒ‰ƒ€–¼F  ‰ÆŒv•ëƒVƒXƒeƒ€
 * ƒvƒƒOƒ‰ƒ€‚h‚cFinsert002
 * ì¬“ú•tF	   2009/06/01
 * ÅIXV“úF	   2008/06/01
 * ƒvƒƒOƒ‰ƒ€à–¾F“o˜^ŽÀs‰æ–Ê
 * •ÏX—š—ð
 * •ÏX“úŽž		•ÏXŽÒ–¼			à–¾
 * 2009/06/01	g—‹				V‹Kì¬
*************************************************************** */
//‹¤’Êfunction“Ç‚Ýž‚Ý
	require('./common.php');
/*
ˆø”
user_id		ƒ†[ƒU[‚h‚c[ƒNƒbƒL[î•ñ]
inout@		0FŽxoA1FŽû“ü

set_date	Ý’è“ú(0`9)
kategori	Ží•Ê(0`9)
money		‹àŠz(0`9)
detail		ƒƒ‚(0`9)
*/

for($i=0;$i<11;$i++){
//Ý’è“ú‚ª‹ó‚Ìê‡ˆ—‚µ‚È‚¢
if($_REQUEST["set_date".$i]==""){
	continue;
}

$CNT=0;
//Ý’è“ú‚ª“¯ˆê‚ÌƒŒƒR[ƒh”‚ðŒŸõ
	$sql="SELECT count(*) CNT FROM kat_inoutdata WHERE user_id='".$_COOKIE['user_id']."' and date='".$_REQUEST["set_date".$i]."'";
	$rs = exSQL($sql,$conn);
	while($row = $rs->fetch_assoc()){
        $CNT=$row["CNT"];
	}
//ŠY“–”{‚P‚ðindexnumber‚ÉÝ’è‚·‚é
	$CNT +=1;

//ƒf[ƒ^‚ð‚c‚a‚É“o˜^
	$sql="INSERT INTO kat_inoutdata VALUES('".$_COOKIE['user_id']."','".$_REQUEST["set_date".$i]."','".$CNT.
	"','".$_REQUEST["money".$i]."','".$_REQUEST["kategori".$i]."','".$_REQUEST["detail".$i]."','".$_REQUEST["inout"]."','0')";
	$rs = exSQL($sql,$conn);
}

//‰æ–Ê‘JˆÚ
	header("location: insert004.php?insert_into=1&inout=".$_REQUEST["inout"]);
?>
