<?php include 'db_conn.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="navbar">
        <h1>ZNNHS - Turno</h1>
        <div class="nav-links">
            <a href="login.php">← Back to Login</a>
            
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
            <h2>Reset Password</h2>
            
            <p style="margin-bottom: 20px; font-size: 14px; color: var(--text-dark);">
                Enter your email address and we will send you a link to reset your password.
            </p>

            <form action="forgot_logic.php" method="POST">
                <label style="text-align: left;">Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
                
                <button type="submit" name="reset_request" class="btn-login">Send Reset Link</button>
            </form>
        </div>
    </div>

    <script>
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