<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
    <h1><?= isset($item) ? 'Chỉnh sửa Menu' : 'Thêm Menu' ?></h1>
	</div>
	<div class="content-header-right">
          </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">

       <?=flash_message()?>
       <?php echo form_open_multipart(base_url().'admin/client/edit/'.$client['id'],array('class' => 'form-horizontal')); ?>
			<div class="box box-info">
				<div class="box-body">
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Name <span>*</span></label>
						<div class="col-sm-6">
							<input type="text" autocomplete="off" class="form-control" name="name" value="<?php echo $client['name']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">URL </label>
						<div class="col-sm-6">
							<input type="text" autocomplete="off" class="form-control" name="url" value="<?php echo $client['url']; ?>">
						</div>
					</div>
					<div class="form-group">
						<?=form_wp_photo('photo',$client['photo'],'photo','Photo',true,'col-sm-4')?>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label"></label>
						<div class="col-sm-6">
							<button value="1" type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
						</div>
					</div>
				</div>
			</div>
		<?php echo form_close(); ?>
       
    </div>
  </div>          

</section>

<?= $this->endSection() ?>
