@extends('layouts.main')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Absensi
      <small>Rekap Kehadiran Santri</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Absensi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Absensi Santri</h3>
            <div class="box-tools">
              @if (Auth::user()->role === 'santri')
              <a href="{{ route('absensi.izin') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Pengajuan Izin
              </a>
              @endif
              @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
              <a href="{{ route('absensi.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Absensi
              </a>
              @endif
            </div>
          </div>

          <div class="box-body table-responsive">
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table id="absensi-table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Santri</th>
                  <th>Tanggal Absensi</th>
                  <th>Catatan</th>
                  <th>Status</th>
                  @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
                  <th>Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($absensi as $index => $a)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $a->santri->nama_lengkap ?? '-' }}</td>
                    <td>{{ $a->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $a->catatan ?? '-' }}</td>
                    <td>
                      @php
                        $labelClass = match($a->status) {
                          'Hadir' => 'label-success',
                          'Izin' => 'label-info',
                          'Sakit' => 'label-warning',
                          'Alpa' => 'label-danger',
                          default => 'label-default',
                        };
                      @endphp
                      <span class="label {{ $labelClass }}">{{ $a->status }}</span>
                    </td>
                    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
                    <td>
                      <a href="{{ route('absensi.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      <form action="{{ route('absensi.destroy', $a->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                      </form>
                    </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
        
        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Pengajuan Perizinan Absensi Santri</h3>
            <div class="box-tools">
            </div>
          </div>

          <div class="box-body table-responsive">
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table id="absensi-table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Santri</th>
                  <th>Tanggal Absensi</th>
                  <th>Alasan</th>
                  <th>Status</th>
                  @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
                  <th>Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($perizinan as $index => $a)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $a->santri->nama_lengkap ?? '-' }}</td>
                    <td>{{ $a->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $a->alasan ?? '-' }}</td>
                    <td>
                      @php
                        $labelClass = match($a->status) {
                          'Hadir' => 'label-success',
                          'Izin' => 'label-info',
                          'Sakit' => 'label-warning',
                          'Alpa' => 'label-danger',
                          default => 'label-default',
                        };
                      @endphp
                      <span class="label {{ $labelClass }}">{{ $a->status }}</span>
                    </td>
                    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
                    <td>
                      <a href="{{ route('perizinan.setujui', $a->id) }}" class="btn btn-success btn-sm">Setujui</a>
                      <form action="{{ route('perizinan.destroy', $a->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                      </form>
                    </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
        @endif
      </div>
    </div>
  </section>

@endsection
