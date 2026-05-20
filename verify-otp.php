<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Verify OTP";

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

.otp-page{

    min-height:100vh;

    width:100%;

    display:flex;
    align-items:center;
    justify-content:center;

    padding:
    130px 16px 80px;

}

/* =====================================================
BOX
===================================================== */

.otp-box{

    position:relative;

    width:100%;

    max-width:560px;

    padding:42px;

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
TOP
===================================================== */

.otp-top{

    text-align:center;

    margin-bottom:34px;

}

.otp-icon{

    width:90px;
    height:90px;

    margin:auto auto 24px;

    border-radius:28px;

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

    font-size:34px;

}

.otp-top h1{

    font-size:
    clamp(34px,7vw,52px);

    line-height:1.1;

    margin-bottom:14px;

}

.otp-top p{

    color:var(--text);

    line-height:1.9;

    font-size:15px;

}

/* =====================================================
FORM
===================================================== */

.otp-form{

    width:100%;

}

/* =====================================================
OTP INPUTS
===================================================== */

.otp-inputs{

    width:100%;

    display:grid;

    grid-template-columns:
    repeat(6,1fr);

    gap:14px;

    margin-bottom:30px;

}

.otp-inputs input{

    width:100%;
    height:74px;

    border:none;

    outline:none;

    text-align:center;

    border-radius:20px;

    background:
    rgba(255,255,255,.05);

    border:
    1px solid var(--border);

    color:var(--white);

    font-size:26px;

    font-weight:700;

    font-family:'Poppins',sans-serif;

    transition:.3s;

}

.otp-inputs input:focus{

    border-color:
    rgba(255,154,61,.4);

    box-shadow:
    0 0 0 4px
    rgba(255,154,61,.08);

}

/* =====================================================
BUTTON
===================================================== */

.otp-btn{

    width:100%;

    height:66px;

    border:none;

    outline:none;

    cursor:pointer;

    border-radius:22px;

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

.otp-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
BOTTOM
===================================================== */

.otp-bottom{

    margin-top:26px;

    text-align:center;

    color:var(--text);

    font-size:14px;

}

.otp-bottom a{

    color:var(--primary);

    text-decoration:none;

    font-weight:600;

}

/* =====================================================
TIMER
===================================================== */

.otp-timer{

    margin-top:18px;

    text-align:center;

    color:var(--text);

    font-size:14px;

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .otp-box{

        padding:30px 18px;

        border-radius:28px;

    }

    .otp-inputs{

        gap:10px;

    }

    .otp-inputs input{

        height:62px;

        font-size:22px;

        border-radius:16px;

    }

}

@media(max-width:520px){

    .otp-inputs{

        gap:8px;

    }

    .otp-inputs input{

        height:54px;

        font-size:18px;

        border-radius:14px;

    }

    .otp-btn{

        height:60px;

        border-radius:18px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="otp-page">

    <section class="otp-box premium-border">

        <!-- TOP -->

        <div class="otp-top">

            <div class="otp-icon">

                <i class="fa-solid fa-shield-halved"></i>

            </div>

            <h1>

                Verify OTP

            </h1>

            <p>

                Enter the 6-digit verification code
                sent to your registered email or phone.

            </p>

        </div>

        <!-- FORM -->

        <form
        class="otp-form"

        action="#"
        method="POST">

            <!-- OTP -->

            <div class="otp-inputs">

                <input
                type="text"
                maxlength="1">

                <input
                type="text"
                maxlength="1">

                <input
                type="text"
                maxlength="1">

                <input
                type="text"
                maxlength="1">

                <input
                type="text"
                maxlength="1">

                <input
                type="text"
                maxlength="1">

            </div>

            <!-- BUTTON -->

            <button
            type="submit"

            class="otp-btn">

                Verify Account

            </button>

        </form>

        <!-- TIMER -->

        <div class="otp-timer">

            Resend code in
            <span id="otpTimer">

                30

            </span>
            sec

        </div>

        <!-- BOTTOM -->

        <div class="otp-bottom">

            Didn’t receive code?

            <a href="#">

                Resend OTP

            </a>

        </div>

    </section>

</main>

<?php include "footer.php"; ?>

<!-- =====================================================
SCRIPT
===================================================== -->

<script>

/* =====================================================
OTP INPUT AUTO NEXT
===================================================== */

const otpInputs =
document.querySelectorAll(
".otp-inputs input"
);

otpInputs.forEach((input,index)=>{

    input.addEventListener(
    "input",
    ()=>{

        input.value =
        input.value.replace(
        /[^0-9]/g,
        ""
        );

        if(

            input.value &&
            otpInputs[index + 1]

        ){

            otpInputs[index + 1]
            .focus();

        }

    });

    /* BACKSPACE */

    input.addEventListener(
    "keydown",
    (event)=>{

        if(

            event.key ===
            "Backspace"

            &&

            !input.value

            &&

            otpInputs[index - 1]

        ){

            otpInputs[index - 1]
            .focus();

        }

    });

});

/* =====================================================
TIMER
===================================================== */

let timer = 30;

const timerEl =
document.getElementById(
"otpTimer"
);

const otpInterval =
setInterval(()=>{

    timer--;

    timerEl.textContent =
    timer;

    if(timer <= 0){

        clearInterval(
        otpInterval
        );

        timerEl.textContent =
        "0";

    }

},1000);

</script>

<script src="assets/js/theme.js"></script>

</body>
</html>