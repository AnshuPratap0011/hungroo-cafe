<?php

session_start();

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Settings";

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

    --green:#2ecc71;

    --danger:#ff4d4d;

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

.settings-page{

    width:100%;

    max-width:1200px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.settings-top{

    text-align:center;

    margin-bottom:50px;

}

.settings-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.settings-top h1{

    font-size:
    clamp(38px,6vw,76px);

    margin:
    10px 0 16px;

}

.settings-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
GRID
===================================================== */

.settings-grid{

    display:grid;

    gap:24px;

}

/* =====================================================
CARD
===================================================== */

.settings-card{

    padding:28px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

}

/* =====================================================
HEADER
===================================================== */

.settings-header{

    margin-bottom:28px;

}

.settings-header h2{

    font-size:30px;

    margin-bottom:10px;

}

.settings-header p{

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
ITEM
===================================================== */

.settings-item{

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:20px;

    padding:22px 0;

    border-bottom:
    1px solid var(--border);

}

.settings-item:last-child{

    border-bottom:none;

    padding-bottom:0;

}

/* =====================================================
LEFT
===================================================== */

.settings-left{

    display:flex;

    align-items:center;

    gap:18px;

}

.settings-icon{

    width:64px;
    height:64px;

    border-radius:20px;

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

    font-size:24px;

    flex-shrink:0;

}

.settings-text h3{

    font-size:22px;

    margin-bottom:8px;

}

.settings-text p{

    color:var(--text);

    line-height:1.8;

}

/* =====================================================
TOGGLE
===================================================== */

.toggle{

    position:relative;

    width:68px;
    height:38px;

    border-radius:999px;

    background:
    rgba(255,255,255,.08);

    cursor:pointer;

    transition:.35s;

    flex-shrink:0;

}

.toggle.active{

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

}

.toggle::before{

    content:"";

    position:absolute;

    top:5px;
    left:5px;

    width:28px;
    height:28px;

    border-radius:50%;

    background:#fff;

    transition:.35s;

}

.toggle.active::before{

    left:35px;

}

/* =====================================================
BUTTONS
===================================================== */

.settings-buttons{

    display:flex;

    gap:16px;

    flex-wrap:wrap;

    margin-top:30px;

}

/* =====================================================
BUTTON
===================================================== */

.settings-btn{

    min-width:180px;

    height:56px;

    border:none;

    cursor:pointer;

    border-radius:18px;

    font-size:14px;

    font-weight:700;

    transition:.35s;

}

.settings-btn.primary{

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

}

.settings-btn.secondary{

    background:
    rgba(255,255,255,.05);

    border:
    1px solid var(--border);

    color:var(--white);

}

.settings-btn.danger{

    background:
    rgba(255,77,77,.12);

    border:
    1px solid rgba(255,77,77,.22);

    color:var(--danger);

}

.settings-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .settings-page{

        padding:
        120px 14px 70px;

    }

    .settings-card{

        padding:22px 18px;

        border-radius:24px;

    }

    .settings-item{

        align-items:flex-start;

        flex-direction:column;

    }

    .settings-left{

        width:100%;

    }

    .settings-header h2{

        font-size:26px;

    }

    .settings-text h3{

        font-size:20px;

    }

    .settings-buttons{

        flex-direction:column;

    }

    .settings-btn{

        width:100%;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="settings-page">

    <!-- TOP -->

    <div class="settings-top">

        <span>

            Premium Controls

        </span>

        <h1>

            Account Settings

        </h1>

        <p>

            Manage your Hungroo Café
            preferences, notifications
            and account experience.

        </p>

    </div>

    <!-- GRID -->

    <section class="settings-grid">

        <!-- CARD -->

        <div class="settings-card">

            <div class="settings-header">

                <h2>

                    Notification Preferences

                </h2>

                <p>

                    Control order updates,
                    promotions and premium alerts.

                </p>

            </div>

            <!-- ITEM -->

            <div class="settings-item">

                <div class="settings-left">

                    <div class="settings-icon">

                        <i class="fa-solid fa-bell"></i>

                    </div>

                    <div class="settings-text">

                        <h3>

                            Push Notifications

                        </h3>

                        <p>

                            Receive instant order updates

                        </p>

                    </div>

                </div>

                <div class="toggle active"></div>

            </div>

            <!-- ITEM -->

            <div class="settings-item">

                <div class="settings-left">

                    <div class="settings-icon">

                        <i class="fa-solid fa-envelope"></i>

                    </div>

                    <div class="settings-text">

                        <h3>

                            Email Updates

                        </h3>

                        <p>

                            Receive offers and newsletters

                        </p>

                    </div>

                </div>

                <div class="toggle"></div>

            </div>

            <!-- ITEM -->

            <div class="settings-item">

                <div class="settings-left">

                    <div class="settings-icon">

                        <i class="fa-solid fa-moon"></i>

                    </div>

                    <div class="settings-text">

                        <h3>

                            Dark Mode

                        </h3>

                        <p>

                            Switch between light and dark themes

                        </p>

                    </div>

                </div>

                <div class="toggle active"></div>

            </div>

        </div>

        <!-- CARD -->

        <div class="settings-card">

            <div class="settings-header">

                <h2>

                    Account Actions

                </h2>

                <p>

                    Manage profile, security
                    and account activity.

                </p>

            </div>

            <div class="settings-buttons">

                <button class="settings-btn primary">

                    Save Changes

                </button>

                <button class="settings-btn secondary">

                    Change Password

                </button>

                <button class="settings-btn danger">

                    Delete Account

                </button>

            </div>

        </div>

    </section>

</main>

<?php include "footer.php"; ?>

<script>

/* =====================================================
TOGGLE
===================================================== */

const toggles =
document.querySelectorAll(
".toggle"
);

toggles.forEach(toggle=>{

    toggle.addEventListener(
    "click",
    ()=>{

        toggle.classList.toggle(
        "active"
        );

    });

});

</script>

<script src="assets/js/theme.js"></script>

</body>
</html>