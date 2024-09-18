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
?>
<!DOCTYPE html>
<html lang="zh-Hant"><head>
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
	<meta property="og:title" content="影音專區-<?=$rows["conpany"];?>"/>
	<meta property="og:description" content="<?=$rows["description"];?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:site_name" content="<?=$rows["conpany"];?>" />
	<meta property="og:image" content="https://<?=$_SERVER['HTTP_HOST']?>/admin/goods_pic/<?=$rows["share_pic"]; ?>"/>
	<link rel="image_src" href="https://<?=$_SERVER['HTTP_HOST']?>/admin/goods_pic/<?=$rows["share_pic"]; ?>" />	
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon" />

    <title>影音專區-<?=$rows["conpany"];?></title>

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
 <header class="page-kv" style="background-image: url('./img/img_videokv.jpg');">
        <div class="kv-caption">
          <h3 class="font-weight-bold text-white text-shadow mb-0">影音專區</h3>
          <h5 class="font-weight-bold text-white text-shadow mb-0">Video Zone</h5>
        </div>
    </header>

    <nav class="breadcrumb-row mb-md-5" aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">首頁</a></li>
                <li class="breadcrumb-item active" aria-current="page">影音專區</li>
            </ol>    
        </div>
    </nav>
    <!-- Content Section -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
<?php
//使用分頁控制必備變數--開始						
$Day = date("Y-m-d H:i:s");//今天日期

include "./admin/include/pages.php";
$pagesize='12';//設定每頁顯示資料量
$phpfile = 'video.php';//使用頁面檔案
$page= isset($_GET['page'])?$_GET['page']:1;//如果沒有傳回頁數，預設為第1頁


//查詢
$sql_main="
SELECT * FROM video 
WHERE video_hide=1 
ORDER BY `video_sort` ,`video_no` DESC 
";//算總頁數用
		  
$result_main = $db->prepare("$sql_main");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
//$result->bindValue(':id', $id, PDO::PARAM_INT);
$result_main->execute();
$counts_main=$result_main->rowCount();//算出總筆數
$counts_page=ceil($counts_main/$pagesize);//總頁數
						
if ($page>$counts_main) $page = $counts_main;//輸入值大於總數則顯示最後頁
else $page = intval($page);//當前頁面-避免非數字頁碼
$getpageinfo = page($page,$counts_main,$phpfile,$pagesize);//將函數傳回給pages.php處理
$page_sql_start=($page-1)*$pagesize;//資料庫查詢起始資料
?>
<?PHP 
//列出內容
$no_id=$no_id+$start+(($page-1)*$pagesize);//流水號

$sql_main="
SELECT * FROM video 
WHERE video_hide=1 
ORDER BY `video_sort` ,`video_no` DESC 
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
                        <div class="col-md-4 col-12 mb-md-5 mb-3">
                            <div class="card border-0 p-0">
                                <div class="embed-responsive embed-responsive-16by9">
                                   <?=$rows_main["video_link"]; ?>
                                </div>
                                <div class="card-body px-0">
                                    <a href="#" target="_blank">
                                        <h4 class="text-dark"><?=$rows_main["video_name"]; ?></h4>
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
                </div>
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