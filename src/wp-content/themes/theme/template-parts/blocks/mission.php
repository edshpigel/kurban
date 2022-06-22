<?php

$post_id = get_the_ID();
if ($args['content_show']) {
    $post_id = get_option( 'page_on_front' );
}
$show_block = get_field('show_block', $post_id);
if ($show_block['mission']) : ?>

<section class="mission" id="mission">
    <div class="container">
        <div class="mission__flex">
            <div class="mission__imgs">
                <?php if($mission_img_1 = get_field('mission_img_1', $post_id)): ?>
                <div class="mission__first">
                    <div class="mission__first__wrapper">
                        <img src="<?php echo $mission_img_1['url']; ?>" alt="<?php echo $mission_img_1['alt']; ?>" class="">
                    </div>
                </div>
                <?php endif; ?>
                <div class="mission__group">
                    <?php if($mission_img_2 = get_field('mission_img_2', $post_id)): ?>
                    <div class="mission__second">
                        <div class="mission__second__wrapper">
                            <img src="<?php echo $mission_img_2['url']; ?>" alt="<?php echo $mission_img_2['alt']; ?>" class="">
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(get_field('mission_num', $post_id)): ?>
                    <div class="mission__num">
                        <div class="large-h"><?php the_field('mission_num', $post_id); ?></div>
                        <div class="mission__num__after"><?php the_field('mission_num_after', $post_id); ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mission__content">
                <div class="mission__text content-field strong-primray"><?php the_field('mission_text', $post_id); ?></div>
                <?php if($mission_btn = get_field('mission_btn', $post_id)): ?>
                    <a class="btn" href="<?php echo $mission_btn['url']; ?>"><?php echo $mission_btn['title']; ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>