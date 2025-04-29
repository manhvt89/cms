<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>
<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Category</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/category" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">

  	<div class="row">
	    <div class="col-md-12">

        <?php if (session()->getFlashdata('error')): ?>
            <div class="callout callout-danger">
                <p><?= session()->getFlashdata('error') ?></p>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="callout callout-success">
                <p><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php endif; 
        ?>

	        <?= form_open_multipart(base_url().'admin/category/edit/'.$category['category_id'],array('class' => 'form-horizontal')); ?>

	        <div class="box box-info">

	            <div class="box-body">
	                <div class="form-group">
	                    <label for="" class="col-sm-2 control-label">Category Name <span>*</span></label>
	                    <div class="col-sm-4">
	                        <input type="text" class="form-control" name="category_name" value="<?php echo $category['category_name']; ?>">
	                    </div>
	                </div>
	                <div class="form-group">
						<label for="" class="col-sm-2 control-label">Existing Banner</label>
						<div class="col-sm-9" style="padding-top:5px">
							<img src="<?php echo base_url(); ?>public/uploads/<?php echo $category['category_banner']; ?>" alt="Slider Photo" style="width:180px;">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Banner </label>
						<div class="col-sm-6" style="padding-top:5px">
							<input type="file" name="banner">(Only jpg, jpeg, gif and png are allowed)
						</div>
					</div>
	                <div class="form-group">
						<label for="" class="col-sm-2 control-label">Meta Title </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="meta_title" value="<?php echo $category['meta_title']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Meta Keywords </label>
						<div class="col-sm-9">
							<textarea class="form-control" name="meta_keyword" style="height:100px;"><?php echo $category['meta_keyword']; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Meta Description </label>
						<div class="col-sm-9">
							<textarea class="form-control" name="meta_description" style="height:100px;"><?php echo $category['meta_description']; ?></textarea>
						</div>
					</div>
					<div class="form-group">
							<label for="" class="col-sm-2 control-label">Language </label>
							<div class="col-sm-2">
								<select name="lang_id" class="form-control select2">
									<?php
									foreach($all_lang as $row)
									{
										?><option value="<?php echo $row['lang_id']; ?>" <?php if($category['lang_id'] == $row['lang_id']) {echo 'selected';} ?>><?php echo $row['lang_name']; ?></option><?php
									}
									?>
								</select>
							</div>
						</div>
	                <div class="form-group">
	                	<label for="" class="col-sm-2 control-label"></label>
	                    <div class="col-sm-6">
	                      <button type="submit" class="btn btn-success pull-left" name="form1" value="1">Update</button>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <?= form_close(); ?>
	    </div>
  	</div>
</section>
<?= $this->endSection() ?>
