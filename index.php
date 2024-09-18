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
<body class="main">
<?PHP include 'include_body.php';?>
<?=$rows["include_body"]; ?>
<?PHP include 'nav.php';?>

    <!-- Slider Banner -->
<div id="carouselExampleIndicators" class="carousel slide wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0ms" data-ride="carousel">
  <ol class="carousel-indicators">
   <?PHP 
$banner_o=0;
$sql_banner="
SELECT * FROM `banner` 
WHERE `banner_hide`='1'
ORDER BY `banner_sort`  
";//DESC是遞減
$result_banner = $db->prepare("$sql_banner");//防sql注入攻擊
$result_banner->execute();
$total_banner=$result_banner->rowCount();//算出總筆數
//列出內容
if($total_banner<>0){//如果判斷結果有值才跑回圈抓資
   while($rows_banner = $result_banner->fetch(PDO::FETCH_ASSOC))
{ 
?>
    <li data-target="#carouselExampleIndicators" data-slide-to="<?=$banner_o?>" <?PHP if($banner_o==0) echo 'class="active"';?>></li>
 <?PHP
$banner_o=$banner_o+1;//判斷第一次要給li style值
}}
?>  
  </ol>
  <div class="carousel-inner">
 <?PHP 
$banner_o=0;
$sql_banner="
SELECT * FROM `banner` 
WHERE `banner_hide`='1'
ORDER BY `banner_sort` 
";//DESC是遞減
$result_banner = $db->prepare("$sql_banner");//防sql注入攻擊
$result_banner->execute();
$total_banner=$result_banner->rowCount();//算出總筆數
//列出內容
if($total_banner<>0){//如果判斷結果有值才跑回圈抓資
   while($rows_banner = $result_banner->fetch(PDO::FETCH_ASSOC))
{ 
$banner_o=$banner_o+1;//判斷第一次要給li style值
?>    
    <div class="carousel-item <?PHP if($banner_o==1) echo 'active';?>">
     <?PHP if($rows_banner["banner_link"]<>''){?>            
            <a href="<?=$rows_banner["banner_link"]?>" <?PHP
			if($rows_banner["banner_href"]=='開啟新頁') echo ' target="_blank"';
			?>>
	<?PHP }?>
      <img src="./admin/goods_pic/<?=$rows_banner["banner_pic_b"]; ?>" class="w-100" alt="<?=$rows_banner["banner_title"]; ?>">
    <?PHP if($rows_banner["banner_link"]<>''){?> 
	</a> 
	<?PHP }?> 
    </div>
<?PHP
}}
?>  
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">上一張</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">下一張</span>
  </a>
</div>
        <!-- Main Slider -->         
		<!-- Slider Banner -->
    </header>

    <!-- About Section -->
    <section class="sec02">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md col-12">
                    <div class="about-block" data-aos="zoom-out-left" data-aos-duration="800">
                        <div class="about-text-block">
                            <p class="text-green">1997年</p>
                            <h4 class="font-weight-bold">我們秉著對食品業的熱誠，成立了理想的團隊</h4>
                            <p>主要經營販售日本、歐美等知名先進製程設備，包含全自動化生產流程、其他週邊設備等，因應客戶之需求，開發及設計，並持續收集各項資訊情報，提供符合多變化的各大市場。</p> 
 <p class="mb-0">
承力是食品業界微不足道的小螺絲，已成為栓緊食品業界的主軸，且帶動食品業界的互動，長久承接其力，永續經營。
</p>    
                        </div>
                    </div>
                </div>
                <div class="col-md-auto col-12 d-md-block d-none">
                    <div class="d-block pr-5" data-aos="fade-down" data-aos-delay="300" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                        <img src="./img/bg_main_sec02.svg" class="img-fluid w-100">
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="sec03">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 py-5 text-center">
                    <h4 class="font-weight-bold text-dark-green">Video Zone</h4>
                    <h2 class="font-weight-bold text-white mb-md-3 mb-2">影音專區</h2>

                    <div id="videoCarousel" class="owl-carousel owl-theme">
                        <?PHP 

						$sql_main="
						SELECT * FROM video 
						WHERE video_hide=1 
						ORDER BY `video_sort` ,`video_no` DESC 
						LIMIT 0 , 6
						 ";

						$result_main = $db->prepare("$sql_main");//防sql注入攻擊
						// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
						//$result->bindValue(':id', $id, PDO::PARAM_INT);
						$result_main->execute();

						$counts_main=$result_main->rowCount();//算出總筆數

						if($counts_main<>0){//如果判斷結果有值才跑回圈抓資料
						   while($rows_main = $result_main->fetch(PDO::FETCH_ASSOC)) {
						$no_id=$no_id+1;
						?>	
                        <div class="item" data-aos="fade-left" data-aos-easing="ease-in-out" data-aos-delay="150" data-aos-duration="1500" data-aos-anchor=".sec03">
                            <div class="card border-0 p-0">
                                <div class="embed-responsive embed-responsive-16by9">
                                   <?=$rows_main["video_link"]; ?>
                                </div>
                                <div class="card-body px-0" style="padding: 0px;">
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
							 <div class="text-center" style="width: 100%">
                            <div class="card border-0 p-0">
                               
                                <div class="card-body px-0">
                                   尚無資料
                                </div>
                            </div>
                        </div>
							<?PHP
						}
						?>
                       
                      
                       
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Section -->
    <section class="sec04">
        <div class="container">
            <div class="row">
                <div class="col-12 py-5">
                    <div class="row align-items-center py-md-5 py-2">
                        <div class="col-lg-3 col-12" data-aos="fade-right" data-aos-easing="ease-in-out" data-aos-delay="100" data-aos-duration="800">
                            <div class="brandTitle">
                                <h4 class="font-weight-bold text-white">Brand Zone</h4>
                                <h2 class="font-weight-bold text-white mb-md-3 mb-2">品牌專區</h2>    
                            </div>
                        </div>
                        <div class="col-lg-9 col-12" data-aos="fade-left" data-aos-easing="ease-in-out" data-aos-delay="450" data-aos-duration="800">
                            <div class="brandContent">
                                <p class="text-white">堅持提供最完整食品生產設備，結合您的專業烘培技術，製造出高品質烘培產品<br>承力實業是陪你一路成長的最佳的夥伴</p>
                            </div>
                        </div>
                    </div>
                    

                    <div id="brandCarousel" class="owl-carousel owl-theme">
                       <?PHP 

						$sql_main="
						SELECT * FROM goods_item 
						WHERE goods_item_hide=1 
						ORDER BY `goods_item_sort` ,`goods_item_no` DESC 
						LIMIT 0 , 6
						 ";

						$result_main = $db->prepare("$sql_main");//防sql注入攻擊
						// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
						//$result->bindValue(':id', $id, PDO::PARAM_INT);
						$result_main->execute();

						$counts_main=$result_main->rowCount();//算出總筆數

						if($counts_main<>0){//如果判斷結果有值才跑回圈抓資料
						   while($rows_main = $result_main->fetch(PDO::FETCH_ASSOC)) {
						$no_id=$no_id+1;
						?>
                        <div class="item" data-aos="fade-left" data-aos-easing="ease-in-out" data-aos-delay="150" data-aos-duration="1500" data-aos-anchor=".sec03">
                            <div class="card border-0 p-0">
                                <div class="card-img">
                                    <a href="brand-detail.php?no=<?=$rows_main["goods_item_no"];?>&home=yes" class="hover-img">
                                        <img class="card-img-top" src="./admin/goods_pic/<?=$rows_main["goods_item_pic_b"]; ?>" title="<?=$rows_main["goods_item_title"]; ?>" alt="brand 01">
                                    </a>
                                </div>
                                <div class="card-body px-0">
                                    <a href="brand-detail.php?no=<?=$rows_main["goods_item_no"];?>&home=yes">
                                        <h4 class="text-white"><?=$rows_main["goods_item_model"]; ?> <?=$rows_main["goods_item_title"]; ?></h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php	
						}
						}else{
							?>
							 <div class="text-center" style="width: 100%">
                            <div class="card border-0 p-0">
                               
                                <div class="card-body px-0">
                                   尚無資料
                                </div>
                            </div>
                        </div>
							<?PHP
						}
						?>
                                                
                       
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- News Section -->
    <section class="sec05">
        <div class="container">
            <div class="row">
                <div class="col-12 py-5">
                    <div class="row align-items-center py-md-5 py-2">
                        <div class="col-lg-3 col-12" data-aos="fade-right" data-aos-easing="ease-in-out" data-aos-delay="100" data-aos-duration="800">
                            <div class="brandTitle text-md-center text-left">
                                <a href="about.php">
                                    <h4 class="font-weight-bold text-green">Industry News</h4>
                                    <h2 class="font-weight-bold text-white mb-md-3 mb-2">產業新知</h2>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-12" data-aos="fade-left" data-aos-easing="ease-in-out" data-aos-delay="450" data-aos-duration="800">
                            <div class="d-flex flex-md-row flex-column justify-content-between align-items-center">
                               <?PHP
									$sql_about="SELECT * FROM `about`";
									$result_about = $db->prepare("$sql_about");//防sql注入攻擊
									$result_about->execute();
									$rows_about = $result_about->fetch(PDO::FETCH_ASSOC);
									?>
                               <?PHP if($rows_about["link"]<>'') {?> <a href="<?=$rows_about["link"]; ?>" class="brandContent text-white"><?PHP }?>  
                             	  <?=$rows_about["content"]; ?>
                                <?PHP if($rows_about["link"]<>''){?> </a>
                                <a href="<?=$rows_about["link"]; ?>" class="btn-more">MORE</a>  <?PHP }?>
                            </div>
                            
                        </div>
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

    <!-- owl.carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

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

        $(".owl-carousel").owlCarousel({
            loop: false, // 循環播放
            //margin: 30, // 外距 30px
            nav: true, // 顯示點點
            navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
            rewind: true,
            dotsEach: true, // 顯示點點
            autoplay: true,
			autoplayTimeout:15000,
    
            responsive: {
                0: {
                    items: 1, // 螢幕大小為 0~576 顯示 1 個項目
                    //stagePadding: 20, // 物件內距
                },
                576: {
                    items: 2, // 螢幕大小為 576~767 顯示 2 個項目
                    //stagePadding: 20, // 物件內距
                },
                768: {
                    items: 2, // 螢幕大小為 768~992 顯示 3 個項目
                    //stagePadding: 50, // 物件內距
                },
                992: {
                    items: 3, // 螢幕大小為 992 以上 顯示 3 個項目
                    //stagePadding: 50, // 物件內距
                }
            }
        });

    })
    </script>
    
</body>
</html>
<?PHP include 'include_footer.php';?>
<?=$rows["include_footer"]; ?>