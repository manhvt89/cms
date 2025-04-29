<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Photo</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/photo" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<section class="content">

	<div class="row">
		<div class="col-md-12">

			<?=flash_message()?>

			<?=form_open_multipart(base_url('admin/photo/add'),array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
                        <?=form_wp_photo('photo_name',old('photo_name')?old('photo_name'):'','photo_name','Photo',true,'col-sm-4')?>
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button value="1" type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>
			<?=form_close(); ?>
		</div>
	</div>
</section>

<?= $this->endSection() ?>
