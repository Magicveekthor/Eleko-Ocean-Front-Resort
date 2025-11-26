<?php
session_start();
require('../admin/includes/db.php');
require('../admin/includes/functions.php');

date_default_timezone_set("Africa/Lagos");

if(isset($_POST['check_availability'])) {
    $frm_data = filteration($_POST);
    $status = "";
    $result = "";

    // check in and out validations
    $today_date = new DateTime(date("d-m-Y"));
    $checkin_date = new DateTime(($frm_data['check_in']));
    $checkout_date = new DateTime(($frm_data['check_out']));

    if($checkin_date == $checkout_date) {
        $status = 'check_in_out_equal';
        $result = json_encode(["status" => $status]);
    } else if($checkout_date < $checkin_date) {
        $status = 'check_out_earlier';
        $result = json_encode(["status" => $status]);
    } else if($checkin_date < $today_date) {
        $status = 'check_in_earlier';
        $result = json_encode(["status" => $status]);
    }

    // check booking availability if status is blank else retun the error
    if($status != ''){
        echo $result;
    } else {
        // GET ROOM QUANTITY (match AJAX logic)
        $rq_sql = "SELECT quantity FROM rooms WHERE id = ?";
        $rq_res = select($rq_sql, [$_SESSION['room']['id']], "i");
        $rq_row = mysqli_fetch_assoc($rq_res);
        $room_quantity = $rq_row['quantity'];

        // CHECK OVERLAPPING BOOKINGS
        $tb_query = "SELECT COUNT(*) AS total_booking FROM booking_order WHERE booking_status = ? AND room_name = ? AND NOT (check_out <= ? OR check_in >= ?)";

        $values = ['booked', $_SESSION['room']['name'], $frm_data['check_in'], $frm_data['check_out']];

        $tb_fetch = mysqli_fetch_assoc(select($tb_query, $values, "ssss"));
        $total_booked = $tb_fetch['total_booking'];

        // COMPARE WITH QUANTITY (correct logic)
        if($total_booked >= $room_quantity){
            echo json_encode(["status" => "unavailable"]);
            exit;
        }

        // CALCULATE PAYMENT
        $count_days = date_diff($checkin_date, $checkout_date)->days;
        $payment = $_SESSION['room']['price'] * $count_days;

        $_SESSION['room']['payment'] = $payment;
        $_SESSION['room']['available'] = true;

        echo json_encode(["status" => "available", "days" => $count_days, "payment" => $payment]);

    }
}
?>