<?php

session_start();

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Payment Methods";

/* =========================================================
PAYMENT METHODS
========================================================= */

$paymentMethods = [

    [
        "icon"  => "fa-credit-card",
        "title" => "Credit / Debit Card",
        "text"  => "Pay securely using Visa, Mastercard and RuPay cards.",
        "status"=> "Connected"
    ],

    [
        "icon"  => "fa-mobile-screen",
        "title" => "UPI Payment",
        "text"  => "Pay instantly with Google Pay, PhonePe and Paytm.",
        "status"=> "Active"
    ],

    [
        "icon"  => "fa-wallet",
        "title" => "Digital Wallet",
        "text"  => "Use your wallet balance for faster checkout.",
        "status"=> "Available"
    ],

    [
        "icon"  => "fa-money-bill-wave",
        "title" => "Cash On Delivery",
        "text"  => "Pay with cash after receiving your premium order.",
        "status"=> "Enabled"
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

.payment-page{

    width:100%;

    max-width:1350px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.payment-top{

    text-align:center;

    margin-bottom:50px;

}

.payment-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.payment-top h1{

    font-size:
    clamp(38px,6vw,76px);

    margin:
    10px 0 16px;

}

.payment-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
GRID
===================================================== */

.payment-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(300px,1fr));

    gap:26px;

}

/* =====================================================
CARD
===================================================== */

.payment-card{

    padding:30px;

    border-radius:32px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    transition:.35s;

}

.payment-card:hover{

    transform:
    translateY(-8px);

}

/* =====================================================
ICON
===================================================== */

.payment-icon{

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

.payment-card h2{

    font-size:28px;

    margin-bottom:14px;

}

.payment-card p{

    color:var(--text);

    line-height:1.9;

    margin-bottom:24px;

}

/* =====================================================
BOTTOM
===================================================== */

.payment-bottom{

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:16px;

    flex-wrap:wrap;

}

/* =====================================================
STATUS
===================================================== */

.payment-status{

    display:inline-flex;

    align-items:center;

    gap:8px;

    padding:
    10px 16px;

    border-radius:999px;

    background:
    rgba(46,204,113,.12);

    border:
    1px solid rgba(46,204,113,.2);

    color:var(--green);

    font-size:13px;

    font-weight:600;

}

/* =====================================================
BUTTON
===================================================== */

.payment-btn{

    height:52px;

    padding:
    0 22px;

    border:none;

    cursor:pointer;

    border-radius:18px;

    font-size:14px;

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

.payment-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .payment-page{

        padding:
        120px 14px 70px;

    }

    .payment-grid{

        grid-template-columns:1fr;

    }

    .payment-card{

        padding:22px 18px;

        border-radius:24px;

    }

    .payment-card h2{

        font-size:24px;

    }

    .payment-bottom{

        flex-direction:column;

        align-items:flex-start;

    }

    .payment-btn{

        width:100%;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="payment-page">

    <!-- TOP -->

    <div class="payment-top">

        <span>

            Secure Checkout

        </span>

        <h1>

            Payment Methods

        </h1>

        <p>

            Choose your preferred payment
            option for a smooth and secure
            Hungroo Café ordering experience.

        </p>

    </div>

    <!-- GRID -->

    <div class="payment-grid">

        <?php foreach($paymentMethods as $method): ?>

        <article class="payment-card">

            <!-- ICON -->

            <div class="payment-icon">

                <i class="fa-solid <?php echo $method['icon']; ?>"></i>

            </div>

            <!-- TEXT -->

            <h2>

                <?php echo $method['title']; ?>

            </h2>

            <p>

                <?php echo $method['text']; ?>

            </p>

            <!-- BOTTOM -->

            <div class="payment-bottom">

                <div class="payment-status">

                    <i class="fa-solid fa-circle-check"></i>

                    <?php echo $method['status']; ?>

                </div>

                <button class="payment-btn">

                    Select

                </button>

            </div>

        </article>

        <?php endforeach; ?>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>