<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hungroo Admin Login</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg: #09090b;
            --card: #17171c;
            --border: rgba(255, 255, 255, 0.08);
            --text: #ffffff;
            --text2: #a1a1aa;
            --purple: #6C5CE7;
            --purple2: #8c7bff;
            --danger: #ff4d4f;
            --success: #00b894;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .bg-blur {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            z-index: 0;
            animation: float 10s infinite ease-in-out alternate;
        }

        .blur1 {
            width: 400px;
            height: 400px;
            background: rgba(108, 92, 231, 0.18);
            top: -120px;
            left: -100px;
        }

        .blur2 {
            width: 350px;
            height: 350px;
            background: rgba(0, 184, 148, 0.12);
            bottom: -120px;
            right: -80px;
            animation-delay: -5s;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(30px, 50px);
            }
        }

        .view-container {
            width: 100%;
            max-width: 430px;
            padding: 20px;
            position: relative;
            z-index: 2;
        }

        .login-card {
            background: rgba(23, 23, 28, 0.92);
            border: 1px solid var(--border);
            backdrop-filter: blur(18px);
            border-radius: 32px;
            padding: 40px 34px;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.45),
                0 0 50px rgba(108, 92, 231, 0.08);
        }

        .login-top {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo {
            width: 78px;
            height: 78px;
            border-radius: 24px;
            background: linear-gradient(135deg, var(--purple), var(--purple2));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            margin-bottom: 18px;
            box-shadow: 0 10px 30px rgba(108, 92, 231, 0.35);
        }

        .logo i {
            font-size: 32px;
            color: #fff;
        }

        .login-top h1 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .login-top p {
            font-size: 13px;
            color: var(--text2);
        }

        .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #d1d1d6;
        }

        .input-box {
            width: 100%;
            height: 58px;
            border-radius: 18px;
            background: #1e1e24;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 18px;
            gap: 14px;
            transition: 0.25s;
        }

        .input-box:focus-within {
            border-color: rgba(108, 92, 231, 0.6);
            box-shadow: 0 0 0 4px rgba(108, 92, 231, 0.12);
        }

        .input-box i.icon-left {
            color: #8d8d98;
            font-size: 15px;
        }

        .input-box input {
            flex: 1;
            background: none;
            border: none;
            outline: none;
            color: #fff;
            font-size: 14px;
        }

        .input-box input::placeholder {
            color: #777781;
        }

        .toggle-password {
            cursor: pointer;
            color: #8d8d98;
            font-size: 14px;
            transition: color 0.3s;
        }

        .toggle-password:hover {
            color: #fff;
        }

        .login-btn {
            width: 100%;
            height: 58px;
            border: none;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--purple), var(--purple2));
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            box-shadow: 0 10px 25px rgba(108, 92, 231, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
        }

        .login-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            display: none;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .error-box {
            width: 100%;
            background: rgba(255, 77, 79, 0.12);
            border: 1px solid rgba(255, 77, 79, 0.25);
            color: #ff6b6b;
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s;
            pointer-events: none;
        }

        .error-box.active {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .toast {
            min-width: 300px;
            padding: 16px;
            border-radius: 12px;
            background: #1e1e24;
            color: #fff;
            border-left: 4px solid var(--success);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            animation: slideIn 0.3s ease forwards;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes shake {
            0%,100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .shake-anim {
            animation: shake 0.3s ease-in-out;
        }

        @media(max-width:500px) {
            .login-card {
                padding: 34px 24px;
                border-radius: 26px;
            }
        }
    </style>
</head>

<body>

    <div class="bg-blur blur1"></div>
    <div class="bg-blur blur2"></div>

    <div class="toast-container" id="toastContainer"></div>

    <div class="view-container">
        <div class="login-card" id="loginCard">

            <div class="login-top">
                <div class="logo">
                    <i class="fa-solid fa-user-shield"></i>
                </div>

                <h1>Admin Panel</h1>
                <p>Login to manage Hungroo Café</p>
            </div>

            <div class="error-box" id="errorBox">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span id="errorText">Invalid credentials</span>
            </div>

            <form id="loginForm">

                <div class="form-group">
                    <label class="form-label">Email Address</label>

                    <div class="input-box">
                        <i class="fa-solid fa-envelope icon-left"></i>

                        <input type="email"
                            id="email"
                            placeholder="hungroocafe@gmail.com"
                            autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>

                    <div class="input-box">
                        <i class="fa-solid fa-lock icon-left"></i>

                        <input type="password"
                            id="password"
                            placeholder="Enter password">

                        <i class="fa-solid fa-eye toggle-password"
                            id="togglePassword"></i>
                    </div>
                </div>

                <button type="submit"
                    class="login-btn"
                    id="loginBtn">

                    <span class="btn-text">Login Admin</span>

                    <div class="spinner"></div>
                </button>

            </form>

            <div style="margin-top:26px;text-align:center;font-size:13px;color:var(--text2);">
                Hungroo Café Admin Access
            </div>

        </div>
    </div>

    <script>

        const ADMIN_CREDENTIALS = {
            email: "hungroocafe@gmail.com",
            password: "Hungroo@112"
        };

        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const loginBtn = document.getElementById('loginBtn');
        const btnText = document.querySelector('.btn-text');
        const spinner = document.querySelector('.spinner');
        const errorBox = document.getElementById('errorBox');
        const errorText = document.getElementById('errorText');
        const togglePassword = document.getElementById('togglePassword');
        const toastContainer = document.getElementById('toastContainer');

        // AUTO REDIRECT IF LOGGED IN
        window.addEventListener('DOMContentLoaded', () => {

            if (localStorage.getItem('admin_logged_in') === 'true') {
                window.location.href = "dashboard.php";
            }

        });

        // TOGGLE PASSWORD
        togglePassword.addEventListener('click', () => {

            const type =
                passwordInput.getAttribute('type') === 'password'
                    ? 'text'
                    : 'password';

            passwordInput.setAttribute('type', type);

            togglePassword.classList.toggle('fa-eye');
            togglePassword.classList.toggle('fa-eye-slash');

        });

        // LOGIN SUBMIT
        loginForm.addEventListener('submit', (e) => {

            e.preventDefault();

            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();

            if (!email || !password) {
                showError("Please fill in all fields");
                return;
            }

            setLoading(true);
            hideError();

            setTimeout(() => {
                checkCredentials(email, password);
            }, 1000);

        });

        // CHECK LOGIN
        function checkCredentials(email, password) {

            if (
                email === ADMIN_CREDENTIALS.email &&
                password === ADMIN_CREDENTIALS.password
            ) {

                localStorage.setItem('admin_logged_in', 'true');

                showToast("Login Successful!");

                setTimeout(() => {

                    window.location.href = "dashboard.php";

                }, 1000);

            } else {

                setLoading(false);

                showError("Invalid email or password");

                shakeCard();

            }

        }

        // LOADING
        function setLoading(isLoading) {

            if (isLoading) {

                loginBtn.disabled = true;
                btnText.style.display = 'none';
                spinner.style.display = 'block';

            } else {

                loginBtn.disabled = false;
                btnText.style.display = 'block';
                spinner.style.display = 'none';

            }

        }

        // ERROR
        function showError(msg) {

            errorText.textContent = msg;
            errorBox.classList.add('active');

        }

        function hideError() {

            errorBox.classList.remove('active');

        }

        // SHAKE
        function shakeCard() {

            const card = document.getElementById('loginCard');

            card.classList.add('shake-anim');

            setTimeout(() => {

                card.classList.remove('shake-anim');

            }, 300);

        }

        // TOAST
        function showToast(message) {

            const toast = document.createElement('div');

            toast.className = `toast`;

            toast.innerHTML = `
                <i class="fa-solid fa-circle-check"></i>
                <span>${message}</span>
            `;

            toastContainer.appendChild(toast);

            setTimeout(() => {

                toast.remove();

            }, 3000);

        }

    </script>

</body>

</html>