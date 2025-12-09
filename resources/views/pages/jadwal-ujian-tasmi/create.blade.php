@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>Tambah Jadwal Ujian Tasmi</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('jadwal-ujian-tasmi.index') }}">Jadwal Ujian Tasmi</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Jadwal Ujian Tasmi</h3>
      <div class="box-tools">
        <a href="{{ route('jadwal-ujian.index') }}" class="btn btn-primary btn-sm">
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
      <form action="{{ route('jadwal-ujian-tasmi.store') }}" method="POST" id="form">
        @csrf

        <div class="row">
          {{-- <div class="col-md-6 form-group">
            <label>Santri</label>
            <select name="santri_id" id="selectSantri" class="form-control" >
              <option value="">-- Pilih Santri --</option>
              @foreach($santris as $s)
                <option value="{{ $s->id }}">{{ $s->nama_lengkap }}</option>
              @endforeach
            </select>
          </div> --}}

          {{-- <div class="col-md-6 form-group">
            <label>Tanggal Ujian</label>
            <input type="date" name="tanggal" class="form-control" value="{{ now()->format('Y-m-d') }}" >
          </div> --}}
          <div class="col-md-12">
              <div class="form-group">
                  <label>Santri</label>
                  <select name="santri_id" class="form-control select2" id="selectSantri" >
                      <option value="">-- Pilih Santri --</option>
                      @foreach($santris as $s)
                          <option value="{{ $s->id }}" data-semester="{{ $s->semester_id }}">
                              {{ $s->nama_lengkap }}
                          </option>
                      @endforeach
                  </select>
              </div>
          </div>
          <div class="col-md-6 form-group">
            <label>Apakah Jadwal Bertahap</label>
            <select name="is_bertahap" class="form-control" value='tidak' >
              {{-- <option value="">-- Tidak Ada --</option> --}}
              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            </select>
          </div>
          <div class="col-md-6 form-group">
            <label>Tahap</label>
            <input type="number" name="tahap" placeholder="Masukan tahap keberapa (kosongkan jika tidak bertahap)" class="form-control without">
          </div>
        </div>

        <div class="row">
          
          <div class="col-md-12 form-group">
            <label>Tanggal Ujian</label>
            <input type="date" name="tanggal" class="form-control" value="{{ now()->format('Y-m-d') }}" >
          </div>
          {{-- <div class="col-md-6 form-group">
            <label>Pilih semester</label>
            <select name="semester_id" class="form-control" >
              @foreach ($semesters as $semester)
                <option value="{{ $semester->id }}">{{ ucfirst($semester->nama_semester) }}</option>
              @endforeach
            </select>
          </div> --}}
        </div>

        {{-- <div class="row">
          <div class="col-md-6 form-group">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" >
          </div>

          <div class="col-md-6 form-group">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control">
          </div>
        </div> --}}

        <div class="row">
          <div class="col-md-6 form-group">
            <label>Pembimbing Putra</label>
            <select name="pembimbing_putra_id" class="form-control">
              <option value="">-- Tidak Ada --</option>
              @foreach ($ustadzah as $u)
                <option value="{{ $u->id }}">{{ $u->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6 form-group">
            <label>Pembimbing Putri</label>
            <select name="pembimbing_putri_id" class="form-control">
              <option value="">-- Tidak Ada --</option>
              @foreach ($ustadzah as $u)
                <option value="{{ $u->id }}">{{ $u->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row">
          {{-- <div class="col-md-12 form-group">
            <label>Jenis Ujian</label>
            <select name="jenis_ujian" class="form-control" >
              <option value="tasmi" selected>Tasmi'</option>
              <option value="ujian_akhir">Ujian Akhir</option>
              <option value="ziyadah">Ziyadah</option>
              <option value="murajaah">Murajaah</option>
            </select>
          </div> --}}

          
          <div class="col-md-12">
              <div class="form-group">
                  <label>Tempat Ujian</label>
                  <textarea name="tempat" class="form-control" rows="3" placeholder="Tambahkan tempat jika ada"></textarea>
              </div>
          </div>
        </div>


        <div class="text-right">
          <button class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
          <a href="{{ route('jadwal-ujian.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
