<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="assets/css/alert.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

</head>

<body>
    <section>
        <div class="square_box box_three"></div>
        <div class="square_box box_four"></div>
        <div class="container mt-5">
            <div class="row">

                <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-success alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show">
                        <button type="button" class="close font__size-18" data-dismiss="alert">
                            <span aria-hidden="true"><a>
                                    <i class="fa fa-times greencross"></i>
                                </a></span>
                            <span class="sr-only">Close</span>
                        </button>
                        <i class="start-icon far fa-check-circle faa-tada animated"></i>
                        <strong class="font__weight-semibold">Sukses,</strong> Tambah data transaksi.
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-info alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
                        <button type="button" class="close font__size-18" data-dismiss="alert">
                            <span aria-hidden="true">
                                <i class="fa fa-times blue-cross"></i>
                            </span>
                            <span class="sr-only">Close</span>
                        </button>
                        <i class="start-icon  fa fa-info-circle faa-shake animated"></i>
                        <strong class="font__weight-semibold">Heads up!</strong> This alert needs your attention, but it's not super important.
                    </div>

                </div>

                <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-warning alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
                        <button type="button" class="close font__size-18" data-dismiss="alert">
                            <span aria-hidden="true">
                                <i class="fa fa-times warning"></i>
                            </span>
                            <span class="sr-only">Close</span>
                        </button>
                        <i class="start-icon fa fa-exclamation-triangle faa-flash animated"></i>
                        <strong class="font__weight-semibold">Warning!</strong> Better check yourself, you're not looking too good.
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
                        <button type="button" class="close font__size-18" data-dismiss="alert">
                            <span aria-hidden="true">
                                <i class="fa fa-times danger "></i>
                            </span>
                            <span class="sr-only">Close</span>
                        </button>
                        <i class="start-icon far fa-times-circle faa-pulse animated"></i>
                        <strong class="font__weight-semibold">Oh snap!</strong> Change a few things up and try submitting again.
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-primary alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
                        <button type="button" class="close font__size-18" data-dismiss="alert">
                            <span aria-hidden="true"><i class="fa fa-times alertprimary"></i></span>
                            <span class="sr-only">Close</span>
                        </button>
                        <i class="start-icon fa fa-thumbs-up faa-bounce animated"></i>
                        <strong class="font__weight-semibold">Well done!</strong> You successfullyread this important.
                    </div>

                </div>

            </div>
        </div>
    </section>

</body>