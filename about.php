<?php

include "config/config.php";

$pageTitle = "Hungroo Café | About Us";

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

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link
rel="stylesheet"
href="assets/css/navbar.css">

<link
rel="stylesheet"
href="assets/css/footer.css">

<style>

/* =========================================================
PREMIUM THEME VARIABLES
========================================================= */

:root,
[data-theme="dark"]{

    --bg-body:#09090b;

    --bg-card:#1e1e22;

    --bg-card-hover:#26262b;

    --text-main:#ffffff;

    --text-sec:#a1a1aa;

    --accent:#6C5CE7;

    --accent-l:#a29bfe;

    --accent-dark:#4834d4;

    --gold:#ffd27a;

    --border:
    rgba(255,255,255,0.08);

    --border-h:
    rgba(255,255,255,0.12);

    --shadow-card:
    0 10px 30px rgba(0,0,0,0.3);

    --shadow-hover:
    0 20px 40px -10px rgba(108,92,231,0.2);

    --gradient-text:
    linear-gradient(
    135deg,
    #6C5CE7,
    #a29bfe
    );

}

[data-theme="light"]{

    --bg-body:#f5f5f7;

    --bg-card:#ffffff;

    --bg-card-hover:#fafafa;

    --text-main:#111111;

    --text-sec:#666666;

    --border:
    rgba(0,0,0,0.08);

    --border-h:
    rgba(0,0,0,0.12);

    --shadow-card:
    0 10px 30px rgba(0,0,0,0.05);

    --shadow-hover:
    0 20px 40px -10px rgba(108,92,231,0.15);

}

/* =========================================================
GLOBAL
========================================================= */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

body{

    font-family:'Poppins',sans-serif;

    background:var(--bg-body);

    color:var(--text-main);

    overflow-x:hidden;

    -webkit-font-smoothing:antialiased;

    transition:
    background .35s ease,
    color .35s ease;

}

a{

    text-decoration:none;

    color:inherit;

}

img{

    display:block;

    max-width:100%;

}

/* =========================================================
BACKGROUND BLOBS
========================================================= */

.co-blobs{

    position:fixed;

    inset:0;

    z-index:0;

    pointer-events:none;

    overflow:hidden;

}

.co-blob{

    position:absolute;

    border-radius:50%;

    filter:blur(130px);

}

.co-blob-1{

    width:600px;
    height:600px;

    background:
    rgba(108,92,231,.08);

    top:-200px;
    left:-100px;

}

.co-blob-2{

    width:500px;
    height:500px;

    background:
    rgba(0,184,148,.08);

    bottom:-100px;
    right:-150px;

}

/* =========================================================
HERO
========================================================= */

.hero-about{

    position:relative;

    max-width:1400px;

    margin:auto;

    padding:
    140px 24px 80px;

    text-align:center;

    z-index:1;

}

.hero-badge{

    display:inline-flex;

    align-items:center;

    gap:8px;

    padding:8px 20px;

    background:
    rgba(108,92,231,0.15);

    border:
    1px solid rgba(108,92,231,0.3);

    border-radius:50px;

    color:var(--accent-l);

    font-size:13px;

    font-weight:600;

    margin-bottom:24px;

    box-shadow:
    0 0 15px rgba(108,92,231,0.2);

    backdrop-filter:blur(5px);

}

.hero-title{

    font-size:
    clamp(42px,6vw,72px);

    font-weight:800;

    line-height:1.1;

    margin-bottom:20px;

    background:
    linear-gradient(
    to right,
    #fff,
    #a1a1aa
    );

    -webkit-background-clip:text;

    -webkit-text-fill-color:transparent;

}

[data-theme="light"] .hero-title{

    background:
    linear-gradient(
    to right,
    #111,
    #666
    );

    -webkit-background-clip:text;

    -webkit-text-fill-color:transparent;

}

.hero-desc{

    font-size:18px;

    color:var(--text-sec);

    max-width:700px;

    margin:
    0 auto 40px;

    line-height:1.6;

}

.hero-btn{

    display:inline-flex;

    align-items:center;

    gap:10px;

    padding:16px 32px;

    background:var(--gradient-text);

    color:#fff;

    border-radius:50px;

    font-weight:600;

    font-size:16px;

    box-shadow:
    0 10px 30px rgba(108,92,231,0.4);

    transition:.3s;

}

.hero-btn:hover{

    transform:
    translateY(-3px);

}

/* =========================================================
CONTAINER
========================================================= */

.container{

    max-width:1200px;

    margin:0 auto;

    padding:
    0 24px 80px;

    position:relative;

    z-index:1;

}

/* =========================================================
STORY GRID
========================================================= */

.story-grid{

    display:grid;

    grid-template-columns:
    1fr 1fr;

    gap:40px;

    align-items:center;

    margin-bottom:80px;

}

.story-img-wrap{

    position:relative;

    border-radius:30px;

    overflow:hidden;

    box-shadow:var(--shadow-card);

    border:
    1px solid var(--border);

}

.story-img-wrap img{

    width:100%;
    height:500px;

    object-fit:cover;

    transition:.5s;

}

.story-img-wrap:hover img{

    transform:scale(1.03);

}

.story-content h2{

    font-size:36px;

    font-weight:700;

    margin-bottom:20px;

}

.story-content p{

    font-size:16px;

    color:var(--text-sec);

    line-height:1.8;

    margin-bottom:30px;

}

.story-features-list{

    list-style:none;

}

.story-features-list li{

    margin-bottom:12px;

    display:flex;

    align-items:center;

    gap:12px;

    font-size:16px;

}

.story-features-list li i{

    color:var(--accent-l);

}

/* =========================================================
FEATURES
========================================================= */

.features-section h2{

    text-align:center;

    font-size:32px;

    font-weight:700;

    margin-bottom:40px;

}

.features-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(260px,1fr));

    gap:24px;

}

.feature-card{

    background:var(--bg-card);

    border:
    1px solid var(--border);

    border-radius:20px;

    padding:30px;

    text-align:center;

    transition:.3s;

}

.feature-card:hover{

    transform:
    translateY(-5px);

    border-color:var(--accent);

    box-shadow:var(--shadow-hover);

}

.feature-icon{

    width:70px;
    height:70px;

    border-radius:50%;

    background:
    rgba(108,92,231,0.1);

    display:flex;

    align-items:center;
    justify-content:center;

    margin:
    0 auto 20px;

    color:var(--accent-l);

    font-size:28px;

}

.feature-card h3{

    font-size:20px;

    margin-bottom:10px;

}

.feature-card p{

    font-size:14px;

    color:var(--text-sec);

    line-height:1.6;

}

/* =========================================================
STATS
========================================================= */

.stats-section{

    margin:
    80px 0;

}

.stats-grid{

    display:grid;

    grid-template-columns:
    repeat(4,1fr);

    gap:20px;

}

.stat-card{

    background:
    linear-gradient(
    145deg,
    var(--bg-card),
    rgba(255,255,255,0.03)
    );

    border:
    1px solid var(--border);

    border-radius:24px;

    padding:30px;

    text-align:center;

}

.stat-number{

    font-size:42px;

    font-weight:800;

    margin-bottom:5px;

    background:var(--gradient-text);

    -webkit-background-clip:text;

    -webkit-text-fill-color:transparent;

}

.stat-label{

    color:var(--text-sec);

    font-size:15px;

}

/* =========================================================
CTA
========================================================= */

.cta-section{

    background:var(--bg-card);

    border-radius:40px;

    padding:60px;

    text-align:center;

    border:
    1px solid var(--border);

    position:relative;

    overflow:hidden;

}

.cta-title{

    font-size:36px;

    font-weight:800;

    margin-bottom:15px;

}

.cta-btn{

    display:inline-flex;

    align-items:center;

    gap:10px;

    background:var(--accent);

    color:#fff;

    padding:16px 32px;

    border-radius:50px;

    font-weight:700;

    margin-top:30px;

    transition:.3s;

}

.cta-btn:hover{

    transform:scale(1.05);

    background:var(--accent-dark);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:768px){

    .story-grid{

        grid-template-columns:1fr;

    }

    .story-img-wrap img{

        height:320px;

    }

    .stats-grid{

        grid-template-columns:
        repeat(2,1fr);

    }

    .hero-title{

        font-size:36px;

    }

    .cta-section{

        border-radius:24px;

        padding:40px 20px;

    }

}

</style>

</head>

<body>

<div class="co-blobs">

    <div class="co-blob co-blob-1"></div>

    <div class="co-blob co-blob-2"></div>

</div>

<?php include "Navbar.php"; ?>

<!-- HERO -->

<section class="hero-about">

    <div class="hero-badge">

        <i class="fa-solid fa-heart"></i>

        Who We Are

    </div>

    <h1 class="hero-title">

        Hungroo Café

    </h1>

    <p class="hero-desc">

        Premium food, luxury ambience, and a taste that stays with you forever.

    </p>

    <a
    href="menu.php"
    class="hero-btn">

        <i class="fa-solid fa-utensils"></i>

        Order Now

    </a>

</section>

<div class="container">

    <!-- STORY -->

    <section class="story-grid">

        <div class="story-img-wrap">

            <img
            src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1200&auto=format&fit=crop"
            alt="Hungroo Interior">

        </div>

        <div class="story-content">

            <h2>

                Crafted With Passion

            </h2>

            <p>

                We believe food is not just about eating, it's an experience.

            </p>

            <p>

                Every dish at Hungroo Café is crafted with premium ingredients and modern taste.

            </p>

            <ul class="story-features-list">

                <li>

                    <i class="fa-solid fa-check-circle"></i>

                    Handcrafted Recipes

                </li>

                <li>

                    <i class="fa-solid fa-leaf"></i>

                    Fresh Ingredients

                </li>

                <li>

                    <i class="fa-solid fa-wine-glass"></i>

                    Premium Ambience

                </li>

            </ul>

        </div>

    </section>

    <!-- FEATURES -->

    <section class="features-section">

        <h2>

            Why Choose Us?

        </h2>

        <div class="features-grid">

            <div class="feature-card">

                <div class="feature-icon">

                    <i class="fa-solid fa-burger"></i>

                </div>

                <h3>

                    Premium Quality

                </h3>

                <p>

                    Finest ingredients with unforgettable taste.

                </p>

            </div>

            <div class="feature-card">

                <div class="feature-icon">

                    <i class="fa-solid fa-clock"></i>

                </div>

                <h3>

                    Fast Delivery

                </h3>

                <p>

                    Hot & fresh delivery at lightning speed.

                </p>

            </div>

            <div class="feature-card">

                <div class="feature-icon">

                    <i class="fa-solid fa-headset"></i>

                </div>

                <h3>

                    24/7 Support

                </h3>

                <p>

                    Always ready to assist you anytime.

                </p>

            </div>

            <div class="feature-card">

                <div class="feature-icon">

                    <i class="fa-solid fa-truck"></i>

                </div>

                <h3>

                    Secure Packaging

                </h3>

                <p>

                    Hygienic packaging for safe delivery.

                </p>

            </div>

        </div>

    </section>

    <!-- STATS -->

    <section class="stats-section">

        <div class="stats-grid">

            <div class="stat-card">

                <div class="stat-number">

                    15K+

                </div>

                <div class="stat-label">

                    Happy Customers

                </div>

            </div>

            <div class="stat-card">

                <div class="stat-number">

                    50+

                </div>

                <div class="stat-label">

                    Menu Items

                </div>

            </div>

            <div class="stat-card">

                <div class="stat-number">

                    4.9

                </div>

                <div class="stat-label">

                    Star Rating

                </div>

            </div>

            <div class="stat-card">

                <div class="stat-number">

                    10+

                </div>

                <div class="stat-label">

                    Cities Active

                </div>

            </div>

        </div>

    </section>

    <!-- CTA -->

    <section class="cta-section">

        <h2 class="cta-title">

            Ready to Taste the Difference?

        </h2>

        <p style="color:var(--text-sec)">

            Join thousands of satisfied customers today.

        </p>

        <a
        href="menu.php"
        class="cta-btn">

            View Full Menu

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </section>

</div>

<?php include "footer.php"; ?>

</body>
</html>