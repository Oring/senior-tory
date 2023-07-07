<?php
if(!function_exists('ht_register_nav_menus')) {
    function ht_register_nav_menus() {
        register_nav_menus(array(
            'primary-menu' => __('Primary Menu', HT_THEME),
            'mobile-menu' => __('Mobile Menu', HT_THEME),
            'account-menu' => __('Account Menu', HT_THEME),
			'footer-menu' => __('Footer Menu', HT_THEME),
			'manager-menu' => __('Manager Menu', HT_THEME),
			'left-menu' => __('Left Menu', HT_THEME),
			'right-menu' => __('Right Menu', HT_THEME),
			'top-menu' => __('Top Menu', HT_THEME),
			'bottom-menu' => __('Bottom Menu', HT_THEME)
        ));
    }
}

add_action('init', 'ht_register_nav_menus');

/*
if(!function_exists('ht_register_nav_menus2')) {
    function ht_register_nav_menus2() {
        register_nav_menus(array(
            'mobile-nav' => 'Mobile Top Navigation'
        ));
    }
}
add_action('init', 'ht_register_nav_menus2');
*/
?>