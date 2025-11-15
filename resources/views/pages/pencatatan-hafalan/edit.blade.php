@extends('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Data Pencatatan Setoran Hafalan Santri
    <small>Edit Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('pencatatan-hafalan.index') }}">Data Pencatatan Setoran Hafalan</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Pencatatan Setoran Hafalan Santri</h3>
    </div>
    <form action="{{ route('pencatatan-hafalan.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Santri</label>
                        <select name="santri_id" class="form-control" required>
                            @foreach($santri as $s)
                            <option value="{{ $s->id }}" {{ $s->id == $data->santri_id ? 'selected' : '' }}>
                                {{ $s->nama_lengkap }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester_id" class="form-control" required>
                            @foreach($semester as $sem)
                            <option value="{{ $sem->id }}" {{ $sem->id == $data->semester_id ? 'selected' : '' }}>
                                {{ $sem->nama_semester }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" value="{{ $data->tanggal->format('Y-m-d') }}" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Hafalan</label>
                        <select name="jenis_hafalan" class="form-control" required>
                            <option value="Ziyadah" {{ $data->jenis_hafalan == 'Ziyadah' ? 'selected' : '' }}>Ziyadah</option>
                            <option value="Murajaah" {{ $data->jenis_hafalan == 'Murajaah' ? 'selected' : '' }}>Murajaah</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Surah / Ayat</label>
                        <input type="text" name="surah_ayat" class="form-control" value="{{ $data->surah_ayat }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="harus diulang" {{ $data->status == 'harus diulang' ? 'selected' : '' }}>Harus diulang</option>
                            <option value="lulus jayyid" {{ $data->status == 'lulus jayyid' ? 'selected' : '' }}>Lulus Jayyid</option>
                            <option value="lulus mumtaz" {{ $data->status == 'lulus mumtaz' ? 'selected' : '' }}>Lulus mumtaz</option>
                            <option value="Perbaikan" {{ $data->status == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nilai Tajwid</label>
                        <input type="number" name="nilai_tajwid" class="form-control" step="0.1" value="{{ $data->nilai_tajwid }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nilai Kelancaran</label>
                        <input type="number" name="nilai_kelancaran" class="form-control" step="0.1" value="{{ $data->nilai_kelancaran }}" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Juz tercapai (untuk proggress ke 5juz/10juz persemester)</label>
                        <input type="number" name="juz_tercapai" class="form-control" step="0.1" value="{{ $data->juz_tercapai }}" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3">{{ $data->catatan }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-footer text-right">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('pencatatan-hafalan.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
</section>
@endsection
