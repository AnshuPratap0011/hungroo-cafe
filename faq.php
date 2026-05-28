<?php
// You can uncomment these lines when integrating into your main project
// require_once "db.php"; 
// include "config/config.php";
// if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hungroo Café | FAQ</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CSS STYLES -->
    <style>
        /* =========================================================
        ROOT VARIABLES (Theme Integration)
        ========================================================= */
        :root {
            --bg: #070707;
            --card: #121212;
            --white: #ffffff;
            --text: #bdbdbd;
            --primary: #ff9a3d;
            --gold: #ffd27a;
            --border: rgba(255, 255, 255, .08);
            --nav-bg: rgba(7, 7, 7, 0.85);
        }

        body.light-mode {
            --bg: #f5f5f7;
            --card: #ffffff;
            --white: #111111;
            --text: #666666;
            --border: rgba(0, 0, 0, .08);
            --nav-bg: rgba(255, 255, 255, 0.85);
        }

        /* =========================================================
        RESET & GLOBAL
        ========================================================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
            background: radial-gradient(circle at top right, rgba(255, 154, 61, .08), transparent 30%), var(--bg);
            color: var(--white);
            font-family: 'Poppins', sans-serif;
            transition: background 0.3s ease, color 0.3s ease;
        }

        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        img { max-width: 100%; display: block; }
        button { border: none; background: none; cursor: pointer; font-family: inherit; }

        /* =========================================================
        MOCK NAVBAR (Visual Consistency)
        ========================================================= */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 80px;
            background: var(--nav-bg);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5%;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .logo {
            font-size: 24px;
            font-weight: 800;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo i { color: var(--primary); }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            font-size: 15px;
            font-weight: 500;
            color: var(--text);
            transition: color 0.3s;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--primary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .theme-toggle {
            color: var(--text);
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s;
        }
        .theme-toggle:hover { color: var(--white); }

        .cart-btn-wrap {
            position: relative;
            cursor: pointer;
            color: var(--white);
            font-size: 20px;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--primary);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: none; /* hidden by default */
            align-items: center;
            justify-content: center;
        }

        /* Mobile Menu Button */
        .menu-toggle {
            display: none;
            color: var(--white);
            font-size: 24px;
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .menu-toggle { display: block; }
        }

        /* =========================================================
        PAGE STYLES (FAQ)
        ========================================================= */
        .faq-page {
            width: 100%;
            max-width: 900px;
            margin: auto;
            padding: 140px 20px 100px;
        }

        .faq-top {
            text-align: center;
            margin-bottom: 50px;
            animation: fadeInUp 0.8s ease;
        }

        .faq-top span {
            color: var(--primary);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .faq-top h1 {
            font-size: clamp(38px, 5vw, 64px);
            margin: 10px 0 20px;
            line-height: 1.1;
        }

        .faq-top p {
            max-width: 600px;
            margin: auto;
            color: var(--text);
            line-height: 1.8;
            font-size: 16px;
        }

        /* =========================================================
        FAQ LIST & ITEMS
        ========================================================= */
        .faq-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .faq-item {
            overflow: hidden;
            border-radius: 24px;
            background: var(--card);
            border: 1px solid var(--border);
            transition: all 0.35s ease;
            animation: fadeInUp 0.8s ease forwards;
            opacity: 0;
        }

        /* Staggered animation delays */
        .faq-item:nth-child(1) { animation-delay: 0.1s; }
        .faq-item:nth-child(2) { animation-delay: 0.2s; }
        .faq-item:nth-child(3) { animation-delay: 0.3s; }
        .faq-item:nth-child(4) { animation-delay: 0.4s; }

        .faq-item:hover {
            border-color: rgba(255, 154, 61, 0.3);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .faq-item.active {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.03);
        }

        .faq-question {
            width: 100%;
            padding: 26px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            color: var(--white);
            font-size: 18px;
            font-weight: 600;
            text-align: left;
            transition: color 0.3s;
        }
        
        .faq-question:hover {
            color: var(--primary);
        }

        .faq-question i {
            flex-shrink: 0;
            font-size: 14px;
            color: var(--text);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
            color: var(--primary);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0, 1, 0, 1);
        }

        .faq-answer-content {
            padding: 0 30px 30px;
        }

        .faq-answer p {
            color: var(--text);
            line-height: 1.8;
            font-size: 15px;
        }

        /* =========================================================
        ANIMATIONS
        ========================================================= */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =========================================================
        MOCK CART (Side)
        ========================================================= */
        .side-cart {
            position: fixed;
            top: 0;
            right: -400px;
            width: 380px;
            height: 100%;
            background: var(--card);
            z-index: 2000;
            box-shadow: -10px 0 40px rgba(0,0,0,0.5);
            transition: right 0.4s ease;
            display: flex;
            flex-direction: column;
            border-left: 1px solid var(--border);
        }

        .side-cart.active { right: 0; }

        .side-cart-top {
            padding: 25px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .side-cart-top h2 { font-size: 20px; color: var(--white); }
        .cart-item-count { font-size: 13px; color: var(--text); }
        .close-cart-btn { color: var(--text); font-size: 22px; transition: 0.3s; }
        .close-cart-btn:hover { color: var(--primary); }

        .side-cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }
        
        .cart-empty {
            text-align: center;
            margin-top: 60px;
            color: var(--text);
        }
        .cart-empty i { font-size: 50px; margin-bottom: 20px; opacity: 0.5; }

        .cart-bottom {
            padding: 25px;
            border-top: 1px solid var(--border);
            background: var(--card);
        }

        .cart-total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center;
        }

        .cart-total-row h3 { color: var(--white); font-size: 22px; }

        .checkout-btn {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: #fff;
            border-radius: 12px;
            font-weight: 600;
            text-align: center;
            transition: 0.3s;
        }

        .checkout-btn:hover { background: #e58936; }

        #cartOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            z-index: 1500;
            opacity: 0;
            visibility: hidden;
            transition: 0.3s;
        }

        #cartOverlay.active { opacity: 1; visibility: visible; }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: var(--card);
            border: 1px solid var(--border);
            color: var(--white);
            padding: 12px 24px;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 3000;
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .toast.show { transform: translateX(-50%) translateY(0); }
        .toast-icon { color: var(--primary); }

        /* =========================================================
        FOOTER MOCK
        ========================================================= */
        .footer {
            background: var(--card);
            padding: 60px 0 20px;
            border-top: 1px solid var(--border);
            text-align: center;
            color: var(--text);
        }

        @media (max-width: 768px) {
            .faq-page { padding-top: 110px; }
            .side-cart { width: 100%; right: -100%; }
            .faq-question { padding: 20px; font-size: 16px; }
            .faq-answer-content { padding: 0 20px 20px; }
        }
    </style>
</head>

<body>

    <!-- NAVBAR (Mocked for standalone file) -->
    <nav class="navbar">
        <a href="#" class="logo">
            <i class="fa-solid fa-utensils"></i> Hungroo
        </a>

        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#" class="active">FAQ</a>
            <a href="#">Menu</a>
            <a href="#">Contact</a>
        </div>

        <div class="nav-actions">
            <!-- Theme Toggle -->
            <div class="theme-toggle" id="themeToggle">
                <i class="fa-solid fa-moon"></i>
            </div>

            <!-- Cart Button -->
            <div class="cart-btn-wrap" id="desktopOpenCart">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-count" id="navCartCount">0</span>
            </div>

            <!-- Mobile Menu -->
            <div class="menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="faq-page">

        <!-- TOP SECTION -->
        <div class="faq-top">
            <span>Help & Support</span>
            <h1>Frequently Asked Questions</h1>
            <p>Find answers to common questions about Hungroo Café orders, reservations, delivery, and payments.</p>
        </div>

        <!-- FAQ LIST -->
        <section class="faq-list">

            <!-- ITEM 1 -->
            <div class="faq-item active">
                <button class="faq-question">
                    How can I place an order?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Browse the menu, add your favorite meals to the cart and complete checkout securely.</p>
                    </div>
                </div>
            </div>

            <!-- ITEM 2 -->
            <div class="faq-item">
                <button class="faq-question">
                    Do you offer table booking?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Yes, you can reserve premium seating directly from the booking page.</p>
                    </div>
                </div>
            </div>

            <!-- ITEM 3 -->
            <div class="faq-item">
                <button class="faq-question">
                    What payment methods are accepted?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>We accept UPI, debit cards, credit cards, net banking and cash on delivery.</p>
                    </div>
                </div>
            </div>

            <!-- ITEM 4 -->
            <div class="faq-item">
                <button class="faq-question">
                    How can I track my order?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Visit the Track Order page to see real-time order and delivery updates.</p>
                    </div>
                </div>
            </div>

             <!-- ITEM 5 -->
             <div class="faq-item">
                <button class="faq-question">
                    Is there a minimum order value?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Yes, the minimum order value for delivery is ₹149. For pickup, there is no minimum.</p>
                    </div>
                </div>
            </div>

        </section>

    </main>

    <!-- FOOTER MOCK -->
    <footer class="footer">
        <p>&copy; 2023 Hungroo Café. All rights reserved.</p>
    </footer>

    <!-- TOAST NOTIFICATION -->
    <div class="toast" id="toast">
        <div class="toast-icon"><i class="fa-solid fa-check"></i></div>
        <span>Added to cart</span>
    </div>

    <!-- CART SIDEBAR -->
    <div class="side-cart" id="slideCart">
        <div class="side-cart-top">
            <div>
                <h2>My Cart</h2>
                <span class="cart-item-count" id="sideCartCount">0 items</span>
            </div>
            <button class="close-cart-btn" id="closeCartBtn">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="side-cart-items" id="sideCartItems">
            <!-- Items injected via JS -->
        </div>
        <div class="cart-bottom">
            <div class="cart-total-row">
                <span>Total Amount</span>
                <h3 id="cartTotal">₹0</h3>
            </div>
            <a href="#" class="checkout-btn">
                Proceed to Checkout <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- OVERLAY -->
    <div id="cartOverlay"></div>

    <!-- JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            /* =========================================================
            THEME TOGGLE LOGIC
            ========================================================= */
            const themeToggle = document.getElementById('themeToggle');
            const body = document.body;
            const icon = themeToggle.querySelector('i');

            // Check local storage
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'light') {
                body.classList.add('light-mode');
                icon.classList.replace('fa-moon', 'fa-sun');
            }

            themeToggle.addEventListener('click', () => {
                body.classList.toggle('light-mode');
                const isLight = body.classList.contains('light-mode');
                
                if (isLight) {
                    icon.classList.replace('fa-moon', 'fa-sun');
                    localStorage.setItem('theme', 'light');
                } else {
                    icon.classList.replace('fa-sun', 'fa-moon');
                    localStorage.setItem('theme', 'dark');
                }
            });

            /* =========================================================
            FAQ ACCORDION LOGIC
            ========================================================= */
            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(item => {
                const button = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');

                // Set initial height for active item
                if (item.classList.contains('active')) {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                }

                button.addEventListener('click', () => {
                    const isActive = item.classList.contains('active');

                    // Close all
                    faqItems.forEach(faq => {
                        faq.classList.remove('active');
                        faq.querySelector('.faq-answer').style.maxHeight = null;
                    });

                    // Open clicked if it wasn't active
                    if (!isActive) {
                        item.classList.add('active');
                        answer.style.maxHeight = answer.scrollHeight + "px";
                    }
                });
            });

            /* =========================================================
            CART LOGIC (Simplified from Home)
            ========================================================= */
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            function saveCart() {
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
                renderCart();
            }

            function updateCartCount() {
                let total = cart.reduce((sum, item) => sum + item.quantity, 0);
                
                // Update Badge
                document.querySelectorAll('.cart-count').forEach(el => {
                    el.textContent = total;
                    el.style.display = total > 0 ? 'flex' : 'none';
                });
            }

            function renderCart() {
                const cartItemsContainer = document.getElementById('sideCartItems');
                const totalBox = document.getElementById('cartTotal');
                const sideCount = document.getElementById('sideCartCount');
                
                if (!cartItemsContainer) return;

                cartItemsContainer.innerHTML = '';
                let total = 0;

                if (cart.length === 0) {
                    cartItemsContainer.innerHTML = `
                        <div class="cart-empty">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <p>Your cart is empty</p>
                            <span>Add items to get started</span>
                        </div>`;
                    totalBox.textContent = '₹0';
                    sideCount.textContent = '0 items';
                    return;
                }

                cart.forEach((item, index) => {
                    total += item.price * item.quantity;
                    cartItemsContainer.innerHTML += `
                        <div class="cart-item" style="display:flex; gap:15px; margin-bottom:20px; padding-bottom:20px; border-bottom:1px solid var(--border);">
                            <img src="${item.image}" style="width:60px; height:60px; border-radius:8px; object-fit:cover;">
                            <div style="flex:1;">
                                <h4 style="color:var(--white); font-size:14px; margin-bottom:5px;">${item.name}</h4>
                                <div style="color:var(--primary); font-weight:600; font-size:14px;">₹${item.price}</div>
                                <div style="display:flex; align-items:center; gap:10px; margin-top:8px;">
                                    <button onclick="changeQty(${index}, -1)" style="width:24px; height:24px; background:rgba(255,255,255,0.1); color:var(--white); border-radius:4px; display:flex; align-items:center; justify-content:center;"><i class="fa-solid fa-minus" style="font-size:10px;"></i></button>
                                    <span style="color:var(--white); font-size:14px;">${item.quantity}</span>
                                    <button onclick="changeQty(${index}, 1)" style="width:24px; height:24px; background:var(--primary); color:#fff; border-radius:4px; display:flex; align-items:center; justify-content:center;"><i class="fa-solid fa-plus" style="font-size:10px;"></i></button>
                                </div>
                            </div>
                        </div>`;
                });

                totalBox.textContent = '₹' + total;
                sideCount.textContent = total + (total === 1 ? ' item' : ' items');
            }

            // Expose function to window for inline onclick
            window.changeQty = function(index, delta) {
                cart[index].quantity += delta;
                if (cart[index].quantity <= 0) {
                    cart.splice(index, 1);
                }
                saveCart();
            };

            /* =========================================================
            SLIDE CART UI
            ========================================================= */
            const slideCart = document.getElementById('slideCart');
            const overlay = document.getElementById('cartOverlay');
            const openBtn = document.getElementById('desktopOpenCart');
            const closeBtn = document.getElementById('closeCartBtn');

            function openCart() {
                slideCart.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeCart() {
                slideCart.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            if(openBtn) openBtn.addEventListener('click', openCart);
            if(closeBtn) closeBtn.addEventListener('click', closeCart);
            if(overlay) overlay.addEventListener('click', closeCart);

            /* =========================================================
            TOAST NOTIFICATION
            ========================================================= */
            function showToast(msg) {
                const toast = document.getElementById('toast');
                if(msg) toast.querySelector('span').textContent = msg;
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 2500);
            }

            // Initialize
            updateCartCount();
            renderCart();
        });
    </script>
</body>
</html>