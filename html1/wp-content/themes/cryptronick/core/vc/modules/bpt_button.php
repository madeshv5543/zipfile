<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        'name' => esc_html__('Button', 'cryptronick'),
        'base' => 'bpt_button',
        'class' => 'cryptronick_button',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_button',
        'content_element' => true,
        'description' => esc_html__('Add custom button','cryptronick'),
        'params' => array(
            // Text
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Text', 'cryptronick'),
                'param_name' => 'button_title',
                'value' => esc_html__('Button text', 'cryptronick'),
                'admin_label' => true,
            ),
            // Link
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'cryptronick' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to button.', 'cryptronick')
            ),
            // Size
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Size', 'cryptronick' ),
                'param_name' => 'button_size',
                'value'         => array(
                    esc_html__( 'Normal', 'cryptronick' )   => 'normal',
                    esc_html__( 'Mini', 'cryptronick' )      => 'mini',
                    esc_html__( 'Small', 'cryptronick' )     => 'small',
                    esc_html__( 'Large', 'cryptronick' )     => 'large'
                ),
                'description' => esc_html__('Select button display size.', 'cryptronick')
            ),
            // Alignment
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'cryptronick' ),
                'param_name' => 'button_alignment',
                'value'         => array(
                    esc_html__( 'Inline', 'cryptronick' )      => 'inline',
                    esc_html__( 'Left', 'cryptronick' )     => 'left',
                    esc_html__( 'Right', 'cryptronick' )   => 'right',
                    esc_html__( 'Center', 'cryptronick' )     => 'center',
                    esc_html__( 'Block', 'cryptronick' )      => 'block'
                ),
                'description' => esc_html__('Select button alignment.', 'cryptronick')
            ),     
            // Button Border
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Border Radius', 'cryptronick' ),
                'param_name' => 'btn_border_radius',
                'value'         => array(
                    esc_html__( 'None', 'cryptronick' )      => 'none',
                    esc_html__( '1px', 'cryptronick' )      => '1px',
                    esc_html__( '2px', 'cryptronick' )      => '2px',
                    esc_html__( '3px', 'cryptronick' )      => '3px',
                    esc_html__( '4px', 'cryptronick' )      => '4px',
                    esc_html__( '5px', 'cryptronick' )      => '5px',
                    esc_html__( '10px', 'cryptronick' )      => '10px',
                    esc_html__( '15px', 'cryptronick' )      => '15px',
                    esc_html__( '20px', 'cryptronick' )      => '20px',
                    esc_html__( '25px', 'cryptronick' )      => '25px',
                    esc_html__( '30px', 'cryptronick' )      => '30px',
                    esc_html__( '35px', 'cryptronick' )      => '35px'
                ),
                'std' => '30px',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Border Style', 'cryptronick' ),
                'param_name' => 'btn_border_style',
                'value'         => array(
                    esc_html__( 'Solid', 'cryptronick' )     => 'solid',
                    esc_html__( 'Dashed', 'cryptronick' )   => 'dashed',
                    esc_html__( 'Dotted', 'cryptronick' )     => 'dotted',
                    esc_html__( 'Double', 'cryptronick' )      => 'double',
                    esc_html__( 'Inset', 'cryptronick' )      => 'inset',
                    esc_html__( 'Outset', 'cryptronick' )      => 'outset',
                    esc_html__( 'None', 'cryptronick' )      => 'none'
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Border Width', 'cryptronick' ),
                'param_name' => 'btn_border_width',
                'value'         => array(
                    esc_html__( '1px', 'cryptronick' )      => '1px',
                    esc_html__( '2px', 'cryptronick' )      => '2px',
                    esc_html__( '3px', 'cryptronick' )      => '3px',
                    esc_html__( '4px', 'cryptronick' )      => '4px',
                    esc_html__( '5px', 'cryptronick' )      => '5px',
                    esc_html__( '6px', 'cryptronick' )      => '6px',
                    esc_html__( '7px', 'cryptronick' )      => '7px',
                    esc_html__( '8px', 'cryptronick' )      => '8px',
                    esc_html__( '9px', 'cryptronick' )      => '9px',
                    esc_html__( '10px', 'cryptronick' )      => '10px'
                ),
                'dependency' => array(
                    'element' => 'btn_border_style',
                    'value_not_equal_to' => 'none',
                ),
            ),
            // --- ICON GROUP --- //
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Icon Type', 'cryptronick'),
                'param_name' => 'h_icon_type',
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'class' => '',
                'param_name' => 'btn_icon_type',
                'value' => array(
                    esc_html__('None','cryptronick') => 'none',
                    esc_html__('Font','cryptronick') => 'font',
                    esc_html__('Image','cryptronick') => 'image',
                ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'description' => esc_html__('Use an existing font icon or upload a custom image.', 'cryptronick'),
            ),
            // Icon
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'cryptronick'),
                'param_name' => 'btn_icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an 'EMPTY' icon?
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => Array('element' => 'btn_icon_type','value' => array('font')),
                'description' => esc_html__( 'Select icon from library.', 'cryptronick' ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
            ),
            // Image
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Image', 'cryptronick'),
                'param_name' => 'btn_image',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'cryptronick' ),
                'dependency' => Array('element' => 'btn_icon_type','value' => array('image')),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image Width', 'cryptronick'),
                'param_name' => 'btn_img_width',
                'value' => '',
                'description' => esc_html__( 'Enter image width in pixels.', 'cryptronick' ),
                'dependency' => Array('element' => 'btn_icon_type','value' => array('image')),
                'edit_field_class' => 'vc_col-sm-6',
                'group' => esc_html__( 'Icon', 'cryptronick' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon Position', 'cryptronick'),
                'param_name' => 'btn_icon_position',
                'value' => array(
                    esc_html__('Left', 'cryptronick') => 'left',
                    esc_html__('Right', 'cryptronick') => 'right'
                ),
                'dependency' => Array('element' => 'btn_icon_type','value' => array('image', 'font')),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
            ),
            // Icon Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icon Font Size', 'cryptronick'),
                'param_name' => 'icon_font_size',
                'value' => '',
                'description' => esc_html__( 'Enter icon font-size in pixels.', 'cryptronick' ),
                'dependency' => Array('element' => 'btn_icon_type','value' => array('font')),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Button icon-color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Colors', 'cryptronick' ),
                'param_name' => 'custom_icon_color',
                'description' => esc_html__( 'Select custom colors', 'cryptronick' ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'dependency' => Array('element' => 'btn_icon_type','value' => array('font')),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Button icon-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Icon Color', 'cryptronick'),
                'param_name' => 'btn_icon_color',
                'value' => '#ffffff',
                'description' => esc_html__('Select icon color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Button Hover icon-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Icon Color', 'cryptronick'),
                'param_name' => 'btn_icon_color_hover',
                'value' => '#ffffff',
                'description' => esc_html__('Select icon hover color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // --- TYPOGRAPHY GROUP --- //
            // Button Font
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for button', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_button',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_button',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_button',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
            ),
            // Button Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Font Size', 'cryptronick'),
                'param_name' => 'btn_font_size',
                'value' => '',
                'description' => esc_html__( 'Enter button font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),            
            // Button Font Weight
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Font Weight', 'cryptronick'),
                'param_name' => 'btn_font_weight',
                'value' => '',
                'description' => esc_html__( 'Enter button font-weight.', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // --- SPACING GROUP --- //
            // button paddings
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Button Paddings', 'cryptronick'),
                'param_name' => 'heading',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Left Padding', 'cryptronick'),
                'param_name' => 'btn_left_pad',
                'value' => '',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'description' => esc_html__( 'Enter button left padding in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Right Padding', 'cryptronick'),
                'param_name' => 'btn_right_pad',
                'value' => '',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'description' => esc_html__( 'Enter button right padding in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Top Padding', 'cryptronick'),
                'param_name' => 'btn_top_pad',
                'value' => '',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'description' => esc_html__( 'Enter button top padding in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Bottom Padding', 'cryptronick'),
                'param_name' => 'btn_bottom_pad',
                'value' => '',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'description' => esc_html__( 'Enter button bottom padding in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // button margins
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Button Margins', 'cryptronick'),
                'param_name' => 'heading',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Left Margin', 'cryptronick'),
                'param_name' => 'btn_left_mar',
                'value' => '',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'description' => esc_html__( 'Enter button left margin in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Right Margin', 'cryptronick'),
                'param_name' => 'btn_right_mar',
                'value' => '',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'description' => esc_html__( 'Enter button right margin in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Top Margin', 'cryptronick'),
                'param_name' => 'btn_top_mar',
                'value' => '',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'description' => esc_html__( 'Enter button top margin in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Bottom Margin', 'cryptronick'),
                'param_name' => 'btn_bottom_mar',
                'value' => '',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'description' => esc_html__( 'Enter button bottom margin in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button animations
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
            // --- CUSTOM GROUP --- //
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Button Colors', 'cryptronick'),
                'param_name' => 'h_button_colors',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
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
                'group' => esc_html__( 'Custom', 'cryptronick' ),
            ),
            // Button text-color header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Text Color', 'cryptronick'),
                'param_name' => 'h_text_color',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
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
                'value' => '#ffffff',
                'description' => esc_html__('Select custom text color for button.', 'cryptronick'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover text-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Text Color', 'cryptronick'),
                'param_name' => 'btn_text_color_hover',
                'value' => esc_attr(Cryptronick_Theme_Helper::get_option('theme-custom-color')),
                'description' => esc_html__('Select custom text color for hover button.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Background Color', 'cryptronick'),
                'param_name' => 'h_background_color',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
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
                'value' => esc_attr(Cryptronick_Theme_Helper::get_option('theme-custom-color')),
                'description' => esc_html__('Select custom background for button.', 'cryptronick'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover Bg
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Background', 'cryptronick'),
                'param_name' => 'btn_bg_color_hover',
                'value' => '#ffffff',
                'description' => esc_html__('Select custom background for hover button.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg Gradient header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Background Gradient Color', 'cryptronick'),
                'param_name' => 'h_background_gradient_color',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
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
                'value' => $theme_gradient['from'],
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg Gradient end
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('End Color', 'cryptronick'),
                'param_name' => 'btn_bg_gradient_end',
                'value' => $theme_gradient['to'],
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg Gradient Hover header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Background Gradient Hover Color', 'cryptronick'),
                'param_name' => 'h_background_gradient_hover_color',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
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
                'value' => $theme_gradient['to'],
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg Gradient Hover end
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('End Color', 'cryptronick'),
                'param_name' => 'btn_bg_gradient_end_hover',
                'value' => $theme_gradient['from'],
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button border-color header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Border Color', 'cryptronick'),
                'param_name' => 'h_border_color',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
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
                'value' => esc_attr(Cryptronick_Theme_Helper::get_option('theme-custom-color')),
                'description' => esc_html__('Select custom border color for button.', 'cryptronick'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover border-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Border Color', 'cryptronick'),
                'param_name' => 'btn_border_color_hover',
                'value' => esc_attr(Cryptronick_Theme_Helper::get_option('theme-custom-color')),
                'description' => esc_html__('Select custom border color for hover button.', 'cryptronick'),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
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
                'group' => esc_html__( 'Custom', 'cryptronick' ),
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
                'group' => esc_html__( 'Custom', 'cryptronick' ),
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
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Border Gradient Hover header
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Border Gradient Hover Color', 'cryptronick'),
                'param_name' => 'h_border_gradient_hover_color',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
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
                'value' => $theme_gradient['to'],
                'save_always' => true,
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Border Gradient Hover end
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('End Color', 'cryptronick'),
                'param_name' => 'btn_border_gradient_end_hover',
                'value' => $theme_gradient['from'],
                'dependency' => array(
                    'element' => 'btn_customize',
                    'value' => array('gradient')
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_Button extends WPBakeryShortCode {
        }
    }
}