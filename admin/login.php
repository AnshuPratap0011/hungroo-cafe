<?php
session_start();

if(isset($_SESSION['admin_id'])){

    header("Location: dashboard.php");
    exit();

}

$error = "";

/* =========================================================
DEFAULT ADMIN LOGIN
========================================================= */

$default_email =
"hungroocafe@gmail.com";

$default_password =
"Hungroo@112";

/* =========================================================
LOGIN
========================================================= */

if(isset($_POST['admin_login'])){

    $email =
    trim($_POST['email']);

    $password =
    trim($_POST['password']);

    if(
    empty($email)
    ||
    empty($password)
    ){

        $error =
        "Please fill all fields";

    }

    else{

        if(
        $email === $default_email
        &&
        $password === $default_password
        ){

            $_SESSION['admin_id'] =
            1;

            $_SESSION['admin_name'] =
            "Hungroo Admin";

            $_SESSION['admin_email'] =
            $email;

            header("Location: dashboard.php");
            exit();

        }

        else{

            $error =
            "Invalid Email or Password";

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
Hungroo Café Admin Login
</title>

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

:root{

    --bg:#09090b;
    --card:#17171c;
    --card2:#1f1f26;
    --text:#ffffff;
    --text2:#a1a1aa;
    --border:rgba(255,255,255,.08);

    --purple:#6C5CE7;
    --purple2:#8B7BFF;

}

*{

    margin:0;
    padding:0;
    box-sizing:border-box;

}

body{

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    radial-gradient(
    circle at top left,
    rgba(108,92,231,.18),
    transparent 35%
    ),

    radial-gradient(
    circle at bottom right,
    rgba(108,92,231,.12),
    transparent 35%
    ),

    #09090b;

    font-family:'Poppins',sans-serif;

    overflow:hidden;

}

/* =========================================================
BACKGROUND BLOBS
========================================================= */

.blob{

    position:absolute;
    border-radius:50%;
    filter:blur(120px);
    z-index:0;

}

.blob1{

    width:400px;
    height:400px;

    background:
    rgba(108,92,231,.18);

    top:-120px;
    left:-120px;

}

.blob2{

    width:350px;
    height:350px;

    background:
    rgba(0,184,148,.10);

    bottom:-120px;
    right:-100px;

}

/* =========================================================
LOGIN CARD
========================================================= */

.login-wrapper{

    width:100%;
    max-width:470px;

    padding:20px;

    position:relative;
    z-index:2;

}

.login-card{

    background:
    rgba(23,23,28,.88);

    backdrop-filter:
    blur(24px);

    border:
    1px solid var(--border);

    border-radius:32px;

    padding:42px;

    box-shadow:
    0 25px 60px rgba(0,0,0,.35);

}

/* =========================================================
TOP
========================================================= */

.admin-logo{

    width:95px;
    height:95px;

    border-radius:28px;

    background:
    linear-gradient(
    135deg,
    var(--purple),
    var(--purple2)
    );

    display:flex;
    justify-content:center;
    align-items:center;

    margin:auto;
    margin-bottom:24px;

    box-shadow:
    0 15px 35px
    rgba(108,92,231,.35);

}

.admin-logo i{

    color:#fff;
    font-size:42px;

}

.login-title{

    text-align:center;
    color:#fff;

    font-size:32px;
    font-weight:800;

    margin-bottom:8px;

}

.login-subtitle{

    text-align:center;
    color:var(--text2);

    font-size:14px;

    margin-bottom:30px;

}

/* =========================================================
ERROR
========================================================= */

.error-box{

    background:
    rgba(255,0,0,.08);

    border:
    1px solid rgba(255,0,0,.20);

    color:#ff6b6b;

    padding:14px 16px;

    border-radius:14px;

    margin-bottom:18px;

    text-align:center;

    font-size:13px;

}

/* =========================================================
INPUTS
========================================================= */

.input-group{

    margin-bottom:18px;

}

.input-label{

    color:#d4d4d8;

    font-size:13px;
    font-weight:600;

    margin-bottom:8px;

    display:block;

}

.input-box{

    height:58px;

    border-radius:18px;

    background:
    rgba(255,255,255,.03);

    border:
    1px solid rgba(255,255,255,.08);

    display:flex;
    align-items:center;

    padding:0 18px;

    transition:.3s;

}

.input-box:focus-within{

    border-color:
    rgba(108,92,231,.55);

    box-shadow:
    0 0 0 4px
    rgba(108,92,231,.12);

}

.input-box i{

    color:#9ca3af;

    margin-right:12px;

}

.input-box input{

    width:100%;

    background:none;
    border:none;
    outline:none;

    color:#fff;

    font-size:14px;

}

.input-box input::placeholder{

    color:#6b7280;

}

/* =========================================================
BUTTON
========================================================= */

.login-btn{

    width:100%;
    height:58px;

    border:none;
    border-radius:18px;

    background:
    linear-gradient(
    135deg,
    var(--purple),
    var(--purple2)
    );

    color:#fff;

    font-size:15px;
    font-weight:700;

    cursor:pointer;

    transition:.3s;

    margin-top:6px;

}

.login-btn:hover{

    transform:
    translateY(-2px);

    box-shadow:
    0 15px 30px
    rgba(108,92,231,.30);

}

/* =========================================================
LOGIN INFO
========================================================= */

.info-box{

    margin-top:22px;

    padding:16px;

    border-radius:18px;

    background:
    rgba(255,255,255,.03);

    border:
    1px solid rgba(255,255,255,.06);

}

.info-title{

    color:#fff;
    font-size:13px;
    font-weight:700;

    margin-bottom:10px;

}

.info-item{

    color:#a1a1aa;
    font-size:12px;

    margin-bottom:5px;

}

.info-item span{

    color:#fff;
    font-weight:600;

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:520px){

    .login-card{

        padding:30px 22px;

        border-radius:24px;

    }

    .admin-logo{

        width:82px;
        height:82px;

    }

    .admin-logo i{

        font-size:35px;

    }

    .login-title{

        font-size:26px;

    }

}

</style>

</head>

<body>

<div class="blob blob1"></div>
<div class="blob blob2"></div>

<div class="login-wrapper">

    <div class="login-card">

        <div class="admin-logo">

            <i class="fa-solid fa-user-shield"></i>

        </div>

        <h1 class="login-title">

            Admin Login

        </h1>

        <p class="login-subtitle">

            Hungroo Café Dashboard Access

        </p>

        <?php if(!empty($error)): ?>

        <div class="error-box">

            <?php echo $error; ?>

        </div>

        <?php endif; ?>

        <form method="POST">

            <div class="input-group">

                <label class="input-label">

                    Email Address

                </label>

                <div class="input-box">

                    <i class="fa-solid fa-envelope"></i>

                    <input
                    type="email"
                    name="email"
                    placeholder="Enter admin email"
                    required>

                </div>

            </div>

            <div class="input-group">

                <label class="input-label">

                    Password

                </label>

                <div class="input-box">

                    <i class="fa-solid fa-lock"></i>

                    <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    required>

                </div>

            </div>

            <button
            type="submit"
            name="admin_login"
            class="login-btn">

                Login To Dashboard

            </button>

        </form>

        <div class="info-box">

            <div class="info-title">

                Default Admin Login

            </div>

            <div class="info-item">

                Email:
                <span>
                hungroocafe@gmail.com
                </span>

            </div>

            <div class="info-item">

                Password:
                <span>
                Hungroo@112
                </span>

            </div>

        </div>

    </div>

</div>

</body>
</html>