<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Management</title>
    <link href="assets/css/alert.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .greeting-card {
            display: none;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }

        .alert {
            padding: 15px;
            margin: 10px 0;
            border: 1px solid transparent;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .fade {
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .fade-out {
            opacity: 0;
        }
    </style>
    <?php
    session_start();
    include 'koneksi.php'
    ?>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-5">
        <h1 class="text-2xl font-bold mb-6 text-center">Transaction Management</h1>

        <!-- Greeting Card -->
        <!-- <div id="greeting-card" class="greeting-card bg-blue-100 p-4 rounded-md mb-6 text-center">
            <h2 class="text-xl font-semibold" id="greeting-message"></h2>
        </div> -->

        <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-4 mb-6">
            <button class="tab-button py-2 px-4 bg-blue-500 text-black rounded mb-2 sm:mb-0" data-target="#input-tab">Input Transaction</button>
            <button class="tab-button py-2 px-4 bg-gray-300 rounded" data-target="#data-tab">Data View Transaction</button>
        </div>

        <div id="input-tab" class="tab-content active">
            <?php
            include '../koneksi.php';

            if (isset($_GET['alert'])) {
                if ($_GET['alert'] === "sukses") {
                    echo "
            <div class='col-sm-12'>
                <div id='success-alert' class='alert alert-success fade'>
                    <i class='start-icon fas fa-check-circle faa-tada animated'></i>
                    <strong class='font__weight-semibold'>Berhasil,</strong>  Tambah data transaksi.
                </div>
            </div>
        ";
                }
            }
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var alert = document.getElementById('success-alert');
                    if (alert) {
                        setTimeout(function() {
                            alert.classList.add('fade-out');
                            setTimeout(function() {
                                alert.style.display = 'none';
                            }, 500); // Wait for fade-out transition to complete
                        }, 2000); // 2 seconds
                    }
                });
            </script>
            <br>
            <form action="err/transaksi_act.php" method="post" enctype="multipart/form-data">
                <div>
                    <label class="block text-sm font-medium">Input Date</label>
                    <!-- <input type="date" name="tanggal" class="form-control" id="exampleInputdate" required="required" > -->
                    <input type="date" name="tanggal" id="exampleInputdate" class="mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Select date" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Jenis Transaksi</label>
                    <select name="jenis" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                        <option value="">- Pilih Jenis Transaksi -</option>
                        <option>Pemasukan</option>
                        <option>Pengeluaran</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Kategori</label>
                    <select name="kategori" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                        <option value="">- Pilih Kategori -</option>
                        <?php
                        $kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                        while ($k = mysqli_fetch_array($kategori)) {
                        ?>
                            <option value="<?php echo htmlspecialchars($k['kategori_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($k['kategori'], ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Rekening Bank</label>
                    <select name="bank" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                        <option value="">- Pilih Bank Asal -</option>
                        <?php
                        $bank = mysqli_query($koneksi, "SELECT * FROM bank");
                        while ($b = mysqli_fetch_array($bank)) {
                        ?>
                            <option value="<?php echo htmlspecialchars($b['bank_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($b['bank_nama'], ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Nominal</label>
                    <input type="number" name="nominal" class="mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Enter nominal" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Keterangan Transaksi</label>
                    <textarea name="keterangan" class="mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Enter description" required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium">Upload Foto Transaksi</label>
                    <div id="drop-area" class="mt-1 border-2 border-dashed border-gray-300 rounded p-4 text-center">
                        <p>Drag & drop or <span class="text-blue-500 cursor-pointer" id="file-upload-text">select a file</span></p>
                        <input type="file" name="foto" id="fileElem" class="hidden" accept="image/png, image/jpeg, image/gif, image/jpg" capture="camera" required />
                    </div>
                    <div class="upload-info" style="font-size: 0.75rem; color: rgba(128, 128, 128, 0.5);">
                        Format File: JPG, JPEG, GIF, PNG
                    </div>
                </div>
                <script>
                    // Fungsi untuk mendeteksi jenis device
                    function isMobileDevice() {
                        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                    }

                    // Jika device yang digunakan adalah mobile, maka tambahkan event listener pada tombol open camera
                    if (isMobileDevice()) {
                        document.getElementById('open-camera').addEventListener('click', () => {
                            // Mengakses kamera menggunakan getUserMedia
                            navigator.mediaDevices.getUserMedia({
                                    video: true
                                })
                                .then(stream => {
                                    // Membuat elemen video untuk menampilkan stream kamera
                                    const video = document.createElement('video');
                                    video.srcObject = stream;
                                    video.play();

                                    // Membuat tombol untuk mengambil foto
                                    const takePictureButton = document.createElement('button');
                                    takePictureButton.textContent = 'Take Picture';

                                    // Mengambil foto dari stream kamera
                                    takePictureButton.addEventListener('click', () => {
                                        const canvas = document.createElement('canvas');
                                        canvas.width = video.videoWidth;
                                        canvas.height = video.videoHeight;
                                        const ctx = canvas.getContext('2d');
                                        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                                        // Mengubah foto menjadi blob
                                        canvas.toBlob(blob => {
                                            // Mengupload foto
                                            const fileInput = document.getElementById('formFile');
                                            fileInput.files = [blob];
                                        });
                                    });

                                    // Menambahkan elemen video dan tombol take picture ke halaman
                                    document.getElementById('fileElem').parentNode.appendChild(video);
                                    document.getElementById('fileElem').parentNode.appendChild(takePictureButton);
                                })
                                .catch(error => {
                                    // Tampilkan pesan error
                                    console.error('Error mengakses kamera:', error);
                                });
                        });
                    }
                </script>
                <div class="flex space-x-4">
                    <button type="reset" class="mt-4 py-2 px-4 bg-gray-300 text-black rounded w-full">Reset</button>
                    <button type="submit" class="mt-4 py-2 px-4 bg-green-500 text-white rounded w-full">Submit</button>
                </div>
            </form>
        </div>

        <script>
            const dropArea = document.getElementById('drop-area');
            const fileInput = document.getElementById('fileElem');
            const fileUploadText = document.getElementById('file-upload-text');

            dropArea.addEventListener('dragover', (event) => {
                event.preventDefault();
                dropArea.classList.add('bg-gray-100');
            });

            dropArea.addEventListener('dragleave', () => {
                dropArea.classList.remove('bg-gray-100');
            });

            dropArea.addEventListener('drop', (event) => {
                event.preventDefault();
                dropArea.classList.remove('bg-gray-100');
                const files = event.dataTransfer.files;
                if (files.length) {
                    fileInput.files = files;
                    dropArea.querySelector('p').textContent = files[0].name;
                }
            });

            fileUploadText.addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length) {
                    dropArea.querySelector('p').textContent = fileInput.files[0].name;
                }
            });
        </script>

        <style>
            #drop-area {
                transition: background-color 0.3s;
            }
        </style>

        <!-- =========================================================================================== -->

        <?php
        include 'koneksi.php';

        // Pagination logic
        $limit = 10; // Number of items per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Initialize filter variables
        $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
        $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

        // Base SQL query
        $sql = "SELECT * FROM transaksi, kategori WHERE kategori_id = transaksi_kategori";

        // Add date filtering if dates are provided
        if (!empty($startDate) && !empty($endDate)) {
            $sql .= " AND transaksi_tanggal BETWEEN '$startDate' AND '$endDate'";
        }

        // Fetch total number of transactions with filtering
        $totalResult = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM ($sql) AS filtered");
        $totalData = mysqli_fetch_assoc($totalResult);
        $totalPages = ceil($totalData['total'] / $limit);

        // Fetch transactions for the current page with filtering
        $sql .= " ORDER BY transaksi_id DESC LIMIT $limit OFFSET $offset";
        $data = mysqli_query($koneksi, $sql);
        ?>

        <div id="data-tab" class="tab-content mt-6">
            <h2 class="text-xl font-semibold mb-4">Data View Transaction</h2>

            <!-- Date Filter Form -->
            <form method="GET" class="mb-4 flex flex-col md:flex-row justify-between items-center rounded-lg">
                <div class="flex items-center mb-2 md:mb-0">
                    <label for="start_date" class="mr-2 font-medium">Start Date:</label>
                    <input type="date" name="start_date" value="<?php echo $startDate; ?>" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div class="flex items-center mb-2 md:mb-0">
                    <label for="end_date" class="mr-2 font-medium">End Date:</label>
                    <input type="date" name="end_date" value="<?php echo $endDate; ?>" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Filter</button>
                    <a href="?page=<?php echo $page; ?>" class="bg-gray-300 text-black px-4 py-2 rounded-lg hover:bg-gray-400 transition">Reset Filter</a>
                </div>
            </form>

            <div id="noDataMessage" class="text-red-500 mb-4 hidden">Maaf Data tidak ditemukan</div>

            <table class="min-w-full bg-white border border-gray-300 overflow-x-auto" id="transactionTable">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">No</th>
                        <th class="py-2 px-4 border-b">Tanggal</th>
                        <th class="py-2 px-4 border-b">Kategori Transaksi</th>
                        <th class="py-2 px-4 border-b">Keterangan Transaksi</th>
                        <th class="py-2 px-4 border-b">Pemasukan</th>
                        <th class="py-2 px-4 border-b">Pengeluaran</th>
                        <th class="py-2 px-4 border-b">Bukti Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $offset + 1; // Adjust the number for the current page
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                        <tr>
                            <td class="py-2 px-4 border-b text-center"><?php echo $no++; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
                            <td class="py-2 px-4 border-b text-center">
                                <div style="display: flex; align-items: center;">
                                    <?php if ($d['kategori_foto'] == "") { ?>
                                        <img src="assets/pictures/kategori/default.png" width="25" height="25" alt="Default Image">
                                    <?php } else { ?>
                                        <img src="<?php echo 'assets/pictures/kategori/' . $d['kategori_foto']; ?>" alt="<?php echo $d['kategori_foto']; ?>" width="25" height="25">
                                    <?php } ?>
                                    <span style="margin-left: 8px;"><?php echo $d['kategori']; ?></span>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $d['transaksi_keterangan']; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $d['transaksi_jenis'] == "Pemasukan" ? "Rp. " . number_format($d['transaksi_nominal']) : "-"; ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $d['transaksi_jenis'] == "Pengeluaran" ? "Rp. " . number_format($d['transaksi_nominal']) : "-"; ?></td>
                            <td class="py-2 px-4 border-b text-center">
                                <?php if ($d['transaksi_foto'] != "") { ?>
                                    <img src="<?php echo 'assets/pictures/transaksi/' . $d['transaksi_foto']; ?>" alt="<?php echo $d['transaksi_foto']; ?>" width="40" height="40" onclick="showTransactionFoto(this.src)" />
                                <?php } ?> 
                                <!-- The Transaction -->
                                <div id="myTransaction" class="Transaction">
                                    <!-- <span class="close">&times;</span> -->
                                    <img class="Transaction-content" id="img01">
                                </div>

                                <style>
                                    .Transaction {
                                        display: none;
                                        /* Hidden by default */
                                        position: fixed;
                                        /* Stay in place */
                                        z-index: 1;
                                        /* Sit on top */
                                        padding-top: 100px;
                                        /* Location of the box */
                                        left: 0;
                                        top: 0;
                                        width: 100%;
                                        /* Full width */
                                        height: 100%;
                                        /* Full height */
                                        overflow: auto;
                                        /* Enable scroll if needed */

                                    }

                                    .Transaction-content {
                                        margin: 20px;
                                        width: 300px;
                                        /* Adjust the width here */
                                        height: 280300pxpx;
                                        /* Adjust the height here */
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
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="flex justify-between mt-4" id="pagination">
                <button id="prevBtn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700" <?php if ($page <= 1) echo 'disabled'; ?> onclick="location.href='?page=<?php echo $page - 1; ?>&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>'">Previous</button>
                <span id="pageInfo" class="self-center">Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>
                <button id="nextBtn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700" <?php if ($page >= $totalPages) echo 'disabled'; ?> onclick="location.href='?page=<?php echo $page + 1; ?>&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>'">Next</button>
            </div>
        </div>

        <script>
            // Search functionality for Keterangan column
            document.getElementById('searchInput').addEventListener('keyup', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('#transactionTable tbody tr');
                let hasResults = false;

                rows.forEach(row => {
                    const keteranganCell = row.cells[3]; // Keterangan is the third cell (index 2)
                    const keteranganText = keteranganCell.textContent.toLowerCase();
                    if (keteranganText.includes(filter)) {
                        row.style.display = '';
                        hasResults = true; // At least one row matches
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Show or hide the "Data tidak ditemukan" message
                const noDataMessage = document.getElementById('noDataMessage');
                noDataMessage.style.display = hasResults ? 'none' : 'block';
            });

            // Existing pagination and rendering code...
        </script>

        <style>
            /* Simple styles for responsive table */
            @media (max-width: 600px) {
                table {
                    width: 100%;
                    display: block;
                    overflow-x: auto;
                }
            }

            /* Button styles */
            #pagination button {
                transition: background-color 0.3s;
            }
        </style>

        <style>
            /* Simple styles for responsive table */
            @media (max-width: 600px) {
                table {
                    width: 100%;
                    display: block;
                    overflow-x: auto;
                }
            }
        </style>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize datepicker
            flatpickr("#input-date", {
                dateFormat: "Y-m-d",
            });

            // Hide greeting card after 5 seconds
            setTimeout(function() {
                $('#greeting-card').fadeOut();
            }, 3000);

            // Load the selected tab from local storage
            const selectedTab = localStorage.getItem('selectedTab') || '#input-tab';
            $(".tab-content").removeClass("active");
            $(selectedTab).addClass("active");

            // Highlight the selected tab button
            $(".tab-button").removeClass("bg-blue-500").addClass("bg-gray-300");
            $(`.tab-button[data-target="${selectedTab}"]`).removeClass("bg-gray-300").addClass("bg-blue-500");

            // Tab switching
            $(".tab-button").click(function() {
                var target = $(this).data("target");
                $(".tab-content").removeClass("active");
                $(target).addClass("active");

                $(".tab-button").removeClass("bg-blue-500").addClass("bg-gray-300");
                $(this).removeClass("bg-gray-300").addClass("bg-blue-500");

                // Save the selected tab to local storage
                localStorage.setItem('selectedTab', target);
            });

            // Other existing JavaScript functionalities...
        });
    </script>
</body>

</html>