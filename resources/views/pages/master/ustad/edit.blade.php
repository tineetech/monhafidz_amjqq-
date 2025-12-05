@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Data Ustad
    <small>Edit data ustad</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('ustadzah.index') }}">Data Ustad</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Data Ustad</h3>
      <div class="box-tools">
        <a href="{{ route('ustadzah.index') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="box-body">
      <form action="{{ route('ustadzah.update', $ustadzah->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="form-group col-md-6">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" value="{{ $ustadzah->nama_lengkap }}" required>
          </div>

          <div class="form-group col-md-6">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
              <option value="Laki-laki" {{ $ustadzah->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ $ustadzah->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ $ustadzah->nik }}" required>
          </div>

          <div class="form-group col-md-6">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $ustadzah->tanggal_lahir }}" required>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $ustadzah->no_hp }}" required>
          </div>

          <div class="form-group col-md-6">
            <label>Status</label>
            <select name="status" class="form-control" required>
              <option value="aktif" {{ $ustadzah->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
              <option value="tidak aktif" {{ $ustadzah->status == 'Tidak Aktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-12">
            <label>Alamat Lengkap</label>
            <textarea name="alamat_lengkap" class="form-control" rows="2" required>{{ $ustadzah->alamat_lengkap }}</textarea>
          </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
          <a href="{{ route('ustadzah.index') }}" class="btn btn-default">Batal</a>
        </div>
      </form>
    </div>
  </div>
</section>

@endsection
