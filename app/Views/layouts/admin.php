<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Panel</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/datepicker3.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/jquery.fancybox.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/magnific-popup.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/style.css">
	


	<style>
		.skin-blue .wrapper,
		.skin-blue .main-header .logo,
		.skin-blue .main-header .navbar,
		.skin-blue .main-sidebar,
		.content-header .content-header-right a,
		.content .form-horizontal .btn-success {
			background-color: #4172a5!important;
		}

		.content-header .content-header-right a,
		.content .form-horizontal .btn-success {
			border-color: #4172a5!important;
		}
		
		.content-header>h1,
		.content-header .content-header-left h1,
		h3 {
			color: #4172a5!important;
		}

		.box.box-info {
			border-top-color: #4172a5!important;
		}

		.nav-tabs-custom>.nav-tabs>li.active {
			border-top-color: #f4f4f4!important;
		}

		.skin-blue .sidebar a {
			color: #fff!important;
		}

		.skin-blue .sidebar-menu>li>.treeview-menu {
			margin: 0!important;
		}
		.skin-blue .sidebar-menu>li>a {
			border-left: 0!important;
		}

		.nav-tabs-custom>.nav-tabs>li {
			border-top-width: 1px!important;
		}

	</style>



</head>

<body class="hold-transition fixed skin-blue sidebar-mini">

	
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