<?php

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Maintenance";

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
href="assets/css/footer.css">

<link
rel="stylesheet"
href="assets/css/animations.css">

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

    --card:
    rgba(255,255,255,.04);

    --border:
    rgba(255,255,255,.08);

}

body.light-mode{

    --bg:#f5f5f7;

    --white:#111111;

    --text:#666666;

    --card:
    rgba(255,255,255,.7);

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

    display:flex;

    flex-direction:column;

    background:
    radial-gradient(
    circle at top right,
    rgba(255,154,61,.12),
    transparent 30%
    ),
    var(--bg);

    color:var(--white);

    font-family:'Poppins',sans-serif;

}

/* =====================================================
PAGE
===================================================== */

.maintenance-page{

    flex:1;

    width:100%;

    display:flex;

    align-items:center;

    justify-content:center;

    padding:
    40px 16px;

}

/* =====================================================
CARD
===================================================== */

.maintenance-card{

    width:100%;

    max-width:760px;

    text-align:center;

    padding:52px 34px;

    border-radius:38px;

    background:var(--card);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    overflow:hidden;

}

/* =====================================================
ICON
===================================================== */

.maintenance-icon{

    width:120px;
    height:120px;

    margin:auto auto 28px;

    border-radius:32px;

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

    font-size:54px;

    animation:
    float 3s ease-in-out infinite;

}

@keyframes float{

    0%{

        transform:
        translateY(0);

    }

    50%{

        transform:
        translateY(-10px);

    }

    100%{

        transform:
        translateY(0);

    }

}

/* =====================================================
TEXT
===================================================== */

.maintenance-card h1{

    font-size:
    clamp(38px,6vw,70px);

    line-height:1.1;

    margin-bottom:18px;

}

.maintenance-card p{

    max-width:620px;

    margin:auto;

    color:var(--text);

    line-height:2;

    margin-bottom:34px;

}

/* =====================================================
STATUS
===================================================== */

.maintenance-status{

    display:inline-flex;

    align-items:center;

    gap:10px;

    padding:
    14px 20px;

    border-radius:999px;

    background:
    rgba(255,154,61,.10);

    border:
    1px solid rgba(255,154,61,.16);

    color:var(--primary);

    font-size:14px;

    font-weight:600;

    margin-bottom:34px;

}

.status-dot{

    width:10px;
    height:10px;

    border-radius:50%;

    background:var(--primary);

    animation:
    pulse 1.5s infinite;

}

@keyframes pulse{

    0%{

        opacity:1;

        transform:scale(1);

    }

    50%{

        opacity:.4;

        transform:scale(1.5);

    }

    100%{

        opacity:1;

        transform:scale(1);

    }

}

/* =====================================================
BUTTONS
===================================================== */

.maintenance-buttons{

    display:flex;

    align-items:center;
    justify-content:center;

    gap:16px;

    flex-wrap:wrap;

}

/* =====================================================
BUTTON
===================================================== */

.maintenance-btn{

    min-width:210px;

    height:60px;

    border:none;

    outline:none;

    cursor:pointer;

    border-radius:20px;

    text-decoration:none;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:15px;

    font-weight:700;

    transition:.35s;

}

.maintenance-btn.primary{

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

}

.maintenance-btn.secondary{

    background:
    rgba(255,255,255,.05);

    border:
    1px solid var(--border);

    color:var(--white);

}

.maintenance-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .maintenance-card{

        padding:38px 20px;

        border-radius:28px;

    }

    .maintenance-icon{

        width:96px;
        height:96px;

        font-size:44px;

        border-radius:26px;

    }

    .maintenance-buttons{

        flex-direction:column;

    }

    .maintenance-btn{

        width:100%;

        min-width:100%;

    }

}

</style>

</head>

<body>

<!-- =====================================================
MAIN
===================================================== -->

<main class="maintenance-page">

    <section class="maintenance-card">

        <!-- ICON -->

        <div class="maintenance-icon">

            <i class="fa-solid fa-screwdriver-wrench"></i>

        </div>

        <!-- TITLE -->

        <h1>

            Website Under Maintenance

        </h1>

        <!-- TEXT -->

        <p>

            Hungroo Café is currently upgrading
            the premium experience for faster
            performance and exciting new features.

        </p>

        <!-- STATUS -->

        <div class="maintenance-status">

            <span class="status-dot"></span>

            System Upgrade In Progress

        </div>

        <!-- BUTTONS -->

        <div class="maintenance-buttons">

            <a
            href="index.php"

            class="maintenance-btn primary">

                Back To Home

            </a>

            <a
            href="contact.php"

            class="maintenance-btn secondary">

                Contact Support

            </a>

        </div>

    </section>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>