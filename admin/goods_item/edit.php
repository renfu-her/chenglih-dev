<?PHP
if (!isset($_SESSION)) {
 	 session_start();
}
include "../include/check_all.php";//檢查登入權限和使用者是否被凍
include "../common.func.php";

$edit_no	=	$_GET['no'];

$sql="SELECT * 
FROM `goods_item` 
where goods_item_no=:edit_no;";

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
<div class="box-header txt_12"><span>|| 後台管理介面 > 修改</span><span>商品</span><span class="txt_12_red"></span> </div>
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
<div class="text-center txt_title"><strong><span class="form-group">
  <input type="hidden" name="edit_no" value="<?=$edit_no?>">
</span>修改商品</strong></div>
<div class="box-body">
	 <div class="form-group">
   		<label class="col-md-2 control-label">名稱：</label>
    	<div class="col-md-10">       
    	<input name="title"  id="title" type="text"  value="<?=$rows["goods_item_title"]?>"  required="required" data-error="必須填寫標題" />
    	<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
     <div class="form-group">
   		<label class="col-md-2 control-label">型號：</label>
    	<div class="col-md-10">       
    	<input name="model"  id="model" type="text"  value="<?=$rows["goods_item_model"]?>"  required="required" data-error="必須填寫型號" />
    	<div class="help-block with-errors"></div>
   	 	</div>
     </div>
      <div class="form-group">
   		<label class="col-md-2 control-label">產品品牌：</label>
    	<div class="col-md-10">       
    	<select name="class_main" id="class_main" required data-error="請選擇產品品牌" >
                    <?PHP //顯示出商品分類
	//查詢
	$sql_class="
	SELECT * FROM `goods_class_main` 
	ORDER BY `goods_class_main_sort`  
	";//DESC是遞減
					
	$result_class = $db->prepare("$sql_class");//防sql注入攻擊	
	$result_class->execute();						
	
	?>
		<?PHP
	  while($rows_class = $result_class->fetch(PDO::FETCH_ASSOC)) 
		{
			echo '<option value="'.$rows_class["goods_class_main_no"].'"';
			if ($rows["goods_item_class_main"]==$rows_class["goods_class_main_no"]){
				echo ' selected';
				}			
			echo '>'.$rows_class["goods_class_main_name"].'</option>';
		}
?>
               </select>
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
			 <input name="class[]" type="checkbox" class="input_checkbox" id="class_<?=$no?>" value="<?=$rows_class["goods_class_no"]?>"  
			 <?PHP
					$string = $rows["goods_item_class"];
					$find = ','.$rows_class["goods_class_no"].',';
					if (strpos($string, $find) !== false) {
						echo " checked";
					}
			?>
			>
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
			 <input name="class2[]" id="class2_<?=$no?>" class="input_checkbox" type="checkbox" value="<?=$rows_class["goods_class2_no"]?>"<?PHP
					$string = $rows["goods_item_class2"];
					$find = ','.$rows_class["goods_class2_no"].',';
					if (strpos($string, $find) !== false) {
						echo " checked";
					}
			?>
			>
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
			 <input name="class3[]" id="class3_<?=$no?>" class="input_checkbox" type="checkbox" value="<?=$rows_class["goods_class3_no"]?>"<?PHP
					$string = $rows["goods_item_class3"];
					$find = ','.$rows_class["goods_class3_no"].',';
					if (strpos($string, $find) !== false) {
						echo " checked";
					}
			?>
			>
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
			 <input name="class4[]" id="class4_<?=$no?>" class="input_checkbox" type="checkbox" value="<?=$rows_class["goods_class4_no"]?>"<?PHP
					$string = $rows["goods_item_class4"];
					$find = ','.$rows_class["goods_class4_no"].',';
					if (strpos($string, $find) !== false) {
						echo " checked";
					}
			?>
			>
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
			 <input name="class5[]" id="class5_<?=$no?>" class="input_checkbox" type="checkbox" value="<?=$rows_class["goods_class5_no"]?>"<?PHP
					$string = $rows["goods_item_class5"];
					$find = ','.$rows_class["goods_class5_no"].',';
					if (strpos($string, $find) !== false) {
						echo " checked";
					}
			?>
			>
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
   		<label class="col-md-2 control-label">目前圖片：</label>
    	<div class="col-md-10 control-label" style="text-align: left">  
    	<?PHP if($rows["goods_item_pic_s"]<>''){ ?>
    	<img src="../goods_pic/<?=$rows["goods_item_pic_s"]; ?>"  height="150" border="1" class="img_Fillet"  onerror="this.src='../goods_pic/defpic.jpg'" >
       </br>
       	  
       
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
      	<span class="txt_12_red">建議尺寸:511x597pix</span> 
    	<input name="imgfile" type="file" id="imgfile" size="40" onChange="chkfile(this);" accept="image/gif, image/jpeg, image/png"/>
    	<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
    <div class="form-group">
   		<label class="col-md-2 control-label">是否發佈：</label>
    	<div class="col-md-10">    
    	 <label for="hide" style="cursor:pointer">
			<input name="hide" type="checkbox" id="hide" value="1" <?PHP if($rows["goods_item_hide"]==1) echo 'checked'; ?> class="input_checkbox" ><span class="txt_12_gl1" style="position: relative; bottom: 7px;">說明：勾選後才會正式對外發佈</span>
		</label>
			<div class="help-block with-errors"></div>
   	 	</div>
     </div>	
     <div class="form-group">
   		<label class="col-md-2 control-label">簡述：</label>
    	<div class="col-md-10"> 
    	 <textarea name="description" id="description"><?=$rows["goods_item_description"]?></textarea>
   	 	</div>
     </div>
     <div class="form-group">
   		<label class="col-md-2 control-label">內容：</label>
    	<div class="col-md-10"> 
    	 <textarea name="content" id="content"><?=$rows["goods_item_content"]?></textarea>
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
  $("#name").focus();
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

<!-- 啟用 tinymce--> 
<script src="/tiny_mce/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: "#content",
    height: '300px',
	//selector: "#textarea,#textarea2",//單獨選擇id
    theme : "modern",
	fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
    language : "zh_TW" ,
    plugins: [
    "advlist autolink lists link image charmap print preview anchor colorpicker textcolor lineheight",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste jbimages youTube",
  ],
	

  toolbar: "insertfile undo redo | styleselect | bold italic strikethrough forecolor backcolor | fontselect | fontsizeselect | lineheightselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages youTube | code",
  relative_urls: false
});
	
</script>
<!-- 啟用 tinymce--> 
</div> 
</body>
</html>
