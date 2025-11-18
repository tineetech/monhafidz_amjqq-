@extends('layouts.main')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Master Data Semester
        <small>Data Semester</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Master Data Semester</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Semester Untuk Hafalan Ziyadah</h3>
              <div class="box-tools">
                <a href="{{ route('semester.create') }}" class="btn btn-primary btn-sm">Tambah Semester</a>
              </div>
            </div>
            <div class="box-body table-responsive">
              
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              <table id="semester-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Semester</th>
                    <th>Tahun Ajaran</th>
                    <th>Periode Mulai</th>
                    <th>Periode Selesai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($semesterZiyadah as $index => $s)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $s->nama_semester }}</td>
                      <td>{{ $s->tahun_ajaran }}</td>
                      <td>{{ $s->periode_mulai }}</td>
                      <td>{{ $s->periode_selesai }}</td>
                      <td>{{ $s->status }}</td>
                      <td>
                        <a href="{{ route('semester.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('semester.destroy', $s->id) }}" method="POST" style="display:inline;">
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Semester Untuk Hafalan Murajaah</h3>
              <div class="box-tools">
                <a href="{{ route('semester.create') }}" class="btn btn-primary btn-sm">Tambah Semester</a>
              </div>
            </div>
            <div class="box-body table-responsive">
              
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              <table id="semester-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Semester</th>
                    <th>Tahun Ajaran</th>
                    <th>Periode Mulai</th>
                    <th>Periode Selesai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($semesterMurajaah as $index => $s)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $s->nama_semester }}</td>
                      <td>{{ $s->tahun_ajaran }}</td>
                      <td>{{ $s->periode_mulai }}</td>
                      <td>{{ $s->periode_selesai }}</td>
                      <td>{{ $s->status }}</td>
                      <td>
                        <a href="{{ route('semester.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('semester.destroy', $s->id) }}" method="POST" style="display:inline;">
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