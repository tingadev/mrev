


<?php require_once('phpmailer/class.phpmailer.php'); ?>
<?php 
	include "lang/config.php";
 ?>
<?php
	function sendMail_Bill($p_from,$p_name,$p_temp,$p_subject,$p_body){
		global $config;
		
		$p_recieve = $p_temp;
		if($p_temp =='empty'){
			$p_recieve = $config['Email'];
		}
		if($p_from == 'empty'){
			$p_from = $config['Email'];
		}
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 1; // enables SMTP debug information (for testing)
		// 1 = errors and messages
		// 2 = messages only


		$mail->SMTPAuth = true; // Sử dụng đăng nhập vào account
		$mail->SMTPSecure = "tls";
		$mail->Host = $config['Host']; // Thiết lập thông tin của SMPT theo dòng Outgoing của bước 1
		$mail->Port = $config['Port']; // Thiết lập cổng gửi email của máyv theo dòng Sever của bước 1
		$mail->Username = $config['Username']; // SMTP account username mà bạn đã tạo trên host cPanel
		$mail->Password = $config['Password']; // SMTP account password mà bạn đã tạo trên host cPanel

		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom($p_from,$p_name);

		//Thiết lập thông tin người nhận
		$mail->AddAddress($p_recieve, "Homebyte");
		//Thiết lập email nhận email hồi đáp
		//nếu người nhận nhấn nút Reply
		$mail->AddReplyTo($p_from,$p_name);

		/*=====================================
		* THIET LAP NOI DUNG EMAIL
		*=====================================*/

		//Thiết lập tiêu đề
		$mail->Subject = $p_subject;

		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";

		//Thiết lập nội dung chính của email
		$body = $p_body;
		$mail->Body = $body;
		$mail->IsHTML(true); 


		if(!$mail->Send()) {
			return false;
		} else {
			return true;

		}
	}
	
	// 	$p_from = $_POST['email'];
	// 	$p_name = $_POST['name'];
	// 	$p_subject = $_POST['title'];
	// 	$p_phone = $_POST['phone'];
	// 	$p_content = $_POST['content'];
	// 	$p_address = $_POST['address'];

		
	// 	// echo $config['Host'] ."</br>";

	// 	// echo $config['Port'] ."</br>";

	// 	// echo $config['Username'] ."</br>";

	// 	// echo $config['Password'] ."</br>";
	// 	// die;


	

		
        	
	
	// // $mess['success'] = $config['success'];
	// // $mess['err'] = $config['fail'];
	// // $mess['ok'] =0;






 ?>