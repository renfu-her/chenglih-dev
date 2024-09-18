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
	<meta property="og:title" content="與我聯絡-<?=$rows["conpany"];?>"/>
	<meta property="og:description" content="<?=$rows["description"];?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:site_name" content="<?=$rows["conpany"];?>" />
	<meta property="og:image" content="https://<?=$_SERVER['HTTP_HOST']?>/admin/goods_pic/<?=$rows["share_pic"]; ?>"/>
	<link rel="image_src" href="https://<?=$_SERVER['HTTP_HOST']?>/admin/goods_pic/<?=$rows["share_pic"]; ?>" />	
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon" />

    <title>與我聯絡-<?=$rows["conpany"];?></title>

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
<header class="page-kv" style="background-image: url('./img/img_contactkv.jpg');">
    <div class="kv-caption">
          <h3 class="font-weight-bold text-white text-shadow mb-0">與我聯絡</h3>
          <h5 class="font-weight-bold text-white text-shadow mb-0">Contact Us</h5>
        </div>
    </header>

    <nav class="breadcrumb-row mb-md-5" aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">首頁</a>                  
                </li>
                <li class="breadcrumb-item active" aria-current="page">與我聯絡</li>
            </ol>    
        </div>
    </nav>

    <!-- Content Section -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5 text-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3615.747277814288!2d121.48610599999999!3d25.008701999999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442a82c190d2df3%3A0x1cf7ad37557582e9!2zMjM15paw5YyX5biC5Lit5ZKM5Y2A56uL5b636KGXMTU46Jmf!5e0!3m2!1szh-TW!2stw!4v1673702090052!5m2!1szh-TW!2stw" width="100%" height="480" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                   
                    <ul class="list-inline py-4">
                        <li class="list-inline-item py-1">
                          <a href="tel:02-8667-2885"> <img src="./img/ic_phone_gray.png" class="img-fluid mr-2">(02)8667-2885</a>
                        </li>
                        <li class="list-inline-item py-1">
                          <a> <img src="./img/ic_fax_gray.png" class="img-fluid mr-2">(02)8667-5265</a>
                        </li>
                        <li class="list-inline-item py-1">
                          <a href="https://goo.gl/maps/1CBpeGC2WDbUZ11e9" target="_blank"> <img src="./img/ic_marker_gray.png" class="img-fluid mr-2">新北市中和區立德街158號7樓</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid pt-md-5" style="background-color: #eee;">
            <div class="row justify-content-center">
                <div class="col-12 py-5" id="form-anchor">
                    <h3 class="page-title text-center mb-4" id="contactus">填寫表單</h3>
                    <p class="text-lightdark text-center mb-4">請填寫以下資料，我們將有專人與您聯絡</p>
                    
                    <div class="form-content pb-5">
                        <div class="row">
                            <div class="col-md-8 col-12 mx-auto">
                                <form method="post" class="col-md-12" action="send_contact.php">
                                    <div class="form-group">
                                        <label for="contact_name">聯絡人</label>
                                        <input type="text" class="form-control form-control-lg" id="contact_name" name="contact_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_tel">聯絡電話</label>
                                        <input type="number" class="form-control form-control-lg" id="contact_tel" name="contact_tel" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_email">電子郵件</label>
                                        <input type="email" class="form-control form-control-lg" id="contact_email" name="contact_email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_objects">詢問項目</label>
                                        <select class="form-control form-control-lg" id="contact_objects" name="contact_objects">
                                            <option value="" selected>請選擇</option>
                                            <option value="產品諮詢">產品諮詢</option>
                                            <option value="合作洽談">合作洽談</option>
                                            <option value="供應商諮詢">供應商諮詢</option>
                                            <option value="其他">其他</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_message">留言內容</label>
                                        <textarea class="form-control form-control-lg" id="contact_message" name="contact_message" rows="4" required></textarea>
                                    </div>
                                    <div class="w-100 text-center mb-3">
                                      <script src='https://www.google.com/recaptcha/api.js'></script>	   
								  	  <div class="g-recaptcha wow fadeInDown animated" data-sitekey="<?=$google_data_sitekey?>"></div>
                                    </div>
                    
                                    <button type="submit" class="btn btn-send btn-block py-md-3 py-2" value="Submit"><h3>送出</h3></button>
                    
                                </form>
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