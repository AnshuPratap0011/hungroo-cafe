<?php

$pageTitle =
"Hungroo Café | About";

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

<!-- CSS -->

<link
rel="stylesheet"
href="assets/css/navbar.css">

<link
rel="stylesheet"
href="assets/css/footer.css">

<style>

/* =========================================================
ROOT
========================================================= */

:root{

    --bg:#070707;

    --card:#111111;

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

/* =========================================================
RESET
========================================================= */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

body{

    background:var(--bg);

    color:var(--white);

    font-family:'Poppins',sans-serif;

    overflow-x:hidden;

}

/* =========================================================
HERO
========================================================= */

.about-hero{

    width:100%;

    min-height:70vh;

    display:flex;

    align-items:center;
    justify-content:center;

    text-align:center;

    padding:
    140px 16px 90px;

}

.about-hero-content{

    width:100%;

    max-width:950px;

}

.about-hero-content span{

    display:inline-flex;

    align-items:center;
    justify-content:center;

    padding:
    10px 20px;

    border-radius:999px;

    background:
    rgba(255,154,61,.10);

    border:
    1px solid rgba(255,154,61,.14);

    color:#ffb15e;

    font-size:13px;

    font-weight:700;

    margin-bottom:24px;

}

.about-hero-content h1{

    font-size:
    clamp(52px,8vw,110px);

    line-height:1.05;

    margin-bottom:24px;

}

.about-hero-content h1 span{

    padding:0;

    border:none;

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

.about-hero-content p{

    max-width:760px;

    margin:auto;

    line-height:2;

    color:var(--text);

    font-size:15px;

}

/* =========================================================
SECTION
========================================================= */

.about-section{

    width:100%;

    max-width:1450px;

    margin:auto;

    padding:
    0 16px 90px;

}

/* =========================================================
GRID
========================================================= */

.about-grid{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:50px;

    align-items:center;

}

/* =========================================================
IMAGE
========================================================= */

.about-image{

    position:relative;

}

.about-image img{

    width:100%;

    height:650px;

    object-fit:cover;

    border-radius:40px;

}

/* =========================================================
CONTENT
========================================================= */

.about-content h2{

    font-size:
    clamp(38px,5vw,70px);

    line-height:1.1;

    margin-bottom:24px;

}

.about-content p{

    color:var(--text);

    line-height:2;

    margin-bottom:22px;

}

/* =========================================================
FEATURES
========================================================= */

.about-features{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:20px;

    margin-top:40px;

}

.about-feature{

    padding:24px;

    border-radius:26px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

body.light-mode
.about-feature{

    background:#fff;

}

.about-feature i{

    width:60px;
    height:60px;

    margin-bottom:18px;

    border-radius:18px;

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

    font-size:24px;

}

.about-feature h3{

    margin-bottom:12px;

    font-size:20px;

}

.about-feature p{

    margin:0;

    line-height:1.8;

}

/* =========================================================
STATS
========================================================= */

.about-stats{

    display:grid;

    grid-template-columns:
    repeat(4,1fr);

    gap:24px;

    margin-top:80px;

}

.about-stat{

    padding:34px;

    border-radius:30px;

    text-align:center;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

body.light-mode
.about-stat{

    background:#fff;

}

.about-stat h2{

    font-size:54px;

    margin-bottom:10px;

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

.about-stat p{

    color:var(--text);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:992px){

    .about-grid{

        grid-template-columns:1fr;

    }

    .about-stats{

        grid-template-columns:
        repeat(2,1fr);

    }

}

@media(max-width:768px){

    .about-hero{

        min-height:auto;

        padding:
        120px 14px 70px;

    }

    .about-section{

        padding:
        0 12px 70px;

    }

    .about-image img{

        height:420px;

        border-radius:28px;

    }

    .about-features{

        grid-template-columns:1fr;

    }

}

@media(max-width:480px){

    .about-stats{

        grid-template-columns:1fr;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =========================================================
HERO
========================================================= -->

<section class="about-hero">

    <div class="about-hero-content">

        <span>

            About Hungroo Café

        </span>

        <h1>

            More Than Just

            <span>

                Delicious Food

            </span>

        </h1>

        <p>

            Hungroo Café is a premium modern café
            built for food lovers who enjoy delicious
            flavours, luxury ambience and unforgettable
            experiences.

        </p>

    </div>

</section>

<!-- =========================================================
ABOUT
========================================================= -->

<section class="about-section">

    <div class="about-grid">

        <!-- IMAGE -->

        <div class="about-image">

            <img
            src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1600&auto=format&fit=crop"
            alt="Cafe">

        </div>

        <!-- CONTENT -->

        <div class="about-content">

            <h2>

                Crafted With Passion & Taste

            </h2>

            <p>

                We combine premium ingredients,
                luxury presentation and modern café
                vibes to create a memorable food
                experience for everyone.

            </p>

            <p>

                From handcrafted burgers and cheesy
                pizzas to refreshing drinks and
                desserts — every item is carefully
                prepared with love.

            </p>

            <!-- FEATURES -->

            <div class="about-features">

                <div class="about-feature">

                    <i class="fa-solid fa-burger"></i>

                    <h3>

                        Premium Food

                    </h3>

                    <p>

                        Fresh ingredients and
                        handcrafted recipes.

                    </p>

                </div>

                <div class="about-feature">

                    <i class="fa-solid fa-mug-hot"></i>

                    <h3>

                        Café Vibes

                    </h3>

                    <p>

                        Modern ambience with
                        luxury comfort.

                    </p>

                </div>

                <div class="about-feature">

                    <i class="fa-solid fa-truck-fast"></i>

                    <h3>

                        Fast Delivery

                    </h3>

                    <p>

                        Quick and secure
                        delivery service.

                    </p>

                </div>

                <div class="about-feature">

                    <i class="fa-solid fa-star"></i>

                    <h3>

                        Best Experience

                    </h3>

                    <p>

                        Trusted by thousands
                        of happy customers.

                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- =====================================================
    STATS
    ====================================================== -->

    <div class="about-stats">

        <div class="about-stat">

            <h2>

                10K+

            </h2>

            <p>

                Happy Customers

            </p>

        </div>

        <div class="about-stat">

            <h2>

                120+

            </h2>

            <p>

                Premium Dishes

            </p>

        </div>

        <div class="about-stat">

            <h2>

                4.9★

            </h2>

            <p>

                Customer Rating

            </p>

        </div>

        <div class="about-stat">

            <h2>

                24/7

            </h2>

            <p>

                Fast Support

            </p>

        </div>

    </div>

</section>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>
<script src="assets/js/cart.js"></script>
<script src="assets/js/preloader.js"></script>

</body>
</html>