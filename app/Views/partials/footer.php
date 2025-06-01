<!--Call Start-->
<div class="call-us" style="background-image: url(<?= base_url($footer_setting_lang_independent['cta_background']) ?>)">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-12">
                <div class="call-text">
                    <h3><?= $footer_setting['cta_text'] ?></h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">
                <div class="button">
                    <a href="<?= $footer_setting['cta_button_url'] ?>"><?= $footer_setting['cta_button_text'] ?> <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Call End-->

<!--Footer-Area Start-->
<div class="footer-area pt_60 pb_90">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item" id="newsletter">
                        <h3><?=FOOTER_1_HEADING ?></h3>
                        <p>
                            <?=nl2br($footer_setting['newsletter_text']); ?>
                        </p>
                        <?=form_open(base_url('newsletter/send'), ['class' => '']) ?>
                            <div class="input-group">
                                <input type="email" class="form-control" name="email_subscribe" placeholder="<?= esc(EMAIL_ADDRESS) ?>">
                                <span class="input-group-btn">
                                    <button class="btn" type="submit" name="form_subscribe">
                                        <i class="fa fa-location-arrow"></i>
                                    </button>
                                </span>
                            </div>
                        <?=form_close() ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <?=$footer_recent_posts?>                 
                </div>
                <div class="col-lg-3 col-md-6">
                    <?=$footer_recent_portfolio?>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h3><?=FOOTER_4_HEADING?></h3>
                        <div class="footer-address-item">
                            <div class="icon"><i class="fa fa-map-marker"></i></div>
                            <div class="text">
                                <span>
                                    <?php echo nl2br($footer_setting['footer_address']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="footer-address-item">
                            <div class="icon"><i class="fa fa-phone"></i></div>
                            <div class="text">
                                <span>
                                    <?php echo nl2br($footer_setting['footer_phone']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="footer-address-item">
                            <div class="icon"><i class="fa fa-envelope-o"></i></div>
                            <div class="text">
                                <span>
                                    <?php echo nl2br($footer_setting['footer_email']); ?>
                                </span>
                            </div>
                        </div>
                        <ul class="footer-social">
                            <?php
                            foreach ($social as $row)
                            {
                                if($row['social_url']!='')
                                {
                                    echo '<li><a href="'.$row['social_url'].'"><i class="'.$row['social_icon'].'"></i></a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom pt_50 pb_50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>"><?php echo HOME; ?></a></li>
                            <li><a href="<?= base_url("term")?>"><?php echo TERMS_AND_CONDITIONS; ?></a></li>
                            <li><a href="<?= base_url("privacy")?>"><?php echo PRIVACY_POLICY; ?></a></li>
                        </ul>
                    </div>
                    <div class="copy-text">
                        <p>
                            <?php echo $footer_setting['footer_copyright']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Footer-Area End-->
<!--Scroll-Top-->
<div class="scroll-top">
    <i class="fa fa-angle-up"></i>
</div>
<!--Scroll-Top-->