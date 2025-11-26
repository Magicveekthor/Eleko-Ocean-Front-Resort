<?php
require_once('admin/includes/db.php');
require_once('admin/includes/functions.php');

// filter and get room and user data
$data = filteration($_GET);
$room_result = select("SELECT * FROM `rooms` WHERE `id` = ? AND `status` = ? AND `removed` = ?", [$data['id'], 1,0], 'iii');

if(mysqli_num_rows($room_result) == 0) {
    redirect('rooms.php');
}
$room_data = mysqli_fetch_assoc($room_result);
$page_title = "Confirm Booking - " .$room_data['name'] . " | Eleko Ocean Front Resort";

$price = number_format($room_data['price']);

$_SESSION['room'] = [
    "id" => $room_data['id'],
    "name" => $room_data['name'],
    "price" => $room_data['price'],
    "payment" => null,
    "available" => false,
];

# get cover image
$room_thumb = ROOMS_IMG_PATH."select_cover.jpg";
$thumb_query = mysqli_query($mysqli, "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]' AND `thumbnail` = '1'");

if(mysqli_num_rows($thumb_query) > 0) {
    $thumb_result = mysqli_fetch_assoc($thumb_query);
    $room_thumb = ROOMS_IMG_PATH.$thumb_result['image'];
}
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
    <title><?php echo $page_title; ?></title>
    
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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/vendors.min.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">
</head>

<body> 

    <?php include "includes/header.php"; ?>
 
    <main>

      <div class="hero small-height jarallax" data-jarallax data-speed="0.2">
          <img class="jarallax-img" src="<?php echo $room_thumb ?>" alt="">
          <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
              <div class="container">
                  <small class="slide-animated one">Eleko Ocean Front Resort</small>
                  <h1 class="slide-animated two">Confirm Booking - <?php echo $room_data['name'] ?></h1>
              </div>
          </div>
      </div>
        <!-- /Background Img Parallax -->

        <div class="container margin_120_95">
            <div class="row justify-content-between">
                <div class="col-xl-12 col-lg-12">
                    <h3 class="mb-2">Booking Details</h3>
                    <span class="text-dark">Note: Your details must match with your ID (Passport, National ID Card, Driving License, etc.) that will be required during check in...</span>
                    <form id="booking-form" class="mt-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" value="<?php echo $room_data['name'] ?>" disabled>
                                    <label for="room_type">Room Type</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" value="&#8358;<?php echo $price ?> / night" disabled>
                                    <label for="price">Price</label>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text"  name="name">
                                    <label for="full_name">Full Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="email" name="email">
                                    <label for="email_address">Email Address</label>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" name="address">
                                    <label for="address">Address</label>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" onchange="check_availability()" type="date" placeholder="Check-in" name="checkin" required>
                                    <label for="checkin">Check-in</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" onchange="check_availability()" type="date" placeholder="Check-out" name="checkout" required>
                                    <label for="checkout">Check-out</label>
                                </div>
                            </div>
                        </div>
                        <div id="message-contact" class="text-danger"></div>
                        <input type="hidden" name="total_amount" id="total_amount">
                         <!-- /row -->
                        <p class="mt-3">
                            <button type="button" onclick="pay_now()" class="btn_1 outline" id="bookingSubmitBtn">
                                <span class="btn-text">Pay Now</span>
                                <span id="bookingSpinner" style="display:none;">⏳</span>
                            </button>
                        </p>
                    </form>
                </div>
            </div>
            <!-- /row -->
        </div>

        <div class="add_bottom_120">
            <div class="container-fluid p-lg-0">
                <div data-cues="zoomIn">
                    <div class="owl-carousel owl-theme carousel_item_centered kenburns rounded-img">
                        <?php 
                        # get cover image
                        $room_img = ROOMS_IMG_PATH."select_cover.jpg";
                        $images_query = mysqli_query($mysqli, "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]' AND `thumbnail` != '1'");

                        if(mysqli_num_rows($images_query) > 0) {
                            while($images_result = mysqli_fetch_assoc($images_query)) {
                                echo "
                                <div class='item'>
                                    <img src='".ROOMS_IMG_PATH.$images_result['image']."' alt=''>
                                </div>
                                ";
                            }
                            
                        } else {
                            echo "
                            <div class='item'>
                                <img src='$room_img' alt=''>
                            </div>
                            ";
                        }
                        ?>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a class="btn_1 outline" data-fslightbox="gallery_1" data-type="image" href="<?php echo $room_thumb; ?>">FullScreen Gallery</a>
                    <?php 
                        # get cover image
                        $room_img = ROOMS_IMG_PATH."select_cover.jpg";
                        $images_query = mysqli_query($mysqli, "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]' AND `thumbnail` != '1'");

                        if(mysqli_num_rows($images_query) > 0) {
                            while($images_result = mysqli_fetch_assoc($images_query)) {
                                echo "<a data-fslightbox='gallery_1' data-type='image' href='".ROOMS_IMG_PATH.$images_result['image']."'></a>";
                            }
                            
                        } else {
                            echo "<a data-fslightbox='gallery_1' data-type='image' href='$room_img;'></a>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <!-- /bg_white -->
    </main>

    <?php include "includes/footer.php" ?>
    <!-- /footer -->
   
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
        </svg>
    </div>
    <!-- /back to top -->

    <!-- Modal Login Form -->
    <div id="loginModal" class="modal-overlay">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <h2>Login</h2>
            <form>
                <input type="email" name="email" placeholder="Enter your email" required>
                <input type="password" name="password" placeholder="Enter your password" required>

                <div class="password_zone">
                    <button type="submit" class="btn_1 mt-2 mb-4">Login</button>
                    <a href="javascript:void(0)">Forgot Password?</a>
                </div>

                <div class="sign-up">
                    <p>If you don't have an account...<a href="register.php">Click here</a> to register</p>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Login Form -->


<!-- COMMON SCRIPTS -->
<script src="js/common_scripts.js"></script>
<script src="js/common_functions.js"></script>
<script src="js/datepicker_inline.js"></script>
<script src="phpmailer/validate.js"></script>
<script src="js/modal_popup.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    // Progress bars animation
    $(function() {
        "use strict";
        var $section = $('#reviews');
        $(window).on('scroll', function(ev) {
            var scrollOffset = $(window).scrollTop();
            var containerOffset = $section.offset().top - window.innerHeight;
            if (scrollOffset > containerOffset) {
                $(".progress-bar").each(function() {
                    var each_bar_width = $(this).attr('aria-valuenow');
                    $(this).width(each_bar_width + '%');
                });
            }
        });
    });

    let booking_form = document.getElementById('booking-form');
    let bookingSubmitBtn = document.getElementById('bookingSubmitBtn');
    let bookingSpinner = document.getElementById('bookingSpinner');
    let bookingBtnText = bookingSubmitBtn.querySelector(".btn-text");
    let message_contact = document.getElementById('message-contact');

    function check_availability(){
        let checkin_val = booking_form.elements['checkin'].value;
        let checkout_val = booking_form.elements['checkout'].value;

        // booking_form.elements['pay_now'].setAttribute('disabled', true);

        if(checkin_val!='' && checkout_val!='') {
            
            let data = new FormData();

            data.append('check_availability', '');
            data.append('check_in', checkin_val);
            data.append('check_out', checkout_val);

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/confirm_booking.php", true);

            xhr.onload = function() {
                let data = JSON.parse(this.responseText);

                if (data.status == 'check_in_out_equal') {
                    bookingSubmitBtn.classList.add('d-none');
                    message_contact.innerText = "You cannot check-out on the same day!";
                } else if (data.status == 'check_out_earlier') {
                    bookingSubmitBtn.classList.add('d-none');
                    message_contact.innerText = "Check-out date is earlier than check-in date!";
                } else if (data.status == 'check_in_earlier') {
                    bookingSubmitBtn.classList.add('d-none');
                    message_contact.innerText = "Check-in date is earlier than today's date!";
                } else if (data.status == 'unavailable') {
                    bookingSubmitBtn.classList.add('d-none');
                    message_contact.innerText = "Room not available for this check-in date";
                } else {
                    message_contact.innerHTML = "Number of Days: "+data.days+"<br>Total Amount to Pay: &#8358;"+data.payment;
                    message_contact.classList.replace('text-danger','text-dark');
                    document.getElementById("total_amount").value = data.payment;
                    bookingSubmitBtn.classList.remove('d-none');
                }
                message_contact.classList
            }

            xhr.send(data);
        }
    }

    function pay_now() {

        // Collect values

        let amount = booking_form.elements['total_amount'].value * 100;

        // Get form values
        let user_name = booking_form.elements['name'].value;
        let email = booking_form.elements['email'].value;
        let address = booking_form.elements['address'].value;
        let check_in = booking_form.elements['checkin'].value;
        let check_out = booking_form.elements['checkout'].value;

        // Your custom data
        let meta = {
            user_name: user_name,
            address: address,
            room_id: <?php echo $room_data['id']; ?>,
            room_name: "<?php echo $room_data['name']; ?>",
            check_in: check_in,
            check_out: check_out
        };



        // console.log(meta);
        // return;

        //Proceed with Paystack
        let handler = PaystackPop.setup({
            key: 'pk_test_6715b9866aca6f2ebe592b5f32424035e4d7f064',
            email: email,
            amount: amount,
            metadata: {
                custom_fields: [ meta ]
            },
            callback: function(response) {
                window.location = "pay_now.php?reference=" + response.reference 
                + "&check_in=" + encodeURIComponent(check_in) 
                + "&check_out=" + encodeURIComponent(check_out)
                + "&user_name=" + encodeURIComponent(user_name)
                + "&address=" + encodeURIComponent(address);
            }
        });

        handler.openIframe();
        
        // Disable + show spinner
        bookingSubmitBtn.disabled = true;
        bookingSpinner.style.display = "inline-block";
        bookingBtnText.textContent = "Please wait...";
    }

</script>

</body>
</html>