<?php
require_once 'functions.php';
$page_title = "Kategori Resep Makanan";
include 'includes/header.php';
include 'includes/navbar.php';

$all_categories = getAllKategori();
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="animate-on-scroll">
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
      <li class="breadcrumb-item active" aria-current="page">Kategori</li>
    </ol>
  </div>
</nav>

<!-- Kategori Resep -->
<section class="py-5 animate-on-scroll">
  <div class="container">
    <h2 class="fw-bold text-center mb-4">
      <i class="fas fa-th-large me-2 text-success"></i> Semua Kategori
    </h2>
    <div class="row g-4">
      <?php foreach ($all_categories as $kat): ?>
        <div class="col-md-3 col-6">
          <a href="<?php echo base_url('resep.php?kategori=' . $kat['id']); ?>" class="text-decoration-none">
            <div class="card category-card h-100 border-0 shadow-sm overflow-hidden text-white">
              <img src="<?php echo kategori_image_path($kat['nama_kategori']); ?>"
                   class="card-img h-100"
                   alt="<?php echo htmlspecialchars($kat['nama_kategori']); ?>"
                   style="object-fit: cover; min-height: 150px;">
              <div class="card-img-overlay d-flex align-items-end p-2 bg-dark bg-opacity-50">
                <h5 class="text-white text-center w-100 mb-0">
                  <?php echo htmlspecialchars($kat['nama_kategori']); ?>
                </h5>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
