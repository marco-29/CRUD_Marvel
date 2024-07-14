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

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-marvel">
        <div class="container-fluid">
            <a href="<?php echo base_url()?>" class="navbar-brand d-none d-sm-block"><img src="<?php echo base_url('almacenamiento/logo/logo-nav.png'); ?>" alt="" class="img-fluid" width="100%"></a>
            <a href="<?php echo base_url()?>" class="navbar-brand d-block d-sm-none text-white">M.A.R.P</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <div class="row justify-content-end">
                    <div class="col-lg-2 col-md-2 col-2 text-end d-none d-sm-block"><a class="nav-link" href="<?php echo base_url('crud')?>" tabindex="-1" aria-disabled="true"><img src="<?php echo base_url('almacenamiento/recursos/btn-crud.png') ?>" alt="" class="img-fluid" width="100%"></a></div>
                    <div class="col-lg-2 col-md-2 col-2 me-3 d-none d-sm-block"><a class="nav-link" href="#" tabindex="-1" aria-disabled="true"><img src="<?php echo base_url('almacenamiento/recursos/btn-doc.png') ?>" alt="" class="img-fluid" width="100%"></a></div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-6 text-end d-block d-sm-none"><a class="nav-link" href="<?php echo base_url('crud')?>" tabindex="-1" aria-disabled="true"><img src="<?php echo base_url('almacenamiento/recursos/btn-crud.png') ?>" alt="" class="img-fluid" width="100%"></a></div>
                    <div class="col-lg-2 col-md-2 col-6 text-end d-block d-sm-none"><a class="nav-link" href="#" tabindex="-1" aria-disabled="true"><img src="<?php echo base_url('almacenamiento/recursos/btn-doc.png') ?>" alt="" class="img-fluid" width="100%"></a></div>
                </div>
            </div>
        </div>
    </nav>