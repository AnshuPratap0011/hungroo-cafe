<?php

$pageTitle =
"Hungroo Café | Offers";

$offers = [

[
"title"=>"Burger Combo",
"discount"=>"50% OFF",
"image"=>"assets/images/burger.jpg"
],

[
"title"=>"Premium Coffee",
"discount"=>"Buy 1 Get 1",
"image"=>"assets/images/coffee.jpg"
],

[
"title"=>"Pizza Feast",
"discount"=>"Free Drink",
"image"=>"assets/images/pizza.jpg"
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

<title><?php echo $pageTitle; ?></title>

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

.offers-page{

max-width:1400px;

margin:auto;

padding:
130px 16px 80px;

}

.offers-top{

text-align:center;

margin-bottom:50px;

}

.offers-top h1{

font-size:
clamp(40px,6vw,80px);

margin-bottom:14px;

}

.offers-top p{

max-width:760px;

margin:auto;

line-height:1.9;

color:var(--text);

}

.offers-grid{

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(320px,1fr));

gap:28px;

}

.offer-card{

overflow:hidden;

border-radius:34px;

background:
rgba(255,255,255,.04);

border:
1px solid var(--border);

transition:.35s;

}

.offer-card:hover{

transform:
translateY(-10px);

}

.offer-image{

position:relative;

height:260px;

overflow:hidden;

}

.offer-image img{

width:100%;
height:100%;

object-fit:cover;

transition:.4s;

}

.offer-card:hover
.offer-image img{

transform:
scale(1.08);

}

.offer-badge{

position:absolute;

top:18px;
left:18px;

padding:
12px 18px;

border-radius:999px;

background:
linear-gradient(
135deg,
var(--primary),
var(--gold)
);

color:#000;

font-size:13px;

font-weight:700;

}

.offer-content{

padding:24px;

}

.offer-content h2{

font-size:30px;

margin-bottom:12px;

}

.offer-content p{

line-height:1.9;

color:var(--text);

margin-bottom:24px;

}

.offer-btn{

width:100%;

height:56px;

border:none;

cursor:pointer;

border-radius:18px;

font-size:14px;

font-weight:700;

background:
linear-gradient(
135deg,
var(--primary),
var(--gold)
);

color:#000;

}

@media(max-width:768px){

.offers-page{

padding:
120px 14px 70px;

}

.offers-grid{

grid-template-columns:1fr;

}

.offer-card{

border-radius:24px;

}

.offer-image{

height:220px;

}

.offer-content{

padding:18px;

}

.offer-content h2{

font-size:24px;

}

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<main class="offers-page">

<div class="offers-top">

<h1>

Exclusive Offers

</h1>

<p>

Unlock premium Hungroo Café
deals and limited-time combo offers.

</p>

</div>

<div class="offers-grid">

<?php foreach($offers as $offer): ?>

<div class="offer-card">

<div class="offer-image">

<img
src="<?php echo $offer['image']; ?>"
alt="offer">

<div class="offer-badge">

<?php echo $offer['discount']; ?>

</div>

</div>

<div class="offer-content">

<h2>

<?php echo $offer['title']; ?>

</h2>

<p>

Premium handcrafted meals
with luxury café vibes.

</p>

<button class="offer-btn">

Claim Offer

</button>

</div>

</div>

<?php endforeach; ?>

</div>

</main>

<?php include "footer.php"; ?>

</body>
</html>