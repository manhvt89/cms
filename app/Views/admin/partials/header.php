<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url('admin/dashboard') ?>" class="logo">
        <span class="logo-mini"><b>A</b>D</span>
        <span class="logo-lg"><b>Admin</b>Panel</span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Right navbar -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Dropdown -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url('public/admin/img/no-photo.jpg') ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= session('email') ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= base_url('public/admin/img/no-photo.jpg') ?>" class="img-circle" alt="User Image">
                            <p><?= session('email') ?></p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= base_url('admin/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= base_url('admin/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
