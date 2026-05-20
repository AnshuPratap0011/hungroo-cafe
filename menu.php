<?php

session_start();

$pageTitle =
"Hungroo Café | Menu";

/* =========================================================
MENU ITEMS
========================================================= */

$menuItems = [

    [
        "id"    => 1,
        "name"  => "Premium Burger",
        "price" => 349,
        "image" => "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1400&auto=format&fit=crop",
        "category" => "Burger"
    ],

    [
        "id"    => 2,
        "name"  => "Italian Pizza",
        "price" => 599,
        "image" => "https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=1400&auto=format&fit=crop",
        "category" => "Pizza"
    ],

    [
        "id"    => 3,
        "name"  => "Cold Coffee",
        "price" => 229,
        "image" => "https://images.unsplash.com/photo-1517701604599-bb29b565090c?q=80&w=1400&auto=format&fit=crop",
        "category" => "Drinks"
    ],

    [
        "id"    => 4,
        "name"  => "Chocolate Dessert",
        "price" => 279,
        "image" => "https://images.unsplash.com/photo-1551024601-bec78aea704b?q=80&w=1400&auto=format&fit=crop",
        "category" => "Dessert"
    ],

    [
        "id"    => 5,
        "name"  => "Cheese Pasta",
        "price" => 449,
        "image" => "https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?q=80&w=1400&auto=format&fit=crop",
        "category" => "Pasta"
    ],

    [
        "id"    => 6,
        "name"  => "Chicken Sandwich",
        "price" => 329,
        "image" => "https://images.unsplash.com/photo-1528735602780-2552fd46c7af?q=80&w=1400&auto=format&fit=crop",
        "category" => "Sandwich"
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
href="assets/css/home.css">

<style>

/* =========================================================
MENU PAGE
========================================================= */

.menu-page{

    width:100%;

    max-width:1450px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =========================================================
TOP
========================================================= */

.menu-top{

    text-align:center;

    margin-bottom:50px;

}

.menu-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.menu-top h1{

    font-size:
    clamp(42px,6vw,82px);

    margin:
    10px 0 16px;

}

.menu-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:2;

}

/* =========================================================
FILTERS
========================================================= */

.menu-filters{

    display:flex;

    justify-content:center;

    gap:14px;

    flex-wrap:wrap;

    margin-bottom:50px;

}

.filter-btn{

    border:none;

    outline:none;

    cursor:pointer;

    padding:
    14px 24px;

    border-radius:999px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:var(--white);

    font-size:14px;

    font-weight:600;

    transition:.35s;

}

.filter-btn.active,
.filter-btn:hover{

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

}

/* =========================================================
MENU GRID
========================================================= */

.menu-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(300px,1fr));

    gap:28px;

}

/* =========================================================
CATEGORY
========================================================= */

.food-category{

    position:absolute;

    top:18px;
    left:18px;

    padding:
    10px 16px;

    border-radius:999px;

    background:
    rgba(0,0,0,.65);

    backdrop-filter:
    blur(10px);

    color:#fff;

    font-size:12px;

    font-weight:700;

    z-index:2;

}

/* =========================================================
SEARCH
========================================================= */

.menu-search{

    width:100%;

    max-width:600px;

    margin:
    0 auto 40px;

    position:relative;

}

.menu-search input{

    width:100%;

    height:62px;

    border:none;

    outline:none;

    padding:
    0 60px 0 22px;

    border-radius:20px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:var(--white);

    font-size:15px;

}

.menu-search i{

    position:absolute;

    top:50%;
    right:22px;

    transform:
    translateY(-50%);

    color:var(--text);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:768px){

    .menu-page{

        padding:
        120px 14px 70px;

    }

    .menu-grid{

        grid-template-columns:1fr;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =========================================================
MENU PAGE
========================================================= -->

<section class="menu-page">

    <!-- TOP -->

    <div class="menu-top">

        <span>

            Premium Food Menu

        </span>

        <h1>

            Explore Our Menu

        </h1>

        <p>

            Discover handcrafted burgers,
            luxury coffee, desserts and
            premium café meals.

        </p>

    </div>

    <!-- SEARCH -->

    <div class="menu-search">

        <input
        type="text"

        id="menuSearch"

        placeholder=
        "Search delicious food...">

        <i class="fa-solid fa-magnifying-glass"></i>

    </div>

    <!-- FILTERS -->

    <div class="menu-filters">

        <button
        class="filter-btn active"

        data-filter="all">

            All

        </button>

        <button
        class="filter-btn"

        data-filter="Burger">

            Burger

        </button>

        <button
        class="filter-btn"

        data-filter="Pizza">

            Pizza

        </button>

        <button
        class="filter-btn"

        data-filter="Drinks">

            Drinks

        </button>

        <button
        class="filter-btn"

        data-filter="Dessert">

            Dessert

        </button>

    </div>

    <!-- GRID -->

    <div class="menu-grid" id="menuGrid">

        <?php foreach($menuItems as $item): ?>

        <div
        class="food-card"

        data-category=
        "<?php echo $item['category']; ?>"

        data-name=
        "<?php echo strtolower($item['name']); ?>">

            <!-- IMAGE -->

            <div class="food-image">

                <div class="food-category">

                    <?php echo $item['category']; ?>

                </div>

                <img
                src="<?php echo $item['image']; ?>"
                alt="<?php echo $item['name']; ?>">

            </div>

            <!-- CONTENT -->

            <div class="food-content">

                <h3>

                    <?php echo $item['name']; ?>

                </h3>

                <p>

                    Premium handcrafted food
                    with unforgettable taste.

                </p>

                <!-- BOTTOM -->

                <div class="food-bottom">

                    <div class="food-price">

                        ₹<?php echo $item['price']; ?>

                    </div>

                    <button
                    class="food-btn"

                    onclick='addToCart(
                    <?php echo json_encode($item); ?>
                    )'>

                        Add To Cart

                    </button>

                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</section>

<?php include "footer.php"; ?>

<!-- =========================================================
CART SYSTEM
========================================================= -->

<script>

let cart =

JSON.parse(
localStorage.getItem("hungrooCart")
) || [];

/* =========================================================
ADD TO CART
========================================================= */

function addToCart(item){

    const existing =

    cart.find(product=>
    product.id === item.id
    );

    if(existing){

        existing.qty += 1;

    }

    else{

        cart.push({

            ...item,

            qty:1

        });

    }

    localStorage.setItem(

        "hungrooCart",

        JSON.stringify(cart)

    );

    updateCartCount();

}

/* =========================================================
UPDATE COUNT
========================================================= */

function updateCartCount(){

    const cartCount =

    document.querySelector(
    ".cart-count"
    );

    let total = 0;

    cart.forEach(item=>{

        total += item.qty;

    });

    if(cartCount){

        cartCount.innerText =
        total;

    }

}

updateCartCount();

/* =========================================================
FILTER SYSTEM
========================================================= */

const filterButtons =

document.querySelectorAll(
".filter-btn"
);

const foodCards =

document.querySelectorAll(
".food-card"
);

filterButtons.forEach(button=>{

    button.addEventListener(

        "click",

        ()=>{

            filterButtons.forEach(btn=>
            btn.classList.remove(
            "active"
            ));

            button.classList.add(
            "active"
            );

            const filter =

            button.dataset.filter;

            foodCards.forEach(card=>{

                if(

                    filter === "all"

                    ||

                    card.dataset.category
                    === filter

                ){

                    card.style.display =
                    "block";

                }

                else{

                    card.style.display =
                    "none";

                }

            });

        }

    );

});

/* =========================================================
SEARCH
========================================================= */

const menuSearch =

document.getElementById(
"menuSearch"
);

menuSearch.addEventListener(

    "keyup",

    ()=>{

        const value =

        menuSearch.value
        .toLowerCase();

        foodCards.forEach(card=>{

            const itemName =

            card.dataset.name;

            if(

                itemName.includes(value)

            ){

                card.style.display =
                "block";

            }

            else{

                card.style.display =
                "none";

            }

        });

    }

);

</script>

<script src="assets/js/theme.js"></script>

<script src="assets/js/preloader.js"></script>

</body>
</html>