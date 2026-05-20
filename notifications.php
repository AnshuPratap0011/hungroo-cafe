<?php

session_start();

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Notifications";

/* =========================================================
DUMMY NOTIFICATIONS
========================================================= */

$notifications = [

    [
        "icon"  => "fa-burger",
        "title" => "Order Confirmed",
        "text"  => "Your premium burger combo order has been confirmed.",
        "time"  => "2 min ago"
    ],

    [
        "icon"  => "fa-motorcycle",
        "title" => "Order On The Way",
        "text"  => "Delivery partner is arriving with your order.",
        "time"  => "10 min ago"
    ],

    [
        "icon"  => "fa-gift",
        "title" => "Special Offer",
        "text"  => "Get 50% OFF on premium pizza combos today.",
        "time"  => "1 hour ago"
    ],

    [
        "icon"  => "fa-mug-hot",
        "title" => "New Café Drinks",
        "text"  => "Try our latest handcrafted coffee collection.",
        "time"  => "3 hours ago"
    ]

];

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

<?php echo $pageTitle; ?>

</title>

<!-- =====================================================
GOOGLE FONT
===================================================== -->

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

<!-- =====================================================
FONT AWESOME
===================================================== -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- =====================================================
CSS
===================================================== -->

<link
rel="stylesheet"
href="assets/css/navbar.css">

<link
rel="stylesheet"
href="assets/css/footer.css">

<link
rel="stylesheet"
href="assets/css/animations.css">

<link
rel="stylesheet"
href="assets/css/effects.css">

<style>

/* =====================================================
ROOT
===================================================== */

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

body.light-mode{

    --bg:#f5f5f7;

    --card:#ffffff;

    --white:#111111;

    --text:#666666;

    --border:
    rgba(0,0,0,.08);

}

/* =====================================================
RESET
===================================================== */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

/* =====================================================
BODY
===================================================== */

body{

    overflow-x:hidden;

    background:
    radial-gradient(
    circle at top right,
    rgba(255,154,61,.08),
    transparent 30%
    ),
    var(--bg);

    color:var(--white);

    font-family:'Poppins',sans-serif;

}

/* =====================================================
PAGE
===================================================== */

.notifications-page{

    width:100%;

    max-width:1200px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.notifications-top{

    text-align:center;

    margin-bottom:50px;

}

.notifications-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.notifications-top h1{

    font-size:
    clamp(38px,6vw,76px);

    margin:
    10px 0 16px;

}

.notifications-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
LIST
===================================================== */

.notifications-list{

    display:flex;

    flex-direction:column;

    gap:22px;

}

/* =====================================================
CARD
===================================================== */

.notification-card{

    display:flex;

    align-items:flex-start;

    gap:20px;

    padding:26px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    transition:.35s;

}

.notification-card:hover{

    transform:
    translateY(-6px);

}

/* =====================================================
ICON
===================================================== */

.notification-icon{

    width:72px;
    height:72px;

    flex-shrink:0;

    border-radius:22px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:28px;

}

/* =====================================================
CONTENT
===================================================== */

.notification-content{

    flex:1;

}

.notification-content h2{

    font-size:28px;

    margin-bottom:10px;

}

.notification-content p{

    color:var(--text);

    line-height:1.9;

    margin-bottom:14px;

}

/* =====================================================
TIME
===================================================== */

.notification-time{

    display:inline-flex;

    align-items:center;

    gap:8px;

    color:var(--primary);

    font-size:14px;

    font-weight:600;

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .notifications-page{

        padding:
        120px 14px 70px;

    }

    .notification-card{

        padding:20px 18px;

        border-radius:24px;

        gap:16px;

    }

    .notification-icon{

        width:58px;
        height:58px;

        border-radius:18px;

        font-size:22px;

    }

    .notification-content h2{

        font-size:22px;

    }

}

@media(max-width:520px){

    .notification-card{

        flex-direction:column;

        align-items:flex-start;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="notifications-page">

    <!-- TOP -->

    <div class="notifications-top">

        <span>

            Premium Updates

        </span>

        <h1>

            Notifications

        </h1>

        <p>

            Stay updated with your latest
            orders, exclusive offers and
            premium café announcements.

        </p>

    </div>

    <!-- LIST -->

    <section class="notifications-list">

        <?php foreach($notifications as $notification): ?>

        <article class="notification-card">

            <!-- ICON -->

            <div class="notification-icon">

                <i class="fa-solid <?php echo $notification['icon']; ?>"></i>

            </div>

            <!-- CONTENT -->

            <div class="notification-content">

                <h2>

                    <?php echo $notification['title']; ?>

                </h2>

                <p>

                    <?php echo $notification['text']; ?>

                </p>

                <div class="notification-time">

                    <i class="fa-regular fa-clock"></i>

                    <?php echo $notification['time']; ?>

                </div>

            </div>

        </article>

        <?php endforeach; ?>

    </section>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>