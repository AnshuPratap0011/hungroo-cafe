/* =========================================================
HUNGROO CAFÉ PRELOADER
========================================================= */

document.addEventListener(

    "DOMContentLoaded",

    function(){

        /* =====================================================
        CREATE PRELOADER
        ===================================================== */

        const preloader =

        document.createElement(
        "div"
        );

        preloader.className =
        "site-preloader";

        /* =====================================================
        HTML
        ===================================================== */

        preloader.innerHTML =

        `
        <div class="preloader-wrapper">

            <div class="preloader-logo">

                <span>Hungroo</span> Café

            </div>

            <div class="preloader-loader">

                <span></span>
                <span></span>
                <span></span>

            </div>

            <p>

                Preparing Premium Experience...

            </p>

        </div>
        `;

        /* =====================================================
        APPEND
        ===================================================== */

        document.body.appendChild(
        preloader
        );

        /* =====================================================
        STYLE
        ===================================================== */

        const style =

        document.createElement(
        "style"
        );

        style.innerHTML =

        `
        /* =================================================
        PRELOADER
        ================================================= */

        .site-preloader{

            position:fixed;

            top:0;
            left:0;

            width:100%;
            height:100vh;

            display:flex;

            align-items:center;
            justify-content:center;

            background:
            radial-gradient(
            circle at top right,
            rgba(255,154,61,.12),
            transparent 30%
            ),
            #070707;

            z-index:999999;

            transition:
            opacity .5s ease,
            visibility .5s ease;

        }

        /* =================================================
        HIDE
        ================================================= */

        .hide-preloader{

            opacity:0;

            visibility:hidden;

            pointer-events:none;

        }

        /* =================================================
        WRAPPER
        ================================================= */

        .preloader-wrapper{

            text-align:center;

            padding:20px;

        }

        /* =================================================
        LOGO
        ================================================= */

        .preloader-logo{

            font-size:
            clamp(42px,7vw,78px);

            font-weight:800;

            color:#ffffff;

            margin-bottom:28px;

            letter-spacing:-2px;

        }

        .preloader-logo span{

            background:
            linear-gradient(
            135deg,
            #ff9a3d,
            #ffd27a
            );

            -webkit-background-clip:text;

            -webkit-text-fill-color:
            transparent;

        }

        /* =================================================
        LOADER
        ================================================= */

        .preloader-loader{

            display:flex;

            align-items:center;
            justify-content:center;

            gap:14px;

            margin-bottom:24px;

        }

        /* =================================================
        DOTS
        ================================================= */

        .preloader-loader span{

            width:18px;
            height:18px;

            border-radius:50%;

            background:
            linear-gradient(
            135deg,
            #ff9a3d,
            #ffd27a
            );

            animation:
            loaderBounce 1s infinite ease-in-out;

        }

        .preloader-loader span:nth-child(2){

            animation-delay:.15s;

        }

        .preloader-loader span:nth-child(3){

            animation-delay:.3s;

        }

        /* =================================================
        ANIMATION
        ================================================= */

        @keyframes loaderBounce{

            0%{

                transform:
                translateY(0);

                opacity:.5;

            }

            50%{

                transform:
                translateY(-12px);

                opacity:1;

            }

            100%{

                transform:
                translateY(0);

                opacity:.5;

            }

        }

        /* =================================================
        TEXT
        ================================================= */

        .preloader-wrapper p{

            color:#bdbdbd;

            font-size:15px;

            letter-spacing:.5px;

        }

        /* =================================================
        RESPONSIVE
        ================================================= */

        @media(max-width:768px){

            .preloader-logo{

                font-size:52px;

            }

            .preloader-loader span{

                width:15px;
                height:15px;

            }

        }
        `;

        document.head.appendChild(
        style
        );

        /* =====================================================
        WINDOW LOAD
        ===================================================== */

        window.addEventListener(

            "load",

            function(){

                setTimeout(function(){

                    preloader.classList.add(
                    "hide-preloader"
                    );

                    setTimeout(function(){

                        if(preloader){

                            preloader.remove();

                        }

                    },600);

                },700);

            }

        );

    }

);