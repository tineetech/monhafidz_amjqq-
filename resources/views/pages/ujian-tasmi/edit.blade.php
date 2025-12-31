@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>Ujian Tasmi <small>Edit Data</small></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('ujian-tasmi.index') }}">Ujian Tasmi</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Data Ujian Tasmi</h3>
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
      <form action="{{ route('ujian-tasmi.update', $ujian->id) }}" method="POST" id="form"> 
        @csrf
        @method('PUT')

        <div class="row">

          {{-- <div class="form-group col-md-6">
            <label>Tanggal Ujian</label>
            <input type="date" name="tanggal" class="form-control"
                   value="{{ $ujian->tanggal }}">
          </div> --}}

          <div class="form-group col-md-12">
            <label>Santri</label>
            <select name="santri_id" class="form-control select2" id="selectSantri">
              <option value="">-- Pilih Santri --</option>
              @foreach($santri as $s)
                <option value="{{ $s->id }}"
                  {{ $ujian->santri_id == $s->id ? 'selected' : '' }}>
                  {{ $s->nama_lengkap }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- <div class="col-md-12">
            <div class="form-group">
              <label>Semester</label>
              <select name="semester_id" class="form-control" id="selectSantri">
                <option value="">-- Pilih Semester --</option>
                @foreach($semester as $sem)
                <option value="{{ $sem->id }}"
                  {{ $ujian->semester_id == $sem->id ? 'selected' : '' }}>
                  {{ $sem->nama_semester }}
                </option>
                @endforeach
              </select>
            </div>
          </div> --}}

        </div>

        <div class="row">

          <div class="form-group col-md-6">
            <label>Pembimbing</label>
            <select name="ustadzah_id" class="form-control">
              <option value="">Tidak Ada</option>
              @foreach ($ustadzah as $u)
                <option value="{{ $u->id }}"
                  {{ $ujian->ustadzah_id == $u->id ? 'selected' : '' }}>
                  {{ $u->nama_lengkap }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-md-6">
            <label>Tanggal Tasmi</label>
            <input type="date" name="tanggal_tasmi" class="form-control"
                   value="{{ $ujian->tanggal_tasmi }}">
          </div>

        </div>

        <div class="row">

          <div class="form-group col-md-6">
            <label>Juz yang Ditasmi</label>
            <input type="text" name="juz_yang_ditasmi" class="form-control"
                   value="{{ $ujian->juz_yang_ditasmi }}" placeholder="Contoh: 1-5">
          </div>

          <div class="form-group col-md-6">
            <label>Status Ujian</label>
            <select name="status_ujian" class="form-control">
              <option value="selesai" {{ $ujian->status_ujian == 'selesai' ? 'selected' : '' }}>Selesai</option>
              <option value="belum_diuji" {{ $ujian->status_ujian == 'belum_diuji' ? 'selected' : '' }}>Belum Diuji</option>
            </select>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Catatan</label>
              <textarea name="catatan" class="form-control" rows="3"
                placeholder="Masukkan catatan...">{{ $ujian->catatan }}</textarea>
            </div>
          </div>

        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Simpan Perubahan
          </button>
          <a href="{{ route('ujian-tasmi.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
