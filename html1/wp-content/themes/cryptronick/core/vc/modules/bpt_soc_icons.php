<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Social Icons', 'cryptronick'),
        'base' => 'bpt_soc_icons',
        'class' => 'cryptronick_soc_icons',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_social-icons',
        'content_element' => true,
        'description' => esc_html__('Display Social Icons','cryptronick'),
        'params' => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'cryptronick' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph - value, title and color.', 'cryptronick' ),
                'value' => urlencode( json_encode( array(
                    array(
                        'link' => 'https://www.facebook.com/',
                        'icon' => 'fa fa-facebook',
                        'title' => esc_html__( 'Facebook', 'cryptronick' ),
                        'new_tab' => true,
                        'custom_colors' => 'true',
                        'icon_color' => '#ffffff',
                        'icon_hover_color' => '#0a7cfa',
                        'bg_color' => '#0a7cfa',
                        'bg_hover_color' => '#ffffff',
                    ),
                    array(
                        'link' => 'https://twitter.com/',
                        'icon' => 'fa fa-twitter',
                        'title' => esc_html__( 'Twitter', 'cryptronick' ),
                        'new_tab' => true,
                        'custom_colors' => 'true',
                        'icon_color' => '#ffffff',
                        'icon_hover_color' => '#5c36da',
                        'bg_color' => '#5c36da',
                        'bg_hover_color' => '#ffffff',
                    ),
                    array(
                        'link' => 'https://www.instagram.com/',
                        'icon' => 'fa fa-instagram',
                        'title' => esc_html__( 'Instagram', 'cryptronick' ),
                        'new_tab' => true,
                        'custom_colors' => 'true',
                        'icon_color' => '#ffffff',
                        'icon_hover_color' => '#40e0b1',
                        'bg_color' => '#40e0b1',
                        'bg_hover_color' => '#ffffff',
                    ),
                ) ) ),
                'params' => array(
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__( 'Icon', 'cryptronick' ),
                        'param_name' => 'icon',
                        'value' => 'fa fa-adjust', // default value to backend editor admin_label
                        'settings' => array(
                            'emptyIcon' => true,
                            // default true, display an "EMPTY" icon?
                            'iconsPerPage' => 200,
                            // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                        ),
                        'description' => esc_html__( 'Select icon from library.', 'cryptronick' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Link', 'cryptronick' ),
                        'param_name' => 'link',
                        'edit_field_class' => 'vc_col-sm-6',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title', 'cryptronick' ),
                        'param_name' => 'title',
                        'edit_field_class' => 'vc_col-sm-6',
                        'admin_label' => true,
                    ),
                    array(
                        "type"          => "bpt_checkbox",
                        'heading' => esc_html__( 'Custom Colors', 'cryptronick' ),
                        "param_name"    => "custom_colors",
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        "type"          => "bpt_checkbox",
                        'heading' => esc_html__( 'Open in New Tab', 'cryptronick' ),
                        "param_name"    => "new_tab",
                        'edit_field_class' => 'vc_col-sm-6',
                        "std"           => 'true',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Icon Color', 'cryptronick'),
                        'param_name' => 'icon_color',
                        'value' => '#ffffff',
                        'dependency' => array(
                            'element' => 'custom_colors',
                            'value' => 'true'
                        ),
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Icon Hover Color', 'cryptronick'),
                        'param_name' => 'icon_hover_color',
                        'value' => $theme_color,
                        'dependency' => array(
                            'element' => 'custom_colors',
                            'value' => 'true'
                        ),
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Background Color', 'cryptronick'),
                        'param_name' => 'bg_color',
                        'value' => $theme_color,
                        'dependency' => array(
                            'element' => 'custom_colors',
                            'value' => 'true'
                        ),
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Background Hover Color', 'cryptronick'),
                        'param_name' => 'bg_hover_color',
                        'value' => '#ffffff',
                        'dependency' => array(
                            'element' => 'custom_colors',
                            'value' => 'true'
                        ),
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icon Font Size', 'cryptronick'),
                'param_name' => 'icon_size',
                'description' => esc_html__( 'Custom icon font size in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Background Size', 'cryptronick'),
                'param_name' => 'bg_size',
                'description' => esc_html__( 'Custom width,height,line-height size in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Border Radius Size', 'cryptronick'),
                'param_name' => 'border_radius',
                'description' => esc_html__( 'Custom border radius size in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icons Position', 'cryptronick'),
                'param_name' => 'icons_pos',
                'value' => array(
                    esc_html__('Left', 'cryptronick') => 'left',
                    esc_html__('Right', 'cryptronick') => 'right',
                    esc_html__('Center', 'cryptronick') => 'center',
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'description' => esc_html__( 'Set alignment icons.', 'cryptronick' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icons Gap', 'cryptronick'),
                'param_name' => 'icon_gap',
                'description' => esc_html__( 'Custom icon gap width in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                "type"          => "bpt_checkbox",
                'heading' => esc_html__( 'Add Icons Background', 'cryptronick' ),
                "param_name"    => "add_bg",
                'edit_field_class' => 'vc_col-sm-4',
                'std' => 'true',
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
        class WPBakeryShortCode_bpt_Soc_Icons extends WPBakeryShortCode {
        }
    }
}
