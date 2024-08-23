<?php include 'header.php'; ?>
    <?php include 'navbar.php'; ?>
            <div id="scrollbar">
                <div class="container-fluid">
                    <?php include 'sidebar.php'; ?>
                    </div>
                    
                </div>
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
                                <h4 class="mb-sm-0">Management User</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                        <li class="breadcrumb-item active">Change Password</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xxl-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Form Change Password</h4>
                                    <div class="flex-shrink-0">
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="gantipassword_act.php" method="post">
                                            <div class="row">
                                                <div class="col-md-12">
                                                <?php 
                                                    if(isset($_GET['alert'])){
                                                    if($_GET['alert'] == "sukses"){
                                                        echo "<div class='alert alert-success'>Password anda berhasil diganti!</div>";
                                                    }
                                                    }
                                                ?>
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Change Password</label>
                                                        <input type="password" class="form-control" placeholder="Input new password .." name="password" required="required" min="5">
                                                        </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                    <div class="d-none code-view">
                                        <pre class="language-markup" style="height: 375px;">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                </div> <!-- container-fluid -->
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

    <!-- JAVASCRIPT -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <script src="../assets/libs/feather-icons/feather.min.js"></script>
    <script src="../assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="../assets/js/plugins.js"></script>

    <!-- prismjs plugin -->
    <script src="../assets/libs/prismjs/prism.js"></script>

    <script src="../assets/js/app.js"></script>

</body>


<!-- Mirrored from themesbrand.com/velzon/html/master/forms-layouts.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 07:47:43 GMT -->
</html>