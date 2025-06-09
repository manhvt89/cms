<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" >
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" >
    <meta name="description" content="<?=$meta_description ?? "" ?>">
    <meta name="keywords" content="<?=$meta_keywords ?? "" ?>">
    <meta name="title" content="<?=$meta_title ?? "" ?>">
    <title><?=$meta_title ?? "" ?></title>

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="<?= $meta_title ?>">
    <meta property="og:description" content="<?= $meta_description ?>">
    <meta property="og:type" content="<?= $type ?>">
    <meta property="og:url" content="<?= current_url() ?>">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url($setting['favicon']) ?>">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?=base_url("public/css/animate.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/css/bootstrap.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/css/jquery-ui.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/css/font-awesome.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/css/owl.carousel.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/css/magnific-popup.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/css/meanmenu.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/css/toastr.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/css/style.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/css/spacing.css")?>">
    <link rel="stylesheet" href="<?=base_url("public/css/responsive.css")?>">
    
    <?php if(session('sess_layout_direction') == 'Right'): ?>
    <link rel="stylesheet" href="<?= base_url('public/css/rtl.css') ?>">
    <?php endif; ?>

    <!-- Dynamic Color Styles -->
    <style>
        .owl-carousel.blog-carousel .owl-item {
        display: flex;
        height: 100%;
        }

        .owl-carousel.blog-carousel .blog-item {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        }


        .header-area,
        .footer-item h3:before,
        .footer-item h3:after {
            background: #<?= $setting['front_end_color'] ?>!important;
        }
        /* Thêm các style động khác tương tự */
    </style>
</head>

<body>
    <?= $comment['code_body'] ?? '' ?>

    <?php if($setting['preloader_status'] == 'On'): ?>
    <!--Preloader Start-->
    <div id="preloader">
        <div id="status" style="background-image: url(<?= base_url('public/images/preloader.gif') ?>)"></div>
    </div>
    <!--Preloader End-->
    <?php endif; ?>

    <!-- Header Area -->
    <?= $this->include('partials/header') ?>

    <!-- Main Content -->
    <?= $this->renderSection('content') ?>

    <!-- Footer Area -->
    <?= $this->include('partials/footer') ?>

    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>public/js/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/jquery.meanmenu.js"></script>
    <script src="<?php echo base_url(); ?>public/js/jquery.filterizr.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/viewportchecker.js"></script>
    <script src="<?php echo base_url(); ?>public/js/toastr.min.js"></script>
    
    <script src="<?php echo base_url(); ?>public/js/custom.js"></script>

    <?php if(session('sess_layout_direction') == 'Left'): ?>
    <script src="<?= base_url('public/js/ltr.js') ?>"></script>
    <?php endif; ?>
    
    <?php if(session('sess_layout_direction') == 'Right'): ?>
    <script src="<?= base_url('public/js/rtl.js') ?>"></script>
    <?php endif; ?>

    <script>
        toastr.options = {
            "closeButton": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000"
        }
        
        <?php if(session()->getFlashdata('success')): ?>
        toastr.success('<?= session()->getFlashdata('success') ?>');
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('error')): ?>
        toastr.error('<?= session()->getFlashdata('error') ?>');
        <?php endif; ?>
    </script>

    <?php if($all_setting['tawk_live_chat_status'] == 'On'): ?>
    <?= $all_setting['tawk_live_chat_code'] ?>
    <?php endif; ?>
    <script>
        function setEqualHeight() {
                var maxHeight = 0;
                var bmaxHeight = 0;
                
                // Reset chiều cao trước
                $('.blog-carousel .blog-item').css('height', 'auto');
                $('.blog-carousel .blog-item blog-text').css('height', 'auto');

                $('.blog-carousel .blog-item').each(function () {
                    
                    var thisHeight = $(this).outerHeight();
                    if (thisHeight > maxHeight) {
                        maxHeight = thisHeight;
                    }
                    
                });

                $('.blog-carousel .blog-item').height(maxHeight);

                $('.blog-carousel .blog-item  .blog-text').each(function () {
                    var bthisHeight = $(this).outerHeight();
                    if (bthisHeight > bmaxHeight) {
                        bmaxHeight = bthisHeight;
                    }
                    
                });

                $('.blog-carousel .blog-item  .blog-text').height(bmaxHeight);

            }

            // Đảm bảo gọi sau khi carousel hoàn tất render
            $(document).ready(function () {
                var $carousel = $('.blog-carousel');

                $carousel.on('initialized.owl.carousel resized.owl.carousel refreshed.owl.carousel', function () {
                    setEqualHeight();
                });

                // Nếu carousel đã được init trước khi bạn gán sự kiện
                if ($carousel.hasClass('owl-loaded')) {
                    setTimeout(setEqualHeight, 300);
                }
            });
    
    $('#newsletterForm').on('submit', function(e) {
        e.preventDefault();
        let email = $('#email_subscribe').val();
        let $form = $(this);

        $.get('<?=base_url("get-csrf-token")?>', function (tokenData) {
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: {
                    email: email,
                    [tokenData.csrfName]: tokenData.csrfHash
                },
                success: function (response) {
                    $('#newsletterMessage').html('<span style="color:green;">' + response.message + '</span>');
                    $('#email').val('');
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON);
                    $('#newsletterMessage').html('<span style="color:red;">' + xhr.responseJSON.messages.message + '</span>');
                }
            });
        });
    });


</script>
</body>
</html>