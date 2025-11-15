@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Data Santri
    <small>Edit data santri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('santri.index') }}">Data Santri</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit data santri</h3>
      <div class="box-tools">
        <a href="{{ route('santri.index') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="box-body">
      <form action="{{ route('santri.update', $santri->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="form-group col-md-12">
                {{-- Tampilkan foto lama --}}
                @if ($santri->foto)
                    <div class="mb-3">
                        <div class="" style="display: flex;gap: 10px">
                          <p>Foto saat ini:</p>
                          {{-- Gunakan asset('storage/') untuk mengakses file dari disk 'public' --}}
                          <img src="{{ asset('/storage/santri/' . $santri->foto) }}" alt="Foto Santri" style="max-width: 150px; height: auto; border: 1px solid #ddd; padding: 5px;">
                        </div>
                        <br>
                        <small class="text-muted">Kosongkan input di bawah jika tidak ingin mengganti foto.</small>
                    </div>
                @else
                    <p class="text-danger">Belum ada foto yang diunggah.</p>
                @endif
            <label>Foto Santri</label>
          <input type="file" name="foto" class="form-control" accept=".png, .jpg, .jpeg">
       </div>
     </div>

        <div class="row">
            <div class="form-group col-md-6">
              <label>Nama Lengkap</label>
              <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $santri->nama_lengkap) }}" required>
            </div>

            <div class="form-group col-md-6">
              <label>Jenis Kelamin</label>
              <select name="jenis_kelamin" class="form-control" required>
                <option value="">Pilih jenis kelamin santri</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
              </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
              <label>NIK</label>
              <input type="text" name="nik" class="form-control" value="{{ old('nik', $santri->nik) }}" required>
            </div>

            <div class="form-group col-md-6">
              <label>Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $santri->tanggal_lahir) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
              <label>Alamat Lengkap</label>
              <textarea name="alamat_lengkap" class="form-control" rows="2" required>{{ old('alamat_lengkap', $santri->alamat_lengkap) }}</textarea>
            </div>

            <div class="form-group col-md-6">
              <label>No HP</label>
              <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $santri->no_hp) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
              <label>Semester</label>
              <select name="semester_id" class="form-control" required>
                <option value="">Pilih semester</option>
                @foreach($semesters as $semester)
                  <option value="{{ $semester->id }}" {{ old('semester_id', $santri->semester_id) == $semester->id ? 'selected' : '' }}>
                    {{ $semester->nama_semester }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-6">
              <label>Total Juz Tercapai (Ziyadah)</label>
              <input type="number" name="total_juz_tercapai" class="form-control" value="{{ old('total_juz_tercapai', $santri->total_juz_tercapai) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
              <label>Status Santri</label>
              <select name="status_santri" class="form-control" required>
                <option value="">Pilih status santri</option>
                <option value="aktif" {{ old('status_santri', $santri->status_santri) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak aktif" {{ old('status_santri', $santri->status_santri) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                <option value="tamat hafalan" {{ old('status_santri', $santri->status_santri) == 'Tamat Hafalan' ? 'selected' : '' }}>Tamat Hafalan</option>
                <option value="lulus" {{ old('status_santri', $santri->status_santri) == 'Lulus' ? 'selected' : '' }}>Lulus</option>
              </select>
            </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
          <a href="{{ route('santri.index') }}" class="btn btn-default">Batal</a>
        </div>
      </form>
    </div>
  </div>
</section>

@endsection
