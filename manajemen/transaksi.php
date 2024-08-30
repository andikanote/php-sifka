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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">List Transaction</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="listjs-table" id="customerList">
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm-auto">
                                                <div>
                                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i>Add Transaction</button>
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
                                                        <th data-sort="nomor" >No</th>
                                                        <th class="sort" data-sort="tanggal">Tanggal</th>
                                                        <th data-sort="kategori" width="10%">Kategori</th>
                                                        <th data-sort="keterangan">Keterangan</th>
                                                        <th data-sort="pemasukan" width="15%" >Pemasukan</th>
                                                        <th data-sort="pengeluaran" width="15%">Pengeluaran</th>
                                                        <th data-sort="pengeluaran" width="15%">Bukti Transaction</th>
                                                        <th data-sort="action" width="13%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    <?php 
                                                        include '../koneksi.php';
                                                        $no=1;
                                                        $data = mysqli_query($koneksi,"SELECT * FROM transaksi,kategori where kategori_id=transaksi_kategori order by transaksi_id desc");
                                                        while($d = mysqli_fetch_array($data)){
                                                    ?>
                                                    <tr>
                                                        <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary"></a></td>
                                                        <td class="customer_name"><center><?php echo $no++; ?></center></td>
                                                        <td class="customer_name"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
                                                        <td class="email">
                                                            <?php if($d['kategori_foto'] == ""){ ?>
                                                                <img src="../assets/pictures/kategori/default.png" swidth="25" height="25">
                                                                <?php }else{ ?>
                                                                <img src="<?php echo '../assets/pictures/kategori/' . $d['kategori_foto']; ?>" alt="<?php echo $d['kategori_foto']; ?>" width="25" height="25">
                                                                <?php } ?>
                                                            <?php echo $d['kategori']; ?> 
                                                        </td>
                                                        <td class="phone"><?php echo $d['transaksi_keterangan']; ?></td>
                                                        <td class="date">
                                                        <?php 
                                                            if($d['transaksi_jenis'] == "Pemasukan"){
                                                            echo "Rp. ".number_format($d['transaksi_nominal'])." ,-";
                                                            }else{
                                                            echo "-";
                                                            }
                                                        ?>
                                                        </td>
                                                        <td class="date">
                                                            <?php 
                                                                if($d['transaksi_jenis'] == "Pengeluaran"){
                                                                echo "Rp. ".number_format($d['transaksi_nominal'])." ,-";
                                                                }else{
                                                                echo "-";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="date">
                                                            <?php if($d['transaksi_foto'] != ""){ ?>
                                                                <img src="<?php echo '../assets/pictures/transaksi/' . $d['transaksi_foto']; ?>" alt="<?php echo $d['transaksi_foto']; ?>" width="40" height="40" onclick="showTransactionFoto(this.src)" />
                                                            <?php } ?>
                                                                <!-- The Transaction -->
                                                                <div id="myTransaction" class="Transaction">
                                                                <!-- <span class="close">&times;</span> -->
                                                                <img class="Transaction-content" id="img01">
                                                                </div>

                                                                <style>
                                                                .Transaction {
                                                                display: none; /* Hidden by default */
                                                                position: fixed; /* Stay in place */
                                                                z-index: 1; /* Sit on top */
                                                                padding-top: 100px; /* Location of the box */
                                                                left: 0;
                                                                top: 0;
                                                                width: 100%; /* Full width */
                                                                height: 100%; /* Full height */
                                                                overflow: auto; /* Enable scroll if needed */
                                                                
                                                                }

                                                                .Transaction-content {
                                                                margin: 20px;
                                                                width: 300px; /* Adjust the width here */
                                                                height: 280300pxpx; /* Adjust the height here */
                                                                border-radius: 5px;
                                                                position: absolute;
                                                                top: 50%;
                                                                left: 50%;
                                                                transform: translate(-50%, -50%);
                                                                }

                                                                .close {
                                                                color: #aaa;
                                                                float: right;
                                                                font-size: 28px;
                                                                font-weight: bold;
                                                                }

                                                                .close:hover,
                                                                .close:focus {
                                                                color: #000;
                                                                text-decoration: none;
                                                                cursor: pointer;
                                                                }
                                                                </style>

                                                            <script>
                                                                function showTransactionFoto(src) {
                                                                var Transaction = document.getElementById("myTransaction");
                                                                var img = document.getElementById("img01");
                                                                img.src = src;
                                                                Transaction.style.display = "block";
                                                                }

                                                                // Close the Transaction when the user clicks on <span class="close">×</span>
                                                                    // document.getElementsByClassName("close")[0].onclick = function() {
                                                                    // var Transaction = document.getElementById("myTransaction");
                                                                    // Transaction.style.display = "none";
                                                                    // }

                                                                // Close the Transaction when the user clicks anywhere outside the Transaction content
                                                                window.onclick = function(event) {
                                                                if (event.target == document.getElementById("myTransaction")) {
                                                                    document.getElementById("myTransaction").style.display = "none";
                                                                }
                                                                }
                                                            </script>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <!-- <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModalEdit">Edit</button> -->
                                                                <!-- Grids in modals -->
                                                                <button type="button" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#exampleModalEditTrx<?php echo $d['kategori_id'] ?>">
                                                                    Edit
                                                                </button>
                                                                <div class="modal fade" id="exampleModalEditTrx<?php echo $d['kategori_id'] ?>" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalgridLabel">Edit Transaction</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="transaksi_update.php" method="post" enctype="multipart/form-data">
                                                                                    <div class="mb-3">
                                                                                        <label for="customername-field" class="form-label">Input Date</label>
                                                                                        <input type="hidden" name="id" value="<?php echo $d['transaksi_id'] ?>">
                                                                                        <input type="date" name="tanggal" class="form-control" id="exampleInputdate" required="required" value="<?php echo $d['transaksi_tanggal'] ?>">
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="customername-field" class="form-label">Jenis</label>
                                                                                        <select name="jenis" style="width:100%" class="form-control" required="required">
                                                                                            <option value="">- Pilih -</option>
                                                                                            <option <?php if($d['transaksi_jenis'] == "Pemasukan"){echo "selected='selected'";} ?> value="Pemasukan">Pemasukan</option>
                                                                                            <option <?php if($d['transaksi_jenis'] == "Pengeluaran"){echo "selected='selected'";} ?> value="Pengeluaran">Pengeluaran</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="customername-field" class="form-label">Kategori</label>
                                                                                        <select name="kategori" style="width:100%" class="form-control" required="required">
                                                                                            <option value="">- Pilih -</option>
                                                                                            <?php 
                                                                                            $kategori = mysqli_query($koneksi,"SELECT * FROM kategori ORDER BY kategori ASC");
                                                                                            while($k = mysqli_fetch_array($kategori)){
                                                                                                ?>
                                                                                                <option <?php if($d['transaksi_kategori'] == $k['kategori_id']){echo "selected='selected'";} ?> value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                                                                                                <?php 
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="customername-field" class="form-label">Rekening Bank</label>
                                                                                        <select name="bank" class="form-control" required="required" style="width:100%">
                                                                                            <option value="">- Pilih -</option>
                                                                                            <?php 
                                                                                            $bank = mysqli_query($koneksi,"SELECT * FROM bank");
                                                                                            while($b = mysqli_fetch_array($bank)){
                                                                                                ?>
                                                                                                <option <?php if($d['transaksi_bank'] == $b['bank_id']){echo "selected='selected'";} ?> value="<?php echo $b['bank_id']; ?>"><?php echo $b['bank_nama']; ?></option>
                                                                                                <?php 
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="customername-field" class="form-label">Nominal</label>
                                                                                        <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['transaksi_nominal'] ?>">
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="customername-field" class="form-label">Keterangan</label>
                                                                                        <textarea name="keterangan" style="width:100%" class="form-control" rows="4"><?php echo $d['transaksi_keterangan'] ?></textarea>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="customername-field" class="form-label">Upload Bukti Transaction</label>
                                                                                        <span style="color: red; font-size: xx-small;">
                                                                                            File Allowed Only Format JPG, JPEG, GIF, PNG
                                                                                        </span>
                                                                                        <div class="card">
                                                                                            <input class="form-control" type="file" name="foto" id="formFile" accept="image/png, image/jpeg, image/gif, image/jpg"/>
                                                                                        </div>
                                                                                        <span style="color: red; font-size: xx-small;">
                                                                                            <b>*Abaikan Upload Bukti Transaksi Jika Tidak Ingin Mengubah!!</b>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <div class="hstack gap-2 justify-content-end">
                                                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                                                        </div>
                                                                                    </div><!--end col-->
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="remove">
                                                                    <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
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
                                                    <p class="text-muted mb-0">We've searched for the data you want, but we didn't find it for your search. more than 150+ Orders We did not find any orders for you search.</p>
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
            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form action="transaksi_act.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Input Date</label>
                                    <input type="date" name="tanggal" class="form-control" id="exampleInputdate" required="required" >
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Jenis</label>
                                    <select name="jenis" class="form-control" required="required">
                                        <option value="">- Jenis -</option>
                                        <option value="Pemasukan">Pemasukan</option>
                                        <option value="Pengeluaran">Pengeluaran</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Kategori</label>
                                    <select name="kategori" class="form-control" required="required">
                                        <option value="">- Pilih -</option>
                                    <?php 
                                        $kategori = mysqli_query($koneksi,"SELECT * FROM kategori ORDER BY kategori ASC");
                                        while($k = mysqli_fetch_array($kategori)){
                                            ?>
                                            <option value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                                            <?php 
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Rekening Bank</label>
                                    <select name="bank" class="form-control" required="required">
                                    <option value="">- Pilih -</option>
                                    <?php 
                                    $bank = mysqli_query($koneksi,"SELECT * FROM bank");
                                    while($b = mysqli_fetch_array($bank)){
                                        ?>
                                        <option value="<?php echo $b['bank_id']; ?>"><?php echo $b['bank_nama']; ?></option>
                                        <?php 
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Nominal</label>
                                    <input type="number" name="nominal" required="required" class="form-control" placeholder="Enter nominal ..">
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" required="required" class="form-control" rows="3"></textarea>

                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Upload Bukti Transaction</label>
                                    <span style="color: red; font-size: xx-small;">
                                                    File Allowed Only Format JPG, JPEG, GIF, PNG
                                                </span>
                                    <div class="card">
                                    <input class="form-control" required="required" type="file" name="foto" id="formFile" accept="image/png, image/jpeg, image/gif, image/jpg" required/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success" id="add-btn">Add Transaction</button>
                                    </div>
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