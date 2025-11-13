@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Jadwal Ujian
    <small>Data Jadwal Ujian</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Jadwal Ujian</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Jadwal Ujian</h3>
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
                <a href="{{ route('jadwal-ujian.index') }}" class="btn btn-default btn-sm">Reset</a>
              @endif
              <button class="btn btn-info btn-sm" type="submit">Filter</button>
            </form>
              @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
            <a href="{{ route('jadwal-ujian.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
            @endif
          </div>
          </div>
        </div>

        <div class="box-body table-responsive">

          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Santri</th>
                <th>Semester</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Pembimbing Putra</th>
                <th>Pembimbing Putri</th>
                <th>Jenis Ujian</th>
                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
                <th>Aksi</th>
                @endif
              </tr>
            </thead>

            <tbody>
              @foreach ($jadwal as $i => $j)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $j->santri->nama_lengkap }}</td>
                <td>{{ $j->semester->nama_semester ?? '-' }}</td>
                <td>{{ $j->tanggal }}</td>
                <td>{{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }}</td>
                <td>{{ $j->pembimbingPutra->nama_lengkap ?? '-' }}</td>
                <td>{{ $j->pembimbingPutri->nama_lengkap ?? '-' }}</td>
                <td>{{ ucfirst($j->jenis_ujian) }}</td>
                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'ustad')
                <td>
                    <a href="{{ route('jadwal-ujian.edit', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('jadwal-ujian.destroy', $j->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>

          </table>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection
