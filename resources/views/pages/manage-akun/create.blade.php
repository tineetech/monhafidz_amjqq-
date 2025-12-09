@extends('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Manajemen Akun
    <small>Tambah Akun Baru</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('manage-akun.index') }}">Manajemen Akun</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Akun Baru</h3>
    </div>

    <form action="{{ route('manage-akun.store') }}" method="POST" id="form">
      @csrf
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama Lengkap <span class="text-danger">*</span></label>
              <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" >
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Username <span class="text-danger">*</span></label>
              <input type="text" name="username" class="form-control" placeholder="Masukkan username" >
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Email <span class="text-danger">*</span></label>
              <input type="email" name="email" class="form-control" placeholder="Masukkan email" >
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Role <span class="text-danger">*</span></label>
              <select name="role" class="form-control" >
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="ustad">Ustad</option>
                <option value="santri">Santri</option>
                <option value="walisantri">Wali Santri</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Status <span class="text-danger">*</span></label>
              <select name="status" class="form-control" >
                <option value="">-- Pilih Status --</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Password <span class="text-danger">*</span></label>
              <input type="password" name="password" class="form-control" placeholder="Masukkan password" >
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Konfirmasi Password <span class="text-danger">*</span></label>
              <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" >
            </div>
          </div>
        </div>
      </div>

      <div class="box-footer text-right">
        <a href="{{ route('manage-akun.index') }}" class="btn btn-default">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</section>
@endsection