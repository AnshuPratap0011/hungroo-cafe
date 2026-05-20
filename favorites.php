<?php

session_start();

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Favorites";

/* =========================================================
FAVORITE ITEMS
========================================================= */

$favorites = [

    [
        "name"  => "Premium Cheese Burger",
        "price" => "₹349",
        "image" => "assets/images/burger.jpg",
        "category" => "Burger"
    ],

    [
        "name"  => "Mocha Cold Coffee",
        "price" => "₹229",
        "image" => "assets/images/coffee.jpg",
        "category" => "Coffee"
    ],

    [
        "name"  => "Italian Farm Pizza",
        "price" => "₹599",
        "image" => "assets/images/pizza.jpg",
        "category" => "Pizza"
    ],

    [
        "name"  => "Chocolate Lava Dessert",
        "price" => "₹279",
        "image" => "assets/images/dessert.jpg",
        "category" => "Dessert"
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

    --danger:#ff4d6d;

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

.favorites-page{

    width:100%;

    max-width:1450px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.favorites-top{

    text-align:center;

    margin-bottom:50px;

}

.favorites-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.favorites-top h1{

    font-size:
    clamp(38px,6vw,76px);

    margin:
    10px 0 16px;

}

.favorites-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
GRID
===================================================== */

.favorites-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(300px,1fr));

    gap:26px;

}

/* =====================================================
CARD
===================================================== */

.favorite-card{

    overflow:hidden;

    border-radius:32px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    transition:.35s;

    backdrop-filter:
    blur(18px);

}

.favorite-card:hover{

    transform:
    translateY(-8px);

}

/* =====================================================
IMAGE
===================================================== */

.favorite-image{

    position:relative;

    width:100%;

    height:240px;

    overflow:hidden;

}

.favorite-image img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.4s;

}

.favorite-card:hover
.favorite-image img{

    transform:
    scale(1.08);

}

/* =====================================================
BADGE
===================================================== */

.favorite-badge{

    position:absolute;

    top:18px;
    left:18px;

    padding:
    10px 16px;

    border-radius:999px;

    background:
    rgba(0,0,0,.45);

    backdrop-filter:
    blur(12px);

    color:#fff;

    font-size:12px;

    font-weight:600;

}

/* =====================================================
HEART
===================================================== */

.favorite-heart{

    position:absolute;

    top:18px;
    right:18px;

    width:50px;
    height:50px;

    border:none;

    cursor:pointer;

    border-radius:16px;

    background:
    rgba(0,0,0,.45);

    backdrop-filter:
    blur(12px);

    color:var(--danger);

    font-size:20px;

}

/* =====================================================
CONTENT
===================================================== */

.favorite-content{

    padding:24px;

}

.favorite-content h2{

    font-size:28px;

    margin-bottom:10px;

}

.favorite-content p{

    color:var(--text);

    line-height:1.9;

    margin-bottom:22px;

}

/* =====================================================
BOTTOM
===================================================== */

.favorite-bottom{

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:16px;

    flex-wrap:wrap;

}

/* =====================================================
PRICE
===================================================== */

.favorite-price{

    font-size:34px;

    font-weight:700;

}

/* =====================================================
BUTTON
===================================================== */

.favorite-btn{

    height:54px;

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

.favorite-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .favorites-page{

        padding:
        120px 14px 70px;

    }

    .favorites-grid{

        grid-template-columns:1fr;

    }

    .favorite-card{

        border-radius:24px;

    }

    .favorite-image{

        height:220px;

    }

    .favorite-content{

        padding:18px;

    }

    .favorite-content h2{

        font-size:24px;

    }

    .favorite-bottom{

        flex-direction:column;

        align-items:flex-start;

    }

    .favorite-btn{

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

<main class="favorites-page">

    <!-- TOP -->

    <div class="favorites-top">

        <span>

            Premium Collection

        </span>

        <h1>

            Favorite Items

        </h1>

        <p>

            Explore your most loved meals,
            handcrafted coffee and premium
            café specials in one place.

        </p>

    </div>

    <!-- GRID -->

    <div class="favorites-grid">

        <?php foreach($favorites as $item): ?>

        <article class="favorite-card">

            <!-- IMAGE -->

            <div class="favorite-image">

                <img
                src="<?php echo $item['image']; ?>"
                alt="<?php echo $item['name']; ?>">

                <div class="favorite-badge">

                    <?php echo $item['category']; ?>

                </div>

                <button class="favorite-heart">

                    <i class="fa-solid fa-heart"></i>

                </button>

            </div>

            <!-- CONTENT -->

            <div class="favorite-content">

                <h2>

                    <?php echo $item['name']; ?>

                </h2>

                <p>

                    Premium handcrafted flavor
                    with unforgettable café vibes.

                </p>

                <div class="favorite-bottom">

                    <div class="favorite-price">

                        <?php echo $item['price']; ?>

                    </div>

                    <button class="favorite-btn">

                        Add To Cart

                    </button>

                </div>

            </div>

        </article>

        <?php endforeach; ?>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>