<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">	
<meta http-equiv="X-UA-Compatible" content="IE=edge">	
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />	
<link rel="shortcut icon" href="<?php echo ht_get_theme_favicon(); ?>" />
<?php if (ht_get_theme_option('use_responsive',null,"on-off")): ?>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<?php endif; ?>	
<title><?php 
if(mbw_get_param("mode")=="view" && mbw_get_param("board_pid")!=""){ $title	= wp_title('',false, 'right'); }
else { $title	= wp_title( '|', false, 'right' ).get_bloginfo( 'name' ); }
echo trim($title);
?></title>
<?php wp_head(); ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>assets/js/html5shiv.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>assets/js/respond.min.js"></script>
<![endif]-->
<?php echo ht_get_header_style(); ?>
</head>
<body class="<?php ht_body_class() ?> mb-tablet">

<div id="ht-main-wrapper" class="ht-main-wrapper ht-wrapper">