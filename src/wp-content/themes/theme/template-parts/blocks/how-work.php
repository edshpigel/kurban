<?php

$post_id = get_the_ID();
if ($args['content_show']) {
    $post_id = get_option('page_on_front');
}
$show_block = get_field('show_block', $post_id);
if ($show_block['how_work']) : ?>


    <section class="how-work" id="how-work">
        <div class="container">
            <div class="how-work__heading strong-primary"><?php the_field('how_work_heading', $post_id); ?></div>
            <?php if (have_rows('how_work_rep', $post_id)) : ?>
                <div class="how-work__flex">
                    <?php while (have_rows('how_work_rep', $post_id)) : the_row(); ?>
                        <div class="how-work__item">
                            <div class="how-work__item__wrapper">
                                <div class="how-work__top">
                                    <div class="how-work__item__num"><span></span></div>
                                    <?php if ($icon = get_sub_field('icon', $post_id)) : ?>
                                        <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" class="how-work__item__img">
                                    <?php endif; ?>
                                </div>
                                <div class="how-work__item__content">
                                    <h4 class="how-work__item__heading"><?php the_sub_field('heading', $post_id); ?></h4>
                                    <div class="how-work__item__text"><?php the_sub_field('text', $post_id); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>