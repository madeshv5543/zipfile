<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Time Line Horizontal', 'cryptronick'),
        'base' => 'bpt_time_line_horizontal',
        'class' => 'cryptronick_time_line_horizontal',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_horizont-timeline',
        'content_element' => true,
        'description' => esc_html__('Display Time Line Horizontal','cryptronick'),
        'params' => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Time Line Items Content', 'cryptronick' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph - title, description, date and color.', 'cryptronick' ),
                'params' => array(
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Date', 'cryptronick' ),
                        "param_name"    => "date",
                    ),
                    array(
                        "type"          => "textarea",
                        "heading"       => esc_html__( 'Description', 'cryptronick' ),
                        "param_name"    => "descr",
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Circle Color', 'cryptronick'),
                        'param_name' => 'circle_color',
                        'value' => $theme_color,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Appear Animation', 'cryptronick' ),
                'param_name' => 'appear_anim',
                'edit_field_class' => 'vc_col-sm-6',
                'std' => 'true'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Time Line Main Color', 'cryptronick'),
                'param_name' => 'main_color',
                'value' => '#ffffff',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
            // Carousel
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Carousel for Time Line Items', 'cryptronick'),
                'param_name' => 'h_carousel',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Items to Show', 'cryptronick' ),
                "param_name"    => "posts_per_line",
                "value"         => array(
                    esc_html__( '1', 'cryptronick' )    => '1',
                    esc_html__( '2', 'cryptronick' )   => '2',
                    esc_html__( '3', 'cryptronick' ) => '3',
                    esc_html__( '4', 'cryptronick' )  => '4',
                    esc_html__( '5', 'cryptronick' )  => '5',
                    esc_html__( '6', 'cryptronick' )  => '6',
                ),           
                'std' => '5',   
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Single slide to scroll', 'cryptronick' ),
                'param_name' => 'scroll_items',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'std' => 'true'
            ),
            array(
                "type"          => "bpt_checkbox",
                'heading' => esc_html__( 'Autoplay', 'cryptronick' ),
                "param_name"    => "autoplay",
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
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'cryptronick' ),
                'param_name' => 'use_pagination',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
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
                'value' => 'line_circle',
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
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'cryptronick' ),
                'param_name' => 'custom_resp',
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
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_Time_Line_Horizontal extends WPBakeryShortCode {
        }
    }
}
