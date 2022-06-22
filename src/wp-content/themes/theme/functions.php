<?php

/* ========================================
 * Functions.php
 * ========================================
 */


/**
 * Scripts & Styles
 */

function theme_styles()
{
	wp_dequeue_style('wp-block-library');

	wp_enqueue_style('fonts_css', get_template_directory_uri() . '/assets/fonts/fonts.css');

	$style_css = get_template_directory_uri() . '/style.css';
	$lastedit_style_css = filemtime(get_template_directory() . '/style.css');

	wp_enqueue_style('style_css', $style_css, array(), $lastedit_style_css);


	$style_global_css = get_template_directory_uri() . '/global.css';
	$lastedit_style_global_css = filemtime(get_template_directory() . '/global.css');

	wp_enqueue_style('style_global_css', $style_global_css, array(), $lastedit_style_global_css);
}
add_action('wp_enqueue_scripts', 'theme_styles', 100);

function theme_scripts()
{
	$style_all_js = get_template_directory_uri() . '/assets/js/all.js';
	$lastedit_script_all_js = filemtime(get_template_directory() . '/assets/js/all.js');

	wp_enqueue_script('all_js', $style_all_js, array('jquery'), $lastedit_script_all_js, true);

	$style_select_city = get_template_directory_uri() . '/assets/js/libs/city_select.js';
	$lastedit_script_select_city = filemtime(get_template_directory() . '/assets/js/libs/city_select.js');

	wp_enqueue_script('select_city', $style_select_city, array('jquery'), $lastedit_script_select_city, true);
	wp_enqueue_script('jquery_js', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');

	wp_localize_script(
		'all_js',
		'get_template_directory_uri',
		array(
			'home' => get_template_directory_uri()
		)
	);
}
add_action('wp_enqueue_scripts', 'theme_scripts', 101);


//
// SVG media wordpress on
//

add_filter('upload_mimes', 'svg_upload_allow');

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow($mimes)
{
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}

add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);

# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '')
{

	// WP 5.1 +
	if (version_compare($GLOBALS['wp_version'], '5.1.0', '>='))
		$dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
	else
		$dosvg = ('.svg' === strtolower(substr($filename, -4)));

	// mime тип был обнулен, поправим его
	// а также проверим право пользователя
	if ($dosvg) {

		// разрешим
		if (current_user_can('manage_options')) {

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		// запретим
		else {
			$data['ext'] = $type_and_ext['type'] = false;
		}
	}

	return $data;
}

add_filter('wp_prepare_attachment_for_js', 'show_svg_in_media_library');

# Формирует данные для отображения SVG как изображения в медиабиблиотеке.
function show_svg_in_media_library($response)
{

	if ($response['mime'] === 'image/svg+xml') {

		// Без вывода названия файла
		$response['sizes'] = [
			'medium' => [
				'url' => $response['url'],
			],
			// при редактирования картинки
			'full' => [
				'url' => $response['url'],
			],
		];
	}

	return $response;
}

//
// ACF option turn
//

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' 	=> 'Основное - OpenKurban',
		'menu_title'	=> 'Основное - OpenKurban',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Основные настройки',
		'menu_title'	=> 'Основные настройки',
		'parent_slug'	=> 'theme-general-settings',
	));
}

/**
 * Склонение слов в количестве при вводе слова
 */

function num_decline($number, $titles, $show_number = 1)
{

	if (is_string($titles))
		$titles = preg_split('/, */', $titles);

	// когда указано 2 элемента
	if (empty($titles[2]))
		$titles[2] = $titles[1];

	$cases = [2, 0, 1, 1, 1, 2];

	$intnum = abs((int) strip_tags($number));

	$title_index = ($intnum % 100 > 4 && $intnum % 100 < 20)
		? 2
		: $cases[min($intnum % 10, 5)];

	return ($show_number ? "$number " : '') . $titles[$title_index];
}

//
// Create [show_tel]
//

function show_tel_fnc()
{
	if ($tel = get_field('tel', 'options')) :
		return '<a class="tel-shortcode" href="' . $tel['url'] . '">' . $tel['title'] . '</a>';
	endif;
}
add_shortcode('show_tel', 'show_tel_fnc');


//
// Выбор города
//



function get_adress_obj($all = false) {
	$cookie = isset($_COOKIE['current_city']) ? $_COOKIE['current_city'] : false;
	$adresses = get_field('spisok_poddomenov','option');


	$adresses_arr = array();
	foreach ($adresses as $key => $adress) {
		$parsedUrl = parse_url($adress['url']);
		$host = explode('.', $parsedUrl['path']);
		if(!empty($host[2])){
			$subdomain = $host[0];
		}else{
			$subdomain = "kzn";
		}
		$adresses_arr[$subdomain] = $adress;

		
	}

	//echo $result;
	//foreach ($adresses as $key => $value) {
	// $adresses[$key] = array_map('utf8_encode', $value);
	//}

	if ($all) return $adresses_arr;
	else return ($cookie && isset($adresses_arr[$cookie])) ? $adresses_arr[$cookie] : array_shift($adresses_arr);
}





function donate_rep_shortcode( $atts ){
	$html = '';
	if($donate_on_1 = get_field('donate_on_1','options')){
		$html .= sprintf('<div class="donate-item is-selected">'.$donate_on_1.'</div>');
	}
	if($donate_on_2 = get_field('donate_on_2','options')){
		$html .= sprintf('<div class="donate-item">'.$donate_on_2.'</div>');
	}
	if($donate_on_3 = get_field('donate_on_3','options')){
		$html .= sprintf('<div class="donate-item">'.$donate_on_3.'</div>');
	}
	return $html;
}

wpcf7_add_form_tag('donate_rep', 'donate_rep_shortcode');



/**
* Подключение Robokassa
*/
class Robokassa {

	private $login, $password1, $password2,
	$endpoint = 'https://merchant.roboxchange.com/Index.aspx?',
	$customVars = array();

	public $OutSum, $Email = false, $InvId = 0, $Desc, $IncCurrLabel = '', $Culture = 'ru'; /* request parameters */

	/**
	* Вносит в класс данные для генерации защищенной подписи
 	*
   	* @param string $login логин мерчанта
   	* @param string $pass1 пароль №1
   	* @param string $pass2 пароль №2
   	* @param boolean $test работа с тестовым сервером
	*
   	* @return none
	*/
	public function __construct($login, $pass1, $pass2, $test = false)
	{
		$this->login = $login;
		$this->password1 = $pass1;
		$this->password2 = $pass2;

		if($test) $this->endpoint = 'http://test.robokassa.ru/Index.aspx?';
	}

	/**
	* Добавление пользовательских значений в запрос
 	*
   	* @param array $vars именованный массив с переменными(названия указывать с суффиксом shp_)
   	* @return none
	*/
	public function addCustomValues($vars)
	{
		if(!is_array($vars)) throw new Exception('Function `addCustomValues` take only array`s');

		foreach($vars as $k => $v)
			$this->customVars[$k] = $v;

	}

	/**
	* Получение URL для запроса
 	*
   	* @return string $url
	*/
	public function getRedirectURL()
	{
		$customVars = $this->getCustomValues();
		$hash = md5("{$this->login}:{$this->OutSum}:{$this->InvId}:{$this->password1}{$customVars}");
		$invId = ($this->InvId !== '') ? '&InvId=' . $this->InvId : '';
		$IncCurrLabel = ($this->IncCurrLabel !== '') ? '&IncCurrLabel=' . $this->IncCurrLabel : '';
		$Email = ($this->Email !== '') ? '&Email=' . $this->Email : '';

		return $this->endpoint . 'MrchLogin=' . $this->login
			. '&OutSum=' . (float) $this->OutSum
			. $invId
			. '&Desc=' . urlencode($this->Desc)
			. '&SignatureValue=' . $hash
			. $IncCurrLabel
            . $Email
			. '&Culture=' . $this->Culture
			. $this->getCustomValues($url = true);
	}

	/**
	* Проверка исполнения операции. Сравнение хеша
 	*
   	* @param string $hash значение SignatureValue, переданное кассой на Result URL
	* @param boolean $checkSuccess проверка параметров в скрипте завершения операции (SuccessURL)
   	* @return boolean $hashValid
	*/
	public function checkHash($hash, $checkSuccess = false)
	{
		$customVars = $this->getCustomValues();
		$password = $checkSuccess ? $this->password1 :$this->password2;
		$hashGenerated = md5("{$this->OutSum}:{$this->InvId}:{$password}{$customVars}");

		return (strtolower($hash) == $hashGenerated);
	}

	/**
	 * Проверка завершения операции (проверка оплаты). Сравнение хеша
	 *
	 * @param string $hash значение SignatureValue, переданное кассой на Result URL
	 * @return boolean $hashValid
	 */
	public function checkSuccess($hash) {
		return $this->checkHash($hash, true);
	}

	/**
	* Получение строки с пользовательскими данными для шифрования
 	*
    * @param boolean $url генерация строки для использования в URL true/false
   	* @return string
	*/
	private function getCustomValues($url = false)
	{
		$out = '';
		$customVars = array();
		if(!empty($this->customVars))
		{
			foreach($this->customVars as $k => $v)
				$customVars[$k] = $k . '=' . $v;
				
			sort($customVars);

			if($url === TRUE)
				$out = '&' . join('&', $customVars);
			else
				$out = ':' . join(':', $customVars);
		}

		return $out;
	}

}