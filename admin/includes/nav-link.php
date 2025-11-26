<?php
include_once  "includes/db.php";
include_once  "includes/functions.php";

// Booking records count
// $booking_records = "SELECT COUNT(*) AS total FROM `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id WHERE ((bo.booking_status = 'booked' AND bo.arrival = 1) OR (bo.booking_status = 'cancelled' AND bo.refund = 1) OR (bo.booking_status = 'failed')) ORDER BY bo.booking_id DESC";
// $booking_records_res = mysqli_query($mysqli, $booking_records);
// $booking_records_row = mysqli_fetch_assoc($booking_records_res);
// $booking_records_count = $booking_records_row['total'];

// Refund count
$refund_records = "SELECT COUNT(*) AS total FROM `booking_order` WHERE (booking_status = 'cancelled' AND refund = 0)";
$refund_records_res = mysqli_query($mysqli, $refund_records);
$refund_records_row = mysqli_fetch_assoc($refund_records_res);
$refund_records_count = $refund_records_row['total'];

// New bookings
$new_records = "SELECT COUNT(*) AS total FROM `booking_order` WHERE (booking_status = 'booked' AND arrival = 0)";
$new_records_res = mysqli_query($mysqli, $new_records);
$new_records_row = mysqli_fetch_assoc($new_records_res);
$new_records_count = $new_records_row['total'];

// joint booking record
$join_records_count = $new_records_count + $refund_records_count;
?>






<section id="sidebar" class="hide">
    <a href="#" class="brand">
        <!-- <i class="bx bxs-smile"></i> -->
        <span class="text"><img src="../img/logo/eleko_logo_black.png"></span>
    </a>
    <ul class="side-menu top">
        <li>
            <a href="rooms.php">
                <i class='bx bx-buildings'></i>
                <span class="text">Rooms</span>
            </a>
        </li>
        <li>
            <a href="contact.php">
                <i class="bx bx-message"></i>
                <span class="text">Contact</span>
            </a>
        </li>
        <li>
            <a href="carousel.php">
                <i class='bx bxs-slideshow'></i>
                <span class="text">Carousel</span>
            </a>
        </li>
        <li class="drop">
            <a href="#" class="drop-toggle">
                <i class='bx bx-bookmark-alt'></i>
                <span class="text">
                    Bookings
                    <?php if ($join_records_count > 0) { ?>
                        <span class="badge_count"><?php echo $join_records_count; ?></span>
                    <?php } ?>
                </span>
            </a>

            <ul class="drop-menu">
                <li>
                    <a href="new_bookings.php">
                        New Bookings 
                        <?php if ($new_records_count > 0) { ?>
                            <span class="badge_count"><?php echo $new_records_count; ?></span>
                        <?php } ?>
                    </a>
                </li>

                <li>
                    <a href="refund_bookings.php">
                        Refund Bookings
                        <?php if ($refund_records_count > 0) { ?>
                            <span class="badge_count"><?php echo $refund_records_count; ?></span>
                        <?php } ?>
                    </a>
                </li>

                <li>
                    <a href="booking_records.php">
                        Booking Records</span>
                    </a>
                </li>

            </ul>
        </li>
    </ul>
    <ul class="side-menu bottom">
        <li>
            <a href="logout.php" class="logout">
                <i class="bx bxs-log-out-circle"></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>