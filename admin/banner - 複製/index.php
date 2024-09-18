<?PHP
if (!isset($_SESSION)) {
 	 session_start();
}
include "../include/check_all.php";//檢查登入權限和使用者是否被凍
include "../include/check_powerisroot.php";//檢查有沒有最高權限=0結
include "../common.func.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>後台管理系統</title>  
<?PHP include '../include_head.php';?> 
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?PHP include '../phpinclude_body.php';?>
<div class="wrapper">
<?PHP include '../head.php';?> 
  <!-- Left side column. contains the logo and sidebar -->
<?PHP include '../menu.php';?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">  
</section>
<!-- Main 內容開始 -->
<section class="content">
  <div class="row">
    <div class=" col-xs-12 col-md-12 col-sm-12 col-xs-12">
      <div class="info-box txt_main">
<?PHP
//查詢
$sql="SELECT * FROM `banner` 
ORDER BY `banner_sort`  
 ";
$result = $db->prepare("$sql");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
//$result->bindValue(':id', $id, PDO::PARAM_INT);
$result->execute();
$total=$result->rowCount();//算出總筆數
?>
<div class="box-header txt_12">
<span>|| 後台管理介面 > banner輪播設定</span>
    <div class="box-tools">
    <img src="../images/icon/off.gif" width="10" height="12"> 不顯示&nbsp;&nbsp;&nbsp; <img src="../images/icon/on.gif" width="10" height="12"> 正常顯示
    </div>
</div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="0" colspan="2" align="left" valign="top"><span class="txt_12_red">
      <?PHP 

		//取得資料新增修改刪除狀態

		if(isset($_GET['msg'])){

			$msg	= $_GET['msg'];

			switch($msg){

				case 'add':

					echo $msg='【資料狀態】：&nbsp;&nbsp;新增成功';

				break;

				case 'updata':

					echo $msg='【資料狀態】：&nbsp;&nbsp;修改成功';

				break;

				case 'del':

					echo $msg='【資料狀態】：&nbsp;&nbsp;刪除成功';

				break;

	}		

}

		?>
    </span></td>
    </tr>

  <tr>

    <td width="52%" height="10" align="left" valign="bottom" class="txt_12_gl">資料 <?PHP echo $total;?>  筆</td>

    <td width="48%" align="right" valign="bottom"><a href="add.php" class="txt_12_gl a_movetop"><span class="label label-primary"><i class="fa f fa-plus-square"></i> 新增</span></td>

  </tr>

</table>

 <div class="box-body table-responsive no-padding">
<table class="table">

<form action="sort.php" method="post">

  <tr>

    <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>

            <td><table width="100%" cellpadding="1" cellspacing="1" class="table_01 stripe">

              <tbody>

                <tr>

                  <th width="7%" height="25" align="center"  bgcolor="#367FA9" class="txt_wt"><strong>NO</strong></th>

                  <th width="7%" height="25" align="center"  bgcolor="#367FA9" class="txt_wt"><strong>電腦版</strong></th>
                  <th width="14%" align="center"  bgcolor="#367FA9" class="txt_wt">行動版</th>
                  <th width="14%" align="center"  bgcolor="#367FA9" class="txt_wt">標題/<strong>超連結</strong></th>
                  <th width="20%" align="center"  bgcolor="#367FA9" class="txt_wt"><strong>開啟模式</strong></th>
                  <th width="14%" align="center"  bgcolor="#367FA9" class="txt_wt">編輯時間</th>

                  <th width="5%" height="25" align="center"  bgcolor="#367FA9" class="txt_wt"><strong>顯示</strong></th>

                  <th width="9%" align="center"  bgcolor="#367FA9" class="txt_wt">排序</th>

                  <th width="5%" align="center"  bgcolor="#367FA9" class="txt_wt">修改</th>

                  <th width="5%" align="center"  bgcolor="#367FA9" class="txt_wt">刪除</th>

                </tr>

<?PHP 
//列出內容
$no_id=$no_id+$start;//流水號 
   while($rows = $result->fetch(PDO::FETCH_ASSOC)) {
$no_id=$no_id+1;
?>			

                <tr>

                  <td height="25" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF" class="txt_12_gl">

                    <?=$no_id;?>                  </td>

                  <td height="25" align="left" valign="middle" bgcolor="#FFFFFF" class="txt_12_gl"><img src="../goods_pic/<?=$rows["banner_pic_s"]; ?>"  height="50" border="1" style=" border-color:#666666; border-style:solid;" onerror="this.src='../goods_pic/defpic.jpg'" ></td>
                  <td height="25" align="left" valign="middle" bgcolor="#FFFFFF" class="txt_12_gl">
                  <img src="../goods_pic/<?=$rows["banner_pic_s_mob"]; ?>"  height="50" border="1" style=" border-color:#666666; border-style:solid;" onerror="this.src='../goods_pic/defpic.jpg'" >
                 </td>
                  <td height="25" align="left" valign="middle" bgcolor="#FFFFFF" class="txt_12_gl">
					<?=$rows["banner_title"]; ?>
					</br>
                 <?=$rows["banner_link"]; ?>
                 </td>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" class="txt_12_gl"><span class="text_item">
                    <?=$rows["banner_href"]; ?>
                  </span></td>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" class="txt_12_gl">
					 <?=$rows["banner_date"]; ?>
                  </td>

                  <td height="25" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF" class="txt_12_gl"><span class="text_item" style="text-indent:5px;">
                    
                    <?PHP

					 if($rows["banner_hide"]==0)

						echo'<img src="../images/icon/off.gif" width="10" height="12" border="0" title="隱藏"';

					else	 

						echo'<img src="../images/icon/on.gif" width="10" height="12" border="0" title="顯示"';

					 ?>
                    
                  </span></td>

                  <td height="25" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF" class="txt_12_gl">                    
                    <input name="<?=$rows["banner_no"];?>" type="text" id="<?=$rows["banner_no"];?>"  value="<?=$rows["banner_sort"];?>" class="input_sort">
				  </td>

                  <td height="25" align="center" valign="middle" nowrap="nowrap" bgcolor="#FFFFFF" class="txt_12_gl"><a href="edit.php?no=<?=$rows["banner_no"];?>" class="a_movetop"><span class="label label-success"><i class="fa fa-edit"></i> 修改</span></a></td>

                  <td height="25" align="center" valign="middle"nowrap="nowrap" bgcolor="#FFFFFF" class="txt_12_gl">
                  
                  <span class="label label-danger a_movetop" onclick ="return del_<?=$no_id?>()"  ><i class="fa fa-trash"></i> 刪除</span>
                      <input id="link_<?=$no_id?>" type="hidden" value="del_ok.php?no=<?=$rows["banner_no"];?>&bpic=<?=$rows["banner_pic_b"]; ?>&spic=<?=$rows["banner_pic_s"]; ?>&bpic_mob	=<?=$rows["banner_pic_b_mob"]; ?>&spic_mob	=<?=$rows["banner_pic_s_mob"]; ?>"  />
                      <input id="delno_<?=$no_id?>" type="hidden" value="確定要刪除第 <?=$no_id;?> 筆 ?"  />
					  <script type="text/javascript" language="javascript">
						function del_<?=$no_id?>(y) {
							var link  = document.getElementById("link_<?=$no_id?>");//刪除超連結
							var delno = document.getElementById("delno_<?=$no_id?>");//刪除編號
							//alertify.alert(link.value);
							this.name = "mike";						
	
							alertify.confirm( delno.value, function (e) {
									if (e) {
										location.href=link.value;
									} else {
										return false;
									}
								});
						}
					  </script>   
                </td>

                </tr>

<?php	
}
?>

              </tbody>

            </table>
            
             <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td height="20" align="right" valign="bottom"><span class="txt_12_gl1">排序方式：數字越小排在越前面(P.S.請輸入半形阿拉伯數字)</span></td>

          </tr>

          <tr>

            <td height="30" align="right" valign="bottom"><table width="100" border="0" align="right" cellpadding="0" cellspacing="0">

              <tr>

                <td><input type="submit" name="Submit2" value="重新排序" class="btn btn-info btn_bt" /></td>

              </tr>

                        </table></td>

          </tr>

        </table>
            </td>

          </tr>

      </table>

       

        </td>

  </tr>



  </form>

</table>
</div>     
       
      </DIV>
    </DIV>
  </DIV>
</section>
<!-- Main 內容結束 -->
</div>
<!-- /.content-wrapper -->
<?PHP include '../footer.php';?> 
<?PHP include '../include_js.php';?>  
<script src="/admin/js/stripe.js"></script></head>
</div> 
</body>
</html>
