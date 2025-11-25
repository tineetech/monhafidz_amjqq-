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
      <h3 class="box-title">Edit Jadwal</h3>
      <div class="box-tools">
        <a href="{{ route('jadwal-ujian.index') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>
    @if ($errors->any())
      <div class="alert alert-danger">
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

        <div class="row">
          <div class="col-md-6 form-group">
            <label>Santri</label>
            <select name="santri_id" id="selectSantri" class="form-control" required>
              @foreach($santri as $s)
                <option value="{{ $s->id }}" {{ $jadwal->santri_id == $s->id ? 'selected' : '' }}>
                  {{ $s->nama_lengkap }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6 form-group">
            <label>Tanggal Ujian</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $jadwal->tanggal }}" required>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 form-group">
            <label>Pilih semester</label>
            <select name="semester_id" class="form-control" required>
              @foreach ($semesters as $semester)
                <option value="{{ $semester->id }}" {{ $jadwal->semester_id == $semester->id ? 'selected' : '' }}> 
                  {{ ucfirst($semester->nama_semester) }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 form-group">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}" required>
          </div>

          <div class="col-md-6 form-group">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}" required>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 form-group">
            <label>Pembimbing Putra</label>
            <select name="pembimbing_putra_id" class="form-control">
              <option value="">-- Tidak Ada --</option>
              @foreach($ustadzah as $u)
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
              @foreach($ustadzah as $u)
                <option value="{{ $u->id }}" {{ $jadwal->pembimbing_putri_id == $u->id ? 'selected' : '' }}>
                  {{ $u->nama_lengkap }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label>Jenis Ujian</label>
          <select name="jenis_ujian" class="form-control" required>
            <option value="tasmi" {{ $jadwal->jenis_ujian == 'tasmi' ? 'selected' : '' }}>Tasmi'</option>
            <option value="ujian_akhir" {{ $jadwal->jenis_ujian == 'ujian_akhir' ? 'selected' : '' }}>Ujian Akhir</option>
            <option value="ziyadah" {{ $jadwal->jenis_ujian == 'ziyadah' ? 'selected' : '' }}>Ziyadah</option>
            <option value="murajaah" {{ $jadwal->jenis_ujian == 'murajaah' ? 'selected' : '' }}>Murajaah</option>
          </select>
        </div>

        <div class="text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
          <a href="{{ route('jadwal-ujian.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
