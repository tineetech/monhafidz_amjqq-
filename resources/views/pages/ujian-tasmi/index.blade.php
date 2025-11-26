@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Ujian Tasmi
    <small>Data Ujian Santri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Ujian Tasmi</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Ujian Tasmi</h3>
      <div class="box-tools">
        <div style="display:flex;gap:8px;">
          @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
          <a href="{{ route('ujian-tasmi.create') }}" class="btn btn-primary btn-sm">
            Tambah Data
          </a>
          @endif
        </div>
      </div>
    </div>

    <div class="box-body table-responsive">

      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Santri</th>
            <th>Ustadzah</th>
            <th>Tanggal Tasmi</th>
            <th>Juz yang ditasmi</th>
            <th>Catatan</th>
            <th>Status</th>
            @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
            <th>Aksi</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($ujian as $index => $u)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $u->santri->nama_lengkap ?? '-' }}</td>
              <td>{{ $u->ustadzah->nama_lengkap ?? '-' }}</td>
              <td>{{ $u->tanggal_tasmi ? date('d-m-Y', strtotime($u->tanggal_tasmi)) : '-' }}</td>
              <td>{{ $u->juz_yang_ditasmi ?? '-' }}</td>
              <td>{{ $u->catatan ?? '-' }}</td>

              @if ($u->status_ujian == 'lancar')
                <td><span class="label label-success">Lancar</span></td>
              @elseif ($u->status_ujian == 'remidi')
                <td><span class="label label-warning">Remidi</span></td>
              @elseif ($u->status_ujian == 'selesai')
                <td><span class="label label-success">Selesai</span></td>
              @else
                <td><span class="label label-danger">{{ $u->status_ujian }}</span></td>
              @endif

              @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')

              <td>
                <a href="{{ route('ujian-tasmi.edit', $u->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('ujian-tasmi.destroy', $u->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">
                    Hapus
                  </button>
                </form>
              </td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
</section>

@endsection
