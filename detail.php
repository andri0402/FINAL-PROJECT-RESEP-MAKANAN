<?php
require_once 'functions.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ' . base_url());
    exit;
}

$resep_id = (int)$_GET['id'];
$resep = getResepById($resep_id);

if (!$resep) {
    header('Location: ' . base_url());
    exit;
}

$page_title = $resep['judul'] . ' - Resep Makanan';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">
    <div class="row animate-on-scroll">
        <div class="col-md-8">
            <!-- Recipe Title and Image -->
            <div class="mb-4">
                <h1 class="fw-bold mb-3"><?php echo htmlspecialchars($resep['judul']); ?></h1>
                <div class="recipe-image">
                    <img src="<?php echo base_url('assets/images/' . ($resep['gambar'] ?: 'default-recipe.jpg')); ?>" class="img-fluid rounded-3 w-100" alt="<?php echo htmlspecialchars($resep['judul']); ?>">
                </div>
            </div>
            
            <!-- Recipe Meta -->
            <div class="row mb-4 g-3">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-2x text-success mb-3"></i>
                            <h5 class="card-title">Waktu Masak</h5>
                            <p class="card-text"><?php echo htmlspecialchars($resep['waktu_masak']); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-utensils fa-2x text-success mb-3"></i>
                            <h5 class="card-title">Porsi</h5>
                            <p class="card-text"><?php echo htmlspecialchars($resep['porsi']); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-tachometer-alt fa-2x text-success mb-3"></i>
                            <h5 class="card-title">Kesulitan</h5>
                            <p class="card-text"><?php echo htmlspecialchars($resep['tingkat_kesulitan']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recipe Description -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-align-left me-2"></i> Deskripsi</h5>
                </div>
                <div class="card-body">
                    <p><?php echo nl2br(htmlspecialchars($resep['deskripsi'])); ?></p>
                </div>
            </div>
            
            <!-- Ingredients -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-basket me-2"></i> Bahan-bahan</h5>
                </div>
                <div class="card-body">
                    <ul class="ingredients-list">
                        <?php 
                        $bahan_list = explode("\n", $resep['bahan']);
                        foreach ($bahan_list as $bahan): 
                            if (!empty(trim($bahan))):
                        ?>
                        <li><?php echo htmlspecialchars(trim($bahan)); ?></li>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </ul>
                </div>
            </div>
            
            <!-- Steps -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-list-ol me-2"></i> Langkah-langkah</h5>
                </div>
                <div class="card-body">
                    <ol class="steps-list">
                        <?php 
                        $langkah_list = explode("\n", $resep['langkah']);
                        foreach ($langkah_list as $langkah): 
                            if (!empty(trim($langkah))):
                        ?>
                        <li><?php echo htmlspecialchars(trim($langkah)); ?></li>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </ol>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Recipe Info -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i> Informasi Resep</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-tag me-2 text-success"></i> Kategori</span>
                            <span class="badge bg-success"><?php echo htmlspecialchars($resep['nama_kategori']); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                       <span><i class="fas fa-calendar me-2 text-success"></i> Tanggal Posting</span>
                            <span><?php echo date('d M Y', strtotime($resep['tanggal_post'])); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Other Recipes -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-utensils me-2"></i> Resep Lainnya</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <?php 
                        $resep_lain = getResepTerbaru(5);
                        foreach ($resep_lain as $rl): 
                            if ($rl['id'] != $resep_id):
                        ?>
                        <a href="<?php echo base_url('detail.php?id=' . $rl['id']); ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?php echo htmlspecialchars($rl['judul']); ?></h6>
                                <small><?php echo htmlspecialchars($rl['waktu_masak']); ?></small>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-fire me-1"></i> <?php echo htmlspecialchars($rl['tingkat_kesulitan']); ?>
                            </small>
                        </a>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                </div>
            </div>
            
            <!-- Share Recipe -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-share-alt me-2"></i> Bagikan Resep</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="tooltip" title="Bagikan ke Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-info btn-sm me-2" data-bs-toggle="tooltip" title="Bagikan ke Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm me-2" data-bs-toggle="tooltip" title="Bagikan ke Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" title="Bagikan via WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Recipes -->
<section class="py-5 bg-light">
    <div class="container animate-on-scroll">
        <h2 class="fw-bold text-center mb-5"><i class="fas fa-utensils me-2 text-success"></i> Resep Serupa</h2>
        <div class="row g-4">
            <?php 
            $resep_serupa = getResepByKategori($resep['kategori_id']);
            $count = 0;
            foreach ($resep_serupa as $rs): 
                if ($rs['id'] != $resep_id && $count < 4):
                    $count++;
            ?>
            <div class="col-md-3">
                <div class="card h-100">
                    <img src="<?php echo base_url('assets/images/' . ($rs['gambar'] ?: 'default-recipe.jpg')); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($rs['judul']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($rs['judul']); ?></h5>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-fire me-1"></i> <?php echo htmlspecialchars($rs['tingkat_kesulitan']); ?>
                            </span>
                            <a href="<?php echo base_url('detail.php?id=' . $rs['id']); ?>" class="btn btn-sm btn-success">
                                <i class="fas fa-eye me-1"></i> Lihat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                endif;
            endforeach; 
            ?>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>