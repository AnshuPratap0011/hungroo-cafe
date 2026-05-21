<?php

include "config/config.php";

$pageTitle =
"Hungroo Café | Contact";

/* =========================================================
FORM SUBMIT
========================================================= */

if(isset($_POST['send_message'])){

    $full_name =

    mysqli_real_escape_string(
    $conn,
    $_POST['full_name']
    );

    $email =

    mysqli_real_escape_string(
    $conn,
    $_POST['email']
    );

    $phone =

    mysqli_real_escape_string(
    $conn,
    $_POST['phone']
    );

    $subject =

    mysqli_real_escape_string(
    $conn,
    $_POST['subject']
    );

    $message =

    mysqli_real_escape_string(
    $conn,
    $_POST['message']
    );

    /* =====================================================
    INSERT
    ====================================================== */

    $query =

    "INSERT INTO contact_messages (

        full_name,
        email,
        phone,
        subject,
        message

    )

    VALUES (

        '$full_name',
        '$email',
        '$phone',
        '$subject',
        '$message'

    )";

    mysqli_query(
    $conn,
    $query
    );

    $success = true;

}

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

<!-- FONT -->

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- ICON -->

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

<style>

/* =========================================================
ROOT
========================================================= */

:root{

    --bg:#070707;

    --card:#111111;

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

body{

    background:var(--bg);

    color:var(--white);

    font-family:'Poppins',sans-serif;

    overflow-x:hidden;

}

/* =========================================================
WRAPPER
========================================================= */

.contact-wrapper{

    width:100%;

    max-width:1450px;

    margin:auto;

    padding:
    140px 16px 90px;

}

/* =========================================================
TOP
========================================================= */

.contact-top{

    text-align:center;

    margin-bottom:70px;

}

.contact-top span{

    display:inline-flex;

    padding:
    10px 20px;

    border-radius:999px;

    background:
    rgba(255,154,61,.10);

    border:
    1px solid rgba(255,154,61,.14);

    color:#ffb15e;

    font-size:13px;

    font-weight:700;

    margin-bottom:24px;

}

.contact-top h1{

    font-size:
    clamp(50px,7vw,100px);

    line-height:1.05;

    margin-bottom:20px;

}

.contact-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:2;

}

/* =========================================================
GRID
========================================================= */

.contact-grid{

    display:grid;

    grid-template-columns:
    .9fr 1.1fr;

    gap:34px;

}

/* =========================================================
INFO
========================================================= */

.contact-info{

    display:flex;

    flex-direction:column;

    gap:22px;

}

.contact-card{

    padding:28px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

body.light-mode
.contact-card{

    background:#fff;

}

.contact-card i{

    width:62px;
    height:62px;

    margin-bottom:18px;

    border-radius:18px;

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

}

.contact-card h3{

    font-size:24px;

    margin-bottom:12px;

}

.contact-card p{

    color:var(--text);

    line-height:1.9;

}

/* =========================================================
FORM
========================================================= */

.contact-form{

    padding:34px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

body.light-mode
.contact-form{

    background:#fff;

}

.contact-form h2{

    font-size:42px;

    margin-bottom:30px;

}

/* =========================================================
SUCCESS
========================================================= */

.success-box{

    margin-bottom:24px;

    padding:18px;

    border-radius:18px;

    background:
    rgba(76,175,80,.12);

    border:
    1px solid rgba(76,175,80,.18);

    color:#4caf50;

    font-size:14px;

    font-weight:600;

}

/* =========================================================
FORM GRID
========================================================= */

.form-grid{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:20px;

}

.form-group{

    display:flex;

    flex-direction:column;

    gap:10px;

}

.form-group.full{

    grid-column:1/-1;

}

.form-group label{

    font-size:14px;

    font-weight:600;

}

.form-group input,
.form-group textarea{

    width:100%;

    border:none;

    outline:none;

    padding:18px;

    border-radius:18px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:var(--white);

    font-size:14px;

    font-family:'Poppins',sans-serif;

}

body.light-mode
.form-group input,
body.light-mode
.form-group textarea{

    color:#111;

}

.form-group textarea{

    height:160px;

    resize:none;

}

/* =========================================================
BUTTON
========================================================= */

.submit-btn{

    width:100%;

    height:62px;

    margin-top:24px;

    border:none;

    cursor:pointer;

    border-radius:18px;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:15px;

    font-weight:800;

    transition:.35s;

}

.submit-btn:hover{

    transform:
    translateY(-4px);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:992px){

    .contact-grid{

        grid-template-columns:1fr;

    }

}

@media(max-width:768px){

    .contact-wrapper{

        padding:
        120px 12px 70px;

    }

    .form-grid{

        grid-template-columns:1fr;

    }

    .contact-form{

        padding:24px;

        border-radius:26px;

    }

    .contact-form h2{

        font-size:32px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =========================================================
WRAPPER
========================================================= -->

<div class="contact-wrapper">

    <!-- TOP -->

    <div class="contact-top">

        <span>

            Contact Hungroo Café

        </span>

        <h1>

            Let's Talk

        </h1>

        <p>

            Have questions, suggestions or want
            to connect with us? We'd love to hear
            from you.

        </p>

    </div>

    <!-- GRID -->

    <div class="contact-grid">

        <!-- INFO -->

        <div class="contact-info">

            <div class="contact-card">

                <i class="fa-solid fa-location-dot"></i>

                <h3>

                    Address

                </h3>

                <p>

                    India

                </p>

            </div>

            <div class="contact-card">

                <i class="fa-solid fa-phone"></i>

                <h3>

                    Phone

                </h3>

                <p>

                    +91 9876543210

                </p>

            </div>

            <div class="contact-card">

                <i class="fa-solid fa-envelope"></i>

                <h3>

                    Email

                </h3>

                <p>

                    support@hungroo.com

                </p>

            </div>

        </div>

        <!-- FORM -->

        <div class="contact-form">

            <h2>

                Send Message

            </h2>

            <?php if(isset($success)): ?>

            <div class="success-box">

                Message sent successfully.

            </div>

            <?php endif; ?>

            <form method="POST">

                <div class="form-grid">

                    <div class="form-group">

                        <label>

                            Full Name

                        </label>

                        <input
                        type="text"

                        name="full_name"

                        required>

                    </div>

                    <div class="form-group">

                        <label>

                            Email

                        </label>

                        <input
                        type="email"

                        name="email"

                        required>

                    </div>

                    <div class="form-group">

                        <label>

                            Phone

                        </label>

                        <input
                        type="text"

                        name="phone">

                    </div>

                    <div class="form-group">

                        <label>

                            Subject

                        </label>

                        <input
                        type="text"

                        name="subject">

                    </div>

                    <div class="form-group full">

                        <label>

                            Message

                        </label>

                        <textarea
                        name="message"

                        required></textarea>

                    </div>

                </div>

                <button
                type="submit"

                name="send_message"

                class="submit-btn">

                    Send Message

                </button>

            </form>

        </div>

    </div>

</div>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>
<script src="assets/js/cart.js"></script>
<script src="assets/js/preloader.js"></script>

</body>
</html>