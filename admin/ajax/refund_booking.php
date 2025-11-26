<?php
# connecting files
require("../includes/db.php");
require("../includes/functions.php");
adminLogin();

if(isset($_POST['get_bookings'])) {
    $frm_data = filteration($_POST);
    
    $query = "SELECT * FROM `booking_order` WHERE (trans_id LIKE ? OR email LIKE ? OR user_name LIKE ?) AND (booking_status = ? AND refund = ?) ORDER BY booking_id ASC";

    $res = select($query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%","cancelled", 0], 'sssss');
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
        $total_pay = number_format($data['trans_amt'] * 0.9);

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
                    <b>Check In: </b> $check_in 
                    <br>
                    <b>Check Out: </b> $check_out
                    <br>
                    <b>Date of Payment: </b> $date
                </td>
                <td>
                    <b>₦$total_pay</b>
                </td>
                <td>
                    <button href='#' onclick='refund_booking($data[booking_id])' class='btn btn-success my-2' data-bs-toggle='modal' data-bs-target='#cancel-room'>
                        <i class='bi bi-cash-stack'></i> Refund
                    </button>
                </td>
            </tr>
        ";

        $i++;
    }

    echo $table_data;
}


if(isset($_POST['refund_booking'])) {
    $frm_data = filteration($_POST);

    $query = "UPDATE `booking_order` SET `refund` = ? WHERE booking_id = ?";
    $values = [1, $frm_data['booking_id']];
    $res = update($query, $values, 'ii');

    echo $res;
}

?>