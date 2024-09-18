<?php
include "../include/check_all.php";//檢查登入權限和使用者是否被凍結
include "../common.func.php";

$del_no	=	$_GET['no'];


$bpic		=	$_GET['bpic'];//大圖
$spic		=	$_GET['spic'];//小圖
$bpic_mob	=	$_GET['bpic_mob'];//大圖
$spic_mob	=	$_GET['spic_mob'];//小圖

// unlink:刪除檔案，傳回布林
$file="../goods_pic/".$bpic;
  if(is_file($file)){
  unlink($file);
  }
$file="../goods_pic/".$spic;
  if(is_file($file)){
  unlink($file);
  }

// unlink:刪除檔案，傳回布林
$file="../goods_pic/".$bpic_mob;
  if(is_file($file)){
  unlink($file);
  }
$file="../goods_pic/".$spic_mob;
  if(is_file($file)){
  unlink($file);
  }



$sql="DELETE FROM banner WHERE banner_no =:del_no;";

$result = $db->prepare("$sql");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result->bindValue(':del_no', $del_no, PDO::PARAM_INT);
$result->execute();

$db = null;// 關閉連線
?>
<script language="javascript">
	location.href= ('./index.php?msg=del');
</script>