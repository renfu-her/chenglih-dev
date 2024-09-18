<?PHP
if (!isset($_SESSION)) {
 	 session_start();
}
include "../include/check_all.php";//檢查登入權限和使用者是否被凍
include "../common.func.php";

$edit_no	=	$_GET['no'];

$sql="SELECT * 
FROM `news` 
where news_no=:edit_no;";

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
<div class="box-header txt_12"><span>|| 後台管理介面 > 修改最新消息</span>
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
<div class="text-center txt_title"><strong>修改最新消息  
    	<input type="hidden" name="edit_no" value="<?=$edit_no?>">   </strong></div>
<div class="box-body">
	 <div class="form-group">
   		<label class="col-md-2 control-label">標題：</label>
    	<div class="col-md-10">       
    	<input name="title"  id="title" type="text"  value="<?=$rows["news_title"]; ?>"  required="required" data-error="必須填寫標題" />
    	<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
    <div class="form-group">
   		<label class="col-md-2 control-label">目前圖片：</label>
    	<div class="col-md-10 control-label" style="text-align: left">  
    	<?PHP if($rows["news_pic_s"]<>''){ ?>
    	<img src="../goods_pic/<?=$rows["news_pic_s"]; ?>"  height="150" border="1" class="img_Fillet"  onerror="this.src='../goods_pic/defpic.jpg'" >
       </br>
       <!--刪除圖片按鈕-->
       <span class="label label-danger a_movetop" onclick ="return del_upload()"  style="cursor:pointer" ><i class="fa fa-trash"></i> 刪除已上傳圖檔</span>
                      <input id="link_upload" type="hidden" value="edit_delpic_ok.php?no=<?=$rows["news_no"];?>&bpic=<?=$rows["news_pic_b"];?>&spic=<?=$rows["news_pic_s"];?>"  />
                      <input id="delno_upload" type="hidden" value="確定要刪除圖檔?"  />
					  <script type="text/javascript" language="javascript">
						function del_upload(y) {
							var link  = document.getElementById("link_upload");//刪除超連結
							var delno = document.getElementById("delno_upload");//刪除編號
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
       <!--刪除圖片按鈕-->		  
       
        <?PHP } 
			else{
			echo "無";
			}
		?>          
   	 	</div>
     </div>	
     <div class="form-group">
   		<label class="col-md-2 control-label">更換圖片：</label>
    	<div class="col-md-10">    
    	<!--預覽區塊-->
    	<label for="imgfile">
        	<img id="view_uppic" src="../images/view_uppic.jpg" class="view_uppic" /> 
        </label>		
      	<!--預覽區塊-->    
			<input name="imgfile" type="file" id="imgfile" onChange="chkfile(this);" accept="image/gif, image/jpeg, image/png"  />   
			<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
    

    
     <div class="form-group">
   		<label class="col-md-2 control-label">是否發佈：</label>
    	<div class="col-md-10">    
    	 <label for="ckpost"  style="cursor:pointer">
			<input name="ckpost" type="checkbox" id="ckpost" value="1" <?PHP if($rows["news_ckpost"]==1) echo 'checked'; ?> class="input_checkbox" ><span class="txt_12_gl1" style="position: relative; bottom: 7px;">說明：勾選後才會正式對外發佈</span>
		</label>
			<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
     <div class="form-group">
   		<label class="col-md-2 control-label">預約發布：</label>
    	<div class="col-md-10">       
    	 <input name="posttime" type="date" id="posttime" style="width:150px;"  value="<?=$rows["news_posttime"]; ?>" /> 到
    	  <input name="overtime" type="date" id="overtime" style="width:150px;" value="<?=$rows["news_overtime"]; ?>" />
    	  <div class="txt_12_gl1">說明：請填寫正確的年月日，將在指定的日期內對外發佈(需勾選"發布"才會在指定日期發布出去)</div>
   	 	</div>
     </div>	
     <div class="form-group">
   		<label class="col-md-2 control-label">內容：</label>
    	<div class="col-md-10"> 
    	 <textarea name="content" id="content"><?=$rows["news_content"]; ?></textarea>
   	 	</div>
     </div>
     
     <!--按鈕-->
     <div  >
    	<div class="col-xs-6 text-right"> 
     		<input type="submit" name="Submit2" value="儲存修改" class="btn btn-info btn_bt" />
        </div> 
        <div class="col-xs-6 text-left"> 
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
