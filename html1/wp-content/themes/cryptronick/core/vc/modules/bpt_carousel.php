<?php

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    vc_map(array(		
		
        'base' => 'bpt_carousel',
        'name' => esc_html__('Carousel', 'cryptronick'),
		'class' => 'cryptronick_carousel_module',
        'description' => esc_html__('Display carousel', 'cryptronick'),
		'as_parent' => array('only' => 'bpt_counter, bpt_button, vc_column_text, bpt_pricing_table, bpt_info_box, bpt_custom_text, vc_single_image, vc_tta_tabs, vc_tta_tour, vc_tta_accordion, vc_images_carousel, vc_gallery, vc_message, vc_row, bpt_flip_box'),
		'content_element' => true,		
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_carousel',
		'show_settings_on_create' => true,
		'is_container' => true,
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items Per Line', 'cryptronick'),
                'param_name' => 'posts_per_line',
                'admin_label' => true,
                'value' => array(
                    esc_html__('1', 'cryptronick') => '1',
                    esc_html__('2', 'cryptronick') => '2',
                    esc_html__('3', 'cryptronick') => '3',
                    esc_html__('4', 'cryptronick') => '4',
                    esc_html__('5', 'cryptronick') => '5',
                    esc_html__('6', 'cryptronick') => '6'
                )
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Autoplay carousel', 'cryptronick' ),
                'param_name' => 'autoplay_carousel',
                'value' => array( esc_html__( 'Yes', 'cryptronick' ) => 'yes' ),
                'edit_field_class' => 'vc_col-sm-4',
                'std' => 'yes'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slider speed', 'cryptronick' ),
                'param_name' => 'slider_speed',
                'value' => '3000',
                'description' => esc_html__( 'Enter autoplay time in milliseconds.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'autoplay_carousel',
                    'value' => array('yes'),
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Single slide to scroll', 'cryptronick' ),
                'param_name' => 'scroll_items',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Multiple Items', 'cryptronick' ),
                'param_name' => 'multiple_items',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Adaptive Height', 'cryptronick' ),
                'param_name' => 'adaptive_height',
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'posts_per_line',
                    'value' => array('1'),
                ),
            ),
            vc_map_add_css_animation( true ),
            // carousel pagination heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Pagination Controls', 'cryptronick'),
                'param_name' => 'h_pag_controls',
                'group' => esc_html__( 'Navigation', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'cryptronick' ),
                'param_name' => 'use_pagination',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Navigation', 'cryptronick' ),
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
                'group' => esc_html__( 'Navigation', 'cryptronick' ),
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
                'group' => esc_html__( 'Navigation', 'cryptronick' ),
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
                'group' => esc_html__( 'Navigation', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'cryptronick' ),
                'param_name' => 'custom_pag_color',
                'edit_field_class' => 'vc_col-sm-6',
                'group' => esc_html__( 'Navigation', 'cryptronick' ),
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
                'group' => esc_html__( 'Navigation', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // carousel prev/next heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Prev/Next Buttons', 'cryptronick'),
                'param_name' => 'h_buttons',
                'group' => esc_html__( 'Navigation', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Prev/Next buttons', 'cryptronick' ),
                'param_name' => 'use_prev_next',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Navigation', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Buttons Color', 'cryptronick' ),
                'param_name' => 'custom_buttons_color',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Navigation', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Prev/Next Buttons Color', 'cryptronick'),
                'param_name' => 'buttons_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_buttons_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Navigation', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'cryptronick' ),
                'param_name' => 'custom_resp',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Responsive', 'cryptronick' ),
            ),
            // medium desktop
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Medium Desktop', 'cryptronick'),
                'param_name' => 'h_resp_medium',
                'group' => esc_html__( 'Responsive', 'cryptronick' ),
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
                'group' => esc_html__( 'Responsive', 'cryptronick' ),
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
                'group' => esc_html__( 'Responsive', 'cryptronick' ),
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
                'group' => esc_html__( 'Responsive', 'cryptronick' ),
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
                'group' => esc_html__( 'Responsive', 'cryptronick' ),
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
                'group' => esc_html__( 'Responsive', 'cryptronick' ),
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
                'group' => esc_html__( 'Responsive', 'cryptronick' ),
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
                'group' => esc_html__( 'Responsive', 'cryptronick' ),
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
                'group' => esc_html__( 'Responsive', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            )			
        ),
		'js_view' => 'VcColumnView'
    ));


    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_bpt_carousel extends WPBakeryShortCodesContainer
        {
        }
    }
}