/* =========================================================
CART SYSTEM
========================================================= */

let cart =

JSON.parse(
localStorage.getItem("cart")
) || [];

/* =========================================================
SAVE CART
========================================================= */

function saveCart(){

    localStorage.setItem(

        "cart",

        JSON.stringify(cart)

    );

}

/* =========================================================
UPDATE NAVBAR COUNT
========================================================= */

function updateCartCount(){

    const countElement =

    document.querySelector(
    ".cart-count"
    );

    if(!countElement) return;

    let total = 0;

    cart.forEach(item=>{

        total += item.quantity;

    });

    countElement.innerText =
    total;

}

/* =========================================================
OPEN MINI CART
========================================================= */

function openMiniCart(){

    const miniCart =

    document.getElementById(
    "miniCart"
    );

    const overlay =

    document.getElementById(
    "miniCartOverlay"
    );

    if(miniCart){

        miniCart.classList.add(
        "active"
        );

    }

    if(overlay){

        overlay.classList.add(
        "active"
        );

    }

}

/* =========================================================
CLOSE MINI CART
========================================================= */

function closeMiniCart(){

    const miniCart =

    document.getElementById(
    "miniCart"
    );

    const overlay =

    document.getElementById(
    "miniCartOverlay"
    );

    if(miniCart){

        miniCart.classList.remove(
        "active"
        );

    }

    if(overlay){

        overlay.classList.remove(
        "active"
        );

    }

}

/* =========================================================
ADD TO CART
========================================================= */

function addToCart(product){

    const existing =

    cart.find(item=>{

        return item.id == product.id;

    });

    if(existing){

        existing.quantity++;

    }

    else{

        cart.push({

            id:product.id,

            name:product.name,

            price:Number(product.price),

            image:product.image,

            quantity:1

        });

    }

    saveCart();

    updateCartCount();

    renderMiniCart();

    renderCardControllers();

    openMiniCart();

}

/* =========================================================
UPDATE QUANTITY
========================================================= */

function updateQuantity(id,type){

    cart = cart.map(item=>{

        if(item.id == id){

            if(type === "plus"){

                item.quantity++;

            }

            else{

                item.quantity--;

                if(item.quantity < 1){

                    item.quantity = 1;

                }

            }

        }

        return item;

    });

    saveCart();

    updateCartCount();

    renderMiniCart();

    renderCardControllers();

}

/* =========================================================
REMOVE ITEM
========================================================= */

function removeFromCart(id){

    cart = cart.filter(item=>{

        return item.id != id;

    });

    saveCart();

    updateCartCount();

    renderMiniCart();

    renderCardControllers();

}

/* =========================================================
RENDER MINI CART
========================================================= */

function renderMiniCart(){

    const miniCartItems =

    document.getElementById(
    "miniCartItems"
    );

    const totalElement =

    document.getElementById(
    "miniCartTotal"
    );

    if(!miniCartItems) return;

    /* =====================
    EMPTY
    ===================== */

    if(cart.length === 0){

        miniCartItems.innerHTML = `

            <div class="empty-cart">

                <img
                src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png">

                <h3>

                    Cart Empty

                </h3>

                <p>

                    Add delicious food now

                </p>

            </div>

        `;

        totalElement.innerText =
        "₹0";

        return;

    }

    /* =====================
    ITEMS
    ===================== */

    let html = "";

    let total = 0;

    cart.forEach(item=>{

        const itemTotal =

        item.price * item.quantity;

        total += itemTotal;

        html += `

            <div class="mini-cart-item">

                <img
                src="${item.image}"

                alt="${item.name}">

                <div class="mini-cart-content">

                    <h4>

                        ${item.name}

                    </h4>

                    <p>

                        ₹${item.price}

                    </p>

                    <div class="mini-cart-qty">

                        <button
                        onclick="updateQuantity(${item.id},'minus')">

                            -

                        </button>

                        <span>

                            ${item.quantity}

                        </span>

                        <button
                        onclick="updateQuantity(${item.id},'plus')">

                            +

                        </button>

                        <button
                        onclick="removeFromCart(${item.id})"

                        style="margin-left:8px;">

                            <i class="fa-solid fa-trash"></i>

                        </button>

                    </div>

                </div>

            </div>

        `;

    });

    miniCartItems.innerHTML =
    html;

    totalElement.innerText =
    `₹${total}`;

}

/* =========================================================
CARD CONTROLLER
========================================================= */

function renderCardControllers(){

    if(

        typeof featuredItemsData ===
        "undefined"

    ){

        return;

    }

    featuredItemsData.forEach(product=>{

        const actionBox =

        document.getElementById(
        `action-${product.id}`
        );

        if(!actionBox) return;

        const existing =

        cart.find(item=>{

            return item.id == product.id;

        });

        /* =====================
        EXISTS
        ===================== */

        if(existing){

            actionBox.innerHTML = `

                <div class="qty-controller">

                    <button
                    onclick="updateQuantity(${product.id},'minus')">

                        -

                    </button>

                    <span>

                        ${existing.quantity}

                    </span>

                    <button
                    onclick="updateQuantity(${product.id},'plus')">

                        +

                    </button>

                </div>

            `;

        }

        /* =====================
        BUTTON
        ===================== */

        else{

            actionBox.innerHTML = `

                <button
                type="button"

                class="menu-btn"

                onclick="addToCart({

                    id:${product.id},

                    name:${JSON.stringify(product.name)},

                    price:${product.price},

                    image:${JSON.stringify(product.image)}

                })">

                    Add To Cart

                </button>

            `;

        }

    });

}

/* =========================================================
INIT
========================================================= */

document.addEventListener(

    "DOMContentLoaded",

    ()=>{

        updateCartCount();

        renderMiniCart();

        renderCardControllers();

        /* =====================
        OPEN BTN
        ===================== */

        const cartButton =

        document.getElementById(
        "cartButton"
        );

        if(cartButton){

            cartButton.addEventListener(

                "click",

                ()=>{

                    openMiniCart();

                }

            );

        }

        /* =====================
        CLOSE BTN
        ===================== */

        const closeBtn =

        document.getElementById(
        "closeMiniCart"
        );

        if(closeBtn){

            closeBtn.addEventListener(

                "click",

                ()=>{

                    closeMiniCart();

                }

            );

        }

        /* =====================
        OVERLAY
        ===================== */

        const overlay =

        document.getElementById(
        "miniCartOverlay"
        );

        if(overlay){

            overlay.addEventListener(

                "click",

                ()=>{

                    closeMiniCart();

                }

            );

        }

    }

);