<?php

$post_id = get_the_ID();
if ($args['content_show']) {
    $post_id = get_option('page_on_front');
}
$show_block = get_field('show_block', $post_id);
if ($show_block['farm']) : ?>

    <section class="video-blog" id="video-blog">
        <div class="container">
            <div class="video-blog__heading strong-primary"><?php the_field('video_blog_heading', $post_id); ?></div>
            <?php if (have_rows('video_blog_rep', $post_id)) : ?>
                <div class="video-blog__flex js-video-blog-wrapper">
                    <?php while (have_rows('video_blog_rep', $post_id)) : the_row(); ?>
                        <div class="video-blog__item js-video-blog-item">
                            <?php $img = get_sub_field('img', $post_id); ?>
                            <a class="video-blog__item__wrapper link-youtube" href="<?php the_sub_field('link', $post_id); ?>">
                                <div class="video-blog__item__preview">
                                    <div class="video-blog__item__bg" style="background-image: url('<?php echo $img['url']; ?>');"></div>
                                    <div class="video-blog__item__icon">
                                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M51.4034 28.4001L17.6589 7.7778C17.3747 7.6041 17.0493 7.50925 16.7163 7.50301C16.3832 7.49678 16.0545 7.57938 15.764 7.74231C15.4735 7.90525 15.2316 8.14264 15.0632 8.43007C14.8949 8.7175 14.8062 9.04458 14.8062 9.37768V50.6224C14.8062 50.9555 14.8949 51.2825 15.0632 51.57C15.2316 51.8574 15.4735 52.0948 15.764 52.2577C16.0545 52.4207 16.3832 52.5033 16.7163 52.497C17.0493 52.4908 17.3747 52.3959 17.6589 52.2222L51.4034 31.5999C51.6775 31.4324 51.9039 31.1973 52.0611 30.9172C52.2182 30.637 52.3007 30.3212 52.3007 30C52.3007 29.6788 52.2182 29.363 52.0611 29.0829C51.9039 28.8027 51.6775 28.5676 51.4034 28.4001Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="video-blog__item__content">
                                    <div class="video-blog__item__yt-icon">
                                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.25 13L11.375 9.75V16.25L16.25 13Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M2.4375 13C2.4375 16.022 2.74972 17.7951 2.98706 18.7064C3.05051 18.9553 3.17234 19.1855 3.34248 19.3779C3.51261 19.5703 3.72615 19.7194 3.9654 19.8129C7.3654 21.1195 13 21.0836 13 21.0836C13 21.0836 18.6345 21.1195 22.0346 19.8129C22.2738 19.7195 22.4874 19.5703 22.6575 19.3779C22.8276 19.1855 22.9495 18.9553 23.0129 18.7064C23.2503 17.7951 23.5625 16.022 23.5625 13C23.5625 9.97792 23.2503 8.20482 23.0129 7.29351C22.9495 7.04463 22.8277 6.81444 22.6575 6.62202C22.4874 6.42961 22.2738 6.2805 22.0346 6.18706C18.6346 4.88048 13 4.91636 13 4.91636C13 4.91636 7.36546 4.88048 3.96543 6.18704C3.72618 6.28049 3.51264 6.42959 3.34251 6.62201C3.17237 6.81442 3.05053 7.04461 2.98709 7.2935C2.74973 8.2048 2.4375 9.97792 2.4375 13Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="video-blog__item__subtitle"><?php the_sub_field('text_before_heading', $post_id); ?></div>
                                        <div class="video-blog__item__title"><?php the_sub_field('name', $post_id); ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>