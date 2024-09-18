<?PHP
if (!isset($_SESSION)) {
 	 session_start();
}
$_SESSION["bt"]='0';
include "./admin/common.func.php";

$sql="SELECT * FROM `webinfo`";
$result = $db->prepare("$sql");//防sql注入攻擊
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);


if (isset($_GET['class'])){
	$_SESSION["class_prekey"]=$_GET['class'];//主分類
}
if (isset($_GET['class_sub'])){
	$_SESSION["class_sub"]=$_GET['class_sub'];//子分類
}

$class_prekey=$_SESSION["class_prekey"];//主分類
$class_sub=$_SESSION["class_sub"];//主分類

?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Language" content="zh-tw">
	<meta name="keywords" content="<?=$rows["keywords"];?>" />
	<meta name="description" content="<?=$rows["description"];?>" />
	<meta name="company" content="<?=$rows["conpany"];?>" />
	<meta name="robots" content="all">
	<meta name="robots" content="index,follow">
	<meta name="distribution" content="Taiwan"/>
	<meta name="revisit-after" content="7 days"/>
	<meta name="rating" content="general"/>
	<meta property="og:title" content="<?=$rows["conpany"];?>"/>
	<meta property="og:description" content="<?=$rows["description"];?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:site_name" content="<?=$rows["conpany"];?>" />
	<meta property="og:image" content="https://<?=$_SERVER['HTTP_HOST']?>/admin/goods_pic/<?=$rows["share_pic"]; ?>"/>
	<link rel="image_src" href="https://<?=$_SERVER['HTTP_HOST']?>/admin/goods_pic/<?=$rows["share_pic"]; ?>" />	
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon" />

    <title><?=$rows["conpany"];?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
   
    <!-- Fontawesome core CSS -->
    <link href="vendor/fontawesome/css/all.min.css" rel="stylesheet">

    <!-- AOS core CSS -->
    <link href="vendor/aos/aos.css" rel="stylesheet">

    <!-- owl.carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"></link>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/main.css">

<?=$rows["include_head"];?>	
<?PHP include 'include_head.php';?>    
</head>
<body>
<?PHP include 'include_body.php';?>
<?=$rows["include_body"]; ?>
<?PHP include 'nav.php';?>

    <header class="page-kv" style="background-image: url('./img/img_brandkv.jpg');">
        <div class="kv-caption">
          <h3 class="font-weight-bold text-white text-shadow mb-0">品牌專區</h3>
          <h5 class="font-weight-bold text-white text-shadow mb-0">Brand Zone</h5>
        </div>
    </header>

    <nav class="breadcrumb-row" aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                <li class="breadcrumb-item"><a href="brand.php">品牌專區</a></li>
                <li class="breadcrumb-item"><a href="brand-list.php?class=<?=$class_prekey?>&class_sub=<?=$class_sub?>">
                <?php
				switch ($class_prekey) {
				   case "1":
					 $class_mysql_class_no='';
					 echo "食品分類";
					 break;
						
				   case "2":
					 $class_mysql_class_no='2';
					 echo "廠牌分類";
					 break;
						
				   case "3":
					 $class_mysql_class_no='3';
					 echo "設備分類(產線)";
					 break;
						
				   case "4":
					 $class_mysql_class_no='4';
					 echo "設備分類 (單機)";
					 break;
						
				   case "5":
					 $class_mysql_class_no='5';
					 echo "其他種類";
					 break;
						
				   default:
					 $class_mysql_class_no='';
					 echo "食品分類";
				}
				?>
                </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                	<?PHP
						//查子分類名字
					
						$class_mysql_no=$class_mysql_class_no."_no";
					    $class_mysql_name=$class_mysql_class_no."_name";
						$sql_class="
						SELECT * FROM `goods_class$class_mysql_class_no` 
						WHERE `goods_class$class_mysql_no` = :class_sub
						";
						$result_class = $db->prepare("$sql_class");//防sql注入攻擊
						$result_class->bindValue(':class_sub', $class_sub, PDO::PARAM_INT);
						$result_class->execute();
						$rows_class = $result_class->fetch(PDO::FETCH_ASSOC);
						$class_sub_txt= $rows_class["goods_class$class_mysql_name"];//主類別
					?>
          			<?=$class_sub_txt;?></li>
            </ol>   
        </div>
    </nav>

    <!-- Content Section -->
    <section class="content mt-md-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-12 mb-md-0 mb-3 py-md-5" style="background-color:#f6f7f7;">
                    <div id="brandmenu" class="sidebar-list list-group list-group-flush">
                        <a href="#brand1sub" class="list-group-item list-group-item-action" data-toggle="collapse" aria-expanded="<?PHP
							 if($class_prekey==1) 
								echo 'true';
							else{
								echo 'false';	
							}
							  ?>"><h4><span class="brand-list_tt">食品分類</span></h4></a>
                        <div class="collapse<?PHP
							 if($class_prekey==1){
								echo ' show';							
							}
							  ?>" id="brand1sub" data-parent="#brandmenu">
                            
                            <?PHP
							//列出內容
														
							$sql_left="
							SELECT * FROM goods_class 
							WHERE goods_class_hide=1
							ORDER BY `goods_class_sort` ,`goods_class_no` DESC 

							 ";

							$result_left = $db->prepare("$sql_left");//防sql注入攻擊
							// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
							//$result->bindValue(':id', $id, PDO::PARAM_INT);
							$result_left->execute();
							$counts_left=$result_left->rowCount();//算出總筆數

							if($counts_left<>0){//如果判斷結果有值才跑回圈抓資料
							   while($rows_left = $result_left->fetch(PDO::FETCH_ASSOC)) {
							$no_id=$no_id+1;
							?>   
                            <a href="brand-list.php?class=1&class_sub=<?=$rows_left["goods_class_no"];?>#goods" class="list-group-item list-group-item-action <?PHP if($class_prekey==1 && $rows_left["goods_class_no"]==$class_sub) echo ' active';?>" data-parent="#brand1sub"><h4><span><?=$rows_left["goods_class_name"]; ?></span></h4></a>
                            <?php	
								}
								}
							?> 
                            
                        </div>
                        <a href="#brand2sub" class="list-group-item list-group-item-action" data-toggle="collapse" aria-expanded="<?PHP
							 if($class_prekey==2) 
								echo 'true';
							else{
								echo 'false';	
							}
							  ?>"><h4><span class="brand-list_tt">廠牌分類</span></h4></a>
                        <div class="collapse<?PHP
							 if($class_prekey==2){
								echo ' show';							
							}
							  ?>" id="brand2sub" data-parent="#brandmenu">
                             <?PHP
							//列出內容
														
							$sql_left="
							SELECT * FROM goods_class2 
							WHERE goods_class2_hide=1
							ORDER BY `goods_class2_sort` ,`goods_class2_no` DESC 

							 ";

							$result_left = $db->prepare("$sql_left");//防sql注入攻擊
							// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
							//$result->bindValue(':id', $id, PDO::PARAM_INT);
							$result_left->execute();
							$counts_left=$result_left->rowCount();//算出總筆數

							if($counts_left<>0){//如果判斷結果有值才跑回圈抓資料
							   while($rows_left = $result_left->fetch(PDO::FETCH_ASSOC)) {
							$no_id=$no_id+1;
							?>   
                            <a href="brand-list.php?class=2&class_sub=<?=$rows_left["goods_class2_no"];?>#goods" class="list-group-item list-group-item-action <?PHP if($class_prekey==2 && $rows_left["goods_class2_no"]==$class_sub) echo ' active';?>" data-parent="#brand1sub"><h4><span><?=$rows_left["goods_class2_name"]; ?></span></h4></a>
                            <?php	
								}
								}
							?> 
                        </div>
                        <a href="#brand3sub" class="list-group-item list-group-item-action" data-toggle="collapse" aria-expanded="<?PHP
							 if($class_prekey==3) 
								echo 'true';
							else{
								echo 'false';	
							}
							  ?>"><h4><span class="brand-list_tt">設備分類(產線)</span></h4></a>
                        <div class="collapse<?PHP
							 if($class_prekey==3){
								echo ' show';							
							}
							  ?>" id="brand3sub" data-parent="#brandmenu">
                             <?PHP
							//列出內容
														
							$sql_left="
							SELECT * FROM goods_class3 
							WHERE goods_class3_hide=1
							ORDER BY `goods_class3_sort` ,`goods_class3_no` DESC 

							 ";

							$result_left = $db->prepare("$sql_left");//防sql注入攻擊
							// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
							//$result->bindValue(':id', $id, PDO::PARAM_INT);
							$result_left->execute();
							$counts_left=$result_left->rowCount();//算出總筆數

							if($counts_left<>0){//如果判斷結果有值才跑回圈抓資料
							   while($rows_left = $result_left->fetch(PDO::FETCH_ASSOC)) {
							$no_id=$no_id+1;
							?>   
                            <a href="brand-list.php?class=3&class_sub=<?=$rows_left["goods_class3_no"];?>#goods" class="list-group-item list-group-item-action <?PHP if($class_prekey==3 && $rows_left["goods_class3_no"]==$class_sub) echo ' active';?>" data-parent="#brand1sub"><h4><span><?=$rows_left["goods_class3_name"]; ?></span></h4></a>
                            <?php	
								}
								}
							?> 
                        </div>
                        <a href="#brand4sub" class="list-group-item list-group-item-action" data-toggle="collapse" aria-expanded="<?PHP
							 if($class_prekey==4) 
								echo 'true';
							else{
								echo 'false';	
							}
							  ?>"><h4><span class="brand-list_tt">設備分類(單機)</span></h4></a>
                        <div class="collapse<?PHP
							 if($class_prekey==4){
								echo ' show';							
							}
							  ?>" id="brand4sub" data-parent="#brandmenu">
                             <?PHP
							//列出內容
														
							$sql_left="
							SELECT * FROM goods_class4 
							WHERE goods_class4_hide=1
							ORDER BY `goods_class4_sort` ,`goods_class4_no` DESC 

							 ";

							$result_left = $db->prepare("$sql_left");//防sql注入攻擊
							// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
							//$result->bindValue(':id', $id, PDO::PARAM_INT);
							$result_left->execute();
							$counts_left=$result_left->rowCount();//算出總筆數

							if($counts_left<>0){//如果判斷結果有值才跑回圈抓資料
							   while($rows_left = $result_left->fetch(PDO::FETCH_ASSOC)) {
							$no_id=$no_id+1;
							?>   
                            <a href="brand-list.php?class=4&class_sub=<?=$rows_left["goods_class4_no"];?>#goods" class="list-group-item list-group-item-action <?PHP if($class_prekey==4 && $rows_left["goods_class4_no"]==$class_sub) echo ' active';?>" data-parent="#brand1sub"><h4><span><?=$rows_left["goods_class4_name"]; ?></span></h4></a>
                            <?php	
								}
								}
							?> 
                        </div>
                        <a href="#brand5sub" class="list-group-item list-group-item-action" data-toggle="collapse" aria-expanded="<?PHP
							 if($class_prekey==5) 
								echo 'true';
							else{
								echo 'false';	
							}
							  ?>"><h4><span class="brand-list_tt">其他種類</span></h4></a>
                        <div class="collapse<?PHP
							 if($class_prekey==5){
								echo ' show';							
							}
							  ?>" id="brand5sub" data-parent="#brandmenu">
                             <?PHP
							//列出內容
														
							$sql_left="
							SELECT * FROM goods_class5 
							WHERE goods_class5_hide=1
							ORDER BY `goods_class5_sort` ,`goods_class5_no` DESC 

							 ";

							$result_left = $db->prepare("$sql_left");//防sql注入攻擊
							// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
							//$result->bindValue(':id', $id, PDO::PARAM_INT);
							$result_left->execute();
							$counts_left=$result_left->rowCount();//算出總筆數

							if($counts_left<>0){//如果判斷結果有值才跑回圈抓資料
							   while($rows_left = $result_left->fetch(PDO::FETCH_ASSOC)) {
							$no_id=$no_id+1;
							?>   
                            <a href="brand-list.php?class=5&class_sub=<?=$rows_left["goods_class5_no"];?>#goods" class="list-group-item list-group-item-action <?PHP if($class_prekey==5 && $rows_left["goods_class5_no"]==$class_sub) echo ' active';?>" data-parent="#brand1sub"><h4><span><?=$rows_left["goods_class5_name"]; ?></span></h4></a>
                            <?php	
								}
								}
							?> 
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-12 mb-md-0 mb-5 py-md-5 px-md-5"  id="goods">
                     <div class="row">
                       <?php
						//使用分頁控制必備變數--開始						
						$Day = date("Y-m-d H:i:s");//今天日期

						include "./admin/include/pages_goods.php";
						$pagesize='12';//設定每頁顯示資料量
						$phpfile = 'brand-list.php';//使用頁面檔案
						$page= isset($_GET['page'])?$_GET['page']:1;//如果沒有傳回頁數，預設為第1頁

						
						$sql_where_class=" && `goods_item_class$class_mysql_class_no` LIKE '%,$class_sub,%' ";
						//查詢
						$sql_main="
						SELECT * FROM `goods_item` 
						WHERE goods_item_hide=1 
						$sql_where_class
						ORDER BY  `goods_item_sort` ASC, `goods_item_no` DESC 
						";//算總頁數用

						$result_main = $db->prepare("$sql_main");//防sql注入攻擊
						// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
						//$result->bindValue(':id', $id, PDO::PARAM_INT);
						$result_main->execute();
						$counts_main=$result_main->rowCount();//算出總筆數
						$counts_page=$counts_main;//給分頁要不要顯示做判斷的總數
						if ($page>$counts_main) $page = $counts_main;//輸入值大於總數則顯示最後頁
						else $page = intval($page);//當前頁面-避免非數字頁碼
						$getpageinfo = page($page,$counts_main,$phpfile,$pagesize);//將函數傳回給pages.php處理
						$page_sql_start=($page-1)*$pagesize;//資料庫查詢起始資料
						?>
						<?PHP 
						//列出內容
						$no_id=$no_id+$start+(($page-1)*$pagesize);//流水號

						$sql_main="
						SELECT * FROM `goods_item` 
						WHERE goods_item_hide=1 
						$sql_where_class
						ORDER BY  `goods_item_sort` ASC, `goods_item_no` DESC 
						LIMIT :page_sql_start , :pagesize 

						 ";

						$result_main = $db->prepare("$sql_main");//防sql注入攻擊
						// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
						//$result->bindValue(':id', $id, PDO::PARAM_INT);
						$result_main->bindValue(':page_sql_start', $page_sql_start, PDO::PARAM_INT);
						$result_main->bindValue(':pagesize', $pagesize, PDO::PARAM_INT);
						$result_main->execute();
						$counts_main=$result_main->rowCount();//算出總筆數

						if($counts_main<>0){//如果判斷結果有值才跑回圈抓資料
						   while($rows_main = $result_main->fetch(PDO::FETCH_ASSOC)) {
						$no_id=$no_id+1;
						?>	 
                        <div class="col-md-4 col-12 mb-md-5 mb-4">
                            <div class="card p-0">
                                <div class="card-img">
                                    <a href="brand-detail.php?class_prekey=<?=$class_prekey?>&class_sub=<?=$class_sub?>&no=<?=$rows_main["goods_item_no"];?>" class="hover-img">
                                        <img class="card-img-top" src="./admin/goods_pic/<?=$rows_main["goods_item_pic_b"]; ?>" title="<?=$rows_main["goods_item_title"]; ?>">
                                    </a>
                                </div>
                                <div class="card-body bg-green">                                  
                                    <a href="brand-detail.php?class_prekey=<?=$class_prekey?>&class_sub=<?=$class_sub?>&no=<?=$rows_main["goods_item_no"];?>">
                                       <h5 class="text-white single-line-text" style="font-size: 16px;"><?=$rows_main["goods_item_model"]; ?></h5>
                                        <h4 class="text-white single-line-text" ><?=$rows_main["goods_item_title"]; ?></h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php	
}
}else{
?>	
<div class="col-lg-12 col-md-12 col-sm-12 text-center wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0ms" style="margin-top: 50px; font-size: 30px;">
<strong>暫無資料</strong>
<div style="height: 20px;"></div>

</div>
<?PHP }?>      
                       
                      
                     </div>

                      <div class="col-lg-12 col-md-12 col-sm-12 text-center wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0ms" style="margin-top: 50px;">
					<?php
					if($counts_page>$pagesize){
						echo $getpageinfo['pagecode'];//顯示分頁的html代碼
					}
					?>
			<div style="height: 20px;"></div>
			</div>
                </div>
            </div>
        </div>
    </section>

    <?PHP include 'footer.php';?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->

    <!-- Fontawesome core JavaScript -->
    <script src="vendor/fontawesome/js/all.min.js"></script>

    <!-- AOS core JavaScript -->
    <script src="vendor/aos/aos.js"></script>

    <!-- Iconify core JavaScript -->
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
    $(document).ready(function(){
        AOS.init({
            offset: 120,
            once: true,
        });

        $("a[href='#top']").click(function() {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });

    })
    </script>
</body>
</html>
<?PHP include 'include_footer.php';?>
<?=$rows["include_footer"]; ?>