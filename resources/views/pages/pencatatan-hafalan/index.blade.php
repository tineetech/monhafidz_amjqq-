@extends('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Data Pencatatan Hafalan
    <small>Daftar semua catatan hafalan santri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pencatatan Hafalan</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Pencatatan Hafalan Ziyadah</h3>
      @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
      <a href="{{ route('pencatatan-hafalan.create') }}" class="btn btn-primary btn-sm pull-right">
        <i class="fa fa-plus"></i> Tambah Data
      </a>
      @endif
    </div>

    <div class="box-body table-responsive">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Santri</th>
            <th>Semester</th>
            <th>Juz tercapai</th>
            <th>Tanggal</th>
            <th>Jenis Hafalan</th>
            <th>Surah/Ayat</th>
            <th>Nilai Tajwid</th>
            <th>Nilai Kelancaran</th>
            <th>Status</th>
            @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
            <th width="120px">Aksi</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @forelse($ziyadah as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->santri->nama_lengkap ?? '-' }}</td>
              <td>{{ $item->semester->nama_semester ?? '-' }}</td>
              <td>{{ $item->juz_tercapai ?? '0' }}</td>
              <td>{{ $item->tanggal->format('d-m-Y') }}</td>
              <td>{{ ucfirst($item->jenis_hafalan) }}</td>
              <td>{{ $item->surah_ayat }}</td>
              <td>{{ $item->nilai_tajwid }}</td>
              <td>{{ $item->nilai_kelancaran }}</td>
              <td>{{ ucfirst($item->status) }}</td>
              @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
              <td>
                <a href="{{ route('pencatatan-hafalan.edit', $item->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                <form action="{{ route('pencatatan-hafalan.destroy', $item->id) }}" method="POST" style="display:inline-block">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-xs" onclick="return confirm('Yakin hapus data ini?')"><i class="fa fa-trash"></i></button>
                </form>
              </td>
              @endif
            </tr>
          @empty
            <tr>
              <td colspan="10" class="text-center">Belum ada data</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Pencatatan Hafalan Murajaah</h3>
      @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
      <a href="{{ route('pencatatan-hafalan.create') }}" class="btn btn-primary btn-sm pull-right">
        <i class="fa fa-plus"></i> Tambah Data
      </a>
      @endif
    </div>

    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Santri</th>
            <th>Semester</th>
            <th>Juz tercapai</th>
            <th>Tanggal</th>
            <th>Jenis Hafalan</th>
            <th>Surah/Ayat</th>
            <th>Nilai Tajwid</th>
            <th>Nilai Kelancaran</th>
            <th>Status</th>
            @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
            <th width="120px">Aksi</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @forelse($murajaah as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->santri->nama_lengkap ?? '-' }}</td>
              <td>{{ $item->semester->nama_semester ?? '-' }}</td>
              <td>{{ $item->juz_tercapai ?? '0' }}</td>
              <td>{{ $item->tanggal->format('d-m-Y') }}</td>
              <td>{{ ucfirst($item->jenis_hafalan) }}</td>
              <td>{{ $item->surah_ayat }}</td>
              <td>{{ $item->nilai_tajwid }}</td>
              <td>{{ $item->nilai_kelancaran }}</td>
              <td>{{ ucfirst($item->status) }}</td>
              @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
              <td>
                <a href="{{ route('pencatatan-hafalan.edit', $item->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                <form action="{{ route('pencatatan-hafalan.destroy', $item->id) }}" method="POST" style="display:inline-block">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-xs" onclick="return confirm('Yakin hapus data ini?')"><i class="fa fa-trash"></i></button>
                </form>
              </td>
              @endif
            </tr>
          @empty
            <tr>
              <td colspan="10" class="text-center">Belum ada data</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection
