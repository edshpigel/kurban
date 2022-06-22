<?php

$post_id = get_the_ID();
if ($args['content_show']) {
    $post_id = get_option('page_on_front');
}
$show_block = get_field('show_block', $post_id);
if ($show_block['faq']) : ?>

    <section id="faq" class="faq">
        <div class="container">
            <h2 class="faq__heading"><?php the_field('faq_heading', $post_id); ?></h2>
            <?php if (have_rows('faq_rep', $post_id)) : $i = 0; ?>
                <div class="faq__flex">
                    <?php while (have_rows('faq_rep', $post_id)) : the_row();
                        $i++; ?>
                        <div class="faq__item js-faq-item<?php echo ($i == 2 ? ' is-active' : ''); ?>">
                            <div class="faq__item__content">
                                <div class="faq__item__heading h5 js-question">
                                    <span><?php the_sub_field('question', $post_id); ?></span>
                                </div>
                                <div class="faq__item__subheading js-ask"><?php the_sub_field('ask', $post_id); ?></div>
                            </div>
                            <div class="faq__item__arrow js-arrow">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M26 12L16 22L6 12" stroke="#0054A4" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>