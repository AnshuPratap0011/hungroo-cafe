<?php

include "config/config.php";

$pageTitle = "Hungroo Café | Gallery";

/* =========================================================
GALLERY DATA
========================================================= */

$gallery = [

    [
        'img' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=800&auto=format&fit=crop',
        'title' => 'Signature Smash Burger',
        'cat' => 'Burgers',
        'size' => 'tall'
    ],

    [
        'img' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=800&auto=format&fit=crop',
        'title' => 'Artisan Cappuccino',
        'cat' => 'Coffee',
        'size' => 'normal'
    ],

    [
        'img' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=800&auto=format&fit=crop',
        'title' => 'Truffle Fries Platter',
        'cat' => 'Snacks',
        'size' => 'normal'
    ],

    [
        'img' => 'https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?q=80&w=800&auto=format&fit=crop',
        'title' => 'Berry Cheese Cake',
        'cat' => 'Desserts',
        'size' => 'tall'
    ],

    [
        'img' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=800&auto=format&fit=crop',
        'title' => 'Hungroo Interior',
        'cat' => 'Interior',
        'size' => 'wide'
    ],

    [
        'img' => 'https://images.unsplash.com/photo-1554118811-5e9d723df671?q=80&w=800&auto=format&fit=crop',
        'title' => 'Mango Smoothie',
        'cat' => 'Drinks',
        'size' => 'normal'
    ],

    [
        'img' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=800&auto=format&fit=crop',
        'title' => 'Pepperoni Feast',
        'cat' => 'Pizza',
        'size' => 'wide'
    ],

    [
        'img' => 'https://images.unsplash.com/photo-1559321666-e65a17d08f12?q=80&w=800&auto=format&fit=crop',
        'title' => 'Sunday Brunch',
        'cat' => 'Events',
        'size' => 'tall'
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

:root,
[data-theme="dark"]{

    --bg-body:#09090b;

    --bg-card:#1e1e22;

    --bg-card-hover:#26262b;

    --border:
    rgba(255,255,255,0.08);

    --text-main:#ffffff;

    --text-sec:#a1a1aa;

    --accent:#6C5CE7;

    --accent-glow:#a29bfe;

    --accent-dark:#4834d4;

    --overlay:
    rgba(0,0,0,0.7);

    --radius:24px;

}

[data-theme="light"]{

    --bg-body:#f5f5f7;

    --bg-card:#ffffff;

    --bg-card-hover:#fafafa;

    --border:
    rgba(0,0,0,0.08);

    --text-main:#111111;

    --text-sec:#666666;

}

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

}

/* =========================================================
BACKGROUND
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

    filter:blur(150px);

}

.co-blob-1{

    width:500px;
    height:500px;

    background:
    rgba(108,92,231,.08);

    top:-200px;
    right:-150px;

}

.co-blob-2{

    width:400px;
    height:400px;

    background:
    rgba(0,184,148,.08);

    bottom:-150px;
    left:-100px;

}

/* =========================================================
HERO
========================================================= */

.gallery-hero{

    position:relative;

    width:100%;

    height:400px;

    display:flex;

    align-items:center;

    justify-content:center;

    text-align:center;

    border-radius:
    0 0 40px 40px;

    overflow:hidden;

    margin-bottom:60px;

}

.gallery-hero-bg{

    position:absolute;

    inset:0;

}

.gallery-hero-bg img{

    width:100%;
    height:100%;

    object-fit:cover;

    filter:brightness(.6);

}

.gallery-hero-overlay{

    position:absolute;

    inset:0;

    background:
    linear-gradient(
    to bottom,
    rgba(9,9,11,.3),
    rgba(9,9,11,1)
    );

}

.gallery-hero-content{

    position:relative;

    z-index:2;

}

.gallery-badge{

    display:inline-block;

    background:
    linear-gradient(
    135deg,
    var(--accent),
    var(--accent-dark)
    );

    color:#fff;

    padding:8px 20px;

    border-radius:50px;

    font-size:13px;

    font-weight:600;

    margin-bottom:15px;

}

.gallery-hero h1{

    font-size:
    clamp(36px,6vw,64px);

    font-weight:800;

    margin-bottom:10px;

}

.gallery-hero p{

    font-size:16px;

    color:var(--text-sec);

    max-width:600px;

    margin:0 auto;

}

/* =========================================================
FILTERS
========================================================= */

.gallery-filters{

    display:flex;

    justify-content:center;

    gap:10px;

    margin-bottom:40px;

    flex-wrap:wrap;

}

.filter-btn{

    padding:10px 24px;

    border-radius:30px;

    border:
    1px solid var(--border);

    background:var(--bg-card);

    color:var(--text-sec);

    cursor:pointer;

    transition:.3s;

    font-size:14px;

    font-weight:500;

}

.filter-btn:hover,
.filter-btn.active{

    background:var(--accent);

    color:#fff;

    border-color:var(--accent);

}

/* =========================================================
GRID
========================================================= */

.gallery-container{

    position:relative;

    z-index:1;

    max-width:1300px;

    margin:0 auto;

    padding:
    0 20px 100px;

}

.gallery-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fill,minmax(300px,1fr));

    gap:24px;

}

.gallery-item{

    position:relative;

    border-radius:var(--radius);

    overflow:hidden;

    background:var(--bg-card);

    border:
    1px solid var(--border);

    cursor:pointer;

    transition:.4s;

}

.gallery-item:hover{

    transform:
    translateY(-10px);

    border-color:var(--accent);

    box-shadow:
    0 15px 40px rgba(108,92,231,.25);

}

.gallery-img-wrap{

    width:100%;

    height:350px;

    overflow:hidden;

}

.gallery-img-wrap img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.6s;

}

.gallery-item:hover .gallery-img-wrap img{

    transform:scale(1.1);

}

.gallery-item[data-size="wide"]{

    grid-column:span 2;

}

.gallery-item[data-size="tall"] .gallery-img-wrap{

    height:420px;

}

/* =========================================================
OVERLAY
========================================================= */

.gallery-info{

    position:absolute;

    inset:0;

    background:
    linear-gradient(
    to top,
    rgba(0,0,0,.9),
    transparent 50%
    );

    display:flex;

    flex-direction:column;

    justify-content:flex-end;

    padding:24px;

    opacity:0;

    transition:.4s;

}

.gallery-item:hover .gallery-info{

    opacity:1;

}

.gallery-info h3{

    font-size:22px;

    font-weight:700;

    margin-bottom:5px;

    color:#fff;

}

.gallery-cat{

    font-size:13px;

    color:var(--accent-glow);

    font-weight:600;

    text-transform:uppercase;

}

.view-btn{

    margin-top:14px;

    align-self:flex-start;

    background:
    rgba(255,255,255,.15);

    backdrop-filter:blur(6px);

    color:#fff;

    border:
    1px solid rgba(255,255,255,.2);

    padding:8px 16px;

    border-radius:20px;

    font-size:12px;

    font-weight:600;

}

/* =========================================================
LIGHTBOX
========================================================= */

.lightbox{

    position:fixed;

    inset:0;

    background:
    rgba(0,0,0,.9);

    z-index:9999;

    display:flex;

    align-items:center;

    justify-content:center;

    opacity:0;

    visibility:hidden;

    transition:.3s;

}

.lightbox.active{

    opacity:1;

    visibility:visible;

}

.lightbox img{

    max-width:90%;

    max-height:90vh;

    border-radius:16px;

}

.close-lightbox{

    position:absolute;

    top:30px;
    right:30px;

    width:45px;
    height:45px;

    border:none;

    border-radius:50%;

    background:
    rgba(255,255,255,.1);

    color:#fff;

    cursor:pointer;

    font-size:20px;

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:768px){

    .gallery-item[data-size="wide"]{

        grid-column:span 1;

    }

    .gallery-hero{

        height:300px;

        border-radius:
        0 0 24px 24px;

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

<section class="gallery-hero">

    <div class="gallery-hero-bg">

        <img
        src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=2000&auto=format&fit=crop"
        alt="Gallery">

        <div class="gallery-hero-overlay"></div>

    </div>

    <div class="gallery-hero-content">

        <span class="gallery-badge">

            <i class="fa-solid fa-camera"></i>

            Visual Treat

        </span>

        <h1>

            Our Gallery

        </h1>

        <p>

            Explore premium food and café interiors.

        </p>

    </div>

</section>

<!-- MAIN -->

<main class="gallery-container">

    <div class="gallery-filters">

        <button
        class="filter-btn active"
        onclick="filterGallery('all',this)">

            All

        </button>

        <button
        class="filter-btn"
        onclick="filterGallery('Burgers',this)">

            Burgers

        </button>

        <button
        class="filter-btn"
        onclick="filterGallery('Pizza',this)">

            Pizza

        </button>

        <button
        class="filter-btn"
        onclick="filterGallery('Coffee',this)">

            Coffee

        </button>

        <button
        class="filter-btn"
        onclick="filterGallery('Interior',this)">

            Interior

        </button>

    </div>

    <div
    class="gallery-grid"
    id="galleryGrid">

        <?php foreach($gallery as $item): ?>

            <div
            class="gallery-item"
            data-cat="<?php echo $item['cat']; ?>"
            data-size="<?php echo $item['size']; ?>"
            onclick="openLightbox('<?php echo $item['img']; ?>')">

                <div class="gallery-img-wrap">

                    <img
                    src="<?php echo $item['img']; ?>"
                    alt="<?php echo $item['title']; ?>">

                </div>

                <div class="gallery-info">

                    <h3>

                        <?php echo $item['title']; ?>

                    </h3>

                    <span class="gallery-cat">

                        <?php echo $item['cat']; ?>

                    </span>

                    <div class="view-btn">

                        View Fullscreen

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</main>

<!-- LIGHTBOX -->

<div
class="lightbox"
id="lightbox">

    <img
    src=""
    alt="Full View"
    id="lightboxImg">

    <button
    class="close-lightbox"
    onclick="closeLightbox()">

        <i class="fa-solid fa-xmark"></i>

    </button>

</div>

<?php include "footer.php"; ?>

<script>

function openLightbox(src){

    document
    .getElementById(
    'lightbox'
    )
    .classList.add(
    'active'
    );

    document
    .getElementById(
    'lightboxImg'
    )
    .src = src;

    document.body.style.overflow =
    'hidden';

}

function closeLightbox(){

    document
    .getElementById(
    'lightbox'
    )
    .classList.remove(
    'active'
    );

    document.body.style.overflow =
    '';

}

document
.getElementById(
'lightbox'
)
.addEventListener(
'click',
e=>{

    if(e.target.id === 'lightbox'){

        closeLightbox();

    }

});

function filterGallery(category,btn){

    document
    .querySelectorAll('.filter-btn')
    .forEach(b=>{

        b.classList.remove('active');

    });

    btn.classList.add('active');

    document
    .querySelectorAll('.gallery-item')
    .forEach(item=>{

        if(
        category === 'all'
        ||
        item.dataset.cat === category
        ){

            item.style.display = 'block';

        }

        else{

            item.style.display = 'none';

        }

    });

}

</script>

</body>
</html>