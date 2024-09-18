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
<div class="box-header txt_12"><span>|| 後台管理介面 > 新增商品</span><span class="txt_12_red"></span>
</div><form  class="form-horizontal" name="form1" method="post" action="add_ok.php" id="form" data-toggle="validator"  enctype="multipart/form-data">
<div class="text-center txt_title"><strong>新增商品</strong></div>
<div class="box-body">
	 <div class="form-group">
   		<label class="col-md-2 control-label">名稱：</label>
    	<div class="col-md-10">       
    	<input name="title"  id="title" type="text"  value=""  required="required" data-error="必須填寫標題" />
    	<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
     
     <div class="form-group">
   		<label class="col-md-2 control-label">食品分類：</label>
    	<div class="col-md-10">                
               
    <?PHP //顯示出商品分類
	//查詢
	$sql_class="
	SELECT * FROM `goods_class` 
	ORDER BY `goods_class_sort`  
	";//DESC是遞減
					
	$result_class = $db->prepare("$sql_class");//防sql注入攻擊	
	$result_class->execute();
			$no=0;
	 while($rows_class = $result_class->fetch(PDO::FETCH_ASSOC)) 
		{
			$no=$no+1;
	?>
         <label for="class_<?=$no?>" style="cursor:pointer;padding:0px 5px; margin-right: 5px;" class="well">
			 <input name="class[]" id="class_<?=$no?>" class="input_checkbox" type="checkbox" value="<?=$rows_class["goods_class_no"]?>">
			 <span style="position: relative; bottom: 7px;"><?=$rows_class["goods_class_name"];?></span>
         </label>
    <?PHP
		}
	?>       
   		<hr>
    	<div class="help-block with-errors"></div>
   	 	</div>
     </div>
     
     <div class="form-group">
   		<label class="col-md-2 control-label">廠牌分類：</label>
    	<div class="col-md-10">                
               
    <?PHP //顯示出商品分類
	//查詢
	$sql_class="
	SELECT * FROM `goods_class2` 
	ORDER BY `goods_class2_sort`  
	";//DESC是遞減
					
	$result_class = $db->prepare("$sql_class");//防sql注入攻擊	
	$result_class->execute();
			$no=0;
	 while($rows_class = $result_class->fetch(PDO::FETCH_ASSOC)) 
		{
			$no=$no+1;
	?>
         <label for="class2_<?=$no?>" style="cursor:pointer;padding:0px 5px; margin-right: 5px;" class="well">
			 <input name="class2[]" id="class2_<?=$no?>" class="input_checkbox" type="checkbox" value="<?=$rows_class["goods_class2_no"]?>">
			 <span style="position: relative; bottom: 7px;"><?=$rows_class["goods_class2_name"];?></span>
         </label>
    <?PHP
		}
	?>  
   		<hr>     
    	<div class="help-block with-errors"></div>
   	 	</div>
     </div>
     
     <div class="form-group">
   		<label class="col-md-2 control-label">設備分類(產線)：</label>
    	<div class="col-md-10">                
               
    <?PHP //顯示出商品分類
	//查詢
	$sql_class="
	SELECT * FROM `goods_class3` 
	ORDER BY `goods_class3_sort`  
	";//DESC是遞減
					
	$result_class = $db->prepare("$sql_class");//防sql注入攻擊	
	$result_class->execute();
			$no=0;
	 while($rows_class = $result_class->fetch(PDO::FETCH_ASSOC)) 
		{
			$no=$no+1;
	?>
         <label for="class3_<?=$no?>" style="cursor:pointer;padding:0px 5px; margin-right: 5px;" class="well">
			 <input name="class3[]" id="class3_<?=$no?>" class="input_checkbox" type="checkbox" value="<?=$rows_class["goods_class3_no"]?>">
			 <span style="position: relative; bottom: 7px;"><?=$rows_class["goods_class3_name"];?></span>
         </label>
    <?PHP
		}
	?>    
   		<hr>   
    	<div class="help-block with-errors"></div>
   	 	</div>
     </div>
     
     <div class="form-group">
   		<label class="col-md-2 control-label">設備分類(單機)：</label>
    	<div class="col-md-10">                
               
    <?PHP //顯示出商品分類
	//查詢
	$sql_class="
	SELECT * FROM `goods_class4` 
	ORDER BY `goods_class4_sort`  
	";//DESC是遞減
					
	$result_class = $db->prepare("$sql_class");//防sql注入攻擊	
	$result_class->execute();
			$no=0;
	 while($rows_class = $result_class->fetch(PDO::FETCH_ASSOC)) 
		{
			$no=$no+1;
	?>
         <label for="class4_<?=$no?>" style="cursor:pointer;padding:0px 5px; margin-right: 5px;" class="well">
			 <input name="class4[]" id="class4_<?=$no?>" class="input_checkbox" type="checkbox" value="<?=$rows_class["goods_class4_no"]?>">
			 <span style="position: relative; bottom: 7px;"><?=$rows_class["goods_class4_name"];?></span>
         </label>
    <?PHP
		}
	?>    
   		<hr>   
    	<div class="help-block with-errors"></div>
   	 	</div>
     </div>
     
     <div class="form-group">
   		<label class="col-md-2 control-label">其他分類：</label>
    	<div class="col-md-10">                
               
    <?PHP //顯示出商品分類
	//查詢
	$sql_class="
	SELECT * FROM `goods_class5` 
	ORDER BY `goods_class5_sort`  
	";//DESC是遞減
					
	$result_class = $db->prepare("$sql_class");//防sql注入攻擊	
	$result_class->execute();
			$no=0;
	 while($rows_class = $result_class->fetch(PDO::FETCH_ASSOC)) 
		{
			$no=$no+1;
	?>
         <label for="class5_<?=$no?>" style="cursor:pointer;padding:0px 5px; margin-right: 5px;" class="well">
			 <input name="class5[]" id="class5_<?=$no?>" class="input_checkbox" type="checkbox" value="<?=$rows_class["goods_class5_no"]?>">
			 <span style="position: relative; bottom: 7px;"><?=$rows_class["goods_class5_name"];?></span>
         </label>
    <?PHP
		}
	?>    
   		<hr>   
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
    	<input name="imgfile" type="file" id="imgfile" size="40"  required="required" onChange="chkfile(this);" accept="image/gif, image/jpeg, image/png"/>
    	<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
    <div class="form-group">
   		<label class="col-md-2 control-label">是否發佈：</label>
    	<div class="col-md-10">    
    	 <label for="hide" style="cursor:pointer">
			<input name="hide" type="checkbox" id="hide" value="1" checked class="input_checkbox" ><span class="txt_12_gl1" style="position: relative; bottom: 7px;">說明：勾選後才會正式對外發佈</span>
		</label>
			<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
  
     <div class="form-group">
   		<label class="col-md-2 control-label">內容：</label>
    	<div class="col-md-10"> 
    	 <textarea name="content" id="content"></textarea>
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
  $("#id").focus();
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

<script type="text/javascript">
$(document).ready(function(){
  $("#title").focus();
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
