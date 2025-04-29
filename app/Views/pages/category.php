<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<!--Banner Start-->
<div class="banner-slider" style="background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo $category['category_banner']; ?>)">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?php echo 'CATEGORY'; ?>: <?php echo $category['category_name']; ?></h1>
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
                foreach($news_by_category as $row) {
                    $_sSlugNews = slugify($row['news_title']);
                    $_sSlugCat = slugify($category['category_name'])
                    ?>
                    <div class="blog-one-item">
                        <div class="blog-one-photo">
                            <a href="<?=base_url("news/view/{$_sSlugNews}-{$row['news_id']}")?>">
                                <img src="<?=base_url($row['photo'])?>" alt="<?=$row['news_title']?>"/>
                            </a>
                        </div>
                        <div class="blog-one-text">
                            <ul>
                                <li><i class="fa fa-edit"></i>
                                    <a href="<?=base_url("category/{$_sSlugCat}-{$row['category_id']}")?>">
                                        <?=$category['category_name']?>
                                    </a>
                                </li>
                                <li><i class="fa fa-calendar-o"></i>
                                    <?=format_news_date($row['news_date'])?>
                                </li>
                            </ul>
                            <h3>
                                <a href="<?=base_url("news/view/{$_sSlugNews}-{$row['news_id']}")?>">
                                    <?=$row['news_title']; ?>
                                </a>
                            </h3>
                            <p>
                                <?php echo $row['news_content_short']; ?>
                            </p>
                            <div class="button-df">
                                <a href="<?=base_url("news/view/{$_sSlugNews}-{$row['news_id']}")?>">
                                    <?=READ_MORE?> <i class="fa fa-chevron-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                } // End Foreach;
                ?>
                
            </div>

            <!--Sidebar Start-->
            <?=render_sidebar($sidebar_items)?>
            <!--Sidebar End-->
        </div>
    </div>
</div>
<!--Blog-One End >
<?= $this->endSection() ?>