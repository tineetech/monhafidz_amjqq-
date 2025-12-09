@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Data Ustad
    <small>Tambah data ustad</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('ustadzah.index') }}">Data Ustad</a></li>
    <li class="active">Tambah</li>
  </ol>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Data Ustad</h3>
      <div class="box-tools">
        <a href="{{ route('ustadzah.index') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="box-body">
      <form action="{{ route('ustadzah.store') }}" method="POST" id="form">
        @csrf

        <div class="row">
          <div class="form-group col-md-6">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukan nama lengkap ustadzah" >
          </div>

          <div class="form-group col-md-6">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" >
              <option value="">Pilih jenis kelamin</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" placeholder="Masukan NIK ustadzah" >
          </div>

          <div class="form-group col-md-6">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" >
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukan nomor HP ustadzah" >
          </div>

          <div class="form-group col-md-6">
            <label>Status</label>
            <select name="status" class="form-control" >
              <option value="">Pilih status</option>
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-12">
            <label>Alamat Lengkap</label>
            <textarea name="alamat_lengkap" class="form-control" rows="2" placeholder="Masukan alamat lengkap" ></textarea>
          </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Tambah Data</button>
          <a href="{{ route('ustadzah.index') }}" class="btn btn-default">Batal</a>
        </div>
      </form>
    </div>
  </div>
</section>

@endsection
