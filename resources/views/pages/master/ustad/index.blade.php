@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Master Data Ustad
    <small>Data Ustad</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Master Data Ustad</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Ustad</h3>
          <div class="box-tools">
            <a href="{{ route('ustadzah.create') }}" class="btn btn-primary btn-sm">
              <i class="fa fa-plus"></i> Tambah Ustad
            </a>
          </div>
        </div>

        <div class="box-body table-responsive">
          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <table id="ustadzah-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>NIK</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($ustadzah as $index => $u)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $u->nama_lengkap }}</td>
                  <td>{{ $u->jenis_kelamin }}</td>
                  <td>{{ $u->nik }}</td>
                  <td>{{ $u->tanggal_lahir }}</td>
                  <td>{{ $u->alamat_lengkap }}</td>
                  <td>{{ $u->no_hp }}</td>
                  <td>{{ ucfirst($u->status) }}</td>
                  <td>
                    <a href="{{ route('ustadzah.edit', $u->id) }}" class="btn btn-warning btn-sm">
                      <i class="fa fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('ustadzah.destroy', $u->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">
                        <i class="fa fa-trash"></i> Hapus
                      </button>
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
