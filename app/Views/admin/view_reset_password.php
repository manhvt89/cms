<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Reset Password</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/datepicker3.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/style.css">
	<style>
		.login-page {
			background: #333;
		}
		.login-logo {
			color: #fff;
		}
	</style>

</head>

<body class="hold-transition login-page sidebar-mini">

<div class="login-box">
	<div class="login-logo">
		<b>
			<?php echo $setting_data['website_name']; ?> - Admin Panel
		</b>
	</div>
  	<div class="login-box-body">
    	<h4 class="login-box-msg">Reset Password</h4>
    
	    <?= flash_message()?>

		<?php echo form_open(base_url("admin/reset-password/{$var2}"));?>
			<div class="form-group has-feedback">
				<input class="form-control" placeholder="New Password" name="new_password" type="password" autocomplete="off" autofocus>
			</div>
			<div class="form-group has-feedback">
				<input class="form-control" placeholder="Retype Password" name="re_password" type="password" autocomplete="off" autofocus>
			</div>
			<div class="row">
				<div class="col-xs-8" style="padding-top:7px;"></div>
				<div class="col-xs-4">
					<input type="submit" class="btn btn-primary btn-block btn-flat login-button" name="form1" value="Submit">
				</div>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>


<script src="<?php echo base_url(); ?>public/admin/js/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/jquery.inputmask.extensions.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/fastclick.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/app.min.js"></script>
<script src="<?php echo base_url(); ?>public/admin/js/demo.js"></script>

</body>
</html>