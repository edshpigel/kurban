<?php

/*
 * Template name: Страница Спасибо	
 */

get_header();

?>

<section class="thanks" id="thanks">
    <div class="header__space"></div>
    <div class="container">
        <?php get_template_part('template-parts/breadcrumbs'); ?>
        <div class="thanks__wrapper">
            <div class="thanks__content">
                <h1 class="thanks__heading">Спасибо за ваше<br>пожертвование!</h1>
                <div class="thanks__h2 content-field"><p>Ваш пожертвование поступит нуждающимся <br>и отчет появится в наших социальных сетях</p></div>
                <a href="/" class="btn">
                    Перейти на главную
                </a>
            </div>
            <div class="thanks__img">
                <?php
                $form_manager = get_field('form_manager', $post_id);
                $form_bg = get_field('form_bg', $post_id);
                ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/thanks.png" alt="<?php echo $form_manager['alt']; ?>">
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>