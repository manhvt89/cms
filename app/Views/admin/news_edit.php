<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit News</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/news" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">
        <?php
			if(session()->getFlashdata('error')) {
				?>
				<div class="callout callout-danger">
					<p><?= session()->getFlashdata('error'); ?></p>
				</div>
				<?php
			}
			if(session()->getFlashdata('success')) {
				?>
				<div class="callout callout-success">
					<p><?= session()->getFlashdata('success'); ?></p>
				</div>
				<?php
			}
			?>
			<?= form_open_multipart(base_url().'admin/news/edit/'.$news['news_id'],['class' => 'form-horizontal']); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Title <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="news_title" value="<?php echo $news['news_title']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Short Content <span>*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="news_content_short" style="height:80px;"><?php echo $news['news_content_short']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Content <span>*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="news_content"><?php echo $news['news_content']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Publish Date <span>*</span></label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="news_date" id="datepicker" value="<?php echo $news['news_date']; ?>">(Format: yy-mm-dd)
							</div>
						</div>
						
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Categories <span>*</span></label>
				            <div class="col-sm-3">
				            	<select class="form-control select2" name="category_id">
								<?php
				            	$i=0;
				            	foreach ($all_category as $row) {
									?>
									<option value="<?php echo $row['category_id']; ?>" <?php if($row['category_id']==$news['category_id']){echo 'selected';} ?>><?php echo $row['category_name']; ?></option>
	                                <?php
								}
								?>
								</select>
				            </div>
				        </div>

				        <div class="form-group">
				            <label for="" class="col-sm-2 control-label">Comment <span>*</span></label>
				            <div class="col-sm-3">
				            	<select class="form-control select2" name="comment">
									<option value="On" <?php if($news['comment'] == 'On') {echo 'selected';} ?>>On</option>
									<option value="Off" <?php if($news['comment'] == 'Off') {echo 'selected';} ?>>Off</option>
								</select>
				            </div>
				        </div>
				        <h3 class="seo-info">Photo and Banner</h3>
						<div class="form-group">
							<label for="featured-photo" class="col-sm-2 control-label">Featured Photo *</label>
							<div id="featured-photo-wrapper" class="wp-featured-wrapper">
								
								<?php if ($news['photo']): ?>
									<img src="<?= base_url($news['photo']) ?>" alt="Featured" style="max-height: 150px; display:block;" id="featured-photo-preview">
								<?php else: ?>
									<img src="https://via.placeholder.com/300x200?text=Chưa+chọn+ảnh" alt="Featured" id="featured-photo-preview">
								<?php endif; ?>
								
								<input type="hidden" name="featured-photo" id="featured-photo" value="<?= $news['photo'] ?>">
								<div class="wp-btns">
									<button type="button" class="btn btn-primary btn-sm" onclick="openMediaPopup('featured-photo')">Chọn ảnh</button>
									<button type="button" class="btn btn-danger btn-sm" onclick="removeFeaturedPhoto('featured-photo')">Xóa</button>
								</div>
		
							</div>
						</div>

						<div class="form-group">
							<label for="banner-photo" class="col-sm-2 control-label">Banner Photo *</label>
							<div id="banner-photo-wrapper" class="wp-featured-wrapper">
								<?php if ($news['banner']): ?>
									<img src="<?= base_url($news['banner']) ?>" alt="Banner" style="max-height: 150px; display:block;" id="banner-photo-preview">
								<?php else: ?>
									<img src="https://via.placeholder.com/300x200?text=Chưa+chọn+ảnh" alt="Featured" id="banner-photo-preview">
								
								<?php endif; ?>
							
								<input type="hidden" name="banner-photo" id="banner-photo" value="<?= $news['banner'] ?>">
								<div class="wp-btns">
									<button type="button" class="btn btn-primary btn-sm" onclick="openMediaPopup('banner-photo')">Chọn ảnh</button>
									<button type="button" class="btn btn-danger btn-sm" onclick="removeFeaturedPhoto('banner-photo')">Xóa</button>
								</div>
								
							</div>
						</div>
						
						<h3 class="seo-info">SEO Information</h3>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Title </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="meta_title" value="<?php echo $news['meta_title']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Keywords </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="meta_keyword" value="<?php echo $news['meta_keyword']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Description </label>
							<div class="col-sm-9">
								<textarea class="form-control" name="meta_description" style="height:200px;"><?php echo $news['meta_description']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Language </label>
							<div class="col-sm-2">
								<select name="lang_id" class="form-control select2">
									<?php
									foreach($all_lang as $row)
									{
										?><option value="<?php echo $row['lang_id']; ?>" <?php if($news['lang_id'] == $row['lang_id']) {echo 'selected';} ?>><?php echo $row['lang_name']; ?></option><?php
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
