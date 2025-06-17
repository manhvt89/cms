<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<!--Banner Start-->
<div class="banner-slider" style="background-image: url(<?php echo base_url($setting['banner_contact']); ?>)">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?php echo $page_contact['heading']; ?></h1>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Contact Start-->
<div class="contact-area pt_60 pb_90">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="contact-item flex">
                    <div class="contact-icon">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                    <div class="contact-text">
                        <h4><?php echo ADDRESS; ?></h4>
                        <p>
                            <?php echo nl2br($page_contact['address']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="contact-item flex">
                    <div class="contact-icon">
                        <i class="fa fa-mobile" aria-hidden="true"></i>
                    </div>
                    <div class="contact-text">
                        <h4><?php echo PHONE_NUMBER; ?></h4>
                        <p>
                            <?php echo nl2br($page_contact['phone']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="contact-item flex">
                    <div class="contact-icon">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </div>
                    <div class="contact-text">
                        <h4><?php echo 'EMAIL_ADDRESS'; ?></h4>
                        <p>
                            <?php echo nl2br($page_contact['email']); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="contact-form headstyle pt_90">  
                    <h4><?php echo CONTACT_FORM; ?></h4>
                    <?= form_open(base_url('contact/send_email'),
                                ['class' => '','id'=>'contact_form']
                            ); ?>
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="<?php echo NAME; ?>" name="name" id="txtname">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="<?php echo PHONE_NUMBER; ?>" name="phone" id="txtphone">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" placeholder="<?php echo EMAIL_ADDRESS; ?>" name="email" id="txtemail">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="<?php echo SUBJECT; ?>" name="subject" id="txtsubject">
                            </div>
                            <div class="form-group col-12">
                                <textarea class="form-control" placeholder="<?php echo MESSAGE; ?>" name="message" id="trmessage"></textarea>
                            </div>

                            <?php if($check_captcha['captcha_contact'] == 'Show'): ?>
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

                            <div class="form-group col-12">
                                <button value="1" type="submit" class="btn" name="form_contact"><?php echo SEND_MESSAGE; ?></button>
                            </div>
                        </div>
                    <?= form_close(); ?>
                    <div id="newsletterMessage" style="margin-top:10px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Contact End-->

<!--Map Start-->
<div class="map-area">
    <?php echo $page_contact['map']; ?>
</div>
<!--Map End-->

<?= $this->endSection() ?>