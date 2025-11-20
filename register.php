<?php
// register.php
// Deskripsi: Form registrasi user baru
session_start();
if (isset($_SESSION['user_id'])) header("Location: dashboard.php");
?>
<link rel="stylesheet" href="register.css">

<div class="signup-container">
    <div class="register-box">
        <div class="brand-name">Vinix7 Learning Path</div>
        
        <h1>Sign up</h1>
        <p class="subtitle">Sign up to enjoy the feature of Vinix7 Learning Path</p>

        <?php if(isset($_GET['error'])): ?>
            <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form action="register_process.php" method="POST">
            <div class="input-group">
                <label for="fullname">Your Name</label>
                <input type="text" id="fullname" name="fullname" placeholder="John Doe" required>
            </div>
            
            <div class="input-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="jonas.kahnwald@gmail.com" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            
            <button class="btn-register" type="submit">Sign up</button>
        </form>

        <div class="separator">or</div>
        
        <button class="btn-google">
            <img src="assets/images/google.png" alt="Google Icon" class="google-icon"> Continue with Google
        </button>

        <p class="small">Already have an account? <a href="login.php" class="link-signin">Sign in</a></p>
    </div>
    <div class="empty-area">
        <div class="logo-placeholder"></div>
    </div>
</div>