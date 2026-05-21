/* =========================================================
CACHE NAME
========================================================= */

const CACHE_NAME =
"hungroo-cache-v1";

/* =========================================================
FILES TO CACHE
========================================================= */

const urlsToCache = [

    "/Hungroo-Cafe/",
    "/Hungroo-Cafe/home.php",
    "/Hungroo-Cafe/menu.php",
    "/Hungroo-Cafe/about.php",
    "/Hungroo-Cafe/contact.php",
    "/Hungroo-Cafe/reservation.php",

    "/Hungroo-Cafe/assets/css/navbar.css",
    "/Hungroo-Cafe/assets/css/home.css",
    "/Hungroo-Cafe/assets/css/menu.css",
    "/Hungroo-Cafe/assets/css/footer.css",

    "/Hungroo-Cafe/assets/js/cart.js",
    "/Hungroo-Cafe/assets/js/theme.js",
    "/Hungroo-Cafe/assets/js/preloader.js",
    "/Hungroo-Cafe/assets/js/pwa.js",

    "/Hungroo-Cafe/assets/images/logo.png"

];

/* =========================================================
INSTALL
========================================================= */

self.addEventListener(

    "install",

    (event)=>{

        event.waitUntil(

            caches.open(CACHE_NAME)

            .then((cache)=>{

                return cache.addAll(
                urlsToCache
                );

            })

        );

    }

);

/* =========================================================
FETCH
========================================================= */

self.addEventListener(

    "fetch",

    (event)=>{

        event.respondWith(

            caches.match(
            event.request
            )

            .then((response)=>{

                return response ||

                fetch(
                event.request
                );

            })

        );

    }

);

/* =========================================================
ACTIVATE
========================================================= */

self.addEventListener(

    "activate",

    (event)=>{

        event.waitUntil(

            caches.keys()

            .then((cacheNames)=>{

                return Promise.all(

                    cacheNames.map((cache)=>{

                        if(cache !== CACHE_NAME){

                            return caches.delete(
                            cache
                            );

                        }

                    })

                );

            })

        );

    }

);