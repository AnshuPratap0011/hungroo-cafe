<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Privacy Policy";

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

.policy-page{

    width:100%;

    max-width:1100px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.policy-top{

    text-align:center;

    margin-bottom:50px;

}

.policy-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.policy-top h1{

    font-size:
    clamp(38px,6vw,76px);

    margin:
    10px 0 16px;

}

.policy-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
CONTENT
===================================================== */

.policy-content{

    display:flex;

    flex-direction:column;

    gap:24px;

}

/* =====================================================
CARD
===================================================== */

.policy-card{

    padding:30px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

}

/* =====================================================
HEADINGS
===================================================== */

.policy-card h2{

    font-size:32px;

    margin-bottom:18px;

}

.policy-card p{

    color:var(--text);

    line-height:2;

    margin-bottom:16px;

}

.policy-card p:last-child{

    margin-bottom:0;

}

/* =====================================================
LIST
===================================================== */

.policy-list{

    display:flex;

    flex-direction:column;

    gap:14px;

    margin-top:18px;

}

.policy-list li{

    color:var(--text);

    line-height:1.9;

    margin-left:18px;

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .policy-page{

        padding:
        120px 14px 70px;

    }

    .policy-card{

        padding:22px 18px;

        border-radius:24px;

    }

    .policy-card h2{

        font-size:26px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="policy-page">

    <!-- TOP -->

    <div class="policy-top">

        <span>

            Legal Information

        </span>

        <h1>

            Privacy Policy

        </h1>

        <p>

            Your privacy and data security
            are important to Hungroo Café.
            Please read our policy carefully.

        </p>

    </div>

    <!-- CONTENT -->

    <section class="policy-content">

        <!-- CARD -->

        <article class="policy-card">

            <h2>

                Information We Collect

            </h2>

            <p>

                We collect information
                such as your name,
                email address, phone number,
                delivery address and payment details
                to provide seamless services.

            </p>

            <ul class="policy-list">

                <li>

                    Account registration data

                </li>

                <li>

                    Order and booking information

                </li>

                <li>

                    Device and browser details

                </li>

            </ul>

        </article>

        <!-- CARD -->

        <article class="policy-card">

            <h2>

                How We Use Information

            </h2>

            <p>

                Hungroo Café uses collected
                information to improve
                customer experience,
                process orders and provide support.

            </p>

            <ul class="policy-list">

                <li>

                    Process food orders securely

                </li>

                <li>

                    Improve website performance

                </li>

                <li>

                    Send offers and updates

                </li>

            </ul>

        </article>

        <!-- CARD -->

        <article class="policy-card">

            <h2>

                Data Security

            </h2>

            <p>

                We use premium security
                measures and encrypted systems
                to protect customer information
                from unauthorized access.

            </p>

        </article>

        <!-- CARD -->

        <article class="policy-card">

            <h2>

                Contact Us

            </h2>

            <p>

                If you have questions regarding
                our privacy policy,
                contact Hungroo Café support anytime.

            </p>

            <p>

                Email: hungroo@gmail.com

            </p>

        </article>

    </section>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>