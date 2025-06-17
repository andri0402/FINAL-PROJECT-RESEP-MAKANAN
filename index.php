<?php
session_start();
require_once 'functions.php';

$page_title = "Resep Makanan Terbaik";

// Include header dan navbar
include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- Hero Section -->
<section class="hero-section animate-on-scroll bg-success text-white text-center" style="padding-top: 120px; padding-bottom: 60px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">Temukan Resep Terbaik</h1>
                <p class="lead mb-5">Ribuan resep masakan dari seluruh dunia siap memandu memasak Anda</p>
                <form class="d-flex justify-content-center" action="<?php echo base_url('search.php'); ?>" method="GET">
                    <div class="input-group w-75">
                        <input type="search" name="q" class="form-control form-control-lg" placeholder="Cari resep..." required>
                        <button class="btn btn-light btn-lg" type="submit">
                            <i class="fas fa-search me-10"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Latest Recipes -->
<section class="my-5 animate-on-scroll">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold"><i class="fas fa-clock me-2 text-success"></i> Resep Terbaru</h2>
            <a href="<?php echo base_url('resep.php'); ?>" class="btn btn-outline-success">Lihat Semua</a>
        </div>
        
        <div class="row g-4">
            <?php 
            $resep_terbaru = getResepTerbaru(3);
            if (!empty($resep_terbaru)) {
                foreach ($resep_terbaru as $resep): 
            ?>
            <div class="col-md-4">
                <div class="card h-10">
                    <div class="position-relative">
                        <img src="<?php echo base_url('assets/images/' . ($resep['gambar'] ?: 'default-recipe.jpg')); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($resep['judul']); ?>">
                        <div class="badge bg-success position-absolute top-0 end-0 m-2">
                            <i class="fas fa-clock me-1"></i> <?php echo htmlspecialchars($resep['waktu_masak']); ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($resep['judul']); ?></h5>
                        <p class="card-text text-muted small">
                            <?php echo substr(htmlspecialchars($resep['deskripsi']), 0, 100); ?>...
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="<?php echo base_url('detail.php?id=' . $resep['id']); ?>" class="btn btn-success w-100">
                            <i class="fas fa-utensils me-2"></i> Lihat Resep
                        </a>
                    </div>
                </div>
            </div>
            <?php 
                endforeach;
            } else {
                echo '<div class="col-12"><div class="alert alert-info">Tidak ada resep tersedia</div></div>';
            }
            ?>
        </div>
    </div>
</section>

<!-- Featured Categories -->
<section class="mb-5 animate-on-scroll">
    <div class="container">
        <h2 class="fw-bold mb-4"><i class="fas fa-tags me-2 text-success"></i> Kategori Unggulan</h2>
        <div class="row g-3">
            <?php 
            $featured_categories = array_slice(getAllKategori(), 0, 6);
            if (!empty($featured_categories)) {
                foreach ($featured_categories as $kat): 
            ?>
            <div class="col-md-4 col-6">
                <a href="<?php echo base_url('resep.php?kategori=' . $kat['id']); ?>" class="text-decoration-none">
                    <div class="card category-card h-100 border-0 overflow-hidden">
                        <img src="<?php echo base_url('assets/gambar/' . strtolower($kat['nama_kategori']) . '.jpg'); ?>" class="card-img h-100" alt="<?php echo htmlspecialchars($kat['nama_kategori']); ?>" style="object-fit: cover; min-height: 150px;">
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="bg-dark bg-opacity-50 w-100 p-3 text-center">
                                <h5 class="text-white mb-0"><?php echo htmlspecialchars($kat['nama_kategori']); ?></h5>
                                <small class="text-white"><?php echo count(getResepByKategori($kat['id'])); ?> resep</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php 
                endforeach;
            } else {
                echo '<div class="col-12"><div class="alert alert-info">Tidak ada kategori tersedia</div></div>';
            }
            ?>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="py-5 bg-light animate-on-scroll">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <i class="fas fa-envelope-open-text fa-3x text-success mb-4"></i>
                <h2 class="fw-bold mb-3">Saran Resep Terbaru</h2>
                <p class="text-muted mb-4">Hubungi kami untuk mendapatkan resep terbaru setiap minggu langsung ke email Anda</p>
                <form class="row g-2 justify-content-center" action="<?php echo base_url('subscribe.php'); ?>" method="POST">
                    <div class="col-md-8">
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Email Anda" required>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success btn-lg w-100">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
