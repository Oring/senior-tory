<?php
/**
 * Initialize the custom Theme Options.
 */
add_action( 'init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.3.0
 */
if (!function_exists('custom_theme_options')) {
	function custom_theme_options() {

	  /* OptionTree is not loaded yet, or this is not an admin request */
	  if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
		return false;

	  /**
	   * Get a copy of the saved settings array. 
	   */
	  $saved_settings = get_option( ot_settings_id(), array() );
	  
	  /**
	   * Custom settings array that will eventually be 
	   * passes to the OptionTree Settings API Class.
	   */
	  $custom_settings = array( 
		'contextual_help' => array( 
		  'content'       => array( 
			array(
			  'id'        => 'option_types_help',
			  'title'     => __( 'Option Types', 'option-tree-theme' ),
			  'content'   => '<p>' . __( 'Help content goes here!', 'option-tree-theme' ) . '</p>'
			)
		  ),
		  'sidebar'       => '<p>' . __( 'Sidebar content goes here!', 'option-tree-theme' ) . '</p>'
		),
		'sections'        => array( 
            array(
                'id'       => 'general',
                'title'    => __('General', HT_THEME),
                'icon'     => 'icon-cog'
            ),
            array(
                'id'       => 'header',
                'title'    => __('Header', HT_THEME),
                'icon'     => 'icon-cogs'
            ),
            array(
                'id'       => 'footer',
                'title'    => __('Footer', HT_THEME),
                'icon'     => 'icon-cogs'
            ),            
			array(
                'id'       => 'sidebars',
                'title'    => __('Sidebars', HT_THEME),
                'icon'     => 'icon-cogs'
            ),            
			array(
                'id'       => 'color_scheme',
                'title'    => __('Color Scheme', HT_THEME),
                'icon'     => 'icon-picture'
            ),
            array(
                'id'       => 'custom_css',
                'title'    => __('Custom CSS/JS', HT_THEME),
                'icon'     => 'icon-paper-clip'
            ),
            array(
                'id'       => 'backup',
                'title'    => __('Import/Export', HT_THEME),
                'icon'     => 'icon-cog'
            )
		),
		'settings'        => array( 


			//HOME
			array(
                'id'          => 'use_responsive',
                'label'       => __('Enable Responsive Layout', HT_THEME),
                'std'         => 'on',
                'type'        => 'on-off',
                'section'     => 'general',
				'desc'    => '반응형 레이아웃 기능의 사용여부를 설정합니다'
            ),
			array(
                'id'          => 'layout_type',
                'label'       => __('Layout', HT_THEME),
                'std'     => 'wide',
                'type'        => 'select',
                'section'     => 'general',
				'desc'    => '레이아웃의 형태를 설정합니다',
                'choices'     => array(
                  array(
                    'value' => 'wide',
                    'label' => __('Wide', HT_THEME)
                  ),
                  array(
                    'value' => 'boxed',
                    'label' => __('Boxed' , HT_THEME)
                  )
                )
            ),						
            array(
                'id'          => 'layout_max_width',
                'label'       => __('Layout Max Width', HT_THEME),
                'desc'        => 'By default: 1200px',
                'std'     => '1200px',
                'type'        => 'text',
                'section'     => 'general',
				'desc'    => '레이아웃의 최대 넓이를 설정합니다'
            ),
	      array(
				'id'          => 'layout_container_padding',
				'label'       => __( 'Layout Padding', 'option-tree-theme' ),
				'std'         => array("top"=>0,"left"=>15,"right"=>15,"bottom"=>0,"unit"=>"px"),
				'type'        => 'spacing',
				'section'     => 'general',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'desc'    => '레이아웃의 기본 패딩값을 설정합니다 (Top, Right, Bottom, Left)',
				'operator'    => 'and'
			  ),
			array(
				'id'          => 'layout_tablet_container_padding',
				'label'       => __( 'Layout Tablet Padding', 'option-tree-theme' ),
				'std'         => array("top"=>0,"left"=>10,"right"=>10,"bottom"=>0,"unit"=>"px"),
				'type'        => 'spacing',
				'section'     => 'general',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'desc'    => '태블릿 레이아웃의 기본 패딩값을 설정합니다 (Top, Right, Bottom, Left)',
				'operator'    => 'and'
			  ),
			array(
				'id'          => 'layout_mobile_container_padding',
				'label'       => __( 'Layout Mobile Padding', 'option-tree-theme' ),
				'std'         => array("top"=>0,"left"=>10,"right"=>10,"bottom"=>0,"unit"=>"px"),
				'type'        => 'spacing',
				'section'     => 'general',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'desc'    => '모바일 레이아웃의 기본 패딩값을 설정합니다 (Top, Right, Bottom, Left)',
				'operator'    => 'and'
			  ),			  
            array(
                'id'          => 'use_back_to_top',
                'label'       => __('Use "Back To Top" button', HT_THEME),
                'std'         => 'on',
                'type'        => 'on-off',
				'desc'        => '우측 하단에 상단 이동하기 화살표 버튼을 표시합니다',
                'section'     => 'general'
            ),            
            
            
       
            // HEADER
			array(
                'id'          => 'use_fixed_nav',
                'label'       => __('Fixed Top Navbar', HT_THEME),
				'std'         => 'on',
                'type'        => 'on-off',
				'desc'        => '스크롤 이동시 상단에 메뉴를 고정시킵니다',
                'section'     => 'header'
            ),
            array(
                'id'          => 'use_top_bar',
                'label'       => __('Use Top Bar', HT_THEME),
                'std'         => 'on',
                'type'        => 'on-off',
				'desc'        => '헤더 상단에 회색바를 표시합니다',
                'section'     => 'header'
            ),			
            array(
                'id'          => 'use_top_panel',
                'label'       => __('Use Top Panel', HT_THEME),
                'std'         => 'on',
                'type'        => 'on-off',
				'desc'        => '헤더 상단에 숨겨진 상단 위젯 패널 기능을 사용합니다',
                'section'     => 'header'
            ),
			array(
                'id'          => 'use_header_widget_inline',
                'label'       => __('Use Top Panel Widget Inline', HT_THEME),
                'std'         => 'on',
                'type'        => 'on-off',
				'desc'        => '상단 위젯 패널의 위젯들을 한줄에 표시합니다',
                'section'     => 'header'
            ),			
            array(
                'id'          => 'theme_main_logo',
                'label'       => __('Main Logo', HT_THEME),
                'std'     => '',
                'desc'        => 'Upload image: png, jpg or gif file',
                'type'        => 'upload',
                'section'     => 'header'
            ),
			array(
                'id'          => 'theme_fixed_nav_logo',
                'label'       => __('Fixed Top Navbar Logo', HT_THEME),
                'std'     => '',
                'desc'        => 'Upload image: png, jpg or gif file',
                'type'        => 'upload',
                'section'     => 'header'
            ),
            array(
                'id'          => 'theme_favicon',
                'label'       => __('Favicon', HT_THEME),
                'desc'        => __('Upload image: png, jpg or gif file',HT_THEME),
                'type'        => 'upload',
                'section'     => 'header'
            ),
            array(
                'id'          => 'use_theme_search',
                'label'       => __('Enable search form in header', HT_THEME),
                'std'         => 'on',
                'type'        => 'on-off',
				'desc'        => '헤더에서 검색 기능 버튼을 표시합니다',
                'section'     => 'header'
            ),
			

            // FOOTER
			array(
                'id'          => 'use_footer_widget_inline',
                'label'       => __('Use Footer Widget Inline', HT_THEME),
                'std'         => 'on',
                'type'        => 'on-off',
				'desc'        => '푸터 위젯 패널의 위젯들을 한줄에 표시합니다 (푸터위젯: Footer1)',
                'section'     => 'footer'
            ),

			array(
				'id'          => 'footer_input_type',
				'label'       => 'Footer Input Type',
				'desc'        => 'HTML: 직접 HTML 코드 입력 / Post: 페이지의 내용을 Footer에 출력',
				'std'         => 'html',
				'type'        => 'select',
				'section'     => 'footer',
				'class'       => '',
				'choices'     => array(
					array(
						'value'   => 'html',
						'label'   => 'HTML'
					),
					array(
						'value'   => 'post',
						'label'   => 'Post'
					)					
				)
			),
			array(
                'id'          => 'footer_post_id',
                'label'       => __('Footer Post', HT_THEME),
                'type'        => 'page_select',
                'section'     => 'footer',
				'condition'   => 'footer_input_type:is(post)',
				'desc'    => 'Footer에 보여줄 페이지를 선택합니다'
            ),
			array(
                'id'          => 'footer_html_code',
                'label'       => __('Footer Html Code', HT_THEME),
                'type'        => 'Textarea',
				'std'         => '<div id="ht-footer-wrapper" class="ht-footer-wrapper ht-layout ht-wrapper ht-border-top-style1" style="text-align: center; border-top: 1px solid #e1e1e1; background-color: #4e84a8; padding: 15px 0 10px;"><div class="container">
			<div style="text-align:center;color: #fff;padding-bottom:20px;">Footer 수정위치: 관리자&gt;외모&gt;Theme Options&gt;Footer&gt;Footer Html Code <a href="'.admin_url().'themes.php?page=ot-theme-options#section_footer" style="color:#F00;background-color:#FFF;;font-weight:600;padding: 2px 3px 3px;" target="_blank">[설정하기]</a></div>
			<div style="font-size: 12px; color: #fff;"><p style="color: #fff;">(주)000 | 대표이사 : 000 | 소재지 : 서울시 구로구 000 000</p><p style="color: #fff;">사업자등록번호 : 000-00-000 | 통신판매업신고 : 제 2016-000-000000 | 전자우편 : 000@gmail.com</p><p style="color: #fff;">개인정보관리책임자 : 000 | 전화 : 000-000-000</p><p style="color: #fff;"><a style="color: #fff;" href="/terms_service">이용약관</a> | <a style="color: #fff;" href="/privacy_policy">개인정보처리방침</a> | <a style="color: #fff;" href="http://www.ftc.go.kr/info/bizinfo/communicationList.jsp" target="_blank" rel="noopener">사업자 정보확인</a></p></div>
			</div></div>',
                'section'     => 'footer',
				'condition'   => 'footer_input_type:is(html)'
            ),

			array(
                'id'          => 'footer_post_id_mobile',
                'label'       => __('Footer Post [Mobile]', HT_THEME),
                'type'        => 'page_select',
                'section'     => 'footer',
				'condition'   => 'footer_input_type:is(post)',
				'desc'    => '모바일에서 Footer에 보여줄 페이지를 선택합니다'
            ),
			array(
                'id'          => 'footer_html_code_mobile',
                'label'       => __('Footer Html Code [Mobile]', HT_THEME),
                'type'        => 'Textarea',
				'std'         => '<div id="ht-footer-wrapper" class="ht-footer-wrapper ht-layout ht-wrapper ht-border-top-style1" style="text-align:center;border-top:1px solid #e1e1e1;background-color:#4e84a8;padding:15px 0 10px;"><div class="container">
<div style="font-size:11px;color:#FFF;"><p style="color:#FFF;">(주)000 | 대표: 000 | 000@gmail.com</p><p style="color:#FFF;">서울시 구로구 000 000</p><p style="color:#FFF;">등록번호 : 000-00-000 | 제 2016-000-000000</p><p style="color:#FFF;"><a style="color:#FFF" href="/terms_service">이용약관</a> | <a style="color:#FFF" href="/privacy_policy">개인정보처리방침</a> | <a style="color:#FFF" href="http://www.ftc.go.kr/info/bizinfo/communicationList.jsp" target="_blank">사업자 정보확인</a></p> </div></div></div>',
                'section'     => 'footer',
				'condition'   => 'footer_input_type:is(html)'
            ),				


			 // SIDEBARS
			array(
				'id'          => 'sidebar_position',
				'label'       => __( 'Sidebar Default Position', 'option-tree-theme' ),
				'std'         => 'full-width',
				'type'        => 'radio-image',
				'section'     => 'sidebars',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'desc'    => '사이드바의 기본 위치를 설정합니다',
				'choices'     => array(
                    array(
                        'value'   => 'left',
                        'label'   => __('Left Sidebar', 'option-tree-theme'),
                        'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
                    ),
                    array(
                        'value'   => 'right',
                        'label'   => __('Right Sidebar', 'option-tree-theme'),
                        'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
                    ),
					array(
                        'value'   => 'dual',
                        'label'   => __('Dual Sidebar', 'option-tree-theme'),
                        'src'     => OT_URL . '/assets/images/layout/dual-sidebar.png'
                    ),
                    array(
                        'value'   => 'no',
                        'label'   => __('Full Width', 'option-tree-theme'),
                        'src'     => OT_URL . '/assets/images/layout/full-width.png'
                    )						
                ),
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and'
			  ),
			   array(
                'id'          => 'sidebar_width',
                'label'       => __('Sidebar Default Width', HT_THEME),
                'type'        => 'select',
				'std'        => 3,
				'section'     => 'sidebars',
				'desc'    => '사이드바의 기본 넓이를 설정합니다',
                'choices'     => array(
                      array(
                        'value' => 2,
                        'label' => '16%'
                      ),
                      array(
                        'value' => 3,
                        'label' => '25%'
                      ),
					  array(
                        'value' => 30,
                        'label' => '30%'
                      ),
                      array(
                        'value' => 4,
                        'label' => '33%'
                      )
                    )
				),
			array(
                'id'          => 'use_mobile_sidebar',
                'label'       => __('Show Mobile Sidebar', HT_THEME),
                'std'         => 'on',
                'type'        => 'on-off',
			    'desc'    => '모바일에서 사이드바 위젯의 표시여부를 설정합니다',
                'section'     => 'sidebars'
            ),
			array(
                'id'          => 'use_right_panel',
                'label'       => __('Use Right Panel', HT_THEME),
                'std'         => 'on',
                'type'        => 'on-off',
				'desc'    => '우측에 숨겨진 사이드 패널 기능을 사용합니다',
                'section'     => 'sidebars'
            ),
			array(
                'id'          => 'use_right_quick_menu',
                'label'       => __('Use Right Quick Menu', HT_THEME),
                'std'         => 'on',
                'type'        => 'on-off',
				'desc'    => '우측에 퀵메뉴 버튼 기능을 표시합니다',
                'section'     => 'sidebars'
            ),
			array(
                'id'          => 'quick_menu_naver_talk_id',
                'label'       => __('Quick Menu - Naver Talk ID', HT_THEME),
                'type'        => 'text',
                'section'     => 'sidebars',
				'desc'    => '네이버톡톡 아이디를 입력합니다 (예: WCCXXX)'
            ),
			array(
                'id'          => 'quick_menu_kakao_plus_id',
                'label'       => __('Quick Menu - Kakao Plus Friend ID', HT_THEME),
                'type'        => 'text',
                'section'     => 'sidebars',
				'desc'    => '카카오 플러스친구 아이디를 입력합니다 (예: @mangboard)'
            ),


            // COLOR SCHEME          
			array(
                'id'          => 'breadcrumbs_info',
                'label'       => __('Breadcrumbs Background', HT_THEME),
                'desc'        => '',
				'std'         => array("background-color"=>"#fdfdfd","background-repeat"=>"","background-attachment"=>"","background-position"=>"","background-size"=>"","background-image"=>""),
                'type'        => 'background',
                'section'     => 'color_scheme',
				'desc'    => '로고와 메인메뉴 하단에 있는 사이트 이동경로 배경을 설정합니다'
            ),
         
            // Custom CSS
		    array(
				'id'          => 'custom_css_text',
				'label'       => __( 'Custom CSS', 'option-tree-theme' ),
				'desc'        => '',
				'std'         => '',
				'type'        => 'css',
				'section'     => 'custom_css',
				'rows'        => '20',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and'
			),
			array(
				'id'          => 'custom_javascript_text',
				'label'       => __( 'Custom JavaScript', 'option-tree-theme' ),
				'desc'        => '',
				'std'         => '',
				'type'        => 'javascript',
				'section'     => 'custom_css',
				'rows'        => '20',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and'
			),
		
		 array(
            'id'          => 'import_data_text',
            'label'       => __( 'Import Options', 'option-tree' ),
            'type'        => 'import-data',
            'section'     => 'backup'
          ),
		  
          array(
            'id'          => 'export_data_text',
            'label'       => __( 'Export Options', 'option-tree' ),
            'type'        => 'export-data',
            'section'     => 'backup'
          )
		  
		)
		
	  );

	  
	  /* allow settings to be filtered before saving */
	  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
	  
	  /* settings are not the same update the DB */
	  if ( $saved_settings !== $custom_settings ) {
		update_option( ot_settings_id(), $custom_settings ); 
	  }
	  
	  /* Lets OptionTree know the UI Builder is being overridden */
	  global $ot_has_custom_theme_options;
	  $ot_has_custom_theme_options = true;
	  
	}
}