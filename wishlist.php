<?php

session_start();

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Wishlist";

/* =========================================================
DUMMY DATA
========================================================= */

$wishlistItems = [

    [
        "name"  => "Classic Beef Burger",
        "price" => "₹299",
        "image" => "assets/images/burger.jpg"
    ],

    [
        "name"  => "Cold Coffee Deluxe",
        "price" => "₹199",
        "image" => "assets/images/coffee.jpg"
    ],

    [
        "name"  => "Italian Pizza",
        "price" => "₹499",
        "image" => "assets/images/pizza.jpg"
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

    --danger:#ff4d4d;

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

.wishlist-page{

    width:100%;

    max-width:1400px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.wishlist-top{

    text-align:center;

    margin-bottom:50px;

}

.wishlist-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.wishlist-top h1{

    font-size:
    clamp(38px,6vw,76px);

    margin:
    10px 0 16px;

}

.wishlist-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
GRID
===================================================== */

.wishlist-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(300px,1fr));

    gap:26px;

}

/* =====================================================
CARD
===================================================== */

.wishlist-card{

    overflow:hidden;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    transition:.35s;

}

.wishlist-card:hover{

    transform:
    translateY(-8px);

}

/* =====================================================
IMAGE
===================================================== */

.wishlist-image{

    position:relative;

    width:100%;

    height:260px;

    overflow:hidden;

}

.wishlist-image img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.4s;

}

.wishlist-card:hover
.wishlist-image img{

    transform:
    scale(1.08);

}

/* =====================================================
HEART
===================================================== */

.wishlist-heart{

    position:absolute;

    top:18px;
    right:18px;

    width:50px;
    height:50px;

    border:none;

    cursor:pointer;

    border-radius:16px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:
    rgba(0,0,0,.45);

    color:var(--danger);

    font-size:20px;

    backdrop-filter:
    blur(10px);

}

/* =====================================================
CONTENT
===================================================== */

.wishlist-content{

    padding:24px;

}

.wishlist-content h2{

    font-size:28px;

    margin-bottom:12px;

}

.wishlist-content p{

    color:var(--text);

    line-height:1.9;

    margin-bottom:20px;

}

/* =====================================================
BOTTOM
===================================================== */

.wishlist-bottom{

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:16px;

    flex-wrap:wrap;

}

/* =====================================================
PRICE
===================================================== */

.wishlist-price{

    font-size:34px;

    font-weight:700;

}

/* =====================================================
BUTTON
===================================================== */

.wishlist-btn{

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

.wishlist-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .wishlist-page{

        padding:
        120px 14px 70px;

    }

    .wishlist-grid{

        grid-template-columns:1fr;

    }

    .wishlist-card{

        border-radius:26px;

    }

    .wishlist-image{

        height:220px;

    }

    .wishlist-content{

        padding:20px 18px;

    }

    .wishlist-content h2{

        font-size:24px;

    }

    .wishlist-price{

        font-size:28px;

    }

    .wishlist-bottom{

        align-items:flex-start;

        flex-direction:column;

    }

    .wishlist-btn{

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

<main class="wishlist-page">

    <!-- TOP -->

    <div class="wishlist-top">

        <span>

            Favorite Meals

        </span>

        <h1>

            Your Wishlist

        </h1>

        <p>

            Save your favorite premium meals,
            handcrafted drinks and luxury café specials.

        </p>

    </div>

    <!-- GRID -->

    <div class="wishlist-grid">

        <?php foreach($wishlistItems as $item): ?>

        <article class="wishlist-card">

            <!-- IMAGE -->

            <div class="wishlist-image">

                <img
                src="<?php echo $item['image']; ?>"
                alt="<?php echo $item['name']; ?>">

                <button class="wishlist-heart">

                    <i class="fa-solid fa-heart"></i>

                </button>

            </div>

            <!-- CONTENT -->

            <div class="wishlist-content">

                <h2>

                    <?php echo $item['name']; ?>

                </h2>

                <p>

                    Premium handcrafted taste
                    with luxury café experience.

                </p>

                <div class="wishlist-bottom">

                    <div class="wishlist-price">

                        <?php echo $item['price']; ?>

                    </div>

                    <button class="wishlist-btn">

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