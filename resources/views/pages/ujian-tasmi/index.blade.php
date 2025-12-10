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
  
      
    @if (Auth::user()->role === 'santri')
    <div class="row">
      
      <section class="col-lg-12 connectedSortable">
        <div class="box">
          <div class="" style="display: flex; justify-content: space-between;width: 100%;align-items: center;padding-block: 10px;padding-inline: 15px;">
            <h3 class="" style="font-size: 16px;margin: 0; padding: 0">Sertifikat Untuk Mu</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            {{-- @if ($santri_personal->total_juz_tercapai >= 30) --}}
            <!-- Button trigger modal -->
            <div class="container" style="padding-block: 20px">
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal{{ $santri_personal->id }}">
                Lihat Sertifikat
              </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{ $santri_personal->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih jenis sertifikat</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button> --}}
                  </div>
                  <div class="modal-body" style="width: 100%;display: flex;flex-direction: column;gap: 8px;text-align: start">
                    <a class="btn btn-primary"
                      href="{{ route('sertifikat.tahfidz', ['id_santri' => $santri_personal->id, 'tanggal' => now()]) }}"
                      target="_blank">
                        Sertifikat Hafalan 30 Juz <i class="fa fa-book"></i>
                    </a>
                    <a class="btn btn-success"
                      href="{{ route('sertifikat.kelulusan', ['id_santri' => $santri_personal->id, 'tanggal' => now()]) }}"
                      target="_blank">
                        Sertifikat Kelulusan Tasmi <i class="fa fa-graduation-cap"></i>
                    </a>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            {{-- @else
            <div class="container" style="padding-block: 20px">
              Belum ada sertifikat untuk mu
            </div>
            @endif --}}
          </div>
          <!-- /.box-body -->
        </div>
      </section>

    </div>
    @endif
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
            <th>Pembimbing</th>
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
