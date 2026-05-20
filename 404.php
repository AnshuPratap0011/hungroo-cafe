<?php

http_response_code(404);

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Page Not Found";

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

    --white:#ffffff;

    --text:#bdbdbd;

    --primary:#ff9a3d;

    --gold:#ffd27a;

    --border:
    rgba(255,255,255,.08);

}

body.light-mode{

    --bg:#f5f5f7;

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

    min-height:100vh;

    background:
    radial-gradient(
    circle at top right,
    rgba(255,154,61,.10),
    transparent 30%
    ),
    var(--bg);

    color:var(--white);

    font-family:'Poppins',sans-serif;

}

/* =====================================================
PAGE
===================================================== */

.error-page{

    width:100%;

    min-height:100vh;

    display:flex;

    align-items:center;

    justify-content:center;

    padding:
    140px 16px 80px;

}

/* =====================================================
CARD
===================================================== */

.error-card{

    width:100%;

    max-width:760px;

    text-align:center;

    padding:50px 34px;

    border-radius:38px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    overflow:hidden;

}

/* =====================================================
NUMBER
===================================================== */

.error-number{

    font-size:
    clamp(100px,18vw,220px);

    font-weight:800;

    line-height:1;

    margin-bottom:18px;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    -webkit-background-clip:text;

    -webkit-text-fill-color:transparent;

}

/* =====================================================
TEXT
===================================================== */

.error-card h1{

    font-size:
    clamp(34px,5vw,60px);

    margin-bottom:18px;

    line-height:1.2;

}

.error-card p{

    max-width:620px;

    margin:auto;

    color:var(--text);

    line-height:2;

    margin-bottom:34px;

}

/* =====================================================
BUTTONS
===================================================== */

.error-buttons{

    display:flex;

    align-items:center;
    justify-content:center;

    gap:16px;

    flex-wrap:wrap;

}

/* =====================================================
BUTTON
===================================================== */

.error-btn{

    min-width:200px;

    height:60px;

    border:none;

    outline:none;

    cursor:pointer;

    border-radius:20px;

    font-size:15px;

    font-weight:700;

    transition:.35s;

    text-decoration:none;

    display:flex;
    align-items:center;
    justify-content:center;

}

.error-btn.primary{

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

}

.error-btn.secondary{

    background:
    rgba(255,255,255,.05);

    border:
    1px solid var(--border);

    color:var(--white);

}

.error-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .error-page{

        padding:
        120px 14px 70px;

    }

    .error-card{

        padding:38px 20px;

        border-radius:28px;

    }

    .error-buttons{

        flex-direction:column;

    }

    .error-btn{

        width:100%;

        min-width:100%;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="error-page">

    <section class="error-card">

        <!-- NUMBER -->

        <div class="error-number">

            404

        </div>

        <!-- TITLE -->

        <h1>

            Oops! Page Not Found

        </h1>

        <!-- TEXT -->

        <p>

            The page you are looking for
            might have been removed,
            renamed or is temporarily unavailable.

        </p>

        <!-- BUTTONS -->

        <div class="error-buttons">

            <a
            href="index.php"

            class="error-btn primary">

                Back To Home

            </a>

            <a
            href="menu.php"

            class="error-btn secondary">

                Explore Menu

            </a>

        </div>

    </section>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>