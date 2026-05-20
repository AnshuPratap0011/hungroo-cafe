/* =========================================================
HUNGROO PREMIUM SEARCH SYSTEM
========================================================= */

/* =========================================================
ELEMENTS
========================================================= */

const searchInput =
document.getElementById(
"liveSearchInput"
);

const searchResults =
document.getElementById(
"liveSearchResults"
);

/* =========================================================
MENU ITEMS
========================================================= */

const foodItems = [

    "Classic Burger",
    "Cheese Burger",
    "Chicken Burger",
    "Veg Burger",

    "Cold Coffee",
    "Cappuccino",
    "Latte Coffee",

    "Boba Tea",
    "Chocolate Boba",
    "Strawberry Boba",

    "Pizza Combo",
    "Cheese Pizza",

    "French Fries",
    "Premium Dessert",
    "Chocolate Cake",

    "Cold Drinks",
    "Mojito",
    "Ice Cream"

];

/* =========================================================
SHOW RESULTS
========================================================= */

function showSearchResults(results){

    if(!searchResults) return;

    /* EMPTY */

    if(results.length === 0){

        searchResults.innerHTML = `

        <div class="search-empty">

            No Item Found

        </div>

        `;

        searchResults.classList.add(
        "active"
        );

        return;

    }

    /* CLEAR */

    searchResults.innerHTML = "";

    /* LOOP */

    results.forEach(item=>{

        searchResults.innerHTML += `

        <a
        href="menu.php?search=${encodeURIComponent(item)}"

        class="search-result-item">

            <i class="fa-solid fa-magnifying-glass"></i>

            <span>

                ${item}

            </span>

        </a>

        `;

    });

    /* ACTIVE */

    searchResults.classList.add(
    "active"
    );

}

/* =========================================================
FILTER
========================================================= */

function filterSearch(query){

    const filtered =
    foodItems.filter(item=>{

        return item
        .toLowerCase()
        .includes(
        query.toLowerCase()
        );

    });

    showSearchResults(filtered);

}

/* =========================================================
INPUT EVENT
========================================================= */

if(searchInput){

    searchInput.addEventListener(
    "input",
    ()=>{

        const value =
        searchInput.value.trim();

        /* EMPTY */

        if(value === ""){

            searchResults.classList.remove(
            "active"
            );

            return;

        }

        /* FILTER */

        filterSearch(value);

    });

}

/* =========================================================
OUTSIDE CLICK
========================================================= */

document.addEventListener(
"click",
(event)=>{

    if(

        !searchResults?.contains(
        event.target
        )

        &&

        event.target !== searchInput

    ){

        searchResults?.classList.remove(
        "active"
        );

    }

});

/* =========================================================
KEYBOARD NAVIGATION
========================================================= */

let currentIndex = -1;

/* =========================================================
KEYDOWN
========================================================= */

if(searchInput){

    searchInput.addEventListener(
    "keydown",
    (event)=>{

        const items =
        document.querySelectorAll(

        ".search-result-item"

        );

        if(!items.length) return;

        /* DOWN */

        if(event.key ===
        "ArrowDown"){

            currentIndex++;

            if(currentIndex >= items.length){

                currentIndex = 0;

            }

            updateActiveResult(items);

        }

        /* UP */

        else if(event.key ===
        "ArrowUp"){

            currentIndex--;

            if(currentIndex < 0){

                currentIndex =
                items.length - 1;

            }

            updateActiveResult(items);

        }

        /* ENTER */

        else if(event.key ===
        "Enter"){

            if(currentIndex >= 0){

                window.location.href =

                items[currentIndex]
                .getAttribute("href");

            }

        }

    });

}

/* =========================================================
ACTIVE RESULT
========================================================= */

function updateActiveResult(items){

    items.forEach(item=>{

        item.classList.remove(
        "active"
        );

    });

    items[currentIndex]
    .classList.add(
    "active"
    );

}

/* =========================================================
AUTO FOCUS SHORTCUT
========================================================= */

document.addEventListener(
"keydown",
(event)=>{

    /* CTRL + K */

    if(

        event.ctrlKey &&

        event.key.toLowerCase()
        === "k"

    ){

        event.preventDefault();

        searchInput?.focus();

    }

});

/* =========================================================
SEARCH LOADER
========================================================= */

function showSearchLoading(){

    if(!searchResults) return;

    searchResults.innerHTML = `

    <div class="search-loading">

        <div class="search-loader"></div>

        Searching...

    </div>

    `;

    searchResults.classList.add(
    "active"
    );

}

/* =========================================================
SIMULATED DELAY
========================================================= */

if(searchInput){

    searchInput.addEventListener(
    "input",
    ()=>{

        showSearchLoading();

        clearTimeout(
        window.searchDelay
        );

        window.searchDelay =
        setTimeout(()=>{

            filterSearch(
            searchInput.value
            );

        },250);

    });

}