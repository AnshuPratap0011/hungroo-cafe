<?php

/* =========================================================
FILE: verify-otp.php
VERIFY OTP SYSTEM
INLINE CSS INCLUDED
========================================================= */

include "config/config.php";

/* =========================================================
CHECK EMAIL SESSION
========================================================= */

if(!isset($_SESSION['reset_email'])){

    header("Location: forgot-password.php");
    exit;

}

$email =
$_SESSION['reset_email'];

/* =========================================================
MESSAGE
========================================================= */

$message = "";

/* =========================================================
VERIFY OTP
========================================================= */

if(isset($_POST['verify_otp'])){

    $otp = cleanInput($_POST['otp']);

    /* =========================================================
    EMPTY
    ========================================================= */

    if(empty($otp)){

        $message = "

        <div class='auth-alert error'>

            Please enter OTP

        </div>

        ";

    }

    else{

        /* =========================================================
        CHECK OTP
        ========================================================= */

        $query = mysqli_query(

            $conn,

            "SELECT *
            FROM users

            WHERE

            email='$email'

            AND

            otp_code='$otp'

            LIMIT 1"

        );

        if(mysqli_num_rows($query) > 0){

            $user =
            mysqli_fetch_assoc($query);

            /* =========================================================
            CHECK EXPIRE
            ========================================================= */

            if(

                strtotime($user['otp_expire'])

                <

                time()

            ){

                $message = "

                <div class='auth-alert error'>

                    OTP expired

                </div>

                ";

            }

            else{

                /* =========================================================
                VERIFIED
                ========================================================= */

                $_SESSION['otp_verified'] =
                true;

                header("Location: reset-password.php");
                exit;

            }

        }

        else{

            $message = "

            <div class='auth-alert error'>

                Invalid OTP

            </div>

            ";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Verify OTP | Hungroo Café

</title>

<!-- GOOGLE FONT -->

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
rel="stylesheet">

<!-- FONT AWESOME -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- NAVBAR -->

<link
rel="stylesheet"
href="assets/css/navbar.css">

<!-- =========================================================
INLINE CSS
========================================================= -->

<style>

/* =========================================================
ROOT
========================================================= */

:root{

    --primary:#ff6b00;
    --secondary:#ffb347;

}

/* =========================================================
GLOBAL
========================================================= */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

body{

    background:
    linear-gradient(
    180deg,
    #050505,
    #0d0d0d
    );

    font-family:'Poppins',sans-serif;

    overflow-x:hidden;

    color:#fff;

}

/* =========================================================
SECTION
========================================================= */

.auth-section{

    width:100%;

    min-height:100vh;

    padding:
    140px 6% 80px;

    display:flex;

    align-items:center;
    justify-content:center;

}

/* =========================================================
BOX
========================================================= */

.auth-box{

    width:100%;

    max-width:520px;

    padding:40px;

    border-radius:40px;

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);

    backdrop-filter:
    blur(24px);

}

/* =========================================================
FORM
========================================================= */

.auth-form{

    display:flex;

    flex-direction:column;

    gap:22px;

}

.auth-form h1{

    font-size:42px;

    font-weight:900;

}

.auth-form p{

    color:#bdbdbd;

    line-height:1.7;

}

/* =========================================================
INPUT
========================================================= */

.input-box label{

    display:block;

    margin-bottom:12px;

    color:#ffb347;

    font-size:14px;

    font-weight:700;

}

.input-wrap{

    width:100%;
    height:68px;

    padding:0 22px;

    border-radius:24px;

    display:flex;

    align-items:center;

    gap:14px;

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);

}

.input-wrap i{

    color:#ffb347;

}

.input-wrap input{

    width:100%;
    height:100%;

    border:none;

    outline:none;

    background:transparent;

    color:#fff;

    font-size:15px;

    letter-spacing:4px;

}

/* =========================================================
BUTTON
========================================================= */

.auth-btn{

    width:100%;
    height:64px;

    border:none;

    outline:none;

    cursor:pointer;

    border-radius:22px;

    background:
    linear-gradient(
    135deg,
    #ff6b00,
    #ffb347
    );

    color:#fff;

    font-size:16px;

    font-weight:700;

}

/* =========================================================
ALERT
========================================================= */

.auth-alert{

    width:100%;

    padding:16px 20px;

    border-radius:18px;

    font-size:14px;

}

.auth-alert.error{

    background:
    rgba(255,60,60,.08);

    border:
    1px solid rgba(255,60,60,.16);

    color:#ff7b7b;

}

/* =========================================================
PHONE
========================================================= */

@media(max-width:768px){

    .auth-section{

        padding:
        120px 5% 60px;

    }

    .auth-box{

        padding:24px;

        border-radius:30px;

    }

    .auth-form h1{

        font-size:34px;

    }

    .input-wrap{

        height:62px;

        border-radius:20px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =========================================================
SECTION
========================================================= -->

<section class="auth-section">

    <div class="auth-box">

        <form
        method="POST"
        class="auth-form">

            <h1>

                Verify OTP

            </h1>

            <p>

                Enter the OTP sent to your email.

            </p>

            <?php echo $message; ?>

            <!-- OTP -->

            <div class="input-box">

                <label>

                    OTP Code

                </label>

                <div class="input-wrap">

                    <i class="fa-solid fa-shield"></i>

                    <input
                    type="text"
                    name="otp"
                    placeholder="Enter OTP"
                    maxlength="6"
                    required>

                </div>

            </div>

            <!-- BTN -->

            <button
            type="submit"
            name="verify_otp"
            class="auth-btn">

                Verify OTP

            </button>

        </form>

    </div>

</section>

</body>
</html>