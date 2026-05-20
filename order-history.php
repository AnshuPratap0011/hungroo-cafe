<?php

session_start();

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Order History";

/* =========================================================
ORDERS
========================================================= */

$orders = [

    [
        "id"     => "#HG1024",
        "item"   => "Premium Burger Combo",
        "price"  => "₹599",
        "status" => "Delivered",
        "date"   => "18 May 2026"
    ],

    [
        "id"     => "#HG1025",
        "item"   => "Cold Coffee & Dessert",
        "price"  => "₹349",
        "status" => "Preparing",
        "date"   => "19 May 2026"
    ],

    [
        "id"     => "#HG1026",
        "item"   => "Italian Pizza Feast",
        "price"  => "₹899",
        "status" => "On The Way",
        "date"   => "19 May 2026"
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

/* =====================================================
ROOT
===================================================== */

:root{

    --bg:#070707;

    --card:#121212;

    --white:#fff;

    --text:#bdbdbd;

    --primary:#ff9a3d;

    --gold:#ffd27a;

    --green:#2ecc71;

    --blue:#3da5ff;

    --orange:#ffb347;

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

.history-page{

    width:100%;

    max-width:1300px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.history-top{

    text-align:center;

    margin-bottom:50px;

}

.history-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.history-top h1{

    font-size:
    clamp(38px,6vw,76px);

    margin:
    10px 0 16px;

}

.history-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
LIST
===================================================== */

.history-list{

    display:flex;

    flex-direction:column;

    gap:24px;

}

/* =====================================================
CARD
===================================================== */

.history-card{

    padding:28px;

    border-radius:32px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:20px;

    flex-wrap:wrap;

    transition:.35s;

}

.history-card:hover{

    transform:
    translateY(-6px);

}

/* =====================================================
LEFT
===================================================== */

.history-left{

    display:flex;

    align-items:center;

    gap:18px;

}

.history-icon{

    width:76px;
    height:76px;

    border-radius:24px;

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

    font-size:30px;

    flex-shrink:0;

}

/* =====================================================
TEXT
===================================================== */

.history-info h2{

    font-size:28px;

    margin-bottom:8px;

}

.history-info p{

    color:var(--text);

    line-height:1.8;

}

/* =====================================================
RIGHT
===================================================== */

.history-right{

    display:flex;

    align-items:center;

    gap:18px;

    flex-wrap:wrap;

}

/* =====================================================
PRICE
===================================================== */

.history-price{

    font-size:30px;

    font-weight:700;

}

/* =====================================================
STATUS
===================================================== */

.history-status{

    padding:
    10px 18px;

    border-radius:999px;

    font-size:13px;

    font-weight:700;

}

.delivered{

    background:
    rgba(46,204,113,.12);

    color:var(--green);

}

.preparing{

    background:
    rgba(255,179,71,.12);

    color:var(--orange);

}

.way{

    background:
    rgba(61,165,255,.12);

    color:var(--blue);

}

/* =====================================================
BUTTON
===================================================== */

.history-btn{

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

.history-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .history-page{

        padding:
        120px 14px 70px;

    }

    .history-card{

        padding:22px 18px;

        border-radius:24px;

        align-items:flex-start;

    }

    .history-left{

        align-items:flex-start;

    }

    .history-icon{

        width:64px;
        height:64px;

        border-radius:20px;

        font-size:24px;

    }

    .history-info h2{

        font-size:22px;

    }

    .history-right{

        width:100%;

        flex-direction:column;

        align-items:stretch;

    }

    .history-btn{

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

<main class="history-page">

    <div class="history-top">

        <span>

            Premium Orders

        </span>

        <h1>

            Order History

        </h1>

        <p>

            Track your previous premium
            Hungroo Café orders,
            delivery updates and invoices.

        </p>

    </div>

    <section class="history-list">

        <?php foreach($orders as $order): ?>

        <article class="history-card">

            <!-- LEFT -->

            <div class="history-left">

                <div class="history-icon">

                    <i class="fa-solid fa-burger"></i>

                </div>

                <div class="history-info">

                    <h2>

                        <?php echo $order['item']; ?>

                    </h2>

                    <p>

                        Order ID:
                        <?php echo $order['id']; ?>

                    </p>

                    <p>

                        Date:
                        <?php echo $order['date']; ?>

                    </p>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="history-right">

                <div class="history-price">

                    <?php echo $order['price']; ?>

                </div>

                <div class="history-status
                <?php

                if($order['status']=="Delivered"){

                    echo "delivered";

                }

                elseif($order['status']=="Preparing"){

                    echo "preparing";

                }

                else{

                    echo "way";

                }

                ?>">

                    <?php echo $order['status']; ?>

                </div>

                <button class="history-btn">

                    View Details

                </button>

            </div>

        </article>

        <?php endforeach; ?>

    </section>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>