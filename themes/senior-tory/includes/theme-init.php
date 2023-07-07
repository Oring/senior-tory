<?php
define('HT_THEME', 'HOMETORY');
define('HT_THEME_VERSION', '1.0.0');
define('HT_HOME_URL', home_url());			//http://www.mangboard.com
define('HT_SITE_URL', site_url());					//http://www.mangboard.com or http://www.mangboard.com/wordpress
define('HT_THEME_URL', get_template_directory_uri());			//http://www.mangboard.com/wp-content/themes/hometory
define('HT_THEME_PATH', get_template_directory());				//home/mangboard/public_html/wp-content/themes/hometory
define('HT_THEME_CHILD_URL', get_stylesheet_directory_uri());		//http://www.mangboard.com/wp-content/themes/hometory-child


if(!function_exists('ht_admin_print_styles')) {
	function ht_admin_print_styles() {
		wp_enqueue_style( 'admin_css', get_stylesheet_directory_uri() . '/assets/css/admin.css' );
	}
}
add_action('admin_print_styles', 'ht_admin_print_styles');

if(!function_exists('ht_admin_enqueue_scripts')) {
	function ht_admin_enqueue_scripts(){
		wp_enqueue_script('admin-js', get_stylesheet_directory_uri() . '/assets/js/admin.js', array('jquery'), null, true);
	}
}
add_action('admin_enqueue_scripts', 'ht_admin_enqueue_scripts',10);

if(!function_exists('ht_init_scripts')) {
	// 자바스크립트 등록
	function ht_init_scripts() {
		// 스타일시트 등록	
		//wp_enqueue_style('bootstrap-style', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array() );
		wp_enqueue_style('bootstrap-grid-style', get_stylesheet_directory_uri() . '/assets/css/bootstrap3-grid.css', array() );	
		wp_enqueue_style('responsive-style', get_stylesheet_directory_uri() . '/assets/css/responsive.css', array() );
		wp_enqueue_style('menu-style', get_stylesheet_directory_uri() . '/assets/css/menu.css', array() );
		wp_enqueue_style('font-style', get_stylesheet_directory_uri() . '/assets/css/font.css', array() );
		wp_enqueue_style('font-nanumgothic', '//cdn.jsdelivr.net/font-nanum/1.0/nanumgothic/nanumgothic.css', array() );
		wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/assets/css/custom.css', array() );		
		//	wp_enqueue_style('animate-style', get_stylesheet_directory_uri() . '/assets/css/animate.min.css', array() );
		wp_enqueue_style( 'ot-theme', get_stylesheet_uri() );
		wp_enqueue_style('font-awesome-style', get_template_directory_uri() . '/assets/fonts/fontawesome/css/all.min.css', array() );
		wp_enqueue_style('genericons', get_template_directory_uri() . '/assets/fonts/genericons/genericons.css', array(), '3.4.1' );		
		if(!is_admin()) wp_enqueue_style('js_composer_front');

		// 자바스크립트 등록	
		//wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), 150120, true);
		wp_enqueue_script('ie-emulation-js', get_stylesheet_directory_uri() . '/assets/js/ie-emulation-modes-warning.js', array('jquery'), null, true);
		wp_enqueue_script('ie8-responsive-file-warning-js', get_stylesheet_directory_uri() . '/assets/js/ie8-responsive-file-warning.js', array('jquery'), null, true);
		wp_enqueue_script('ie10-viewport-js', get_stylesheet_directory_uri() . '/assets/js/ie10-viewport-bug-workaround.js', array('jquery'), null, true);
		wp_enqueue_script('jquery.cookie-js', get_stylesheet_directory_uri() . '/assets/js/jquery.cookie.js', array('jquery'), null, true);
		wp_enqueue_script('imagesloaded.pkgd.min-js', get_stylesheet_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array('jquery'), null, true);
		wp_enqueue_script('hoverdir-js', get_stylesheet_directory_uri() . '/assets/js/jquery.hoverdir.js', array('jquery'), null, true);
		wp_enqueue_script('modernizr-js', get_stylesheet_directory_uri() . '/assets/js/modernizr.custom.97074.js', array('jquery'), null, true);
		wp_enqueue_script('toucheffects-js', get_stylesheet_directory_uri() . '/assets/js/toucheffects.js', array('jquery'), null, true);
		wp_enqueue_script('jquery.easing-js', get_stylesheet_directory_uri() . '/assets/js/jquery.easing.1.3.js', array('jquery'), null, true);
		wp_enqueue_script('jquery.waypoints.min-js', get_stylesheet_directory_uri() . '/assets/js/jquery.waypoints.min.js', array('jquery'), null, true);
		wp_enqueue_script('nicescroll-js', get_stylesheet_directory_uri() . '/assets/js/jquery.nicescroll.min.js', array('jquery'), null, true);
		wp_enqueue_script('masonry');
		
		wp_enqueue_script('hometory-theme-main-js', get_stylesheet_directory_uri() . '/assets/js/hometory-theme-main.js', array('jquery'), 150120, true);
		wp_enqueue_script('hometory-theme-custom-js', get_stylesheet_directory_uri() . '/assets/js/hometory-theme-custom.js', array('jquery'), 150120, true);
		
		if ( is_page_template( 'page-gridblog.php' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action('wp_enqueue_scripts', 'ht_init_scripts');

?>