<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MONHAFIDZ AMJQQ - Sistem Hafalan Santri</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
    .fade-in { opacity: 0; transform: translateY(20px); transition: all .8s ease; }
    .fade-in.visible { opacity: 1; transform: translateY(0); }
  </style>
</head>
<body class="bg-white text-gray-800">

  <!-- Header -->
  <header class="bg-green-900 text-white">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-4">
      <h1 class="text-xl font-semibold flex items-center gap-2">
        <img src="{{ asset('images/logo.png') }}" style="width: 40px" class="rounded-full" alt="logo">
        Pondok Al Munawwar
      </h1>
      <nav class="space-x-4 hidden md:block">
        <a href="#" class="hover:text-yellow-300">Beranda</a>
        <a href="#" class="hover:text-yellow-300">Tentang</a>
        <a href="#" class="hover:text-yellow-300">Program</a>
        <a href="#" class="hover:text-yellow-300">Pengumuman</a>
        <a href="#" class="hover:text-yellow-300">Kontak</a>
      </nav>
      <button class="bg-yellow-400 text-green-900 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-300 transition" onclick="window.location.href = '/dashboard'">Mulai Monitoring</button>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="bg-gradient-to-b from-green-900 to-green-700 text-white text-center py-16 relative overflow-hidden">
    <div class="fade-in">
      <h2 class="text-3xl md:text-4xl font-bold mb-4">Sistem Monitoring Hafalan Santri</h2>
      <p class="text-lg mb-6">Yakinlah dengan iman, lanjutkan dengan ilmu, sempurnakan dengan amal.</p>
      <div class="flex justify-center gap-6 flex-wrap mt-10">
        <div class="bg-white/10 backdrop-blur p-4 rounded-xl w-40">
          <p class="text-2xl font-bold">100+</p><p>Santri Aktif</p>
        </div>
        <div class="bg-white/10 backdrop-blur p-4 rounded-xl w-40">
          <p class="text-2xl font-bold">50+</p><p>Ustadz & Ustadzah</p>
        </div>
        <div class="bg-white/10 backdrop-blur p-4 rounded-xl w-40">
          <p class="text-2xl font-bold">10+</p><p>Tahun Berjalan</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Tentang Kami -->
  <section class="py-16 max-w-6xl mx-auto px-6 text-center fade-in">
    <h3 class="text-3xl font-semibold text-green-800 mb-4">Tentang Kami</h3>
    <p class="text-gray-600 leading-relaxed max-w-3xl mx-auto">
      Sistem Hafalan Santri Tahfidz di Pondok Pesantren Al Munawwar dirancang untuk memudahkan monitoring perkembangan hafalan santri secara digital.
      Ustadz dapat mencatat hafalan baru (ziyadah) dan muraja‘ah secara real time, sementara wali santri dapat memantau progres hafalan anaknya.
    </p>
    <img src="https://placehold.co/600x350" alt="Tentang" class="rounded-2xl mx-auto mt-8 shadow-lg">
  </section>

  <!-- Statistik -->
  <section class="bg-green-50 py-12 fade-in">
    <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
      <div class="bg-white shadow rounded-xl p-6 hover:scale-105 transition">
        <p class="text-4xl text-green-700 font-bold">100+</p>
        <p>Santri</p>
      </div>
      <div class="bg-white shadow rounded-xl p-6 hover:scale-105 transition">
        <p class="text-4xl text-green-700 font-bold">25+</p>
        <p>Ustadz</p>
      </div>
      <div class="bg-white shadow rounded-xl p-6 hover:scale-105 transition">
        <p class="text-4xl text-green-700 font-bold">15+</p>
        <p>Kelas</p>
      </div>
      <div class="bg-white shadow rounded-xl p-6 hover:scale-105 transition">
        <p class="text-4xl text-green-700 font-bold">5+</p>
        <p>Program</p>
      </div>
    </div>
  </section>

  <!-- Program Hafalan -->
  <section class="py-16 max-w-6xl mx-auto px-6 fade-in">
    <h3 class="text-3xl font-semibold text-center text-green-800 mb-10">Sistem Hafalan Santri Tahfidz</h3>
    <div class="flex flex-col md:flex-row justify-center items-center gap-8">
      <img src="https://placehold.co/500x300" class="rounded-2xl shadow-lg" alt="Program">
      <div class="text-center md:text-left max-w-md">
        <p class="text-gray-700 mb-4">
          Santri dapat mencatat hafalan baru (ziyadah) dan muraja‘ah harian, sementara guru dapat melakukan penilaian dan verifikasi.
          Data hafalan akan terhubung dengan laporan otomatis dan grafik perkembangan hafalan setiap semester.
        </p>
        <a href="#" class="bg-green-700 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-600 transition">Mulai Sekarang</a>
      </div>
    </div>
  </section>

  <!-- Informasi & Pengumuman -->
  <section class="bg-green-50 py-16 fade-in">
    <div class="max-w-6xl mx-auto px-6">
      <h3 class="text-3xl font-semibold text-green-800 text-center mb-10">Informasi & Pengumuman</h3>
      <div class="grid md:grid-cols-4 gap-6">
        <div class="bg-white shadow-md rounded-xl overflow-hidden hover:scale-105 transition">
          <img src="https://placehold.co/400x200" alt="img">
          <div class="p-4">
            <h4 class="font-semibold text-green-700">Pengumuman Ujian Hafalan</h4>
            <p class="text-sm text-gray-600 mt-2">Jadwal ujian hafalan semester ganjil telah diumumkan.</p>
          </div>
        </div>
        <div class="bg-white shadow-md rounded-xl overflow-hidden hover:scale-105 transition">
          <img src="https://placehold.co/400x200" alt="img">
          <div class="p-4">
            <h4 class="font-semibold text-green-700">Wisuda Tahfidz</h4>
            <p class="text-sm text-gray-600 mt-2">Wisuda tahfidz akan diadakan pada bulan Ramadhan mendatang.</p>
          </div>
        </div>
        <div class="bg-white shadow-md rounded-xl overflow-hidden hover:scale-105 transition">
          <img src="https://placehold.co/400x200" alt="img">
          <div class="p-4">
            <h4 class="font-semibold text-green-700">Penerimaan Santri Baru</h4>
            <p class="text-sm text-gray-600 mt-2">Pendaftaran santri baru tahun ajaran 2025/2026 telah dibuka.</p>
          </div>
        </div>
        <div class="bg-white shadow-md rounded-xl overflow-hidden hover:scale-105 transition">
          <img src="https://placehold.co/400x200" alt="img">
          <div class="p-4">
            <h4 class="font-semibold text-green-700">Kegiatan Pondok</h4>
            <p class="text-sm text-gray-600 mt-2">Lihat kegiatan pondok terbaru di halaman galeri.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Wisudawan -->
  <section class="py-16 max-w-6xl mx-auto px-6 fade-in">
    <h3 class="text-3xl font-semibold text-center text-green-800 mb-10">Wisudawan Tahfidz</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
      <div>
        <img src="https://placehold.co/200x200" class="rounded-xl mx-auto mb-2 shadow">
        <p class="font-semibold">Fulan Bin Fulan</p>
      </div>
      <div>
        <img src="https://placehold.co/200x200" class="rounded-xl mx-auto mb-2 shadow">
        <p class="font-semibold">Ahmad Zaid</p>
      </div>
      <div>
        <img src="https://placehold.co/200x200" class="rounded-xl mx-auto mb-2 shadow">
        <p class="font-semibold">Muhammad Yusuf</p>
      </div>
      <div>
        <img src="https://placehold.co/200x200" class="rounded-xl mx-auto mb-2 shadow">
        <p class="font-semibold">Ali Rahman</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-green-900 text-white py-10 text-center">
    <h4 class="text-lg font-semibold mb-2">Pondok Pesantren Al Munawwar Jannatulqur'an</h4>
    <p class="text-sm text-green-200 mb-4">Jl. Pesantren No. 123, Bogor - Indonesia</p>
    <div class="flex justify-center gap-4 mb-4">
      <a href="#" class="hover:text-yellow-300">Facebook</a>
      <a href="#" class="hover:text-yellow-300">Instagram</a>
      <a href="#" class="hover:text-yellow-300">YouTube</a>
    </div>
    <p class="text-xs text-green-300">&copy; 2025 MONHAFIDZ AMJQQ. All rights reserved.</p>
  </footer>

  <script>
    // Animasi muncul saat scroll
    const faders = document.querySelectorAll('.fade-in');
    const appearOnScroll = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('visible');
      });
    }, { threshold: 0.2 });
    faders.forEach(el => appearOnScroll.observe(el));
  </script>

</body>
</html>