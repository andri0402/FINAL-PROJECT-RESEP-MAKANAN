<?php
require_once 'functions.php';
$page_title = "Daftar Resep Makanan";
include 'includes/header.php';
include 'includes/navbar.php';

$kategori_id = isset($_GET['kategori']) ? (int)$_GET['kategori'] : 0;
$kategori_nama = 'Semua Resep';

if ($kategori_id > 0) {
    $resep_list = getResepByKategori($kategori_id);
    $kategori = getAllKategori();
    foreach ($kategori as $kat) {
        if ($kat['id'] == $kategori_id) {
            $kategori_nama = $kat['nama_kategori'];
            break;
        }
    }
} else {
    $resep_list = getResepTerbaru(12);
}
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="animate-on-scroll">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($kategori_nama); ?></li>
        </ol>
    </div>
</nav>

<!-- Recipe List -->
<section class="mb-5 animate-on-scroll">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold"><i class="fas fa-utensils me-2 text-success"></i> <?php echo htmlspecialchars($kategori_nama); ?></h2>
            <div class="dropdown">
                <button class="btn btn-outline-success dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-sort me-1"></i> Urutkan
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                    <li><a class="dropdown-item" href="?sort=terbaru">Terbaru</a></li>
                    <li><a class="dropdown-item" href="?sort=populer">Populer</a></li>
                    <li><a class="dropdown-item" href="?sort=mudah">Termudah</a></li>
                </ul>
            </div>
        </div>

        <?php if (empty($resep_list)): ?>
            <div class="alert alert-info animate-on-scroll">
                <i class="fas fa-info-circle me-2"></i> Belum ada resep untuk kategori ini.
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($resep_list as $resep): ?>
                <div class="col-md-4 col-lg-3 animate-on-scroll">
                    <div class="card h-100">
                        <div class="position-relative overflow-hidden">
                            <img src="<?php echo base_url('assets/images/' . ($resep['gambar'] ?: 'default-recipe.jpg')); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($resep['judul']); ?>">
                            <div class="badge bg-success position-absolute top-0 end-0 m-2">
                                <i class="fas fa-clock me-1"></i> <?php echo htmlspecialchars($resep['waktu_masak']); ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($resep['judul']); ?></h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-fire me-1"></i> <?php echo htmlspecialchars($resep['tingkat_kesulitan']); ?>
                                </span>
                                <a href="<?php echo base_url('detail.php?id=' . $resep['id']); ?>" class="btn btn-sm btn-success">
                                    <i class="fas fa-eye me-1"></i> Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4 animate-on-scroll">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Selanjutnya</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 bg-light animate-on-scroll">
    <div class="container">
        <h2 class="fw-bold text-center mb-5"><i class="fas fa-tags me-2 text-success"></i> Jelajahi Kategori</h2>
        <div class="row g-3">
            <?php 
            $all_categories = getAllKategori();
            foreach ($all_categories as $kat): 
            ?>
            <div class="col-md-2 col-4">
                <a href="<?php echo base_url('resep.php?kategori=' . $kat['id']); ?>" class="text-decoration-none">
                    <div class="card category-card h-100 border-0 overflow-hidden">
                        <img src="<?php echo base_url('assets/images/category-' . strtolower($kat['nama_kategori']) . '.jpg'); ?>" class="card-img h-100" alt="<?php echo htmlspecialchars($kat['nama_kategori']); ?>" style="object-fit: cover; min-height: 100px;">
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="bg-dark bg-opacity-50 w-100 p-2 text-center">
                                <h6 class="text-white mb-0"><?php echo htmlspecialchars($kat['nama_kategori']); ?></h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>