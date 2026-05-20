<?php

session_start();

$pageTitle =
"Hungroo Café | Careers";

/* =========================================================
JOBS
========================================================= */

$jobs = [

    [
        "title" => "Head Chef",
        "type"  => "Full Time",
        "location" => "Chandigarh"
    ],

    [
        "title" => "Barista",
        "type"  => "Part Time",
        "location" => "Mohali"
    ],

    [
        "title" => "Restaurant Manager",
        "type"  => "Full Time",
        "location" => "Delhi"
    ],

    [
        "title" => "Delivery Executive",
        "type"  => "Flexible",
        "location" => "Remote Area"
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

.career-page{

    width:100%;

    max-width:1400px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =========================================================
TOP
========================================================= */

.career-top{

    text-align:center;

    margin-bottom:60px;

}

.career-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.career-top h1{

    font-size:
    clamp(42px,6vw,84px);

    margin:
    10px 0 18px;

}

.career-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:2;

}

/* =========================================================
GRID
========================================================= */

.career-grid{

    display:grid;

    gap:28px;

}

/* =========================================================
CARD
========================================================= */

.career-card{

    padding:30px;

    border-radius:30px;

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

.career-card:hover{

    transform:
    translateY(-6px);

}

/* =========================================================
LEFT
========================================================= */

.career-left{

    display:flex;

    align-items:center;

    gap:20px;

}

.career-icon{

    width:74px;
    height:74px;

    border-radius:22px;

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

    font-size:28px;

    flex-shrink:0;

}

/* =========================================================
TEXT
========================================================= */

.career-info h2{

    font-size:30px;

    margin-bottom:10px;

}

.career-info p{

    color:var(--text);

    line-height:1.9;

}

/* =========================================================
BADGE
========================================================= */

.career-badge{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    padding:
    10px 18px;

    border-radius:999px;

    background:
    rgba(255,154,61,.10);

    border:
    1px solid rgba(255,154,61,.18);

    color:var(--primary);

    font-size:13px;

    font-weight:700;

    margin-top:12px;

}

/* =========================================================
BUTTON
========================================================= */

.career-btn{

    height:56px;

    padding:
    0 26px;

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

.career-btn:hover{

    transform:
    translateY(-4px);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:768px){

    .career-page{

        padding:
        120px 14px 70px;

    }

    .career-card{

        padding:22px 18px;

        border-radius:24px;

    }

    .career-left{

        align-items:flex-start;

    }

    .career-icon{

        width:62px;
        height:62px;

        border-radius:18px;

        font-size:24px;

    }

    .career-info h2{

        font-size:24px;

    }

    .career-btn{

        width:100%;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<main class="career-page">

    <!-- TOP -->

    <div class="career-top">

        <span>

            Join Our Team

        </span>

        <h1>

            Careers At Hungroo Café

        </h1>

        <p>

            Build your future with
            Hungroo Café and become
            part of our premium café experience.

        </p>

    </div>

    <!-- GRID -->

    <div class="career-grid">

        <?php foreach($jobs as $job): ?>

        <div class="career-card">

            <!-- LEFT -->

            <div class="career-left">

                <div class="career-icon">

                    <i class="fa-solid fa-briefcase"></i>

                </div>

                <div class="career-info">

                    <h2>

                        <?php echo $job['title']; ?>

                    </h2>

                    <p>

                        Location:
                        <?php echo $job['location']; ?>

                    </p>

                    <div class="career-badge">

                        <?php echo $job['type']; ?>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->

            <button class="career-btn">

                Apply Now

            </button>

        </div>

        <?php endforeach; ?>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

<script src="assets/js/preloader.js"></script>

</body>
</html>