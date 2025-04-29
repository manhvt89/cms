<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="description" content="<?= $meta_description ?>">
    <meta name="keywords" content="<?= $meta_keywords ?>">
    <title><?= $meta_title ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('uploads/'.$setting['favicon']) ?>">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= base_url('public/css/animate.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/magnific-popup.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/toastr.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/style.css') ?>">
    
    <?php if(session('sess_layout_direction') == 'Right'): ?>
    <link rel="stylesheet" href="<?= base_url('public/css/rtl.css') ?>">
    <?php endif; ?>

    <!-- Dynamic Color Styles -->
    <style>
        .header-area,
        .footer-item h3:before,
        .footer-item h3:after {
            background: #<?= $setting['front_end_color'] ?>!important;
        }
        /* Thêm các style động khác tương tự */
    </style>
</head>

<body>
    <?= $comment['code_body'] ?? '' ?>

    <?php if($setting['preloader_status'] == 'On'): ?>
    <!--Preloader Start-->
    <div id="preloader">
        <div id="status" style="background-image: url(<?= base_url('public/images/preloader.gif') ?>)"></div>
    </div>
    <!--Preloader End-->
    <?php endif; ?>

    <!-- Header Area -->
    <?= $this->include('partials/header') ?>

    <!-- Main Content -->
    <?= $this->renderSection('content') ?>

    <!-- Footer Area -->
    <?= $this->include('partials/footer') ?>

    <!-- Scripts -->
    <script src="<?= base_url('public/js/jquery-2.2.4.min.js') ?>"></script>
    <script src="<?= base_url('public/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('public/js/owl.carousel.min.js') ?>"></script>
    <script src="<?= base_url('public/js/toastr.min.js') ?>"></script>
    
    <?php if(session('sess_layout_direction') == 'Left'): ?>
    <script src="<?= base_url('public/js/ltr.js') ?>"></script>
    <?php endif; ?>
    
    <?php if(session('sess_layout_direction') == 'Right'): ?>
    <script src="<?= base_url('public/js/rtl.js') ?>"></script>
    <?php endif; ?>

    <script>
        toastr.options = {
            "closeButton": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000"
        }
        
        <?php if(session()->getFlashdata('success')): ?>
        toastr.success('<?= session()->getFlashdata('success') ?>');
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('error')): ?>
        toastr.error('<?= session()->getFlashdata('error') ?>');
        <?php endif; ?>
    </script>

    <?php if($all_setting['tawk_live_chat_status'] == 'On'): ?>
    <?= $all_setting['tawk_live_chat_code'] ?>
    <?php endif; ?>
</body>
</html>