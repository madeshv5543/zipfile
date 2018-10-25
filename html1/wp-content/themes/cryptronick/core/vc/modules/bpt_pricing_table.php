<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Pricing Table', 'cryptronick'),
        'base' => 'bpt_pricing_table',
        'class' => 'cryptronick_pricing_table',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_price_table',
        'content_element' => true,
        'description' => esc_html__('Display Pricing Table','cryptronick'),
        'params' => array(
            // General
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Pricing Table Title', 'cryptronick'),
                'param_name' => 'pricing_title',
                'admin_label' => true,
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Currency', 'cryptronick'),
                'param_name' => 'pricing_cur',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Price', 'cryptronick'),
                'param_name' => 'pricing_price',
                'edit_field_class' => 'vc_col-sm-4',
                'admin_label' => true,
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Descriptions', 'cryptronick'),
                'param_name' => 'pricing_desc',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Recommended', 'cryptronick' ),
                'param_name' => 'recommend',
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Recommended Text', 'cryptronick'),
                'param_name' => 'recommend_text',
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'recommend',
                    'value' => 'true',
                ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
            // Icon Section
            // Pricing Table Icon/Image heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Icon Type', 'cryptronick'),
                'param_name' => 'h_icon_type',
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Pricing Table Icon/Image
            array(
                'type'          => 'dropdown',
                'param_name'    => 'icon_type',
                'value'         => array(
                    esc_html__( 'None', 'cryptronick' )      => 'none',
                    esc_html__( 'Font', 'cryptronick' )      => 'font',
                    esc_html__( 'Image', 'cryptronick' )     => 'image',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Icon', 'cryptronick' ),
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'icon_font_type',
                'value'         => array(
                    esc_html__( 'Fontawesome', 'cryptronick' )      => 'type_fontawesome',
                    esc_html__( 'Flaticon', 'cryptronick' )      => 'type_flaticon',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'cryptronick' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon?
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'icon_font_type',
                    'value' => 'type_fontawesome',
                ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'cryptronick' ),
                'param_name' => 'icon_flaticon',
                'value' => '', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon?
                    'type' => 'flaticon',
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'icon_font_type',
                    'value' => 'type_flaticon',
                ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'cryptronick' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
            ),
            // Custom image width
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Image Width', 'cryptronick'),
                'param_name' => 'custom_image_width',
                'description' => esc_html__( 'Enter image size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Custom image height
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Image Height', 'cryptronick'),
                'param_name' => 'custom_image_height',
                'description' => esc_html__( 'Enter image size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Custom icon size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Icon Size', 'cryptronick'),
                'param_name' => 'custom_icon_size',
                'description' => esc_html__( 'Enter Icon size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
            ),
            // Icon color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Icon Colors', 'cryptronick' ),
                'param_name' => 'custom_icon_color',
                'description' => esc_html__( 'Select custom colors', 'cryptronick' ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Icon color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Color', 'cryptronick'),
                'param_name' => 'icon_color',
                'value' => '#ffffff',
                'description' => esc_html__('Select icon color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),   
            // Content Section
            array(
                'type' => 'textarea_html',
                'holder' => 'div',
                'heading' => esc_html__('Content.', 'cryptronick'),
                'param_name' => 'content',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'admin_label' => false,
            ),
            // description
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Description Text', 'cryptronick'),
                'param_name' => 'descr_text',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            // add button header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Add Button', 'cryptronick'),
                'param_name' => 'h_button',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // button
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Text', 'cryptronick'),
                'param_name' => 'button_title',
                'value' => esc_html__('Choose Plan', 'cryptronick'),
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            // Link
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Button Link', 'cryptronick' ),
                'param_name' => 'link',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'description' => esc_html__('Add link to button.', 'cryptronick')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize', 'cryptronick' ),
                'param_name' => 'btn_customize',
                'value'         => array(
                    esc_html__( 'Default', 'cryptronick' )        => 'def',
                    esc_html__( 'Color', 'cryptronick' )          => 'color',
                    esc_html__( 'Gradient', 'cryptronick' )       => 'gradient',
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            // Button text-color header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Text Color', 'cryptronick'),
                'param_name' => 'h_text_color',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color', 'gradient')
                ),
            ),
            // Button text-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Text Color', 'cryptronick'),
                'param_name' => 'btn_text_color',
                'value' => '#1b3452',
                'description' => esc_html__('Select custom text color for button.', 'cryptronick'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover text-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Text Color', 'cryptronick'),
                'param_name' => 'btn_text_color_hover',
                'value' => '#ffffff',
                'description' => esc_html__('Select custom text color for hover button.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Background Color', 'cryptronick'),
                'param_name' => 'h_background_color',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color')
                ),
            ),
            // Button Bg
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Background', 'cryptronick'),
                'param_name' => 'btn_bg_color',
                'value' => '#ffffff',
                'description' => esc_html__('Select custom background for button.', 'cryptronick'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover Bg
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Background', 'cryptronick'),
                'param_name' => 'btn_bg_color_hover',
                'value' => $theme_color,
                'description' => esc_html__('Select custom background for hover button.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg Gradient header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Background Gradient Color', 'cryptronick'),
                'param_name' => 'h_btn_background_gradient_color',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
            ),
            // Button Bg Gradient start
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Start Color', 'cryptronick'),
                'param_name' => 'btn_bg_gradient_start',
                'value' => '#f8f9fd',
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg Gradient end
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('End Color', 'cryptronick'),
                'param_name' => 'btn_bg_gradient_end',
                'value' => '#f8f9fd',
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg Gradient Hover header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Background Gradient Hover Color', 'cryptronick'),
                'param_name' => 'h_background_gradient_hover_color',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
            ),
            // Button Bg Gradient Hover start
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Start Color', 'cryptronick'),
                'param_name' => 'btn_bg_gradient_start_hover',
                'value' => $theme_gradient['from'],
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg Gradient Hover end
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('End Color', 'cryptronick'),
                'param_name' => 'btn_bg_gradient_end_hover',
                'value' => $theme_gradient['to'],
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button border-color header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Border Color', 'cryptronick'),
                'param_name' => 'h_border_color',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color')
                ),
            ),
            // Button border-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Border Color', 'cryptronick'),
                'param_name' => 'btn_border_color',
                'value' => $theme_color,
                'description' => esc_html__('Select custom border color for button.', 'cryptronick'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover border-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Border Color', 'cryptronick'),
                'param_name' => 'btn_border_color_hover',
                'value' => $theme_color,
                'description' => esc_html__('Select custom border color for hover button.', 'cryptronick'),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color')
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Border Gradient header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Border Gradient Color', 'cryptronick'),
                'param_name' => 'h_border_gradient_color',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
            ),
            // Button Border Gradient start
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Start Color', 'cryptronick'),
                'param_name' => 'btn_border_gradient_start',
                'value' => $theme_gradient['from'],
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover Border Gradient end
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('End Color', 'cryptronick'),
                'param_name' => 'btn_border_gradient_end',
                'value' => $theme_gradient['to'],
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Border Gradient Hover header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Border Gradient Hover Color', 'cryptronick'),
                'param_name' => 'h_border_gradient_hover_color',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
            ),
            // Button Border Gradient Hover start
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Start Color', 'cryptronick'),
                'param_name' => 'btn_border_gradient_start_hover',
                'value' => $theme_gradient['from'],
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Border Gradient Hover end
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('End Color', 'cryptronick'),
                'param_name' => 'btn_border_gradient_end_hover',
                'value' => $theme_gradient['to'],
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // header styling header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Header Styling', 'cryptronick'),
                'param_name' => 'h_header_style',
                'group' => esc_html__( 'Header Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize', 'cryptronick' ),
                'param_name' => 'header_customize',
                'value'         => array(
                    esc_html__( 'Default', 'cryptronick' )        => 'def',
                    esc_html__( 'Color', 'cryptronick' )          => 'color',
                    esc_html__( 'Gradient', 'cryptronick' )       => 'gradient',
                    esc_html__( 'Image', 'cryptronick' )       => 'image',
                ),
                'group' => esc_html__( 'Header Background', 'cryptronick' ),
            ),
            // Header Bg header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Header Background Color', 'cryptronick'),
                'param_name' => 'h_header_background_color',
                'group' => esc_html__( 'Header Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'header_customize',
                    'value' => array('color')
                ),
            ),
            // Header Bg
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Background', 'cryptronick'),
                'param_name' => 'header_bg_color',
                'value' => $theme_color,
                'description' => esc_html__('Select custom background for header.', 'cryptronick'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'header_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Header Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Header Bg Gradient header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Background Gradient Color', 'cryptronick'),
                'param_name' => 'h_background_gradient_color',
                'group' => esc_html__( 'Header Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'header_customize',
                    'value' => array('gradient')
                ),
            ),
            // Header Bg Gradient start
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Start Color', 'cryptronick'),
                'param_name' => 'header_bg_gradient_start',
                'value' => $theme_gradient['from'],
                'save_always' => true,
                'dependency' => array(
                    'element' => 'header_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Header Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Header Bg Gradient end
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('End Color', 'cryptronick'),
                'param_name' => 'header_bg_gradient_end',
                'value' => $theme_gradient['to'],
                'dependency' => array(
                    'element' => 'header_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Header Background', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Header Bg Image header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Background Header Image', 'cryptronick'),
                'param_name' => 'h_background_image',
                'group' => esc_html__( 'Header Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'header_customize',
                    'value' => array('image')
                ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'cryptronick' ),
                'param_name' => 'bg_image',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'header_customize',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Header Background', 'cryptronick' ),
            ),
            // title styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Title Styles', 'cryptronick'),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // title Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Size', 'cryptronick'),
                'param_name' => 'title_size',
                'value' => '',
                'description' => esc_html__( 'Enter title font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // title Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Weight', 'cryptronick'),
                'param_name' => 'title_weight',
                'value' => '',
                'description' => esc_html__( 'Enter font-weight.', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Title Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for pricing table title', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_title',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_title',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
            ),
            // title color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Title Color', 'cryptronick' ),
                'param_name' => 'custom_title_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'cryptronick'),
                'param_name' => 'title_color',
                'value' => '#ffffff',
                'description' => esc_html__('Select title color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // title styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Price Styles', 'cryptronick'),
                'param_name' => 'h_content_styles',
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // content Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Price Font Size', 'cryptronick'),
                'param_name' => 'price_size',
                'value' => '',
                'description' => esc_html__( 'Enter price font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Price Color', 'cryptronick' ),
                'param_name' => 'custom_price_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Price Color', 'cryptronick'),
                'param_name' => 'price_color',
                'value' => '#ffffff',
                'description' => esc_html__('Select price color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_price_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_Pricing_Table extends WPBakeryShortCode {
        }
    }
}
