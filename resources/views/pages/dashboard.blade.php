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
              <h3>{{ $santri ?? '0' }}</h3>

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
      <div class="row">
        <!-- Left col -->
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
                  <td>{{ substr($row->jam_mulai, 11, 5) . ' - ' . ($row->jam_selesai == null ? 'Selesai' : $row->jam_selesai) }}</td>
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
                  <td>{{ substr($row->jam_mulai, 11, 5) . ' - ' . ($row->jam_selesai == null ? 'Selesai' : $row->jam_selesai) }}</td>
                  <td>{{ $row->pembimbingPutra->nama_lengkap ?? 'Tidak Ada' }}</td>
                  <td>{{ $row->pembimbingPutri->nama_lengkap ?? 'Tidak Ada' }}</td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </section>

        <section class="col-lg-12">
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
        </section>
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
