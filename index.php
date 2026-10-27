<?php
require 'db.php';
// Mengambil data galeri langsung untuk menghindari blokir keamanan hosting
$query = "SELECT id_foto as id, tipe as type, src_file as src, judul_foto as title, rasio as ratio, id_event as event FROM tb_galeri";
$result = mysqli_query($conn, $query);
$dataFiles = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dataFiles[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="google-site-verification" content="pz72A_SOUbG4L7dPVTVI81N2NCn6mhxR7WBHsYVQMho" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMPS KPI Official - UIN AMSARI</title>
    <meta name="description" content="Website Resmi HMPS KPI Angkatan 2026 UIN AMSARI.">
    <meta name="keywords"
        content="HMPS KPI, UIN Kyai Ageng Muhammad Besari, HMPS KPI Angkatan 2026, FUAD, Mahasiswa Ponorogo">
    <meta name="theme-color" content="#000000">

    <meta property="og:site_name" content="HMPS KPI Official - UIN AMSARI">
    <meta property="og:type" content="website">
    <meta property="og:title" content="HMPS KPI Official - UIN AMSARI">
    <meta property="og:description" content="Website Resmi Keluarga Besar HMPS KPI 2026">
    <meta property="og:image" content="kpi.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="HMPS KPI Official - UIN AMSARI">
    <meta name="twitter:description" content="Website Resmi Keluarga Besar HMPS KPI 2026">
    <meta name="twitter:image" content="kpi.jpg">
    <meta itemprop="image" content="kpi.jpg">

    <script type="application/ld+json">
    [{
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "HMPS KPI Official",
            "url": "https://hmpskpi-official.com",
            "logo": "tmpk.jpeg",
            "sameAs": [
                "https://www.instagram.com/n/"
            ]
        },
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "HMPS KPI Official - UIN AMSARI",
            "alternateName": ["HMPS KPI 2026", "HMPS KPI PONOROGO"]
        }
    ]
    </script>

    <link rel="icon" type="image/jpeg" href="assets/iconweb/tempk.webp">
    <link rel="shortcut icon" type="image/jpeg" href="assets/iconweb/tempk.webp">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">

    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'crimson-dark': '#1a0505',
                    'crimson-main': '#8a0000',
                    'crimson-light': '#ff1f1f',
                    'glass': 'rgba(255, 255, 255, 0.05)',
                },
                fontFamily: {
                    'tech': ['Orbitron', 'sans-serif'],
                    'body': ['Poppins', 'sans-serif'],
                },
                animation: {
                    'float': 'float 6s ease-in-out infinite',
                },
                keyframes: {
                    float: {
                        '0%, 100%': {
                            transform: 'translateY(0)'
                        },
                        '50%': {
                            transform: 'translateY(-10px)'
                        },
                    }
                }
            }
        }
    }
    </script>

    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="font-body selection:bg-red-500 selection:text-white">
    <div id="admin-controls" class="hidden fixed bottom-6 right-6 z-[9999] flex-col gap-3">
        <button onclick="openUploadModal()"
            class="bg-red-600 text-white w-14 h-14 rounded-full shadow-[0_0_20px_rgba(220,38,38,0.6)] hover:scale-110 hover:bg-red-500 transition-all flex items-center justify-center group relative cursor-pointer outline-none border-none">
            <i class="fas fa-plus text-2xl"></i>
            <span
                class="absolute right-16 bg-black border border-red-500/50 text-white text-xs px-3 py-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap font-tech tracking-wider pointer-events-none">Upload
                Arsip Baru</span>
        </button>
        <button onclick="handleLogout()"
            class="bg-gray-800 text-white w-14 h-14 rounded-full shadow-[0_0_15px_rgba(0,0,0,0.8)] border border-gray-600 hover:scale-110 hover:border-red-500 hover:text-red-500 transition-all flex items-center justify-center group relative cursor-pointer outline-none">
            <i class="fas fa-power-off text-xl"></i>
            <span
                class="absolute right-16 bg-black border border-gray-600 text-white text-xs px-3 py-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap font-tech pointer-events-none">Keluar
                (Logout)</span>
        </button>
    </div>

    <audio id="bg-music" loop>
        <source src="assets/music/multo.mp3" type="audio/mpeg">
    </audio>

    <div id="intro-screen">
        <div class="text-center">
            <h1 class="font-tech text-4xl md:text-7xl font-bold text-white mb-4 tracking-widest neon-text">
                HMPS <span id="typing-text" class="text-red-500 typing-cursor"></span>
            </h1>
            <p class="text-gray-400 text-sm md:text-lg mb-8 font-light tracking-[0.3em]">2026 | THE GOLDEN ERA</p>
            <button onclick="enterSite()"
                class="group relative px-8 py-3 bg-transparent overflow-hidden rounded-full border border-red-600 transition-all hover:shadow-[0_0_20px_rgba(255,0,0,0.5)]">
                <span
                    class="relative z-10 text-white font-tech tracking-wider group-hover:text-black transition-colors duration-300">VISIT</span>
                <div
                    class="absolute inset-0 h-full w-full scale-0 rounded-full transition-all duration-300 group-hover:scale-100 group-hover:bg-red-600">
                </div>
            </button>
        </div>
    </div>

    <div id="main-app" class="hidden opacity-0 transition-opacity duration-1000 min-h-screen flex flex-col">

        <nav class="fixed top-0 w-full z-50 glass-panel border-b border-red-900/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex-shrink-0">
                        <span class="font-tech text-2xl font-bold text-red-500 tracking-tighter">HMPS <span
                                class="text-white">KPI</span></span>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-8">
                            <button onclick="switchTab('home')"
                                class="nav-btn text-white border-b-2 border-red-500 hover:text-red-400 px-1 py-2 text-sm font-medium transition-all duration-300">Home</button>
                            <button onclick="switchTab('structure')"
                                class="nav-btn text-gray-300 border-b-2 border-transparent hover:text-red-400 px-1 py-2 text-sm font-medium transition-all duration-300">Structure</button>
                            <button onclick="switchTab('documentation')"
                                class="nav-btn text-gray-300 border-b-2 border-transparent hover:text-red-400 px-1 py-2 text-sm font-medium transition-all duration-300">Documentation</button>
                            <button onclick="switchTab('pendaftaran')"
                                class="nav-btn text-gray-300 border-b-2 border-transparent hover:text-red-400 px-1 py-2 text-sm font-medium transition-all duration-300">Pendaftaran</button>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <button onclick="toggleMusic()" id="music-btn"
                            class="w-8 h-8 rounded-full bg-red-900/50 flex items-center justify-center text-red-400 border border-red-500/30 hover:bg-red-600 hover:text-white transition-all music-pulse">
                            <i class="fas fa-music"></i>
                        </button>
                        <div class="relative group py-2">
                            <button id="user-btn"
                                class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 border border-gray-700 hover:border-red-500 hover:text-red-500 transition-all focus:outline-none">
                                <i class="fas fa-user-circle text-xl"></i>
                            </button>
                            <div id="user-dropdown"
                                class="absolute right-0 mt-2 w-48 bg-gray-900 border border-red-500/30 rounded-lg shadow-[0_10px_25px_rgba(0,0,0,0.5)] py-2 transition-all duration-300 opacity-0 invisible group-hover:opacity-100 group-hover:visible z-[999]">
                                <a href="login.php" id="nav-login-btn"
                                    class="flex items-center gap-3 px-4 py-3 text-sm text-gray-300 hover:bg-red-900/20 hover:text-white transition">
                                    <i class="fas fa-sign-in-alt text-red-500"></i> Login Admin
                                </a>
                                <button onclick="openUploadModal()" id="nav-upload-btn"
                                    class="hidden w-full text-left flex items-center gap-3 px-4 py-3 text-sm text-gray-300 hover:bg-red-900/20 hover:text-white transition">
                                    <i class="fas fa-upload text-red-500"></i> Upload Arsip
                                </button>
                                <button onclick="handleLogout()" id="nav-logout-btn"
                                    class="hidden w-full text-left flex items-center gap-3 px-4 py-3 text-sm text-red-400 hover:bg-red-900/20 transition border-t border-gray-800">
                                    <i class="fas fa-power-off mr-1"></i> Logout
                                </button>
                            </div>
                        </div>
                        <div class="md:hidden">
                            <button onclick="toggleMobileMenu()" class="text-gray-300 hover:text-white p-2">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="mobile-menu" class="hidden md:hidden glass-panel border-t border-red-900/30">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <button onclick="switchTab('home')"
                        class="mobile-nav-btn text-red-500 bg-red-900/20 border-l-4 border-red-500 block px-3 py-2 rounded-r-md text-base font-medium w-full text-left transition-all duration-300">Home</button>
                    <button onclick="switchTab('structure')"
                        class="mobile-nav-btn text-gray-300 border-l-4 border-transparent hover:text-red-400 block px-3 py-2 rounded-r-md text-base font-medium w-full text-left transition-all duration-300">Structure</button>
                    <button onclick="switchTab('documentation')"
                        class="mobile-nav-btn text-gray-300 border-l-4 border-transparent hover:text-red-400 block px-3 py-2 rounded-r-md text-base font-medium w-full text-left transition-all duration-300">Documentation</button>
                    <button onclick="switchTab('pendaftaran')"
                        class="mobile-nav-btn text-gray-300 border-l-4 border-transparent hover:text-red-400 block px-3 py-2 rounded-r-md text-base font-medium w-full text-left transition-all duration-300">Pendaftaran</button>
                </div>
            </div>
        </nav>

        <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-b from-black via-[#1a0000] to-black opacity-80"></div>
            <div
                class="hidden md:block absolute top-[-10%] left-[-10%] w-96 h-96 bg-red-900 rounded-full filter blur-[100px] opacity-20">
            </div>
            <div
                class="hidden md:block absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-red-800 rounded-full filter blur-[100px] opacity-20">
            </div>
        </div>

        <main class="flex-grow pt-20 px-4 md:px-8 max-w-7xl mx-auto w-full">

            <section id="home" class="active-section py-10">
                <div class="grid md:grid-cols-2 gap-10 items-center">
                    <div class="space-y-6 text-center md:text-left">
                        <div class="md:hidden mb-4 flex justify-center">
                            <img src="logo.jpg" alt="Class Logo Mobile"
                                class="w-30 h-30 object-contain filter drop-shadow-[0_0_10px_rgba(220,38,38,0.5)]"
                                onerror="this.style.display='none'">
                        </div>

                        <h2 class="text-5xl md:text-6xl font-bold font-tech leading-tight">
                            WELCOME TO <br>
                            <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-orange-600">OFFICIAL
                                <br> HMPS KPI WEBSITE</span>
                        </h2>
                        <p class="text-gray-400 leading-relaxed text-lg">
                            "Dunia penyiaran terus berubah, jadilah sarjana komunikasi yang adaptif dan tahan banting
                            untuk menghadapi tantangan global. Bersama HMPS KPI, kita akan menjelajahi inovasi,
                            memperkuat solidaritas, dan membangun masa depan yang cerah dalam dunia komunikasi."
                        </p>
                        <div class="flex gap-4 pt-4 justify-center md:justify-start">
                            <button onclick="switchTab('documentation')"
                                class="px-6 py-3 bg-red-700 hover:bg-red-600 rounded-lg text-white font-semibold transition-all shadow-[0_0_15px_rgba(220,38,38,0.5)]">
                                Let's Go !!!
                            </button>
                            <button onclick="switchTab('structure')"
                                class="px-6 py-3 border border-gray-600 hover:border-red-500 hover:text-red-400 rounded-lg text-gray-300 font-semibold transition-all">
                                Mahasiswa
                            </button>
                        </div>

                        <div class="grid grid-cols-3 gap-4 pt-8 border-t border-gray-800">
                            <div>
                                <h3 class="text-2xl font-bold text-white">24</h3>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Mahasiswa</p>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white">9</h3>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Laki-laki</p>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white">15</h3>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Perempuan</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative animate-float hidden md:block">
                        <div class="flex justify-center mb-6">
                            <img src="https://i.postimg.cc/x8L0g9Bd/atmaaruthala.jpg" alt="Class Logo"
                                class="w-32 h-32 rounded-full object-cover shadow-2xl shadow-red-900/50 filter drop-shadow-[0_0_15px_rgba(220,38,38,0.6)] hover:scale-110 transition-transform duration-300 border-2 border-red-500/30"
                                onerror="this.onerror=null; this.src='https://cdn-icons-png.flaticon.com/512/2997/2997322.png';">
                        </div>
                        <div
                            class="glass-panel p-8 rounded-2xl transform rotate-3 hover:rotate-0 transition-all duration-500 border border-red-500/20">
                            <div class="flex items-center gap-4 mb-6">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-red-500 to-black flex items-center justify-center">
                                    <i class="fas fa-quote-left text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Motto HMPS KPI 2026</h4>
                                    <p class="text-xs text-red-400">Since 2026</p>
                                </div>
                            </div>
                            <blockquote class="text-xl font-light italic text-gray-300 mb-6">
                                "Dakwah Cerdas, Media Berkualitas."
                            </blockquote>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span>HMPS KPI 2026 Family</span>
                                <i class="fas fa-fingerprint text-red-500 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-24 pt-16 border-t border-red-900/30">
                    <div class="text-center mb-12 md:mb-16">
                        <h2 class="text-3xl md:text-5xl font-tech font-bold text-white mb-3 uppercase tracking-wider">
                            Kabar <span class="text-red-500">Terkini</span></h2>
                        <div
                            class="h-1 w-24 bg-red-600 mx-auto rounded-full mb-4 shadow-[0_0_10px_rgba(220,38,38,0.8)]">
                        </div>
                        <p class="text-gray-400 text-sm md:text-base">Informasi, Berita, dan Karya Terbaru dari HMPS KPI
                        </p>
                    </div>

                    <div id="news-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    </div>

                    <div id="news-btn-container" class="mt-12 text-center" style="display: none;">
                        <button onclick="toggleNews()"
                            class="group relative px-8 py-3 bg-transparent overflow-hidden rounded-xl border border-red-600 transition-all hover:shadow-[0_0_20px_rgba(220,38,38,0.4)]">
                            <span id="btn-news-text"
                                class="relative z-10 text-white font-tech tracking-wider transition-colors duration-300">Lihat
                                Semua Artikel</span>
                            <i id="btn-news-icon"
                                class="fas fa-angle-double-right ml-2 relative z-10 text-red-500 group-hover:text-white transition-transform"></i>
                            <div
                                class="absolute inset-0 h-full w-full scale-0 rounded-xl transition-all duration-300 group-hover:scale-100 group-hover:bg-red-600">
                            </div>
                        </button>
                    </div>

                    <div class="mt-20 pt-10 border-t border-gray-800">
                        <div class="flex justify-between items-end mb-6">
                            <div>
                                <h3 class="text-2xl font-tech font-bold text-white border-l-4 border-red-600 pl-4">
                                    Poster
                                    <span class="text-red-500">Pemberitahuan</span>
                                </h3>
                                <p class="text-gray-400 text-xs mt-2 pl-5">Karya visual pemberitahuan dan events yang
                                    akan diselenggarakan.
                                </p>
                            </div>
                            <button
                                onclick="switchTab('documentation'); setTimeout(()=>openEventFolder('E04', 'POSTER PEMBERITAHUAN'), 100);"
                                class="text-xs font-bold text-red-500 hover:text-white transition-colors hidden md:block uppercase tracking-wider">
                                Lihat Semua Album <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>

                        <div id="home-poster-carousel"
                            class="flex overflow-x-auto gap-4 pb-6 snap-x cursor-grab [&::-webkit-scrollbar]:hidden"
                            style="scrollbar-width: none; -ms-overflow-style: none; touch-action: pan-x; -webkit-overflow-scrolling: touch;">
                        </div>
                    </div>
                    <div class="max-w-4xl mx-auto px-4 mb-20">
                        <div
                            class="glass-panel p-8 rounded-3xl border border-red-500/30 bg-gradient-to-b from-red-950/ 20 to-transparent text-center relative overflow-hidden">
                            <div class="absolute -top-10 -right-10 w-32 h-32 bg-red-600/10 rounded-full blur-3xl"></div>

                            <h3 class="text-red-500 font-tech font-bold text-sm uppercase tracking-[0.3em] mb-2">
                                Upcoming Grand Event</h3>
                            <h2 class="text-white text-2xl md:text-4xl font-bold mb-8 uppercase">SIDANG PARIPURNA 1</h2>

                            <div class="flex justify-center gap-4 md:gap-8">
                                <div class="flex flex-col">
                                    <span id="days"
                                        class="text-4xl md:text-6xl font-tech font-bold text-white shadow-red-500/50 drop-shadow-[0_0_10px_rgba(220,38,38,0.5)]">00</span>
                                    <span class="text-[10px] md:text-xs text-gray-500 uppercase mt-2">Hari</span>
                                </div>
                                <div class="text-4xl md:text-6xl font-tech font-bold text-red-600">:</div>
                                <div class="flex flex-col">
                                    <span id="hours"
                                        class="text-4xl md:text-6xl font-tech font-bold text-white">00</span>
                                    <span class="text-[10px] md:text-xs text-gray-500 uppercase mt-2">Jam</span>
                                </div>
                                <div class="text-4xl md:text-6xl font-tech font-bold text-red-600">:</div>
                                <div class="flex flex-col">
                                    <span id="minutes"
                                        class="text-4xl md:text-6xl font-tech font-bold text-white">00</span>
                                    <span class="text-[10px] md:text-xs text-gray-500 uppercase mt-2">Menit</span>
                                </div>
                            </div>

                            <p class="text-gray-400 text-xs mt-8 italic">"Persiapkan karya terbaikmu untuk era keemasan
                                penyiaran."</p>
                        </div>
                    </div>
                    <div class="mt-24 pt-16 border-t border-red-900/30">
                        <div class="text-center mb-16">
                            <h2
                                class="text-3xl md:text-5xl font-tech font-bold text-white mb-3 uppercase tracking-wider">
                                Timeline <span class="text-red-500">Proker</span></h2>
                            <div
                                class="h-1 w-24 bg-red-600 mx-auto rounded-full mb-4 shadow-[0_0_10px_rgba(220,38,38,0.8)]">
                            </div>
                            <p class="text-gray-400 text-sm md:text-base">Perjalanan program kerja utama HMPS KPI 2026 -
                                The Golden Era.</p>
                        </div>

                        <div class="max-w-4xl mx-auto px-4 md:px-8" id="proker-timeline">
                        </div>
                    </div>
            </section>

            <section id="structure" class="hidden-section py-10">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-5xl font-tech font-bold text-white mb-2">STRUKTUR ORGANISASI</h2>
                    <div class="h-1 w-20 bg-red-600 mx-auto rounded-full shadow-[0_0_10px_rgba(220,38,38,0.8)]"></div>
                    <p class="text-gray-400 mt-4 text-sm md:text-base tracking-widest uppercase font-light">HMPS KPI
                        2026 - The Golden Era</p>
                </div>

                <div class="hidden md:flex justify-center overflow-x-auto pb-16 custom-scrollbar">
                    <div class="tree min-w-[900px]">
                        <ul>
                            <li>
                                <div class="glass-panel p-5 rounded-2xl border border-red-500/40 inline-block w-52 hover:bg-red-900/40 transition-all cursor-pointer shadow-[0_0_20px_rgba(220,38,38,0.2)]"
                                    onclick="openBioModalByName('Aqilla Nindita N. M.')">
                                    <img src="assets/mahasiswa/qila2.webp"
                                        class="w-20 h-20 mx-auto rounded-full mb-3 border-2 border-red-500 object-cover">
                                    <h3 class="font-bold text-red-400 text-sm">Aqilla Nindita</h3>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-tighter">Ketua Umum</p>
                                </div>
                                <ul>
                                    <li>
                                        <div class="glass-panel p-5 rounded-2xl border border-red-500/40 inline-block w-52 hover:bg-red-900/40 transition-all cursor-pointer"
                                            onclick="openBioModalByName('Renny Ismawati')">
                                            <img src="assets/mahasiswa/renny (1).webp"
                                                class="w-20 h-20 mx-auto rounded-full mb-3 border-2 border-white/50 object-cover">
                                            <h3 class="font-bold text-white text-sm">Renny Ismawati</h3>
                                            <p class="text-[10px] text-gray-400 uppercase tracking-tighter">Wakil Ketua
                                            </p>
                                        </div>
                                        <ul class="flex justify-center">
                                            <li class="px-5">
                                                <div class="flex flex-col gap-4 pt-4">
                                                    <div class="glass-panel p-4 rounded-xl border border-gray-700 w-44 hover:border-red-500 transition-all cursor-pointer text-center"
                                                        onclick="openBioModalByName('Siti Nur Azizah')">
                                                        <img src="assets/mahasiswa/nur.webp"
                                                            class="w-14 h-14 mx-auto rounded-full mb-2 border border-gray-600 object-cover">

                                                        <h3 class="font-bold text-white text-xs">Siti Nur Azizah</h3>
                                                        <p class="text-[9px] text-red-500 uppercase tracking-widest">
                                                            Sekretaris 1</p>
                                                    </div>
                                                    <div class="glass-panel p-4 rounded-xl border border-gray-700 w-44 hover:border-red-500 transition-all cursor-pointer text-center"
                                                        onclick="openBioModalByName('Nabil Tri Yoga')">
                                                        <img src="assets/mahasiswa/nabilpp.webp"
                                                            class="w-14 h-14 mx-auto rounded-full mb-2 border border-gray-600 object-cover">
                                                        <h3 class="font-bold text-white text-xs">Nabil Tri Yoga</h3>
                                                        <p class="text-[9px] text-red-500 uppercase tracking-widest">
                                                            Sekretaris 2</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="px-5">
                                                <div class="flex flex-col gap-4 pt-4">
                                                    <div class="glass-panel p-4 rounded-xl border border-gray-700 w-44 hover:border-red-500 transition-all cursor-pointer text-center"
                                                        onclick="openBioModalByName('Khoirul Latifah')">
                                                        <img src="assets/mahasiswa/ipah.webp"
                                                            class="w-14 h-14 mx-auto rounded-full mb-2 border border-gray-600 object-cover">
                                                        <h3 class="font-bold text-white text-xs">Khoirul Latifah</h3>
                                                        <p class="text-[9px] text-red-500 uppercase tracking-widest">
                                                            Bendahara 1</p>
                                                    </div>
                                                    <div class="glass-panel p-4 rounded-xl border border-gray-700 w-44 hover:border-red-500 transition-all cursor-pointer text-center"
                                                        onclick="openBioModalByName('Aisyah Imtiyaz T.')">
                                                        <img src="assets/mahasiswa/ais.webp"
                                                            class="w-14 h-14 mx-auto rounded-full mb-2 border border-gray-600 object-cover">
                                                        <h3 class="font-bold text-white text-xs">Aisyah Imtiyaz</h3>
                                                        <p class="text-[9px] text-red-500 uppercase tracking-widest">
                                                            Bendahara 2</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Mobile -->
                <div class="md:hidden flex flex-col items-center space-y-4 px-4 pb-10">
                    <div class="glass-panel p-4 rounded-xl border border-red-500 w-full max-w-[280px] text-center relative z-20"
                        onclick="openBioModalByName('Aqilla Nindita N. M.')">
                        <img src="assets/mahasiswa/qila2.webp"
                            class="w-16 h-16 mx-auto rounded-full mb-2 border border-red-500 object-cover">
                        <h3 class="text-white font-bold text-sm">Aqilla Nindita</h3>
                        <p class="text-[10px] text-red-500 uppercase">Ketua Umum</p>
                    </div>
                    <div class="h-6 w-px bg-red-900"></div>
                    <div class="glass-panel p-4 rounded-xl border border-gray-700 w-full max-w-[280px] text-center relative z-20"
                        onclick="openBioModalByName('Renny Ismawati')">
                        <img src="assets/mahasiswa/renny (1).webp"
                            class="w-16 h-16 mx-auto rounded-full mb-2 border border-gray-600 object-cover">
                        <h3 class="text-white font-bold text-sm">Renny Ismawati</h3>
                        <p class="text-[10px] text-gray-500 uppercase">Wakil Ketua</p>
                    </div>
                    <div class="grid grid-cols-2 gap-3 w-full mt-4 px-2 overflow-hidden">
                        <div class="space-y-3">
                            <div class="glass-panel p-3 rounded-lg border border-gray-800 text-center relative z-20"
                                onclick="openBioModalByName('Siti Nur Azizah')">
                                <img src="assets/mahasiswa/nur.webp"
                                    class="w-12 h-12 mx-auto rounded-full mb-2 border border-gray-700 object-cover">
                                <p class="text-white text-[10px] font-bold">Siti Nur Azizah</p>
                                <p class="text-[8px] text-red-500 uppercase">Sekretaris 1</p>
                            </div>
                            <div class="glass-panel p-3 rounded-lg border border-gray-800 text-center relative z-20"
                                onclick="openBioModalByName('Nabil Tri Yoga')">
                                <img src="assets/mahasiswa/nabilpp.webp"
                                    class="w-12 h-12 mx-auto rounded-full mb-2 border border-gray-700 object-cover">
                                <p class="text-white text-[10px] font-bold">Nabil Tri Yoga</p>
                                <p class="text-[8px] text-red-500 uppercase">Sekretaris 2</p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="glass-panel p-3 rounded-lg border border-gray-800 text-center relative z-20"
                                onclick="openBioModalByName('Khoirul Latifah')">
                                <img src="assets/mahasiswa/ipah.webp"
                                    class="w-12 h-12 mx-auto rounded-full mb-2 border border-gray-700 object-cover">
                                <p class="text-white text-[10px] font-bold">Khoirul Latifah</p>
                                <p class="text-[8px] text-red-500 uppercase">Bendahara 1</p>
                            </div>
                            <div class="glass-panel p-3 rounded-lg border border-gray-800 text-center relative z-20"
                                onclick="openBioModalByName('Aisyah Imtiyaz T.')">
                                <img src="assets/mahasiswa/ais.webp"
                                    class="w-12 h-12 mx-auto rounded-full mb-2 border border-gray-700 object-cover">
                                <p class="text-white text-[10px] font-bold">Aisyah Imtiyaz T.</p>
                                <p class="text-[8px] text-red-500 uppercase">Bendahara 2</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-4xl mx-auto px-4 mb-16">
                    <div
                        class="glass-panel p-6 rounded-2xl border border-red-500/20 bg-gradient-to-br from-red-900/10 to-transparent">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="text-center md:text-left">
                                <h3 class="text-white font-tech font-bold text-xl uppercase tracking-wider mb-1">Dokumen
                                    Resmi HMPS</h3>
                                <p class="text-gray-400 text-xs">Unduh SK Kepengurusan dan Kalender Program Kerja The
                                    Golden Era.</p>
                            </div>
                            <div class="flex flex-wrap justify-center gap-3">
                                <a href="assets/dokumen/SK_PENGURUS_2026.pdf" download
                                    class="flex items-center gap-2 bg-red-600/20 hover:bg-red-600 text-white text-[10px] font-bold px-4 py-2 rounded-lg border border-red-500/50 transition-all group">
                                    <i class="fas fa-file-pdf text-red-500 group-hover:text-white"></i> SK PENGURUS
                                </a>
                                <a href="assets/dokumen/KALENDER_PROKER.pdf" download
                                    class="flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white text-[10px] font-bold px-4 py-2 rounded-lg border border-gray-700 transition-all group">
                                    <i class="fas fa-calendar-alt text-gray-400 group-hover:text-white"></i> KALENDER
                                    PROKER
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-20 pt-16 border-t border-red-900/30">
                    <div class="text-center mb-16">
                        <h3 class="font-tech text-2xl text-white mb-2 uppercase tracking-[0.4em]">Struktur Divisi</h3>
                        <p class="text-gray-500 text-sm">Empat pilar utama penggerak HMPS KPI 2026.</p>
                    </div>
                    <div class="max-w-md mx-auto px-4 mb-10 hidden md:block">
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fas fa-search text-red-500 group-focus-within:text-white transition-colors"></i>
                            </div>
                            <input type="text" id="member-search" onkeyup="filterMembers()"
                                placeholder="Cari nama pengurus..."
                                class="w-full bg-black/40 border border-red-900/50 text-white text-sm rounded-full py-3 pl-12 pr-4 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all placeholder:text-gray-600 shadow-[0_0_15px_rgba(220,38,38,0.1)]">
                        </div>
                    </div>
                    <div id="division-container" class="space-y-24 max-w-6xl mx-auto px-4">
                    </div>
                </div>

                <div class="text-center py-20">
                    <button onclick="toggleFamilyGallery()"
                        class="group relative px-12 py-5 bg-black overflow-hidden rounded-2xl border border-red-600/50 shadow-[0_0_30px_rgba(220,38,38,0.2)] hover:shadow-[0_0_50px_rgba(220,38,38,0.6)] transition-all duration-500">
                        <div class="flex items-center gap-4 relative z-10">
                            <i
                                class="fas fa-users text-3xl text-red-500 group-hover:text-white transition-colors duration-500"></i>
                            <span class="font-tech text-xl font-bold text-white tracking-[0.2em]">FAMILY HMPS KPI
                                2026</span>
                        </div>
                        <div
                            class="absolute inset-0 bg-red-600 opacity-0 group-hover:opacity-10 transition-opacity duration-500">
                        </div>
                    </button>
                </div>
            </section>

            <section id="documentation" class="hidden-section py-10">
                <div class="text-center mb-10">
                    <h2 class="text-3xl md:text-5xl font-tech font-bold text-white mb-2">ARCHIVES</h2>
                    <div class="h-1 w-20 bg-red-600 mx-auto rounded-full mb-4"></div>
                    <p class="text-gray-400 mb-6" id="doc-subtitle">Memories & Moments</p>

                    <div id="doc-controls"
                        class="hidden flex-col md:flex-row justify-center items-center gap-3 max-w-2xl mx-auto mb-8">
                        <button onclick="backToFolders()"
                            class="w-full md:w-auto bg-gray-800 hover:bg-red-700 border border-gray-600 hover:border-red-500 text-white px-4 py-2 rounded-lg text-sm transition-all whitespace-nowrap flex items-center justify-center gap-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </button>

                        <button id="btn-bulk-delete" onclick="confirmBulkDelete()"
                            class="hidden w-full md:w-auto bg-red-700 hover:bg-red-600 border border-red-500 text-white px-4 py-2 rounded-lg text-sm transition-all items-center justify-center gap-2 whitespace-nowrap">
                            <i class="fas fa-trash-alt"></i>
                            <span>Hapus (<span id="bulk-delete-count">0</span>)</span>
                        </button>

                        <div class="relative w-full">
                            <input type="text" id="doc-search" placeholder="Cari dokumentasi..."
                                onkeyup="handleSearch(event)"
                                class="w-full bg-black/40 border border-red-500/30 rounded-lg px-4 py-2 text-white text-sm focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all text-center md:text-left">
                            <button onclick="handleSearch({key: 'Enter'})"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div id="event-folders-grid" class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto px-4"></div>
                <div id="documentation-grid" class="hidden columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6"></div>
            </section>
            <section id="pendaftaran" class="hidden-section py-10">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-5xl font-tech font-bold text-white mb-2">PORTAL <span
                            class="text-red-500">PENDAFTARAN</span></h2>
                    <div class="h-1 w-20 bg-red-600 mx-auto rounded-full mt-2 mb-4"></div>
                    <p class="text-gray-400">Silakan pilih lomba yang ingin kamu ikuti di bawah ini.</p>
                </div>

                <div id="pendaftaran-list" class="max-w-4xl mx-auto px-4 grid grid-cols-1 gap-6">

                </div>
            </section>
        </main>

        <footer class="border-t border-red-900/30 bg-black/90 mt-12 pt-12 pb-8">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-8 border-b border-red-900/30 pb-8">
                    <div class="text-left">
                        <h3
                            class="font-tech text-xl text-white font-bold mb-4 border-b-2 border-red-600 inline-block pb-1">
                            HMPS KPI 2026</h3>
                        <p class="text-gray-400 text-sm leading-relaxed mt-2">
                            Menempa generasi komunikator unggul untuk mewujudkan <span
                                class="text-amber-400 font-bold">The Golden Era</span> penyiaran Islam yang kreatif dan
                            adaptif.
                        </p>
                    </div>
                    <div class="text-left">
                        <h3
                            class="font-tech text-xl text-white font-bold mb-4 border-b-2 border-red-600 inline-block pb-1">
                            KONTAK KAMI</h3>
                        <div class="mt-2 flex flex-col gap-2">
                            <a href="https://maps.app.goo.gl/6riPJYNs8Bz7dGDT8" target="_blank"
                                class="text-gray-400 text-sm flex items-center hover:text-white transition-colors group">
                                <i
                                    class="fas fa-map-marker-alt text-red-500 w-6 text-center mr-2 group-hover:scale-110 transition-transform"></i>
                                Jl. Puspita Jaya, Krajan, Pintu, Kec. Jenangan
                            </a>
                            <a href="https://wa.me/6285755161229" target="_blank"
                                class="text-gray-400 text-sm flex items-center hover:text-white transition-colors group">
                                <i
                                    class="fas fa-phone text-red-500 w-6 text-center mr-2 group-hover:scale-110 transition-transform"></i>
                                0857-5516-1229
                            </a>
                            <a href="https://www.instagram.com/hmjkpi.uinpo/" target="_blank"
                                class="text-gray-400 text-sm flex items-center hover:text-white transition-colors group">
                                <i
                                    class="fab fa-instagram text-red-500 w-6 text-center mr-2 group-hover:scale-110 transition-transform"></i>
                                @hmpskpi.uinpo
                            </a>
                        </div>
                    </div>
                    <div class="text-left">
                        <h3
                            class="font-tech text-xl text-white font-bold mb-4 border-b-2 border-red-600 inline-block pb-1">
                            AKADEMIK</h3>
                        <div class="mt-2">
                            <p class="text-gray-400 text-sm mb-2"><i
                                    class="fas fa-graduation-cap text-red-500 mr-2"></i> Komunikasi dan Penyiaran Islam
                            </p>
                            <p class="text-gray-400 text-sm mb-2"><i class="fas fa-calendar-alt text-red-500 mr-2"></i>
                                Angkatan 2026</p>
                            <p class="text-gray-400 text-sm"><i class="fas fa-users text-red-500 mr-2"></i>Himpunan
                                Mahasiswa Program Studi</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="font-tech text-gray-500 text-sm text-center md:text-left">© 2026 HMPS KPI - UIN AMSARI
                        PONOROGO. All Rights Reserved.</p>
                    <div class="flex gap-4">
                        <a href="https://www.instagram.com/uin.ponorogo/" target="_blank"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-red-600 hover:text-white transition-all duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://uinponorogo.ac.id/" target="_blank"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-blue-500 hover:text-white transition-all duration-300">
                            <i class="fas fa-globe"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div id="family-gallery" class="fullscreen-overlay" tabindex="0">
        <div class="max-w-7xl mx-auto px-4 pt-24 pb-10 relative">
            <button onclick="toggleFamilyGallery()"
                class="fixed top-6 right-6 z-50 bg-red-600 text-white w-12 h-12 rounded-full hover:bg-red-500 transition flex items-center justify-center text-xl shadow-lg border-2 border-black">
                <i class="fas fa-times"></i>
            </button>
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-6xl font-tech font-bold text-white mb-2">HMPS KPI 2026</h2>
                <p class="text-red-400 text-lg">Awaken The Golden Era</p>
            </div>
            <div id="student-grid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6"></div>
        </div>
    </div>

    <div id="bio-modal" class="custom-modal" onclick="closeBioModal(event)">
        <div id="bio-content"
            class="glass-panel w-[90%] md:w-full max-w-6xl max-h-[90vh] md:max-h-[85vh] overflow-y-auto transform scale-95 transition-all duration-300 rounded-2xl flex flex-col md:flex-row bg-black/90 border border-red-500/30 shadow-2xl relative overflow-hidden"
            tabindex="0">
            <div class="w-full md:w-5/12 aspect-[9/16] relative bg-gray-900 group shrink-0">
                <div id="modal-img-loader" class="img-loading-skeleton">
                    <i class="fas fa-spinner fa-spin text-red-900 text-4xl"></i>
                </div>
                <img id="modal-img" src="" alt="Profile Photo"
                    class="relative z-10 w-full h-full object-cover transition-opacity duration-500 opacity-0"
                    onerror="this.src='https://placehold.co/400x500?text=No+Image';">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent md:bg-gradient-to-r md:from-transparent md:to-black/90 z-20 pointer-events-none">
                </div>
                <button onclick="closeBioModal(null, true)"
                    class="md:hidden absolute top-4 right-4 z-50 bg-black/50 text-white w-8 h-8 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div
                class="w-full md:w-7/12 p-6 md:p-10 flex flex-col justify-center text-left relative bg-black/50 md:bg-transparent">
                <div class="absolute top-0 right-0 p-6 opacity-10 hidden md:block">
                    <i class="fas fa-fingerprint text-9xl text-red-600"></i>
                </div>
                <div class="mb-6 md:mb-10 relative z-10">
                    <h2 id="modal-name"
                        class="text-2xl md:text-6xl font-bold text-white font-tech mb-2 tracking-wide leading-tight drop-shadow-lg">
                        Name Here</h2>
                    <div class="flex items-center gap-3">
                        <span
                            class="px-4 py-1 bg-red-900/40 border border-red-500/30 rounded text-red-400 font-mono text-xs md:text-base tracking-wider"
                            id="modal-nim">NIM: 00000000</span>
                    </div>
                </div>
                <div class="space-y-6 relative z-10">
                    <div class="bio-info-row group">
                        <div class="bio-icon-box w-10 h-10 md:w-14 md:h-14 text-lg md:text-2xl">
                            <i class="fab fa-instagram"></i>
                        </div>
                        <div class="flex-grow pt-1 md:pt-2">
                            <span
                                class="text-[10px] md:text-xs text-gray-500 uppercase tracking-[0.2em] font-bold block mb-1">Instagram</span>
                            <div id="modal-ig" class="text-sm md:text-xl"></div>
                        </div>
                    </div>
                    <div class="bio-info-row group">
                        <div class="bio-icon-box w-10 h-10 md:w-14 md:h-14 text-lg md:text-2xl">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="flex-grow pt-1 md:pt-2">
                            <span
                                class="text-[10px] md:text-xs text-gray-500 uppercase tracking-[0.2em] font-bold block mb-1">About
                                Me</span>
                            <p id="modal-bio"
                                class="text-gray-300 font-light leading-relaxed text-sm md:text-xl italic pr-2 md:pr-8 text-justify">
                                "..."</p>
                        </div>
                    </div>
                </div>
                <button onclick="closeBioModal(null, true)"
                    class="hidden md:flex absolute top-6 right-6 z-50 bg-transparent text-white/50 hover:text-white transition w-10 h-10 items-center justify-center text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="media-modal" class="custom-modal" onclick="closeMediaModal(event)">
        <div class="relative max-w-5xl w-full mx-4 flex justify-center">
            <button onclick="closeMediaModal(null, true)"
                class="absolute -top-12 right-0 md:-right-12 text-white hover:text-red-500 text-3xl transition z-50">
                <i class="fas fa-times"></i>
            </button>
            <div id="media-container" class="max-h-[85vh] rounded-lg shadow-2xl border border-red-500/30"></div>
        </div>
    </div>

    <div id="upload-modal" class="custom-modal p-4 sm:p-8 z-[9999]" onclick="closeUploadModal(event)">
        <div id="upload-content"
            class="w-full max-w-5xl max-h-[90vh] bg-[#0a0000]/95 backdrop-blur-xl border border-red-500/30 rounded-2xl shadow-[0_0_40px_rgba(0,0,0,0.8)] flex flex-col relative transform scale-95 transition-all duration-300"
            onclick="event.stopPropagation()">

            <button onclick="closeUploadModal(null, true)"
                class="absolute top-4 right-4 md:top-5 md:right-5 text-gray-500 hover:text-red-500 hover:bg-red-950/30 transition-all z-50 bg-black/40 border border-gray-800 w-8 h-8 rounded-full flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>
            <div class="shrink-0 p-5 md:p-6 border-b border-gray-800/80 text-center bg-black/20 rounded-t-2xl">
                <h2 class="text-xl md:text-2xl font-bold text-red-500 font-tech uppercase tracking-widest m-0">Panel
                    Kendali Admin</h2>
            </div>

            <div class="flex flex-col md:flex-row flex-1 overflow-y-auto md:overflow-hidden custom-scrollbar min-h-0">

                <div class="w-full md:w-1/2 p-6 md:p-8 flex flex-col overflow-y-auto custom-scrollbar min-h-0">
                    <form id="upload-form" onsubmit="handleBulkUpload(event)" enctype="multipart/form-data"
                        class="space-y-5 flex flex-col">

                        <div class="shrink-0">
                            <label
                                class="block text-gray-400 text-[10px] uppercase font-bold mb-2 tracking-widest">Judul /
                                Prefix</label>
                            <input type="text" name="judul" required placeholder="Contoh: PBAK 2026 - Hari 1"
                                class="w-full bg-black/40 border border-gray-700 px-4 py-3 rounded-xl focus:border-red-500 outline-none transition text-sm text-white placeholder-gray-600">
                        </div>
                        <div class="shrink-0">
                            <label
                                class="block text-gray-400 text-[10px] uppercase font-bold mb-2 tracking-widest">Pilih
                                Album</label>
                            <select name="id_event"
                                class="w-full bg-black/40 border border-gray-700 px-4 py-3 rounded-xl focus:border-red-500 outline-none text-sm text-white cursor-pointer appearance-none">
                                <option value="E01">MUBES HMPS KPI 2026</option>
                                <option value="E02">OSMAJUR</option>
                                <option value="E03">FEBKOM</option>
                                <option value="E04">POSTER PENGUMUMAN</option>
                            </select>
                        </div>
                        <div id="drop-zone"
                            class="shrink-0 relative border-2 border-dashed border-gray-700 rounded-2xl py-8 px-6 text-center cursor-pointer hover:border-red-500 hover:bg-red-950/10 transition-all bg-black/20 mt-2"
                            onclick="document.getElementById('file-input-bulk').click()"
                            ondragover="event.preventDefault(); this.classList.add('border-red-500','bg-red-950/20')"
                            ondragleave="this.classList.remove('border-red-500','bg-red-950/20')"
                            ondrop="handleDrop(event)">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-600 mb-3 transition-colors"></i>
                            <p class="text-gray-300 text-sm mb-1">Klik atau <span class="text-red-500 font-bold">drag &
                                    drop</span> file</p>
                            <p class="text-gray-600 text-[10px]">Mendukung banyak file sekaligus (Foto/Video)</p>
                            <input type="file" id="file-input-bulk" name="berkas" multiple accept="image/*,video/*"
                                class="hidden" onchange="handleFileSelect(this.files)">
                        </div>

                        <div class="flex-1 min-h-0">
                            <div id="file-queue-container"
                                class="hidden bg-gray-900/40 p-4 rounded-xl border border-gray-800 mt-4">
                                <div class="flex items-center justify-between mb-3 border-b border-gray-800 pb-2">
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-widest">Antrian:
                                        <span id="queue-count" class="text-red-500">0</span> file
                                    </p>
                                    <button type="button" onclick="clearQueue()"
                                        class="text-[10px] text-gray-400 hover:text-red-500 transition px-2 py-1 rounded bg-black/30 border border-gray-800"><i
                                            class="fas fa-trash-alt mr-1"></i> Kosongkan</button>
                                </div>
                                <div id="file-queue-list"
                                    class="space-y-2 max-h-32 overflow-y-auto pr-2 custom-scrollbar"></div>
                            </div>
                            <div id="upload-progress-container"
                                class="hidden mt-4 space-y-2 bg-red-950/20 p-4 rounded-xl border border-red-900/30">
                                <div class="flex justify-between text-[10px] text-gray-300 uppercase tracking-widest">
                                    <span>Progress</span>
                                    <span id="upload-progress-text">0 / 0</span>
                                </div>
                                <div class="w-full bg-black/50 rounded-full h-2 overflow-hidden">
                                    <div id="upload-progress-bar"
                                        class="bg-red-600 h-full rounded-full transition-all duration-300"
                                        style="width:0%"></div>
                                </div>
                                <p id="upload-current-file" class="text-[10px] text-gray-400 truncate"></p>
                                <div id="upload-error-list"
                                    class="space-y-1 max-h-20 overflow-y-auto custom-scrollbar mt-2"></div>
                            </div>
                        </div>

                        <button type="submit" id="btn-upload-submit"
                            class="w-full shrink-0 bg-gradient-to-r from-red-800 to-red-600 hover:from-red-700 hover:to-red-500 py-4 rounded-xl font-bold text-white transition-all shadow-[0_0_20px_rgba(220,38,38,0.2)] uppercase tracking-widest text-sm disabled:opacity-50 disabled:cursor-not-allowed mt-4 border border-red-500/50">
                            <i class="fas fa-cloud-upload-alt mr-2"></i> Mulai Upload
                        </button>
                    </form>
                </div>

                <div
                    class="w-full md:w-1/2 flex flex-col bg-black/40 border-t md:border-t-0 md:border-l border-gray-800/80 min-h-[400px] md:min-h-0">
                    <div class="shrink-0 p-6 md:p-8 pb-4">
                        <h3
                            class="text-gray-400 text-[10px] uppercase font-bold tracking-widest flex items-center gap-2">
                            <i class="fas fa-list-ul text-red-500"></i> Kelola File
                        </h3>
                        <p class="text-[9px] text-gray-600 mt-1">Daftar arsip yang masuk ke database</p>
                    </div>
                    <div class="flex-1 overflow-y-auto px-6 md:px-8 pb-6 md:pb-8 custom-scrollbar min-h-0">
                        <div id="admin-file-list" class="space-y-3"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="confirm-delete-modal" class="custom-modal" style="z-index:9998;">
        <div
            class="glass-panel w-[90%] max-w-sm p-8 rounded-2xl border border-red-500/40 shadow-2xl text-center transform scale-95 transition-all duration-300">
            <div class="text-5xl mb-4" style="filter:drop-shadow(0 0 12px rgba(239,68,68,0.7))">
                <i class="fas fa-exclamation-triangle text-red-500"></i>
            </div>
            <h3 class="text-xl font-bold font-tech text-white mb-2 tracking-widest uppercase">KONFIRMASI HAPUS</h3>
            <p id="confirm-delete-title" class="text-gray-400 text-sm mb-6">Hapus file ini secara permanen?</p>
            <div class="flex gap-3">
                <button onclick="closeConfirmDelete()"
                    class="flex-1 py-3 rounded-lg font-bold transition bg-gray-700 hover:bg-gray-600 text-white uppercase tracking-widest text-sm">Batal</button>
                <button onclick="executeDelete()"
                    class="flex-1 py-3 rounded-lg font-bold transition bg-red-700 hover:bg-red-600 text-white uppercase tracking-widest text-sm"><i
                        class="fas fa-trash-alt mr-1"></i> Hapus</button>
            </div>
        </div>
    </div>

    <div id="notif-action-modal" class="custom-modal" style="z-index:9999;">
        <div
            class="glass-panel w-[90%] max-w-sm p-8 rounded-2xl border border-gray-700 shadow-2xl text-center transform scale-95 transition-all duration-300">
            <div id="notif-action-icon" class="text-6xl mb-4"></div>
            <h3 id="notif-action-title" class="text-xl font-bold font-tech text-white mb-2 tracking-widest uppercase">
            </h3>
            <p id="notif-action-msg" class="text-gray-400 text-sm mb-6"></p>
            <button id="notif-action-btn" onclick="closeNotifModal()"
                class="w-full py-3 rounded-lg font-bold transition bg-red-700 hover:bg-red-600 text-white uppercase tracking-widest text-sm">OK</button>
        </div>
    </div>

    <div id="news-modal" class="custom-modal" onclick="closeNewsModal(event)" style="z-index: 9999;">
        <div id="news-content"
            class="glass-panel w-[90%] md:w-full max-w-4xl max-h-[90vh] overflow-y-auto transform scale-95 transition-all duration-300 rounded-2xl flex flex-col bg-black/95 border border-red-500/30 shadow-2xl relative custom-scrollbar"
            tabindex="0">
            <button onclick="closeNewsModal(null, true)"
                class="absolute top-4 right-4 z-50 bg-black/50 text-white hover:text-red-500 hover:bg-black transition w-10 h-10 rounded-full flex items-center justify-center border border-gray-700">
                <i class="fas fa-times"></i>
            </button>
            <div class="w-full h-64 md:h-80 relative shrink-0">
                <img id="news-modal-img" src="" alt="News Image" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
                <div id="news-modal-category"
                    class="absolute top-6 left-6 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded shadow-lg uppercase tracking-widest">
                    Kategori</div>
                <div class="absolute bottom-0 left-0 w-full p-6 md:p-8">
                    <div class="flex items-center gap-2 text-xs text-gray-400 mb-3 font-tech tracking-wider">
                        <i class="far fa-calendar-alt text-red-500"></i> <span id="news-modal-date">Tanggal</span>
                    </div>
                    <h2 id="news-modal-title"
                        class="text-2xl md:text-4xl font-bold text-white leading-tight drop-shadow-lg">Judul Berita</h2>
                </div>
            </div>
            <div class="p-6 md:p-8 flex flex-col flex-grow">
                <div class="text-gray-300 leading-relaxed space-y-4 text-sm md:text-base font-light text-justify"
                    id="news-modal-body"></div>

                <div id="news-modal-action" class="mt-8 pt-6 border-t border-red-900/30 hidden flex justify-end">
                    <button onclick="closeNewsModal(); switchTab('pendaftaran');"
                        class="bg-gradient-to-r from-red-700 to-red-500 hover:from-red-600 hover:to-red-400 text-white px-8 py-3 rounded-xl font-bold font-tech tracking-widest transition-all shadow-[0_0_20px_rgba(220,38,38,0.4)] hover:shadow-[0_0_30px_rgba(220,38,38,0.7)] hover:-translate-y-1 flex items-center gap-3">
                        DAFTAR SEKARANG <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="daftar-modal" class="custom-modal" style="z-index:9999;">
        <div
            class="glass-panel w-[90%] max-w-lg p-6 md:p-8 rounded-2xl border border-red-500/40 shadow-2xl relative transform scale-95 transition-all duration-300">
            <button onclick="closeDaftarModal()"
                class="absolute top-4 right-4 text-gray-500 hover:text-red-500 transition-colors w-8 h-8 rounded-full bg-black/50 flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>

            <div class="text-center mb-6">
                <i class="fas fa-clipboard-list text-4xl text-red-500 mb-2"></i>
                <h3 class="text-xl md:text-2xl font-tech font-bold text-white uppercase" id="modal-lomba-title">Daftar
                    Lomba</h3>
                <p class="text-gray-400 text-xs mt-1">Lengkapi form di bawah ini. Data akan otomatis masuk ke database
                    HMPS KPI.</p>
            </div>

            <form id="form-pendaftaran" onsubmit="submitPendaftaran(event)" class="space-y-4 text-left">
                <input type="hidden" id="input-nama-lomba" name="nama_lomba">

                <div id="dynamic-inputs-container" class="space-y-4 flex flex-wrap"></div>

                <div id="file-upload-section">
                    <label id="dynamic-file-label"
                        class="block text-gray-400 text-[10px] font-bold mb-1 uppercase tracking-widest">Upload
                        File</label>
                    <div
                        class="border-2 border-dashed border-gray-700 rounded-xl p-4 text-center hover:border-red-500 transition-colors bg-black/20 cursor-pointer relative">
                        <input type="file" id="input-file"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-2xl text-gray-500 mb-1"></i>
                        <p class="text-xs text-gray-400" id="file-name-display">Klik untuk memilih file</p>
                    </div>
                </div>

                <button type="submit" id="btn-submit-daftar"
                    class="w-full mt-4 bg-gradient-to-r from-red-800 to-red-600 hover:from-red-700 hover:to-red-500 text-white font-bold py-3.5 rounded-xl transition-all shadow-[0_0_15px_rgba(220,38,38,0.3)] uppercase tracking-widest text-sm flex justify-center items-center gap-2">
                    Kirim Pendaftaran <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
    // Melempar data dari PHP langsung ke Javascript agar tidak perlu fetch('api.php')
    var allFilesData = <?php echo json_encode($dataFiles); ?>;
    </script>
    <script src="assets/script/script.js?v=52.0"></script>
</body>

</html>