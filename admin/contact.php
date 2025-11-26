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
    <title>Contact Info - Eleko Ocean Front Resort</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
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
                    <h1>Contact</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i>
                        <li>
                            <a class="active" href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="actions">
                    <a href="?seen=all" class="btn-download">
                        <i class='bx bx-message-check'></i> 
                        <span class="text">Mark all read</span>
                    </a>
                    <a href="?del=all" class="btn-download pending">
                        <i class='bx bx-trash'></i> 
                        <span class="text">Delete all</span>
                    </a>
                </div>

            </div>

            <div class="table-data" style="max-height: 68vh;">
                <div class="order">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Phone</th>
                                <th width="20%">Subject</th>
                                <th width="30%">Message</th>
                                <th>Date</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_GET['seen'])) {
                                    $frm_data = filteration($_GET);
                                    if($frm_data['seen'] == 'all'){
                                        $query = "UPDATE `contact` SET `seen` = ?";
                                        $values = [1];
                                        if(update($query, $values, 'i')){
                                            alert('success', 'Marked all as read');
                                        } else {
                                            alert('error', 'Operation Failed');
                                        }
                                    } else {
                                        $query = "UPDATE `contact` SET `seen` = ? WHERE `id` = ? ";
                                        $values = [1, $frm_data['seen']];
                                        if(update($query, $values, 'ii')){
                                            alert('success', 'Marked as read');
                                        } else {
                                            alert('error', 'Operation Failed');
                                        }
                                    }
                                }

                                if(isset($_GET['del'])) {
                                    $frm_data = filteration($_GET);
                                    if($frm_data['del'] == 'all'){
                                        $query = "DELETE FROM `contact`";
                                        mysqli_query($mysqli, $query);

                                        // Check how many rows were actually deleted
                                        $affected = mysqli_affected_rows($mysqli);

                                        if($affected > 0){
                                            alert('success', "{$affected} message(s) deleted!");
                                        } else if($affected == 0) {
                                            alert('error', 'No messages!.');
                                        } else {
                                            alert('error', 'Operation Failed!');
                                        }
                                    } else {
                                        $query = "DELETE FROM `contact` WHERE `id` = ? ";
                                        $values = [$frm_data['del']];
                                        if(delete($query, $values, 'i')){
                                            alert('success', 'Message Deleted!');
                                        } else {
                                            alert('error', 'Operation Failed!');
                                        }
                                    }
                                }
                            ?>
                            <?php
                                $query = "SELECT * FROM contact ORDER BY id DESC";
                                $data = mysqli_query($mysqli, $query);
                                $i = 1;

                                while($row = mysqli_fetch_assoc($data)) {
                                    $seen = "";
                                    if($row['seen']!=1){
                                        $seen = "<a href='?seen={$row['id']}' class='status completed'>Mark as read</a>";
                                    }
                                    echo<<<query
                                        <tr>
                                            <td>{$row['name']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['phone']}</td>
                                            <td>{$row['subject']}</td>
                                            <td>{$row['message']}</td>
                                            <td>{$row['date']}</td>
                                            <td>
                                                <a href="?del={$row['id']}" class="status pending">Delete</a>
                                            </td>
                                            <td>{$seen}</td>
                                        </tr>
                                    query;
                                    $i++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <!--MAIN -->
    </section>
    <!--CONTENT -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>