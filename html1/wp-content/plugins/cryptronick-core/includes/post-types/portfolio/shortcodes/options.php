<?php
$theme_color = Cryptronick_Theme_Helper::get_option('theme-custom-color');
$header_font = Cryptronick_Theme_Helper::get_option('header-font');
$main_font = Cryptronick_Theme_Helper::get_option('main-font');
$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');

if (function_exists('vc_map')) {
    vc_map( array(
        "name" => esc_html__("Portfolio List", "cryptronick-core"),
        "base" => $this->shortcodeName,
        "class" => 'cryptronick_portfolio_list',
        "category" => esc_html__('BPT Modules', 'cryptronick-core'),
        "icon" => 'bpt_icon_portfolio_module',
        "content_element" => true,
        "description" => esc_html__("Portfolio List","cryptronick-core"),
        "params" => array(
            array(
                'type' => 'loop',
                'heading' => esc_html__('Portfolio Items', 'cryptronick-core'),
                'param_name' => 'build_query',
                'settings' => array(
                    'size' => array('hidden' => false, 'value' => 4 * 3),
                    'order_by' => array('value' => 'date'),
                    'post_type' => array('value' => 'team', 'hidden' => true),
                    'categories' => array('hidden' => true),
                    'tags' => array('hidden' => true),
                ),
                'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'cryptronick-core')
            ),
            array(
                'type' => 'cryptronick_dropdown',
                'heading' => esc_html__('Layout', 'cryptronick'),
                'param_name' => 'portfolio_layout',
                'fields' => array(
                    'grid' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/layout_grid.png',
                        'descr' => esc_html__('Grid', 'cryptronick')),
                    'masonry' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/layout_masonry.png',
                        'descr' => esc_html__('Masonry', 'cryptronick')),
                    'carousel' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/layout_carousel.png',
                        'descr' => esc_html__('Carousel', 'cryptronick')),
                ),
                'value' => 'grid',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Column', 'cryptronick-core'),
                'param_name' => 'posts_per_row',
                'admin_label' => true,
                'value' => array(
                    esc_html__("1", "cryptronick-core") => '1',
                    esc_html__("2", "cryptronick-core") => '2',
                    esc_html__("3", "cryptronick-core") => '3',
                    esc_html__("4", "cryptronick-core") => '4',
                ),
                'std' => '4',
            ),            
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Show Filter', 'cryptronick-core' ),
                'param_name' => 'show_filter',
                'value' => array( esc_html__( 'Yes', 'cryptronick-core' ) => 'yes' ),
                'std' => '',
                'save_always' => true,
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => array('grid', 'masonry')
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Crop Images', 'cryptronick-core' ),
                'param_name' => 'crop_images',
                'value' => array( esc_html__( 'Yes', 'cryptronick-core' ) => 'yes' ),
                'std' => 'yes',
                'save_always' => true,
            ),            
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Pagination', 'cryptronick-core'),
                'param_name' => 'view_style',
                'admin_label' => true,
                'save_always' => true,
                'value' => array(
                    esc_html__('Static', "cryptronick-core") => "standard",
                    esc_html__('Ajax load', "cryptronick-core") => "ajax",
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Show Pagination', 'cryptronick-core' ),
                'param_name' => 'show_pagination',
                'value' => array( esc_html__( 'Yes', 'cryptronick-core' ) => 'yes' ),
                'std' => 'not',
                'dependency' => array(
                    'element' => 'view_style',
                    "value" => "standard"
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Navigation\'s Alignment', 'cryptronick' ),
                'param_name' => 'portfolio_navigation_align',
                'value'         => array(
                    esc_html__( 'Center', 'cryptronick' ) => 'center',
                    esc_html__( 'Left', 'cryptronick' ) => 'left',
                    esc_html__( 'Right', 'cryptronick' ) => 'right'
                ),
                'description' => esc_html__('Select Navigation\'s Alignment.', 'cryptronick'),
                'std' => 'left',
                'dependency' => array(
                    'element' => 'show_pagination',
                    'value' => 'yes',
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Show Load More Button', 'cryptronick-core' ),
                'param_name' => 'show_loadmore',
                'value' => array( esc_html__( 'Yes', 'cryptronick-core' ) => 'yes' ),
                'std' => 'not',
                'dependency' => array(
                    'element' => 'view_style',
                    "value" => "ajax"
                )
            ),                    
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Items on load', 'cryptronick-core'),
                'param_name' => 'items_load',
                'value' => '4',
                'save_always' => true,
                'description' => esc_html__( 'Items load by load more button.', 'cryptronick-core' ),
                'dependency' => array(
                    'element' => 'show_loadmore',
                    "value" => "yes"
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Grid Gap', 'cryptronick-core'),
                'param_name' => 'grid_gap',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-6',
                'value' => array(
                    esc_html__("0", "wizeedu") => '0px',
                    esc_html__("1", "wizeedu") => '1px',
                    esc_html__("2", "wizeedu") => '2px',
                    esc_html__("3", "wizeedu") => '3px',
                    esc_html__("4", "wizeedu") => '4px',
                    esc_html__("5", "wizeedu") => '5px',
                    esc_html__("10", "wizeedu") => '10px',
                    esc_html__("15", "wizeedu") => '15px',
                    esc_html__("20", "wizeedu") => '20px',
                    esc_html__("25", "wizeedu") => '25px',
                    esc_html__("30", "wizeedu") => '30px',
                    esc_html__("35", "wizeedu") => '35px',
                ),
                'std' => '30px',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'cryptronick')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Click Item', 'cryptronick-core'),
                'param_name' => 'click_area',
                'admin_label' => true,
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'value' => array(
                    esc_html__("Single", "cryptronick-core") => 'single',
                    esc_html__("Popup", "cryptronick-core") => 'popup',
                    esc_html__("Default", "cryptronick-core") => 'none',
                ),
                'std' => 'none',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show Info Position', 'cryptronick-core'),
                'param_name' => 'info_position',
                'admin_label' => true,
                'value' => array(
                    esc_html__('Inside Image', "cryptronick-core") => 'inside_image',
                    esc_html__('Under Image', "cryptronick-core") => 'under_image',
                ),
                'std' => 'inside_image',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => array('grid', 'masonry')
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Inside Image Animation', 'cryptronick-core'),
                'param_name' => 'image_anim',
                'value' => array(
                    esc_html__('Default', 'cryptronick-core') => 'default',
                    esc_html__('Zoom', 'cryptronick-core') => 'zoom',
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'info_position',
                    'value' => array('inside_image')
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Horizontal Align', 'cryptronick-core'),
                'param_name' => 'horizontal_align',
                'admin_label' => true,
                'std'   => 'center',
                'value' => array(
                    esc_html__('Left', 'cryptronick-core') => 'Left',
                    esc_html__('Center', 'cryptronick-core') => 'center',
                    esc_html__('Right', 'cryptronick-core') => 'right'
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'info_position',
                    'value' => array('under_image')
                )
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Add Shadow', 'cryptronick' ),
                'param_name' => 'add_shadow',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'info_position',
                    "value" => 'under_image'
                )
            ),  
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Content Elements', 'cryptronick'),
                'param_name' => 'h_content_elements',
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Show Title?', 'cryptronick' ),
                'param_name' => 'show_portfolio_title',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'std' => 'true',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Show Content?', 'cryptronick' ),
                'param_name' => 'show_content',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Show author?', 'cryptronick' ),
                'param_name' => 'show_meta_author',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Show categories?', 'cryptronick' ),
                'param_name' => 'show_meta_categories',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'std' => 'true',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Show date?', 'cryptronick' ),
                'param_name' => 'show_meta_date',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Show Likes?', 'cryptronick' ),
                'param_name' => 'show_likes',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),            
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Show Comments?', 'cryptronick' ),
                'param_name' => 'show_comments',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            // Content Letter Count
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Letter Count', 'cryptronick'),
                'param_name' => 'content_letter_count',
                'value' => '85',
                'description' => esc_html__( 'Enter content letter count.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            // Portfolio Headings Font
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for Portfolio Headings', 'cryptronick' ),
                'param_name' => 'custom_fonts_portfolio_headings',
                'group' => esc_html__( 'Font', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_portfolio_headings',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'custom_fonts_portfolio_headings',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'cryptronick' ),
            ),

            // --- CAROUSEL GROUP --- //
            array(
                "type"          => "bpt_checkbox",
                'heading' => esc_html__( 'Autoplay', 'cryptronick' ),
                "param_name"    => "autoplay",
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Autoplay Speed', 'cryptronick' ),
                "param_name"    => "autoplay_speed",
                "dependency"    => array(
                    "element"   => "autoplay",
                    "value" => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-4',
                "value"         => "3000",
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            // carousel pagination heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Pagination Controls', 'cryptronick'),
                'param_name' => 'h_pag_controls',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'cryptronick' ),
                'param_name' => 'use_pagination',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'std' => 'true'
            ),
            array(
                'type' => 'cryptronick_dropdown',
                'heading' => esc_html__('Pagination Type', 'cryptronick'),
                'param_name' => 'pag_type',
                'fields' => array(
                    'circle' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/pag_circle.png',
                        'descr' => esc_html__('Circle', 'cryptronick')),
                    'square' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/pag_square.png',
                        'descr' => esc_html__('Square', 'cryptronick')),
                    'line' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/pag_line.png',
                        'descr' => esc_html__('Line', 'cryptronick')),
                    'line_circle' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/pag_line_circle.png',
                        'descr' => esc_html__('Line - Circle', 'cryptronick')),
                ),
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'value' => 'circle',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'cryptronick' ),
                'param_name' => 'pag_offset',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
                'description' => esc_html__( 'Enter pagination top offset in pixels.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'cryptronick' ),
                'param_name' => 'custom_pag_color',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Pagination Color', 'cryptronick'),
                'param_name' => 'pag_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // carousel pagination heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Responsive', 'cryptronick'),
                'param_name' => 'h_resp',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'cryptronick' ),
                'param_name' => 'custom_resp',
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            // medium desktop
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Medium Desktop', 'cryptronick'),
                'param_name' => 'h_resp_medium',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'cryptronick' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'cryptronick' ),
                'param_name' => 'resp_medium_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            
            // tablets
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Tablets', 'cryptronick'),
                'param_name' => 'h_resp_tablets',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'cryptronick' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'cryptronick' ),
                'param_name' => 'resp_tablets_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            // mobile phones
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Mobile Phones', 'cryptronick'),
                'param_name' => 'h_resp_mobile',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'cryptronick' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'cryptronick' ),
                'param_name' => 'resp_mobile_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),

            // --- CUSTOM GROUP --- //
            // Portfolio Font
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for Portfolio Content', 'cryptronick' ),
                'param_name' => 'custom_fonts_portfolio_content',
                'group' => esc_html__( 'Font', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_portfolio',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'custom_fonts_portfolio_content',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom styles for Portfolio', 'cryptronick' ),
                'param_name' => 'custom_portfolio_style',
                'description' => esc_html__( 'Custom portfolio font size and font color.', 'cryptronick' ),
                'group' => esc_html__( 'Font', 'cryptronick' ),
            ),
            // Custom portfolio style
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Custom Main Color', 'cryptronick'),
                'param_name' => 'custom_main_color',
                'value' => esc_attr(Cryptronick_Theme_Helper::get_option('theme-custom-color')),
                'description' => esc_html__('Select custom main color.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_portfolio_style',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),            
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Custom Filter Color', 'cryptronick'),
                'param_name' => 'custom_filter_color',
                'value' => esc_attr(Cryptronick_Theme_Helper::get_option('theme-custom-color')),
                'description' => esc_html__('Select custom filter color.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_portfolio_style',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Custom Headings Color', 'cryptronick'),
                'param_name' => 'custom_headings_color',
                'value' => esc_attr($header_font['color']),
                'description' => esc_html__('Select custom headings color.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_portfolio_style',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Custom Content Color', 'cryptronick'),
                'param_name' => 'custom_content_color',
                'value' => esc_attr($main_font['color']),
                'description' => esc_html__('Select custom content color.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_portfolio_style',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Heading Font Size', 'cryptronick'),
                'param_name' => 'heading_font_size',
                'value' => '30',
                'description' => esc_html__( 'Enter heading font-size in pixels.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'custom_portfolio_style',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Font Size', 'cryptronick'),
                'param_name' => 'content_font_size',
                'value' => '16',
                'description' => esc_html__( 'Enter content font-size in pixels.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'custom_portfolio_style',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
           array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Overlay settings', 'cryptronick'),
                'param_name' => 'h_content_overlay',
                'group' => esc_html__( 'Font', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Font', 'cryptronick' ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Background Customize Colors', 'cryptronick' ),
                'param_name'    => 'bg_color_type',
                'value'         => array(
                    esc_html__( 'None', 'cryptronick' )      => 'none',
                    esc_html__( 'Color', 'cryptronick' )      => 'color',
                    esc_html__( 'Gradient', 'cryptronick' )     => 'gradient',
                ),
                'std' => 'color',
                'group' => esc_html__( 'Font', 'cryptronick' ),
            ),
            // background color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'cryptronick'),
                'param_name' => 'background_color',
                'value' => 'rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_color).', 0.8)',
                'description' => esc_html__('Select background color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Font', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Start Color', 'cryptronick'),
                'param_name' => 'background_gradient_start',
                'value' => 'rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient['from']).', 0.8)',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Font', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background End Color', 'cryptronick'),
                'param_name' => 'background_gradient_end',
                'value' => 'rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient['to']).', 0.8)',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Font', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        )
));
}
?>