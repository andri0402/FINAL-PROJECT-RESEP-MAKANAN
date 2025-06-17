<?php
session_start();
require_once 'includes/functions.php';

if (!isset($_SESSION['user_logged_in'])) {
    header('Location: login.php');
    exit;
}

$page_title = "Dashboard Pengguna";
include 'includes/header.php';
?>

<div class="container py-4">
    <h1 class="mb-4">Selamat Datang di Dashboard Anda</h1>
    <p>Di sini Anda bisa melihat aktivitas terbaru, resep favorit, dan lainnya (bisa dikembangkan).</p>
</div>

<?php include 'includes/footer.php'; ?>
