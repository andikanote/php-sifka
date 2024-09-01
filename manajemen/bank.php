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
                                <h4 class="mb-sm-0">List Bank</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Bank</a></li>
                                        <li class="breadcrumb-item active">List Bank</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">List Bank</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="listjs-table" id="customerList">
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm-auto">
                                                <div>
                                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModalAdd"><i class="ri-add-line align-bottom me-1"></i>Add Bank</button>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="d-flex justify-content-sm-end">
                                                    <div class="search-box ms-2">
                                                        <input type="text" class="form-control search" placeholder="Search...">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive table-card mt-3 mb-1">
                                            <table class="table align-middle table-nowrap" id="customerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th data-sort="namaBank" style="text-align: center;" width="15%">Nama Bank</th>
                                                        <th data-sort="pemilikRekening" width="15%">Pemilik Rekening</th>
                                                        <th data-sort="noRekening" width="10%">No Rekening</th>
                                                        <th data-sort="saldo" width="15%">Saldo</th>
                                                        <th data-sort="saldo" width="15%">CreatedAt</th>
                                                        <th data-sort="saldo" width="15%">UpdateAt</th>
                                                        <th data-sort="action" width="25%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    <?php 
                                                        include '../koneksi.php';
                                                        $no=1;
                                                        $data = mysqli_query($koneksi,"SELECT * FROM list_bank, bank WHERE list_bank_name=bank_nama ORDER BY bank_id DESC");
                                                        while($d = mysqli_fetch_array($data)){
                                                    ?>
                                                        <tr>
                                                            <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary"></a></td>
                                                            <td class="customer_name" style="text-align: center;"><?php echo $d['bank_nama']; ?></td>
                                                            <td class="email"><?php echo $d['bank_pemilik']; ?></td>
                                                            <td class="phone"><?php echo $d['bank_nomor']; ?></td>
                                                            <td class="date"><?php echo "Rp. ".number_format($d['bank_saldo'])." ,-"; ?></td>
                                                            <td class="date"><?php echo date_format(date_create($d['created_at']), 'd-m-Y H:i:s'); ?></td>
                                                            <td class="date">
                                                                <?php 
                                                                if (is_null($d['update_at'])) {
                                                                    echo '-';
                                                                } else {
                                                                    echo date_format(date_create($d['update_at']), 'd-m-Y H:i:s'); 
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                <button type="button" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#exampleModalEdit<?php echo $d['bank_id'] ?>">
                                                                    Edit
                                                                </button>
                                                                <div class="modal fade" id="exampleModalEdit<?php echo $d['bank_id'] ?>" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalgridLabel">Edit Bank</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="bank_update.php" method="post">
                                                                                    <div class="mb-3">
                                                                                        <label for="employeeName" class="form-label">Nama Bank</label>
                                                                                        <input type="hidden" name="id" value="<?php echo $d['bank_id'] ?>">
                                                                                        <select name="nama" style="width:100%" class="form-control" required="required">
                                                                                            <option value="">-- Pilih Bank --</option>
                                                                                            <?php 
                                                                                                $listbank = mysqli_query($koneksi, "SELECT * FROM list_bank ORDER BY list_bank_name");
                                                                                                while($list = mysqli_fetch_array($listbank)){
                                                                                                    ?>
                                                                                                    <option <?php if($d['bank_nama'] == $list['list_bank_name']){echo "selected='selected'";} ?> value="<?php echo $list['list_bank_name']; ?>"><?php echo $list['list_bank_name']; ?></option>
                                                                                                    <?php 
                                                                                                }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="employeeName" class="form-label">Nama Pemilik Rekening Bank</label>
                                                                                        <input type="text" name="pemilik" style="width:100%" class="form-control" placeholder="Nama pemiliki rekening bank .." value="<?php echo $d['bank_pemilik']; ?>">
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="employeeName" class="form-label">Nomor Rekening Bank</label>
                                                                                        <input type="text" name="nomor" style="width:100%" class="form-control" placeholder="Nomor rekening bank .." value="<?php echo $d['bank_nomor']; ?>">
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="employeeName" class="form-label">Saldo Awal</label>
                                                                                        <input type="number" name="saldo" style="width:100%" required="required" class="form-control" placeholder="Saldo bank .." value="<?php echo $d['bank_saldo']; ?>">
                                                                                    </div>
                                                                                    <div class="text-end">
                                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="remove">
                                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal<?php echo $d['bank_id'] ?>">Remove</button>
                                                                <!-- Modal -->
                                                                <div class="modal fade zoomIn" id="deleteRecordModal<?php echo $d['bank_id'] ?>" tabindex="-1" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="mt-2 text-center">
                                                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                                                                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                                        <h4>Are you Sure ?</h4>
                                                                                        <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="button" class="btn w-sm btn-danger" id="delete-record" 
                                                                                            onclick="if (confirm('Are you Sure You want to Remove this Record ?')) {
                                                                                            window.location.href = 'bank_hapus.php?id=<?php echo $d['bank_id'] ?>';
                                                                                            }">
                                                                                    Yes, Delete It!
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                            
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                                    <p class="text-muted mb-0">We've searched for the data you want, but we didn't find it for your search.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <div class="pagination-wrap hstack gap-2">
                                                <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                                    Previous
                                                </a>
                                                <ul class="pagination listjs-pagination mb-0"></ul>
                                                <a class="page-item pagination-next" href="javascript:void(0);">
                                                    Next
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end col -->
                    </div>
            </div>
            <!-- End Page-content -->
            <!-- start Modal Add Category -->
            <div class="modal fade" id="showModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form action="bank_act.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Nama Bank</label>
                                    <select name="nama" class="form-control" required="required">
                                        <option value="">- Pilih Bank-</option>
                                        <?php 
                                            $banklist = mysqli_query($koneksi,"SELECT * FROM list_bank ORDER BY list_bank_name");
                                            while($k = mysqli_fetch_array($banklist)){
                                                ?>
                                                <option value="<?php echo $k['list_bank_name']; ?>"><?php echo $k['list_bank_name']; ?></option>
                                                <?php 
                                            }
                                        ?>
                                    </select>
                                    </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Nama Pemilik Rekening</label>
                                    <input type="text" name="pemilik" class="form-control" placeholder="Nama pemiliki rekening bank ..">
                                    </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Nomor Rekening</label>
                                    <input type="text" name="nomor" class="form-control" placeholder="Nomor rekening bank ..">
                                    </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Saldo Awal Rekening</label>
                                    <input type="number" name="saldo" required="required" class="form-control" placeholder="Saldo bank ..">
                                    </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success" id="add-btn">Add Bank</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal Add Category -->

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