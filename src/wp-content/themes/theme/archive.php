<?php

/*
 * Template name: Страница Магазина	
 */

get_header();

?>

<section class="page" id="page">
    <div class="container">
        <?php echo get_template_part('template-parts/breadcrumbs'); ?>
        <h2><?php the_title(); ?></h2>
        <div class="page-content">
            <?php echo get_template_part('template-parts/content'); ?>
        </div>
    </div>
</section>



<?php get_footer(); ?>