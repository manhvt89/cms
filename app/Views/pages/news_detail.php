<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<!--Banner Start-->
<div class="banner-slider" style="background-image: url(<?php echo base_url($news_detail['banner']); ?>)">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?=$news_detail['news_title']; ?></h1>
        </div>
    </div>
</div>
<!--Banner End-->
<!--Blog-One Start-->
<div class="blog-one-area pt_60 pb_90">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="single-blog">
                    <?=$news_detail['photo']?>
                    <h3><?=$news_detail['news_title']; ?></h3>
                    <ul>
                        <li><i class="fa fa-edit"></i><?=$news_detail["cat"]?></li>
                        <li><i class="fa fa-calendar-o"></i>
                            <?= $news_detail['news_date']?>
                        </li>
                    </ul>
                    <?php echo $news_detail['news_content']; ?>
                </div>
                
                <div class="comment-form headstyle mt_50">
                    <h4><?php echo SHARE_THIS_NEWS; ?></h4>
                    <?php $url = base_url().'news/view/'.$news_detail['news_id']; ?>
                    <div class="share_buttons">
                        <a class="facebook" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $url; ?>&t=<?php echo $news_detail['news_title']; ?>"><i class="fa fa-facebook-f"></i></a>

                        <a class="twitter" target="_blank" href="https://twitter.com/share?text=<?php echo $news_detail['news_title']; ?>&url=<?php echo $url; ?>"><i class="fa fa-twitter"></i></a>

                        <a class="pinterest" target="_blank" href="https://www.pinterest.com/pin/create/button/?description=<?php echo $news_detail['news_title']; ?>&media=&url=<?php echo $url; ?>"><i class="fa fa-pinterest"></i></a>

                        <a class="linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $news_detail['news_title']; ?>"><i class="fa fa-linkedin"></i></a>
                    </div>

                </div>

                <?php if($news_detail['comment'] == 'On'): ?>
                <div class="comment-form headstyle mt_50">
                    <h4><?php echo COMMENT; ?></h4>
                    <div class="comment-inner">
                        <?php
                        $final_url = base_url().'news/view/'.$id;
                        ?>
                        <div class="fb-comments" data-href="<?php echo $final_url; ?>" data-numposts="5"></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!--Sidebar Start-->
            <?=render_sidebar($sidebar_items)?>
            <!--Sidebar End-->
        </div>
    </div>
</div>
<!--Blog-One End-->

<?= $this->endSection() ?>