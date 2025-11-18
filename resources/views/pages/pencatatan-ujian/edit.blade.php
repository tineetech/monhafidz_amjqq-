@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>Pencatatan Ujian <small>Edit Data</small></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('pencatatan-ujian.index') }}">Pencatatan Ujian</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Data Ujian</h3>
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
      <form action="{{ route('pencatatan-ujian.update', $ujian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="form-group col-md-12">
            <label>Pilih jadwal ujian</label>
            <select name="jadwal_ujian_id" class="form-control" required>
              <option value="">Pilih Jadwal Ujian</option>
              @foreach ($jadwalUjian as $jadwal)
                <option value="{{ $jadwal->id }}" {{ $ujian->jadwal_ujian_id == $jadwal->id ? 'selected' : '' }}>
                  {{ ucfirst($jadwal->santri->nama_lengkap) }} | {{ $jadwal->tanggal }} | {{ ucfirst($jadwal->jenis_ujian) }}
                </option>
              @endforeach
            </select> 
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>Pengawas</label>
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
            <label>Nilai Ujian</label>
            <input type="number" name="nilai_ujian" class="form-control"
                   value="{{ round($ujian->nilai_ujian, 2) }}"
                   min="0" max="100" step="0.01">
          </div>
        </div>

        <div class="row">

          <div class="form-group col-md-12">
            <label>Status Ujian</label>
            <select name="status_ujian" class="form-control">
              <option value="belum_diuji" {{ $ujian->status_ujian == 'belum_diuji' ? 'selected' : '' }}>Belum Diuji</option>
              <option value="lulus" {{ $ujian->status_ujian == 'lulus' ? 'selected' : '' }}>Lulus</option>
            </select>
          </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
          <a href="{{ route('pencatatan-ujian.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
