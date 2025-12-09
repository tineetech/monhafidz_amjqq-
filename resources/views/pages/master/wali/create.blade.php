@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Data Wali Santri
    <small>Tambah Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('wali.index') }}">Data Wali Santri</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Data Wali Santri</h3>
      <div class="box-tools">
        <a href="{{ route('wali.index') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="box-body">
      <form action="{{ route('wali.store') }}" method="POST" id="form">
        @csrf

        <div class="row">
          <div class="form-group col-md-6">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap wali" >
          </div>
          <div class="form-group col-md-6">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" >
              <option value="">Pilih Jenis Kelamin</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK" >
          </div>
          <div class="form-group col-md-6">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" >
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>Wali Sebagai</label>
            <select name="wali_sebagai" class="form-control" >
              <option value="">Pilih Peran</option>
              <option value="ayah">Ayah</option>
              <option value="ibu">Ibu</option>
              <option value="wali">Wali</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label>Santri</label>
            <select name="santri_id" class="form-control" >
              <option value="">Pilih Santri</option>
              @foreach($santri as $s)
                <option value="{{ $s->id }}">{{ $s->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>Alamat Lengkap</label>
            <textarea name="alamat_lengkap" class="form-control" placeholder="Masukkan alamat lengkap" rows="2" ></textarea>
          </div>
          <div class="form-group col-md-6">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukkan nomor HP" >
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-12">
            <label>Status Wali</label>
            <select name="status_wali" class="form-control" >
              <option value="">Pilih Status</option>
              <option value="aktif">Aktif</option>
              <option value="tidak aktif">Tidak Aktif</option>
            </select>
          </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Data</button>
          <a href="{{ route('wali.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
