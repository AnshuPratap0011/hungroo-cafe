<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Terms & Conditions";

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

.terms-page{

    width:100%;

    max-width:1150px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.terms-top{

    text-align:center;

    margin-bottom:50px;

}

.terms-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.terms-top h1{

    font-size:
    clamp(38px,6vw,76px);

    margin:
    10px 0 16px;

    line-height:1.1;

}

.terms-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
CONTENT
===================================================== */

.terms-content{

    display:flex;

    flex-direction:column;

    gap:24px;

}

/* =====================================================
CARD
===================================================== */

.terms-card{

    padding:32px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    overflow:hidden;

}

/* =====================================================
HEADINGS
===================================================== */

.terms-card h2{

    font-size:32px;

    margin-bottom:18px;

    line-height:1.3;

}

.terms-card p{

    color:var(--text);

    line-height:2;

    margin-bottom:16px;

    word-break:break-word;

}

.terms-card p:last-child{

    margin-bottom:0;

}

/* =====================================================
LIST
===================================================== */

.terms-list{

    display:flex;

    flex-direction:column;

    gap:14px;

    margin-top:20px;

    padding-left:18px;

}

.terms-list li{

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
HIGHLIGHT
===================================================== */

.terms-highlight{

    color:var(--primary);

    font-weight:600;

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .terms-page{

        padding:
        120px 14px 70px;

    }

    .terms-card{

        padding:22px 18px;

        border-radius:24px;

    }

    .terms-card h2{

        font-size:26px;

    }

    .terms-top h1{

        line-height:1.2;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="terms-page">

    <!-- TOP -->

    <div class="terms-top">

        <span>

            Legal Agreement

        </span>

        <h1>

            Terms & Conditions

        </h1>

        <p>

            Please read these terms carefully
            before using Hungroo Café services,
            ordering food or booking tables.

        </p>

    </div>

    <!-- CONTENT -->

    <section class="terms-content">

        <!-- CARD -->

        <article class="terms-card">

            <h2>

                Acceptance Of Terms

            </h2>

            <p>

                By accessing or using
                Hungroo Café services,
                you agree to comply with
                these terms and conditions.

            </p>

            <p>

                If you do not agree with
                any part of these terms,
                please discontinue using
                our services immediately.

            </p>

        </article>

        <!-- CARD -->

        <article class="terms-card">

            <h2>

                Orders & Payments

            </h2>

            <p>

                All orders placed through
                Hungroo Café are subject
                to availability and confirmation.

            </p>

            <ul class="terms-list">

                <li>

                    Prices may change without notice

                </li>

                <li>

                    Payments must be completed securely

                </li>

                <li>

                    Fraudulent activities are prohibited

                </li>

                <li>

                    Refund eligibility depends on policy

                </li>

            </ul>

        </article>

        <!-- CARD -->

        <article class="terms-card">

            <h2>

                Reservations & Bookings

            </h2>

            <p>

                Customers booking tables
                should arrive on time.
                Delayed arrivals may lead
                to automatic cancellation.

            </p>

            <p>

                Hungroo Café reserves the right
                to modify seating arrangements
                during peak hours.

            </p>

        </article>

        <!-- CARD -->

        <article class="terms-card">

            <h2>

                User Responsibilities

            </h2>

            <p>

                Users must provide accurate
                account and delivery information.

            </p>

            <ul class="terms-list">

                <li>

                    Respect staff and customers

                </li>

                <li>

                    Avoid misuse of website systems

                </li>

                <li>

                    Protect account credentials

                </li>

                <li>

                    Follow community guidelines

                </li>

            </ul>

        </article>

        <!-- CARD -->

        <article class="terms-card">

            <h2>

                Intellectual Property

            </h2>

            <p>

                All content, branding,
                logos and designs used
                by <span class="terms-highlight">

                Hungroo Café

                </span>
                are protected under
                intellectual property laws.

            </p>

        </article>

        <!-- CARD -->

        <article class="terms-card">

            <h2>

                Contact Information

            </h2>

            <p>

                For questions regarding
                these terms and conditions,
                contact our support team.

            </p>

            <p>

                Email:
                hungroo@gmail.com

            </p>

        </article>

    </section>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>