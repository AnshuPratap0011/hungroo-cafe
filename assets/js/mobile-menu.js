/* =========================================================
HUNGROO PREMIUM MOBILE MENU
========================================================= */

/* =========================================================
ELEMENTS
========================================================= */

const mobileToggle =
document.getElementById(
"mobileMenuToggle"
);

const mobileMenu =
document.getElementById(
"mobileMenu"
);

const mobileOverlay =
document.getElementById(
"mobileOverlay"
);

const mobileClose =
document.getElementById(
"mobileMenuClose"
);

/* =========================================================
OPEN
========================================================= */

function openMobileMenu(){

    if(!mobileMenu) return;

    mobileMenu.classList.add(
    "active"
    );

    mobileOverlay?.classList.add(
    "active"
    );

    document.body.style.overflow =
    "hidden";

}

/* =========================================================
CLOSE
========================================================= */

function closeMobileMenu(){

    if(!mobileMenu) return;

    mobileMenu.classList.remove(
    "active"
    );

    mobileOverlay?.classList.remove(
    "active"
    );

    document.body.style.overflow =
    "";

}

/* =========================================================
TOGGLE
========================================================= */

mobileToggle?.addEventListener(
"click",
()=>{

    openMobileMenu();

});

/* =========================================================
CLOSE BTN
========================================================= */

mobileClose?.addEventListener(
"click",
()=>{

    closeMobileMenu();

});

/* =========================================================
OVERLAY
========================================================= */

mobileOverlay?.addEventListener(
"click",
()=>{

    closeMobileMenu();

});

/* =========================================================
ESC CLOSE
========================================================= */

document.addEventListener(
"keydown",
(event)=>{

    if(event.key === "Escape"){

        closeMobileMenu();

    }

});

/* =========================================================
AUTO CLOSE ON LINK CLICK
========================================================= */

document
.querySelectorAll(
"#mobileMenu a"
)
.forEach(link=>{

    link.addEventListener(
    "click",
    ()=>{

        closeMobileMenu();

    });

});

/* =========================================================
ACTIVE LINK
========================================================= */

const currentPage =
window.location.pathname
.split("/")
.pop();

document
.querySelectorAll(
"#mobileMenu a"
)
.forEach(link=>{

    const href =
    link.getAttribute(
    "href"
    );

    if(href === currentPage){

        link.classList.add(
        "active"
        );

    }

});

/* =========================================================
SWIPE CLOSE MOBILE
========================================================= */

let startX = 0;

mobileMenu?.addEventListener(
"touchstart",
(event)=>{

    startX =
    event.touches[0].clientX;

});

mobileMenu?.addEventListener(
"touchmove",
(event)=>{

    const currentX =
    event.touches[0].clientX;

    const diff =
    startX - currentX;

    /* SWIPE LEFT */

    if(diff > 90){

        closeMobileMenu();

    }

});

/* =========================================================
PREVENT SCROLL BUG
========================================================= */

mobileMenu?.addEventListener(
"wheel",
(event)=>{

    event.stopPropagation();

});

/* =========================================================
DEBUG
========================================================= */

console.log(

"%c Hungroo Mobile Menu Ready ",

`
background:#ff9a3d;
color:#000;
padding:8px 18px;
border-radius:10px;
font-weight:bold;
`

);