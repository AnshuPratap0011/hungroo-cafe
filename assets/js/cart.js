/* =========================================================
cart.js
CREATE:
assets/js/cart.js
========================================================= */

/* =========================================================
GET CART
========================================================= */

function getCart(){

    return JSON.parse(
    localStorage.getItem('cart')
    ) || [];

}
/* =========================================================
REMOVE ITEM
========================================================= */

function removeCartItem(index){

    let cart =
    getCart();

    cart.splice(index,1);

    saveCart(cart);

}
/* =========================================================
SAVE CART
========================================================= */

function saveCart(cart){

    localStorage.setItem(
    'cart',
    JSON.stringify(cart)
    );

    updateCartCount();

}

/* =========================================================
UPDATE NAVBAR COUNT
========================================================= */

function updateCartCount(){

    const cart =
    getCart();

    document
    .querySelectorAll('.cart-count')
    .forEach(count=>{

        count.innerHTML =
        cart.length;

    });

}

/* =========================================================
ADD TO CART
========================================================= */

function addToCart(product){

    let cart = getCart();

    const existing = cart.find(item => item.id === product.id);

    if(existing){
        // FIX: Change qty to quantity
        existing.quantity += 1; 
    }
    else{
        cart.push({
            ...product,
            // FIX: Change qty to quantity
            quantity: 1 
        });
    }

    saveCart(cart);

}






/* =========================================================
CHANGE QUANTITY
========================================================= */

function changeCartQty(index, value){

    let cart = getCart();

    // FIX: Check for quantity, not qty
    if(!cart[index].quantity){
        cart[index].quantity = 1;
    }

    // FIX: Update quantity
    cart[index].quantity += value;

    // FIX: Check quantity
    if(cart[index].quantity <= 0){
        cart.splice(index, 1);
    }

    saveCart(cart);

}


/* =========================================================
CLEAR CART
========================================================= */

function clearCart(){

    localStorage.removeItem('cart');

    updateCartCount();

}

/* =========================================================
GET TOTAL
========================================================= */

function getCartTotal(){

    let total = 0;

    getCart().forEach(item => {

        // FIX: Use quantity, not qty
        total += Number(item.price) * (item.quantity || 1);

    });

    return total;

}

/* =========================================================
INIT
========================================================= */

document.addEventListener(

'dDOMContentLoaded',

()=>{

    updateCartCount();

}

);