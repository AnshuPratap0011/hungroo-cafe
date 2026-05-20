<?php

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Coming Soon";

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
    rgba(255,255,255,.72);

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

    min-height:100vh;

    overflow-x:hidden;

    display:flex;

    flex-direction:column;

    background:
    radial-gradient(
    circle at top right,
    rgba(255,154,61,.14),
    transparent 30%
    ),
    var(--bg);

    color:var(--white);

    font-family:'Poppins',sans-serif;

}

/* =====================================================
PAGE
===================================================== */

.coming-page{

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

.coming-card{

    width:100%;

    max-width:860px;

    text-align:center;

    padding:56px 36px;

    border-radius:40px;

    background:var(--card);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    overflow:hidden;

}

/* =====================================================
BADGE
===================================================== */

.coming-badge{

    display:inline-flex;

    align-items:center;

    gap:10px;

    padding:
    14px 20px;

    border-radius:999px;

    margin-bottom:28px;

    background:
    rgba(255,154,61,.10);

    border:
    1px solid rgba(255,154,61,.16);

    color:var(--primary);

    font-size:14px;

    font-weight:600;

}

/* =====================================================
ICON
===================================================== */

.coming-icon{

    width:120px;
    height:120px;

    margin:auto auto 28px;

    border-radius:34px;

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

    font-size:56px;

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

.coming-card h1{

    font-size:
    clamp(42px,7vw,82px);

    line-height:1.1;

    margin-bottom:20px;

}

.coming-card p{

    max-width:680px;

    margin:auto;

    color:var(--text);

    line-height:2;

    margin-bottom:38px;

}

/* =====================================================
COUNTDOWN
===================================================== */

.coming-countdown{

    display:grid;

    grid-template-columns:
    repeat(4,1fr);

    gap:18px;

    margin-bottom:40px;

}

.count-box{

    padding:26px 14px;

    border-radius:28px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

.count-box h2{

    font-size:42px;

    margin-bottom:10px;

}

.count-box span{

    color:var(--text);

    font-size:14px;

}

/* =====================================================
FORM
===================================================== */

.coming-form{

    display:flex;

    align-items:center;
    justify-content:center;

    gap:14px;

    flex-wrap:wrap;

}

/* =====================================================
INPUT
===================================================== */

.coming-input{

    flex:1;

    min-width:240px;

    max-width:420px;

    height:60px;

    border:none;

    outline:none;

    border-radius:20px;

    padding:
    0 20px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:var(--white);

    font-size:15px;

    font-family:'Poppins',sans-serif;

}

/* =====================================================
BUTTON
===================================================== */

.coming-btn{

    height:60px;

    padding:
    0 28px;

    border:none;

    outline:none;

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

.coming-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .coming-card{

        padding:40px 20px;

        border-radius:28px;

    }

    .coming-icon{

        width:96px;
        height:96px;

        font-size:44px;

        border-radius:26px;

    }

    .coming-countdown{

        grid-template-columns:
        repeat(2,1fr);

    }

    .count-box{

        border-radius:22px;

    }

    .count-box h2{

        font-size:34px;

    }

    .coming-form{

        flex-direction:column;

    }

    .coming-input,
    .coming-btn{

        width:100%;

        max-width:100%;

    }

}

</style>

</head>

<body>

<!-- =====================================================
MAIN
===================================================== -->

<main class="coming-page">

    <section class="coming-card">

        <!-- BADGE -->

        <div class="coming-badge">

            <i class="fa-solid fa-fire"></i>

            Something Premium Is Coming

        </div>

        <!-- ICON -->

        <div class="coming-icon">

            <i class="fa-solid fa-burger"></i>

        </div>

        <!-- TITLE -->

        <h1>

            Coming Soon

        </h1>

        <!-- TEXT -->

        <p>

            Hungroo Café is preparing a
            next-level premium experience with
            exciting features, exclusive offers
            and luxury café vibes.

        </p>

        <!-- COUNTDOWN -->

        <div class="coming-countdown">

            <div class="count-box">

                <h2 id="days">

                    12

                </h2>

                <span>

                    Days

                </span>

            </div>

            <div class="count-box">

                <h2 id="hours">

                    08

                </h2>

                <span>

                    Hours

                </span>

            </div>

            <div class="count-box">

                <h2 id="minutes">

                    32

                </h2>

                <span>

                    Minutes

                </span>

            </div>

            <div class="count-box">

                <h2 id="seconds">

                    45

                </h2>

                <span>

                    Seconds

                </span>

            </div>

        </div>

        <!-- FORM -->

        <form class="coming-form">

            <input
            type="email"

            class="coming-input"

            placeholder=
            "Enter your email for updates">

            <button
            type="submit"

            class="coming-btn">

                Notify Me

            </button>

        </form>

    </section>

</main>

<?php include "footer.php"; ?>

<!-- =====================================================
SCRIPT
===================================================== -->

<script>

/* =====================================================
COUNTDOWN
===================================================== */

let totalSeconds =

12 * 24 * 60 * 60 +

8 * 60 * 60 +

32 * 60 +

45;

const days =
document.getElementById(
"days"
);

const hours =
document.getElementById(
"hours"
);

const minutes =
document.getElementById(
"minutes"
);

const seconds =
document.getElementById(
"seconds"
);

setInterval(()=>{

    if(totalSeconds <= 0){

        return;

    }

    totalSeconds--;

    const d =
    Math.floor(
    totalSeconds / 86400
    );

    const h =
    Math.floor(
    (totalSeconds % 86400) / 3600
    );

    const m =
    Math.floor(
    (totalSeconds % 3600) / 60
    );

    const s =
    totalSeconds % 60;

    days.textContent =
    String(d).padStart(2,"0");

    hours.textContent =
    String(h).padStart(2,"0");

    minutes.textContent =
    String(m).padStart(2,"0");

    seconds.textContent =
    String(s).padStart(2,"0");

},1000);

</script>

<script src="assets/js/theme.js"></script>

</body>
</html>