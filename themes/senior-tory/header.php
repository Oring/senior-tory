<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">	
<meta http-equiv="X-UA-Compatible" content="IE=edge">	
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />	
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="shortcut icon" href="<?php echo ht_get_theme_favicon(); ?>" />
<?php if (ht_get_theme_option('use_responsive',null,"on-off")): 
	$head_meta		= "";
	if(!empty($_SERVER['HTTP_USER_AGENT'])){
		if(preg_match('/(iPhone|iPad|iPod)/i', $_SERVER['HTTP_USER_AGENT'],$matches)){
			//[아이폰] font-size가 16이하인 INPUT 속성에서 포커스시에 확대되는 문제 해결 (아래 코드를 추가해도 아이폰에서는 화면확대 가능)
			$head_meta		= "maximum-scale=1.0, user-scalable=0, ";
		}
	}
?>
<meta name="viewport" content="initial-scale=1, <?php echo $head_meta;?>width=device-width, height=device-height, viewport-fit=cover">
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

<body class="<?php ht_body_class() ?> mb-<?php echo mbw_get_vars("device_type");?>">

<!-- 테마 상단 위젯 패널 -->
<?php if (ht_get_theme_option('use_top_panel',null,"on-off")): ?>
	<div class="ht-widget-panel ht-top-widget-panel ht-layout ht-panel ht-display-none"><!-- top-widget-panel start -->

	
		<div class="container">
			<div class="ht-widget-wrap <?php if(ht_get_theme_option('use_header_widget_inline',null,"on-off")) echo "ht-widget-inline-".ht_get_widget_count('top-panel-sidebar');?>">
			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('top-panel-sidebar')): ?>				
				<div style="font-weight:600;">Top Panel</div>
				<div>위치: 관리자&gt;외모&gt;위젯&gt;Hidden top panel area</div>
				<div>설정: 관리자&gt;외모&gt;Theme Options&gt;Header&gt;Use Top Panel <a href="<?php echo admin_url();?>themes.php?page=ot-theme-options#section_header" style="color:#F00;" target="_blank">[설정하기]</a></div>
			<?php endif; ?>	
			</div>			
		</div>
	</div><!-- top-widget-panel end -->
<?php endif ?>

<!-- 스크롤 이동시 상단 고정 메뉴 -->
<?php if (ht_get_theme_option('use_fixed_nav',null,"on-off")): ?>
	<div class="ht-top-navbar-panel ht-layout ht-panel">

		<div class="ht-top-navbar-popup-search">
			<div class="container">
				<div>
					<form action="<?php echo home_url();?>">
						<input type="text" name="s">
						<div class="ht-popup-search-send"><i class="fa-search fas" style="font-size:17px;color:#BBB;"></i></div>
					</form>			
				</div>
			</div>
		</div>

		<div class="ht-top-navbar">
			<div class="container">
				<div class="ht-menu-wrapper ht-menu-horizontal">					
					<div class="ht-menu-logo">						
						<div class="ht-menu-icon mb-desktop-hide mb-desktop-large-hide"><i class="fas fa-bars icon-panel-open"></i></div>
						<?php echo ht_get_theme_logo("fixed"); ?>
					</div>

					<div class="ht-site-navigation mb-mobile-hide mb-tablet-hide">
					<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
						<nav id="ht-top-navbar-navigation" class="ht-menu-nav ht-menu-primary ht-top-navbar-navigation" role="navigation" aria-label="Primary Menu">
						<?php
								wp_nav_menu( array(
									'theme_location' => 'primary-menu',
									'menu_class'     => 'primary-menu',
								 ) );
						?>
						</nav>
					<?php else: ?>
						<p class="ht-install-info">Primary Menu에 등록된 메뉴가 없습니다 <a href="<?php echo admin_url();?>nav-menus.php" style="color:#F00;" target="_blank">[메뉴설정]</a></p>
					<?php endif; ?>
					</div>
					<?php if (ht_get_theme_option('use_theme_search',null,"on-off")): ?>
						<div class="ht-show-search-popup-btn mb-desktop-large-hide mb-desktop-hide"><i class="fa-search fas" style="font-size:17px;color:#BBB;"></i></div>
						<div class="ht-show-search-popup-close-btn mb-desktop-large-hide mb-desktop-hide"><img src="<?php echo HT_THEME_URL;?>/assets/images/icon_small_close.png" style="width:16px;height:16px;"></div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>

<!-- 모바일 메뉴 -->
<div class="ht-mobile-panel-dim"></div>
<div class="ht-mobile-panel ht-side-block ht-menu-vertical">
	<div class="ht-mobile-panel-header">		
		<div class="ht-mobile-panel-header-person">
			<?php 
			if(mbw_is_login()){
				$img_path			= mbw_get_user('fn_user_picture');
				if($img_path!="" && strpos($img_path,'http')!==0)
					$img_path		= mbw_get_image_url("url_small",$img_path);
				else $img_path	= HT_THEME_URL.'/assets/images/icon_user_thumbnail.gif';
				echo '<div class="ht-header-person-info ht-header-person-img" style="background-image: url('.$img_path.');"></div>';
				echo '<div class="ht-header-person-info ht-header-person-name"><p>'.mbw_get_user('fn_user_name').'</p><p><span>레벨 '.mbw_get_user('fn_user_level').'</span> / <span>포인트 '.number_format(mbw_get_user('fn_user_point')).'</span></p></div>';

			}else{
				$img_path	= HT_THEME_URL.'/assets/images/icon_user_thumbnail.gif';
				echo '<a href="'.mbw_get_user_url("login").'">';
				echo '<div class="ht-header-person-info ht-header-person-img" style="background-image: url('.$img_path.');"></div>';
				echo '<div class="ht-header-person-info ht-header-person-login">로그인을 해주세요</div>';
				echo '</a>';
			}
			?>
			<div class="ht-close-ht-mobile-panel"></div>
			<div class="clear"></div>
		</div>		
	</div>
	<?php echo ht_get_top_links("mobile"); ?>
	<!-- 모바일 검색 -->
	<?php if (ht_get_theme_option('use_theme_search',null,"on-off")): ?>
		<form action="<?php echo home_url();?>">
			<div class="ht-mobile-search-box"><i class="fa-search fas ht-mobile-search-btn" style="font-size:17px;color:#BBB;"></i><input type="text" name="s"></div>
		</form>
	<?php endif ?>
	<div class="ht-site-navigation">
	<?php if ( has_nav_menu( 'mobile-menu' ) ) : ?>
		<nav id="ht-mobile-navigation" class="ht-menu-nav ht-menu-mobile ht-mobile-navigation" role="navigation" aria-label="Mobile Menu">
		<?php
				wp_nav_menu( array(
					'theme_location' => 'mobile-menu',
					'menu_class'     => 'mobile-menu',
				 ) );
		?>
		</nav>
	<?php endif; ?>
	</div>
	<div class="ht-mobile-panel-heading">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('mobile-sidebar')): ?>		
		<?php endif; ?>
	</div>
</div>


<!-- 우측 위젯 패널 -->
<div class="ht-widget-panel ht-right-widget-panel mb-hide-mobile mb-hide-tablet ht-layout ht-panel ht-border-style1">
		
	<?php if(ht_get_theme_option('use_right_quick_menu',null,"on-off")): ?>
	<ul class="ht-widget-panel-btns">
		<?php if(ht_get_theme_option('use_right_panel',null,"on-off")): ?>
		<li class="ht-right-open-btn" title="퀵메뉴" style="cursor:pointer;"></li>
		<?php endif; ?>
		<?php  if ( mbw_get_option("commerce_version")!="" && function_exists('mbw_init_commerce_panel') ) : ?>	
		<li><a href="<?php echo mbw_check_permalink(mbw_get_option("post_cart")); ?>" title="장바구니"><div style="padding:8px 8px 8px 9px;"><img src="<?php echo HT_THEME_URL;?>/assets/images/icon_small_my-cart4_mobile.png" style="width:20px;height:20px;"></div></a></li>
		<li><a href="<?php echo mbw_check_permalink(mbw_get_option("post_my_order")); ?>" title="주문/배송조회"><div style="padding:11px 11px;"><i class="fas fa-truck" style="font-size:14px;"></i></div></a></li>
		<?php endif; ?>
		<?php  if ( ht_get_theme_option('quick_menu_kakao_plus_id')!="" ) : ?>	
		<li><a href="http://plus.kakao.com/home/<?php echo ht_get_theme_option('quick_menu_kakao_plus_id');?>" title="카카오 플러스친구" target="_blank"><div style="padding:8px 8px;"><img src="<?php echo HT_THEME_URL;?>/assets/images/icon_small_kakao.png" style="width:20px;height:20px;"></div></a></li>
		<?php endif; ?>
		<?php  if ( ht_get_theme_option('quick_menu_naver_talk_id')!="" ) : ?>	
		<li><a href="#" title="네이버톡톡" onclick="javascript:window.open('http://talk.naver.com/<?php echo ht_get_theme_option('quick_menu_naver_talk_id');?>?ref=<?php echo urlencode(mbw_get_current_url());?>', 'talktalk', 'width=471, height=640');return false;" class=""><div style="padding:8px 8px;"><img src="<?php echo HT_THEME_URL;?>/assets/images/icon_small_naver.png" style="width:20px;height:20px;"></div></a></li>
		<?php endif; ?>
		<li><a href="#" id="favorite" title="즐겨찾기 등록"><div style="padding:8px 8px;"><img src="<?php echo HT_THEME_URL;?>/assets/images/icon_small_star.png" style="width:20px;height:20px;"></div></a></li>
		<li class="ht-right-top-btn" title="위로" style="padding:8px 8px;cursor:pointer;"><img src="<?php echo HT_THEME_URL;?>/assets/images/icon_small_top.png" style="width:20px;height:20px;"></li>
		<li class="ht-right-down-btn" title="아래로" style="padding:8px 8px;cursor:pointer;"><img src="<?php echo HT_THEME_URL;?>/assets/images/icon_small_bottom.png" style="width:20px;height:20px;"></li>
	</ul>
	<?php endif; ?>

	<?php if(ht_get_theme_option('use_right_panel',null,"on-off")): ?>
		<div class="ht-widget-panel">
			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('right-panel-sidebar')): ?>
				<div style="font-weight:600;">Right Panel</div>
				<div>관리자>외모>위젯>Right side panel area</div>
				<div style="padding-top:12px;">설정: 관리자&gt;외모&gt;Theme Options></div>
				<div style="padding-left:32px;">Sidebars&gt;Use Right Panel</div>
				<div style="padding-left:32px;"><a href="<?php echo admin_url();?>themes.php?page=ot-theme-options#section_sidebars" style="color:#F00;" target="_blank">[설정하기]</a></div>

				<div style="font-weight:600;padding-top:22px;">Quick Menu</div>
				<div>설정: 관리자&gt;외모&gt;Theme Options></div>
				<div style="padding-left:32px;">Sidebars&gt;Use Right Quick Menu</div>
				<div style="padding-left:32px;"><a href="<?php echo admin_url();?>themes.php?page=ot-theme-options#section_sidebars" style="color:#F00;" target="_blank">[설정하기]</a></div>

				<div style="font-weight:600;padding-top:22px;">네이버 톡톡</div>
				<div>설정: 관리자&gt;외모&gt;Theme Options></div>
				<div style="padding-left:32px;">Sidebars&gt;Quick Menu - Naver Talk ID</div>
				<div style="padding-left:32px;"><a href="<?php echo admin_url();?>themes.php?page=ot-theme-options#section_sidebars" style="color:#F00;" target="_blank">[설정하기]</a></div>

				<div style="font-weight:600;padding-top:22px;">카카오 플러스 친구</div>
				<div>설정: 관리자&gt;외모&gt;Theme Options></div>
				<div style="padding-left:32px;">Sidebars&gt;Quick Menu - Kakao Plus Friend ID</div>
				<div style="padding-left:32px;"><a href="<?php echo admin_url();?>themes.php?page=ot-theme-options#section_sidebars" style="color:#F00;" target="_blank">[설정하기]</a></div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>

<div id="ht-main-wrapper" class="ht-main-wrapper ht-wrapper">
	<!-- 상단 Bar (로그인,로그아웃,나의계정) -->	
	<?php if (ht_get_theme_option('use_top_bar',null,"on-off")): ?>
		<div class="ht-top-bar ht-layout ht-border-bottom-style1"><!-- top-panel start -->
			<div class="container">
				<!-- 상단 위젯 패널 Show,Hide 버튼 -->	
				<?php if (ht_get_theme_option('use_top_panel',null,"on-off")): ?>
					<div class="ht-top-widget-open mb-hide-mobile"></div>
				<?php endif; ?>

				<!-- 우측 위젯 패널 Show,Hide 버튼 -->	
				<?php if(ht_get_theme_option('use_right_panel',null,"on-off")): ?>
					<div class="ht-right-icon mb-mobile-hide mb-tablet-hide"><i class="fas fa-bars icon-panel-open"></i></div>
				<?php endif; ?>
				<!-- 전체 검색 -->
				<?php if (ht_get_theme_option('use_theme_search',null,"on-off")): ?>				
				<div class="ht-top-bar-search mb-mobile-hide">
					<form action="<?php echo home_url();?>"><input type="text" name="s"></form>
					<div class="ht-top-search-btn"><img src="<?php echo HT_THEME_URL;?>/assets/images/icon_small_search_d.png"></div>					
					<div class="ht-top-close-btn"><img src="<?php echo HT_THEME_URL;?>/assets/images/icon_small_close.png" style="width:12px;height:12px;"></div>
				</div>
				<?php endif ?>
				<?php echo ht_get_top_links();?>
			</div>
		</div><!-- top-panel end -->
	<?php endif ?>
	

	<div class="ht-header-wrapper ht-layout ht-wrapper ht-border-bottom-style1"><!-- header-wrapper start -->		
		<div id="ht-main-nav-panel" class="ht-main-nav-panel visible-desktop"><!-- main nav menu start -->
			<div class="">
				<div class="container">
					<div class="ht-menu-wrapper ht-menu-horizontal">
						<div class="ht-menu-logo">
							<div class="ht-menu-icon mb-desktop-hide mb-desktop-large-hide"><i class="fas fa-bars icon-panel-open"></i></div>
							<?php echo ht_get_theme_logo(); ?>
						</div>

						<div class="ht-site-navigation mb-mobile-hide mb-tablet-hide">
						<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
							<nav id="ht-main-navigation" class="ht-menu-nav ht-menu-primary ht-main-navigation" role="navigation" aria-label="Primary Menu">
							<?php
									wp_nav_menu( array(
										'theme_location' => 'primary-menu',
										'menu_class'     => 'primary-menu',
									 ) );
							?>
							</nav>
						<?php else: ?>
							<p class="ht-install-info">Primary Menu에 등록된 메뉴가 없습니다 <a href="<?php echo admin_url();?>nav-menus.php" style="color:#F00;" target="_blank">[메뉴설정]</a></p>
						<?php endif; ?>
						<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- ht-main-nav-panel menu end -->
	</div><!-- ht-header-wrapper end -->