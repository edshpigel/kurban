<?php

/*
 * Template name: Страница Page	
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

<?php echo get_template_part('template-parts/content', 'blocks'); ?>

<?php get_footer(); ?>