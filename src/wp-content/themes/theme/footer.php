<?php

/**
 * Footer.php
 */
?>
</main>
<footer class="footer" id="footer">
    <div class="container">
        <div class="footer__flex">
            <?php if (have_rows('social_footer', 'options')) : ?>
                <div class="footer__social">
                    <?php while (have_rows('social_footer', 'options')) : the_row(); ?>
                        <?php $icon = get_sub_field('icon', 'options'); ?>
                        <a class="footer__social__item" href="<?php the_sub_field('name', 'options'); ?>" target="_blank">
                            <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['url']; ?>">
                        </a>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <div class="footer__tel">
                <div class="footer__subtitle"><?php the_field('text_before_tel', 'options'); ?></div>
                <?php if ($tel_header = get_field('tel_header', 'options')) : ?>
                    <a class="footer__title h3" href="<?php echo $tel_header['url']; ?>"><?php echo $tel_header['title']; ?></a>
                <?php endif; ?>
            </div>
            <div class="footer__address">
                <div class="footer__subtitle"><?php the_field('text_before_address', 'options'); ?></div>
                <div class="footer__title h3"><?php the_field('address_footer', 'options'); ?></div>
            </div>
        </div>
        <div class="footer__copyright">
            <div class="footer__copyright__item"><?php the_field('copyright', 'options'); ?></div>
            <?php if (have_rows('columns_copyright', 'options')) : ?>
                <div class="footer__columns">
                    <?php while (have_rows('columns_copyright', 'options')) : the_row(); ?>
                        <div class="footer__columns__item">
                            <div class="footer__columns__text"><?php the_sub_field('text', 'options'); ?></div>
                            <?php $link = get_sub_field('link', 'options'); ?>
                            <a class="footer__columns__link" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>

<div style="position:fixed; left: 0; bottom: 0;"></div>

<?php get_template_part('template-parts/to-top'); ?>
<?php get_template_part('template-parts/modals'); ?>

</div>
<?php wp_footer(); ?>

<script type="text/javascript">
jQuery(function ($) {

$(document).ready(function () {


  var city_obj = <?= json_encode(get_adress_obj(1)) ?> ;
  var city_instance = $('.city-init').selectCity({
    cityes: city_obj,
    default_city: '0',
    reload_on_change: false,
    host: '<?=$_SERVER["HTTP_HOST"]?>',
    request: '<?=$_SERVER["REQUEST_URI"]?>'
  });
  city_instance.on('set_city', function (ev, current_city, key) {
    //можно менять js-ом
  });
});

$.fn.selectCity = function (options) {
  options = $.extend({
    cityes: {},
    default_city: 'none',
    reload_on_change: false,
    cookie_days: 7,
    cookie_name: 'current_city',
    popover_width: 230,
    geo: false,
    host: '<?=$_SERVER["HTTP_HOST"]?>',
    request: '/'
  }, options);

  var _this = $(this);

  var html = '';
  var modal = '';

  var popover, adress_link, city_name;
  var modal_div, overlay;

  var cookIe_citY = readCookieCity();

  var current_city_key;

  var instance = $({
    current_city: '',
    default_city: ''
  });

  // var get_geo_info = function () {
  //     return $.getJSON('//getcitydetails.geobytes.com/GetCityDetails?callback=?');
  // }

  var set_current_city = function (name) {
    if (name) {
      if (!options.cityes[name]) {
        console.log('set_current_city not in city obj: ' + name);
        current_city_key = set_default_city_key();
        instance.current_city = options.cityes[current_city_key];
        // instance.current_city = instance.default_city;
      } else {
        instance.current_city = options.cityes[name];
        current_city_key = name;
        go_url(name);
      }
    } else if (cookIe_citY) {
      if (!options.cityes[cookIe_citY]) {
        console.log('cookie city not in city obj: ' + cookIe_citY);
        return false;
      }
      instance.current_city = options.cityes[cookIe_citY];
      current_city_key = cookIe_citY;
    } else {
      current_city_key = set_default_city_key();
      instance.current_city = options.cityes[current_city_key];
      // instance.current_city = instance.default_city;
    }
  }

  function get_by_domain() {
    // проверка по домену
    var res = '';
    var lev = '';
    var levels = options.host.split('.');
    $.each(options.cityes, function (key, obj) {
      if (obj['url'] == options.host) {
        res = key;
      };
    });
    console.log(res)
    return res;
  }

  var set_default_city_key = function () {
    // проверка по домену
    current_city_key = get_by_domain();

    if (!current_city_key) {
      if (!options.cityes[options.default_city]) {
        current_city_key = Object.keys(options.cityes)[0];
      } else {
        current_city_key = options.default_city;
      }
    };

    return current_city_key;
  }

  var init = function () {

    if (!Object.keys(options.cityes).length) {
      console.log('city count = 0');
      return false;
    }

    if (!options.cityes[options.default_city]) {
      options.default_city = Object.keys(options.cityes)[0];
      console.log('default_city "' + options.cityes[options.default_city].name +
        '" not exist, get first...' + options.cityes[options.default_city].name);
    } else {
      instance.default_city = options.cityes[options.default_city];
    }

    if (cookIe_citY) {
      var name = get_by_domain();
      if (cookIe_citY === name) {
        set_current_city();
        construct();
        console.log('set by cookie: ' + cookIe_citY);
      } else {
        set_current_city(name);
        construct();
        console.log('set by domain: ' + name);
        set_city(name);
      }
    } else {
      var name = get_by_domain();
      console.log('set by default: ' + name);
      set_current_city(name);
      construct();
      set_city(name);
    }

    return instance;
  }

  var construct = function () {
    var name = get_by_domain();
    var c = options.cityes[name];
    build_html();
    build_modal();
    bind_events();

    $('.current-main-city').html(c.name);
    $('.current-time-work').html(c.vremya_raboty);
    $('.city-form-hidden').val(c.name);
    $('.current-main-adr, .footer__adr').html(c.adres);
    $('.current-main-phone-text').html(c.phone);

    $('.current-main-phone').attr(
      'href', 'tel:' + c.phone.replace(/[^A-Z0-9]/gi, ''));
    if ($(c.pochta).length) {
      $('.current-main-pochta').html(c.pochta);
      $('.current-main-pochta').attr('href', 'mailto:' + c.pochta);
    } else {
      $('.current-main-pochta').hide();
    }
    if ($(c.vk).length) {
      $('.current-main-vk').attr('href', c.vk);
    } else {
      $('.current-main-vk').remove();
    }
    if ($(c.youtube).length) {
      $('.current-main-youtube').attr('href', c.youtube);
    } else {
      $('.current-main-youtube').remove();
    }
    if ($(c.instagram).length) {
      $('.current-main-instagram').attr('href', c.instagram);
    } else {
      $('.current-main-instagram').remove();
    }
    if ($(c.telegram).length) {
      $('.current-main-telegram').attr('href', 'https://t.me/' + c.telegram);
    } else {
      $('.current-main-telegram').remove();
    }
    $('.current-main-whatsapp').attr('href', 'https://wa.me/' + c.whatsapp);






  }

  var go_url = function (nm) {
    if (options.host != options.cityes[nm]['url']) {
      console.log('//' + options.cityes[nm]['url'] + options.request);
      document.location.href = '//' + options.cityes[nm]['url'] + options.request;
    }
  }

  var build_html = function () {
    if (!_this.length) {
      console.log('element not exist');
      return false;
    }

    html += '<div class="adress_popover">';
    html += '<span class="current_city"><span class="city_name">' + instance.current_city.name +
      '</span></span>';
    html += '<div class="city_popover">';
    html += 'Ваш город <span class="city_name">' + instance.current_city.name +
      '</span>?<br><a href="#" class="close_popover">Да</a><a href="#" class="open_modal_city">Нет</a>';
    html += '</div>';
    html += '</div>';

    // _this.append(html);

    city_name = $('.city_name');
    popover = $('.city_popover');
    adress_link = $('.current_city');

    //var marginleft = ~~(adress_link.width()/2) + ~~(popover.width()/2);
    var marginleft = ~~(options.popover_width / 2);
    popover.css('marginLeft', -marginleft + 'px');

  }

  var build_modal = function () {
    modal +=
      '<div class="city_modal"><span class="choose_city_title">Выберите город</span><span class="city_modal_close"><svg width="20" height="20" xmlns="https://www.w3.org/2000/svg" version="1.1" xmlns:xlink="https://www.w3.org/1999/xlink" xmlns:avocode="https://avocode.com/" viewBox="0 0 40 40"><path d="M40.00789,1.89664v0l-1.90482,-1.90461v0l-18.09708,18.09704v0l-18.0969,-18.09704v0l-1.90482,1.90461v0l18.09726,18.09716v0l-18.09726,18.09704v0l1.90482,1.90461v0l18.0969,-18.0968v0l18.09708,18.0968v0l1.90482,-1.90461v0l-18.09726,-18.09704v0z"fill="#B8BBCC" fill-opacity="1"></path></svg></span><div class="links-city">';
    $.each(options.cityes, function (key, obj) {
      if (instance.current_city.url == obj.url) {
        var currcity = ' current-city';
      } else {
        var currcity = ' empty-city';
      }

      modal += '<a href="#" class="select_city' + currcity + '" data-city="' + key +
        '"><div class="icon-checkbox"></div>' + obj.name + '</a>';
    });
    modal +=
      '</div></div><div class="city_overlay"></div>';

    $('body').append(modal);

    modal_div = $('.city_modal');
    overlay = $('.city_overlay');
  }

  var bind_events = function () {
    $('.current_city').each(function(){
      $(this).click(function (e) {
        e.preventDefault();
        if ($(popover).is(':visible')) {
          close_modal();
          console.log(123);
        } else {
          open_modal();
          console.log(321);
        }
      });
    })

    $(document).on('click', '.close_popover', function (e) {
      e.preventDefault();
      close_popover();
      set_city(current_city_key);
      //if (options.reload_on_change) location.reload();
    });

    overlay.click(function () {
      close_modal();
    });

    $(document).on('click', '.city_modal_close', function () {
      close_modal();
    });

    $(document).on('click', '.open_modal_city', function (e) {
      e.preventDefault();
      close_popover();
      open_modal();
    });

    $(document).on('click', '.city_modal a', function (e) {
      e.preventDefault();
      var name = $(this).attr('data-city');
      set_city(name);
      close_modal();
      go_url(name);

      // if (options.reload_on_change) location.reload();
    });

  }

  var open_popover = function () {
    instance.trigger('open_popover');
    popover.stop(true).show().animate({
      'marginTop': '20px',
      opacity: 1
    }, 200, function () {
      instance.trigger('opened_popover');
    });
  }

  var close_popover = function () {
    instance.trigger('close_popover');
    popover.stop(true).animate({
      'marginTop': '35px',
      opacity: 0
    }, 200, function () {
      popover.hide()
      instance.trigger('closed_popover');
    });
  }

  var open_modal = function () {
    instance.trigger('open_modal');
    overlay.fadeIn(400,
      function () {
        modal_div.css('display', 'block').animate({
          opacity: 1,
          top: '15%'
        }, 200, function () {
          instance.trigger('opened_modal');
        });
      });
  }

  var close_modal = function () {
    instance.trigger('close_modal');
    modal_div.animate({
      opacity: 0,
      top: '5%'
    }, 200, function () { // пoсле aнимaции
      $(this).css('display', 'none');
      overlay.fadeOut(400);
      instance.trigger('closed_modal');
    });
  }

  function createCookieCity(value) {
    var name = options.cookie_name;
    var days = options.cookie_days;
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      var expires = "; expires=" + date.toGMTString();
    } else var expires = "";
    document.cookie = name + "=" + value + expires + "; domain=avto-gigant-russia.ru; path=/";
  }

  function readCookieCity() {
    name = options.cookie_name;
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  function set_city(name) {
    if (!options.cityes[name]) {
      console.log(name + ' not exist');
      return false;
    }
    instance.current_city = options.cityes[name];
    createCookieCity(name);
    $(city_name).text(options.cityes[name].name)
    instance.trigger('set_city', [options.cityes[name], name]);
  }

  instance.getObj = function () {
    return _this;
  }

  return init(this);
};

// These are the options that I'm going to be using on each statistic
var options = {
  useEasing: true,
  useGrouping: true,
  separator: ",",
  decimal: "."
};

// Find all Statistics on page, put them inside a variable
var statistics = $(".counter-value");

// For each Statistic we find, animate it
statistics.each(function (index) {
  // Find the value we want to animate (what lives inside the p tags)
  var value = $(statistics[index]).html();
  // Start animating
  var statisticAnimation = new CountUp(statistics[index], 0, value, 0, 5, options);
  statisticAnimation.start();
});

});
</script>


</body>

</html>