@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>Ujian Tasmi <small>Edit Data</small></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('ujian-tasmi.index') }}">Ujian Tasmi</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Data Ujian Tasmi</h3>
    </div>
    <div class="box-body">
      <form action="{{ route('ujian-tasmi.update', $ujian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="form-group col-md-12">
            <label>Pilih Jadwal Ujian</label>
            <select name="jadwal_ujian_id" class="form-control" required>
              <option value="">Pilih Jadwal Ujian</option>
              @foreach ($jadwalUjian as $j)
                <option value="{{ $j->id }}" {{ $ujian->jadwal_ujian_id == $j->id ? 'selected' : '' }}>
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
                <option value="{{ $u->id }}" {{ $ujian->ustadzah_id == $u->id ? 'selected' : '' }}>
                  {{ $u->nama_lengkap }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-md-6">
            <label>Tanggal Tasmi</label>
            <input type="date" name="tanggal_tasmi" class="form-control" value="{{ $ujian->tanggal_tasmi }}">
          </div>
        </div>

        <div class="row">

          <div class="form-group col-md-6">
            <label>Juz yang Ditasmi</label>
            <input type="text" name="juz_yang_ditasmi" value="{{ $ujian->juz_yang_ditasmi }}" class="form-control">
          </div>

          <div class="form-group col-md-6">
            <label>Status Ujian</label>
            <select name="status_ujian" class="form-control">
              <option value="selesai" {{ $ujian->status_ujian == 'selesai' ? 'selected' : '' }}>Selesai</option>
              <option value="lancar" {{ $ujian->status_ujian == 'lancar' ? 'selected' : '' }}>Lancar</option>
              <option value="belum_diuji" {{ $ujian->status_ujian == 'belum_diuji' ? 'selected' : '' }}>Belum Diuji</option>
              <option value="remidi" {{ $ujian->status_ujian == 'remidi' ? 'selected' : '' }}>Remidi</option>
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
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
          <a href="{{ route('ujian-tasmi.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
