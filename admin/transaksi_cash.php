<?php include 'header.php'; ?>
    <?php include 'navbar.php'; ?>

            <div id="scrollbar">
            <?php include 'sidebar.php'; ?>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">List Transaction</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Transaction</a></li>
                                        <li class="breadcrumb-item active">List Transaction</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Responsive Tables</h4>
                                    <div class="flex-shrink-0">
                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col" style="width: 42px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="responsivetableCheck">
                                                                <label class="form-check-label" for="responsivetableCheck"></label>
                                                            </div>
                                                        </th>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Category</th>
                                                        <th scope="col">Pemasukan</th>
                                                        <th scope="col">Pengeluara</th>
                                                        <th scope="col">Revenue</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="responsivetableCheck01">
                                                                <label class="form-check-label" for="responsivetableCheck01"></label>
                                                            </div>
                                                        </th>
                                                        <td><a href="#" class="fw-medium">#VZ2110</a></td>
                                                        <td>10 Oct, 14:47</td>
                                                        <td class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i> Paid</td>
                                                        <td>
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <div class="flex-shrink-0">
                                                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-circle" />
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    Jordan Kennedy
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Mastering the grid</td>
                                                        <td>$9.98</td>
                                                    </tr>

                                                </tbody>
                                                <tfoot class="table-light">
                                                    <tr>
                                                        <td colspan="6">Total</td>
                                                        <td>$947.55</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <!-- end table -->
                                        </div>
                                        <!-- end table responsive -->
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                         </div>
                         </div>       
            </div>
            <!-- End Page-content -->

            <?php include 'footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <script src="../assets/libs/feather-icons/feather.min.js"></script>
    <script src="../assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <!-- prismjs plugin -->
    <script src="../assets/libs/prismjs/prism.js"></script>
    <script src="../assets/libs/list.js/list.min.js"></script>
    <script src="../assets/libs/list.pagination.js/list.pagination.min.js"></script>

    <!-- listjs init -->
    <script src="../assets/js/pages/listjs.init.js"></script>

    <!-- Sweet Alerts js -->
    <script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.js"></script>
</body>


</html>