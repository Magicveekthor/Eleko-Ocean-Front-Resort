<?php
include "../admin/includes/db.php";

if(isset($_POST['check_availability'])) {

    $room_name   = $_POST['room_id'];
    $check_in  = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Convert dates to SQL format
    $in  = DateTime::createFromFormat("d/m/Y", $check_in)->format("Y-m-d");
    $out = DateTime::createFromFormat("d/m/Y", $check_out)->format("Y-m-d");

    /* ---------------------------------------------------------
       1. GET ROOM QUANTITY
    --------------------------------------------------------- */
    $qty_sql = "SELECT quantity FROM rooms WHERE `name` = ?";
    $qty_stmt = $mysqli->prepare($qty_sql);
    $qty_stmt->bind_param("s", $room_name);
    $qty_stmt->execute();
    $qty_result = $qty_stmt->get_result();
    $qty_row = $qty_result->fetch_assoc();
    $room_quantity = $qty_row['quantity'];

    /* ---------------------------------------------------------
       2. COUNT HOW MANY BOOKINGS OVERLAP THIS DATE RANGE
          Overlap formula:
          NOT (existing.checkout <= new.checkin OR existing.checkin >= new.checkout)
    --------------------------------------------------------- */
    $book_sql = "
        SELECT COUNT(*) AS total_booked 
        FROM booking_order 
        WHERE room_name = ? 
        AND booking_status = 'booked'
        AND NOT (check_out <= ? OR check_in >= ?)
    ";

    $book_stmt = $mysqli->prepare($book_sql);
    $book_stmt->bind_param("sss", $room_name, $in, $out);
    $book_stmt->execute();
    $book_result = $book_stmt->get_result();
    $book_row = $book_result->fetch_assoc();
    $total_booked = $book_row['total_booked'];

    /* ---------------------------------------------------------
       3. COMPARE WITH QUANTITY
    --------------------------------------------------------- */

    if($total_booked >= $room_quantity){
        echo "<span style='color:red;font-weight:bold;'>❌ Room NOT AVAILABLE for the selected period.</span>";
    } else {
        echo "<span style='color:green;font-weight:bold;'>✔ Room is AVAILABLE for the selected period!</span>";
    }
}
