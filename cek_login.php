<?php
session_start();
header('Content-Type: application/json');

// Mengecek apakah ada stempel VIP
if (isset($_SESSION['status_login']) && $_SESSION['status_login'] == true) {
    // Jika ada, balas: BENAR, INI ADMIN
    echo json_encode(["is_admin" => true, "nama" => $_SESSION['admin_name']]);
} else {
    // Jika tidak ada, balas: BUKAN ADMIN
    echo json_encode(["is_admin" => false]);
}
?>