<?php 


if (!class_exists( 'RWMB_Loader' )) {
	return;
}


add_filter( 'rwmb_meta_boxes', 'cryptronick_pteam_meta_boxes' );
function cryptronick_pteam_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Team Options', 'cryptronick' ),
        'post_types' => array( 'team' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
	            'name' => esc_html__( 'Info Name Department', 'cryptronick' ),
	            'id'   => 'department_name',
	            'type' => 'text',
	            'class' => 'name-field'
	        ),       
        	array(
	            'name' => esc_html__( 'Member Department', 'cryptronick' ),
	            'id'   => 'department',
	            'type' => 'text',
	            'class' => 'field-inputs'
	        ),
			array(
				'name' => esc_html__( 'Info', 'cryptronick' ),
	            'id'   => 'info_items',
	            'type' => 'social',
	            'clone' => true,
	            'sort_clone'     => true,
	            'desc' => esc_html__( 'Description', 'cryptronick' ),
	            'options' => array(
					'name'    => array(
						'name' => esc_html__( 'Name', 'cryptronick' ),
						'type_input' => 'text'
						),
					'description' => array(
						'name' => esc_html__( 'Description', 'cryptronick' ),
						'type_input' => 'text'
						),
					'link' => array(
						'name' => esc_html__( 'Url', 'cryptronick' ),
						'type_input' => 'text'
						),
				),
	        ),		
	        array(
				'name'     => esc_html__( 'Icons', 'cryptronick' ),
				'id'          => "soc_icon",
				'type'        => 'select_icon',
				'options'     => function_exists('bpt_get_all_icon') ? bpt_get_all_icon() : '',
				'clone' => true,
				'sort_clone'     => true,
				'placeholder' => esc_html__( 'Select an icon', 'cryptronick' ),
				'multiple'    => false,
				'std'         => 'default',
			),
        ),
    );
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'cryptronick_pportfolio_meta_boxes' );
function cryptronick_pportfolio_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Portfolio Options', 'cryptronick' ),
        'post_types' => array( 'portfolio' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'id'   => 'mb_portfolio_featured_img',
				'name' => esc_html__( 'Show Featured image on single', 'cryptronick' ),
				'type' => 'checkbox',
			),        	
			array(
				'id'   => 'mb_portfolio_title',
				'name' => esc_html__( 'Show Title on single', 'cryptronick' ),
				'type' => 'checkbox',
			),	
			array(
				'name' => esc_html__( 'Info', 'cryptronick' ),
	            'id'   => 'mb_portfolio_info_items',
	            'type' => 'social',
	            'clone' => true,
	            'sort_clone'     => true,
	            'desc' => esc_html__( 'Description', 'cryptronick' ),
	            'options' => array(
					'name'    => array(
						'name' => esc_html__( 'Name', 'cryptronick' ),
						'type_input' => 'text'
						),
					'description' => array(
						'name' => esc_html__( 'Description', 'cryptronick' ),
						'type_input' => 'text'
						),
					'link' => array(
						'name' => esc_html__( 'Url', 'cryptronick' ),
						'type_input' => 'text'
						),
				),
	        ),		
	        array(
				'name'     => esc_html__( 'Show Tags', 'cryptronick' ),
				'id'          => "mb_portfolio_above_content_cats",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'cryptronick' ),
					'yes' => esc_html__( 'yes', 'cryptronick' ),
					'no' => esc_html__( 'no', 'cryptronick' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),		
	        array(
				'name'     => esc_html__( 'Show Share Links', 'cryptronick' ),
				'id'          => "mb_portfolio_above_content_share",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'cryptronick' ),
					'yes' => esc_html__( 'yes', 'cryptronick' ),
					'no' => esc_html__( 'no', 'cryptronick' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),			
        ),
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'cryptronick_pportfolio_related_meta_boxes' );
function cryptronick_pportfolio_related_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Related Portfolio', 'cryptronick' ),
        'post_types' => array( 'portfolio' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'id'   => 'mb_pf_carousel_r',
				'name' => esc_html__( 'Display items carousel for this portfolio post', 'cryptronick' ),
				'type' => 'checkbox',
				'std'  => 1,
			),           	
			array(
				'id'   => 'mb_pf_show_r',
				'name' => esc_html__( 'Show related', 'cryptronick' ),
				'type' => 'checkbox',
				'std'  => 1,
			),
			array(
				'name' => esc_html__( 'Title', 'cryptronick' ),
				'id'   => "mb_pf_title_r",
				'type' => 'text',
				'std'  => 'Related Portfolio',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('mb_pf_show_r','=','1')
						),
					),
				),
			), 			
			array(
				'name' => esc_html__( 'Categories', 'cryptronick' ),
				'id'   => "mb_pf_cat_r",
				'multiple'    => true,
				'type' => 'taxonomy_advanced',
				'taxonomy' => 'portfolio-category',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('mb_pf_show_r','=','1')
						),
					),
				),
			),     
			array(
				'name'     => esc_html__( 'Columns', 'cryptronick' ),
				'id'          => "mb_pf_column_r",
				'type'        => 'select',
				'options'     => array(
					'1' => esc_html__( 'One', 'cryptronick' ),
					'2' => esc_html__( 'Two', 'cryptronick' ),
					'3' => esc_html__( 'Three', 'cryptronick' ),
					'4' => esc_html__( 'Four', 'cryptronick' ),
				),
				'multiple'    => false,
				'std'         => '4',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('mb_pf_show_r','=','1')
						),
					),
				),
			),  
			array(
				'name' => esc_html__( 'Number of Related Items', 'cryptronick' ),
				'id'   => "mb_pf_number_r",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 4,
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('mb_pf_show_r','=','1')
						),
					),
				),
			),
        ),
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'cryptronick_blog_meta_boxes' );
function cryptronick_blog_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'      => esc_html__( 'Post Format Layout', 'cryptronick' ),
		'post_types' => array( 'post' ),
		'context' => 'advanced',
		'fields'     => array(
			// Standard Post Format
			array(
				'name'             => esc_html__( 'You can use only featured image for this post-format', 'cryptronick' ),
				'id'               => "post_format_standard",
				'type'             => 'static-text',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','0')
						),
					),
				),
			),
			// Gallery Post Format
			array(
				'name'             => esc_html__( 'Gallery images', 'cryptronick' ),
				'id'               => "post_format_gallery_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => '',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','gallery')
						),
					),
				),
			),
			// Video Post Format
			array(
				'name' => esc_html__( 'oEmbed', 'cryptronick' ),
				'id'   => "post_format_video_oEmbed",
				'desc' => esc_html__( 'enter URL', 'cryptronick' ),
				'type' => 'oembed',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','video')
						),
						array(
							array('post_format_video_select','=','oEmbed')
						)
					),
				),
			),
			// Audio Post Format
			array(
				'name' => esc_html__( 'oEmbed', 'cryptronick' ),
				'id'   => "post_format_audio_oEmbed",
				'desc' => esc_html__( 'enter URL', 'cryptronick' ),
				'type' => 'oembed',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','audio')
						),
						array(
							array('post_format_audio_select','=','oEmbed')
						)
					),
				),
			),
			// Quote Post Format
			array(
				'name'             => esc_html__( 'Quote Author', 'cryptronick' ),
				'id'               => "post_format_qoute_author",
				'type'             => 'text',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','quote')
						),
					),
				),
			),
			array(
				'name'             => esc_html__( 'Author Image', 'cryptronick' ),
				'id'               => "post_format_qoute_author_image",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','quote')
						),
					),
				),
			),
			array(
				'name'             => esc_html__( 'Quote Content', 'cryptronick' ),
				'id'               => "post_format_qoute_text",
				'type'             => 'textarea',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','quote')
						),
					),
				),
			),
			// Link Post Format
			array(
				'name'             => esc_html__( 'Link URL', 'cryptronick' ),
				'id'               => "post_format_link",
				'type'             => 'url',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','link')
						),
					),
				),
			),
			array(
				'name'             => esc_html__( 'Link Text', 'cryptronick' ),
				'id'               => "post_format_link_text",
				'type'             => 'text',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','link')
						),
					),
				),
			),


		)
	);
	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'cryptronick_blog_related_meta_boxes' );
function cryptronick_blog_related_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Related Blog Post', 'cryptronick' ),
        'post_types' => array( 'post' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'id'   => 'mb_blog_carousel_r',
				'name' => esc_html__( 'Display items carousel for this blog post', 'cryptronick' ),
				'type' => 'checkbox',
				'std'  => 1,
			),           	
			array(
				'id'   => 'mb_blog_show_r',
				'name' => esc_html__( 'Show related', 'cryptronick' ),
				'type' => 'checkbox',
				'std'  => 1,
			),
			array(
				'name' => esc_html__( 'Title', 'cryptronick' ),
				'id'   => "mb_blog_title_r",
				'type' => 'text',
				'std'  => 'Related Posts',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('mb_blog_show_r','=','1')
						),
					),
				),
			), 			
			array(
				'name' => esc_html__( 'Categories', 'cryptronick' ),
				'id'   => "mb_blog_cat_r",
				'multiple'    => true,
				'type' => 'taxonomy_advanced',
				'taxonomy' => 'category',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('mb_blog_show_r','=','1')
						),
					),
				),
			),     
			array(
				'name'     => esc_html__( 'Columns', 'cryptronick' ),
				'id'          => "mb_blog_column_r",
				'type'        => 'select',
				'options'     => array(
					'12' => esc_html__( 'One', 'cryptronick' ),
					'6' => esc_html__( 'Two', 'cryptronick' ),
					'4' => esc_html__( 'Three', 'cryptronick' ),
					'3' => esc_html__( 'Four', 'cryptronick' ),
				),
				'multiple'    => false,
				'std'         => '2',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('mb_blog_show_r','=','1')
						),
					),
				),
			),  
			array(
				'name' => esc_html__( 'Number of Related Items', 'cryptronick' ),
				'id'   => "mb_blog_number_r",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 2,
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('mb_blog_show_r','=','1')
						),
					),
				),
			),
        ),
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'cryptronick_page_layout_meta_boxes' );
function cryptronick_page_layout_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      => esc_html__( 'Page Layout', 'cryptronick' ),
        'post_types' => array( 'page' , 'post', 'team', 'practice','portfolio' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Page Sidebar Layout', 'cryptronick' ),
				'id'          => "mb_page_sidebar_layout",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'cryptronick' ),
					'none' => esc_html__( 'None', 'cryptronick' ),
					'left' => esc_html__( 'Left', 'cryptronick' ),
					'right' => esc_html__( 'Right', 'cryptronick' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name'     => esc_html__( 'Page Sidebar', 'cryptronick' ),
				'id'          => "mb_page_sidebar_def",
				'type'        => 'select',
				'options'     => cryptronick_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_sidebar_layout','!=','default'),
						array('mb_page_sidebar_layout','!=','none'),
					)),
				),
			),			
			array(
				'name'     => esc_html__( 'Page Sidebar Width', 'cryptronick' ),
				'id'          => "mb_page_sidebar_def_width",
				'type'        => 'select',
				'options'     => array(
					'8' => esc_html( '33.333%' ),
					'9' => esc_html( '25%' ),
				),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_sidebar_layout','!=','default'),
						array('mb_page_sidebar_layout','!=','none'),
					)),
				),
			),
        )
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'cryptronick_page_color_meta_boxes' );
function cryptronick_page_color_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      => esc_html__( 'Page Colors', 'cryptronick' ),
        'post_types' => array( 'page' , 'post', 'team', 'practice','portfolio' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Page Colors', 'cryptronick' ),
				'id'          => "mb_page_colors_switch",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'cryptronick' ),
					'custom' => esc_html__( 'custom', 'cryptronick' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name'     	=> esc_html__( 'General Theme Color', 'cryptronick' ),
                'id'        => 'mb_page_theme_color',
                'type'      => 'color',
                'std'         => '#14c7ff',
				'js_options' => array(
					'defaultColor' => '#14c7ff',
				),
                'validate'  => 'color',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_colors_switch','=','custom'),
					)),
				),
            ),
            array(
                'id'       => 'mb_use_gradient',
                'type'     => 'checkbox',
                'name'    => esc_html__( 'Use Theme Gradient?', 'cryptronick' ),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_colors_switch','=','custom'),
					)),
				),
            ),
            array(
                'id'        => 'mb_theme_gradient_from',
                'type'      => 'color',
                'name'     => esc_html__('Theme Gradient From', 'cryptronick' ),
                'std'         => '#0c63ff',
				'js_options' => array(
					'defaultColor' => '#0c63ff',
				),
                'validate' => 'color',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_use_gradient','=','1'),
						array('mb_page_colors_switch','=','custom'),
					)),
				),
            ),
            array(
                'id'        => 'mb_theme_gradient_to',
                'type'      => 'color',
                'name'     => esc_html__('Theme Gradient To', 'cryptronick' ),
                'std'         => '#10e0e8',
				'js_options' => array(
					'defaultColor' => '#10e0e8',
				),
                'validate' => 'color',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_use_gradient','=','1'),
						array('mb_page_colors_switch','=','custom'),
					)),
				),
            ),
			array(
				'name'     	=> esc_html__( 'Body Background Color', 'cryptronick' ),
                'id'        => 'mb_body_background_color',
                'type'      => 'color',
                'std'         => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
                'validate'  => 'color',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_colors_switch','=','custom'),
					)),
				),
            ),
        )
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'cryptronick_logo_meta_boxes' );
function cryptronick_logo_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Logo Options', 'cryptronick' ),
        'post_types' => array( 'page' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Logo', 'cryptronick' ),
				'id'          => "mb_customize_logo",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'cryptronick' ),
					'custom' => esc_html__( 'custom', 'cryptronick' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name'             => esc_html__( 'Header Logo', 'cryptronick' ),
				'id'               => "mb_header_logo",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_logo_height_custom',
				'name' => esc_html__( 'Enable Logo Height', 'cryptronick' ),
				'type' => 'checkbox',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_customize_logo','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Set Logo Height', 'cryptronick' ),
				'id'   => "mb_logo_height",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 50,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom'),
						array('mb_logo_height_custom','=',true)
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Sticky Logo', 'cryptronick' ),
				'id'               => "mb_logo_sticky",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_sticky_logo_height_custom',
				'name' => esc_html__( 'Enable Sticky Logo Height', 'cryptronick' ),
				'type' => 'checkbox',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_customize_logo','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Set Sticky Logo Height', 'cryptronick' ),
				'id'   => "mb_sticky_logo_height",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom'),
						array('mb_sticky_logo_height_custom','=',true),
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Mobile Logo', 'cryptronick' ),
				'id'               => "mb_logo_mobile",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_mobile_logo_height_custom',
				'name' => esc_html__( 'Enable Mobile Logo Height', 'cryptronick' ),
				'type' => 'checkbox',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_customize_logo','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Set Mobile Logo Height', 'cryptronick' ),
				'id'   => "mb_mobile_logo_height",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom'),
						array('mb_mobile_logo_height_custom','=',true),
					)),
				),
			),
        )
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'cryptronick_header_option_meta_boxes' );
function cryptronick_header_option_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
        'title'      => esc_html__( 'Header Layout and Color', 'cryptronick' ),
        'post_types' => array( 'page' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Header Settings', 'cryptronick' ),
				'id'          => "mb_customize_header_layout",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'cryptronick' ),
					'custom' => esc_html__( 'custom', 'cryptronick' ),
					'hide' => esc_html__( 'hide', 'cryptronick' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),

			// It is works 
			array(
				'id'   => 'mb_menu_ative_top_line',
				'name' => esc_html__( 'Enable Active Menu Item Marker', 'cryptronick' ),
				'type' => 'checkbox',
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_header_sticky',
				'name' => esc_html__( 'Sticky Header', 'cryptronick' ),
				'type' => 'checkbox',
				'std'  => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom')
					)),
				),
			),
        )

	);
	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'cryptronick_header_meta_boxes' );
function cryptronick_header_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Header Builder', 'cryptronick' ),
        'post_types' => array( 'page' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Header', 'cryptronick' ),
				'id'          => "mb_customize_header",
				'type'        => 'select',
				'options'     => cryptronick_get_custom_preset(),
				'multiple'    => false,
				'std'         => 'default',
			),
        )
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'cryptronick_page_title_meta_boxes' );
function cryptronick_page_title_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Page Title Options', 'cryptronick' ),
        'post_types' => array( 'page', 'post', 'team', 'practice','portfolio' ),
        'context' => 'advanced',
        'fields'     => array(
			array(
				'name'     => esc_html__( 'Show Page Title', 'cryptronick' ),
				'id'          => "mb_page_title_conditional",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'cryptronick' ),
					'yes' => esc_html__( 'yes', 'cryptronick' ),
					'no' => esc_html__( 'no', 'cryptronick' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'id'   => 'mb_show_breadcrumbs',
				'name' => esc_html__( 'Show Breadcrumbs', 'cryptronick' ),
				'type' => 'checkbox',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Vertical Alignment', 'cryptronick' ),
				'id'       => 'mb_page_title_vertical_align',
				'type'     => 'select_advanced',
				'options'  => array(
					'top' => esc_html__( 'top', 'cryptronick' ),
					'middle' => esc_html__( 'middle', 'cryptronick' ),
					'bottom' => esc_html__( 'bottom', 'cryptronick' ),
				),
				'multiple' => false,
				'std'         => 'middle',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Horizontal Alignment', 'cryptronick' ),
				'id'       => 'mb_page_title_horizontal_align',
				'type'     => 'select_advanced',
				'options'  => array(
					'left' => esc_html__( 'left', 'cryptronick' ),
					'center' => esc_html__( 'center', 'cryptronick' ),
					'right' => esc_html__( 'right', 'cryptronick' ),
				),
				'multiple' => false,
				'std'         => 'left',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Font Color', 'cryptronick' ),
				'id'   => "mb_page_title_font_color",
				'type' => 'color',
				'std'         => '#192041',
				'js_options' => array(
					'defaultColor' => '#192041',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Background Color', 'cryptronick' ),
				'id'   => "mb_page_title_bg_color",
				'type' => 'color',
				'std'  => '#f5f5f5',
				'js_options' => array(
					'defaultColor' => '#f5f5f5',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Page Title Background Image', 'cryptronick' ),
				'id'               => "mb_page_title_bg_image",
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => 'image',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Repeat', 'cryptronick' ),
				'id'       => 'mb_page_title_bg_repeat',
				'type'     => 'select_advanced',
				'options'  => array(
					'no-repeat' => esc_html__( 'no-repeat', 'cryptronick' ),
					'repeat' => esc_html__( 'repeat', 'cryptronick' ),
					'repeat-x' => esc_html__( 'repeat-x', 'cryptronick' ),
					'repeat-y' => esc_html__( 'repeat-y', 'cryptronick' ),
					'inherit' => esc_html__( 'inherit', 'cryptronick' ),
				),
				'multiple' => false,
				'std'         => 'repeat',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Size', 'cryptronick' ),
				'id'       => 'mb_page_title_bg_size',
				'type'     => 'select_advanced',
				'options'  => array(
					'inherit' => esc_html__( 'inherit', 'cryptronick' ),
					'cover' => esc_html__( 'cover', 'cryptronick' ),
					'contain' => esc_html__( 'contain', 'cryptronick' )
				),
				'multiple' => false,
				'std'         => 'cover',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Attachment', 'cryptronick' ),
				'id'       => 'mb_page_title_bg_attachment',
				'type'     => 'select_advanced',
				'options'  => array(
					'fixed' => esc_html__( 'fixed', 'cryptronick' ),
					'scroll' => esc_html__( 'scroll', 'cryptronick' ),
					'inherit' => esc_html__( 'inherit', 'cryptronick' )
				),
				'multiple' => false,
				'std'         => 'scroll',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Position', 'cryptronick' ),
				'id'       => 'mb_page_title_bg_position',
				'type'     => 'select_advanced',
				'options'  => array(
					'left top' => esc_html__( 'left top', 'cryptronick' ),
					'left center' => esc_html__( 'left center', 'cryptronick' ),
					'left bottom' => esc_html__( 'left bottom', 'cryptronick' ),
					'center top' => esc_html__( 'center top', 'cryptronick' ),
					'center center' => esc_html__( 'center center', 'cryptronick' ),
					'center bottom' => esc_html__( 'center bottom', 'cryptronick' ),
					'right top' => esc_html__( 'right top', 'cryptronick' ),
					'right center' => esc_html__( 'right center', 'cryptronick' ),
					'right bottom' => esc_html__( 'right bottom', 'cryptronick' ),
				),
				'multiple' => false,
				'std'         => 'center center',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Height', 'cryptronick' ),
				'id'   => 'mb_page_title_height',
				'type' => 'number',
				'std'  => 200,
				'min'  => 0,
				'step' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),

			array(
				'name' => esc_html__( 'Height', 'cryptronick' ),
				'id'   => 'mb_page_title_padding',
				'type' => 'fieldset_text',
				'options' => array(
			        'padding-top'    => 'Padding Top',
			        'padding-bottom' => 'Padding Bottom',
			    ),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),

			array(
				'name' => esc_html__( 'Offset to content', 'cryptronick' ),
				'id'   => "mb_page_title_offset",
				'type' => 'number',
				'std'  => 0,
				'min'  => 0,
				'step' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
        ),
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'cryptronick_footer_meta_boxes' );
function cryptronick_footer_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Footer Options', 'cryptronick' ),
        'post_types' => array( 'page' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Show Footer', 'cryptronick' ),
				'id'          => "mb_footer_switch",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'cryptronick' ),
					'yes' => esc_html__( 'yes', 'cryptronick' ),
					'no' => esc_html__( 'no', 'cryptronick' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name'     => esc_html__( 'Footer Content Type', 'cryptronick' ),
				'id'          => 'mb_footer_content_type',
				'type'        => 'select',
				'options'     => array(
					'widgets' => esc_html__( 'Widgets', 'cryptronick' ),
					'pages' => esc_html__( 'Page', 'cryptronick' )		
				),
				'multiple'    => false,
				'std'         => 'center',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
        		'name'        => 'Select a page',
				'id'          => 'mb_footer_page_select',
				'type'        => 'post',
				'post_type'   => 'page',
				'field_type'  => 'select_advanced',
				'placeholder' => 'Select a page',
				'query_args'  => array(
				    'post_status'    => 'publish',
				    'posts_per_page' => - 1,
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_content_type','=','pages')
					)),
				),
        	),
			array(
				'name'     => esc_html__( 'Footer Column', 'cryptronick' ),
				'id'          => "mb_footer_column",
				'type'        => 'select',
				'options'     => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',				
				),
				'multiple'    => false,
				'std'         => '4',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_content_type','=','widgets')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 1', 'cryptronick' ),
				'id'          => "mb_footer_sidebar_1",
				'type'        => 'select',
				'options'     => cryptronick_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_content_type','=','widgets')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 2', 'cryptronick' ),
				'id'          => "mb_footer_sidebar_2",
				'type'        => 'select',
				'options'     => cryptronick_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_content_type','=','widgets'),
						array('mb_footer_column','!=','1')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 3', 'cryptronick' ),
				'id'          => "mb_footer_sidebar_3",
				'type'        => 'select',
				'options'     => cryptronick_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1'),
						array('mb_footer_column','!=','2'),
						array('mb_footer_content_type','=','widgets')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 4', 'cryptronick' ),
				'id'          => "mb_footer_sidebar_4",
				'type'        => 'select',
				'options'     => cryptronick_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1'),
						array('mb_footer_column','!=','2'),
						array('mb_footer_column','!=','3'),
						array('mb_footer_content_type','=','widgets')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column Layout', 'cryptronick' ),
				'id'          => "mb_footer_column2",
				'type'        => 'select',
				'options'     => array(
					'6-6' => '50% / 50%',
                    '3-9' => '25% / 75%',
                    '9-3' => '75% / 25%',
                    '4-8' => '33% / 66%',
                    '8-3' => '66% / 33%',				
				),
				'multiple'    => false,
				'std'         => '6-6',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','=','2'),
						array('mb_footer_content_type','=','widgets')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column Layout', 'cryptronick' ),
				'id'          => "mb_footer_column3",
				'type'        => 'select',
				'options'     => array(
					'4-4-4' => '33% / 33% / 33%',
                    '3-3-6' => '25% / 25% / 50%',
                    '3-6-3' => '25% / 50% / 25%',
                    '6-3-3' => '50% / 25% / 25%',				
				),
				'multiple'    => false,
				'std'         => '4-4-4',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','=','3'),
						array('mb_footer_content_type','=','widgets')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Title Text Align', 'cryptronick' ),
				'id'          => "mb_footer_align",
				'type'        => 'select',
				'options'     => array(
					'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right'			
				),
				'multiple'    => false,
				'std'         => 'left',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_content_type','=','widgets')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Padding Top (px)', 'cryptronick' ),
				'id'   => "mb_padding_top",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 70,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Padding Bottom (px)', 'cryptronick' ),
				'id'   => "mb_padding_bottom",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 70,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Padding Left (px)', 'cryptronick' ),
				'id'   => "mb_padding_left",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Padding Right (px)', 'cryptronick' ),
				'id'   => "mb_padding_right",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'id'   => 'mb_footer_full_width',
				'name' => esc_html__( 'Full Width Footer', 'cryptronick' ),
				'type' => 'checkbox',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),			
			array(
				'id'   => 'mb_footer_add_wave',
				'name' => esc_html__( 'Add Wave', 'cryptronick' ),
				'type' => 'checkbox',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Set Wave Height', 'cryptronick' ),
				'id'   => "mb_footer_wave_height",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 250,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_add_wave','=','1')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Background Color', 'cryptronick' ),
				'id'   => "mb_footer_bg_color",
				'type' => 'color',
				'std'  => '#192041',
				'js_options' => array(
					'defaultColor' => '#192041',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Footer Text Color', 'cryptronick' ),
				'id'   => "mb_footer_text_color",
				'type' => 'color',
				'std'  => '#9299a4',
				'js_options' => array(
					'defaultColor' => '#9299a4',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),			
			array(
				'name' => esc_html__( 'Footer Heading Color', 'cryptronick' ),
				'id'   => "mb_footer_heading_color",
				'type' => 'color',
				'std'  => '#fafafa',
				'js_options' => array(
					'defaultColor' => '#fafafa',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),			
			array(
				'name' => esc_html__( 'Footer Menu color', 'cryptronick' ),
				'id'   => "mb_footer_menu_color",
				'type' => 'color',
				'std'  => '#404040',
				'js_options' => array(
					'defaultColor' => '#404040',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Footer Background Image', 'cryptronick' ),
				'id'               => "mb_footer_bg_image",
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => 'image',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Repeat', 'cryptronick' ),
				'id'       => 'mb_footer_bg_repeat',
				'type'     => 'select_advanced',
				'options'  => array(
					'no-repeat' => esc_html__( 'no-repeat', 'cryptronick' ),
					'repeat' => esc_html__( 'repeat', 'cryptronick' ),
					'repeat-x' => esc_html__( 'repeat-x', 'cryptronick' ),
					'repeat-y' => esc_html__( 'repeat-y', 'cryptronick' ),
					'inherit' => esc_html__( 'inherit', 'cryptronick' ),
				),
				'multiple' => false,
				'std'         => 'repeat',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Size', 'cryptronick' ),
				'id'       => 'mb_footer_bg_size',
				'type'     => 'select_advanced',
				'options'  => array(
					'inherit' => esc_html__( 'inherit', 'cryptronick' ),
					'cover' => esc_html__( 'cover', 'cryptronick' ),
					'contain' => esc_html__( 'contain', 'cryptronick' )
				),
				'multiple' => false,
				'std'         => 'cover',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Attachment', 'cryptronick' ),
				'id'       => 'mb_footer_attachment',
				'type'     => 'select_advanced',
				'options'  => array(
					'fixed' => esc_html__( 'fixed', 'cryptronick' ),
					'scroll' => esc_html__( 'scroll', 'cryptronick' ),
					'inherit' => esc_html__( 'inherit', 'cryptronick' )
				),
				'multiple' => false,
				'std'         => 'scroll',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Position', 'cryptronick' ),
				'id'       => 'mb_footer_bg_position',
				'type'     => 'select_advanced',
				'options'  => array(
					'left top' => esc_html__( 'left top', 'cryptronick' ),
					'left center' => esc_html__( 'left center', 'cryptronick' ),
					'left bottom' => esc_html__( 'left bottom', 'cryptronick' ),
					'center top' => esc_html__( 'center top', 'cryptronick' ),
					'center center' => esc_html__( 'center center', 'cryptronick' ),
					'center bottom' => esc_html__( 'center bottom', 'cryptronick' ),
					'right top' => esc_html__( 'right top', 'cryptronick' ),
					'right center' => esc_html__( 'right center', 'cryptronick' ),
					'right bottom' => esc_html__( 'right bottom', 'cryptronick' ),
				),
				'multiple' => false,
				'std'         => 'center center',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),

			array(
				'id'   => 'mb_copyright_switch',
				'name' => esc_html__( 'Show Copyright', 'cryptronick' ),
				'type' => 'checkbox',
				'std'  => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				), 
			),
			array(
				'name' => esc_html__( 'Copyright Editor', 'cryptronick' ),
				'id'   => "mb_copyright_editor",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'attributes' => array(
				    'data-dependency'  =>  array( array(						
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Copyright Title Text Align', 'cryptronick' ),
				'id'       => 'mb_copyright_align',
				'type'     => 'select',
				'options'  => array(
					'left' => esc_html__( 'left', 'cryptronick' ),
					'center' => esc_html__( 'center', 'cryptronick' ),
					'right' => esc_html__( 'right', 'cryptronick' ),
				),
				'multiple' => false,
				'std'         => 'left',
				'attributes' => array(
				    'data-dependency'  =>  array( array(						
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Padding Top (px)', 'cryptronick' ),
				'id'   => "mb_copyright_padding_top",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 20,
				'attributes' => array(
				    'data-dependency'  =>  array( array(						
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Padding Bottom (px)', 'cryptronick' ),
				'id'   => "mb_copyright_padding_bottom",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 20,
				'attributes' => array(
				    'data-dependency'  =>  array( array(						
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Padding Left (px)', 'cryptronick' ),
				'id'   => "mb_copyright_padding_left",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(						
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Padding Right (px)', 'cryptronick' ),
				'id'   => "mb_copyright_padding_right",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(						
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Background Color', 'cryptronick' ),
				'id'   => "mb_copyright_bg_color",
				'type' => 'color',
				'std'  => '#192041',
				'js_options' => array(
					'defaultColor' => '#192041',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(						
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Text Color', 'cryptronick' ),
				'id'   => "mb_copyright_text_color",
				'type' => 'color',
				'std'  => '#9299a4',
				'js_options' => array(
					'defaultColor' => '#848d95',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'id'   => 'mb_copyright_top_border',
				'name' => esc_html__( 'Set Copyright Top Border?', 'cryptronick' ),
				'type' => 'checkbox',
				'std'  => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Border Color', 'cryptronick' ),
				'id'   => "mb_copyright_top_border_color",
				'type' => 'color',
				'std'         => '#2b4764',
				'js_options' => array(
					'defaultColor' => '#2b4764',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes'),
						array('mb_copyright_top_border','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Border Opacity', 'cryptronick' ),
				'id'   => "mb_copyright_top_border_color_opacity",
				'type' => 'number',
				'std'  => 1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes'),
						array('mb_copyright_top_border','=',true)
					)),
				),
			),
        ),
     );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'cryptronick_shortcode_meta_boxes' );
function cryptronick_shortcode_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'      => esc_html__( 'Shortcode Above Content', 'cryptronick' ),
		'post_types' => array( 'page' ),
		'context' => 'advanced',
		'fields'     => array(
			array(
				'name' => esc_html__( 'Shortcode', 'cryptronick' ),
				'id'   => "mb_page_shortcode",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3
			),
		),
     );
    return $meta_boxes;
}

?>