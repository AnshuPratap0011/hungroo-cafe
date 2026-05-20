/* =========================================================
THEME TOGGLE SYSTEM
========================================================= */

const body =
document.body;

/* =========================================================
GET SAVED THEME
========================================================= */

const savedTheme =
localStorage.getItem(
"hungroo-theme"
);

/* =========================================================
APPLY SAVED THEME
========================================================= */

if(savedTheme === "light"){

    body.classList.add(
    "light-mode"
    );

}

/* =========================================================
THEME BUTTON
========================================================= */

const themeToggle =
document.querySelector(
".theme-toggle"
);

/* =========================================================
UPDATE ICON
========================================================= */

function updateThemeIcon(){

    if(!themeToggle) return;

    const icon =
    themeToggle.querySelector(
    "i"
    );

    if(body.classList.contains(
    "light-mode"
    )){

        icon.className =
        "fa-solid fa-moon";

    }

    else{

        icon.className =
        "fa-solid fa-sun";

    }

}

/* =========================================================
INITIAL ICON
========================================================= */

updateThemeIcon();

/* =========================================================
CLICK EVENT
========================================================= */

if(themeToggle){

    themeToggle.addEventListener(
    "click",
    ()=>{

        body.classList.toggle(
        "light-mode"
        );

        /* SAVE THEME */

        if(body.classList.contains(
        "light-mode"
        )){

            localStorage.setItem(
            "hungroo-theme",
            "light"
            );

        }

        else{

            localStorage.setItem(
            "hungroo-theme",
            "dark"
            );

        }

        /* UPDATE ICON */

        updateThemeIcon();

    });

}

/* =========================================================
SMOOTH PAGE LOAD
========================================================= */

window.addEventListener(
"load",
()=>{

    body.classList.add(
    "page-loaded"
    );

});

/* =========================================================
PREVENT OVERFLOW BUGS
========================================================= */

document.querySelectorAll(
"img"
).forEach(img=>{

    img.setAttribute(
    "draggable",
    "false"
    );

});

/* =========================================================
AUTO CLOSE MOBILE NAVBAR
========================================================= */

const mobileLinks =
document.querySelectorAll(
".mobile-menu a"
);

mobileLinks.forEach(link=>{

    link.addEventListener(
    "click",
    ()=>{

        const mobileMenu =
        document.querySelector(
        ".mobile-menu"
        );

        const menuBtn =
        document.querySelector(
        ".menu-toggle"
        );

        if(mobileMenu){

            mobileMenu.classList.remove(
            "active"
            );

        }

        if(menuBtn){

            menuBtn.classList.remove(
            "active"
            );

        }

    });

});

/* =========================================================
SCROLL SHADOW NAVBAR
========================================================= */

window.addEventListener(
"scroll",
()=>{

    const navbar =
    document.querySelector(
    ".navbar"
    );

    if(!navbar) return;

    if(window.scrollY > 20){

        navbar.classList.add(
        "navbar-scrolled"
        );

    }

    else{

        navbar.classList.remove(
        "navbar-scrolled"
        );

    }

});