<?php
require_once 'functions.php';
$page_title = "Hasil Pencarian";
include 'includes/header.php';
include 'includes/navbar.php';

$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = [];

if (!empty($keyword)) {
    $results = searchResep($keyword);
}
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="animate-on-scroll">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hasil Pencarian</li>
        </ol>
    </div>
</nav>

<!-- Search Results -->
<section class="mb-5 animate-on-scroll">
    <div class="container">
        <h2 class="fw-bold mb-4">
            <i class="fas fa-search me-2 text-success"></i> 
            Hasil Pencarian untuk "<?php echo htmlspecialchars($keyword); ?>"
        </h2>
        
        <?php if (empty($keyword)): ?>
            <div class="alert alert-warning animate-on-scroll">
                <i class="fas fa-exclamation-circle me-2"></i> Silakan masukkan kata kunci pencarian.
            </div>
        <?php elseif (empty($results)): ?>
            <div class="alert alert-info animate-on-scroll">
                <i class="fas fa-info-circle me-2"></i> Tidak ditemukan resep dengan kata kunci tersebut.
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($results as $resep): ?>
                <div class="col-md-6 animate-on-scroll">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo base_url('assets/images/' . ($resep['gambar'] ?: 'default-recipe.jpg')); ?>" class="img-fluid rounded-start h-100" style="object-fit: cover;" alt="<?php echo htmlspecialchars($resep['judul']); ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($resep['judul']); ?></h5>
                                    <p class="card-text text-muted small"><?php echo substr(htmlspecialchars($resep['deskripsi']), 0, 150); ?>...</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            <span class="badge bg-light text-dark me-2">
                                                <i class="fas fa-clock me-1"></i> <?php echo htmlspecialchars($resep['waktu_masak']); ?>
                                            </span>
                                            <span class="badge bg-light text-dark">
                                                <i class="fas fa-fire me-1"></i> <?php echo htmlspecialchars($resep['tingkat_kesulitan']); ?>
                                            </span>
                                        </div>
                                        <a href="<?php echo base_url('detail.php?id=' . $resep['id']); ?>" class="btn btn-sm btn-success">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
include 'includes/footer.php';
?>