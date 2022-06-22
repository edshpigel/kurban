# OpenKurban
<https://kurban.shop>

Загружены только gulp-файлы и тема сайта 

1. В файле [acf-fields.php](acf/acf-fields.php) находятся все произвольные поля настренные в плагине ACF, для управления контентом сайта 
2. Стоит обратить внимание на реализацию выбора города: был использован скрипт [city_select.js](src/wp-content/themes/theme/assets/js/libs/city_select.js), функционал в [footer.php](/src/wp-content/themes/theme/footer.php#L63), в панели управления WordPress есть возможность добавлять поддомены и настраивать контакты в каждом городе [acf-fields.php](acf/acf-fields.php#L698)