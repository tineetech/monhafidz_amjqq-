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
            <label>Tanggal Ujian</label>
            <input type="date" name="tanggal" class="form-control"
                   value="{{ $ujian->tanggal }}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                  <label>Santri</label>
                  <select name="santri_id" class="form-control select2" id="selectSantri" required>
                      <option value="">-- Pilih Santri --</option>
                      @foreach($santri as $s)
                          <option value="{{ $s->id }}"
                                  {{ $ujian->santri_id == $s->id ? 'selected' : '' }}
                                  data-semester="{{ $s->semester_id }}">
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
                      <option value="ujian_akhir" {{ $ujian->jenis_ujian == 'ujian_akhir' ? 'selected' : '' }}>Ujian Akhir</option>
                      <option value="ziyadah" {{ $ujian->jenis_ujian == 'ziyadah' ? 'selected' : '' }}>Ziyadah</option>
                      <option value="murajaah" {{ $ujian->jenis_ujian == 'murajaah' ? 'selected' : '' }}>Murajaah</option>
                  </select>
              </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
                  <label>Semester</label>
                  <select name="semester_id" class="form-control" required>
                      <option value="">-- Pilih Semester --</option>
                      @foreach($semester as $sem)
                          <option value="{{ $sem->id }}"
                                  {{ $ujian->semester_id == $sem->id ? 'selected' : '' }}>
                              {{ $sem->nama_semester }}
                          </option>
                      @endforeach
                  </select>
              </div>
          </div>

          <div class="form-group col-md-6">
            <label>Nilai Tajwid</label>
            <input type="number" name="nilai_tajwid" class="form-control"
                   value="{{ $ujian->nilai_tajwid }}"
                   min="0" max="100" step="0.01">
          </div>

          <div class="form-group col-md-6">
            <label>Nilai Kelancaran</label>
            <input type="number" name="nilai_kelancaran" class="form-control"
                   value="{{ $ujian->nilai_kelancaran }}"
                   min="0" max="100" step="0.01">
          </div>

          <div class="form-group col-md-12">
            <label>Kesalahan</label>
            <input type="number" name="kesalahan" class="form-control"
                   value="{{ $ujian->kesalahan }}"
                   min="0" max="100" step="0.01">
          </div>

        </div>

        <div class="row">
          <div class="form-group col-md-12">
            <label>Status Ujian</label>
            <select name="status_ujian" class="form-control">
              <option value="lulus" {{ $ujian->status_ujian == 'lulus' ? 'selected' : '' }}>Lulus</option>
            </select>
          </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Simpan Perubahan
          </button>
          <a href="{{ route('pencatatan-ujian.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
