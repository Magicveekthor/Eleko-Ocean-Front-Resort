<?php
#connection file
require("includes/db.php");
require("includes/functions.php");

session_start();
if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
    redirect('dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Eleko Ocean Front Resort</title>
    <!-- Remixicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
    <!-- Bootstrap -->
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Css style -->
    <link href="../img/logo/favicon.png" rel="icon">
    <link href="css/login.css" rel="stylesheet">

</head>
<body>
    <svg class="login__blob" viewBox="0 0 566 840" xmlns="http://www.w3.org/2000/svg">
       <mask id="mask0" mask-type="alpha">
          <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 
          0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 
          591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 
          167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z"/>
       </mask>
    
       <g mask="url(#mask0)">
          <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 
          0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 
          591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 
          167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z"/>
    
          <!-- Insert your image (recommended size: 1000 x 1200) -->
          <image class="login__img" href="assets/login/bg-login.jpg"/>
       </g>
    </svg>  

    <div class="login container grid" id="loginAccessRegister">
        <div class="login__access">
            <div class="logo">
                <img src="../img/logo/eleko_logo_black.png">
            </div>

            <h1 class="login__title">Admin Login</h1>

            <div class="login__area">
                <form method="post" class="login__form">
                    <div class="login__content grid">
                        <div class="login__box">
                            <input type="text" name="admin_name" id="admin" required placeholder="" class="login__input">
                            <label for="admin" class="login__label">Username</label>

                            <i class="ri-user-6-fill login__icon"></i>
                        </div>

                        <div class="login__box">
                            <input type="password" name="admin_password" id="password" required placeholder="" class="login__input">
                            <label for="password" class="login__label">Password</label>
            
                            <i class="ri-eye-off-fill login__icon login__password" id="loginPassword"></i>
                        </div>
                    </div>

                    <a href="#" class="login__forgot">Forgot Password?</a>

                    <button type="submit" name="submit" class="login__button">Login</button>
                </form>
            </div>
        </div>
    </div>


    <?php
        if(isset($_POST['submit'])) {
            $frm_data = filteration($_POST);

            $query = "SELECT * FROM `admin_cred` WHERE `admin_name` = ? AND `admin_password` = ?";
            $values = [$frm_data['admin_name'], $frm_data['admin_password']];

            $res = select($query, $values, "ss");
            if($res->num_rows == 1){
                $row = mysqli_fetch_assoc($res);
                $_SESSION['adminLogin'] = true;
                $_SESSION['adminId'] = $row['id'];
                redirect('rooms.php');
            } else {
                alert('error', 'Login failed - Invalid Credentials!');
            }
        }
    ?>


    <script src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>