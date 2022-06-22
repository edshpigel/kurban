<?php

$post_id = get_the_ID();
if ($args['content_show']) {
    $post_id = get_option('page_on_front');
}
$show_block = get_field('show_block', $post_id);
if ($show_block['farm']) : ?>

    <section class="farm" id="farm">
        <div class="container">
            <div class="farm__flex">
                <div class="farm__gal">
                    <?php
                    $farm_slider = get_field('farm_slider', $post_id);
                    if ($farm_slider) : ?>
                        <div class="swiper-group">
                            <div class="farm-swiper swiper-container">
                                <div class="swiper-wrapper">
                                    <?php foreach ($farm_slider as $image) : ?>
                                        <div class="farm__item swiper-slide">
                                            <a href="<?php echo esc_url($image['url']); ?>" data-fancybox="farm-fancybox" data-caption="<?php echo esc_html($image['caption']); ?>">
                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="swiper-buttons-group">
                                <div class="swiper-prev-farm swiper-button-prev-secondary swiper-button-prev"></div>
                                <div class="swiper-next-farm swiper-button-next-secondary swiper-button-next swiper-button-primary"></div>
                            </div>
                            <div class="swiper-pagination-group">
                                <div class="farm-pagination swiper-pagination"></div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="farm__content">
                    <div class="farm__text strong-primary content-field"><?php the_field('farm_text', $post_id); ?></div>
                    <?php if (have_rows('farm_nums', $post_id)) : ?>
                        <div class="farm__nums">
                            <?php while (have_rows('farm_nums', $post_id)) : the_row(); ?>
                                <div class="farm__nums__item">
                                    <div class="farm__nums__title large-h"><?php the_sub_field('num', $post_id); ?></div>
                                    <div class="farm__nums__subtitle h5"><?php the_sub_field('text', $post_id); ?></div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>