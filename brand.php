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
                <li class="breadcrumb-item active" aria-current="page">品牌專區</li>
            </ol>   
        </div>
    </nav>

    <!-- Content Section -->
    <section class="content mt-md-0">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-md-0 mb-3 py-md-5">
                    <h3 class="brand-title">品牌專區</h3>

                    <div class="row">
                        <div class="col-md col-6 mb-md-0 mb-4 pr-3" data-aos="fade-down" data-aos-delay="150" data-aos-duration="800">
                            <div class="card border-0 p-0">
                                <div class="card-img">
                                    <a href="brand-list.php?class=1&class_sub=<?PHP
									//取第一筆子類別
									$sql_class_sub="
									SELECT * 
									FROM `goods_class` 
									ORDER BY `goods_class_sort` ,`goods_class_no` DESC 
									LIMIT 1
									";
									$result_class_sub = $db->prepare("$sql_class_sub");//防sql注入攻擊
									$result_class_sub->execute();
									$rows_class_sub = $result_class_sub->fetch(PDO::FETCH_ASSOC);
									echo $rows_class_sub["goods_class_no"];
											 ?>" class="hover-img">
                                        <img class="card-img-top img-fluid" src="./img/img_brand01.jpg" alt="brand 01">
                                    </a>
                                </div>
                                <div class="card-body bg-green">
                                    <a href="brand-list.php?class=1&class_sub=<?=$rows_class_sub["goods_class_no"];?>">
                                        <h4 class="text-white">食品分類</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md col-6 mb-md-0 mb-4 pt-md-5 pr-3"  data-aos="fade-up" data-aos-delay="450" data-aos-duration="800">
                            <div class="card border-0 p-0">
                                <div class="card-img">
                                    <a href="brand-list.php?class=2&class_sub=<?PHP
									//取第一筆子類別
									$sql_class_sub="
									SELECT * 
									FROM `goods_class2` 
									ORDER BY `goods_class2_sort` ,`goods_class2_no` DESC 
									LIMIT 1
									";
									$result_class_sub = $db->prepare("$sql_class_sub");//防sql注入攻擊
									$result_class_sub->execute();
									$rows_class_sub = $result_class_sub->fetch(PDO::FETCH_ASSOC);
									echo $rows_class_sub["goods_class2_no"];
											 ?>" class="hover-img">
                                        <img class="card-img-top img-fluid" src="./img/img_brand02.jpg" alt="brand 02">
                                    </a>
                                </div>
                                <div class="card-body bg-green">
                                    <a href="brand-list.php?class=2&class_sub=<?=$rows_class_sub["goods_class2_no"];?>">
                                        <h4 class="text-white">廠牌分類</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md col-6 mb-md-0 mb-4 pr-3" data-aos="fade-down" data-aos-delay="750" data-aos-duration="800">
                            <div class="card border-0 p-0">
                                <div class="card-img">
                                    <a href="brand-list.php?class=3&class_sub=<?PHP
									//取第一筆子類別
									$sql_class_sub="
									SELECT * 
									FROM `goods_class3` 
									ORDER BY `goods_class3_sort` ,`goods_class3_no` DESC 
									LIMIT 1
									";
									$result_class_sub = $db->prepare("$sql_class_sub");//防sql注入攻擊
									$result_class_sub->execute();
									$rows_class_sub = $result_class_sub->fetch(PDO::FETCH_ASSOC);
									echo $rows_class_sub["goods_class3_no"];
											 ?>" class="hover-img">
                                        <img class="card-img-top img-fluid" src="./img/img_brand03.jpg" alt="brand 03">
                                    </a>
                                </div>
                                <div class="card-body bg-green">
                                    <a href="brand-list.php?class=3&class_sub=<?=$rows_class_sub["goods_class3_no"];?>">
                                        <h4 class="text-white">設備分類(產線)</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md col-6 mb-md-0 mb-4 pt-md-5 pr-3" data-aos="fade-up" data-aos-delay="1050" data-aos-duration="800">
                            <div class="card border-0 p-0">
                                <div class="card-img">
                                    <a href="brand-list.php?class=4&class_sub=<?PHP
									//取第一筆子類別
									$sql_class_sub="
									SELECT * 
									FROM `goods_class4` 
									ORDER BY `goods_class4_sort` ,`goods_class4_no` DESC 
									LIMIT 1
									";
									$result_class_sub = $db->prepare("$sql_class_sub");//防sql注入攻擊
									$result_class_sub->execute();
									$rows_class_sub = $result_class_sub->fetch(PDO::FETCH_ASSOC);
									echo $rows_class_sub["goods_class4_no"];
											 ?>" class="hover-img">
                                        <img class="card-img-top img-fluid" src="./img/img_brand04.jpg" alt="brand 04">
                                    </a>
                                </div>
                                <div class="card-body bg-green">
                                    <a href="brand-list.php?class=4&class_sub=<?=$rows_class_sub["goods_class4_no"];?>">
                                        <h4 class="text-white">設備分類 (單機)</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md col-6 mb-md-0 mb-4 pr-3" data-aos="fade-down" data-aos-delay="1350" data-aos-duration="800">
                            <div class="card border-0 p-0">
                                <div class="card-img">
                                    <a href="brand-list.php?class=5&class_sub=<?PHP
									//取第一筆子類別
									$sql_class_sub="
									SELECT * 
									FROM `goods_class5` 
									ORDER BY `goods_class5_sort` ,`goods_class5_no` DESC 
									LIMIT 1
									";
									$result_class_sub = $db->prepare("$sql_class_sub");//防sql注入攻擊
									$result_class_sub->execute();
									$rows_class_sub = $result_class_sub->fetch(PDO::FETCH_ASSOC);
									echo $rows_class_sub["goods_class5_no"];
											 ?>" class="hover-img">
                                        <img class="card-img-top img-fluid" src="./img/img_brand05.jpg" alt="brand 05">
                                    </a>
                                </div>
                                <div class="card-body bg-green">
                                    <a href="brand-list.php?class=5&class_sub=<?=$rows_class_sub["goods_class5_no"];?>">
                                        <h4 class="text-white">其他種類</h4>
                                    </a>
                                </div>
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