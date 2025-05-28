<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<!--Banner Start-->
<div class="banner-slider" style="background-image: url(<?=base_url($category['category_banner']); ?>)">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?=lang('Common.category')?><?=$category['category_name']?></h1>
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
                    $_sSlugNews = $row['slug'];
                    $_sSlugCat = $category['category_slug'];
                    ?>
                    <div class="blog-one-item">
                        <div class="blog-one-photo">
                            <a href="<?=base_url($_sSlugNews)?>">
                                <img src="<?=base_url($row['photo'])?>" alt="<?=$row['news_title']?>"/>
                            </a>
                        </div>
                        <div class="blog-one-text">
                            <ul>
                                <li><i class="fa fa-edit"></i>
                                    <a href="<?=base_url("category/{$_sSlugCat}")?>">
                                        <?=$category['category_name']?>
                                    </a>
                                </li>
                                <li><i class="fa fa-calendar-o"></i>
                                    <?=format_news_date($row['news_date'])?>
                                </li>
                            </ul>
                            <h3>
                                <a href="<?=base_url($_sSlugNews)?>">
                                    <?=$row['news_title']; ?>
                                </a>
                            </h3>
                            <p>
                                <?php echo $row['news_content_short']; ?>
                            </p>
                            <div class="button-df">
                                <a href="<?=base_url($_sSlugNews)?>">
                                    <?=lang('Common.read.more')?> <i class="fa fa-chevron-circle-right"></i>
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