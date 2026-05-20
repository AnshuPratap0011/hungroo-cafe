<?php

session_start();

$pageTitle =
"Hungroo Café | Blog";

/* =========================================================
BLOG POSTS
========================================================= */

$blogs = [

    [
        "title" =>
        "Top 5 Premium Burgers To Try",

        "image" =>
        "assets/images/blog1.jpg",

        "date" =>
        "20 May 2026",

        "category" =>
        "Food"
    ],

    [
        "title" =>
        "Best Coffee Experience Guide",

        "image" =>
        "assets/images/blog2.jpg",

        "date" =>
        "18 May 2026",

        "category" =>
        "Coffee"
    ],

    [
        "title" =>
        "Luxury Café Interior Trends",

        "image" =>
        "assets/images/blog3.jpg",

        "date" =>
        "15 May 2026",

        "category" =>
        "Lifestyle"
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

.blog-page{

    width:100%;

    max-width:1450px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =========================================================
TOP
========================================================= */

.blog-top{

    text-align:center;

    margin-bottom:60px;

}

.blog-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.blog-top h1{

    font-size:
    clamp(42px,6vw,84px);

    margin:
    10px 0 16px;

}

.blog-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:2;

}

/* =========================================================
GRID
========================================================= */

.blog-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(340px,1fr));

    gap:28px;

}

/* =========================================================
CARD
========================================================= */

.blog-card{

    overflow:hidden;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    transition:.35s;

    backdrop-filter:
    blur(18px);

}

.blog-card:hover{

    transform:
    translateY(-8px);

}

/* =========================================================
IMAGE
========================================================= */

.blog-image{

    position:relative;

    overflow:hidden;

    height:260px;

}

.blog-image img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.4s;

}

.blog-card:hover
.blog-image img{

    transform:
    scale(1.08);

}

/* =========================================================
CATEGORY
========================================================= */

.blog-category{

    position:absolute;

    top:18px;
    left:18px;

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

    font-size:12px;

    font-weight:700;

}

/* =========================================================
CONTENT
========================================================= */

.blog-content{

    padding:26px;

}

.blog-date{

    display:flex;

    align-items:center;

    gap:10px;

    color:var(--text);

    font-size:14px;

    margin-bottom:16px;

}

.blog-content h2{

    font-size:30px;

    line-height:1.4;

    margin-bottom:18px;

}

.blog-content p{

    color:var(--text);

    line-height:1.9;

    margin-bottom:24px;

}

/* =========================================================
BUTTON
========================================================= */

.blog-btn{

    width:100%;

    height:56px;

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

.blog-btn:hover{

    transform:
    translateY(-4px);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:768px){

    .blog-page{

        padding:
        120px 14px 70px;

    }

    .blog-grid{

        grid-template-columns:1fr;

    }

    .blog-card{

        border-radius:24px;

    }

    .blog-image{

        height:220px;

    }

    .blog-content{

        padding:20px 18px;

    }

    .blog-content h2{

        font-size:24px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<main class="blog-page">

    <!-- TOP -->

    <div class="blog-top">

        <span>

            Latest Stories

        </span>

        <h1>

            Hungroo Café Blog

        </h1>

        <p>

            Discover premium food guides,
            café lifestyle tips and the latest
            Hungroo Café stories.

        </p>

    </div>

    <!-- GRID -->

    <div class="blog-grid">

        <?php foreach($blogs as $blog): ?>

        <div class="blog-card">

            <!-- IMAGE -->

            <div class="blog-image">

                <img
                src="<?php echo $blog['image']; ?>"
                alt="<?php echo $blog['title']; ?>">

                <div class="blog-category">

                    <?php echo $blog['category']; ?>

                </div>

            </div>

            <!-- CONTENT -->

            <div class="blog-content">

                <div class="blog-date">

                    <i class="fa-solid fa-calendar"></i>

                    <?php echo $blog['date']; ?>

                </div>

                <h2>

                    <?php echo $blog['title']; ?>

                </h2>

                <p>

                    Explore premium café culture,
                    handcrafted meals and modern
                    luxury dining experiences.

                </p>

                <button class="blog-btn">

                    Read More

                </button>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

<script src="assets/js/preloader.js"></script>

</body>
</html>