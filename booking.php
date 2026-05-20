<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Table Booking";

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

.booking-page{

    width:100%;

    max-width:1400px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.booking-top{

    text-align:center;

    margin-bottom:46px;

}

.booking-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.booking-top h1{

    font-size:
    clamp(38px,6vw,78px);

    margin:
    10px 0 16px;

}

.booking-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
GRID
===================================================== */

.booking-grid{

    display:grid;

    grid-template-columns:
    1fr 1.1fr;

    gap:28px;

}

/* =====================================================
CARD
===================================================== */

.booking-card{

    overflow:hidden;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

}

/* =====================================================
IMAGE
===================================================== */

.booking-image{

    position:relative;

    min-height:100%;

}

.booking-image img{

    width:100%;
    height:100%;

    object-fit:cover;

}

/* =====================================================
OVERLAY
===================================================== */

.booking-overlay{

    position:absolute;

    inset:0;

    display:flex;

    flex-direction:column;

    justify-content:flex-end;

    padding:34px;

    background:
    linear-gradient(
    to top,
    rgba(0,0,0,.82),
    transparent 60%
    );

}

.booking-overlay h2{

    font-size:42px;

    margin-bottom:14px;

}

.booking-overlay p{

    color:
    rgba(255,255,255,.82);

    line-height:1.9;

}

/* =====================================================
FORM
===================================================== */

.booking-form{

    padding:34px;

}

.booking-form h2{

    font-size:38px;

    margin-bottom:28px;

}

/* =====================================================
ROW
===================================================== */

.booking-row{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:18px;

}

/* =====================================================
GROUP
===================================================== */

.booking-group{

    margin-bottom:20px;

}

.booking-group label{

    display:block;

    margin-bottom:10px;

    font-size:13px;

    font-weight:600;

}

/* =====================================================
INPUT
===================================================== */

.booking-input{

    width:100%;

    height:62px;

    border:none;

    outline:none;

    border-radius:20px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:var(--white);

    padding:
    0 18px;

    font-size:15px;

    font-family:'Poppins',sans-serif;

}

.booking-input option{

    color:#000;

}

/* =====================================================
TEXTAREA
===================================================== */

.booking-textarea{

    width:100%;

    min-height:140px;

    resize:none;

    border:none;

    outline:none;

    border-radius:20px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:var(--white);

    padding:18px;

    font-size:15px;

    font-family:'Poppins',sans-serif;

}

/* =====================================================
BUTTON
===================================================== */

.booking-btn{

    width:100%;

    height:62px;

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

.booking-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:992px){

    .booking-grid{

        grid-template-columns:1fr;

    }

    .booking-image{

        min-height:420px;

    }

}

@media(max-width:768px){

    .booking-page{

        padding:
        120px 14px 70px;

    }

    .booking-card{

        border-radius:26px;

    }

    .booking-form{

        padding:22px 16px;

    }

    .booking-overlay{

        padding:22px 18px;

    }

    .booking-overlay h2{

        font-size:32px;

    }

    .booking-form h2{

        font-size:30px;

    }

    .booking-row{

        grid-template-columns:1fr;

        gap:0;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="booking-page">

    <!-- TOP -->

    <div class="booking-top">

        <span>

            Premium Reservation

        </span>

        <h1>

            Book Your Table

        </h1>

        <p>

            Reserve your premium dining
            experience at Hungroo Café
            with handcrafted meals and luxury vibes.

        </p>

    </div>

    <!-- GRID -->

    <section class="booking-grid">

        <!-- IMAGE -->

        <div class="booking-card booking-image">

            <img
            src="assets/images/gallery1.jpg"
            alt="Hungroo Café">

            <div class="booking-overlay">

                <h2>

                    Luxury Café Experience

                </h2>

                <p>

                    Book your table now and
                    enjoy handcrafted food,
                    artisan coffee and premium ambiance.

                </p>

            </div>

        </div>

        <!-- FORM -->

        <div class="booking-card booking-form">

            <h2>

                Reservation Form

            </h2>

            <form>

                <!-- ROW -->

                <div class="booking-row">

                    <div class="booking-group">

                        <label>

                            Full Name

                        </label>

                        <input
                        type="text"

                        class="booking-input"

                        placeholder=
                        "Enter your name">

                    </div>

                    <div class="booking-group">

                        <label>

                            Phone Number

                        </label>

                        <input
                        type="tel"

                        class="booking-input"

                        placeholder=
                        "Enter phone number">

                    </div>

                </div>

                <!-- ROW -->

                <div class="booking-row">

                    <div class="booking-group">

                        <label>

                            Date

                        </label>

                        <input
                        type="date"

                        class="booking-input">

                    </div>

                    <div class="booking-group">

                        <label>

                            Time

                        </label>

                        <input
                        type="time"

                        class="booking-input">

                    </div>

                </div>

                <!-- ROW -->

                <div class="booking-row">

                    <div class="booking-group">

                        <label>

                            Guests

                        </label>

                        <select
                        class="booking-input">

                            <option>

                                1 Person

                            </option>

                            <option>

                                2 People

                            </option>

                            <option>

                                4 People

                            </option>

                            <option>

                                6+ People

                            </option>

                        </select>

                    </div>

                    <div class="booking-group">

                        <label>

                            Occasion

                        </label>

                        <select
                        class="booking-input">

                            <option>

                                Casual Dining

                            </option>

                            <option>

                                Birthday

                            </option>

                            <option>

                                Anniversary

                            </option>

                            <option>

                                Business Meeting

                            </option>

                        </select>

                    </div>

                </div>

                <!-- MESSAGE -->

                <div class="booking-group">

                    <label>

                        Special Request

                    </label>

                    <textarea

                    class="booking-textarea"

                    placeholder=
                    "Write your special request here..."></textarea>

                </div>

                <!-- BUTTON -->

                <button
                type="submit"

                class="booking-btn">

                    Book Table Now

                </button>

            </form>

        </div>

    </section>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>