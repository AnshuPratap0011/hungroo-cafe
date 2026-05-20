/* =========================================================
HUNGROO CAFÉ ADVANCED CART SYSTEM
========================================================= */

/* =========================================================
LOCAL STORAGE KEY
========================================================= */

const CART_STORAGE_KEY =
"hungroo-cart";

/* =========================================================
GET CART
========================================================= */

let cart =
JSON.parse(
localStorage.getItem(
CART_STORAGE_KEY
)
) || [];

/* =========================================================
SAVE CART
========================================================= */

function saveCart(){

    localStorage.setItem(

        CART_STORAGE_KEY,

        JSON.stringify(cart)

    );

    updateCartCount();

}

/* =========================================================
FORMAT PRICE
========================================================= */

function formatPrice(price){

    return "₹" + Number(price);

}

/* =========================================================
PARSE PRICE
========================================================= */

function parsePrice(price){

    if(typeof price === "number"){

        return price;

    }

    return Number(

        String(price)
        .replace("₹","")
        .replace(/,/g,"")

    );

}

/* =========================================================
UPDATE CART COUNT
========================================================= */

function updateCartCount(){

    const cartCounts =

    document.querySelectorAll(
    ".cart-count"
    );

    let totalQuantity = 0;

    cart.forEach(item=>{

        totalQuantity += item.quantity;

    });

    cartCounts.forEach(count=>{

        count.textContent =
        totalQuantity;

    });

}

/* =========================================================
ADD TO CART
========================================================= */

function addToCart(

    name,
    price,
    image

){

    const existingItem =

    cart.find(item=>

        item.name === name

    );

    if(existingItem){

        existingItem.quantity += 1;

    }

    else{

        cart.push({

            name:name,

            price:parsePrice(price),

            image:image,

            quantity:1

        });

    }

    saveCart();

    renderCart();

    showToast(

        name + " added to cart"

    );

}

/* =========================================================
REMOVE ITEM
========================================================= */

function removeCartItem(index){

    if(index < 0 || index >= cart.length){

        return;

    }

    const removedItem =

    cart[index].name;

    cart.splice(index,1);

    saveCart();

    renderCart();

    showToast(

        removedItem + " removed"

    );

}

/* =========================================================
CLEAR CART
========================================================= */

function clearCart(){

    cart = [];

    saveCart();

    renderCart();

    showToast(

        "Cart cleared"

    );

}

/* =========================================================
CHANGE QUANTITY
========================================================= */

function changeQuantity(

    index,
    action

){

    if(!cart[index]){

        return;

    }

    if(action === "increase"){

        cart[index].quantity += 1;

    }

    else if(action === "decrease"){

        cart[index].quantity -= 1;

        if(cart[index].quantity <= 0){

            removeCartItem(index);

            return;

        }

    }

    saveCart();

    renderCart();

}

/* =========================================================
GET TOTAL
========================================================= */

function getCartTotal(){

    let total = 0;

    cart.forEach(item=>{

        total +=

        item.price *
        item.quantity;

    });

    return total;

}

/* =========================================================
RENDER CART
========================================================= */

function renderCart(){

    const cartContainer =

    document.querySelector(
    ".cart-items"
    );

    const totalPrice =

    document.querySelector(
    ".cart-total-price"
    );

    const subtotalPrice =

    document.querySelector(
    ".cart-subtotal-price"
    );

    const deliveryPrice =

    document.querySelector(
    ".delivery-price"
    );

    if(!cartContainer){

        return;

    }

    cartContainer.innerHTML = "";

    /* =====================================================
    EMPTY CART
    ===================================================== */

    if(cart.length === 0){

        cartContainer.innerHTML =

        `
        <div class="empty-cart">

            <div class="empty-cart-icon">

                <i class="fa-solid fa-cart-shopping"></i>

            </div>

            <h2>

                Your cart is empty

            </h2>

            <p>

                Add premium burgers,
                coffee and desserts.

            </p>

        </div>
        `;

        if(totalPrice){

            totalPrice.textContent =
            "₹0";

        }

        if(subtotalPrice){

            subtotalPrice.textContent =
            "₹0";

        }

        if(deliveryPrice){

            deliveryPrice.textContent =
            "₹0";

        }

        return;

    }

    /* =====================================================
    LOOP ITEMS
    ===================================================== */

    cart.forEach((item,index)=>{

        const itemTotal =

        item.price *
        item.quantity;

        cartContainer.innerHTML +=

        `
        <div class="cart-card">

            <!-- LEFT -->

            <div class="cart-left">

                <div class="cart-image">

                    <img
                    src="${item.image}"
                    alt="${item.name}">

                </div>

                <div class="cart-info">

                    <h2>

                        ${item.name}

                    </h2>

                    <p class="cart-item-price">

                        ${formatPrice(item.price)}

                    </p>

                    <div class="cart-quantity">

                        <button
                        onclick=
                        "changeQuantity(${index},'decrease')">

                            <i class="fa-solid fa-minus"></i>

                        </button>

                        <span>

                            ${item.quantity}

                        </span>

                        <button
                        onclick=
                        "changeQuantity(${index},'increase')">

                            <i class="fa-solid fa-plus"></i>

                        </button>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="cart-right">

                <h3>

                    ${formatPrice(itemTotal)}

                </h3>

                <button
                class="remove-cart-btn"

                onclick=
                "removeCartItem(${index})">

                    <i class="fa-solid fa-trash"></i>

                </button>

            </div>

        </div>
        `;

    });

    /* =====================================================
    TOTAL
    ===================================================== */

    const subtotal =

    getCartTotal();

    const delivery =

    subtotal > 499
    ?
    0
    :
    49;

    const finalTotal =

    subtotal + delivery;

    if(subtotalPrice){

        subtotalPrice.textContent =

        formatPrice(subtotal);

    }

    if(deliveryPrice){

        deliveryPrice.textContent =

        delivery === 0
        ?
        "FREE"
        :
        formatPrice(delivery);

    }

    if(totalPrice){

        totalPrice.textContent =

        formatPrice(finalTotal);

    }

}

/* =========================================================
TOAST
========================================================= */

function showToast(message){

    let toast =

    document.querySelector(
    ".cart-toast"
    );

    if(!toast){

        toast =

        document.createElement(
        "div"
        );

        toast.className =
        "cart-toast";

        document.body.appendChild(
        toast
        );

    }

    toast.innerHTML =

    `
    <i class="fa-solid fa-circle-check"></i>
    ${message}
    `;

    toast.classList.add(
    "show-toast"
    );

    setTimeout(()=>{

        toast.classList.remove(
        "show-toast"
        );

    },2500);

}

/* =========================================================
BUY NOW
========================================================= */

function buyNow(

    name,
    price,
    image

){

    addToCart(

        name,
        price,
        image

    );

    window.location.href =
    "cart.php";

}

/* =========================================================
CHECKOUT
========================================================= */

function proceedCheckout(){

    if(cart.length === 0){

        showToast(

            "Your cart is empty"

        );

        return;

    }

    window.location.href =
    "checkout.php";

}

/* =========================================================
INIT
========================================================= */

document.addEventListener(

    "DOMContentLoaded",

    ()=>{

        updateCartCount();

        renderCart();

    }

);

/* =========================================================
GLOBAL FUNCTIONS
========================================================= */

window.addToCart =
addToCart;

window.removeCartItem =
removeCartItem;

window.changeQuantity =
changeQuantity;

window.clearCart =
clearCart;

window.buyNow =
buyNow;

window.proceedCheckout =
proceedCheckout;