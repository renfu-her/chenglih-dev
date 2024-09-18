<?php
include "../include/check_all.php";//檢查登入權限和使用者是否被凍結
include "../common.func.php";


$del_no	=	$_GET['no'];
$bpic		=	$_GET['bpic'];//大圖
$spic		=	$_GET['spic'];//小圖
$file="../goods_pic/".$bpic;

  if(is_file($file)){
    unlink($file);
    //echo "{$file}刪除大圖成功!"."<BR>";
  //}else{
   // echo "{$file}大圖檔案不存在!"."<BR>";
  }


$file_s="../goods_pic/".$spic;
  if(is_file($file_s)){
    unlink($file_s);
 //   echo "{$file_s}刪除小圖成功!"."<BR>";
 // }else{
 //   echo "{$file_s}小圖檔案不存在!"."<BR>";
  }
  


$sql="UPDATE `news` SET 
`news_pic_s` =:pic_s,
`news_pic_b` =:pic_b
WHERE `news_no` =:del_no ;";

$result = $db->prepare("$sql");//防sql注入攻擊
	// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
	$result->bindValue(':pic_s', $pic_s, PDO::PARAM_STR);
	$result->bindValue(':pic_b', $pic_b, PDO::PARAM_STR);
	$result->bindValue(':del_no', $del_no, PDO::PARAM_INT);
	$result->execute();
?>
<script language="javascript">
	location.href= ('./edit.php?no=<?=$del_no;?>');
</script>
