<?php

$post_id = get_the_ID();
if ($args['content_show']) {
    $post_id = get_option('page_on_front');
}
$show_block = get_field('show_block', $post_id);
if ($show_block['address']) : ?>

    <section class="address" id="address">
        <div class="container">
            <div class="address__heading"><?php the_field('address_heading', $post_id); ?></div>
            <?php if (have_rows('address_rep', $post_id)) : $i = 0; ?>
                <div class="address__flex">
                    <?php while (have_rows('address_rep', $post_id)) : the_row();
                        $i++; ?>
                        <div class="address__item">
                            <div class="address__top">
                                <div class="address__group">
                                    <div class="address__icon">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.21312 4.08768L8.24948 18.6372C8.29691 18.7742 8.38644 18.8927 8.50526 18.9758C8.62409 19.0588 8.76614 19.1022 8.9111 19.0997C9.05607 19.0972 9.19652 19.0489 9.31239 18.9618C9.42827 18.8746 9.51362 18.7531 9.55626 18.6145L11.5806 12.0355C11.6135 11.9283 11.6722 11.8308 11.7515 11.7515C11.8308 11.6722 11.9283 11.6135 12.0355 11.5806L18.6145 9.55626C18.7531 9.51362 18.8746 9.42827 18.9618 9.3124C19.0489 9.19653 19.0972 9.05607 19.0997 8.91111C19.1022 8.76614 19.0588 8.6241 18.9758 8.50527C18.8927 8.38644 18.7742 8.29691 18.6372 8.24949L4.08768 3.21312C3.96576 3.17091 3.83442 3.16387 3.70869 3.19279C3.58295 3.22171 3.46789 3.28543 3.37666 3.37666C3.28543 3.46789 3.22171 3.58295 3.19279 3.70869C3.16387 3.83442 3.17091 3.96576 3.21312 4.08768V4.08768Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="address__title"><?php the_sub_field('address', $post_id); ?></div>
                                        <div class="address__subtitle"><?php the_sub_field('time_work', $post_id); ?></div>
                                    </div>
                                </div>
                                <div class="address__group">
                                    <div class="address__icon">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.94718 10.7264C8.66032 12.1843 9.84213 13.3608 11.3033 14.0673C11.4102 14.1179 11.5285 14.1399 11.6465 14.131C11.7644 14.122 11.878 14.0825 11.9761 14.0164L14.1276 12.5817C14.2228 12.5182 14.3322 12.4795 14.4461 12.4691C14.56 12.4586 14.6747 12.4767 14.7798 12.5218L18.8049 14.2468C18.9416 14.3049 19.0558 14.4058 19.1302 14.5344C19.2045 14.663 19.2351 14.8123 19.2173 14.9598C19.09 15.9553 18.6043 16.8703 17.851 17.5335C17.0978 18.1966 16.1286 18.5625 15.125 18.5626C12.0253 18.5626 9.05252 17.3312 6.86069 15.1394C4.66886 12.9475 3.4375 9.97477 3.4375 6.87506C3.43755 5.87145 3.80342 4.90228 4.46659 4.14901C5.12975 3.39574 6.04475 2.91002 7.04026 2.7828C7.18774 2.76495 7.33703 2.79551 7.46562 2.86989C7.59422 2.94426 7.69517 3.05841 7.75325 3.19514L9.47978 7.22371C9.52444 7.32791 9.54264 7.44154 9.53275 7.55448C9.52287 7.66742 9.4852 7.77616 9.42312 7.87102L7.99343 10.0555C7.92836 10.1538 7.88989 10.2673 7.88179 10.3848C7.87368 10.5024 7.89621 10.6201 7.94718 10.7264V10.7264Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div>
                                        <?php if ($tel = get_sub_field('tel', $post_id)) : ?>
                                            <a class="address__title" href="<?php echo $tel['url']; ?>"><?php echo $tel['title']; ?></a>
                                        <?php endif; ?>
                                        <a class="address__subtitle" href="mailto:<?php the_sub_field('mail', $post_id); ?>"><?php the_sub_field('mail', $post_id); ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="address__bottom">
                                <?php if (get_sub_field('coords_map', $post_id)) : ?>
                                    <div id="map<?php echo $i; ?>" style="height: 221px;"></div>
                                <?php endif; ?>
                            </div>
                        </div>


                        <?php if (get_sub_field('coords_map', $post_id)) : ?>
                            <script>
                                function yandexinit_<?php echo $i; ?>() {
                                    // Функция ymaps.ready() будет вызвана, когда
                                    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
                                    ymaps.ready(init<?php echo $i; ?>);

                                    function init<?php echo $i; ?>() {
                                        // Создание карты.
                                        // https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/map-docpage/
                                        var myMap<?php echo $i; ?> = new ymaps.Map("map<?php echo $i; ?>", {
                                            center: [<?php the_sub_field('coords_map', $post_id) ?>],
                                            // Уровень масштабирования. Допустимые значения:
                                            // от 0 (весь мир) до 19.
                                            zoom: 15,
                                            suppressMapOpenBlock: true,
                                            controls: []
                                        }, {
                                            suppressMapOpenBlock: true
                                        });

                                        var myPlacemark<?php echo $i; ?> = new ymaps.Placemark([<?php the_sub_field('coords_map', $post_id) ?>], {
                                            // Хинт показывается при наведении мышкой на иконку метки.
                                            hintContent: '<?php the_sub_field('address', $post_id) ?>',
                                            // Балун откроется при клике по метке.
                                            balloonContent: '<?php the_sub_field('address', $post_id); ?><br><?php the_sub_field('time_work', $post_id); ?>'
                                        }, {
                                            // Опции.
                                            // Необходимо указать данный тип макета.
                                            iconLayout: 'default#image',
                                            // Своё изображение иконки метки.
                                            iconImageHref: "data:image/svg+xml,%3Csvg width='32' height='44' viewBox='0 0 32 44' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cg clip-path='url(%23clip0_103:3286)'%3E%3Cpath d='M15.9673 0C7.16302 0 0 7.34594 0 16.3745C0 21.4251 2.53525 27.555 7.53666 34.595C11.1962 39.7469 14.8029 43.4208 14.9547 43.5746C15.2337 43.8573 15.6005 43.9991 15.9682 43.9991C16.3247 43.9991 16.6822 43.8651 16.9585 43.597C17.1104 43.4491 20.7265 39.924 24.3928 34.8434C29.3977 27.9082 31.9355 21.6941 31.9355 16.3745C31.9346 7.34594 24.7716 0 15.9673 0ZM15.9673 23.4446C11.6628 23.4446 8.16109 19.9169 8.16109 15.5805C8.16109 11.2441 11.6628 7.71633 15.9673 7.71633C20.2718 7.71633 23.7735 11.2441 23.7735 15.5805C23.7735 19.9169 20.2718 23.4446 15.9673 23.4446Z' fill='%230D1026'/%3E%3C/g%3E%3Cdefs%3E%3CclipPath id='clip0_103:3286'%3E%3Crect width='31.9355' height='44' fill='white'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E%0A",
                                            // Размеры метки.
                                            iconImageSize: [33, 44],
                                            // Смещение левого верхнего угла иконки относительно
                                            // её "ножки" (точки привязки).
                                            iconImageOffset: [-5, -38]
                                        });

                                        // После того как метка была создана, добавляем её на карту.
                                        myMap<?php echo $i; ?>.geoObjects.add(myPlacemark<?php echo $i; ?>);
                                        myMap<?php echo $i; ?>.behaviors.disable('scrollZoom');
                                    }
                                }

                                setTimeout(function() {
                                    yandexinit_<?php echo $i; ?>();
                                }, 100);
                            </script>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>