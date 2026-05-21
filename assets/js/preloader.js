/* =========================================================
PRELOADER SYSTEM
========================================================= */

/* =========================================================
CREATE PRELOADER
========================================================= */

const preloader =

document.createElement(
"div"
);

preloader.className =
"site-preloader";

preloader.innerHTML = `

    <div class="preloader-box">

        <div class="loader-ring"></div>

        <h2>

            Hungroo Café

        </h2>

        <p>

            Loading Delicious Experience...

        </p>

    </div>

`;

document.body.appendChild(
preloader
);

/* =========================================================
STYLE
========================================================= */

const style =

document.createElement(
"style"
);

style.innerHTML = `

/* =========================================
PRELOADER
========================================= */

.site-preloader{

    position:fixed;

    inset:0;

    z-index:999999;

    display:flex;

    align-items:center;
    justify-content:center;

    background:#070707;

    transition:
    opacity .6s ease,
    visibility .6s ease;

}

/* =========================================
HIDE
========================================= */

.site-preloader.hide{

    opacity:0;

    visibility:hidden;

}

/* =========================================
BOX
========================================= */

.preloader-box{

    text-align:center;

}

/* =========================================
RING
========================================= */

.loader-ring{

    width:90px;
    height:90px;

    margin:auto auto 28px;

    border-radius:50%;

    border:
    6px solid rgba(255,255,255,.08);

    border-top:
    6px solid #ff9a3d;

    border-right:
    6px solid #ffd27a;

    animation:
    rotateLoader 1s linear infinite;

    box-shadow:
    0 0 40px rgba(255,154,61,.25);

}

/* =========================================
TEXT
========================================= */

.preloader-box h2{

    font-size:42px;

    margin-bottom:10px;

    background:
    linear-gradient(
    135deg,
    #ff9a3d,
    #ffd27a
    );

    -webkit-background-clip:text;

    -webkit-text-fill-color:
    transparent;

    font-family:'Poppins',sans-serif;

}

.preloader-box p{

    color:#bdbdbd;

    font-size:14px;

    letter-spacing:.5px;

    font-family:'Poppins',sans-serif;

}

/* =========================================
ANIMATION
========================================= */

@keyframes rotateLoader{

    100%{

        transform:
        rotate(360deg);

    }

}

/* =========================================
PHONE
========================================= */

@media(max-width:768px){

    .loader-ring{

        width:74px;
        height:74px;

    }

    .preloader-box h2{

        font-size:32px;

    }

}

`;

document.head.appendChild(
style
);

/* =========================================================
WINDOW LOAD
========================================================= */

window.addEventListener(

    "load",

    ()=>{

        setTimeout(()=>{

            preloader.classList.add(
            "hide"
            );

            setTimeout(()=>{

                preloader.remove();

            },700);

        },500);

    }

);