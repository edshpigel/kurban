//
// jQuery 
//
window.$ = window.jQuery = $ = require('jquery');

//
// Fancybox import
//
var fancybox = require('@fancyapps/fancybox');

//
// Swiper import
//
import Swiper from './libs/swiper.min.js';

//
// AOS import
//
import AOS from "./libs/aos.min.js";

//
// maskedinput import
//
import InputMask from "./libs/maskedinput.min.js";

//
// validate import
//
import validate from "./libs/jquery.validate.min.js";

//
// Clone .js-header-search, .js-header-nav, .js-header-whatsapp, .js-header-mail, .js-header-tel, .js-header-cats, .js-header-btns
//

$(document).ready(function(){
    var menu_dropdown = $('.js-header-dropdown').find('.js-header-dropdown-flex');

    $('.js-header-top .js-header-search').clone().appendTo(menu_dropdown);
    $('.js-header-top .js-header-nav').clone().appendTo(menu_dropdown);
    $('.js-header-top .js-header-whatsapp').clone().appendTo(menu_dropdown);
    $('.js-header-top .js-header-mail').clone().appendTo(menu_dropdown);
    $('.js-header-top .js-header-tel').clone().appendTo(menu_dropdown);
    $('.js-header-bottom .js-header-cats').clone().appendTo(menu_dropdown);
    $('.js-header-bottom .js-header-btns').clone().appendTo(menu_dropdown);
});

//
// Clone .js-header-whatsapp, .js-header-tel
//

$(document).ready(function(){
    var menu_top = $('.js-header-bottom-flex');
    $('.js-header-top .js-header-whatsapp').clone().appendTo(menu_top);
    $('.js-header-top .js-header-tel').clone().appendTo(menu_top);
});

//
// Scroll to section
//

$(document).ready(function(){
    $("a[href*='#']:not([href*='#modal'])").each(function(){
        $(this).click(function() {
            var id = $(this).attr('href');
            if($(id).is('section, h2')) {
                event.preventDefault();
                var heightheader = $(".header").height();
                var top = $(id).offset().top - heightheader;
                $('body,html').animate({ scrollTop: top }, 800);
            }
        });
    });
});


//
// Load more .desc-table 
// 

$(document).ready(function() {
    if($(".js-video-blog-wrapper .js-video-blog-item").length > 2) {
        var loadmore_btn = '<div class="load-more-video-blog">Загрузить больше видео</div>'
        $(".js-video-blog-wrapper .js-video-blog-item").slice(2, 20).hide();
        $(loadmore_btn).insertAfter( $(".js-video-blog-wrapper"));

        $(".load-more-video-blog").on('click', function() {
            $(".js-video-blog-wrapper .js-video-blog-item").slice(2, 20).slideToggle();
            $(this).fadeOut();
        });
    }
});


//
// Swiper settings
//

$(document).ready(function() {

    var farmSwiper = new Swiper('.farm-swiper', {
        slidesPerView: 1,
        loop: true,
        pagination: {
            el: '.farm-pagination',
            type: 'bullets',
            clickable: true,
        },
        navigation: {
            prevEl: '.swiper-prev-farm',
            nextEl: '.swiper-next-farm',
        },
    });

    var partnersSwiper = new Swiper('.partners-swiper', {
        slidesPerView: 3,
        loop: true,
        pagination: {
            el: '.partners-pagination',
            type: 'bullets',
            clickable: true,
        },
        navigation: {
            prevEl: '.swiper-prev-partners',
            nextEl: '.swiper-next-partners',
        },
        breakpoints: {
            576: {
                slidesPerView: 3,
            },
            768: {
                slidesPerView: 3,
            },
            998: {
                slidesPerView: 4,
            },
            1300: {
                slidesPerView: 4,
            },
            1450: {
                slidesPerView: 5,
            },
        },
    });

    var galSwiper = new Swiper('.gal-swiper', {
        slidesPerView: 2.5,
        spaceBetween: 15,
        loop: true,
        pagination: {
            el: '.gal-pagination',
            type: 'bullets',
            clickable: true,
        },
        navigation: {
            prevEl: '.swiper-prev-gal',
            nextEl: '.swiper-next-gal',
        },
        breakpoints: {
            576: {
                slidesPerView: 2.5,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            998: {
                slidesPerView: 4,
            },
            1300: {
                slidesPerView: 4,
            },
            1450: {
                slidesPerView: 4,
            },
        },
    });
});


//
// target .js-donate-link
//


$(document).ready(function() {
    $('.js-donate-link').click(function(){
        var donate_link = $(this).data('donate-link'),
            donate_link_index = $(this).index();
        var form_block_section = $('#form-block');
        var donate_link_index_plus = donate_link_index+1;
        $(form_block_section).find('.donate-item').slice(donate_link_index, donate_link_index_plus).trigger('click');

        var heightheader = $(".header").height();
        var top = $(form_block_section).offset().top - heightheader;
        $('body,html').animate({ scrollTop: top }, 800);
    });
});


//
// CF7 form scripts
//

$(document).ready(function() {
    $('.js-form-block').each(function(){
        $(this).find('.js-info-form').appendTo($(this).find('.js-method-payment'));
    });
    $('span.your_price_select select').each(function(){
        $(this).find('option:first-child').text('');
        var html_custom_select = '<div class="custom-select"><div class="custom-select-title">Выбрать</div><div class="custom-select-list"></div></div><svg width="14" height="7" viewBox="0 0 14 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.625 0.75L7 6.375L1.375 0.75" stroke="black" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        $(html_custom_select).insertBefore($(this));
        $(this).find('option').clone().appendTo($(this).siblings('.custom-select').find('.custom-select-list'));
    });
    $('.custom-select').each(function(){
        $(this).find('option').each(function(){
            if($(this).val() != '') {
                var this_value = $(this).val();
                var this_option_deform = '<div data-value="'+this_value+'">'+this_value+'</div>'
                $(this_option_deform).appendTo($(this).parents('.custom-select-list'));
            }
        });
        $(this).find('option').remove();
        $(this).parents('.label-block').click(function(){
            if(!($(this).find('.custom-select').hasClass('is-open'))){
                $(this).find('.custom-select').addClass('is-open');
                $(this).find('.custom-select').find('.custom-select-list').slideToggle(300);
            } else {
                $(this).find('.custom-select').removeClass('is-open');
                $(this).find('.custom-select').find('.custom-select-list').slideToggle(300);
            }
        });
        $(this).find('.custom-select-list').find('div').click(function(){
            if(!($(this).hasClass('checked'))){
                $(this).addClass('checked');
                $(this).siblings('.checked').removeClass('checked');
                var this_option_text = $(this).text();
                $(this).parents('.custom-select').find('.custom-select-title').text(this_option_text);
                $(this).parents('.custom-select').siblings('select').find('option').each(function(){
                    var option_active = $(this).parents('select').siblings('.custom-select').find('div.checked').text();
                    if($(this).val() === option_active) {
                        console.log(123);
                        $(this).prop('selected', true);
                        $(this).parents('.label-block').addClass('is-active');
                    }
                });
            }
           
        });
    });
    setTimeout(() => {
        $('.js-form-block').each(function(){
            var donate_name = $(this).find('.donate-item.is-selected').text();
            $(this).find('input[name="your_donate"]').val(donate_name);
        });
    }, 500);
    
    $('.js-form-block').find('.donate-item').click(function(this_block){
        if(!($(this).hasClass('is-selected'))){
            $(this).addClass('is-selected').siblings('.donate-item.is-selected').removeClass('is-selected');
            var donate_name = $(this).text();
            $(this).parents('.js-form-block').find('input[name="your_donate"]').val(donate_name);
        }
    });
});

//
// Mask tel
//

$(document).ready(function() {
    $.mask.definitions['~'] = "[0-69]";
	$("[type='tel']").mask("+7 (~99) 999-99-99");
});


//
// Validate settings
//

$(document).ready(function() {
    $('.js-form-item').find('input').click(function(){
        $(this).siblings('.wpcf7-not-valid-tip').hide();
    });
});
$('.flex-form').find('input').each(function() {
    $(this).focus(function() {
        $(this).parents('label').addClass('input--onfocus');
    });
    $(this).focusout(function() {
        $(this).parents('label').removeClass('input--onfocus');
    });
});

var Form = {
    init: function() {
        Form.validation();
    },
    validation: function() {
        $('.wpcf7-form:not(.js-form-item)').each(function(i) {
            $(this).validate({
                rules: {
                    your_price_select: {
                        required: true
                    },
                    your_name: {
                        required: true,
                    },
                    your_tel: {
                        required: true,
                    },
                    your_email: {
                        required: true,
                    },
                },
                highlight: function(element) {
                    $(element).removeClass('form--valid').addClass('form--error');
                    $(element).parents('label, .label-block').removeClass('label--valid').addClass('label--error');
                },
                unhighlight: function(element) {
                    $(element).removeClass('form--error').addClass('form--valid');
                    $(element).parents('label, .label-block').removeClass('label--error').addClass('label--valid');
                },
                errorPlacement: function(error, element) {
                    var error_label = error.addClass('input-label--error').text();
                    $(element).parents('label, .label-block').children('span.label-span').attr('aria-label-error', error_label);
                },
                messages: {
                    your_price_select: {
                        required: "Выберите кол-во барашков",
                    },
                    your_name: {
                        required: "Введите имя и фамилию",
                    },
                    your_tel: {
                        required: "Введите телефон",
                    },
                    your_email: {
                        required: "Введите почту",
                        email: "Не корректный адрес эл. почты",
                    },
                },
            });
        });
    }
}
$(function() { Form.init(); });



//
// Fancybox settings
//

$(document).ready(function() {
    
    // Skip cloned elements
    $('[data-fancybox]').fancybox({
        backFocus : false,
        loop: true,
    });

    $('.link-youtube').fancybox({
        openEffect: 'none',
        closeEffect: 'none',
        helpers: {
            media: {

            }
        }
    });
});

//
// faq block 
// 

$(document).ready(function() {
    $(".js-question").each(function() {
        $(this).parents('.js-faq-item').not('.is-active').find('.js-ask').hide();
    });
    $(".js-question").click(function() {
        var this_quest = $(this);
        if (this_quest.parents('.js-faq-item').hasClass('is-active')) {
            this_quest.parents('.js-faq-item').removeClass('is-active');
            this_quest.parents('.js-faq-item').find('.js-ask').slideUp();
        } else {
            this_quest.parents('.js-faq-item').addClass('is-active');
            this_quest.parents('.js-faq-item').find('.js-ask').slideDown();
            this_quest.parents('.js-faq-item').siblings(".js-faq-item.is-active").find('.js-ask').slideToggle();
            this_quest.parents('.js-faq-item').siblings(".js-faq-item.is-active").removeClass('is-active');
        }
    });
    $(".js-arrow").click(function() {
        var this_quest = $(this);
        if (this_quest.parents('.js-faq-item').hasClass('is-active')) {
            this_quest.parents('.js-faq-item').removeClass('is-active');
            this_quest.parents('.js-faq-item').find('.js-ask').slideUp();
        } else {
            this_quest.parents('.js-faq-item').addClass('is-active');
            this_quest.parents('.js-faq-item').find('.js-ask').slideDown();
            this_quest.parents('.js-faq-item').siblings(".js-faq-item.is-active").find('.js-ask').slideToggle();
            this_quest.parents('.js-faq-item').siblings(".js-faq-item.is-active").removeClass('is-active');
        }
    });
});

//
// Load more .desc-table 
// 

$(document).ready(function() {
    if($(".desc-table tr").length > 8) {
        var loadmore_btn = '<div class="load-more-single">Показать полностью</div>'
        $(".desc-table tr").slice(8, 99).hide();
        $(loadmore_btn).appendTo( $(".desc-table").find('tbody'));

        $(".desc-table .load-more-single").on('click', function() {
            if($(this).hasClass('is-active')) {
                $(".desc-table tr").slice(8, 99).slideUp();
                $(this).removeClass('is-active').text("Показать полностью");
            } else {
                $(".desc-table tr").slice(8, 99).slideDown();
                $(this).addClass('is-active').text("Скрыть");
            }
        });
    }
});

//
// From_where to CF7 
//


$(document).ready(function() {
    $('a[href*="#modal"]').addClass('modal-inline');
    var modal_form = $('#modal-form'),
        from_where_default = "";

    function default_after_close() {
        modal_form.find('input[name="from_where"]').removeAttr('value');
    };
    $(".modal-inline").each(function() {
        var this_val = $(this).attr('from_where');
        $(this).fancybox({
            smallBtn: false,
            buttons: [],
            beforeShow: function() {
                setTimeout(function() {
                    modal_form.find('input[name="from_where"]').val(this_val);
                }, 100);
            },
            afterClose: function() {
                default_after_close();
            }
        });
    });
});

//
// cf7 redirect 
//

document.addEventListener('wpcf7mailsent', function(event){
    window.location.href="/thanks/"
},!1);

//
// Heading after scrolling
//

$(document).ready(function() {
    function scrollFixed() {
        if ($(window).scrollTop() > 180) {
            $('.header').addClass('fixed');
            $('.header').slideDown(500);
            $('.to-top-fixed').addClass('fixed');
        } else if ($(window).scrollTop() < 41) {
            $('.header').removeClass('fixed');
            $('.to-top-fixed').removeClass('fixed');
        }
        if ($(window).scrollTop() > 200) {
            $('.to-top-fixed').addClass('fixed');
        } else if ($(window).scrollTop() < 201) {
            $('.to-top-fixed').removeClass('fixed');
        }
    };

    setTimeout(function() {
        scrollFixed();
    }, 100);
    $(window).scroll(function() {
        scrollFixed();
    });
    $('.to-top-fixed, .js-to-top').click(function() {
        $('body,html').animate({ scrollTop: 0 }, 800);
    });
});

//
// Antispam
//

$(document).ready(function(){
    setTimeout(function(){
        jQuery('.antispam').prop('checked',!1)
    },500)
});

//
// Menu space for position:fixed settings
//

$(document).ready(function() {
    function heightheader() {
        var heightheader = $("header").height();
        $('.header__space').css('height', heightheader);
        $('.js-header-dropdown').css('padding-top', heightheader);
    };
    setTimeout(function() {
        heightheader();
    }, 50);
    $(window).resize(function() {
        heightheader();
    });
});

//
// Menu hamburger
//

$(document).ready(function() {
    var clickstatus = 0;
    function addClass_menu() {
        $(".js-header-hamburger").addClass('toggled');
        $(".header").addClass('toggled');
        $(".js-header-dropdown").addClass('toggled');
        $(".overlay").addClass('toggled');
        $("body").addClass('menu-toggled');
    }
    function removeClass_menu() {
        $(".js-header-hamburger").removeClass('toggled');
        $(".header").removeClass('toggled');
        $(".js-header-dropdown").removeClass('toggled');
        $(".overlay").removeClass('toggled');
        $("body").removeClass('menu-toggled');
    }
    $(".js-header-hamburger").click(function() {
        if (clickstatus == 0) {
            addClass_menu();
            clickstatus = 1;
        } else if (clickstatus == 1) {
            removeClass_menu();
            clickstatus = 0;
        }
    });
    $(".overlay").click(function() {
        if (clickstatus == 1) {
            removeClass_menu();
            clickstatus = 0;
        }
    });
    $("a").not('.catalog-link').click(function() {
        if (clickstatus == 1) {
            removeClass_menu();
            clickstatus = 0;
        }
    });
});

//
// Load more
//

$(document).ready(function(){
    $(".js-archive-item").slice(0, 4).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".js-archive-item:hidden").slice(0, 4).slideDown();
        if ($(".js-archive-item:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }
    });
    if ($(".js-archive-item:hidden").length == 0) {
        $("#loadMore").fadeOut('slow');
    }
});

//
// Cookie
//

function checkCookies(){
    let cookieDate = localStorage.getItem('cookieDate');
    let cookieNotification = document.getElementById('cookie_notification');
    let cookieBtn = cookieNotification.querySelector('.cookie_accept');

    // Если записи про кукисы нет или она просрочена на 1 год, то показываем информацию про кукисы
    if( !cookieDate || (+cookieDate + 31536000000) < Date.now() ){
        cookieNotification.classList.add('show');
    }

    // При клике на кнопку, в локальное хранилище записывается текущая дата в системе UNIX
    cookieBtn.addEventListener('click', function(){
        localStorage.setItem( 'cookieDate', Date.now() );
        cookieNotification.classList.remove('show');
    })
}
checkCookies();