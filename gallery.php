<?php

$pageTitle =
"Hungroo Café | Gallery";

$gallery = [

"assets/images/burger.jpg",
"assets/images/coffee.jpg",
"assets/images/pizza.jpg",
"assets/images/dessert.jpg",
"assets/images/boba.jpg",
"assets/images/cafe.jpg"

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
href="assets/css/animations.css">

<style>

:root{

    --bg:#070707;
    --card:#121212;
    --white:#fff;
    --text:#bdbdbd;
    --primary:#ff9a3d;
    --gold:#ffd27a;
    --border:
    rgba(255,255,255,.08);

}

body.light-mode{

    --bg:#f5f5f7;
    --card:#fff;
    --white:#111;
    --text:#666;
    --border:
    rgba(0,0,0,.08);

}

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

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

.gallery-page{

    width:100%;

    max-width:1500px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* TOP */

.gallery-top{

    text-align:center;

    margin-bottom:60px;

}

.gallery-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.gallery-top h1{

    font-size:
    clamp(40px,6vw,82px);

    margin:
    10px 0 16px;

}

.gallery-top p{

    max-width:760px;

    margin:auto;

    line-height:1.9;

    color:var(--text);

}

/* GRID */

.gallery-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(320px,1fr));

    gap:26px;

}

/* CARD */

.gallery-card{

    position:relative;

    overflow:hidden;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    transition:.35s;

}

.gallery-card:hover{

    transform:
    translateY(-8px);

}

/* IMAGE */

.gallery-card img{

    width:100%;
    height:320px;

    object-fit:cover;

    display:block;

    transition:.4s;

}

.gallery-card:hover img{

    transform:
    scale(1.08);

}

/* OVERLAY */

.gallery-overlay{

    position:absolute;

    inset:0;

    background:
    linear-gradient(
    to top,
    rgba(0,0,0,.7),
    transparent
    );

    display:flex;

    align-items:flex-end;

    padding:24px;

}

.gallery-overlay h2{

    font-size:28px;

}

/* RESPONSIVE */

@media(max-width:768px){

    .gallery-page{

        padding:
        120px 14px 70px;

    }

    .gallery-grid{

        grid-template-columns:1fr;

    }

    .gallery-card{

        border-radius:24px;

    }

    .gallery-card img{

        height:240px;

    }

    .gallery-overlay h2{

        font-size:22px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<main class="gallery-page">

    <!-- TOP -->

    <div class="gallery-top">

        <span>

            Premium Moments

        </span>

        <h1>

            Our Gallery

        </h1>

        <p>

            Explore premium meals,
            handcrafted café drinks,
            desserts and luxury vibes
            from Hungroo Café.

        </p>

    </div>

    <!-- GRID -->

    <div class="gallery-grid">

        <?php foreach($gallery as $index => $image): ?>

        <div class="gallery-card">

            <img
            src="<?php echo $image; ?>"
            alt="gallery">

            <div class="gallery-overlay">

                <h2>

                    Hungroo Café

                </h2>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>