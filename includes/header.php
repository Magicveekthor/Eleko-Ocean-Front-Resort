<?php
    session_start();
    require_once('admin/includes/db.php');
    require_once('admin/includes/functions.php');
?>

<div id="preloader">
   <div data-loader="circle-side"></div>
</div><!-- /Page Preload -->

<div class="layer"></div><!-- Opacity Mask -->



<header class="reveal_header">
   <div class="container">
       <div class="row align-items-center">
            <div class="col-6">
               <a href="index.php" class="logo_normal"><img src="img/logo/eleko_logo_white.png" width="150" alt=""></a>
               <a href="index.php" class="logo_sticky"><img src="img/logo/eleko_logo_black.png" width="150" alt=""></a>
           </div>
           <div class="col-6">
               <nav>
                   <ul>
                        <li><a href="rooms.php" class="btn_1 btn_scrollto">Book Now</a></li>
                        <li>
                            <div class="hamburger_2 open_close_nav_panel">
                                <div class="hamburger__box">
                                    <div class="hamburger__inner"></div>
                                </div>
                            </div>
                        </li>
                   </ul>
               </nav>
           </div>
       </div>
   </div><!-- /container -->
</header><!-- /Header -->



<div class="nav_panel">
   <a href="#0" class="closebt open_close_nav_panel"><i class="bi bi-x"></i></a>
   <div class="logo_panel"><img src="img/logo/eleko_logo_black.png" width="135" height="45" alt=""></div>
   <div class="sidebar-navigation">
       <nav>
           <ul class="level-1">
               <li><a href="index.php">Home</a></li>
               <li><a href="about.php">About</a></li>
               <li><a href="rooms.php">Rooms & Suites</a></li>
               <!-- <li><a href="restaurant.php">Restaurant</a></li> -->
               <li><a href="contacts.php">Contact</a></li>
           </ul>
           <div class="panel_footer">
               <div class="phone_element"><a href="tel://+234 814 998 6209"><i class="bi bi-telephone"></i><span><em>Info and bookings</em>+234 814 998 6209</span></a></div>
           </div>
           <!-- /panel_footer -->
       </nav>
   </div>
   <!-- /sidebar-navigation -->
</div>
<!-- /nav_panel -->