<?php

session_start();

$pageTitle =
"Hungroo Café | Invoice";

/* =========================================================
INVOICE DATA
========================================================= */

$orderItems = [

    [
        "name"  => "Premium Cheese Burger",
        "qty"   => 2,
        "price" => 349
    ],

    [
        "name"  => "Cold Coffee",
        "qty"   => 1,
        "price" => 229
    ],

    [
        "name"  => "Chocolate Dessert",
        "qty"   => 1,
        "price" => 279
    ]

];

$subtotal = 1206;
$delivery = 0;
$total = 1206;

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
href="assets/css/responsive.css">

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

/* =========================================================
RESET
========================================================= */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

/* =========================================================
BODY
========================================================= */

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

/* =========================================================
PAGE
========================================================= */

.invoice-page{

    width:100%;

    max-width:1100px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =========================================================
CARD
========================================================= */

.invoice-card{

    padding:34px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

}

/* =========================================================
TOP
========================================================= */

.invoice-top{

    display:flex;

    align-items:flex-start;
    justify-content:space-between;

    gap:20px;

    flex-wrap:wrap;

    padding-bottom:30px;

    border-bottom:
    1px solid var(--border);

}

.invoice-logo h1{

    font-size:
    clamp(36px,6vw,58px);

    margin-bottom:10px;

}

.invoice-logo span{

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    -webkit-background-clip:text;

    -webkit-text-fill-color:
    transparent;

}

.invoice-logo p{

    color:var(--text);

    line-height:1.8;

}

.invoice-id{

    text-align:right;

}

.invoice-id h2{

    font-size:32px;

    margin-bottom:12px;

}

.invoice-id p{

    color:var(--text);

    line-height:1.9;

}

/* =========================================================
CUSTOMER
========================================================= */

.invoice-customer{

    margin:
    34px 0;

    padding:
    28px;

    border-radius:26px;

    background:
    rgba(255,255,255,.03);

    border:
    1px solid var(--border);

}

.invoice-customer h3{

    font-size:28px;

    margin-bottom:14px;

}

.invoice-customer p{

    color:var(--text);

    line-height:2;

}

/* =========================================================
TABLE
========================================================= */

.invoice-table{

    width:100%;

    overflow-x:auto;

}

.invoice-table table{

    width:100%;

    border-collapse:collapse;

    min-width:700px;

}

.invoice-table th{

    text-align:left;

    padding:18px;

    background:
    rgba(255,255,255,.04);

    color:var(--white);

    font-size:14px;

}

.invoice-table td{

    padding:20px 18px;

    border-bottom:
    1px solid var(--border);

    color:var(--text);

}

/* =========================================================
TOTAL
========================================================= */

.invoice-total{

    margin-top:34px;

    margin-left:auto;

    width:100%;

    max-width:360px;

}

.total-row{

    display:flex;

    align-items:center;
    justify-content:space-between;

    padding:
    14px 0;

    border-bottom:
    1px solid var(--border);

}

.total-row h3{

    font-size:16px;

}

.total-row.total-final{

    border:none;

    padding-top:24px;

}

.total-final h2{

    font-size:32px;

}

/* =========================================================
BUTTONS
========================================================= */

.invoice-buttons{

    display:flex;

    gap:18px;

    flex-wrap:wrap;

    margin-top:40px;

}

.invoice-btn{

    flex:1;

    min-width:220px;

    height:58px;

    border:none;

    cursor:pointer;

    border-radius:20px;

    font-size:15px;

    font-weight:700;

    transition:.35s;

}

.invoice-btn.primary{

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

}

.invoice-btn.secondary{

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:var(--white);

}

.invoice-btn:hover{

    transform:
    translateY(-4px);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:768px){

    .invoice-page{

        padding:
        120px 14px 70px;

    }

    .invoice-card{

        padding:22px 18px;

        border-radius:24px;

    }

    .invoice-top{

        flex-direction:column;

    }

    .invoice-id{

        text-align:left;

    }

    .invoice-customer{

        padding:20px;

        border-radius:22px;

    }

    .invoice-buttons{

        flex-direction:column;

    }

    .invoice-btn{

        width:100%;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<main class="invoice-page">

    <div class="invoice-card">

        <!-- TOP -->

        <div class="invoice-top">

            <div class="invoice-logo">

                <h1>

                    <span>Hungroo</span> Café

                </h1>

                <p>

                    Premium Café & Restaurant Experience

                </p>

            </div>

            <div class="invoice-id">

                <h2>

                    Invoice

                </h2>

                <p>

                    Invoice ID:
                    #INV1024

                </p>

                <p>

                    Date:
                    20 May 2026

                </p>

            </div>

        </div>

        <!-- CUSTOMER -->

        <div class="invoice-customer">

            <h3>

                Customer Details

            </h3>

            <p>

                Mahavir Kumar

            </p>

            <p>

                Chandigarh, India

            </p>

            <p>

                +91 99999 99999

            </p>

        </div>

        <!-- TABLE -->

        <div class="invoice-table">

            <table>

                <thead>

                    <tr>

                        <th>

                            Item

                        </th>

                        <th>

                            Quantity

                        </th>

                        <th>

                            Price

                        </th>

                        <th>

                            Total

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach($orderItems as $item): ?>

                    <tr>

                        <td>

                            <?php echo $item['name']; ?>

                        </td>

                        <td>

                            <?php echo $item['qty']; ?>

                        </td>

                        <td>

                            ₹<?php echo $item['price']; ?>

                        </td>

                        <td>

                            ₹<?php echo $item['qty'] * $item['price']; ?>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <!-- TOTAL -->

        <div class="invoice-total">

            <div class="total-row">

                <h3>

                    Subtotal

                </h3>

                <p>

                    ₹<?php echo $subtotal; ?>

                </p>

            </div>

            <div class="total-row">

                <h3>

                    Delivery

                </h3>

                <p>

                    FREE

                </p>

            </div>

            <div class="total-row total-final">

                <h2>

                    Total

                </h2>

                <h2>

                    ₹<?php echo $total; ?>

                </h2>

            </div>

        </div>

        <!-- BUTTONS -->

        <div class="invoice-buttons">

            <button
            class="invoice-btn primary"

            onclick="window.print()">

                Print Invoice

            </button>

            <button
            class="invoice-btn secondary">

                Download PDF

            </button>

        </div>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

<script src="assets/js/preloader.js"></script>

</body>
</html>