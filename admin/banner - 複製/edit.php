<?PHP
if (!isset($_SESSION)) {
 	 session_start();
}
include "../include/check_all.php";//檢查登入權限和使用者是否被凍
include "../include/check_powerisroot.php";//檢查有沒有最高權限=0結
include "../common.func.php";

$edit_no	=	$_GET['no'];

$sql="
SELECT * FROM `banner` 
where banner_no=:edit_no";//sql語法


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
<div class="box-header txt_12"><span>|| 後台管理介面 > 修改banner輪播</span>
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
<div class="text-center txt_title"><strong>修改banner輪播<input type="hidden" name="edit_no" value="<?=$edit_no?>">   </strong></div>
<div class="box-body">
<div class="form-group">
   		<label class="col-md-2 control-label">標題：</label>
    	<div class="col-md-10">       
			<input name="banner_title" id="banner_title" type="text" value="<?=$rows["banner_title"]; ?>"  data-error="" />
			<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
	<div class="form-group">
   		<label class="col-md-2 control-label">目前圖片(電腦版)：</label>
    	<div class="col-md-10 control-label" style="text-align: left">  
    	<img src="../goods_pic/<?=$rows["banner_pic_s"]; ?>"  height="150" border="1" class="img_Fillet"  onerror="this.src='../goods_pic/defpic.jpg'" >
                    
   	 	</div>
     </div>	
     <div class="form-group">
   		<label class="col-md-2 control-label">更換圖片(電腦版)：</label>
    	<div class="col-md-10">    
    	<!--預覽區塊-->
    	<label for="imgfile">
        	<img id="view_uppic" src="../images/view_uppic.jpg" class="view_uppic" /> 
        </label>		
      	<!--預覽區塊-->    
			<input name="imgfile" type="file" id="imgfile" onChange="chkfile(this);" accept="image/gif, image/jpeg, image/png" />   
			<span class="txt_12_gl1">說明：建議上傳大小為1920 x 865 px </span>
			<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
     <div class="form-group">
   		<label class="col-md-2 control-label">目前圖片(行動版)：</label>
    	<div class="col-md-10 control-label" style="text-align: left">  
    	<img src="../goods_pic/<?=$rows["banner_pic_s_mob"]; ?>"  height="150" border="1" class="img_Fillet"  onerror="this.src='../goods_pic/defpic.jpg'" >
                    
   	 	</div>
     </div>	
     <div class="form-group">
   		<label class="col-md-2 control-label">更換圖片(行動版)：</label>
    	<div class="col-md-10">    
    	<!--預覽區塊-->
    	<label for="imgfile2">
        	<img id="view_uppic2" src="../images/view_uppic.jpg" class="view_uppic" /> 
        </label>		
      	<!--預覽區塊-->    
			<input name="imgfile2" type="file" id="imgfile2" onChange="chkfile(this);" accept="image/gif, image/jpeg, image/png" /> 
			<span class="txt_12_gl1">說明：建議上傳大小為1370 x 1220 px </span>  
			<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
     
    <div class="form-group">
   		<label class="col-md-2 control-label">超聯結：</label>
    	<div class="col-md-10">       
			<input name="link" id="link" type="text" value="<?=$rows["banner_link"]; ?>"  data-error="請填寫超連結,需包含http://或https://" placeholder="超連結須完整，包含http://或https://" />
			<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
     <div class="form-group">
   		<label class="col-md-2 control-label">開啟模式：</label>
    	<div class="col-md-10">       
    	    <select name="banner_href" id="banner_href"  data-error="請選擇開啟模式"> 
    	        <option value="無超連結" <?PHP if($rows["banner_href"]=='無超連結') echo ' selected="selected"';?>>無超連結</option> 				                
				<option value="當前視窗" <?PHP if($rows["banner_href"]=='當前視窗') echo ' selected="selected"';?>>當前視窗</option>
				<option value="開啟新頁" <?PHP if($rows["banner_href"]=='開啟新頁') echo ' selected="selected"';?>>開啟新頁</option>                        
		    </select>
    		<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
     <div class="form-group">
   		<label class="col-md-2 control-label">排序：</label>
    	<div class="col-md-10">       
    		<input name="sort" id="sort" type="text" value="<?=$rows["banner_sort"]; ?>"  required="required" class="input_sort" />
			<span class="txt_12_gl1">排序方式：數字越小排在越前面</span>
    		<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
     <div class="form-group">
   		<label class="col-md-2 control-label">是否顯示：</label>
    	<div class="col-md-10">    
    	 <label for="hide" style="cursor:pointer">
			<input name="hide" type="checkbox" id="hide" value="1" <?PHP if($rows["banner_hide"]==1) echo 'checked'; ?> class="input_checkbox" ><span class="txt_12_gl1" style="position: relative; bottom: 7px;">勾選後將展示於前台</span>
		</label>
			<div class="help-block with-errors"></div>
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
<script type="text/javascript">
$(document).ready(function(){
//  $("#banner_title").focus();
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
