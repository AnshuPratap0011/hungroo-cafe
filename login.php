<?php

session_start();

/* =========================================================
CONFIG
========================================================= */

include "config/config.php";

/* =========================================================
MESSAGE
========================================================= */

$message = "";

/* =========================================================
REGISTER SUCCESS
========================================================= */

if(isset($_GET['registered'])){

    $message =
    "Account created successfully.";

}

/* =========================================================
LOGIN
========================================================= */

if(isset($_POST['login'])){

    $email_or_phone =

    mysqli_real_escape_string(
    $conn,
    $_POST['email_or_phone']
    );

    $password =
    $_POST['password'];

    /* =====================================================
    CHECK USER
    ====================================================== */

    $query =

    "SELECT * FROM users

    WHERE email='$email_or_phone'

    OR phone='$email_or_phone'

    LIMIT 1";

    $result =

    mysqli_query(
    $conn,
    $query
    );

    if(mysqli_num_rows($result) > 0){

        $user =

        mysqli_fetch_assoc(
        $result
        );

        /* =================================================
        VERIFY PASSWORD
        ================================================== */

        if(password_verify(

            $password,
            $user['password']

        )){

            $_SESSION['user_id'] =
            $user['id'];

            $_SESSION['user_name'] =
            $user['full_name'];

            $_SESSION['user_email'] =
            $user['email'];

            $_SESSION['user_phone'] =
            $user['phone'];

            header(
            "Location: home.php"
            );

            exit();

        }

        else{

            $message =
            "Wrong password.";

        }

    }

    else{

        $message =
        "Account not found.";

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

Hungroo Login

</title>

<!-- FONT -->

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- ICON -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

/* =========================================================
ROOT
========================================================= */

:root{

    --primary:#ff9a3d;
    --gold:#ffd27a;
    --dark:#050505;
    --card:rgba(255,255,255,.05);
    --border:rgba(255,255,255,.08);
    --white:#ffffff;
    --text:#aaaaaa;

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

/* =========================================================
BACKGROUND
========================================================= */

.blur-circle{

    position:absolute;

    border-radius:50%;

    filter:blur(120px);

    opacity:.18;

    z-index:1;

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

/* =========================================================
CARD
========================================================= */

.login-card{

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

/* =========================================================
ANIMATION
========================================================= */

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

/* =========================================================
LOGO
========================================================= */

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

/* =========================================================
TEXT
========================================================= */

.subtitle{

    text-align:center;

    color:var(--text);

    line-height:1.8;

    margin-bottom:35px;

    font-size:15px;

}

/* =========================================================
MESSAGE
========================================================= */

.message{

    margin-bottom:24px;

    padding:16px;

    border-radius:18px;

    text-align:center;

    font-size:14px;

    background:
    rgba(76,175,80,.1);

    border:
    1px solid rgba(76,175,80,.2);

    color:#4caf50;

}

/* =========================================================
INPUT GROUP
========================================================= */

.input-group{

    margin-bottom:24px;

}

.input-group label{

    display:block;

    margin-bottom:10px;

    font-size:14px;

    color:#fff;

    font-weight:500;

}

/* =========================================================
INPUT BOX
========================================================= */

.input-box{

    position:relative;

}

.input-box .left-icon{

    position:absolute;

    top:50%;
    left:20px;

    transform:
    translateY(-50%);

    color:#999;

    font-size:15px;

}

.input-box input{

    width:100%;
    height:65px;

    border:none;
    outline:none;

    border-radius:22px;

    padding:
    0 58px 0 58px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid rgba(255,255,255,.08);

    color:#fff;

    font-size:14px;

    transition:.35s;

}

.input-box input:focus{

    border:
    1px solid var(--primary);

    box-shadow:
    0 0 0 4px rgba(255,154,61,.12);

    transform:
    translateY(-2px);

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

    font-size:16px;

}

.toggle-password:hover{

    color:var(--gold);

}

/* =========================================================
BUTTON
========================================================= */

.login-btn{

    width:100%;
    height:65px;

    border:none;

    cursor:pointer;

    border-radius:22px;

    margin-top:8px;

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

    position:relative;

    overflow:hidden;

}

.login-btn::before{

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

.login-btn:hover::before{

    left:100%;

}

.login-btn:hover{

    transform:
    translateY(-4px);

    box-shadow:
    0 12px 30px rgba(255,154,61,.35);

}

/* =========================================================
BOTTOM LINKS
========================================================= */

.bottom-links{

    margin-top:28px;

    display:flex;

    justify-content:space-between;

    gap:20px;

    flex-wrap:wrap;

}

.bottom-links a{

    color:var(--gold);

    text-decoration:none;

    font-size:14px;

    transition:.3s;

    position:relative;

}

.bottom-links a::after{

    content:"";

    position:absolute;

    left:0;
    bottom:-3px;

    width:0%;
    height:2px;

    background:var(--gold);

    transition:.3s;

}

.bottom-links a:hover::after{

    width:100%;

}

.bottom-links a:hover{

    color:#fff;

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:600px){

    .login-card{

        padding:35px 24px;

        border-radius:28px;

    }

    .logo h1{

        font-size:42px;

    }

}

</style>

</head>

<body>

<!-- BACKGROUND -->

<div class="blur-circle blur-1"></div>
<div class="blur-circle blur-2"></div>

<!-- CARD -->

<div class="login-card">

    <!-- LOGO -->

    <div class="logo">

        <h1>

            Hungroo

        </h1>

    </div>

    <!-- SUBTITLE -->

    <p class="subtitle">

        Welcome back 👋<br>
        Login to continue your premium café experience.

    </p>

    <!-- MESSAGE -->

    <?php if(!empty($message)): ?>

    <div class="message">

        <?php echo $message; ?>

    </div>

    <?php endif; ?>

    <!-- FORM -->

    <form method="POST">

        <!-- EMAIL -->

        <div class="input-group">

            <label>

                Email or Phone

            </label>

            <div class="input-box">

                <i class="fa-solid fa-user left-icon"></i>

                <input
                type="text"

                name="email_or_phone"

                placeholder="Enter email or phone"

                required>

            </div>

        </div>

        <!-- PASSWORD -->

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

                placeholder="Enter password"

                required>

                <span
                class="toggle-password"

                onclick="togglePassword()">

                    <i
                    id="eyeIcon"

                    class="fa-solid fa-eye"></i>

                </span>

            </div>

        </div>

        <!-- BUTTON -->

        <button
        type="submit"

        name="login"

        class="login-btn">

            Login Account

        </button>

    </form>

    <!-- LINKS -->

    <div class="bottom-links">

        <a href="send-otp.php">

            Create Account

        </a>

        <a href="forgot-password.php">

            Forgot Password?

        </a>

    </div>

</div>

<!-- SCRIPT -->

<script>

function togglePassword(){

    const passwordInput =

    document.getElementById(
    "password"
    );

    const eyeIcon =

    document.getElementById(
    "eyeIcon"
    );

    if(passwordInput.type === "password"){

        passwordInput.type =
        "text";

        eyeIcon.classList.remove(
        "fa-eye"
        );

        eyeIcon.classList.add(
        "fa-eye-slash"
        );

    }

    else{

        passwordInput.type =
        "password";

        eyeIcon.classList.remove(
        "fa-eye-slash"
        );

        eyeIcon.classList.add(
        "fa-eye"
        );

    }

}

</script>

</body>
</html>