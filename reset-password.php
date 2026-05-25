<?php

session_start();

/* =========================================================
CONFIG
========================================================= */

include "config/config.php";

/* =========================================================
CHECK RESET EMAIL
========================================================= */

if(!isset($_SESSION['reset_email'])){

    header(
    "Location: forgot-password.php"
    );

    exit();

}

$email =

$_SESSION['reset_email'];

$message = "";
$success = "";

/* =========================================================
RESET PASSWORD
========================================================= */

if(isset($_POST['reset_password'])){

    $otp =

    mysqli_real_escape_string(
    $conn,
    $_POST['otp']
    );

    $password =
    $_POST['password'];

    $confirm_password =
    $_POST['confirm_password'];

    /* =====================================================
    CHECK PASSWORD MATCH
    ====================================================== */

    if($password != $confirm_password){

        $message =
        "Passwords do not match.";

    }

    else{

        /* =================================================
        CHECK OTP
        ================================================== */

        $checkOTP =

        mysqli_query(

            $conn,

            "SELECT * FROM otp_verifications

            WHERE email='$email'

            AND otp='$otp'

            AND expires_at >= NOW()

            LIMIT 1"

        );

        if(mysqli_num_rows($checkOTP) < 1){

            $message =
            "Invalid or expired OTP.";

        }

        else{

            /* =============================================
            HASH PASSWORD
            ============================================== */

            $hashed_password =

            password_hash(

                $password,
                PASSWORD_DEFAULT

            );

            /* =============================================
            UPDATE PASSWORD
            ============================================== */

            mysqli_query(

                $conn,

                "UPDATE users

                SET password='$hashed_password'

                WHERE email='$email'"

            );

            /* =============================================
            DELETE OTP
            ============================================== */

            mysqli_query(

                $conn,

                "DELETE FROM otp_verifications
                WHERE email='$email'"

            );

            unset($_SESSION['reset_email']);

            $success =
            "Password reset successful.";

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

Reset Password

</title>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<style>

body{

    margin:0;
    background:#070707;
    color:#fff;

    font-family:'Poppins',sans-serif;

    display:flex;

    align-items:center;
    justify-content:center;

    min-height:100vh;

    padding:20px;

}

.box{

    width:100%;
    max-width:500px;

    padding:40px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid rgba(255,255,255,.08);

}

h1{

    font-size:42px;

    margin-bottom:10px;

}

p{

    color:#aaa;

    margin-bottom:30px;

}

input{

    width:100%;
    height:60px;

    border:none;
    outline:none;

    border-radius:18px;

    padding:0 18px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid rgba(255,255,255,.08);

    color:#fff;

    font-size:14px;

    margin-bottom:20px;

}

button{

    width:100%;
    height:60px;

    border:none;

    cursor:pointer;

    border-radius:18px;

    background:
    linear-gradient(
    135deg,
    #ff9a3d,
    #ffd27a
    );

    color:#000;

    font-size:15px;

    font-weight:800;

}

.message{

    margin-bottom:20px;

    color:#ff4d4d;

}

.success{

    margin-bottom:20px;

    color:#4caf50;

}

.login-link{

    display:block;

    margin-top:24px;

    text-align:center;

    color:#ffd27a;

    text-decoration:none;

}

</style>

</head>

<body>

<div class="box">

    <h1>

        Reset Password

    </h1>

    <p>

        Enter OTP and create your new password.

    </p>

    <?php if(!empty($message)): ?>

    <div class="message">

        <?php echo $message; ?>

    </div>

    <?php endif; ?>

    <?php if(!empty($success)): ?>

    <div class="success">

        <?php echo $success; ?>

    </div>

    <a
    href="login.php"

    class="login-link">

        Login Now

    </a>

    <?php else: ?>

    <form method="POST">

        <input
        type="text"

        name="otp"

        placeholder="Enter OTP"

        maxlength="6"

        required>

        <input
        type="password"

        name="password"

        placeholder="New Password"

        required>

        <input
        type="password"

        name="confirm_password"

        placeholder="Confirm Password"

        required>

        <button
        type="submit"

        name="reset_password">

            Reset Password

        </button>

    </form>

    <?php endif; ?>

</div>

</body>
</html>