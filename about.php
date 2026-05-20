<?php

session_start();

$pageTitle =
"Hungroo Café | About Us";

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

<!-- GOOGLE FONT -->

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

<!-- FONT AWESOME -->

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

<link
rel="stylesheet"
href="assets/css/responsive.css">

<style>

/* =========================================================
ROOT
========================================================= */

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

/* =========================================================
RESET
========================================================= */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

/* =========================================================
BODY
========================================================= */

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

/* =========================================================
PAGE
========================================================= */

.about-page{

    width:100%;

    max-width:1450px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =========================================================
TOP
========================================================= */

.about-top{

    text-align:center;

    margin-bottom:70px;

}

.about-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.about-top h1{

    font-size:
    clamp(42px,6vw,86px);

    margin:
    10px 0 18px;

}

.about-top p{

    max-width:820px;

    margin:auto;

    line-height:2;

    color:var(--text);

}

/* =========================================================
WRAPPER
========================================================= */

.about-wrapper{

    display:grid;

    grid-template-columns:
    1fr 1fr;

    gap:34px;

    align-items:center;

    margin-bottom:70px;

}

/* =========================================================
IMAGE
========================================================= */

.about-image{

    position:relative;

    overflow:hidden;

    border-radius:36px;

    border:
    1px solid var(--border);

}

.about-image img{

    width:100%;
    height:100%;

    min-height:520px;

    object-fit:cover;

    display:block;

}

/* =========================================================
CONTENT
========================================================= */

.about-content{

    padding:10px;

}

.about-badge{

    display:inline-flex;

    align-items:center;

    gap:10px;

    padding:
    12px 18px;

    border-radius:999px;

    margin-bottom:26px;

    background:
    rgba(255,154,61,.10);

    border:
    1px solid rgba(255,154,61,.16);

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.about-content h2{

    font-size:
    clamp(34px,5vw,58px);

    line-height:1.2;

    margin-bottom:20px;

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

    gap:18px;

    margin-top:30px;

}

.about-feature{

    padding:22px;

    border-radius:24px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

.about-feature i{

    width:62px;
    height:62px;

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

    font-size:22px;

    margin-bottom:10px;

}

.about-feature p{

    margin:0;

    font-size:14px;

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

}

.about-stat{

    padding:30px;

    text-align:center;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

.about-stat h2{

    font-size:
    clamp(34px,5vw,54px);

    margin-bottom:12px;

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

    line-height:1.8;

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:992px){

    .about-wrapper{

        grid-template-columns:1fr;

    }

    .about-stats{

        grid-template-columns:
        repeat(2,1fr);

    }

}

@media(max-width:768px){

    .about-page{

        padding:
        120px 14px 70px;

    }

    .about-image{

        border-radius:24px;

    }

    .about-image img{

        min-height:320px;

    }

    .about-features{

        grid-template-columns:1fr;

    }

    .about-stat{

        padding:24px 18px;

        border-radius:22px;

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

<main class="about-page">

    <!-- TOP -->

    <div class="about-top">

        <span>

            Premium Café Experience

        </span>

        <h1>

            About Hungroo Café

        </h1>

        <p>

            Hungroo Café blends premium dining,
            handcrafted coffee and luxury café vibes
            into one unforgettable experience.
            From gourmet burgers to signature desserts,
            every meal is crafted with passion.

        </p>

    </div>

    <!-- WRAPPER -->

    <div class="about-wrapper">

        <!-- IMAGE -->

        <div class="about-image">

            <img
            src="assets/images/cafe.jpg"
            alt="Hungroo Café">

        </div>

        <!-- CONTENT -->

        <div class="about-content">

            <div class="about-badge">

                <i class="fa-solid fa-fire"></i>

                Modern Luxury Café

            </div>

            <h2>

                Crafted For Premium Food Lovers

            </h2>

            <p>

                We focus on premium quality,
                aesthetic interiors and rich flavors
                to deliver the best café experience.

            </p>

            <p>

                Whether it’s handcrafted coffee,
                loaded burgers or premium desserts,
                Hungroo Café creates moments
                people remember.

            </p>

            <!-- FEATURES -->

            <div class="about-features">

                <div class="about-feature">

                    <i class="fa-solid fa-burger"></i>

                    <h3>

                        Premium Meals

                    </h3>

                    <p>

                        Fresh handcrafted burgers,
                        pizzas and signature dishes.

                    </p>

                </div>

                <div class="about-feature">

                    <i class="fa-solid fa-mug-hot"></i>

                    <h3>

                        Café Coffee

                    </h3>

                    <p>

                        Authentic premium coffee
                        with luxury café vibes.

                    </p>

                </div>

                <div class="about-feature">

                    <i class="fa-solid fa-truck-fast"></i>

                    <h3>

                        Fast Delivery

                    </h3>

                    <p>

                        Quick and secure delivery
                        across your city.

                    </p>

                </div>

                <div class="about-feature">

                    <i class="fa-solid fa-star"></i>

                    <h3>

                        Top Rated

                    </h3>

                    <p>

                        Loved by thousands of
                        premium food lovers.

                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- STATS -->

    <div class="about-stats">

        <div class="about-stat">

            <h2>

                25K+

            </h2>

            <p>

                Happy Customers

            </p>

        </div>

        <div class="about-stat">

            <h2>

                150+

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

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

<script src="assets/js/preloader.js"></script>

</body>
</html>