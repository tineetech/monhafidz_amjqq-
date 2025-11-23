@extends('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Pengaturan Akun
    <small>Ubah informasi akun Anda</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pengaturan Akun</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Pengaturan Akun</h3>
    </div>

    <form action="{{ route('pengaturan.update', Auth::id()) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="box-body">
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
          <div class="col-md-12">
            @if ($user->foto)
              <img src="{{ asset('storage/users/' . $user->foto) }}" 
                  class="img-thumbnail mb-2" width="120">
            @endif
            <div class="form-group">
              <label>Foto Profil</label>
              <input type="file" name="foto" class="form-control">
              <small class="text-muted">Biarkan kosong jika tidak ingin mengganti.</small>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Nama Lengkap <span class="text-danger">*</span></label>
              <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Email <span class="text-danger">*</span></label>
              <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Masukkan email" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Role <span class="text-danger">*</span></label>
              <select name="role" class="form-control" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="santri" {{ $user->role == 'santri' ? 'selected' : '' }}>Santri</option>
                <option value="ustad" {{ $user->role == 'ustad' ? 'selected' : '' }}>Ustad</option>
                <option value="walisantri" {{ $user->role == 'walisantri' ? 'selected' : '' }}>Wali santri</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Password Baru (Opsional)</label>
              <input type="password" name="password" class="form-control" placeholder="Isi jika ingin mengganti password">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Konfirmasi Password Baru</label>
              <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
            </div>
          </div>
        </div>
      </div>

      <div class="box-footer text-right">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</section>
@endsection