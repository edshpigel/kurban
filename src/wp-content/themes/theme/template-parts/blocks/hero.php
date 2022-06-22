<?php

$post_id = get_the_ID();
if ($args['content_show']) {
    $post_id = get_option('page_on_front');
}
$show_block = get_field('show_block', $post_id);
if ($show_block['hero']) : ?>

    <section class="hero" id="hero">
        <div class="hero__wrapper">
            <div class="container">
            <div class="header__space"></div>
                <div class="hero__content">
                    <div class="hero__side-1">
                        <div class="hero__text">
                            <div class="hero__heading"><?php the_field('hero_heading', $post_id); ?></div>
                            <div class="h4"><?php the_field('hero_h2', $post_id); ?></div>
                        </div>
                        <div class="hero__mobile-btn">
                            <?php if ($hero_btn = get_field('hero_btn', $post_id)) : ?>
                                <a href="<?php echo $hero_btn['url']; ?>" class="hero__mobile-btn btn"><?php echo $hero_btn['title']; ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="hero__num">
                            <div class="large-h"><?php the_field('hero_people', $post_id); ?></div>
                        </div>
                    </div>
                    <div class="hero__links">
                        <?php if (get_field('donate_on_1', 'options')) : ?>
                            <div class="hero__link js-donate-link" data-donate-link="donate-1">
                                <h4 class="hero__donate__title"><?php the_field('donate_on_1','options'); ?></h4>
                                <div class="hero__donate__btn">
                                    <span class="hero__donate__icon">
                                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.75 4.875L17.875 13L9.75 21.125" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span>Выбрать барашка</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (get_field('donate_on_2', 'options')) : ?>
                            <div class="hero__link js-donate-link" data-donate-link="donate-2">
                                <h4 class="hero__donate__title"><?php the_field('donate_on_2','options'); ?></h4>
                                <div class="hero__donate__btn">
                                    <span class="hero__donate__icon">
                                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.75 4.875L17.875 13L9.75 21.125" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span>Выбрать барашка</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (get_field('donate_on_3', 'options')) : ?>
                            <div class="hero__link js-donate-link" data-donate-link="donate-3">
                                <h4 class="hero__donate__title"><?php the_field('donate_on_3','options'); ?></h4>
                                <div class="hero__donate__btn">
                                    <span class="hero__donate__icon">
                                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.75 4.875L17.875 13L9.75 21.125" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span>Выбрать барашка</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <h6 class="hero__num__subtitle"><?php the_field('hero_people_h2', $post_id); ?></h6>
                    </div>
                </div>
                <?php if ($hero_bg = get_field('hero_bg', $post_id)) : ?>
                    <div class="hero__bg" style="background-image: url('<?php echo $hero_bg['url']; ?>');"></div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>