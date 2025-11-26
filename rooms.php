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
    <title>Rooms & Suites - Eleko Ocean Front Resort</title>
    
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

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">
</head>

<body> 

    <?php include "includes/header.php"; ?>

    <main>

        <div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
            <img class="jarallax-img" src="img/home_3.jpg" alt="">
            <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <small class="slide-animated one">Eleko Ocean Front Resort</small>
                    <h1 class="slide-animated two">Rooms & Suites</h1>
                </div>
            </div>
        </div>
        <!-- /Background Img Parallax -->

        <div class="container margin_120_95 pb-0" id="first_section">

            <?php
                $room_query = select("SELECT * FROM `rooms` WHERE `status` = ? and `removed` = ?", [1,0], 'ii');
                while($room_data = mysqli_fetch_assoc($room_query)) {
                    $price = number_format($room_data['price']);

                    # get cover image
                    $room_thumb = ROOMS_IMG_PATH."select_cover.jpg";
                    $thumb_query = mysqli_query($mysqli, "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]' AND `thumbnail` = '1'");

                    if(mysqli_num_rows($thumb_query) > 0) {
                        $thumb_result = mysqli_fetch_assoc($thumb_query);
                        $room_thumb = ROOMS_IMG_PATH.$thumb_result['image'];
                    }

            

                    echo <<<data
                        <div class="row_list_version_1">
                            <div class="pinned-image rounded_container pinned-image--medium">
                                <div class="pinned-image__container">
                                    <img src="$room_thumb" alt="">
                                </div>
                            </div>
                            <!-- /pinned-image -->
                            <div class="row justify-content-start">
                                <div class="col-lg-8">
                                    <div class="box_item_info" data-jarallax-element="-30">
                                        <small>&#8358;$price/night</small>
                                        <h2>$room_data[name]</h2>
                                        <p>Beautiful design with modern furnishings including a glamorous bay window with your own private view of Lucerne.</p>
                                        <!-- <div class="facilities clearfix">
                                            <ul>
                                                <li>
                                                    <i class="customicon-double-bed"></i> King Size Bed
                                                </li>
                                                <li>
                                                    <i class="customicon-wifi"></i> Free Wifi
                                                </li>
                                                <li>
                                                    <i class="customicon-television"></i> 32 Inc TV
                                                </li>
                                            </ul>
                                        </div> -->
                                        <div class="box_item_footer d-flex align-items-center justify-content-between">
                                            <a href="confirm_booking.php?id=$room_data[id]" class="btn_4 learn-more">
                                                <span class="circle">
                                                    <span class="icon arrow"></span>
                                                </span>
                                                <span class="button-text">Book Now</span>
                                            </a>
                                            <a href="room-details.php?id=$room_data[id]" class="animated_link">
                                                <strong>Read more</strong>
                                            </a>
                                        </div>
                                        <!-- /box_item_footer -->
                                    </div>
                                    <!-- /box_item_info -->
                                </div>
                                <!-- /col -->
                            </div>
                            <!-- /row -->
                        </div>
                    data;
                } 
            ?>
        </div>
        <!-- /container -->

        <div class="bg_white">
            <div class="container margin_120_95">
                <div class="title center mb-5">
                    <small data-cue="slideInUp">Eleko Ocean Front Resort</small>
                    <h2 data-cue="slideInUp" data-delay="100">Main Facilities</h2>
                </div>
                <div class="row mt-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="box_facilities no-border" data-cue="slideInUp">
                            <i class="customicon-private-parking"></i>
                            <h3>Private Parking</h3>
                            <p>Enjoy the convenience and security of your own reserved parking space throughout your stay.</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="box_facilities" data-cue="slideInUp">
                            <i class="customicon-wifi"></i>
                            <h3>High-Speed Wi-Fi</h3>
                            <p>Stay connected at all times with fast, reliable internet access throughout the apartment.</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="box_facilities" data-cue="slideInUp">
                            <i class="customicon-cocktail"></i>
                            <h3>Bar & Restaurant</h3>
                            <p>Enjoy a delightful dining experience with a fully stocked bar and restaurant offering a variety of meals and drinks.</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="box_facilities" data-cue="slideInUp">
                            <i class="customicon-swimming-pool"></i>
                            <h3>Swimming Pool</h3>
                            <p>Relax and unwind in our serene swimming pool, perfect for leisure, exercise, or a refreshing dip.</p>
                        </div>
                    </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /container-->
            <div class="marquee">
                <div class="track">
                    <div class="content">&nbsp;Relax Enjoy Luxury Holiday Travel Discover Experience Relax Enjoy Luxury Holiday Travel Discover Experience Relax Enjoy Luxury Holiday Travel Discover Experience Relax Enjoy Luxury Holiday Travel Discover Experience</div>
                </div>
            </div>
            <!-- /marquee-->
        </div>
        <!-- /bg_white -->

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
                        <p class="text-end mt-5"><a href="#0" class="btn_1 outline" id="checkBtn">Check Availability</a></p>
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
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- /back to top -->

<!-- COMMON SCRIPTS -->
<script src="js/common_scripts.js"></script>
<script src="js/common_functions.js"></script>
<script src="js/datepicker_inline.js"></script>
<script src="phpmailer/validate.js"></script>
<script src="js/modal_popup.js"></script>

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