<?php 
# connecting files
require("../admin/includes/db.php");
require("../admin/includes/functions.php");

// EMAIL
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_booking_email($frm_data) {
    //Load Composer's autoloader
    require '../includes/vendor/autoload.php';

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
		$mail->Port       = 465;                   

		//Recipients
		$mail->setFrom('support@elekooceanresort.com', 'Eleko Ocean Front Resort');
		$mail->addAddress('elekooceanresort@gmail.com');   

		//Content
		$mail->isHTML(true);                                 
		$mail->Subject = "{$frm_data['subject']}";

        // Embed logo and room thumbnail
        $mail->AddEmbeddedImage('../img/logo/eleko_logo_white.png', 'logo_cid');   // Logo

        $mail->Body = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <title>Booking Confirmation</title>
                <link rel='preconnect' href='https://fonts.googleapis.com'>
                <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
                <link href='https://fonts.googleapis.com/css2?family=Caveat:wght@400;500&family=Montserrat:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
                <style>
                    * { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
                    body { padding:0; margin:0; display:block; min-width:100%; width:100%; background:#ededed; font-family: 'Montserrat', Arial, sans-serif; }
                    a { color:#978667; text-decoration:none; }
                    p { padding:0; margin:0; }
                    strong { font-weight:600; }
                    img { -ms-interpolation-mode:bicubic; }
                </style>
            </head>
            <body>
            <table width='100%' bgcolor='#ededed' cellpadding='0' cellspacing='0'>
                <tr>
                    <td align='center'>
                        <!-- Header -->
                        <table width='650' bgcolor='#262626'>
                            <tr>
                                <td align='center' style='padding:30px;'>
                                    <img src='cid:logo_cid' width='135' height='45' alt='Logo' />
                                </td>
                            </tr>
                        </table>

                        <!-- Booking Details -->
                        <table width='650' bgcolor='#ffffff' style='padding:30px;'>
                            <tr>
                                <td>
                                    <table width='100%' style='margin-top:20px; border-collapse:collapse;'>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Full Name:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>{$frm_data['name']}</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Email Address:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>{$frm_data['email']}</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Phone Number:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>{$frm_data['phone']}</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Subject:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>{$frm_data['subject']}</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Message:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>{$frm_data['message']}</td>
                                        </tr>
                                    </table>

                                    <p style='margin-top:10px; font-size:14px; line-height:20px; color:#444;'>
                                        Regards,<br>Eleko Ocean Front Resort
                                    </p>
                                </td>
                            </tr>
                        </table>

                        <!-- Footer -->
                        <table width='650' cellpadding='0' cellspacing='0' style='text-align:center; padding:20px; font-size:12px; color:#777;'>
                            <tr>
                                <td>
                                    &copy; <script>document.write(new Date().getFullYear());</script> Eleko Ocean Front Resort - All rights reserved
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>
            </body>
            </html>

        ";

        return $mail->send();

    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }
}

if(isset($_POST['submit'])) {
    $frm_data = filteration($_POST);

    $query = "INSERT INTO `contact`(`name`, `email`, `phone`, `subject`, `message`) VALUES (?,?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['email'], $frm_data['phone'], $frm_data['subject'], $frm_data['message']];

    $res = insert($query, $values, 'sssss');
    if($res) {
        echo "1";
        send_booking_email($frm_data);
    } else {
        echo "0";
    }
}
?>