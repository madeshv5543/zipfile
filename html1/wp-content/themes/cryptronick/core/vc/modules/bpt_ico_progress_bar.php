<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Ico Progress Bar', 'cryptronick'),
        'base' => 'bpt_ico_progress_bar',
        'class' => 'cryptronick_ico_progress_bar',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_ico-mod',
        'content_element' => true,
        'description' => esc_html__('Display Ico Progress Bar','cryptronick'),
        'params' => array(
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Max Value', 'cryptronick' ),
                "param_name"    => "max_value",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Max Value Label', 'cryptronick' ),
                "param_name"    => "max_value_label",
                'edit_field_class' => 'vc_col-sm-6 no-top-padding',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Completed', 'cryptronick' ),
                "param_name"    => "completed",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Completed Label', 'cryptronick' ),
                "param_name"    => "completed_label",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Units', 'cryptronick' ),
                "param_name"    => "units",
                "value"    => "$",
                "description"   => esc_html__( 'Enter measurement units (Example: %, px, points, etc.)', 'cryptronick' ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Max Ico Progress Bar Width', 'cryptronick' ),
                "param_name"    => "max_width",
                "description"   => esc_html__( 'Enter max width in pixels', 'cryptronick' ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
            // Ico Progress Bar Points
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Ico Progress Bar Points', 'cryptronick'),
                'param_name' => 'h_bar_points',
                'group' => esc_html__( 'Points', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'param_group',
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph - point label and point value.', 'cryptronick' ),
                'group' => esc_html__( 'Points', 'cryptronick' ),
                'value' => urlencode( json_encode( array(
                    array(
                        'point_label' => esc_html__( 'Soft Cap', 'cryptronick' ),
                        'point_value' => '25',
                    ),
                    array(
                        'point_label' => esc_html__( 'Hard Cap', 'cryptronick' ),
                        'point_value' => '75',
                    ),
                ) ) ),
                'params' => array(
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Point Label', 'cryptronick' ),
                        "param_name"    => "point_label",
                        'admin_label'   => true,
                    ),
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Point Value', 'cryptronick' ),
                        "param_name"    => "point_value",
                        "description"    => esc_html__( 'Enter value in percentage', 'cryptronick' ),
                    ),
                ),
            ),
            // Colors
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Bar Colors', 'cryptronick'),
                'param_name' => 'h_bar_colors',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Colors', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Bar Colors', 'cryptronick' ),
                'param_name' => 'custom_bar_color',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Colors', 'cryptronick' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Bacground Color', 'cryptronick'),
                'param_name' => 'bg_color',
                'value' => '#1b3452',
                'edit_field_class' => 'vc_col-sm-4',
                "dependency"    => array(
                    "element"   => "custom_bar_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Comleted Color', 'cryptronick'),
                'param_name' => 'completed_color',
                'value' => '#90ff98',
                'edit_field_class' => 'vc_col-sm-4',
                "dependency"    => array(
                    "element"   => "custom_bar_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
            ),
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Text Colors', 'cryptronick'),
                'param_name' => 'h_text_colors',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Colors', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Text Colors', 'cryptronick' ),
                'param_name' => 'custom_text_color',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Colors', 'cryptronick' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Values Colors', 'cryptronick'),
                'param_name' => 'value_color',
                'value' => '#ffffff',
                'edit_field_class' => 'vc_col-sm-4',
                "dependency"    => array(
                    "element"   => "custom_text_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Labels Colors', 'cryptronick'),
                'param_name' => 'label_color',
                'value' => '#ffffff',
                'edit_field_class' => 'vc_col-sm-4',
                "dependency"    => array(
                    "element"   => "custom_text_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_Ico_Progress_Bar extends WPBakeryShortCode {
        }
    }
}
