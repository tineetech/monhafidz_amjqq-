@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Pencatatan Ujian
    <small>Data Ujian</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pencatatan Ujian</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Ujian Santri</h3>
      <div class="box-tools">
        <div class="" style="display: flex; gap: 8px;width: auto;">
          <form action="" method="GET" style="display: flex;gap:3px">
            <select name="filter_semester" class="form-control" style="margin-right: 5px;" id="">
              <option value="">-- Filter Semester --</option>
              @foreach ($semesters as $semester)
                <option value="{{ $semester->id }}"  {{ request('filter_semester') == $semester->id ? 'selected' : '' }}>
                  {{ ucfirst($semester->nama_semester) }}
                </option>
              @endforeach
            </select>
            <select name="filter_jenis_ujian" class="form-control" style="margin-right: 5px;" id="">
              <option value="">-- Filter Jenis Ujian --</option>
              <option value="tasmi" {{ request('filter_jenis_ujian') == 'tasmi' ? 'selected' : '' }}>Tasmi</option>
              <option value="ujian_akhir" {{ request('filter_jenis_ujian') == 'ujian_akhir' ? 'selected' : '' }}>Ujian Akhir</option>
              <option value="ziyadah" {{ request('filter_jenis_ujian') == 'ziyadah' ? 'selected' : '' }}>Ziyadah</option>
              <option value="murajaah" {{ request('filter_jenis_ujian') == 'murajaah' ? 'selected' : '' }}>Murajaah</option>
            </select>
            @if (request('filter_semester') || request('filter_jenis_ujian'))
              <a href="{{ route('pencatatan-ujian.index') }}" class="btn btn-default btn-sm">Reset</a>
            @endif
            <button class="btn btn-info btn-sm" type="submit">Filter</button>
          </form>
          @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
          <a href="{{ route('pencatatan-ujian.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
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
            <th>Semester</th>
            <th>Pengawas</th>
            <th>Tanggal</th>
            <th>Jenis Ujian</th>
            <th>Nilai</th>
            <th>Peringkat</th>
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
              <td>{{ $u->jadwalUjian->santri->nama_lengkap ?? '-' }}</td>
              <td>{{ $u->jadwalUjian->semester->nama_semester ?? '-' }}</td>
              <td>{{ $u->ustadzah->nama_lengkap ?? '-' }}</td>
              <td>{{ date('d-m-Y', strtotime($u->jadwalUjian->tanggal)) }}</td>
              <td>{{ ucfirst($u->jadwalUjian->jenis_ujian) }}</td>
              <td>{{ $u->nilai_ujian ? number_format($u->nilai_ujian, 0) : '-' }}</td>
              <td>{{ $u->rank === "null" ? 'Belum Tersedia' : "Ke - " . $u->rank }}</td>
              {{-- @dd() --}}
              @if ($u->status_ujian == 'lulus')
                <td><span class="label label-success">Lolos</span></td>
              @elseif ($u->status_ujian == 'belum_diuji')
                <td><span class="label label-danger">Belum Diuji</span></td>
              @endif
                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
              <td>
                @if ($u->rank !== "null" && ($u->rank === 1 || $u->rank === 2 || $u->rank === 3))
                  <a href="{{ route('sertifikat.top3', ['id_ujian' => $u->id]) }}" class="btn btn-success btn-sm" target="_blank">Lihat Sertifikat</a>
                @endif
                <a href="{{ route('pencatatan-ujian.edit', $u->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('pencatatan-ujian.destroy', $u->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
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
