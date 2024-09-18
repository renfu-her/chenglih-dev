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


if (isset($_GET['no']) && $_GET['no'] !== '') {
  	// 如果有傳送 no 參數且其值不為空字串，則執行以下程式碼
 	$no=$_GET['no'];
} else {
  	// 如果沒有傳送 no 參數或其值為空字串，則執行以下程式碼  
	$sql_no="SELECT * FROM `abouts` 
		where abouts_hide=1
		ORDER BY `abouts_sort` ,`abouts_no` DESC 
		LIMIT 1
		";
	$result_no = $db->prepare("$sql_no");//防sql注入攻擊
	$result_no->execute();
	$rows_no = $result_no->fetch(PDO::FETCH_ASSOC);
	$no=$rows_no["abouts_no"];
	
}

$sql_main="SELECT * FROM `abouts` 
	where abouts_hide=1 &&  abouts_no=:no
	ORDER BY `abouts_sort` ,`abouts_no` DESC 
	LIMIT 1
	";
$result_main = $db->prepare("$sql_main");//防sql注入攻擊
$result_main->bindValue(':no', $no, PDO::PARAM_INT);
$result_main->execute();
$rows_main = $result_main->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Language" content="zh-tw">
	<meta name="keywords" content="<?=$rows["keywords"];?>" />
	<meta name="description" content="<?PHP
												$abouts_content = $rows_main["abouts_content"];
												$abouts_content = strip_tags($abouts_content); // 过滤 HTML 标记
												$abouts_content = htmlspecialchars_decode($abouts_content); // 将实体转换回普通字符
	   										echo mb_strimwidth($abouts_content, 0, 500, '...', 'UTF-8'); 
										?>" />
	<meta name="company" content="<?=$rows_main["abouts_name"].'-'.$rows["conpany"];?>" />
	<meta name="robots" content="all">
	<meta name="robots" content="index,follow">
	<meta name="distribution" content="Taiwan"/>
	<meta name="revisit-after" content="7 days"/>
	<meta name="rating" content="general"/>
	<meta property="og:title" content="<?=$rows_main["abouts_name"].'-'.$rows["conpany"];?>"/>
	<meta property="og:description" content="<?PHP
												$abouts_content = $rows_main["abouts_content"];
												$abouts_content = strip_tags($abouts_content); // 过滤 HTML 标记
												$abouts_content = htmlspecialchars_decode($abouts_content); // 将实体转换回普通字符
	   										echo mb_strimwidth($abouts_content, 0, 500, '...', 'UTF-8'); 
										?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:site_name" content="<?=$rows["conpany"];?>" />
	<meta property="og:image" content="https://<?=$_SERVER['HTTP_HOST']?>/admin/goods_pic/<?=$rows["share_pic"]; ?>"/>
	<link rel="image_src" href="https://<?=$_SERVER['HTTP_HOST']?>/admin/goods_pic/<?=$rows["share_pic"]; ?>" />	
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon" />

    <title><?=$rows_main["abouts_name"].'-'.$rows["conpany"];?></title>

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

    <header class="page-kv" style="background-image: url('./img/img_aboutkv.jpg');">
        <div class="kv-caption">
          <h3 class="font-weight-bold text-white text-shadow mb-0">關於我們</h3>
          <h5 class="font-weight-bold text-white text-shadow mb-0">About Us</h5>
        </div>
    </header>

    <nav class="breadcrumb-row" aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                <li class="breadcrumb-item"><a href="about.php">關於我們</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?=$rows_main["abouts_name"]?></li>
            </ol>   
        </div>
    </nav>

    <!-- Content Section -->
    <section class="content mt-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-12 mb-md-0 mb-3 py-md-5" style="background-color:#f6f7f7;">
                    <div class="sidebar-list list-group list-group-flush">
                     <?PHP 	
					//列出內容
					$sql_left="SELECT * 
							FROM `abouts` 
							where abouts_hide=1
							ORDER BY `abouts_sort` ,`abouts_no` DESC 
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
                        <a href="about.php?no=<?=$rows_left["abouts_no"]; ?>" class="list-group-item list-group-item-action <?PHP if($rows_left["abouts_no"]==$no) echo 'active'; ?>"><h4><span><?=$rows_left["abouts_name"]; ?></span></h4></a>
                    <?php	
					}
					}
					?>
                    </div>
                </div>
                <div class="col-md-9 col-12 mb-md-0 mb-5 py-md-5 px-md-5 video-wrapper" id="img-responsive">
                    <?PHP					
					echo $rows_main["abouts_content"];
					?>
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
<!--變更圖片class成為響應式大小-->
<script type="text/javascript">
$(document).ready(function() {
	$("#img-responsive img")
	.addClass("img-responsive")//增加bootstrap內健RWD寬度
	.css("height",'');//高度清除
});
</script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#img-responsive img")
	.addClass("img-responsive")//增加bootstrap內健RWD寬度
	.css("height",'');//高度清除
});
</script>
<style>
.img-responsive,.thumbnail>img,.thumbnail a>img,.carousel-inner>.item>img,.carousel-inner>.item>a>img{max-width:100%;height:auto}
.video-wrapper iframe {  width: 100%; height: auto; aspect-ratio: 16/9;}/*youtube崁入自動100%*/
</style>
<!--變更圖片class成為響應式大小-->
</body>
</html>
<?PHP include 'include_footer.php';?>
<?=$rows["include_footer"]; ?>