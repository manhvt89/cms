<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<!--Banner Start-->
<div class="banner-slider" style="background-image: url(<?=base_url($setting['banner_service']); ?>)">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?php echo $service['name']; ?></h1>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Single-Service Start-->
<div class="single-service-area pt_60 pb_90">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="service-info">
                    <div class="single-ser-carousel owl-carousel">
                        <div class="event-photo-item">
                            <img src="<?=base_url($service['photo'])?>" alt="Service Photo">
                        </div>
                    </div>
                    <h2><?php echo $service['name']; ?></h2>
                    <?php echo $service['description']; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="service-sidebar">
                    <div class="service-sidebar-item headstyle">
                        <h4><?php echo SIDEBAR_SERVICE_HEADING_1; ?></h4>
                        <ul>
                            <?php
                            foreach ($services as $row) {
                                ?>
                                <li><a href="<?=base_url("service/view/{$row['id']}"); ?>"><?=$row['name']; ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="service-sidebar-item headstyle">
                        <h4><?php echo SIDEBAR_SERVICE_HEADING_2; ?></h4>
                        <?php echo form_open(base_url().'service/send_email',array('class' => '')); ?>
                            <div class="form-row">
                                <input type="hidden" name="service" value="<?php echo $service['name']; ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="<?php echo NAME; ?>" name="name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="<?php echo EMAIL_ADDRESS; ?>" name="email">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="<?php echo PHONE_NUMBER; ?>" name="phone">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="<?php echo MESSAGE; ?>" name="message"></textarea>
                                </div>
                                <?php if($check_captcha['captcha_service_detail'] == 'Show'): ?>
                                <div class="form-group col-12">
                                   
                                    <div class="captcha-section-1">
                                        <?php echo $captcha_one['captcha_value1'].' '.$captcha_one['captcha_symbol'].' '.$captcha_one['captcha_value2'].' = ' ?>
                                    </div>
                                    <div class="captcha-section-2">
                                        <input type="hidden" name="r_serial" value="<?php echo $r_serial; ?>">
                                        <input type="text" class="form-control w-60" name="captcha_input">
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="form-button">
                                    <button type="submit" class="btn" name="form_service"><?php echo SUBMIT; ?></button>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Single-Service End-->
<?= $this->endSection() ?>