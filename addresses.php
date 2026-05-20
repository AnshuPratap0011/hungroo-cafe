<?php

session_start();

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Saved Addresses";

/* =========================================================
ADDRESSES
========================================================= */

$addresses = [

    [
        "type"    => "Home",
        "name"    => "Mahavir Kumar",
        "address" => "House No 24, Sector 22, Chandigarh, India",
        "phone"   => "+91 99999 99999"
    ],

    [
        "type"    => "Office",
        "name"    => "Mahavir Kumar",
        "address" => "IT Park Road, Chandigarh, India",
        "phone"   => "+91 88888 88888"
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

    --green:#2ecc71;

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

.address-page{

    width:100%;

    max-width:1300px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.address-top{

    text-align:center;

    margin-bottom:50px;

}

.address-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.address-top h1{

    font-size:
    clamp(38px,6vw,76px);

    margin:
    10px 0 16px;

}

.address-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
GRID
===================================================== */

.address-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(340px,1fr));

    gap:26px;

}

/* =====================================================
CARD
===================================================== */

.address-card{

    padding:28px;

    border-radius:32px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    transition:.35s;

}

.address-card:hover{

    transform:
    translateY(-8px);

}

/* =====================================================
BADGE
===================================================== */

.address-badge{

    display:inline-flex;

    align-items:center;

    gap:8px;

    padding:
    10px 16px;

    border-radius:999px;

    margin-bottom:24px;

    background:
    rgba(46,204,113,.12);

    border:
    1px solid rgba(46,204,113,.2);

    color:var(--green);

    font-size:13px;

    font-weight:600;

}

/* =====================================================
TEXT
===================================================== */

.address-card h2{

    font-size:28px;

    margin-bottom:16px;

}

.address-card p{

    color:var(--text);

    line-height:2;

    margin-bottom:14px;

}

/* =====================================================
BOTTOM
===================================================== */

.address-bottom{

    display:flex;

    align-items:center;

    gap:14px;

    flex-wrap:wrap;

    margin-top:24px;

}

/* =====================================================
BUTTON
===================================================== */

.address-btn{

    height:54px;

    padding:
    0 22px;

    border:none;

    cursor:pointer;

    border-radius:18px;

    font-size:14px;

    font-weight:700;

    transition:.35s;

}

.address-btn.primary{

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

}

.address-btn.secondary{

    background:
    rgba(255,255,255,.05);

    border:
    1px solid var(--border);

    color:var(--white);

}

.address-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
ADD CARD
===================================================== */

.add-new-card{

    min-height:100%;

    display:flex;

    flex-direction:column;

    align-items:center;
    justify-content:center;

    text-align:center;

}

.add-icon{

    width:90px;
    height:90px;

    margin-bottom:24px;

    border-radius:28px;

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

    font-size:36px;

}

.add-new-card h2{

    font-size:32px;

    margin-bottom:14px;

}

.add-new-card p{

    max-width:320px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

    margin-bottom:24px;

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .address-page{

        padding:
        120px 14px 70px;

    }

    .address-grid{

        grid-template-columns:1fr;

    }

    .address-card{

        padding:22px 18px;

        border-radius:24px;

    }

    .address-card h2{

        font-size:24px;

    }

    .address-bottom{

        flex-direction:column;

        align-items:stretch;

    }

    .address-btn{

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

<main class="address-page">

    <!-- TOP -->

    <div class="address-top">

        <span>

            Delivery Locations

        </span>

        <h1>

            Saved Addresses

        </h1>

        <p>

            Manage your saved delivery
            locations for faster checkout
            and premium ordering experience.

        </p>

    </div>

    <!-- GRID -->

    <div class="address-grid">

        <?php foreach($addresses as $address): ?>

        <article class="address-card">

            <div class="address-badge">

                <i class="fa-solid fa-location-dot"></i>

                <?php echo $address['type']; ?>

            </div>

            <h2>

                <?php echo $address['name']; ?>

            </h2>

            <p>

                <?php echo $address['address']; ?>

            </p>

            <p>

                <?php echo $address['phone']; ?>

            </p>

            <div class="address-bottom">

                <button class="address-btn primary">

                    Edit Address

                </button>

                <button class="address-btn secondary">

                    Delete

                </button>

            </div>

        </article>

        <?php endforeach; ?>

        <!-- ADD NEW -->

        <article class="address-card add-new-card">

            <div class="add-icon">

                <i class="fa-solid fa-plus"></i>

            </div>

            <h2>

                Add New Address

            </h2>

            <p>

                Save another delivery address
                for quicker premium checkout.

            </p>

            <button class="address-btn primary">

                Add Address

            </button>

        </article>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>