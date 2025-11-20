<?php
session_start();
include "config.php";

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
}
?>
<link rel="stylesheet" href="login.css">

<div class="main-container">
    <div class="login-box">
        <div class="brand-name">Vinix7 Learning Path</div>

        <h1>Sign in</h1>
        <p class="subtitle">Sign up to enjoy the feature of Vinix7 Learning Path</p>

        <?php if (isset($_GET['error'])): ?>
            <p class="error-message">Email atau password salah</p>
        <?php endif; ?>

        <form action="login_process.php" method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="jonas.kahnwald@gmail.com" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>

            <button class="btn-login" type="submit">Sign In</button> </form>

        <div class="separator">or</div>
        
        <button class="btn-google">
            <img src="assets/images/google.png" alt="Google Icon" class="google-icon"> Continue with Google
        </button>

        <p class="small">Don't have an account? <a href="register.php" class="link-signup">Sign up</a></p>
    </div>
    
    <div class="visual-area">
        <div class="logo-placeholder"></div>
        </div>
</div>