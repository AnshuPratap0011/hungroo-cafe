<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Refund Policy";

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

.refund-page{

    width:100%;

    max-width:1150px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.refund-top{

    text-align:center;

    margin-bottom:50px;

}

.refund-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.refund-top h1{

    font-size:
    clamp(38px,6vw,76px);

    margin:
    10px 0 16px;

    line-height:1.1;

}

.refund-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
CONTENT
===================================================== */

.refund-content{

    display:flex;

    flex-direction:column;

    gap:24px;

}

/* =====================================================
CARD
===================================================== */

.refund-card{

    padding:32px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

}

.refund-card h2{

    font-size:32px;

    margin-bottom:18px;

}

.refund-card p{

    color:var(--text);

    line-height:2;

    margin-bottom:16px;

}

.refund-card p:last-child{

    margin-bottom:0;

}

/* =====================================================
LIST
===================================================== */

.refund-list{

    display:flex;

    flex-direction:column;

    gap:14px;

    padding-left:18px;

    margin-top:18px;

}

.refund-list li{

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
HIGHLIGHT
===================================================== */

.refund-highlight{

    color:var(--primary);

    font-weight:600;

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .refund-page{

        padding:
        120px 14px 70px;

    }

    .refund-card{

        padding:22px 18px;

        border-radius:24px;

    }

    .refund-card h2{

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

<main class="refund-page">

    <!-- TOP -->

    <div class="refund-top">

        <span>

            Customer Support

        </span>

        <h1>

            Refund Policy

        </h1>

        <p>

            Hungroo Café values customer
            satisfaction and ensures fair
            refund and cancellation policies.

        </p>

    </div>

    <!-- CONTENT -->

    <section class="refund-content">

        <!-- CARD -->

        <article class="refund-card">

            <h2>

                Order Cancellation

            </h2>

            <p>

                Orders can be cancelled
                before preparation begins.
                Once the kitchen starts preparing,
                cancellation may not be possible.

            </p>

        </article>

        <!-- CARD -->

        <article class="refund-card">

            <h2>

                Refund Eligibility

            </h2>

            <p>

                Refunds may be approved
                in situations involving:

            </p>

            <ul class="refund-list">

                <li>

                    Wrong food item delivered

                </li>

                <li>

                    Damaged packaging

                </li>

                <li>

                    Missing order items

                </li>

                <li>

                    Failed online transactions

                </li>

            </ul>

        </article>

        <!-- CARD -->

        <article class="refund-card">

            <h2>

                Refund Processing Time

            </h2>

            <p>

                Approved refunds are processed
                within <span class="refund-highlight">

                5-7 business days

                </span>
                depending on your payment provider.

            </p>

        </article>

        <!-- CARD -->

        <article class="refund-card">

            <h2>

                Non-Refundable Situations

            </h2>

            <ul class="refund-list">

                <li>

                    Incorrect delivery address provided

                </li>

                <li>

                    Delay caused by customer unavailability

                </li>

                <li>

                    Minor packaging variations

                </li>

            </ul>

        </article>

        <!-- CARD -->

        <article class="refund-card">

            <h2>

                Need Help?

            </h2>

            <p>

                For refund or cancellation support,
                contact Hungroo Café anytime.

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