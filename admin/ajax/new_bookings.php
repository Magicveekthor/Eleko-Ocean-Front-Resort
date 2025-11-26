<?php
# connecting files
require("../includes/db.php");
require("../includes/functions.php");
adminLogin();

if(isset($_POST['get_bookings'])) {
    $frm_data = filteration($_POST);
    
    $query = "SELECT * FROM `booking_order` WHERE (trans_id LIKE ? OR email LIKE ? OR user_name LIKE ?) AND (booking_status = ? AND arrival = ?) ORDER BY booking_id ASC";

    $res = select($query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%","booked", 0], 'sssss');
    $i = 1;
    $table_data = "";

    if(mysqli_num_rows($res) == 0){
        echo "<tr><td><b>No Data Found!</b></td></tr>";
        exit;
    }

    while($data = mysqli_fetch_assoc($res)) {
        $date  = date("d - M - Y | h:i A", strtotime($data['datentime']));
        $check_in = date("d - M - Y", strtotime($data['check_in']));
        $check_out = date("d - M - Y", strtotime($data['check_out']));
        $price = number_format($data['price']);
        $total_pay = number_format($data['trans_amt']);

        $table_data .="
            <tr>
                <td>$i</td>
                <td>
                    <span class='badge bg-primary'>Reference ID: $data[trans_id]</span> 
                    <br>
                    <b>Name: </b> $data[user_name]
                    <br>
                    <b>Email Address: </b> $data[email]
                </td>
                <td>
                    <b>Room Name: </b> $data[room_name]
                    <br>
                    <b>Price: </b> ₦$price
                    <br>
                    <b>Amount Paid: </b> ₦$total_pay
                </td>
                <td>
                    <b>Check In: </b> $check_in 
                    <br>
                    <b>Check Out: </b> $check_out
                    <br>
                    <b>Date of Payment: </b> $date
                </td>
                <td>
                    <button href='#' onclick='assign_room($data[booking_id])' class='btn btn-outline-success'>
                        <i class='bi bi-check2-square'></i> Confirm Booking
                    </button>
                    <br>
                    <button href='#' onclick='cancel_booking($data[booking_id])' class='btn btn-outline-danger my-2' data-bs-toggle='modal' data-bs-target='#cancel-room'>
                        <i class='bi bi-trash'></i> Cancel Booking
                    </button>
                </td>
            </tr>
        ";

        $i++;
    }

    echo $table_data;
}


if(isset($_POST['assign_room'])) {
    $frm_data = filteration($_POST);

    $query = "UPDATE `booking_order` SET arrival = ? WHERE booking_id = ?";
    $values = [1, $frm_data['booking_id']];
    $res = update($query, $values, 'ii');

    if ($res) {
        echo 1;
    } else {
        echo 0;
    }
}


if(isset($_POST['cancel_booking'])) {
    $frm_data = filteration($_POST);

    $query = "UPDATE `booking_order` SET `booking_status` = ?, `refund` = ? WHERE booking_id = ?";
    $values = ['cancelled', 0, $frm_data['booking_id']];
    $res = update($query, $values, 'sii');

    echo $res;
}

?>