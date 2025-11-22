 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      {{-- menu admin  --}}
      @if (Auth::user()->role === "admin")
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview {{ request()->routeIs(['santri.*','ustadzah.*','wali.*','semester.*']) ? 'active menu-open' : '' }}">
          <a href="#">
            <i class="fa fa-gears"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu" style="{{ request()->routeIs(['santri.*','ustadzah.*','wali.*','semester.*']) ? 'display:block;' : '' }}">
              <li class="{{ request()->routeIs('santri.*') ? 'active' : '' }}">
                <a href="{{ route('santri.index') }}"><i class="fa fa-circle-o"></i> Santri</a>
              </li>

              <li class="{{ request()->routeIs('ustadzah.*') ? 'active' : '' }}">
                <a href="{{ route('ustadzah.index') }}"><i class="fa fa-circle-o"></i> Ustad</a>
              </li>

              <li class="{{ request()->routeIs('wali.*') ? 'active' : '' }}">
                <a href="{{ route('wali.index') }}"><i class="fa fa-circle-o"></i> Wali Santri</a>
              </li>

              <li class="{{ request()->routeIs('semester.*') ? 'active' : '' }}">
                <a href="{{ route('semester.index') }}"><i class="fa fa-circle-o"></i> Semester</a>
              </li>
          </ul>
        </li>

        {{-- <li class="{{ request()->routeIs('absensi.*') ? 'active' : '' }}">
          <a href="{{ route('absensi.index') }}">
            <i class="fa fa-id-badge"></i> <span>Absensi</span>
          </a>
        </li> --}}

        <li class="{{ request()->routeIs('jadwal-hafalan.*') ? 'active' : '' }}">
          <a href="{{ route('jadwal-hafalan.index') }}">
            <i class="fa fa-calendar"></i> <span>Jadwal Setoran</span>
          </a>
        </li>

        {{-- <li class="treeview {{ request()->routeIs(['jadwal-hafalan.*','pencatatan-hafalan.*','rekap-hafalan.*']) ? 'active menu-open' : '' }}">
          <a href="#">
            <i class="fa fa-book"></i> <span>Setoran Hafalan Santri</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ request()->routeIs('jadwal-hafalan.*') ? 'active' : '' }}">
              <a href="{{ route('jadwal-hafalan.index') }}">
                <i class="fa fa-calendar"></i> <span>Jadwal Setoran</span>
              </a>
            </li>
    
            <li class="{{ request()->routeIs('pencatatan-hafalan.*') ? 'active' : '' }}">
              <a href="{{ route('pencatatan-hafalan.index') }}">
                <i class="fa fa-book"></i> <span>Pencatatan Setoran Hafalan</span>
              </a>
            </li>
    
            <li class="{{ request()->routeIs('rekap-hafalan.*') ? 'active' : '' }}">
              <a href="{{ route('rekap-hafalan.index') }}">
                <i class="fa fa-archive"></i> <span>Rekap Hafalan</span>
              </a>
            </li>
          </ul>
        </li> --}}

        {{-- <li class="treeview {{ request()->routeIs(['jadwal-ujian.*','pencatatan-ujian.*','ujian-tasmi.*']) ? 'active menu-open' : '' }}">
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Ujian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
          <ul class="treeview-menu" style="{{ request()->routeIs(['jadwal-ujian.*','pencatatan-ujian.*','ujian-tasmi.*']) ? 'display:block;' : '' }}">
            <li class="{{ request()->routeIs('jadwal-ujian.*') ? 'active' : '' }}">
              <a href="{{ route('jadwal-ujian.index') }}">
                <i class="fa fa-calendar"></i> <span>Jadwal Ujian</span>
              </a>
            </li>
    
            <li class="{{ request()->routeIs('pencatatan-ujian.*') ? 'active' : '' }}">
              <a href="{{ route('pencatatan-ujian.index') }}">
                <i class="fa fa-book"></i> <span>Ujian Akhir Semester</span>
              </a>
            </li>

            <li class="{{ request()->routeIs('ujian-tasmi.*') ? 'active' : '' }}">
              <a href="{{ route('ujian-tasmi.index') }}">
                <i class="fa fa-book"></i> <span>Ujian Tasmi</span>
              </a>
            </li>
          </ul>
        </li> --}}

        {{-- <li class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
          <a href="{{ route('laporan.index') }}">
            <i class="fa fa-file"></i> <span>Laporan Perkembangan Hafalan</span>
          </a>
        </li> --}}

        <li class="{{ request()->routeIs('manage-akun.*') ? 'active' : '' }}">
          <a href="{{ route('manage-akun.index') }}">
            <i class="fa fa-users"></i> <span>Manajemen Akun</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
          <a href="{{ route('pengaturan.index') }}">
            <i class="fa fa-cog"></i> <span>Pengaturan</span>
          </a>
        </li>

      </ul>
      @endif
      {{-- menu admin  --}}

      @if (Auth::user()->role === "santri")
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('absensi.*') ? 'active' : '' }}">
          <a href="{{ route('absensi.index') }}">
            <i class="fa fa-id-badge"></i> <span>Absensi</span>
          </a>
        </li>
        
          <li class="{{ request()->routeIs('jadwal-hafalan.*') ? 'active' : '' }}">
            <a href="{{ route('jadwal-hafalan.index') }}">
              <i class="fa fa-calendar"></i> <span>Jadwal Setoran</span>
            </a>
          </li>

          <li class="{{ request()->routeIs('pencatatan-hafalan.*') ? 'active' : '' }}">
            <a href="{{ route('pencatatan-hafalan.index') }}">
              <i class="fa fa-book"></i> <span>Setoran Hafalan Santri</span>
            </a>
          </li>

        {{-- <li class="treeview {{ request()->routeIs(['jadwal-hafalan.*','pencatatan-hafalan.*','rekap-hafalan.*']) ? 'active menu-open' : '' }}">
          <a href="#">
            <i class="fa fa-book"></i> <span>Setoran Hafalan Santri</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li> --}}

        {{-- <li class="{{ request()->routeIs('jadwal-ujian.*') ? 'active' : '' }}">
            <a href="{{ route('jadwal-ujian.index') }}">
              <i class="fa fa-calendar"></i> <span>Jadwal Ujian</span>
            </a>
          </li> --}}
  
          <li class="{{ request()->routeIs('pencatatan-ujian.*') ? 'active' : '' }}">
            <a href="{{ route('pencatatan-ujian.index') }}">
              <i class="fa fa-book"></i> <span>Ujian Akhir Semester</span>
            </a>
          </li>

          <li class="{{ request()->routeIs('ujian-tasmi.*') ? 'active' : '' }}">
            <a href="{{ route('ujian-tasmi.index') }}">
              <i class="fa fa-book"></i> <span>Ujian Tasmi</span>
            </a>
          </li>
        {{-- <li class="treeview {{ request()->routeIs(['jadwal-ujian.*','pencatatan-ujian.*','ujian-tasmi.*']) ? 'active menu-open' : '' }}">
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Ujian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
          <ul class="treeview-menu" style="{{ request()->routeIs(['jadwal-ujian.*','pencatatan-ujian.*','ujian-tasmi.*']) ? 'display:block;' : '' }}">
            <li class="{{ request()->routeIs('jadwal-ujian.*') ? 'active' : '' }}">
              <a href="{{ route('jadwal-ujian.index') }}">
                <i class="fa fa-calendar"></i> <span>Jadwal Ujian</span>
              </a>
            </li>
    
            <li class="{{ request()->routeIs('pencatatan-ujian.*') ? 'active' : '' }}">
              <a href="{{ route('pencatatan-ujian.index') }}">
                <i class="fa fa-book"></i> <span>Ujian Akhir Semester</span>
              </a>
            </li>

            <li class="{{ request()->routeIs('ujian-tasmi.*') ? 'active' : '' }}">
              <a href="{{ route('ujian-tasmi.index') }}">
                <i class="fa fa-book"></i> <span>Ujian Tasmi</span>
              </a>
            </li>
          </ul>
        </li> --}}

        <li class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
          <a href="{{ route('laporan.index') }}">
            <i class="fa fa-file"></i> <span>Laporan Perkembangan Hafalan</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
          <a href="{{ route('pengaturan.index') }}">
            <i class="fa fa-cog"></i> <span>Pengaturan</span>
          </a>
        </li>

      </ul>
      @endif
      
      @if (Auth::user()->role === "ustad")
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('absensi.*') ? 'active' : '' }}">
          <a href="{{ route('absensi.index') }}">
            <i class="fa fa-id-badge"></i> <span>Absensi</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('pencatatan-hafalan.*') ? 'active' : '' }}">
          <a href="{{ route('pencatatan-hafalan.index') }}">
            <i class="fa fa-book"></i> <span>Setoran Hafalan Santri</span>
          </a>
        </li>

        {{-- <li class="treeview {{ request()->routeIs(['jadwal-hafalan.*','pencatatan-hafalan.*','rekap-hafalan.*']) ? 'active menu-open' : '' }}">
          <a href="#">
            <i class="fa fa-book"></i> <span>Setoran Hafalan Santri</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ request()->routeIs('jadwal-hafalan.*') ? 'active' : '' }}">
              <a href="{{ route('jadwal-hafalan.index') }}">
                <i class="fa fa-calendar"></i> <span>Jadwal Setoran</span>
              </a>
            </li>
    
            <li class="{{ request()->routeIs('pencatatan-hafalan.*') ? 'active' : '' }}">
              <a href="{{ route('pencatatan-hafalan.index') }}">
                <i class="fa fa-book"></i> <span>Pencatatan Setoran Hafalan</span>
              </a>
            </li>
    
            <li class="{{ request()->routeIs('rekap-hafalan.*') ? 'active' : '' }}">
              <a href="{{ route('rekap-hafalan.index') }}">
                <i class="fa fa-archive"></i> <span>Rekap Hafalan</span>
              </a>
            </li>
          </ul>
        </li> --}}
         {{-- <li class="{{ request()->routeIs('jadwal-ujian.*') ? 'active' : '' }}">
            <a href="{{ route('jadwal-ujian.index') }}">
              <i class="fa fa-calendar"></i> <span>Jadwal Ujian</span>
            </a>
          </li> --}}
  
          <li class="{{ request()->routeIs('pencatatan-ujian.*') ? 'active' : '' }}">
            <a href="{{ route('pencatatan-ujian.index') }}">
              <i class="fa fa-book"></i> <span>Ujian Akhir Semester</span>
            </a>
          </li>

          <li class="{{ request()->routeIs('ujian-tasmi.*') ? 'active' : '' }}">
            <a href="{{ route('ujian-tasmi.index') }}">
              <i class="fa fa-book"></i> <span>Ujian Tasmi</span>
            </a>
          </li>

        {{-- <li class="treeview {{ request()->routeIs(['jadwal-ujian.*','pencatatan-ujian.*','ujian-tasmi.*']) ? 'active menu-open' : '' }}">
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Ujian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
          <ul class="treeview-menu" style="{{ request()->routeIs(['jadwal-ujian.*','pencatatan-ujian.*','ujian-tasmi.*']) ? 'display:block;' : '' }}">
            <li class="{{ request()->routeIs('jadwal-ujian.*') ? 'active' : '' }}">
              <a href="{{ route('jadwal-ujian.index') }}">
                <i class="fa fa-calendar"></i> <span>Jadwal Ujian</span>
              </a>
            </li>
    
            <li class="{{ request()->routeIs('pencatatan-ujian.*') ? 'active' : '' }}">
              <a href="{{ route('pencatatan-ujian.index') }}">
                <i class="fa fa-book"></i> <span>Ujian Akhir Semester</span>
              </a>
            </li>

            <li class="{{ request()->routeIs('ujian-tasmi.*') ? 'active' : '' }}">
              <a href="{{ route('ujian-tasmi.index') }}">
                <i class="fa fa-book"></i> <span>Ujian Tasmi</span>
              </a>
            </li>
          </ul>
        </li> --}}

        <li class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
          <a href="{{ route('laporan.index') }}">
            <i class="fa fa-file"></i> <span>Laporan Perkembangan Hafalan</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
          <a href="{{ route('pengaturan.index') }}">
            <i class="fa fa-cog"></i> <span>Pengaturan</span>
          </a>
        </li>

      </ul>
      @endif
      
      @if (Auth::user()->role === "walisantri")
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        {{-- <li class="{{ request()->routeIs('absensi.*') ? 'active' : '' }}">
          <a href="{{ route('absensi.index') }}">
            <i class="fa fa-id-badge"></i> <span>Absensi</span>
          </a>
        </li> --}}

        {{-- <li class="treeview {{ request()->routeIs(['jadwal-hafalan.*','pencatatan-hafalan.*','rekap-hafalan.*']) ? 'active menu-open' : '' }}">
          <a href="#">
            <i class="fa fa-book"></i> <span>Setoran Hafalan Santri</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ request()->routeIs('jadwal-hafalan.*') ? 'active' : '' }}">
              <a href="{{ route('jadwal-hafalan.index') }}">
                <i class="fa fa-calendar"></i> <span>Jadwal Setoran</span>
              </a>
            </li>
    
            <li class="{{ request()->routeIs('pencatatan-hafalan.*') ? 'active' : '' }}">
              <a href="{{ route('pencatatan-hafalan.index') }}">
                <i class="fa fa-book"></i> <span>Pencatatan Setoran Hafalan</span>
              </a>
            </li>
    
            <li class="{{ request()->routeIs('rekap-hafalan.*') ? 'active' : '' }}">
              <a href="{{ route('rekap-hafalan.index') }}">
                <i class="fa fa-archive"></i> <span>Rekap Hafalan</span>
              </a>
            </li>
          </ul>
        </li> --}}

        {{-- <li class="treeview {{ request()->routeIs(['jadwal-ujian.*','pencatatan-ujian.*','ujian-tasmi.*']) ? 'active menu-open' : '' }}">
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Ujian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
          <ul class="treeview-menu" style="{{ request()->routeIs(['jadwal-ujian.*','pencatatan-ujian.*','ujian-tasmi.*']) ? 'display:block;' : '' }}">
            <li class="{{ request()->routeIs('jadwal-ujian.*') ? 'active' : '' }}">
              <a href="{{ route('jadwal-ujian.index') }}">
                <i class="fa fa-calendar"></i> <span>Jadwal Ujian</span>
              </a>
            </li>
    
            <li class="{{ request()->routeIs('pencatatan-ujian.*') ? 'active' : '' }}">
              <a href="{{ route('pencatatan-ujian.index') }}">
                <i class="fa fa-book"></i> <span>Ujian Akhir Semester</span>
              </a>
            </li>

            <li class="{{ request()->routeIs('ujian-tasmi.*') ? 'active' : '' }}">
              <a href="{{ route('ujian-tasmi.index') }}">
                <i class="fa fa-book"></i> <span>Ujian Tasmi</span>
              </a>
            </li>
          </ul>
        </li> --}}

        <li class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
          <a href="{{ route('laporan.index') }}">
            <i class="fa fa-file"></i> <span>Laporan Perkembangan Hafalan</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
          <a href="{{ route('pengaturan.index') }}">
            <i class="fa fa-cog"></i> <span>Pengaturan</span>
          </a>
        </li>

      </ul>
      @endif

    </section>
    <!-- /.sidebar -->
  </aside>