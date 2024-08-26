<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-success">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/dist/img/KOS.png') }}" alt="AdminLTE Logo" class="brand-image"
            style="width: 40px; height: auto;">
        <span class="brand-text font-weight-bold">NAMA KOST</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img style="margin-top: 10px;" src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="/profile" class="d-block">Bahrul</a>
                <span class="right badge badge-success">Admin</span>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header">Menu Utama</li>

                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ $nama == 'dashboard' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/setting_gedung" class="nav-link {{ $nama == 'setting gedung' ? 'active' : '' }}">
                        <i class="far nav-icon fa-solid fa-building"></i>
                        <p>Setting Gedung</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/setting_ruangan" class="nav-link {{ $nama == 'setting ruangan' ? 'active' : '' }}">
                        <i class="far nav-icon fas fa-solid fa-door-closed"></i>
                        <p>Setting Ruangan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="penghuni_ruang" class="nav-link {{ $nama == 'penghuni' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon fas fa-users"></i>
                        <p>Penghuni</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="pindah_ruang" class="nav-link {{ $nama == 'pindah ruang' ? 'active' : '' }}">
                        <i class="far nav-icon fas fa-solid fa-door-open"></i>
                        <p>Pindah Ruangan</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="pembayaran" class="nav-link {{ $nama == 'pembayaran' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-money-bill-wave-alt"></i>
                        <p>Entry Pembayaran</p>
                    </a>
                </li>
                <li class="nav-header">Laporan</li>
                <li class="nav-item">
                    <a href="/tagihan" class="nav-link {{ $nama == 'tagihan' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-dollar-sign"></i>
                        <p>Tagihan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="rekap_pembayaran" class="nav-link">
                        <i class="fas nav-icon fa-calculator"></i>
                        <p>Grafik Penghuni</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="faktur" class="nav-link">
                        <i class="fas nav-icon fa-university"></i>
                        <p>Tingkat Hunian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/laporan_pendapatan" class="nav-link {{ $nama == 'laporan pendapatan' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-money-check"></i>
                        <p>Laporan Pendapatan</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
