<?php

/* =========================================================
FILE: reset-password.php
RESET PASSWORD SYSTEM
INLINE CSS INCLUDED
========================================================= */

include "config/config.php";

/* =========================================================
CHECK VERIFY
========================================================= */

if(

    !isset($_SESSION['reset_email'])

    ||

    !isset($_SESSION['otp_verified'])

){

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
RESET PASSWORD
========================================================= */

if(isset($_POST['reset_password'])){

    $password =
    $_POST['password'];

    $confirm_password =
    $_POST['confirm_password'];

    /* =========================================================
    EMPTY
    ========================================================= */

    if(

        empty($password)
        ||
        empty($confirm_password)

    ){

        $message = "

        <div class='auth-alert error'>

            Please fill all fields

        </div>

        ";

    }

    /* =========================================================
    MATCH
    ========================================================= */

    else if($password != $confirm_password){

        $message = "

        <div class='auth-alert error'>

            Passwords do not match

        </div>

        ";

    }

    /* =========================================================
    LENGTH
    ========================================================= */

    else if(strlen($password) < 6){

        $message = "

        <div class='auth-alert error'>

            Password minimum 6 characters

        </div>

        ";

    }

    else{

        /* =========================================================
        HASH
        ========================================================= */

        $hashedPassword = password_hash(

            $password,

            PASSWORD_DEFAULT

        );

        /* =========================================================
        UPDATE PASSWORD
        ========================================================= */

        $update = mysqli_query(

            $conn,

            "UPDATE users
            SET

            password='$hashedPassword',
            otp_code=NULL,
            otp_expire=NULL

            WHERE email='$email'"

        );

        if($update){

            /* =========================================================
            REMOVE SESSION
            ========================================================= */

            unset($_SESSION['reset_email']);

            unset($_SESSION['otp_verified']);

            /* =========================================================
            SUCCESS
            ========================================================= */

            $message = "

            <div class='auth-alert success'>

                Password reset successful

            </div>

            ";

            header("refresh:2;url=login.php");

        }

        else{

            $message = "

            <div class='auth-alert error'>

                Failed to reset password

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

Reset Password | Hungroo Café

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

    line-height:1.8;

}

.auth-alert.error{

    background:
    rgba(255,60,60,.08);

    border:
    1px solid rgba(255,60,60,.16);

    color:#ff7b7b;

}

.auth-alert.success{

    background:
    rgba(60,255,120,.08);

    border:
    1px solid rgba(60,255,120,.16);

    color:#7dffae;

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

                Reset Password

            </h1>

            <p>

                Create a new secure password for your account.

            </p>

            <?php echo $message; ?>

            <!-- PASSWORD -->

            <div class="input-box">

                <label>

                    New Password

                </label>

                <div class="input-wrap">

                    <i class="fa-solid fa-lock"></i>

                    <input
                    type="password"
                    name="password"
                    placeholder="Enter new password"
                    required>

                </div>

            </div>

            <!-- CONFIRM -->

            <div class="input-box">

                <label>

                    Confirm Password

                </label>

                <div class="input-wrap">

                    <i class="fa-solid fa-lock"></i>

                    <input
                    type="password"
                    name="confirm_password"
                    placeholder="Confirm password"
                    required>

                </div>

            </div>

            <!-- BTN -->

            <button
            type="submit"
            name="reset_password"
            class="auth-btn">

                Reset Password

            </button>

        </form>

    </div>

</section>

<!-- =========================================================
VERCEL SPEED INSIGHTS
========================================================= -->
<script src="assets/js/speed-insights-init.js" defer></script>

</body>
</html>
