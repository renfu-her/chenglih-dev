<?php
include "../include/check_all.php";//檢查登入權限和使用者是否被凍結
include "../common.func.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?PHP
$name 	=	$_POST["name"];
$content	=	$_POST["content"];

//有無設排序

if ( isset($_POST["sort"]) && $_POST["sort"] != '' ) { $sort   	=	$_POST["sort"]; }
else { $sort = '0'; }


//發布狀態：有勾選傳回:1
if ( isset($_POST["hide"]) && $_POST["hide"] != '' ) { $hide = '1'; }
else { $hide = '0'; }

//新增使用者
$sql="insert into abouts (abouts_name,abouts_sort,abouts_hide,abouts_content)	
VALUES (:name,:sort,:hide,:content)";

	$result = $db->prepare("$sql");//防sql注入攻擊
	// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
	$result->bindValue(':name', $name, PDO::PARAM_STR);
	$result->bindValue(':sort', $sort, PDO::PARAM_INT);
	$result->bindValue(':hide', $hide, PDO::PARAM_INT);
	$result->bindValue(':content', $content, PDO::PARAM_STR);
	$result->execute();


$db = null;// 關閉連線

?>
<script language="javascript">
location.href= ('./index.php?msg=add');
</script>





