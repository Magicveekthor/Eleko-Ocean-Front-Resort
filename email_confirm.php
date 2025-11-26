<?php
require('admin/includes/db.php');
require('admin/includes/functions.php');

if(isset($_GET['email_confirmation'])) {
    $data = filteration($_GET);

    $query = select("SELECT * FROM `user_cred` WHERE `email` = ? AND `token` = ? LIMIT 1", [$data['email'], $data['token']], 'ss');

    if(mysqli_num_rows($query) == 1) {
        $fetch = mysqli_fetch_assoc($query);
        if($fetch['is_verified'] == 1){
            $msg = "
                <h2>Email address already verified!</h2>
                <p>You can now log in or continue browsing our website.</p>
            ";
        } else {
            $update = update("UPDATE `user_cred` SET `is_verified` = ? WHERE `id` = ?", [1, $fetch['id']], 'ii');
            if($update) {
                $msg = "
                    <h2>Email address confirmed!</h2>
                    <p>Your email has been verified successfully. You can now log in or continue browsing our website.</p>
                ";
            } else {
                $msg = "
                    <h2>Email address verification failed!</h2>
                    <p>The page you are looking for does not exist. But you can click the button below to go back to the homepage.</p>
                ";
            }
        }
    } else {
        $msg = "
                <h2>Link Expired!</h2>
                <p>The page you are looking for does not exist. But you can click the button below to go back to the homepage.</p>
            ";;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Email Confirmation - Eleko Ocean Front Resort</title>
    
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
</head>

<body> 

    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Page Preload -->

    <main>
        <div class="container">
            <div class="row error_page">
                <div class="col-12 align-self-center text-center">
                    <?php echo $msg ?>
                    <p><a class="btn_1 mt-3" href="index.php">Back to home</a></p>
                </div>
            </div>
        </div>
    </main>

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
        </svg>
    </div>
    <!-- /back to top -->


<!-- COMMON SCRIPTS -->
<script src="js/common_scripts.js"></script>
<script src="js/common_functions.js"></script>


</body>
</html>