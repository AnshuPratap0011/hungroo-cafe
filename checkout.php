<?php
/* =========================================================
CHECKOUT.PHP — Premium Checkout Page
Hungroo Café
========================================================= */

include "config/config.php";

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='login.php'</script>";
    exit;
}

/* =========================================================
USER INFO
========================================================= */

 $userId = (int) $_SESSION['user_id'];

 $userQuery = mysqli_query($conn, "SELECT full_name, email, phone FROM users WHERE id = '$userId' LIMIT 1");
 
 if($userQuery){
     $user = mysqli_fetch_assoc($userQuery);
 } else {
     $user = ['full_name' => '', 'email' => '', 'phone' => ''];
 }

/* =========================================================
INITIALIZE VARIABLES
========================================================= */

 $subtotal = 0;
 $discount = 0;
 $couponCode = '';
 $couponMsg = '';
 $couponType = '';
 $orderError = '';
 $orderPlaced = false;
 $orderNumber = '';
 $deliveryFee = 0;

/* =========================================================
HANDLE AJAX COUPON CHECK
========================================================= */

if (isset($_POST['check_coupon']) && isset($_POST['coupon_code'])) {
    
    $cartData = isset($_POST['cart_data']) ? $_POST['cart_data'] : '[]';
    $cart = json_decode($cartData, true); 
    $sub = 0;
    
    if(is_array($cart)){
        foreach ($cart as $item) {
            $price = isset($item['price']) ? $item['price'] : (isset($item->price) ? $item->price : 0);
            $qty   = isset($item['quantity']) ? $item['quantity'] : (isset($item->quantity) ? $item->quantity : 0);
            $sub += (float)$price * (int)$qty;
        }
    }

    $code = trim($_POST['coupon_code']);
    $disc = 0;

    if (strtoupper($code) === 'HUNGRY30') {
        $disc = round($sub * 0.30);
        $couponMsg = '30% discount applied!';
        $couponType = 'success';
    } elseif (strtoupper($code) === 'FLAT100') {
        $disc = 100;
        $couponMsg = '₹100 off applied!';
        $couponType = 'success';
    } elseif (strtoupper($code) === 'FREEDELIVERY') {
        $couponMsg = 'Free delivery applied!';
        $couponType = 'success';
    } else if (!empty($code)) {
        $couponMsg = 'Invalid coupon code';
        $couponType = 'error';
    }

    echo json_encode(['type' => $couponType, 'msg' => $couponMsg, 'discount' => $disc]);
    exit;
}

/* =========================================================
PLACE ORDER
========================================================= */

if (isset($_POST['place_order'])) {

    $cartData = isset($_POST['cart_data']) ? $_POST['cart_data'] : '[]';
    $cart = json_decode($cartData);

    if (!is_array($cart) && !is_object($cart)) {
        $orderError = 'Invalid cart data';
    } elseif (empty($cart)) {
        $orderError = 'Your cart is empty';
    } else {

        $couponCode = isset($_POST['coupon_code']) ? trim($_POST['coupon_code']) : '';
        $name = mysqli_real_escape_string($conn, $_POST['delivery_name']);
        $phone = mysqli_real_escape_string($conn, $_POST['delivery_phone']);
        $address = mysqli_real_escape_string($conn, $_POST['delivery_address']);
        $notes = isset($_POST['order_notes']) ? mysqli_real_escape_string($conn, $_POST['order_notes']) : '';
        $payment = mysqli_real_escape_string($conn, $_POST['payment_method']);

        if (empty($name) || empty($phone) || empty($address)) {
            $orderError = 'Please fill in all required delivery details';
        } else {

            // Calculate Subtotal
            $sub = 0;
            $cartArray = is_array($cart) ? $cart : (array)$cart;
            
            foreach ($cartArray as $item) {
                $p = is_array($item) ? $item['price'] : $item->price;
                $q = is_array($item) ? $item['quantity'] : $item->quantity;
                $sub += (float)$p * (int)$q;
            }

            /* Calculate Discount */
            if (strtoupper($couponCode) === 'HUNGRY30') {
                $discount = round($sub * 0.30);
            } elseif (strtoupper($couponCode) === 'FLAT100') {
                $discount = 100;
            }

            $total = max(0, $sub - $discount) + $deliveryFee;
            $orderNumber = 'HG' . str_pad($userId, 4, '0', STR_PAD_LEFT) . date('dmHi');

            /* 
               FIXED INSERT QUERY
               We are listing 12 columns explicitly.
               We are providing 12 values (10 placeholders + 2 hardcoded strings).
               We are binding 10 variables.
            */
            $sql = "INSERT INTO orders (
                        order_number, 
                        user_id, 
                        subtotal, 
                        delivery_fee, 
                        discount, 
                        total, 
                        coupon_code, 
                        status, 
                        payment_method, 
                        payment_status, 
                        delivery_address, 
                        notes
                    ) VALUES (
                        ?,        -- order_number (1)
                        ?,        -- user_id (2)
                        ?,        -- subtotal (3)
                        ?,        -- delivery_fee (4)
                        ?,        -- discount (5)
                        ?,        -- total (6)
                        ?,        -- coupon_code (7)
                        'confirmed', -- status (Hardcoded)
                        ?,        -- payment_method (8)
                        'paid',   -- payment_status (Hardcoded)
                        ?,        -- delivery_address (9)
                        ?         -- notes (10)
                    )";

            if ($stmt = $conn->prepare($sql)) {
                
                // Bind types: s=string, i=int, d=double
                // Total 10 variables to bind
                $stmt->bind_param(
                    'siddddssss', 
                    $orderNumber, 
                    $userId, 
                    $sub, 
                    $deliveryFee, 
                    $discount, 
                    $total, 
                    $couponCode, 
                    $payment, 
                    $address, 
                    $notes
                );
                
                if ($stmt->execute()) {
                    $orderId = $conn->insert_id;

                    /* Insert order items */
                    foreach ($cartArray as $item) {
                        $id = is_array($item) ? $item['id'] : $item->id;
                        $name = is_array($item) ? $item['name'] : $item->name;
                        $image = is_array($item) ? $item['image'] : $item->image;
                        $price = is_array($item) ? $item['price'] : $item->price;
                        $qty = is_array($item) ? $item['quantity'] : $item->quantity;
                        
                        $itemTotal = (float)$price * (int)$qty;

                        $itemSql = "INSERT INTO order_items (
                                        order_id, 
                                        product_id, 
                                        product_name, 
                                        product_image, 
                                        price, 
                                        quantity, 
                                        total
                                    ) VALUES (
                                        '$orderId', 
                                        '$id', 
                                        '$name', 
                                        '$image', 
                                        '$price', 
                                        '$qty', 
                                        '$itemTotal'
                                    )";
                        
                        mysqli_query($conn, $itemSql);
                    }
                    $orderPlaced = true;
                } else {
                    $orderError = "Database error: Could not place order.";
                }
                $stmt->close();
            } else {
                $orderError = "Database error: Prepare failed. Check table structure.";
            
            }
        }
    }
}

 $total = 0; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout | Hungroo Café</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root,[data-theme="dark"]{--co-bg:#09090b;--co-bg2:#18181b;--co-card:#1e1e22;--co-card-h:#26262b;--co-border:rgba(255,255,255,.06);--co-border-h:rgba(255,255,255,.12);--co-text:#fff;--co-text2:#a1a1aa;--co-text3:#71717a;--co-accent:#6C5CE7;--co-accent-l:#a29bfe;--co-accent-h:#5b4bd5;--co-green:#00b894;--co-red:#e74c3c;--co-input:rgba(255,255,255,.05);--co-input-b:rgba(255,255,255,.08);--co-shadow:0 4px 24px rgba(0,0,0,.4);--co-scroll:#27272a}
[data-theme="light"]{--co-bg:#f4f4f5;--co-bg2:#fff;--co-card:#fff;--co-card-h:#fafafa;--co-border:rgba(0,0,0,.08);--co-border-h:rgba(0,0,0,.15);--co-text:#09090b;--co-text2:#52525b;--co-text3:#a1a1aa;--co-accent:#6C5CE7;--co-accent-l:#6C5CE7;--co-accent-h:#5b4bd5;--co-green:#00a884;--co-red:#dc2626;--co-input:rgba(0,0,0,.04);--co-input-b:rgba(0,0,0,.1);--co-shadow:0 2px 12px rgba(0,0,0,.06);--co-scroll:#d4d4d8}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Poppins',sans-serif;background:var(--co-bg);color:var(--co-text);-webkit-font-smoothing:antialiased;transition:background .35s ease,color .35s ease}
a{text-decoration:none;color:inherit}
img{display:block;max-width:100%}
::-webkit-scrollbar{width:6px}::-webkit-scrollbar-track{background:transparent}::-webkit-scrollbar-thumb{background:var(--co-scroll);border-radius:3px}
.co-blobs{position:fixed;inset:0;z-index:0;pointer-events:none;overflow:hidden}
.co-blob{position:absolute;border-radius:50%;filter:blur(130px)}
.co-blob-1{width:500px;height:500px;background:rgba(108,92,231,.1);top:-200px;right:-150px}
.co-blob-2{width:400px;height:400px;background:rgba(0,184,148,.08);bottom:-150px;left:-100px}
.co-header{position:relative;z-index:1;text-align:center;padding:120px 24px 40px}
.co-header h1{font-size:clamp(28px,4vw,40px);font-weight:800;margin-bottom:8px;transition:color .35s ease}
.co-header p{font-size:14px;color:var(--co-text2);transition:color .35s ease}
.co-section{position:relative;z-index:1;max-width:1100px;margin:0 auto;padding:0 24px 80px;display:grid;grid-template-columns:1fr 400px;gap:24px;align-items:start}
.co-left{display:flex;flex-direction:column;gap:20px}
.co-card{background:var(--co-card);border:1px solid var(--co-border);border-radius:16px;padding:24px;transition:all .35s ease}
.co-card h3{font-size:16px;font-weight:700;margin-bottom:18px;display:flex;align-items:center;gap:8px;transition:color .35s ease}
.co-card h3 i{color:var(--co-accent-l);font-size:18px}
.co-field{margin-bottom:16px}
.co-field label{display:block;font-size:12px;font-weight:600;color:var(--co-text3);margin-bottom:6px;transition:color .35s ease}
.co-input{width:100%;height:48px;padding:0 16px;border-radius:12px;background:var(--co-input);border:1px solid var(--co-input-b);color:var(--co-text);font-family:inherit;font-size:14px;outline:none;transition:all .3s ease}
.co-input:focus{border-color:var(--co-accent);box-shadow:0 0 0 3px rgba(108,92,231,.2)}
textarea.co-input{height:80px;padding:12px 16px;resize:vertical}
.co-payment{display:flex;gap:10px}
.co-pay-opt{flex:1;display:flex;align-items:center;gap:10px;padding:14px 16px;border-radius:12px;background:var(--co-input);border:2px solid var(--co-border);cursor:pointer;transition:all .25s ease;font-family:inherit}
.co-pay-opt:hover{border-color:var(--co-border-h)}
.co-pay-opt input{display:none}
.co-pay-opt i{font-size:20px;color:var(--co-text2);transition:color .25s ease}
.co-pay-opt.active i{color:var(--co-accent-l)}
.co-pay-opt span{font-size:13px;font-weight:500;color:var(--co-text2);transition:color .25s ease}
.co-pay-opt.active span{color:var(--co-text);font-weight:600}
.co-coupon-row{display:flex;gap:10px}
.co-coupon-row .co-input{flex:1}
.co-coupon-btn{height:48px;padding:0 20px;border-radius:12px;background:var(--co-accent);color:#fff;border:none;font-family:inherit;font-size:13px;font-weight:600;cursor:pointer;white-space:nowrap;transition:all .3s ease;box-shadow:0 2px 10px rgba(108,92,231,.3)}
.co-coupon-btn:hover{background:var(--co-accent-h)}
.co-alert{padding:12px 16px;border-radius:10px;font-size:13px;font-weight:500;margin-bottom:16px;display:flex;align-items:center;gap:8px;animation:coIn .35s ease}
@keyframes coIn{from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:translateY(0)}}
.co-alert.error{background:rgba(231,76,60,.08);border:1px solid rgba(231,76,60,.16);color:var(--co-red)}
.co-alert.success{background:rgba(0,184,148,.08);border:1px solid rgba(0,184,148,.16);color:var(--co-green)}
.co-items{background:var(--co-card);border:1px solid var(--co-border);border-radius:16px;padding:20px;transition:all .35s ease}
.co-items h3{font-size:16px;font-weight:700;margin-bottom:16px;transition:color .35s ease}
.co-item{display:flex;align-items:center;gap:14px;padding:12px 0;border-bottom:1px solid var(--co-border);transition:border-color .35s ease}
.co-item:last-child{border-bottom:none}
.co-item-img{width:50px;height:50px;border-radius:10px;overflow:hidden;flex-shrink:0}
.co-item-img img{width:100%;height:100%;object-fit:cover}
.co-item-info{flex:1;min-width:0}
.co-item-name{font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;transition:color .35s ease}
.co-item-qty{font-size:12px;color:var(--co-text3);transition:color .35s ease}
.co-item-price{font-size:14px;font-weight:700;color:var(--co-accent-l);white-space:nowrap;transition:color .35s ease}
.co-right{position:sticky;top:100px}
.co-summary{background:var(--co-card);border:1px solid var(--co-border);border-radius:16px;padding:24px;transition:all .35s ease}
.co-summary h3{font-size:18px;font-weight:700;margin-bottom:20px;transition:color .35s ease}
.co-row{display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid var(--co-border);font-size:14px;transition:border-color .35s ease}
.co-row:last-child{border-bottom:none}
.co-row-label{color:var(--co-text2);transition:color .35s ease}
.co-row-value{font-weight:600;transition:color .35s ease}
.co-row.discount .co-row-value{color:var(--co-green)}
.co-row.free .co-row-value{color:var(--co-green)}
.co-total{display:flex;justify-content:space-between;padding:16px 0 0;margin-top:8px;border-top:2px solid var(--co-border);border-bottom:none;font-size:16px;font-weight:700;transition:border-color .35s ease}
.co-total .co-row-value{font-size:20px;color:var(--co-accent-l)}
.co-place-btn{width:100%;height:54px;margin-top:20px;border:none;border-radius:14px;background:var(--co-accent);color:#fff;font-family:inherit;font-size:15px;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;transition:all .3s ease;box-shadow:0 4px 20px rgba(108,92,231,.35)}
.co-place-btn:hover{background:var(--co-accent-h);transform:translateY(-1px);box-shadow:0 6px 28px rgba(108,92,231,.45)}
.co-place-btn:disabled{opacity:.4;cursor:not-allowed;transform:none!important;box-shadow:none}
.co-safe{display:flex;align-items:center;gap:8px;margin-top:16px;justify-content:center;font-size:11px;color:var(--co-text3);transition:color .35s ease}
.co-safe i{color:var(--co-green);font-size:13px}
.co-success{position:relative;z-index:1;max-width:500px;margin:40px auto;text-align:center;padding:60px 32px}
.co-success-icon{width:90px;height:90px;border-radius:50%;background:rgba(0,184,148,.1);display:flex;align-items:center;justify-content:center;margin:0 auto 24px;font-size:36px;color:var(--co-green);animation:coPop .5s ease}
@keyframes coPop{0%{transform:scale(0)}50%{transform:scale(1.1)}100%{transform:scale(1)}}
.co-success h2{font-size:28px;font-weight:800;margin-bottom:8px;color:var(--co-green);transition:color .35s ease}
.co-success p{font-size:15px;color:var(--co-text2);margin-bottom:6px;transition:color .35s ease}
.co-success .order-num{font-size:13px;color:var(--co-text3);margin-bottom:28px;transition:color .35s ease}
.co-success-btns{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}
.co-success-btn{display:inline-flex;align-items:center;gap:8px;padding:12px 28px;border-radius:12px;font-size:14px;font-weight:600;transition:all .3s ease;font-family:inherit;cursor:pointer}
.co-success-btn.primary{background:var(--co-accent);color:#fff;box-shadow:0 4px 15px rgba(108,92,231,.3)}
.co-success-btn.primary:hover{background:var(--co-accent-h);transform:translateY(-1px)}
.co-success-btn.secondary{background:var(--co-input);color:var(--co-text);border:1px solid var(--co-border)}
.co-success-btn.secondary:hover{border-color:var(--co-border-h);color:var(--co-text)}
@media(max-width:900px){.co-section{grid-template-columns:1fr}.co-right{position:relative;top:0;order:-1}}
@media(max-width:600px){.co-payment{flex-direction:column}.co-coupon-row{flex-direction:column}.co-success{padding:40px 20px}.co-success h2{font-size:24px}}
</style>
</head>
<body>

<div class="co-blobs">
    <div class="co-blob co-blob-1"></div>
    <div class="co-blob co-blob-2"></div>
</div>

<?php include "Navbar.php"; ?>

<?php if ($orderPlaced): ?>
<div class="co-success">
    <div class="co-success-icon"><i class="fa-solid fa-check"></i></div>
    <h2>Order Placed!</h2>
    <p>Your delicious food is being prepared</p>
    <div class="order-num">Order #<?php echo $orderNumber; ?></div>
    <div class="co-success-btns">
        <a href="orders.php" class="co-success-btn primary"><i class="fa-solid fa-box"></i> View Orders</a>
        <a href="menu.php" class="co-success-btn secondary"><i class="fa-solid fa-utensils"></i> Order More</a>
    </div>
</div>
<?php else: ?>

<div class="co-header">
    <h1>Checkout</h1>
    <p>Almost there! Complete your order below</p>
</div>

<section class="co-section">
    <div class="co-left">

        <?php if (isset($orderError)): ?>
        <div class="co-alert error"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $orderError; ?></div>
        <?php endif; ?>

        <!-- DELIVERY -->
        <div class="co-card">
            <h3><i class="fa-solid fa-location-dot"></i> Delivery Details</h3>
            <form method="POST" id="checkoutForm">
                <div class="co-field">
                    <label>Full Name *</label>
                    <input type="text" name="delivery_name" class="co-input" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                </div>
                <div class="co-field">
                    <label>Phone Number *</label>
                    <input type="tel" name="delivery_phone" class="co-input" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" placeholder="10 digit number" required>
                </div>
                <div class="co-field">
                    <label>Delivery Address *</label>
                    <textarea name="delivery_address" class="co-input" placeholder="House no, Street, Area, Landmark" required></textarea>
                </div>
                <div class="co-field">
                    <label>Order Notes (optional)</label>
                    <input type="text" name="order_notes" class="co-input" placeholder="Any special instructions">
                </div>
        </div>

        <!-- PAYMENT -->
        <div class="co-card">
            <h3><i class="fa-solid fa-credit-card"></i> Payment Method</h3>
            <div class="co-payment">
                <label class="co-pay-opt active" onclick="selectPayment(this, 'cod')">
                    <input type="radio" name="payment_method" value="cod" checked>
                    <i class="fa-solid fa-money-bill-wave"></i>
                    <span>Cash on Delivery</span>
                </label>
                <label class="co-pay-opt" onclick="selectPayment(this, 'online')">
                    <input type="radio" name="payment_method" value="online">
                    <i class="fa-solid fa-wallet"></i>
                    <span>Online Payment</span>
                </label>
            </div>
        </div>

        <!-- COUPON -->
        <div class="co-card">
            <h3><i class="fa-solid fa-tag"></i> Coupon Code</h3>
            <div class="co-coupon-row">
                <input type="text" name="coupon_code" class="co-input" placeholder="Enter code" id="couponInput">
                <button type="button" class="co-coupon-btn" id="applyCouponBtn">Apply</button>
            </div>
            <div id="couponMsg"></div>
            <p style="font-size:11px;color:var(--co-text3);margin-top:8px">Try: HUNGRY30, FLAT100, FREEDELIVERY</p>
        </div>

        <!-- ORDER ITEMS PREVIEW -->
        <div class="co-items">
            <h3><i class="fa-solid fa-bag-shopping"></i> Your Items</h3>
            <div id="checkoutItemsList"></div>
        </div>

        <!-- HIDDEN CART DATA + SUBMIT -->
        <input type="hidden" name="cart_data" id="cartDataInput">
        <input type="hidden" name="place_order" value="1">

    </div>

    <!-- RIGHT SUMMARY -->
    <div class="co-right">
        <div class="co-summary">
            <h3>Bill Summary</h3>
            <div class="co-row">
                <span class="co-row-label">Subtotal</span>
                <span class="co-row-value" id="coSubtotal">₹0</span> 
            </div>
            <div class="co-row" id="discountRow" style="display:none">
                <span class="co-row-label"></span>
                <span class="co-row-value discount"></span>
            </div>
            <div class="co-row free">
                <span class="co-row-label">Delivery</span>
                <span class="co-row-value">FREE</span>
            </div>
            <div class="co-total">
                <span class="co-row-label">Total</span>
                <span class="co-row-value" id="coTotal">₹0</span> 
            </div>
            <button type="submit" form="checkoutForm" class="co-place-btn" id="placeOrderBtn">
                <i class="fa-solid fa-lock"></i> Place Order
            </button>
            <div class="co-safe">
                <i class="fa-solid fa-shield-halved"></i>
                Safe & Secure Payment
            </div>
        </div>
    </div>

</section>
<?php endif; ?>

<?php include "footer.php"; ?>

<script>
let cart = JSON.parse(localStorage.getItem('cart')) || [];

/* POPULATE ITEMS */
const itemsList = document.getElementById('checkoutItemsList');

if (itemsList && cart.length > 0) {
    itemsList.innerHTML = cart.map(item => `
        <div class="co-item">
            <div class="co-item-img"><img src="${item.image}" alt="${item.name}"></div>
            <div class="co-item-info">
                <div class="co-item-name">${item.name}</div>
                <div class="co-item-qty">x${item.quantity}</div>
            </div>
            <div class="co-item-price">₹${item.price * item.quantity}</div>
        </div>
    `).join('');
} else if (itemsList) {
    itemsList.innerHTML = '<p style="color:var(--co-text3);font-size:13px;padding:8px 0">No items</p>';
}

/* SET CART DATA */
const cartInput = document.getElementById('cartDataInput');
if (cartInput) cartInput.value = JSON.stringify(cart);

/* PAYMENT */
function selectPayment(el, value) {
    document.querySelectorAll('.co-pay-opt').forEach(opt => opt.classList.remove('active'));
    el.classList.add('active');
    el.querySelector('input').checked = true;
}

/* CALCULATE INITIAL TOTAL */
function updateSummary() {
    let subtotal = 0;
    cart.forEach(item => {
        subtotal += (item.price * item.quantity);
    });
    
    document.getElementById('coSubtotal').textContent = '₹' + subtotal;
    if(document.getElementById('discountRow').style.display === 'none') {
        document.getElementById('coTotal').textContent = '₹' + subtotal;
    }
}
updateSummary();

/* COUPON — AJAX check */
const applyBtn = document.getElementById('applyCouponBtn');
const couponInput = document.getElementById('couponInput');
const couponMsg = document.getElementById('couponMsg');
const discountRow = document.getElementById('discountRow');

if(applyBtn) {
    applyBtn.addEventListener('click', () => {
        const code = couponInput.value.trim();
        if (!code) return;

        applyBtn.disabled = true;
        applyBtn.textContent = 'Checking...';

        const formData = new FormData();
        formData.append('check_coupon', '1');
        formData.append('coupon_code', code);
        formData.append('cart_data', JSON.stringify(cart));

        fetch('checkout.php', { method: 'POST', body: formData })
            .then(r => r.json())
            .then(data => {
                applyBtn.disabled = false;
                applyBtn.textContent = 'Apply';

                couponMsg.innerHTML = `<div class="co-alert ${data.type}"><i class="fa-solid ${data.type === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'}"></i> ${data.msg}</div>`;

                if (data.discount > 0) {
                    discountRow.style.display = '';
                    discountRow.querySelector('.co-row-label').textContent = 'Discount';
                    discountRow.querySelector('.co-row-value').textContent = '-₹' + data.discount;
                } else {
                    discountRow.style.display = 'none';
                }

                /* Update total */
                const sub = parseFloat(document.getElementById('coSubtotal').textContent.replace(/[^\d.-]/g, ''));
                const disc = data.discount || 0;
                const total = Math.max(0, sub - disc);
                document.getElementById('coTotal').textContent = '₹' + total;
            })
            .catch(() => {
                applyBtn.disabled = false;
                applyBtn.textContent = 'Apply';
                couponMsg.innerHTML = '<div class="co-alert error"><i class="fa-solid fa-circle-exclamation"></i> Error applying coupon</div>';
            });
    });
}

/* PLACE ORDER */
const placeBtn = document.getElementById('placeOrderBtn');
const form = document.getElementById('checkoutForm');

if (form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if(cart.length === 0) {
            alert("Your cart is empty!");
            return;
        }

        placeBtn.disabled = true;
        placeBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Placing...';

        const formData = new FormData(form);
        formData.set('cart_data', JSON.stringify(cart));

        fetch('checkout.php', { method: 'POST', body: formData })
            .then(r => r.text())
            .then(html => {
                document.documentElement.innerHTML = html;
                localStorage.removeItem('cart');
                document.querySelectorAll('.cart-count').forEach(el => {
                    el.textContent = '0';
                    el.style.display = 'none';
                });
            })
            .catch(err => {
                placeBtn.disabled = false;
                placeBtn.innerHTML = '<i class="fa-solid fa-lock"></i> Place Order';
                alert("Error placing order. Please try again.");
            });
    });
}
</script>

</body>
</html>