<?php
// dashboard.php
// Deskripsi: tampilan setelah login, menampilkan daftar modul dan progress.

session_start();
if (!isset($_SESSION['user_id'])) header("Location: login.php");
include "config.php"; // Pastikan koneksi database sudah di-include

$user_id = $_SESSION['user_id'];
// Simulasi: Ambil fullname dari database user
// $fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Pengguna'; 
// Asumsi 'fullname' sudah di set di session saat login
$fullname = $_SESSION['fullname']; 

// Tentukan tab default yang aktif
$active_tab = isset($_GET['view']) && $_GET['view'] === 'completed' ? 'completed' : 'active';


// --- QUERY UNTUK PROGRESS USER (Active dan Completed Courses) ---
// Note: Perbaiki kembali `up.progress_percent` sesuai nama kolom database Anda jika masih error.
// Asumsi: Nama kolom dan tabel sudah benar (`db_elearning_user_progress` dan `db_elearning_modules`).
$sql_progress = "
    SELECT 
        up.id_module, 
        m.title, 
        m.description, 
        m.level,
        up.status,
        up.progress_percent 
    FROM 
        user_progress up
    JOIN 
        modules m ON up.id_module = m.id_module
    WHERE 
        up.id_user = ?
";
$stmt_progress = mysqli_prepare($conn, $sql_progress);

if ($stmt_progress === false) {
    // Error handling untuk debugging (ubah ini di production)
    // die("Error Query Progress: " . mysqli_error($conn)); 
} else {
    mysqli_stmt_bind_param($stmt_progress, "i", $user_id);
    mysqli_stmt_execute($stmt_progress);
    $res_progress = mysqli_stmt_get_result($stmt_progress);

    $active_courses = [];
    $completed_courses = [];

    if ($res_progress) {
        while($row = mysqli_fetch_assoc($res_progress)) {
            if ($row['status'] === 'Completed' || $row['progress_percent'] == 100) {
                $completed_courses[] = $row;
            } else {
                $active_courses[] = $row;
            }
        }
    }
    mysqli_stmt_close($stmt_progress);
}


// --- QUERY UNTUK MODUL BARU ("Start a New Learning Path") ---
$sql_new_paths = "SELECT id_module, title, description, level FROM modules ORDER BY created_at DESC LIMIT 4";
$res_new_paths = mysqli_query($conn, $sql_new_paths);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Vinix7 Learning Path</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

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

<div class="main-content">
    
    <section class="greeting-hero">
        <div class="hero-content">
            <h1>Welcome, <?php echo htmlspecialchars($fullname); ?>!</h1>
            <p>Lanjutkan perjalanan belajar Anda dan capai target karir berikutnya.</p>
        </div>
        <div class="hero-illustration">
             <img src="assets/images/learn.svg" alt="Illustrasi belajar" style="max-width: 80%;">
        </div>
    </section>

    <section class="study-progress">
        <h2>Study Progress</h2>
        
        <div class="tabs">
            <button class="tab-button <?php echo ($active_tab === 'active' ? 'active' : ''); ?>" onclick="showCourses('active')">Your Active Courses (<?php echo count($active_courses); ?>)</button>
            <button class="tab-button <?php echo ($active_tab === 'completed' ? 'active' : ''); ?>" onclick="showCourses('completed')">Your Completed Courses (<?php echo count($completed_courses); ?>)</button>
        </div>

        <div id="active-courses" class="course-list <?php echo ($active_tab === 'active' ? 'active-content' : 'hidden-content'); ?>">
            <?php if (count($active_courses) > 0): ?>
                <?php foreach ($active_courses as $course): ?>
                    <div class="course-card">
                        <img src="assets/images/unnamed.jpg" alt="Thumbnail" class="course-thumbnail">
                        <div class="course-details">
                            <h4 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h4>
                            <div class="meta-info">
                                <span>👥 23,456</span> <span>📖 12 Modul</span> </div>
                            
                            <div class="progress-container">
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" style="width: <?php echo $course['progress_percent']; ?>%;"></div>
                                </div>
                                <span class="progress-percent"><?php echo $course['progress_percent']; ?>%</span>
                            </div>
                            
                            <a href="module.php?id=<?php echo $course['id_module']; ?>" class="btn btn-primary btn-card-action">Continue Study</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-course-message">Anda belum memiliki kursus aktif. Mulai Learning Path baru di bawah!</p>
            <?php endif; ?>
        </div>

        <div id="completed-courses" class="course-list <?php echo ($active_tab === 'completed' ? 'active-content' : 'hidden-content'); ?>">
            <?php if (count($completed_courses) > 0): ?>
                <?php foreach ($completed_courses as $course): ?>
                    <div class="course-card completed-card">
                        <img src="assets/images/unnamed.jpg" alt="Thumbnail" class="course-thumbnail">
                        <div class="course-details">
                            <h4 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h4>
                            <div class="meta-info">
                                <span>👥 23,456</span>
                                <span>📖 12 Modul</span>
                            </div>
                            
                            <div class="progress-container">
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar complete" style="width: 100%;"></div>
                                </div>
                                <span class="progress-percent complete-text">100%</span>
                            </div>

                            <a href="certificate.php?id=<?php echo $course['id_module']; ?>" class="btn btn-secondary btn-card-action btn-certificate">📜 Ambil Sertifikat</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-course-message">Anda belum menyelesaikan kursus apapun.</p>
            <?php endif; ?>
        </div>
        
    </section>

    <section class="new-path">
        <div class="path-header">
            <h2>Start a New Learning Path</h2>
            <div class="search-box">
                <input type="text" placeholder="🔎 Find Course">
            </div>
        </div>

        <div class="course-list new-path-list">
            <?php 
            if (isset($res_new_paths) && $res_new_paths && mysqli_num_rows($res_new_paths) > 0) {
                while($row = mysqli_fetch_assoc($res_new_paths)): ?>
                    <div class="course-card new-path-card">
                        <img src="assets/images/unnamed.jpg" alt="Thumbnail" class="course-thumbnail">
                        <div class="course-details">
                            <h4 class="course-title"><?php echo htmlspecialchars($row['title']); ?></h4>
                            <div class="meta-info">
                                <span>👥 20,458</span>
                                <span>📖 12 Modul</span>
                            </div>
                            <a href="module_detail.php?id=<?php echo $row['id_module']; ?>" class="btn btn-secondary btn-card-action">Detail</a>
                        </div>
                    </div>
                <?php endwhile; 
            } else { ?>
                 <p class="no-course-message">Tidak ada modul baru yang ditemukan.</p>
            <?php } ?>
        </div>
    </section>
    
</div> <footer>
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
    function showCourses(type) {
        // Logika tab switching
        const activeContent = document.getElementById('active-courses');
        const completedContent = document.getElementById('completed-courses');
        const activeBtn = document.querySelector('.tabs .tab-button:nth-child(1)');
        const completedBtn = document.querySelector('.tabs .tab-button:nth-child(2)');

        if (type === 'active') {
            activeContent.classList.add('active-content');
            activeContent.classList.remove('hidden-content');
            completedContent.classList.remove('active-content');
            completedContent.classList.add('hidden-content');
            activeBtn.classList.add('active');
            completedBtn.classList.remove('active');
        } else { // type === 'completed'
            completedContent.classList.add('active-content');
            completedContent.classList.remove('hidden-content');
            activeContent.classList.remove('active-content');
            activeContent.classList.add('hidden-content');
            completedBtn.classList.add('active');
            activeBtn.classList.remove('active');
        }
    }
    
    // Inisialisasi tab saat halaman dimuat
    const urlParams = new URLSearchParams(window.location.search);
    const viewType = urlParams.get('view');
    document.addEventListener('DOMContentLoaded', () => {
        showCourses(viewType === 'completed' ? 'completed' : 'active');
    });
</script>

</body>
</html>