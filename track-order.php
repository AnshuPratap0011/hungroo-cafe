<?php

$pageTitle =
"Hungroo Café | Track Order";

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

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link
rel="stylesheet"
href="assets/css/navbar.css">

<link
rel="stylesheet"
href="assets/css/footer.css">

<style>

:root{

--bg:#070707;
--card:#121212;
--white:#fff;
--text:#bdbdbd;
--primary:#ff9a3d;
--gold:#ffd27a;
--green:#2ecc71;
--border:rgba(255,255,255,.08);

}

*{

margin:0;
padding:0;
box-sizing:border-box;

}

body{

overflow-x:hidden;

background:var(--bg);

color:var(--white);

font-family:'Poppins',sans-serif;

}

.track-page{

max-width:1200px;

margin:auto;

padding:
130px 16px 80px;

}

.track-top{

text-align:center;

margin-bottom:60px;

}

.track-top h1{

font-size:
clamp(40px,6vw,80px);

margin-bottom:16px;

}

.track-top p{

max-width:760px;

margin:auto;

line-height:1.9;

color:var(--text);

}

/* CARD */

.track-card{

padding:36px;

border-radius:34px;

background:
rgba(255,255,255,.04);

border:
1px solid var(--border);

}

/* SEARCH */

.track-search{

display:flex;

gap:18px;

flex-wrap:wrap;

margin-bottom:50px;

}

.track-input{

flex:1;

min-width:240px;

height:60px;

border:none;

outline:none;

padding:
0 20px;

border-radius:18px;

background:
rgba(255,255,255,.04);

border:
1px solid var(--border);

color:#fff;

font-size:15px;

}

.track-btn{

height:60px;

padding:
0 28px;

border:none;

cursor:pointer;

border-radius:18px;

font-size:15px;

font-weight:700;

background:
linear-gradient(
135deg,
var(--primary),
var(--gold)
);

color:#000;

}

/* STATUS */

.track-status{

display:flex;

justify-content:space-between;

gap:20px;

flex-wrap:wrap;

position:relative;

}

.track-status::before{

content:"";

position:absolute;

top:38px;
left:0;

width:100%;
height:4px;

background:
rgba(255,255,255,.08);

z-index:-1;

}

.step{

flex:1;

min-width:180px;

text-align:center;

}

.step-icon{

width:80px;
height:80px;

margin:auto auto 18px;

border-radius:50%;

display:flex;
align-items:center;
justify-content:center;

background:
rgba(255,255,255,.06);

border:
2px solid rgba(255,255,255,.08);

font-size:32px;

}

.step.active .step-icon{

background:
linear-gradient(
135deg,
var(--primary),
var(--gold)
);

color:#000;

border:none;

}

.step h2{

font-size:22px;

margin-bottom:10px;

}

.step p{

font-size:14px;

line-height:1.8;

color:var(--text);

}

@media(max-width:768px){

.track-page{

padding:
120px 14px 70px;

}

.track-card{

padding:24px 18px;

border-radius:24px;

}

.track-status{

flex-direction:column;

}

.track-status::before{

display:none;

}

.step{

text-align:left;

display:flex;

gap:18px;

align-items:flex-start;

}

.step-icon{

margin:0;

width:65px;
height:65px;

font-size:24px;

flex-shrink:0;

}

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<main class="track-page">

<div class="track-top">

<h1>

Track Your Order

</h1>

<p>

Track your premium Hungroo Café
delivery in real-time.

</p>

</div>

<div class="track-card">

<!-- SEARCH -->

<div class="track-search">

<input
type="text"

class="track-input"

placeholder=
"Enter Order ID">

<button class="track-btn">

Track Order

</button>

</div>

<!-- STATUS -->

<div class="track-status">

<!-- STEP -->

<div class="step active">

<div class="step-icon">

<i class="fa-solid fa-check"></i>

</div>

<div>

<h2>

Order Confirmed

</h2>

<p>

Your premium order is confirmed.

</p>

</div>

</div>

<!-- STEP -->

<div class="step active">

<div class="step-icon">

<i class="fa-solid fa-kitchen-set"></i>

</div>

<div>

<h2>

Preparing

</h2>

<p>

Our chefs are preparing your meal.

</p>

</div>

</div>

<!-- STEP -->

<div class="step">

<div class="step-icon">

<i class="fa-solid fa-motorcycle"></i>

</div>

<div>

<h2>

Out For Delivery

</h2>

<p>

Delivery partner is on the way.

</p>

</div>

</div>

<!-- STEP -->

<div class="step">

<div class="step-icon">

<i class="fa-solid fa-house"></i>

</div>

<div>

<h2>

Delivered

</h2>

<p>

Your order has arrived.

</p>

</div>

</div>

</div>

</div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>