@extends('layouts.main')
@section('content')
<section class="content-header">
  <h1>
    Jadwal Hafalan Santri
    <small>Kelola jadwal hafalan santri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Jadwal Hafalan Santri</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="" style="display: flex; justify-content: space-between;width: 100%;align-items: center;padding-block: 10px;padding-inline: 15px;">
              <h3 class="" style="font-size: 16px;margin: 0; padding: 0">Jadwal Setoran Ziyadah</h3>
              <div>
                @if (Auth::user()->role === 'admin')
                <a href="/jadwal-hafalan-zm/edit?type=ziyadah" class="btn btn-success">Atur Jadwal</a>
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
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="" style="display: flex; justify-content: space-between;width: 100%;align-items: center;padding-block: 10px;padding-inline: 15px;">
              <h3 class="" style="font-size: 16px;margin: 0; padding: 0">Jadwal Setoran Muraja'ah</h3>
              <div>
                @if (Auth::user()->role === 'admin')
                <a href="/jadwal-hafalan-zm/edit?type=murajaah" class="btn btn-success">Atur Jadwal</a>
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
    </div>
    

</section>
@endsection