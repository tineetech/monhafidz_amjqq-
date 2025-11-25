@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Data Absensi Santri
    <small>Tambah data santri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('absensi.index') }}">Data Absensi Santri</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title">Tambah Absensi Santri</h3>
           <div class="box-tools">
            <a href="{{ route('santri.index') }}" class="btn btn-primary btn-sm">
              <i class="fa fa-arrow-left"></i> Kembali
            </a>
          </div>
      </div>

      <form action="{{ route('absensi.store') }}" method="POST">
          @csrf
          <div class="box-body">
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Santri <span class="text-danger">*</span></label>
                        <select name="santri_id" id="selectSantri" class="form-control" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach($santri as $s)
                                <option value="{{ $s->id }}" {{ old('santri_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Tanggal <span class="text-danger">*</span></label>
                          <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Status <span class="text-danger">*</span></label>
                          <select name="status" class="form-control" value="Hadir" required>
                              <option value="">-- Pilih Status --</option>
                              <option value="Hadir" {{ old('status') == 'Hadir' ? 'selected' : '' }} selected>Hadir</option>
                              <option value="Izin" {{ old('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                              <option value="Sakit" {{ old('status') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                              <option value="Alpa" {{ old('status') == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                          </select>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Catatan</label>
                          <textarea name="catatan" class="form-control" rows="3" placeholder="Masukkan catatan...">{{ old('catatan') }}</textarea>
                      </div>
                  </div>
              </div>
          </div>

          <div class="box-footer text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
              <a href="{{ route('absensi.index') }}" class="btn btn-default">Batal</a>
          </div>
      </form>
  </div>
</section>

@endsection
