<?php

session_start();

/* =========================================================
CONFIG
========================================================= */

include "config/config.php";

/* =========================================================
CHECK VERIFIED EMAIL
========================================================= */

if(!isset($_SESSION['verified_email'])){

    header(
    "Location: send-otp.php"
    );

    exit();

}

$email =

$_SESSION['verified_email'];

$message = "";

/* =========================================================
REGISTER USER
========================================================= */

if(isset($_POST['register'])){

    $full_name =

    mysqli_real_escape_string(
    $conn,
    $_POST['full_name']
    );

    $phone =

    mysqli_real_escape_string(
    $conn,
    $_POST['phone']
    );

    $password =
    $_POST['password'];

    $confirm_password =
    $_POST['confirm_password'];

    if($password != $confirm_password){

        $message =
        "Passwords do not match.";

    }

    else{

        $checkUser =

        mysqli_query(

            $conn,

            "SELECT * FROM users

            WHERE email='$email'

            OR phone='$phone'

            LIMIT 1"

        );

        if(mysqli_num_rows($checkUser) > 0){

            $message =
            "User already exists.";

        }

        else{

            $hashed_password =

            password_hash(

                $password,
                PASSWORD_DEFAULT

            );

            $referral_code =

            "BOOBA" .
            rand(1000,9999);

            mysqli_query(

                $conn,

                "INSERT INTO users (

                    full_name,
                    email,
                    phone,
                    password,
                    is_verified,
                    referral_code

                )

                VALUES (

                    '$full_name',
                    '$email',
                    '$phone',
                    '$hashed_password',
                    '1',
                    '$referral_code'

                )"

            );

            unset($_SESSION['otp_email']);
            unset($_SESSION['verified_email']);

            header(
            "Location: login.php?registered=1"
            );

            exit();

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

Create Account

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

    overflow-y:auto;
    overflow-x:hidden;

    padding:30px 20px;

    background-color:#050505;

    background-image:
    radial-gradient(circle at top right,#ff9a3d22,transparent 30%),
    radial-gradient(circle at bottom left,#ffd27a22,transparent 30%);

    background-repeat:no-repeat;

    background-size:cover;

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

.register-card{

    position:relative;

    width:100%;
    max-width:560px;

    margin:auto;

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

    margin-bottom:15px;

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

    margin-bottom:30px;

    font-size:15px;

}

.email{

    color:var(--gold);

    font-weight:600;

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

    margin-bottom:22px;

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
    height:65px;

    border:none;
    outline:none;

    border-radius:22px;

    padding-left:58px;
    padding-right:58px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid rgba(255,255,255,.08);

    color:#fff;

    font-size:14px;

    transition:.35s;

    text-align:left;

}

.input-box input::placeholder{

    color:#777;

    text-align:left;

}

.input-box input:focus{

    border:
    1px solid var(--primary);

    box-shadow:
    0 0 0 4px rgba(255,154,61,.12);

}

.toggle-password{

    position:absolute;

    top:50%;
    right:20px;

    transform:
    translateY(-50%);

    cursor:pointer;

    color:#999;

    transition:.3s;

    z-index:2;

}

.toggle-password:hover{

    color:var(--gold);

}

.register-btn{

    width:100%;
    height:65px;

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

.register-btn::before{

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

.register-btn:hover::before{

    left:100%;

}

.register-btn:hover{

    transform:
    translateY(-4px);

    box-shadow:
    0 12px 30px rgba(255,154,61,.35);

}

@media(max-width:600px){

    .register-card{

        padding:34px 24px;

        border-radius:28px;

    }

}

</style>

</head>

<body>

<div class="blur-circle blur-1"></div>
<div class="blur-circle blur-2"></div>

<div class="register-card">

    <div class="logo">

        <h1>

            Hungroo

        </h1>

    </div>

    <p class="subtitle">

        Create your premium café account ☕<br>

        Verified Email:
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

        <div class="input-group">

            <label>

                Full Name

            </label>

            <div class="input-box">

                <i class="fa-solid fa-user left-icon"></i>

                <input
                type="text"

                name="full_name"

                placeholder="Enter full name"

                required>

            </div>

        </div>

        <div class="input-group">

            <label>

                Phone Number

            </label>

            <div class="input-box">

                <i class="fa-solid fa-phone left-icon"></i>

                <input
                type="text"

                name="phone"

                placeholder="Enter phone number"

                required>

            </div>

        </div>

        <div class="input-group">

            <label>

                Password

            </label>

            <div class="input-box">

                <i class="fa-solid fa-lock left-icon"></i>

                <input
                type="password"

                id="password"

                name="password"

                placeholder="Create password"

                required>

                <span
                class="toggle-password"

                onclick="togglePassword('password','eye1')">

                    <i
                    id="eye1"

                    class="fa-solid fa-eye"></i>

                </span>

            </div>

        </div>

        <div class="input-group">

            <label>

                Confirm Password

            </label>

            <div class="input-box">

                <i class="fa-solid fa-lock left-icon"></i>

                <input
                type="password"

                id="confirmPassword"

                name="confirm_password"

                placeholder="Confirm password"

                required>

                <span
                class="toggle-password"

                onclick="togglePassword('confirmPassword','eye2')">

                    <i
                    id="eye2"

                    class="fa-solid fa-eye"></i>

                </span>

            </div>

        </div>

        <button
        type="submit"

        name="register"

        class="register-btn">

            Create Account

        </button>

    </form>

</div>

<script>

function togglePassword(inputId,iconId){

    const input =
    document.getElementById(inputId);

    const icon =
    document.getElementById(iconId);

    if(input.type === "password"){

        input.type = "text";

        icon.classList.remove(
        "fa-eye"
        );

        icon.classList.add(
        "fa-eye-slash"
        );

    }

    else{

        input.type = "password";

        icon.classList.remove(
        "fa-eye-slash"
        );

        icon.classList.add(
        "fa-eye"
        );

    }

}

</script>

</body>
</html>