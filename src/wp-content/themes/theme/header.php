<?php

/**
 * Header.php
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title><?php wp_title(); ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
    <script type="text/javascript" src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>

</head>

<body <?php body_class(); ?>>

    <div class="screen-page">
        <header class="header<?php if(!(is_front_page())){echo " white-header";} ?>" id="header">
            <div class="container">
                <div class="header__city mobile-city js-header-city">
                    <a class="link-city current_city city-init ">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.04482 2.60112L5.24978 11.8599C5.27996 11.9471 5.33693 12.0225 5.41255 12.0754C5.48817 12.1282 5.57856 12.1558 5.67081 12.1542C5.76306 12.1526 5.85244 12.1219 5.92618 12.0664C5.99992 12.011 6.05423 11.9336 6.08137 11.8455L7.36956 7.65881C7.39055 7.59061 7.4279 7.52857 7.47836 7.47812C7.52882 7.42766 7.59085 7.39031 7.65905 7.36932L11.8457 6.08112C11.9339 6.05399 12.0112 5.99967 12.0667 5.92594C12.1221 5.8522 12.1529 5.76282 12.1545 5.67057C12.1561 5.57832 12.1285 5.48793 12.0756 5.41231C12.0227 5.33669 11.9473 5.27972 11.8601 5.24954L2.60136 2.04458C2.52378 2.01772 2.4402 2.01324 2.36018 2.03164C2.28017 2.05004 2.20695 2.09059 2.14889 2.14865C2.09084 2.2067 2.05029 2.27993 2.03188 2.35994C2.01348 2.43995 2.01796 2.52353 2.04482 2.60112V2.60112Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="city-name current-main-city">Казань</span>
                    </a>
                </div>
                <div class="header__flex">
                    <div class="header__mobile js-header-hamburger">
                        <div class="header__mobile__wrapper">
                            <span></span>
                        </div>
                    </div>
                    <div class="header__logo">
                        <a href="/">
                            <?php $logo = get_field('logo', 'options'); ?>
                            <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                            <div>
                                <span class="name-company strong-primary"><?php the_field('name_company', 'options'); ?></span>
                                <span class="desc-company"><?php the_field('desc_company', 'options'); ?></span>
                            </div>
                        </a>
                    </div>
                    <div class="header__group">
                        <div class="header__top js-header-top">
                            <div class="header__top__flex">
                                <div class="header__city js-header-city">
                                    <a class="link-city current_city city-init">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.04482 2.60112L5.24978 11.8599C5.27996 11.9471 5.33693 12.0225 5.41255 12.0754C5.48817 12.1282 5.57856 12.1558 5.67081 12.1542C5.76306 12.1526 5.85244 12.1219 5.92618 12.0664C5.99992 12.011 6.05423 11.9336 6.08137 11.8455L7.36956 7.65881C7.39055 7.59061 7.4279 7.52857 7.47836 7.47812C7.52882 7.42766 7.59085 7.39031 7.65905 7.36932L11.8457 6.08112C11.9339 6.05399 12.0112 5.99967 12.0667 5.92594C12.1221 5.8522 12.1529 5.76282 12.1545 5.67057C12.1561 5.57832 12.1285 5.48793 12.0756 5.41231C12.0227 5.33669 11.9473 5.27972 11.8601 5.24954L2.60136 2.04458C2.52378 2.01772 2.4402 2.01324 2.36018 2.03164C2.28017 2.05004 2.20695 2.09059 2.14889 2.14865C2.09084 2.2067 2.05029 2.27993 2.03188 2.35994C2.01348 2.43995 2.01796 2.52353 2.04482 2.60112V2.60112Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span class="city-name current-main-city">Казань</span>
                                    </a>
                                </div>
                                <div class="header__social js-header-social">
                                    <?php if (have_rows('social_header', 'options')) : $i = 0; ?>
                                        <?php while (have_rows('social_header', 'options')) : the_row();
                                            $i++; ?>
                                            <?php $icon = get_sub_field('icon', 'options'); ?>
                                            <?php $link = get_sub_field('link', 'options'); ?>
                                            <a href="<?php echo $link['url']; ?>" class="link-social-header" target="_blank">
                                                <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                                                <span><?php echo $link['title']; ?></span>
                                            </a>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="header__mail js-header-mail">
                                    <?php if ($mail_header = get_field('mail_header', 'options')) : ?>
                                        <a href="mailto:<?php echo $mail_header; ?>" class="link-mail">
                                            <span><?php echo $mail_header; ?></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="header__tel js-header-tel">
                                    <?php if ($tel_header = get_field('tel_header', 'options')) : ?>
                                        <a href="<?php echo $tel_header['url'] ?>" class="h5">
                                            <svg class="desctop-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.77977 7.80102C6.29842 8.86135 7.15792 9.71695 8.2206 10.2308C8.29835 10.2676 8.38436 10.2836 8.47015 10.2771C8.55595 10.2706 8.63857 10.2419 8.7099 10.1937L10.2746 9.15034C10.3438 9.1042 10.4234 9.07605 10.5063 9.06844C10.5891 9.06083 10.6725 9.074 10.749 9.10677L13.6763 10.3613C13.7757 10.4036 13.8588 10.477 13.9128 10.5705C13.9669 10.664 13.9892 10.7726 13.9762 10.8799C13.8837 11.6039 13.5304 12.2693 12.9826 12.7516C12.4347 13.2339 11.7299 13.5 11 13.5001C8.74566 13.5001 6.58365 12.6045 4.98959 11.0105C3.39553 9.41641 2.5 7.2544 2.5 5.00006C2.50004 4.27017 2.76612 3.56532 3.24843 3.01748C3.73073 2.46965 4.39618 2.1164 5.12019 2.02387C5.22745 2.01089 5.33602 2.03312 5.42955 2.08721C5.52307 2.1413 5.59649 2.22432 5.63873 2.32376L6.89439 5.25363C6.92687 5.32941 6.9401 5.41205 6.93291 5.49419C6.92572 5.57632 6.89833 5.65541 6.85318 5.7244L5.81341 7.31313C5.76608 7.3846 5.73811 7.46712 5.73221 7.55263C5.72631 7.63815 5.7427 7.72373 5.77977 7.80102Z" fill="white" />
                                            </svg>
                                            <svg class="mobile-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.22471 9.75133C7.87302 11.0767 8.94739 12.1462 10.2758 12.7885C10.3729 12.8346 10.4804 12.8545 10.5877 12.8464C10.6949 12.8383 10.7982 12.8024 10.8874 12.7422L12.8433 11.438C12.9298 11.3803 13.0293 11.3451 13.1328 11.3356C13.2364 11.3261 13.3407 11.3426 13.4362 11.3835L17.0954 12.9517C17.2197 13.0045 17.3234 13.0963 17.3911 13.2132C17.4587 13.3301 17.4865 13.4658 17.4702 13.5999C17.3546 14.5049 16.913 15.3367 16.2282 15.9396C15.5434 16.5425 14.6624 16.8751 13.75 16.8751C10.9321 16.8751 8.22956 15.7557 6.23699 13.7631C4.24442 11.7706 3.125 9.06806 3.125 6.25014C3.12505 5.33777 3.45765 4.45671 4.06053 3.77192C4.66341 3.08712 5.49523 2.64556 6.40023 2.5299C6.53431 2.51368 6.67002 2.54146 6.78693 2.60908C6.90384 2.67669 6.99561 2.78046 7.04841 2.90476L8.61798 6.5671C8.65858 6.66183 8.67512 6.76513 8.66614 6.8678C8.65715 6.97047 8.62291 7.06932 8.56647 7.15556L7.26676 9.14147C7.2076 9.23081 7.17263 9.33396 7.16526 9.44085C7.15789 9.54775 7.17837 9.65472 7.22471 9.75133V9.75133Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <span><?php echo $tel_header['title']; ?></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="header__bottom js-header-bottom">
                            <div class="header__nav js-header-nav">
                                <?php if (have_rows('nav_rep', 'options')) : $i = 0; ?>
                                    <?php while (have_rows('nav_rep', 'options')) : the_row();
                                        $i++; ?>
                                        <?php $link = get_sub_field('link'); ?>
                                        <a href="<?php echo $link['url']; ?>" class="header__nav__item"><?php echo $link['title']; ?></a>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="header__btn">
                        <?php if ($btn_header = get_field('btn_header', 'options')) : ?>
                            <a href="<?php echo $btn_header['url']; ?>" class="btn"><?php echo $btn_header['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="header__dropdown js-header-dropdown">
                <div class="container">
                    <div class="header__dropdown__flex">
                        <!-- here js clone .js-header-search, .js-header-nav, .js-header-whatsapp, .js-header-mail, .js-header-tel, .js-header-cats, .js-header-btns -->

                        <div class="header__nav js-header-nav">
                            <?php if (have_rows('nav_rep', 'options')) : $i = 0; ?>
                                <?php while (have_rows('nav_rep', 'options')) : the_row();
                                    $i++; ?>
                                    <?php $link = get_sub_field('link'); ?>
                                    <a href="<?php echo $link['url']; ?>" class="header__nav__item"><?php echo $link['title']; ?></a>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <div class="header__info">
                            <div class="header__info__before"><?php the_field('text_before_tel', 'options'); ?></div>
                            <div class="header__info__item h3">
                                <?php if ($tel_header = get_field('tel_header', 'options')) : ?>
                                    <a href="<?php echo $tel_header['url']; ?>"><?php echo $tel_header['title']; ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="header__info__before"><?php the_field('text_before_address', 'options'); ?></div>
                            <div class="header__info__item h3">
                                <span><?php the_field('address_footer', 'options'); ?></span>
                            </div>
                        </div>
                        <div class="header__dropdown-social">
                            <?php if (have_rows('social_footer', 'options')) : $i = 0; ?>
                                <?php while (have_rows('social_footer', 'options')) : the_row();
                                    $i++; ?>
                                    <?php $icon = get_sub_field('icon', 'options'); ?>
                                    <a href="<?php the_sub_field('name', 'options'); ?>" class="social-header-mobile" target="_blank">
                                        <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                                    </a>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <?php if ($btn_header = get_field('btn_header', 'options')) : ?>
                            <a href="<?php echo $btn_header['url']; ?>" class="btn"><?php echo $btn_header['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="overlay"></div>
        </header>

        <main>