/* =====================================================
CONFIG
===================================================== */

const DELIVERY_FEE = 40;
const GST_FEE = 20;

const STORAGE_KEY = "hungroo-cart";

/* =====================================================
CART
===================================================== */

let cart = loadCart();

/* =====================================================
LOAD CART
===================================================== */

function loadCart(){

    try{

        const savedCart =
        JSON.parse(
        localStorage.getItem(STORAGE_KEY)
        ) || [];

        return savedCart
        .filter(item =>
            item &&
            item.name &&
            Number(item.price) > 0
        )
        .map(item => ({

            name:
            String(item.name),

            price:
            Number(item.price),

            image:
            String(item.image || ""),

            quantity:
            Math.max(
            1,
            Number(item.quantity) || 1
            )

        }));

    }

    catch(error){

        console.error(
        "Cart Load Error:",
        error
        );

        return [];

    }

}

/* =====================================================
SAVE CART
===================================================== */

function saveCart(){

    localStorage.setItem(
    STORAGE_KEY,
    JSON.stringify(cart)
    );

}

/* =====================================================
OPEN CART
===================================================== */

function openCart(){

    document
    .getElementById("cartSidebar")
    ?.classList.add("active");

    document
    .getElementById("overlay")
    ?.classList.add("show");

    document.body.style.overflow =
    "hidden";

}

/* =====================================================
CLOSE CART
===================================================== */

function closeCart(){

    document
    .getElementById("cartSidebar")
    ?.classList.remove("active");

    document
    .getElementById("overlay")
    ?.classList.remove("show");

    document.body.style.overflow =
    "";

}

/* =====================================================
FIND ITEM
===================================================== */

function findCartItem(name){

    return cart.find(
    item => item.name === name
    );

}

/* =====================================================
ADD TO CART
===================================================== */

function addToCart(button){

    const name =
    button.dataset.name;

    const price =
    Number(button.dataset.price);

    const image =
    button.dataset.image;

    if(!name || !price){

        return;

    }

    const existingItem =
    findCartItem(name);

    if(existingItem){

        existingItem.quantity++;

    }

    else{

        cart.push({

            name,
            price,
            image,
            quantity:1

        });

    }

    updateCart();

    openCart();

    showToast(
    `${name} added to cart`
    );

}

/* =====================================================
INCREASE
===================================================== */

function increaseQty(index){

    if(!cart[index]) return;

    cart[index].quantity++;

    updateCart();

}

/* =====================================================
DECREASE
===================================================== */

function decreaseQty(index){

    if(!cart[index]) return;

    if(cart[index].quantity > 1){

        cart[index].quantity--;

    }

    else{

        cart.splice(index,1);

    }

    updateCart();

}

/* =====================================================
REMOVE ITEM
===================================================== */

function removeItem(index){

    if(!cart[index]) return;

    showToast(
    `${cart[index].name} removed`
    );

    cart.splice(index,1);

    updateCart();

}

/* =====================================================
PRODUCT CARD CONTROLS
===================================================== */

function updateProductQuantity(button){

    const actionBox =
    button.closest(".cart-action");

    const addButton =
    actionBox?.querySelector(".add-cart");

    if(!addButton) return;

    const itemIndex =
    cart.findIndex(
    item =>
    item.name === addButton.dataset.name
    );

    if(itemIndex === -1) return;

    if(button.classList.contains("plus")){

        cart[itemIndex].quantity++;

    }

    if(button.classList.contains("minus")){

        if(cart[itemIndex].quantity > 1){

            cart[itemIndex].quantity--;

        }

        else{

            cart.splice(itemIndex,1);

        }

    }

    updateCart();

}

/* =====================================================
TOTALS
===================================================== */

function getCartTotals(){

    const subtotal =
    cart.reduce(
    (sum,item)=>
    sum + item.price * item.quantity,
    0
    );

    const itemCount =
    cart.reduce(
    (sum,item)=>
    sum + item.quantity,
    0
    );

    const delivery =
    itemCount > 0
    ? DELIVERY_FEE
    : 0;

    const gst =
    itemCount > 0
    ? GST_FEE
    : 0;

    return {

        subtotal,
        itemCount,
        delivery,
        gst,

        grandTotal:
        subtotal + delivery + gst

    };

}

/* =====================================================
CREATE CART ITEM
===================================================== */

function createCartItem(
item,
index,
layout = "sidebar"
){

    const itemBox =
    document.createElement("div");

    itemBox.className =
    layout === "page"
    ? "cart-box"
    : "cart-item";

    itemBox.innerHTML = `

    <img
        src="${item.image}"
        alt="${item.name}"

        onerror="
        this.src='images/default-food.png'
        ">

    <div class="${
        layout === "page"
        ? "cart-details"
        : "cart-info"
    }">

        <h4>

            ${item.name}

        </h4>

        <p>

            ₹${item.price}

        </p>

        <div class="qty-box">

            <button
                type="button"

                data-cart-action="decrease"

                data-index="${index}">

                -

            </button>

            <span>

                ${item.quantity}

            </span>

            <button
                type="button"

                data-cart-action="increase"

                data-index="${index}">

                +

            </button>

        </div>

    </div>

    <button
        type="button"

        class="remove-item"

        data-cart-action="remove"

        data-index="${index}">

        <i class="fa-solid fa-trash"></i>

    </button>

    `;

    return itemBox;

}

/* =====================================================
SIDEBAR CART
===================================================== */

function renderSidebarCart(){

    const sidebarItems =
    document.getElementById("cart-items");

    if(!sidebarItems) return;

    sidebarItems.innerHTML = "";

    if(cart.length === 0){

        sidebarItems.innerHTML = `

        <div class="empty-cart">

            <i class="fa-solid fa-bag-shopping"></i>

            <h3>

                Your cart is empty

            </h3>

            <a
                href="menu.php"
                class="small-link">

                Explore Menu

            </a>

        </div>

        `;

        return;

    }

    cart.forEach((item,index)=>{

        sidebarItems.appendChild(
        createCartItem(
        item,
        index
        ));

    });

}

/* =====================================================
CART PAGE
===================================================== */

function renderCartPage(){

    const cartContainer =
    document.getElementById(
    "cart-container"
    );

    if(!cartContainer) return;

    cartContainer.innerHTML = "";

    if(cart.length === 0){

        cartContainer.innerHTML = `

        <div class="empty-cart empty-cart-page">

            <i class="fa-solid fa-cart-shopping"></i>

            <h2>

                Your cart is empty

            </h2>

            <p>

                Add your favourite meals
                from the menu.

            </p>

            <a
                href="menu.php"
                class="btn">

                Explore Menu

            </a>

        </div>

        `;

        return;

    }

    cart.forEach((item,index)=>{

        cartContainer.appendChild(
        createCartItem(
        item,
        index,
        "page"
        ));

    });

}

/* =====================================================
CHECKOUT LIST
===================================================== */

function renderCheckoutList(){

    const checkoutItems =
    document.getElementById(
    "checkout-items"
    );

    if(!checkoutItems) return;

    checkoutItems.innerHTML = "";

    if(cart.length === 0){

        checkoutItems.innerHTML =

        '<p class="muted-text">No items selected.</p>';

        return;

    }

    cart.forEach(item=>{

        checkoutItems.innerHTML += `

        <div class="checkout-item">

            <span>

                ${item.name} x ${item.quantity}

            </span>

            <strong>

                ₹${item.price * item.quantity}

            </strong>

        </div>

        `;

    });

}

/* =====================================================
SYNC PRODUCT CONTROLS
===================================================== */

function syncProductControls(){

    document
    .querySelectorAll(".cart-action")
    .forEach(actionBox=>{

        const addButton =
        actionBox.querySelector(".add-cart");

        const quantityWrap =
        actionBox.querySelector(".qty-wrap");

        const quantityNumber =
        actionBox.querySelector(".qty-number");

        if(
            !addButton ||
            !quantityWrap ||
            !quantityNumber
        ){

            return;

        }

        const item =
        findCartItem(
        addButton.dataset.name
        );

        if(item){

            addButton.classList.add(
            "hidden"
            );

            quantityWrap.classList.remove(
            "hidden"
            );

            quantityNumber.textContent =
            item.quantity;

        }

        else{

            addButton.classList.remove(
            "hidden"
            );

            quantityWrap.classList.add(
            "hidden"
            );

            quantityNumber.textContent =
            "1";

        }

    });

}

/* =====================================================
UPDATE TOTALS
===================================================== */

function updateTotals(){

    const totals =
    getCartTotals();

    document
    .querySelectorAll("#cart-count")
    .forEach(el=>{

        el.textContent =
        totals.itemCount;

    });

    setText(
    "cart-total",
    totals.grandTotal
    );

    setText(
    "sidebar-subtotal",
    totals.subtotal
    );

    setText(
    "sidebar-delivery",
    totals.delivery
    );

    setText(
    "sidebar-gst",
    totals.gst
    );

    setText(
    "total-items",
    totals.itemCount
    );

    setText(
    "subtotal",
    totals.subtotal
    );

    setText(
    "delivery-fee",
    totals.delivery
    );

    setText(
    "gst-fee",
    totals.gst
    );

    setText(
    "grand-total",
    totals.grandTotal
    );

}

/* =====================================================
SET TEXT
===================================================== */

function setText(id,value){

    const element =
    document.getElementById(id);

    if(element){

        element.textContent =
        value;

    }

}

/* =====================================================
UPDATE CART
===================================================== */

function updateCart(){

    saveCart();

    renderSidebarCart();

    renderCartPage();

    renderCheckoutList();

    syncProductControls();

    updateTotals();

}

/* =====================================================
CHECKOUT
===================================================== */

function handleCheckoutSubmit(event){

    const form =
    event.target;

    if(form.id !== "checkoutForm"){

        return;

    }

    event.preventDefault();

    const message =
    document.getElementById(
    "order-message"
    );

    if(cart.length === 0){

        if(message){

            message.textContent =
            "Please add at least one item.";

            message.className =
            "form-message error";

        }

        return;

    }

    const orderId =
    `HG${Date.now()
    .toString()
    .slice(-6)}`;

    cart = [];

    saveCart();

    updateCart();

    form.reset();

    if(message){

        message.textContent =
        `Order placed successfully. Order ID: ${orderId}`;

        message.className =
        "form-message success";

    }

}

/* =====================================================
TOAST
===================================================== */

function showToast(message){

    const toast =
    document.createElement("div");

    toast.className =
    "cart-toast";

    toast.textContent =
    message;

    document.body.appendChild(toast);

    setTimeout(()=>{

        toast.classList.add(
        "show"
        );

    },50);

    setTimeout(()=>{

        toast.classList.remove(
        "show"
        );

        setTimeout(()=>{

            toast.remove();

        },300);

    },2500);

}

/* =====================================================
EVENTS
===================================================== */

document.addEventListener(
"click",
(event)=>{

    const addButton =
    event.target.closest(".add-cart");

    const openButton =
    event.target.closest("[data-open-cart]");

    const closeButton =
    event.target.closest("[data-close-cart]");

    const actionButton =
    event.target.closest("[data-cart-action]");

    const productQtyButton =
    event.target.closest(".qty-btn");

    if(addButton){

        addToCart(addButton);

        return;

    }

    if(productQtyButton){

        updateProductQuantity(
        productQtyButton
        );

        return;

    }

    if(openButton){

        openCart();

        return;

    }

    if(closeButton){

        closeCart();

        return;

    }

    if(actionButton){

        const index =
        Number(
        actionButton.dataset.index
        );

        const action =
        actionButton.dataset.cartAction;

        if(action === "increase"){

            increaseQty(index);

        }

        if(action === "decrease"){

            decreaseQty(index);

        }

        if(action === "remove"){

            removeItem(index);

        }

    }

});

/* =====================================================
SUBMIT
===================================================== */

document.addEventListener(
"submit",
handleCheckoutSubmit
);

/* =====================================================
LOAD
===================================================== */

document.addEventListener(
"DOMContentLoaded",
updateCart
);

/* =====================================================
WINDOW
===================================================== */

window.openCart = openCart;
window.closeCart = closeCart;
window.increaseQty = increaseQty;
window.decreaseQty = decreaseQty;
window.removeItem = removeItem;