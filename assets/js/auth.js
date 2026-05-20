/* =========================================================
HUNGROO PREMIUM AUTH SYSTEM
========================================================= */

/* =========================================================
PASSWORD TOGGLE
========================================================= */

document
.querySelectorAll(
".password-toggle"
)
.forEach(toggle=>{

    toggle.addEventListener(
    "click",
    ()=>{

        const input =
        toggle.parentElement
        .querySelector("input");

        /* PASSWORD */

        if(input.type ===
        "password"){

            input.type =
            "text";

            toggle.innerHTML =

            `<i class="fa-solid fa-eye-slash"></i>`;

        }

        /* TEXT */

        else{

            input.type =
            "password";

            toggle.innerHTML =

            `<i class="fa-solid fa-eye"></i>`;

        }

    });

});

/* =========================================================
FORM VALIDATION
========================================================= */

const authForms =
document.querySelectorAll(

".auth-form"

);

authForms.forEach(form=>{

    form.addEventListener(
    "submit",
    (event)=>{

        const email =
        form.querySelector(
        'input[type="email"]'
        );

        const password =
        form.querySelector(
        'input[type="password"]'
        );

        /* EMAIL */

        if(email){

            const emailValue =
            email.value.trim();

            const emailRegex =

            /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if(

                !emailRegex.test(
                emailValue
                )

            ){

                event.preventDefault();

                showAuthError(

                "Enter valid email address"

                );

                return;

            }

        }

        /* PASSWORD */

        if(password){

            if(

                password.value.length < 6

            ){

                event.preventDefault();

                showAuthError(

                "Password must be at least 6 characters"

                );

                return;

            }

        }

    });

});

/* =========================================================
ERROR
========================================================= */

function showAuthError(message){

    let errorBox =
    document.querySelector(
    ".auth-error"
    );

    /* CREATE */

    if(!errorBox){

        errorBox =
        document.createElement(
        "div"
        );

        errorBox.className =
        "auth-error";

        document.body.appendChild(
        errorBox
        );

    }

    /* TEXT */

    errorBox.innerHTML = `

    <i class="fa-solid fa-circle-exclamation"></i>

    ${message}

    `;

    /* ACTIVE */

    errorBox.classList.add(
    "active"
    );

    /* REMOVE */

    setTimeout(()=>{

        errorBox.classList.remove(
        "active"
        );

    },3000);

}

/* =========================================================
SUCCESS
========================================================= */

function showAuthSuccess(message){

    let successBox =
    document.querySelector(
    ".auth-success"
    );

    /* CREATE */

    if(!successBox){

        successBox =
        document.createElement(
        "div"
        );

        successBox.className =
        "auth-success";

        document.body.appendChild(
        successBox
        );

    }

    /* TEXT */

    successBox.innerHTML = `

    <i class="fa-solid fa-circle-check"></i>

    ${message}

    `;

    /* ACTIVE */

    successBox.classList.add(
    "active"
    );

    /* REMOVE */

    setTimeout(()=>{

        successBox.classList.remove(
        "active"
        );

    },3000);

}

/* =========================================================
REMEMBER LOGIN
========================================================= */

const rememberBox =
document.getElementById(
"rememberLogin"
);

if(rememberBox){

    rememberBox.addEventListener(
    "change",
    ()=>{

        localStorage.setItem(

            "hungroo-remember",

            rememberBox.checked

        );

    });

    /* INIT */

    const savedRemember =
    localStorage.getItem(

    "hungroo-remember"

    );

    if(savedRemember ===
    "true"){

        rememberBox.checked =
        true;

    }

}

/* =========================================================
LOADING BUTTON
========================================================= */

document
.querySelectorAll(
".auth-submit-btn"
)
.forEach(button=>{

    button.addEventListener(
    "click",
    ()=>{

        button.classList.add(
        "loading"
        );

        button.innerHTML = `

        <span class="auth-loader"></span>

        Please Wait...

        `;

    });

});

/* =========================================================
AUTO HIDE ALERTS
========================================================= */

document
.querySelectorAll(

".auth-alert"

)
.forEach(alert=>{

    setTimeout(()=>{

        alert.classList.add(
        "hide"
        );

    },3500);

});

/* =========================================================
ENTER SUBMIT
========================================================= */

document.addEventListener(
"keydown",
(event)=>{

    if(event.key ===
    "Enter"){

        const activeForm =
        document.querySelector(
        ".auth-form"
        );

        if(activeForm){

            activeForm.requestSubmit();

        }

    }

});

/* =========================================================
DEBUG
========================================================= */

console.log(

"%c Hungroo Auth System Loaded ",

`
background:#ff9a3d;
color:#000;
padding:8px 18px;
border-radius:10px;
font-weight:bold;
`

);