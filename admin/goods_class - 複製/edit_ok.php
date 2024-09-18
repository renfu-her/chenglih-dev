<?php
include "../include/check_all.php";//檢查登入權限和使用者是否被凍結
include "../common.func.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?PHP
$edit_no=	$_POST["edit_no"];//傳回修改的編號
$name	 	=	$_POST["name"];
$keyword 	=	$_POST["keyword"];
$contact	=	$_POST["contact"];

//有無設排序

if ( isset($_POST["sort"]) && $_POST["sort"] != '' ) { $sort   	=	$_POST["sort"]; }
else { $sort = '0'; }


//發布狀態：有勾選傳回:1
if ( isset($_POST["hide"]) && $_POST["hide"] != '' ) { $hide = '1'; }
else { $hide = '0'; }

$sql="UPDATE `goods_class` SET 
`goods_class_name` =:name,
`goods_class_sort` =:sort,
`goods_class_hide` =:hide,
`goods_class_keyword` =:keyword,
`goods_class_contact` =:contact
WHERE `goods_class_no` =:edit_no ;";

$result = $db->prepare("$sql");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
	$result->bindValue(':name', $name, PDO::PARAM_STR);
	$result->bindValue(':sort', $sort, PDO::PARAM_INT);
	$result->bindValue(':hide', $hide, PDO::PARAM_INT);
	$result->bindValue(':keyword', $keyword, PDO::PARAM_STR);
	$result->bindValue(':contact', $contact, PDO::PARAM_STR);
	$result->bindValue(':edit_no', $edit_no, PDO::PARAM_INT);
	$result->execute();

$db = null;// 關閉連線
?>
<script language="javascript">
 location.href= ('./index.php?msg=updata');
</script>





