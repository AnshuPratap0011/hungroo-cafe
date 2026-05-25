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
SEND RESET OTP
========================================================= */

if(isset($_POST['send_otp'])){

    $email =

    mysqli_real_escape_string(
    $conn,
    $_POST['email']
    );

    /* =====================================================
    CHECK USER
    ====================================================== */

    $checkUser =

    mysqli_query(

        $conn,

        "SELECT * FROM users
        WHERE email='$email'
        LIMIT 1"

    );

    if(mysqli_num_rows($checkUser) < 1){

        $message =
        "Email not registered.";

    }

    else{

        /* =================================================
        GENERATE OTP
        ================================================== */

        $otp =
        rand(100000,999999);

        $expires_at =

        date(
        "Y-m-d H:i:s",
        strtotime("+10 minutes")
        );

        /* =============================================
        DELETE OLD OTP
        ============================================== */

        mysqli_query(

            $conn,

            "DELETE FROM otp_verifications
            WHERE email='$email'"

        );

        /* =============================================
        INSERT OTP
        ============================================== */

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

        /* =============================================
        MAILER
        ============================================== */

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

            /* =========================================
            EMAIL
            ========================================== */

            $mail->setFrom(

                'hungroocafe@gmail.com',
                'Hungroo Cafe'

            );

            $mail->addAddress(
            $email
            );

            $mail->isHTML(true);

            $mail->Subject =
            'Hungroo Password Reset Code';

            $mail->AltBody =
            "Your password reset OTP is: $otp";

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

                        Reset Password

                        </h2>

                        <p style='
                        color:#666;
                        line-height:1.8;
                        font-size:15px;
                        '>

                        Use the OTP below to reset
                        your Hungroo account password.

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

            $_SESSION['reset_email'] =
            $email;

            header(
            "Location: reset-password.php"
            );

            exit();

        }

        catch(Exception $e){

            $message =
            "Mailer Error: " .
            $mail->ErrorInfo;

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

Forgot Password

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
    max-width:450px;

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

    word-break:break-word;

}

</style>

</head>

<body>

<div class="box">

    <h1>

        Forgot Password

    </h1>

    <p>

        Enter your registered email
        to receive reset OTP.

    </p>

    <?php if(!empty($message)): ?>

    <div class="message">

        <?php echo $message; ?>

    </div>

    <?php endif; ?>

    <form method="POST">

        <input
        type="email"

        name="email"

        placeholder="Enter Registered Email"

        required>

        <button
        type="submit"

        name="send_otp">

            Send Reset OTP

        </button>

    </form>

</div>

</body>
</html>