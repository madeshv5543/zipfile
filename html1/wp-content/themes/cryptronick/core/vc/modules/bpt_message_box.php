<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
// Add list item
    $main_font = Cryptronick_Theme_Helper::get_option('main-font');
    vc_map(array(
        'name' => esc_html__('Message Box', 'cryptronick'),
        'base' => 'bpt_message_box',
        'class' => 'cryptronick_message_box',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_message_box',
        'content_element' => true,
        'description' => esc_html__('Message Box','cryptronick'),
        'params' => array(
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Message Type', 'cryptronick' ),
                'param_name'    => 'type',
                'value'         => array(
                    esc_html__( 'Informational', 'cryptronick' )  => 'info',
                    esc_html__( 'Success', 'cryptronick' )   => 'success',
                    esc_html__( 'Warning', 'cryptronick' ) => 'warning',
                    esc_html__( 'Error', 'cryptronick' )  => 'error',
                    esc_html__( 'Custom', 'cryptronick' )    => 'custom',
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
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type'          => 'colorpicker',
                'heading'       => esc_html__( 'Message Color', 'cryptronick' ),
                'param_name'    => 'icon_color',
                'value'         => $theme_color,
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'cryptronick'),
                'param_name' => 'title',
                'admin_label'   => true,
            ),  
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Text', 'cryptronick'),
                'param_name' => 'text',
            ),       
            array(
                'type'          => 'bpt_checkbox',
                'heading'       => esc_html__( 'Closable?', 'cryptronick' ),
                'param_name'    => 'closable',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
            // title styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Title Styles', 'cryptronick'),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Title Tag', 'cryptronick' ),
                'param_name'    => 'title_tag',
                'value'         => array(
                    esc_html__( 'Div', 'cryptronick' )    => 'div',
                    esc_html__( 'Span', 'cryptronick' )    => 'span',
                    esc_html__( 'H2', 'cryptronick' )    => 'h2',
                    esc_html__( 'H3', 'cryptronick' )    => 'h3',
                    esc_html__( 'H4', 'cryptronick' )    => 'h4',
                    esc_html__( 'H5', 'cryptronick' )    => 'h5',
                    esc_html__( 'H6', 'cryptronick' )    => 'h6',
                ),
                'std' => 'h4',
                'group'         => esc_html__( 'Typography', 'cryptronick' ),
                'description' => esc_html__( 'Choose your tag for title', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
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
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            // Title Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for title', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_title',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
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
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'cryptronick'),
                'param_name' => 'title_color',
                'value' => $theme_color,
                'description' => esc_html__('Select title color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // text styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Text Styles', 'cryptronick'),
                'param_name' => 'h_text_styles',
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Text Tag', 'cryptronick' ),
                'param_name'    => 'text_tag',
                'value'         => array(
                    esc_html__( 'Div', 'cryptronick' )    => 'div',
                    esc_html__( 'Span', 'cryptronick' )    => 'span',
                    esc_html__( 'H2', 'cryptronick' )    => 'h2',
                    esc_html__( 'H3', 'cryptronick' )    => 'h3',
                    esc_html__( 'H4', 'cryptronick' )    => 'h4',
                    esc_html__( 'H5', 'cryptronick' )    => 'h5',
                    esc_html__( 'H6', 'cryptronick' )    => 'h6',
                ),
                'std' => 'div',
                'group'         => esc_html__( 'Typography', 'cryptronick' ),
                'description' => esc_html__( 'Choose your tag for text', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            // text Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Text Font Size', 'cryptronick'),
                'param_name' => 'text_size',
                'value' => '',
                'description' => esc_html__( 'Enter text font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            // text Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for text', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_text',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
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
                    'element' => 'use_theme_fonts_text',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
            ),
            // text color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Text Color', 'cryptronick' ),
                'param_name' => 'custom_text_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
            ),
            // text color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Text Color', 'cryptronick'),
                'param_name' => 'text_color',
                'value' => '#000000',
                'description' => esc_html__('Select text color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_text_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),             
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_message_box extends WPBakeryShortCode {
            
        }
    } 
}
