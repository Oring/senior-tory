<?php

/**
 * Register Theme Features
 */
function ht_theme_setup()  {

  /**
   * Add support for i18n Theme Translation
   * See http://codex.wordpress.org/I18n_for_WordPress_Developers
   */
  load_theme_textdomain( 'option-tree-theme', get_template_directory() . '/languages' );
  
  // Enable support for Post Thumbnails.
  add_theme_support( 'post-thumbnails' );

  /**
   * Enable support for all Post Formats.
   * See http://codex.wordpress.org/Post_Formats
   */
  add_theme_support( 'post-formats', array(
    'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'
  ) );
  
}
add_action( 'after_setup_theme', 'ht_theme_setup' );

/**
 * Filters the Theme Options ID
 */
function ht_theme_options_id() {
  return 'hometory_theme';
}
add_filter( 'ot_options_id', 'ht_theme_options_id' );

/**
 * Filters the Settings ID
 */
function ht_theme_settings_id() {
  return 'hometory_theme_settings';
}
add_filter( 'ot_settings_id', 'ht_theme_settings_id' );

/**
 * Filters the Layouts ID
 */
function ht_theme_layouts_id() {
  return 'hometory_theme_layouts';
}
add_filter( 'ot_layouts_id', 'ht_theme_layouts_id' );

/**
 * Filters the Theme Option header list.
 */
function ht_theme_header_list() {
  echo '';  
}
add_action( 'ot_header_list', 'ht_theme_header_list' );

function ht_theme_header_version_text() {
  echo '<li id="theme-version"><span>Version ' .HT_THEME_VERSION. '</span></li>';
}
add_action( 'ot_header_version_text', 'ht_theme_header_version_text' );

function ht_theme_header_logo_link() {
  return	 '<a href="http://www.hometory.com" target="_blank">HOMETORY</a>';
}
add_filter( 'ot_header_logo_link', 'ht_theme_header_logo_link' );




/**
 * Theme Mode
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Child Theme Mode
 */
add_filter( 'ot_child_theme_mode', '__return_false' );

/**
 * Show Settings Pages
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Show Theme Options UI Builder
 */
add_filter( 'ot_show_options_ui', '__return_true' );

/**
 * Show Settings Import
 */
add_filter( 'ot_show_settings_import', '__return_true' );

/**
 * Show Settings Export
 */
add_filter( 'ot_show_settings_export', '__return_true' );

/**
 * Show New Layout
 */
add_filter( 'ot_show_new_layout', '__return_true' );

/**
 * Show Documentation
 */
add_filter( 'ot_show_docs', '__return_true' );

/**
 * Custom Theme Option page
 */
add_filter( 'ot_use_theme_options', '__return_true' );

/**
 * Meta Boxes
 */
add_filter( 'ot_meta_boxes', '__return_true' );

/**
 * Allow Unfiltered HTML in textareas options
 */
add_filter( 'ot_allow_unfiltered_html', '__return_false' );

/**
 * Loads the meta boxes for post formats
 */
add_filter( 'ot_post_formats', '__return_true' );

/**
 * OptionTree in Theme Mode
 */
require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

/**
 * Theme Options
 */
require( trailingslashit( get_template_directory() ) . 'includes/ot-options.php' );

/**
 * Meta Boxes
 */

require( trailingslashit( get_template_directory() ) . 'includes/ot-meta-boxes.php' );

require( trailingslashit( get_template_directory() ) . 'option-tree/includes/ot-functions-settings-page.php' );


if(function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => __('Main Sidebar', HT_THEME),
        'id' => 'main-sidebar',
        'description' => __('The main sidebar area', HT_THEME),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div><!-- //widget -->',
        'before_title' => '<h4 class="ht-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Shop Sidebar', HT_THEME),
        'id' => 'shop-sidebar',
        'description' => __('Shop page widget area', HT_THEME),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div><!-- //widget -->',
        'before_title' => '<h4 class="ht-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Single product page Sidebar', HT_THEME),
        'id' => 'single-sidebar',
        'description' => __('Single product page widget area', HT_THEME),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div><!-- //widget -->',
        'before_title' => '<h4 class="ht-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Shopping cart sidebar', HT_THEME),
        'id' => 'cart-sidebar',
        'description' => __('Area after cart totals block', HT_THEME),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div><!-- //widget -->',
        'before_title' => '<h4 class="ht-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Right side panel area', HT_THEME),
        'id' => 'right-panel-sidebar',
        'description' => __('Right side panel widget area', HT_THEME),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div><!-- //widget -->',
        'before_title' => '<h4 class="ht-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Hidden top panel area', HT_THEME),
        'id' => 'top-panel-sidebar',
        'description' => __('Hidden top panel widget area', HT_THEME),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div><!-- //widget -->',
        'before_title' => '<h4 class="ht-widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Place in header top bar', HT_THEME),
        'id' => 'languages-sidebar',
        'description' => __('Can be used for placing languages switcher of some contacts information.', HT_THEME),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div><!-- //widget -->',
        'before_title' => '<h4 class="ht-widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Prefooter Row', HT_THEME),
        'id' => 'prefooter',
        'before_widget' => '<div id="%1$s" class="prefooter-widget %2$s">',
        'after_widget' => '</div><!-- //prefooter-widget -->',
        'before_title' => '<h4 class="ht-widget-title">',
        'after_title' => '</h4>',
    ));


    register_sidebar(array(
        'name' => __('Footer 1', HT_THEME),
        'id' => 'footer1',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div><!-- //footer-widget -->',
        'before_title' => '<h4 class="ht-widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer 2', HT_THEME),
        'id' => 'footer2',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div><!-- //widget -->',
        'before_title' => '<h4 class="ht-widget-title">',
        'after_title' => '</h4>',
    ));


    register_sidebar(array(
        'name' => __('Footer Copyright', HT_THEME),
        'id' => 'footer9',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div><!-- //footer-widget -->',
        'before_title' => '<h4 class="ht-widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer Links', HT_THEME),
        'id' => 'footer10',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div><!-- //footer-widget -->',
        'before_title' => '<h4 class="ht-widget-title">',
        'after_title' => '</h4>',
    ));
}





/**
 * Custom Sidebars
 */

function ht_add_sidebar(){
    if (!wp_verify_nonce($_GET['_wpnonce_hometory_widgets'],'hometory-add-sidebar-widgets') ) die( 'Security check' );
    if($_GET['hometory_sidebar_name'] == '') die('Empty Name');
    $option_name = 'hometory_custom_sidebars';
    if(!get_option($option_name) || get_option($option_name) == '') delete_option($option_name);

    $new_sidebar = $_GET['hometory_sidebar_name'];


    if(get_option($option_name)) {
        $hometory_custom_sidebars = ht_get_stored_sidebar();
        $hometory_custom_sidebars[] = trim($new_sidebar);
        $result = update_option($option_name, $hometory_custom_sidebars);
    }else{
        $hometory_custom_sidebars[] = $new_sidebar;
        $result2 = add_option($option_name, $hometory_custom_sidebars);
    }


    if($result) die('Updated');
    elseif($result2) die('added');
    else die('error');
}

/**
*
*   Function for deleting sidebar (AJAX action)
*/

function ht_delete_sidebar(){
    $option_name = 'hometory_custom_sidebars';
    $del_sidebar = trim($_GET['hometory_sidebar_name']);

    if(get_option($option_name)) {
        $hometory_custom_sidebars = ht_get_stored_sidebar();

        foreach($hometory_custom_sidebars as $key => $value){
            if($value == $del_sidebar)
                unset($hometory_custom_sidebars[$key]);
        }


        $result = update_option($option_name, $hometory_custom_sidebars);
    }

    if($result) die('Deleted');
    else die('error');
}

/**
*
*   Function for registering previously stored sidebars
*/
function ht_register_stored_sidebar(){
    $hometory_custom_sidebars = ht_get_stored_sidebar();
    if(is_array($hometory_custom_sidebars)) {
        foreach($hometory_custom_sidebars as $name){
            register_sidebar( array(
                'name' => ''.$name.'',
                'id' => $name,
                'class' => 'hometory_custom_sidebar',
                'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="ht-widget-title">',
                'after_title' => '</h3>',
            ) );
        }
    }

}

/**
*
*   Function gets stored sidebar array
*/
function ht_get_stored_sidebar(){
    $option_name = 'hometory_custom_sidebars';
    return get_option($option_name);
}


/**
*
*   Add form after all widgets
*/
function ht_sidebar_form(){
    ?>

    <form action="<?php echo admin_url( 'widgets.php' ); ?>" method="post" id="hometory_add_sidebar_form">
        <h2>Custom Sidebar</h2>
        <?php wp_nonce_field( 'hometory-add-sidebar-widgets', '_wpnonce_hometory_widgets', false ); ?>
        <input type="text" name="hometory_sidebar_name" id="hometory_sidebar_name" />
        <button type="submit" class="button-primary" value="add-sidebar">Add Sidebar</button>
    </form>
    <script type="text/javascript">
        var sidebarForm = jQuery('#hometory_add_sidebar_form');
        var sidebarFormNew = sidebarForm.clone();
        sidebarForm.remove();
        jQuery('#widgets-right').append('<div style="clear:both;"></div>');
        jQuery('#widgets-right').append(sidebarFormNew);

        sidebarFormNew.submit(function(e){
            e.preventDefault();
            var data =  {
                'action':'hometory_add_sidebar',
                '_wpnonce_hometory_widgets': jQuery('#_wpnonce_hometory_widgets').val(),
                'hometory_sidebar_name': jQuery('#hometory_sidebar_name').val(),
            };
            //console.log(data);
            jQuery.ajax({
                url: ajaxurl,
                data: data,
                success: function(response){
                    window.location.reload(true);
                },
                error: function(data) {
                    console.log('error');

                }
            });
        });

    </script>
    <?php
}

add_action( 'sidebar_admin_page', 'ht_sidebar_form', 30 );
add_action('wp_ajax_hometory_add_sidebar', 'ht_add_sidebar');
add_action('wp_ajax_hometory_delete_sidebar', 'ht_delete_sidebar');
add_action( 'widgets_init', 'ht_register_stored_sidebar' );



?>