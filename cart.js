/* =========================================================
HUNGROO PREMIUM CART SYSTEM
========================================================= */

const HungrooCart = (() => {

/* =========================================================
STORAGE KEY
========================================================= */

const STORAGE_KEY =
"hungroo-cart";

/* =========================================================
STATE
========================================================= */

let cart =
JSON.parse(
localStorage.getItem(STORAGE_KEY)
) || [];

/* =========================================================
SAVE CART
========================================================= */

function saveCart(){

    localStorage.setItem(
        STORAGE_KEY,
        JSON.stringify(cart)
    );

}

/* =========================================================
GET TOTAL COUNT
========================================================= */

function getTotalCount(){

    return cart.reduce(
        (total,item)=>
        total + item.qty,
        0
    );

}

/* =========================================================
GET SUBTOTAL
========================================================= */

function getSubtotal(){

    return cart.reduce(
        (total,item)=>
        total + (item.price * item.qty),
        0
    );

}

/* =========================================================
DELIVERY
========================================================= */

function getDelivery(subtotal){

    return subtotal >= 299
    ? 0
    : 49;

}

/* =========================================================
GST
========================================================= */

function getGST(subtotal){

    return Math.round(
        subtotal * 0.05
    );

}

/* =========================================================
TOTAL
========================================================= */

function getTotal(){

    const subtotal =
    getSubtotal();

    return (
        subtotal +
        getDelivery(subtotal) +
        getGST(subtotal)
    );

}

/* =========================================================
UPDATE NAVBAR COUNT
========================================================= */

function updateNavbarCount(){

    const countEl =
    document.getElementById(
    "cart-count"
    );

    if(countEl){

        countEl.textContent =
        getTotalCount();

    }

}

/* =========================================================
TOAST
========================================================= */

function showToast(message){

    let toast =
    document.querySelector(
    ".hungroo-toast"
    );

    if(!toast){

        toast =
        document.createElement("div");

        toast.className =
        "hungroo-toast";

        document.body.appendChild(
        toast
        );

    }

    toast.textContent =
    message;

    toast.classList.add(
    "show"
    );

    clearTimeout(
    toast.hideTimeout
    );

    toast.hideTimeout =
    setTimeout(()=>{

        toast.classList.remove(
        "show"
        );

    },2200);

}

/* =========================================================
ADD ITEM
========================================================= */

function addItem(item){

    const existing =
    cart.find(
        product =>
        product.name === item.name
    );

    if(existing){

        existing.qty++;

    }

    else{

        cart.push({

            name:item.name,

            price:Number(item.price),

            image:item.image,

            qty:1

        });

    }

    saveCart();

    renderEverything();

    showToast(
    `${item.name} added to cart`
    );

}

/* =========================================================
INCREASE
========================================================= */

function increaseQty(name){

    const item =
    cart.find(
    product =>
    product.name === name
    );

    if(item){

        item.qty++;

        saveCart();

        renderEverything();

    }

}

/* =========================================================
DECREASE
========================================================= */

function decreaseQty(name){

    const item =
    cart.find(
    product =>
    product.name === name
    );

    if(!item) return;

    item.qty--;

    if(item.qty <= 0){

        cart =
        cart.filter(
        product =>
        product.name !== name
        );

    }

    saveCart();

    renderEverything();

}

/* =========================================================
REMOVE
========================================================= */

function removeItem(name){

    cart =
    cart.filter(
    product =>
    product.name !== name
    );

    saveCart();

    renderEverything();

    showToast(
    "Item removed"
    );

}

/* =========================================================
RENDER SIDEBAR CART
========================================================= */

function renderSidebarCart(){

    const container =
    document.getElementById(
    "cart-items"
    );

    if(!container) return;

    container.innerHTML = "";

    if(cart.length === 0){

        container.innerHTML = `

        <div class="mini-cart-empty">

            <i class="fa-solid fa-cart-shopping"></i>

            <h3>Your cart is empty</h3>

            <p>Add delicious meals now.</p>

        </div>

        `;

    }

    else{

        cart.forEach(item=>{

            container.innerHTML += `

            <div class="mini-cart-item">

                <img
                src="${item.image}"
                alt="${item.name}">

                <div class="mini-cart-info">

                    <h4>

                        ${item.name}

                    </h4>

                    <p>

                        ₹${item.price}

                    </p>

                    <div class="mini-qty">

                        <button
                        onclick="HungrooCart.decreaseQty('${item.name}')">

                            -

                        </button>

                        <span>

                            ${item.qty}

                        </span>

                        <button
                        onclick="HungrooCart.increaseQty('${item.name}')">

                            +

                        </button>

                    </div>

                </div>

            </div>

            `;

        });

    }

    updateSidebarTotals();

}

/* =========================================================
UPDATE SIDEBAR TOTALS
========================================================= */

function updateSidebarTotals(){

    const subtotal =
    getSubtotal();

    const delivery =
    getDelivery(subtotal);

    const gst =
    getGST(subtotal);

    const total =
    getTotal();

    const subtotalEl =
    document.getElementById(
    "sidebar-subtotal"
    );

    const deliveryEl =
    document.getElementById(
    "sidebar-delivery"
    );

    const gstEl =
    document.getElementById(
    "sidebar-gst"
    );

    const totalEl =
    document.getElementById(
    "cart-total"
    );

    if(subtotalEl)
    subtotalEl.textContent =
    subtotal;

    if(deliveryEl)
    deliveryEl.textContent =
    delivery;

    if(gstEl)
    gstEl.textContent =
    gst;

    if(totalEl)
    totalEl.textContent =
    total;

}

/* =========================================================
RENDER MENU/HOME BUTTONS
========================================================= */

function renderButtons(){

    document
    .querySelectorAll(".cart-action,.menu-cart-box")
    .forEach(box=>{

        const name =
        box.dataset.name;

        const existing =
        cart.find(
        item =>
        item.name === name
        );

        /* =====================================================
        EXISTS
        ===================================================== */

        if(existing){

            box.innerHTML = `

            <div class="qty-wrap active">

                <button
                class="qty-btn minus">

                    -

                </button>

                <span class="qty-number">

                    ${existing.qty}

                </span>

                <button
                class="qty-btn plus">

                    +

                </button>

            </div>

            `;

            /* PLUS */

            box
            .querySelector(".plus")
            ?.addEventListener(
            "click",
            ()=>{

                increaseQty(name);

            });

            /* MINUS */

            box
            .querySelector(".minus")
            ?.addEventListener(
            "click",
            ()=>{

                decreaseQty(name);

            });

        }

        /* =====================================================
        ADD BUTTON
        ===================================================== */

        else{

            box.innerHTML = `

            <button class="add-cart-btn">

                <i class="fa-solid fa-cart-shopping"></i>

                Add To Cart

            </button>

            `;

            box
            .querySelector(".add-cart-btn")
            ?.addEventListener(
            "click",
            ()=>{

                addItem({

                    name:
                    box.dataset.name,

                    price:
                    box.dataset.price,

                    image:
                    box.dataset.image

                });

            });

        }

    });

}

/* =========================================================
RENDER CART PAGE
========================================================= */

function renderCartPage(){

    const container =
    document.getElementById(
    "cart-page-items"
    );

    if(!container) return;

    const empty =
    document.getElementById(
    "empty-cart"
    );

    const countEl =
    document.getElementById(
    "cart-page-count"
    );

    if(countEl){

        countEl.textContent =
        getTotalCount();

    }

    container.innerHTML = "";

    if(cart.length === 0){

        empty?.classList.remove(
        "hidden"
        );

        return;

    }

    empty?.classList.add(
    "hidden"
    );

    cart.forEach(item=>{

        container.innerHTML += `

        <article class="cart-item">

            <img
            src="${item.image}"
            alt="${item.name}">

            <div class="cart-item-info">

                <h3>

                    ${item.name}

                </h3>

                <p>

                    Premium Hungroo Café Meal

                </p>

                <div class="cart-price">

                    ₹${item.price}

                </div>

            </div>

            <div class="cart-actions">

                <div class="qty-box">

                    <button
                    onclick="HungrooCart.decreaseQty('${item.name}')">

                        -

                    </button>

                    <span>

                        ${item.qty}

                    </span>

                    <button
                    onclick="HungrooCart.increaseQty('${item.name}')">

                        +

                    </button>

                </div>

                <button
                class="remove-btn"

                onclick="HungrooCart.removeItem('${item.name}')">

                    Remove

                </button>

            </div>

        </article>

        `;

    });

    updateCartPageTotals();

}

/* =========================================================
CART PAGE TOTALS
========================================================= */

function updateCartPageTotals(){

    const subtotal =
    getSubtotal();

    const delivery =
    getDelivery(subtotal);

    const gst =
    getGST(subtotal);

    const total =
    getTotal();

    const subtotalEl =
    document.getElementById(
    "cart-subtotal"
    );

    const deliveryEl =
    document.getElementById(
    "cart-delivery"
    );

    const gstEl =
    document.getElementById(
    "cart-gst"
    );

    const totalEl =
    document.getElementById(
    "cart-total-page"
    );

    if(subtotalEl)
    subtotalEl.textContent =
    subtotal;

    if(deliveryEl)
    deliveryEl.textContent =
    delivery;

    if(gstEl)
    gstEl.textContent =
    gst;

    if(totalEl)
    totalEl.textContent =
    total;

}

/* =========================================================
CHECKOUT PAGE
========================================================= */

function renderCheckoutPage(){

    const container =
    document.getElementById(
    "checkout-items"
    );

    if(!container) return;

    container.innerHTML = "";

    cart.forEach(item=>{

        container.innerHTML += `

        <div class="checkout-item">

            <div>

                <h4>

                    ${item.name}

                </h4>

                <p>

                    Qty ${item.qty}

                </p>

            </div>

            <h4>

                ₹${item.price * item.qty}

            </h4>

        </div>

        `;

    });

    const subtotal =
    getSubtotal();

    const delivery =
    getDelivery(subtotal);

    const gst =
    getGST(subtotal);

    const total =
    getTotal();

    const subtotalEl =
    document.getElementById(
    "checkout-subtotal"
    );

    const deliveryEl =
    document.getElementById(
    "checkout-delivery"
    );

    const gstEl =
    document.getElementById(
    "checkout-gst"
    );

    const totalEl =
    document.getElementById(
    "checkout-total"
    );

    if(subtotalEl)
    subtotalEl.textContent =
    subtotal;

    if(deliveryEl)
    deliveryEl.textContent =
    delivery;

    if(gstEl)
    gstEl.textContent =
    gst;

    if(totalEl)
    totalEl.textContent =
    total;

}

/* =========================================================
GLOBAL RENDER
========================================================= */

function renderEverything(){

    updateNavbarCount();

    renderSidebarCart();

    renderButtons();

    renderCartPage();

    renderCheckoutPage();

}

/* =========================================================
INIT
========================================================= */

document.addEventListener(
"DOMContentLoaded",
()=>{

    renderEverything();

});

/* =========================================================
PUBLIC API
========================================================= */

return{

    addItem,
    increaseQty,
    decreaseQty,
    removeItem,
    renderEverything

};

})();