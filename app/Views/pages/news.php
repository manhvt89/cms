<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<!--Banner Start-->
<div class="banner-slider" style="background-image: url(<?php echo base_url($setting['banner_news']); ?>)">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?php echo $page_news['heading']; ?></h1>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Blog-One Start-->
<div class="blog-one-area pt_60 pb_90">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">               

                <?php
                foreach($news_fetched as $row) {
                    $_sSlug = $row->slug;
                    
                    $_sSlugCat = slugify($row->category_name)
                    ?>
                    <div class="blog-one-item">
                        <div class="blog-one-photo">
                            <a href="<?=base_url("{$_sSlug}")?>"><img src="<?=base_url($row->photo); ?>" alt="Blog Photo"></a>
                        </div>
                        <div class="blog-one-text">
                            <ul>
                                <li><i class="fa fa-edit"></i><a href="<?=base_url("category/{$_sSlugCat}")?>"><?=$row->category_name; ?></a></li>
                                <li><i class="fa fa-calendar-o"></i>
                                    <?=format_news_date($row->news_date)?>
                                </li>
                            </ul>
                            
                            <h3><a href="<?=base_url("{$_sSlug}")?>"><?=$row->news_title?></a></h3>
                            <p>
                                <?=$row->news_content_short; ?>
                            </p>
                            <div class="button-df">
                                <a href="<?=base_url("$_sSlug}")?>"><?=READ_MORE?> <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <div class="col-md-12" style="margin-top:30px;text-align: center;">
                        <?=$links; ?>
                    </div>
                </div>
                
            </div>

            <!--Sidebar Start-->
            <?=render_sidebar($sidebar_items)?>
            <!--Sidebar End-->
        </div>
    </div>
</div>
<!--Blog-One End
<?= $this->endSection() ?>