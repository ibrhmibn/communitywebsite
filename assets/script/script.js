// ==========================================
// STATE GLOBAL
// ==========================================
let isAdmin = false;
let selectedFiles = new Set();
let currentEvent = null;
let uploadQueue = [];

// allFilesData di-inject dari index.php via <script> inline

const textToType = "KPI 2026";
const typingElement = document.getElementById("typing-text");
let i = 0;

function typeWriter() {
    if (i < textToType.length) {
        typingElement.innerHTML += textToType.charAt(i);
        i++;
        setTimeout(typeWriter, 150);
    }
}

// ==========================================
// DATA MAHASISWA (JANGAN DIUBAH)
// ==========================================
const studentsData = [
  {
    name: "Aqilla Nindita N. M.",
    nim: "302250029",
    ig: "@aqillanindita",
    img: "assets/mahasiswa/qila2.webp",
    bioImg: "assets/mahasiswa/qilaneh.webp",
    bio: "Aku sek bingung kata katane piye",
    divisi: "inti",
    role: "Ketua Umum",
  },
  {
    name: "Renny Ismawati",
    nim: "302250015",
    ig: "@renistii",
    img: "assets/mahasiswa/renny (1).webp",
    bioImg: "assets/mahasiswa/rennyneh.webp",
    bio: "Berusaha baik dan tetap sederhana.",
    divisi: "inti",
    role: "Wakil Ketua",
  },
  {
    name: "Siti Nur Azizah",
    nim: "302250012",
    ig: "_nurtured.lens",
    img: "assets/mahasiswa/nur.webp",
    bioImg: "assets/mahasiswa/nurneh.webp",
    bio: "Never Miss a Chance",
    divisi: "inti",
    role: "Sekeretaris 1",
  },
  {
    name: "Nabil Tri Yoga",
    nim: " 302250032",
    ig: "ygtrnl",
    img: "assets/mahasiswa/nabilpp.webp",
    bioImg: "assets/mahasiswa/nabilbio.webp",
    bio: "Never look back, there's nothing behind your back",
    divisi: "inti",
    role: "Sekeretaris 2",
  },
  {
    name: "Khoirul Latifah",
    nim: "302250050",
    ig: "khrllatifah__",
    img: "assets/mahasiswa/ipah.webp",
    bioImg: "assets/mahasiswa/ipahneh.webp",
    bio: "Saya tidak malas, hanya hemat energi.",
    divisi: "inti",
    role: "Bendahara 1",
  },
  {
    name: "Aisyah Imtiyaz T.",
    nim: "302250018",
    ig: "bithaplace",
    img: "assets/mahasiswa/ais.webp",
    bioImg: "assets/mahasiswa/aisneh.webp",
    bio: "We are only as strong as we are united, as weak as we are divided",
    divisi: "inti",
    role: "Bendahara 2",
  },
  {
    name: "Ibrahim Ibnu S.",
    nim: "302250053",
    ig: "@ibnu_satryo",
    img: "assets/mahasiswa/tyo.webp",
    bioImg: "assets/mahasiswa/tyo-2.webp",
    bio: "BACOD KLEN ANJENG!",
    divisi: "Media",
    role: "CO",
  },
  {
    name: "Naufal Miqdad Hasbulloh",
    nim: "302250073",
    ig: "nplaaeee",
    img: "assets/mahasiswa/nopalneh.webp",
    bioImg: "assets/mahasiswa/nopal.webp",
    bio: "If you want to go fast, go alone. If you want to go far, go together.",
    divisi: "Intelektual",
    role: "CO",
  },
  {
    name: "Ilham Adjie P.",
    nim: "30250045",
    ig: "aadd.jjiiee",
    img: "assets/mahasiswa/ajineh.webp",
    bioImg: "assets/mahasiswa/aji.webp",
    bio: "Urip iku urup.",
    divisi: "Public Speaking",
    role: "CO",
  },
  {
    name: "Tri Bagus P.",
    nim: "302250028",
    ig: "tribagus__p",
    img: "assets/mahasiswa/baguspp.webp",
    bioImg: "assets/mahasiswa/bagusbio.webp",
    bio: "When life gives you a hundred reasons to cry, show life that you have a thousand reasons to smile.",
    divisi: "PKM",
    role: "CO",
  },
  {
    name: "Arista Putri P.",
    nim: "302250080",
    ig: "pertiwyfoxcool",
    img: "assets/mahasiswa/arista.webp",
    bioImg: "assets/mahasiswa/arista.webp",
    bio: "Gantungkan cita-cita mu setinggi langit! Bermimpilah setinggi langit. Jika engkau jatuh, engkau akan jatuh di antara bintang-bintang.",
    divisi: "Intelektual",
    role: "Anggota",
  },
  {
    name: " Anindi Shofia D. A.",
    nim: "302250008",
    ig: "cookiespai",
    img: "assets/mahasiswa/sopia.webp",
    bioImg: "assets/mahasiswa/sopianehh.webp",
    bio: "Jangan pernah meremehkan kekuatan doa, karena doa adalah senjata bagi orang beriman.",
    divisi: "Media",
    role: "Anggota",
  },
  {
    name: "Shafa Durroh Nafisah",
    nim: "302250059",
    ig: "shafadurroh3",
    img: "assets/mahasiswa/safapp.webp",
    bioImg: "assets/mahasiswa/safaneh.webp",
    bio: "Aku bukanlah seorang yang sempurna, tapi aku selalu berusaha untuk menjadi versi terbaik dari diriku sendiri.",
    divisi: "Intelektual",
    role: "Anggota",
  },
  {
    name: "Muhammad Sulthoni",
    nim: "302250048",
    ig: "rajaswla",
    img: "assets/mahasiswa/raja.webp",
    bioImg: "assets/mahasiswa/rajaneh.webp",
    bio: "Kesuksesan bukanlah kunci kebahagiaan. Kebahagiaanlah kunci kesuksesan. Jika kamu mencintai apa yang kamu kerjakan, kamu akan sukses.",
    divisi: "Public Speaking",
    role: "Anggota",
  },
  {
    name: "Arica Fatima A.",
    nim: "302250014",
    ig: "arrcafz",
    img: "assets/mahasiswa/icaneh.webp",
    bioImg: "assets/mahasiswa/ica.webp",
    bio: "Learn from the past, be grateful for the present, plan for the future.",
    divisi: "Media",
    role: "Anggota",

  },
  {
    name: "Sulistya Ningsih",
    nim: "302250024",
    ig: "_sulistyaa.n",
    img: "assets/mahasiswa/tya.webp",
    bioImg: "assets/mahasiswa/tyaneh.webp",
    bio: "Jangan berkembang biak sebelum berkembang baik",
    divisi: "Public Speaking",
    role: "Anggota",

  },
  {
    name: "Maslica Nazlia Intani",
    nim: "302250085",
    ig: "lia.maslicaaa_",
    img: "assets/mahasiswa/lia.webp",
    bioImg: "assets/mahasiswa/lianeh.webp",
    bio: "Life is not about waiting for the storm to pass, but learning to dance in the rain.",
    divisi: "PKM",
    role: "Anggota",
  },
  {
    name: "Wildan Al Muthi",
    nim: "302250086",
    ig: "wldaaaaan._",
    img: "assets/mahasiswa/wildanpp.webp",
    bioImg: "assets/mahasiswa/wildanbio.webp",
    bio: "Innama Qoli, Syududuuuu",
    divisi: "Intelektual",
    role: "Anggota",
  },
  {
    name: "M. Faris Bayu N.",
    nim: "302250027",
    ig: "boyymenn.2",
    img: "assets/mahasiswa/bayupp.webp",
    bioImg: "assets/mahasiswa/bayubio.webp",
    bio: "Kesuksesan bukanlah tentang seberapa banyak uang yang kamu hasilkan, tetapi tentang seberapa besar dampak positif yang kamu berikan kepada orang lain.",
    divisi: "PKM",
    role: "Anggota",
  },
  {
    name: "Conny Septi A. F.",
    nim: "302250088",
    ig: "??????",
    img: "assets/mahasiswa/septipp.webp",
    bioImg: "assets/mahasiswa/septibio.webp",
    bio: "Hidup ini singkat, jadi jangan sia-siakan waktu untuk hal-hal yang tidak penting. Fokuslah pada hal-hal yang benar-benar berarti bagi kamu.",
    divisi: "PKM",
    role: "Anggota",
  },
  {
    name: "Alan Tirta S.",
    nim: "302250021",
    ig: "alnntrta",
    img: "assets/mahasiswa/alanpp.webp",
    bioImg: "assets/mahasiswa/alanbio.webp",
    bio: "Jangan pernah takut untuk bermimpi besar, karena mimpi adalah langkah pertama menuju kesuksesan.",
    divisi: "PKM",
    role: "Anggota",
  },
  {
    name: "Abdul Barri K.",
    nim: "302250007",
    ig: "aaaaww__",
    img: "assets/mahasiswa/abokpp.webp",
    bioImg: "assets/mahasiswa/abokpp.webp",
    bio: "Kesuksesan bukanlah tentang seberapa cepat kamu mencapainya, tetapi tentang seberapa konsisten kamu dalam mengejarnya.",
    divisi: "Public Speaking",
    role: "Anggota",
  },
  {
    name: "Silviana Nur H.",
    nim: "302250001",
    ig: "??????",
    img: "assets/mahasiswa/silvipp.webp",
    bioImg: "assets/mahasiswa/silvibio.webp",
    bio: "Jangan pernah meremehkan kekuatan kerja keras, karena kerja keras adalah kunci utama untuk meraih kesuksesan.",
    divisi: "PKM",
    role: "Anggota",
  }
];

// ==========================================
// DATA EVENT
// ==========================================
const eventsList = [
    { id: "E01", name: "MUBES HMPS KPI 2026", icon: "fa-users", desc: "MUSYAWARAH BESAR HMPS KPI 2026 untuk evaluasi dan perencanaan program kerja ke depan" },
    { id: "E02", name: "OSMAJUR", icon: "fa-campground", desc: "Orientasi Mahasiswa Jurusan" },
    { id: "E03", name: "FEBKOM", icon: "fa-masks-theater", desc: "Festival dan Kompetisi Internal HMPS KPI" },
    { id: "E04", name: "POSTER PENGUMUMAN", icon: "fa-bullhorn", desc: "Kumpulan Pengumuman dan Informasi Resmi" },
];

// ==========================================
// DATA BERITA (JANGAN DIUBAH)
// ==========================================
const newsData = [
  {
    id: 1,
    title:
      "Pelantikan Pengurus HMPS KPI 2026: Langkah Awal Menuju Era Keemasan",
    date: "13 April 2026",
    category: "Pelantikan",
    color: "bg-red-600",
    img: "assets/berita/beritapelantikan.webp", 
    excerpt:
      "Keluarga besar mahasiswa Komunikasi dan Penyiaran Islam (KPI) UIN Kiai Ageng Muhammad Besari Ponorogo secara resmi melantik kepengurusan HMPS angkatan 2026...",
    content: `
            <p><strong>PONOROGO</strong> – Pada tanggal 13 April 2026, telah dilaksanakan acara pelantikan pengurus Himpunan Mahasiswa Program Studi (HMPS) Komunikasi dan Penyiaran Islam (KPI) angkatan 2026. Acara yang berlangsung khidmat ini diselenggarakan di lingkungan Fakultas Ushuluddin, Adab, dan Dakwah, UIN Kiai Ageng Muhammad Besari Ponorogo.</p>
            
            <p>Mengusung semangat <em>"Awaken The Golden Era"</em>, kepengurusan baru yang dinahkodai oleh <strong>Aqilla Nindita N. M.</strong> (Ketua Umum) dan <strong>Renny Ismawati</strong> (Wakil Ketua) ini diharapkan mampu membawa angin segar dan inovasi bagi mahasiswa KPI. Momen kebersamaan ini terekam jelas dengan kekompakan seluruh pengurus yang mengenakan jas almamater kebanggaan kampus.</p>
            
            <p>"Pelantikan ini bukanlah akhir, melainkan garis *start* bagi kita semua untuk bekerja sama, berkarya, dan mengukir prestasi. Mari kita wujudkan visi <strong>Dakwah Cerdas, Media Berkualitas</strong> melalui program-program kerja yang nyata dan bermanfaat," ujar perwakilan pengurus setelah resmi dilantik.</p>
            
            <p>Dengan resminya kepengurusan HMPS KPI 2026, diharapkan tali persaudaraan antar mahasiswa semakin kuat. Semoga formasi kabinet baru ini sukses melahirkan bibit-bibit unggul di bidang <em>broadcasting</em>, jurnalistik, desain, dan <em>public speaking</em> yang berlandaskan nilai-nilai keislaman. Selamat bertugas, HMPS KPI 2026!</p>
        `,
  },
  {
    id: 2,
    title: "Musyawarah Besar HMPS KPI 2026 Usung Tema 'The Golden Age'",
    date: "23 Mei 2026",
    category: "Mubes",
    color: "bg-blue-600",
    img: "assets/berita/beritamubes.webp",
    excerpt: "Himpunan Mahasiswa Program Studi Komunikasi dan Penyiaran Islam (HMPS KPI) menggelar Musyawarah Besar (Mubes) pada 23 Mei 2026 dengan mengusung tema 'The Golden Age'...",
    content: `
        <p><strong>PONOROGO</strong> – Himpunan Mahasiswa Program Studi (HMPS) Komunikasi dan Penyiaran Islam (KPI) kembali menggelar agenda tahunan tertinggi organisasi, yaitu Musyawarah Besar (Mubes) dilaksanakan pada <strong>23 Mei 2026</strong>. Mubes kali ini mengusung tema besar yang sejalan dengan visi digitalisasi kampus, yakni <strong>"The Golden Age"</strong>, sebuah tema yang juga menjadi tagline pada situs resmi program studi melalui laman <strong>hmjkpi.page.gd</strong>.</p>
        
        <p>Ketua Pelaksana, Renny Ismawati menjelaskan bahwa pemilihan tema tersebut bukan tanpa alasan. "Kami melihat bahwa masa keemasan organisasi dan mahasiswa KPI sedang berada di ambang pintu. Era digital dan bonus demografi menuntut kita untuk bergerak lebih cepat, lebih cerdas, dan lebih kolaboratif. 'The Golden Age' bukan sekadar slogan, melainkan seruan untuk mencetak kepemimpinan yang adaptif dan transformatif," ujarnya dalam konferensi pers virtual.</p>
        
        <p>Sekretaris Panitia, Nabil Tri Yoga menambahkan bahwa Mubes 2026 akan menjadi momentum penting untuk menyusun program kerja periode mendatang yang berbasis pada inovasi digital dan penguatan keilmuan KPI. "Kami ingin memastikan bahwa setiap keputusan yang dihasilkan dalam Mubes nanti mampu membawa HMPS KPI menuju era keemasan, di mana solidaritas, intelektualitas, dan kontribusi nyata untuk prodi menjadi prioritas utama," jelasnya.</p>
        
        <p>Rangkaian acara Mubes bertempat di Aula Fakultas Ushuluddin Adab dan Dakwah. Agenda utama meliputi laporan pertanggungjawaban pengurus lama, pembahasan dan pengesahan AD/ART, serta pemilihan ketua HMPS KPI periode 2026/2027.</p>
        
        <p>Selaras dengan semangat "The Golden Age" yang juga tercantum dalam laman <strong>hmjkpi.page.gd</strong>, panitia mengimbau seluruh mahasiswa KPI untuk berpartisipasi aktif. "Jangan sia-siakan masa keemasan ini. Mari kita wujudkan kepengurusan yang berkelas, berintegritas, dan membanggakan," tutup Ahmad Fauzan.</p>
        
        <p>Pantau terus informasi terbaru seputar Mubes HMPS KPI 2026 melalui kanal media sosial resmi HIMA dan situs <strong>hmjkpi.page.gd</strong>.</p>
    `,
},
  // --- TAMBAHKAN DI DALAM ARRAY newsData ---
  {
    id: 3,
    title: "Open Volunteer FEBKOM 2026",
    folderName: "Open Volunteer",
    date: "23 - 26 Oktober 2026",
    category: "Kompetisi",
    color: "bg-blue-600",
    img: "assets/berita/poster_volunteer.webp",
    excerpt: "Mari bergabung menjadi bagian dari kepanitiaan FEBKOM 2026! Tersedia berbagai benefit menarik.",
    content: `
        <p><strong>PONOROGO</strong> – HMPS KPI membuka pendaftaran relawan (Open Volunteer) untuk menyukseskan acara FEBKOM 2026. Ini adalah kesempatan emas untuk mengembangkan <em>soft skill</em>.</p>
        <p><strong>Divisi yang dibuka:</strong> Kegiatan, Perlengkapan, Konsumsi, KSK, Media, dan Humas.</p>
    `,
    formFields: [
        { id: "nama", label: "Nama Lengkap", type: "text", placeholder: "Nama lengkap...", halfWidth: false },
        { id: "nim", label: "NIM", type: "text", placeholder: "30225...", halfWidth: true },
        { id: "wa", label: "Nomor WhatsApp", type: "tel", placeholder: "0812...", halfWidth: true },
        
        // INI DROPDOWN DIVISINYA
        { 
          id: "divisi", 
          label: "Pilihan Divisi", 
          type: "select", // Kita set tipenya 'select'
          halfWidth: false,
          options: [
            { value: "Kegiatan", label: "Divisi Kegiatan" },
            { value: "Perlengkapan", label: "Divisi Perlengkapan" },
            { value: "Konsumsi", label: "Divisi Konsumsi" },
            { value: "KSK", label: "Divisi KSK" },
            { value: "Media", label: "Divisi Media" },
            { value: "Humas", label: "Divisi Humas" }
          ]
        },
        
        // INI TEXTAREA MOTIVASI
        { 
          id: "motivasi", 
          label: "Motivasi Mengikuti Volunteer", 
          type: "textarea", 
          placeholder: "Ceritakan alasanmu ingin ikut FEBKOM...", 
          halfWidth: false 
        }
    ],
    fileLabel: "Upload KRS (PDF/Gambar)"
  },
  // ===================================================
  // ===========  LOMBA ONLINE  ========================
  //====================================================

  // {
  //    id: 3,
  //    title: "Pendaftaran Lomba Desain Poster Nasional 2026 Resmi Dibuka!",
  //    folderName: "Lomba Poster",
  //    date: "14 April 2026",
  //    category: "Kompetisi",
  //    color: "bg-orange-600",
  //   img: "https://placehold.co/600x400/1a0000/ff6600?text=Lomba+Poster",
  //    excerpt: "Asah kreativitasmu dan menangkan total hadiah jutaan rupiah!...",
  //    content: `
  //            <p><strong>PONOROGO</strong> – Divisi Kreatif HMPS KPI 2026 resmi membuka ajang kompetisi bergengsi tingkat nasional bertajuk <strong>"National Poster Design Competition 2026"</strong>. Lomba ini merupakan wadah bagi mahasiswa di seluruh Indonesia untuk mengekspresikan gagasan dakwah melalui media visual.</p>
  //            <p>Tema lomba tahun ini adalah <em>"Modernizing Dakwah in Digital Society"</em>. Peserta diharapkan mampu menciptakan karya yang tidak hanya estetik, tetapi juga memiliki pesan moral yang kuat sesuai dengan jati diri mahasiswa Komunikasi Islam.</p>
  //            <p><strong>Timeline Lomba:</strong></p>
  //            <ul>
  //                <li>Pendaftaran: 14 April - 10 Mei 2026</li>
  //                <li>Penjurian: 11 - 15 Mei 2026</li>
  //                <li>Pengumuman: 17 Mei 2026</li>
  //            </ul>
  //            <p>Klik tombol di bawah ini untuk melihat detail syarat ketentuan dan mengisi formulir pendaftaran resmi.</p>
  //        `,
    
  //    // --- TAMBAHKAN BAGIAN INI ---
  //    // Resep form dinamis khusus untuk lomba ini
  //    formFields: [
  //        { id: "nama", label: "Nama Lengkap", type: "text", placeholder: "Nama lengkap...", halfWidth: false },
  //        { id: "instansi", label: "Instansi / Kampus", type: "text", placeholder: "Asal kampus...", halfWidth: true },
  //        { id: "wa", label: "Nomor WhatsApp", type: "tel", placeholder: "0812...", halfWidth: true },
  //        { id: "judul_karya", label: "Judul Karya Poster", type: "text", placeholder: "Masukkan judul karya...", halfWidth: false }
  //    ],
  // //   fileLabel: "Upload Karya Poster (PNG/JPG)" // Label khusus untuk file
  //  },
  // // Nanti kalau ada Lomba Esai, kamu tinggal copas struktur di atas
  // // dan ganti isi formFields-nya (misal tambah input "Tema Esai")
  // {
  //   id: "lomba-esai",
  //   title: "Pendaftaran Lomba Esai Nasional 2026 Resmi Dibuka!",
  //   folderName: "Lomba Esai",
  //   date: "15 April 2026",
  //   category: "Kompetisi",
  //   color: "bg-yellow-600",
  //   img: "https://placehold.co/600x400/1a0000/ffcc00?text=Lomba+Esai",
  //   excerpt: "Tunjukkan kemampuan menulismu dan menangkan total hadiah jutaan rupiah!...",
  //   content: `
  //           <p><strong>PONOROGO</strong> – Divisi Kreatif HMPS KPI 2026 resmi membuka ajang kompetisi bergengsi tingkat nasional bertajuk <strong>"National Essay Writing Competition 2026"</strong>. Lomba ini merupakan wadah bagi mahasiswa di seluruh Indonesia untuk mengekspresikan gagasan dakwah melalui media tulisan.</p>
  //           <p>Tema lomba tahun ini adalah <em>"Modernizing Dakwah in Digital Society"</em>. Peserta diharapkan mampu menciptakan karya yang tidak hanya estetik, tetapi juga memiliki pesan moral yang kuat sesuai dengan jati diri mahasiswa Komunikasi Islam.</p>
  //           <p><strong>Timeline Lomba:</strong></p>
  //           <ul>
  //               <li>Pendaftaran: 14 April - 10 Mei 2026</li>
  //               <li>Penjurian: 11 - 15 Mei 2026</li>
  //               <li>Pengumuman: 17 Mei 2026</li>
  //           </ul>
  //           <p>Klik tombol di bawah ini untuk melihat detail syarat ketentuan dan mengisi formulir pendaftaran resmi.</p>
  //       `,
    
  //   // --- TAMBAHKAN BAGIAN INI ---
  //   // Resep form dinamis khusus untuk lomba ini
  //   formFields: [
  //       { id: "nama", label: "Nama Lengkap", type: "text", placeholder: "Nama lengkap...", halfWidth: false },
  //       { id: "instansi", label: "Instansi / Kampus", type: "text", placeholder: "Asal kampus...", halfWidth: true },
  //       { id: "wa", label: "Nomor WhatsApp", type: "tel", placeholder: "0812...", halfWidth: true },
  //       { id: "tema_esai", label: "Tema Esai", type: "text", placeholder: "Masukkan tema esai...", halfWidth: false }
  //   ],
  //   fileLabel: "Upload Esai (PDF)" // Label khusus untuk file

  // },

  // ===================================================
  // ===========  LOMBA OFFLINE  ========================
  //====================================================

  // {
  //   id: "lomba-futsal",
  //   title: "Pendaftaran Lomba Futsal Antar Jurusan 2026",
  //   folderName: "Lomba Futsal",
  //   date: "20 April 2026",
  //   category: "Kompetisi",
  //   color: "bg-blue-600",
  //   img: "https://placehold.co/600x400/1a0000/0044ff?text=Lomba+Futsal",
  //   excerpt: "Daftarkan tim terbaikmu di ajang bergengsi...",
  //   content: `<p>Detail lomba futsal...</p>`,
    
  //   // --- PENANDA LOMBA OFFLINE (TANPA FILE) ---
  //   requireFile: false, 
    
  //   formFields: [
  //       { id: "nama_tim", label: "Nama Tim", type: "text", placeholder: "Nama Tim...", halfWidth: false },
  //       { id: "kapten", label: "Nama Kapten", type: "text", placeholder: "Nama Kapten...", halfWidth: true },
  //       { id: "wa", label: "Nomor WhatsApp", type: "tel", placeholder: "0812...", halfWidth: true }
  //   ]
  // }
];

// ==========================================
// DATA TIMELINE
// ==========================================
const timelineData = [
    {
        month: "April 2026",
        title: "Pelantikan HMPS KPI 2026/2027",
        desc: "Pelantikan resmi pengurus HMPS KPI periode 2026/2027, menandai dimulainya The Golden Era",
        status: "upcoming", // completed = selesai (menyala) / upcoming = belum selesai (redup)
        icon: "fa-user-tie",
    },
    {
        month: "Mei 2026",
        title: "Upgrading skill yang diadakan DEMA",
        desc: "Pengasahan skill anggota melalui serangkaian workshop dan pelatihan yang diselenggarakan oleh DEMA",
        status: "upcoming",
        icon: "fa-star",
    },
    {
        month: "Mei 2026",
        title: "MUBES HMPS KPI",
        desc: "Musyawarah Besar untuk evaluasi dan perencanaan program kerja HMPS KPI ke depan",
        status: "upcoming",
        icon: "fa-users-cog", 
    },
    {
        month: "Juni 2026",
        title: "Sidang Paripurna",
        desc: "Sidang untuk mengesahkan proker proker Ormawa FUAD 2026/2027",
        status: "completed",
        icon: "fa-rocket",
    }
];

// ==========================================
// INIT
// ==========================================
window.onload = function () {
    history.replaceState({ page: "home" }, "", window.location.pathname);
    _switchTabUI('home');

    typeWriter();
    if (typeof generateStudents === "function") generateStudents();

    loadGalleryData();
    checkAdminStatus();
    renderNewsList();   // udah manggil checkNewsCount() di dalemnya
    renderPendaftaranPortal();
    renderDivisionStructure();
    renderTimeline();
    startCountdown();
};

// ==========================================
// HOME POSTERS CAROUSEL
// ==========================================
function renderHomePosters() {
    const container = document.getElementById("home-poster-carousel");
    if (!container) return;

    if (typeof allFilesData === "undefined" || !Array.isArray(allFilesData)) {
        container.innerHTML = `<div class="w-full text-center py-10"><p class="text-gray-500 text-sm italic">Data galeri belum tersedia.</p></div>`;
        return;
    }

    const posters = allFilesData.filter((item) => item.event === "E04");

    if (posters.length === 0) {
        container.innerHTML = `<div class="w-full text-center py-10"><p class="text-gray-500 text-sm italic">Belum ada poster yang diunggah.</p></div>`;
        return;
    }

    let html = "";
    posters.forEach((item) => {
        html += `
        <div class="w-64 md:w-80 shrink-0 snap-center group" onclick="openMediaModal('image', '${item.src}')">
            <div class="glass-panel aspect-[4/5] rounded-xl overflow-hidden relative border border-gray-800 hover:border-red-500/50 transition-all cursor-pointer">
                <img src="${item.src}" alt="${item.title}" loading="lazy" draggable="false" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 pointer-events-none" onerror="this.src='https://placehold.co/400x500/1a0000/ff0000?text=Error';">
                <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black via-black/80 to-transparent pointer-events-none">
                    <h4 class="text-white font-bold text-sm drop-shadow-md line-clamp-2">${item.title}</h4>
                </div>
            </div>
        </div>`;
    });
    container.innerHTML = html;
    initDragToScroll();
}

function initDragToScroll() {
    const carousel = document.getElementById("home-poster-carousel");
    if (!carousel) return;

    let isDown = false;
    let startX;
    let scrollLeft;

    carousel.addEventListener("mousedown", (e) => {
        isDown = true;
        carousel.style.cursor = "grabbing";
        carousel.classList.remove("snap-x");
        startX = e.pageX - carousel.offsetLeft;
        scrollLeft = carousel.scrollLeft;
    });
    carousel.addEventListener("mouseleave", () => {
        isDown = false;
        carousel.style.cursor = "grab";
        carousel.classList.add("snap-x");
    });
    carousel.addEventListener("mouseup", () => {
        isDown = false;
        carousel.style.cursor = "grab";
        carousel.classList.add("snap-x");
    });
    carousel.addEventListener("mousemove", (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - carousel.offsetLeft;
        const walk = (x - startX) * 2;
        carousel.scrollLeft = scrollLeft - walk;
    });
}

// ==========================================
// GALLERY & ADMIN
// ==========================================
async function loadGalleryData() {
    try {
        renderHomePosters();
        if (currentEvent) renderMainDocGrid();
        else initDocumentation();
    } catch (error) {
        console.error("Gagal memuat data galeri:", error);
    }
}

async function checkAdminStatus() {
    try {
        const response = await fetch("cek_login.php");
        const data = await response.json();

        if (data.is_admin === true) {
            isAdmin = true;
            document.getElementById("admin-controls").classList.replace("hidden", "flex");
            document.getElementById("nav-upload-btn").classList.remove("hidden");
            document.getElementById("nav-logout-btn").classList.remove("hidden");
            document.getElementById("nav-login-btn").classList.add("hidden");
            if (currentEvent) renderMainDocGrid();
        }
    } catch (error) {
        console.error("Gagal mengecek status admin:", error);
    }
}

function openUploadModal() {
    const modal = document.getElementById("upload-modal");
    const content = document.getElementById("upload-content");
    modal.classList.add("active");
    setTimeout(() => content.classList.replace("scale-95", "scale-100"), 10);
    document.body.style.overflow = "hidden";
}

function closeUploadModal(e, force = false) {
    if (e && !force && e.target !== document.getElementById("upload-modal")) return;
    const modal = document.getElementById("upload-modal");
    const content = document.getElementById("upload-content");
    content.classList.replace("scale-100", "scale-95");
    setTimeout(() => {
        modal.classList.remove("active");
        document.body.style.overflow = "auto";
    }, 200);
}

function initDocumentation() {
    renderEventFolders();
}

function renderEventFolders() {
    const container = document.getElementById("event-folders-grid");
    let html = "";
    eventsList.forEach((ev) => {
        html += `
        <div onclick="openEventFolder('${ev.id}', '${ev.name}')" class="glass-panel p-8 rounded-2xl border border-red-500/30 hover:bg-red-900/40 hover:-translate-y-2 hover:shadow-[0_10px_30px_rgba(220,38,38,0.3)] transition-all cursor-pointer group text-center flex flex-col items-center justify-center gap-4">
            <div class="w-20 h-20 rounded-full bg-black/50 flex items-center justify-center border-2 border-red-500 shadow-[0_0_15px_rgba(220,38,38,0.2)] group-hover:shadow-[0_0_25px_rgba(220,38,38,0.8)] group-hover:bg-red-600 transition-all duration-300">
                <i class="fas ${ev.icon} text-3xl text-red-500 group-hover:text-white transition-colors duration-300"></i>
            </div>
            <div>
                <h3 class="font-tech text-xl md:text-2xl font-bold text-white tracking-wider mb-2">${ev.name}</h3>
                <p class="text-gray-400 text-xs md:text-sm">${ev.desc}</p>
            </div>
        </div>`;
    });
    container.innerHTML = html;
    document.getElementById("event-folders-grid").classList.remove("hidden");
    document.getElementById("documentation-grid").classList.add("hidden");
    const controls = document.getElementById("doc-controls");
    if (controls) {
        controls.classList.add("hidden");
        controls.classList.remove("flex");
    }
}

function openEventFolder(eventId, eventName) {
    currentEvent = eventId;
    document.getElementById("event-folders-grid").classList.add("hidden");
    document.getElementById("documentation-grid").classList.remove("hidden");
    const controls = document.getElementById("doc-controls");
    if (controls) {
        controls.classList.remove("hidden");
        controls.classList.add("flex");
    }
    document.getElementById("doc-subtitle").innerHTML =
        `<span class="text-red-500 font-bold">ALBUM:</span> ${eventName}`;
    renderMainDocGrid();
}

function backToFolders() {
    currentEvent = null;
    selectedFiles.clear();
    updateBulkDeleteUI();
    const searchInput = document.getElementById("doc-search");
    if (searchInput) searchInput.value = "";
    _switchTabUI("documentation");
    initDocumentation();
    document.getElementById("doc-subtitle").innerText = "Class Memories & Moments";
    history.replaceState({ page: "documentation" }, "", "#documentation");
    window.scrollTo({ top: 0, behavior: "smooth" });
}

function renderMainDocGrid(filter = "") {
    const container = document.getElementById("documentation-grid");
    let html = "";
    let itemsToShow = allFilesData.filter((item) => {
        const matchEvent = currentEvent ? item.event === currentEvent : true;
        const matchSearch = filter ? item.title.toLowerCase().includes(filter.toLowerCase()) : true;
        return matchEvent && matchSearch;
    });

    itemsToShow.forEach((item) => { html += createMediaCard(item); });

    if (html === "") {
        container.classList.remove("columns-1", "md:columns-2", "lg:columns-3", "space-y-6");
        container.classList.add("flex", "justify-center", "items-center", "w-full", "min-h-[300px]");
        html = `
        <div class="max-w-md w-full text-center p-10 border border-gray-800 rounded-2xl bg-black/50 shadow-2xl">
            <i class="fas fa-folder-open text-5xl text-gray-700 mb-4 block"></i>
            <p class="text-gray-500 font-tech tracking-widest text-sm uppercase">Belum ada dokumentasi untuk event ini</p>
        </div>`;
    } else {
        container.classList.add("columns-1", "md:columns-2", "lg:columns-3", "space-y-6");
        container.classList.remove("flex", "justify-center", "items-center", "min-h-[300px]");
    }
    container.innerHTML = html;
}

function handleSearch(event) {
    if (event.key === "Enter" || event.type === "click" || event.type === "keyup") {
        const query = document.getElementById("doc-search").value;
        renderMainDocGrid(query);
    }
}

function createMediaCard(item, isSmall = false) {
    const margin = isSmall ? "mb-4" : "mb-6";
    const isLogo = item.ratio === "aspect-square" && item.title.toLowerCase().includes("logo");
    const shapeClass = isLogo
        ? `rounded-full aspect-square border-4 border-red-600/30 shadow-[0_0_25px_rgba(220,38,38,0.4)]`
        : `rounded-xl`;
    const textPosition = isLogo ? "inset-0 flex items-end justify-center pb-6" : "bottom-4 left-4";

    const adminCheckbox = isAdmin
        ? `<div class="absolute top-3 right-3 z-30">
            <input type="checkbox" value="${item.id}" onclick="event.stopPropagation()" onchange="toggleSelectFile(event, '${item.id}')" class="w-6 h-6 cursor-pointer rounded-full accent-red-600 border-2 border-white shadow-[0_0_10px_rgba(0,0,0,0.8)] transition-transform hover:scale-110">
           </div>`
        : "";

    if (item.type === "video") {
        return `
        <div class="break-inside-avoid relative group ${shapeClass} overflow-hidden glass-panel cursor-pointer ${margin}" onclick="openMediaModal('video', '${item.src}')">
            ${adminCheckbox}
            <div class="w-full h-auto bg-black/50 flex items-center justify-center relative">
                ${item.src
                    ? `<video preload="none" class="w-full h-auto object-contain opacity-80 group-hover:opacity-100 transition duration-500" loop muted onmouseenter="previewVideo(this)" onmouseleave="stopPreview(this)"><source src="${item.src}" type="video/mp4"></video>`
                    : `<i class="fas fa-video text-gray-600 text-4xl py-20"></i>`}
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-14 h-14 bg-red-600/80 rounded-full flex items-center justify-center text-white text-xl opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all z-20 pointer-events-none shadow-[0_0_15px_rgba(220,38,38,0.6)]">
                    <i class="fas fa-play ml-1"></i>
                </div>
            </div>
            <div class="absolute z-10 ${textPosition}">
                <span class="text-xs font-bold text-white bg-red-600 px-2 py-1 rounded shadow-lg">${item.title}</span>
            </div>
        </div>`;
    } else {
        return `
        <div class="break-inside-avoid relative group ${shapeClass} overflow-hidden glass-panel cursor-pointer ${margin}" onclick="openMediaModal('image', '${item.src}')">
            ${adminCheckbox}
            <img src="${item.src}" alt="${item.title}" loading="lazy" decoding="async"
                 class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                 onerror="this.src='https://placehold.co/600x800/1a0505/FFF?text=No+Image';">
            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-80 pointer-events-none"></div>
            <div class="absolute z-10 ${textPosition} pointer-events-none">
                <h3 class="text-lg font-bold text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">${item.title}</h3>
            </div>
        </div>`;
    }
}

// ==========================================
// INTRO & MUSIC
// ==========================================
function enterSite() {
    const intro = document.getElementById("intro-screen");
    const mainApp = document.getElementById("main-app");
    const audio = document.getElementById("bg-music");

    if (audio) {
        audio.volume = 0.3;
        audio.play().catch((error) => console.log("Audio autoplay blocked"));
    }
    intro.style.transform = "translateY(-100%)";
    intro.style.opacity = "0";
    mainApp.classList.remove("hidden");
    setTimeout(() => {
        mainApp.style.opacity = "1";
        setTimeout(() => { intro.style.display = "none"; }, 800);
    }, 100);
}

let isPlaying = true;
function toggleMusic() {
    const audio = document.getElementById("bg-music");
    const btn = document.getElementById("music-btn");
    if (isPlaying) {
        audio.pause();
        btn.innerHTML = '<i class="fas fa-volume-mute"></i>';
        btn.classList.remove("music-pulse");
        isPlaying = false;
    } else {
        audio.play();
        btn.innerHTML = '<i class="fas fa-music"></i>';
        btn.classList.add("music-pulse");
        isPlaying = true;
    }
}

document.addEventListener("visibilitychange", function () {
    const audio = document.getElementById("bg-music");
    if (document.hidden) audio.pause();
    else if (isPlaying) audio.play().catch((e) => console.log(e));
});

// ==========================================
// TAB NAVIGATION
// ==========================================
function _switchTabUI(tabId) {
    const sections = document.querySelectorAll("main section");
    sections.forEach((section) => {
        section.classList.remove("active-section");
        section.classList.add("hidden-section");
        setTimeout(() => {
            if (!section.classList.contains("active-section")) section.style.display = "none";
        }, 0);
    });
    const target = document.getElementById(tabId);
    if (target) {
        target.style.display = "block";
        void target.offsetWidth;
        target.classList.remove("hidden-section");
        target.classList.add("active-section");
    }
    document.getElementById("mobile-menu").classList.add("hidden");

    const desktopBtns = document.querySelectorAll(".nav-btn");
    const mobileBtns = document.querySelectorAll(".mobile-nav-btn");

    desktopBtns.forEach(btn => {
        btn.classList.remove("text-white", "border-red-500");
        btn.classList.add("text-gray-300", "border-transparent");
        if (btn.getAttribute("onclick").includes(`'${tabId}'`)) {
            btn.classList.remove("text-gray-300", "border-transparent");
            btn.classList.add("text-white", "border-red-500");
        }
    });

    mobileBtns.forEach(btn => {
        btn.classList.remove("text-red-500", "bg-red-900/20", "border-red-500");
        btn.classList.add("text-gray-300", "border-transparent");
        if (btn.getAttribute("onclick").includes(`'${tabId}'`)) {
            btn.classList.remove("text-gray-300", "border-transparent");
            btn.classList.add("text-red-500", "bg-red-900/20", "border-red-500");
        }
    });

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function switchTab(tabId) {
    _switchTabUI(tabId);
    history.pushState({ page: tabId }, "", "#" + tabId);
}

function toggleMobileMenu() {
    document.getElementById("mobile-menu").classList.toggle("hidden");
}

// ==========================================
// STUDENT GRID & BIO MODAL
// ==========================================
function generateStudents() {
    const grid = document.getElementById("student-grid");
    let html = "";
    studentsData.forEach((student, index) => {
        html += `
        <div class="glass-panel p-4 rounded-xl border border-red-500/30 text-center hover:bg-red-900/40 transition-all cursor-pointer group hover:-translate-y-1" onclick="openBioModal(${index})">
            <div class="w-24 h-24 mx-auto bg-gray-700 rounded-full mb-3 overflow-hidden border-2 border-red-500 shadow-[0_0_15px_rgba(220,38,38,0.3)] group-hover:shadow-[0_0_20px_rgba(220,38,38,0.6)] transition-all">
                <img src="${student.img}" loading="lazy" decoding="async" alt="${student.name}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(student.name)}&background=random';">
            </div>
            <h3 class="font-bold text-red-400 text-base group-hover:text-white transition-colors">${student.name}</h3>
            <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-wider">Detail <i class="fas fa-arrow-right ml-1"></i></p>
        </div>`;
    });
    grid.innerHTML = html;
}

function toggleFamilyGallery() {
    const gallery = document.getElementById("family-gallery");
    if (gallery.classList.contains("open")) {
        gallery.classList.remove("open");
        document.body.style.overflow = "auto";
        const activeSection = document.querySelector(".active-section");
        history.replaceState(
            { page: activeSection ? activeSection.id : "home" },
            "",
            "#" + (activeSection ? activeSection.id : "home")
        );
    } else {
        gallery.classList.add("open");
        document.body.style.overflow = "hidden";
        history.pushState({ page: "family-gallery" }, "", "#family");
        gallery.focus();
    }
}

function openBioModal(index) {
    const student = studentsData[index];
    if (!student) return;

    const modal = document.getElementById("bio-modal");
    const content = document.getElementById("bio-content");

    document.getElementById("modal-name").innerText = student.name;
    document.getElementById("modal-nim").innerText = "NIM: " + student.nim;

    const igContainer = document.getElementById("modal-ig");
    if (student.ig === "-" || student.ig === "") {
        igContainer.innerHTML = `<span class="text-gray-500">-</span>`;
    } else {
        const username = student.ig.replace("@", "").trim();
        igContainer.innerHTML = `<a href="https://www.instagram.com/${username}" target="_blank" rel="noopener noreferrer" class="text-lg text-white font-medium hover:text-red-400 transition cursor-pointer flex items-center gap-1">${student.ig} <i class="fas fa-external-link-alt text-xs ml-1 opacity-50"></i></a>`;
    }
    document.getElementById("modal-bio").innerText = `"${student.bio}"`;

    const imgElement = document.getElementById("modal-img");
    const loaderElement = document.getElementById("modal-img-loader");
    imgElement.classList.remove("img-loaded");
    imgElement.style.opacity = "0";
    loaderElement.style.display = "flex";

    imgElement.onload = function () {
        imgElement.style.opacity = "1";
        loaderElement.style.display = "none";
    };
    imgElement.onerror = function () {
        this.onerror = null;
        this.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(student.name)}&background=random&size=400`;
        imgElement.style.opacity = "1";
        loaderElement.style.display = "none";
    };
    imgElement.src = student.bioImg;

    modal.classList.add("active");
    content.classList.remove("scale-95");
    content.classList.add("scale-100");
    history.pushState({ page: "bio-details" }, "", "#student-bio");
    setTimeout(() => content.focus(), 100);
}

function closeBioModal(e, force = false) {
    if (e && !force) {
        const content = document.getElementById("bio-content");
        if (content.contains(e.target)) return;
    }
    document.getElementById("bio-modal").classList.remove("active");
    history.replaceState({ page: "family-gallery" }, "", "#family");
}

// ==========================================
// MEDIA MODAL
// ==========================================
function openMediaModal(type, src) {
    if (!src) return;
    if (type === "video") {
        const bgMusic = document.getElementById("bg-music");
        if (bgMusic && !bgMusic.paused) {
            bgMusic.pause();
            bgMusic.dataset.wasPlaying = "true";
        }
    }
    const modal = document.getElementById("media-modal");
    const container = document.getElementById("media-container");

    if (type === "video") {
        container.innerHTML = `
        <div class="bg-black w-full h-full flex items-center justify-center">
            <video controls autoplay class="w-full h-auto max-h-[85vh]">
                <source src="${src}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>`;
    } else {
        container.innerHTML = `<img src="${src}" class="w-full h-auto max-h-[85vh] object-contain bg-black" onerror="this.src='https://placehold.co/600x400?text=Image+Not+Found';">`;
    }
    container.dataset.mediaType = type;
    modal.classList.add("active");
    history.pushState({ page: "media-preview" }, "", "#preview");
}

function closeMediaModal(e, force = false) {
    if (e && !force) {
        const container = document.getElementById("media-container");
        if (container.contains(e.target)) return;
    }
    const container = document.getElementById("media-container");
    if (container.dataset.mediaType === "video") {
        const bgMusic = document.getElementById("bg-music");
        const musicBtn = document.getElementById("music-btn");
        if (bgMusic && bgMusic.dataset.wasPlaying === "true") {
            bgMusic.play().catch((e) => console.log(e));
            if (musicBtn) {
                musicBtn.innerHTML = '<i class="fas fa-music"></i>';
                musicBtn.classList.add("music-pulse");
                isPlaying = true;
            }
        }
    }
    container.innerHTML = "";
    document.getElementById("media-modal").classList.remove("active");
    history.replaceState({ page: "documentation" }, "", "#documentation");
}

function previewVideo(video) {
    video.muted = true;
    const p = video.play();
    if (p !== undefined) p.then(_ => {}).catch(err => {
        if (err.name !== "AbortError") console.log("Prev prevented");
    });
}

function stopPreview(video) {
    video.pause();
    video.currentTime = 0;
}

// ==========================================
// POPSTATE (back/forward browser)
// ==========================================
window.addEventListener("popstate", function (event) {
    const state = event.state || { page: "home" };
    const bioModal = document.getElementById("bio-modal");
    const mediaModal = document.getElementById("media-modal");
    const familyGallery = document.getElementById("family-gallery");
    const mediaContainer = document.getElementById("media-container");

    if (mediaModal.classList.contains("active")) {
        if (mediaContainer.dataset.mediaType === "video") {
            const bgMusic = document.getElementById("bg-music");
            if (bgMusic && bgMusic.dataset.wasPlaying === "true") bgMusic.play().catch(e => console.log(e));
        }
        mediaContainer.innerHTML = "";
    }

    bioModal.classList.remove("active");
    mediaModal.classList.remove("active");

    if (state.page === "family-gallery" || state.page === "bio-details") {
        familyGallery.classList.add("open");
        if (state.page === "family-gallery") familyGallery.focus();
    } else {
        familyGallery.classList.remove("open");
        document.body.style.overflow = "auto";
    }

    if (["home", "structure", "documentation", "pendaftaran"].includes(state.page)) {
        _switchTabUI(state.page);
    }
});

// ==========================================
// DELETE (single & bulk)
// ==========================================
function showToast(msg) {
    const toast = document.createElement("div");
    toast.className = "toast-msg font-tech tracking-wider border-l-4 border-l-red-600";
    toast.innerHTML = `<i class="fas fa-check-circle text-red-500 mr-2"></i> ${msg}`;
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity = "0";
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

let _pendingDeleteId = null;
let _pendingDeleteTitle = null;

function confirmDelete(id, title) {
    _pendingDeleteId = id;
    _pendingDeleteTitle = title;
    document.getElementById("confirm-delete-title").innerText = `Hapus "${title}"?`;
    document.getElementById("confirm-delete-modal").classList.add("active");
}

function closeConfirmDelete() {
    document.getElementById("confirm-delete-modal").classList.remove("active");
    _pendingDeleteId = null;
    _pendingDeleteTitle = null;
}

function toggleSelectFile(event, id) {
    event.stopPropagation();
    if (event.target.checked) selectedFiles.add(id);
    else selectedFiles.delete(id);
    updateBulkDeleteUI();
}

function updateBulkDeleteUI() {
    const btn = document.getElementById("btn-bulk-delete");
    const count = document.getElementById("bulk-delete-count");
    if (selectedFiles.size > 0) {
        btn.classList.remove("hidden");
        btn.classList.add("flex");
        count.innerText = selectedFiles.size;
    } else {
        btn.classList.add("hidden");
        btn.classList.remove("flex");
    }
}

function confirmBulkDelete() {
    document.getElementById("confirm-delete-title").innerText =
        `Hapus ${selectedFiles.size} file yang dipilih secara permanen?`;
    _pendingDeleteId = "BULK";
    document.getElementById("confirm-delete-modal").classList.add("active");
}

async function executeDelete() {
    if (!_pendingDeleteId) return;
    const targetId = _pendingDeleteId;
    closeConfirmDelete();

    try {
        let response, result;
        if (targetId === "BULK") {
            const ids = Array.from(selectedFiles);
            response = await fetch("hapus.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ ids: ids }),
            });
        } else {
            response = await fetch(`hapus.php?id=${targetId}`);
        }
        result = await response.json();

        if (result.success) {
            showNotifModal("success", "BERHASIL DIHAPUS", result.message);
            if (targetId === "BULK") {
                selectedFiles.clear();
                updateBulkDeleteUI();
            }
            await loadGalleryData();
            renderMainDocGrid();
        } else {
            showNotifModal("error", "GAGAL", result.message);
        }
    } catch (error) {
        console.error("Gagal menghapus:", error);
        showNotifModal("error", "ERROR", "Gagal menyambung ke server.");
    }
}

// ==========================================
// NOTIF MODAL
// ==========================================
function showNotifModal(type, title, message) {
    const modal = document.getElementById("notif-action-modal");
    const btn = document.getElementById("notif-action-btn");
    document.getElementById("notif-action-title").innerText = title;
    document.getElementById("notif-action-msg").innerText = message;
    if (type === "success") {
        document.getElementById("notif-action-icon").innerHTML =
            '<i class="fas fa-check-circle text-green-500" style="filter:drop-shadow(0 0 12px rgba(34,197,94,0.7))"></i>';
        btn.className = "w-full py-3 rounded-lg font-bold transition bg-green-600 hover:bg-green-500 text-white uppercase tracking-widest text-sm";
    } else {
        document.getElementById("notif-action-icon").innerHTML =
            '<i class="fas fa-times-circle text-red-500" style="filter:drop-shadow(0 0 12px rgba(239,68,68,0.7))"></i>';
        btn.className = "w-full py-3 rounded-lg font-bold transition bg-red-700 hover:bg-red-600 text-white uppercase tracking-widest text-sm";
    }
    modal.classList.add("active");
}

function closeNotifModal() {
    document.getElementById("notif-action-modal").classList.remove("active");
}

async function handleLogout() {
    try {
        const response = await fetch("logout.php", {
            method: "GET",
            headers: { "X-Requested-With": "XMLHttpRequest" },
        });
        const result = await response.json();
        document.getElementById("admin-controls").classList.add("hidden");
        document.getElementById("admin-controls").classList.remove("flex");
        document.getElementById("nav-logout-btn").classList.add("hidden");
        document.getElementById("nav-upload-btn").classList.add("hidden");
        document.getElementById("nav-login-btn").classList.remove("hidden");
        showNotifModal("success", "LOGOUT BERHASIL", result.message || "Anda telah keluar dari Panel Admin.");
        isAdmin = false;
        renderMainDocGrid();
    } catch (e) {
        showNotifModal("error", "ERROR", "Gagal logout, coba lagi.");
    }
}

// ==========================================
// UPLOAD QUEUE
// ==========================================
function handleFileSelect(files) {
    for (const file of files) uploadQueue.push(file);
    renderQueuePreview();
}

function handleDrop(event) {
    event.preventDefault();
    document.getElementById("drop-zone").classList.remove("border-red-500", "bg-red-950/10");
    const files = event.dataTransfer.files;
    for (const file of files) uploadQueue.push(file);
    renderQueuePreview();
}

function clearQueue() {
    uploadQueue = [];
    document.getElementById("file-input-bulk").value = "";
    renderQueuePreview();
}

function removeFromQueue(index) {
    uploadQueue.splice(index, 1);
    renderQueuePreview();
}

function renderQueuePreview() {
    const container = document.getElementById("file-queue-container");
    const list = document.getElementById("file-queue-list");
    const countEl = document.getElementById("queue-count");

    if (uploadQueue.length === 0) {
        container.classList.add("hidden");
        return;
    }
    container.classList.remove("hidden");
    countEl.innerText = uploadQueue.length;

    const displayList = uploadQueue.slice(0, 50);
    list.innerHTML = displayList.map((file, i) => {
        const sizeKB = (file.size / 1024).toFixed(0);
        const icon = file.type.startsWith("video") ? "fa-film text-blue-400" : "fa-image text-green-400";
        return `<div class="flex items-center justify-between bg-black/30 px-3 py-1.5 rounded text-[10px]">
            <div class="flex items-center gap-2 min-w-0">
                <i class="fas ${icon}"></i>
                <span class="text-gray-300 truncate">${file.name}</span>
            </div>
            <div class="flex items-center gap-2 shrink-0 ml-2">
                <span class="text-gray-600">${sizeKB} KB</span>
                <button type="button" onclick="removeFromQueue(${i})" class="text-gray-600 hover:text-red-500 transition"><i class="fas fa-times"></i></button>
            </div>
        </div>`;
    }).join("");
    if (uploadQueue.length > 50) {
        list.innerHTML += `<p class="text-center text-gray-600 text-[9px] py-1">... dan ${uploadQueue.length - 50} file lainnya</p>`;
    }
}

async function handleBulkUpload(event) {
    event.preventDefault();
    if (uploadQueue.length === 0) {
        showNotifModal("error", "TIDAK ADA FILE", "Pilih minimal satu file terlebih dahulu.");
        return;
    }

    const form = event.target;
    const btn = document.getElementById("btn-upload-submit");
    const judulBase = form.querySelector('[name="judul"]').value.trim();
    const idEvent = form.querySelector('[name="id_event"]').value;
    const total = uploadQueue.length;
    const isMultiple = total > 1;

    const progressContainer = document.getElementById("upload-progress-container");
    const progressBar = document.getElementById("upload-progress-bar");
    const progressText = document.getElementById("upload-progress-text");
    const currentFile = document.getElementById("upload-current-file");
    const errorList = document.getElementById("upload-error-list");

    progressContainer.classList.remove("hidden");
    errorList.innerHTML = "";
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengupload...';
    btn.disabled = true;

    let sukses = 0, gagal = 0;
    const errors = [];

    for (let i = 0; i < total; i++) {
        const file = uploadQueue[i];
        const judul = isMultiple ? `${judulBase} #${i + 1}` : judulBase;

        progressText.innerText = `${i + 1} / ${total}`;
        progressBar.style.width = `${Math.round((i / total) * 100)}%`;
        currentFile.innerText = `Mengupload: ${file.name}`;

        const formData = new FormData();
        formData.append("judul", judul);
        formData.append("id_event", idEvent);
        formData.append("berkas", file);

        try {
            const response = await fetch("proses_upload.php", { method: "POST", body: formData });
            const result = await response.json();
            if (result.success) sukses++;
            else {
                gagal++;
                errors.push(`<p class="text-red-500 text-[9px]"><i class="fas fa-times-circle mr-1"></i>${file.name}: ${result.message}</p>`);
            }
        } catch (err) {
            gagal++;
            errors.push(`<p class="text-red-500 text-[9px]"><i class="fas fa-times-circle mr-1"></i>${file.name}: Koneksi gagal</p>`);
        }
    }

    progressBar.style.width = "100%";
    progressBar.classList.replace("bg-red-600", sukses > 0 ? "bg-green-600" : "bg-red-600");
    progressText.innerText = `${total} / ${total}`;
    currentFile.innerText = `Selesai! ${sukses} berhasil${gagal > 0 ? `, ${gagal} gagal` : ""}.`;
    if (errors.length > 0) errorList.innerHTML = errors.join("");

    await loadGalleryData();
    renderMainDocGrid();

    uploadQueue = [];
    document.getElementById("file-input-bulk").value = "";
    renderQueuePreview();
    btn.innerHTML = '<i class="fas fa-cloud-upload-alt mr-2"></i> Mulai Upload';
    btn.disabled = false;

    if (gagal === 0) {
        showNotifModal("success", "UPLOAD SELESAI", `${sukses} file berhasil diunggah!`);
        progressContainer.classList.add("hidden");
        progressBar.classList.replace("bg-green-600", "bg-red-600");
        progressBar.style.width = "0%";
        closeUploadModal(null, true);
    } else {
        showNotifModal("error", "UPLOAD SELESAI", `${sukses} berhasil, ${gagal} file gagal. Cek log di atas.`);
    }
}

// ==========================================
// NEWS
// ==========================================
function renderNewsList() {
    const grid = document.getElementById("news-grid");
    if (!grid) return;

    let html = "";
    const reversedNews = [...newsData].reverse();

    reversedNews.forEach((news) => {
        html += `
        <div class="glass-panel rounded-2xl overflow-hidden group hover:-translate-y-3 transition-all duration-500 border border-red-500/20 hover:border-red-500/50 hover:shadow-[0_15px_30px_rgba(220,38,38,0.2)] flex flex-col">
            <div class="relative h-56 overflow-hidden bg-black">
                <img src="${news.img}" alt="${news.title}" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-80 group-hover:opacity-100">
                <div class="absolute top-4 left-4 ${news.color} text-white text-[10px] font-bold px-3 py-1 rounded shadow-lg uppercase tracking-widest backdrop-blur-sm bg-opacity-90">${news.category}</div>
            </div>
            <div class="p-6 flex flex-col flex-grow">
                <div class="flex items-center gap-2 text-[11px] text-gray-500 mb-3 font-tech tracking-wider">
                    <i class="far fa-calendar-alt text-red-500"></i> ${news.date}
                </div>
                <h3 class="text-xl font-bold text-white mb-3 leading-snug group-hover:text-red-400 transition-colors line-clamp-2">${news.title}</h3>
                <p class="text-sm text-gray-400 mb-6 line-clamp-3 flex-grow">${news.excerpt}</p>
                <button onclick="openNewsModal(${news.id})" class="inline-flex items-center text-sm font-bold text-red-500 hover:text-white transition-colors w-fit border-b border-transparent hover:border-white pb-1">
                    Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-xs transition-transform group-hover:translate-x-2"></i>
                </button>
            </div>
        </div>`;
    });
    grid.innerHTML = html;
    checkNewsCount();
}

function openNewsModal(id) {
    const news = newsData.find((n) => n.id === id);
    if (!news) return;

    document.getElementById("news-modal-img").src = news.img;
    document.getElementById("news-modal-category").innerText = news.category;
    document.getElementById("news-modal-category").className =
        `absolute top-6 left-6 ${news.color} text-white text-xs font-bold px-3 py-1 rounded shadow-lg uppercase tracking-widest`;
    document.getElementById("news-modal-date").innerText = news.date;
    document.getElementById("news-modal-title").innerText = news.title;
    document.getElementById("news-modal-body").innerHTML = news.content;

    const actionContainer = document.getElementById("news-modal-action");
    if (news.category.toLowerCase() === "kompetisi") actionContainer.classList.remove("hidden");
    else actionContainer.classList.add("hidden");

    const modal = document.getElementById("news-modal");
    const content = document.getElementById("news-content");
    modal.classList.add("active");
    content.classList.remove("scale-95");
    content.classList.add("scale-100");
    document.body.style.overflow = "hidden";
}

function closeNewsModal(e, force = false) {
    if (e && !force) {
        const content = document.getElementById("news-content");
        if (content.contains(e.target)) return;
    }
    const modal = document.getElementById("news-modal");
    const content = document.getElementById("news-content");
    content.classList.remove("scale-100");
    content.classList.add("scale-95");
    setTimeout(() => {
        modal.classList.remove("active");
        document.body.style.overflow = "auto";
    }, 200);
}

function toggleNews() {
    const grid = document.getElementById("news-grid");
    const text = document.getElementById("btn-news-text");
    const icon = document.getElementById("btn-news-icon");

    if (grid.classList.contains("show-all")) {
        grid.classList.remove("show-all");
        text.innerText = "Lihat Semua Artikel";
        icon.className = "fas fa-angle-double-right ml-2 group-hover:translate-x-1 transition-transform";
    } else {
        grid.classList.add("show-all");
        text.innerText = "Tutup Sebagian Artikel";
        icon.className = "fas fa-angle-double-up ml-2 group-hover:-translate-y-1 transition-transform";
    }
}

function checkNewsCount() {
    const btnContainer = document.getElementById("news-btn-container");
    if (btnContainer) {
        btnContainer.style.display = newsData.length <= 3 ? "none" : "block";
    }
}

// ==========================================
// PENDAFTARAN PORTAL
// ==========================================
function renderPendaftaranPortal() {
    const container = document.getElementById('pendaftaran-list');
    const competitions = newsData
        .filter(n => n.category && n.category.toLowerCase() === 'kompetisi')
        .reverse();

    if (competitions.length > 0) {
        let html = '';
        competitions.forEach(c => {
            if (!c.folderName) {
                console.warn("[Pendaftaran] Kompetisi tanpa folderName:", c.title);
                return;
            }
            html += `
            <div class="glass-panel p-6 md:p-8 rounded-2xl border border-red-500/30 flex flex-col md:flex-row gap-6 items-center hover:border-red-500/60 transition-all">
                <div class="w-full md:w-1/3 aspect-video rounded-xl overflow-hidden">
                    <img src="${c.img}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                </div>
                <div class="flex-grow text-center md:text-left">
                    <h3 class="text-xl font-bold text-white mb-2">${c.title}</h3>
                    <p class="text-gray-400 text-sm mb-4 italic">Pendaftaran Aktif</p>
                    <button onclick="openDaftarModal('${c.folderName}')" class="inline-block bg-gradient-to-r from-red-700 to-red-500 hover:from-red-600 hover:to-red-400 text-white px-6 py-2 rounded-lg font-bold transition-all shadow-[0_0_15px_rgba(220,38,38,0.4)]">
                        DAFTAR SEKARANG <i class="fas fa-edit ml-2"></i>
                    </button>
                </div>
            </div>`;
        });

        if (html === "") {
            container.className = "max-w-4xl mx-auto px-4 flex justify-center items-center min-h-[40vh]";
            container.innerHTML = `
            <div class="glass-panel p-10 rounded-2xl border border-red-500/30 text-center shadow-[0_0_30px_rgba(220,38,38,0.1)] w-full max-w-lg">
                <i class="fas fa-rocket text-6xl text-gray-600 mb-6 drop-shadow-md"></i>
                <h3 class="text-2xl font-tech font-bold text-white mb-2">Belum Ada Kompetisi</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Saat ini belum ada event atau perlombaan yang sedang membuka pendaftaran.</p>
            </div>`;
        } else {
            container.className = "max-w-4xl mx-auto px-4 grid grid-cols-1 gap-6";
            container.innerHTML = html;
        }
    } else {
        container.className = "max-w-4xl mx-auto px-4 flex justify-center items-center min-h-[40vh]";
        container.innerHTML = `
        <div class="glass-panel p-10 rounded-2xl border border-red-500/30 text-center shadow-[0_0_30px_rgba(220,38,38,0.1)] w-full max-w-lg">
            <i class="fas fa-rocket text-6xl text-gray-600 mb-6 drop-shadow-md"></i>
            <h3 class="text-2xl font-tech font-bold text-white mb-2">Belum Ada Kompetisi</h3>
            <p class="text-gray-400 text-sm leading-relaxed">Saat ini belum ada event atau perlombaan yang sedang membuka pendaftaran. Nantikan info menarik selanjutnya!</p>
        </div>`;
    }
}

// ==========================================
// STRUKTUR DIVISI
// ==========================================
function renderDivisionStructure() {
    const container = document.getElementById('division-container');
    if (!container) return;

    const divisions = ["Public Speaking", "Media", "Intelektual", "PKM"];
    let html = '';

    divisions.forEach(divName => {
        const members = studentsData.filter(s => s.divisi === divName);
        const co = members.find(m => m.role === "CO");
        const staff = members.filter(m => m.role === "Anggota");

        if (members.length > 0) {
            html += `
            <div class="division-block mb-16 md:mb-24 px-4">
                <div class="flex items-center gap-4 mb-8 md:mb-12">
                    <div class="h-[1px] md:h-[2px] flex-grow bg-gradient-to-r from-transparent to-red-900"></div>
                    <h3 class="font-tech text-lg md:text-3xl font-bold text-white tracking-widest uppercase">${divName}</h3>
                    <div class="h-[1px] md:h-[2px] flex-grow bg-gradient-to-l from-transparent to-red-900"></div>
                </div>

                <div class="hidden md:block">
                    <div class="tree">
                        <ul>
                            <li>
                                ${co ? `
                                <div class="glass-panel p-5 rounded-2xl border border-red-500/40 inline-block w-52 text-center cursor-pointer transition-all hover:bg-red-900/40 shadow-lg relative z-10" onclick="openBioModalByName('${co.name}')">
                                    <img src="${co.img}" class="w-20 h-20 mx-auto rounded-full mb-3 border-2 border-red-500 object-cover" onerror="this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(co.name)}&background=random'">
                                    <h4 class="text-white font-bold text-sm">${co.name}</h4>
                                    <span class="inline-block bg-red-600 text-white text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-widest mt-2">CO DIVISI</span>
                                </div>` : ''}
                                <ul>
                                    ${staff.map(s => `
                                    <li>
                                        <div class="glass-panel p-4 rounded-2xl border border-gray-800 hover:border-red-500/50 w-40 text-center cursor-pointer transition-all hover:-translate-y-1 relative z-20" onclick="openBioModalByName('${s.name}')">
                                            <div class="w-16 h-16 mx-auto bg-gray-900 rounded-full mb-2 overflow-hidden border border-gray-700">
                                                <img src="${s.img}" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(s.name)}&background=random'">
                                            </div>
                                            <h5 class="text-white text-xs font-bold line-clamp-1">${s.name}</h5>
                                            <p class="text-[9px] text-gray-500 uppercase mt-1 tracking-widest">Anggota</p>
                                        </div>
                                    </li>`).join('')}
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="md:hidden flex flex-col items-center w-full overflow-hidden">
                    ${co ? `
                    <div class="glass-panel p-4 rounded-xl border border-red-500/40 w-48 text-center mb-6" onclick="openBioModalByName('${co.name}')">
                        <img src="${co.img}" class="w-16 h-16 mx-auto rounded-full mb-2 border border-red-500 object-cover">
                        <h4 class="text-white font-bold text-xs">${co.name}</h4>
                        <p class="text-[8px] text-red-500 uppercase font-bold mt-1">CO DIVISI</p>
                    </div>` : ''}
                    <div class="flex flex-wrap justify-center gap-3 w-full px-2 overflow-hidden">
                        ${staff.map(s => `
                        <div class="glass-panel p-3 rounded-xl border border-gray-800 w-[45%] text-center" onclick="openBioModalByName('${s.name}')">
                            <img src="${s.img}" class="w-12 h-12 mx-auto rounded-full mb-2 object-cover border border-gray-700">
                            <h5 class="text-white text-[10px] font-bold line-clamp-1">${s.name}</h5>
                            <p class="text-[8px] text-gray-500 uppercase mt-1">Anggota</p>
                        </div>`).join('')}
                    </div>
                </div>
            </div>`;
        }
    });

    container.innerHTML = html;
}

function openBioModalByName(name) {
    const index = studentsData.findIndex(s => s.name === name);
    if (index !== -1) openBioModal(index);
}

// ==========================================
// TIMELINE
// ==========================================
function renderTimeline() {
    const container = document.getElementById('proker-timeline');
    if (!container) return;

    let html = '<div class="relative border-l-2 border-red-900/50 ml-3 md:ml-6 space-y-8 md:space-y-12 py-4">';

    timelineData.forEach((item) => {
        const isCompleted = item.status === 'completed';
        const dotColor = isCompleted ? 'bg-red-600 border-red-400 shadow-[0_0_15px_rgba(220,38,38,0.8)]' : 'bg-gray-900 border-gray-600';
        const titleColor = isCompleted ? 'text-white' : 'text-gray-400';
        const iconColor = isCompleted ? 'text-red-500' : 'text-gray-600';
        const borderColor = isCompleted ? 'border-red-500/40 hover:border-red-500/80' : 'border-gray-800 hover:border-gray-600';

        html += `
        <div class="relative pl-8 md:pl-12 group cursor-default">
            <div class="absolute -left-[11px] top-2 w-5 h-5 rounded-full border-2 ${dotColor} transition-all duration-500 group-hover:scale-125 flex items-center justify-center z-10"></div>
            <div class="glass-panel p-5 md:p-8 rounded-2xl border ${borderColor} transition-all duration-500 hover:-translate-y-1 hover:shadow-xl">
                <span class="text-[10px] md:text-xs font-bold ${isCompleted ? 'text-red-400' : 'text-gray-500'} uppercase tracking-widest mb-2 block">${item.month}</span>
                <h4 class="text-xl md:text-2xl font-bold font-tech ${titleColor} mb-3 flex items-center gap-3 transition-colors duration-300">
                    <i class="fas ${item.icon} ${iconColor} text-lg md:text-xl transition-colors duration-300"></i>
                    ${item.title}
                </h4>
                <p class="text-xs md:text-sm text-gray-400 leading-relaxed">${item.desc}</p>
            </div>
        </div>`;
    });

    html += '</div>';
    container.innerHTML = html;
}

// ==========================================
// COUNTDOWN
// ==========================================
function startCountdown() {
    const eventDate = new Date("Jun 5, 2026 08:00:00").getTime();

    const timer = setInterval(() => {
        const now = new Date().getTime(), dist = eventDate - now;
        const d = Math.floor(dist / (1000 * 60 * 60 * 24)),
              h = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
              m = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));

        const daysEl = document.getElementById("days");
        if (daysEl) {
            daysEl.innerText = d < 10 ? "0" + d : (d < 0 ? "00" : d);
            document.getElementById("hours").innerText = h < 10 ? "0" + h : (h < 0 ? "00" : h);
            document.getElementById("minutes").innerText = m < 10 ? "0" + m : (m < 0 ? "00" : m);
        }

        if (dist < 0) {
            clearInterval(timer);
            const subtitle = document.querySelector(".max-w-4xl.mx-auto.px-4.mb-20 h3");
            if (subtitle) {
                subtitle.innerText = "🔴 HAPPENING NOW / LIVE EVENT";
                subtitle.classList.add("animate-pulse", "text-red-400");
            }
            const timerGrid = document.querySelector(".max-w-4xl.mx-auto.px-4.mb-20 .glass-panel > div.flex.justify-center");
            if (timerGrid) {
                timerGrid.innerHTML = `
                <div class="text-2xl md:text-5xl font-tech font-bold text-red-500 tracking-[0.2em] shadow-red-500/50 drop-shadow-[0_0_20px_rgba(220,38,38,0.9)] py-4 my-4 border-y border-red-900/50">
                    SEDANG BERLANGSUNG
                </div>`;
            }
        }
    }, 1000);
}

// ==========================================
// SEARCH ANGGOTA (desktop only)
// ==========================================
function filterMembers() {
    if (window.innerWidth < 768) return;

    const input = document.getElementById('member-search').value.toLowerCase();
    const allCards = document.querySelectorAll('.glass-panel[onclick*="openBioModalByName"]');
    let firstMatch = null;

    allCards.forEach(card => {
        const nameEl = card.querySelector('h3, h4, h5');
        if (!nameEl) return;
        const match = nameEl.innerText.toLowerCase().includes(input);

        if (input === "") {
            card.style.opacity = "1";
            card.style.filter = "none";
        } else if (match) {
            card.style.opacity = "1";
            card.style.filter = "drop-shadow(0 0 15px rgba(220,38,38,0.8))";
            if (!firstMatch) firstMatch = card;
        } else {
            card.style.opacity = "0.1";
            card.style.filter = "grayscale(100%)";
        }
    });

    if (firstMatch && input.length >= 3) {
        setTimeout(() => firstMatch.scrollIntoView({ behavior: 'smooth', block: 'center' }), 100);
    }
}

// ==========================================
// MODAL DAFTAR LOMBA (DINAMIS)
// ==========================================
function openDaftarModal(folderName) {
    if (!folderName) {
        showNotifModal('error', 'ERROR', 'Data lomba tidak lengkap.');
        return;
    }
    const lomba = newsData.find(n => n.folderName === folderName);
    if (!lomba) {
        showNotifModal('error', 'ERROR', 'Lomba tidak ditemukan.');
        return;
    }

    document.getElementById('modal-lomba-title').innerText = 'Daftar ' + lomba.folderName;
    document.getElementById('input-nama-lomba').value = lomba.folderName;

    const container = document.getElementById('dynamic-inputs-container');
    let htmlInputs = '';
    
    if (lomba.formFields) {
        lomba.formFields.forEach(field => {
            const widthClass = field.halfWidth ? 'w-full md:w-[48%] md:mr-[2%]' : 'w-full';
            
            // --- LOGIKA BARU BUAT RENDER INPUT ---
            let inputElement = '';
            
            if (field.type === 'select') {
                // Render Dropdown
                let optionsHtml = field.options.map(opt => `<option value="${opt.value}">${opt.label}</option>`).join('');
                inputElement = `
                    <select id="dyn_${field.id}" data-label="${field.label}" required class="dyn-input w-full bg-black/50 border border-gray-700 rounded-xl px-4 py-3 text-white text-sm focus:border-red-500 outline-none transition-all cursor-pointer appearance-none">
                        <option value="" disabled selected>-- Pilih ${field.label} --</option>
                        ${optionsHtml}
                    </select>`;
            } else if (field.type === 'textarea') {
                // Render Textarea (buat motivasi)
                inputElement = `
                    <textarea id="dyn_${field.id}" data-label="${field.label}" required placeholder="${field.placeholder}" rows="3" class="dyn-input w-full bg-black/50 border border-gray-700 rounded-xl px-4 py-3 text-white text-sm focus:border-red-500 outline-none transition-all placeholder:text-gray-600 resize-none"></textarea>`;
            } else {
                // Render Input biasa (text, tel, dll)
                inputElement = `
                    <input type="${field.type}" id="dyn_${field.id}" data-label="${field.label}" required placeholder="${field.placeholder}" class="dyn-input w-full bg-black/50 border border-gray-700 rounded-xl px-4 py-3 text-white text-sm focus:border-red-500 outline-none transition-all placeholder:text-gray-600">`;
            }

            htmlInputs += `
            <div class="${widthClass} mb-4">
                <label class="block text-gray-400 text-[10px] font-bold mb-1 uppercase tracking-widest">${field.label}</label>
                ${inputElement}
            </div>`;
        });
    }
    container.innerHTML = htmlInputs;

    const fileSection = document.getElementById('file-upload-section');
    const fileInput = document.getElementById('input-file');

    if (lomba.requireFile === false) {
        fileSection.style.display = 'none';
        fileInput.removeAttribute('required');
    } else {
        fileSection.style.display = 'block';
        fileInput.setAttribute('required', 'required');
        document.getElementById('dynamic-file-label').innerText = lomba.fileLabel || "Upload File Persyaratan";
    }

    const modal = document.getElementById('daftar-modal');
    const panel = modal.querySelector('.glass-panel');
    modal.classList.add('active');
    setTimeout(() => panel.classList.replace('scale-95', 'scale-100'), 10);
}

function closeDaftarModal() {
    const modal = document.getElementById('daftar-modal');
    const panel = modal.querySelector('.glass-panel');
    panel.classList.replace('scale-100', 'scale-95');
    setTimeout(() => {
        modal.classList.remove('active');
        const form = document.getElementById('form-pendaftaran');
        if (form) form.reset();
        const fileNameDisplay = document.getElementById('file-name-display');
        if (fileNameDisplay) fileNameDisplay.innerText = "Klik untuk memilih file";
    }, 200);
}

async function submitPendaftaran(e) {
    e.preventDefault();
    const btn = document.getElementById('btn-submit-daftar');
    const folderName = document.getElementById('input-nama-lomba').value;
    const lomba = newsData.find(n => n.folderName === folderName);

    if (!lomba) {
        showNotifModal('error', 'ERROR', 'Data lomba tidak ditemukan.');
        return;
    }

    const isFileRequired = lomba.requireFile !== false;
    const fileInput = document.getElementById('input-file');
    const file = fileInput.files[0];

    if (isFileRequired && !file) {
        alert("Pilih file terlebih dahulu!");
        return;
    }

    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sedang Mengirim...';
    btn.disabled = true;

    let biodataText = "=== BIODATA PENDAFTAR ===\n";
    biodataText += "Lomba: " + folderName + "\n";
    const allDynInputs = document.querySelectorAll('.dyn-input');
    allDynInputs.forEach(input => {
        biodataText += input.getAttribute('data-label') + ": " + input.value + "\n";
    });
    const namaPendaftar = allDynInputs.length > 0 ? allDynInputs[0].value : "TanpaNama";

    const sendData = async (base64Data, fileName, fileType) => {
        const payload = new URLSearchParams({
            nama_lomba: folderName,
            namaLengkap: namaPendaftar,
            biodata_lengkap: biodataText,
            fileName: fileName || "",
            fileType: fileType || "",
            fileData: base64Data || "",
            hasFile: isFileRequired ? "yes" : "no"
        });

        try {
            const scriptURL = "https://script.google.com/macros/s/AKfycbxIhON9fdF_wNqMSxPhSNXLMVlJuAKlRSQRgjYfZB8eCbfuJANaWJxG8zjW6CIsORI_8Q/exec";
            const response = await fetch(scriptURL, { method: "POST", body: payload });
            const result = await response.json();

            if (result.result === "success") {
                showNotifModal('success', 'PENDAFTARAN BERHASIL', 'Data kamu sudah tersimpan di sistem kami.');
                closeDaftarModal();
            } else throw new Error(result.message);
        } catch (error) {
            showNotifModal('error', 'GAGAL MENGIRIM', error.message || 'Terjadi kesalahan sistem.');
        } finally {
            btn.innerHTML = 'Kirim Pendaftaran <i class="fas fa-paper-plane"></i>';
            btn.disabled = false;
        }
    };

    if (isFileRequired && file) {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = async function () {
            const base64Data = reader.result.split(',')[1];
            await sendData(base64Data, file.name, file.type);
        };
    } else {
        await sendData("", "", "");
    }
}

// ==========================================
// EFEK NAMA FILE DI FORM PENDAFTARAN
// ==========================================
const fileInputDaftar = document.getElementById('input-file');
if (fileInputDaftar) {
    fileInputDaftar.addEventListener('change', function (e) {
        const display = document.getElementById('file-name-display');
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            const sizeKB = (file.size / 1024).toFixed(0);
            display.innerHTML = `<span class="text-white font-bold">${file.name}</span> <br> <span class="text-[10px] text-red-400">(${sizeKB} KB)</span>`;
        } else {
            display.innerText = "Klik untuk memilih file";
        }
    });
}