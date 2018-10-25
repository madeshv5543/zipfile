<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Time Line Vertical', 'cryptronick'),
        'base' => 'bpt_time_line_vertical',
        'class' => 'cryptronick_time_line_vertical',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_vertical-timeline',
        'content_element' => true,
        'description' => esc_html__('Display Time Line Vertical','cryptronick'),
        'params' => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Time Line Items Content', 'cryptronick' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph - title, description, date and color.', 'cryptronick' ),
                'params' => array(
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Title', 'cryptronick' ),
                        "param_name"    => "title",
                        'admin_label'   => true,
                    ),
                    array(
                        "type"          => "textarea",
                        "heading"       => esc_html__( 'Description', 'cryptronick' ),
                        "param_name"    => "descr",
                    ),
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Date', 'cryptronick' ),
                        "param_name"    => "date",
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Main Color', 'cryptronick'),
                        'param_name' => 'color',
                        'value' => $theme_color,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        "type"          => "bpt_checkbox",
                        'heading' => esc_html__( 'Active Item', 'cryptronick' ),
                        "param_name"    => "active",
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
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_Time_Line_Vertical extends WPBakeryShortCode {
        }
    }
}
