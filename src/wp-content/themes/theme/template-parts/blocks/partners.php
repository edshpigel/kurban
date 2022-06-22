<?php

$post_id = get_the_ID();
if ($args['content_show']) {
    $post_id = get_option('page_on_front');
}
$show_block = get_field('show_block', $post_id);
if ($show_block['partners']) : ?>

    <section class="partners" id="partners">
        <div class="container">
            <h2 class="partners__heading"><?php the_field('partners_heading', $post_id); ?></h2>
            <?php if (have_rows('partners_rep', $post_id)) : $i = 0; ?>
                <div class="partners__group">
                    <div class="swiper-prev-partners swiper-button-prev-secondary swiper-button-prev"></div>
                    <div class="swiper-next-partners swiper-button-next-secondary swiper-button-next"></div>
                    <div class="partners-swiper swiper-container">
                        <div class="swiper-wrapper">
                            <?php while (have_rows('partners_rep', $post_id)) : the_row();
                                $i++; ?>
                                <?php $img = get_sub_field('img', $post_id); ?>
                                <div class="swiper-slide">
                                    <div class="partners__item">
                                        <div class="partners__item__wrapper">
                                            <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <div class="swiper-pagination-group">
                        <div class="partners-pagination swiper-pagination"></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>