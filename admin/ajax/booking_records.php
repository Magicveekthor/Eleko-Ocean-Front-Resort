<?php
# connecting files
require("../includes/db.php");
require("../includes/functions.php");
adminLogin();

if(isset($_POST['get_bookings'])) {
    $frm_data = filteration($_POST);

    // set limit pagination
    $limit  = 10;
    $page = $frm_data['page'];
    $start  = ($page - 1) * $limit;

    // page 1: 1-1
    
    $query = "SELECT * FROM `booking_order` WHERE ((booking_status = 'booked' AND arrival = 1) OR (booking_status = 'cancelled' AND refund = 1) OR (booking_status = 'failed')) AND (trans_id LIKE ? OR email LIKE ? OR user_name LIKE ?) ORDER BY booking_id DESC";

    $res = select($query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%"], 'sss');

    $limit_query = $query ." LIMIT $start, $limit";
    $limit_res = select($limit_query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%"], 'sss');


    $i = $start + 1;
    $table_data = "";

    $total_rows = mysqli_num_rows($res);
    if($total_rows == 0){
        $output = json_encode(["table-body" => "<tr><td><b>No Data Found!</b></td></tr>", "pagination"=>'']);
        echo $output;
        exit;
    }

    while($data = mysqli_fetch_assoc($limit_res)) {
        $date  = date("d - M - Y | h:i A", strtotime($data['datentime']));
        $check_in = date("d - M - Y", strtotime($data['check_in']));
        $check_out = date("d - M - Y", strtotime($data['check_out']));
        $price = number_format($data['price']);

        if($data['booking_status'] == 'booked'){
            $status_bg = 'bg-success';
            $status_text = 'Booked';
            $total_pay = number_format($data['trans_amt']);
        } else if($data['booking_status'] == 'cancelled'){
            $status_bg = 'bg-danger';
            $status_text = 'Cancelled';
            $total_pay = number_format($data['trans_amt'] * 0.9);
        } else {
            $status_bg = 'bg-warning text-white';
        }

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
                    <span class='badge $status_bg'>$status_text</span>
                </td>
            </tr>
        ";

        $i++;
    }

    $pagination = "";
    if($total_rows > $limit) {
        $total_pages = ceil($total_rows / $limit);

        if($page != 1) {
            $pagination .= "<li class='page-item'><button onclick='change_page(1)' class='page-link shadow-none'>First</button></li>";
        }

        $disabled = ($page == 1) ? "disabled" : "";
        $prev = $page - 1;
        $pagination .="<li class='page-item $disabled'><button onclick='change_page($prev)' class='page-link shadow-none'>Prev</button></li>";

        $disabled = ($page == $total_pages) ? "disabled" : "";
        $next = $page + 1;
        $pagination .="<li class='page-item $disabled'><button onclick='change_page($next)' class='page-link shadow-none'>Next</button></li>";

        if($page != $total_pages) {
            $pagination .= "<li class='page-item $disabled'><button onclick='change_page($total_pages)' class='page-link shadow-none'>Last</button></li>";
        }
    }

    $output = json_encode(["table_body" => $table_data, "pagination" => $pagination]);
    echo $output;
}


if(isset($_POST['cancel_booking'])) {
    $frm_data = filteration($_POST);

    $query = "UPDATE `booking_order` SET `booking_status` = ?, `refund` = ? WHERE booking_id = ?";
    $values = ['cancelled', 0, $frm_data['booking_id']];
    $res = update($query, $values, 'sii');

    echo $res;
}

?>