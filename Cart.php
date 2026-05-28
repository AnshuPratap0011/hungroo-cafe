<?php
/* =========================================================
CART.PHP
========================================================= */

include "config/config.php";

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='login.php'</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Cart | Hungroo Café</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root,[data-theme="dark"]{--c-bg:#09090b;--c-bg2:#18181b;--c-card:#1e1e22;--c-card-h:#26262b;--c-border:rgba(255,255,255,.06);--c-border-h:rgba(255,255,255,.12);--c-text:#fff;--c-text2:#a1a1aa;--c-text3:#71717a;--c-accent:#6C5CE7;--c-accent-l:#a29bfe;--c-accent-h:#5b4bd5;--c-green:#00b894;--c-red:#e74c3c;--c-input:rgba(255,255,255,.05);--c-input-b:rgba(255,255,255,.08);--c-shadow:0 4px 24px rgba(0,0,0,.4);--c-scroll:#27272a}
[data-theme="light"]{--c-bg:#f4f4f5;--c-bg2:#fff;--c-card:#fff;--c-card-h:#fafafa;--c-border:rgba(0,0,0,.08);--c-border-h:rgba(0,0,0,.15);--c-text:#09090b;--c-text2:#52525b;--c-text3:#a1a1aa;--c-accent:#6C5CE7;--c-accent-l:#6C5CE7;--c-accent-h:#5b4bd5;--c-green:#00a884;--c-red:#dc2626;--c-input:rgba(0,0,0,.04);--c-input-b:rgba(0,0,0,.1);--c-shadow:0 2px 12px rgba(0,0,0,.06);--c-scroll:#d4d4d8}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Poppins',sans-serif;background:var(--c-bg);color:var(--c-text);-webkit-font-smoothing:antialiased;transition:background .35s ease,color .35s ease}
a{text-decoration:none;color:inherit}
img{display:block;max-width:100%}
::-webkit-scrollbar{width:6px}::-webkit-scrollbar-track{background:transparent}::-webkit-scrollbar-thumb{background:var(--c-scroll);border-radius:3px}

.ct-blobs{position:fixed;inset:0;z-index:0;pointer-events:none;overflow:hidden}
.ct-blob{position:absolute;border-radius:50%;filter:blur(130px)}
.ct-blob-1{width:500px;height:500px;background:rgba(108,92,231,.1);top:-200px;right:-150px}
.ct-blob-2{width:400px;height:400px;background:rgba(0,184,148,.08);bottom:-150px;left:-100px}

.ct-header{position:relative;z-index:1;text-align:center;padding:120px 24px 40px}
.ct-header-badge{display:inline-flex;align-items:center;gap:8px;padding:8px 18px;border-radius:50px;background:rgba(108,92,231,.12);border:1px solid rgba(108,92,231,.25);color:var(--c-accent-l);font-size:12px;font-weight:600;margin-bottom:20px}
.ct-header h1{font-size:clamp(36px,5vw,56px);font-weight:900;line-height:1.1;margin-bottom:12px;transition:color .35s ease}
.ct-header p{font-size:15px;color:var(--c-text2);max-width:500px;margin:0 auto;transition:color .35s ease}

.ct-section{position:relative;z-index:1;max-width:1200px;margin:0 auto;padding:0 24px 80px}

.ct-grid{display:grid;grid-template-columns:1fr 380px;gap:24px;align-items:start}

.ct-items{display:flex;flex-direction:column;gap:16px;min-height:300px}

.ct-card{display:flex;gap:20px;padding:20px;background:var(--c-card);border:1px solid var(--c-border);border-radius:16px;transition:all .3s ease;animation:ctIn .4s ease both}
.ct-card:hover{border-color:var(--c-border-h);box-shadow:var(--c-shadow)}
@keyframes ctIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}
.ct-card-img{width:110px;height:110px;border-radius:12px;overflow:hidden;flex-shrink:0}
.ct-card-img img{width:100%;height:100%;object-fit:cover}
.ct-card-body{flex:1;display:flex;flex-direction:column;justify-content:space-between;min-height:110px}
.ct-card-name{font-size:15px;font-weight:600;margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;transition:color .35s ease}
.ct-card-desc{font-size:12px;color:var(--c-text3);margin-bottom:auto;transition:color .35s ease}
.ct-card-bottom{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-top:12px}
.ct-card-price{font-size:18px;font-weight:800;color:var(--c-accent-l);transition:color .35s ease}
.ct-qty{display:flex;align-items:center;gap:0;background:var(--c-accent);border-radius:10px;overflow:hidden;box-shadow:0 2px 10px rgba(108,92,231,.3)}
.ct-qty-btn{width:34px;height:34px;background:transparent;color:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;transition:background .2s ease}
.ct-qty-btn:hover{background:rgba(255,255,255,.15)}
.ct-qty-num{font-size:14px;font-weight:700;color:#fff;min-width:28px;text-align:center}
.ct-remove{background:none;border:none;color:var(--c-text3);cursor:pointer;font-size:18px;padding:4px;transition:color .25s ease;border-radius:6px}
.ct-remove:hover{color:var(--c-red);background:rgba(231,76,60,.08)}

.ct-empty{grid-column:1/-1;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;min-height:400px;background:var(--c-card);border:1px solid var(--c-border);border-radius:20px;padding:40px;transition:all .35s ease}
.ct-empty-icon{width:80px;height:80px;border-radius:50%;background:var(--c-input);display:flex;align-items:center;justify-content:center;font-size:32px;color:var(--c-text3);margin-bottom:20px}
.ct-empty h2{font-size:24px;font-weight:700;margin-bottom:8px;transition:color .35s ease}
.ct-empty p{font-size:14px;color:var(--c-text3);margin-bottom:24px;transition:color .35s ease}
.ct-empty-btn{display:inline-flex;align-items:center;gap:8px;padding:12px 28px;background:var(--c-accent);color:#fff;border-radius:12px;font-size:14px;font-weight:600;transition:all .3s ease;box-shadow:0 4px 15px rgba(108,92,231,.3)}
.ct-empty-btn:hover{background:var(--c-accent-h);transform:translateY(-2px)}

.ct-summary{position:sticky;top:100px;background:var(--c-card);border:1px solid var(--c-border);border-radius:20px;padding:28px;transition:all .35s ease}
.ct-summary h2{font-size:20px;font-weight:700;margin-bottom:24px;transition:color .35s ease}
.ct-row{display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid var(--c-border);transition:border-color .35s ease}
.ct-row:last-of-type{border-bottom:none}
.ct-row-label{font-size:14px;color:var(--c-text2);transition:color .35s ease}
.ct-row-value{font-size:14px;font-weight:600;transition:color .35s ease}
.ct-row.free .ct-row-value{color:var(--c-green)}
.ct-total-row{display:flex;align-items:center;justify-content:space-between;padding:18px 0 0;margin-top:8px;border-top:2px solid var(--c-border);border-bottom:none;transition:border-color .35s ease}
.ct-total-label{font-size:16px;font-weight:600;color:var(--c-text2);transition:color .35s ease}
.ct-total-value{font-size:22px;font-weight:800;transition:color .35s ease}
.ct-delivery{display:flex;align-items:center;gap:10px;padding:12px 16px;background:rgba(0,184,148,.08);border:1px solid rgba(0,184,148,.15);border-radius:10px;margin-bottom:20px;color:var(--c-green);font-size:13px;font-weight:500;transition:all .35s ease}
.ct-delivery i{font-size:14px}
.ct-clear-btn{width:100%;padding:12px;border:1px solid var(--c-border);border-radius:12px;background:transparent;color:var(--c-text2);font-family:inherit;font-size:13px;font-weight:500;cursor:pointer;transition:all .25s ease;margin-bottom:16px;display:flex;align-items:center;justify-content:center;gap:8px}
.ct-clear-btn:hover{border-color:var(--c-red);color:var(--c-red);background:rgba(231,76,60,.05)}
.ct-checkout{width:100%;padding:16px;background:var(--c-accent);color:#fff;border:none;border-radius:14px;font-family:inherit;font-size:15px;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;transition:all .3s ease;box-shadow:0 4px 20px rgba(108,92,231,.35)}
.ct-checkout:hover{background:var(--c-accent-h);transform:translateY(-1px);box-shadow:0 6px 28px rgba(108,92,231,.45)}
.ct-checkout:disabled{opacity:.4;cursor:not-allowed;transform:none !important;box-shadow:none}

@media(max-width:900px){.ct-grid{grid-template-columns:1fr}.ct-summary{position:relative;top:0;order:-1}}
@media(max-width:600px){.ct-card{flex-direction:column;gap:14px;padding:16px}.ct-card-img{width:100%;height:160px;border-radius:12px}.ct-card-body{min-height:auto}.ct-card-bottom{flex-direction:column;align-items:stretch;gap:12px}.ct-qty{align-self:flex-start}}
</style>
</head>
<body>

<div class="ct-blobs">
    <div class="ct-blob ct-blob-1"></div>
    <div class="ct-blob ct-blob-2"></div>
</div>

<?php include "Navbar.php"; ?>

<div class="ct-header">
    <div class="ct-header-badge"><i class="fa-solid fa-basket-shopping"></i> Your Selection</div>
    <h1>My Cart</h1>
    <p>Review your items before placing order</p>
</div>

<section class="ct-section">
    <div class="ct-grid">

        <div class="ct-items" id="cartItems"></div>

        <div class="ct-summary">
            <h2>Order Summary</h2>
            <div class="ct-delivery">
                <i class="fa-solid fa-bolt"></i>
                Estimated delivery: 10 minutes
            </div>
            <div class="ct-row">
                <span class="ct-row-label">Subtotal (<span id="itemCount">0</span> items)</span>
                <span class="ct-row-value" id="subtotal">₹0</span>
            </div>
            <div class="ct-row free">
                <span class="ct-row-label">Delivery Fee</span>
                <span class="ct-row-value">FREE</span>
            </div>
            <div class="ct-total-row">
                <span class="ct-total-label">Total</span>
                <span class="ct-total-value" id="total">₹0</span>
            </div>
            <button class="ct-clear-btn" id="clearCartBtn" style="display:none">
                <i class="fa-solid fa-trash-can"></i> Clear Cart
            </button>
            <button class="ct-checkout" id="checkoutBtn" disabled>
                Proceed to Checkout <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>

    </div>
</section>

<?php include "footer.php"; ?>

<script>
let cart = JSON.parse(localStorage.getItem('cart')) || [];
const cartItems = document.getElementById('cartItems');
const subtotalEl = document.getElementById('subtotal');
const totalEl = document.getElementById('total');
const itemCountEl = document.getElementById('itemCount');
const clearBtn = document.getElementById('clearCartBtn');
const checkoutBtn = document.getElementById('checkoutBtn');

function save() {
    localStorage.setItem('cart', JSON.stringify(cart));
    let n = 0;
    cart.forEach(i => n += i.quantity);
    document.querySelectorAll('.cart-count').forEach(el => {
        el.textContent = n;
        el.style.display = n > 0 ? 'flex' : 'none';
    });
}

function render() {
    cartItems.innerHTML = '';
    if (cart.length === 0) {
        cartItems.innerHTML = `
            <div class="ct-empty">
                <div class="ct-empty-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                <h2>Your cart is empty</h2>
                <p>Add some delicious items from our menu</p>
                <a href="menu.php" class="ct-empty-btn"><i class="fa-solid fa-utensils"></i> Explore Menu</a>
            </div>`;
        subtotalEl.textContent = '₹0';
        totalEl.textContent = '₹0';
        itemCountEl.textContent = '0';
        clearBtn.style.display = 'none';
        checkoutBtn.disabled = true;
        return;
    }
    let sub = 0;
    cart.forEach((item, i) => {
        const itemTotal = item.price * item.quantity;
        sub += itemTotal;
        cartItems.innerHTML += `
            <div class="ct-card">
                <div class="ct-card-img">
                    <img src="${item.image}" alt="${item.name}" onerror="this.src='https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=300&auto=format&fit=crop'">
                </div>
                <div class="ct-card-body">
                    <div>
                        <div class="ct-card-name">${item.name}</div>
                        <div class="ct-card-desc">Premium Hungroo Special</div>
                    </div>
                    <div class="ct-card-bottom">
                        <div class="ct-card-price">₹${item.price}</div>
                        <div class="ct-qty">
                            <button class="ct-qty-btn" onclick="changeQty(${i},-1)"><i class="fa-solid fa-minus"></i></button>
                            <span class="ct-qty-num">${item.quantity}</span>
                            <button class="ct-qty-btn" onclick="changeQty(${i},1)"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>
                    <button class="ct-remove" onclick="removeItem(${i})" title="Remove"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>`;
    });
    subtotalEl.textContent = '₹' + sub;
    totalEl.textContent = '₹' + sub;
    itemCountEl.textContent = cart.length;
    clearBtn.style.display = '';
    checkoutBtn.disabled = false;
}

function changeQty(i, val) {
    cart[i].quantity += val;
    if (cart[i].quantity <= 0) cart.splice(i, 1);
    save();
    render();
}

function removeItem(i) {
    cart.splice(i, 1);
    save();
    render();
}

clearBtn.addEventListener('click', () => {
    cart = [];
    save();
    render();
});

checkoutBtn.addEventListener('click', () => {
    if (cart.length > 0) {
        window.location.href = 'checkout.php';
    }
});

render();
</script>

</body>
</html>