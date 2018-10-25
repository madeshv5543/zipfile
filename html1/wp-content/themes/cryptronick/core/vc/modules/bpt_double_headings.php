<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
$header_font = Cryptronick_Theme_Helper::get_option('header-font');
$main_font = Cryptronick_Theme_Helper::get_option('main-font');
$h2_font = Cryptronick_Theme_Helper::get_option('h2-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__('Double Headings', 'cryptronick'),
        'base' => 'bpt_double_headings',
        'class' => 'cryptronick_custom_text',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_double-text',
        'content_element' => true,
        'description' => esc_html__('Double Headings','cryptronick'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'cryptronick'),
                'param_name' => 'title',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle', 'cryptronick'),
                'param_name' => 'subtitle',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Alignment', 'cryptronick' ),
                'param_name'    => 'align',
                'edit_field_class' => 'vc_col-sm-6',
                'value'         => array(
                    esc_html__( 'Left', 'cryptronick' )      => 'left',
                    esc_html__( 'Right', 'cryptronick' )      => 'right',
                    esc_html__( 'Center', 'cryptronick' )     => 'center',
                ),
            ), 
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Subtitle Position', 'cryptronick' ),
                'param_name'    => 'sub_pos',
                'edit_field_class' => 'vc_col-sm-6',
                'value'         => array(
                    esc_html__( 'Top', 'cryptronick' )      => 'top',
                    esc_html__( 'Bottom', 'cryptronick' )      => 'bottom',
                ),
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
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Title Styles', 'cryptronick'),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type'          => 'colorpicker',
                'heading'       => esc_html__( 'Title Color', 'cryptronick' ),
                'param_name'    => 'title_color',
                'group'         => esc_html__( 'Styling', 'cryptronick' ),
                'value'         => esc_attr($header_font['color']),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
                'description' => esc_html__( 'Choose color for title.', 'cryptronick' ),
            ), 
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Size', 'cryptronick'),
                'param_name' => 'title_size',
                'value' => esc_attr($h2_font['font-size']),
                'description' => esc_html__( 'Enter font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Line Height', 'cryptronick'),
                'param_name' => 'title_line_height',
                'value' => '120',
                'description' => esc_html__( 'Enter line height in %.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Weight', 'cryptronick'),
                'param_name' => 'title_weight',
                'value' => esc_attr($h2_font['font-weight']),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Set Title Resonsive Font Size', 'cryptronick' ),
                'param_name' => 'responsive_font',
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Small Desktops', 'cryptronick'),
                'param_name' => 'font_size_sm_desctop',
                'description' => esc_html__( 'Enter font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'responsive_font',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Tablets', 'cryptronick'),
                'param_name' => 'font_size_tablet',
                'description' => esc_html__( 'Enter font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'responsive_font',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Mobile', 'cryptronick'),
                'param_name' => 'font_size_mobile',
                'description' => esc_html__( 'Enter font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'responsive_font',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for title', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_title',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
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
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),   
            // subtitle
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Subtitle Styles', 'cryptronick'),
                'param_name' => 'h_subtitle_styles',
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type'          => 'colorpicker',
                'heading'       => esc_html__( 'Subtitle Color', 'cryptronick' ),
                'param_name'    => 'subtitle_color',
                'group'         => esc_html__( 'Styling', 'cryptronick' ),
                'value'         => $theme_color,
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
                'description' => esc_html__( 'Choose color for subtitle.', 'cryptronick' ),
            ), 
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle Font Size', 'cryptronick'),
                'param_name' => 'subtitle_size',
                'value' => '18px',
                'description' => esc_html__( 'Enter font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle Line Height', 'cryptronick'),
                'param_name' => 'subtitle_line_height',
                'value' => '160',
                'description' => esc_html__( 'Enter line height in %.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle Font Weight', 'cryptronick'),
                'param_name' => 'subtitle_weight',
                'value' => esc_attr($main_font['font-weight']),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for subtitle', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_subtitle',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_subtitle',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_subtitle',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),                   
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_Double_Headings extends WPBakeryShortCode {
            
        }
    } 
}
