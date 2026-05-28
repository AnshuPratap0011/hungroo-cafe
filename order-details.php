<?php

/* =========================================================
FILE: order-details.php
FULL ORDER DETAILS PAGE
========================================================= */

include "check-auth.php";

/* =========================================================
ORDER ID
========================================================= */

if(!isset($_GET['id'])){

    header("Location: orders.php");
    exit;

}

$orderId = intval($_GET['id']);

$userId = intval($_SESSION['user_id']);

/* =========================================================
GET ORDER
========================================================= */

$orderQuery = mysqli_query(

    $conn,

    "SELECT *
    FROM orders

    WHERE

    id='$orderId'

    AND

    user_id='$userId'

    LIMIT 1"

);

if(mysqli_num_rows($orderQuery) == 0){

    header("Location: orders.php");
    exit;

}

$order =
mysqli_fetch_assoc($orderQuery);

/* =========================================================
GET ORDER ITEMS
========================================================= */

$itemsQuery = mysqli_query(

    $conn,

    "SELECT *

    FROM order_items

    WHERE order_id='$orderId'

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

Order Details | Hungroo Café

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

.details-section{

    width:100%;

    min-height:100vh;

    padding:
    140px 6% 80px;

}

/* =========================================================
TOP
========================================================= */

.details-top{

    margin-bottom:40px;

}

.details-top span{

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

    margin-bottom:18px;

}

.details-top h1{

    font-size:
    clamp(42px,5vw,72px);

    font-weight:900;

}

/* =========================================================
LAYOUT
========================================================= */

.details-layout{

    display:grid;

    grid-template-columns:
    1.1fr .9fr;

    gap:30px;

}

/* =========================================================
BOX
========================================================= */

.details-box{

    padding:30px;

    border-radius:34px;

    background:
    rgba(255,255,255,.05);

    border:
    1px solid rgba(255,255,255,.08);

    backdrop-filter:
    blur(20px);

}

/* =========================================================
ORDER INFO
========================================================= */

.info-grid{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:20px;

}

.info-card{

    padding:22px;

    border-radius:24px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid rgba(255,255,255,.06);

}

.info-card h3{

    font-size:14px;

    color:#bdbdbd;

    margin-bottom:10px;

}

.info-card p{

    font-size:22px;

    font-weight:800;

}

/* =========================================================
STATUS
========================================================= */

.status{

    color:#ffb347;

}

/* =========================================================
ITEMS
========================================================= */

.items-list{

    display:flex;

    flex-direction:column;

    gap:18px;

}

.item-card{

    padding:20px;

    border-radius:24px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid rgba(255,255,255,.06);

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:20px;

}

.item-left h2{

    font-size:20px;

    font-weight:800;

    margin-bottom:6px;

}

.item-left p{

    color:#bdbdbd;

    font-size:14px;

}

.item-price{

    font-size:22px;

    font-weight:900;

    color:#ffb347;

}

/* =========================================================
BACK BUTTON
========================================================= */

.back-btn{

    width:220px;
    height:60px;

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

    margin-top:30px;

}

/* =========================================================
PHONE
========================================================= */

@media(max-width:950px){

    .details-layout{

        grid-template-columns:1fr;

    }

}

@media(max-width:768px){

    .details-section{

        padding:
        120px 5% 60px;

    }

    .details-top h1{

        font-size:38px;

    }

    .info-grid{

        grid-template-columns:1fr;

    }

    .item-card{

        flex-direction:column;

        align-items:flex-start;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =========================================================
SECTION
========================================================= -->

<section class="details-section">

    <!-- TOP -->

    <div class="details-top">

        <span>

            Order Details

        </span>

        <h1>

            #HG<?php echo $order['id']; ?>

        </h1>

    </div>

    <!-- LAYOUT -->

    <div class="details-layout">

        <!-- LEFT -->

        <div class="details-box">

            <div class="info-grid">

                <!-- STATUS -->

                <div class="info-card">

                    <h3>

                        Order Status

                    </h3>

                    <p class="status">

                        <?php echo $order['status']; ?>

                    </p>

                </div>

                <!-- PAYMENT -->

                <div class="info-card">

                    <h3>

                        Payment Method

                    </h3>

                    <p>

                        <?php echo strtoupper($order['payment_method']); ?>

                    </p>

                </div>

                <!-- TOTAL -->

                <div class="info-card">

                    <h3>

                        Total Amount

                    </h3>

                    <p>

                        ₹<?php echo number_format($order['total_amount']); ?>

                    </p>

                </div>

                <!-- DATE -->

                <div class="info-card">

                    <h3>

                        Order Date

                    </h3>

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

            </div>

        </div>

        <!-- RIGHT -->

        <div class="details-box">

            <div class="items-list">

                <?php

                if(mysqli_num_rows($itemsQuery) > 0):

                while($item = mysqli_fetch_assoc($itemsQuery)):

                ?>

                <div class="item-card">

                    <div class="item-left">

                        <h2>

                            Product #<?php echo $item['product_id']; ?>

                        </h2>

                        <p>

                            Quantity :
                            <?php echo $item['quantity']; ?>

                        </p>

                    </div>

                    <div class="item-price">

                        ₹<?php echo number_format($item['price']); ?>

                    </div>

                </div>

                <?php endwhile; ?>

                <?php else: ?>

                <div class="item-card">

                    <div class="item-left">

                        <h2>

                            No Items Found

                        </h2>

                    </div>

                </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

    <!-- BACK -->

    <a
    href="orders.php"
    class="back-btn">

        Back Orders

    </a>

</section>

</body>
</html>