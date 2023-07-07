<?php
if(!function_exists('ht_get_theme_favicon')) {
	function ht_get_theme_favicon() {
		$theme_favicon		= ot_get_option( "theme_favicon" );
		$theme_favicon		= apply_filters('hf_theme_favicon', $theme_favicon);

		if(empty($theme_favicon)){
			$theme_favicon		= HT_THEME_URL.'/assets/images/favicon.ico';
		}
		return mbw_check_url($theme_favicon);
	}
}

if(!function_exists('ht_get_theme_logo')) {
	function ht_get_theme_logo($type="main") {
		if($type=="main"){
			$theme_logo		= ot_get_option( "theme_main_logo" );
			$theme_logo		= apply_filters('hf_theme_main_logo', $theme_logo);			
		}else if($type=="fixed"){
			$theme_logo		= ot_get_option( "theme_fixed_nav_logo" );
			if(empty($theme_logo)) $theme_logo		= ot_get_option( "theme_main_logo" );
			$theme_logo		= apply_filters('hf_theme_fixed_logo', $theme_logo);			
		}		

		if(!empty($theme_logo)){
			$logo_html		= '<a href="'.home_url().'"><img src="'.mbw_check_url($theme_logo).'" alt="'.get_bloginfo( "name" ).'" /></a>';
		}else{
			$logo_html		= '<a href="'.home_url().'"><img src="'.HT_THEME_URL.'/assets/images/img_main_logo.png" alt="'.get_bloginfo( "name" ).'" /></a>';
		}
		return $logo_html;
	}
}

if(!function_exists('ht_get_theme_option')) {
	function ht_get_theme_option($option_id, $default = null,$type = "") {
		$option_value		= $default;
		if ( function_exists( 'ot_get_option' ) ) {
			if($type==""){
				$option_value		= ot_get_option( $option_id, $option_value );
			}else if($type=="on-off"){
				$option_value		= ot_get_option( $option_id, $option_value );
				if($option_value=="on") $option_value	= true;
				else $option_value	= false;
			}else if($type=="logo"){
				$option_value		= ht_get_theme_logo();
			}else if($type=="shortcode"){
				$option_value		= do_shortcode(ot_get_option( $option_id, $option_value ));
			}else if($type=="css"){
				$option_value		= demo_parse_css( $option_id, ot_get_option( $option_id, $option_value ) );
			}
		}
		return apply_filters('hf_theme_option_'.$option_id, $option_value);
	}
}
if(!function_exists('ht_get_widget_count')) {
	function ht_get_widget_count($widget_id) {
		$registered_widgets		= wp_get_sidebars_widgets();
		return count($registered_widgets[$widget_id]);
	}
}				


if(!function_exists('ht_get_layout_options')) {
	function ht_get_layout_options(){
		global $layout_options;
		return $layout_options;
	}
}
if(!function_exists('ht_set_layout_options')) {
	function ht_set_layout_options($data){		
		global $layout_options;
		$layout_options					= array_merge($layout_options,$data);
	}
}
if(!function_exists('ht_get_layout_option')) {
	function ht_get_layout_option($key){
		global $layout_options;
		if(isset($layout_options[$key])){
			return ($layout_options[$key]);
		}else return "";
	}
}
if(!function_exists('ht_set_layout_option')) {
	function ht_set_layout_option($key,$value){
		global $layout_options;
		$layout_options[$key]		= $value;
	}
}
if(!function_exists('ht_set_post_options')) {
	function ht_set_post_options(){		
		global $layout_options,$post;
		$post_id		= "";
		if(!empty($post)) $post_id				= $post->ID;		
		if(empty($post_id)) return;

		$post_options												= array();
		$post_options['page_heading']						= get_post_meta( $post_id, 'page_heading', true );
		$post_options['slider_name']							= get_post_meta( $post_id, 'slider_name', true );	
		$post_options['sidebar_position']						= get_post_meta( $post_id, 'sidebar_position', true );	
		$post_options['sidebar_width']						= intval(get_post_meta( $post_id, 'sidebar_width', true ));
		$post_options['sidebar_name1']						= get_post_meta( $post_id, 'sidebar_name1', true );
		$post_options['post_heading']						= get_post_meta( $post_id, 'post_heading', true );
		$post_options['use_theme_layout_padding']		= get_post_meta( $post_id, 'use_theme_layout_padding', true );
		$post_options['content_layout']						= "";		

		if(empty($post_options['sidebar_name1'])) $post_options['sidebar_name1']			= 'main-sidebar';
		if(empty($post_options['sidebar_position'])) $post_options['sidebar_position']		= ht_get_theme_option('sidebar_position');
		if(empty($post_options['sidebar_width'])) $post_options['sidebar_width']			= intval(ht_get_theme_option('sidebar_width'));

		$layout_max						= 12;
		if($post_options['sidebar_width']>12) $layout_max		= 100;

		$post_options['sidebar_name2']		= $post_options['sidebar_name1'];
		$post_options['sidebar_class']			= 'col-sm-'.($post_options['sidebar_width']);
		if($post_options['sidebar_position']=="left" || $post_options['sidebar_position']=="right"){
			$post_options['content_class']	= 'col-sm-'.($layout_max-$post_options['sidebar_width']);
		}else if($post_options['sidebar_position']=="dual"){
			$post_options['content_class']	= 'col-sm-'.($layout_max-($post_options['sidebar_width']*2));
			$post_options['sidebar_name2']		= get_post_meta( $post_id, 'sidebar_name2', true );
			if(empty($post_options['sidebar_name2'])) $post_options['sidebar_name2']			= $post_options['sidebar_name1'];
		}else{
			$post_options['content_class']	= 'col-sm-12';
		}
		
		ht_set_layout_options($post_options);		
	}
}

if(!function_exists('ht_get_resize_responsive')){
	function ht_get_resize_responsive(){
		$responsive_script		= 'function resizeResponsive(){';
			$responsive_script		.= 'var nWidth	= window.innerWidth;';	
			if(mbw_get_vars("device_type")=="desktop"){
				$responsive_array		= array("1200","992","768");
				$responsive_script		.= 'if(nWidth>='.$responsive_array[0].'){jQuery(".mb-desktop").removeClass("mb-desktop").addClass("mb-desktop-large");jQuery(".mb-tablet").removeClass("mb-tablet").addClass("mb-desktop-large");jQuery(".mb-mobile").removeClass("mb-mobile").addClass("mb-desktop-large");';
				$responsive_script		.= '}else if(nWidth>='.$responsive_array[1].'){jQuery(".mb-desktop-large").removeClass("mb-desktop-large").addClass("mb-desktop");jQuery(".mb-tablet").removeClass("mb-tablet").addClass("mb-desktop");jQuery(".mb-mobile").removeClass("mb-mobile").addClass("mb-desktop");';
				$responsive_script		.= '}else if(nWidth>='.$responsive_array[2].'){jQuery(".mb-desktop-large").removeClass("mb-desktop-large").addClass("mb-tablet");jQuery(".mb-desktop").removeClass("mb-desktop").addClass("mb-tablet");jQuery(".mb-mobile").removeClass("mb-mobile").addClass("mb-tablet");';		
				$responsive_script		.= '}else if(nWidth<'.$responsive_array[2].'){jQuery(".mb-desktop-large").removeClass("mb-desktop-large").addClass("mb-mobile");jQuery(".mb-desktop").removeClass("mb-desktop").addClass("mb-mobile");jQuery(".mb-tablet").removeClass("mb-tablet").addClass("mb-mobile");}';
			}else{
				$type		= mbw_get_vars("device_type");
				$responsive_script		.= 'if(window.orientation && (window.orientation==90 || window.orientation==-90)){
					jQuery(".mb-'.$type.'").removeClass("mb-'.$type.'-portrait").addClass("mb-'.$type.'-landscape");
				}else{
					jQuery(".mb-'.$type.'").removeClass("mb-'.$type.'-landscape").addClass("mb-'.$type.'-portrait");
				}';
			}
		$responsive_script		.= '}';

		if(mbw_get_vars("device_type")=="desktop"){
			$responsive_script		.= 'if(typeof jQuery != "undefined"){ jQuery(window).on("resize",resizeResponsive);resizeResponsive();};';
		}else{
			$responsive_script		.= 'if(typeof jQuery != "undefined"){ jQuery(window).on("orientationchange",resizeResponsive);resizeResponsive();};';
		}
		return $responsive_script;
	}
}

if(!function_exists('ht_get_header_style')) {
	function ht_get_header_style() {
		ht_set_post_options();
		
		$container_padding				= ht_get_theme_option('layout_container_padding');
		$t_container_padding			= ht_get_theme_option('layout_tablet_container_padding');
		$m_container_padding			= ht_get_theme_option('layout_mobile_container_padding');
		$header_style						= ht_get_theme_option('custom_css_text');
		$body_info							= ht_get_theme_option('background_info');
		$breadcrumbs_info				= ht_get_theme_option('breadcrumbs_info');
		$layout_type						= ht_get_theme_option('layout_type');
		$use_mobile_sidebar				= ht_get_theme_option('use_mobile_sidebar',null,'on-off');
				
		$body_style							= "";
		$breadcrumbs_style				= "";		

		$padding_style			= $container_padding['top'].$container_padding['unit'].' '.$container_padding['right'].$container_padding['unit'].' '.$container_padding['bottom'].$container_padding['unit'].' '.$container_padding['left'].$container_padding['unit'].' !important;';
		$t_padding_style			= $t_container_padding['top'].$t_container_padding['unit'].' '.$t_container_padding['right'].$t_container_padding['unit'].' '.$t_container_padding['bottom'].$t_container_padding['unit'].' '.$t_container_padding['left'].$t_container_padding['unit'].' !important;';
		$m_padding_style		= $m_container_padding['top'].$m_container_padding['unit'].' '.$m_container_padding['right'].$m_container_padding['unit'].' '.$m_container_padding['bottom'].$m_container_padding['unit'].' '.$m_container_padding['left'].$m_container_padding['unit'].' !important;';

		if(!empty($body_info['background-color'])) $body_style .= 'background-color:'.$body_info['background-color'].';';
		if(!empty($body_info['background-repeat'])) $body_style .= 'background-repeat:'.$body_info['background-repeat'].';';		
		if(!empty($body_info['background-position'])) $body_style .= 'background-position:'.$body_info['background-position'].';';
		if(!empty($body_info['background-size'])) $body_style .= 'background-size:'.$body_info['background-size'].';';
		if(!empty($body_info['background-attachment'])) $body_style .= 'background-attachment:'.$body_info['background-attachment'].';';
		if(!empty($body_info['background-image'])) $body_style .= 'background-image:url(\''.$body_info['background-image'].'\');';

		if(!empty($breadcrumbs_info['background-color'])) $breadcrumbs_style .= 'background-color:'.$breadcrumbs_info['background-color'].';';
		if(!empty($breadcrumbs_info['background-repeat'])) $breadcrumbs_style .= 'background-repeat:'.$breadcrumbs_info['background-repeat'].';';		
		if(!empty($breadcrumbs_info['background-position'])) $breadcrumbs_style .= 'background-position:'.$breadcrumbs_info['background-position'].';';
		if(!empty($breadcrumbs_info['background-size'])) $breadcrumbs_style .= 'background-size:'.$breadcrumbs_info['background-size'].';';
		if(!empty($breadcrumbs_info['background-attachment'])) $breadcrumbs_style .= 'background-attachment:'.$breadcrumbs_info['background-attachment'].';';
		if(!empty($breadcrumbs_info['background-image'])) $breadcrumbs_style .= 'background-image:url(\''.$breadcrumbs_info['background-image'].'\');';

		$header_style		.= 'body{'.$body_style.'}';
		$header_style		.= '.ht-body-head-wrapper{'.$breadcrumbs_style .'}';
		$header_style		.= '.container{max-width:'.ht_get_theme_option('layout_max_width').' !important;}';

		$use_theme_layout_padding		= ht_get_layout_option('use_theme_layout_padding');
		if($use_theme_layout_padding!="0"){
			$header_style		.= '.container{padding:'.$padding_style.';}';
			$header_style		.= '.container-fluid{padding:'.$padding_style.';}';
			$header_style		.= '.mb-tablet .container{padding:'.$t_padding_style.';}';
			$header_style		.= '.mb-tablet .container-fluid{padding:'.$t_padding_style.';}';
			$header_style		.= '.mb-mobile .container{padding:'.$m_padding_style.';}';
			$header_style		.= '.mb-mobile .container-fluid{padding:'.$m_padding_style.';}';
		}
		if($layout_type=="boxed"){
			$header_style		.= '.container{padding:0 17px;}';
			$header_style		.= '.ht-main-wrapper{margin:0 auto;max-width:'.ht_get_theme_option('layout_max_width').' !important;}';
		}
		if(!$use_mobile_sidebar){
			$header_style		.= '.mb-mobile .ht-sidebar-left,.mb-mobile .ht-sidebar-right{display:none !important;}';
		}
		//IE를 제외한 브라우저에 셀렉트 CSS 적용
		if(!empty($_SERVER['HTTP_USER_AGENT']) && !preg_match('/(MSIE|Trident)/i', $_SERVER['HTTP_USER_AGENT'])){
			$header_style		.= '.mb-board div select{width:auto;padding:1px 15px 0 7px !important;min-width:64px;*padding:2px 0px;border: 1px solid #ccc;background-color:#FFF;appearance:none !important;-moz-appearance:none !important;-webkit-appearance:none !important;background-image: url("'.HT_THEME_URL.'/assets/images/icon_select_arrow.png") !important;background-repeat: no-repeat;background-position: center right;}';
		}
		return '<style type="text/css">'.$header_style.'</style>';
	}
}




if(!function_exists('ht_get_post_heading')) {
	function ht_get_post_heading(){
		if( is_home() && get_option('page_for_posts') ) {
			$page_id = get_option('page_for_posts');
			$title	= get_the_title($page_id);
		} elseif ( is_search() ) {	
			$title	= get_search_query();
		} elseif ( is_category() ) {
			$cat = get_category(get_query_var('cat'), false);
			$title	= $cat->name;
		} elseif ( is_tag() ) {
			$title	= single_tag_title();
		} elseif ( is_author() ) {
			$title	= get_the_author();
		} elseif ( is_year() ) {
			$title	= get_the_time('Y');
		} elseif ( is_month() ) {
			$title	= get_the_time('Y - F');
		} elseif ( is_day() ) {
			$title	= get_the_time('Y - F - d');
		} else {
			$title	= get_the_title();
		}

		$head_html		= '';
		$head_html		.= '<div class="ht-post-heading" style="">';
			$head_html		.= '<div><span class="ht-title">'.$title.'</span></div>';
			$head_html		.= '<div class="ht-post-breadcrumbs" style="">'.ht_get_breadcrumbs().'</div>';
		$head_html		.= '</div>';
		return $head_html;
	}
}
if(!function_exists('ht_get_breadcrumbs')) {
    function ht_get_breadcrumbs() {
		global $post;
		$breadcrumbs_html		= "";
		
		if (is_front_page()) {
			$breadcrumbs_html	.= '<div id="ht_breadcrumbs"><a href="' . home_url() . '">' . __('Home', HT_THEME) . '</a></div>';
		} else {
			$check_wrap			= true;
			$delimiter_tag			= '<span class="ht-delimeter">/</span>'; 
			$current_html			= '';

			$breadcrumbs_html	.= '<div class="ht-breadcrumbs-wrapper mb-mobile-hide">';
			$breadcrumbs_html	.= '<div>';
			$breadcrumbs_html	.= '<a href="' . home_url() . '">' . __('Home', HT_THEME) . '</a> ' . $delimiter_tag . ' ';


			if ( is_category() ) {
				$cat = get_category(get_query_var('cat'), false);
				if ($cat->parent != 0) $current_html	.= get_category_parents($cat->parent, TRUE, ' ' . $delimiter_tag . ' ');
				$current_html	.= 'Archive by category "' . single_cat_title('', false) . '"';
			} elseif ( is_page() ) {
				$current_html	.= get_the_title();

			} elseif ( is_search() ) {
				$current_html	.= 'Search results for "' . get_search_query() . '"';

			} elseif ( is_day() ) {
				$current_html	.= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter_tag . ' ';
				$current_html	.= '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter_tag . ' ';
				$current_html	.= get_the_time('d');

			} elseif ( is_month() ) {
				$current_html	.= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter_tag . ' ';
				$current_html	.= get_the_time('F');

			} elseif ( is_year() ) {
				$current_html	.= get_the_time('Y');

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				$current_html	.= $post_type->labels->singular_name;

			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$current_html	.= get_the_title();
	
			} elseif ( is_tag() ) {
				$current_html	.= 'Posts tagged "' . single_tag_title('', false) . '"';

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				$current_html	.= 'Articles posted by ' . $userdata->display_name;

			} elseif ( is_404() ) {
				$current_html	.= 'Error 404';
			}else{
				$current_html		.= __('Blog', HT_THEME);
				$check_wrap		= false;
			}
			if($check_wrap){
				$breadcrumbs_html	.= '<span class="current">'.$current_html.'</span>';
			}

			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $breadcrumbs_html	.= ' (';
				$breadcrumbs_html	.= ' ('.__('Page') . ' ' . get_query_var('paged').')';
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $breadcrumbs_html	.= ')';
			}
			$breadcrumbs_html	.= '</div>';
			$breadcrumbs_html	.= '</div>';
		}
		return $breadcrumbs_html;
	}
}



if(!function_exists('ht_get_top_links')) {
    function ht_get_top_links($type="") {
        ?>
            <ul class="ht-links">
			<?php 
				if($type!="mobile" && mbw_get_vars("device_type")!="mobile"){
					$new_memo			= mbw_get_user('fn_new_memo');		
					$slug						= get_post_field( 'post_name', get_post() );
					if(!empty($new_memo) && $slug!="user_messages"){
						global $mb_fields,$mb_admin_tables,$wpdb;
						if(!empty($mb_admin_tables)){					
							$post_id				= $wpdb->get_var("SELECT ".$mb_fields["board_options"]["fn_post_id"]." FROM ".$mb_admin_tables["board_options"]." where ".$mb_fields["board_options"]["fn_board_name2"]."='user_messages' limit 1");
							if(!empty($post_id)){
								$permalink			= get_permalink($post_id);
								echo '<li class="ht-user-new-msg" style=""><a href="'.$permalink.'"><span class="ht-my-memo-count">'.$new_memo.'</span>'.__('메시지', HT_THEME ).'</a></li>';
							}						
						}
					}
				}
				?>
                <?php if ( mbw_is_login() ) : ?>
                    <li class="ht-my-account-link"><a href="#"><?php _e( '나의계정', HT_THEME ); ?></a>
					<div class="ht-my-account-hitarea" style=""></div>
                    <div class="ht-submenu-dropdown">						
                        <?php  if ( has_nav_menu( 'account-menu' ) ) : ?>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'account-menu',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'depth' => 3,
                                'fallback_cb' => false
                            )); ?>
						<?php else : ?>
							<div style="font-weight:600;">나의계정 메뉴추가 방법</div>
							<div style="padding-top:12px;">관리자&gt;외모&gt;메뉴></div>
							<div style="padding-top:7px;">메뉴추가&gt;메뉴설정-위치표시&gt;</div>
							<div style="padding-top:7px;">Account Menu 선택</div>
							<div style="padding-top:7px;"><a href="<?php echo admin_url();?>nav-menus.php" style="color:#F00;" target="_blank">[설정하기]</a></div>
                        <?php endif; ?>
                    </div>
                </li>				
					<?php  if ( mbw_get_option("commerce_version")!="" && function_exists('mbw_init_commerce_panel') ) : ?>	
					<li class="ht-my-cart-link" style=""><a href="<?php  echo mbw_check_permalink(mbw_get_option("post_cart")); ?>"><?php _e( '장바구니', HT_THEME ); ?><span class="mb-product-cart-count"><span class="mb-number"><?php  echo mbw_get_cart_items_count(); ?></span></span></a></li>
					<?php endif; ?>
                <li class="ht-logout-link"><a href="<?php  echo home_url(); ?>/?mb_user=logout"><?php _e( '로그아웃', HT_THEME ); ?></a></li>
                <?php else : ?>
                    <li class="ht-login-link"><a href="<?php  echo mbw_get_user_url("login"); ?>"><?php _e( '로그인', HT_THEME ); ?></a></li>
					<li class="ht-register-link"><a href="<?php  echo mbw_get_user_url("register"); ?>"><?php _e( '회원가입', HT_THEME ); ?></a></li>
                <?php endif; ?>							 
            </ul>
			<ul class="clear"></ul>
        <?php
    }
}

if(!function_exists('ht_body_class')) {
	function ht_body_class( $print = true ) {
		global $wp_query, $current_user;

		$c = array('wordpress');

		ht_date_classes( time(), $c );

		is_front_page()  ? $c[] = 'home'       : null;
		is_home()        ? $c[] = 'blog'       : null;
		is_archive()     ? $c[] = 'archive'    : null;
		is_date()        ? $c[] = 'date'       : null;
		is_search()      ? $c[] = 'search'     : null;
		is_paged()       ? $c[] = 'paged'      : null;
		is_attachment()  ? $c[] = 'attachment' : null;
		is_404()         ? $c[] = 'four04'     : null;

		if ( is_single() ) {
			$postID = $wp_query->post->ID;
			the_post();

			$c[] = 'single postid-' . $postID;

			if ( isset( $wp_query->post->post_date ) )
				ht_date_classes( mysql2date( 'U', $wp_query->post->post_date ), $c, 's-' );

			if ( $cats = get_the_category() )
				foreach ( $cats as $cat )
					$c[] = 's-category-' . $cat->slug;

			if ( $tags = get_the_tags() )
				foreach ( $tags as $tag )
					$c[] = 's-tag-' . $tag->slug;

			if ( is_attachment() ) {
				$mime_type = get_post_mime_type();
				$mime_prefix = array( 'application/', 'image/', 'text/', 'audio/', 'video/', 'music/' );
					$c[] = 'attachmentid-' . $postID . ' attachment-' . str_replace( $mime_prefix, "", "$mime_type" );
			}

			rewind_posts();
		} elseif ( is_author() ) {
			$author = $wp_query->get_queried_object();
			$c[] = 'author';
			$c[] = 'author-' . $author->user_nicename;
		} elseif ( is_category() ) {
			$cat = $wp_query->get_queried_object();
			$c[] = 'category';
			$c[] = 'category-' . $cat->slug;
		} elseif ( is_tag() ) {
			$tags = $wp_query->get_queried_object();
			$c[] = 'tag';
			$c[] = 'tag-' . $tags->slug;
		} elseif ( is_page() ) {
			$pageID = $wp_query->post->ID;
			$page_children = wp_list_pages("child_of=".$pageID."&echo=0");
			the_post();
			$c[] = 'page pageid-' . $pageID;
			if ( $page_children )
				$c[] = 'page-parent';
			if ( $wp_query->post->post_parent )
				$c[] = 'page-child parent-pageid-' . $wp_query->post->post_parent;
			if ( is_page_template() )
				$c[] = 'page-template page-template-' . str_replace( '.php', '-php', get_post_meta( $pageID, '_wp_page_template', true ) );
			rewind_posts();
		} elseif ( is_search() ) {
			the_post();
			if ( have_posts() ) {
				$c[] = 'search-results';
			} else {
				$c[] = 'search-no-results';
			}
			rewind_posts();
		}

		if ( is_admin_bar_showing() ){
			$c[] = 'wp_adminbar';
		}

		if ( $current_user->ID )
			$c[] = 'loggedin';

		if ( ( ( $page = $wp_query->get('paged') ) || ( $page = $wp_query->get('page') ) ) && $page > 1 ) {
			$page = intval($page);
			$c[] = 'paged-' . $page;
			if ( is_single() ) {
				$c[] = 'single-paged-' . $page;
			} elseif ( is_page() ) {
				$c[] = 'page-paged-' . $page;
			} elseif ( is_category() ) {
				$c[] = 'category-paged-' . $page;
			} elseif ( is_tag() ) {
				$c[] = 'tag-paged-' . $page;
			} elseif ( is_date() ) {
				$c[] = 'date-paged-' . $page;
			} elseif ( is_author() ) {
				$c[] = 'author-paged-' . $page;
			} elseif ( is_search() ) {
				$c[] = 'search-paged-' . $page;
			}
		}

		$c = join( ' ', apply_filters( 'body_class',  $c ) );

		return $print ? print($c) : $c;
	}
}
if(!function_exists('ht_post_class')) {
	function ht_post_class( $print = true ) {
		global $post, $hometory_post_alt;

		$c = array( 'hentry', "p".$hometory_post_alt, $post->post_type, $post->post_status );

		foreach ( (array) get_the_category() as $cat )
			$c[] = 'category-' . $cat->slug;

		if ( get_the_tags() == null ) {
			$c[] = 'untagged';
		} else {
			foreach ( (array) get_the_tags() as $tag )
				$c[] = 'tag-' . $tag->slug;
		}

		if ( $post->post_password )
			$c[] = 'protected';

		ht_date_classes( mysql2date( 'U', $post->post_date ), $c );

		if ( ++$hometory_post_alt % 2 )
			$c[] = 'alt';

		$c = join( ' ', apply_filters( 'post_class', $c ) );

		return $print ? print($c) : $c;
	}
}

$hometory_post_alt = 1;

if(!function_exists('ht_date_classes')) {
	function ht_date_classes( $t, &$c, $p = '' ) {
		$t = $t + ( get_option('gmt_offset') * 3600 );
		$c[] = $p . 'y' . gmdate( 'Y', $t );
		$c[] = $p . 'm' . gmdate( 'm', $t );
		$c[] = $p . 'd' . gmdate( 'd', $t );
		$c[] = $p . 'h' . gmdate( 'H', $t );
	}
}

if(!function_exists('ht_gallery')) {
	function ht_gallery($attr) {
		global $post;
		if ( isset($attr['orderby']) ) {
			$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
			if ( !$attr['orderby'] )
				unset($attr['orderby']);
		}

		extract(shortcode_atts( array(
			'orderby'    => 'menu_order ASC, ID ASC',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
		), $attr ));

		$id           =  intval($id);
		$orderby      =  addslashes($orderby);
		$attachments  =  get_children("post_parent=$id&post_type=attachment&post_mime_type=image&orderby={$orderby}");

		if ( empty($attachments) )
			return null;

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $id => $attachment )
				$output .= wp_get_attachment_link( $id, $size, true ) . "\n";
			return $output;
		}

		$listtag     =  tag_escape($listtag);
		$itemtag     =  tag_escape($itemtag);
		$captiontag  =  tag_escape($captiontag);
		$columns     =  intval($columns);
		$itemwidth   =  $columns > 0 ? floor(100/$columns) : 100;

		$output = apply_filters( 'gallery_style', "\n" . '<div class="gallery">', 9 );

		foreach ( $attachments as $id => $attachment ) {
			$img_lnk = get_attachment_link($id);
			$img_src = wp_get_attachment_image_src( $id, $size );
			$img_src = $img_src[0];
			$img_alt = $attachment->post_excerpt;
			if ( $img_alt == null )
				$img_alt = $attachment->post_title;
			$img_rel = apply_filters( 'gallery_img_rel', 'attachment' );
			$img_class = apply_filters( 'gallery_img_class', 'gallery-image' );

			$output  .=  "\n\t" . '<' . $itemtag . ' class="gallery-item gallery-columns-' . $columns .'">';
			$output  .=  "\n\t\t" . '<' . $icontag . ' class="gallery-icon"><a href="' . $img_lnk . '" title="' . $img_alt . '" rel="' . $img_rel . '"><img src="' . $img_src . '" alt="' . $img_alt . '" class="' . $img_class . ' attachment-' . $size . '" /></a></' . $icontag . '>';

			if ( $captiontag && trim($attachment->post_excerpt) ) {
				$output .= "\n\t\t" . '<' . $captiontag . ' class="gallery-caption">' . $attachment->post_excerpt . '</' . $captiontag . '>';
			}

			$output .= "\n\t" . '</' . $itemtag . '>';
			if ( $columns > 0 && ++$i % $columns == 0 )
				$output .= "\n</div>\n" . '<div class="gallery">';
		}
		$output .= "\n</div>\n";

		return $output;
	}
}


if(!function_exists('widget_hometory_search')) {
	function widget_hometory_search($args) {
		extract($args);
		$options = get_option('widget_hometory_search');
		$title = empty($options['title']) ? __( 'Search', HT_THEME ) : attribute_escape($options['title']);
		$button = empty($options['button']) ? __( 'Find', HT_THEME ) : attribute_escape($options['button']);
	?>
				<?php echo $before_widget ?>
					<?php echo $before_title ?><label for="s"><?php echo $title ?></label><?php echo $after_title ?>
					<form id="searchform" class="blog-search" method="get" action="<?php bloginfo('home') ?>">
						<div>
							<input id="s" name="s" type="text" class="text" value="<?php the_search_query() ?>" size="10" tabindex="1" />
							<input type="submit" class="button" value="<?php echo $button ?>" tabindex="2" />
						</div>
					</form>
				<?php echo $after_widget ?>
	<?php
	}
}
if(!function_exists('widget_hometory_search_control')) {
	// Widget: Search; element controls for customizing text within Widget plugin
	function widget_hometory_search_control() {
		$options = $newoptions = get_option('widget_hometory_search');
		if ( $_POST['search-submit'] ) {
			$newoptions['title'] = strip_tags(stripslashes( $_POST['search-title']));
			$newoptions['button'] = strip_tags(stripslashes( $_POST['search-button']));
		}
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option( 'widget_hometory_search', $options );
		}
		$title = attribute_escape($options['title']);
		$button = attribute_escape($options['button']);
	?>
		<p><label for="search-title"><?php _e( 'Title:', HT_THEME ) ?> <input class="widefat" id="search-title" name="search-title" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="search-button"><?php _e( 'Button Text:', HT_THEME ) ?> <input class="widefat" id="search-button" name="search-button" type="text" value="<?php echo $button; ?>" /></label></p>
		<input type="hidden" id="search-submit" name="search-submit" value="1" />
	<?php
	}
}
if(!function_exists('widget_hometory_meta')) {
	function widget_hometory_meta($args) {
		extract($args);
		$options = get_option('widget_meta');
		$title = empty($options['title']) ? __( 'Meta', HT_THEME ) : attribute_escape($options['title']);
	?>
				<?php echo $before_widget; ?>
					<?php echo $before_title . $title . $after_title; ?>
					<ul>
						<?php wp_register() ?>

						<li><?php wp_loginout() ?></li>
						<?php wp_meta() ?>

					</ul>
				<?php echo $after_widget; ?>
	<?php
	}
}
if(!function_exists('widget_hometory_rsslinks')) {
	function widget_hometory_rsslinks($args) {
		extract($args);
		$options = get_option('widget_hometory_rsslinks');
		$title = empty($options['title']) ? __( 'RSS Links', HT_THEME ) : attribute_escape($options['title']);
	?>
			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
				<ul>
					<li><a href="<?php bloginfo('rss2_url') ?>" title="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?> <?php _e( 'Posts RSS feed', HT_THEME ); ?>" rel="alternate" type="application/rss+xml"><?php _e( 'All posts', HT_THEME ) ?></a></li>
					<li><a href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo wp_specialchars(bloginfo('name'), 1) ?> <?php _e( 'Comments RSS feed', HT_THEME ); ?>" rel="alternate" type="application/rss+xml"><?php _e( 'All comments', HT_THEME ) ?></a></li>
				</ul>
			<?php echo $after_widget; ?>
	<?php
	}
}
if(!function_exists('widget_hometory_rsslinks_control')) {
	function widget_hometory_rsslinks_control() {
		$options = $newoptions = get_option('widget_hometory_rsslinks');
		if ( $_POST['rsslinks-submit'] ) {
			$newoptions['title'] = strip_tags( stripslashes( $_POST['rsslinks-title'] ) );
		}
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option( 'widget_hometory_rsslinks', $options );
		}
		$title = attribute_escape($options['title']);
	?>
		<p><label for="rsslinks-title"><?php _e( 'Title:', HT_THEME ) ?> <input class="widefat" id="rsslinks-title" name="rsslinks-title" type="text" value="<?php echo $title; ?>" /></label></p>
		<input type="hidden" id="rsslinks-submit" name="rsslinks-submit" value="1" />
	<?php
	}
}
if(!function_exists('ht_widgets_init')) {
	function ht_widgets_init() {
		if ( !function_exists('register_sidebars') )
			return;

		$p = array(
			'before_widget'  =>   "\n\t\t\t" . '<li id="%1$s" class="widget %2$s">',
			'after_widget'   =>   "\n\t\t\t</li>\n",
			'before_title'   =>   "\n\t\t\t\t". '<h3 class="ht-widget-title">',
			'after_title'    =>   "</h3>\n"
		);
		register_sidebars( 2, $p );
	}
}

load_theme_textdomain('hometory');
add_action( 'init', 'ht_widgets_init' );
add_filter( 'post_gallery', 'ht_gallery');
add_filter( 'archive_meta', 'wptexturize' );
add_filter( 'archive_meta', 'convert_smilies' );
add_filter( 'archive_meta', 'convert_chars' );
add_filter( 'archive_meta', 'wpautop' );
?>