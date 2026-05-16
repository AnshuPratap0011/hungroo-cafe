<header class="navbar">

    <!-- =====================================================
    LEFT
    ===================================================== -->

    <div class="nav-left">

        <!-- MOBILE TOGGLE -->

        <button
            class="menu-toggle"
            id="menuToggle"
            type="button"
            aria-label="Open Menu">

            <i class="fa-solid fa-bars"></i>

        </button>

        <!-- LOGO -->

        <a
            href="home.php"
            class="logo">

            <img
                src="hlogo.png"
                alt="Hungroo Cafe">

        </a>

    </div>

    <!-- =====================================================
    NAVIGATION
    ===================================================== -->

    <nav
        class="nav"
        id="mobileNav">

        <a href="home.php">

            Home

        </a>

        <a href="menu.php">

            Menu

        </a>


        <a href="home.php#signature">

            Signature

        </a>

        <a href="home.php#reviews">

            Reviews

        </a>

        <a href="#footer">

            Contact

        </a>

    </nav>

    <!-- =====================================================
    RIGHT
    ===================================================== -->

    <div class="nav-icons">

        <!-- CART -->

        <button
            class="cart-icon"
            id="openCartBtn"
            type="button"
            aria-label="Open Cart">

            <i class="fa-solid fa-cart-shopping"></i>

            <span id="cart-count">

                0

            </span>

        </button>

        <!-- PROFILE -->

        <a
            href="#"
            class="profile-icon"
            aria-label="Profile">

            <i class="fa-solid fa-user"></i>

        </a>

    </div>

</header>

<!-- =====================================================
MOBILE OVERLAY
===================================================== -->

<div
    class="mobile-overlay"
    id="mobileOverlay">

</div>

<!-- =====================================================
MINI CART OVERLAY
===================================================== -->

<div
    class="mini-cart-overlay"
    id="miniCartOverlay">

</div>

<!-- =====================================================
MINI CART SIDEBAR
===================================================== -->

<aside
    class="mini-cart-sidebar"
    id="miniCartSidebar">

    <!-- TOP -->

    <div class="mini-cart-top">

        <h2>

            Your Cart

        </h2>

        <button
            id="closeCartBtn"
            type="button"
            aria-label="Close Cart">

            <i class="fa-solid fa-xmark"></i>

        </button>

    </div>

    <!-- ITEMS -->

    <div
        class="mini-cart-items"
        id="miniCartItems">

    </div>

    <!-- FOOTER -->

    <div class="mini-cart-footer">

        <div class="mini-cart-total-row">

            <h3>

                Total

            </h3>

            <h2>

                ₹<span id="miniCartTotal">

                    0

                </span>

            </h2>

        </div>

        <a
            href="cart.php"
            class="mini-cart-btn">

            Proceed To Cart

        </a>

    </div>

</aside>

<!-- =====================================================
JAVASCRIPT
===================================================== -->

<script>

/* =====================================================
MOBILE NAV
===================================================== */

const menuToggle =
document.getElementById(
"menuToggle"
);

const mobileNav =
document.getElementById(
"mobileNav"
);

const mobileOverlay =
document.getElementById(
"mobileOverlay"
);

/* TOGGLE */

menuToggle.onclick = () => {

    mobileNav.classList.toggle(
    "active"
    );

    mobileOverlay.classList.toggle(
    "active"
    );

};

/* CLOSE */

mobileOverlay.onclick = () => {

    mobileNav.classList.remove(
    "active"
    );

    mobileOverlay.classList.remove(
    "active"
    );

};

/* AUTO CLOSE */

document
.querySelectorAll(".nav a")
.forEach(link => {

    link.onclick = () => {

        mobileNav.classList.remove(
        "active"
        );

        mobileOverlay.classList.remove(
        "active"
        );

    };

});

/* =====================================================
CART DATA
===================================================== */

let miniCart =
JSON.parse(
localStorage.getItem(
"hungroo-cart"
)
) || [];

/* ELEMENTS */

const cartCount =
document.getElementById(
"cart-count"
);

const miniCartItems =
document.getElementById(
"miniCartItems"
);

const miniCartTotal =
document.getElementById(
"miniCartTotal"
);

const openCartBtn =
document.getElementById(
"openCartBtn"
);

const closeCartBtn =
document.getElementById(
"closeCartBtn"
);

const miniCartSidebar =
document.getElementById(
"miniCartSidebar"
);

const miniCartOverlay =
document.getElementById(
"miniCartOverlay"
);

/* =====================================================
SAVE CART
===================================================== */

function saveMiniCart(){

    localStorage.setItem(
        "hungroo-cart",
        JSON.stringify(miniCart)
    );

}

/* =====================================================
UPDATE COUNT
===================================================== */

function updateMiniCartCount(){

    let total = 0;

    miniCart.forEach(item => {

        total += item.qty;

    });

    cartCount.textContent = total;

}

/* =====================================================
RENDER CART
===================================================== */

function renderMiniCart(){

    miniCartItems.innerHTML = "";

    let totalPrice = 0;

    /* EMPTY */

    if(miniCart.length === 0){

        miniCartItems.innerHTML = `

        <div class="mini-cart-empty">

            <i class="fa-solid fa-cart-shopping"></i>

            <h3>

                Your Cart Is Empty

            </h3>

            <p>

                Add delicious items to continue.

            </p>

        </div>

        `;

        miniCartTotal.textContent = "0";

        return;

    }

    /* LOOP */

    miniCart.forEach((item,index)=>{

        totalPrice +=
        item.price * item.qty;

        miniCartItems.innerHTML += `

        <div class="mini-cart-card">

            <!-- IMAGE -->

            <div class="mini-cart-image">

                <img
                    src="${item.image}"
                    alt="${item.name}">

            </div>

            <!-- CONTENT -->

            <div class="mini-cart-content">

                <h4>

                    ${item.name}

                </h4>

                <span>

                    ₹${item.price}

                </span>

                <!-- QTY -->

                <div class="mini-cart-qty">

                    <button
                        onclick="decreaseMiniQty(${index})">

                        -

                    </button>

                    <p>

                        ${item.qty}

                    </p>

                    <button
                        onclick="increaseMiniQty(${index})">

                        +

                    </button>

                </div>

            </div>

        </div>

        `;

    });

    miniCartTotal.textContent =
    totalPrice;

}

/* =====================================================
INCREASE
===================================================== */

function increaseMiniQty(index){

    miniCart[index].qty++;

    saveMiniCart();

    renderMiniCart();

    updateMiniCartCount();

}

/* =====================================================
DECREASE
===================================================== */

function decreaseMiniQty(index){

    miniCart[index].qty--;

    if(miniCart[index].qty <= 0){

        miniCart.splice(index,1);

    }

    saveMiniCart();

    renderMiniCart();

    updateMiniCartCount();

}

/* =====================================================
OPEN CART
===================================================== */

openCartBtn.onclick = () => {

    miniCartSidebar.classList.add(
    "active"
    );

    miniCartOverlay.classList.add(
    "active"
    );

};

/* =====================================================
CLOSE CART
===================================================== */

function closeMiniCart(){

    miniCartSidebar.classList.remove(
    "active"
    );

    miniCartOverlay.classList.remove(
    "active"
    );

}

closeCartBtn.onclick =
closeMiniCart;

miniCartOverlay.onclick =
closeMiniCart;

/* =====================================================
INIT
===================================================== */

updateMiniCartCount();

renderMiniCart();

</script>