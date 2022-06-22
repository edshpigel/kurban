<?php

$post_id = get_the_ID();
if ($args['content_show']) {
    $post_id = get_option('page_on_front');
}
$show_block = get_field('show_block', $post_id);
if ($show_block['gal']) : ?>

<section class="gal" id="gal">
    <div class="container">
        <div class="gal__headings">
            <div class="gal__heading"><?php the_field('gal_heading', $post_id); ?></div>
            <div class="gal__subtitle"><?php the_field('gal_subheading', $post_id); ?></div>
        </div>
        <?php 
        $gal_rep = get_field('gal_rep');
        if( $gal_rep ): ?>
        <div class="gal__slider">
            <div class="gal-swiper">
                <div class="swiper-wrapper">
                    <?php foreach( $gal_rep as $image ): ?>
                    <div class="swiper-slide gal__item">
                        <a class="gal__item__wrapper" data-fancybox="gal-fancybox" data-caption="<?php echo esc_html($image['caption']); ?>" href="<?php echo esc_url($image['url']); ?>">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="swiper-prev-gal swiper-button-prev swiper-button-prev-secondary"></div>
            <div class="swiper-next-gal swiper-button-next swiper-button-next-secondary"></div>
            <div class="swiper-pagination-group gal__slider__pag">
                <div class="swiper-pagination gal-pagination"></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php endif; ?>