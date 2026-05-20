<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Reviews";

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

.review-page{

    width:100%;

    max-width:1400px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.review-top{

    text-align:center;

    margin-bottom:40px;

}

.review-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.review-top h1{

    font-size:
    clamp(38px,6vw,76px);

    margin:
    10px 0 16px;

}

.review-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
STATS
===================================================== */

.review-stats{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(220px,1fr));

    gap:20px;

    margin-bottom:40px;

}

.review-stat{

    padding:26px;

    border-radius:28px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    text-align:center;

}

.review-stat h2{

    font-size:40px;

    margin-bottom:10px;

}

.review-stat p{

    color:var(--text);

}

/* =====================================================
GRID
===================================================== */

.review-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(320px,1fr));

    gap:24px;

}

/* =====================================================
CARD
===================================================== */

.review-card{

    position:relative;

    overflow:hidden;

    padding:28px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    transition:.35s;

}

.review-card:hover{

    transform:
    translateY(-8px);

}

/* =====================================================
QUOTE
===================================================== */

.review-quote{

    font-size:50px;

    color:
    rgba(255,154,61,.2);

    margin-bottom:12px;

}

/* =====================================================
TEXT
===================================================== */

.review-text{

    color:var(--text);

    line-height:1.9;

    margin-bottom:26px;

}

/* =====================================================
BOTTOM
===================================================== */

.review-bottom{

    display:flex;
    align-items:center;
    justify-content:space-between;

    gap:16px;

    flex-wrap:wrap;

}

/* =====================================================
USER
===================================================== */

.review-user{

    display:flex;

    align-items:center;

    gap:14px;

}

.review-user img{

    width:62px;
    height:62px;

    border-radius:50%;

    object-fit:cover;

}

.review-user h3{

    font-size:18px;

    margin-bottom:4px;

}

.review-user span{

    color:var(--text);

    font-size:13px;

}

/* =====================================================
STARS
===================================================== */

.review-stars{

    display:flex;

    gap:4px;

    color:#ffb400;

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .review-grid{

        grid-template-columns:1fr;

    }

    .review-card{

        padding:22px 18px;

        border-radius:24px;

    }

    .review-bottom{

        align-items:flex-start;

        flex-direction:column;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="review-page">

    <!-- TOP -->

    <div class="review-top">

        <span>

            Premium Testimonials

        </span>

        <h1>

            Customer Reviews

        </h1>

        <p>

            Thousands of food lovers trust
            Hungroo Café for premium meals,
            handcrafted coffee and fast delivery.

        </p>

    </div>

    <!-- STATS -->

    <div class="review-stats">

        <div class="review-stat">

            <h2>

                4.9★

            </h2>

            <p>

                Average Rating

            </p>

        </div>

        <div class="review-stat">

            <h2>

                12K+

            </h2>

            <p>

                Happy Customers

            </p>

        </div>

        <div class="review-stat">

            <h2>

                50K+

            </h2>

            <p>

                Orders Delivered

            </p>

        </div>

    </div>

    <!-- GRID -->

    <div class="review-grid">

        <!-- CARD -->

        <article class="review-card">

            <div class="review-quote">

                “

            </div>

            <p class="review-text">

                Best café experience ever.
                Burgers were juicy, coffee was
                premium and delivery was super fast.

            </p>

            <div class="review-bottom">

                <div class="review-user">

                    <img
                    src="assets/images/user.png"
                    alt="User">

                    <div>

                        <h3>

                            Rahul Sharma

                        </h3>

                        <span>

                            Chandigarh

                        </span>

                    </div>

                </div>

                <div class="review-stars">

                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>

                </div>

            </div>

        </article>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>