@extends('layouts.main')

@section('content')
<style>
#chartAbsensi {
    max-width: 600px;
    max-height: 600px;
    margin: 0 auto; /* biar center */
}
</style>

<section class="content-header">
  <h1>
    Laporan
    <small>Daftar semua catatan hafalan santri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Rekap Hafalan</li>
  </ol>
</section>

<section class="content">
  
  <div class="box">
    <div class="box-header text-center with-border">
      <h3 class="box-title ">Grafik</h3>
    </div>

    <div class="box-body table-responsive">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- <canvas id="chartZiyadah" height="100"></canvas>
      <canvas id="chartDonatZiyadah" width="400" height="400"></canvas> --}}
      <canvas id="chartAbsensi" height="100"></canvas>

    </div>
  </div>

  
  <div class="box">
    <div class="box-header text-center with-border">
      <h3 class="box-title">Laporan perkembangan hafalan santri</h3>
    </div>

    <div class="box-body">
      <form id="form-hafalan" method="POST">
        @csrf
        <div class="" style="display: flex;justify-content: space-between">
          <h4 class="">Cari Santri</h4>
          <div style=" text-align:right">
            <a id="btnExportPdf" class="btn btn-danger" target="_blank" style="display:none">
                <i class="fa fa-file-pdf-o"></i> Export PDF
            </a>
            <button type="button" class="btn btn-success" style="display:none" data-toggle="modal" id="btnWa" data-target="">
              <i class="fa fa-whatsapp"></i>
              Kirim Notifikasi
            </button>

            <button type="submit" class="btn btn-success"> Simpan <i class="fa fa-arrow-right"></i></button>
        </div>
        </div>
        <div class="row" style="margin-top: 10px">
            <div class="form-group col-md-6">
                <select name="santri_id" id="selectSantri" class="form-control" required>
                    <option value="">-- Pilih Santri --</option>
                    @foreach($santri as $s)
                        <option value="{{ $s->id }}" {{ old('santri_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <select name="semester" id="semester" class="form-control" required>
                    <option value="">-- Pilih Semester --</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->nama_semester }}" {{ old('semester') == $semester->nama_semester ? 'selected' : '' }}>
                            {{ $semester->nama_semester }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <select name="jenis_hafalan" id="jenis_hafalan" class="form-control" required>
                    <option value="">-- Pilih Jenis Hafalan --</option>
                    <option value="Ziyadah" {{ old('jenis_hafalan') == 'Ziyadah' ? 'selected' : '' }}>Ziyadah</option>
                    <option value="Murajaah" {{ old('jenis_hafalan') == 'Murajaah' ? 'selected' : '' }}>Murajaah</option>
                </select>
            </div>
        </div>
      </form>

      <div class="box-display-laporan-hafalan hidden">
        <div class="box">
          <div class="box-header with-border" style="display: flex;flex-direction: column;gap: 15px">
            {{-- <div style="display: flex;justify-content: space-between">
              <div style="display: flex;flex-direction: column; gap: 8px;">
              </div>
            </div> --}}
            <h3 class="box-title">Nama Santri : </h3>
            <h3 class="box-title">Jenis hafalan : </h3>
            <h3 class="box-title">Periode : </h3>
            <h3 class="box-title">Pembimbing : </h3>
          </div>

          <div class="box-body " style="overflow: hidden">
            <div class="table-responsive">
              <table id="santri-table" class="table table-bordered table-striped">
                 <thead>
                   <tr>
                     <th>No</th>
                     <th>Bulan</th>
                     <th>Surah/Juz yang dihapal</th>
                     <th>Jumlah Juz</th>
                     <th>Target</th>
                     <th>Persentase</th>
                     {{-- <th>Nilai</th> --}}
                     <th>Keterangan</th>
                   </tr>
                 </thead>
                 <tbody>
                 </tbody>
               </table>
            </div>
              
              <div class="row text-center w-100 overflow-hidden" style="margin-inline: 10px">
                <div class="col-md-4 " style="padding: 10px">
                  🥈 
                  <h3 id="nm-peringkat2">Nama peringkat</h3>
                  <p>Peringkat 2</p>
                </div>
                <div class="col-md-4 " style="padding: 10px">
                  🥇
                  <h3 id="nm-peringkat1">Nama peringkat</h3>
                  <p>Peringkat 1</p>
                </div>
                <div class="col-md-4 " style="padding: 10px">
                  🥉
                  <h3 id="nm-peringkat3">Nama peringkat</h3>
                  <p>Peringkat 3</p>
                </div>
              </div>
            </div>

          
        </div>
      </div>
    </div>
  </div>

  <div class="box">
    <div class="box-header text-center with-border">
      <h3 class="box-title">Laporan absensi hafalan santri</h3>
    </div>

    <div class="box-body">
      <form id="form-lap-absensi" method="POST">
        @csrf
        <div class="" style="display: flex;justify-content: space-between">
          <h4 class="">Cari Santri</h4>
          <div style=" text-align:right">
            <a id="btnExportPdfAbsensi" class="btn btn-danger" target="_blank" style="display:none">
                <i class="fa fa-file-pdf-o"></i> Export PDF
            </a>
            <button type="submit" class="btn btn-success"> Simpan <i class="fa fa-arrow-right"></i></button>
        </div>
        </div>
        <div class="row" style="margin-top: 10px">
            <div class="form-group col-md-6">
                <select name="santri_id" id="selectSantri2" class="form-control" required>
                    <option value="">-- Pilih Santri --</option>
                    @foreach($santri as $s)
                        <option value="{{ $s->id }}" {{ old('santri_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <select name="semester_id" id="semester_id" class="form-control" required>
                    <option value="">-- Pilih Semester --</option>
                      @foreach($semesters as $sem)
                          <option value="{{ $sem->id }}"
                                  {{ old('semester_id') == $sem->id ? 'selected' : '' }}>
                              {{ $sem->nama_semester }}
                          </option>
                      @endforeach
                </select>
            </div>
            {{-- <div class="form-group col-md-3">
              <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div> --}}
        </div>
      </form>

      <div class="box-display-laporan-absensi hidden">
        <div class="box">
          <div class="box-header with-border" style="display: flex;flex-direction: column;gap: 15px">
            <h3 class="box-title">Nama Santri : </h3>
            <h3 class="box-title">Jenis hafalan : Ziyadah & Murajaah</h3>
            <h3 class="box-title">Periode : </h3>
            <h3 class="box-title">Pembimbing : </h3>
          </div>

          <div class="box-body table-responsive">
             <table id="santri-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Tanggal</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alpa</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot></tfoot>
              </table>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
console.log("{{ url('/api/laporan/chart-ziyadah') }}?role={{ Auth::user()->role }}&user_id={{ auth()->id() }}")
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
              new Chart(document.getElementById('chartDonatZiyadah'), {
                type: "doughnut",
                data: {
                    labels: res.donut_labels, // Juz 1–30
                    datasets: [{
                        data: res.donut_dataset, // Persentase per juz
                        backgroundColor: res.donut_labels.map(() =>
                            "#" + Math.floor(Math.random()*16777215).toString(16)
                        ),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' },
                        title: {
                            display: true,
                            text: "Distribusi Juz Ziyadah Semua Santri"
                        },
                        tooltip: {
                            callbacks: {
                                label: (ctx) =>
                                    `Juz ${ctx.label}: ${ctx.raw}% santri`
                            }
                        }
                    }
                }
              });
          });

          fetch("{{ url('/api/laporan/chart-absensi') }}?role={{ Auth::user()->role }}&user_id={{ auth()->id() }}")
            .then(res => res.json())
            .then(res => {
                new Chart(document.getElementById('chartAbsensi'), {
                    type: "doughnut",
                    data: {
                        labels: res.labels,
                        datasets: [{
                            data: res.dataset,
                            backgroundColor: res.colors,
                            borderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'right' },
                            title: {
                                display: true,
                                text: "Rekap Grafik Absensi Santri"
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(ctx) {
                                        return `${ctx.label}: ${ctx.raw}`;
                                    }
                                }
                            }
                        },
                        cutout: '60%' // donut tebal seperti contoh
                    }
                });
            });


  });

  document.getElementById('form-hafalan').addEventListener('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("{{ url('/api/laporan/hafalan') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        console.log(res);

        const boxdisplay = document.querySelector('.box-display-laporan-hafalan');
        document.getElementById("btnWa").style.display = "inline-block";
        document.getElementById("btnExportPdf").style.display = "inline-block";
        document.getElementById("btnExportPdf").href =
            `/export/laporan/hafalan/export-pdf?santri_id=${formData.get('santri_id')}&semester=${formData.get('semester')}&jenis_hafalan=${formData.get('jenis_hafalan')}`;
        document.querySelector('.box-display-laporan-hafalan').classList.remove('hidden');
        boxdisplay.querySelector('.box-title:nth-child(1)').innerHTML = "Nama Santri : " + res.santri.nama_lengkap;
        boxdisplay.querySelector('.box-title:nth-child(2)').innerHTML = "Jenis Hafalan : " + res.jenis_hafalan;
        boxdisplay.querySelector('.box-title:nth-child(3)').innerHTML = "Periode : " + res.periode + ' (' + res.semester + ')';
        boxdisplay.querySelector('.box-title:nth-child(4)').innerHTML = "Pembimbing : " + res.pembimbing;
        
        boxdisplay.querySelector('#nm-peringkat2').innerHTML = res.juara2;
        boxdisplay.querySelector('#nm-peringkat1').innerHTML = res.juara1;
        boxdisplay.querySelector('#nm-peringkat3').innerHTML = res.juara3;

        let tbody = document.querySelector('#santri-table tbody');
        tbody.innerHTML = "";

        res.data.forEach((row, i) => {
            tbody.innerHTML += `
                <tr>
                  <td>${i + 1}</td>
                  <td>${row.bulan}</td>
                  <td>${row.surah_juz}</td>
                  <td>${row.jumlah_juz}</td>
                  <td>${res.jenis_hafalan === 'Ziyadah' ? "5 juz" : '10 juz'}</td>
                  <td>${row.persentase}%</td>
                  
                  <td>${i === 0 ? (row.persentase_all < 90 ? 'Belum Tercapai' : 'Tercapai') : ''}</td>
                </tr>
            `;
        });

        // =====================
        // DYNAMIC MODAL WA
        // =====================
        let santriId = res.santri.id;
        let modalId = `modalWa-${santriId}`;

        // Hapus modal lama jika ada
        let existingModal = document.getElementById(modalId);
        if (existingModal) existingModal.remove();

        // Render modal ke body
        document.body.insertAdjacentHTML("beforeend", `
        <div class="modal fade" id="${modalId}" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Kirim Notifikasi</h5>
              </div>

              <div class="modal-body" style="display:flex;flex-direction:column;gap:8px;">
                <span class="text-center">Kirim ke santri langsung</span>

                <button class="btn btn-primary btn-send-wa" data-id="${santriId}" data-template="1" data-tujuan="santri">
                  Pengingat Hafalan Ziyadah Belum Tercapai <i class="fa fa-book"></i>
                </button>

                <button class="btn btn-success btn-send-wa" data-id="${santriId}" data-template="2" data-tujuan="santri">
                  Pengingat Hafalan Murajaah Belum Tercapai <i class="fa fa-book"></i>
                </button>

                <button class="btn btn-info btn-send-wa" data-id="${santriId}" data-template="3" data-tujuan="santri">
                  Apresiasi Santri Telah tercapai ziyadah/murajaah <i class="fa fa-check"></i>
                </button>

                <span class="text-center">Kirim ke wali santri</span>

                <button class="btn btn-primary btn-send-wa" data-id="${santriId}" data-template="1" data-tujuan="ortu">
                  Pengingat Hafalan Ziyadah Belum Tercapai <i class="fa fa-book"></i>
                </button>

                <button class="btn btn-success btn-send-wa" data-id="${santriId}" data-template="2" data-tujuan="ortu">
                  Pengingat Hafalan Murajaah Belum Tercapai <i class="fa fa-book"></i>
                </button>

                <button class="btn btn-info btn-send-wa" data-id="${santriId}" data-template="3" data-tujuan="ortu">
                  Apresiasi Santri Telah tercapai ziyadah/murajaah<i class="fa fa-check"></i>
                </button>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        `);

        // Set button WA untuk membuka modal
        document.getElementById("btnWa").setAttribute("data-target", `#${modalId}`);

    });
  });

  document.getElementById('form-lap-absensi').addEventListener('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("{{ url('/api/laporan/absensi') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        console.log(res);

        const boxdisplay = document.querySelector('.box-display-laporan-absensi');

        document.getElementById("btnExportPdfAbsensi").style.display = "inline-block";
        document.getElementById("btnExportPdfAbsensi").href =
            `/export/laporan/absensi/export-pdf?santri_id=${formData.get('santri_id')}&jenis_laporan=${formData.get('jenis_laporan')}&tanggal=${formData.get('tanggal')}`;

        boxdisplay.classList.remove('hidden');

        boxdisplay.querySelector('.box-title:nth-child(1)').innerHTML = "Nama Santri : " + res.santri.nama_lengkap;
        boxdisplay.querySelector('.box-title:nth-child(3)').innerHTML = "Periode : " + res.periode;
        boxdisplay.querySelector('.box-title:nth-child(4)').innerHTML = "Pembimbing : " + res.pembimbing;

        let tbody = document.querySelector('.box-display-laporan-absensi table tbody');
        tbody.innerHTML = "";

        // Hitung total
        let totalHadir = 0, totalIzin = 0, totalSakit = 0, totalAlpa = 0;

        res.data.forEach((row, i) => {
            tbody.innerHTML += `
                <tr>
                    <td>${i + 1}</td>
                    <td>${row.bulan}</td>
                    <td>${row.tanggal.slice(0, 10)}</td>
                    <td>${row.hadir > 0 ? '✔️' : ''}</td>
                    <td>${row.izin > 0 ? '✔️' : ''}</td>
                    <td>${row.sakit > 0 ? '✔️' : ''}</td>
                    <td>${row.alpa > 0 ? '✔️' : ''}</td>
                    <td>${row.keterangan ?? '-'}</td>
                </tr>
            `;
            totalHadir += parseInt(row.hadir);
            totalIzin += parseInt(row.izin);
            totalSakit += parseInt(row.sakit);
            totalAlpa += parseInt(row.alpa);
        });

        // Hitung total & persentase
        let totalPertemuan = totalHadir + totalIzin + totalSakit + totalAlpa;
        let persenHadir = totalPertemuan > 0 ? Math.round((totalHadir / totalPertemuan) * 100) : 0;
        let persenAlpha = totalPertemuan > 0 ? Math.round((totalAlpa / totalPertemuan) * 100) : 0;

        // Tambahkan footer
        let tfoot = document.querySelector('.box-display-laporan-absensi table tfoot');
        tfoot.innerHTML = `
            <tr style="font-weight:bold;background:#eef">
                <td colspan="3" class="text-center">TOTAL</td>
                <td>${totalHadir}</td>
                <td>${totalIzin}</td>
                <td>${totalSakit}</td>
                <td>${totalAlpa}</td>
                <td>-</td>
            </tr>
            <tr style="font-weight:bold;background:#def">
                <td colspan="3" class="text-center">Persentase Kehadiran</td>
                <td colspan="5">${persenHadir}% hadir</td>
            </tr>
        `;
    });
  });

</script>
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
