<?php

session_start();

/* =========================================================
CONFIG
========================================================= */

include "../config/config.php";

/* =========================================================
LOGIN
========================================================= */

$error = "";

if(isset($_POST['admin_login'])){

    $admin_email =

    mysqli_real_escape_string(
    $conn,
    $_POST['admin_email']
    );

    $admin_password =

    md5(
    $_POST['admin_password']
    );

    /* =====================================================
    CHECK ADMIN
    ====================================================== */

    $query =

    "SELECT * FROM admins

    WHERE admin_email='$admin_email'

    AND admin_password='$admin_password'

    LIMIT 1";

    $result =

    mysqli_query(
    $conn,
    $query
    );

    /* =====================================================
    LOGIN SUCCESS
    ====================================================== */

    if(mysqli_num_rows($result) > 0){

        $admin =

        mysqli_fetch_assoc(
        $result
        );

        $_SESSION['admin_id'] =
        $admin['id'];

        $_SESSION['admin_name'] =
        $admin['admin_name'];

        header(
        "Location: dashboard.php"
        );

        exit();

    }

    /* =====================================================
    LOGIN FAILED
    ====================================================== */

    else{

        $error =
        "Admin Not Found";

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

Admin Login

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

    --bg:#070707;

    --card:#121212;

    --white:#ffffff;

    --text:#bdbdbd;

    --primary:#ff9a3d;

    --gold:#ffd27a;

    --border:
    rgba(255,255,255,.08);

}

/* =========================================================
RESET
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

    background:
    radial-gradient(
    circle at top,
    rgba(255,154,61,.15),
    transparent 30%
    ),
    #070707;

    font-family:'Poppins',sans-serif;

    overflow:hidden;

    padding:20px;

}

/* =========================================================
LOGIN BOX
========================================================= */

.login-box{

    width:100%;
    max-width:460px;

    padding:40px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(20px);

}

/* =========================================================
LOGO
========================================================= */

.login-logo{

    text-align:center;

    margin-bottom:34px;

}

.login-logo img{

    width:90px;
    height:90px;

    border-radius:28px;

    object-fit:cover;

    margin-bottom:20px;

}

.login-logo h1{

    font-size:42px;

    margin-bottom:10px;

}

.login-logo span{

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

.login-logo p{

    color:var(--text);

    font-size:14px;

}

/* =========================================================
ERROR
========================================================= */

.error-box{

    margin-bottom:20px;

    padding:16px;

    border-radius:18px;

    background:
    rgba(255,77,77,.12);

    border:
    1px solid rgba(255,77,77,.18);

    color:#ff4d4d;

    font-size:14px;

    font-weight:600;

}

/* =========================================================
FORM
========================================================= */

.form-group{

    margin-bottom:22px;

}

.form-group label{

    display:block;

    margin-bottom:10px;

    font-size:14px;

    font-weight:600;

    color:#fff;

}

.form-group input{

    width:100%;

    height:62px;

    border:none;

    outline:none;

    padding:
    0 18px;

    border-radius:18px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:#fff;

    font-size:14px;

    font-family:'Poppins',sans-serif;

}

.form-group input::placeholder{

    color:#777;

}

/* =========================================================
BUTTON
========================================================= */

.login-btn{

    width:100%;

    height:62px;

    border:none;

    cursor:pointer;

    border-radius:18px;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:15px;

    font-weight:800;

    transition:.35s;

}

.login-btn:hover{

    transform:
    translateY(-4px);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:768px){

    .login-box{

        padding:28px;

        border-radius:26px;

    }

    .login-logo h1{

        font-size:34px;

    }

}

</style>

</head>

<body>

<div class="login-box">

    <!-- LOGO -->

    <div class="login-logo">

        <img
        src="../assets/images/logo.png"
        alt="Logo">

        <h1>

            <span>

                Hungroo

            </span>

            Admin

        </h1>

        <p>

            Login to manage your café

        </p>

    </div>

    <!-- ERROR -->

    <?php if(!empty($error)): ?>

    <div class="error-box">

        <?php echo $error; ?>

    </div>

    <?php endif; ?>

    <!-- FORM -->

    <form method="POST">

        <div class="form-group">

            <label>

                Admin Email

            </label>

            <input
            type="email"

            name="admin_email"

            placeholder="Enter admin email"

            required>

        </div>

        <div class="form-group">

            <label>

                Password

            </label>

            <input
            type="password"

            name="admin_password"

            placeholder="Enter password"

            required>

        </div>

        <button
        type="submit"

        name="admin_login"

        class="login-btn">

            Login Admin

        </button>

    </form>

</div>

</body>
</html>