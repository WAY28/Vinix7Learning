<?php
// Koneksi ke database
require_once 'config.php';

// Query untuk mengambil data FAQ
$faq_query = "SELECT * FROM faq ORDER BY id_faq ASC";
$faq_result = mysqli_query($conn, $faq_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Subscription Plan</title>
    <link rel="stylesheet" href="subscription.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="navbar">
        <div class="brand">Vinix7 Learning Path</div>
        
        <div class="main-nav">
            <a href="dashboard.php">Home</a>
            <a href="learning_path.php">Learning Path</a>
            <a href="subscription.php" class="active">Subscription</a>
        </div>

        <div class="user-actions">
            <a href="profile.php" class="user-profile">
                <img src="assets/images/study.png" alt="Profile" class="profile-img">
            </a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <main>
        <section class="hero-section">
            <div class="container">
                <h1>Your Subscription Plan</h1>
                <p>Review your current plan, explore available benefits, and update your preferences anytime.</p>
            </div>
        </section>

        <section class="subscription-section">
            <div class="container">
                <h2>Subscription Package</h2>
                <div class="packages-grid">
                    <div class="package-card learning-path-package">
                        <h3>Learning Path Subscription</h3>
                        <p class="level-package">Level Package</p>
                        <div class="level-tabs">
                            <button class="level-tab active">Basic</button>
                            <button class="level-tab">Intermediate</button>
                            <button class="level-tab">Advanced</button>
                        </div>
                        <p class="price">Rp. 540.000</p>
                        <p class="learning-path-label">Learning Path</p>
                        <div class="custom-select">
                            <select>
                                <option>Data Science & Data Analyst</option>
                                <option>Web Development</option>
                                <option>Mobile Development</option>
                            </select>
                            <div class="select-arrow"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <a href="https://wa.me/6281234567890?text=Hello,%20I'm%20interested%20in%20the%20Learning%20Path%20Subscription%20(Basic%20-%20Data%20Science%20&%20Data%20Analyst)." target="_blank" class="purchase-button">Purchase</a>
                        
                        <p class="suitable-text">Suitable for those of you who want to learn more comprehensively and in depth in a particular learning path</p>
                        <ul class="benefits-list">
                            <li><i class="fas fa-check-circle"></i> Access up to 5 Basic - Beginner classes</li>
                            <li><i class="fas fa-check-circle"></i> Access up to 5 Basic - Beginner classes</li>
                            <li><i class="fas fa-check-circle"></i> Access up to 5 Basic - Beginner classes</li>
                            <li><i class="fas fa-check-circle"></i> Access up to 5 Basic - Beginner classes</li>
                            <li><i class="fas fa-check-circle"></i> Access up to 5 Basic - Beginner classes</li>
                        </ul>
                    </div>

                    <div class="package-card plus-package">
                        <h3>Plus Subscription</h3>
                        <p class="level-package">Level Package</p>
                        <div class="duration-tabs">
                            <button class="duration-tab active">1 Month</button>
                            <button class="duration-tab">3 Month</button>
                            <button class="duration-tab">6 Month</button>
                            <button class="duration-tab">1 Year</button>
                        </div>
                        <p class="price">Rp. 1.540.000</p>
                        <a href="https://wa.me/6281234567890?text=Hello,%20I'm%20interested%20in%20the%20Plus%20Subscription%20(1%20Month)." target="_blank" class="purchase-button">Purchase</a>
                        
                        <p class="suitable-text">Suitable for those of you who want to learn more comprehensively and in depth in a particular learning path</p>
                        <ul class="benefits-list">
                            <li><i class="fas fa-check-circle"></i> Access up to 5 Basic - Beginner classes</li>
                            <li><i class="fas fa-check-circle"></i> Access up to 5 Basic - Beginner classes</li>
                            <li><i class="fas fa-check-circle"></i> Access up to 5 Basic - Beginner classes</li>
                            <li><i class="fas fa-check-circle"></i> Access up to 5 Basic - Beginner classes</li>
                            <li><i class="fas fa-check-circle"></i> Access up to 5 Basic - Beginner classes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section">
            <div class="container">
                <h2>FAQ</h2>
                <div class="faq-grid">
                    <div class="faq-contact">
                        <p>Have other questions?</p>
                        <a href="https://wa.me/6281234567890?text=Hello,%20I%20have%20some%20questions%20about%20your%20subscription%20plans." target="_blank">Contacts via WhatsApp</a>
                    </div>
                    <div class="faq-items">
                        <?php if(mysqli_num_rows($faq_result) > 0): ?>
                            <?php while($faq = mysqli_fetch_assoc($faq_result)): ?>
                                <div class="faq-item">
                                    <div class="faq-question">
                                        <?php echo htmlspecialchars($faq['questions']); ?> 
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div class="faq-answer">
                                        <?php echo htmlspecialchars($faq['answer']); ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="faq-item">
                                <div class="faq-question">No FAQ available <i class="fas fa-chevron-down"></i></div>
                                <div class="faq-answer">Please check back later for frequently asked questions.</div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

</div> 

<footer>
    <div class="footer-grid">
        <div class="footer-col brand-info">
            <div class="brand-footer">Vinix7 Learning Path</div>
            <p>Platform edukasi online terbaik untuk masa depan karir Anda.</p>
            <p class="copyright">&copy; 2025 Vinix7 Learning Path. All Rights Reserved.</p>
        </div>
        
        <div class="footer-col links">
            <h4>Menu</h4>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="learning_path.php">Course</a></li>
                <li><a href="subscription.php">Subscription</a></li>
                <li><a href="#faq-section">FAQ</a></li>
            </ul>
        </div>
        
        <div class="footer-col links">
            <h4>T&C</h4>
            <ul>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Cookie Policy</a></li>
            </ul>
        </div>
        
        <div class="footer-col social">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="#"><img src="assets/images/fb.png" alt="Facebook"></a>
                <a href="#"><img src="assets/images/ig.png" alt="Instagram"></a>
                <a href="#"><img src="assets/images/in.png" alt="LinkedIn"></a>
            </div>
            <p>Email: info@brandname.com</p>
        </div>
    </div>
</footer>

    <script>
        document.querySelectorAll('.faq-question').forEach(item => {
            item.addEventListener('click', event => {
                const faqItem = event.target.closest('.faq-item');
                faqItem.classList.toggle('active');
            });
        });

        // Simple script to handle tab active states
        document.querySelectorAll('.level-tab').forEach(button => {
            button.addEventListener('click', () => {
                button.closest('.level-tabs').querySelectorAll('.level-tab').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
            });
        });
        document.querySelectorAll('.duration-tab').forEach(button => {
            button.addEventListener('click', () => {
                button.closest('.duration-tabs').querySelectorAll('.duration-tab').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
            });
        });
    </script>

    <?php
    // Tutup koneksi database
    mysqli_close($conn);
    ?>
</body>
</html>