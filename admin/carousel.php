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
    <title>Carousel - Eleko Ocean Front Resort</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Css style -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/addproject.css" rel="stylesheet">
    <link href="assets/logo/Asset8.png" rel="icon">
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
                    <h1>Carousel</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i>
                        <li>
                            <a class="active" href="carousel.php">Carousel</a>
                        </li>
                    </ul>
                </div>
                <a href="addcarousel.php" class="btn-download" data-bs-toggle="modal" data-bs-target="#addCarouselModal" id="addCarouselBtn">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Add Carousel</span>
                </a>
            </div>

            <div class="table-data" style="max-height: 68vh;">
                <div class="order">
                    <table>
                        <thead>
                            <tr>
                                <th>Carousel Video</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="carousel-body"></tbody>
                    </table>
                </div>
            </div>
        </main>
        <!--MAIN -->
    </section>
    <!--CONTENT -->

    <!-- Add Team Member Modal -->
    <div class="modal fade" id="addCarouselModal" tabindex="-1" aria-labelledby="addCarouselModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
      
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="addCarouselModalLabel">Add Carousel Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body (your form goes here) -->
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="carousel_form">
                        <div class="project-details row g-3">
                            <div class="input-box col-md-12">
                                <span class="details">Carousel Video</span>
                                <input type="file" name="carousel_video" id="carousel_video_inp" required>
                            </div>
                        </div>
          
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Add Team Member Modal -->



    <!-- Edit Carousel Modal -->
    <div class="modal fade" id="editCarouselModal" tabindex="-1" aria-labelledby="editCarouselModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editCarouselModalLabel">Edit Carousel Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="edit_carousel_form">
                        <div class="project-details row g-3">
                            <div class="input-box col-md-12">
                                <span class="details">New Carousel Video</span>
                                <input type="file" name="carousel_video" id="edit_carousel_video_inp" required>
                            </div>
                        </div>
                        <input type="hidden" name="edit_carousel" id="edit_carousel_id">
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Edit Carousel Modal -->




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        let carousel_form = document.getElementById('carousel_form');        
        let carousel_video_inp = document.getElementById('carousel_video_inp');

        // Edit function parameters
        let edit_carousel_form = document.getElementById('edit_carousel_form');
        let edit_carousel_video_inp = document.getElementById('edit_carousel_video_inp');
        let edit_carousel_id = document.getElementById('edit_carousel_id');

        carousel_form.addEventListener('submit', function(e){
            e.preventDefault();
            
            let file = carousel_video_inp.files[0];
            if (!file) {
                alert('error', 'Please select a video!');
                return;
            }

            // validate size before uploading
            if (file.size > 20 * 1024 * 1024) {
                alert('error', 'Video should be less than 20MB');
                return;
            }

            //Validate form
            let allowedTypes = ['video/mp4', 'video/webm', 'video/ogv', 'video/avi', 'video/mov'];
            if (!allowedTypes.includes(file.type)) {
                alert('error', 'Only MP4, WEBM, OGG, AVI, MOV videos are allowed!');
                return;
            }

            // If everything is fine, then run function
            addcarousel();
        });

        function addcarousel(){
            let data = new FormData();
            data.append('carousel_video',carousel_video_inp.files[0]);
            data.append('addcarousel','');

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/carousel.php",true);

            xhr.onload = function(){
                var myModal = document.getElementById('addCarouselModal');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText == 'inv_vid') {
                    alert('error', 'Only MP4, WEBM, OGG, AVI, MOV videos are allowed!');
                } else if(this.responseText == 'inv_size') {
                    alert('error', 'Video should be less than 20MB');
                }  else if (this.responseText == 'max_reached') {
                    alert('error', 'You cannot upload more than one hero video!');
                } else if (this.responseText == 'Upload Failed') {
                    alert('error', 'Video upload failed. Server Down!');
                } else {
                    alert('success','New Carousel added!');
                    carousel_video_inp.value = '';
                    get_carousel();
                }
            }
            xhr.send(data);
        }

        function get_carousel() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/carousel.php",true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById('carousel-body').innerHTML = this.responseText;

                // Check if we have any rows in the table
                if (this.responseText.trim() === "") {
                    // No carousel → show Add button
                    document.getElementById('addCarouselBtn').style.display = "flex";
                } else {
                    // Carousel exists → hide Add button
                    document.getElementById('addCarouselBtn').style.display = "none";
                }
            }

            xhr.send('get_carousel');
        }

        function remove_carousel(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/carousel.php",true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if(this.responseText.trim() === "1") {
                    alert('success', 'Carousel removed!');
                    get_carousel();
                } else {
                    alert('error', 'Server Down!');
                    console.log("DEBUG Response:", this.responseText);
                }
            }

            xhr.send('remove_carousel='+val);
        }

        
        // Handle submit for EDIT
        edit_carousel_form.addEventListener('submit', function(e){
            e.preventDefault();

            let file = edit_carousel_video_inp.files[0];

            if(!file) {
                alert('error', 'Please select a video');
                return;
            }

            if(file.size > 20 * 1024 * 1024) {
                alert('error', 'Video should be less than 20MB!');
                return;
            }

            let allowedTypes = ['video/mp4', 'video/webm', 'video/ogv', 'video/avi', 'video/mov'];
            if (!allowedTypes.includes(file.type)) {
                alert('error', 'Only MP4, WEBM, OGG, AVI, MOV videos are allowed!');
                return;
            }

            let data =  new FormData();
            data.append('carousel_video', edit_carousel_video_inp.files[0]);
            data.append('edit_carousel', edit_carousel_id.value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/carousel.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById('editCarouselModal');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText.trim() === "1") {
                    alert('success', 'Carousel updated!');
                    edit_carousel_video_inp.value = '';
                    get_carousel();
                } else {
                    alert('error', this.responseText);
                }
            }

            xhr.send(data);
        });

        // Function to open the edit modal with the correct ID
        function openEditModal(id){
            edit_carousel_id.value = id; // set hidden input
            let modal = new bootstrap.Modal(document.getElementById('editCarouselModal'));
            modal.show();
        }



        window.onload = function(){
            get_carousel();
        }
    </script>
</body>
</html>