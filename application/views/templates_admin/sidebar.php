<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">KOPERASI BGR</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->

            <?php if(in_array('dashboard', $akses_menu) || $is_superadmin){ ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php } ?>
            
            <?php if(in_array('master_data', $akses_menu) || $is_superadmin){ ?>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <?php if(in_array('dataJabatan', $akses_menu) || $is_superadmin){ ?>
                            <a class="collapse-item" href="<?php echo base_url('dataJabatan') ?>">Data Jabatan</a>
                        <?php } ?>
                        
                        <?php if(in_array('dataPengurus', $akses_menu) || $is_superadmin){ ?>
                            <a class="collapse-item" href="<?php echo base_url('dataPengurus') ?>">Data Pengurus</a>
                        <?php } ?>

                        <?php if(in_array('dataAnggota', $akses_menu) || $is_superadmin){ ?>
                            <a class="collapse-item" href="<?php echo base_url('dataAnggota') ?>">Data Anggota</a>
                        <?php } ?>
                    </div>
                </div>
            </li>
            <?php } ?>
            
            <?php if(in_array('simpanan', $akses_menu) || $is_superadmin){ ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-wallet"></i>
                    <span>Simpanan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <?php if(in_array('simpananPokok', $akses_menu) || $is_superadmin){ ?>
                            <a class="collapse-item" href="<?php echo base_url('simpananPokok/simpanan') ?>">Simpanan Pokok</a>
                        <?php } ?>
                        <?php if(in_array('simpananWajib', $akses_menu) || $is_superadmin){ ?>
                            <a class="collapse-item" href="<?php echo base_url('simpananWajib/simpanan') ?>">Simpanan Wajib</a>
                        <?php } ?>
                        <?php if(in_array('simpananSukarela', $akses_menu) || $is_superadmin){ ?>
                            <a class="collapse-item" href="<?php echo base_url('simpananSukarela/simpanan') ?>">Simpanan Tabungan</a>
                        <?php } ?>
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php if(in_array('pinjaman', $akses_menu) || $is_superadmin){ ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('pinjaman') ?>">
                    <i class="fas fa-fw fa-money-check-alt"></i>
                    <span>Pinjaman</span>
                </a>
            </li>
            <?php } ?>
            
            <?php if(in_array('gantiPassword', $akses_menu) || $is_superadmin){ ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('gantiPassword') ?>">
                    <i class="fas fa-fw fa-lock"></i>
                    <span>Ubah Password</span>
                </a>
            </li>
            <?php } ?>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" onclick="return confirm('Yakin Untuk Logout?')" href="<?php echo base_url('login/logout') ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <H4 class="font-weight-bold ml-auto">KOPERASI BOGOR GADING RESIDENCE</H4>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat Datang <?php echo $this->session->userdata('nama_anggota') ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo base_url('assets/photo/').$this->session->userdata('photo') ?>">
                            </a>

                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->