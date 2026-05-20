<?php

session_start();

$pageTitle =
"Hungroo Café | Reservation History";

/* =========================================================
RESERVATIONS
========================================================= */

$reservations = [

    [
        "id"       => "#TB1024",
        "date"     => "18 May 2026",
        "time"     => "7:30 PM",
        "guests"   => "2 Guests",
        "status"   => "Confirmed"
    ],

    [
        "id"       => "#TB1025",
        "date"     => "20 May 2026",
        "time"     => "9:00 PM",
        "guests"   => "5 Guests",
        "status"   => "Pending"
    ],

    [
        "id"       => "#TB1026",
        "date"     => "25 May 2026",
        "time"     => "8:15 PM",
        "guests"   => "3 Guests",
        "status"   => "Completed"
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

    --orange:#ffb347;

    --blue:#3da5ff;

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

.reservation-page{

    width:100%;

    max-width:1350px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =========================================================
TOP
========================================================= */

.reservation-top{

    text-align:center;

    margin-bottom:50px;

}

.reservation-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.reservation-top h1{

    font-size:
    clamp(40px,6vw,82px);

    margin:
    10px 0 16px;

}

.reservation-top p{

    max-width:760px;

    margin:auto;

    line-height:1.9;

    color:var(--text);

}

/* =========================================================
LIST
========================================================= */

.reservation-list{

    display:flex;

    flex-direction:column;

    gap:24px;

}

/* =========================================================
CARD
========================================================= */

.reservation-card{

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

    gap:24px;

    flex-wrap:wrap;

    transition:.35s;

}

.reservation-card:hover{

    transform:
    translateY(-6px);

}

/* =========================================================
LEFT
========================================================= */

.reservation-left{

    display:flex;

    align-items:center;

    gap:20px;

}

.reservation-icon{

    width:78px;
    height:78px;

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

/* =========================================================
TEXT
========================================================= */

.reservation-info h2{

    font-size:28px;

    margin-bottom:8px;

}

.reservation-info p{

    color:var(--text);

    line-height:1.9;

}

/* =========================================================
RIGHT
========================================================= */

.reservation-right{

    display:flex;

    align-items:center;

    gap:18px;

    flex-wrap:wrap;

}

/* =========================================================
STATUS
========================================================= */

.reservation-status{

    padding:
    10px 18px;

    border-radius:999px;

    font-size:13px;

    font-weight:700;

}

.confirmed{

    background:
    rgba(46,204,113,.12);

    color:var(--green);

}

.pending{

    background:
    rgba(255,179,71,.12);

    color:var(--orange);

}

.completed{

    background:
    rgba(61,165,255,.12);

    color:var(--blue);

}

/* =========================================================
BUTTON
========================================================= */

.reservation-btn{

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

.reservation-btn:hover{

    transform:
    translateY(-4px);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:768px){

    .reservation-page{

        padding:
        120px 14px 70px;

    }

    .reservation-card{

        padding:22px 18px;

        border-radius:24px;

        align-items:flex-start;

    }

    .reservation-left{

        align-items:flex-start;

    }

    .reservation-icon{

        width:64px;
        height:64px;

        border-radius:20px;

        font-size:24px;

    }

    .reservation-info h2{

        font-size:22px;

    }

    .reservation-right{

        width:100%;

        flex-direction:column;

        align-items:stretch;

    }

    .reservation-btn{

        width:100%;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<main class="reservation-page">

    <!-- TOP -->

    <div class="reservation-top">

        <span>

            Premium Dining

        </span>

        <h1>

            Reservation History

        </h1>

        <p>

            View your table bookings,
            reservation details and
            premium dining history.

        </p>

    </div>

    <!-- LIST -->

    <div class="reservation-list">

        <?php foreach($reservations as $reservation): ?>

        <div class="reservation-card">

            <!-- LEFT -->

            <div class="reservation-left">

                <div class="reservation-icon">

                    <i class="fa-solid fa-utensils"></i>

                </div>

                <div class="reservation-info">

                    <h2>

                        <?php echo $reservation['id']; ?>

                    </h2>

                    <p>

                        Date:
                        <?php echo $reservation['date']; ?>

                    </p>

                    <p>

                        Time:
                        <?php echo $reservation['time']; ?>

                    </p>

                    <p>

                        Guests:
                        <?php echo $reservation['guests']; ?>

                    </p>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="reservation-right">

                <div class="reservation-status

                <?php

                if($reservation['status']=="Confirmed"){

                    echo "confirmed";

                }

                elseif($reservation['status']=="Pending"){

                    echo "pending";

                }

                else{

                    echo "completed";

                }

                ?>">

                    <?php echo $reservation['status']; ?>

                </div>

                <button class="reservation-btn">

                    View Details

                </button>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

<script src="assets/js/preloader.js"></script>

</body>
</html>