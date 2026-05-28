<?php

/* =========================================================
FILE: orders.php
FULL DYNAMIC ORDERS PAGE
========================================================= */

include "check-auth.php";

/* =========================================================
USER ID
========================================================= */

$userId = intval($_SESSION['user_id']);

/* =========================================================
GET ORDERS
========================================================= */

$ordersQuery = mysqli_query(

    $conn,

    "SELECT *
    FROM orders

    WHERE user_id='$userId'

    ORDER BY id DESC"

);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

My Orders | Hungroo Café

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
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
rel="stylesheet">

<!-- FONT AWESOME -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- NAVBAR -->

<link
rel="stylesheet"
href="assets/css/navbar.css">

<!-- =========================================================
INLINE CSS
========================================================= -->

<style>

/* =========================================================
ROOT
========================================================= */

:root{

    --primary:#ff6b00;
    --secondary:#ffb347;

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

    background:
    linear-gradient(
    180deg,
    #050505,
    #0d0d0d
    );

    font-family:'Poppins',sans-serif;

    color:#fff;

    overflow-x:hidden;

}

/* =========================================================
SECTION
========================================================= */

.orders-section{

    width:100%;

    min-height:100vh;

    padding:
    140px 6% 80px;

}

/* =========================================================
TITLE
========================================================= */

.orders-top{

    margin-bottom:50px;

}

.orders-top span{

    display:inline-flex;

    padding:12px 22px;

    border-radius:999px;

    background:
    rgba(255,255,255,.06);

    border:
    1px solid rgba(255,255,255,.08);

    color:#ffb347;

    font-size:13px;

    font-weight:700;

    margin-bottom:20px;

}

.orders-top h1{

    font-size:
    clamp(42px,5vw,74px);

    font-weight:900;

    line-height:1.05;

}

/* =========================================================
GRID
========================================================= */

.orders-grid{

    display:grid;

    grid-template-columns:
    repeat(3,1fr);

    gap:28px;

}

/* =========================================================
CARD
========================================================= */

.order-card{

    padding:30px;

    border-radius:34px;

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);

    backdrop-filter:
    blur(20px);

    transition:.35s;

}

.order-card:hover{

    transform:
    translateY(-6px);

}

/* =========================================================
TOP
========================================================= */

.order-top{

    display:flex;

    align-items:flex-start;
    justify-content:space-between;

    gap:20px;

    margin-bottom:26px;

}

.order-top h2{

    font-size:26px;

    font-weight:800;

    margin-bottom:8px;

}

.order-top p{

    color:#bdbdbd;

    font-size:14px;

}

/* =========================================================
STATUS
========================================================= */

.status{

    padding:10px 16px;

    border-radius:999px;

    background:
    rgba(255,255,255,.06);

    border:
    1px solid rgba(255,255,255,.08);

    color:#ffb347;

    font-size:12px;

    font-weight:700;

    text-transform:capitalize;

}

/* =========================================================
PRICE
========================================================= */

.order-price{

    margin-bottom:28px;

}

.order-price h3{

    font-size:42px;

    font-weight:900;

    color:#ffb347;

}

/* =========================================================
BUTTONS
========================================================= */

.order-actions{

    display:flex;

    gap:14px;

}

.order-btn{

    flex:1;

    height:56px;

    border-radius:18px;

    display:flex;

    align-items:center;
    justify-content:center;

    text-decoration:none;

    font-size:14px;

    font-weight:700;

    transition:.35s;

}

.view-btn{

    background:
    linear-gradient(
    135deg,
    #ff6b00,
    #ffb347
    );

    color:#fff;

}

.view-btn:hover{

    transform:
    translateY(-4px);

}

.track-btn{

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);

    color:#fff;

}

.track-btn:hover{

    transform:
    translateY(-4px);

}

/* =========================================================
EMPTY
========================================================= */

.empty-orders{

    width:100%;

    min-height:420px;

    border-radius:40px;

    display:flex;

    flex-direction:column;

    align-items:center;
    justify-content:center;

    text-align:center;

    gap:18px;

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);

}

.empty-orders i{

    font-size:84px;

    color:#ff6b00;

}

.empty-orders h2{

    font-size:42px;

    font-weight:900;

}

.empty-orders p{

    color:#bdbdbd;

}

.empty-orders a{

    min-width:220px;
    height:60px;

    padding:0 24px;

    border-radius:22px;

    display:flex;

    align-items:center;
    justify-content:center;

    text-decoration:none;

    background:
    linear-gradient(
    135deg,
    #ff6b00,
    #ffb347
    );

    color:#fff;

    font-size:15px;

    font-weight:700;

    margin-top:10px;

}

/* =========================================================
PHONE
========================================================= */

@media(max-width:1100px){

    .orders-grid{

        grid-template-columns:
        repeat(2,1fr);

    }

}

@media(max-width:768px){

    .orders-section{

        padding:
        120px 5% 60px;

    }

    .orders-grid{

        display:flex;

        overflow-x:auto;

        gap:18px;

        padding-bottom:10px;

    }

    .orders-grid::-webkit-scrollbar{

        display:none;

    }

    .order-card{

        min-width:320px;

        flex:none;

    }

    .orders-top h1{

        font-size:38px;

    }

    .order-price h3{

        font-size:34px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =========================================================
SECTION
========================================================= -->

<section class="orders-section">

    <!-- TITLE -->

    <div class="orders-top">

        <span>

            My Orders

        </span>

        <h1>

            Order History

        </h1>

    </div>

    <!-- ORDERS -->

    <?php if(mysqli_num_rows($ordersQuery) > 0): ?>

    <div class="orders-grid">

        <?php while($order = mysqli_fetch_assoc($ordersQuery)): ?>

        <div class="order-card">

            <!-- TOP -->

            <div class="order-top">

                <div>

                    <h2>

                        #HG<?php echo $order['id']; ?>

                    </h2>

                    <p>

                        <?php

                        echo date(

                            "d M Y",

                            strtotime(
                            $order['created_at']
                            )

                        );

                        ?>

                    </p>

                </div>

                <div class="status">

                    <?php echo $order['status']; ?>

                </div>

            </div>

            <!-- PRICE -->

            <div class="order-price">

                <h3>

                    ₹<?php echo number_format($order['total_amount']); ?>

                </h3>

            </div>

            <!-- BUTTONS -->

            <div class="order-actions">

                <a
                href="order-details.php?id=<?php echo $order['id']; ?>"
                class="order-btn view-btn">

                    View Details

                </a>

                <a
                href="#"
                class="order-btn track-btn">

                    Track

                </a>

            </div>

        </div>

        <?php endwhile; ?>

    </div>

    <?php else: ?>

    <!-- EMPTY -->

    <div class="empty-orders">

        <i class="fa-solid fa-bag-shopping"></i>

        <h2>

            No Orders Yet

        </h2>

        <p>

            Your delicious orders will appear here.

        </p>

        <a href="menu.php">

            Explore Menu

        </a>

    </div>

    <?php endif; ?>

</section>

</body>
</html>