<?php

session_start();

/* =========================================================
CONFIG
========================================================= */

include "config/config.php";

/* =========================================================
PHPMailer
========================================================= */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

/* =========================================================
MESSAGE
========================================================= */

$message = "";

/* =========================================================
SEND OTP
========================================================= */

if(isset($_POST['send_otp'])){

    $email =

    mysqli_real_escape_string(
    $conn,
    $_POST['email']
    );

    $otp =
    rand(100000,999999);

    $expires_at =

    date(
    "Y-m-d H:i:s",
    strtotime("+10 minutes")
    );

    /* =====================================================
    DELETE OLD OTP
    ====================================================== */

    mysqli_query(

        $conn,

        "DELETE FROM otp_verifications
        WHERE email='$email'"

    );

    /* =====================================================
    INSERT OTP
    ====================================================== */

    mysqli_query(

        $conn,

        "INSERT INTO otp_verifications (

            email,
            otp,
            expires_at

        )

        VALUES (

            '$email',
            '$otp',
            '$expires_at'

        )"

    );

    /* =====================================================
    MAILER
    ====================================================== */

    $mail = new PHPMailer(true);

    try{

        $mail->isSMTP();

        $mail->Host =
        'smtp.gmail.com';

        $mail->SMTPAuth =
        true;

        $mail->Username =
        'hungroocafe@gmail.com';

        $mail->Password =
        'yzlf rgcm skcw zkjg';

        $mail->SMTPSecure =
        PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port =
        587;

        $mail->setFrom(

            'hungroocafe@gmail.com',
            'Hungroo Cafe'

        );

        $mail->addAddress(
        $email
        );

        $mail->isHTML(true);

        $mail->Subject =
        'Your Hungroo Verification Code';

        $mail->AltBody =
        "Your Hungroo OTP is: $otp";

        $mail->Body = "

        <div style='
        background:#f5f5f5;
        padding:40px 20px;
        font-family:Arial,sans-serif;
        '>

            <div style='
            max-width:520px;
            margin:auto;
            background:#ffffff;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
            '>

                <div style='
                background:linear-gradient(135deg,#ff9a3d,#ffd27a);
                padding:30px;
                text-align:center;
                '>

                    <h1 style='
                    margin:0;
                    color:#111;
                    font-size:34px;
                    '>

                    Hungroo Cafe

                    </h1>

                </div>

                <div style='padding:40px;'>

                    <h2 style='
                    margin-top:0;
                    color:#111;
                    '>

                    Email Verification

                    </h2>

                    <p style='
                    color:#666;
                    line-height:1.8;
                    font-size:15px;
                    '>

                    Use the OTP below to verify
                    your Hungroo account.

                    </p>

                    <div style='
                    margin:35px 0;
                    text-align:center;
                    '>

                        <span style='
                        display:inline-block;
                        background:#111;
                        color:#ffd27a;
                        padding:18px 34px;
                        border-radius:16px;
                        font-size:38px;
                        letter-spacing:8px;
                        font-weight:bold;
                        '>

                        $otp

                        </span>

                    </div>

                    <p style='
                    color:#999;
                    font-size:14px;
                    line-height:1.7;
                    '>

                    This OTP will expire in
                    10 minutes.

                    </p>

                </div>

            </div>

        </div>

        ";

        $mail->send();

        $_SESSION['otp_email'] =
        $email;

        header(
        "Location: verify-otp.php"
        );

        exit();

    }

    catch(Exception $e){

        $message =
        "Mailer Error: " .
        $mail->ErrorInfo;

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

Send OTP

</title>

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

:root{

    --primary:#ff9a3d;
    --gold:#ffd27a;
    --dark:#050505;
    --card:rgba(255,255,255,.05);
    --border:rgba(255,255,255,.08);
    --text:#aaaaaa;

}

*{

    margin:0;
    padding:0;
    box-sizing:border-box;

}

body{

    min-height:100vh;

    display:flex;

    align-items:center;
    justify-content:center;

    overflow:hidden;

    padding:20px;

    background:
    radial-gradient(circle at top right,#ff9a3d22,transparent 30%),
    radial-gradient(circle at bottom left,#ffd27a22,transparent 30%),
    var(--dark);

    font-family:'Poppins',sans-serif;

    position:relative;

}

.blur-circle{

    position:absolute;

    border-radius:50%;

    filter:blur(120px);

    opacity:.18;

}

.blur-1{

    width:350px;
    height:350px;

    background:#ff9a3d;

    top:-100px;
    right:-100px;

}

.blur-2{

    width:320px;
    height:320px;

    background:#ffd27a;

    bottom:-100px;
    left:-100px;

}

.otp-card{

    position:relative;

    width:100%;
    max-width:520px;

    padding:45px;

    border-radius:36px;

    background:var(--card);

    border:
    1px solid var(--border);

    backdrop-filter:blur(18px);

    box-shadow:
    0 20px 60px rgba(0,0,0,.45);

    z-index:10;

    animation:fadeUp .7s ease;

}

@keyframes fadeUp{

    from{

        opacity:0;

        transform:
        translateY(30px);

    }

    to{

        opacity:1;

        transform:
        translateY(0);

    }

}

.logo{

    text-align:center;

    margin-bottom:16px;

}

.logo h1{

    font-size:52px;

    font-weight:800;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    -webkit-background-clip:text;

    -webkit-text-fill-color:
    transparent;

}

.subtitle{

    text-align:center;

    color:var(--text);

    line-height:1.8;

    margin-bottom:34px;

    font-size:15px;

}

.message{

    margin-bottom:24px;

    padding:16px;

    border-radius:18px;

    text-align:center;

    font-size:14px;

    background:
    rgba(255,77,77,.1);

    border:
    1px solid rgba(255,77,77,.2);

    color:#ff4d4d;

}

.input-group{

    margin-bottom:24px;

}

.input-group label{

    display:block;

    margin-bottom:10px;

    color:#fff;

    font-size:14px;

    font-weight:500;

}

.input-box{

    position:relative;

}

.left-icon{

    position:absolute;

    top:50%;
    left:20px;

    transform:
    translateY(-50%);

    color:#999;

    z-index:2;

}

.input-box input{

    width:100%;
    height:68px;

    border:none;
    outline:none;

    border-radius:22px;

    padding-left:58px;
    padding-right:20px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid rgba(255,255,255,.08);

    color:#fff;

    font-size:15px;

    transition:.35s;

}

.input-box input::placeholder{

    color:#777;

}

.input-box input:focus{

    border:
    1px solid var(--primary);

    box-shadow:
    0 0 0 4px rgba(255,154,61,.12);

}

.send-btn{

    width:100%;
    height:66px;

    border:none;

    cursor:pointer;

    border-radius:22px;

    margin-top:10px;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#111;

    font-size:16px;

    font-weight:800;

    transition:.35s;

    overflow:hidden;

    position:relative;

}

.send-btn::before{

    content:"";

    position:absolute;

    top:0;
    left:-100%;

    width:100%;
    height:100%;

    background:
    rgba(255,255,255,.2);

    transition:.5s;

}

.send-btn:hover::before{

    left:100%;

}

.send-btn:hover{

    transform:
    translateY(-4px);

    box-shadow:
    0 12px 30px rgba(255,154,61,.35);

}

@media(max-width:600px){

    .otp-card{

        padding:34px 24px;

        border-radius:28px;

    }

    .logo h1{

        font-size:42px;

    }

}

</style>

</head>

<body>

<div class="blur-circle blur-1"></div>
<div class="blur-circle blur-2"></div>

<div class="otp-card">

    <div class="logo">

        <h1>

            Hungroo

        </h1>

    </div>

    <p class="subtitle">

        Verify your email to continue ✨

    </p>

    <?php if(!empty($message)): ?>

    <div class="message">

        <?php echo $message; ?>

    </div>

    <?php endif; ?>

    <form method="POST">

        <div class="input-group">

            <label>

                Email Address

            </label>

            <div class="input-box">

                <i class="fa-solid fa-envelope left-icon"></i>

                <input
                type="email"

                name="email"

                placeholder="Enter your email"

                required>

            </div>

        </div>

        <button
        type="submit"

        name="send_otp"

        class="send-btn">

            Send OTP

        </button>

    </form>

</div>

</body>
</html>