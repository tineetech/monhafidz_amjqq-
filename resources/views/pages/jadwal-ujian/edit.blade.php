@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>Edit Jadwal Ujian</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('jadwal-ujian.index') }}">Jadwal Ujian</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Jadwal Ujian</h3>
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
      <form action="{{ route('jadwal-ujian.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- === ROW 1 : Is Bertahap + Tahap === --}}
        <div class="row">
          <div class="col-md-6 form-group">
            <label>Apakah Jadwal Bertahap</label>
            <select name="is_bertahap" class="form-control" required>
              <option value="0" {{ $jadwal->is_bertahap == 0 ? 'selected' : '' }}>Tidak</option>
              <option value="1" {{ $jadwal->is_bertahap == 1 ? 'selected' : '' }}>Ya</option>
            </select>
          </div>

          <div class="col-md-6 form-group">
            <label>Tahap</label>
            <input type="number"
                   name="tahap"
                   class="form-control"
                   placeholder="Masukan tahap keberapa (kosongkan jika tidak bertahap)"
                   value="{{ $jadwal->tahap }}">
          </div>
        </div>

        {{-- === ROW 2 : Tanggal === --}}
        <div class="row">
          <div class="col-md-12 form-group">
            <label>Tanggal Ujian</label>
            <input type="date" name="tanggal" value="{{ $jadwal->tanggal }}" class="form-control" required>
          </div>
        </div>

        {{-- === ROW 3 : Jam Mulai + Jam Selesai === --}}
        <div class="row">
          <div class="col-md-6 form-group">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}" required>
          </div>

          <div class="col-md-6 form-group">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}">
          </div>
        </div>

        {{-- === ROW 4 : Pembimbing === --}}
        <div class="row">
          <div class="col-md-6 form-group">
            <label>Pembimbing Putra</label>
            <select name="pembimbing_putra_id" class="form-control">
              <option value="">-- Tidak Ada --</option>
              @foreach ($ustadzah as $u)
                <option value="{{ $u->id }}" {{ $jadwal->pembimbing_putra_id == $u->id ? 'selected' : '' }}>
                  {{ $u->nama_lengkap }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6 form-group">
            <label>Pembimbing Putri</label>
            <select name="pembimbing_putri_id" class="form-control">
              <option value="">-- Tidak Ada --</option>
              @foreach ($ustadzah as $u)
                <option value="{{ $u->id }}" {{ $jadwal->pembimbing_putri_id == $u->id ? 'selected' : '' }}>
                  {{ $u->nama_lengkap }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- === ROW 5 : Jenis Ujian === --}}
        <div class="row">
          <div class="col-md-12 form-group">
            <label>Jenis Ujian</label>
            <select name="jenis_ujian" class="form-control" required>
              <option value="tasmi"        {{ $jadwal->jenis_ujian == 'tasmi' ? 'selected' : '' }}>Tasmi'</option>
              <option value="ujian_akhir"  {{ $jadwal->jenis_ujian == 'ujian_akhir' ? 'selected' : '' }}>Ujian Akhir</option>
              <option value="ziyadah"      {{ $jadwal->jenis_ujian == 'ziyadah' ? 'selected' : '' }}>Ziyadah</option>
              <option value="murajaah"     {{ $jadwal->jenis_ujian == 'murajaah' ? 'selected' : '' }}>Murajaah</option>
            </select>
          </div>
        </div>

        {{-- === ROW 6 : Tempat Ujian === --}}
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Tempat Ujian</label>
              <textarea name="tempat" class="form-control" rows="3" placeholder="Tambahkan tempat jika ada">{{ $jadwal->tempat }}</textarea>
            </div>
          </div>
        </div>

        <div class="text-right">
          <button class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
          <a href="{{ route('jadwal-ujian.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
