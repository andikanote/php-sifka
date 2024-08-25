<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<div id="scrollbar">
    <?php include 'sidebar.php'; ?>
    <!-- Sidebar -->
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
                        <h4 class="mb-sm-0">Data Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Data Category</a></li>
                                <li class="breadcrumb-item active">Category List</li>
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
                            <strong>Sukses!</strong> Data category telah ditambahkan.
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
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Category List</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModalAdd"><i class="ri-add-line align-bottom me-1"></i> Add Category</button>
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
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="customer_name" width="8%">No</th>
                                                <th class="sort" data-sort="email">Image</th>
                                                <th class="sort" data-sort="email">Nama</th>
                                                <th class="sort" data-sort="action" width="20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <?php
                                            include '../koneksi.php';
                                            $no = 1;
                                            $data = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                                            while ($d = mysqli_fetch_array($data)) {
                                            ?>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                        </div>
                                                    </th>
                                                    <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                    <td class="customer_name"><?php echo $no++; ?></td>
                                                    <td class="customer_name">
                                                    <?php if($d['kategori_foto'] == ""){ ?>
                                                        <img src="../assets/pictures/kategori/default.png" swidth="40" height="40">
                                                        <?php }else{ ?>
                                                        <img src="<?php echo '../assets/pictures/kategori/' . $d['kategori_foto']; ?>" alt="<?php echo $d['kategori_foto']; ?>" width="40" height="40">
                                                        <?php } ?>
                                                    </td>
                                                    <td class="email"><?php echo $d['kategori']; ?></td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <!-- <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModalEdit">Edit</button> -->
                                                                <!-- Grids in modals -->
                                                                <button type="button" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#exampleModalEdit<?php echo $d['kategori_id'] ?>">
                                                                    Edit
                                                                </button>
                                                                <div class="modal fade" id="exampleModalEdit<?php echo $d['kategori_id'] ?>" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalgridLabel">Edit Category</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                            <form action="kategori_update.php" method="post" enctype="multipart/form-data">
                                                                                    <div class="row g-3">
                                                                                        <div class="col-xxl-6">
                                                                                            <div>
                                                                                                <label for="firstName" class="form-label">Category Name</label>
                                                                                                <input type="hidden" name="id" required="required" class="form-control" placeholder="Nama Kategori .." value="<?php echo $d['kategori_id']; ?>">
                                                                                                <input type="text" name="kategori" required="required" class="form-control" placeholder="Nama Kategori .." value="<?php echo $d['kategori']; ?>" style="width:100%">   
                                                                                            </div>
                                                                                            <div>
                                                                                                <br>
                                                                                                <label for="firstName" class="form-label">Foto Category</label>
                                                                                                <div class="card">
                                                                                                <input class="form-control" type="file" name="foto" id="formFile" accept="image/png, image/jpeg, image/gif, image/jpg"  />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="hstack gap-2 justify-content-end">
                                                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                                            </div>
                                                                                        </div><!--end col-->
                                                                                    </div><!--end row-->
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="remove">
                                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal<?php echo $d['kategori_id'] ?>">Delete</button>
                                                                <!-- Modal -->
                                                                <div class="modal fade zoomIn" id="deleteRecordModal<?php echo $d['kategori_id'] ?>" tabindex="-1" aria-hidden="true">
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
                                                                                            window.location.href = 'kategori_hapus.php?id=<?php echo $d['kategori_id'] ?>';
                                                                                            }">
                                                                                    Yes, Delete It!
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end modal -->
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
                                            <p class="text-muted mb-0">We've searched Category We did not find any orders for you Category.</p>
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
            <!-- end row -->

            <!-- start Modal Add Category -->
            <div class="modal fade" id="showModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form action="kategori_act.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Category Name</label>
                                    <input type="text" name="kategori" required="required" class="form-control" placeholder="Enter category name .." required />
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Foto Category</label>
                                    <div class="card">
                                        <input class="form-control" type="file" name="foto" id="formFile" accept="image/png, image/jpeg, image/gif, image/jpg"  />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success" id="add-btn">Add Category</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal Add Category -->

    </div>
    <?php include 'footer.php'; ?>
</div>
</div>
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
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