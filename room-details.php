<?php
require_once('admin/includes/db.php');
require_once('admin/includes/functions.php');

if(isset($_GET['id'])) {
    $room_id = filteration($_GET)['id'];

    // Fetch the room details
    $result = select("SELECT * FROM `rooms` WHERE `id` = ?", [$room_id], 'i');
    $room_data = mysqli_fetch_assoc($result);

    if(!$room_data){
        // Redirect or show 404 if invalid room ID
        header("Location: rooms.php");
        exit;
    }

    // Set dynamic title
    $page_title = $room_data['name'] . " - Eleko Ocean Front Resort";
} else {
    header("Location: rooms.php");
    exit;
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

    <!-- redirect back to rooms list page if ID is not called -->
    <?php 
        if(!isset($_GET['id'])) {
            redirect('rooms.php');
        }

        $data = filteration($_GET);
        $room_result = select("SELECT * FROM `rooms` WHERE `id` = ? AND `status` = ? AND `removed` = ?", [$data['id'], 1,0], 'iii');

        if(mysqli_num_rows($room_result) == 0) {
            redirect('rooms.php');
        }
        $room_data = mysqli_fetch_assoc($room_result);

        # get cover image
        $room_thumb = ROOMS_IMG_PATH."select_cover.jpg";
        $thumb_query = mysqli_query($mysqli, "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]' AND `thumbnail` = '1'");

        if(mysqli_num_rows($thumb_query) > 0) {
            $thumb_result = mysqli_fetch_assoc($thumb_query);
            $room_thumb = ROOMS_IMG_PATH.$thumb_result['image'];
        }

        $login = 0;
        if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
            $login = 1;
        }
    ?>
    <!-- redirect back to rooms list page if ID is not called -->
 
    <main>

        <div class="hero full-height jarallax" data-jarallax data-speed="0.2">
            <img class="jarallax-img kenburns" src="<?php echo $room_thumb; ?>" alt="">
            <div class="wrapper opacity-mask d-flex align-items-center  text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <small class="slide-animated one">Luxury Staycation Experience</small>
                            <h1 class="slide-animated two"><?php echo $room_data['name']; ?></h1>
                            <!-- <p class="slide-animated three">Exquisite furnishings for a cosy ambience</p> -->
                        </div>
                    </div>
                </div>
                <div class="mouse_wp slide-animated four">
                    <a href="#first_section" class="btn_explore">
                        <div class="mouse"></div>
                    </a>
                </div>
                <!-- / mouse -->
            </div>
        </div>
        <!-- /Background Img Parallax -->

        <div class="bg_white" id="first_section">
            <div class="container margin_120_95">
                <div class="row justify-content-between">
                    <div class="col-lg-4">
                        <div class="title">
                            <small>Luxury Staycation Experience</small>
                            <h2><?php echo $room_data['desc_title']; ?></h2>
                        </div>
                        <p><?php echo nl2br(stripslashes($room_data['descrip'])); ?></p>
                        <a href="confirm_booking.php?id=<?php echo $room_data['id']; ?>" class="btn_1 outline">Book Now</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="room_facilities_list">
                            <ul data-cues="slideInLeft">
                                <!-- <li><i class="icon-hotel-double_bed_2"></i> King Size Bed</li> -->
                                <li><i class="icon-hotel-patio"></i>Oceanfront Lounge</li>
                                <li><i class="icon-hotel-tv"></i> Smart TV</li>
                                <li><i class="icon-hotel-wifi"></i> 24/7 Unlimited Wifi</li>
                                <li><i class="icon-hotel-loundry"></i>Towels</li>
                                <li><i class="icon-hotel-bottle"></i> Complementary Breakfast</li>
                                <li><i class="icon-hotel-condition"></i> Air Condition</li>
                                <li><i class="bi bi-lightning-charge"></i> 24/7 Power Supply</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_white -->

        <div class="bg_white add_bottom_120">
            <div class="container-fluid p-lg-0">
                <div data-cues="zoomIn">
                    <div class="owl-carousel owl-theme carousel_item_centered kenburns rounded-img">
                        <div class="item">
                            <img src="<?php echo $room_thumb; ?>" alt="">
                        </div>
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


        <!-- <div class="container margin_120_95">
            <div data-cue="slideInUp">
                <div class="title">
                    <small>Paradise Hotel</small>
                    <h2>Similar Rooms</h2>
                </div>
                <div class="row" data-cues="slideInUp" data-delay="800">
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <a href="room-list-1.html" class="box_cat_rooms">
                            <figure>
                                <div class="background-image" data-background="url(img/rooms/1.jpg)"></div>
                                <div class="info">
                                    <small>From $150/night</small>
                                    <h3>Double Room</h3>
                                    <span>Read more</span>
                                </div>
                            </figure>
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <a href="room-list-1.html" class="box_cat_rooms">
                            <figure>
                                <div class="background-image" data-background="url(img/rooms/2.jpg)"></div>
                                <div class="info">
                                    <small>From $190/night</small>
                                    <h3>Deluxe Room</h3>
                                    <span>Read more</span>
                                </div>
                            </figure>
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <a href="room-list-1.html" class="box_cat_rooms">
                            <figure>
                                <div class="background-image" data-background="url(img/rooms/3.jpg)"></div>
                                <div class="info">
                                    <small>From $240/night</small>
                                    <h3>Superior Room</h3>
                                    <span>Read more</span>
                                </div>
                            </figure>
                        </a>
                    </div>
                </div>
                
            </div>
        </div> -->
        

        <div class="container margin_120_95" id="booking_section">
            <div class="row justify-content-between">
                <div class="col-xl-4">
                    <div data-cue="slideInUp">
                        <div class="title">
                            <small>Eleko Ocean Front Resort</small>
                            <h2>Check Availability</h2>
                        </div>
                        <p>Quickly find available dates for your stay and secure your reservation with ease.</p>
                        <p class="phone_element no_borders"><a href="tel://+2348149986209"><i class="bi bi-telephone"></i><span><em>Info and bookings</em>+234 814 998 6209</span></a></p>
                    </div>
                </div>
                <div class="col-xl-7">
                     <?php
                        $rooms_sql = "SELECT `id`, `name` FROM rooms ORDER BY id ASC";
                        $rooms_res = mysqli_query($mysqli, $rooms_sql);
                    ?>
                    <div data-cue="slideInUp" data-delay="200">
                        <div class="booking_wrapper">
                            <div class="col-12">
                                <input type="hidden" id="date_booking" name="date_booking">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="custom_select">
                                        <select class="wide" id="room_id">
                                            <?php while($room = mysqli_fetch_assoc($rooms_res)): ?>
                                                <option value="<?= $room['name'] ?>">
                                                    <?= $room['name'] ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="qty-buttons mb-3 version_2">
                                                <input type="button" value="+" class="qtyplus" name="adults_booking">
                                                <input type="text" name="adults_booking" id="adults_booking" value="" class="qty form-control" placeholder="Adults">
                                                <input type="button" value="-" class="qtyminus" name="adults_booking">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3 qty-buttons mb-3 version_2">
                                                <input type="button" value="+" class="qtyplus" name="childs_booking">
                                                <input type="text" name="childs_booking" id="childs_booking" value="" class="qty form-control" placeholder="Childs">
                                                <input type="button" value="-" class="qtyminus" name="childs_booking">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / row -->
                        <div id="availability_result" class="mt-2"></div>

                        <!-- / Button -->
                        <p class="text-end mt-4"><a href="#0" class="btn_1 outline" id="checkBtn">Check Availability</a></p>
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
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
</script>

<script>
    document.getElementById("checkBtn").addEventListener("click", function (e) {
        e.preventDefault();

        let room_id = document.getElementById("room_id").value;
        let dateRange = document.getElementById("date_booking").value;

        if (room_id === "") {
            alert("Please select a room.");
            return;
        }

        if (dateRange === "") {
            alert("Please select your check-in and check-out dates.");
            return;
        }

        // dateBooking format = "12/03/2025 - 15/03/2025"
        let dates = dateRange.split(" - ");

        let check_in = dates[0];
        let check_out = dates[1];

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/check_availability.php", true);

        xhr.onload = function () {
            document.getElementById("availability_result").innerHTML = this.responseText;
        };

        let form = new FormData();
        form.append("check_availability", "1");
        form.append("room_id", room_id);
        form.append("check_in", check_in);
        form.append("check_out", check_out);

        xhr.send(form);
    });

</script>

</body>
</html>