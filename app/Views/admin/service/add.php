<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
    <h1><?= isset($item) ? 'Chỉnh sửa' : 'Thêm mới' ?></h1>
	</div>
	<div class="content-header-right">
          </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">

       <?=flash_message()?>
       <?php echo form_open_multipart(base_url().'admin/service/add',array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Name *</label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="name" value="<?=old('name')?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Short Description *</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="short_description" style="height:140px;"><?=old('short_description')?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description *</label>
							<div class="col-sm-8">
								<textarea class="form-control editor" name="description"><?=old('description')?></textarea>
							</div>
						</div>
						<div class="form-group">
							<?=form_wp_photo('photo',old('photo')??'','photo','Photo',true,'col-sm-4')?>
						</div>
						<h3 class="seo-info">SEO Information</h3>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Title</label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="meta_title" value="<?=old('meta_title')?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Keyword</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="meta_keyword" style="height:80px;"><?=old('meta_keyword')?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Description</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="meta_description" style="height:80px;"><?=old('meta_description')?></textarea>
							</div>
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
