@extends('layouts.main')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel {{ Auth::user()->role }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $santri_count ?? '0' }}</h3>

              <p>Santri Aktif</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $ustad ?? '0' }}</h3>

              <p>Ustad/Ustadzah</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $pencatatan_hafalan ?? '0' }}</h3>

              <p>Pencatatan Hafalan</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $santri_lulus ?? '0' }}</h3>

              <p>Santri Lulus</p>
            </div>
            <div class="icon">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      @if (Auth::user()->role === 'santri' || Auth::user()->role === 'walisantri')
      <div class="row">
        
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="" style="display: flex; justify-content: space-between;width: 100%;align-items: center;padding-block: 10px;padding-inline: 15px;">
              <h3 class="" style="font-size: 16px;margin: 0; padding: 0">Infografis</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              @if (Auth::user()->role === 'walisantri')
              {{-- Pastikan ada $walisantri dan variabel ranking --}}
              @php
                  $santri = $walisantri->santri;
              @endphp
              <div class="container" style="width: 100%;padding-block: 20px; font-size: 16px">
                <div class="box box-widget widget-user">

                    {{-- FOTO + NAMA --}}
                    <div class="widget-user-header bg-green" style="padding: 20px">
                        <h3 class="widget-user-username" style="font-weight: bold">
                            {{ $santri->nama_lengkap }}
                        </h3>
                        <h5 class="widget-user-desc">
                            {{ $santri->jenis_kelamin === 'Laki-laki' ? 'Santri Putra' : 'Santri Putri' }}
                        </h5>
                    </div>

                    <div class="widget-user-image">
                        <img class="img-circle" 
                            style="object-fit: cover; width: 90px; height: 90px"
                            src="{{ $santri->foto ? '/storage/santri/' . $santri->foto : url('assets/dist/img/user2-160x160.jpg') }}" 
                            alt="User Avatar">
                    </div>

                    <div class="box-footer" style="padding-top: 40px">
                        <div class="row">

                            {{-- Semester --}}
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $santri->semester->nama_semester ?? '-' }}</h5>
                                    <span class="description-text">SEMESTER AKTIF</span>
                                </div>
                            </div>

                            {{-- Total Juz --}}
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $santri->total_juz_tercapai ?? 0 }}</h5>
                                    <span class="description-text">TOTAL JUZ TERCAPAI</span>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        {{ ucfirst($santri->status_santri ?? 'Aktif') }}
                                    </h5>
                                    <span class="description-text">STATUS SANTRI</span>
                                </div>
                            </div>

                        </div>

                        <hr>

                        {{-- PERINGKAT --}}
                        <div class="row" style="padding-inline: 15px">

                            {{-- <div class="col-md-6">
                                <p style="margin-bottom: 5px"><strong>Peringkat Ziyadah:</strong></p>

                                @if($rankingZiyadah > 0)
                                    <div class="alert alert-info" style="padding: 10px">
                                        {{ $santri->nama_lengkap }} berada di 
                                        <strong>peringkat {{ $rankingZiyadah }}</strong>
                                        dari {{ $totalPesertaZiyadah }} santri.  
                                    </div>
                                @else
                                    <div class="alert alert-warning" style="padding: 10px">
                                        Belum tersedia data peringkat Ziyadah.
                                    </div>
                                @endif
                            </div> --}}

                            {{-- <div class="col-md-6">
                                <p style="margin-bottom: 5px"><strong>Peringkat Murajaah:</strong></p>

                                @if($rankingMurajaah > 0)
                                    <div class="alert alert-success" style="padding: 10px">
                                        {{ $santri->nama_lengkap }} berada di 
                                        <strong>peringkat {{ $rankingMurajaah }}</strong>
                                        dari {{ $totalPesertaMurajaah }} santri.  
                                    </div>
                                @else
                                    <div class="alert alert-warning" style="padding: 10px">
                                        Belum tersedia data peringkat Murajaah.
                                    </div>
                                @endif
                            </div> --}}

                        </div>

                    </div>
                </div>
              </div>

              <div class="container" style="padding-block: 20px; font-size: 16px">
                  @if ($infoRankingZiyadah)
                    <p style="margin-bottom: 5px;">
                        {{ $walisantri->santri->jenis_kelamin === 'Laki-laki' ? 'Ananda' : 'Adinda' }}
                        <strong>{{ $infoRankingZiyadah['nama'] }}</strong>
                        meraih 
                        <strong>peringkat {{ $infoRankingZiyadah['ranking'] }}</strong>
                        dari <strong>{{ $infoRankingZiyadah['total_peserta'] }}</strong>
                        santri {{ $infoRankingZiyadah['gender'] }}
                        {{-- pada <strong>{{ ucfirst($infoRankingZiyadah['kategori']) }}</strong> --}}
                        pada semester <strong>{{ $infoRankingZiyadah['semester'] }}</strong>
                        kategori <strong>{{ $infoRankingZiyadah['kategori'] }}</strong>.
                    </p>
                  @endif
                  @if ($infoRankingMurajaah)
                    <p style="margin-bottom: 5px;">
                        {{ $walisantri->santri->jenis_kelamin === 'Laki-laki' ? 'Ananda' : 'Adinda' }}
                        <strong>{{ $infoRankingMurajaah['nama'] }}</strong>
                        meraih 
                        <strong>peringkat {{ $infoRankingMurajaah['ranking'] }}</strong>
                        dari <strong>{{ $infoRankingMurajaah['total_peserta'] }}</strong>
                        santri {{ $infoRankingMurajaah['gender'] }}
                        {{-- pada <strong>{{ ucfirst($infoRankingMurajaah['kategori']) }}</strong> --}}
                        pada semester <strong>{{ $infoRankingMurajaah['semester'] }}</strong>
                        kategori <strong>{{ $infoRankingMurajaah['kategori'] }}</strong>.
                    </p>
                  @endif
                </div>

              @endif
              @if (Auth::user()->role === 'santri')
              <div class="container" style="padding-block: 20px; font-size: 16px">
                  @if ($infoRankingZiyadah)
                    <p style="margin-bottom: 5px;">
                        Selamat {{ $santri->jenis_kelamin === 'Laki-laki' ? 'Ananda' : 'Adinda' }}
                        <strong>{{ $infoRankingZiyadah['nama'] }}</strong>
                        meraih 
                        <strong>peringkat {{ $infoRankingZiyadah['ranking'] }}</strong>
                        dari <strong>{{ $infoRankingZiyadah['total_peserta'] }}</strong>
                        santri {{ $infoRankingZiyadah['gender'] }}
                        {{-- pada <strong>{{ ucfirst($infoRankingZiyadah['kategori']) }}</strong> --}}
                        pada semester <strong>{{ $infoRankingZiyadah['semester'] }}</strong>
                        kategori <strong>{{ $infoRankingZiyadah['kategori'] }}</strong>.
                    </p>
                  @endif
                  @if ($infoRankingMurajaah)
                    <p style="margin-bottom: 5px;">
                        Selamat {{ $santri->jenis_kelamin === 'Laki-laki' ? 'Ananda' : 'Adinda' }}
                        <strong>{{ $infoRankingMurajaah['nama'] }}</strong>
                        meraih 
                        <strong>peringkat {{ $infoRankingMurajaah['ranking'] }}</strong>
                        dari <strong>{{ $infoRankingMurajaah['total_peserta'] }}</strong>
                        santri {{ $infoRankingMurajaah['gender'] }}
                        {{-- pada <strong>{{ ucfirst($infoRankingMurajaah['kategori']) }}</strong> --}}
                        pada semester <strong>{{ $infoRankingMurajaah['semester'] }}</strong>
                        kategori <strong>{{ $infoRankingMurajaah['kategori'] }}</strong>.
                    </p>
                  @endif
                </div>

              @endif


            </div>
            <!-- /.box-body -->
          </div>
        </section>

      </div>
      @endif
      
      @if (Auth::user()->role === 'santri')
      <div class="row">
        
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="" style="display: flex; justify-content: space-between;width: 100%;align-items: center;padding-block: 10px;padding-inline: 15px;">
              <h3 class="" style="font-size: 16px;margin: 0; padding: 0">Sertifikat Untuk Mu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              @if ($santri_personal->total_juz_tercapai >= 30)
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
                          Sertifikat Kelulusan <i class="fa fa-graduation-cap"></i>
                      </a>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              @else
              <div class="container" style="padding-block: 20px">
                Belum ada sertifikat untuk mu
              </div>
              @endif
            </div>
            <!-- /.box-body -->
          </div>
        </section>

      </div>
      @endif
      <div class="row">
        <!-- Left col -->
        @if (Auth::user()->role === 'santri' || Auth::user()->role === 'ustad')
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Jadwal Ujian Akhir semester</h3>
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
                  @if (Auth::user()->role === 'ustad')
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
                    {{-- <th>Santri</th>
                    <th>Semester</th> --}}
                    <th>Jenis Ujian</th>
                    <th>Tahap</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Pembimbing Putra</th>
                    <th>Pembimbing Putri</th>
                    <th>Tempat</th>
                    @if (Auth::user()->role === 'ustad')
                    <th>Aksi</th>
                    @endif
                  </tr>
                </thead>

                <tbody>
                  @foreach ($jadwal as $i => $j)
                  <tr>
                    <td>{{ $i + 1 }}</td>
                    {{-- <td>{{ $j->santri->nama_lengkap }}</td>
                    <td>{{ $j->semester->nama_semester ?? '-' }}</td> --}}
                    <td>{{ ucfirst($j->jenis_ujian) }}</td>
                    <td>{{ $j->tahap ? 'ke - ' . $j->tahap : 'Tidak ada tahapan' }}</td>
                    <td>{{ $j->tanggal }}</td>
                    <td>
                        {{ substr($j->jam_mulai, 0, 5) }} -
                        {{ $j->jam_selesai ? substr($j->jam_selesai, 0, 5) : 'selesai' }}
                    </td>
                    <td>{{ $j->pembimbingPutra->nama_lengkap ?? '-' }}</td>
                    <td>{{ $j->pembimbingPutri->nama_lengkap ?? '-' }}</td>
                    <td>{{ $j->tempat ?? '-' }}</td>
                    @if (Auth::user()->role === 'ustad')
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
        </section>
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Jadwal Ujian Tasmi</h3>
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
                  @if (Auth::user()->role === 'ustad')
                <a href="{{ route('jadwal-ujian-tasmi.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
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
                    {{-- <th>Santri</th>
                    <th>Semester</th> --}}
                    @if (Auth::user()->role === 'ustad')
                    <th>Santri</th>
                    @endif
                    {{-- <th>Jenis Ujian</th> --}}
                    <th>Tahap</th>
                    <th>Tanggal</th>
                    {{-- <th>Jam</th> --}}
                    <th>Pembimbing Putra</th>
                    <th>Pembimbing Putri</th>
                    <th>Tempat</th>
                    @if (Auth::user()->role === 'ustad')
                    <th>Aksi</th>
                    @endif
                  </tr>
                </thead>

                <tbody>
                  @foreach ($jadwalTasmi as $i => $j)
                  <tr>
                    <td>{{ $i + 1 }}</td>
                    {{-- <td>{{ $j->santri->nama_lengkap }}</td>
                    <td>{{ $j->semester->nama_semester ?? '-' }}</td> --}}
                    @if (Auth::user()->role === 'ustad')
                    <td>{{ $j->santri->nama_lengkap }}</td>
                    @endif
                    {{-- <td>{{ ucfirst($j->jenis_ujian) }}</td> --}}
                    <td>{{ $j->tahap ? 'ke - ' . $j->tahap : 'Tidak ada tahapan' }}</td>
                    <td>{{ $j->tanggal }}</td>
                    {{-- <td>
                        {{ substr($j->jam_mulai, 0, 5) }} -
                        {{ $j->jam_selesai ? substr($j->jam_selesai, 0, 5) : 'selesai' }}
                    </td> --}}
                    <td>{{ $j->pembimbingPutra->nama_lengkap ?? '-' }}</td>
                    <td>{{ $j->pembimbingPutri->nama_lengkap ?? '-' }}</td>
                    <td>{{ $j->tempat ?? '-' }}</td>
                    @if (Auth::user()->role === 'ustad')
                    <td>
                        <a href="{{ route('jadwal-ujian-tasmi.edit', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jadwal-ujian-tasmi.destroy', $j->id) }}" method="POST" style="display:inline;">
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
        </section>
        @endif
        @if (Auth::user()->role !== 'walisantri')
        <section class="col-lg-6 connectedSortable">
          <div class="box">
            <div class="" style="display: flex; justify-content: space-between;width: 100%;align-items: center;padding-block: 10px;padding-inline: 15px;">
              <h3 class="" style="font-size: 16px;margin: 0; padding: 0">Jadwal Setoran Ziyadah</h3>
              <div>
                @if (Auth::user()->role === 'admin')
                <a href="{{ route('jadwal-hafalan.index') }}" class="btn btn-success">Atur Jadwal</a>
                @endif
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th>Hari</th>
                  <th>Waktu</th>
                  <th>Pembimbing Putra</th>
                  <th>Pembimbing Putri</th>
                </tr>
                
                @foreach($ziyadah as $row)
                <tr>
                  <td>{{ $row->hari }}</td>
                  <td>{{ substr($row->jam_mulai, 11, 5) . ' - ' . ($row->jam_selesai == null ? 'Selesai' : substr($row->jam_selesai, 11, 5)) }}</td>
                  <td>{{ $row->pembimbingPutra->nama_lengkap ?? 'Tidak Ada' }}</td>
                  <td>{{ $row->pembimbingPutri->nama_lengkap ?? 'Tidak Ada' }}</td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        <section class="col-lg-6 connectedSortable">
          <div class="box">
            <div class="" style="display: flex; justify-content: space-between;width: 100%;align-items: center;padding-block: 10px;padding-inline: 15px;">
              <h3 class="" style="font-size: 16px;margin: 0; padding: 0">Jadwal Setoran Muraja'ah</h3>
              <div>
                @if (Auth::user()->role === 'admin')
                <a href="{{ route('jadwal-hafalan.index') }}" class="btn btn-success">Atur Jadwal</a>
                @endif
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th>Hari</th>
                  <th>Waktu</th>
                  <th>Pembimbing Putra</th>
                  <th>Pembimbing Putri</th>
                </tr>
                @foreach($murajaah as $row)
                <tr>
                  <td>{{ $row->hari }}</td>
                  <td>{{ substr($row->jam_mulai, 11, 5) . ' - ' . ($row->jam_selesai == null ? 'Selesai' : substr($row->jam_selesai, 11, 5)) }}</td>
                  <td>{{ $row->pembimbingPutra->nama_lengkap ?? 'Tidak Ada' }}</td>
                  <td>{{ $row->pembimbingPutri->nama_lengkap ?? 'Tidak Ada' }}</td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        @endif

        {{-- <section class="col-lg-12">
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Grafik Perkembangan Hafalan Santri Per Semester</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
               
              <canvas id="chartZiyadah" height="100"></canvas>
              <!-- <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div> -->
            </div>
          </div>
        </section> --}}
        <!-- /.Left col -->
      </div>
      <!-- /.row (main row) -->

    </section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {

     fetch("{{ url('/api/laporan/chart-ziyadah') }}?role={{ Auth::user()->role }}&user_id={{ auth()->id() }}")
          .then(res => res.json())
          .then(res => {
            console.log(res)
              new Chart(document.getElementById('chartZiyadah'), {
                  type: "line",
                  data: {
                      labels: res.labels,
                      datasets: res.datasets
                  },
                  options: {
                      responsive: true,
                      plugins: {
                          legend: { position: 'bottom' },
                          title: {
                              display: true,
                              text: "Total Hafalan Ziyadah Semua Santri per Semester"
                          }
                      },
                      scales: {
                          y: {
                              beginAtZero: true,
                              title: { display: true, text: "Jumlah Juz" }
                          },
                          x: {
                              title: { display: true, text: "Semester" }
                          }
                      }
                  }
              });

          });

  });

</script>
@endsection
