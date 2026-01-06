<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Ditolak</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white">

    <div class="text-center px-6 max-w-lg">
        <!-- Ilustrasi -->
        {{-- <img 
            src="https://illustrations.popsy.co/gray/error.svg" 
            alt="Request Ditolak"
            class="w-64 mx-auto mb-8 opacity-90"
        > --}}

        <!-- Judul -->
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-red-500">
            Request Ditolak
        </h1>

        <!-- Pesan -->
        <p class="text-gray-300 text-lg mb-8">
            {{ $message }}
        </p>

        <!-- Tombol aksi -->
        <a href="{{ url('/ujian-tasmi') }}"
           class="inline-flex items-center justify-center px-6 py-3 rounded-lg bg-red-600 hover:bg-red-700 transition font-semibold shadow-lg">
            Kembali
        </a>
    </div>

</body>
</html>
