<?php

use Config\Services;


if (!function_exists('set_meta_defaults')) {
    /**
     * Đặt giá trị mặc định cho các meta fields
     *
     * @param array $data
     * @param array $fields
     * @return array
     */
    function set_meta_defaults(array $data, array $fields = ['meta_title', 'meta_keywords', 'meta_description']): array
    {
        foreach ($fields as $field) {
            $data[$field] = $data[$field] ?? '';
        }
        return $data;
    }
}

if (!function_exists('get_meta')) {
    function get_meta(string $tag,string $defaul_value)
    {
        $request = Services::request();
        $meta_tag = trim($request->getPost($tag));
        $meta_tag = $meta_tag !== '' ? $meta_tag : $defaul_value;
        return $meta_tag;
    }
}            

if (!function_exists('flash_message')) {
    function flash_message()
    {
        $session = session();

        if ($session->getFlashdata('error')) {
            $error = esc($session->getFlashdata('error'));
            $msg = "";
            if(is_array($error))
            {
                
                foreach($error as $sr)
                {
                    $msg = "{$msg}<p>{$sr}</p>";
                }

            } else {
                $msg = $error;
            }
            return <<<HTML
                <div class="callout callout-danger">
                    <p>{$msg}</p>
                </div>
                HTML;
        }

        if ($session->getFlashdata('success')) {
            $success = esc($session->getFlashdata('success'));
            return <<<HTML
                <div class="callout callout-success">
                    <p>{$success}</p>
                </div>
                HTML;
        }
        return ''; // Không có flash
    }
}


if (!function_exists('form_wp_photo')) {
    /**
     * Summary of form_wp_photo
     * @param array $input = ['name';'id','label',require=>true/false,atribute]
     * @return string
     */
    function form_wp_photo(string $name='', string $value='', string $id='', string $label='', bool $require = false,string $classLabel='')
    {
        //echo $name; die();
        if($name != '')
        {
            $id = $id == '' ? $name: $id;
            
            $label = $require ? "{$label} *": $label;
            $src = $value ? base_url($value) : "https://via.placeholder.com/300x200?text=Chưa+chọn+ảnh";
            $imagePreview = "<img src=\"{$src}\" alt=\"{$label}\" style=\"max-height: 150px; display:block;\" id=\"{$id}-preview\">";
            
            $classLabel = empty($classLabel) ? 'col-sm-12' : $classLabel;

            //echo $label;die();
            return <<<HTML
                    <div class="form-group">
                        <label for="{$id}" class="{$classLabel} control-label">{$label}</label>
                        <div id="{$id}-wrapper" class="wp-featured-wrapper">
                            {$imagePreview}
                            <input type="hidden" name="{$name}" id="{$id}" value="{$value}">
                            <div class="wp-btns">
                                <button type="button" class="btn btn-primary btn-sm" onclick="openMediaPopup('{$id}')">Chọn ảnh</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeFeaturedPhoto('{$id}')">Xóa</button>
                            </div>
                        </div>
                    </div>
                    HTML;
        } else {
            return '';
        }
    }

}


/**
 * Cache thông minh – giống Laravel's remember()
 */
if (!function_exists('slugify')) {
    function slugify($str) {
        
        // Bỏ dấu tiếng Việt
        $str = mb_strtolower($str, 'UTF-8');
        $str = preg_replace([
            // loại bỏ dấu tiếng Việt
            '/[áàảãạăắằẳẵặâấầẩẫậ]/u',
            '/[éèẻẽẹêếềểễệ]/u',
            '/[íìỉĩị]/u',
            '/[óòỏõọôốồổỗộơớờởỡợ]/u',
            '/[úùủũụưứừửữự]/u',
            '/[ýỳỷỹỵ]/u',
            '/[đ]/u',
            // loại bỏ ký tự không mong muốn
            '/[^a-z0-9\s-]/u',
            // thay thế khoảng trắng bằng dấu gạch ngang
            '/[\s]+/u'
        ], [
            'a', 'e', 'i', 'o', 'u', 'y', 'd', '', '-'
        ], $str);

        // Xóa dấu gạch ngang ở đầu/cuối
        return trim($str, '-');
    }
}


if (!function_exists('render_sidebar')) {
    /**
     * Render Sidebar
     * 
     * @param array $sidebar_items
     *  [
     *    'search_form' => [ 'action_url' => base_url('search') ],
     *    'categories'  => [ 'categories' => $all_categories ],
     *    'recent_posts'=> [ 'news' => $news, 'setting' => $setting ]
     *  ]
     * @return string
     */
    function render_sidebar(array $sidebar_items = []): string
    {
        
        ob_start();
        ?>
        <div class="col-lg-4">
            <div class="sidebar">
                <?php
                foreach ($sidebar_items as $item_name => $item_data) {
                    $function_name = "sidebar_item_{$item_name}";
                    if (function_exists($function_name)) {
                       
                        echo $function_name($item_data);
                    }
                }
                
                ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}


if (!function_exists('format_date')) {
    /**
     * Format date to 'Month day, Year' format
     *
     * @param string $date
     * @return string
     */
    function format_date(string $date): string
    {
        $timestamp = strtotime($date);
        if (!$timestamp) return '';

        return date('F d, Y', $timestamp);
    }
}

function sidebar_item_search_form(array $data)
{
    $action_url = $data['action_url'] ?? base_url('search');

    ob_start();
    ?>
    <div class="sidebar-item">
        <?= form_open($action_url); ?>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="<?= SEARCH_FOR; ?>" name="search_string" autocomplete="off">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name="form1"><i class="fa fa-search"></i></button>
            </span>
        </div>
        <?= form_close(); ?>
    </div>
    <?php
    return ob_get_clean();
}

function sidebar_item_categories(array $data)
{
    $categories = $data['items'] ?? [];

    ob_start();
    ?>
    <div class="sidebar-item">
        <h3><?= SIDEBAR_NEWS_HEADING_1; ?></h3>
        <ul>
            <?php foreach ($categories as $row): ?>
                <?php $_sSlug = $row["category_slug"]; ?>
                <li><a href="<?= base_url("category/{$_sSlug}"); ?>"><?= $row['category_name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
    return ob_get_clean();
}

if (!function_exists('sidebar_item_recent_posts')) {
    function sidebar_item_recent_posts(array $data)
    {
        $news = $data['items'] ?? [];
        $count = $data['count'] ?? 5;
        //var_dump($data);die();
        ob_start();
        ?>
        <div class="sidebar-item">
            <h3><?= SIDEBAR_NEWS_HEADING_2; ?></h3>
            <?php
            $i = 0;
            foreach ($news as $row) {
                $i++;
                if ($i > $count) {
                    break;
                }
                $_sSlugNew = $row['slug'];
                ?>
                <div class="sidebar-recent-item">
                    <div class="recent-photo">
                        <a href="<?= base_url("{$_sSlugNew}"); ?>">
                            <img src="<?= base_url($row['photo']); ?>" alt="<?=$row["news_title"]?>">
                        </a>
                    </div>
                    <div class="recent-text">
                        <a href="<?= base_url("{$_sSlugNew}"); ?>">
                            <?= $row['news_title']; ?>
                        </a>
                        <div class="rpwwt-post-date">
                            <?= format_news_date($row['news_date']); ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('format_news_date')) {
    function format_news_date(string $date_string): string
    {
        $dt = explode('-', $date_string);
        if (count($dt) !== 3) return $date_string; // fallback nếu sai định dạng

        $months = [
            '01' => 'tháng 1', '02' => 'tháng 2', '03' => 'tháng 3',
            '04' => 'tháng 4',   '05' => 'tháng 5',      '06' => 'tháng 6',
            '07' => 'tháng 7',    '08' => 'tháng 8',   '09' => 'tháng 9',
            '10' => 'tháng 10', '11' => 'November', '12' => 'December',
        ];

        //$month = $months[$dt[1]] ?? '';
        return "{$dt[2]}, tháng {$dt[1]}, năm {$dt[0]}";
    }
}

if (!function_exists('footer_recent_posts')) {
    function footer_recent_posts(array $data)
    {
        $all_news = $data['all_news'] ?? [];
        $limit = $data['limit'] ?? 5; // fallback mặc định 5 bài

        ob_start();
        ?>
        <div class="footer-item footer-recent-post">
            <h3><?= FOOTER_2_HEADING ?></h3>
            <ul>
                <?php
                $i = 0;
                foreach ($all_news as $news) {
                    $i++;
                    if ($i > $limit) {
                        break;
                    }
                    $_sSlugNews = slugify($news['news_title']);
                    ?>
                    <li>
                        <a href="<?= base_url("news/view/{$_sSlugNews}-{$news['news_id']}") ?>">
                            <?= esc($news['news_title']) ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
        return ob_get_clean();
    }
}


if (!function_exists('footer_recent_portfolio')) {
    function footer_recent_portfolio(array $data)
    {
        $portfolio_items = $data['portfolio_items'] ?? [];
        $limit = $data['limit'] ?? 6; // Mặc định hiển thị 6 dự án

        ob_start();
        ?>
        <div class="footer-item">
            <h3><?= FOOTER_3_HEADING ?></h3>
            <div class="row pl-10 pr-10">
                <?php
                $i = 0;
                foreach ($portfolio_items as $item) {
                    $i++;
                    if ($i > $limit) {
                        break;
                    }
                    //var_dump($item);die();
                    $photo_url = base_url( $item['photo']);
                    $detail_url = base_url("portfolio/view/{$item['name']}-{$item['id']}");
                    ?>
                    <div class="col-4 footer-project">
                        <a href="<?= $detail_url ?>">
                            <img src="<?= $photo_url ?>" alt="<?=$item['name']?>">
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}


if (!function_exists('word_limiter')) {
    function word_limiter($str, $limit = 100, $end_char = '…') {
        $words = explode(' ', strip_tags($str));
        if (count($words) <= $limit) return $str;
        return implode(' ', array_slice($words, 0, $limit)) . $end_char;
    }
}

if (!function_exists('shop_is_active')) {
    function shop_is_active()
    {
        return true;
    }
}
/*
** Hiển thị sản phẩm
*/
if (!function_exists('the_product')) {
    function the_product($product)
    {
        $_sTheProductTitle = the_product_title($product);
        $_sTheProductImage = the_product_image($product);
        $_sTheProductSescription = the_product_description($product);
        $_sthe_product_price = the_product_price($product);
        $_sthe_view_product = the_view_product($product);
        return <<<HTML
                <div class="product-card">
                    {$_sTheProductImage}
                    {$_sTheProductTitle}
                    {$_sTheProductSescription}
                    {$_sthe_product_price}
                    {$_sthe_view_product}
                </div>
                HTML;
    }
}

if (!function_exists('the_product_title')) {
    function the_product_title($product)
    {
        $_sTitle = $product["product_title"];
        return <<<HTML
                  <h3 class="product-title">{$_sTitle}</h3>
                HTML;
    }
}

if (!function_exists('the_product_image')) {
    function the_product_image($product)
    {
        $_sSlug = slugify($product["product_title"]);
        $_sHref = base_url("product_detail/{$_sSlug}-{$product["product_id"]}");
        $_sImageSrc = base_url($product["product_image"]);
        
        return <<<HTML
        <div class="product-image">
            <a href="{$_sHref}">
                <img src="{$_sImageSrc}" alt="{$product["product_title"]}">
            </a>
        </div>
        HTML;
    }
}

if (!function_exists('the_product_description')) {
    function the_product_description($product)
    {                        
        $_sDescription = word_limiter($product["product_short_description"], 10);                      
                                              
        return <<<HTML
                    <p class="product-description">{$_sDescription}</p>
                HTML;
    }
}
if (!function_exists('the_product_price')) {
    function the_product_price($product)
    {
        $_sPrice = number_format($product["product_price"],0,',','.');
        return <<<HTML
                    <p class="product-price">{$_sPrice} vnđ</p>
                HTML;
    }
}

if (!function_exists('the_product_quantity')) {
    function the_product_quantity()
    {
        return <<<HTML
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://via.placeholder.com/300x300.png?text=Product+Image" alt="Sản phẩm 1">
                    </div>
                    <h3 class="product-title">Sản phẩm 1</h3>
                    <p class="product-description">Mô tả ngắn của sản phẩm sẽ hiển thị ở đây.</p>
                    <p class="product-price">1,200,000 vnd</p>
                    <button class="product-button">Details</button>
                </div>
                HTML;
    }
}

if (!function_exists('the_short_cart')) {
    function the_short_cart()
    {
        return <<<HTML
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://via.placeholder.com/300x300.png?text=Product+Image" alt="Sản phẩm 1">
                    </div>
                    <h3 class="product-title">Sản phẩm 1</h3>
                    <p class="product-description">Mô tả ngắn của sản phẩm sẽ hiển thị ở đây.</p>
                    <p class="product-price">1,200,000 vnd</p>
                    <button class="product-button">Details</button>
                </div>
                HTML;
    }
}

if (!function_exists('the_cart')) {
    function the_cart()
    {
        return <<<HTML
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://via.placeholder.com/300x300.png?text=Product+Image" alt="Sản phẩm 1">
                    </div>
                    <h3 class="product-title">Sản phẩm 1</h3>
                    <p class="product-description">Mô tả ngắn của sản phẩm sẽ hiển thị ở đây.</p>
                    <p class="product-price">1,200,000 vnd</p>
                    <button class="product-button">Details</button>
                </div>
                HTML;
    }
}

if (!function_exists('the_add_to_cart')) {
    function the_add_to_cart()
    {
        return <<<HTML
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://via.placeholder.com/300x300.png?text=Product+Image" alt="Sản phẩm 1">
                    </div>
                    <h3 class="product-title">Sản phẩm 1</h3>
                    <p class="product-description">Mô tả ngắn của sản phẩm sẽ hiển thị ở đây.</p>
                    <p class="product-price">1,200,000 vnd</p>
                    <button class="product-button">Details</button>
                </div>
                HTML;
    }
}

if (!function_exists('the_view_product')) {
    function the_view_product($product)
    {
        $slug = slugify($product["product_title"]);
        $href = base_url("product_detail/{$slug}-{$product["product_id"]}");
        $buyUrl = base_url("cart/add/{$product["product_id"]}");

        return <<<HTML
        <div class="product-actions">
            <button class="product-button view-btn" onclick="window.location.href='{$href}'">
                <i class="fas fa-eye"></i> Xem sản phẩm
            </button>
            <button class="product-button buy-btn" onclick="window.location.href='{$buyUrl}'">
                <i class="fas fa-shopping-cart"></i> Mua hàng
            </button>
        </div>
        HTML;
    }
}

