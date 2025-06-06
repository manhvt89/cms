<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Profile</h1>
	</div>
</section>

<section class="content" style="min-height:auto;margin-bottom: -30px;">
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
            <?php endif; ?>
            
			
		</div>
	</div>
</section>


<section class="content">
	<div class="row">
		<div class="col-md-12">
				
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_1" data-toggle="tab">Update Information</a></li>
					<li><a href="#tab_2" data-toggle="tab">Update Photo</a></li>
					<li><a href="#tab_3" data-toggle="tab">Update Password</a></li>
				</ul>
				<div class="tab-content">

      				<div class="tab-pane active" id="tab_1">						
						<?= form_open(base_url().'admin/profile/update',array('class' => 'form-horizontal')); ?>
						<div class="box box-info">
							<div class="box-body">
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Email Address <span>*</span></label>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="email" value="<?= session()->get('email'); ?>">
									</div>			
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Role <span>*</span></label>
									<div class="col-sm-4" style="padding-top:7px;">
                                        <?= session()->get('role'); ?>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label"></label>
									<div class="col-sm-6">
										<button type="submit" class="btn btn-success pull-left" name="form1">Update Information</button>
									</div>
								</div>
							</div>
						</div>
						<?= form_close(); ?>
      				</div>


      				<div class="tab-pane" id="tab_2">
						<?= form_open_multipart(base_url().'admin/profile/update',array('class' => 'form-horizontal')); ?>
						<div class="box box-info">
							<div class="box-body">
								<div class="form-group">
						            <label for="" class="col-sm-2 control-label">Existing Photo</label>
						            <div class="col-sm-6" style="padding-top:6px;">
						            	<?php if(session()->get('photo') ==''): ?>
						            		<img src="<?php echo base_url(); ?>public/img/no-photo.jpg" class="existing-photo" alt="profile photo" width="140">
						            	<?php else: ?>
						            		 <img src="<?php echo base_url(); ?>public/uploads/<?= session()->get('photo'); ?>" class="existing-photo" width="140">
						            	<?php endif; ?>							                
						            </div>
						        </div>
								<div class="form-group">
						            <label for="" class="col-sm-2 control-label">New Photo</label>
						            <div class="col-sm-6" style="padding-top:6px;">
						                <input type="file" name="photo">
						            </div>
						        </div>
						        <div class="form-group">
									<label for="" class="col-sm-2 control-label"></label>
									<div class="col-sm-6">
										<button type="submit" class="btn btn-success pull-left" name="form2">Update Photo</button>
									</div>
								</div>
							</div>
						</div>
						<?= form_close(); ?>
      				</div>


      				<div class="tab-pane" id="tab_3">
						<?= form_open(base_url().'admin/profile/update',array('class' => 'form-horizontal')); ?>
						<div class="box box-info">
							<div class="box-body">
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
									<label for="" class="col-sm-2 control-label"></label>
									<div class="col-sm-6">
										<button type="submit" class="btn btn-success pull-left" name="form3" value="1">Update Password</button>
									</div>
								</div>
							</div>
						</div>
						<?= form_close(); ?>
      				</div>
      			</div>
			</div>
		</div>
	</div>
</section>

<?= $this->endSection() ?>
