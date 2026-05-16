<!-- =====================================================
====================== FOOTER ============================
====================================================== -->

<style>

/* =====================================================
================ FOOTER ===============================
===================================================== */

.footer{
    background:#111;

    color:white;

    margin-top:50px;

    padding-top:28px;

    overflow:hidden;
}

/* =====================================================
================ FOOTER CONTAINER =====================
===================================================== */

.footer-container{
    width:100%;

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(180px,1fr));

    gap:28px;

    padding:0 45px 24px;
}

/* =====================================================
================ FOOTER BOX ===========================
===================================================== */

.footer-box h2{
    font-size:18px;

    margin-bottom:14px;

    color:white;

    font-weight:600;
}

/* =====================================================
================ FOOTER LOGO TEXT =====================
===================================================== */

.footer-logo-text{
    display:inline-block;

    font-size:28px;

    font-weight:700;

    color:#ff3b3b;

    text-decoration:none;

    margin-bottom:12px;

    letter-spacing:0.5px;

    transition:0.3s;
}

/* HOVER */

.footer-logo-text:hover{
    color:white;

    transform:translateX(3px);
}

/* =====================================================
================ FOOTER TEXT ==========================
===================================================== */

.footer-box p,
.footer-box a{
    color:#cfcfcf;

    text-decoration:none;

    line-height:1.7;

    display:block;

    margin-bottom:8px;

    font-size:14px;

    transition:0.3s;
}

/* =====================================================
================ LINK HOVER ==========================
===================================================== */

.footer-box a:hover{
    color:#ff3b3b;

    transform:translateX(3px);
}

/* =====================================================
================ FOOTER NOTE ==========================
===================================================== */

.footer-note{
    color:#ffb703 !important;

    font-weight:500;
}

/* =====================================================
================ SOCIAL ==============================
===================================================== */

.footer-socials{
    display:flex;

    align-items:center;

    gap:10px;

    margin-top:15px;
}

/* =====================================================
================ SOCIAL ICON =========================
===================================================== */

.footer-socials a{
    width:36px;
    height:36px;

    border-radius:50%;

    background:#1f1f1f;

    display:flex;
    justify-content:center;
    align-items:center;

    color:white;

    font-size:14px;

    transition:0.3s;
}

/* =====================================================
================ ICON HOVER ==========================
===================================================== */

.footer-socials a:hover{

    background:#ff3b3b;

    transform:
    translateY(-4px);

}

/* =====================================================
================ CONTACT ICON ========================
===================================================== */

.footer-box p i{
    color:#ff3b3b;

    margin-right:8px;
}

/* =====================================================
================ FOOTER BOTTOM =======================
===================================================== */

.footer-bottom{
    width:100%;

    border-top:
    1px solid rgba(255,255,255,0.08);

    padding:14px 45px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    flex-wrap:wrap;

    gap:12px;
}

/* =====================================================
================ BOTTOM TEXT =========================
===================================================== */

.footer-bottom p{
    color:#bdbdbd;

    font-size:13px;
}

/* =====================================================
================ FOOTER BOTTOM LINKS ==================
===================================================== */

.footer-bottom-links{
    display:flex;

    align-items:center;

    gap:14px;
}

/* =====================================================
================ LINKS ===============================
===================================================== */

.footer-bottom-links a{
    color:#cfcfcf;

    text-decoration:none;

    font-size:13px;

    transition:0.3s;
}

/* =====================================================
================ LINK HOVER ==========================
===================================================== */

.footer-bottom-links a:hover{
    color:#ff3b3b;
}

/* =====================================================
================ RESPONSIVE ==========================
===================================================== */

@media(max-width:768px){

    .footer-container{
        padding:0 22px 24px;
    }

    .footer-bottom{
        padding:14px 22px;

        flex-direction:column;

        align-items:flex-start;
    }

}

</style>

<footer class="footer" id="footer">

    <!-- =====================================================
    ====================== FOOTER CONTAINER ==================
    ====================================================== -->

    <div class="footer-container">

        <!-- =====================================================
        ====================== BRAND =============================
        ====================================================== -->

        <div class="footer-box footer-brand">

            <!-- LOGO TEXT -->

            <a href="home.php"
            class="footer-logo-text">

                Hungroo Cafe

            </a>

            <p>

                Fresh burgers, coffee,
                boba and desserts made
                daily for food lovers.

            </p>

            <!-- SOCIAL -->

            <div class="footer-socials">

                <!-- INSTAGRAM -->

                <a href="#"
                aria-label="Instagram">

                    <i class=
                    "fa-brands fa-instagram"></i>

                </a>

                <!-- FACEBOOK -->

                <a href="#"
                aria-label="Facebook">

                    <i class=
                    "fa-brands fa-facebook-f"></i>

                </a>

                <!-- WHATSAPP -->

                <a href="#"
                aria-label="WhatsApp">

                    <i class=
                    "fa-brands fa-whatsapp"></i>

                </a>

            </div>

        </div>

        <!-- =====================================================
        ====================== EXPLORE ==========================
        ====================================================== -->

        <div class="footer-box">

            <h2>

                Explore

            </h2>

            <a href="home.php">

                Home

            </a>

            <a href="menu.php">

                Menu

            </a>

            <a href="cart.php">

                Cart

            </a>

            <a href="checkout.php">

                Checkout

            </a>

        </div>

        <!-- =====================================================
        ====================== OPENING HOURS ====================
        ====================================================== -->

        <div class="footer-box">

            <h2>

                Opening Hours

            </h2>

            <p>

                Monday - Friday :
                10 AM - 10 PM

            </p>

            <p>

                Saturday - Sunday :
                9 AM - 11 PM

            </p>

            <p class="footer-note">

                Delivery available daily.

            </p>

        </div>

        <!-- =====================================================
        ====================== CONTACT ==========================
        ====================================================== -->

        <div class="footer-box">

            <h2>

                Contact

            </h2>

            <p>

                <i class=
                "fa-solid fa-location-dot"></i>

                Chandigarh

            </p>

            <p>

                <i class=
                "fa-solid fa-phone"></i>

                +91 99999 99999

            </p>

            <p>

                <i class=
                "fa-solid fa-envelope"></i>

                hungroo@gmail.com

            </p>

        </div>

    </div>

    <!-- =====================================================
    ====================== FOOTER BOTTOM =====================
    ====================================================== -->

    <div class="footer-bottom">

        <!-- COPYRIGHT -->

        <p>

            © <?php echo date("Y"); ?>
            Hungroo Cafe.
            All Rights Reserved.

        </p>

        <!-- LINKS -->

        <div class="footer-bottom-links">

            <a href="#">

                Privacy Policy

            </a>

            <a href="#">

                Terms & Conditions

            </a>

        </div>

    </div>

</footer>