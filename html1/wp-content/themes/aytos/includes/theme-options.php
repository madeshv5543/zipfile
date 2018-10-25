<?php

if ( ! class_exists( 'OT_Loader' )){
	function ot_get_option() {
		return false;
	}

	function get_option_tree() {
		return false;
	}
}

/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => esc_html__('General Config','cryptoking'),
      ),
	  
      array(
        'id'          => 'skin_type',
        'title'       => esc_html__('Skin Type','cryptoking'),
      ), 

      array(
        'id'          => 'menu_type',
        'title'       => esc_html__('Menu Type','cryptoking'),
      ), 
	  
      array(
        'id'          => 'header_settings',
        'title'       => esc_html__('Header Settings','cryptoking'),
      ),
	  
      array(
        'id'          => 'color_settings',
        'title'       => esc_html__('Color Settings','cryptoking'),
      ),

      array(
        'id'          => 'blog_settings',
        'title'       => esc_html__('Blog Settings','cryptoking'),
      ), 	  
	  
      array(
        'id'          => 'google_fonts',
        'title'       => esc_html__('Google Fonts','cryptoking'),
      ),

      array(
        'id'          => 'typography',
        'title'       => esc_html__('Typography','cryptoking'),
      ),
	  
	  array(
		'id'          => 'map_settings',
		'title'       => esc_html__('Map Settings','cryptoking'),
	  ),
	  
      array(
        'id'          => 'copyright',
        'title'       => 'Footer / Copyright'
      ),
	
    ),
    'settings'        => array(
	
      array(
        'label'       => esc_html__( 'Logo', 'cryptoking' ),
        'id'          => 'tab_logo',
        'type'        => 'tab',
        'section'     => 'general'
      ),
	  array(
        'id'          => 'cryptoking_logo',
        'label'       => esc_html__('Logo Image','cryptoking'),
        'desc'        => esc_html__('Upload your own logo.','cryptoking'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  
      array(
        'id'          => 'cryptoking_logo_size',
        'label'       => esc_html__( 'Logo Size', 'cryptoking' ),
        'desc'        => esc_html__( 'You can set logo width.', 'cryptoking' ),
        'std'         => '150',
        'type'        => 'numeric-slider',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '50,400,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	 
	  array(
        'id'          => 'cryptoking_logotext',
        'label'       => esc_html__('Logo Text','cryptoking'),
        'desc'        => esc_html__('Add Logo Text','cryptoking'),
        'std'         => 'Cryptoking',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  
      array(
        'label'       => esc_html__( 'Css', 'cryptoking' ),
        'id'          => 'tab_css',
        'type'        => 'tab',
        'section'     => 'general'
      ),

      array(
        'id'          => 'cryptoking_css',
        'label'       => esc_html__('Additional CSS','cryptoking' ),
        'desc'        => esc_html__('Additional css here (optional)','cryptoking' ),
        'std'         => '',
        'type'        => 'css',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

      array(
        'label'       => esc_html__( 'Js', 'cryptoking' ),
        'id'          => 'tab_js',
        'type'        => 'tab',
        'section'     => 'general'
      ),
	  
       array(
        'id'          => 'cryptoking_js',
        'label'       => esc_html__('Additional JS','cryptoking' ),
        'desc'        => esc_html__('Additional js here (optional)','cryptoking' ),
        'std'         => '',
        'type'        => 'css',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),	
	  
	  
	  array(
        'id'          => 'cryptoking_skin_type',
        'label'       => esc_html__( 'Skin Type', 'cryptoking' ),
        'desc'        => esc_html__( 'Select Skin Type', 'cryptoking' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'skin_type',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'default',
            'label'       => esc_html__( 'Default', 'cryptoking' ),
            'src'         => ''
          ),
          array(
            'value'       => 'blue',
            'label'       => esc_html__( 'Blue', 'cryptoking' ),
            'src'         => ''
          ),
          array(
            'value'       => 'light',
            'label'       => esc_html__( 'Light', 'cryptoking' ),
            'src'         => ''
          ),
          array(
            'value'       => 'dark',
            'label'       => esc_html__( 'Dark', 'cryptoking' ),
            'src'         => ''
          ),
          array(
            'value'       => 'dark_light',
            'label'       => esc_html__( 'Dark Light', 'cryptoking' ),
            'src'         => ''
          ),


        )
      ),

	  
	  array(
        'id'          => 'cryptoking_menu_type',
        'label'       => esc_html__( 'Menu Type', 'cryptoking' ),
        'desc'        => esc_html__( 'Select Menu Type', 'cryptoking' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'menu_type',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'no-transparent',
            'label'       => esc_html__( 'No Transparent', 'cryptoking' ),
            'src'         => ''
          ),
          array(
            'value'       => 'transparent',
            'label'       => esc_html__( 'Transparent', 'cryptoking' ),
            'src'         => ''
          )
        )
      ),
	  
      array(
        'id'          => 'cryptoking_header_buttons',
        'label'       => esc_html__( 'Buttons', 'cryptoking' ),
        'desc'        => esc_html__( 'You can add buttons on the header', 'cryptoking' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'header_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
			  array(
				'id'          => 'cryptoking_button_text',
				'label'       => esc_html__('Set button text','cryptoking'),
				'desc'        => esc_html__('Add button text','cryptoking'),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'header_settings',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'operator'    => 'and'
			  ),

			  array(
				'id'          => 'cryptoking_button_url',
				'label'       => esc_html__('Set button url','cryptoking'),
				'desc'        => esc_html__('Add button url','cryptoking'),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'header_settings',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'operator'    => 'and'
			  ),
			  
        )
      ),

	  
	  array(
        'id'          => 'cryptoking_main_color',
        'label'       => esc_html__('Color','cryptoking'),
        'desc'        => esc_html__('Set a color for the theme','cryptoking'),
        'std'         => '#0a1c5d',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

	  array(
		'label'       => esc_html__( 'Layouts', 'cryptoking' ),
		'id'          => 'tab_layouts',
		'type'        => 'tab',
		'section'     => 'blog_settings'
	  ),
	  
      array(
        'id'          => 'layout_set',
        'label'       => esc_html__( 'Blog Layout', 'cryptoking' ),
        'desc'        => esc_html__( ' Left Sidebar - Right Sidebar - Full Width', 'cryptoking' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'blog_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	  array(
		'label'       => esc_html__( 'Header', 'cryptoking' ),
		'id'          => 'tab_blog_header',
		'type'        => 'tab',
		'section'     => 'blog_settings'
	  ),
	  
      array(
        'id'          => 'cryptoking_blog_header_title',
        'label'       => esc_html__('Title','cryptoking'),
        'desc'        => esc_html__('Add a title for blog header.','cryptoking'),
        'std'         => 'Blog List',
        'type'        => 'text',
        'section'     => 'blog_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
      ),
	  
	  
	 array(
	    'id'          => 'body_google_fonts',
	    'label'       => esc_html__('Google Fonts','cryptoking' ),
	    'desc'        => esc_html__('Add Google Font and after the save settings follow these steps Dashboard > Appearance > Theme Options > Typography','cryptoking' ),
	    'std'         => '',
	    'type'        => 'google-fonts',
	    'section'     => 'google_fonts',
	    'rows'        => '',
	    'post_type'   => '',
	    'taxonomy'    => '',
	    'min_max_step'=> '',
	    'class'       => '',
	    'condition'   => '',
	    'operator'    => 'and'
	),

      array(
        'label'       => esc_html__( 'General', 'cryptoking' ),
        'id'          => 'tab_general',
        'type'        => 'tab',
        'section'     => 'typography'
      ),

      array(
        'id'          => 'tipigrof',
        'label'       => esc_html__( 'Body Typography', 'cryptoking' ),
        'desc'        => esc_html__('The Typography option type is for adding typography styles to your site.', 'cryptoking' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'label'       => esc_html__( 'H1 Title', 'cryptoking' ),
        'id'          => 'tab_h1title',
        'type'        => 'tab',
        'section'     => 'typography'
      ),

      array(
        'id'          => 'h1_tipigrof',
        'label'       => esc_html__( 'H1 Title Typography', 'cryptoking' ),
        'desc'        => esc_html__('The Typography option type is for adding typography styles to your site.', 'cryptoking' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'label'       => esc_html__( 'H2 Title', 'cryptoking' ),
        'id'          => 'tab_h2title',
        'type'        => 'tab',
        'section'     => 'typography'
      ),

      array(
        'id'          => 'h2_tipigrof',
        'label'       => esc_html__( 'H2 Title Typography', 'cryptoking' ),
        'desc'        => esc_html__('The Typography option type is for adding typography styles to your site.', 'cryptoking' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'label'       => esc_html__( 'H3 Title', 'cryptoking' ),
        'id'          => 'tab_h3title',
        'type'        => 'tab',
        'section'     => 'typography'
      ),

      array(
        'id'          => 'h3_tipigrof',
        'label'       => esc_html__( 'H3 Title Typography', 'cryptoking' ),
        'desc'        => esc_html__('The Typography option type is for adding typography styles to your site.', 'cryptoking' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'label'       => esc_html__( 'H4 Title', 'cryptoking' ),
        'id'          => 'tab_h4title',
        'type'        => 'tab',
        'section'     => 'typography'
      ),

      array(
        'id'          => 'h4_tipigrof',
        'label'       => esc_html__( 'H4 Title Typography', 'cryptoking' ),
        'desc'        => esc_html__('The Typography option type is for adding typography styles to your site.', 'cryptoking' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'label'       => esc_html__( 'H5 Title', 'cryptoking' ),
        'id'          => 'tab_h5title',
        'type'        => 'tab',
        'section'     => 'typography'
      ),

      array(
        'id'          => 'h5_tipigrof',
        'label'       => esc_html__( 'H5 Title Typography', 'cryptoking' ),
        'desc'        => esc_html__('The Typography option type is for adding typography styles to your site.', 'cryptoking' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'label'       => esc_html__( 'H6 Title', 'cryptoking' ),
        'id'          => 'tab_h6title',
        'type'        => 'tab',
        'section'     => 'typography'
      ),


      array(
        'id'          => 'h6_tipigrof',
        'label'       => esc_html__( 'H6 Title Typography', 'cryptoking' ),
        'desc'        => esc_html__('The Typography option type is for adding typography styles to your site.','cryptoking' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'label'       => esc_html__( 'P(Content)', 'cryptoking' ),
        'id'          => 'tab_pcontent',
        'type'        => 'tab',
        'section'     => 'typography'
      ),

      array(
        'id'          => 'p_tipigrof',
        'label'       => esc_html__( 'P(Content) Typography', 'cryptoking' ),
        'desc'        => esc_html__('The Typography option type is for adding typography styles to your site.','cryptoking' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	
	  array(
			'id'          => 'cryptoking_mapapi',
			'label'       => esc_html__('Google Map Api Key','cryptoking' ),
			'desc'        => esc_html__('Add your google map api key','cryptoking' ),
			'std'         => '',
			'type'        => 'text',
			'section'     => 'map_settings',
			'rows'        => '',
			'post_type'   => '',
			'taxonomy'    => '',
			'class'       => ''
	  ),	

      array(
        'label'       => esc_html__( 'General', 'cryptoking' ),
        'id'          => 'tab__footer_general',
        'type'        => 'tab',
        'section'     => 'copyright'
      ),
	  
      array(
        'id'          => 'cryptoking_copyright',
        'label'       => esc_html__('Footer Copyright','cryptoking'),
        'desc'        => esc_html__('Footer Copyright','cryptoking'),
        'std'         => esc_html__('Copyright 2018.KlbTheme . All rights reserved','cryptoking'),
        'type'        => 'text',
        'section'     => 'copyright',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}