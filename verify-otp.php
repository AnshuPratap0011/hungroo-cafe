<?php

session_start();

/* =========================================================
CONFIG
========================================================= */

include "config/config.php";

/* =========================================================
CHECK EMAIL SESSION
========================================================= */

if(!isset($_SESSION['otp_email'])){

    header(
    "Location: send-otp.php"
    );

    exit();

}

$email =

$_SESSION['otp_email'];

$message = "";

/* =========================================================
VERIFY OTP
========================================================= */

if(isset($_POST['verify_otp'])){

    $user_otp =

    mysqli_real_escape_string(
    $conn,
    $_POST['otp']
    );

    /* =====================================================
    CHECK OTP
    ====================================================== */

    $query =

    "SELECT * FROM otp_verifications

    WHERE email='$email'

    AND otp='$user_otp'

    AND expires_at >= NOW()

    LIMIT 1";

    $result =

    mysqli_query(
    $conn,
    $query
    );

    /* =====================================================
    SUCCESS
    ====================================================== */

    if(mysqli_num_rows($result) > 0){

        mysqli_query(

            $conn,

            "UPDATE otp_verifications

            SET is_verified='1'

            WHERE email='$email'"

        );

        $_SESSION['verified_email'] =
        $email;

        header(
        "Location: register.php"
        );

        exit();

    }

    else{

        $message =
        "Invalid or expired OTP.";

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

Verify OTP

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

    backdrop-filter:blur(12px);

}

.logo{

    text-align:center;

    margin-bottom:20px;

}

.logo h1{

    margin:0;

    font-size:38px;

    background:
    linear-gradient(
    135deg,
    #ff9a3d,
    #ffd27a
    );

    -webkit-background-clip:text;

    -webkit-text-fill-color:
    transparent;

}

h2{

    font-size:32px;

    margin-bottom:10px;

    text-align:center;

}

p{

    color:#aaa;

    margin-bottom:30px;

    text-align:center;

    line-height:1.8;

}

.email{

    color:#ffd27a;

    font-weight:600;

}

input{

    width:100%;
    height:65px;

    border:none;
    outline:none;

    border-radius:20px;

    padding:0 20px;

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);

    color:#fff;

    font-size:24px;

    letter-spacing:10px;

    text-align:center;

    margin-bottom:24px;

}

button{

    width:100%;
    height:62px;

    border:none;

    cursor:pointer;

    border-radius:20px;

    background:
    linear-gradient(
    135deg,
    #ff9a3d,
    #ffd27a
    );

    color:#111;

    font-size:16px;

    font-weight:800;

    transition:.3s;

}

button:hover{

    transform:
    translateY(-2px);

}

.message{

    margin-bottom:20px;

    color:#ff4d4d;

    text-align:center;

}

.resend{

    margin-top:24px;

    text-align:center;

}

.resend a{

    color:#ffd27a;

    text-decoration:none;

    font-size:14px;

}

</style>

</head>

<body>

<div class="box">

    <div class="logo">

        <h1>

            Hungroo

        </h1>

    </div>

    <h2>

        Verify OTP

    </h2>

    <p>

        OTP sent to:

        <span class="email">

            <?php echo $email; ?>

        </span>

    </p>

    <?php if(!empty($message)): ?>

    <div class="message">

        <?php echo $message; ?>

    </div>

    <?php endif; ?>

    <form method="POST">

        <input
        type="text"

        name="otp"

        maxlength="6"

        placeholder="000000"

        required>

        <button
        type="submit"

        name="verify_otp">

            Verify OTP

        </button>

    </form>

    <div class="resend">

        <a href="send-otp.php">

            Resend OTP

        </a>

    </div>

</div>

</body>
</html>