@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>Pencatatan Ujian <small>Tambah Data</small></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('pencatatan-ujian.index') }}">Pencatatan Ujian</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Data Ujian</h3>
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
      <form action="{{ route('pencatatan-ujian.store') }}" method="POST">
        @csrf

        <div class="row">
          {{-- <div class="form-group col-md-12">
            <label>Pilih jadwal ujian</label>
            <select name="jadwal_ujian_id" class="form-control" required>
              <option value="" hidden>Pilih Jadwal Ujian</option>
              @foreach ($jadwalUjian as $jadwal)
                <option value="{{ $jadwal->id }}">
                  {{ ucfirst($jadwal->santri->nama_lengkap) }} | {{ $jadwal->semester->nama_semester }} | {{ $jadwal->tanggal }} | {{ ucfirst($jadwal->jenis_ujian) }}
                </option>
              @endforeach
            </select> 
          </div> --}}
          <div class="form-group col-md-12">
            <label>Tanggal Ujian</label>
            <input type="date" name="tanggal" placeholder="Masukan tanggal" class="form-control">
          </div>
        </div>

        <div class="row">
          {{-- <div class="form-group col-md-12">
            <label>Pengawas</label>
            <select name="ustadzah_id" class="form-control">
              <option value="">Tidak Ada</option>
              @foreach ($ustadzah as $u)
                <option value="{{ $u->id }}">{{ $u->nama_lengkap }}</option>
              @endforeach
            </select>
          </div> --}}
          <div class="col-md-12">
              <div class="form-group">
                  <label>Santri</label>
                  <select name="santri_id" class="form-control select2" id="selectSantri" required>
                      <option value="">-- Pilih Santri --</option>
                      @foreach($santri as $s)
                          <option value="{{ $s->id }}" data-semester="{{ $s->semester_id }}">
                              {{ $s->nama_lengkap }}
                          </option>
                      @endforeach
                  </select>
              </div>
          </div>
          
          <div class="col-md-6">
              <div class="form-group">
                  <label>Jenis Ujian</label>
                  <select name="jenis_ujian" class="form-control" required>
                    {{-- <option value="tasmi" selected>Tasmi'</option> --}}
                    <option value="ujian_akhir">Ujian Akhir</option>
                    <option value="ziyadah">Ziyadah</option>
                    <option value="murajaah">Murajaah</option>
                  </select>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label>Semester</label>
                  <select name="semester_id" class="form-control" required>
                      <option value="">-- Pilih Semester --</option>
                      @foreach($semester as $sem)
                      <option value="{{ $sem->id }}">{{ $sem->nama_semester }}</option>
                      @endforeach
                  </select>
              </div>
          </div>
          <div class="form-group col-md-6">
            <label>Nilai Tajwid</label>
            <input type="number" name="nilai_tajwid" placeholder="Masukan nilai tajwid" class="form-control" min="0" max="100" step="0.01">
          </div>
          <div class="form-group col-md-6">
            <label>Nilai Kelancaran</label>
            <input type="number" name="nilai_kelancaran" placeholder="Masukan nilai kelancaran" class="form-control" min="0" max="100" step="0.01">
          </div>
          <div class="form-group col-md-12">
            <label>Kesalahan</label>
            <input type="number" name="kesalahan" placeholder="Masukan kesalahan" class="form-control" min="0" max="100" step="0.01">
          </div>

        </div>

        {{-- <div class="row">

          <div class="form-group col-md-12">
            <label>Status Ujian</label>
            <select name="status_ujian" class="form-control">
              <option value="lulus">Lulus</option>
              <option value="belum_diuji">Belum Diuji</option>
            </select>
          </div>
        </div> --}}

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
          <a href="{{ route('pencatatan-ujian.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
