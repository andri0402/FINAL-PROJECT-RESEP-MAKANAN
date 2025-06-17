<?php
require_once 'functions.php';
$page_title = "Kontak Kami";

include 'includes/header.php';
include 'includes/navbar.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if (empty($name) || empty($email) || empty($message)) {
        $error_message = 'Semua field harus diisi!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Email tidak valid!';
    } else {
        $conn = connectDB();
        $stmt = $conn->prepare("INSERT INTO contact_messages (nama, email, phone, pesan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        if ($stmt->execute()) {
            $success_message = 'Pesan Anda telah berhasil dikirim!';
            $name = $email = $phone = $message = ''; // Reset form
        } else {
            $error_message = 'Terjadi kesalahan saat mengirim pesan.';
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!-- Konten Kontak -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
<style>
    .contact-container {
        max-width: 600px;
        margin: 60px auto;
        background-color: #fff;
        padding: 40px 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .contact-container h1 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 2rem;
        color: #28a745;
    }

    .contact-form .form-group {
        margin-bottom: 20px;
    }

    .contact-form label {
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
        color: #333;
    }

    .contact-form input[type="text"],
    .contact-form input[type="email"],
    .contact-form textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #ddd;
        border-radius: 10px;
        font-size: 14px;
        transition: 0.3s;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
    }

    .contact-form input:focus,
    .contact-form textarea:focus {
        border-color: #28a745;
        box-shadow: 0 0 8px rgba(40, 167, 69, 0.2);
        outline: none;
    }

    .contact-form textarea {
        resize: vertical;
        min-height: 120px;
    }

    .contact-form button {
        width: 100%;
        padding: 14px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .contact-form button:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }

    .alert-success, .alert-error {
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 5px solid #28a745;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 5px solid #dc3545;
    }
</style>

<div class="contact-container" data-aos="fade-up">
    <h1 data-aos="fade-down"><i class="fas fa-envelope"></i> Kontak Kami</h1>

    <?php if ($success_message): ?>
        <div class="alert-success" data-aos="zoom-in"><i class="fas fa-check-circle"></i> <?= $success_message ?></div>
    <?php elseif ($error_message): ?>
        <div class="alert-error" data-aos="zoom-in"><i class="fas fa-times-circle"></i> <?= $error_message ?></div>
    <?php endif; ?>

    <form method="post" action="" class="contact-form" data-aos="fade-up">
        <div class="form-group">
            <label for="name"><i class="fas fa-user"></i> Nama</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($name ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="email"><i class="fas fa-envelope-open-text"></i> Email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($email ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="phone"><i class="fas fa-phone"></i> Nomor Telepon (opsional)</label>
            <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($phone ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="message"><i class="fas fa-comment-dots"></i> Pesan</label>
            <textarea name="message" id="message" required><?= htmlspecialchars($message ?? '') ?></textarea>
        </div>

        <button type="submit"><i class="fas fa-paper-plane"></i> Kirim</button>
    </form>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true });
</script>

<?php include 'includes/footer.php'; ?>
