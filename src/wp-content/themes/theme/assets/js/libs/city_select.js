(function($){
  $.fn.selectCity = function(options){
    options = $.extend({
      cityes: {},
      default_city: 'none',
      reload_on_change: false,
      cookie_days: 7,
      cookie_name: 'current_city',
      popover_width: 230,
      geo: true
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

    var get_geo_info = function() {
      return $.getJSON('//getcitydetails.geobytes.com/GetCityDetails?callback=?');
    }

    var set_current_city = function(name) {
      if (name) {
        if (!options.cityes[name]) {
            console.log('set_current_city not in city obj: '+name);
            instance.current_city = instance.default_city;
            set_default_city_key();
        } else {
          instance.current_city = options.cityes[name];
          current_city_key = name;
        }
      } else if (cookIe_citY) {
        if (!options.cityes[cookIe_citY]) {
            console.log('cookie city not in city obj: '+cookIe_citY);
            return false;
        }
        instance.current_city = options.cityes[cookIe_citY];
        current_city_key = cookIe_citY;
      } else {
        instance.current_city = instance.default_city;
        set_default_city_key();
      }
    }

    var set_default_city_key = function() {
        if (!options.cityes[options.default_city]) {
          current_city_key = Object.keys(options.cityes)[0];
        } else {
          current_city_key = options.default_city;
        } 
    }

    var init = function() {

      if (!Object.keys(options.cityes).length) {
        console.log('city count = 0');
        return false;
      }

      if (!options.cityes[options.default_city]) {
        options.default_city = Object.keys(options.cityes)[0];
        console.log('default_city "'+options.cityes[options.default_city].name+'" not exist, get first...'+options.cityes[options.default_city].name);
      } else {
        instance.default_city = options.cityes[options.default_city];
      }
      
      if (cookIe_citY) {
          set_current_city();
          construct();
          console.log('set by cookie: '+cookIe_citY);
      } else if (options.geo) {
        get_geo_info().promise().done(function(data){
          var name = data.geobytescity.toLowerCase();
          set_current_city(name);
          construct();
          console.log('set by geo: '+name);
          //set_city(name);
        });
      } else {
        console.log('set by default: '+name);
        set_current_city();
        construct();
      }

      return instance;
    }

    var construct = function() {
      build_html();
      build_modal();
      bind_events();

      if (!cookIe_citY) open_popover();
    }


    var build_html = function() {
      if (!_this.length) {
        console.log('element not exist');
        return false;
      }

      html += '<div class="adress_popover">';
      html += '<span class="current_city">Город: <span class="city_name">'+instance.current_city.name+'</span></span>';
      html += '<div class="city_popover">';
      html += 'Ваш город <span class="city_name">'+instance.current_city.name+'</span>?<br><a href="#" class="close_popover">Да</a><a href="#" class="open_modal_city">Нет</a>';
      html += '</div>';
      html += '</div>';

      _this.append(html);

      city_name = $('.city_name');
      popover = $('.city_popover');
      adress_link = $('.current_city');

      //var marginleft = ~~(adress_link.width()/2) + ~~(popover.width()/2);
      var marginleft = ~~(options.popover_width/2);
      popover.css('marginLeft', -marginleft+'px');

    }

    var build_modal = function() {
      modal += '<div class="city_modal"><span class="choose_city_title">Выберите ваш город</span><span class="city_modal_close">&times;</span>';
      $.each(options.cityes, function(key, obj){
        modal += '<a href="#" class="select_city" data-city="'+key+'">'+obj.name+'</a>';
      });
      modal += '</div><div class="city_overlay"></div>';   

      $('body').append(modal);

      modal_div = $('.city_modal');
      overlay = $('.city_overlay');
    }

    var bind_events = function() {
      adress_link.click(function(e){
        e.preventDefault();
          if (popover.is(':visible')) {
            close_popover();
          } else {
            open_popover();
          }
      });

      $('.close_popover').click(function(e){
        e.preventDefault();
        close_popover();
        set_city(current_city_key);
        if (options.reload_on_change) location.reload();
      });

      overlay.click(function(){
        close_modal();
      });

      $('.city_modal_close').click(function(){
        close_modal();
      });

      $('.open_modal_city').click(function(e){
        e.preventDefault();
        close_popover();
        open_modal();
      });

      $('.city_modal a').click(function(e){
        e.preventDefault();
        var name = $(this).attr('data-city');
        set_city(name);
        close_modal();
        if (options.reload_on_change) location.reload();
      });

    }

    var open_popover = function() {
      instance.trigger('open_popover');
      popover.stop(true).show().animate({ 'marginTop': '20px', opacity: 1 }, 200, function(){
        instance.trigger('opened_popover');
      });
    }

    var close_popover = function() {
      instance.trigger('close_popover');
      popover.stop(true).animate({ 'marginTop': '35px', opacity: 0 }, 200, function(){
          popover.hide()
          instance.trigger('closed_popover');
      });
    }

    var open_modal = function() {
      instance.trigger('open_modal');
      overlay.fadeIn(400,
        function(){
          modal_div.css('display', 'block').animate({opacity: 1, top: '15%'}, 200, function(){
            instance.trigger('opened_modal');
          });
      });
    }

    var close_modal = function() {
      instance.trigger('close_modal');
      modal_div.animate({opacity: 0, top: '5%'}, 200, function(){ // пoсле aнимaции
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
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
    }

    function readCookieCity() {
        name = options.cookie_name;
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    function set_city(name) {
      if (!options.cityes[name]) {
        console.log(name+' not exist');
        return false;
      }
      instance.current_city = options.cityes[name];
      createCookieCity(name);
      city_name.text(options.cityes[name].name)
      instance.trigger('set_city', [options.cityes[name],name]);
    }

    instance.getObj = function(){
      return _this;
    }

    return init(this);
  };
})(jQuery);