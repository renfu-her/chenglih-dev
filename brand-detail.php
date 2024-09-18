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
<?PHP
$edit_no		=	$_GET['no'];
$class_prekey	=	$_GET["class_prekey"];//主分類
$class_sub		=	$_GET["class_sub"];//主分類

$sql_main="SELECT *
FROM goods_item 
where goods_item_hide=1 && goods_item_no=:edit_no;
";

$result_main = $db->prepare("$sql_main");//防sql注入攻擊
// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
$result_main->bindValue(':edit_no', $edit_no, PDO::PARAM_INT);
$result_main->execute();
$rows_main = $result_main->fetch(PDO::FETCH_ASSOC);
$counts_main=$result_main->rowCount();//算出總筆數

if($counts_main<=0){
	echo '<meta charset="UTF-8">';
	echo '<script language="javascript">';
	echo 'alert("抱歉！資料已經下架或移除囉，網站將轉回首頁！");';
	echo "location='./';";
	echo '</script>';	
	exit();
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Language" content="zh-tw">
	<meta name="keywords" content="<?=$rows["keywords"];?>" />
	<meta name="description" content="<?PHP
												$news_content = $rows_main["goods_item_description"];
												$news_content = strip_tags($news_content); // 过滤 HTML 标记
												$news_content = htmlspecialchars_decode($news_content); // 将实体转换回普通字符
	   										echo mb_strimwidth($news_content, 0, 500, '...', 'UTF-8'); 
										?>" />
	<meta name="company" content="<?=$rows["conpany"];?>" />
	<meta name="robots" content="all">
	<meta name="robots" content="index,follow">
	<meta name="distribution" content="Taiwan"/>
	<meta name="revisit-after" content="7 days"/>
	<meta name="rating" content="general"/>
	<meta property="og:title" content="<?=$rows_main["goods_item_title"]; ?>-<?=$rows["conpany"];?>"/>
	<meta property="og:description" content="<?PHP
												$news_content = $rows_main["goods_item_description"];
												$news_content = strip_tags($news_content); // 过滤 HTML 标记
												$news_content = htmlspecialchars_decode($news_content); // 将实体转换回普通字符
	   										echo mb_strimwidth($news_content, 0, 500, '...', 'UTF-8'); 
										?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:site_name" content="<?=$rows["conpany"];?>" />
	<meta property="og:image" content="https://<?=$_SERVER['HTTP_HOST']?>/admin/goods_pic/<?=$rows_main["goods_item_pic_b"]; ?>"/>
	<link rel="image_src" href="https://<?=$_SERVER['HTTP_HOST']?>/admin/goods_pic/<?=$rows_main["goods_item_pic_b"]; ?>" />	
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon" />

    <title><?=$rows_main["goods_item_title"]; ?>-<?=$rows["conpany"];?></title>

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
                <?PHP if($class_prekey<>'' && $class_sub<>''){//有主類別和子類別就顯示 ?>
                
                
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
          			<?PHP }	//有主類別和子類別就顯示 ?>
            </ol>   
            </ol>   
        </div>
    </nav>

    <!-- Content Section -->
    <section class="content mt-md-0">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-md-0 mb-5 py-md-5">
                    <div class="row align-items-center">
                        <div class="col-auto mb-md-0 mb-5 pr-md-5">
                            <div class="card-img border">
                                <img class="card-img-top" src="./admin/goods_pic/<?=$rows_main["goods_item_pic_b"]; ?>">
                            </div>
                        </div>
                        <div class="col ml-md-5 mb-md-0 mb-5 pl-md-5">
                            <div class="about-text-block mb-5">
                              <div class="mb-2">
                            	  
     <?PHP //顯示出商品分類
	//查詢	
	$sql_class="
	SELECT * FROM `goods_class` 
	ORDER BY `goods_class_sort`  
	";//DESC是遞減
					
	$result_class = $db->prepare("$sql_class");//防sql注入攻擊	
	$result_class->execute();
			
	 while($rows_class = $result_class->fetch(PDO::FETCH_ASSOC)) 
	{
	
		$string = $rows_main["goods_item_class"];
		$find = ','.$rows_class["goods_class_no"].',';
		if (strpos($string, $find) !== false) {
	?>
						
						<span class="d-inline-block px-3 py-1" style="color: #627534;border: 1px solid #627534;border-radius: 8px;"><?=$rows_class["goods_class_name"];?></span>
	<?PHP
		}					
	}
	?> 
                             
                              </div>
                              
                               <h5 style="font-size: 16px;"><?=$rows_main["goods_item_model"]; ?></h5>
                                <h4 class="font-weight-bold"><?=$rows_main["goods_item_title"]; ?></h4>
                                <p class="mb-0"><?=nl2br($rows_main["goods_item_description"]); ?></p> 
                            </div>

                            <a href="contact.php#contactus" class="btn btn-send btn-block py-2"><h3>立即諮詢</h3></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-5 pb-md-5 video-wrapper" id="img-responsive">
                     


                    <!-- 編輯器 -->
                   <?=$rows_main["goods_item_content"]; ?>
                    <!-- 編輯器 -->


                </div>
                <div class="d-flex justify-content-center w-100 mb-0 py-5" aria-label="Go Back">
                    <a href="#" class="btn btn-goback rounded-pill px-md-5 px-4 py-2" onclick="history.back()">回上頁</a>
                    <?PHP $GoBack='yes';//返回上頁函式 ?>
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
.img-responsive,.thumbnail>img,.thumbnail a>img,.carousel-inner>.item>img,.carousel-inner>.item>a>img{display:block;max-width:100%;height:auto}
.video-wrapper iframe {  width: 100%; height: auto; aspect-ratio: 16/9;}/*youtube崁入自動100%*/
</style>
<!--變更圖片class成為響應式大小-->
</body>
</html>
<?PHP include 'include_footer.php';?>
<?=$rows["include_footer"]; ?>