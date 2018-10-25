<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = Cryptronick_Theme_Helper::get_option('header-font');
$main_font = Cryptronick_Theme_Helper::get_option('main-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__('Countdown', 'cryptronick'),
        'base' => 'bpt_countdown',
        'class' => 'cryptronick_countdown',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_countdown',
        'content_element' => true,
        'description' => esc_html__('Countdown','cryptronick'),
        'params' => array(
            array(
                'type'          => 'cryptronick_param_heading',
                'heading' => esc_html__('Countdown Date:', 'cryptronick'),
                'param_name'    => 'h_date',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Year', 'cryptronick'),
                'param_name' => 'countdown_year',
                'description' => esc_html__('Enter year EX.: 2018', 'cryptronick'),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Month', 'cryptronick'),
                'param_name' => 'countdown_month',
                'description' => esc_html__('Enter month EX.: 08', 'cryptronick'),
                'edit_field_class' => 'vc_col-sm-2',
            ),            
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Day', 'cryptronick'),
                'param_name' => 'countdown_day',
                'description' => esc_html__('Enter day EX.: 20', 'cryptronick'),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Hours', 'cryptronick'),
                'param_name' => 'countdown_hours', 
                'description' => esc_html__('Enter hours EX.: 13', 'cryptronick'),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Minutes', 'cryptronick'),
                'param_name' => 'countdown_min',
                'description' => esc_html__('Enter min. EX.: 24', 'cryptronick'),
                'edit_field_class' => 'vc_col-sm-2',
            ), 
            array(
                "type"          => "cryptronick_param_heading",
                "heading" => esc_html__("Countdown Hide:", 'cryptronick'),
                "param_name"    => "h_hide",
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Hide Days?', 'cryptronick' ),
                'param_name' => 'hide_day',
                'edit_field_class' => 'vc_col-sm-3',
            ),            
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Hide Hours?', 'cryptronick' ),
                'param_name' => 'hide_hours',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Hide Minutes?', 'cryptronick' ),
                'param_name' => 'hide_minutes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Hide Seconds?', 'cryptronick' ),
                'param_name' => 'hide_seconds',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for a countdown?', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_countdown',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Style', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_countdown',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_countdown',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Style', 'cryptronick' ),
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Size", 'cryptronick'),
                "param_name" => "size",
                "value" => array(
                    esc_html__("Small",'cryptronick') => "small",
                    esc_html__("Medium",'cryptronick') => "medium",
                    esc_html__("Large",'cryptronick') => "large",
                    esc_html__("Extra Large",'cryptronick') => "e_large",
                    esc_html__("Custom",'cryptronick') => "custom",
                ),
                'std'         => 'large', 
                'group' => esc_html__( 'Style', 'cryptronick' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Font Size', 'cryptronick'),
                'param_name' => 'font_size',
                'description' => esc_html__('Enter font-size in pixels', 'cryptronick'),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'size',
                    'value' => 'custom',
                ),
                'group' => esc_html__( 'Style', 'cryptronick' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Number Weight', 'cryptronick'),
                'param_name' => 'font_weight',
                'description' => esc_html__('Enter font-weight in pixels', 'cryptronick'),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Style', 'cryptronick' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Text Weight', 'cryptronick'),
                'param_name' => 'font_text_weight',
                'description' => esc_html__('Enter font-weight in pixels', 'cryptronick'),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Style', 'cryptronick' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Align', 'cryptronick' ),
                'param_name' => 'align',
                "value"         => array(
                    esc_html__( 'left', 'cryptronick' ) => 'left',
                    esc_html__( 'center', 'cryptronick' ) => 'center',
                    esc_html__( 'right', 'cryptronick' ) => 'right',
                ),
                'std' => 'center',
                'group' => esc_html__( 'Style', 'cryptronick' ),
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Number Color', 'cryptronick'),
                'param_name' => 'number_color',
                'value' => "#ffffff",
                'group' => esc_html__( 'Style', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ), 
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Text Color', 'cryptronick'),
                'param_name' => 'countdown_color',
                'value' => "#ffffff",
                'group' => esc_html__( 'Style', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ), 
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Points Color', 'cryptronick'),
                'param_name' => 'points_color',
                'value' => "#46e1ac",
                'group' => esc_html__( 'Style', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),                     
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_countdown extends WPBakeryShortCode {

            
        }
    } 
}