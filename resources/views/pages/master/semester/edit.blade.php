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
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title">Edit Data Semester</h3>
  </div>

  <form action="{{ route('semester.update', $semester->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Nama Semester <span class="text-danger">*</span></label>
            <input type="text" name="nama_semester" class="form-control" value="{{ old('nama_semester', $semester->nama_semester) }}" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Tahun Ajaran <span class="text-danger">*</span></label>
            <input type="text" name="tahun_ajaran" class="form-control" value="{{ old('tahun_ajaran', $semester->tahun_ajaran) }}" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal Mulai <span class="text-danger">*</span></label>
            <input type="date" name="periode_mulai" class="form-control" value="{{ old('periode_mulai', $semester->periode_mulai) }}" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal Selesai <span class="text-danger">*</span></label>
            <input type="date" name="periode_selesai" class="form-control" value="{{ old('periode_selesai', $semester->periode_selesai) }}" required>
          </div>
        </div>

        {{-- <div class="row"> --}}
          <div class="form-group col-md-12">
            <label>Jenis Hafalan Semester</label>
            <select name="jenis_hafalan" class="form-control" required>
              <option value="">Pilih jenis</option>
              <option value="ziyadah" {{ old('jenis_hafalan', $semester->jenis_hafalan) == 'ziyadah' ? 'selected' : '' }}>Ziyadah</option>
              <option value="murajaah" {{ old('jenis_hafalan', $semester->jenis_hafalan) == 'murajaah' ? 'selected' : '' }}>Murajaah</option>
            </select>
          </div>
        {{-- </div> --}}

        <div class="col-md-12">
          <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
              <option value="">Pilih status</option>
              <option value="aktif" {{ old('status', $semester->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
              <option value="nonaktif" {{ old('status', $semester->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="box-footer text-right">
      <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
      <a href="{{ route('semester.index') }}" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>
</section>
@endsection
