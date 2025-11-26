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
    <title>Rooms - Eleko Ocean Front Resort</title>
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
                    <h1>Rooms</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i>
                        <li>
                            <a class="active" href="team.php">Rooms</a>
                        </li>
                    </ul>
                </div>
                <a href="#" class="btn-download" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Add Room</span>
                </a>
            </div>

            <div class="table-data" style="max-height: 68vh;">
                <div class="order">
                    <table>
                        <thead>
                            <th>Name</th>
                            <th>Area</th>
                            <th>Guests</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="room-data"></tbody>
                    </table>
                </div>
            </div>
        </main>
        <!--MAIN -->
    </section>
    <!--CONTENT -->

    <!-- Add Room Modal -->
    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
      
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoomModalLabel">Add Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body (your form goes here) -->
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="add_room_form" autocomplete="off">
                        <div class="project-details row g-3">
                            <div class="input-box col-lg-6">
                                <span class="details">Name</span>
                                <input type="text" name="name" required>
                            </div>

                            <div class="input-box col-lg-6">
                                <span class="details">Area</span>
                                <input type="number" name="area" min="1" required>
                            </div>

                            <div class="input-box col-lg-6">
                                <span class="details">Price</span>
                                <input type="number" name="price" min="1" required>
                            </div>

                            <div class="input-box col-lg-6">
                                <span class="details">Quantity</span>
                                <input type="number" name="quantity" min="1" required>
                            </div>

                            <div class="input-box col-lg-6">
                                <span class="details">Adult (Max.)</span>
                                <input type="number" name="adult" min="1" required>
                            </div>

                            <div class="input-box col-lg-6">
                                <span class="details">Children (Max.)</span>
                                <input type="number" name="children" min="1" required>
                            </div>

                            <div class="input-box col-lg-12">
                                <span class="details">Description Title</span>
                                <input type="text" name="desc_title" required>
                            </div>

                            <div class="input-box col-lg-12">
                                <span class="details">Description</span>
                                <textarea name="descrip" required></textarea>
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
    <!-- Add Room Modal -->

    <!-- Edit Room Modal -->
    <div class="modal fade" id="edit-room" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
      
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoomModalLabel">Edit Room Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body (your form goes here) -->
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="edit_room_form" autocomplete="off">
                        <div class="project-details row g-3">
                            <div class="input-box col-lg-6">
                                <span class="details">Name</span>
                                <input type="text" name="name" required>
                            </div>

                            <div class="input-box col-lg-6">
                                <span class="details">Area</span>
                                <input type="number" name="area" min="1" required>
                            </div>

                            <div class="input-box col-lg-6">
                                <span class="details">Price</span>
                                <input type="number" name="price" min="1" required>
                            </div>

                            <div class="input-box col-lg-6">
                                <span class="details">Quantity</span>
                                <input type="number" name="quantity" min="1" required>
                            </div>

                            <div class="input-box col-lg-6">
                                <span class="details">Adult (Max.)</span>
                                <input type="number" name="adult" min="1" required>
                            </div>

                            <div class="input-box col-lg-6">
                                <span class="details">Children (Max.)</span>
                                <input type="number" name="children" min="1" required>
                            </div>

                            <div class="input-box col-lg-12">
                                <span class="details">Description Title</span>
                                <input type="text" name="desc_title" required>
                            </div>

                            <div class="input-box col-lg-12">
                                <span class="details">Description</span>
                                <textarea name="descrip" required></textarea>
                            </div>

                            <input type="hidden" name="room_id">
                        </div>
          
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Edit Room Modal -->

    <!-- Room Images Modal -->
    <div class="modal fade" id="room-images" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
      
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Room Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body (your form goes here) -->
                <div class="modal-body">
                    <div id="image-alert"></div>
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form method="POST" enctype="multipart/form-data" id="add_image_form">
                            <div class="project-details row g-3">
                                <div class="input-box col-md-12">
                                    <span class="details">Add Image</span>
                                    <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" id="team_picture_inp" required>
                                    <input type="hidden" name="room_id">
                                </div>
                            </div>
            
                            <div class="footer">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-data" style="height: 350px; overflow-y: scroll; scroll-behavior: smooth;">
                        <div class="order">
                            <table>
                                <thead>
                                    <th width="60%">Image</th>
                                    <th>Cover Image</th>
                                    <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="room-image-data"></tbody>
                            </table>
                        </div>
                    </div>                    
                </div>

            </div>
        </div>
    </div>
    <!-- Room Images Modal -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        let add_room_form = document.getElementById('add_room_form');
        let edit_room_form = document.getElementById('edit_room_form');
        let add_image_form = document.getElementById('add_image_form');

        add_room_form.addEventListener('submit',function(e){
            e.preventDefault();
            add_room();
        });

        edit_room_form.addEventListener('submit',function(e){
            e.preventDefault();
            edit_room();
        });

        add_image_form.addEventListener('submit',function(e){
            e.preventDefault();
            add_image();
        });

        function add_room() {
            let data = new FormData();
            data.append('add_room','');
            data.append('name',add_room_form.elements['name'].value);
            data.append('area',add_room_form.elements['area'].value);
            data.append('price',add_room_form.elements['price'].value);
            data.append('quantity',add_room_form.elements['quantity'].value);
            data.append('adult',add_room_form.elements['adult'].value);
            data.append('children',add_room_form.elements['children'].value);
            data.append('desc_title',add_room_form.elements['desc_title'].value);
            data.append('descrip',add_room_form.elements['descrip'].value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);

            xhr.onload = function(){
                var myModal = document.getElementById('addRoomModal');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText.trim() === "1") {
                    alert('success', 'New room added!');
                    add_room_form.reset();
                    get_all_rooms();
                } else {
                    alert('error', 'Server Down!')
                }
            }
            xhr.send(data);
        }


        function get_all_rooms(){
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                document.getElementById('room-data').innerHTML = this.responseText;
            }
            xhr.send('get_all_rooms');
        }

        function edit_details(id){
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                let data = JSON.parse(this.responseText);
                edit_room_form.elements['name'].value = data.roomdata.name;
                edit_room_form.elements['area'].value = data.roomdata.area;
                edit_room_form.elements['price'].value = data.roomdata.price;
                edit_room_form.elements['quantity'].value = data.roomdata.quantity;
                edit_room_form.elements['adult'].value = data.roomdata.adult;
                edit_room_form.elements['children'].value = data.roomdata.children;
                edit_room_form.elements['desc_title'].value = data.roomdata.desc_title;
                edit_room_form.elements['descrip'].value = data.roomdata.descrip;
                edit_room_form.elements['room_id'].value = data.roomdata.id;
            }
            xhr.send('get_room='+id);
        }

        function edit_room() {
            let data = new FormData();
            data.append('edit_room','');
            data.append('room_id',edit_room_form.elements['room_id'].value);
            data.append('name',edit_room_form.elements['name'].value);
            data.append('area',edit_room_form.elements['area'].value);
            data.append('price',edit_room_form.elements['price'].value);
            data.append('quantity',edit_room_form.elements['quantity'].value);
            data.append('adult',edit_room_form.elements['adult'].value);
            data.append('children',edit_room_form.elements['children'].value);
            data.append('desc_title',edit_room_form.elements['desc_title'].value);
            data.append('descrip',edit_room_form.elements['descrip'].value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);

            xhr.onload = function(){
                var myModal = document.getElementById('edit-room');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText.trim() === "1") {
                    alert('success', 'Room Info Updated!');
                    edit_room_form.reset();
                    get_all_rooms();
                } else {
                    alert('error', 'Server Down!')
                }
            }
            xhr.send(data);
        }

        function toggle_status(id, val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                if(this.responseText.trim() === "1") {
                    alert('success', 'Status updated successfully!');
                    get_all_rooms();
                } else {
                    alert('error', 'Server Down!');
                }
            }
            xhr.send('toggle_status='+id+'&value='+val);
        }

        function add_image() {
            let data = new FormData();
            data.append('image',add_image_form.elements['image'].files[0]);
            data.append('room_id',add_image_form.elements['room_id'].value);
            data.append('add_image','');

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);

            xhr.onload = function(){
                if(this.responseText == 'inv_img') {
                    alert('error', 'Only JPG, WEBP or PNG images are allowed!', 'image-alert');
                } else if(this.responseText == 'inv_size') {
                    alert('error', 'Image should be less than 2MB', 'image-alert');
                } else if (this.responseText == 'Upload Failed') {
                    alert('error', 'Image upload failed. Server Down!','image-alert');
                } else {
                    alert('success','New image added!','image-alert');
                    room_images(add_image_form.elements['room_id'].value, document.querySelector("#room-images .modal-title").innerText);
                    add_image_form.reset();
                }
            }
            xhr.send(data);
        }

        function room_images(id, rname) {
            document.querySelector("#room-images .modal-title").innerText = rname;
            add_image_form.elements['room_id'].value = id;
            add_image_form.elements['image'].value = '';

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                document.getElementById('room-image-data').innerHTML = this.responseText;
            }
            xhr.send('get_room_images='+id);
        }

        function remove_image(img_id, room_id) {
            let data = new FormData();
            data.append('image_id', img_id);
            data.append('room_id', room_id);
            data.append('remove_image','');

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);

            xhr.onload = function(){
                if(this.responseText.trim() === "1") {
                    alert('success', 'Image removed!', 'image-alert');
                    room_images(room_id, document.querySelector("#room-images .modal-title").innerText);
                } else {
                    alert('error','Image removal failed. Server Down!','image-alert');
                }
            }
            xhr.send(data);
        }

        //thumbnail - you might remove later
        function thumb_image(img_id, room_id) {
            let data = new FormData();
            data.append('image_id', img_id);
            data.append('room_id', room_id);
            data.append('thumb_image','');

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);

            xhr.onload = function(){
                if(this.responseText.trim() === "1") {
                    alert('success', 'Image Thumbnail Changed!', 'image-alert');
                    room_images(room_id, document.querySelector("#room-images .modal-title").innerText);
                } else {
                    alert('error','Thumbnail update failed. Server Down!','image-alert');
                }
            }
            xhr.send(data);
        }
        //thumbnail - you might remove later

        function remove_room(room_id) {
            if(confirm("Are you sure, you want to delete this room")) {
                let data = new FormData();
                data.append('room_id', room_id);
                data.append('remove_room','');

                let xhr = new XMLHttpRequest();
                xhr.open("POST","ajax/rooms.php",true);

                xhr.onload = function(){
                    if(this.responseText.trim() === "1") {
                        alert('success', 'Room deleted!');
                        get_all_rooms();
                    } else {
                        alert('error','Operation failed. Server Down!');
                    }
                }
                xhr.send(data);
            }
        }

        window.onload = function(){
            get_all_rooms();
        }
    </script>
</body>
</html>