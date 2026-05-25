<?php

session_start();

/* =========================================================
CONFIG
========================================================= */

include "config/config.php";

/* =========================================================
CART
========================================================= */

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){

    header(
    "Location: cart.php"
    );

    exit();

}

$cart = $_SESSION['cart'];

/* =========================================================
TOTAL
========================================================= */

$total = 0;

foreach($cart as $item){

    $total +=
    $item['price'] *
    $item['quantity'];

}

$grand_total =
$total + 49;

/* =========================================================
PLACE ORDER
========================================================= */

if(isset($_POST['place_order'])){

    $customer_name =

    mysqli_real_escape_string(
    $conn,
    $_POST['customer_name']
    );

    $customer_phone =

    mysqli_real_escape_string(
    $conn,
    $_POST['customer_phone']
    );

    $customer_address =

    mysqli_real_escape_string(
    $conn,
    $_POST['customer_address']
    );

    $payment_method =

    mysqli_real_escape_string(
    $conn,
    $_POST['payment_method']
    );

    /* =====================================================
    INSERT ORDER
    ====================================================== */

    $insertOrder =

    "INSERT INTO orders (

        customer_name,
        customer_phone,
        customer_address,
        payment_method,
        total_amount,
        order_status

    )

    VALUES (

        '$customer_name',
        '$customer_phone',
        '$customer_address',
        '$payment_method',
        '$grand_total',
        'pending'

    )";

    mysqli_query(
    $conn,
    $insertOrder
    );

    $order_id =

    mysqli_insert_id(
    $conn
    );

    /* =====================================================
    ORDER ITEMS
    ====================================================== */

    foreach($cart as $item){

        $product_name =
        $item['name'];

        $product_price =
        $item['price'];

        $quantity =
        $item['quantity'];

        $subtotal =
        $product_price *
        $quantity;

        $insertItems =

        "INSERT INTO order_items (

            order_id,
            product_name,
            product_price,
            quantity,
            subtotal

        )

        VALUES (

            '$order_id',
            '$product_name',
            '$product_price',
            '$quantity',
            '$subtotal'

        )";

        mysqli_query(
        $conn,
        $insertItems
        );

    }

    /* =====================================================
    CLEAR CART
    ====================================================== */

    unset($_SESSION['cart']);

    /* =====================================================
    REDIRECT
    ====================================================== */

    header(
    "Location: success.php?id=$order_id"
    );

    exit();

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Checkout

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

:root{

    --bg:#070707;
    --card:#121212;
    --white:#ffffff;
    --text:#bdbdbd;
    --primary:#ff9a3d;
    --gold:#ffd27a;
    --border:rgba(255,255,255,.08);

}

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

.checkout-page{

    padding:
    140px 5% 80px;

}

.checkout-top{

    margin-bottom:40px;

}

.checkout-top h1{

    font-size:52px;

    margin-bottom:10px;

}

.checkout-top p{

    color:var(--text);

}

.checkout-grid{

    display:grid;

    grid-template-columns:
    1fr 400px;

    gap:28px;

}

.checkout-form{

    padding:34px;

    border-radius:30px;

    background:var(--card);

    border:1px solid var(--border);

}

.form-group{

    margin-bottom:22px;

}

.form-group label{

    display:block;

    margin-bottom:10px;

    font-size:14px;

    font-weight:600;

}

.form-group input,
.form-group textarea,
.form-group select{

    width:100%;

    border:none;
    outline:none;

    padding:18px;

    border-radius:18px;

    background:
    rgba(255,255,255,.04);

    border:1px solid var(--border);

    color:#fff;

    font-size:14px;

    font-family:'Poppins',sans-serif;

}

.form-group textarea{

    height:140px;

    resize:none;

}

.form-group select option{

    background:#111;

}

.place-btn{

    width:100%;
    height:62px;

    border:none;

    cursor:pointer;

    border-radius:18px;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:15px;

    font-weight:800;

}

.summary-box{

    position:sticky;

    top:120px;

    height:max-content;

    padding:30px;

    border-radius:30px;

    background:var(--card);

    border:1px solid var(--border);

}

.summary-box h2{

    font-size:30px;

    margin-bottom:28px;

}

.summary-item{

    display:flex;

    justify-content:space-between;

    margin-bottom:16px;

    color:var(--text);

}

.summary-total{

    display:flex;

    justify-content:space-between;

    margin-top:24px;

    padding-top:22px;

    border-top:
    1px solid var(--border);

    font-size:22px;

    font-weight:700;

}

@media(max-width:992px){

    .checkout-grid{

        grid-template-columns:1fr;

    }

}

@media(max-width:768px){

    .checkout-top h1{

        font-size:38px;

    }

    .checkout-form,
    .summary-box{

        padding:24px;

        border-radius:24px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<section class="checkout-page">

    <div class="checkout-top">

        <h1>

            Checkout

        </h1>

        <p>

            Complete your delicious order

        </p>

    </div>

    <div class="checkout-grid">

        <!-- FORM -->

        <form
        method="POST"

        class="checkout-form">

            <div class="form-group">

                <label>

                    Full Name

                </label>

                <input
                type="text"

                name="customer_name"

                required>

            </div>

            <div class="form-group">

                <label>

                    Phone Number

                </label>

                <input
                type="text"

                name="customer_phone"

                required>

            </div>

            <div class="form-group">

                <label>

                    Delivery Address

                </label>

                <textarea
                name="customer_address"

                required></textarea>

            </div>

            <div class="form-group">

                <label>

                    Payment Method

                </label>

                <select
                name="payment_method"

                required>

                    <option value="Cash On Delivery">

                        Cash On Delivery

                    </option>

                    <option value="UPI">

                        UPI

                    </option>

                    <option value="Card">

                        Debit / Credit Card

                    </option>

                </select>

            </div>

            <button
            type="submit"

            name="place_order"

            class="place-btn">

                Place Order

            </button>

        </form>

        <!-- SUMMARY -->

        <div class="summary-box">

            <h2>

                Order Summary

            </h2>

            <?php foreach($cart as $item): ?>

            <div class="summary-item">

                <span>

                    <?php echo $item['name']; ?>

                    ×
                    <?php echo $item['quantity']; ?>

                </span>

                <span>

                    ₹<?php

                    echo number_format(

                    $item['price'] *
                    $item['quantity']

                    );

                    ?>

                </span>

            </div>

            <?php endforeach; ?>

            <div class="summary-item">

                <span>

                    Delivery

                </span>

                <span>

                    ₹49

                </span>

            </div>

            <div class="summary-total">

                <span>

                    Total

                </span>

                <span>

                    ₹<?php echo number_format($grand_total); ?>

                </span>

            </div>

        </div>

    </div>

</section>

<?php include "footer.php"; ?>

</body>
</html>