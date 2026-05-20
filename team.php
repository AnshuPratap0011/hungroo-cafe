<?php

session_start();

$pageTitle =
"Hungroo Café | Our Team";

/* =========================================================
TEAM MEMBERS
========================================================= */

$teamMembers = [

    [
        "name"  => "Aarav Sharma",
        "role"  => "Head Chef",
        "image" => "assets/images/team1.jpg"
    ],

    [
        "name"  => "Priya Verma",
        "role"  => "Coffee Specialist",
        "image" => "assets/images/team2.jpg"
    ],

    [
        "name"  => "Rahul Mehta",
        "role"  => "Restaurant Manager",
        "image" => "assets/images/team3.jpg"
    ],

    [
        "name"  => "Ananya Singh",
        "role"  => "Dessert Expert",
        "image" => "assets/images/team4.jpg"
    ]

];

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

.team-page{

    width:100%;

    max-width:1450px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =========================================================
TOP
========================================================= */

.team-top{

    text-align:center;

    margin-bottom:60px;

}

.team-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.team-top h1{

    font-size:
    clamp(42px,6vw,84px);

    margin:
    10px 0 16px;

}

.team-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:2;

}

/* =========================================================
GRID
========================================================= */

.team-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(300px,1fr));

    gap:28px;

}

/* =========================================================
CARD
========================================================= */

.team-card{

    overflow:hidden;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    transition:.35s;

    backdrop-filter:
    blur(18px);

}

.team-card:hover{

    transform:
    translateY(-8px);

}

/* =========================================================
IMAGE
========================================================= */

.team-image{

    position:relative;

    overflow:hidden;

    height:340px;

}

.team-image img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.4s;

}

.team-card:hover
.team-image img{

    transform:
    scale(1.08);

}

/* =========================================================
SOCIAL
========================================================= */

.team-social{

    position:absolute;

    right:20px;
    bottom:20px;

    display:flex;

    flex-direction:column;

    gap:12px;

}

.team-social a{

    width:48px;
    height:48px;

    border-radius:16px;

    display:flex;
    align-items:center;
    justify-content:center;

    text-decoration:none;

    background:
    rgba(0,0,0,.55);

    backdrop-filter:
    blur(12px);

    color:#ffffff;

    transition:.35s;

}

.team-social a:hover{

    transform:
    translateY(-4px);

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

}

/* =========================================================
CONTENT
========================================================= */

.team-content{

    padding:26px;

    text-align:center;

}

.team-content h2{

    font-size:30px;

    margin-bottom:10px;

}

.team-content p{

    color:var(--text);

    line-height:1.8;

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:768px){

    .team-page{

        padding:
        120px 14px 70px;

    }

    .team-grid{

        grid-template-columns:1fr;

    }

    .team-card{

        border-radius:24px;

    }

    .team-image{

        height:280px;

    }

    .team-content{

        padding:20px 18px;

    }

    .team-content h2{

        font-size:24px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<main class="team-page">

    <!-- TOP -->

    <div class="team-top">

        <span>

            Meet Our Experts

        </span>

        <h1>

            Our Premium Team

        </h1>

        <p>

            Meet the passionate chefs,
            coffee specialists and café experts
            behind the Hungroo Café experience.

        </p>

    </div>

    <!-- GRID -->

    <div class="team-grid">

        <?php foreach($teamMembers as $member): ?>

        <div class="team-card">

            <!-- IMAGE -->

            <div class="team-image">

                <img
                src="<?php echo $member['image']; ?>"
                alt="<?php echo $member['name']; ?>">

                <!-- SOCIAL -->

                <div class="team-social">

                    <a href="#">

                        <i class="fa-brands fa-instagram"></i>

                    </a>

                    <a href="#">

                        <i class="fa-brands fa-facebook-f"></i>

                    </a>

                    <a href="#">

                        <i class="fa-brands fa-linkedin-in"></i>

                    </a>

                </div>

            </div>

            <!-- CONTENT -->

            <div class="team-content">

                <h2>

                    <?php echo $member['name']; ?>

                </h2>

                <p>

                    <?php echo $member['role']; ?>

                </p>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

<script src="assets/js/preloader.js"></script>

</body>
</html>  