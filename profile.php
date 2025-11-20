<?php
// profile.php

session_start();
// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    // Arahkan ke halaman login jika belum login
    header("Location: login.php");
    exit;
}

// ASUMSI: File config.php sudah mendefinisikan variabel koneksi $conn
include "config.php"; 

$user_id = $_SESSION['user_id'];
$active_tab = isset($_GET['view']) && $_GET['view'] === 'completed' ? 'completed' : 'active';

// --- 1. QUERY UNTUK DETAIL USER (Tabel: user) ---
$sql_user = "SELECT fullname, dob, created_at, email FROM user WHERE id_user = ?";
$stmt_user = mysqli_prepare($conn, $sql_user);
$user_data = ['fullname' => 'Pengguna', 'dob' => 'N/A', 'created_at' => 'N/A', 'avatar' => 'avatar.png'];

if ($stmt_user) {
    mysqli_stmt_bind_param($stmt_user, "i", $user_id);
    mysqli_stmt_execute($stmt_user);
    $res_user = mysqli_stmt_get_result($stmt_user);

    if ($row = mysqli_fetch_assoc($res_user)) {
        $user_data = array_merge($user_data, $row);
    }
    mysqli_stmt_close($stmt_user);
}


// --- 2. QUERY UNTUK PROGRESS USER (Tabel: user_progress JOIN modules) ---
// Mengambil semua kursus yang memiliki progres untuk user ini
$sql_progress = "
    SELECT 
        up.id_module, 
        m.title, 
        up.status,
        up.progress_percent 
    FROM 
        user_progress up
    JOIN 
        modules m ON up.id_module = m.id_module
    WHERE 
        up.id_user = ?
    ORDER BY 
        up.progress_percent DESC
";
$stmt_progress = mysqli_prepare($conn, $sql_progress);

$active_courses = [];
$completed_courses = [];

if ($stmt_progress) {
    mysqli_stmt_bind_param($stmt_progress, "i", $user_id);
    mysqli_stmt_execute($stmt_progress);
    $res_progress = mysqli_stmt_get_result($stmt_progress);

    if ($res_progress) {
        while($row = mysqli_fetch_assoc($res_progress)) {
            // Logika untuk menentukan Active atau Completed
            if ($row['status'] === 'Completed' || $row['progress_percent'] == 100) {
                $completed_courses[] = $row;
            } else {
                $active_courses[] = $row;
            }
        }
    }
    mysqli_stmt_close($stmt_progress);
}

// Tutup koneksi setelah semua query selesai (jika menggunakan MySQLi Prosedural)
// mysqli_close($conn); 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page - <?= htmlspecialchars($user_data['fullname']) ?></title>
    <link rel="stylesheet" href="profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="navbar">
    <div class="brand">Vinix7 Learning Path</div>
    
    <div class="main-nav">
        <a href="dashboard.php">Home</a>
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
<main class="main-content">
    
    <section class="profile-header-section">
        <div class="user-info-wrapper">
            <img src="assets/images/study.png" alt="User Avatar" class="large-profile-img">
            
            <div class="user-details">
                <h1><?= htmlspecialchars($user_data['fullname']) ?></h1>
                <p class="user-id">ID: <?= htmlspecialchars($user_id) ?></p>
                <p class="user-join-date">Join: <?= date('d F Y', strtotime($user_data['created_at'])) ?></p>
                <p class="user-email">Email: <?= htmlspecialchars($user_data['email'] ?? 'N/A') ?></p>
                <p class="user-dob">Tanggal Lahir: <?= date('d F Y', strtotime($user_data['dob'])) ?></p>
            </div>
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
                                <span>👥 23,456</span> <span>📖 12 Modul</span> 
                            </div>
                            
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
                <p class="no-course-message">Anda tidak memiliki kursus aktif saat ini.</p>
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
                                <span>👥 23,456</span> <span>📖 12 Modul</span>
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

</main> 

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
    // Fungsi JavaScript untuk mengganti tampilan tab (Diambil dari referensi dashboard)
    function showCourses(type) {
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