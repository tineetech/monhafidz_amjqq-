<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MONHAFIDZ AMJQQ - Sistem Hafalan Santri</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Poppins', sans-serif; }
    .fade-in { opacity: 0; transform: translateY(25px); transition: all .8s ease; }
    .fade-in.visible { opacity: 1; transform: translateY(0); }

    .scrolled {
      background-color: white !important;
      color: black !important;
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
  </style>
</head>

<body class="bg-white text-gray-800">

<!-- HEADER -->
<header id="header" class="fixed top-0 left-0 w-full py-4 bg-white/10 backdrop-blur text-white transition-all duration-300 z-50">
  <div class="max-w-7xl mx-auto flex justify-between items-center px-4">
    <div class="flex items-center gap-2 text-xl font-semibold">
      <img src="{{ asset('images/logo.png') }}" class="w-10 rounded-full">
      <span class="header-text">MONHAFIDZ AMJQQ</span>
    </div>

    <nav class="hidden md:flex gap-6">
      <a href="#" class="header-link hover:text-yellow-300">Beranda</a>
      <a href="#" class="header-link hover:text-yellow-300">Tentang</a>
      <a href="#" class="header-link hover:text-yellow-300">Program</a>
      <a href="#" class="header-link hover:text-yellow-300">Pengumuman</a>
      <a href="#" class="header-link hover:text-yellow-300">Kontak</a>
    </nav>

    <button onclick="window.location.href='/dashboard'"
      class="bg-yellow-400 hover:bg-yellow-300 text-green-900 px-4 py-2 rounded-lg font-semibold">
      Mulai Monitoring
    </button>
  </div>
</header>

<!-- HERO -->
<section class="h-screen flex items-center justify-center text-center text-white relative overflow-hidden"
  style="background:url('{{ asset('images/header-bg.png') }}') center/cover;">
  <div class="fade-in">
    <h1 class="text-4xl md:text-5xl font-bold">Sistem Monitoring Hafalan Santri</h1>
    <p class="text-lg mt-4">Yakinlah dengan iman, lanjutkan dengan ilmu, sempurnakan dengan amal.</p>

    <div class="grid grid-cols-3 gap-6 mt-10 max-w-md mx-auto">
      <div class="bg-white/10 backdrop-blur p-4 rounded-xl">
        <p class="text-3xl font-bold">{{ $santri .'+' ?? '0' }}</p>
        <p>Santri</p>
      </div>
      <div class="bg-white/10 backdrop-blur p-4 rounded-xl">
        <p class="text-3xl font-bold">{{ $ustad . '+' ?? '0' }}</p>
        <p>Ustadz</p>
      </div>
      <div class="bg-white/10 backdrop-blur p-4 rounded-xl">
        <p class="text-3xl font-bold">{{ $santri_lulus . '+' ?? '0' }}</p>
        <p>Santri lulus</p>
      </div>
    </div>
  </div>
</section>

<div class="max-w-6xl mx-auto relative z-20" style="margin-top: -100px">
  <div class="bg-white rounded-2xl shadow-xl p-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

      <!-- Item 1 -->
      <div class="border rounded-xl p-6 flex flex-col items-center text-center hover:shadow-md transition">
        <div class="bg-green-700 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4">
          <!-- icon -->
          <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v12H4zM4 16l4-4m4 4l4-4"></path>
          </svg>
        </div>
        <p class="text-sm font-medium text-gray-700">Pencatatan & Penilaian Hafalan</p>
      </div>

      <!-- Item 2 -->
      <div class="border rounded-xl p-6 flex flex-col items-center text-center hover:shadow-md transition">
        <div class="bg-green-700 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"></path>
          </svg>
        </div>
        <p class="text-sm font-medium text-gray-700">Jadwal Setor Hafalan</p>
      </div>

      <!-- Item 3 -->
      <div class="border rounded-xl p-6 flex flex-col items-center text-center hover:shadow-md transition">
        <div class="bg-green-700 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 0c-4 0-7 3-7 7h14c0-4-3-7-7-7z"></path>
          </svg>
        </div>
        <p class="text-sm font-medium text-gray-700">Absensi Santri</p>
      </div>

      <!-- Item 4 -->
      <div class="border rounded-xl p-6 flex flex-col items-center text-center hover:shadow-md transition">
        <div class="bg-green-700 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M9 17l2-3 2 2 3-5"></path>
          </svg>
        </div>
        <p class="text-sm font-medium text-gray-700">Laporan Perkembangan Hafalan</p>
      </div>

    </div>
  </div>
</div>


<!-- TENTANG KAMI -->
<section class="py-20 max-w-6xl mx-auto px-6 fade-in flex flex-col md:flex-row items-center gap-10">
  <img src="{{ asset('images/logo.png') }}" style="width: 600px;height: 380px;" class="rounded-2xl shadow-lg">

  <div>
    <h2 class="text-3xl font-bold  mb-4">Tentang Kami</h2>
    <h2 class="text-2xl text-green-600  mb-4">Sistem Hafalan Santri Tahfidz di Pondok Pesantren al munawwar jarnauziyyah qiro'atul qur'an.</h2>
    <p class="leading-relaxed text-gray-600">
      Sistem Hafalan Santri Tahfidz di Pondok Pesantren Al munawwar jarnauziyyah qiro'atul qur'an dirancang
      untuk memudahkan monitoring perkembangan hafalan santri secara digital.
      Ustadz dapat mencatat hafalan baru (ziyadah) dan muraja‘ah secara real time,
      sementara wali santri dapat memantau progres hafalan anaknya.
    </p>
  </div>
</section>

<!-- STATISTIK -->
<section class="bg-green-50 py-16 fade-in">
  <h2 class="text-3xl text-center font-bold  mb-8">Statistik Pondok & Program</h2>
  <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
    <div class="bg-white shadow-md rounded-xl p-6 hover:scale-105 transition">
      <p class="text-4xl font-bold text-green-700">{{ $santri .'+' ?? '0' }}</p><p>Santri</p>
    </div>
    <div class="bg-white shadow-md rounded-xl p-6 hover:scale-105 transition">
      <p class="text-4xl font-bold text-green-700">{{ $ustad .'+' ?? '0' }}</p><p>Ustadz</p>
    </div>
    <div class="bg-white shadow-md rounded-xl p-6 hover:scale-105 transition">
      <p class="text-4xl font-bold text-green-700">{{ $pencatatan_hafalan .'+' ?? '0' }}</p><p>Pencatatan Hafalan</p>
    </div>
    <div class="bg-white shadow-md rounded-xl p-6 hover:scale-105 transition">
      <p class="text-4xl font-bold text-green-700">{{ $santri_lulus .'+' ?? '0' }}</p><p>Santri Lulus</p>
    </div>
  </div>
</section>

<section class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-10 items-start fade-in">

  <!-- VISI -->
  <div>
    <h3 class="text-xl font-semibold text-gray-800 mb-3">Visi</h3>

    <p class="text-green-700 font-medium leading-relaxed mb-6">
      Menyiapkan dan mewujudkan generasi qur'ani yang berakhlakul karimah
      cerdas, trampil kreatif inovatif dan bertanggung jawab
    </p>

    <!-- VIDEO -->
    <div class="rounded-2xl overflow-hidden shadow-lg border border-green-200">
      <img src="{{ asset('images/logo.png') }}" style="width: 600px;height: 330px;" alt="Video" class="w-full">
    </div>
  </div>

  <!-- MISI -->
  <div class="h-full">
    <div class="bg-gradient-to-br from-green-600 to-green-400 rounded-3xl p-8 shadow-lg h-full" style="">

      <h3 class="text-white text-xl font-semibold mb-6">Misi</h3>

      <div class=" h-[90%]">

        <div class="grid grid-cols-2 gap-4">
  
          <!-- Card 1 -->
          <div class="bg-white rounded-xl p-4 shadow-sm text-center text-gray-700 text-sm font-medium">
            Membekali Generasi yang hafal Al-Qur'an
          </div>
  
          <!-- Card 2 -->
          <div class="bg-white rounded-xl p-4 shadow-sm text-center text-gray-700 text-sm font-medium">
            Menciptakan Generasi yang bertaqwa dan berakhlakul karimah
          </div>
  
        </div>
  
        <!-- Full width card -->
        <div class="bg-white h-[60%] flex justify-center items-center rounded-xl p-4 shadow-sm  text-center text-gray-700 text-sm font-medium mt-4">
          Menciptakan santri yang kreatif, inovatif dan bermoral
        </div>
      </div>

    </div>
  </div>

</section>

<!-- PROGRAM -->
<section class="py-20 max-w-6xl mx-auto px-6 fade-in">
  <h2 class="text-center text-3xl font-bold text-green-700">Sistem Hafalan Santri Tahfidz</h2>

  <div class="grid md:grid-cols-1 gap-10 justify-center items-center">
    <img src="{{ asset('/images/proto.png') }}" class="w-full rounded-xl">
    <div class="flex flex-col justify-center items-center">
      <p class="text-gray-700 mb-4 leading-relaxed text-3xl text-green-600">
        Kelola Hafalan Santri dengan mudah kini di MONHAFIDZ AMJQQ
      </p>
      <a href="/dashboard" class="bg-green-700 px-6 py-3 text-white rounded-lg hover:bg-green-600">
        Mulai Sekarang
      </a>
    </div>
  </div>
</section>

<!-- INFORMASI -->
<section class=" py-20 fade-in">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-center text-3xl font-bold text-green-700 mb-10">Informasi & Pengumuman</h2>

    <section class="max-w-7xl mb-8 mx-auto ">

      <!-- Container besar -->
      <div class="bg-white rounded-3xl shadow-lg p-10">

        <!-- Judul -->
        <h2 class="text-center text-2xl md:text-3xl  mb-10">
          Ringkasan Keseluruhan
        </h2>

        <!-- Grid Card -->
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-4">

          <!-- Card 1 -->
          <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="{{ asset('/images/info-wisudatahfidz.png') }}" class="w-full">
            <div class="p-4">
              <h3 class="font-semibold text-gray-800">Wisuda Tahfidz</h3>
              <p class="text-sm text-gray-600 mt-2">
                Pemberian Sertifikat bagi santri yang telah menyelesaikan hafalan 30 juz.
              </p>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="{{ asset('/images/info-tasmiakbar.png') }}" class="w-full">
            <div class="p-4">
              <h3 class="font-semibold text-gray-800">Tasmī’ Akbar</h3>
              <p class="text-sm text-gray-600 mt-2">
                Kegiatan penyetoran hafalan secara terbuka sebagai bentuk evaluasi dan motivasi bersama.
              </p>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="{{ asset('/images/info-ujian.png') }}" class="w-full">
            <div class="p-4">
              <h3 class="font-semibold text-gray-800">Ujian Tahfidz Semester</h3>
              <p class="text-sm text-gray-600 mt-2">
                Evaluasi berkala untuk menilai ketepatan, tajwīd, dan kelancaran hafalan santri.
              </p>
            </div>
          </div>

          <!-- Card 4 -->
          <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
            <img src="{{ asset('/images/info-ranking.png') }}" class="w-full">
            <div class="p-4">
              <h3 class="font-semibold text-gray-800">Pengumuman Ranking & Penghargaan</h3>
              <p class="text-sm mt-2 text-gray-600">
                Pemberian penghargaan kepada santri berprestasi yang mencapai target hafalan terbaik.
              </p>
            </div>
          </div>

        </div>
      </div>

    </section>

    <section class="max-w-7xl mx-auto py-20 fade-in">

      <!-- Container besar -->
      <div class="bg-white rounded-3xl shadow-lg p-10">

        <!-- Judul -->
        <h2 class="text-center text-2xl md:text-3xl font-semibold text-green-700 mb-12">
          Kejuaraan Santri 2025/2026
        </h2>

        <!-- Grid 4 Box -->
        <div class="grid md:grid-cols-2 gap-10">


          <!-- Box 3 -->
          <div class="bg-green-700 text-white p-6 rounded-2xl shadow-lg">
            <h3 class="text-center font-semibold mb-5">Juara 123 Santri Putra Ziyadah</h3>

            {{-- <div class="bg-white text-gray-800 rounded-xl p-4 flex items-center gap-3 mb-3">
              <img src="https://placehold.co/60x60" class="w-12 h-12 rounded-full">
              <div>
                <p class="font-semibold text-sm">Fajar Zaky Ramadhan</p>
                <p class="text-xs text-gray-500">Ketepatan 100% – Kelancaran 100% – Absensi 100%</p>
              </div>
            </div> --}}
            @foreach($kelompokRanking['ziyadah']['laki-laki'] as $data)
              <div class="bg-white text-gray-800 rounded-xl p-4 flex items-center gap-3 mb-3">
                  <img src="{{ $data->jadwalUjian->santri->foto ? '/storage/santri/' . $data->jadwalUjian->santri->foto : 'defaultpp.jpg' }}" class="w-12 h-12 rounded-full" style="object-fit: cover">
                  <div>
                      <p class="font-semibold text-sm">{{ $data->jadwalUjian->santri->nama_lengkap }}</p>
                      <p class="text-xs text-gray-500">
                        Nilai ujian: {{ number_format(floatval($data->nilai_ujian), 0) }}
                      </p>
                  </div>
              </div>
              @endforeach

          </div>

          <!-- Box 4 -->
          <div class="bg-green-700 text-white p-6 rounded-2xl shadow-lg">
            <h3 class="text-center font-semibold mb-5">Juara 123 Santri Putri Ziyadah</h3>

            {{-- <div class="bg-white text-gray-800 rounded-xl p-4 flex items-center gap-3 mb-3">
              <img src="https://placehold.co/60x60" class="w-12 h-12 rounded-full">
              <div>
                <p class="font-semibold text-sm">Fajar Zaky Ramadhan</p>
                <p class="text-xs text-gray-500">Ketepatan 100% – Kelancaran 100% – Absensi 100%</p>
              </div>
            </div> --}}
            @foreach($kelompokRanking['ziyadah']['perempuan'] as $data)
              <div class="bg-white rounded-xl p-4 flex items-center gap-3 mb-3">
                  <img src="{{ $data->jadwalUjian->santri->foto ? '/storage/santri/' . $data->jadwalUjian->santri->foto : 'defaultpp.jpg' }}" class="w-12 h-12 rounded-full" style="object-fit: cover">
                  <div>
                      <p class="font-semibold text-sm">{{ $data->jadwalUjian->santri->nama_lengkap }}</p>
                      <p class="text-xs text-gray-500">
                        Nilai ujian: {{ number_format(floatval($data->nilai_ujian), 0) }}
                      </p>
                  </div>
              </div>
              @endforeach

          </div>

          <!-- Box 1 -->
          <div class="bg-green-700 text-white p-6 rounded-2xl shadow-lg">
            <h3 class="text-center font-semibold mb-5">Juara 123 Santri Putra Muhraja’ah</h3>

            {{-- <div class="bg-white text-gray-800 rounded-xl p-4 flex items-center gap-3 mb-3">
              <img src="https://placehold.co/60x60" class="w-12 h-12 rounded-full">
              <div>
                <p class="font-semibold text-sm">Fajar Zaky Ramadhan</p>
                <p class="text-xs text-gray-500">Ketepatan 100% – Kelancaran 100% – Absensi 100%</p>
              </div>
            </div> --}}
            @foreach($kelompokRanking['murajaah']['laki-laki'] as $data)
              <div class="bg-white rounded-xl p-4 flex items-center gap-3 mb-3">
                  <img src="{{ $data->jadwalUjian->santri->foto ? '/storage/santri/' . $data->jadwalUjian->santri->foto : 'defaultpp.jpg' }}" class="w-12 h-12 rounded-full" style="object-fit: cover">
                  <div>
                      <p class="font-semibold text-sm">{{ $data->jadwalUjian->santri->nama_lengkap }}</p>
                      <p class="text-xs text-gray-500">
                        Nilai ujian: {{ number_format(floatval($data->nilai_ujian), 0) }}
                      </p>
                  </div>
              </div>
            @endforeach

          </div>

          <!-- Box 2 -->
          <div class="bg-green-700 text-white p-6 rounded-2xl shadow-lg">
            <h3 class="text-center font-semibold mb-5">Juara 123 Santri Putri Muhraja’ah</h3>

            {{-- <div class="bg-white text-gray-800 rounded-xl p-4 flex items-center gap-3 mb-3">
              <img src="https://placehold.co/60x60" class="w-12 h-12 rounded-full">
              <div>
                <p class="font-semibold text-sm">Hilqutun Nabilah</p>
                <p class="text-xs text-gray-500">Ketepatan 100% – Kelancaran 100% – Absensi 100%</p>
              </div>
            </div> --}}
            @foreach($kelompokRanking['murajaah']['perempuan'] as $data)
              <div class="bg-white rounded-xl p-4 flex items-center gap-3 mb-3">
                  <img src="{{ $data->jadwalUjian->santri->foto ? '/storage/santri/' . $data->jadwalUjian->santri->foto : 'defaultpp.jpg' }}" class="w-12 h-12 rounded-full" style="object-fit: cover">
                  <div>
                      <p class="font-semibold text-sm">{{ $data->jadwalUjian->santri->nama_lengkap }}</p>
                      <p class="text-xs text-gray-500">
                        Nilai ujian: {{ number_format(floatval($data->nilai_ujian), 0) }}
                      </p>
                  </div>
              </div>
              @endforeach

          </div>
        </div>

      </div>
    </section>

  </div>
</section>

<!-- WISUDAWAN -->
<section class="py-20 max-w-6xl mx-auto px-6 fade-in">
  <h2 class="text-center text-3xl font-bold text-green-700 mb-10">Wisudawan Tahfidz</h2>

  <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
    @foreach ($wisudawan_tahfidz as $w)
      <div>
        <img src="{{ $w->foto ? '/storage/santri/' . $w->foto : 'defaultpp.jpg' }}" style="width: 250px;height:250px;object-fit: cover" class="rounded-xl shadow mx-auto mb-2">
        <p class="font-semibold">{{ $w->nama_lengkap }}</p>
      </div>
    @endforeach
  </div>
</section>

<!-- FOOTER -->
<footer class="bg-gradient-to-br from-green-600 to-green-400 text-white pt-20 pb-10 rounded-t-[70px] mt-20">

  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 mb-16 items-center">

    <!-- LEFT CONTENT -->
    <div>
      <h2 class="text-2xl md:text-3xl font-semibold leading-snug mb-4">
        Mulailah Sekarang untuk Bergabung<br>
        dalam Program Tahfidz di Pondok Pesantren al munawwar jarnauziyyah qiro'atul qur'an.<br>
      </h2>

      <p class="text-green-100 text-sm leading-relaxed mb-6">
        Bergabunglah bersama kami dalam membina generasi Qur'ani yang berilmu dan
        berakhlak. Daftarkan putra/i Anda untuk mengikuti program hafalan Al-Qur’an
        dengan sistem monitoring digital, terintegrasi dengan bimbingan ustadz
        dan ustadzah berpengalaman.
      </p>

      <!-- BUTTONS -->
      <div class="flex flex-wrap gap-4 mt-4">
        <a href="https://wa.me/6281282222222"
           class="bg-white text-green-700 font-semibold px-6 py-3 rounded-xl shadow flex items-center gap-2 hover:bg-green-50">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.119.553 4.183 1.604 6.01L0 24l6.182-1.563A12.05 12.05 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
          </svg>
          +6281282222222
        </a>

        <a href="#" class="border border-white px-6 py-3 rounded-xl hover:bg-white hover:text-green-700">
          Kontak Kami
        </a>
      </div>
    </div>

    <!-- RIGHT MAP -->
    <div class="flex justify-center md:justify-end">
      <div class="bg-white p-2 rounded-2xl shadow-xl w-full max-w-sm overflow-hidden">
        {{-- <img src="https://placehold.co/400x250" class="rounded-xl w-full"> --}}
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.1119440358575!2d108.16126007375807!3d-7.341324272212301!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5694d5162d07%3A0xa7bc076bec77ebbf!2sPondok%20Pesantren%20Al-Munawwar%20Jarnauziyyah!5e0!3m2!1sid!2sid!4v1763172730291!5m2!1sid!2sid" class="w-full" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>

  </div>

  <!-- BOTTOM FOOTER SECTIONS -->
  <div class="border-t border-green-300/40 pt-10">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-10 text-sm">

      <!-- Logo & Social -->
      <div>
        <div class="flex items-center gap-2 mb-3">
          <img src="{{ asset('images/logo.png') }}" class="w-12 rounded-full">
          <div>
            <p class="font-semibold">Pondok Pesantren</p>
            <p class="text-green-100 text-xs">Al munawwar jarnauziyyah qiro'atul qur'an.</p>
          </div>
        </div>

        <p class="text-green-100 text-xs mb-4">
          Yakinkan dengan iman. Usahakan dengan ilmu. Sempurnakan dengan amal.
        </p>

        <div class="flex gap-3 mt-3 text-white">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

      <!-- Profil -->
      <div>
        <h4 class="font-semibold mb-3">Profil</h4>
        <ul class="space-y-2 text-green-100">
          <li><a href="#" class="hover:text-white">Tentang kami</a></li>
          <li><a href="#" class="hover:text-white">Kontak</a></li>
          <li><a href="#" class="hover:text-white">Visi Misi</a></li>
        </ul>
      </div>

      <!-- Pesantren -->
      <div>
        <h4 class="font-semibold mb-3">Pondok Pesantren</h4>
        <ul class="space-y-2 text-green-100">
          <li><a href="#" class="hover:text-white">Hafalan Santri</a></li>
          <li><a href="#" class="hover:text-white">Ujian Santri</a></li>
          <li><a href="#" class="hover:text-white">Notifikasi Setor Hafalan</a></li>
          <li><a href="#" class="hover:text-white">Syarat & Ketentuan</a></li>
        </ul>
      </div>

      <!-- Informasi -->
      <div>
        <h4 class="font-semibold mb-3">Informasi</h4>

        <div class="bg-white text-green-700 rounded-xl p-4 shadow">
          <p class="font-semibold">24 Juni 2025</p>
          <p class="text-sm mt-1">5 Juz per semester untuk hafalan Ziyadah.</p>
        </div>
      </div>

    </div>

    <!-- COPYRIGHT -->
    <p class="text-center text-green-100 text-xs mt-10">
      © 2025 Pondok pesantren al munawwar jarnauziyyah qiro'atul qur'an. All Rights Reserved.
    </p>
  </div>

</footer>


<script>
  const faders = document.querySelectorAll('.fade-in');
  const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.2 });
  faders.forEach(el => observer.observe(el));

  const header = document.getElementById('header');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 60) header.classList.add('scrolled');
    else header.classList.remove('scrolled');
  });
</script>

</body>
</html>
