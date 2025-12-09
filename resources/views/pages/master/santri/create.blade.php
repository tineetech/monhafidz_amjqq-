@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Data Santri
    <small>Tambah data santri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('santri.index') }}">Data Santri</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah data santri</h3>
      <div class="box-tools">
        <a href="{{ route('santri.index') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>
    @if ($errors->any())
      <div class="alert alert-danger m-3">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="box-body">
      <form action="{{ route('santri.store') }}" method="POST" enctype="multipart/form-data" id="form">
        @csrf
        

        <div class="row">
              <div class="form-group col-md-12">
                  <label>Foto Santri</label>
                  <input type="file" name="foto" class="form-control" id="" accept=".png, .jpg, .jpeg">
              </div>
        </div>

        <div class="row">
          

            <!-- Input 1 -->
            <div class="form-group col-md-6">
              <label>Nama Lengkap</label>
              <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukan nama lengkap santri" >
            </div>
    
            <!-- Input 2 -->
            <div class="form-group col-md-6">
              <label>Jenis Kelamin</label>
              <select name="jenis_kelamin" class="form-control" >
                <option value="">Pilih jenis kelamin santri</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
        </div>

        <div class="row">
            <!-- Input 3 -->
            <div class="form-group col-md-6">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" placeholder="Masukan NIK santri" >
            </div>

            <!-- Input 4 -->
            <div class="form-group col-md-6">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" >
            </div>
        </div>

        <div class="row">
            <!-- Input 5 -->
            <div class="form-group col-md-6">
                <label>Alamat Lengkap</label>
                <textarea name="alamat_lengkap" class="form-control" placeholder="Masukan alamat santri" rows="2" ></textarea>
            </div>

            <!-- Input 6 -->
            <div class="form-group col-md-6">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="Masukan nomor HP santri" >
            </div>
        </div>

        <div class="row">
            <!-- Input 7 -->
            <div class="form-group col-md-6">
                <label>Semester</label>
                <select name="semester_id" class="form-control" >
                    <option value="">Pilih semester</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->nama_semester }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Input 8 -->
            <div class="form-group col-md-6">
                <label>Total Juz Tercapai (Ziyadah)</label>
                <input type="number" name="total_juz_tercapai" value="0" class="form-control" placeholder="Masukan jumlah juz yang dicapai oleh santri" >
            </div>
        </div>

        <div class="row">
            <!-- Input 9 (Full Width) -->
            <div class="form-group col-md-12">
                <label>Status Santri</label>
                <select name="status_santri" class="form-control" >
                    <option value="">Pilih status santri</option>
                    <option value="aktif">Aktif</option>
                    <option value="tidak aktif">Tidak Aktif</option>
                    <option value="tamat hafalan">Tamat Hafalan</option>
                    <option value="lulus">Lulus</option>
                </select>
            </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Tambah Data</button>
          <a href="{{ route('santri.index') }}" class="btn btn-default">Batal</a>
        </div>
      </form>
    </div>
  </div>
</section>

@endsection
