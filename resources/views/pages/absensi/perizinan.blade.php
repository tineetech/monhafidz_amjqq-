@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Data Absensi Santri
    <small>Pengajuan perizinan santri</small>
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
          <h3 class="box-title">Pengajuan Perizinan Santri</h3>
           <div class="box-tools">
            <a href="{{ route('santri.index') }}" class="btn btn-primary btn-sm">
              <i class="fa fa-arrow-left"></i> Kembali
            </a>
          </div>
      </div>

      <form action="{{ route('perizinan.store') }}" method="POST" id="form" enctype="multipart/form-data">
          @csrf
          <div class="box-body">
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label>Upload Bukti Izin <span class="text-danger">*</span></label>
                        <input type="file" name="foto" class="form-control" >
                    </div>
                </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Santri <span class="text-danger">*</span></label>
                        <select name="santri_id" id="santri_id" class="form-control" >
                            <option value="">-- Pilih Santri --</option>
                            <option value="{{ $santri->id }}" {{ old('santri_id') == $santri->id ? 'selected' : '' }}>
                                {{ $santri->nama_lengkap }}
                            </option>
                        </select>
                    </div>
                </div>


                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Tanggal <span class="text-danger">*</span></label>
                          <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', now()->format('Y-m-d')) }}" >
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Status Absensi<span class="text-danger">*</span></label>
                          <select name="status" class="form-control" value="Hadir" >
                              <option value="">-- Pilih Status --</option>
                              <option value="Izin" {{ old('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                              <option value="Sakit" {{ old('status') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                          </select>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Alasan</label>
                          <textarea name="alasan" class="form-control" rows="3" placeholder="Masukkan alasan...">{{ old('alasan') }}</textarea>
                      </div>
                  </div>
              </div>
          </div>

          <div class="box-footer text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Tambah Data</button>
              <a href="{{ route('absensi.index') }}" class="btn btn-default">Batal</a>
          </div>
      </form>
  </div>
</section>

@endsection
