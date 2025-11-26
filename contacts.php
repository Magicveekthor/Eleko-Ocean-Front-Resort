<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Eleko Ocean Front Resort offers luxury beachfront apartments and premium short-stay accommodation in Lagos. Enjoy ocean views, a serene swimming pool, African-inspired architecture, and exceptional hospitality—perfect for vacations, getaways, and relaxation by the beach.">
    <meta name="author" content="Magic Veekthor">
    <meta name="keywords" content="Eleko Ocean Front Resort, Eleko Beach Resort, Lagos resort, beachfront accommodation, short stay apartment Lagos, luxury resort Nigeria, beach resort Lagos, vacation rental Lagos, oceanfront hotel Lagos, Eleko beach lodging, holiday homes Lagos, premium apartments Eleko">

    <meta property="og:title" content="Eleko Ocean Front Resort – Luxury Beachfront Stay in Lagos">
    <meta property="og:description" content="Experience premium beachfront living at Eleko Ocean Front Resort. Elegant apartments, ocean views, swimming pool, African-inspired art & exceptional hospitality.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.elekooceanresort.com">
    <meta property="og:site_name" content="Eleko Ocean Front Resort">
    <title>Contact - Eleko Ocean Front Resort</title>
    
    <!-- Favicons-->
    <link rel="shortcut icon" href="img/logo/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/vendors.min.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">
</head>

<body> 

    <?php include "includes/header.php"; ?>

    <main>

        <div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
            <img class="jarallax-img" src="img/home_3.jpg" alt="">
            <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <small class="slide-animated one">Eleko Ocean Front Resort</small>
                    <h1 class="slide-animated two">Contact Us</h1>
                </div>
            </div>
        </div>
        <!-- /Background Img Parallax -->

        <div class="container margin_120_95">
            <div class="row justify-content-between">
                <div class="col-xl-4 col-lg-5 order-2 order-lg-2">
                    <div class="contact_info">
                        <ul class="clearfix">
                            <li>
                                <i class="bi bi-geo-alt"></i>
                                <h4>Address</h4>
                                <div>Adepeyin Olowu street, Eleko Beach road<br>Ibeju-lekki, Lagos.</div>
                            </li>
                            <li>
                                <i class="bi bi-envelope-paper"></i>
                                <h4>Email address</h4>
                                <p><a href="mailto:elekooceanresort@gmail.com">elekooceanresort@gmail.com</a></p>
                            </li>
                            <li>
                                <i class="bi bi-telephone"></i>
                                <h4>Telephone</h4>
                                <div><a href="tel://+234 814 998 6209">+234 814 998 6209</a></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 order-1 order-lg-1">
                    <h3 class="mb-3">Get in Touch</h3>
                    <div id="message-contact"></div>
                    <form method="POST" id="contact_form">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                                    <label for="name_contact">Full Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="email" name="email" placeholder="Email Address" required>
                                    <label for="lastname_contact">Email Address</label>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="number" name="phone" placeholder="Phone Number" required>
                                    <label for="email_contact">Phone Number</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" name="subject" placeholder="Subject" required>
                                    <label for="phone_contact">Subject</label>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="form-floating mb-4">
                            <textarea class="form-control" placeholder="Message" name="message"></textarea>
                            <label for="message_contact">Message</label>
                        </div>
                        <p class="mt-3">
                            <button type="submit" class="btn_1 outline" id="SubmitBtn">
                                <span class="btn-text">Send Message</span>
                                <span id="Spinner" style="display:none;">⏳</span>
                            </button>
                        </p>
                    </form>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!--/container -->

        <div class="map_contact">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15858.566182063301!2d3.8484576!3d6.4400577!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103953a3f33c709d%3A0x52ae80de73110f04!2sEleko%20Ocean%20Front%20Resort!5e0!3m2!1sen!2sng!4v1688036537189!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!--/map_contact -->
    </main>

    <?php include "includes/footer.php" ?>
    <!-- /footer -->

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- /back to top -->

    <!-- Modal Login Form -->
    <div id="loginModal" class="modal-overlay">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <h2>Login</h2>
            <form>
                <input type="email" name="email" placeholder="Enter your email" required>
                <input type="password" name="password" placeholder="Enter your password" required>

                <div class="password_zone">
                    <button type="submit" class="btn_1 mt-2 mb-4">Login</button>
                    <a href="javascript:void(0)">Forgot Password?</a>
                </div>

                <div class="sign-up">
                    <p>If you don't have an account...<a href="register.php">Click here</a> to register</p>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Login Form -->



<!-- COMMON SCRIPTS -->
<script src="js/common_scripts.js"></script>
<script src="js/common_functions.js"></script>
<script src="js/datepicker_inline.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="js/modal_popup.js"></script>

<script>
    let contact_form = document.getElementById('contact_form');
    let SubmitBtn = document.getElementById('SubmitBtn');
    let Spinner = document.getElementById('Spinner');
    let BtnText = document.querySelector("#SubmitBtn .btn-text");

    contact_form.addEventListener('submit', function(e){
        e.preventDefault();

        // Disable button + show spinner
        SubmitBtn.disabled = true;
        Spinner.style.display = "inline-block";
        BtnText.textContent = "Please wait...";

        let data = new FormData();
        data.append('submit', '');
        data.append('name', contact_form.elements['name'].value);
        data.append('email', contact_form.elements['email'].value);
        data.append('phone', contact_form.elements['phone'].value);
        data.append('subject', contact_form.elements['subject'].value);
        data.append('message', contact_form.elements['message'].value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/contact_form.php", true);

        xhr.onload = function(){

            // Re-enable button + hide spinner
            SubmitBtn.disabled = false;
            Spinner.style.display = "none";
            BtnText.textContent = "Send Message";

            if (this.responseText.trim() === "1") {
                alert('success', 'Message sent!');
                contact_form.reset();
            } else {
                alert('error', 'Server Down! Try again later');
            }
        };

        xhr.send(data);
    });
</script>
</body>
</html>