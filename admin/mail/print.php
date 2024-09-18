<?PHP
if (!isset($_SESSION)) {
 	 session_start();
}
include "../include/check_all.php";//檢查登入權限和使用者是否被凍
include "../common.func.php";

$edit_no	=	$_GET['no'];

$sql="SELECT * 
FROM `mail` 
where no=:edit_no;";

$result = $db->prepare("$sql");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result->bindValue(':edit_no', $edit_no, PDO::PARAM_INT);
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>後台管理系統</title>  
<?PHP include '../include_head.php';?> 
<!-- 表單css -->
<link rel="stylesheet" href="/admin/style_form.css">  
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
<div class="box-header txt_12"><span>|| 後台管理介面 > 聯絡我們來信列表</span>
  <div class="box-tools"></div>
</div>
<span class="txt_12_red">
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
 </span>
<form  class="form-horizontal" method="post" action="edit_ok.php" name="form"  id="form" data-toggle="validator" enctype="multipart/form-data">
<div class="text-center txt_title" style="margin-bottom: 20px;"><strong>聯絡我們來信列表</strong></div>
<div class="text-right" style="padding-right: 15px;"><i class="fa fa-clock-o"></i>發送時間：<?=$rows["date"];?></div>
<div class="box-body">
<div class="box">
           
           
            <div class="well" style="margin-bottom: 0px;">
                     
                  
            <!-- /.box-header -->
            
            <div class="box-body no-padding">
             <style>
				td, th {
					padding: 3px  !important;
				}
				</style>
              <table width="100%" align="center">   
                 <tr>
                  <td  width="100" valign="top" class="text-right">姓名：</td>
                  <td><?=$rows["name"];?></td>                 
                </tr>
                <tr>
                  <td  width="100" valign="top" class="text-right">連絡電話：</td>
                  <td><?=$rows["tel"];?></td>                 
                </tr>
                 <tr>
                  <td  width="100" valign="top" class="text-right">電子郵件：</td>
                  <td><?=$rows["mail"];?></td>                 
                </tr>
                 <tr>
                  <td  width="100" valign="top" class="text-right">詢問項目：</td>
                  <td><?=$rows["objects"];?></td>                 
                </tr>                 
                 <tr>
                  <td  width="100" valign="top" class="text-right">留言：</td>
                  <td><div class="well" style="padding: 10px;"><?=nl2br($rows["message"]);?></div>
                  	 
                  </td>                 
                </tr>
               
               
              </table>
            </div>
            
            <!-- /.box-body -->
          </div>
      <div style="margin-bottom: 20px;">發送IP位置：<?=$rows["ip"];?></div>
     <!--按鈕-->
     <div  >
    	
        <div class="col-xs-12 text-center"> 
     		<input type="button" value="返回" class="btn btn-default btn_bt"  onclick="location.href='./index.php'"/>
        </div> 
     </div>
     <!--按鈕-->
</div>


</form>


 
  
       
      </DIV>
    </DIV>
  </DIV>
</section>
<!-- Main 內容結束 -->

</div>
<!-- /.content-wrapper -->
<?PHP include '../footer.php';?> 
<?PHP include '../include_js.php';?>  
<!--引用 Validator-->
<script src="../js/validator.min.js"></script>

<!--執行 Validator-->
<script>
$('#form').validator().on('submit', function(e) {
if (e.isDefaultPrevented()) { // 未驗證通過 則不處理
return;
} else { // 通过后，送出表单
//alert("已送出表單");
}
//e.preventDefault();  防止原始 form 提交表单
});
</script>

<script type="text/javascript">
$(document).ready(function(){
//  $("#title").focus();
});
</script>

<!--檢查上傳檔案-->
<?PHP include '../include/chkfile_size.php';?> 
<!--檢查上傳檔案-->

<!--預覽區塊-->	
		<script>  
		 $('#imgfile').change(function() {
		  var file = $('#imgfile')[0].files[0];
		  var reader = new FileReader;
		  reader.onload = function(e) {
			$('#view_uppic').attr('src', e.target.result);
		  };
		  reader.readAsDataURL(file);
		});
		</script>  
<!--預覽區塊--> 

<!-- 啟用 CKEitor--> 
<script src="../ck_editor/ckeditor.js"></script>
<script type="text/javascript">
    // 啟用 CKEitor 的上傳功能，使用了 CKFinder 插件	
    CKEDITOR.replace( 'content', {
		allowedContent: true,//不吃字
		height: '400px', width: '100%',
        filebrowserBrowseUrl        : '../ck_finder/ckfinder.html',
        filebrowserImageBrowseUrl   : '../ck_finder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl   : '../ck_finder/ckfinder.html?Type=Flash',
        filebrowserUploadUrl        : '../ck_finder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl   : '../ck_finder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl   : '../ck_finder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
		
    });

</script>
</div> 
</body>
</html>
