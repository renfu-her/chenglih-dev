<?php
include "../include/check_all.php";//檢查登入權限和使用者是否被凍結
include "../common.func.php";

$del_no	=	$_GET['no'];

$sql="DELETE FROM goods_class4 WHERE goods_class4_no =:del_no;";

$result = $db->prepare("$sql");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result->bindValue(':del_no', $del_no, PDO::PARAM_INT);
$result->execute();

$db = null;// 關閉連線
?>
<script language="javascript">
	location.href= ('./index.php?msg=del');
</script>