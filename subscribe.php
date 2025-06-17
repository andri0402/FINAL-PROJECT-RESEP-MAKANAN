<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Simpan ke database
        $conn = connectDB();
        $stmt = $conn->prepare("INSERT INTO subscribers (email, created_at) VALUES (?, NOW())");
        $stmt->bind_param("s", $email);
        
        if ($stmt->execute()) {
            header('Location: index.php?subscribe=success');
        } else {
            header('Location: index.php?subscribe=error');
        }
        exit;
    }
}

header('Location: index.php');