/* =========================================================
THEME SYSTEM
========================================================= */

const themeToggle =

document.getElementById(
"themeToggle"
);

/* =========================================================
LOAD SAVED THEME
========================================================= */

function loadTheme(){

    const savedTheme =

    localStorage.getItem(
    "hungroo_theme"
    );

    if(savedTheme === "light"){

        document.body.classList.add(
        "light-mode"
        );

        updateThemeIcon(true);

    }

    else{

        document.body.classList.remove(
        "light-mode"
        );

        updateThemeIcon(false);

    }

}

/* =========================================================
UPDATE ICON
========================================================= */

function updateThemeIcon(isLight){

    if(!themeToggle) return;

    const icon =

    themeToggle.querySelector("i");

    if(isLight){

        icon.className =
        "fa-solid fa-sun";

    }

    else{

        icon.className =
        "fa-solid fa-moon";

    }

}

/* =========================================================
TOGGLE THEME
========================================================= */

function toggleTheme(){

    document.body.classList.toggle(
    "light-mode"
    );

    const isLight =

    document.body.classList.contains(
    "light-mode"
    );

    /* =====================
    SAVE
    ===================== */

    if(isLight){

        localStorage.setItem(

            "hungroo_theme",

            "light"

        );

    }

    else{

        localStorage.setItem(

            "hungroo_theme",

            "dark"

        );

    }

    updateThemeIcon(isLight);

}

/* =========================================================
BUTTON CLICK
========================================================= */

if(themeToggle){

    themeToggle.addEventListener(

        "click",

        ()=>{

            toggleTheme();

        }

    );

}

/* =========================================================
INIT
========================================================= */

document.addEventListener(

    "DOMContentLoaded",

    ()=>{

        loadTheme();

    }

);