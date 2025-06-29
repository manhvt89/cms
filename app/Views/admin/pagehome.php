<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Home Page Item</h1>
    </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">

       <?=flash_message()?>
      <div class="box box-info">
        
	  <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Language</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            foreach ($page_home as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['lang_name']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>admin/pagehome/edit/<?php echo $row['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
      </div> 

</section>
<section class="content-header">
    <div class="content-header-left">
        <h1>View Home Page Item (Language Independent)</h1>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info" style="padding-top:0;">
                <div class="box-body" style="padding-top:0;">


                    <h3 class="sec_title">Welcome Section</h3>
                    <?=form_open_multipart(base_url('admin/pagehome/update'),array('class' => 'form-horizontal')); ?>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Video</label>
                        <div class="col-sm-6">
                            <textarea name="home_welcome_video" class="form-control" cols="30" rows="10" style="height:100px;"><?php echo $page_home_lang_independent['home_welcome_video']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Show on Home?</label>
                        <div class="col-sm-2">
                            <select name="home_welcome_status" class="form-control select2" style="width:auto;">
                            <option value="Show" <?php if($page_home_lang_independent['home_welcome_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                            <option value="Hide" <?php if($page_home_lang_independent['home_welcome_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2"></label>
                        <div class="col-sm-6">
                            <button value="1" type="submit" class="btn btn-success pull-left" name="form_home_welcome">Update</button>
                        </select>
                        </div>
                    </div>
                    <?=form_close(); ?>

                    <h3 class="sec_title">Welcome Section (Video Background)</h3>
                    <?=form_open_multipart(base_url('admin/pagehome/update'),array('class' => 'form-horizontal')); ?>
                        
                        <div class="form-group">
                            <?=form_wp_photo('home_welcome_video_bg',$page_home_lang_independent['home_welcome_video_bg'],'home_welcome_video_bg','Video Background',false,'col-sm-4')?>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button value="2" type="submit" class="btn btn-success pull-left" name="form_home_welcome_video_bg">Update</button>
                            </select>
                            </div>
                        </div>
                    <?=form_close(); ?>



                    <h3 class="sec_title">Why Choose Us Section</h3>
                    <?=form_open_multipart(base_url('admin/pagehome/update'),array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_why_choose_status" class="form-control select2" style="width:auto;">
                                <option value="Show" <?php if($page_home_lang_independent['home_why_choose_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_why_choose_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button value="3" type="submit" class="btn btn-success pull-left" name="form_home_why_choose">Update</button>
                            </select>
                            </div>
                        </div>
                    <?=form_close(); ?>



                    <h3 class="sec_title">Feature Section</h3>
                    <?=form_open_multipart(base_url().'admin/pagehome/update',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_feature_status" class="form-control select2" style="width:auto;">
                                <option value="Show" <?php if($page_home_lang_independent['home_feature_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_feature_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button value="4" type="submit" class="btn btn-success pull-left" name="form_home_feature">Update</button>
                            </select>
                            </div>
                        </div>
                    <?=form_close(); ?>


                    <h3 class="sec_title">Service Section</h3>
                    <?php echo form_open_multipart(base_url().'admin/pagehome/update',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_service_status" class="form-control select2" style="width:auto;">
                                <option value="Show" <?php if($page_home_lang_independent['home_service_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_service_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button value="5" type="submit" class="btn btn-success pull-left" name="form_home_service">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>



                    <h3 class="sec_title">Counter Information Section</h3>
                    <?php echo form_open(base_url().'admin/pagehome/update',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="counter_status" class="form-control select2" style="width:auto;">
                                    <option value="Show" <?php if($page_home_lang_independent['counter_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                    <option value="Hide" <?php if($page_home_lang_independent['counter_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button value="6" type="submit" class="btn btn-success pull-left" name="form_home_counter_text">Update</button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>



                    <h3 class="sec_title">Counter Photo Section</h3>
                    <?php echo form_open_multipart(base_url().'admin/pagehome/update',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <?=form_wp_photo('counter_photo',$page_home_lang_independent['counter_photo'],'counter_photo','New Counter Background', true,'col-sm-4') ?>
                        
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button value="7" type="submit" class="btn btn-success pull-left" name="form_home_counter_photo">Update</button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>



                    <h3 class="sec_title">Portfolio Section</h3>
                    <?php echo form_open(base_url().'admin/pagehome/update',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_portfolio_status" class="form-control select2" style="width:auto;">
                                <option value="Show" <?php if($page_home_lang_independent['home_portfolio_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_portfolio_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button value="8" type="submit" class="btn btn-success pull-left" name="form_home_portfolio">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>


                    <h3 class="sec_title">Booking Section</h3>
                    <?php echo form_open(base_url().'admin/pagehome/update',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_booking_status" class="form-control select2" style="width:auto;">
                                <option value="Show" <?php if($page_home_lang_independent['home_booking_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_booking_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button value="9" type="submit" class="btn btn-success pull-left" name="form_home_booking">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>


                    <h3 class="sec_title">Booking Photo Section</h3>
                    <?php echo form_open_multipart(base_url().'admin/pagehome/update',array('class' => 'form-horizontal')); ?>
                        
                        <div class="form-group">
                            <?=form_wp_photo('home_booking_photo',$page_home_lang_independent['home_booking_photo'],'home_booking_photo','New Booking Background',true,'col-sm-4')?>
                            
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button value="10" type="submit" class="btn btn-success pull-left" name="form_home_booking_photo">Update</button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>



                    <h3 class="sec_title">Team Section</h3>
                    <?php echo form_open(base_url().'admin/pagehome/update',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_team_status" class="form-control select2" style="width:auto;">
                                <option value="Show" <?php if($page_home_lang_independent['home_team_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_team_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button value="11" type="submit" class="btn btn-success pull-left" name="form_home_team">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>


                    <h3 class="sec_title">Pricing Table Section</h3>
                    <?php echo form_open(base_url().'admin/pagehome/update',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_ptable_status" class="form-control select2" style="width:auto;">
                                <option value="Show" <?php if($page_home_lang_independent['home_ptable_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_ptable_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button value="12" type="submit" class="btn btn-success pull-left" name="form_home_pricing_table">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>


                    <h3 class="sec_title">Testimonial Section</h3>
                    <?php echo form_open(base_url().'admin/pagehome/update',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_testimonial_status" class="form-control select2" style="width:auto;">
                                <option value="Show" <?php if($page_home_lang_independent['home_testimonial_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_testimonial_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button value="13" type="submit" class="btn btn-success pull-left" name="form_home_testimonial">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>

                    <h3 class="sec_title">Testimonial Photo Section</h3>
                    <?php echo form_open_multipart(base_url().'admin/pagehome/update',array('class' => 'form-horizontal')); ?>
                    
                        <div class="form-group">
                            <?=form_wp_photo('home_testimonial_photo',$page_home_lang_independent['home_testimonial_photo'],'home_testimonial_photo','New Photo',true,'col-sm-4')?>
                            
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button value="14" type="submit" class="btn btn-success pull-left" name="form_home_testimonial_photo">Update</button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>


                    <h3 class="sec_title">Blog Section</h3>
                    <?php echo form_open(base_url().'admin/pagehome/update',array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">How many item to show? </label>
                            <div class="col-sm-2">
                                <input type="text" name="home_blog_item" class="form-control" value="<?php echo $page_home_lang_independent['home_blog_item']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Home? </label>
                            <div class="col-sm-2">
                                <select name="home_blog_status" class="form-control select2" style="width:auto;">
                                <option value="Show" <?php if($page_home_lang_independent['home_blog_status'] == 'Show') {echo 'selected';} ?>>Show</option>
                                <option value="Hide" <?php if($page_home_lang_independent['home_blog_status'] == 'Hide') {echo 'selected';} ?>>Hide</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2"></label>
                            <div class="col-sm-6">
                                <button value="15" type="submit" class="btn btn-success pull-left" name="form_home_blog">Update</button>
                            </select>
                            </div>
                        </div>
                    <?php echo form_close(); ?>




                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
