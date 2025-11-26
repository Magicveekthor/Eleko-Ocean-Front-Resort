<?php
require('../admin/includes/db.php');
require('../admin/includes/functions.php');

date_default_timezone_set("Africa/Lagos");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_email($email, $name, $token){
	//Load Composer's autoloader
	require '../includes/vendor/autoload.php';

	//Create an instance passing `true` enables exception
	$mail = new PHPMailer(true);

	try {
		//Server setting
		$mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
		$mail->isSMTP();
		$mail->SMTPKeepAlive = true; // Set mailer to use SMTP                                            //Send using SMTP
		$mail->Host       = 'elekooceanresort.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'support@elekooceanresort.com';                     //SMTP username
		$mail->Password   = 'oceanfront#123';                               //SMTP password
		$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
		$mail->Port       = 465;                     //Enable verbose debug output

		//Recipients
		$mail->setFrom('support@elekooceanresort.com', 'Eleko Ocean Front Resort');
		$mail->addAddress($email);     //Add a recipient

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Verify Email Address - Eleko Ocean Front Resort';
		//$mail->AddEmbeddedImage('../img/logo/eleko_logo_black.png', 'logoimg');

		$mail->Body = "
		
		<!DOCTYPE html>
		<html lang='en'>
		<head>
			<meta charset='UTF-8'>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>

			<link rel='preconnect' href='https://fonts.googleapis.com'>
			<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
			<link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
			
			<title>Email Verification Form</title>

			<style>
				*{
					box-sizing: border-box;
					margin: 0;
					padding: 0;
				}
				body {
					background-color: #f1f3f5;
					font-family: 'Poppins', sans-serif;
					font-weight: 500;
					
				}
				p{
					margin-top: 20px;
				}
				a {
					text-decoration: underline;
					color:#339af0;
				}
				.container {
					max-width: 600px;
					width: 90%;
					margin: 0 auto;
					color:#343a40;
				}
				/* --------------------------------------- BODY -----------------------------------  */
				.main {
					font-size: 15px;
					background-color: white;
					min-height: 400px;
					margin-left: 0 auto;
					padding: 50px;
					
				}
				.footer {
					font-family:#495057 ;
					font-size: 10px;
					text-align: center; 
					margin: 20px 0;

				}
				.code-name {
					position: relative;
					width: 100%;
					background-color: #f1f3f5;
					height: 100px;
					border: none;
					border-radius: 8px;
					margin-top: 20px;
					display: flex;
					align-items: center;
					justify-content: center;
				}
				.code-name a {
					font-size: 24px;
					color: #007bff;
					text-decoration: none;
					letter-spacing: 3px;
					text-transform: uppercase;
				}

				.anchor:hover, .anchor:visited {
					cursor: pointer;
					color: #1c7ed6;
				}
				/* ------------------------- PARAGRAPHS ---------------------------------  */
				.para1 {
					font-size: 24px;
					margin-top: 30px;
				}
				.para8 {
					margin-top: 0;
				}
				.para9 {
					font-weight: 600;
				}
				.para10{
					line-height: 1.2;
					margin-bottom: 35px;
				}
				.para11 {
					margin-top: 35px;
				}
				.nested-para {
					color: black;
					font-weight: 600;
				}
				/* ------------------------------ RESPONSIVE ADJUSTMENTS -------------------------------- */

				/* ----- large screens ------ */
				@media (max-width: 1600px) {
					.container {
						max-width: 800px;
					}
					.main {
						padding: 60px;
					}
				}
				/* ----- medium screens ------ */

				@media (max-width: 1000px) {
					.main {
						padding: 40px;
					}
					.para1 {
						font-size: 20px;
					}
					.code-name {
						height: 55px;
						font-size: 20px;
					}
					.container {
						width: 95%;
					}
				}

				/* ------ small screens ------ */

				@media (max-width: 500px) {
					body {
						background-color: #fff;
					}
					.main {
						padding: 25px 20px;
						border-radius: 0;
					}
					.para1 {
						font-size: 18px;
						margin-top: 20px;
					}
					.code-name {
						height: 50px;
						font-size: 18px;
					}
					.footer {
						font-size: 8px;
					}
				}
			</style>
		</head>

		<body>
			<div class='container'>
				<!-- MAIN BODY -->
				
				<main class='main-section'>
					<div class='main'>
						<p class='para2'>Hello, $name</p>
						<p class='para3'> Your account is nearly set up. Please use the link to verify your email address.</p>
					
						<div class='background:#f1f3f5; border-radius:8px; text-align:center; padding:22px 0; margin-top:40px;'>
							<a href='".SITE_URL."email_confirm.php?email_confirmation&email=$email&token=$token"."' style='font-size:24px; color:#3a6ee8; text-decoration:none; letter-spacing:3px; text-transform:uppercase; display:inline-block;'>click to verify</a>
						</div>

						<p class='para6'>If you are having issues with email verification or creating an
							account please contact our <a href='mailto:elekooceanresort@gmail.com' class='anchor'>support team</a>. If you did not make 
							this request, you can ignore this email. No account will be created.
						</p>
						<p class='para7'>Thank you</p>
						<p class='para8'>Eleko Ocean Front Resort Team</p>
					</div>
				</main>

				<!-- FOOTER SECTION -->

				<footer class='footer'>
					<p class='para9'> <span class='nested-para'>Need help?</span> <a href='mailto:elekooceanresort@gmail.com' class='anchor'>elekooceanresort@gmail.com</a></p> 
					<p class='para10'>
						&copy; <script>document.write(new Date().getFullYear());</script>, Eleko Ocean Front Resort. Eleko Ocean Front Resort, its logo, and all associated names and design elements are trademarks or registered trademarks of Eleko Ocean Front Resort. All other product names, logos, and brands are property of their respective owners.
					</p>
					<p> <a href='#'>Terms of Service</a> | <a href='#'>Privacy Policy</a> </p>
					<p class='para11'>Adepeyin Olowu Street, Eleko Beach Rd, Eleko 105101, Lagos</p> 
				</footer>
			</div>
		
			
			
		</body>
		</html>

		";
	$mail->send();

	if($mail) {
		return 1;
	} else {
		return 0;
	}
	} catch (Exception $e) {
		return 0;
		//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}

// function reset_link($email, $token){
// 	//Load Composer's autoloader
// 	require '../includes/vendor/autoload.php';

// 	//Create an instance passing `true` enables exception
// 	$mail = new PHPMailer(true);

// 	try {
// 		//Server setting
// 		$mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
// 		$mail->isSMTP();
// 		$mail->SMTPKeepAlive = true; // Set mailer to use SMTP                                            //Send using SMTP
// 		$mail->Host       = 'elekooceanresort.com';                     //Set the SMTP server to send through
// 		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
// 		$mail->Username   = 'support@elekooceanresort.com';                     //SMTP username
// 		$mail->Password   = 'oceanfront#123';                               //SMTP password
// 		$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
// 		$mail->Port       = 465;                     //Enable verbose debug output

// 		//Recipients
// 		$mail->setFrom('support@elekooceanresort.com', 'Eleko Ocean Front Resort');
// 		$mail->addAddress($email);     //Add a recipient

// 		//Content
// 		$mail->isHTML(true);                                  //Set email format to HTML
// 		$mail->Subject = 'Password Reset - Eleko Ocean Front Resort';
// 		//$mail->AddEmbeddedImage('../img/logo/eleko_logo_black.png', 'logoimg');

// 		$mail->Body = "
		
// 		<!DOCTYPE html>
// 		<html lang='en'>
// 		<head>
// 			<meta charset='UTF-8'>
// 			<meta name='viewport' content='width=device-width, initial-scale=1.0'>

// 			<link rel='preconnect' href='https://fonts.googleapis.com'>
// 			<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
// 			<link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
			
// 			<title>Email Verification Form</title>

// 			<style>
// 				*{
// 					box-sizing: border-box;
// 					margin: 0;
// 					padding: 0;
// 				}
// 				body {
// 					background-color: #f1f3f5;
// 					font-family: 'Poppins', sans-serif;
// 					font-weight: 500;
					
// 				}
// 				p{
// 					margin-top: 20px;
// 				}
// 				a {
// 					text-decoration: underline;
// 					color:#339af0;
// 				}
// 				.container {
// 					max-width: 600px;
// 					width: 90%;
// 					margin: 0 auto;
// 					color:#343a40;
// 				}
// 				/* --------------------------------------- BODY -----------------------------------  */
// 				.main {
// 					font-size: 15px;
// 					background-color: white;
// 					min-height: 400px;
// 					margin-left: 0 auto;
// 					padding: 50px;
					
// 				}
// 				.footer {
// 					font-family:#495057 ;
// 					font-size: 10px;
// 					text-align: center; 
// 					margin: 20px 0;

// 				}
// 				.code-name {
// 					position: relative;
// 					width: 100%;
// 					background-color: #f1f3f5;
// 					height: 100px;
// 					border: none;
// 					border-radius: 8px;
// 					margin-top: 20px;
// 					display: flex;
// 					align-items: center;
// 					justify-content: center;
// 				}
// 				.code-name a {
// 					font-size: 24px;
// 					color: #007bff;
// 					text-decoration: none;
// 					letter-spacing: 3px;
// 					text-transform: uppercase;
// 				}

// 				.anchor:hover, .anchor:visited {
// 					cursor: pointer;
// 					color: #1c7ed6;
// 				}
// 				/* ------------------------- PARAGRAPHS ---------------------------------  */
// 				.para1 {
// 					font-size: 24px;
// 					margin-top: 30px;
// 				}
// 				.para8 {
// 					margin-top: 0;
// 				}
// 				.para9 {
// 					font-weight: 600;
// 				}
// 				.para10{
// 					line-height: 1.2;
// 					margin-bottom: 35px;
// 				}
// 				.para11 {
// 					margin-top: 35px;
// 				}
// 				.nested-para {
// 					color: black;
// 					font-weight: 600;
// 				}
// 				/* ------------------------------ RESPONSIVE ADJUSTMENTS -------------------------------- */

// 				/* ----- large screens ------ */
// 				@media (max-width: 1600px) {
// 					.container {
// 						max-width: 800px;
// 					}
// 					.main {
// 						padding: 60px;
// 					}
// 				}
// 				/* ----- medium screens ------ */

// 				@media (max-width: 1000px) {
// 					.main {
// 						padding: 40px;
// 					}
// 					.para1 {
// 						font-size: 20px;
// 					}
// 					.code-name {
// 						height: 55px;
// 						font-size: 20px;
// 					}
// 					.container {
// 						width: 95%;
// 					}
// 				}

// 				/* ------ small screens ------ */

// 				@media (max-width: 500px) {
// 					body {
// 						background-color: #fff;
// 					}
// 					.main {
// 						padding: 25px 20px;
// 						border-radius: 0;
// 					}
// 					.para1 {
// 						font-size: 18px;
// 						margin-top: 20px;
// 					}
// 					.code-name {
// 						height: 50px;
// 						font-size: 18px;
// 					}
// 					.footer {
// 						font-size: 8px;
// 					}
// 				}
// 			</style>
// 		</head>

// 		<body>
// 			<div class='container'>
// 				<!-- MAIN BODY -->
				
// 				<main class='main-section'>
// 					<div class='main'>
// 						<p class='para2'>Hello, $email</p>
// 						<p class='para3'> Trouble accessing your Eleko Ocean Front Resort account? No problem, we're here to help. Select the button below to reset your password.</p>
					
// 						<div class='background:#f1f3f5; border-radius:8px; text-align:center; padding:22px 0; margin-top:40px;'>
// 							<a href='".SITE_URL."reset_password.php?reset_password&email=$email&token=$token"."' style='font-size:24px; color:#3a6ee8; text-decoration:none; letter-spacing:3px; text-transform:uppercase; display:inline-block;'>RESET PASSWORD</a>
// 						</div>

// 						<p class='para6'>By resetting your password, you'll also confirm your email associated with the account. If you didn't request this reset, you can safely ignore this email.</p>
// 						<p class='para7'>Thank you</p>
// 						<p class='para8'>Eleko Ocean Front Resort Team</p>
// 					</div>
// 				</main>

// 				<!-- FOOTER SECTION -->

// 				<footer class='footer'>
// 					<p class='para9'> <span class='nested-para'>Need help?</span> <a href='mailto:elekooceanresort@gmail.com' class='anchor'>elekooceanresort@gmail.com</a></p> 
// 					<p class='para10'>
// 						&copy; <script>document.write(new Date().getFullYear());</script>, Eleko Ocean Front Resort. Eleko Ocean Front Resort, its logo, and all associated names and design elements are trademarks or registered trademarks of Eleko Ocean Front Resort. All other product names, logos, and brands are property of their respective owners.
// 					</p>
// 					<p> <a href='#'>Terms of Service</a> | <a href='#'>Privacy Policy</a> </p>
// 					<p class='para11'>Adepeyin Olowu Street, Eleko Beach Rd, Eleko 105101, Lagos</p> 
// 				</footer>
// 			</div>
		
			
			
// 		</body>
// 		</html>

// 		";
// 	$mail->send();

// 	if($mail) {
// 		return 1;
// 	} else {
// 		return 0;
// 	}
// 	} catch (Exception $e) {
// 		return 0;
// 		//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// 	}
// }

// if(isset($_POST['register'])) {
//     $data = filteration($_POST);

//     if($data['password'] != $data['cpassword']) {
//         echo 'password_mismatch';
//         exit;
//     }

//     # check user exists or not
//     $u_exists = select("SELECT * FROM `user_cred` WHERE `email` = ? OR `phonenum` = ? LIMIT 1", [$data['email'], $data['phonenum']], "ss");

//     if(mysqli_num_rows($u_exists) != 0) {
//         $u_exists_fetch = mysqli_fetch_assoc($u_exists);
//         echo ($u_exists_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
//         exit;
//     }

//     # upload user image to server
//     $img = uploadUserImage($_FILES['profile']);

//     if($img == 'inv_img') {
//         echo 'inv_img';
//         exit;
//     } else if($img == 'Upload Failed') {
//         echo 'Upload Failed';
//         exit;
//     }

//     #send confirmation link to user's email
// 	$token = bin2hex(random_bytes(16));

// 	if(!send_email($data['email'], $data['name'], $token)) {
// 		echo 'mail_failed';
// 		exit;
// 	}

// 	$enc_pass = password_hash($data['password'], PASSWORD_BCRYPT);

// 	$query = "INSERT INTO `user_cred`(`name`, `email`, `phonenum`, `address`, `dob`, `zipcode`, `profile`, `password`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";
// 	$values  = [$data['name'], $data['email'], $data['phonenum'], $data['address'], $data['dob'], $data['zipcode'], $img, $enc_pass, $token];

// 	if(insert($query, $values, 'sssssssss')){
// 		echo 1;
// 	} else {
// 		echo 'ins_failed';
// 	}
// }


// if(isset($_POST['login'])) {
// 	$data = filteration($_POST);

// 	# check user exists or not
//     $u_exists = select("SELECT * FROM `user_cred` WHERE `email` = ? OR `phonenum` = ? LIMIT 1", [$data['email_mob'], $data['email_mob']], "ss");

//     if(mysqli_num_rows($u_exists) == 0) {
// 		echo 'inv_email_mob';
// 		exit;
//     } else {
// 		$u_fetch = mysqli_fetch_assoc($u_exists);
// 		if($u_fetch['is_verified'] == 0) {
// 			echo 'not_verified';
// 		} else if($u_fetch['status'] == 0){
// 			echo 'inactive';
// 		} else {
// 			if(!password_verify($data['password'], $u_fetch['password'])){
// 				echo 'invalid_pass';
// 			} else {
// 				session_start();
// 				$_SESSION['login'] = true;
// 				$_SESSION['uId'] = $u_fetch['id'];
// 				$_SESSION['uName'] = $u_fetch['name'];
// 				$_SESSION['uPic'] = $u_fetch['profile'];
// 				$_SESSION['uPhone'] = $u_fetch['phonenum'];
// 				echo 1;
// 			}
// 		}
// 	}
// }


// if(isset($_POST['forgot_password'])) {
// 	$data = filteration($_POST);

// 	# check user exists or not
//     $u_exists = select("SELECT * FROM `user_cred` WHERE `email` = ? LIMIT 1", [$data['email']], "s");

//     if(mysqli_num_rows($u_exists) == 0) {
// 		echo 'inv_email';
// 		exit;
//     } else {
// 		$u_fetch = mysqli_fetch_assoc($u_exists);
// 		if($u_fetch['is_verified'] == 0) {
// 			echo 'not_verified';
// 		} else if($u_fetch['status'] == 0){
// 			echo 'inactive';
// 		} else {
// 			//send reset link
// 			$token = bin2hex(random_bytes(16));
// 			if(!reset_link($data['email'], $token)){
// 				echo 'mail_failed';
// 			} else {
// 				$date = date("Y-m-d");
// 				$query = mysqli_query($mysqli, "UPDATE `user_cred` SET `token` = '$token', `t_expire` = '$date' WHERE `id` = '$u_fetch[id]'");

// 				if($query) {
// 					echo 1;
// 				} else {
// 					echo 'upd_failed';
// 				}
// 			}
// 		}
// 	}
// }


// if(isset($_POST['recover_password'])) {
// 	$data = filteration($_POST);

// 	if($data['password'] != $data['cpassword']) {
// 		echo 'password_mismatch';
// 		exit;
//     }

// 	# check user record to compare old password
// 	$check_user = select("SELECT `password` FROM `user_cred` WHERE `email` = ? AND `token` = ? LIMIT 1", [$data['email'], $data['token']], "ss");
// 	if(mysqli_num_rows($check_user) == 1) {
// 		$fetch = mysqli_fetch_assoc($check_user);

// 		# Verify if entered password is SAME as old password
// 		if(password_verify($data['password'], $fetch['password'])) {
// 			echo 'same_password';
// 			exit;
// 		}
// 	}

// 	$enc_pass = password_hash($data['password'], PASSWORD_BCRYPT);
// 	$query = "UPDATE `user_cred` SET `password` = ?, `token` = '', `t_expire` = '' WHERE `email` = ? AND `token` = ?";
// 	$values = [$enc_pass, $data['email'], $data['token']];

// 	if(update($query, $values, 'sss')) {
// 		echo 'success';
// 	} else {
// 		echo 'failed';
// 	}
// }
?>