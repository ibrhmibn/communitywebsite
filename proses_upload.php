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
// VALIDASI INPUT
// ==========================================
if (empty($_POST['judul']) || empty($_POST['id_event']) || !isset($_FILES['berkas'])) {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap."]);
    exit;
}

$judul    = trim($_POST['judul']);
$id_event = $_POST['id_event'];
$file     = $_FILES['berkas'];

// ==========================================
// CEK ERROR UPLOAD DARI PHP
// ==========================================
if ($file['error'] !== UPLOAD_ERR_OK) {
    $phpErrors = [
        UPLOAD_ERR_INI_SIZE   => 'File terlalu besar (server limit).',
        UPLOAD_ERR_FORM_SIZE  => 'File terlalu besar (form limit).',
        UPLOAD_ERR_PARTIAL    => 'Upload tidak lengkap.',
        UPLOAD_ERR_NO_FILE    => 'Tidak ada file yang dikirim.',
        UPLOAD_ERR_NO_TMP_DIR => 'Folder temp tidak ditemukan.',
        UPLOAD_ERR_CANT_WRITE => 'Gagal menulis ke disk.',
        UPLOAD_ERR_EXTENSION  => 'Upload dihentikan oleh ekstensi PHP.',
    ];
    $msg = $phpErrors[$file['error']] ?? 'Upload error tidak diketahui.';
    echo json_encode(["success" => false, "message" => $msg]);
    exit;
}

// ==========================================
// CEK UKURAN FILE (max 64MB)
// ==========================================
$maxSize = 64 * 1024 * 1024;
if ($file['size'] > $maxSize) {
    echo json_encode(["success" => false, "message" => "File terlalu besar (max 64MB)."]);
    exit;
}

// ==========================================
// VALIDASI EKSTENSI + MIME TYPE (bukan cuma ekstensi!)
// ==========================================
$ekstensi = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

$izin_gambar = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
$izin_video  = ['mp4', 'mov', 'avi', 'mkv', 'webm'];
$semua_izin  = array_merge($izin_gambar, $izin_video);

if (!in_array($ekstensi, $semua_izin, true)) {
    echo json_encode(["success" => false, "message" => "Format file '$ekstensi' tidak diizinkan."]);
    exit;
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime  = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

$allowedMime = [
    'image/jpeg', 'image/png', 'image/webp', 'image/gif',
    'video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/webm',
];

if (!in_array($mime, $allowedMime, true)) {
    echo json_encode(["success" => false, "message" => "Tipe file tidak valid (MIME: $mime)."]);
    exit;
}

// ==========================================
// TENTUKAN TIPE & RASIO
// ==========================================
$tipe  = in_array($ekstensi, $izin_video, true) ? 'video' : 'image';
$rasio = ($tipe === 'video') ? 'aspect-[9/16]' : 'aspect-video';

// ==========================================
// FOLDER MAP (udah disamain sama eventsList)
// ==========================================
$folder_map = [
    'E01' => 'mubes',
    'E02' => 'osmajur',
    'E03' => 'lainnya',
    'E04' => 'poster',
];
$folder     = $folder_map[$id_event] ?? 'lainnya';
$target_dir = "assets/" . $folder . "/";

if (!is_dir($target_dir)) {
    echo json_encode(["success" => false, "message" => "Folder tujuan tidak ditemukan. Pastikan folder $target_dir sudah dibuat."]);
    exit;
}

// ==========================================
// SIMPAN FILE (nama unik)
// ==========================================
$nama_baru    = time() . "_" . bin2hex(random_bytes(4)) . "." . $ekstensi;
$jalur_simpan = $target_dir . $nama_baru;

if (!move_uploaded_file($file['tmp_name'], $jalur_simpan)) {
    echo json_encode(["success" => false, "message" => "Gagal memindahkan file ke server."]);
    exit;
}

// ==========================================
// INSERT DB (prepared statement)
// ==========================================
$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO tb_galeri (tipe, src_file, judul_foto, rasio, id_event) VALUES (?, ?, ?, ?, ?)"
);
mysqli_stmt_bind_param($stmt, 'sssss', $tipe, $jalur_simpan, $judul, $rasio, $id_event);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    echo json_encode(["success" => true, "message" => "Berhasil diunggah ke $folder!"]);
} else {
    mysqli_stmt_close($stmt);
    // Rollback: hapus file yang udah kepindah
    if (file_exists($jalur_simpan)) @unlink($jalur_simpan);
    echo json_encode(["success" => false, "message" => "Gagal mencatat di database: " . mysqli_error($conn)]);
}