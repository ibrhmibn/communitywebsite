<?php
session_start();
$_SESSION = [];
session_destroy();

// Jika request AJAX, balas JSON
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode(["status" => "success", "message" => "Anda telah berhasil keluar dari Panel Admin."]);
    exit;
}

// Jika request biasa (klik link langsung), redirect ke halaman utama
header('Location: index.php');
exit;
?>