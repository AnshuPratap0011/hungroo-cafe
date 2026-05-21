<?php

include "config/config.php";

$pageTitle =
"Hungroo Café | Table Reservation";

/* =========================================================
BOOK TABLE
========================================================= */

if(isset($_POST['book_table'])){

    $full_name =

    mysqli_real_escape_string(
    $conn,
    $_POST['full_name']
    );

    $phone =

    mysqli_real_escape_string(
    $conn,
    $_POST['phone']
    );

    $email =

    mysqli_real_escape_string(
    $conn,
    $_POST['email']
    );

    $total_people =

    mysqli_real_escape_string(
    $conn,
    $_POST['total_people']
    );

    $reservation_date =

    mysqli_real_escape_string(
    $conn,
    $_POST['reservation_date']
    );

    $reservation_time =

    mysqli_real_escape_string(
    $conn,
    $_POST['reservation_time']
    );

    $special_note =

    mysqli_real_escape_string(
    $conn,
    $_POST['special_note']
    );

    /* =====================================================
    INSERT
    ====================================================== */

    $query =

    "INSERT INTO reservations (

        full_name,
        phone,
        email,
        total_people,
        reservation_date,
        reservation_time,
        special_note

    )

    VALUES (

        '$full_name',
        '$phone',
        '$email',
        '$total_people',
        '$reservation_date',
        '$reservation_time',
        '$special_note'

    )";

    mysqli_query(
    $conn,
    $query
    );

    $success = true;

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

<?php echo $pageTitle; ?>

</title>

<!-- FONT -->

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- ICON -->

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

<style>

/* =========================================================
ROOT
========================================================= */

:root{

    --bg:#070707;

    --card:#111111;

    --white:#ffffff;

    --text:#bdbdbd;

    --primary:#ff9a3d;

    --gold:#ffd27a;

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

body{

    background:var(--bg);

    color:var(--white);

    font-family:'Poppins',sans-serif;

    overflow-x:hidden;

}

/* =========================================================
WRAPPER
========================================================= */

.reservation-wrapper{

    width:100%;

    max-width:1450px;

    margin:auto;

    padding:
    140px 16px 90px;

}

/* =========================================================
TOP
========================================================= */

.reservation-top{

    text-align:center;

    margin-bottom:70px;

}

.reservation-top span{

    display:inline-flex;

    padding:
    10px 20px;

    border-radius:999px;

    background:
    rgba(255,154,61,.10);

    border:
    1px solid rgba(255,154,61,.14);

    color:#ffb15e;

    font-size:13px;

    font-weight:700;

    margin-bottom:24px;

}

.reservation-top h1{

    font-size:
    clamp(50px,7vw,100px);

    line-height:1.05;

    margin-bottom:20px;

}

.reservation-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:2;

}

/* =========================================================
GRID
========================================================= */

.reservation-grid{

    display:grid;

    grid-template-columns:
    .9fr 1.1fr;

    gap:34px;

}

/* =========================================================
IMAGE
========================================================= */

.reservation-image{

    position:relative;

    overflow:hidden;

    border-radius:36px;

}

.reservation-image img{

    width:100%;
    height:100%;

    object-fit:cover;

    min-height:700px;

}

/* =========================================================
FORM
========================================================= */

.reservation-form{

    padding:34px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

body.light-mode
.reservation-form{

    background:#fff;

}

.reservation-form h2{

    font-size:42px;

    margin-bottom:30px;

}

/* =========================================================
SUCCESS
========================================================= */

.success-box{

    margin-bottom:24px;

    padding:18px;

    border-radius:18px;

    background:
    rgba(76,175,80,.12);

    border:
    1px solid rgba(76,175,80,.18);

    color:#4caf50;

    font-size:14px;

    font-weight:600;

}

/* =========================================================
GRID
========================================================= */

.form-grid{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:20px;

}

.form-group{

    display:flex;

    flex-direction:column;

    gap:10px;

}

.form-group.full{

    grid-column:1/-1;

}

.form-group label{

    font-size:14px;

    font-weight:600;

}

.form-group input,
.form-group textarea{

    width:100%;

    border:none;

    outline:none;

    padding:18px;

    border-radius:18px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:var(--white);

    font-size:14px;

    font-family:'Poppins',sans-serif;

}

body.light-mode
.form-group input,
body.light-mode
.form-group textarea{

    color:#111;

}

.form-group textarea{

    height:150px;

    resize:none;

}

/* =========================================================
BUTTON
========================================================= */

.reserve-btn{

    width:100%;

    height:62px;

    margin-top:24px;

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

    transition:.35s;

}

.reserve-btn:hover{

    transform:
    translateY(-4px);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:992px){

    .reservation-grid{

        grid-template-columns:1fr;

    }

    .reservation-image img{

        min-height:420px;

    }

}

@media(max-width:768px){

    .reservation-wrapper{

        padding:
        120px 12px 70px;

    }

    .form-grid{

        grid-template-columns:1fr;

    }

    .reservation-form{

        padding:24px;

        border-radius:26px;

    }

    .reservation-form h2{

        font-size:32px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =========================================================
WRAPPER
========================================================= -->

<div class="reservation-wrapper">

    <!-- TOP -->

    <div class="reservation-top">

        <span>

            Premium Table Booking

        </span>

        <h1>

            Reserve Your Table

        </h1>

        <p>

            Book your table now and enjoy
            a premium dining experience at
            Hungroo Café.

        </p>

    </div>

    <!-- GRID -->

    <div class="reservation-grid">

        <!-- IMAGE -->

        <div class="reservation-image">

            <img
            src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1600&auto=format&fit=crop"
            alt="Reservation">

        </div>

        <!-- FORM -->

        <div class="reservation-form">

            <h2>

                Book Table

            </h2>

            <?php if(isset($success)): ?>

            <div class="success-box">

                Table booked successfully.

            </div>

            <?php endif; ?>

            <form method="POST">

                <div class="form-grid">

                    <div class="form-group">

                        <label>

                            Full Name

                        </label>

                        <input
                        type="text"

                        name="full_name"

                        required>

                    </div>

                    <div class="form-group">

                        <label>

                            Phone Number

                        </label>

                        <input
                        type="text"

                        name="phone"

                        required>

                    </div>

                    <div class="form-group">

                        <label>

                            Email Address

                        </label>

                        <input
                        type="email"

                        name="email">

                    </div>

                    <div class="form-group">

                        <label>

                            Total People

                        </label>

                        <input
                        type="number"

                        name="total_people"

                        required>

                    </div>

                    <div class="form-group">

                        <label>

                            Reservation Date

                        </label>

                        <input
                        type="date"

                        name="reservation_date"

                        required>

                    </div>

                    <div class="form-group">

                        <label>

                            Reservation Time

                        </label>

                        <input
                        type="time"

                        name="reservation_time"

                        required>

                    </div>

                    <div class="form-group full">

                        <label>

                            Special Note

                        </label>

                        <textarea
                        name="special_note"></textarea>

                    </div>

                </div>

                <button
                type="submit"

                name="book_table"

                class="reserve-btn">

                    Reserve Table

                </button>

            </form>

        </div>

    </div>

</div>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>
<script src="assets/js/cart.js"></script>
<script src="assets/js/preloader.js"></script>

</body>
</html>