<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD MARVEL</title>
    <meta property="og:title" content="diufo">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://diufo-tesis.000webhostapp.com/">
    <meta property="og:image" content="<?php echo base_url('almacenamiento/recursos/og.jpg'); ?>">
    <meta property="og:site_name" content="diufo-tesis.000webhostapp.com">
    <meta property="og:description" content="DIUFO software para niños con transtorno de dislexia fonologica">

    <link rel="apple-touch-icon" href="<?php echo base_url('almacenamiento/logo/logo.png'); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>almacenamiento/logo/logo.png">

    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/estlos.css'); ?>">
</head>

<body class="bg-marvel">
    <section class="mt-5">
        <div class="container p-5">
            <div class="row d-none d-sm-block">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <img src="<?php echo base_url('almacenamiento/logo/logo.png') ?>" alt="" class="img-fluid" width="30%">
                </div>
                <div class="row col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center mt-5">
                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                        <a href="<?php echo base_url('crud')?>"><img src="<?php echo base_url('almacenamiento/recursos/btn-crud.png') ?>" alt="" class="img-fluid float-end" width="50%"></a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                        <a href=""><img src="<?php echo base_url('almacenamiento/recursos/btn-doc.png') ?>" alt="" class="img-fluid float-start" width="50%"></a>
                    </div>
                </div>
            </div>
            <div class="row d-block d-sm-none">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <img src="<?php echo base_url('almacenamiento/logo/logo.png') ?>" alt="" class="img-fluid" width="70%">
                </div>
                <div class="row col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center mt-5">
                    <div class="col-lg-6 col-md-6 col-6 text-center">
                        <a href="<?php echo base_url('crud')?>"><img src="<?php echo base_url('almacenamiento/recursos/btn-crud.png') ?>" alt="" class="img-fluid"></a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 text-center">
                        <a href=""><img src="<?php echo base_url('almacenamiento/recursos/btn-doc.png') ?>" alt="" class="img-fluid"></a>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>