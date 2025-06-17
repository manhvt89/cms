<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
    <h1><?=$title?></h1>
	</div>
	<div class="content-header-right">
          </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">

       <?=flash_message()?>
       <?php echo form_open(base_url().'admin/whychoose/add',array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">	
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Name *</label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="name" value="<?= old('name'); ?>">
							</div>
						</div>	
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Content *</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="content" style="height:140px;"><?=old('content') ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Icon *</label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="icon" value="<?=old('icon'); ?>">
							</div>
						</div>

						<div class="form-group">
							<?=form_wp_photo('photo',old('photo')??'','photo','Photo',true,'col-sm-4')?>
							
						</div>
					
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Language </label>
							<div class="col-sm-2">
								<select name="lang_id" class="form-control select2">
									<?php
									foreach($all_lang as $row)
									{
										?><option value="<?php echo $row['lang_id']; ?>"><?php echo $row['lang_name']; ?></option><?php
									}
									?>
								</select>
							</div>
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
