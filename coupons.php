<?php

session_start();

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Coupons";

/* =========================================================
COUPONS
========================================================= */

$coupons = [

    [
        "code"   => "HUNGROO50",
        "title"  => "Flat 50% OFF",
        "text"   => "Get flat 50% OFF on premium burger combos.",
        "offer"  => "50% OFF"
    ],

    [
        "code"   => "COFFEE20",
        "title"  => "Coffee Lover Deal",
        "text"   => "Enjoy 20% OFF on all handcrafted coffees.",
        "offer"  => "20% OFF"
    ],

    [
        "code"   => "FREEDEL",
        "title"  => "Free Delivery",
        "text"   => "Get free delivery on orders above ₹499.",
        "offer"  => "FREE"
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

    --green:#2ecc71;

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

.coupon-page{

    width:100%;

    max-width:1400px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.coupon-top{

    text-align:center;

    margin-bottom:54px;

}

.coupon-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.coupon-top h1{

    font-size:
    clamp(38px,6vw,78px);

    margin:
    10px 0 16px;

}

.coupon-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
GRID
===================================================== */

.coupon-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(320px,1fr));

    gap:28px;

}

/* =====================================================
CARD
===================================================== */

.coupon-card{

    position:relative;

    overflow:hidden;

    padding:34px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    transition:.35s;

}

.coupon-card:hover{

    transform:
    translateY(-10px);

}

/* =====================================================
OFFER
===================================================== */

.coupon-offer{

    position:absolute;

    top:18px;
    right:18px;

    padding:
    10px 16px;

    border-radius:999px;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:13px;

    font-weight:700;

}

/* =====================================================
ICON
===================================================== */

.coupon-icon{

    width:86px;
    height:86px;

    margin-bottom:24px;

    border-radius:26px;

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

    font-size:34px;

}

/* =====================================================
TEXT
===================================================== */

.coupon-code{

    display:inline-flex;

    align-items:center;

    gap:8px;

    padding:
    12px 18px;

    border-radius:999px;

    margin-bottom:20px;

    background:
    rgba(46,204,113,.12);

    border:
    1px solid rgba(46,204,113,.2);

    color:var(--green);

    font-size:14px;

    font-weight:700;

}

.coupon-card h2{

    font-size:30px;

    margin-bottom:14px;

}

.coupon-card p{

    color:var(--text);

    line-height:1.9;

    margin-bottom:28px;

}

/* =====================================================
BUTTON
===================================================== */

.coupon-btn{

    width:100%;

    height:58px;

    border:none;

    cursor:pointer;

    border-radius:20px;

    font-size:15px;

    font-weight:700;

    transition:.35s;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

}

.coupon-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .coupon-page{

        padding:
        120px 14px 70px;

    }

    .coupon-grid{

        grid-template-columns:1fr;

    }

    .coupon-card{

        padding:24px 20px;

        border-radius:26px;

    }

    .coupon-icon{

        width:76px;
        height:76px;

        border-radius:22px;

        font-size:30px;

    }

    .coupon-card h2{

        font-size:24px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="coupon-page">

    <!-- TOP -->

    <div class="coupon-top">

        <span>

            Premium Discounts

        </span>

        <h1>

            Coupons & Offers

        </h1>

        <p>

            Unlock exclusive Hungroo Café
            discounts, free delivery and
            premium combo meal offers.

        </p>

    </div>

    <!-- GRID -->

    <div class="coupon-grid">

        <?php foreach($coupons as $coupon): ?>

        <article class="coupon-card">

            <div class="coupon-offer">

                <?php echo $coupon['offer']; ?>

            </div>

            <!-- ICON -->

            <div class="coupon-icon">

                <i class="fa-solid fa-ticket"></i>

            </div>

            <!-- CODE -->

            <div class="coupon-code">

                <i class="fa-solid fa-copy"></i>

                <?php echo $coupon['code']; ?>

            </div>

            <!-- TEXT -->

            <h2>

                <?php echo $coupon['title']; ?>

            </h2>

            <p>

                <?php echo $coupon['text']; ?>

            </p>

            <!-- BUTTON -->

            <button class="coupon-btn">

                Apply Coupon

            </button>

        </article>

        <?php endforeach; ?>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>