<?php

$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');

if (function_exists('vc_map')) {
    vc_map(array(		
		
        'base' => 'bpt_ico_progress',
        'name' => esc_html__('Ico Progress', 'cryptronick'),
		'class' => 'cryptronick_ico_progress_module',
        'description' => esc_html__('Display Ico Progress Module', 'cryptronick'),
        'as_parent' => array('only' => 'bpt_countdown, bpt_button, vc_column_text, bpt_custom_text, vc_single_image, vc_row , bpt_ico_progress_bar, bpt_spacing'),
		'content_element' => true,		
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_ico-mod',
		'show_settings_on_create' => true,
		'is_container' => true,
        'params' => array(
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Background Colors', 'cryptronick'),
                'param_name' => 'h_bg_bg_colors',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Background Customize Colors', 'cryptronick' ),
                'param_name'    => 'bg_color_type',
                'value'         => array(
                    esc_html__( 'Default', 'cryptronick' )      => 'def',
                    esc_html__( 'Color', 'cryptronick' )      => 'color',
                    esc_html__( 'Gradient', 'cryptronick' )     => 'gradient',
                ),
            ),	
            // background color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'cryptronick'),
                'param_name' => 'bg_color',
                'value' => 'rgba(0,0,32,0.7)',
                'description' => esc_html__('Select background color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),	
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Start Color', 'cryptronick'),
                'param_name' => 'bg_gradient_start',
                'value' => $theme_gradient['from'],
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background End Color', 'cryptronick'),
                'param_name' => 'bg_gradient_end',
                'value' => $theme_gradient['to'],
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // button paddings
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Ico Paddings', 'cryptronick'),
                'param_name' => 'heading',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Ico Left Padding', 'cryptronick'),
                'param_name' => 'ico_left_pad',
                'value' => '30',
                'description' => esc_html__( 'Enter Ico left padding in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Ico Right Padding', 'cryptronick'),
                'param_name' => 'ico_right_pad',
                'value' => '30',
                'description' => esc_html__( 'Enter Ico right padding in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Ico Top Padding', 'cryptronick'),
                'param_name' => 'ico_top_pad',
                'value' => '30',
                'description' => esc_html__( 'Enter Ico top padding in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Ico Bottom Padding', 'cryptronick'),
                'param_name' => 'ico_bottom_pad',
                'value' => '30',
                'description' => esc_html__( 'Enter Ico bottom padding in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
        ),
		'js_view' => 'VcColumnView'
    ));


    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_bpt_Ico_Progress extends WPBakeryShortCodesContainer
        {
        }
    }
}