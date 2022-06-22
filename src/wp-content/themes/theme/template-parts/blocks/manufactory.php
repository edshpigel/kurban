<?php

$post_id = get_the_ID();
if ($args['content_show']) {
    $post_id = get_option('page_on_front');
}
$show_block = get_field('show_block', $post_id);
if ($show_block['manufactory']) : ?>

<section class="manufactory" id="manufactory">
    <div class="container">
        <div class="manufactory__flex">
            <div class="manufactory__content">
                <div class="manufactory__heading strong-primary"><?php the_field('manufactory_heading', $post_id); ?></div>
                <div class="manufactory__text  content-field"><?php the_field('manufactory_text', $post_id); ?></div>
                <?php if($manufactory_btn = get_field('manufactory_btn', $post_id)): ?>
                    <a href="<?php echo $manufactory_btn['url']; ?>" class="btn"><?php echo $manufactory_btn['title']; ?></a>
                <?php endif; ?>
            </div>
            <?php $manufactory_video_link = get_field('manufactory_video_link', $post_id); ?>
            <?php $manufactory_video_bg = get_field('manufactory_video_bg', $post_id); ?>
            <a href="<?php echo $manufactory_video_link; ?>" class="manufactory__video link-youtube">
                <div class="manufactory__video__btn btn-video h4">
                    <span>
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M51.4034 28.4001L17.6589 7.7778C17.3747 7.6041 17.0493 7.50925 16.7163 7.50301C16.3832 7.49678 16.0545 7.57938 15.764 7.74231C15.4735 7.90525 15.2316 8.14264 15.0632 8.43007C14.8949 8.7175 14.8062 9.04458 14.8062 9.37768V50.6224C14.8062 50.9555 14.8949 51.2825 15.0632 51.57C15.2316 51.8574 15.4735 52.0948 15.764 52.2577C16.0545 52.4207 16.3832 52.5033 16.7163 52.497C17.0493 52.4908 17.3747 52.3959 17.6589 52.2222L51.4034 31.5999C51.6775 31.4324 51.9039 31.1973 52.0611 30.9172C52.2182 30.637 52.3007 30.3212 52.3007 30C52.3007 29.6788 52.2182 29.363 52.0611 29.0829C51.9039 28.8027 51.6775 28.5676 51.4034 28.4001Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <div>
                        <span><?php the_field('manufactory_text_video', $post_id); ?></span>
                    </div>
                </div>
                <div class="manufactory__video__bg" style="background-image: url('<?php echo $manufactory_video_bg['url']; ?>');"></div>
            </a>
        </div>
    </div>
</section>

<?php endif; ?>