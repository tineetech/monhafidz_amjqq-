@extends('layouts.main')

@section('content')

<section class="content-header">
  <h1>
    Data Jadwal Hafalan
    <small>Edit Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('jadwal-hafalan.index') }}">Data Jadwal Hafalan</a></li>
    <li class="active">Edit</li>
  </ol>
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
</section>

<section class="content">
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Edit Jadwal Hafalan</h3>
  </div>

  <form action="{{ route('jadwal-hafalan-zm.update') }}" method="POST" id="form">
    @method('PUT')
    @csrf
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Jenis Hafalan <span class="text-danger">*</span></label>
            <select name="jenis_hafalan" class="form-control" >
              <option value="">-- Pilih Jenis Hafalan --</option>
              <option value="ziyadah" {{ isset($type) && $type === 'ziyadah' ? 'selected' : '' }}>Ziyadah</option>
              <option value="murajaah" {{ isset($type) && $type === 'murajaah' ? 'selected' : '' }}>Murajaah</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Hari <span class="text-danger">*</span></label>
            <select name="hari" class="form-control" >
              <option value="">-- Pilih Hari --</option>
              <option value="Senin">Senin</option>
              <option value="Selasa">Selasa</option>
              <option value="Rabu">Rabu</option>
              <option value="Kamis">Kamis</option>
              <option value="Sabtu">Sabtu</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Jam Mulai <span class="text-danger">*</span></label>
            <input type="time" name="jam_mulai" class="form-control" >
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Pembimbing Putra</label>
            <select name="pembimbing_putra_id" class="form-control">
              <option value="">-- Pilih Ustadz Putra --</option>
              @foreach($pembimbing_putra as $p)
                <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Pembimbing Putri</label>
            <select name="pembimbing_putri_id" class="form-control">
              <option value="">-- Pilih Ustadzah Putri --</option>
              @foreach($pembimbing_putri as $p)
                <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="box-footer text-right">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('jadwal-hafalan.index') }}" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>
</section>
@endsection
