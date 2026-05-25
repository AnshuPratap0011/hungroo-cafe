<?php

session_start();

/* =========================================================
CONFIG
========================================================= */

include "config/config.php";

/* =========================================================
GET ORDER
========================================================= */

if(!isset($_GET['id'])){

    header(
    "Location: home.php"
    );

    exit();

}

$order_id =

intval(
$_GET['id']
);

/* =========================================================
FETCH ORDER
========================================================= */

$query =

"SELECT * FROM orders
WHERE id='$order_id'
LIMIT 1";

$result =

mysqli_query(
$conn,
$query
);

if(mysqli_num_rows($result) < 1){

    header(
    "Location: home.php"
    );

    exit();

}

$order =

mysqli_fetch_assoc(
$result
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

Order Success

</title>

<link
rel="stylesheet"
href="assets/css/navbar.css">

<link
rel="stylesheet"
href="assets/css/footer.css">

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

/* =========================================================
ROOT
========================================================= */

:root{

    --bg:#070707;

    --card:#121212;

    --white:#ffffff;

    --text:#bdbdbd;

    --primary:#ff9a3d;

    --gold:#ffd27a;

    --border:
    rgba(255,255,255,.08);

}

/* =========================================================
RESET
========================================================= */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

body{

    background:var(--bg);

    color:var(--white);

    font-family:'Poppins',sans-serif;

}

/* =========================================================
PAGE
========================================================= */

.success-page{

    min-height:100vh;

    display:flex;

    align-items:center;
    justify-content:center;

    padding:
    140px 5% 80px;

}

/* =========================================================
CARD
========================================================= */

.success-card{

    width:100%;
    max-width:720px;

    text-align:center;

    padding:50px 40px;

    border-radius:36px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    position:relative;

    overflow:hidden;

}

.success-card::before{

    content:"";

    position:absolute;

    top:-120px;
    right:-120px;

    width:260px;
    height:260px;

    border-radius:50%;

    background:
    rgba(255,154,61,.08);

}

/* =========================================================
ICON
========================================================= */

.success-icon{

    width:120px;
    height:120px;

    margin:
    0 auto 30px;

    border-radius:50%;

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

    font-size:50px;

}

/* =========================================================
TEXT
========================================================= */

.success-card h1{

    font-size:48px;

    margin-bottom:14px;

}

.success-card p{

    color:var(--text);

    line-height:1.9;

    margin-bottom:36px;

}

/* =========================================================
ORDER BOX
========================================================= */

.order-box{

    padding:28px;

    border-radius:26px;

    background:
    rgba(255,255,255,.03);

    border:
    1px solid var(--border);

    text-align:left;

    margin-bottom:34px;

}

.order-row{

    display:flex;

    justify-content:space-between;

    gap:20px;

    margin-bottom:18px;

}

.order-row:last-child{

    margin-bottom:0;

}

.order-row span{

    color:var(--text);

}

.order-row strong{

    color:#fff;

}

/* =========================================================
BUTTONS
========================================================= */

.button-group{

    display:flex;

    justify-content:center;

    gap:18px;

    flex-wrap:wrap;

}

.action-btn{

    min-width:220px;

    height:60px;

    border:none;

    border-radius:18px;

    text-decoration:none;

    display:flex;

    align-items:center;
    justify-content:center;

    font-size:15px;

    font-weight:800;

}

.home-btn{

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

}

.menu-btn{

    background:
    rgba(255,255,255,.06);

    border:
    1px solid var(--border);

    color:#fff;

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:768px){

    .success-card{

        padding:36px 24px;

        border-radius:28px;

    }

    .success-card h1{

        font-size:36px;

    }

    .success-icon{

        width:100px;
        height:100px;

        font-size:42px;

    }

    .order-row{

        flex-direction:column;

    }

    .action-btn{

        width:100%;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<section class="success-page">

    <div class="success-card">

        <!-- ICON -->

        <div class="success-icon">

            <i class="fa-solid fa-check"></i>

        </div>

        <!-- TEXT -->

        <h1>

            Order Successful

        </h1>

        <p>

            Your delicious order has been placed successfully.
            Our team will prepare your food soon.

        </p>

        <!-- ORDER DETAILS -->

        <div class="order-box">

            <div class="order-row">

                <span>

                    Order ID

                </span>

                <strong>

                    #<?php echo $order['id']; ?>

                </strong>

            </div>

            <div class="order-row">

                <span>

                    Customer Name

                </span>

                <strong>

                    <?php echo $order['customer_name']; ?>

                </strong>

            </div>

            <div class="order-row">

                <span>

                    Payment Method

                </span>

                <strong>

                    <?php echo $order['payment_method']; ?>

                </strong>

            </div>

            <div class="order-row">

                <span>

                    Order Status

                </span>

                <strong>

                    <?php echo ucfirst($order['order_status']); ?>

                </strong>

            </div>

            <div class="order-row">

                <span>

                    Total Amount

                </span>

                <strong>

                    ₹<?php echo number_format($order['total_amount']); ?>

                </strong>

            </div>

        </div>

        <!-- BUTTONS -->

        <div class="button-group">

            <a
            href="home.php"

            class="action-btn home-btn">

                Back To Home

            </a>

            <a
            href="menu.php"

            class="action-btn menu-btn">

                Order More

            </a>

        </div>

    </div>

</section>

<?php include "footer.php"; ?>

</body>
</html>