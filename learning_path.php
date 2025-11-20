<?php
// learning_path.php

// 1. Panggil file koneksi database Anda
// Pastikan file config.php sudah benar-benar ada dan berisi detail koneksi.
include 'config.php'; 

// Inisialisasi variabel $modules sebagai array kosong di awal untuk mencegah error undefined variable
// JIKA koneksi gagal, $modules tetap array kosong, sehingga loop foreach aman.
$modules = []; 

// Fungsi untuk format angka (25458 -> 25.458)
function format_students($number) {
    return number_format($number, 0, ',', '.');
}

// Cek apakah koneksi berhasil sebelum menjalankan query
// $conn biasanya disiapkan di config.php
if (isset($conn) && $conn) {
    // 2. QUERY SQL: Ambil field yang diperlukan.
    $query = "SELECT title, description, level, total_students , type FROM modules";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // 3. Mengambil semua hasil dan menyimpannya ke variabel $modules
        while ($row = mysqli_fetch_assoc($result)) {
            $modules[] = $row;
        }
    } else {
        // Tangani error query
        echo "<div style='color: red; text-align: center; padding: 20px;'>Query Database Gagal: " . mysqli_error($conn) . "</div>";
    }

    // Tutup koneksi setelah selesai
    mysqli_close($conn);
} else {
    // Pesan jika koneksi database gagal
    // HANYA MUNCULKAN INI JIKA DEBUGGING
    // echo "<div style='color: red; text-align: center; padding: 20px;'>Koneksi Database Gagal! Periksa config.php Anda.</div>";
}
// Catatan: Variabel $active_tab tidak didefinisikan di sini, jadi saya inisialisasi saja untuk navbar.
$active_tab = 'learning_path';
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Path - Vinix7 Learning Path</title>
    <link rel="stylesheet" href="learning_path.css"> 
</head>
<body>

<div class="navbar">
    <div class="brand">Vinix7 Learning Path</div>
    
    <div class="main-nav">
        <a href="dashboard.php">Home</a>
        <a href="learning_path.php" class="active">Learning Path</a> 
        <a href="subscription.php">Subscription</a>
    </div>

    <div class="user-actions">
        <a href="profile.php" class="user-profile">
            <img src="assets/images/study.png" alt="Profile" class="profile-img">
        </a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

    <main class="container">
        <section class="hero-section">
            <h1>Temukan Learning Path Terbaik Anda</h1>
            <p class="subtitle">Eksplorasi modul-modul yang dirancang oleh para ahli industri untuk membangun karir Anda.</p>
            
            <div class="search-filter-area">
                <input type="text" placeholder="Cari Kursus Data, Web, UI/UX" class="search-input">
                <select class="level-select">
                    <option value="">All Level</option>
                    <option value="Basic">Basic</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
                <select class="type-select">
                    <option value="">All Type</option>
                    <option value="Paid">Paid</option>
                    <option value="Free">Free</option>
                </select>
            </div>
        </section>

        <section class="modules-list-section">
            <div class="module-grid">
                <?php 
                // Line 56: Loop ini sekarang aman karena $modules dijamin array
                foreach ($modules as $module): 
                ?>
                    <div class="module-card">
                        <img src="assets/images/unnamed.jpg" alt="Thumbnail <?= htmlspecialchars($module['title']) ?>" class="module-thumbnail">
                        
                        <div class="card-body">
                            <span class="level-tag level-<?= strtolower($module['level']) ?>">
                                <?= htmlspecialchars($module['level']) ?>
                            </span>

                            <span class="type-tag type-<?= strtolower($module['type']) ?>">
                                <?= htmlspecialchars($module['type']) ?>
                            </span>

                            <h3 class="module-title"><?= htmlspecialchars($module['title']) ?></h3>
                            <p class="module-description"><?= htmlspecialchars($module['description']) ?></p>
                            
                            <div class="card-footer">
                                <p class="students-count">
                                    <span class="icon-student">👨‍🎓</span> 
                                    <?= format_students($module['total_students']) ?> Students
                                </p>
                                <a href="module_detail.php" class="detail-button">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php if (empty($modules)): ?>
                <p style="text-align: center; padding: 50px; color: #7f8c8d;">Tidak ada modul yang tersedia saat ini.</p>
            <?php endif; ?>
        </section>
    </main>

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

</body>
</html>