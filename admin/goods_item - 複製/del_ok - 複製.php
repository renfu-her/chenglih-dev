<?php
include "../include/check_all.php";//檢查登入權限和使用者是否被凍結
include "../common.func.php";

$del_no	=	$_GET['no'];
$uppics_class = 'goods';//所屬類別

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


//刪除多圖
$sql_del="SELECT * FROM `uppics` 
WHERE `uppics_ing` = :del_no && `uppics_class` = :uppics_class
ORDER BY  `uppics_sort` ASC 
 ";
$result_del = $db->prepare("$sql_del");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result_del->bindValue(':del_no', $del_no, PDO::PARAM_INT);
$result_del->bindValue(':uppics_class', $uppics_class, PDO::PARAM_STR);
$result_del->execute();
$total_del=$result_del->rowCount();//算出總筆數
//列出內容
$no_id=$no_id+$start;//流水號 
if($total_del<>0){
	 while($rows_del = $result_del->fetch(PDO::FETCH_ASSOC)) {
		 $no_id=$no_id+1;
		 
		 //刪除照片
			 $del_pic=$rows_del["uppics_pic_s"];
			 $file="../goods_pic/".$del_pic;
				  if(is_file($file)){
					unlink($file);
				  }

			 $del_pic=$rows_del["uppics_pic_b"];
			 $file="../goods_pic/".$del_pic;
				  if(is_file($file)){
					unlink($file);
				  }
		 //刪除照片
		 
		 //刪除資料庫
		 
		 	$sql="DELETE FROM uppics WHERE uppics_ing =:del_no;";

			$result = $db->prepare("$sql");//防sql注入攻擊
			// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
			$result->bindValue(':del_no', $del_no, PDO::PARAM_INT);
			$result->execute();

		 //刪除資料庫
	
	}
}
//刪除多圖


$sql="DELETE FROM goods_item WHERE goods_item_no =:del_no;";

$result = $db->prepare("$sql");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result->bindValue(':del_no', $del_no, PDO::PARAM_INT);
$result->execute();

$db = null;// 關閉連線
?>
<script language="javascript">
	location.href= ('./index.php?msg=del');
</script>
