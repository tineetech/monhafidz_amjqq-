@extends('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Tambah Pencatatan Setoran Hafalan Santri
    <small>Form input setoran hafalan santri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('pencatatan-hafalan.index') }}">Pencatatan Setoran Hafalan</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah Pencatatan Setoran Hafalan Santri</h3>
    </div>
    <form action="{{ route('pencatatan-hafalan.store') }}" method="POST">
        @csrf
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Santri</label>
                        <select name="santri_id" class="form-control" id="selectSantri" required>
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
                        <label>Semester</label>
                        <select name="semester_id" class="form-control" required>
                            <option value="">-- Pilih Semester --</option>
                            @foreach($semester as $sem)
                            <option value="{{ $sem->id }}">{{ $sem->nama_semester }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Hafalan</label>
                        <select name="jenis_hafalan" class="form-control" required>
                            <option value="">-- Pilih Jenis Hafalan --</option>
                            <option value="Ziyadah">Ziyadah</option>
                            <option value="Murajaah">Murajaah</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Surah / Ayat</label>
                        <input type="text" name="surah_ayat" class="form-control" placeholder="Contoh: Al-Baqarah 1-5" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status (otomatis)</label>
                        <select name="status" class="form-control" required disabled>
                            <option value="lulus jayyid">Lulus Jayyid</option>
                            <option value="lulus mumtaz">Lulus Mumtaz</option>
                            <option value="harus diulang">Harus di ulang</option>
                            <option value="Belum Diperiksa">Belum Diperiksa</option>
                            <option value="Perbaikan">Perbaikan</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nilai Tajwid</label>
                        <input type="number" name="nilai_tajwid" class="form-control" step="0.1" min="0" max="100" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nilai Kelancaran</label>
                        <input type="number" name="nilai_kelancaran" class="form-control" step="0.1" min="0" max="100" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Juz tercapai (untuk proggress ke 5juz/10juz persemester)</label>
                        <input type="number" name="juz_tercapai" class="form-control" step="0.1" min="0" max="100" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan jika ada"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-footer text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pencatatan-hafalan.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
</section>
@endsection
@section('scripts')
<script>
    document.getElementById('selectSantri').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var semesterId = selectedOption.getAttribute('data-semester');

        if (semesterId) {
            document.querySelector('select[name="semester_id"]').value = semesterId;
        }
    });
</script>

@endsection