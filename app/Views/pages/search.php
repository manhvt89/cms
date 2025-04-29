<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<!--Banner Start-->
<div class="banner-slider" style="background-image: url(<?=base_url($setting['banner_search'])?>)">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?php echo $page_search['heading']; ?> <?php echo $search_string; ?></h1>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Event-Area Start-->
<div class="event-area pt_60 pb_90">
    <div class="container">
        <div class="row">
            <div class="col-12">
                
                <?php if(!$total): ?>
                <span style="color:red;"><?=NO_RESULT_FOUND?></span>
                <?php else: ?>
                <?php
                foreach($result as $row) {
                    $_sSlugNews = slugify($row['news_title']);
                    ?>
                    <div class="event-item">
                        <div class="row">
                            <div class="col-xl-3 col-lg-4">
                                <div class="event-photo" style="background-image: url(<?=base_url($row['photo']); ?>)"></div>
                            </div>
                            <div class="col-xl-9 col-lg-8">
                                <div class="event-body">
                                    <div class="event-header">
                                        <ul>
                                            <li class="event-header-left">
                                                <h4><?=$row['news_title']?></h4>
                                                <span><i class="fa fa-clock-o"></i><?=NEWS_DATE ?>:
                                                <?=format_news_date($row['news_date'])?>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="event-content">
                                        <p>
                                            <?=$row['news_content_short']; ?>
                                        </p>
                                        <div class="button-df">
                                            <a href="<?=base_url("news/view/{$_sSlugNews}-{$row['news_id']}")?>">
                                                <?=READ_MORE; ?> <i class="fa fa-chevron-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!--Event-Area End
<?= $this->endSection() ?>