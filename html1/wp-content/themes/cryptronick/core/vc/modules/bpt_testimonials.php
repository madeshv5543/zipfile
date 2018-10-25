<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Testimonials', 'cryptronick'),
        'base' => 'bpt_testimonials',
        'class' => 'cryptronick_testimonials',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_testimonial',
        'content_element' => true,
        'description' => esc_html__('Display Testimonials','cryptronick'),
        'params' => array(
            array(
                'type' => 'cryptronick_dropdown',
                'heading' => esc_html__('Testimonials Type', 'cryptronick'),
                'param_name' => 'item_type',
                'fields' => array(
                    'default' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/testimonials_1.png',
                        'descr' => esc_html__('Default', 'cryptronick')),
                    'author_top' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/testimonials_2.png',
                        'descr' => esc_html__('Author Top', 'cryptronick')),
                    'author_bottom' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/testimonials_3.png',
                        'descr' => esc_html__('Author Bottom', 'cryptronick')),
                ),
                'value' => 'default',
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Testimonials Grid', 'cryptronick' ),
                "param_name"    => "item_grid",
                "value"         => array(
                    esc_html__( 'One Column', 'cryptronick' )    => '1',
                    esc_html__( 'Two Columns', 'cryptronick' )   => '2',
                    esc_html__( 'Three Columns', 'cryptronick' ) => '3',
                    esc_html__( 'Four Columns', 'cryptronick' )  => '4',
                ),              
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Alignment', 'cryptronick' ),
                'param_name'    => 'item_align',
                'value'         => array(
                    esc_html__( 'Center', 'cryptronick' )     => 'center',
                    esc_html__( 'Left', 'cryptronick' )      => 'left',
                    esc_html__( 'Right', 'cryptronick' )      => 'right',
                ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'cryptronick' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph - thumbnail, quote, author name and author status.', 'cryptronick' ),
                'group' => esc_html__( 'Items', 'cryptronick' ),
                'params' => array(
                    array(
                        "type"          => "attach_image",
                        "heading"       => esc_html__( 'Thumbnail', 'cryptronick' ),
                        "param_name"    => "thumbnail",
                    ),
                    array(
                        "type"          => "textarea",
                        "heading"       => esc_html__( 'Quote', 'cryptronick' ),
                        "param_name"    => "quote",
                    ),
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Author Name', 'cryptronick' ),
                        "param_name"    => "author_name",
                        'admin_label'   => true,
                    ),
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Author Status', 'cryptronick' ),
                        "param_name"    => "author_status",
                    ),
                ),
            ),
            // image styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Custom Image Styles', 'cryptronick'),
                'param_name' => 'h_image_styles',
                'group' => esc_html__( 'Items', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Custom image size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Image Width', 'cryptronick'),
                'param_name' => 'custom_img_width',
                'description' => esc_html__( 'Custom width in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Items', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Custom image size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Image Height', 'cryptronick'),
                'param_name' => 'custom_img_height',
                'description' => esc_html__( 'Custom height in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Items', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Custom image radius
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Image Radius', 'cryptronick'),
                'param_name' => 'custom_img_radius',
                'description' => esc_html__( 'Custom radius in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Items', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // carousel heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Add Carousel for Testimonials Items', 'cryptronick'),
                'param_name' => 'h_carousel',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                "type"          => "bpt_checkbox",
                'heading' => esc_html__( 'Use Carousel', 'cryptronick' ),
                "param_name"    => "use_carousel",
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            array(
                "type"          => "bpt_checkbox",
                'heading' => esc_html__( 'Autoplay', 'cryptronick' ),
                "param_name"    => "autoplay",
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
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
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'cryptronick' ),
                'param_name' => 'use_pagination',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
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
                'edit_field_class' => 'vc_col-sm-6',
                'description' => esc_html__( 'Enter pagination top offset in pixels.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Pagination Aligning', 'cryptronick'),
                'param_name' => 'pag_align',
                'value' => array(
                    esc_html__('Left', 'cryptronick') => 'left',
                    esc_html__('Right', 'cryptronick') => 'right',
                    esc_html__('Center', 'cryptronick') => 'center',
                ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'std' => 'center',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'cryptronick' ),
                'param_name' => 'custom_pag_color',
                'edit_field_class' => 'vc_col-sm-6',
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
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // carousel pagination heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Responsive', 'cryptronick'),
                'param_name' => 'h_resp',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'cryptronick' ),
                'param_name' => 'custom_resp',
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
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
            // quote styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Quote Styles', 'cryptronick'),
                'param_name' => 'h_quote_styles',
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Quote Tag', 'cryptronick' ),
                'param_name'    => 'quote_tag',
                'value'         => array(
                    esc_html__( 'Div', 'cryptronick' )    => 'div',
                    esc_html__( 'Span', 'cryptronick' )    => 'span',
                    esc_html__( 'H2', 'cryptronick' )    => 'h2',
                    esc_html__( 'H3', 'cryptronick' )    => 'h3',
                    esc_html__( 'H4', 'cryptronick' )    => 'h4',
                    esc_html__( 'H5', 'cryptronick' )    => 'h5',
                    esc_html__( 'H6', 'cryptronick' )    => 'h6',
                ),
                'std' => 'div',
                'group'         => esc_html__( 'Typography', 'cryptronick' ),
                'description' => esc_html__( 'Choose your tag for quote', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // quote Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Quote Font Size', 'cryptronick'),
                'param_name' => 'quote_size',
                'value' => '',
                'description' => esc_html__( 'Enter quote font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Quote Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for quote', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_quote',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_quote',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_quote',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
            ),
            // quote color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Quote Color', 'cryptronick' ),
                'param_name' => 'custom_quote_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // quote color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Quote Color', 'cryptronick'),
                'param_name' => 'quote_color',
                'value' => '#000000',
                'description' => esc_html__('Select quote color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_quote_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // author name styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Author Name Styles', 'cryptronick'),
                'param_name' => 'h_name_styles',
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Author Name Tag', 'cryptronick' ),
                'param_name'    => 'name_tag',
                'value'         => array(
                    esc_html__( 'Span', 'cryptronick' )    => 'span',
                    esc_html__( 'Div', 'cryptronick' )    => 'div',
                    esc_html__( 'H2', 'cryptronick' )    => 'h2',
                    esc_html__( 'H3', 'cryptronick' )    => 'h3',
                    esc_html__( 'H4', 'cryptronick' )    => 'h4',
                    esc_html__( 'H5', 'cryptronick' )    => 'h5',
                    esc_html__( 'H6', 'cryptronick' )    => 'h6',
                ),
                'std' => 'h3',
                'group'         => esc_html__( 'Typography', 'cryptronick' ),
                'description' => esc_html__( 'Choose your tag for author name', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // author name Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Author Name Font Size', 'cryptronick'),
                'param_name' => 'name_size',
                'value' => '',
                'description' => esc_html__( 'Enter author name font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // author name Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for author name', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_name',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_name',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_name',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
            ),
            // author name color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Author Name Color', 'cryptronick' ),
                'param_name' => 'custom_name_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // author name color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Author Name Color', 'cryptronick'),
                'param_name' => 'name_color',
                'value' => '#000000',
                'description' => esc_html__('Select author name color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_name_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // author status styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Author Status Styles', 'cryptronick'),
                'param_name' => 'h_status_styles',
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Author Status Tag', 'cryptronick' ),
                'param_name'    => 'status_tag',
                'value'         => array(
                    esc_html__( 'Span', 'cryptronick' )    => 'span',
                    esc_html__( 'Div', 'cryptronick' )    => 'div',
                    esc_html__( 'H2', 'cryptronick' )    => 'h2',
                    esc_html__( 'H3', 'cryptronick' )    => 'h3',
                    esc_html__( 'H4', 'cryptronick' )    => 'h4',
                    esc_html__( 'H5', 'cryptronick' )    => 'h5',
                    esc_html__( 'H6', 'cryptronick' )    => 'h6',
                ),
                'std' => 'span',
                'group'         => esc_html__( 'Typography', 'cryptronick' ),
                'description' => esc_html__( 'Choose your tag for author status', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // author status Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Author Status Font Size', 'cryptronick'),
                'param_name' => 'status_size',
                'value' => '',
                'description' => esc_html__( 'Enter author status font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // author status Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for author status', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_status',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_status',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_status',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
            ),
            // author status color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Author Status Color', 'cryptronick' ),
                'param_name' => 'custom_status_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // author status color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Author Status Color', 'cryptronick'),
                'param_name' => 'status_color',
                'value' => '#000000',
                'description' => esc_html__('Select author status color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_status_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_Testimonials extends WPBakeryShortCode {
        }
    }
}
