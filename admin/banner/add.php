<?PHP
if (!isset($_SESSION)) {
 	 session_start();
}
include "../include/check_all.php";//檢查登入權限和使用者是否被凍
include "../common.func.php";
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
首頁輪播<?PHP include '../phpinclude_body.php';?>
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
<div class="box-header txt_12"><span>|| 後台管理介面 > 新增首頁輪播</span>
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
<form  class="form-horizontal" name="form1" method="post" action="add_ok.php" id="form" data-toggle="validator"  enctype="multipart/form-data">
<div class="text-center txt_title"><strong>新增首頁輪播</strong></div>
<div class="box-body">
<div class="form-group">
   		<label class="col-md-2 control-label">標題：</label>
    	<div class="col-md-10">       
			<input name="banner_title" id="banner_title" type="text" value=""  data-error="" />
			<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
	<div class="form-group">
   		<label class="col-md-2 control-label">上傳圖片：</label>
    	<div class="col-md-10">
    	<!--預覽區塊-->
    	<label for="imgfile">
        	<img id="view_uppic" src="../images/view_uppic.jpg" class="view_uppic" /> 
        </label>		
      	<!--預覽區塊-->      
			<input name="imgfile" type="file" id="imgfile"  required="required" data-error="請選擇檔案" onChange="chkfile(this);" accept="image/gif, image/jpeg, image/png" />   
			<span class="txt_12_gl1">說明：建議上傳大小為1920 x 865 px </span>
			<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
     
     
    <div class="form-group">
   		<label class="col-md-2 control-label">超聯結：</label>
    	<div class="col-md-10">       
			<input name="link" id="link" type="text" value=""  data-error="請填寫超連結,需包含http://或https://" placeholder="超連結須完整，包含http://或https://" />
			<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
     <div class="form-group">
   		<label class="col-md-2 control-label">開啟模式：</label>
    	<div class="col-md-10">       
    	    <select name="banner_href" id="banner_href"  data-error="請選擇開啟模式"> 
				<option value="無超連結" selected="selected">無超連結</option>                      
				<option value="當前視窗">當前視窗</option>
				<option value="開啟新頁">開啟新頁</option>                        
		    </select>
    		<div class="help-block with-errors"></div>
   	 	</div>
     </div>	

     <div class="form-group">
   		<label class="col-md-2 control-label">是否顯示：</label>
    	<div class="col-md-10">    
    	 <label for="hide" style="cursor:pointer">
			<input name="hide" type="checkbox" id="hide" value="1" checked class="input_checkbox" ><span class="txt_12_gl1" style="position: relative; bottom: 7px;">勾選後將展示於前台</span>
		</label>
			<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
     <!--按鈕-->
     <div  >
    	<div class="col-xs-6 text-right"> 
     		<input type="submit" name="Submit2" value="送出" class="btn btn-info btn_bt" />
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
<script type="text/javascript">
$(document).ready(function(){
  $("#banner_title").focus();
});
</script>
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
		<script>  
		 $('#imgfile2').change(function() {
		  var file = $('#imgfile2')[0].files[0];
		  var reader = new FileReader;
		  reader.onload = function(e) {
			$('#view_uppic2').attr('src', e.target.result);
		  };
		  reader.readAsDataURL(file);
		});
		</script>
<!--預覽區塊--> 

</div> 
</body>
</html>
