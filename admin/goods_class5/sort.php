<?PHP 

include "../include/check_all.php";//檢查登入權限和使用者是否被凍結
include "../common.func.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?PHP
$sql="
SELECT MAX(goods_class5_no) FROM `goods_class5` 
";
$result = $db->prepare("$sql");//防sql注入攻擊
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);

$max_no = $rows["MAX(goods_class5_no)"];//取出資料庫中no的最大值

//跑回圈抓取回傳的編號對應的值

for ($no=1;$no<=$max_no;$no++){

	$goods_class5_sort=$_POST["$no"];

	//echo '編號'.$no.'值等於='.$sort.'<br>';

	$sql_update="UPDATE `goods_class5` SET `goods_class5_sort` = '$goods_class5_sort' WHERE `goods_class5_no` ='$no';";
	$result_update = $db->prepare("$sql_update");//防sql注入攻擊
	$result_update->execute();
	$rows_update = $result_update->fetch(PDO::FETCH_ASSOC);

}

//釋放

$db = null;// 關閉連線

?>

<script language="javascript">
location.href= ('./index.php?msg=updata');
</script>