@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>Ujian Tasmi <small>Tambah Data</small></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('ujian-tasmi.index') }}">Ujian Tasmi</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Data Ujian Tasmi</h3>
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
      <form action="{{ route('ujian-tasmi.store') }}" method="POST">
        @csrf

        <div class="row">
          <div class="form-group col-md-12">
            <label>Pilih Jadwal Ujian</label>
            <select name="jadwal_ujian_id" class="form-control" required>
              <option value="">Pilih Jadwal Ujian</option>
              @foreach ($jadwalUjian as $j)
                <option value="{{ $j->id }}">
                  {{ $j->santri->nama_lengkap }} | {{ $j->tanggal }} | {{ ucfirst($j->jenis_ujian) }}
                </option>
              @endforeach
            </select> 
          </div>
        </div>

        <div class="row">

          <div class="form-group col-md-6">
            <label>Ustadzah</label>
            <select name="ustadzah_id" class="form-control">
              <option value="">Tidak Ada</option>
              @foreach ($ustadzah as $u)
                <option value="{{ $u->id }}">{{ $u->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-md-6">
            <label>Tanggal Tasmi</label>
            <input type="date" name="tanggal_tasmi" class="form-control">
          </div>
        </div>

        <div class="row">

          <div class="form-group col-md-6">
            <label>Juz yang Ditasmi</label>
            <input type="text" name="juz_yang_ditasmi" class="form-control" placeholder="Contoh: 1-5">
          </div>

          <div class="form-group col-md-6">
            <label>Status Ujian</label>
            <select name="status_ujian" class="form-control">
              <option value="belum_diuji">Belum Diuji</option>
              <option value="lancar">Lancar</option>
              <option value="remidi">Remidi</option>
            </select>
          </div>
          <div class="col-md-12">
              <div class="form-group">
                  <label>Catatan</label>
                  <textarea name="catatan" class="form-control" rows="3" placeholder="Masukkan catatan...">{{ old('catatan') }}</textarea>
              </div>
          </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
          <a href="{{ route('ujian-tasmi.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
