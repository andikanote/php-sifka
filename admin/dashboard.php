<div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row h-100">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="row align-items-end">
                                                    <div class="col-sm-8">
                                                        <div class="p-3">
                                                            <?php
                                                                $id_user = $_SESSION['id'];
                                                                $profil = mysqli_query($koneksi, "select * from user where user_id='$id_user'");
                                                                $profil = mysqli_fetch_assoc($profil);
                                                                date_default_timezone_set('Asia/Jakarta');
                                                                $Hour = date('G');
                                                                if ( $Hour >= 5 && $Hour <= 11 ) {
                                                                    echo "<span style='font-weight: bold; font-size: 20px;'>Good Morning</span>";
                                                                } else if ( $Hour >= 12 && $Hour <= 18 ) {
                                                                    echo "<span style='font-weight: bold; font-size: 20px;'>Good Afternoon</span>";
                                                                } else if ( $Hour >= 19 || $Hour <= 4 ) {
                                                                    echo "<span style='font-weight: bold; font-size: 20px;'>Good Evening</span>";
                                                                }
                                                            ?>
                                                            <p class="fs-16 lh-base">Hello! <span class="fw-semibold"><?php echo $_SESSION['nama']; ?></span> <i class="mdi mdi-arrow-right"></i></p>
                                                            <p class="fs-16 lh-base"><strong>Save</strong> your earnings so that you can use them for your future.</i></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                    <br>
                                                        <div class="px-2">
                                                            <img src="../assets/images/user-illustarator-2.png" class="img-fluid" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end card-body-->
                                        </div>
                                    </div> <!-- end col-->
                                </div> <!-- end row-->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card crm-widget">
                                <div class="card-body p-0">
                                    <div class="row row-cols-md-3 row-cols-1">
                                        <div class="col col-lg border-end">
                                            <div class="mt-3 mt-md-0 py-4 px-3">
                                                <h5 class="text-muted text-uppercase fs-13">Pemasukan Harian <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-exchange-dollar-line display-6 text-muted"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h2 class="mb-0">Rp<span class="counter-value" data-target="100000000">0</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col col-lg border-end">
                                            <div class="mt-3 mt-md-0 py-4 px-3">
                                                <h5 class="text-muted text-uppercase fs-13">Pemasukan Bulanan <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-exchange-dollar-line display-6 text-muted"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h2 class="mb-0">Rp<span class="counter-value" data-target="100000000">0</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col col-lg border-end">
                                            <div class="mt-3 mt-md-0 py-4 px-3">
                                                <h5 class="text-muted text-uppercase fs-13">Pemasukan Tahunan <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-exchange-dollar-line display-6 text-muted"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h2 class="mb-0">Rp<span class="counter-value" data-target="100000000">0</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row -->
                    

                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Balance Overview</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Last Week</a>
                                                <a class="dropdown-item" href="#">Last Month</a>
                                                <a class="dropdown-item" href="#">Current Year</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body px-0">
                                    <ul class="list-inline main-chart text-center mb-0">
                                        <li class="list-inline-item chart-border-left me-0 border-0">
                                        <span class="text-muted d-inline-block fs-13 align-middle ms-2">Pemasukan</span>
                                            <h4 class="text-primary">Rp. 100.000.000 </h4>
                                        </li>
                                        <li class="list-inline-item chart-border-left me-0">
                                        <span class="text-muted d-inline-block fs-13 align-middle ms-2">Pengeluaran</span>
                                            <h4 class="text-primary">Rp. 100.000.000 </h4>
                                        </li>
                                    </ul>

                                    <div id="revenue-expenses-charts" data-colors='["--vz-success", "--vz-danger"]' data-colors-minimal='["--vz-primary", "--vz-info"]' data-colors-interactive='["--vz-info", "--vz-primary"]' data-colors-galaxy='["--vz-primary", "--vz-secondary"]' data-colors-classic='["--vz-primary", "--vz-secondary"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <?php include 'footer.php'; ?>
        </div>