<?php 
require('admin/includes/db.php');
require('admin/includes/functions.php');

date_default_timezone_set("Africa/Lagos");
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_booking_email($user_name, $customer_email, $room_name, $check_in_m, $check_out_m, $price_m, $paystack_reference, $room_thumb, $current_date) {
    //Load Composer's autoloader
    require 'includes/vendor/autoload.php';

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
		$mail->addAddress($customer_email);   

		//Content
		$mail->isHTML(true);                                 
		$mail->Subject = "Booking Confirmation - {$paystack_reference}";

        // Embed logo and room thumbnail
        $mail->AddEmbeddedImage('img/logo/eleko_logo_white.png', 'logo_cid');   // Logo
        $mail->AddEmbeddedImage($room_thumb, 'room_cid'); // thumbnail for the room

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

                        <!-- Banner -->
                        <table width='650'>
                            <tr>
                                <td>
                                    <img src='cid:room_cid' width='650' height='325' alt='Banner' />
                                </td>
                            </tr>
                        </table>

                        <!-- Booking Details -->
                        <table width='650' bgcolor='#ffffff' style='padding:30px;'>
                            <tr>
                                <td>
                                    <h2 style='text-align:center; font-family:'Montserrat', Arial; color:#333;'>Booking Confirmation!</h2>
                                    <p style='font-size:14px; line-height:20px; color:#444;'>Dear <strong>$user_name</strong>,</p>
                                    <p style='font-size:14px; line-height:20px; color:#444;'>Thank you for your booking. Here are your reservation details:</p>
                                    
                                    <table width='100%' style='margin-top:20px; border-collapse:collapse;'>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Apartment:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>$room_name</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Price:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>₦ $price_m</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Check-in:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>$check_in_m</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Check-out:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>$check_out_m</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Date of payment:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>$current_date</td>
                                        </tr>
                                    </table>

                                    <p style='margin-top:20px; font-size:14px; line-height:20px; color:#444;'>
                                        We look forward to welcoming you at Eleko Ocean Front Resort. If you wish to cancel your booking, kindly send a email to support@elekooceanresort.com
                                    </p>
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
        error_log("Email Error: " . $mail->ErrorInfo);
        return false;
    }
}

function send_booking_info($user_name, $customer_email, $room_name, $check_in_m, $check_out_m, $price_m, $paystack_reference, $room_thumb, $current_date) {
    //Load Composer's autoloader
    require 'includes/vendor/autoload.php';

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
        $mail->addAddress('victorodoh7@gmail.com');     

		//Content
		$mail->isHTML(true);                                 
		$mail->Subject = "Booking Confirmation - {$paystack_reference}";

        // Embed logo and room thumbnail
        $mail->AddEmbeddedImage('img/logo/eleko_logo_white.png', 'logo_cid');   // Logo
        $mail->AddEmbeddedImage($room_thumb, 'room_cid'); 

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

                        <!-- Banner -->
                        <table width='650'>
                            <tr>
                                <td>
                                    <img src='cid:room_cid' width='650' height='325' alt='Banner' />
                                </td>
                            </tr>
                        </table>

                        <!-- Booking Details -->
                        <table width='650' bgcolor='#ffffff' style='padding:30px;'>
                            <tr>
                                <td>
                                    <h2 style='text-align:center; font-family:'Montserrat', Arial; color:#333;'>Booking Confirmation!</h2>
                                    <p style='font-size:14px; line-height:20px; color:#444;'>Someone just made a reservation at Eleko Ocean Front Resort. Here are your reservation details:</p>
                                    
                                    <table width='100%' style='margin-top:20px; border-collapse:collapse;'>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Customer Name:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>$user_name</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Customer Email:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>$customer_email</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Apartment:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>$room_name</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Price:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>₦ $price_m</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Check-in:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>$check_in_m</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Check-out:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>$check_out_m</td>
                                        </tr>
                                        <tr>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'><strong>Date of payment:</strong></td>
                                            <td style='padding:8px; border-bottom:1px solid #ddd;'>$current_date</td>
                                        </tr>
                                    </table>

                                    <p style='margin-top:20px; font-size:14px; line-height:20px; color:#444;'>
                                        We look forward to welcoming you at Eleko Ocean Front Resort.
                                    </p>
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
        error_log("Email Error: " . $mail->ErrorInfo);
        return false;
    }
}


// Check reference
if (!isset($_GET['reference']) || empty($_GET['reference'])) {
    die("Invalid transaction reference!");
}

$reference = filteration($_GET)['reference'];


// Make sure room session exists
if (!isset($_SESSION['room'])) {
    die("Booking session missing.");
}

$room = $_SESSION['room'];
$room_id   = $room['id'];
$room_name = $room['name'];
$room_price = $room['price'];

// Check-in/out from URL (sent from JS)
$user_name = isset($_GET['user_name']) ? $_GET['user_name'] : null;
$address = isset($_GET['address']) ? $_GET['address'] : null;
$check_in  = isset($_GET['check_in']) ? $_GET['check_in'] : null;
$check_out = isset($_GET['check_out']) ? $_GET['check_out'] : null;

if (!$check_in || !$check_out) {
    die("Missing stay dates.");
}


// Verify transaction with Paystack (file_get_contents, no cURL)
$secretKey = "sk_test_90c050395058dab17436aa427f901f61c839a6ba";
$opts = [
    "http" => [
        "method" => "GET",
        "header" => "Authorization: Bearer $secretKey\r\n"
    ]
];
$context = stream_context_create($opts);
$response = file_get_contents("https://api.paystack.co/transaction/verify/$reference", false, $context);

if ($response === false) {
    die("Unable to verify payment. Please try again later.");
}

$paymentData = json_decode($response, true);


// Validate payment
if (!isset($paymentData['data']['status']) || $paymentData['data']['status'] !== "success") {
    die("Payment verification failed.");
}

$amount_paid = $paymentData['data']['amount'] / 100; // kobo → naira
$transaction_id = $paymentData['data']['id'];
$paystack_reference = $paymentData['data']['reference'];
$customer_email = $paymentData['data']['customer']['email'];


// Prevent double-charging
$check_sql = "SELECT booking_id FROM booking_order WHERE `trans_id` = ?";
$check_res = select($check_sql, [$paystack_reference], "s");

if (mysqli_num_rows($check_res) > 0) {
    header("Location: booking_success.php?ref=" . urlencode($paystack_reference) . "&status=already_recorded");
    exit;
}


// Insert new booking
$query = "INSERT INTO `booking_order`(`user_name`, `email`, `address`, `room_name`, `check_in`, `check_out`, `trans_id`, `price`, `trans_amt`) VALUES (?,?,?,?,?,?,?,?,?)";
$query_insert = insert($query, [$user_name, $customer_email, $address, $room_name, $check_in, $check_out, $paystack_reference, $room_price, $amount_paid], 'sssssssss');


// Make sure $user_data exists
// $user_data_res = select("SELECT * FROM user_cred WHERE id = ? LIMIT 1", [$user_id], "i");
// $user_data = mysqli_fetch_assoc($user_data_res);

// if (!$user_data) {
//     die("User data not found!");
// }

// $query2 = "INSERT INTO `booking_details`(`room_name`, `price`, `total_pay`, `user_name`, `email`, `address`) VALUES (?,?,?,?,?,?,?)";
// $query_insert2 = insert($query2, [$room_name, $room_price, $amount_paid, $user_data['name'], $customer_email, $user_data['address']], 'issssss');



// modify the amount
$price_m = number_format($amount_paid);

// modify the check in and check out
$check_in_m = date("d - F - Y", strtotime($check_in));
$check_out_m = date("d - F - Y", strtotime($check_out));


// Default cover image
$room_thumb = $_SERVER['DOCUMENT_ROOT'] . "/Eleko_v2/img/rooms/select_cover.jpg";

$thumb_query = mysqli_query($mysqli, "SELECT * FROM room_images WHERE room_id = $room_id AND thumbnail = '1'");
if (mysqli_num_rows($thumb_query) > 0) {
    $thumb_result = mysqli_fetch_assoc($thumb_query);
    $room_thumb = $_SERVER['DOCUMENT_ROOT'] . "/Eleko_v2/img/rooms/" . $thumb_result['image'];
}

// get date and time of the payment
$current_date = date("d - F - Y | h:i A",);

if ($query_insert) {
    unset($_SESSION['room']);

    // send email
    send_booking_email($user_name, $customer_email, $room_name, $check_in_m, $check_out_m, $price_m, $paystack_reference, $room_thumb, $current_date);
    send_booking_info($user_name,$customer_email, $room_name, $check_in_m, $check_out_m, $price_m, $paystack_reference, $room_thumb, $current_date);

    // redirect AFTER email function
    header("Location: booking_success.php?ref=" . urlencode($paystack_reference) . "&status=success");
    exit;

} else {
    die("Database error: booking insert failed.");
}

?>
