<?php

session_start();

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Gift Cards";

/* =========================================================
GIFT CARDS
========================================================= */

$giftCards = [

    [
        "amount" => "₹500",
        "title"  => "Starter Treat",
        "text"   => "Perfect for coffee, desserts and snacks."
    ],

    [
        "amount" => "₹1000",
        "title"  => "Premium Feast",
        "text"   => "Ideal for burgers, pizzas and café combos."
    ],

    [
        "amount" => "₹2500",
        "title"  => "Luxury Dining",
        "text"   => "Best for parties, celebrations and gifting."
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

.gift-page{

    width:100%;

    max-width:1400px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.gift-top{

    text-align:center;

    margin-bottom:54px;

}

.gift-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.gift-top h1{

    font-size:
    clamp(38px,6vw,78px);

    margin:
    10px 0 16px;

}

.gift-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
GRID
===================================================== */

.gift-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(320px,1fr));

    gap:28px;

}

/* =====================================================
CARD
===================================================== */

.gift-card{

    position:relative;

    overflow:hidden;

    padding:34px;

    border-radius:34px;

    background:
    linear-gradient(
    135deg,
    rgba(255,154,61,.12),
    rgba(255,210,122,.05)
    );

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    transition:.35s;

}

.gift-card:hover{

    transform:
    translateY(-10px);

}

/* =====================================================
ICON
===================================================== */

.gift-icon{

    width:90px;
    height:90px;

    margin-bottom:26px;

    border-radius:28px;

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

    font-size:36px;

}

/* =====================================================
AMOUNT
===================================================== */

.gift-amount{

    font-size:54px;

    font-weight:800;

    margin-bottom:14px;

    line-height:1;

}

/* =====================================================
TEXT
===================================================== */

.gift-card h2{

    font-size:30px;

    margin-bottom:14px;

}

.gift-card p{

    color:var(--text);

    line-height:1.9;

    margin-bottom:30px;

}

/* =====================================================
BUTTON
===================================================== */

.gift-btn{

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

.gift-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
TAG
===================================================== */

.gift-tag{

    position:absolute;

    top:18px;
    right:-42px;

    width:160px;

    text-align:center;

    padding:
    10px 0;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:12px;

    font-weight:700;

    transform:
    rotate(45deg);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .gift-page{

        padding:
        120px 14px 70px;

    }

    .gift-grid{

        grid-template-columns:1fr;

    }

    .gift-card{

        padding:24px 20px;

        border-radius:26px;

    }

    .gift-icon{

        width:76px;
        height:76px;

        border-radius:22px;

        font-size:30px;

    }

    .gift-amount{

        font-size:42px;

    }

    .gift-card h2{

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

<main class="gift-page">

    <!-- TOP -->

    <div class="gift-top">

        <span>

            Premium Gifting

        </span>

        <h1>

            Gift Cards

        </h1>

        <p>

            Surprise your friends and family
            with premium Hungroo Café gift cards
            for luxury dining experiences.

        </p>

    </div>

    <!-- GRID -->

    <div class="gift-grid">

        <?php foreach($giftCards as $card): ?>

        <article class="gift-card">

            <div class="gift-tag">

                PREMIUM

            </div>

            <!-- ICON -->

            <div class="gift-icon">

                <i class="fa-solid fa-gift"></i>

            </div>

            <!-- AMOUNT -->

            <div class="gift-amount">

                <?php echo $card['amount']; ?>

            </div>

            <!-- TEXT -->

            <h2>

                <?php echo $card['title']; ?>

            </h2>

            <p>

                <?php echo $card['text']; ?>

            </p>

            <!-- BUTTON -->

            <button class="gift-btn">

                Buy Gift Card

            </button>

        </article>

        <?php endforeach; ?>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>