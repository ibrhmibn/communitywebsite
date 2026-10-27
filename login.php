<?php
session_start();

// Menangkap request AJAX dari JavaScript
if (isset($_POST['ajax_login'])) {
    header('Content-Type: application/json');
    include 'db.php';
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);

    $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username='$user' AND password='$pass'");
    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['status_login'] = true;
        $_SESSION['admin_name'] = $user;
        echo json_encode(['status' => 'success', 'message' => 'Login Berhasil! Mengalihkan...']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Username atau Password salah!']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Admin - HMPS KPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #0a0000;
        color: white;
    }

    .font-tech {
        font-family: 'Orbitron', sans-serif;
    }

    .custom-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        pointer-events: none;
        transition: 0.3s;
        backdrop-filter: blur(5px);
    }

    .custom-modal.active {
        opacity: 1;
        pointer-events: auto;
    }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen relative overflow-hidden">
    <div class="absolute inset-0 z-[-1] flex items-center justify-center">
        <div class="w-96 h-96 bg-red-900 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-pulse">
        </div>
    </div>

    <div
        class="bg-gray-900/80 p-8 rounded-2xl border border-red-500/30 w-full max-w-md shadow-[0_0_30px_rgba(220,38,38,0.2)] backdrop-blur-md">
        <div class="text-center mb-8">
            <i class="fas fa-user-shield text-5xl text-red-600 mb-4 drop-shadow-[0_0_15px_rgba(220,38,38,0.8)]"></i>
            <h2 class="text-3xl font-bold font-tech text-red-500 tracking-wider">ADMIN LOGIN</h2>
        </div>

        <form id="login-form" onsubmit="handleLogin(event)" class="space-y-5">
            <input type="text" name="username" placeholder="Username" required
                class="w-full bg-black/50 border border-gray-700 p-4 rounded-lg focus:outline-none focus:border-red-500 text-white transition">
            <input type="password" name="password" placeholder="Password" required
                class="w-full bg-black/50 border border-gray-700 p-4 rounded-lg focus:outline-none focus:border-red-500 text-white transition">

            <button type="submit" id="btn-login"
                class="w-full bg-red-700 hover:bg-red-600 py-4 rounded-lg font-bold tracking-widest transition shadow-[0_0_15px_rgba(220,38,38,0.4)]">
                <i class="fas fa-sign-in-alt mr-2"></i> MASUK
            </button>
        </form>
        <p class="text-center mt-6 text-gray-500 text-sm"><a href="index.php" class="hover:text-red-500 transition"><i
                    class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda</a></p>
    </div>

    <div id="notif-modal" class="custom-modal">
        <div id="notif-content"
            class="bg-gray-900 border border-gray-700 p-8 rounded-2xl shadow-2xl transform scale-90 transition-transform duration-300 text-center max-w-sm w-[90%]">
            <div id="notif-icon" class="text-6xl mb-4"></div>
            <h3 id="notif-title" class="text-2xl font-bold font-tech text-white mb-2 tracking-widest"></h3>
            <p id="notif-msg" class="text-gray-400 mb-6 text-sm"></p>
            <button onclick="closeNotif()" id="notif-btn"
                class="w-full py-3 rounded-lg font-bold transition uppercase tracking-widest"></button>
        </div>
    </div>

    <script>
    let redirectPath = null;

    function showModal(type, title, message, redirect = null) {
        const modal = document.getElementById('notif-modal');
        const content = document.getElementById('notif-content');
        const btn = document.getElementById('notif-btn');

        redirectPath = redirect;
        document.getElementById('notif-title').innerText = title;
        document.getElementById('notif-msg').innerText = message;

        if (type === 'success') {
            document.getElementById('notif-icon').innerHTML =
                '<i class="fas fa-check-circle text-green-500 drop-shadow-[0_0_15px_rgba(34,197,94,0.6)]"></i>';
            btn.className = 'w-full py-3 rounded-lg font-bold transition bg-green-600 hover:bg-green-500 text-white';
            btn.innerText = 'Lanjutkan';
        } else {
            document.getElementById('notif-icon').innerHTML =
                '<i class="fas fa-times-circle text-red-500 drop-shadow-[0_0_15px_rgba(239,68,68,0.6)]"></i>';
            btn.className = 'w-full py-3 rounded-lg font-bold transition bg-red-700 hover:bg-red-600 text-white';
            btn.innerText = 'Coba Lagi';
        }

        modal.classList.add('active');
        setTimeout(() => content.classList.replace('scale-90', 'scale-100'), 10);
    }

    function closeNotif() {
        document.getElementById('notif-content').classList.replace('scale-100', 'scale-90');
        setTimeout(() => {
            document.getElementById('notif-modal').classList.remove('active');
            if (redirectPath) window.location.href = redirectPath;
        }, 200);
    }

    async function handleLogin(e) {
        e.preventDefault();
        const btn = document.getElementById('btn-login');
        const formData = new FormData(e.target);
        formData.append('ajax_login', '1');

        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
        btn.disabled = true;

        try {
            const response = await fetch('login.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.status === 'success') showModal('success', 'BERHASIL', result.message, 'index.php');
            else showModal('error', 'GAGAL LOGIN', result.message);
        } catch (error) {
            showModal('error', 'SYSTEM ERROR', 'Koneksi ke server terputus.');
        } finally {
            btn.innerHTML = '<i class="fas fa-sign-in-alt mr-2"></i> MASUK';
            btn.disabled = false;
        }
    }
    </script>
</body>

</html>