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
                                        <li class="breadcrumb-item active">Add Users</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Form Edit    Users</h4>
                                    <div class="flex-shrink-0">
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                    <form action="user_update.php" method="post" enctype="multipart/form-data">
                                    <?php 
                                        $id = $_GET['id'];              
                                        $data = mysqli_query($koneksi, "select * from user where user_id='$id'");
                                        while($d = mysqli_fetch_array($data)){
                                        ?>
                                        <div class="mb-3">
                                            <label for="employeeName" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="nama" value="<?php echo $d['user_nama'] ?>" required="required">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $d['user_id'] ?>" required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label for="employeeUrl" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" value="<?php echo $d['user_username'] ?>" required="required" placeholder="Enter username">
                                            </div>
                                        <div class="mb-3">
                                            <label for="StartleaveDate" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" min="5" placeholder="Blank if you don't want to replace">
                                            </div>
                                        <div class="mb-3">
                                            <label for="customername-field" class="form-label">Foto Users</label>
                                            <span style="color: red; font-size: xx-small;">
                                                    File Allowed Only Format JPG, JPEG, GIF, PNG
                                                </span>
                                            <div class="card">
                                                <input class="form-control" required="required" type="file" name="foto" id="formFile" accept="image/png, image/jpeg, image/gif, image/jpg" required/>
                                                
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="EndleaveDate" class="form-label">Permission Roles</label>
                                            <select class="form-control" name="level" required="required">
                                                <option value=""> - Pilih Level - </option>
                                                <option <?php if($d['user_level'] == "Administrator"){echo "selected='selected'";} ?> value="Administrator"> Administrator </option>
                                                <option <?php if($d['user_level'] == "Manajemen"){echo "selected='selected'";} ?> value="Manajemen"> Manajemen </option>
                                            </select>
                                        </div>
                                        
                                                <div class="text-end">
                                                <a href="user.php" onclick="return true;"><button type="button" class="btn btn-primary">Cancel</button></a>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <?php } ?>
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
</html>