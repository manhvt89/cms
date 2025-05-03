<?php
    $uri = service('uri');
    $segment = $uri->getSegment(2); // Lấy segment sau "admin"
    $router = \Config\Services::router();
    $class_name = $router->controllerName();
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="<?= ($segment == 'dashboard') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>


            
            <?php if($shop_is_active):?>
            <li class="treeview <?php if( ($class_name == 'page_home') || ($class_name == 'page_about') || ($class_name == 'page_faq') || ($class_name == 'page_service') || ($class_name == 'page_testimonial') || ($class_name == 'page_news') || ($class_name == 'page_event') || ($class_name == 'page_contact') || ($class_name == 'page_search') || ($class_name == 'page_team') || ($class_name == 'page_portfolio') || ($class_name == 'page_photo_gallery') || ($class_name == 'page_pricing') || ($class_name == 'page_term') || ($class_name == 'page_privacy') ) {echo 'active';} ?>">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>SHOP</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('admin/shop/dashboard')?>"><i class="icon-dashboard"></i><span class="hidden-tablet"> Dashboard</span></a></li>	
                    <li><a href="<?php echo base_url('admin/shop/add/category')?>"><i class="icon-th"></i><span class="hidden-tablet"> Add Category</span></a></li>
                    <li><a href="<?php echo base_url('admin/shop/manage/category')?>"><i class="icon-tasks"></i><span class="hidden-tablet"> Manage Category</span></a></li>
                    <li><a href="<?php echo base_url('admin/shop/add/brand')?>"><i class="icon-edit"></i><span class="hidden-tablet"> Add Brand</span></a></li>
                    <li><a href="<?php echo base_url('admin/shop/manage/brand')?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> Manage Brand</span></a></li>
                    <li><a href="<?php echo base_url('admin/shop/add/product')?>"><i class="icon-shopping-cart"></i><span class="hidden-tablet"> Add Product</span></a></li>
                    <li><a href="<?php echo base_url('admin/shop/manage/product')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Manage Product</span></a></li>
                    
                    <li><a href="<?php echo base_url('theme/option');?>"><i class="icon-align-justify"></i><span class="hidden-tablet"> Theme Option</span></a></li>
                    <li><a href="<?php echo base_url('admin/shop/manage/order');?>"><i class="icon-calendar"></i><span class="hidden-tablet"> Manage Order</span></a></li>
                </ul>
			</li>
            <?php endif; ?>    
                <li class="treeview <?php if( ($class_name == 'page_home') || ($class_name == 'page_about') || ($class_name == 'page_faq') || ($class_name == 'page_service') || ($class_name == 'page_testimonial') || ($class_name == 'page_news') || ($class_name == 'page_event') || ($class_name == 'page_contact') || ($class_name == 'page_search') || ($class_name == 'page_team') || ($class_name == 'page_portfolio') || ($class_name == 'page_photo_gallery') || ($class_name == 'page_pricing') || ($class_name == 'page_term') || ($class_name == 'page_privacy') ) {echo 'active';} ?>">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i>
                        <span>Page Section</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url(); ?>admin/pagehome"><i class="fa fa-circle-o"></i>Home Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pageabout"><i class="fa fa-circle-o"></i>About Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pagefaq"><i class="fa fa-circle-o"></i>FAQ Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pageservice"><i class="fa fa-circle-o"></i>Service Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pagetestimonial"><i class="fa fa-circle-o"></i>Testimonial Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pagenews"><i class="fa fa-circle-o"></i>News Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pageevent"><i class="fa fa-circle-o"></i>Event Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pagecontact"><i class="fa fa-circle-o"></i>Contact Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pagesearch"><i class="fa fa-circle-o"></i>Search Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pageteam"><i class="fa fa-circle-o"></i>Team Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pageportfolio"><i class="fa fa-circle-o"></i>Portfolio Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pagephoto-gallery"><i class="fa fa-circle-o"></i>Photo Gallery Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pagepricing"><i class="fa fa-circle-o"></i>Pricing Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pageterm"><i class="fa fa-circle-o"></i>Term Page</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pageprivacy"><i class="fa fa-circle-o"></i>Privacy Page</a></li>
                    </ul>
                </li>

            <li class="<?= ($segment == 'category') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/category') ?>"><i class="fa fa-folder-open"></i> <span>Category</span></a>
            </li>

            <li class="<?= ($segment == 'news') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/news') ?>"><i class="fa fa-newspaper-o"></i> <span>News</span></a>
            </li>

            <li class="<?= ($segment == 'event') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/event') ?>"><i class="fa fa-calendar"></i> <span>Event</span></a>
            </li>

            <li class="<?= ($segment == 'photo_gallery') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/photo_gallery') ?>"><i class="fa fa-image"></i> <span>Photo Gallery</span></a>
            </li>

            <li class="<?= ($segment == 'portfolio') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/portfolio') ?>"><i class="fa fa-briefcase"></i> <span>Portfolio</span></a>
            </li>

            <li class="treeview <?php if( ($class_name == 'footer_setting') ) {echo 'active';} ?>">
                <a href="<?php echo base_url(); ?>admin/footersetting">
                <i class="fa fa-cog"></i> <span>Footer Section</span>
                </a>
            </li>
            <?php //echo  $class_name; die();?>
            <li class="treeview <?php if( ($class_name == 'menugroup') ) {echo 'active';} ?>">
                <a href="<?php echo base_url(); ?>admin/menugroup">
                <i class="fa fa-file-text"></i> <span>Menu</span>
                </a>
            </li>

            <li class="treeview <?php if( ($class_name == 'lang') ) {echo 'active';} ?>">
                <a href="<?php echo base_url(); ?>admin/lang">
                <i class="fa fa-language"></i> <span>Language</span>
                </a>
            </li>
            <li class="treeview <?php if( ($class_name == 'slider') ) {echo 'active';} ?>">
                <a href="<?php echo base_url(); ?>admin/slider">
                <i class="fa fa-picture-o"></i> <span>Slider</span>
                </a>
            </li>
            <li class="<?= ($segment == 'service') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/service') ?>"><i class="fa fa-cogs"></i> <span>Services</span></a>
            </li>

            <li class="<?= ($segment == 'team') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/team') ?>"><i class="fa fa-users"></i> <span>Team</span></a>
            </li>

            <li class="<?= ($segment == 'testimonial') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/testimonial') ?>"><i class="fa fa-comments"></i> <span>Testimonials</span></a>
            </li>

            <li class="<?= ($segment == 'client') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/client') ?>"><i class="fa fa-handshake-o"></i> <span>Clients</span></a>
            </li>

            <li class="<?= ($segment == 'pricing') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/pricing') ?>"><i class="fa fa-money"></i> <span>Pricing Tables</span></a>
            </li>

            <li class="<?= ($segment == 'subscriber') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/subscriber') ?>"><i class="fa fa-envelope"></i> <span>Subscribers</span></a>
            </li>

            <li class="<?= ($segment == 'search') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/search') ?>"><i class="fa fa-search"></i> <span>Search</span></a>
            </li>

            <li class="<?= ($segment == 'settings') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/settings') ?>"><i class="fa fa-cogs"></i> <span>Settings</span></a>
            </li>

            <li class="<?= ($segment == 'whychoose') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/whychoose') ?>"><i class="fa fa-cogs"></i> <span>Why Choose</span></a>
            </li></li>

            <li>
                <a href="<?= base_url('admin/logout') ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
            </li>
        </ul>
    </section>
</aside>
