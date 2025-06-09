<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<!--Banner Start-->
<div class="banner-slider" style="background-image: url(<?php echo base_url($setting['banner_verify_subscriber']); ?>)">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?php echo $page_home['title']; ?></h1>
        </div>
    </div>
</div>
<!--Banner End-->
<div class="contact-area pt_60 pb_90">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-form" style="padding-top:50px;padding-bottom:50px;font-size:24px;color:green;text-align: center;">
                    <?php echo SUCCESS_SUBSCRIPTION; ?>
                </div>
            </div>            
        </div>
    </div>
</div>
<!--Service-Area End-->
<?= $this->endSection() ?>