/* =========================================================
HUNGROO PREMIUM CUSTOM CURSOR
========================================================= */

/* =========================================================
CREATE CURSOR
========================================================= */

const cursor =
document.createElement(
"div"
);

cursor.className =
"premium-cursor";

document.body.appendChild(
cursor
);

/* =========================================================
CREATE DOT
========================================================= */

const cursorDot =
document.createElement(
"div"
);

cursorDot.className =
"premium-cursor-dot";

document.body.appendChild(
cursorDot
);

/* =========================================================
MOUSE MOVE
========================================================= */

window.addEventListener(
"mousemove",
(event)=>{

    const x =
    event.clientX;

    const y =
    event.clientY;

    /* DOT */

    cursorDot.style.left =
    x + "px";

    cursorDot.style.top =
    y + "px";

    /* CURSOR */

    requestAnimationFrame(()=>{

        cursor.style.left =
        x + "px";

        cursor.style.top =
        y + "px";

    });

});

/* =========================================================
HOVER EFFECT
========================================================= */

const hoverItems =
document.querySelectorAll(

"a,\
button,\
.food-card,\
.gallery-card,\
.review-card,\
.offer-card"

);

hoverItems.forEach(item=>{

    item.addEventListener(
    "mouseenter",
    ()=>{

        cursor.classList.add(
        "cursor-hover"
        );

    });

    item.addEventListener(
    "mouseleave",
    ()=>{

        cursor.classList.remove(
        "cursor-hover"
        );

    });

});

/* =========================================================
CLICK EFFECT
========================================================= */

window.addEventListener(
"mousedown",
()=>{

    cursor.classList.add(
    "cursor-click"
    );

});

window.addEventListener(
"mouseup",
()=>{

    cursor.classList.remove(
    "cursor-click"
    );

});

/* =========================================================
HIDE MOBILE
========================================================= */

function isMobile(){

    return window.innerWidth <= 768;

}

/* =========================================================
CHECK
========================================================= */

if(isMobile()){

    cursor.style.display =
    "none";

    cursorDot.style.display =
    "none";

}

/* =========================================================
RESIZE
========================================================= */

window.addEventListener(
"resize",
()=>{

    if(isMobile()){

        cursor.style.display =
        "none";

        cursorDot.style.display =
        "none";

    }

    else{

        cursor.style.display =
        "block";

        cursorDot.style.display =
        "block";

    }

});

/* =========================================================
DEBUG
========================================================= */

console.log(

"%c Hungroo Premium Cursor Enabled ",

`
background:#ffd27a;
color:#000;
padding:8px 18px;
border-radius:10px;
font-weight:bold;
`

);