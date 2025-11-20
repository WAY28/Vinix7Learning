<?php
// landing.php
// Halaman utama sebelum login
session_start();

// Koneksi ke database
require_once 'config.php';

// Query untuk mengambil data FAQ
$faq_query = "SELECT * FROM faq ORDER BY id_faq ASC";
$faq_result = mysqli_query($conn, $faq_query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinix7 Learning Path - Platform Edukasi Online</title>
    <link rel="stylesheet" href="landing.css">
</head>
<body>

<div class="navbar">
    <div class="brand">Vinix7 Learning Path</div>
    
    <div class="nav-menu">
        <a href="#home" class="active">Home</a>
        <a href="#courses">Learning Path</a>
        <a href="#about">About</a>
        <a href="#faq">FAQ</a>
    </div>

    <div class="nav-links">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php" class="btn btn-secondary">Dashboard</a>
            <a href="logout.php" class="btn btn-primary">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-secondary">Sign In</a>
            <a href="register.php" class="btn btn-primary">Sign Up</a>
        <?php endif; ?>
    </div>
</div>

<section class="hero" id="home">
    <div class="hero-content">
        <h1>Start learning with us now</h1>
        <p>A great place to discover, learn, and grow your career with a curated selection of courses and practical projects.</p>
        <a href="#courses" class="btn btn-primary">Start Learning</a>
    </div>

    <div class="hero-illustration">
        <img src="assets/images/learn.svg" alt="Illustrasi belajar" style="max-width: 80%;">
    </div>
</section>

<section class="course-activity-center" id="courses">
    <h2>Course Activity Center</h2>
    <div class="activity-grid">
        <div class="activity-item">
            <span class="icon">💡</span>
            <h3>Driven Learning Modules</h3>
            <p>Access structured material for deep understanding.</p>
        </div>
        <div class="activity-item">
            <span class="icon">📈</span>
            <h3>Global Skills Track</h3>
            <p>Follow a path designed for high-demand skills.</p>
        </div>
        <div class="activity-item">
            <span class="icon">⚙️</span>
            <h3>Assignment Automation</h3>
            <p>Hands-on practice with automated grading.</p>
        </div>
        <div class="activity-item">
            <span class="icon">🎓</span>
            <h3>Project Submission Program</h3>
            <p>Build a portfolio by submitting real-world projects.</p>
        </div>
    </div>
</section>

<section class="highlights-bar">
    <div class="highlight-item">
        <h3>50+</h3>
        <p>Kelas tersedia di tahun 2025</p>
    </div>
    <div class="highlight-item">
        <h3>20,000+</h3>
        <p>Students telah bergabung</p>
    </div>
    <div class="highlight-item">
        <h3>100+</h3>
        <p>Top Mentor telah bergabung</p>
    </div>
</section>

<section class="learning-path">
    <div class="path-header">
        <h2>Learning Path</h2>
        <a href="#" class="view-more">View More</a>
    </div>
    <div class="path-grid">
        <div class="path-card">
            <img src="assets/images/unnamed.jpg" alt="Course Thumbnail">
            <h4>Data Science & Mathematics</h4>
            <div class="path-meta">
                <span>📅 1 Month</span>
                <span>⭐ Course!</span>
            </div>
        </div>
        <div class="path-card">
            <img src="assets/images/unnamed.jpg" alt="Course Thumbnail">
            <h4>Data Science & Mathematics</h4>
            <div class="path-meta">
                <span>📅 1 Month</span>
                <span>⭐ Course!</span>
            </div>
        </div>
        <div class="path-card">
            <img src="assets/images/unnamed.jpg" alt="Course Thumbnail">
            <h4>Data Science & Mathematics</h4>
            <div class="path-meta">
                <span>📅 1 Month</span>
                <span>⭐ Course!</span>
            </div>
        </div>
        <div class="path-card">
            <img src="assets/images/unnamed.jpg" alt="Course Thumbnail">
            <h4>Data Science & Mathematics</h4>
            <div class="path-meta">
                <span>📅 1 Month</span>
                <span>⭐ Course!</span>
            </div>
        </div>
    </div>
</section>

<section class="testimonials">
    <h3>What Student's Say</h3>
    <div class="testimonial-grid">
        <div class="testimonial-card">
            <p>"Kursus di sini sangat terstruktur dan mentornya supportif. Benar-benar membuka wawasan karir saya."</p>
            <div class="student-info">
                <img src="assets/images/study2.png" alt="Avatar">
                <p><strong>Sarah M.</strong><br><span>Product Designer</span></p>
            </div>
        </div>
        <div class="testimonial-card">
            <p>"Materi yang disajikan sangat relevan dengan industri saat ini. Saya langsung bisa mengaplikasikannya di pekerjaan."</p>
            <div class="student-info">
                <img src="assets/images/study.png" alt="Avatar">
                <p><strong>David A.</strong><br><span>Data Scientist</span></p>
            </div>
        </div>
        <div class="testimonial-card">
            <p>"Saya tidak menyangka bisa belajar secepat ini. Kurikulumnya padat tapi sangat mudah diikuti."</p>
            <div class="student-info">
                <img src="assets/images/study2.png" alt="Avatar">
                <p><strong>Rina N.</strong><br><span>Web Developer</span></p>
            </div>
        </div>
    </div>
</section>

<section class="about-us" id="about">
    <div class="about-illustration">
        <img src="assets/images/unnamed.jpg" alt="About Us Illustration">
    </div>
    <div class="about-content">
        <h2>About Us</h2>
        <p>Vinix7 Learning Path adalah platform edukasi online yang berkomitmen untuk menyediakan akses mudah ke pengetahuan dan keterampilan berkualitas tinggi. Kami percaya bahwa setiap orang berhak mendapatkan kesempatan untuk belajar dan tumbuh, terlepas dari latar belakang mereka. Kurikulum kami dirancang oleh para ahli industri untuk memastikan relevansi dan nilai praktis.</p>
        <p>Kami fokus pada pembelajaran berbasis proyek, memberikan siswa pengalaman langsung yang diperlukan untuk sukses di dunia kerja.</p>
    </div>
</section>

<section class="faq" id="faq">
    <h2>FAQ</h2>
    <?php if(mysqli_num_rows($faq_result) > 0): ?>
        <?php while($faq = mysqli_fetch_assoc($faq_result)): ?>
            <div class="faq-item">
                <details>
                    <summary><?php echo htmlspecialchars($faq['questions']); ?></summary>
                    <p><?php echo htmlspecialchars($faq['answer']); ?></p>
                </details>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="faq-item">
            <details>
                <summary>No FAQ Available</summary>
                <p>Please check back later for frequently asked questions.</p>
            </details>
        </div>
    <?php endif; ?>
</section>

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
                <li><a href="#home">Home</a></li>
                <li><a href="#courses">Course</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#faq">FAQ</a></li>
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

<?php
// Tutup koneksi database
mysqli_close($conn);
?>
</body>
</html>