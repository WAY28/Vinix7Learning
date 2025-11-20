<?php 
$active_tab = 'active';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduction To Figma - Vinix7 Learning Path</title>
    <link rel="stylesheet" href="module_detail.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar-wrapper">
    <div class="navbar">
        <div class="brand">Vinix7 Learning Path</div>
    
        <div class="main-nav">
            <a href="dashboard.php" class="<?php echo ($active_tab === 'active' ? 'active' : ''); ?>">Home</a>
            <a href="learning_path.php">Learning Path</a>
            <a href="subscription.php">Subscription</a>
        </div>

        <div class="user-actions">
            <a href="profile.php" class="user-profile">
                <img src="assets/images/study.png" alt="Profile" class="profile-img">
            </a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

<div class="main-content module-detail-page">
    
    <section class="module-intro-hero">
        <div class="intro-image">
            <!-- KAMU GANTI GAMBAR DI SINI -->
            <img src="assets/images/unnamed.jpg" alt="Module Image">
        </div>

        <div class="intro-info">
            <p class="module-topic">Tool: **UX/UI Design**</p>
            <h1>Introduction To Figma</h1>
            <p class="module-level">Level: **Beginner** ⏱️ 90 Hours</p>
            <ul class="key-points">
                <li>Learn the basics of Figma and start creating simple UI designs.</li>
                <li>This module covers the key features of the tool.</li>
                <li>Perfect for beginners starting their design journey.</li>
            </ul>
            <a href="module.php" class="btn btn-primary btn-start-learning">Start Learning</a>
        </div>
    </section>

    <section class="module-benefits-section">
        <div class="benefit-card-grid">
            <!-- TAMBAHKAN A HREF DI SINI -->
            <a href="certificate.php" class="benefit-card-item">
                <div class="icon">📜</div>
                <h3>Certificate</h3>
                <p>Earn an industry standard certificate upon completing this course.</p>
            </a>
            <a href="quiz.php" class="benefit-card-item">
                <div class="icon">❓</div>
                <h3>Quiz</h3>
                <p>Pass a short internal quiz to test your understanding regarding the module.</p>
            </a>
            <a href="test.php" class="benefit-card-item">
                <div class="icon">📝</div>
                <h3>Test</h3>
                <p>Pass an industry standard examination upon completing this course.</p>
            </a>
        </div>
    </section>
    
    <div class="detail-content-wrapper">
    
        <section class="module-section class-description-section">
            <h2 class="section-title-center">Class Descriptions</h2>
            <div class="class-description-content">
                <p>
                    Introduction to Figma adalah modul komprehensif yang membahas dasar-dasar perangkat lunak desain antarmuka (UI) dan pengalaman pengguna (UX) terkemuka, Figma. Modul ini dirancang untuk pemula yang ingin menguasai keterampilan dasar dalam desain digital. Anda akan mempelajari mulai dari antarmuka Figma, penggunaan tools dasar, hingga kolaborasi tim yang efektif.
                </p>
                <p>Materi yang akan dipelajari meliputi:</p>
                <ul>
                    <li>Dasar-dasar Figma: Memahami lingkungan kerja, frame, dan page.</li>
                    <li>Tools Desain Dasar: Penggunaan shape, text, dan image.</li>
                    <li>Component dan Style: Membuat komponen yang dapat digunakan kembali untuk konsistensi desain.</li>
                    <li>Auto Layout: Membangun desain yang responsif dan fleksibel.</li>
                </ul>
            </div>
        </section>

        <section class="module-section testimonial-section">
            <h2 class="section-title-center">Student Testimonials</h2>
            <div class="testimonial-grid-detail">
                <div class="testimonial-card-detail">
                    <div class="testimonial-header-wrapper">
                        <img src="assets/images/study.png" alt="Susan Doe" class="avatar-small-detail">
                        <h4>Susan Doe</h4>
                    </div>
                    <p>"Classnya sangat detail dan mudah diikuti, memberikan pemahaman yang kuat tentang UI/UX. Saya sangat merekomendasikannya untuk siapa saja yang tertarik di bidang desain."</p>
                </div>
                <div class="testimonial-card-detail">
                    <div class="testimonial-header-wrapper">
                        <img src="assets/images/study.png" alt="Susan Doe" class="avatar-small-detail">
                        <h4>Susan Doe</h4>
                    </div>
                    <p>"Materi yang disajikan sangat relevan dengan kebutuhan industri saat ini, khususnya penggunaan Auto Layout dan Prototyping di Figma."</p>
                </div>
                <div class="testimonial-card-detail">
                    <div class="testimonial-header-wrapper">
                        <img src="assets/images/study.png" alt="Susan Doe" class="avatar-small-detail">
                        <h4>Susan Doe</h4>
                    </div>
                    <p>"Penjelasan yang jelas dan studi kasus yang praktis membantu saya memahami konsep kompleks dengan mudah."</p>
                </div>
                <div class="testimonial-card-detail">
                    <div class="testimonial-header-wrapper">
                        <img src="assets/images/study.png" alt="Susan Doe" class="avatar-small-detail">
                        <h4>Susan Doe</h4>
                    </div>
                    <p>"Saya sekarang lebih percaya diri dalam menggunakan Figma untuk proyek-proyek pribadi dan profesional. Terima kasih!"</p>
                </div>
            </div>
        </section>

        <section class="module-section syllabus-section">
            <h2 class="section-title-center">Syllabus</h2>

            <div class="syllabus-group">
                <div class="syllabus-header">
                    <h3>Basic Concepts of UI (User Designer) Design</h3>
                    <p>Learn the fundamental principles of design thinking and how it applies to UI design.</p>
                    <div class="syllabus-meta">
                        <span>⏱️ 1 Module</span>
                        <span>📖 27 Materi/Notes</span>
                    </div>
                </div>

            <div class="syllabus-group">
                <div class="syllabus-header">
                    <h3>Empathize, Define and Ideate</h3>
                    <p>Understand your users through research and transform insights into actionable ideas.</p>
                    <div class="syllabus-meta">
                        <span>⏱️ 2 Module</span>
                        <span>📖 14 Materi/Notes</span>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-secondary load-more-btn">Load More Syllabus</button>
            </div>
        </section>
        
    </div>
</div>

<!-- FOOTER -->
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

</body>
</html>