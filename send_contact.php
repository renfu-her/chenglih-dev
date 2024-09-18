<?PHP
if (!isset($_SESSION)) {
 	 session_start();
	}
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
include "admin/common.func.php";
$contact_name 		=	$_POST["contact_name"];
$contact_email 		=	$_POST["contact_email"];
$contact_tel 		=	$_POST["contact_tel"];
$contact_objects	=	$_POST["contact_objects"];
$contact_message 	=	$_POST["contact_message"];

//google我不是機器人
$captcha = $_POST['g-recaptcha-response'];
$secretKey = "$google_secretKey";
$ip = $_SERVER['REMOTE_ADDR'];

$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
$response = file_get_contents($url);
$responseKeys = json_decode($response,true);

if($responseKeys["success"]) {// success//google我不是機器人
	


$edittime   =	date("Y-m-d H:i:s");//新增時間

if (!empty($_SERVER['HTTP_CLIENT_IP']))
	$ip=$_SERVER['HTTP_CLIENT_IP'];
else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
else
	$ip=$_SERVER['REMOTE_ADDR'];



$sql="SELECT * FROM `webinfo`";
$result = $db->prepare("$sql");//防sql注入攻擊
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);

;


$send_email=$rows["send_email"];//收件者

	 
//新增
$sql="insert into mail (
`name` ,
`mail` ,
`tel` ,
`objects` ,
`message` ,
`date` ,
`ip`
)	VALUES (
:contact_name,
:contact_email,
:contact_tel,
:contact_objects,
:contact_message,
:edittime,
:ip
)";

	$result = $db->prepare("$sql");//防sql注入攻擊
	// 數值PDO::PARAM_INT  字串PDO::PARAM_STR
	$result->bindValue(':contact_name', $contact_name, PDO::PARAM_STR);
	$result->bindValue(':contact_email', $contact_email, PDO::PARAM_STR);
	$result->bindValue(':contact_tel', $contact_tel, PDO::PARAM_STR);
	$result->bindValue(':contact_objects', $contact_objects, PDO::PARAM_STR);
	$result->bindValue(':contact_message', $contact_message, PDO::PARAM_STR);
	$result->bindValue(':edittime', $edittime, PDO::PARAM_STR);
	$result->bindValue(':ip', $ip, PDO::PARAM_STR);


	$result->execute();


	$db = null;// 關閉連線
	


//Mail
		$message  ="
		<table width='700' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td height='61' align='left'><strong><font size='4'>網站來信通知</font></strong></td>
  </tr>
   <tr>
    <td height='2' align='left' bgcolor='#eeeeee'></td>
  </tr>
  <tr>
    <td align='left'>姓名 ：$contact_name</td>
  </tr>
  <tr>
    <td align='left'>連絡電話 ： $contact_tel </td>
  </tr>
  <tr>
    <td align='left'>電子郵件   ： $contact_email</td>
  </tr>  
  <tr>
    <td align='left'>詢問項目   ： $contact_objects</td>
  </tr>

  <tr>
    <td align='left'>留言</td>
  </tr>
    <tr>
      <td align='left'>".nl2br($contact_message)."</td>
    </tr>
</table>
";

//mail發送
	   //mail發送
	    //設定time out
		set_time_limit(120);
		//echo !extension_loaded('openssl')?"Not Available":"Available";

		require_once("./PHP_Mailer/PHPMailerAutoload.php"); //記得引入檔案 
		$mail = new PHPMailer;
		$mail->CharSet = "utf-8"; //郵件編碼
		//寄信的程式頁面加入這一行

	//$mail->SMTPDebug = 3; // 開啟偵錯模式
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = "$PHP_Mailer_host"; // Specify main and backup SMTP servers
		$mail->SMTPAuth = "$PHP_Mailer_SMTPAuth"; // Enable SMTP authentication
		//$mail->Username = '寄件者gmail'; // SMTP username
		$mail->Username = "$PHP_Mailer_Username"; // SMTP username
		//$mail->Password = "寄件者gmail密碼"; // SMTP password
		$mail->Password = "$PHP_Mailer_Password"; // SMTP password
		$mail->SMTPSecure = "$PHP_Mailer_SMTPSecure"; // Enable TLS encryption, `ssl` also accepted
		$mail->Port = "$PHP_Mailer_Port"; // TCP port to connect to

		//$mail->setFrom('寄件者gmail', '名字'); //寄件的Gmail
		$mail->setFrom("$PHP_Mailer_setFrom_mail", "$PHP_Mailer_setFrom_name"); //寄件的Gmail
		//$mail->addAddress('收件者信箱', '收件者名字'); // 收件的信箱
	
		//多收件者處理
		$send_email_array=explode(",",$send_email); //根據,切割存陣列
		$send_email_count=count($send_email_array);//計算陣列數量
		$i=0;
		while($i<$send_email_count){
			$send_email_tmp=$send_email_array[$i];//收件者mail
			$mail->addAddress("$send_email_tmp", "$send_email_tmp");
			
		  $i++;
		}
		//多收件者處理
	
		$mail->isHTML(true); // Set email format to HTML


		/*
			內文
		*/
	    $send_conpany=$rows['conpany'];//公司名稱
	    $mail->Subject = '=?utf-8?B?' . base64_encode("[ $send_conpany ] 聯絡我們來信") . '?=';
		$mail->Body = "$message"; //郵件內容
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		 	echo "<Script Language =\"Javascript\">";
			echo "alert('伺服器寄送失敗，或請直接來信或來電連繫，謝謝您!');";
			echo "location='./';";
			echo "</script>";
		} else {
			echo "<Script Language =\"Javascript\">";
			echo "alert('已順利送出資訊，我們將會盡快與您做聯繫，謝謝您!');";
			echo "location='./';";
			echo "</script>";	
		}
	    //mail發送
		


	} else {// error//google我不是機器人
	echo '<script language="javascript">';
	echo 'alert("請勾選 我不是機器人");';
	echo "history.back();";
	echo '</script>';
	exit();
}
//google我不是機器人
?>
