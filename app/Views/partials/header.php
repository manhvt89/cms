<!--Header-Area Start-->
<div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-5 col-12">
                    <div class="header-social">
                        <ul>
                            <li>
                                <div class="social-bar">
                                    <ul>
                                        <?php
                                        foreach ($social as $row)
                                        {
                                            if($row['social_url']!='')
                                            {
                                                echo '<li><a href="'.$row['social_url'].'"><i class="'.$row['social_icon'].'"></i></a></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7 col-12">
                    <div class="header-info">
                        <ul class="first">
                            <li>
                                <i class="fa fa-envelope"></i>
                                <span><?php echo $setting['top_bar_email']; ?></span>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                <span><?php echo $setting['top_bar_phone']; ?></span>
                            </li>
                        </ul>

                        <?php if($setting['language_status'] == 'Show'): ?>
                        <div class="lang-right">
                        <?= form_open(base_url().'lang/change'); ?>
                            <select name="lang_change_id" class="form-control" onchange="this.form.submit()">
                                <?php
                                
                                foreach($all_language as $row)
                                {
                                    ?>
                                    <option value="<?php echo $row['lang_id']; ?>" <?php if($row['lang_id'] == $_SESSION['sess_lang_id']) {echo 'selected';} ?>><?php echo $row['lang_short_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        <?= form_close(); ?>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Header-Area End-->

    <!--Menu Start-->
    <div id="strickymenu" class="menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="logo flex">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url($setting['logo']); ?>" alt="Logo"></a>
                    </div>
                </div>
                <div class="col-lg-9 col-12 main-menu">
                    <div class="main-menu-item">
                                <!-- Menu render tự động -->
                            <?= get_menu_html('mainmenu', [
                                'ul_class' => 'nav-menu',
                                'li_class' => '',
                                'a_class' => '',
                                'active_class' => 'current-menu-item'
                            ]) ?>
                            <!-- End menu -->
                    </div>
                    <div class="searchbar">
                        <div class="search-button"><i class="fa fa-search"></i></div>
                        <?php echo form_open(base_url().'search'); ?>
                            <div class="input-group input-search">
                                <input type="text" class="form-control" placeholder="<?php echo 'SEARCH_FOR'; ?>" name="search_string">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="form1"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Menu End-->