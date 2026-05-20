<?php

session_start();

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Loyalty Program";

/* =========================================================
REWARDS
========================================================= */

$rewards = [

    [
        "icon"  => "fa-mug-hot",
        "title" => "Free Coffee",
        "points" => "200 Points",
        "text"  => "Redeem handcrafted premium coffee for free."
    ],

    [
        "icon"  => "fa-burger",
        "title" => "Burger Combo",
        "points" => "500 Points",
        "text"  => "Get a premium burger combo meal reward."
    ],

    [
        "icon"  => "fa-gift",
        "title" => "Exclusive Gift",
        "points" => "1000 Points",
        "text"  => "Unlock surprise premium café gifts and deals."
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

.loyalty-page{

    width:100%;

    max-width:1400px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.loyalty-top{

    text-align:center;

    margin-bottom:54px;

}

.loyalty-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.loyalty-top h1{

    font-size:
    clamp(38px,6vw,78px);

    margin:
    10px 0 16px;

}

.loyalty-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
POINTS CARD
===================================================== */

.points-card{

    position:relative;

    overflow:hidden;

    padding:40px;

    border-radius:38px;

    margin-bottom:40px;

    background:
    linear-gradient(
    135deg,
    rgba(255,154,61,.16),
    rgba(255,210,122,.06)
    );

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

}

.points-card::before{

    content:"";

    position:absolute;

    top:-80px;
    right:-80px;

    width:220px;
    height:220px;

    border-radius:50%;

    background:
    rgba(255,255,255,.06);

}

.points-card h2{

    font-size:34px;

    margin-bottom:16px;

}

.points-card p{

    color:var(--text);

    line-height:1.9;

    margin-bottom:26px;

    max-width:650px;

}

/* =====================================================
POINTS
===================================================== */

.total-points{

    font-size:
    clamp(54px,8vw,90px);

    font-weight:800;

    line-height:1;

    margin-bottom:10px;

}

.total-points span{

    font-size:20px;

    font-weight:600;

    color:var(--primary);

}

/* =====================================================
BUTTON
===================================================== */

.points-btn{

    height:58px;

    padding:
    0 28px;

    border:none;

    cursor:pointer;

    border-radius:20px;

    font-size:15px;

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

.points-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
GRID
===================================================== */

.rewards-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(300px,1fr));

    gap:28px;

}

/* =====================================================
CARD
===================================================== */

.reward-card{

    padding:30px;

    border-radius:32px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    transition:.35s;

}

.reward-card:hover{

    transform:
    translateY(-8px);

}

/* =====================================================
ICON
===================================================== */

.reward-icon{

    width:84px;
    height:84px;

    margin-bottom:24px;

    border-radius:26px;

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

    font-size:34px;

}

/* =====================================================
TEXT
===================================================== */

.reward-points{

    display:inline-flex;

    padding:
    10px 16px;

    border-radius:999px;

    margin-bottom:18px;

    background:
    rgba(46,204,113,.12);

    border:
    1px solid rgba(46,204,113,.2);

    color:var(--green);

    font-size:13px;

    font-weight:600;

}

.reward-card h2{

    font-size:28px;

    margin-bottom:14px;

}

.reward-card p{

    color:var(--text);

    line-height:1.9;

    margin-bottom:26px;

}

/* =====================================================
REDEEM
===================================================== */

.reward-btn{

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

.reward-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .loyalty-page{

        padding:
        120px 14px 70px;

    }

    .points-card{

        padding:28px 20px;

        border-radius:28px;

    }

    .rewards-grid{

        grid-template-columns:1fr;

    }

    .reward-card{

        padding:24px 20px;

        border-radius:26px;

    }

    .reward-card h2{

        font-size:24px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="loyalty-page">

    <!-- TOP -->

    <div class="loyalty-top">

        <span>

            Premium Rewards

        </span>

        <h1>

            Loyalty Program

        </h1>

        <p>

            Earn reward points on every
            Hungroo Café order and redeem
            premium meals, coffee and gifts.

        </p>

    </div>

    <!-- POINTS -->

    <section class="points-card">

        <div class="total-points">

            2,450

            <span>

                Points

            </span>

        </div>

        <h2>

            Your Reward Balance

        </h2>

        <p>

            Keep ordering premium meals
            and handcrafted café drinks
            to unlock exclusive rewards
            and VIP benefits.

        </p>

        <button class="points-btn">

            View Reward History

        </button>

    </section>

    <!-- REWARDS -->

    <section class="rewards-grid">

        <?php foreach($rewards as $reward): ?>

        <article class="reward-card">

            <div class="reward-icon">

                <i class="fa-solid <?php echo $reward['icon']; ?>"></i>

            </div>

            <div class="reward-points">

                <?php echo $reward['points']; ?>

            </div>

            <h2>

                <?php echo $reward['title']; ?>

            </h2>

            <p>

                <?php echo $reward['text']; ?>

            </p>

            <button class="reward-btn">

                Redeem Reward

            </button>

        </article>

        <?php endforeach; ?>

    </section>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>