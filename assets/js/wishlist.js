/* =========================================================
HUNGROO PREMIUM WISHLIST SYSTEM
========================================================= */

/* =========================================================
LOCAL STORAGE
========================================================= */

let wishlist =
JSON.parse(
localStorage.getItem(
"hungroo-wishlist"
)
) || [];

/* =========================================================
SAVE
========================================================= */

function saveWishlist(){

    localStorage.setItem(

        "hungroo-wishlist",

        JSON.stringify(wishlist)

    );

}

/* =========================================================
COUNT
========================================================= */

function updateWishlistCount(){

    const countEls =
    document.querySelectorAll(

    "#wishlist-count"

    );

    countEls.forEach(el=>{

        el.textContent =
        wishlist.length;

    });

}

/* =========================================================
CHECK EXISTS
========================================================= */

function isInWishlist(name){

    return wishlist.some(

        item => item.name === name

    );

}

/* =========================================================
ADD
========================================================= */

function addToWishlist(
name,
price,
image
){

    /* EXISTS */

    if(isInWishlist(name)){

        removeFromWishlist(name);

        return;

    }

    /* PUSH */

    wishlist.push({

        name:name,

        price:price,

        image:image

    });

    saveWishlist();

    updateWishlistButtons();

    updateWishlistCount();

}

/* =========================================================
REMOVE
========================================================= */

function removeFromWishlist(name){

    wishlist =
    wishlist.filter(

        item => item.name !== name

    );

    saveWishlist();

    updateWishlistButtons();

    updateWishlistCount();

}

/* =========================================================
BUTTONS
========================================================= */

function updateWishlistButtons(){

    document
    .querySelectorAll(
    ".wishlist-btn"
    )
    .forEach(button=>{

        const name =
        button.dataset.name;

        /* ACTIVE */

        if(isInWishlist(name)){

            button.classList.add(
            "active"
            );

            button.innerHTML = `

            <i class="fa-solid fa-heart"></i>

            `;

        }

        /* NORMAL */

        else{

            button.classList.remove(
            "active"
            );

            button.innerHTML = `

            <i class="fa-regular fa-heart"></i>

            `;

        }

    });

}

/* =========================================================
INIT BUTTONS
========================================================= */

function initWishlistButtons(){

    document
    .querySelectorAll(
    ".wishlist-btn"
    )
    .forEach(button=>{

        button.addEventListener(
        "click",
        ()=>{

            addToWishlist(

                button.dataset.name,

                button.dataset.price,

                button.dataset.image

            );

        });

    });

}

/* =========================================================
RENDER PAGE
========================================================= */

function renderWishlistPage(){

    const container =
    document.getElementById(
    "wishlistGrid"
    );

    if(!container) return;

    /* EMPTY */

    if(wishlist.length === 0){

        container.innerHTML = `

        <div class="empty-wishlist">

            <img
            src="assets/images/empty-cart.png"
            alt="Empty Wishlist">

            <h2>

                Wishlist Empty

            </h2>

            <p>

                Save your favorite premium meals.

            </p>

        </div>

        `;

        return;

    }

    /* ITEMS */

    container.innerHTML = "";

    wishlist.forEach(item=>{

        container.innerHTML += `

        <article class="wishlist-card">

            <!-- IMAGE -->

            <div class="wishlist-image">

                <img
                src="${item.image}"
                alt="${item.name}">

            </div>

            <!-- CONTENT -->

            <div class="wishlist-content">

                <h3>

                    ${item.name}

                </h3>

                <p>

                    Premium handcrafted Hungroo meal.

                </p>

                <!-- BOTTOM -->

                <div class="wishlist-bottom">

                    <h2>

                        ₹${item.price}

                    </h2>

                    <div class="wishlist-actions">

                        <button
                        class="wishlist-cart-btn"

                        onclick=
                        "moveWishlistToCart(
                        '${item.name}',
                        '${item.price}',
                        '${item.image}'
                        )">

                            Add To Cart

                        </button>

                        <button
                        class="wishlist-remove-btn"

                        onclick=
                        "removeFromWishlist(
                        '${item.name}'
                        )">

                            <i class="fa-solid fa-trash"></i>

                        </button>

                    </div>

                </div>

            </div>

        </article>

        `;

    });

}

/* =========================================================
MOVE TO CART
========================================================= */

function moveWishlistToCart(
name,
price,
image
){

    /* CART FUNCTION */

    if(typeof addToCart ===
    "function"){

        addToCart(

            name,
            price,
            image

        );

    }

}

/* =========================================================
GLOBAL INIT
========================================================= */

document.addEventListener(
"DOMContentLoaded",
()=>{

    updateWishlistCount();

    updateWishlistButtons();

    initWishlistButtons();

    renderWishlistPage();

});