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
       <?php echo form_open_multipart(base_url().'admin/user/edit/'.$item['id'],array('class' => 'form-horizontal')); ?>
				<input type="hidden" name="current_photo" value="<?=$item['photo']?>">
				<input type="hidden" name="email" value="<?=$item['email']?>">
				<input type="hidden" name="user_id" value="<?=$item['id']?>">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Email <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" disabled class="form-control" name="email" value="<?php echo $item['email']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Password </label>
							<div class="col-sm-4">
								<input type="password" class="form-control" name="password">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Retype Password </label>
							<div class="col-sm-4">
								<input type="password" class="form-control" name="re_password">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Role </label>
							<div class="col-sm-2">
								<select name="role" class="form-control select2">
									<?php
									foreach($all_role as $row)
									{
										?><option value="<?=$row?>" <?php if($item['role'] == $row) {echo 'selected';} ?>><?=$row?></option><?php
									}
									?>
								</select>
							</div>
						</div>
						        
						<div class="form-group">
							<?=form_wp_photo('photo',$item['photo'],'photo','Photo',true,'col-sm-4')?>
							
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button value="1" type="submit" class="btn btn-success pull-left" name="form3">Submit</button>
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
       
    </div>
  </div>          

</section>

<?= $this->endSection() ?>
