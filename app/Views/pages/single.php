<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<!--Banner Start-->
<div class="banner-slider">
    <div class="bg"></div>
    <div class="bannder-table">
        <div class="banner-text">
            <h1><?=$get_single_product["product_title"] ?></h1>
        </div>
    </div>
</div>
<!--Banner End-->
<!--Blog-One Start-->
<div class="blog-one-area pt_60 pb_90">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section group">
                    <div class="cont-desc span_1_of_2">				
                        <div class="grid images_3_of_2">
                            <img src="<?php echo base_url($get_single_product["product_image"])?>" alt="" />
                        </div>
                        <div class="desc span_3_of_2">
                            <h2><?=$get_single_product["product_title"]?></h2>
                            <p><?php echo $get_single_product["product_short_description"]?></p>					
                            <div class="price">
                                <p>Giá: <span><?=number_format($get_single_product["product_price"],0,",",".")?></span></p>
                                <p>Danh mục: <span><?=$get_single_product["category_name"]?></span></p>
                                <p>Thương hiệu:<span><?=$get_single_product["brand_name"]?></span></p>
                            </div>
                            <div class="add-cart">
                                <form action="<?php echo base_url('save/cart');?>" method="post">
                                    <input type="number" class="buyfield" name="qty" value="1"/>
                                    <input type="hidden" class="buyfield" name="product_id" value="<?=$get_single_product["product_id"]?>"/>
                                    <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
                                </form>				
                            </div>
                        </div>
                        <div class="product-desc">
                            <h2>Mô tả chi tiết</h2>
                            <p><?=$get_single_product["product_long_description"]?></p>
                        </div>

                    </div>
                    <div class="rightsidebar span_3_of_1">
                        <h2>Danh mục</h2>
                        <ul>
                            <?php foreach($get_all_category as $single_category){?>
                            <li><a href="<?php echo base_url('get/category/'.$single_category["id"]);?>"><?php echo $single_category["category_name"]?></a></li>
                            <?php }?>
                        </ul>

                    </div>
                </div>
            </div>

            <!--Sidebar Start-->
            <?=render_sidebar($sidebar_items)?>
            <!--Sidebar End-->
        </div>
    </div>
</div>
<!--Blog-One End-->

<?= $this->endSection() ?>