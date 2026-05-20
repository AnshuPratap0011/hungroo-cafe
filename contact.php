<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Contact";

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
href="assets/css/animations.css">

<style>

:root{

    --bg:#070707;
    --card:#121212;
    --white:#fff;
    --text:#bdbdbd;
    --primary:#ff9a3d;
    --gold:#ffd27a;
    --border:rgba(255,255,255,.08);

}

body.light-mode{

    --bg:#f5f5f7;
    --card:#fff;
    --white:#111;
    --text:#666;
    --border:rgba(0,0,0,.08);

}

*{

    margin:0;
    padding:0;
    box-sizing:border-box;

}

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

.contact-page{

    width:100%;

    max-width:1400px;

    margin:auto;

    padding:
    130px 16px 80px;

}

.contact-top{

    text-align:center;

    margin-bottom:60px;

}

.contact-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.contact-top h1{

    font-size:
    clamp(40px,6vw,80px);

    margin:
    10px 0 16px;

}

.contact-top p{

    max-width:760px;

    margin:auto;

    line-height:1.9;

    color:var(--text);

}

.contact-wrapper{

    display:grid;

    grid-template-columns:
    1fr 1fr;

    gap:30px;

}

/* CARD */

.contact-card{

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    border-radius:34px;

    padding:34px;

    backdrop-filter:
    blur(18px);

    overflow:hidden;

}

/* INFO */

.contact-info{

    display:flex;

    flex-direction:column;

    gap:24px;

}

.contact-box{

    display:flex;

    align-items:flex-start;

    gap:18px;

}

.contact-icon{

    width:70px;
    height:70px;

    border-radius:22px;

    flex-shrink:0;

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

}

.contact-text h2{

    font-size:26px;

    margin-bottom:10px;

}

.contact-text p{

    color:var(--text);

    line-height:1.9;

}

/* FORM */

.contact-form{

    display:flex;

    flex-direction:column;

    gap:20px;

}

.contact-form input,
.contact-form textarea{

    width:100%;

    border:none;

    outline:none;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    border-radius:20px;

    padding:18px;

    color:var(--white);

    font-size:15px;

    font-family:'Poppins',sans-serif;

}

.contact-form textarea{

    min-height:180px;

    resize:none;

}

.contact-btn{

    height:58px;

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

.contact-btn:hover{

    transform:
    translateY(-4px);

}

/* MAP */

.contact-map{

    margin-top:30px;

    overflow:hidden;

    border-radius:30px;

    border:
    1px solid var(--border);

}

.contact-map iframe{

    width:100%;

    height:320px;

    border:none;

}

/* RESPONSIVE */

@media(max-width:900px){

    .contact-wrapper{

        grid-template-columns:1fr;

    }

}

@media(max-width:768px){

    .contact-page{

        padding:
        120px 14px 70px;

    }

    .contact-card{

        padding:24px 18px;

        border-radius:24px;

    }

    .contact-icon{

        width:60px;
        height:60px;

        font-size:22px;

        border-radius:18px;

    }

    .contact-text h2{

        font-size:22px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<main class="contact-page">

    <!-- TOP -->

    <div class="contact-top">

        <span>

            Get In Touch

        </span>

        <h1>

            Contact Us

        </h1>

        <p>

            Reach out to Hungroo Café
            for reservations, support,
            feedback or premium dining assistance.

        </p>

    </div>

    <!-- WRAPPER -->

    <div class="contact-wrapper">

        <!-- LEFT -->

        <div class="contact-card">

            <div class="contact-info">

                <!-- ITEM -->

                <div class="contact-box">

                    <div class="contact-icon">

                        <i class="fa-solid fa-location-dot"></i>

                    </div>

                    <div class="contact-text">

                        <h2>

                            Address

                        </h2>

                        <p>

                            Chandigarh, India

                        </p>

                    </div>

                </div>

                <!-- ITEM -->

                <div class="contact-box">

                    <div class="contact-icon">

                        <i class="fa-solid fa-phone"></i>

                    </div>

                    <div class="contact-text">

                        <h2>

                            Phone

                        </h2>

                        <p>

                            +91 99999 99999

                        </p>

                    </div>

                </div>

                <!-- ITEM -->

                <div class="contact-box">

                    <div class="contact-icon">

                        <i class="fa-solid fa-envelope"></i>

                    </div>

                    <div class="contact-text">

                        <h2>

                            Email

                        </h2>

                        <p>

                            hungroo@gmail.com

                        </p>

                    </div>

                </div>

            </div>

            <!-- MAP -->

            <div class="contact-map">

                <iframe
                src=
                "https://maps.google.com/maps?q=chandigarh&t=&z=13&ie=UTF8&iwloc=&output=embed">
                </iframe>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="contact-card">

            <form class="contact-form">

                <input
                type="text"

                placeholder=
                "Full Name"

                required>

                <input
                type="email"

                placeholder=
                "Email Address"

                required>

                <input
                type="text"

                placeholder=
                "Subject"

                required>

                <textarea
                placeholder=
                "Write your message..."
                required></textarea>

                <button
                type="submit"

                class="contact-btn">

                    Send Message

                </button>

            </form>

        </div>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>