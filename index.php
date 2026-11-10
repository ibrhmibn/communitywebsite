<?php
require 'db.php';
$query = "SELECT id_foto as id, tipe as type, src_file as src, judul_foto as title, rasio as ratio, id_event as event FROM tb_galeri";
$result = mysqli_query($conn, $query);
$dataFiles = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dataFiles[] = $row;
    }
}

function rt_round_stamp($ring, $big, $small = '', $class = '', $size = '7rem') {
    static $n = 0;
    $n++;
    $id    = 'rtpath' . $n;
    $ring  = htmlspecialchars($ring, ENT_QUOTES, 'UTF-8');
    $big   = htmlspecialchars($big, ENT_QUOTES, 'UTF-8');
    $small = htmlspecialchars($small, ENT_QUOTES, 'UTF-8');
    $class = htmlspecialchars($class, ENT_QUOTES, 'UTF-8');
    $size  = htmlspecialchars($size, ENT_QUOTES, 'UTF-8');
    return '<div class="stamp-round ' . $class . '" style="--s:' . $size . '" aria-hidden="true">'
        . '<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" focusable="false">'
        . '<defs><path id="' . $id . '" d="M100,100 m-80,0 a80,80 0 1,1 160,0 a80,80 0 1,1 -160,0"/></defs>'
        . '<circle cx="100" cy="100" r="96" fill="none" stroke="currentColor" stroke-width="5"/>'
        . '<circle cx="100" cy="100" r="62" fill="none" stroke="currentColor" stroke-width="3"/>'
        . '<text font-size="19" textLength="494" lengthAdjust="spacing"><textPath href="#' . $id . '">' . $ring . '</textPath></text>'
        . '<text x="100" y="92" font-size="15" text-anchor="middle" letter-spacing="2">' . $small . '</text>'
        . '<text x="100" y="126" font-size="38" text-anchor="middle">' . $big . '</text>'
        . '</svg></div>';
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
    <meta name="theme-color" content="#edebdd">

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

    <!-- Tema: terang (merah) / gelap. Dipasang sebelum render supaya tidak berkedip -->
    <script>
    (function() {
        try {
            var t = localStorage.getItem('hmps-theme');
            if (t !== 'dark') t = 'light';
            document.documentElement.setAttribute('data-theme', t);
            var m = document.querySelector('meta[name="theme-color"]');
            if (m) m.setAttribute('content', t === 'dark' ? '#1b1717' : '#edebdd');
        } catch (e) {}
    })();
    </script>

    <link rel="icon" type="image/jpeg" href="assets/iconweb/tempk.webp">
    <link rel="shortcut icon" type="image/jpeg" href="assets/iconweb/tempk.webp">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Oswald:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    cream: '#EDEBDD',
                    paper: 'rgb(var(--surface) / <alpha-value>)',
                    brick: 'rgb(var(--brick) / <alpha-value>)',
                    rust: '#630000',
                    mustard: '#EDEBDD',
                    ink: '#1B1717',
                    espresso: 'rgb(var(--espresso) / <alpha-value>)',
                },
                fontFamily: {
                    display: ['"Alfa Slab One"', 'serif'],
                    body: ['Oswald', 'sans-serif'],
                },
            }
        }
    }
    </script>

    <link rel="stylesheet" href="assets/css/styles.css?v=54.0">
</head>

<body class="font-body selection:bg-ink selection:text-cream">
    <!-- Lapisan halftone dekoratif -->
    <div class="halftone-bg" aria-hidden="true"></div>
    <!-- ORNAMEN: titik komik di sudut layar (non-interaktif, di belakang konten) -->
    <div class="ornament-page-dots" aria-hidden="true"></div>
    <div id="scroll-progress" aria-hidden="true"></div>

    <!-- ADMIN FLOATING BUTTONS -->
    <div id="admin-controls" class="hidden fixed bottom-6 right-6 z-[9999] flex-col gap-3">
        <button onclick="openUploadModal()" class="rt-btn rt-btn-red !p-0 w-14 h-14 text-2xl group relative">
            <i class="fas fa-plus"></i>
            <span
                class="absolute right-16 bg-ink text-cream border-2 border-ink text-xs px-3 py-2 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap font-body tracking-wider pointer-events-none">Upload
                Arsip Baru</span>
        </button>
        <button onclick="handleLogout()" class="rt-btn rt-btn-ink !p-0 w-14 h-14 text-xl group relative">
            <i class="fas fa-power-off"></i>
            <span
                class="absolute right-16 bg-ink text-cream border-2 border-ink text-xs px-3 py-2 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap font-body tracking-wider pointer-events-none">Keluar
                (Logout)</span>
        </button>
    </div>

    <!-- Sumber lagu diatur oleh PLAYLIST di script.js (acak otomatis, tanpa loop) -->
    <audio id="bg-music" preload="none"></audio>

    <!-- ==================== INTRO SCREEN ==================== -->
    <div id="intro-screen">
        <div
            class="relative ornament-host w-[90%] max-w-3xl bg-cream border-4 border-ink shadow-[10px_10px_0px_var(--shadow-hi-c)] p-6 md:p-10 text-center">
            <!-- ORNAMEN belakang (dipotong layer, tidak bocor) -->
            <div class="ornament-layer" aria-hidden="true">
                <span class="ornament ornament-halftone ornament-halftone--tl ornament-halftone--cotton"></span>
                <span class="ornament ornament-halftone ornament-halftone--br ornament-halftone--cotton"></span>
                <span
                    class="ornament ornament-star ornament-star--ghost ornament-star--lg ornament-star--cotton -bottom-16 -left-10 rotate-12 hidden md:grid"></span>
            </div>
            <span class="staple top-3 left-3 -rotate-12"></span>
            <span class="staple top-3 right-3 rotate-12"></span>
            <!-- ORNAMEN depan (pointer-events: none) -->
            <span class="ornament ornament-star ornament-star--md -top-10 -right-8 rotate-12 hidden md:grid"
                aria-hidden="true"><span>Vol.<br>1</span></span>
            <span class="stamp-badge stamp-badge--red -bottom-4 -left-3 -rotate-6 hidden sm:block"
                aria-hidden="true">Approved</span>
            <div
                class="absolute -top-5 -left-2 md:-left-4 -rotate-6 bg-mustard border-4 border-ink px-3 py-1 font-display text-[10px] md:text-sm uppercase tracking-widest pointer-events-none">
                ★ Est. 2026 ★</div>

            <div class="flex justify-center mb-4 mt-2">
                <div class="vinyl vinyl-spin w-20 h-20 md:w-28 md:h-28"></div>
            </div>

            <h1 class="font-display text-5xl sm:text-7xl md:text-8xl uppercase tracking-tight leading-[0.95] mb-4">
                HMPS <br><span id="typing-text" class="text-brick typing-cursor"></span>
            </h1>

            <div class="star-divider max-w-xs mx-auto mb-4"><span>★</span></div>

            <p class="text-xs md:text-lg mb-8 font-medium tracking-[0.3em] uppercase">2026 | The Golden Era</p>

            <button onclick="enterSite()" class="rt-btn rt-btn-red text-base md:text-lg px-10">
                VISIT
            </button>
        </div>
    </div>

    <!-- ==================== MAIN APP ==================== -->
    <div id="main-app" class="hidden opacity-0 transition-opacity duration-1000 min-h-screen flex flex-col">

        <!-- NAVBAR -->
        <nav class="fixed top-0 w-full z-50 bg-espresso border-b-4 border-ink">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <span class="text-mustard text-xl">★</span>
                        <span class="font-display text-xl md:text-2xl text-mustard tracking-tight uppercase">HMPS <span
                                class="text-cream">KPI</span></span>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-center space-x-3">
                            <button onclick="switchTab('home')"
                                class="nav-btn bg-mustard text-ink border-ink border-2 hover:border-mustard px-3 py-1.5 text-sm font-semibold uppercase tracking-widest transition-all duration-200">Home</button>
                            <button onclick="switchTab('structure')"
                                class="nav-btn text-cream border-transparent border-2 hover:border-mustard px-3 py-1.5 text-sm font-semibold uppercase tracking-widest transition-all duration-200">Structure</button>
                            <button onclick="switchTab('documentation')"
                                class="nav-btn text-cream border-transparent border-2 hover:border-mustard px-3 py-1.5 text-sm font-semibold uppercase tracking-widest transition-all duration-200">Documentation</button>
                            <button onclick="switchTab('pendaftaran')"
                                class="nav-btn text-cream border-transparent border-2 hover:border-mustard px-3 py-1.5 text-sm font-semibold uppercase tracking-widest transition-all duration-200">Pendaftaran</button>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button onclick="toggleTheme()" id="theme-btn" aria-label="Ganti mode terang / gelap"
                            title="Mode terang / gelap"
                            class="w-9 h-9 bg-ink flex items-center justify-center text-cream border-2 border-cream hover:bg-mustard hover:text-ink transition-all">
                            <i class="fas fa-moon icon-moon"></i><i class="fas fa-sun icon-sun"></i>
                        </button>
                        <button onclick="toggleMusic()" id="music-btn"
                            class="w-9 h-9 bg-brick flex items-center justify-center text-cream border-2 border-cream hover:bg-mustard hover:text-ink transition-all music-pulse">
                            <i class="fas fa-music"></i>
                        </button>
                        <div class="relative group py-2">
                            <button id="user-btn"
                                class="w-9 h-9 bg-cream flex items-center justify-center text-ink border-2 border-ink hover:bg-mustard transition-all focus:outline-none">
                                <i class="fas fa-user-circle text-xl"></i>
                            </button>
                            <div id="user-dropdown"
                                class="absolute right-0 mt-2 w-52 bg-paper border-4 border-ink shadow-[5px_5px_0px_var(--shadow-c)] py-1 transition-all duration-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible z-[999]">
                                <a href="login.php" id="nav-login-btn"
                                    class="flex items-center gap-3 px-4 py-3 text-sm font-semibold uppercase tracking-widest text-ink hover:bg-mustard transition">
                                    <i class="fas fa-sign-in-alt text-brick"></i> Emang lu admin?
                                </a>
                                <button onclick="openUploadModal()" id="nav-upload-btn"
                                    class="hidden w-full text-left flex items-center gap-3 px-4 py-3 text-sm font-semibold uppercase tracking-widest text-ink hover:bg-mustard transition">
                                    <i class="fas fa-upload text-brick"></i> Upload Arsip
                                </button>
                                <button onclick="handleLogout()" id="nav-logout-btn"
                                    class="hidden w-full text-left flex items-center gap-3 px-4 py-3 text-sm font-semibold uppercase tracking-widest text-brick hover:bg-mustard transition border-t-2 border-dashed border-ink">
                                    <i class="fas fa-power-off mr-1"></i> Logout
                                </button>
                            </div>
                        </div>
                        <div class="md:hidden">
                            <button onclick="toggleMobileMenu()"
                                class="w-9 h-9 flex items-center justify-center text-cream border-2 border-cream hover:bg-mustard hover:text-ink transition">
                                <i class="fas fa-bars text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="mobile-menu" class="hidden md:hidden bg-espresso border-t-4 border-ink">
                <div class="px-3 pt-3 pb-4 space-y-2">
                    <button onclick="switchTab('home')"
                        class="mobile-nav-btn bg-mustard text-ink border-ink border-2 block px-4 py-3 text-base font-semibold uppercase tracking-widest w-full text-left transition-all duration-200">Home</button>
                    <button onclick="switchTab('structure')"
                        class="mobile-nav-btn text-cream border-transparent border-2 block px-4 py-3 text-base font-semibold uppercase tracking-widest w-full text-left transition-all duration-200">Structure</button>
                    <button onclick="switchTab('documentation')"
                        class="mobile-nav-btn text-cream border-transparent border-2 block px-4 py-3 text-base font-semibold uppercase tracking-widest w-full text-left transition-all duration-200">Documentation</button>
                    <button onclick="switchTab('pendaftaran')"
                        class="mobile-nav-btn text-cream border-transparent border-2 block px-4 py-3 text-base font-semibold uppercase tracking-widest w-full text-left transition-all duration-200">Pendaftaran</button>
                </div>
            </div>
        </nav>

        <div class="h-[68px] shrink-0"></div>

        <!-- MARQUEE STRIP -->
        <div class="bg-mustard border-b-4 border-ink overflow-hidden" aria-hidden="true">
            <div class="marquee-track font-display uppercase text-xs md:text-sm py-2 text-ink">
                <div class="marquee-group">
                    <span>HMPS KPI 2026</span><span>★</span><span>The Golden Era</span><span>★</span><span>Dakwah
                        Cerdas,
                        Media
                        Berkualitas</span><span>★</span><span>UIN AMSARI PO.</span><span>★</span>
                    <span>HMPS KPI</span><span>★</span><span>The Golden Era</span><span>★</span><span>Dakwah Cerdas,
                        Media
                        Berkualitas</span><span>★</span><span>UIN AMSARI PO.</span><span>★</span>
                </div>
                <div class="marquee-group">
                    <span>HMPS KPI 2026</span><span>★</span><span>The Golden Era</span><span>★</span><span>Dakwah
                        Cerdas,
                        Media
                        Berkualitas</span><span>★</span><span>UIN AMSARI PO.</span><span>★</span>
                    <span>HMPS KPI 2026</span><span>★</span><span>The Golden Era</span><span>★</span><span>Dakwah
                        Cerdas,
                        Media
                        Berkualitas</span><span>★</span><span>UIN AMSARI PO.</span><span>★</span>
                </div>
            </div>
        </div>

        <main class="flex-grow pt-8 px-4 md:px-8 max-w-7xl mx-auto w-full">

            <div class="ornament-layer" aria-hidden="true">
                <span class="ornament ornament-halftone ornament-halftone--bl ornament-halftone--big hidden md:block"
                    style="top:auto"></span>
                <span class="ornament ornament-halftone ornament-halftone--br hidden md:block"></span>
            </div>
            <!-- ==================== HOME ==================== -->
            <section id="home" class="active-section ornament-host py-6 md:py-10">
                <!-- ORNAMEN section: sinar sunburst + halftone -->

                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6 text-center md:text-left">
                        <!-- Mobile: logo + vinyl kecil -->
                        <div class="md:hidden flex justify-center items-center gap-4">
                            <img src="logo.jpg" alt="Class Logo Mobile"
                                class="w-24 h-24 object-contain bg-mustard border-4 border-ink shadow-[4px_4px_0px_var(--shadow-c)]"
                                onerror="this.style.display='none'">
                            <div class="vinyl vinyl-spin w-20 h-20"></div>
                        </div>

                        <span class="rt-ticket">No. 01 · Edisi 2026</span>

                        <div class="relative ornament-host">
                            <!-- <div class="ornament-layer" aria-hidden="true">
                                <span
                                    class="ornament ornament-star ornament-star--ghost ornament-star--xl -top-24 -right-20 rotate-12"></span>
                            </div> -->
                            <h2
                                class="text-5xl sm:text-6xl md:text-5xl lg:text-6xl xl:text-7xl font-display uppercase leading-[0.95] tracking-tight">
                                WELCOME TO <br>
                                <span class="text-brick">OFFICIAL</span> <br>
                                HMPS KPI <br> WEBSITE
                            </h2>
                        </div>

                        <p
                            class="relative text-base md:text-lg leading-relaxed bg-paper border-2 border-dashed border-ink p-4 text-left">
                            <span class="ornament ornament-tape ornament-tape--stripe -top-3 left-6 -rotate-3"
                                aria-hidden="true"></span>
                            "Dunia penyiaran terus berubah, jadilah sarjana komunikasi yang adaptif dan tahan banting
                            untuk menghadapi tantangan global. Bersama HMPS KPI, kita akan menjelajahi inovasi,
                            memperkuat solidaritas, dan membangun masa depan yang cerah dalam dunia komunikasi."
                        </p>

                        <div class="flex flex-wrap gap-4 pt-2 justify-center md:justify-start">
                            <button onclick="switchTab('documentation')" class="rt-btn rt-btn-red">
                                ★ Let's Go !!!
                            </button>
                            <button onclick="switchTab('structure')" class="rt-btn rt-btn-paper">
                                Mahasiswa
                            </button>
                        </div>

                        <div class="relative grid grid-cols-3 gap-3 pt-4">
                            <span
                                class="ornament ornament-star ornament-star--md -top-8 -right-2 md:-right-6 rotate-12 hidden sm:grid"
                                style="--s:4.2rem" aria-hidden="true"><span>Since<br>2026</span></span>
                            <div
                                class="relative overflow-hidden ornament-host bg-mustard border-4 border-ink shadow-[4px_4px_0px_var(--shadow-c)] p-3 text-center">
                                <span class="ornament ornament-halftone ornament-halftone--br ornament-halftone--sm"
                                    aria-hidden="true"></span>
                                <h3 class="font-display text-3xl">24</h3>
                                <p class="text-[10px] md:text-xs uppercase tracking-widest font-semibold">Mahasiswa</p>
                            </div>
                            <div
                                class="relative overflow-hidden ornament-host bg-paper border-4 border-ink shadow-[4px_4px_0px_var(--shadow-c)] p-3 text-center">
                                <span class="ornament ornament-halftone ornament-halftone--br ornament-halftone--sm"
                                    aria-hidden="true"></span>
                                <h3 class="font-display text-3xl">9</h3>
                                <p class="text-[10px] md:text-xs uppercase tracking-widest font-semibold">Laki-laki</p>
                            </div>
                            <div
                                class="relative overflow-hidden ornament-host bg-brick text-cream border-4 border-ink shadow-[4px_4px_0px_var(--shadow-c)] p-3 text-center">
                                <span
                                    class="ornament ornament-halftone ornament-halftone--br ornament-halftone--sm ornament-halftone--cotton"
                                    aria-hidden="true"></span>
                                <h3 class="font-display text-3xl">15</h3>
                                <p class="text-[10px] md:text-xs uppercase tracking-widest font-semibold">Perempuan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom kanan (desktop): piringan + kartu motto -->
                    <div class="relative hidden md:block pt-10 pr-6">
                        <!-- Sinar sunburst: titik tengahnya tepat di tengah piringan -->
                        <span class="ornament ornament-rays w-[90rem] h-[90rem]" aria-hidden="true"
                            style="top:6.5rem; right:6rem; transform:translate(50%,-50%); --rx:50%; --ry:50%"></span>
                        <div class="vinyl vinyl-spin w-56 h-56 absolute -top-2 -right-4 z-0"></div>
                        <div
                            class="relative ornament-host z-10 bg-espresso border-4 border-ink p-4 shadow-[10px_10px_0px_var(--shadow-hi-c)] rotate-2 hover:rotate-0 transition-transform duration-300 mt-16">
                            <div class="ornament-layer" aria-hidden="true">
                                <span
                                    class="ornament ornament-halftone ornament-halftone--tr ornament-halftone--cotton"></span>
                                <span
                                    class="ornament ornament-halftone ornament-halftone--bl ornament-halftone--cotton ornament-halftone--sm"></span>
                            </div>
                            <span class="tape -top-3 left-8 -rotate-3"></span>
                            <span class="ornament ornament-star ornament-star--md -top-14 -left-10 -rotate-12"
                                aria-hidden="true"><span>Vol.<br>1</span></span>
                            <span class="ornament ornament-tape ornament-tape--dots -bottom-3 right-10 rotate-3"
                                aria-hidden="true"></span>
                            <div class="bg-cream border-4 border-ink p-6">
                                <div class="flex items-center gap-4 mb-5">
                                    <img src="https://i.postimg.cc/x8L0g9Bd/atmaaruthala.jpg" alt="Class Logo"
                                        class="w-20 h-20 object-cover border-4 border-ink bg-mustard shadow-[3px_3px_0px_var(--shadow-c)]"
                                        onerror="this.onerror=null; this.src='https://cdn-icons-png.flaticon.com/512/2997/2997322.png';">
                                    <div>
                                        <h4 class="font-display text-lg uppercase leading-tight">Motto HMPS KPI 2026
                                        </h4>
                                        <p class="text-xs font-semibold uppercase tracking-widest text-brick">★ Since
                                            2026</p>
                                    </div>
                                </div>
                                <blockquote
                                    class="font-display text-3xl uppercase leading-tight tracking-tight mb-6 border-y-4 border-dashed border-ink py-4">
                                    "Dakwah Cerdas, Media Berkualitas."
                                </blockquote>
                                <div
                                    class="flex justify-between items-center text-sm font-semibold uppercase tracking-widest">
                                    <span>HMPS KPI 2026 Family</span>
                                    <i class="fas fa-fingerprint text-brick text-2xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="stamp absolute -bottom-6 -left-2 -rotate-6 px-3 py-1 text-xs z-20">Official · HMPS
                            KPI · 2026</div>
                    </div>
                </div>

                <!-- ======= SETLIST PROKER (TURNTABLE) ======= -->
                <div class="mt-20 pt-0">
                    <div class="ornament-zigzag mb-12" aria-hidden="true"></div>
                    <div class="text-center mb-10 ornament-host">
                        <div class="ornament-layer" aria-hidden="true">
                            <span
                                class="ornament ornament-star ornament-star--ghost ornament-star--xl left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rotate-12"></span>
                            <span class="ornament ornament-halftone ornament-halftone--tl ornament-halftone--sm"></span>
                        </div>
                        <span class="rt-ticket mb-3">Side A · Setlist</span>
                        <h2
                            class="font-display uppercase leading-[0.9] tracking-tight mt-3 text-5xl sm:text-7xl lg:text-8xl">
                            <span class="fill-text">KPI</span> <span class="outline-text">RECORDS</span>
                        </h2>
                        <div class="star-divider max-w-xs mx-auto my-4"><span>★</span></div>
                        <p class="text-sm md:text-base font-medium uppercase tracking-widest">Our Favourite Playlist ·
                            Program Kerja The Golden Era</p>
                    </div>
                    <div class="grid lg:grid-cols-2 gap-10 lg:gap-14 items-center max-w-6xl mx-auto px-2">
                        <div class="turntable" id="turntable" role="button" tabindex="0"
                            aria-label="Putar atau jeda musik" style="cursor:pointer" onclick="toggleMusic()"
                            onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();toggleMusic();}">
                            <div class="tt-plinth">
                                <span class="stamp-badge stamp-badge--solid -top-4 -right-3 rotate-6 hidden sm:block"
                                    aria-hidden="true">Hi-Fi Stereo</span>
                                <div class="tt-platter">
                                    <div class="vinyl vinyl-spin"></div>
                                </div>
                                <div class="tt-arm"></div>
                                <div class="tt-label">
                                    <span class="tt-led"></span>
                                    <span class="tt-title" id="tt-title">Side A · -</span>
                                    <span>33⅓ RPM</span>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <span class="ornament ornament-tape ornament-tape--stripe -top-3 left-10 -rotate-2"
                                aria-hidden="true"></span>
                            <span class="ornament ornament-tape ornament-tape--dots -bottom-3 right-12 rotate-3"
                                aria-hidden="true"></span>
                            <span class="stamp-badge stamp-badge--red -top-5 right-4 rotate-6" aria-hidden="true">Hit
                                Parade</span>
                            <div class="track-list" id="proker-timeline"></div>
                        </div>
                    </div>
                </div>

                <!-- ======= KABAR TERKINI ======= -->
                <div class="mt-20 pt-12 border-t-4 border-dashed border-ink">
                    <div class="text-center mb-12 ornament-host">
                        <div class="ornament-layer" aria-hidden="true">
                            <span
                                class="ornament ornament-star ornament-star--ghost ornament-star--xl left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-6"></span>
                            <span class="ornament ornament-halftone ornament-halftone--tr ornament-halftone--sm"></span>
                        </div>
                        <span class="rt-ticket mb-3">No. 02 · Berita</span>
                        <h2 class="text-4xl md:text-6xl font-display uppercase tracking-tight leading-none mt-3 mb-3">
                            Kabar <span class="text-brick">Terkini</span></h2>
                        <div class="star-divider max-w-xs mx-auto mb-4"><span>★</span></div>
                        <p class="text-sm md:text-base font-medium uppercase tracking-widest">Informasi, Berita, dan
                            Karya Terbaru dari HMPS KPI</p>
                    </div>

                    <div id="news-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pt-3">
                    </div>

                    <div id="news-btn-container" class="mt-12 text-center" style="display: none;">
                        <button onclick="toggleNews()" class="rt-btn rt-btn-ink">
                            <span id="btn-news-text">Lihat Semua Artikel</span>
                            <i id="btn-news-icon" class="fas fa-angle-double-right ml-2"></i>
                        </button>
                    </div>

                    <!-- ======= POSTER ======= -->
                    <div class="mt-20 pt-0">
                        <div class="ornament-zigzag mb-10" aria-hidden="true"></div>
                        <div class="flex justify-between items-end mb-4 gap-4">
                            <div>
                                <span class="rt-ticket mb-2">No. 03 · Poster</span>
                                <h3
                                    class="text-2xl md:text-4xl font-display uppercase tracking-tight border-l-8 border-brick pl-4 mt-2 leading-tight">
                                    Poster <span class="text-brick">Pemberitahuan</span>
                                </h3>
                                <p class="text-xs md:text-sm mt-2 pl-5 font-medium">Karya visual pemberitahuan dan
                                    events yang akan diselenggarakan.</p>
                            </div>
                            <button
                                onclick="switchTab('documentation'); setTimeout(()=>openEventFolder('E04', 'POSTER PEMBERITAHUAN'), 100);"
                                class="rt-btn rt-btn-paper hidden md:inline-flex !py-2 !text-xs shrink-0">
                                Lihat Semua Album <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>

                        <div id="home-poster-carousel"
                            class="flex overflow-x-auto gap-5 pt-6 pb-8 px-2 snap-x cursor-grab [&::-webkit-scrollbar]:hidden"
                            style="scrollbar-width: none; -ms-overflow-style: none; touch-action: pan-x; -webkit-overflow-scrolling: touch;">
                        </div>
                    </div>

                    <!-- ======= COUNTDOWN ======= -->
                    <div class="max-w-4xl mx-auto px-4 mb-20 mt-16">
                        <div id="countdown-card"
                            class="relative ornament-host bg-brick text-cream border-4 border-ink shadow-[8px_8px_0px_var(--shadow-c)] p-5 sm:p-8 md:p-10 text-center">
                            <div class="ornament-layer" aria-hidden="true">
                                <span class="ornament ornament-rays ornament-rays--cotton top-0 left-0 w-full h-full"
                                    style="--rx:50%;--ry:50%"></span>
                                <span
                                    class="ornament ornament-halftone ornament-halftone--tl ornament-halftone--cotton"></span>
                                <span
                                    class="ornament ornament-halftone ornament-halftone--br ornament-halftone--cotton"></span>
                            </div>
                            <span class="tape -top-3 left-1/2 -translate-x-1/2 rotate-2"></span>
                            <div
                                class="sticker absolute -top-5 -right-3 w-14 h-14 rotate-12 text-2xl bg-mustard !text-ink">
                                ★</div>
                            <?= rt_round_stamp('★ HMPS KPI ★ THE GOLDEN ERA ★ ', '2026', 'Est.', '-bottom-10 -left-6 -rotate-12 hidden md:block', '6.5rem') ?>

                            <h3 id="countdown-title"
                                class="text-mustard font-display text-xs md:text-sm uppercase tracking-[0.3em] mb-2">
                                Upcoming Grand Event</h3>
                            <h2 class="font-display text-3xl md:text-5xl uppercase tracking-tight mb-4">Festival Budaya
                                Komunikasi
                            </h2>
                            <div class="ornament-zigzag mb-6" aria-hidden="true"></div>

                            <div id="countdown-timer" class="flex justify-center items-start gap-2 md:gap-6">
                                <div class="flex flex-col items-center">
                                    <span id="days"
                                        class="font-display text-3xl sm:text-4xl md:text-6xl bg-paper text-ink border-4 border-ink shadow-[4px_4px_0px_var(--shadow-c)] px-2 md:px-5 py-2 min-w-[4rem] md:min-w-[7rem]">00</span>
                                    <span
                                        class="text-[10px] md:text-xs uppercase tracking-widest font-semibold mt-3">Hari</span>
                                </div>
                                <div class="font-display text-3xl sm:text-4xl md:text-6xl text-mustard pt-2">:</div>
                                <div class="flex flex-col items-center">
                                    <span id="hours"
                                        class="font-display text-3xl sm:text-4xl md:text-6xl bg-paper text-ink border-4 border-ink shadow-[4px_4px_0px_var(--shadow-c)] px-2 md:px-5 py-2 min-w-[4rem] md:min-w-[7rem]">00</span>
                                    <span
                                        class="text-[10px] md:text-xs uppercase tracking-widest font-semibold mt-3">Jam</span>
                                </div>
                                <div class="font-display text-3xl sm:text-4xl md:text-6xl text-mustard pt-2">:</div>
                                <div class="flex flex-col items-center">
                                    <span id="minutes"
                                        class="font-display text-3xl sm:text-4xl md:text-6xl bg-paper text-ink border-4 border-ink shadow-[4px_4px_0px_var(--shadow-c)] px-2 md:px-5 py-2 min-w-[4rem] md:min-w-[7rem]">00</span>
                                    <span
                                        class="text-[10px] md:text-xs uppercase tracking-widest font-semibold mt-3">Menit</span>
                                </div>
                            </div>

                            <p class="text-xs md:text-sm mt-8 italic border-t-2 border-dashed border-cream/60 pt-4">
                                "Persiapkan karya terbaikmu untuk era keemasan penyiaran."</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==================== STRUCTURE ==================== -->
            <section id="structure" class="hidden-section ornament-host py-6 md:py-10">
                <div class="ornament-layer" aria-hidden="true">
                    <span class="ornament ornament-halftone ornament-halftone--tr hidden md:block"></span>
                    <span
                        class="ornament ornament-halftone ornament-halftone--bl ornament-halftone--big hidden md:block"></span>
                </div>
                <div class="text-center mb-12 ornament-host">
                    <div class="ornament-layer" aria-hidden="true">
                        <span
                            class="ornament ornament-star ornament-star--ghost ornament-star--xl left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rotate-6"></span>
                        <span class="ornament ornament-halftone ornament-halftone--tl ornament-halftone--sm"></span>
                    </div>
                    <span class="rt-ticket mb-3">No. 04 · Kepengurusan</span>
                    <h2 class="text-4xl md:text-6xl font-display uppercase tracking-tight leading-none mt-3 mb-3">
                        Struktur Organisasi</h2>
                    <div class="star-divider max-w-xs mx-auto mb-4"><span>★</span></div>
                    <p class="text-sm md:text-base font-medium uppercase tracking-widest">HMPS KPI 2026 - The Golden Era
                    </p>
                </div>

                <!-- Desktop tree -->
                <div class="hidden md:flex justify-center overflow-x-auto pb-16 custom-scrollbar">
                    <div class="tree min-w-[900px]">
                        <ul>
                            <li>
                                <div class="member-card inline-block w-52 p-4 bg-mustard hover:-translate-y-1"
                                    onclick="openBioModalByName('Aqilla Nindita N. M.')">
                                    <span class="ornament ornament-star ornament-star--sm -top-4 -right-4 rotate-12"
                                        aria-hidden="true"><span>★</span></span>
                                    <div class="w-20 h-20 mx-auto mb-3 border-4 border-ink overflow-hidden bg-cream">
                                        <img src="assets/mahasiswa/qila2.webp" class="w-full h-full object-cover">
                                    </div>
                                    <h3 class="font-display text-sm uppercase leading-tight">Aqilla Nindita</h3>
                                    <p
                                        class="mt-2 inline-block bg-ink text-cream text-[10px] px-2 py-0.5 tracking-widest uppercase font-semibold">
                                        ★ Ketua Umum</p>
                                </div>
                                <ul>
                                    <li>
                                        <div class="member-card inline-block w-52 p-4 hover:-translate-y-1"
                                            onclick="openBioModalByName('Renny Ismawati')">
                                            <div
                                                class="w-20 h-20 mx-auto mb-3 border-4 border-ink overflow-hidden bg-mustard">
                                                <img src="assets/mahasiswa/renny (1).webp"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <h3 class="font-display text-sm uppercase leading-tight">Renny Ismawati</h3>
                                            <p
                                                class="mt-2 inline-block bg-brick text-cream text-[10px] px-2 py-0.5 tracking-widest uppercase font-semibold">
                                                Wakil Ketua</p>
                                        </div>
                                        <ul class="flex justify-center">
                                            <li class="px-5">
                                                <div class="flex flex-col gap-4 pt-4">
                                                    <div class="member-card w-44 p-3 text-center hover:-translate-y-1"
                                                        onclick="openBioModalByName('Siti Nur Azizah')">
                                                        <div
                                                            class="w-14 h-14 mx-auto mb-2 border-2 border-ink overflow-hidden bg-mustard">
                                                            <img src="assets/mahasiswa/nur.webp"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                        <h3 class="font-display text-xs uppercase leading-tight">Siti
                                                            Nur Azizah</h3>
                                                        <p
                                                            class="text-[10px] text-brick font-semibold uppercase tracking-widest">
                                                            Sekretaris 1</p>
                                                    </div>
                                                    <div class="member-card w-44 p-3 text-center hover:-translate-y-1"
                                                        onclick="openBioModalByName('Nabil Tri Yoga')">
                                                        <div
                                                            class="w-14 h-14 mx-auto mb-2 border-2 border-ink overflow-hidden bg-mustard">
                                                            <img src="assets/mahasiswa/nabilpp.webp"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                        <h3 class="font-display text-xs uppercase leading-tight">Nabil
                                                            Tri Yoga</h3>
                                                        <p
                                                            class="text-[10px] text-brick font-semibold uppercase tracking-widest">
                                                            Sekretaris 2</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="px-5">
                                                <div class="flex flex-col gap-4 pt-4">
                                                    <div class="member-card w-44 p-3 text-center hover:-translate-y-1"
                                                        onclick="openBioModalByName('Khoirul Latifah')">
                                                        <div
                                                            class="w-14 h-14 mx-auto mb-2 border-2 border-ink overflow-hidden bg-mustard">
                                                            <img src="assets/mahasiswa/ipah.webp"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                        <h3 class="font-display text-xs uppercase leading-tight">Khoirul
                                                            Latifah</h3>
                                                        <p
                                                            class="text-[10px] text-brick font-semibold uppercase tracking-widest">
                                                            Bendahara 1</p>
                                                    </div>
                                                    <div class="member-card w-44 p-3 text-center hover:-translate-y-1"
                                                        onclick="openBioModalByName('Aisyah Imtiyaz T.')">
                                                        <div
                                                            class="w-14 h-14 mx-auto mb-2 border-2 border-ink overflow-hidden bg-mustard">
                                                            <img src="assets/mahasiswa/ais.webp"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                        <h3 class="font-display text-xs uppercase leading-tight">Aisyah
                                                            Imtiyaz</h3>
                                                        <p
                                                            class="text-[10px] text-brick font-semibold uppercase tracking-widest">
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
                <div class="md:hidden flex flex-col items-center space-y-3 px-2 pb-10">
                    <div class="member-card bg-mustard p-4 w-full max-w-[280px] text-center relative z-20"
                        onclick="openBioModalByName('Aqilla Nindita N. M.')">
                        <span class="ornament ornament-star ornament-star--sm -top-4 -right-3 rotate-12"
                            aria-hidden="true"><span>★</span></span>
                        <div class="w-16 h-16 mx-auto mb-2 border-4 border-ink overflow-hidden bg-cream">
                            <img src="assets/mahasiswa/qila2.webp" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-display text-sm uppercase">Aqilla Nindita</h3>
                        <p class="text-[10px] text-ink font-bold uppercase tracking-widest">★ Ketua Umum</p>
                    </div>
                    <div class="h-6 w-1 bg-ink"></div>
                    <div class="member-card p-4 w-full max-w-[280px] text-center relative z-20"
                        onclick="openBioModalByName('Renny Ismawati')">
                        <div class="w-16 h-16 mx-auto mb-2 border-4 border-ink overflow-hidden bg-mustard">
                            <img src="assets/mahasiswa/renny (1).webp" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-display text-sm uppercase">Renny Ismawati</h3>
                        <p class="text-[10px] text-brick font-bold uppercase tracking-widest">Wakil Ketua</p>
                    </div>
                    <div class="h-6 w-1 bg-ink"></div>
                    <div class="grid grid-cols-2 gap-4 w-full px-1">
                        <div class="space-y-4">
                            <div class="member-card p-3 text-center relative z-20"
                                onclick="openBioModalByName('Siti Nur Azizah')">
                                <div class="w-12 h-12 mx-auto mb-2 border-2 border-ink overflow-hidden bg-mustard">
                                    <img src="assets/mahasiswa/nur.webp" class="w-full h-full object-cover">
                                </div>
                                <p class="font-display text-[11px] uppercase leading-tight">Siti Nur Azizah</p>
                                <p class="text-[9px] text-brick font-bold uppercase tracking-widest">Sekretaris 1</p>
                            </div>
                            <div class="member-card p-3 text-center relative z-20"
                                onclick="openBioModalByName('Nabil Tri Yoga')">
                                <div class="w-12 h-12 mx-auto mb-2 border-2 border-ink overflow-hidden bg-mustard">
                                    <img src="assets/mahasiswa/nabilpp.webp" class="w-full h-full object-cover">
                                </div>
                                <p class="font-display text-[11px] uppercase leading-tight">Nabil Tri Yoga</p>
                                <p class="text-[9px] text-brick font-bold uppercase tracking-widest">Sekretaris 2</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="member-card p-3 text-center relative z-20"
                                onclick="openBioModalByName('Khoirul Latifah')">
                                <div class="w-12 h-12 mx-auto mb-2 border-2 border-ink overflow-hidden bg-mustard">
                                    <img src="assets/mahasiswa/ipah.webp" class="w-full h-full object-cover">
                                </div>
                                <p class="font-display text-[11px] uppercase leading-tight">Khoirul Latifah</p>
                                <p class="text-[9px] text-brick font-bold uppercase tracking-widest">Bendahara 1</p>
                            </div>
                            <div class="member-card p-3 text-center relative z-20"
                                onclick="openBioModalByName('Aisyah Imtiyaz T.')">
                                <div class="w-12 h-12 mx-auto mb-2 border-2 border-ink overflow-hidden bg-mustard">
                                    <img src="assets/mahasiswa/ais.webp" class="w-full h-full object-cover">
                                </div>
                                <p class="font-display text-[11px] uppercase leading-tight">Aisyah Imtiyaz T.</p>
                                <p class="text-[9px] text-brick font-bold uppercase tracking-widest">Bendahara 2</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dokumen resmi -->
                <div class="max-w-4xl mx-auto px-2 md:px-4 mb-16">
                    <div class="rt-card relative ornament-host p-6 md:p-8">
                        <div class="ornament-layer" aria-hidden="true">
                            <span class="ornament ornament-halftone ornament-halftone--tr"></span>
                            <span class="ornament ornament-halftone ornament-halftone--bl ornament-halftone--sm"></span>
                        </div>
                        <span class="tape -top-3 left-10 -rotate-2"></span>
                        <span class="stamp-badge stamp-badge--red -top-4 right-8 rotate-6 hidden md:block"
                            aria-hidden="true">Approved</span>
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="text-center md:text-left">
                                <span class="rt-ticket mb-2">Arsip Resmi</span>
                                <h3 class="font-display text-xl md:text-2xl uppercase tracking-tight mt-2 mb-1">Dokumen
                                    Resmi HMPS</h3>
                                <p class="text-xs md:text-sm">Unduh SK Kepengurusan dan Kalender Program Kerja The
                                    Golden Era.</p>
                            </div>
                            <div class="flex flex-wrap justify-center gap-3">
                                <a href="assets/dokumen/SK_PENGURUS_2026.pdf" download
                                    class="rt-btn rt-btn-red !text-xs !px-4 !py-2">
                                    <i class="fas fa-file-pdf"></i> SK PENGURUS
                                </a>
                                <a href="assets/dokumen/KALENDER_PROKER.pdf" download
                                    class="rt-btn rt-btn-paper !text-xs !px-4 !py-2">
                                    <i class="fas fa-calendar-alt"></i> KALENDER PROKER
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Struktur divisi -->
                <div class="mt-16 pt-12 border-t-4 border-dashed border-ink">
                    <div class="text-center mb-12 ornament-host">
                        <div class="ornament-layer" aria-hidden="true">
                            <span
                                class="ornament ornament-star ornament-star--ghost ornament-star--xl left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-12"></span>
                            <span class="ornament ornament-halftone ornament-halftone--tr ornament-halftone--sm"></span>
                        </div>
                        <span class="rt-ticket mb-3">No. 05 · Divisi</span>
                        <h3 class="font-display text-3xl md:text-5xl uppercase tracking-tight mt-3 mb-3">Struktur
                            <span class="text-brick">Divisi</span>
                        </h3>
                        <div class="star-divider max-w-xs mx-auto mb-4"><span>★</span></div>
                        <p class="text-sm font-medium uppercase tracking-widest">Empat pilar utama penggerak HMPS KPI
                            2026.</p>
                    </div>
                    <div class="max-w-md mx-auto px-4 mb-10 hidden md:block">
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                <i class="fas fa-search text-brick"></i>
                            </div>
                            <input type="text" id="member-search" onkeyup="filterMembers()"
                                placeholder="Cari nama pengurus..." class="rt-input !pl-12 uppercase tracking-wider">
                        </div>
                    </div>
                    <div id="division-container" class="space-y-24 max-w-6xl mx-auto px-4">
                    </div>
                </div>

                <!-- Family -->
                <div class="text-center py-16">
                    <button onclick="toggleFamilyGallery()"
                        class="rt-btn rt-btn-ink !px-6 md:!px-12 !py-5 !shadow-[8px_8px_0px_var(--shadow-hi-c)] hover:!shadow-[4px_4px_0px_var(--shadow-hi-c)]">
                        <i class="fas fa-users text-2xl md:text-3xl text-mustard"></i>
                        <span class="font-display text-base md:text-xl tracking-widest">FAMILY HMPS KPI 2026</span>
                    </button>
                </div>
            </section>

            <!-- ==================== DOCUMENTATION ==================== -->
            <section id="documentation" class="hidden-section ornament-host py-6 md:py-10">
                <div class="ornament-layer" aria-hidden="true">
                    <span class="ornament ornament-halftone ornament-halftone--tl hidden md:block"></span>
                    <span
                        class="ornament ornament-halftone ornament-halftone--br ornament-halftone--big hidden md:block"></span>
                </div>
                <div class="text-center mb-10 ornament-host">
                    <div class="ornament-layer" aria-hidden="true">
                        <span
                            class="ornament ornament-star ornament-star--ghost ornament-star--xl left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rotate-12"></span>
                        <span class="ornament ornament-halftone ornament-halftone--tl ornament-halftone--sm"></span>
                    </div>
                    <span class="rt-ticket mb-3">No. 06 · Galeri</span>
                    <h2 class="text-4xl md:text-6xl font-display uppercase tracking-tight leading-none mt-3 mb-3">
                        Archives
                    </h2>
                    <div class="star-divider max-w-xs mx-auto mb-4"><span>★</span></div>
                    <p class="text-sm md:text-base font-medium uppercase tracking-widest mb-6" id="doc-subtitle">
                        Memories
                        &amp; Moments</p>

                    <div id="doc-controls"
                        class="hidden flex-col md:flex-row justify-center items-center gap-3 max-w-2xl mx-auto mb-8">
                        <button onclick="backToFolders()"
                            class="rt-btn rt-btn-ink w-full md:w-auto !py-2 !text-xs whitespace-nowrap">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </button>

                        <button id="btn-bulk-delete" onclick="confirmBulkDelete()"
                            class="rt-btn rt-btn-red hidden w-full md:w-auto !py-2 !text-xs items-center justify-center gap-2 whitespace-nowrap">
                            <i class="fas fa-trash-alt"></i>
                            <span>Hapus (<span id="bulk-delete-count">0</span>)</span>
                        </button>

                        <div class="relative w-full">
                            <input type="text" id="doc-search" placeholder="Cari dokumentasi..."
                                onkeyup="handleSearch(event)" class="rt-input !py-2 !pr-12 text-center md:text-left">
                            <button onclick="handleSearch({key: 'Enter'})"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-ink hover:text-brick">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div id="event-folders-grid" class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto px-4 pt-3">
                </div>
                <div id="documentation-grid" class="hidden columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6"></div>
            </section>

            <!-- ==================== PENDAFTARAN ==================== -->
            <section id="pendaftaran" class="hidden-section ornament-host py-6 md:py-10">
                <div class="ornament-layer" aria-hidden="true">
                    <span class="ornament ornament-halftone ornament-halftone--tr hidden md:block"></span>
                    <span
                        class="ornament ornament-halftone ornament-halftone--bl ornament-halftone--big hidden md:block"></span>
                </div>
                <div class="text-center mb-12 ornament-host">
                    <div class="ornament-layer" aria-hidden="true">
                        <span
                            class="ornament ornament-star ornament-star--ghost ornament-star--xl left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-6"></span>
                        <span class="ornament ornament-halftone ornament-halftone--tr ornament-halftone--sm"></span>
                    </div>
                    <span class="rt-ticket mb-3">No. 07 · Open Registration</span>
                    <h2 class="text-4xl md:text-6xl font-display uppercase tracking-tight leading-none mt-3 mb-3">Portal
                        <span class="text-brick">Pendaftaran</span>
                    </h2>
                    <div class="star-divider max-w-xs mx-auto mb-4"><span>★</span></div>
                    <p class="text-sm md:text-base font-medium uppercase tracking-widest">Silakan pilih lomba yang ingin
                        kamu ikuti di bawah ini.</p>
                </div>

                <div id="pendaftaran-list" class="max-w-4xl mx-auto px-4 grid grid-cols-1 gap-8 pt-3">
                </div>
            </section>
        </main>

        <!-- NOW PLAYING -->
        <button type="button" id="now-playing" class="now-playing is-playing" onclick="shuffleNext()"
            aria-label="Putar lagu acak berikutnya" title="Klik untuk lagu acak berikutnya">
            <div class="vinyl vinyl-spin np-vinyl"></div>
            <div class="np-text">
                <div class="text-[9px] uppercase tracking-[0.25em] text-mustard font-semibold">Now Playing</div>
                <div class="text-xs font-semibold uppercase tracking-wider np-title-line" id="np-title">-</div>
            </div>
            <div class="np-eq" aria-hidden="true"><i></i><i></i><i></i></div>
            <i class="fas fa-shuffle text-xs text-mustard" aria-hidden="true"></i>
        </button>

        <!-- ==================== FOOTER ==================== -->
        <footer
            class="relative ornament-host overflow-hidden bg-espresso text-cream border-t-4 border-ink mt-12 pt-12 pb-8">
            <!-- ORNAMEN footer: tepi zigzag, halftone, stempel bulat (semua di belakang konten) -->
            <div class="ornament-layer" aria-hidden="true">
                <div class="ornament ornament-zigzag top-2 left-0 right-0"></div>
                <span class="ornament ornament-halftone ornament-halftone--tl ornament-halftone--cotton"></span>
                <span
                    class="ornament ornament-halftone ornament-halftone--br ornament-halftone--cotton ornament-halftone--big"></span>
                <?= rt_round_stamp('★ HMPS KPI ★ UIN AMSARI ★ ', 'Est.', '2026', 'stamp-round--faint -bottom-8 left-6 -rotate-12 hidden md:block', '8rem') ?>
            </div>
            <div
                class="vinyl vinyl-spin w-40 h-40 absolute -bottom-12 -right-12 opacity-80 hidden md:block pointer-events-none">
            </div>
            <div class="relative max-w-7xl mx-auto px-4">
                <div class="flex items-center gap-4 mb-10">
                    <span class="flex-grow border-t-4 border-dashed border-cream/40"></span>
                    <span class="text-mustard text-2xl">★ ★ ★</span>
                    <span class="flex-grow border-t-4 border-dashed border-cream/40"></span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-8 pb-8">
                    <div class="text-left">
                        <h3
                            class="font-display text-xl text-mustard uppercase mb-4 border-b-4 border-brick inline-block pb-1">
                            HMPS KPI 2026</h3>
                        <p class="text-sm leading-relaxed mt-2">
                            Menempa generasi komunikator unggul untuk mewujudkan <span
                                class="text-mustard font-bold">The Golden Era</span> penyiaran Islam yang kreatif dan
                            adaptif.
                        </p>
                    </div>
                    <div class="text-left">
                        <h3
                            class="font-display text-xl text-mustard uppercase mb-4 border-b-4 border-brick inline-block pb-1">
                            Kontak Kami</h3>
                        <div class="mt-2 flex flex-col gap-3">
                            <a href="https://maps.app.goo.gl/6riPJYNs8Bz7dGDT8" target="_blank"
                                class="text-sm flex items-center hover:text-mustard transition-colors group">
                                <i
                                    class="fas fa-map-marker-alt text-mustard w-6 text-center mr-2 group-hover:scale-110 transition-transform"></i>
                                Jl. Puspita Jaya, Krajan, Pintu, Kec. Jenangan
                            </a>
                            <a href="https://wa.me/6285755161229" target="_blank"
                                class="text-sm flex items-center hover:text-mustard transition-colors group">
                                <i
                                    class="fas fa-phone text-mustard w-6 text-center mr-2 group-hover:scale-110 transition-transform"></i>
                                0857-5516-1229
                            </a>
                            <a href="https://www.instagram.com/hmjkpi.uinpo/" target="_blank"
                                class="text-sm flex items-center hover:text-mustard transition-colors group">
                                <i
                                    class="fab fa-instagram text-mustard w-6 text-center mr-2 group-hover:scale-110 transition-transform"></i>
                                @hmpskpi.uinpo
                            </a>
                        </div>
                    </div>
                    <div class="text-left">
                        <h3
                            class="font-display text-xl text-mustard uppercase mb-4 border-b-4 border-brick inline-block pb-1">
                            Akademik</h3>
                        <div class="mt-2">
                            <p class="text-sm mb-3"><i class="fas fa-graduation-cap text-mustard mr-2"></i> Komunikasi
                                dan Penyiaran Islam</p>
                            <p class="text-sm mb-3"><i class="fas fa-calendar-alt text-mustard mr-2"></i> Angkatan 2026
                            </p>
                            <p class="text-sm"><i class="fas fa-users text-mustard mr-2"></i>Himpunan Mahasiswa Program
                                Studi</p>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col md:flex-row justify-between items-center gap-4 pt-6 border-t-2 border-dashed border-cream/40">
                    <p class="font-medium text-xs md:text-sm text-center md:text-left uppercase tracking-widest">© 2026
                        HMPS KPI - UIN AMSARI PONOROGO. All Rights Reserved.</p>
                    <div class="flex gap-3">
                        <a href="https://www.instagram.com/hmpskpi.uinpo" target="_blank"
                            class="w-10 h-10 bg-cream text-ink border-2 border-ink shadow-[3px_3px_0px_#edebdd] flex items-center justify-center hover:bg-mustard transition-all duration-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://uinponorogo.ac.id/" target="_blank"
                            class="w-10 h-10 bg-cream text-ink border-2 border-ink shadow-[3px_3px_0px_#edebdd] flex items-center justify-center hover:bg-mustard transition-all duration-200">
                            <i class="fas fa-globe"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- ==================== FAMILY GALLERY ==================== -->
    <div id="family-gallery" class="fullscreen-overlay" tabindex="0">
        <div class="max-w-7xl mx-auto px-4 pt-24 pb-10 relative">
            <button onclick="toggleFamilyGallery()"
                class="fixed top-4 right-4 md:top-6 md:right-6 z-[60] w-12 h-12 bg-brick text-cream border-4 border-ink shadow-[4px_4px_0px_var(--shadow-c)] hover:bg-mustard hover:text-ink transition flex items-center justify-center text-xl">
                <i class="fas fa-times"></i>
            </button>
            <div class="text-center mb-12 ornament-host">
                <div class="ornament-layer" aria-hidden="true">
                    <span
                        class="ornament ornament-star ornament-star--ghost ornament-star--xl left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rotate-6"></span>
                    <span class="ornament ornament-halftone ornament-halftone--tl ornament-halftone--sm"></span>
                </div>
                <span class="rt-ticket mb-3">★ The Family ★</span>
                <h2 class="text-4xl md:text-6xl font-display uppercase tracking-tight leading-none mt-3 mb-3">HMPS KPI
                    2026</h2>
                <div class="star-divider max-w-xs mx-auto mb-3"><span>★</span></div>
                <p class="text-brick text-lg font-semibold uppercase tracking-widest">Awaken The Golden Era</p>
            </div>
            <div id="student-grid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-5 md:gap-6"></div>
        </div>
    </div>

    <!-- ==================== MODAL BIO ==================== -->
    <div id="bio-modal" class="custom-modal" onclick="closeBioModal(event)">
        <div id="bio-content"
            class="w-[90%] md:w-full max-w-6xl max-h-[90vh] md:max-h-[85vh] overflow-y-auto transform scale-95 transition-all duration-300 flex flex-col md:flex-row bg-paper border-4 border-ink shadow-[10px_10px_0px_var(--shadow-hi-c)] relative"
            tabindex="0">
            <!-- Tombol close mobile (sticky, ikut scroll) -->
            <div class="md:hidden sticky top-0 z-50 h-0 flex justify-end pointer-events-none">
                <button onclick="closeBioModal(null, true)"
                    class="pointer-events-auto m-3 w-10 h-10 shrink-0 bg-brick text-cream border-4 border-ink shadow-[3px_3px_0px_var(--shadow-c)] flex items-center justify-center">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div
                class="w-full md:w-5/12 aspect-[4/5] md:aspect-[3/4] relative bg-mustard group shrink-0 border-b-4 md:border-b-0 md:border-r-4 border-ink">
                <span
                    class="ornament ornament-tape ornament-tape--stripe ornament-tape--lg -top-1 -left-8 -rotate-45 z-30"
                    aria-hidden="true"></span>
                <div id="modal-img-loader" class="img-loading-skeleton">
                    <i class="fas fa-spinner fa-spin text-ink text-4xl"></i>
                </div>
                <img id="modal-img" src="" alt="Profile Photo"
                    class="relative z-10 w-full h-full object-cover transition-opacity duration-500 opacity-0"
                    onerror="this.src='https://placehold.co/400x500?text=No+Image';">
                <div class="halftone absolute inset-0 z-20"></div>
                <div class="sticker absolute bottom-3 right-3 z-30 w-12 h-12 rotate-12 text-xl">★</div>
            </div>
            <div class="w-full md:w-7/12 p-6 md:p-10 flex flex-col justify-center text-left relative ornament-host">
                <div class="ornament-layer" aria-hidden="true">
                    <span class="ornament ornament-halftone ornament-halftone--tr"></span>
                    <span
                        class="ornament ornament-star ornament-star--ghost ornament-star--lg -bottom-14 -right-10 rotate-12 hidden md:grid"></span>
                    <span class="stamp-badge stamp-badge--faint bottom-5 left-6 -rotate-6 hidden md:block">Member · HMPS
                        KPI</span>
                </div>
                <span class="staple top-3 right-16 rotate-6 hidden md:block"></span>
                <div class="absolute bottom-2 right-4 opacity-10 hidden md:block pointer-events-none">
                    <i class="fas fa-fingerprint text-9xl text-ink"></i>
                </div>
                <div class="mb-6 md:mb-10 relative z-10 pr-0 md:pr-12">
                    <span class="rt-ticket mb-3">Profil Mahasiswa</span>
                    <h2 id="modal-name"
                        class="text-3xl md:text-5xl font-display uppercase mt-2 mb-3 tracking-tight leading-tight">
                        Name Here</h2>
                    <div class="flex items-center gap-3">
                        <span
                            class="px-4 py-1 bg-mustard border-2 border-ink text-ink font-semibold text-xs md:text-base tracking-widest"
                            id="modal-nim">NIM: 00000000</span>
                    </div>
                </div>
                <div class="space-y-4 relative z-10">
                    <div class="bio-info-row group">
                        <div class="bio-icon-box w-10 h-10 md:w-14 md:h-14 text-lg md:text-2xl">
                            <i class="fab fa-instagram"></i>
                        </div>
                        <div class="flex-grow pt-1 md:pt-2 min-w-0">
                            <span
                                class="text-[10px] md:text-xs text-brick uppercase tracking-[0.2em] font-bold block mb-1">Instagram</span>
                            <div id="modal-ig" class="text-sm md:text-xl break-words"></div>
                        </div>
                    </div>
                    <div class="bio-info-row group">
                        <div class="bio-icon-box w-10 h-10 md:w-14 md:h-14 text-lg md:text-2xl">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="flex-grow pt-1 md:pt-2 min-w-0">
                            <span
                                class="text-[10px] md:text-xs text-brick uppercase tracking-[0.2em] font-bold block mb-1">About
                                Me</span>
                            <p id="modal-bio"
                                class="leading-relaxed text-sm md:text-xl italic pr-0 md:pr-8 border-l-4 border-mustard pl-3">
                                "..."</p>
                        </div>
                    </div>
                </div>
                <button onclick="closeBioModal(null, true)"
                    class="hidden md:flex absolute top-4 right-4 z-50 bg-brick text-cream border-4 border-ink shadow-[3px_3px_0px_var(--shadow-c)] hover:bg-mustard hover:text-ink transition w-10 h-10 items-center justify-center text-lg">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- ==================== MODAL MEDIA ==================== -->
    <div id="media-modal" class="custom-modal" onclick="closeMediaModal(event)">
        <div class="relative max-w-5xl w-full mx-4 flex justify-center">
            <button onclick="closeMediaModal(null, true)"
                class="absolute -top-14 right-0 w-11 h-11 bg-brick text-cream border-4 border-ink shadow-[3px_3px_0px_var(--shadow-c)] hover:bg-mustard hover:text-ink text-xl transition z-50 flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>
            <div id="media-container"
                class="max-h-[85vh] border-4 border-cream shadow-[8px_8px_0px_var(--shadow-c)] bg-ink"></div>
        </div>
    </div>

    <!-- ==================== MODAL UPLOAD ADMIN ==================== -->
    <div id="upload-modal" class="custom-modal p-4 sm:p-8" onclick="closeUploadModal(event)">
        <div id="upload-content"
            class="w-full max-w-5xl h-[85vh] md:h-[80vh] bg-paper border-4 border-ink shadow-[10px_10px_0px_var(--shadow-hi-c)] flex flex-col relative transform scale-95 transition-all duration-300"
            onclick="event.stopPropagation()">

            <button onclick="closeUploadModal(null, true)"
                class="absolute top-3 right-3 md:top-4 md:right-4 z-50 w-9 h-9 bg-brick text-cream border-4 border-ink shadow-[3px_3px_0px_var(--shadow-c)] hover:bg-mustard hover:text-ink transition flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>
            <div
                class="shrink-0 p-4 md:p-5 border-b-4 border-ink text-center bg-espresso relative overflow-hidden ornament-host">
                <div class="ornament-layer" aria-hidden="true">
                    <span
                        class="ornament ornament-halftone ornament-halftone--tl ornament-halftone--cotton ornament-halftone--sm"></span>
                    <span
                        class="ornament ornament-halftone ornament-halftone--br ornament-halftone--cotton ornament-halftone--sm"></span>
                    <span
                        class="ornament ornament-star ornament-star--sm left-4 top-1/2 -translate-y-1/2 -rotate-12 hidden sm:grid"><span>★</span></span>
                    <span
                        class="ornament ornament-star ornament-star--sm right-16 top-1/2 -translate-y-1/2 rotate-12 hidden sm:grid"><span>★</span></span>
                </div>
                <h2 class="text-lg md:text-2xl font-display text-mustard uppercase tracking-widest m-0 pr-10">★ Panel
                    Kendali Admin ★</h2>
            </div>

            <div class="flex flex-col md:flex-row flex-1 overflow-y-auto md:overflow-hidden custom-scrollbar min-h-0">

                <div class="w-full md:w-1/2 p-5 md:p-8 flex flex-col overflow-y-auto custom-scrollbar min-h-0">
                    <form id="upload-form" onsubmit="handleBulkUpload(event)" enctype="multipart/form-data"
                        class="space-y-5 flex flex-col">

                        <div class="shrink-0">
                            <label class="block text-ink text-xs uppercase font-bold mb-2 tracking-widest">Judul /
                                Prefix</label>
                            <input type="text" name="judul" required placeholder="Contoh: PBAK 2026 - Hari 1"
                                class="rt-input">
                        </div>
                        <div class="shrink-0">
                            <label class="block text-ink text-xs uppercase font-bold mb-2 tracking-widest">Pilih
                                Album</label>
                            <select name="id_event" class="rt-input">
                                <option value="E01">MUBES HMPS KPI 2026</option>
                                <option value="E02">OSMAJUR</option>
                                <option value="E03">FEBKOM</option>
                                <option value="E04">POSTER PENGUMUMAN</option>
                            </select>
                        </div>
                        <div id="drop-zone"
                            class="shrink-0 relative border-4 border-dashed border-ink py-8 px-6 text-center cursor-pointer hover:border-brick hover:bg-mustard/30 transition-all bg-cream mt-2"
                            onclick="document.getElementById('file-input-bulk').click()"
                            ondragover="event.preventDefault(); this.classList.add('border-brick','bg-mustard/30')"
                            ondragleave="this.classList.remove('border-brick','bg-mustard/30')"
                            ondrop="handleDrop(event)">
                            <i class="fas fa-cloud-upload-alt text-4xl text-brick mb-3"></i>
                            <p class="text-sm md:text-base mb-1 font-medium">Klik atau <span
                                    class="text-brick font-bold">drag &amp; drop</span> file</p>
                            <p class="text-xs text-ink/70">Mendukung banyak file sekaligus (Foto/Video)</p>
                            <input type="file" id="file-input-bulk" name="berkas" multiple accept="image/*,video/*"
                                class="hidden" onchange="handleFileSelect(this.files)">
                        </div>

                        <div class="flex-1 min-h-0">
                            <div id="file-queue-container" class="hidden bg-cream p-4 border-2 border-ink mt-4">
                                <div
                                    class="flex items-center justify-between mb-3 border-b-2 border-dashed border-ink pb-2">
                                    <p class="text-ink text-xs uppercase font-bold tracking-widest">Antrian:
                                        <span id="queue-count" class="text-brick">0</span> file
                                    </p>
                                    <button type="button" onclick="clearQueue()"
                                        class="text-xs font-semibold uppercase tracking-wider text-ink hover:bg-brick hover:text-cream transition px-2 py-1 border-2 border-ink"><i
                                            class="fas fa-trash-alt mr-1"></i> Kosongkan</button>
                                </div>
                                <div id="file-queue-list"
                                    class="space-y-2 max-h-32 overflow-y-auto pr-2 custom-scrollbar"></div>
                            </div>
                            <div id="upload-progress-container"
                                class="hidden mt-4 space-y-2 bg-mustard/30 p-4 border-2 border-ink">
                                <div
                                    class="flex justify-between text-xs text-ink uppercase tracking-widest font-semibold">
                                    <span>Progress</span>
                                    <span id="upload-progress-text">0 / 0</span>
                                </div>
                                <div class="w-full bg-paper border-2 border-ink h-4 overflow-hidden">
                                    <div id="upload-progress-bar" class="bg-brick h-full transition-all duration-300"
                                        style="width:0%"></div>
                                </div>
                                <p id="upload-current-file" class="text-xs text-ink truncate"></p>
                                <div id="upload-error-list"
                                    class="space-y-1 max-h-20 overflow-y-auto custom-scrollbar mt-2"></div>
                            </div>
                        </div>

                        <button type="submit" id="btn-upload-submit"
                            class="rt-btn rt-btn-red w-full shrink-0 !py-4 mt-4">
                            <i class="fas fa-cloud-upload-alt mr-2"></i> Mulai Upload
                        </button>
                    </form>
                </div>

                <div
                    class="w-full md:w-1/2 flex flex-col bg-cream border-t-4 md:border-t-0 md:border-l-4 border-ink min-h-[300px] md:min-h-0">
                    <div class="shrink-0 p-5 md:p-8 pb-4">
                        <h3
                            class="text-ink text-xs md:text-sm uppercase font-bold tracking-widest flex items-center gap-2">
                            <i class="fas fa-list-ul text-brick"></i> Kelola File
                        </h3>
                        <p class="text-xs text-ink/70 mt-1">Daftar arsip yang masuk ke database</p>
                    </div>
                    <div class="flex-1 overflow-y-auto px-5 md:px-8 pb-6 md:pb-8 custom-scrollbar min-h-0">
                        <div id="admin-file-list" class="space-y-3"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ==================== MODAL KONFIRMASI HAPUS ==================== -->
    <div id="confirm-delete-modal" class="custom-modal" style="z-index:10000;">
        <div
            class="relative ornament-host bg-paper w-[90%] max-w-sm p-8 border-4 border-ink shadow-[8px_8px_0px_var(--shadow-hi-c)] text-center transform scale-95 transition-all duration-300">
            <div class="ornament-layer" aria-hidden="true">
                <div class="ornament ornament-stripes top-0 left-0 right-0"></div>
                <span class="ornament ornament-halftone ornament-halftone--br ornament-halftone--sm"></span>
            </div>
            <span class="tape -top-3 left-1/2 -translate-x-1/2 -rotate-3"></span>
            <div class="text-5xl mb-4">
                <i class="fas fa-exclamation-triangle text-brick"></i>
            </div>
            <h3 class="text-xl font-display uppercase mb-2 tracking-widest">Konfirmasi Hapus</h3>
            <p id="confirm-delete-title" class="text-sm mb-6">Hapus file ini secara permanen?</p>
            <div class="flex gap-3">
                <button onclick="closeConfirmDelete()" class="rt-btn rt-btn-paper flex-1 !px-2 !py-3">Batal</button>
                <button onclick="executeDelete()" class="rt-btn rt-btn-red flex-1 !px-2 !py-3"><i
                        class="fas fa-trash-alt mr-1"></i> Hapus</button>
            </div>
        </div>
    </div>

    <!-- ==================== MODAL NOTIFIKASI ==================== -->
    <div id="notif-action-modal" class="custom-modal" style="z-index:10001;">
        <div
            class="relative ornament-host bg-paper w-[90%] max-w-sm p-8 border-4 border-ink shadow-[8px_8px_0px_var(--shadow-c)] text-center transform scale-95 transition-all duration-300">
            <div class="ornament-layer" aria-hidden="true">
                <span class="ornament ornament-halftone ornament-halftone--tl ornament-halftone--sm"></span>
                <span class="ornament ornament-halftone ornament-halftone--br ornament-halftone--sm"></span>
            </div>
            <span class="tape -top-3 left-1/2 -translate-x-1/2 rotate-2"></span>
            <div id="notif-action-icon" class="text-6xl mb-4"></div>
            <h3 id="notif-action-title" class="text-xl font-display uppercase mb-2 tracking-widest"></h3>
            <p id="notif-action-msg" class="text-sm mb-6"></p>
            <button id="notif-action-btn" onclick="closeNotifModal()" class="rt-btn rt-btn-red w-full">OK</button>
        </div>
    </div>

    <!-- ==================== MODAL BERITA ==================== -->
    <div id="news-modal" class="custom-modal" onclick="closeNewsModal(event)" style="z-index: 9999;">
        <div id="news-content"
            class="w-[90%] md:w-full max-w-4xl max-h-[90vh] overflow-y-auto transform scale-95 transition-all duration-300 flex flex-col bg-paper border-4 border-ink shadow-[10px_10px_0px_var(--shadow-hi-c)] relative custom-scrollbar"
            tabindex="0">
            <!-- Tombol close sticky -->
            <div class="sticky top-0 z-50 h-0 flex justify-end pointer-events-none">
                <button onclick="closeNewsModal(null, true)"
                    class="pointer-events-auto m-3 w-10 h-10 shrink-0 bg-brick text-cream border-4 border-ink shadow-[3px_3px_0px_var(--shadow-c)] hover:bg-mustard hover:text-ink transition flex items-center justify-center">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="w-full h-56 md:h-80 relative shrink-0 bg-mustard border-b-4 border-ink overflow-hidden">
                <img id="news-modal-img" src="" alt="News Image" class="w-full h-full object-cover">
                <div class="halftone absolute inset-0"></div>
                <!-- ORNAMEN: sobekan kertas + stempel di foto berita -->
                <span class="ornament ornament-torn ornament-torn--bottom ornament-torn--surface"
                    aria-hidden="true"></span>
                <span class="stamp-badge stamp-badge--solid bottom-6 right-4 rotate-6 hidden sm:block"
                    aria-hidden="true">Kabar Terkini</span>
                <div id="news-modal-category"
                    class="absolute top-4 left-4 bg-brick text-cream border-2 border-ink text-xs font-semibold px-3 py-1 uppercase tracking-widest shadow-[3px_3px_0px_var(--shadow-c)]">
                    Kategori</div>
            </div>
            <div class="p-6 md:p-8 flex flex-col flex-grow relative ornament-host">
                <div class="ornament-layer" aria-hidden="true">
                    <span class="ornament ornament-halftone ornament-halftone--br"></span>
                    <span class="ornament ornament-halftone ornament-halftone--tr ornament-halftone--sm"></span>
                    <span
                        class="ornament ornament-star ornament-star--ghost ornament-star--lg -bottom-10 -left-10 -rotate-12 hidden md:grid"></span>
                </div>
                <span class="staple -top-2 left-8 rotate-6"></span>
                <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-widest mb-3">
                    <i class="far fa-calendar-alt text-brick"></i> <span id="news-modal-date">Tanggal</span>
                </div>
                <h2 id="news-modal-title"
                    class="text-2xl md:text-4xl font-display uppercase tracking-tight leading-tight mb-5 pb-5 border-b-4 border-dashed border-ink">
                    Judul Berita</h2>

                <div class="space-y-4 text-sm md:text-base" id="news-modal-body"></div>

                <div id="news-modal-action"
                    class="mt-8 pt-6 border-t-4 border-dashed border-ink hidden flex justify-end">
                    <button onclick="closeNewsModal(); switchTab('pendaftaran');"
                        class="rt-btn rt-btn-red w-full md:w-auto !px-8 !py-3">
                        ★ DAFTAR SEKARANG <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== MODAL DAFTAR ==================== -->
    <div id="daftar-modal" class="custom-modal" style="z-index:9999;">
        <div
            class="daftar-panel ornament-host w-[90%] max-w-lg p-6 md:p-8 bg-paper border-4 border-ink shadow-[10px_10px_0px_var(--shadow-hi-c)] relative transform scale-95 transition-all duration-300 max-h-[90vh] overflow-y-auto custom-scrollbar">
            <!-- ORNAMEN belakang form (tidak menutupi input / tombol Close / Submit) -->
            <div class="ornament-layer" aria-hidden="true">
                <span class="ornament ornament-torn ornament-torn--top"></span>
                <span class="ornament ornament-halftone ornament-halftone--tl ornament-halftone--sm"
                    style="top:14px"></span>
                <span class="ornament ornament-halftone ornament-halftone--br"></span>
                <span
                    class="ornament ornament-star ornament-star--ghost ornament-star--lg left-1/2 top-20 -translate-x-1/2 -translate-y-1/2 rotate-12"></span>
                <span class="stamp-badge top-8 left-4 -rotate-6 hidden sm:block">Form 2026</span>
            </div>
            <!-- Tombol close sticky -->
            <div class="sticky top-0 z-50 h-0 flex justify-end pointer-events-none">
                <button onclick="closeDaftarModal()"
                    class="pointer-events-auto -mt-2 -mr-2 w-10 h-10 shrink-0 bg-brick text-cream border-4 border-ink shadow-[3px_3px_0px_var(--shadow-c)] hover:bg-mustard hover:text-ink transition flex items-center justify-center">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="text-center mb-6 pt-2">
                <div
                    class="w-16 h-16 mx-auto mb-3 bg-mustard border-4 border-ink shadow-[4px_4px_0px_var(--shadow-c)] flex items-center justify-center">
                    <i class="fas fa-clipboard-list text-3xl text-ink"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-display uppercase tracking-tight" id="modal-lomba-title">Daftar
                    Lomba</h3>
                <p class="text-xs md:text-sm mt-2 border-t-2 border-dashed border-ink pt-2">Lengkapi form di bawah ini.
                    Data akan otomatis masuk ke database HMPS KPI.</p>
            </div>

            <form id="form-pendaftaran" onsubmit="submitPendaftaran(event)" class="space-y-4 text-left">
                <input type="hidden" id="input-nama-lomba" name="nama_lomba">

                <div id="dynamic-inputs-container" class="space-y-4 flex flex-wrap"></div>

                <!-- Area File Upload -->
                <div id="file-upload-section" class="w-full md:w-[48%] md:mr-[2%] mb-4">
                    <label id="dynamic-file-label"
                        class="block text-ink text-xs font-bold mb-1 uppercase tracking-widest">Upload File</label>
                    <div
                        class="border-4 border-dashed border-ink px-4 py-3 flex items-center justify-center gap-2 hover:border-brick hover:bg-mustard/30 transition-colors bg-cream cursor-pointer relative">
                        <input type="file" id="input-file"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-lg text-brick"></i>
                        <p class="text-xs truncate w-full" id="file-name-display">Pilih file...</p>
                    </div>
                </div>

                <button type="submit" id="btn-submit-daftar" class="rt-btn rt-btn-red w-full mt-4 !py-3.5">
                    ★ Kirim Pendaftaran <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
    var allFilesData = <?php echo json_encode($dataFiles); ?>;
    </script>
    <script src="assets/script/script.js?v=54.0"></script>
</body>

</html>