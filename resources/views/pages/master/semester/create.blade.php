@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Data Semester
    <small>Tambah data semester</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('semester.index') }}">Data Semester</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah data semester</h3>
      <div class="box-tools">
        <a href="{{ route('semester.index') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="box-body">
      <form action="{{ route('semester.store') }}" method="POST">
        @csrf

        <div class="row">
          <div class="form-group col-md-6">
            <label>Nama Semester</label>
            <input type="text" name="nama_semester" class="form-control" placeholder="Masukan nama semester" required>
          </div>

          <div class="form-group col-md-6">
            <label>Tahun Ajaran</label>
            <input type="text" name="tahun_ajaran" class="form-control" placeholder="Masukan tahun ajaran (contoh: 2025/2026)" required>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>Periode Mulai</label>
            <input type="date" name="periode_mulai" class="form-control" required>
          </div>

          <div class="form-group col-md-6">
            <label>Periode Selesai</label>
            <input type="date" name="periode_selesai" class="form-control" required>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-12">
            <label>Jenis Hafalan Semester</label>
            <select name="jenis_hafalan" class="form-control" required>
              <option value="">Pilih jenis</option>
              <option value="ziyadah">Ziyadah</option>
              <option value="murajaah">Murajaah</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-12">
            <label>Status</label>
            <select name="status" class="form-control" required>
              <option value="">Pilih status</option>
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Nonaktif</option>
              <option value="selesai">Selesai</option>
            </select>
          </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Tambah Data
          </button>
          <a href="{{ route('semester.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</section>

@endsection
