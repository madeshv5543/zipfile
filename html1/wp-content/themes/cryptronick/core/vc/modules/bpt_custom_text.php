<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$main_font = Cryptronick_Theme_Helper::get_option('main-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__('Custom Text', 'cryptronick'),
        'base' => 'bpt_custom_text',
        'class' => 'cryptronick_custom_text',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_custom_text',
        'content_element' => true,
        'description' => esc_html__('Custom Text','cryptronick'),
        'params' => array(
            // Icon Section
            array(
                'type' => 'textarea_html',
                'holder' => 'div',
                'heading' => esc_html__('Content.', 'cryptronick') ,
                'param_name' => 'content',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
            // Styling
            array(
                'type'          => 'colorpicker',
                'heading'       => esc_html__( 'Text Color', 'cryptronick' ),
                'param_name'    => 'text_color',
                'group'         => esc_html__( 'Styling', 'cryptronick' ),
                'value'         => esc_attr($main_font['color']),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
                'description' => esc_html__( 'Choose color for text.', 'cryptronick' ),
            ), 
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Font Size', 'cryptronick'),
                'param_name' => 'font_size',
                'value' => (int)$main_font['font-size'],
                'description' => esc_html__( 'Enter font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Line Height', 'cryptronick'),
                'param_name' => 'line_height',
                'value' => '140',
                'description' => esc_html__( 'Enter line height in %.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Set Resonsive Font Size', 'cryptronick' ),
                'param_name' => 'responsive_font',
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Font Size for small Desktops', 'cryptronick'),
                'param_name' => 'font_size_sm_desctop',
                'description' => esc_html__( 'Enter font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'responsive_font',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Font Size for Tablets', 'cryptronick'),
                'param_name' => 'font_size_tablet',
                'description' => esc_html__( 'Enter font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'responsive_font',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Font Size for Mobile', 'cryptronick'),
                'param_name' => 'font_size_mobile',
                'description' => esc_html__( 'Enter font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'responsive_font',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for text', 'cryptronick' ),
                'param_name' => 'use_theme_fonts',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_text',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),               
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_custom_text extends WPBakeryShortCode {
            
        }
    } 
}
