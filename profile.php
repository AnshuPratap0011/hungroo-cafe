<?php

session_start();

$pageTitle =
"Hungroo Café | My Profile";

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

.profile-page{

    width:100%;

    max-width:1400px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =========================================================
TOP
========================================================= */

.profile-top{

    text-align:center;

    margin-bottom:50px;

}

.profile-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.profile-top h1{

    font-size:
    clamp(40px,6vw,80px);

    margin:
    10px 0 16px;

}

.profile-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =========================================================
WRAPPER
========================================================= */

.profile-wrapper{

    display:grid;

    grid-template-columns:
    350px 1fr;

    gap:28px;

}

/* =========================================================
SIDEBAR
========================================================= */

.profile-sidebar{

    padding:30px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    text-align:center;

    backdrop-filter:
    blur(18px);

}

/* =========================================================
IMAGE
========================================================= */

.profile-image{

    width:130px;
    height:130px;

    margin:auto auto 20px;

    border-radius:50%;

    overflow:hidden;

    border:
    4px solid rgba(255,154,61,.3);

}

.profile-image img{

    width:100%;
    height:100%;

    object-fit:cover;

}

/* =========================================================
NAME
========================================================= */

.profile-sidebar h2{

    font-size:30px;

    margin-bottom:10px;

}

.profile-sidebar p{

    color:var(--text);

    line-height:1.8;

    margin-bottom:24px;

}

/* =========================================================
STATS
========================================================= */

.profile-stats{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:16px;

}

.profile-stat{

    padding:18px;

    border-radius:22px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

.profile-stat h3{

    font-size:28px;

    margin-bottom:8px;

}

.profile-stat p{

    margin:0;

    font-size:13px;

}

/* =========================================================
CONTENT
========================================================= */

.profile-content{

    padding:34px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

}

/* =========================================================
FORM
========================================================= */

.profile-form{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:22px;

}

.profile-group{

    width:100%;

}

.profile-group.full{

    grid-column:1/-1;

}

.profile-label{

    display:block;

    margin-bottom:10px;

    font-size:14px;

    font-weight:600;

}

.profile-input{

    width:100%;

    height:58px;

    border:none;

    outline:none;

    padding:
    0 18px;

    border-radius:18px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:var(--white);

    font-size:15px;

    font-family:'Poppins',sans-serif;

}

textarea.profile-input{

    height:140px;

    padding:18px;

    resize:none;

}

/* =========================================================
BUTTON
========================================================= */

.profile-btn{

    margin-top:10px;

    width:100%;

    height:58px;

    border:none;

    cursor:pointer;

    border-radius:18px;

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

.profile-btn:hover{

    transform:
    translateY(-4px);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:992px){

    .profile-wrapper{

        grid-template-columns:1fr;

    }

}

@media(max-width:768px){

    .profile-page{

        padding:
        120px 14px 70px;

    }

    .profile-sidebar,
    .profile-content{

        padding:24px 18px;

        border-radius:24px;

    }

    .profile-form{

        grid-template-columns:1fr;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<main class="profile-page">

    <!-- TOP -->

    <div class="profile-top">

        <span>

            Premium Account

        </span>

        <h1>

            My Profile

        </h1>

        <p>

            Manage your Hungroo Café
            profile, delivery details,
            rewards and preferences.

        </p>

    </div>

    <!-- WRAPPER -->

    <div class="profile-wrapper">

        <!-- SIDEBAR -->

        <div class="profile-sidebar">

            <div class="profile-image">

                <img
                src="assets/images/user.jpg"
                alt="profile">

            </div>

            <h2>

                Mahavir Kumar

            </h2>

            <p>

                Premium Hungroo Café Member

            </p>

            <!-- STATS -->

            <div class="profile-stats">

                <div class="profile-stat">

                    <h3>

                        24

                    </h3>

                    <p>

                        Orders

                    </p>

                </div>

                <div class="profile-stat">

                    <h3>

                        2450

                    </h3>

                    <p>

                        Points

                    </p>

                </div>

            </div>

        </div>

        <!-- CONTENT -->

        <div class="profile-content">

            <form class="profile-form">

                <!-- NAME -->

                <div class="profile-group">

                    <label class="profile-label">

                        Full Name

                    </label>

                    <input
                    type="text"

                    class="profile-input"

                    value="Mahavir Kumar">

                </div>

                <!-- EMAIL -->

                <div class="profile-group">

                    <label class="profile-label">

                        Email Address

                    </label>

                    <input
                    type="email"

                    class="profile-input"

                    value="hungroo@gmail.com">

                </div>

                <!-- PHONE -->

                <div class="profile-group">

                    <label class="profile-label">

                        Phone Number

                    </label>

                    <input
                    type="text"

                    class="profile-input"

                    value="+91 99999 99999">

                </div>

                <!-- LOCATION -->

                <div class="profile-group">

                    <label class="profile-label">

                        Location

                    </label>

                    <input
                    type="text"

                    class="profile-input"

                    value="Chandigarh, India">

                </div>

                <!-- BIO -->

                <div class="profile-group full">

                    <label class="profile-label">

                        Bio

                    </label>

                    <textarea
                    class="profile-input">Premium food lover and café enthusiast.</textarea>

                </div>

                <!-- BUTTON -->

                <div class="profile-group full">

                    <button
                    type="submit"

                    class="profile-btn">

                        Save Changes

                    </button>

                </div>

            </form>

        </div>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

<script src="assets/js/preloader.js"></script>

</body>
</html>