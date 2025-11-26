<?php
session_start();
require_once('admin/includes/db.php');
require_once('admin/includes/functions.php');

$frm_data = filteration($_GET);

$booking_query = "SELECT * FROM `booking_order` WHERE trans_id = ? AND booking_status != ?";

$booking_res = select($booking_query, [$frm_data['ref'], 'pending'], 'ss');

if(mysqli_num_rows($booking_res) == 0) {
    redirect('index.php');
}

$booking_fetch = mysqli_fetch_assoc($booking_res);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Eleko Ocean Front Resort offers luxury beachfront apartments and premium short-stay accommodation in Lagos. Enjoy ocean views, a serene swimming pool, African-inspired architecture, and exceptional hospitality—perfect for vacations, getaways, and relaxation by the beach.">
    <meta name="author" content="Magic Veekthor">
    <meta name="keywords" content="Eleko Ocean Front Resort, Eleko Beach Resort, Lagos resort, beachfront accommodation, short stay apartment Lagos, luxury resort Nigeria, beach resort Lagos, vacation rental Lagos, oceanfront hotel Lagos, Eleko beach lodging, holiday homes Lagos, premium apartments Eleko">

    <meta property="og:title" content="Eleko Ocean Front Resort – Luxury Beachfront Stay in Lagos">
    <meta property="og:description" content="Experience premium beachfront living at Eleko Ocean Front Resort. Elegant apartments, ocean views, swimming pool, African-inspired art & exceptional hospitality.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.elekooceanresort.com">
    <meta property="og:site_name" content="Eleko Ocean Front Resort">
    <title>Booking Confirmation - Eleko Ocean Front Resort</title>
    
    <!-- Favicons-->
    <link rel="shortcut icon" href="img/logo/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/vendors.min.css" rel="stylesheet">
</head>

<body> 

    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Page Preload -->

    <main>
        <div class="container">
            <div class="row error_page">
                <div class="col-12 align-self-center text-center">
                    <?php 
                        if($booking_fetch['trans_status'] == 'success') {
                            echo<<<data
                                <h2>Booking successful!</h2>
                                <p>Check your email/spam for booking confirmation</p>
                                <p><a class="btn_1 mt-3" href="index.php">Go to home</a></p>
                            data;
                        } else {
                            echo<<<data
                                <h2>Payment failed! $booking_fetch[trans_resp_msg]</h2>
                                <p>Something went wrong! Return to the home page.</p>
                                <p><a class="btn_1 mt-3" href="index.php">Go to home</a></p>
                            data;
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
        </svg>
    </div>
    <!-- /back to top -->


<!-- COMMON SCRIPTS -->
<script src="js/common_scripts.js"></script>
<script src="js/common_functions.js"></script>


</body>
</html>