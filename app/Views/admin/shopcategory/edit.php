<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 25px;
}
.switch input {display:none;}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 25px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 19px;
  width: 19px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}
input:checked + .slider {
  background-color: #28a745;
}
input:checked + .slider:before {
  transform: translateX(25px);
}
</style>
<section class="content-header">
	<div class="content-header-left">
    	<h1><?=$title?></h1>
	</div>
	<div class="content-header-right">
	<a href="<?= base_url('admin/shop/manage/category') ?>" class="btn btn-primary mb-3">View All</a>
    
    </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">

       <?=flash_message()?>
       <?php echo form_open_multipart(base_url("admin/shop/edit/category/{$category['id']}"),array('class' => 'form-horizontal')); ?>
			<div class="box box-info">
				<div class="box-body">
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Category Name <span>*</span></label>
						<div class="col-sm-6">
							<input type="text" autocomplete="off" class="form-control" name="category_name" value="<?=$category['category_name']; ?>">
						</div>
					</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description <span></span></label>
							<div class="col-sm-6">
								<textarea autocomplete="off" class="form-control editor" name="category_description" ><?=$category['category_description']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<?=form_wp_photo('category_photo',$category['category_photo'],'category_photo','Photo',false,'col-sm-4')?>
							
						</div>
						<div class="form-group">
							<label for="publication_status" class="col-sm-2 control-label">Hiển thị</label>
							<div class="col-sm-6">
								<label class="switch">
								<input type="checkbox" id="publication_status" name="publication_status" value="1" <?= $category['publication_status'] === '0' ? '' : 'checked' ?>>
								<span class="slider"></span>
								</label>
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
