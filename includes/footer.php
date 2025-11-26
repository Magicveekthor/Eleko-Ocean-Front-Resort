<footer class="revealed">
    <div class="footer_bg">
        <div class="gradient_over"></div>
        <div class="background-image" data-background="url(img/footer.jpg)"></div>
    </div>
    <div class="container">
        <div class="row move_content">
            <div class="col-lg-4 col-md-12">
                <h5>Contacts</h5>
                <ul>
                    <li>Adepeyin Olowu street, Eleko Beach road<br>Ibeju-lekki, Lagos<br><br></li> 
                    <li><strong><a href="#0">support@elekooceanresort.com</a></strong></li>
                    <li><strong><a href="tel://+2348149986209">+234 814 998 6209</a></strong></li>
                </ul>
                <div class="social">
                    <ul>
                        <li><a href="https://www.instagram.com/elekooceanfrontresort?igsh=N2Z1cW02aHI5aWJh"><i class="bi bi-instagram"></i></a></li>
                        <li><a href="https://wa.me/+2348149986209"><i class="bi bi-whatsapp"></i></a></li>
                        <li><a href="https://www.facebook.com/share/1CvrSJiDrd/?mibextid=wwXIfr"><i class="bi bi-facebook"></i></a></li>
                        <li><a href="https://www.tiktok.com/@elekooceanfrontresort?_t=ZS-90xlaJN7WTq&_r=1"><i class="bi bi-tiktok"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 ms-lg-auto">
                <h5>Explore</h5>
                <div class="footer_links">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="rooms.php">Rooms &amp; Suites</a></li>
                        <li><a href="contacts.php">Contacts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div id="newsletter">
                    <h5>Newsletter</h5>
                    <div id="message-newsletter"></div>
                    <form method="post" id="newsletter">
                        <div class="form-group">
                            <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                            <button type="submit" id="submit-newsletter"><i class="bi bi-send"></i></button>
                        </div>
                    </form>
                    <p>Receive latest offers and promos without spam. You can cancel anytime.</p>
                </div>
            </div>
        </div>
        <!--/row-->
    </div>
    <!--/container-->
    <div class="copy">
        <div class="container">
            © Eleko Ocean Front Resort - by <a href="https://www.magicveekthor.com/"  target="_blank">Magic Veekthor</a>
        </div>
    </div>
</footer>


<script>
document.getElementById("newsletter").addEventListener("submit", function(e) {
    e.preventDefault(); // Stop form from submitting

    let email = document.getElementById("email_newsletter").value.trim();
    let msg = document.getElementById("message-newsletter");

    if (email === "") {
        msg.innerHTML = "<span style='color:red;'>Please enter your email.</span>";
    } else {
        msg.innerHTML = "<span style='color:green;'>Thank you! You'll receive our updates soon.</span>";
    }
});
</script>