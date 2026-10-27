<?php
session_start();
header('Content-Type: application/json');
include 'db.php';

// ==========================================
// AUTH CHECK
// ==========================================
if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] != true) {
    echo json_encode(["success" => false, "message" => "Akses ditolak!"]);
    exit;
}

// ==========================================
// AMBIL ID (bulk atau single)
// ==========================================
$inputJSON = file_get_contents('php://input');
$input     = json_decode($inputJSON, true);

$ids = [];
if (isset($input['ids']) && is_array($input['ids'])) {
    $ids = $input['ids'];
} elseif (isset($_GET['id'])) {
    $ids = [$_GET['id']];
}

$ids = array_values(array_filter(array_map('trim', $ids), fn($v) => $v !== ''));

if (empty($ids)) {
    echo json_encode(["success" => false, "message" => "Tidak ada file yang dipilih."]);
    exit;
}

// ==========================================
// BASE PATH BUAT VALIDASI (anti path traversal)
// ==========================================
$basePath = realpath('assets');
if ($basePath === false) {
    echo json_encode(["success" => false, "message" => "Folder assets tidak ditemukan."]);
    exit;
}

$sukses = 0;
$gagal  = 0;

// Prepared statement reused
$selStmt = mysqli_prepare($conn, "SELECT src_file FROM tb_galeri WHERE id_foto = ?");
$delStmt = mysqli_prepare($conn, "DELETE FROM tb_galeri WHERE id_foto = ?");

foreach ($ids as $id) {
    // SELECT
    mysqli_stmt_bind_param($selStmt, 's', $id);
    mysqli_stmt_execute($selStmt);
    $result = mysqli_stmt_get_result($selStmt);
    $data   = mysqli_fetch_assoc($result);

    if (!$data) {
        $gagal++;
        continue;
    }

    $jalur_file = $data['src_file'];

    // Validasi path: harus di dalam assets/ dan file-nya exist
    $realPath = realpath($jalur_file);
    $isSafe   = $realPath !== false
                && strpos($realPath, $basePath . DIRECTORY_SEPARATOR) === 0
                && is_file($realPath);

    if ($isSafe) {
        @unlink($realPath);
    }

    // DELETE dari DB
    mysqli_stmt_bind_param($delStmt, 's', $id);
    if (mysqli_stmt_execute($delStmt)) $sukses++;
    else $gagal++;
}

mysqli_stmt_close($selStmt);
mysqli_stmt_close($delStmt);

echo json_encode([
    "success" => $sukses > 0,
    "message" => "Selesai! $sukses berhasil dihapus" . ($gagal > 0 ? ", $gagal gagal." : "."),
]);