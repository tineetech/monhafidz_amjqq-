@extends('layouts.main')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Master Data Santri
        <small>Data Santri</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Master Data Santri</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Santri</h3>
              <div class="box-tools">
                <a href="{{ route('santri.create') }}" class="btn btn-primary btn-sm">Tambah Santri</a>
              </div>
            </div>
            <div class="box-body table-responsive">
              
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              <table id="santri-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Nik</th>
                    <th style="width: 130px">Total Juz Tercapai (Ziyadah)</th>
                    <th>TGL Lahir</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Status Santri</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($santri as $index => $s)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $s->nama_lengkap }}</td>
                      <td>{{ $s->jenis_kelamin }}</td>
                      <td>{{ $s->nik }}</td>
                      <td>{{ $s->total_juz_tercapai }} juz</td>
                      <td>{{ $s->tanggal_lahir }}</td>
                      <td>{{ $s->alamat_lengkap }}</td>
                      <td>{{ $s->no_hp }}</td>
                      <td>{{ $s->status_santri }}</td>
                      <td>
                        @if ($s->total_juz_tercapai >= 90)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal{{ $s->id }}">
                          Lihat Sertifikat
                        </button>

                        <div class="modal fade" id="exampleModal{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                  href="{{ route('sertifikat.tahfidz', ['id_santri' => $s->id, 'tanggal' => now()]) }}"
                                  target="_blank">
                                    Sertifikat Hafalan 30 Juz <i class="fa fa-book"></i>
                                </a>
                                <a class="btn btn-success"
                                  href="{{ route('sertifikat.kelulusan', ['id_santri' => $s->id, 'tanggal' => now()]) }}"
                                  target="_blank">
                                    Sertifikat Kelulusan <i class="fa fa-graduation-cap"></i>
                                </a>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endif
                        
                        {{-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal{{ $s->id . 'wa' }}">
                          <i class="fa fa-whatsapp"></i>
                        </button> --}}

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $s->id . 'wa' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kirim Notifikasi</h5>
                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button> --}}
                              </div>
                              <div class="modal-body" style="width: 100%;display: flex;flex-direction: column;gap: 8px;text-align: start">
                                <span class="text-center">Kirim ke santri langsung</span>
                                <button
                                    class="btn btn-primary btn-send-wa"
                                    data-id="{{ $s->id }}"
                                    data-template="1"
                                    data-tujuan="santri">
                                    Pengingat Hafalan Ziyadah <i class="fa fa-book"></i>
                                </button>

                                <button
                                    class="btn btn-success btn-send-wa"
                                    data-id="{{ $s->id }}"
                                    data-template="2"
                                    data-tujuan="santri">
                                    Pengingat Hafalan Murajaah <i class="fa fa-book"></i>
                                </button>

                                <button
                                    class="btn btn-info btn-send-wa"
                                    data-id="{{ $s->id }}"
                                    data-template="3"
                                    data-tujuan="santri">
                                    Apresiasi Santri mencapai target <i class="fa fa-check"></i>
                                </button>

                                <span class="text-center">Kirim ke wali santri</span>
                                <button
                                    class="btn btn-primary btn-send-wa"
                                    data-id="{{ $s->id }}"
                                    data-template="1"
                                    data-tujuan="ortu">
                                    Pengingat Hafalan Ziyadah <i class="fa fa-book"></i>
                                </button>

                                <button
                                    class="btn btn-success btn-send-wa"
                                    data-id="{{ $s->id }}"
                                    data-template="2"
                                    data-tujuan="ortu">
                                    Pengingat Hafalan Murajaah <i class="fa fa-book"></i>
                                </button>

                                <button
                                    class="btn btn-info btn-send-wa"
                                    data-id="{{ $s->id }}"
                                    data-template="3"
                                    data-tujuan="ortu">
                                    Apresiasi Santri mencapai target <i class="fa fa-check"></i>
                                </button>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <a href="{{ route('santri.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('santri.destroy', $s->id) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                      </td>
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
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on("click", ".btn-send-wa", function() {
    let id_santri   = $(this).data("id");
    let no_template = $(this).data("template");
    let tujuan      = $(this).data("tujuan");

    Swal.fire({
        title: 'Mengirim pesan...',
        text: 'Mohon tunggu sebentar',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    $.ajax({
        url: "{{ route('wablast') }}",
        type: "GET",
        data: {
            id_santri: id_santri,
            no_template: no_template,
            tujuan: tujuan
        },
        success: function(res) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil terkirim',
                html: res.message ?? 'Pesan berhasil dikirim!',
                timer: 2000
            });
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal mengirim',
                html: xhr.responseText ?? 'Terjadi kesalahan'
            });
        }
    });
});
</script>

@endsection
