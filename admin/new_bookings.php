<?php
#connectionn file
require("includes/db.php");
require("includes/functions.php");

# if login is not true, redirect back to login page
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Bookings - Eleko Ocean Front Resort</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Css style -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/addproject.css" rel="stylesheet">
    <link href="../img/logo/favicon.png" rel="icon">
</head>
<body>
    
    <!--SIDEBAR -->
    <?php include "includes/nav-link.php" ?>
    <!--SIDEBAR -->


    <!--CONTENT -->
    <section id="content">
        <!--NAVBAR -->
        <nav>
            <i class="bx bx-menu menus"></i>
            <form action="#">
                <div class="form-input">
                    <input type="text" onkeyup="get_bookings(this.value)" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="img/8.jpg" alt="">
            </a>
        </nav>
        <!--NAVBAR -->

        <!--MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>New Bookings</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i>
                        <li>
                            <a class="active" href="">New Bookings</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-data">
                <div class="order" style="width: 100%; max-height: 68vh; overflow-x: auto; overflow-y: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>User Details</th>
                                <th>Room Details</th>
                                <th>Booking Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body"></tbody>
                    </table>
                </div>
            </div>
        </main>
        <!--MAIN -->
    </section>
    <!--CONTENT -->






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/new_booking.js"></script>
</body>
</html>