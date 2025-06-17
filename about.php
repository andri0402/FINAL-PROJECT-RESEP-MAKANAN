<?php
require_once 'functions.php';
$page_title = "Tentang Kami";
include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="animate-on-scroll">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
        </ol>
    </div>
</nav>

<!-- About Section -->
<section class="my-5 animate-on-scroll">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h1 class="fw-bold mb-4">Tentang ResepMakanan</h1>
                <p class="lead">Kami adalah platform berbagi resep masakan terbesar di Indonesia dengan ribuan resep dari berbagai daerah dan negara.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 animate-on-scroll">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-success text-white rounded-circle p-3 me-3">
                                <i class="fas fa-utensils fa-2x"></i>
                            </div>
                            <h3 class="mb-0">Visi Kami</h3>
                        </div>
                        <p>Menjadi platform berbagi resep terdepan yang menghubungkan pecinta masakan di seluruh Indonesia dan menyediakan resep berkualitas untuk semua kalangan.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 animate-on-scroll">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-success text-white rounded-circle p-3 me-3">
                                <i class="fas fa-heart fa-2x"></i>
                            </div>
                            <h3 class="mb-0">Misi Kami</h3>
                        </div>
                        <p>Menyediakan resep masakan yang mudah dipahami, terjangkau, dan dapat diakses oleh siapa saja. Kami berkomitmen untuk mempromosikan masakan tradisional Indonesia dan dunia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-5 bg-light animate-on-scroll">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Tim Kami</h2>
        <div class="row g-4">
            <div class="col-md-4 animate-on-scroll">
                <div class="card border-0 shadow-sm h-100">
                    <img src="<?php echo base_url('assets/images/team1.jpg'); ?>" class="card-img-top" alt="Team Member">
                    <div class="card-body text-center">
                        <h5 class="card-title">andri,. Skom.</h5>
                        <p class="text-muted">desainer UX/UI</p>
                        <div class="social-icons">
                            <a href="#" class="text-dark me-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-dark me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-dark"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 animate-on-scroll">
                <div class="card border-0 shadow-sm h-100">
                    <img src="<?php echo base_url('assets/images/team2.jpg'); ?>" class="card-img-top" alt="Team Member">
                    <div class="card-body text-center">
                        <h5 class="card-title">aditya,.Skom.</h5>
                        <p class="text-muted">desainer UX/UI</p>
                        <div class="social-icons">
                            <a href="#" class="text-dark me-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-dark me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-dark"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 animate-on-scroll">
                <div class="card border-0 shadow-sm h-100">
                    <img src="<?php echo base_url('assets/images/team3.jpg'); ?>" class="card-img-top" alt="Team Member">
                    <div class="card-body text-center">
                        <h5 class="card-title">sapoan,. Skom. dan lucky,. S.Skom.</h5>
                        <p class="text-muted">data base</p>
                        <div class="social-icons">
                            <a href="#" class="text-dark me-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-dark me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-dark"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 animate-on-scroll">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="display-4 fw-bold text-success">10+++</div>
                <p class="text-muted">Resep</p>
            </div>
            <div class="col-md-3">
                <div class="display-4 fw-bold text-success">5</div>
                <p class="text-muted">Kategori</p>
            </div>
            <div class="col-md-3">
                <div class="display-4 fw-bold text-success">4</div>
                <p class="text-muted">Pengguna</p>
            </div>
            <div class="col-md-3">
                <div class="display-4 fw-bold text-success">1 bulan</div>
                <p class="text-muted">Pengalaman</p>
            </div>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>