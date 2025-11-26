<?php  
require('admin/includes/db.php');
require('admin/includes/functions.php');
session_start();

// // User must be logged in
// if(!isset($_SESSION['login']) || $_SESSION['login'] != true){
//     redirect("index.php");
//     exit;
// }


// Check reference
if(!isset($_GET['ref'])){
    redirect("index.php");
    exit;
}

$reference = $_GET['ref'];

// VERIFY PAYMENT AGAIN
$secretKey = "sk_test_90c050395058dab17436aa427f901f61c839a6ba";
$opts = [
    "http" => [
        "method" => "GET",
        "header" => "Authorization: Bearer $secretKey\r\n"
    ]
];

$context = stream_context_create($opts);
$response = file_get_contents("https://api.paystack.co/transaction/verify/" . $reference, false, $context);

if ($response === false) {
    die("Unable to verify payment. Please try again later.");
}

$paystack = json_decode($response, true);

if (!$paystack['status']) {
    die("Verification failed");
}

$data = $paystack['data'];

// Extract values
$status       = $data['status'];
$gateway_msg  = $data['gateway_response'];
$trans_ref    = $data['reference']; // same as $reference

// FIND THE BOOKING BY THIS REFERENCE
$booking_res = select("SELECT booking_id FROM booking_order WHERE trans_id = ? LIMIT 1", [$trans_ref], "s");

if(mysqli_num_rows($booking_res) == 0){
    die("No booking found for this reference!");
}

$booking_row = mysqli_fetch_assoc($booking_res);
$booking_id = $booking_row['booking_id'];

// UPDATE THE BOOKING
$booking_status = ($status === 'success') ? 'booked' : 'payment failed';

$upd_query = "UPDATE booking_order SET booking_status = ?, trans_status = ?, trans_resp_msg = ? WHERE booking_id = ?";
update($upd_query, [$booking_status, $status, $gateway_msg, $booking_id], "sssi");





// Redirect to final page with reference and status
header("Location: final_success.php?ref=" . $trans_ref);
exit;
?>
