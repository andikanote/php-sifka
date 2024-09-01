<?php include 'header.php'; ?>
    <?php include 'navbar.php'; ?>
            <div id="scrollbar">
                <div class="container-fluid">
                <?php include 'sidebar.php'; ?>
                </div>
           </div>
            <div class="sidebar-background"></div>
        </div>
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
                                <h4 class="mb-sm-0">Users</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Management Users</a></li>
                                        <li class="breadcrumb-item active">List Users</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <?php
                        include '../koneksi.php';
                        if (isset($_GET['alert'])) {
                            if ($_GET['alert'] == "sukses") {
                            echo 
                            "
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Sukses!</strong> Data user telah ditambahkan.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            
                            </div>
                            ";
                        } else if ($_GET['alert'] == "edit") {
                            echo 
                            "
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Sukses!</strong> Data user telah diedit.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            
                            </div>
                            ";
                        } else if ($_GET['alert'] == "hapus") {
                            echo 
                            "
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Sukses!</strong> Data user telah dihapus.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            
                            </div>
                            ";
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" id="userList">
                                <div class="card-header border-bottom-dashed">

                                    <div class="row g-4 align-items-center">
                                        <div class="col-sm">
                                            <div>
                                                <h5 class="card-title mb-0">Users List</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="d-flex flex-wrap align-items-start gap-2">
                                            <button type="button" class="btn btn-success add-btn" onclick="location.href='user_tambah.php';"><i class="ri-add-line align-bottom me-1"></i> Add user</button>                                                <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> Import</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive table-card mb-1">
                                            <table class="table align-middle" id="userTable">
                                                <thead class="table-light text-muted">
                                                    <tr>
                                                        <th scope="col" style="width: 50px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                            </div>
                                                        </th>

                                                        <th class="sort" data-sort="user_name">Nama</th>
                                                        <th class="sort" data-sort="email">Username</th>
                                                        <th class="sort" data-sort="phone">Level</th>
                                                        <th class="sort" data-sort="date">Foto</th>
                                                        <th class="sort" data-sort="action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    <?php 
                                                        include '../koneksi.php';
                                                        $no=1;
                                                        $data = mysqli_query($koneksi,"SELECT * FROM user");
                                                        while($d = mysqli_fetch_array($data)){
                                                    ?>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                            </div>
                                                        </th>
                                                        <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                        <td class="user_name"><?php echo $d['user_nama']; ?></td>
                                                        <td class="email"><?php echo $d['user_username']; ?></td>
                                                        <td class="status">
                                                            <?php
                                                                if ($d['user_level'] == 'Administrator') {
                                                                    echo '<span class="badge bg-danger text-white text-uppercase">' . $d['user_level'] . '</span>';
                                                                } elseif ($d['user_level'] == 'Manajemen') {
                                                                    echo '<span class="badge bg-info text-white text-uppercase">' . $d['user_level'] . '</span>';
                                                                } else {
                                                                    echo $d['user_level'];
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="date">
                                                        <center>
                                                        <?php if($d['user_foto'] == ""){ ?>
                                                            <div style="width: 50px; height: 50px; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;">
                                                                <img src="../assets/pictures/user.png" style="width: 100%; height: 100%; object-fit: cover;">
                                                            </div>
                                                        <?php }else{ ?>
                                                            <div style="width: 50px; height: 50px; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;">
                                                                <img src="../assets/pictures/<?php echo $d['user_foto']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                                            </div>
                                                        <?php } ?>
                                                        </center>
                                                        </td>
                                                        <!-- <td class="status"><span class="badge bg-success-subtle text-success text-uppercase">Active</span> -->
                                                        </td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item edit">
                                                                    <a href="user_edit.php?id=<?php echo $d['user_id'] ?>" class="text-primary d-inline-block edit-item-btn">
                                                                        <i class="ri-pencil-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                                <?php if($d['user_id'] != 1){ ?>
                                                                <li class="list-inline-item"">
                                                                    <a class="text-danger d-inline-block remove-item-btn" 
                                                                        href="user_hapus.php?id=<?php echo $d['user_id'] ?>">
                                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>                                            
                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                    <p class="text-muted mb-0">We've searched for the data you want, but we didn't find it for your search. user We did not find any user for you search.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" id="deleteRecord-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mt-2 text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                            <h4>Are you sure ?</h4>
                                                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record ?</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn w-sm btn-danger" id="delete-record">Yes, Delete It!</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end modal -->
                                </div>
                            </div>

                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
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

    <!-- list.js min js -->
    <script src="../assets/libs/list.js/list.min.js"></script>
    <script src="../assets/libs/list.pagination.js/list.pagination.min.js"></script>

    <!--ecommerce-user init js -->
    <script src="../assets/js/pages/ecommerce-user-list.init.js"></script>

    <!-- Sweet Alerts js -->
    <script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.js"></script>
</body>


</html>