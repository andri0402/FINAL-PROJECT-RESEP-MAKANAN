<?php
require_once 'config/database.php';
$conn = connectDB(); // Inisialisasi koneksi global

function connectDB() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "db_resep_makanan";

    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    return $conn;
}

function base_url($path = '') {
    return 'http://localhost/resep-makanan/' . ltrim($path, '/');
}


function getResepTerbaru($limit = 5) {
    global $conn;
    $query = "SELECT * FROM resep ORDER BY tanggal_post DESC LIMIT ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getResepByKategori($kategori_id) {
    global $conn;
    $query = "SELECT * FROM resep WHERE kategori_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $kategori_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getResepById($id) {
    global $conn;
    $query = "SELECT resep.*, kategori.nama_kategori 
              FROM resep 
              JOIN kategori ON resep.kategori_id = kategori.id 
              WHERE resep.id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function getAllKategori() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM kategori ORDER BY id DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function searchResep($keyword) {
    global $conn;
    $keyword = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM resep WHERE judul LIKE ? OR deskripsi LIKE ?";
    $stmt = mysqli_prepare($conn, $query);
    $search_term = "%$keyword%";
    mysqli_stmt_bind_param($stmt, 'ss', $search_term, $search_term);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function isAdminLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function isUserLoggedIn() {
    return isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
}

function kategori_image_path($nama_kategori) {
    $nama_file = strtolower(str_replace(' ', '_', $nama_kategori)) . '.jpg';
    $path = 'assets/images/kategori/' . $nama_file;

    if (file_exists(__DIR__ . '/' . $path)) {
        return base_url($path);
    } else {
        return base_url('assets/images/kategori/default-kategori.jpg');
    }
}

function addKategori($nama_kategori) {
    global $conn;
    $query = "INSERT INTO kategori (nama_kategori) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $nama_kategori);
        return mysqli_stmt_execute($stmt);
    }
    return false;
}

function deleteKategori($kategori_id) {
    global $conn;
    $query = "DELETE FROM kategori WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $kategori_id);
    return mysqli_stmt_execute($stmt);
}

function updateKategori($id, $nama_kategori) {
    global $conn;
    $query = "UPDATE kategori SET nama_kategori = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'si', $nama_kategori, $id);
    return mysqli_stmt_execute($stmt);
}

function getAllResep() {
    global $conn;
    $query = "SELECT resep.*, kategori.nama_kategori FROM resep 
              JOIN kategori ON resep.kategori_id = kategori.id 
              ORDER BY tanggal_post DESC";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
