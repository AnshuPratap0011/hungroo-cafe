<?php

session_start();

/* =========================================================
CONFIG
========================================================= */

include "config/config.php";

/* =========================================================
BOOK TABLE
========================================================= */

$success = "";

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

    $insertQuery =

    "INSERT INTO reservations (

        full_name,
        phone,
        email,
        total_people,
        reservation_date,
        reservation_time,
        special_note,
        status

    )

    VALUES (

        '$full_name',
        '$phone',
        '$email',
        '$total_people',
        '$reservation_date',
        '$reservation_time',
        '$special_note',
        'pending'

    )";

    mysqli_query(
    $conn,
    $insertQuery
    );

    $success =
    "Table booked successfully.";

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

Book Table

</title>

<!-- CSS -->

<link
rel="stylesheet"
href="assets/css/navbar.css">

<link
rel="stylesheet"
href="assets/css/footer.css">

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

body.light-mode{

    --bg:#f7f7f7;
    --card:#ffffff;
    --white:#111111;
    --text:#666666;
    --border:rgba(0,0,0,.08);

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

    transition:.35s;

}

/* =========================================================
PAGE
========================================================= */

.reservation-page{

    padding:
    140px 5% 80px;

}

/* =========================================================
TOP
========================================================= */

.reservation-top{

    text-align:center;

    margin-bottom:60px;

}

.reservation-top h1{

    font-size:60px;

    margin-bottom:14px;

}

.reservation-top p{

    color:var(--text);

    max-width:700px;

    margin:auto;

    line-height:1.9;

}

/* =========================================================
BOX
========================================================= */

.reservation-box{

    max-width:1000px;

    margin:auto;

    padding:36px;

    border-radius:36px;

    background:var(--card);

    border:
    1px solid var(--border);

}

/* =========================================================
FORM
========================================================= */

.form-grid{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:24px;

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

.form-group textarea{

    height:170px;

    resize:none;

}

/* =========================================================
BUTTON
========================================================= */

.book-btn{

    width:100%;

    height:64px;

    margin-top:30px;

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
RESPONSIVE
========================================================= */

@media(max-width:768px){

    .reservation-page{

        padding:
        120px 4% 70px;

    }

    .reservation-top h1{

        font-size:42px;

    }

    .reservation-box{

        padding:24px;

        border-radius:26px;

    }

    .form-grid{

        grid-template-columns:1fr;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<section class="reservation-page">

    <!-- TOP -->

    <div class="reservation-top">

        <h1>

            Book A Table

        </h1>

        <p>

            Reserve your table and enjoy delicious
            premium café experience.

        </p>

    </div>

    <!-- FORM BOX -->

    <div class="reservation-box">

        <?php if(!empty($success)): ?>

        <div class="success-box">

            <?php echo $success; ?>

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

                    name="email"

                    required>

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

            class="book-btn">

                Book Table

            </button>

        </form>

    </div>

</section>

<?php include "footer.php"; ?>

</body>
</html>