<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | FAQ";

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

.faq-page{

    width:100%;

    max-width:1200px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.faq-top{

    text-align:center;

    margin-bottom:46px;

}

.faq-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.faq-top h1{

    font-size:
    clamp(38px,6vw,78px);

    margin:
    10px 0 16px;

}

.faq-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
LIST
===================================================== */

.faq-list{

    display:flex;

    flex-direction:column;

    gap:20px;

}

/* =====================================================
ITEM
===================================================== */

.faq-item{

    overflow:hidden;

    border-radius:28px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

    transition:.35s;

}

.faq-item.active{

    border-color:
    rgba(255,154,61,.22);

}

/* =====================================================
QUESTION
===================================================== */

.faq-question{

    width:100%;

    border:none;

    outline:none;

    cursor:pointer;

    display:flex;
    align-items:center;
    justify-content:space-between;

    gap:18px;

    padding:26px;

    background:transparent;

    color:var(--white);

    text-align:left;

    font-size:20px;

    font-weight:600;

    font-family:'Poppins',sans-serif;

}

/* =====================================================
ICON
===================================================== */

.faq-question i{

    flex-shrink:0;

    transition:.35s;

    color:var(--primary);

}

.faq-item.active
.faq-question i{

    transform:
    rotate(180deg);

}

/* =====================================================
ANSWER
===================================================== */

.faq-answer{

    max-height:0;

    overflow:hidden;

    transition:
    max-height .4s ease;

}

.faq-answer-content{

    padding:
    0 26px 26px;

}

.faq-answer p{

    color:var(--text);

    line-height:2;

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .faq-page{

        padding:
        120px 14px 70px;

    }

    .faq-item{

        border-radius:22px;

    }

    .faq-question{

        padding:20px 18px;

        font-size:17px;

    }

    .faq-answer-content{

        padding:
        0 18px 20px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="faq-page">

    <!-- TOP -->

    <div class="faq-top">

        <span>

            Help & Support

        </span>

        <h1>

            Frequently Asked Questions

        </h1>

        <p>

            Find answers to common questions
            about Hungroo Café orders,
            reservations, delivery and payments.

        </p>

    </div>

    <!-- LIST -->

    <section class="faq-list">

        <!-- ITEM -->

        <div class="faq-item active">

            <button class="faq-question">

                How can I place an order?

                <i class="fa-solid fa-chevron-down"></i>

            </button>

            <div class="faq-answer">

                <div class="faq-answer-content">

                    <p>

                        Browse the menu,
                        add your favorite meals
                        to the cart and complete
                        checkout securely.

                    </p>

                </div>

            </div>

        </div>

        <!-- ITEM -->

        <div class="faq-item">

            <button class="faq-question">

                Do you offer table booking?

                <i class="fa-solid fa-chevron-down"></i>

            </button>

            <div class="faq-answer">

                <div class="faq-answer-content">

                    <p>

                        Yes, you can reserve
                        premium seating directly
                        from the booking page.

                    </p>

                </div>

            </div>

        </div>

        <!-- ITEM -->

        <div class="faq-item">

            <button class="faq-question">

                What payment methods are accepted?

                <i class="fa-solid fa-chevron-down"></i>

            </button>

            <div class="faq-answer">

                <div class="faq-answer-content">

                    <p>

                        We accept UPI, debit cards,
                        credit cards, net banking
                        and cash on delivery.

                    </p>

                </div>

            </div>

        </div>

        <!-- ITEM -->

        <div class="faq-item">

            <button class="faq-question">

                How can I track my order?

                <i class="fa-solid fa-chevron-down"></i>

            </button>

            <div class="faq-answer">

                <div class="faq-answer-content">

                    <p>

                        Visit the Track Order page
                        to see real-time order
                        and delivery updates.

                    </p>

                </div>

            </div>

        </div>

    </section>

</main>

<?php include "footer.php"; ?>

<!-- =====================================================
SCRIPT
===================================================== -->

<script>

const faqItems =
document.querySelectorAll(
".faq-item"
);

faqItems.forEach(item=>{

    const button =
    item.querySelector(
    ".faq-question"
    );

    const answer =
    item.querySelector(
    ".faq-answer"
    );

    /* ACTIVE DEFAULT */

    if(item.classList.contains(
    "active"
    )){

        answer.style.maxHeight =

        answer.scrollHeight + "px";

    }

    /* CLICK */

    button.addEventListener(
    "click",
    ()=>{

        const active =
        item.classList.contains(
        "active"
        );

        /* RESET */

        faqItems.forEach(faq=>{

            faq.classList.remove(
            "active"
            );

            faq.querySelector(
            ".faq-answer"
            ).style.maxHeight = null;

        });

        /* OPEN */

        if(!active){

            item.classList.add(
            "active"
            );

            answer.style.maxHeight =

            answer.scrollHeight + "px";

        }

    });

});

</script>

<script src="assets/js/theme.js"></script>

</body>
</html>