<?php include 'db_conn.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Turno NHS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="navbar">
        <h1>ZNNHS - Turno</h1>
        <div class="nav-links">
            <div class="theme-switch-wrapper">
                <span id="theme-label" class="theme-status">Light Mode</span>
                <label class="theme-switch" for="checkbox">
                    <input type="checkbox" id="checkbox" />
                    <div class="slider round"></div>
                </label>
            </div>
        </div>
    </div>

    <div class="login-wrapper">
        <div class="login-box">
            <h2>Welcome Back</h2>
            
            <?php if (isset($_GET['error'])) { ?>
                <p class="error" style="font-size: 14px;"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <p class="success" style="font-size: 14px;"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <form action="login_logic.php" method="POST">
                <input type="text" name="username" placeholder="Username or Email" required>
                
                <div class="password-container">
                    <input type="password" name="password" id="loginPass" placeholder="Password" required>
                    <svg class="password-icon" id="eyeOpen" onclick="togglePass()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                    <svg class="password-icon hide-icon" id="eyeClose" onclick="togglePass()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/></svg>
                </div>

                <button type="submit" name="login_btn" class="btn-login">Login</button>

                <div class="login-links">
                    <a href="forgot_password.php">Forgot Password?</a>
                    <br><br>
                    <span>No account?</span> <a href="register.php" style="font-weight:bold;">Create one</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // 1. Password Toggle Logic
        function togglePass() {
            var passInput = document.getElementById('loginPass');
            var iconOpen = document.getElementById('eyeOpen');
            var iconClose = document.getElementById('eyeClose');
            if (passInput.type === "password") {
                passInput.type = "text";
                iconOpen.style.display = "none";
                iconClose.style.display = "block";
            } else {
                passInput.type = "password";
                iconOpen.style.display = "block";
                iconClose.style.display = "none";
            }
        }

        // 2. Dark Mode Toggle with Text Update
        const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
        const themeLabel = document.getElementById('theme-label');
        const currentTheme = localStorage.getItem('theme');

        if (currentTheme) {
            document.body.classList.add(currentTheme);
            if (currentTheme === 'dark-mode') {
                toggleSwitch.checked = true;
                themeLabel.textContent = "Dark Mode";
            }
        }

        function switchTheme(e) {
            if (e.target.checked) {
                document.body.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark-mode');
                themeLabel.textContent = "Dark Mode";
            } else {
                document.body.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
                themeLabel.textContent = "Light Mode";
            }
        }

        toggleSwitch.addEventListener('change', switchTheme, false);
    </script>

</body>
</html>