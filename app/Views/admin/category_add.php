<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Category</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/category" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">

        <?= flash_message()?>
		<?= form_open_multipart(base_url().'admin/category/add',array('class' => 'form-horizontal')); ?>

				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"><?=lang('Admin.category.name')?> <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="category_name">
							</div>
						</div>
						<div class="form-group">
							<?=form_wp_photo('category_banner',old('category_banner')??'','category_banner','Banner',true,'col-sm-4')?>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"><?=lang('Admin.meta.title')?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="meta_title">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"><?=lang('Admin.meta.keywords')?></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="meta_keyword" style="height:80px;"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"><?=lang('Admin.meta.description')?></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="meta_description" style="height:80px;"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"><?=lang('Admin.language')?> </label>
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
								<button type="submit" class="btn btn-success pull-left" name="form1" value="1"><?=lang('Admin.button.submit')?></button>
							</div>
						</div>
					</div>
				</div>

			<?= form_close(); ?>
		</div>
	</div>
</section>
<?= $this->endSection() ?>