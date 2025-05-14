<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<style>
  .pagination {
    display: inline-flex;
    padding-left: 0;
    list-style: none;
    border-radius: 4px;
  }
  .pagination li {
    margin: 0 5px;
  }
  .pagination li a {
    color: #007bff;
    padding: 8px 12px;
    text-decoration: none;
    border: 1px solid #dee2e6;
    border-radius: 4px;
  }
    .pagination li.active a {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .product-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 16px;
        width: 300px;
        text-align: center;
        font-family: Arial, sans-serif;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .product-image {
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        border-radius: 6px;
        margin-bottom: 12px;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
  display: block;
}

.product-title {
  font-size: 18px;
  margin: 8px 0;
}

.product-description {
  font-size: 14px;
  color: #555;
  margin: 8px 0;
  height: 38px;
  overflow: hidden;
}

.product-price {
  font-size: 16px;
  color: #e53935;
  font-weight: bold;
  margin: 8px 0;
}

.product-button {
  background-color: #337ab7;
  color: white;
  border: none;
  padding: 10px 16px;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
}

.product-button:hover {
  background-color: #286090;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
                $arr_chunk_product = array_chunk($get_all_product, 4);
                foreach($arr_chunk_product as $chunk_products) {
                    
                    ?>
                    <div class="row">
                    <?php foreach ($chunk_products as $row) { 
                        
                        $_sSlug = slugify($row["product_title"]);
                    
                        $_sSlugCat = slugify($row["category_name"]);

                        ?>
                        <div class="col-md-6">
                            <div class="grid_1_of_4 images_1_of_4">
                                <?=the_product($row)?>    
                            </div>
                        </div>
                    <?php } ?>    
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