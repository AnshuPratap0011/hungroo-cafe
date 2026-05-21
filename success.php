<?php

session_start();

/* =========================================================
ORDER CHECK
========================================================= */

if(!isset($_SESSION['success_order'])){

    header(
    "Location: home.php"
    );

    exit();

}

$order_id =

$_SESSION['success_order'];

/* =========================================================
REMOVE SESSION
========================================================= */

unset(
$_SESSION['success_order']
);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Order Success

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

    padding:20px;

    overflow:hidden;

    background:#070707;

    color:#fff;

    font-family:'Poppins',sans-serif;

}

/* =========================================================
BLUR
========================================================= */

.blur{

    position:absolute;

    border-radius:50%;

    filter:blur(120px);

    opacity:.18;

    z-index:-1;

}

.blur-1{

    width:320px;
    height:320px;

    background:#ff9a3d;

    top:-100px;
    left:-100px;

}

.blur-2{

    width:320px;
    height:320px;

    background:#ffd27a;

    bottom:-100px;
    right:-100px;

}

/* =========================================================
BOX
========================================================= */

.success-box{

    width:100%;

    max-width:620px;

    padding:50px 36px;

    border-radius:34px;

    text-align:center;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid rgba(255,255,255,.08);

    backdrop-filter:
    blur(16px);

    box-shadow:
    0 20px 60px rgba(0,0,0,.45);

}

/* =========================================================
ICON
========================================================= */

.success-icon{

    width:120px;
    height:120px;

    margin:auto auto 30px;

    border-radius:50%;

    display:flex;

    align-items:center;
    justify-content:center;

    background:
    linear-gradient(
    135deg,
    #ff9a3d,
    #ffd27a
    );

    animation:
    pop .8s ease;

}

.success-icon i{

    font-size:56px;

    color:#000;

}

/* =========================================================
TITLE
========================================================= */

.success-box h1{

    font-size:52px;

    margin-bottom:18px;

}

.success-box p{

    color:#cfcfcf;

    line-height:1.9;

    font-size:15px;

    margin-bottom:30px;

}

/* =========================================================
ORDER ID
========================================================= */

.order-id{

    width:max-content;

    margin:auto auto 34px;

    padding:
    16px 24px;

    border-radius:18px;

    background:
    rgba(255,154,61,.10);

    border:
    1px solid rgba(255,154,61,.14);

    color:#ffb15e;

    font-size:15px;

    font-weight:700;

}

/* =========================================================
BUTTONS
========================================================= */

.success-buttons{

    display:flex;

    align-items:center;
    justify-content:center;

    gap:16px;

    flex-wrap:wrap;

}

.success-btn{

    min-width:210px;

    height:58px;

    padding:
    0 24px;

    border:none;

    outline:none;

    cursor:pointer;

    border-radius:18px;

    display:flex;

    align-items:center;
    justify-content:center;

    gap:10px;

    text-decoration:none;

    transition:.35s;

    font-size:14px;

    font-weight:700;

}

.primary-btn{

    background:
    linear-gradient(
    135deg,
    #ff9a3d,
    #ffd27a
    );

    color:#000;

}

.secondary-btn{

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);

    color:#fff;

}

.success-btn:hover{

    transform:
    translateY(-4px);

}

/* =========================================================
ANIMATION
========================================================= */

@keyframes pop{

    0%{

        transform:
        scale(.5);

        opacity:0;

    }

    100%{

        transform:
        scale(1);

        opacity:1;

    }

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:768px){

    .success-box{

        padding:42px 22px;

        border-radius:26px;

    }

    .success-box h1{

        font-size:38px;

    }

    .success-icon{

        width:100px;
        height:100px;

    }

    .success-icon i{

        font-size:46px;

    }

}

@media(max-width:480px){

    .success-buttons{

        flex-direction:column;

    }

    .success-btn{

        width:100%;

    }

}

</style>

</head>

<body>

<!-- =========================================================
BLUR
========================================================= -->

<div class="blur blur-1"></div>
<div class="blur blur-2"></div>

<!-- =========================================================
SUCCESS BOX
========================================================= -->

<div class="success-box">

    <!-- ICON -->

    <div class="success-icon">

        <i class="fa-solid fa-check"></i>

    </div>

    <!-- TITLE -->

    <h1>

        Order Placed!

    </h1>

    <!-- TEXT -->

    <p>

        Thank you for ordering from
        Hungroo Café.

        Your delicious food is being
        prepared and will arrive soon.

    </p>

    <!-- ORDER ID -->

    <div class="order-id">

        Order ID :
        #<?php echo $order_id; ?>

    </div>

    <!-- BUTTONS -->

    <div class="success-buttons">

        <a
        href="home.php"

        class="success-btn primary-btn">

            <i class="fa-solid fa-house"></i>

            Back To Home

        </a>

        <a
        href="menu.php"

        class="success-btn secondary-btn">

            <i class="fa-solid fa-utensils"></i>

            Order More

        </a>

    </div>

</div>

<!-- =========================================================
CLEAR CART
========================================================= -->

<script>

localStorage.removeItem(
"cart"
);

</script>

</body>
</html>