<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
$header_font = Cryptronick_Theme_Helper::get_option('header-font');
$main_font = Cryptronick_Theme_Helper::get_option('main-font');

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        'name' => esc_html__('Flip Box', 'cryptronick'),
        'base' => 'bpt_flip_box',
        'class' => 'cryptronick_flip_box',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_flip_box',
        'content_element' => true,
        'description' => esc_html__('Add Flip Box','cryptronick'),
        'params' => array(
            // General
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Flip Direction', 'cryptronick' ),
                'param_name' => 'fb_dir',
                'value'         => array(
                    esc_html__( 'Flip to Right', 'cryptronick' )      => 'flip_right',
                    esc_html__( 'Flip to Left', 'cryptronick' )      => 'flip_left',
                    esc_html__( 'Flip to Top', 'cryptronick' )      => 'flip_top',
                    esc_html__( 'Flip to Bottom', 'cryptronick' )      => 'flip_bottom',
                ),
                'admin_label' => true,
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Flip Box Height', 'cryptronick'),
                'param_name' => 'fb_height',
                'value' => '',
                'description' => esc_html__( 'Enter custom flip box height in pixels.', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Shadow', 'cryptronick' ),
                'param_name' => 'add_shadow',
                'std' => 'true',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
            // Front Side
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Front Side Background', 'cryptronick'),
                'param_name' => 'h_front_bg',
                'group' => esc_html__( 'Front Side', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'front_bg_style',
                'value'         => array(
                    esc_html__( 'Color', 'cryptronick' )      => 'front_color',
                    esc_html__( 'Image', 'cryptronick' )      => 'front_image',
                ),
                'group' => esc_html__( 'Front Side', 'cryptronick' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'cryptronick'),
                'param_name' => 'front_bg_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => 'front_color'
                ),
                'group' => esc_html__( 'Front Side', 'cryptronick' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Background Image', 'cryptronick'),
                'param_name' => 'front_bg_image',
                'description' => esc_html__( 'Select image from media library.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => 'front_image'
                ),
                'group' => esc_html__( 'Front Side', 'cryptronick' ),
            ),
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Front Side Content', 'cryptronick'),
                'param_name' => 'h_front_content',
                'group' => esc_html__( 'Front Side', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Logo Image', 'cryptronick'),
                'param_name' => 'front_logo_image',
                'description' => esc_html__( 'Select image from media library.', 'cryptronick' ),
                'group' => esc_html__( 'Front Side', 'cryptronick' ),
            ),
            array(
                'type' => 'textarea',
                'param_name' => 'front_title',
                'heading' => esc_html__('Title', 'cryptronick'),
                'group' => esc_html__( 'Front Side', 'cryptronick' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'cryptronick'),
                'param_name' => 'front_title_color',
                'value' => $header_font['color'],
                'group' => esc_html__( 'Front Side', 'cryptronick' ),
            ),
            array(
                'type' => 'textarea',
                'param_name' => 'front_descr',
                'heading' => esc_html__('Description', 'cryptronick'),
                'group' => esc_html__( 'Front Side', 'cryptronick' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Description Color', 'cryptronick'),
                'param_name' => 'front_descr_color',
                'value' => $main_font['color'],
                'group' => esc_html__( 'Front Side', 'cryptronick' ),
            ),
            // Back Side
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Back Side Background', 'cryptronick'),
                'param_name' => 'h_back_bg',
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'back_bg_style',
                'value'         => array(
                    esc_html__( 'Color', 'cryptronick' )      => 'back_color',
                    esc_html__( 'Image', 'cryptronick' )      => 'back_image',
                ),
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'cryptronick'),
                'param_name' => 'back_bg_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'back_bg_style',
                    'value' => 'back_color'
                ),
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Background Image', 'cryptronick'),
                'param_name' => 'back_bg_image',
                'description' => esc_html__( 'Select image from media library.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'back_bg_style',
                    'value' => 'back_image'
                ),
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
            ),
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Back Side Content', 'cryptronick'),
                'param_name' => 'h_back_title',
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'back_title',
                'heading' => esc_html__('Title', 'cryptronick'),
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'cryptronick'),
                'param_name' => 'back_title_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
            ),
            array(
                'type' => 'textarea',
                'param_name' => 'back_descr',
                'heading' => esc_html__('Description', 'cryptronick'),
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Description Color', 'cryptronick'),
                'param_name' => 'back_descr_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
            ),
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Back Side Button', 'cryptronick'),
                'param_name' => 'h_back_button',
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Read More Button', 'cryptronick' ),
                'param_name' => 'add_read_more',
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button Color', 'cryptronick'),
                'param_name' => 'back_button_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Read More Button Text', 'cryptronick'),
                'param_name' => 'read_more_text',
                'value' => esc_html__('Read More', 'cryptronick'),
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'cryptronick' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to read more button.', 'cryptronick'),
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Icon to the Button', 'cryptronick' ),
                'param_name' => 'add_icon_button',
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'cryptronick'),
                'param_name' => 'btn_icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an 'EMPTY' icon?
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => Array('element' => 'add_icon_button','value' => 'true'),
                'description' => esc_html__( 'Select icon from library.', 'cryptronick' ),
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon Position', 'cryptronick'),
                'param_name' => 'btn_icon_position',
                'value' => array(
                    esc_html__('Left', 'cryptronick') => 'left',
                    esc_html__('Right', 'cryptronick') => 'right'
                ),
                'dependency' => Array('element' => 'add_icon_button','value' => 'true'),
                'group' => esc_html__( 'Back Side', 'cryptronick' ),
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_Flip_Box extends WPBakeryShortCode {
        }
    }
}