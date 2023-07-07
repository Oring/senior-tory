<?php
add_action( 'admin_init', 'page_meta_boxes' );
function page_meta_boxes() {
	global $wpdb;
	$page_options = array(
		array(
			'id'          => 'sidebar_position',
			'label'       => __('Sidebar Position', HT_THEME),
			'type'        => 'select',
			'choices'     => array(
				  array(
					'value' => '',
					'label' => __('Default' , HT_THEME)
				  ),
				  array(
					'value' => 'no',
					'label' => __('No Sidebar', HT_THEME)
				  ),
				  array(
					'value' => 'left',
					'label' => __('Left Sidebar', HT_THEME)
				  ),
				  array(
					'value' => 'right',
					'label' => __('Right Sidebar' , HT_THEME)
				  ),
				  array(
					'value' => 'dual',
					'label' => __('Dual Sidebar' , HT_THEME)
				  )

				)
		),
		array(
			'id'          => 'sidebar_name1',
			'label'       => __('Sidebar Select1', HT_THEME),
			'condition'   => 'sidebar_position:not(no)',
			'type'        => 'sidebar_select'
		),
		 array(
			'id'          => 'sidebar_name2',
			'label'       => __('Sidebar Select2', HT_THEME),
			'type'        => 'sidebar_select',
			'condition'   => 'sidebar_position:is(dual),sidebar_position:not(no)',
			'operator'    => 'and'
		),
		array(
			'id'          => 'sidebar_width',
			'label'       => __('Sidebar width', HT_THEME),
			'type'        => 'select',
			'condition'   => 'sidebar_position:not(no)',
			'choices'     => array(
				  array(
					'value' => '',
					'label' => 'Default'
				  ),
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
			'id'          => 'post_heading',
			'label'       => __('Show Page Heading', HT_THEME),
			'type'        => 'select',
			'choices'     => array(
				  array(
					'value' => 'show',
					'label' => 'Show'
				  ),
				  array(
					'value' => 'hide',
					'label' => 'Hide'
				  )
				)
		),
		array(
			'id'          => 'use_theme_layout_padding',
			'label'       => __('Use Theme Layout Padding', HT_THEME),
			'type'        => 'select',
			'choices'     => array(
				  array(
					'value' => '1',
					'label' => 'Enable'
				  ),
				  array(
					'value' => '0',
					'label' => 'Disable'
				  )
				)
		)
	);

	if(class_exists('RevSliderAdmin')) {
		$slider_list		= $wpdb->get_results("SELECT id, title, alias FROM ".$wpdb->prefix."revslider_sliders ORDER BY id ASC LIMIT 100");
		$slider_data		= array();
		$slider_data[]	= array('value' => 'no','label' => 'No Slider');
		if(!empty($slider_list)){
			foreach ( $slider_list as $item ) {
				$slider_data[]	= array('value' => $item->alias,'label' => $item->title);
			}
			array_push($page_options, array(
				'id'          => 'slider_name',
				'label'       => 'Show revolution slider instead of breadcrumbs and page title',
				'type'        => 'select',
				'choices'     => $slider_data
			));
		}
	}

	$ot_meta_box = array(
		'id'        => 'page_layout',
		'title'     => 'Page Layout',
		'desc'      => '',
		'pages'     => array( 'page', 'post' ),
		'context'   => 'side',
		'priority'  => 'low',
		'fields'    => $page_options
	);

ot_register_meta_box( $ot_meta_box );
}
