<?php

use Config\Services;

use CodeIgniter\HTTP\URI;

if (!function_exists('slider')) {
    function slider($sliders = [])
    {
        $home_sliders = $sliders;
        if (empty($home_sliders)) return '';

        ob_start();
        ?>
        <div class="slider">
            <div class="slide-carousel slider-one owl-carousel">
                <?php foreach ($home_sliders as $slider): ?>
                    <div class="item slider-item flex" style="background-image:url(<?= base_url($slider['photo']) ?>);">
                        <div class="bg-slider"></div>
                        <div class="container">
                            <div class="row">
                                <div class="<?= $slider['position'] == 'Left' ? 'col-lg-6 col-md-9 col-12' : 'offset-lg-6 col-lg-6 offset-md-3 col-md-9 col-12' ?>">
                                    <div class="slider-text">
                                        <?php if (!empty($slider['heading'])): ?>
                                            <div class="text-animated">
                                                <h1><?= esc($slider['heading']) ?></h1>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($slider['content'])): ?>
                                            <div class="text-animated">
                                                <p><?= nl2br(esc($slider['content'])) ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($slider['button1_text']) || !empty($slider['button2_text'])): ?>
                                            <div class="text-animated">
                                                <ul>
                                                    <?php if (!empty($slider['button1_text'])): ?>
                                                        <li><a href="<?= esc($slider['button1_url']) ?>"><?= esc($slider['button1_text']) ?></a></li>
                                                    <?php endif; ?>
                                                    <?php if (!empty($slider['button2_text'])): ?>
                                                        <li><a href="<?= esc($slider['button2_url']) ?>"><?= esc($slider['button2_text']) ?></a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}
