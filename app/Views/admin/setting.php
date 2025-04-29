<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Settings Section</h1>
	</div>
</section>

<section class="content" style="min-height:auto;margin-bottom: -30px;">
	<div class="row">
		<div class="col-md-12">
			<?php
	        if(session()->getFlashdata('error')) {
	            ?>
				<div class="callout callout-danger">
					<p><?php echo session()->getFlashdata('error'); ?></p>
				</div>
	            <?php
	        }
	        if(session()->getFlashdata('success')) {
	            ?>
				<div class="callout callout-success">
					<p><?php echo session()->getFlashdata('success'); ?></p>
				</div>
	            <?php
	        }
	        ?>

		</div>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">
							
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_logo" data-toggle="tab">Logo</a></li>
						<li><a href="#tab_favicon" data-toggle="tab">Favicon</a></li>
						<li><a href="#tab_top_bar" data-toggle="tab">Top Bar</a></li>
						<li><a href="#tab_email" data-toggle="tab">Email</a></li>
						<li><a href="#tab_banner" data-toggle="tab">Banner</a></li>
						<li><a href="#tab_sidebar" data-toggle="tab">Sidebar</a></li>
                        <li><a href="#tab_color" data-toggle="tab">Color</a></li>
                        <li><a href="#tab_language" data-toggle="tab">Language</a></li>
                        <li><a href="#tab_other" data-toggle="tab">Other</a></li>
					</ul>

					<div class="tab-content">

          				<div class="tab-pane active" id="tab_logo">
          					<?= form_open_multipart(base_url('admin/setting/update'),['class' => 'form-horizontal']); ?>
          					<div class="box box-info">
								<div class="box-body">
                                    <?= form_wp_photo('logo',$setting['logo'],'logo','Logo',true)?>
									
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_logo" value="logo">Update Logo</button>
										</div>
									</div>
								</div>
							</div>
							<?= form_close(); ?>
          				</div>


          				<div class="tab-pane" id="tab_favicon">

          					<?= form_open_multipart(base_url('admin/setting/update'),['class' => 'form-horizontal']); ?>
							<div class="box box-info">
								<div class="box-body">
                                    <?= form_wp_photo('favicon',$setting['favicon'],'favicon','Favicon',true)?>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_favicon" value="favi">Update Favicon</button>
										</div>
									</div>
								</div>
							</div>
							<?=form_close(); ?>
          				</div>
          				<div class="tab-pane" id="tab_top_bar">
							<?=form_open(base_url('admin/setting/update'),['class' => 'form-horizontal']); ?>
							<div class="box box-info">
								<div class="box-body">									
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Top Bar Email </label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="top_bar_email" value="<?=$setting['top_bar_email']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label">Top Bar Phone Number </label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="top_bar_phone" value="<?=$setting['top_bar_phone']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_top_bar" value="topbar">Update</button>
										</div>
									</div>
								</div>
							</div>
							<?=form_close(); ?>
          				</div>
          				<div class="tab-pane" id="tab_email">
          					<?=form_open(base_url('admin/setting/update'),['class' => 'form-horizontal']); ?>
							<div class="box box-info">
								<div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Send Email From *</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="send_email_from" maxlength="255" autocomplete="off" value="<?= $setting['send_email_from']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Receive Email To *</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="receive_email_to" maxlength="255" autocomplete="off" value="<?php echo $setting['receive_email_to']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
				                        <label for="" class="col-sm-3 control-label">SMTP Active? *</label>
				                        <div class="col-sm-4">
				                            <select name="smtp_active" class="form-control select2">
				                            	<option value="Yes" <?php if($setting['smtp_active'] == 'Yes') {echo 'selected';} ?>>Yes</option>
				                            	<option value="No" <?php if($setting['smtp_active'] == 'No') {echo 'selected';} ?>>No</option>
				                            </select>
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <label for="" class="col-sm-3 control-label">SSL Active? *</label>
				                        <div class="col-sm-4">
				                            <select name="smtp_ssl" class="form-control select2">
				                            	<option value="Yes" <?php if($setting['smtp_ssl'] == 'Yes') {echo 'selected';} ?>>Yes</option>
				                            	<option value="No" <?php if($setting['smtp_ssl'] == 'No') {echo 'selected';} ?>>No</option>
				                            </select>
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <label for="" class="col-sm-3 control-label">SMTP Host </label>
				                        <div class="col-sm-4">
				                            <input type="text" class="form-control" name="smtp_host" maxlength="255" autocomplete="off" value="<?php echo $setting['smtp_host']; ?>">
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <label for="" class="col-sm-3 control-label">SMTP Port </label>
				                        <div class="col-sm-4">
				                            <input type="text" class="form-control" name="smtp_port" maxlength="255" autocomplete="off" value="<?php echo $setting['smtp_port']; ?>">
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <label for="" class="col-sm-3 control-label">SMTP Username </label>
				                        <div class="col-sm-4">
				                            <input type="text" class="form-control" name="smtp_username" maxlength="255" autocomplete="off" value="<?php echo $setting['smtp_username']; ?>">
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <label for="" class="col-sm-3 control-label">SMTP Password </label>
				                        <div class="col-sm-4">
				                            <input type="text" class="form-control" name="smtp_password" maxlength="255" autocomplete="off" value="<?php echo $setting['smtp_password']; ?>">
				                        </div>
				                    </div>
									<div class="form-group">
										<label for="" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_email" value="email">Update</button>
										</div>
									</div>
								</div>
							</div>
							<?=form_close(); ?>
          				</div>

          				<div class="tab-pane" id="tab_banner">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">                                
                                        <tr>
                                            <?=form_open_multipart(base_url('admin/setting/update'),['class' => '']); ?>
                                            
                                            <td style="width:100%">
                                                <?php //echo  $setting['banner_about'];?>
                                            <?=form_wp_photo('banner_about',$setting['banner_about'],'banner_about','About Page')?>    
                                            
                                            <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_about" value="banner">
                                            </td>
                                            <?= form_close(); ?>
                                        </tr>
                                        
                                        <tr>
                                            <?= form_open_multipart(base_url('admin/setting/update'),['class' => '']); ?>
                                            <td style="width:100%">
                                                <?=form_wp_photo('banner_testimonial',$setting['banner_testimonial'],'banner_testimonial','Testimonial Page')?>    
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_testimonial">
                                            </td>
                                            <?= form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?=form_open_multipart(base_url('admin/setting/update'),['class' => '']); ?>
                                            <td style="width:100%">
                                            <?=form_wp_photo('banner_news',$setting['banner_news'],'banner_news','News Page')?>    
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_news">
                                            </td>
                                            <?=form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?=form_open_multipart(base_url('admin/setting/update'),['class' => '']); ?>
                                            <td style="width:50%">
                                            <?=form_wp_photo('banner_event',$setting['banner_event'],'banner_event','Event Page')?>    
                                            
                                                
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_event">
                                            </td>
                                            <?=form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url('admin/setting/update'),array('class' => '')); ?>
                                            <td style="width:100%">
                                                <?=form_wp_photo('banner_contact',$setting['banner_contact'],'banner_contact','Contact Page')?>    
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_contact">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?php echo form_open_multipart(base_url('admin/setting/update'),array('class' => '')); ?>
                                            <td style="width:100%">
                                            <?=form_wp_photo('banner_search',$setting['banner_search'],'banner_search','Search Page')?>    
                                                    
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_search">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                        <tr>
                                            <?php echo form_open_multipart(base_url('admin/setting/update'),array('class' => '')); ?>
                                            <td style="width:100%">
                                            <?=form_wp_photo('banner_privacy',$setting['banner_privacy'],'banner_privacy','Privacy Page')?>    
                                            
                        
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_privacy">
                                            </td>
                                            <?=form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?=form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:100%">
                                            <?=form_wp_photo('banner_verify_subscriber',$setting['banner_verify_subscriber'],'banner_verify_subscriber','Verify Subscriber Page')?>    
                                                
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_verify_subscriber">
                                            </td>
                                            <?=form_close(); ?>
                                        </tr>
                                        
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">    
                                        <tr>
                                            <?=form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:100%">
                                            <?=form_wp_photo('banner_faq',$setting['banner_faq'],'banner_faq','FAQ Page')?>    
                                                
                                            
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_faq">
                                            </td>
                                            <?=form_close(); ?>
                                        </tr>

                                        <tr>
                                            <?=form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:100%">
                                            <?=form_wp_photo('banner_service',$setting['banner_service'],'banner_service','Service Page')?>    
        
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_service">
                                            </td>
                                            <?= form_close(); ?>
                                        </tr>
                                        
                                        <tr>
                                            <?=form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:100%">
                                                <?=form_wp_photo('banner_portfolio',$setting['banner_portfolio'],'banner_portfolio','Portfolio Page')?>    
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_portfolio">
                                            </td>
                                            <?=form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?=form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:100%">
                                                <?=form_wp_photo('banner_team',$setting['banner_team'],'banner_team','Team Page')?>    
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_team">
                                            </td>
                                            <?=form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?=form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:100%">
                                                <?=form_wp_photo('banner_pricing',$setting['banner_pricing'],'banner_pricing','Pricing Page')?>    
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_pricing">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?=form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:100%">
                                                <?=form_wp_photo('banner_photo_gallery',$setting['banner_photo_gallery'],'banner_photo_gallery','Photo Gallery Page')?>    
                                                    
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_photo_gallery">
                                            </td>
                                            <?=form_close(); ?>
                                        </tr>
                                        <tr>
                                            <?=form_open_multipart(base_url().'admin/setting/update',array('class' => '')); ?>
                                            <td style="width:100%">
                                            <?=form_wp_photo('banner_terms',$setting['banner_terms'],'banner_terms','Terms Page')?>    
                                                
                                                
                                                <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form_banner_terms">
                                            </td>
                                            <?php echo form_close(); ?>
                                        </tr>
                                        
                                    </table>
                                </div>
                            </div>
          				</div>



          				<div class="tab-pane" id="tab_sidebar">
          					<?=form_open(base_url('admin/setting/update'),array('class' => 'form-horizontal')); ?>
							<div class="box box-info">
								<div class="box-body">                                    
                                    <h3 class="sec_title" style="margin-top:0;">News Page - Sidebar Section</h3>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Total Recent Posts *</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="sidebar_total_recent_post" maxlength="255" autocomplete="off" value="<?php echo $setting['sidebar_total_recent_post']; ?>">
                                        </div>
                                    </div>

                                    <h3 class="sec_title">Event Page - Sidebar Section</h3>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Total Upcoming Events *</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="sidebar_total_upcoming_event" maxlength="255" autocomplete="off" value="<?php echo $setting['sidebar_total_upcoming_event']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Total Past Events *</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="sidebar_total_past_event" maxlength="255" autocomplete="off" value="<?php echo $setting['sidebar_total_past_event']; ?>">
                                        </div>
                                    </div>
                                   
									<div class="form-group">
										<label for="" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form_sidebar" value="sidebar">Update</button>
										</div>
									</div>
								</div>
							</div>
							<?=form_close(); ?>
          				</div>


                        
                        <div class="tab-pane" id="tab_color">
                            <?php echo form_open(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Color </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="front_end_color" class="form-control jscolor" value="<?php echo $setting['front_end_color']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button value="color" type="submit" class="btn btn-success pull-left" name="form_color">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>



                        <div class="tab-pane" id="tab_language">
                            <?php echo form_open(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Language Option? </label>
                                        <div class="col-sm-3">
                                            <select name="language_status" class="form-control select2">
                                            	<option value="Show" <?php if($setting['language_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                            	<option value="Hide" <?php if($setting['language_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button value="language" type="submit" class="btn btn-success pull-left" name="form_language">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>





                        <div class="tab-pane" id="tab_other">
                            <?php echo form_open(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Website Name </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="website_name" class="form-control" value="<?php echo $setting['website_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Preloader Status </label>
                                        <div class="col-sm-4">
                                            <select name="preloader_status" class="form-control select2">
                                            	<option value="On" <?php if($setting['preloader_status'] == 'On') {echo 'selected';} ?>>On</option>
                                            	<option value="Off" <?php if($setting['preloader_status'] == 'Off') {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Tawk Live Chat Code </label>
                                        <div class="col-sm-6">
                                        	<textarea name="tawk_live_chat_code" class="form-control" cols="30" rows="10"><?php echo $setting['tawk_live_chat_code']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Tawk Live Chat Status </label>
                                        <div class="col-sm-4">
                                            <select name="tawk_live_chat_status" class="form-control select2">
                                            	<option value="On" <?php if($setting['tawk_live_chat_status'] == 'On') {echo 'selected';} ?>>On</option>
                                            	<option value="Off" <?php if($setting['tawk_live_chat_status'] == 'Off') {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button value="other" type="submit" class="btn btn-success pull-left" name="form_other">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        










          			</div>
				</div>

			
		</div>
	</div>

</section>

<?= $this->endSection() ?>
