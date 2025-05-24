<?php
    $uri = service('uri');
    $segment = $uri->getSegment(2); // Lấy segment sau "admin"
    $router = \Config\Services::router();
    $class_name = $router->controllerName();
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree" role="menu">
            <?= render_admin_menu() ?>
        </ul>
    </section>
</aside>
