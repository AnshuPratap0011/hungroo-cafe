<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Loading";

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

<style>

/* =====================================================
ROOT
===================================================== */

:root{

    --bg:#050505;

    --primary:#ff9a3d;
    --gold:#ffd27a;

    --white:#ffffff;
    --text:#bdbdbd;

}

/* =====================================================
BODY
===================================================== */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

body{

    width:100%;
    height:100vh;

    overflow:hidden;

    background:
    radial-gradient(
    circle at top,
    rgba(255,154,61,.14),
    transparent 35%
    ),
    var(--bg);

    display:flex;
    align-items:center;
    justify-content:center;

    font-family:'Poppins',sans-serif;

}

/* =====================================================
WRAPPER
===================================================== */

.loader-wrapper{

    position:relative;

    text-align:center;

}

/* =====================================================
LOGO
===================================================== */

.loader-logo{

    position:relative;

    width:140px;
    height:140px;

    margin:auto;

    border-radius:40px;

    overflow:hidden;

    display:flex;
    align-items:center;
    justify-content:center;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid rgba(255,255,255,.08);

    backdrop-filter:blur(18px);

    animation:
    pulse 2s infinite ease-in-out;

}

.loader-logo img{

    width:88px;

    object-fit:contain;

}

/* =====================================================
RING
===================================================== */

.loader-ring{

    position:absolute;

    inset:-16px;

    border-radius:50%;

    border:
    3px solid transparent;

    border-top:
    3px solid var(--primary);

    border-right:
    3px solid var(--gold);

    animation:
    rotate 1.2s linear infinite;

}

/* =====================================================
TEXT
===================================================== */

.loader-wrapper h1{

    margin-top:34px;

    font-size:42px;

    color:var(--white);

}

.loader-wrapper p{

    margin-top:12px;

    color:var(--text);

    font-size:14px;

    letter-spacing:2px;

}

/* =====================================================
BAR
===================================================== */

.loader-bar{

    width:320px;
    height:10px;

    margin-top:30px;

    border-radius:999px;

    overflow:hidden;

    background:
    rgba(255,255,255,.08);

}

.loader-progress{

    width:0%;

    height:100%;

    border-radius:999px;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    animation:
    load 3s ease forwards;

}

/* =====================================================
ANIMATION
===================================================== */

@keyframes rotate{

    from{

        transform:rotate(0deg);

    }

    to{

        transform:rotate(360deg);

    }

}

@keyframes pulse{

    0%{

        transform:scale(1);

    }

    50%{

        transform:scale(1.04);

    }

    100%{

        transform:scale(1);

    }

}

@keyframes load{

    from{

        width:0%;

    }

    to{

        width:100%;

    }

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:600px){

    .loader-logo{

        width:120px;
        height:120px;

    }

    .loader-logo img{

        width:72px;

    }

    .loader-wrapper h1{

        font-size:32px;

    }

    .loader-bar{

        width:260px;

    }

}

</style>

</head>

<body>

<!-- =====================================================
LOADER
===================================================== -->

<div class="loader-wrapper">

    <!-- LOGO -->

    <div class="loader-logo">

        <div class="loader-ring"></div>

        <img
        src="hlogo.png"
        alt="Hungroo Café">

    </div>

    <!-- TITLE -->

    <h1>

        Hungroo Café

    </h1>

    <!-- TEXT -->

    <p>

        PREMIUM CAFÉ EXPERIENCE

    </p>

    <!-- BAR -->

    <div class="loader-bar">

        <div class="loader-progress"></div>

    </div>

</div>

<!-- =====================================================
SCRIPT
===================================================== -->

<script>

/* =====================================================
REDIRECT
===================================================== */

setTimeout(()=>{

    window.location.href =
    "home.php";

},3000);

</script>

</body>
</html>