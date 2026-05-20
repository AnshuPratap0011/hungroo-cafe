/* =========================================================
HUNGROO PREMIUM NOTIFICATION SYSTEM
========================================================= */

/* =========================================================
CONTAINER
========================================================= */

function createNotificationContainer(){

    /* EXISTS */

    if(
        document.querySelector(
        ".notification-container"
        )
    ) return;

    /* CREATE */

    const container =
    document.createElement("div");

    container.className =
    "notification-container";

    document.body.appendChild(
    container
    );

}

/* =========================================================
SHOW NOTIFICATION
========================================================= */

function showNotification(
message,
type = "success"
){

    createNotificationContainer();

    const container =
    document.querySelector(
    ".notification-container"
    );

    /* ICON */

    let icon =
    "fa-circle-check";

    if(type === "error"){

        icon =
        "fa-circle-xmark";

    }

    else if(type === "warning"){

        icon =
        "fa-triangle-exclamation";

    }

    else if(type === "info"){

        icon =
        "fa-circle-info";

    }

    /* CREATE */

    const notification =
    document.createElement("div");

    notification.className =

    `notification ${type}`;

    notification.innerHTML = `

    <div class="notification-icon">

        <i class="fa-solid ${icon}"></i>

    </div>

    <div class="notification-content">

        <h4>

            Hungroo Café

        </h4>

        <p>

            ${message}

        </p>

    </div>

    <button class="notification-close">

        <i class="fa-solid fa-xmark"></i>

    </button>

    `;

    /* APPEND */

    container.appendChild(
    notification
    );

    /* ACTIVE */

    setTimeout(()=>{

        notification.classList.add(
        "active"
        );

    },50);

    /* CLOSE */

    notification
    .querySelector(
    ".notification-close"
    )
    .addEventListener(
    "click",
    ()=>{

        removeNotification(
        notification
        );

    });

    /* AUTO REMOVE */

    setTimeout(()=>{

        removeNotification(
        notification
        );

    },4000);

}

/* =========================================================
REMOVE
========================================================= */

function removeNotification(
notification
){

    notification.classList.remove(
    "active"
    );

    setTimeout(()=>{

        notification.remove();

    },350);

}

/* =========================================================
SUCCESS
========================================================= */

function showSuccess(message){

    showNotification(

        message,

        "success"

    );

}

/* =========================================================
ERROR
========================================================= */

function showError(message){

    showNotification(

        message,

        "error"

    );

}

/* =========================================================
WARNING
========================================================= */

function showWarning(message){

    showNotification(

        message,

        "warning"

    );

}

/* =========================================================
INFO
========================================================= */

function showInfo(message){

    showNotification(

        message,

        "info"

    );

}

/* =========================================================
CART EVENTS
========================================================= */

document.addEventListener(
"click",
(event)=>{

    /* ADD TO CART */

    if(

        event.target.closest(
        ".food-btn"
        )

    ){

        showSuccess(

        "Item added to cart"

        );

    }

    /* REMOVE */

    if(

        event.target.closest(
        ".remove-cart-item"
        )

    ){

        showWarning(

        "Item removed from cart"

        );

    }

});

/* =========================================================
NETWORK STATUS
========================================================= */

window.addEventListener(
"offline",
()=>{

    showError(

    "No internet connection"

    );

});

window.addEventListener(
"online",
()=>{

    showSuccess(

    "Connection restored"

    );

});

/* =========================================================
WELCOME
========================================================= */

window.addEventListener(
"load",
()=>{

    setTimeout(()=>{

        showInfo(

        "Welcome to Hungroo Café"

        );

    },1200);

});