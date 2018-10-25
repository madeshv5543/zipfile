<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');
$header_font = Cryptronick_Theme_Helper::get_option('header-font');

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'bpt_video_popup',
        'name' => esc_html__('Video Popup', 'cryptronick'),
        'description' => esc_html__('Video Popup Widget', 'cryptronick'),
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_video_popup',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'cryptronick'),
                'param_name' => 'video_title',
                'description' => esc_html__('Enter title.', 'cryptronick')
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Title Position', 'cryptronick' ),
                'param_name'    => 'title_pos',
                'value'         => array(
                    esc_html__( 'Left', 'cryptronick' )      => 'left',
                    esc_html__( 'Right', 'cryptronick' )      => 'right',
                    esc_html__( 'Top', 'cryptronick' )     => 'top',
                    esc_html__( 'Bottom', 'cryptronick' )     => 'bot',
                ),
                'std' => 'right',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Video Popup Button Alignment', 'cryptronick' ),
                'param_name'    => 'button_pos',
                'value'         => array(
                    esc_html__( 'Left', 'cryptronick' )      => 'left',
                    esc_html__( 'Right', 'cryptronick' )      => 'right',
                    esc_html__( 'Center', 'cryptronick' )     => 'center',
                    esc_html__( 'Inline', 'cryptronick' )     => 'inline',
                ),
            ),
            
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Always Pulse Animation on Button.', 'cryptronick' ),
                'param_name' => 'always_pulse_anim',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Background Image Video', 'cryptronick'),
                'param_name' => 'bg_image',
                'description' => esc_html__('Select video background image.', 'cryptronick')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Video Link', 'cryptronick'),
                'param_name' => 'video_link',
                'description' => esc_html__('Enter video link from youtube or vimeo.', 'cryptronick')
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
            /* styling video popup */
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title color', 'cryptronick'),
                'param_name' => 'title_color',
                'value' => $header_font['color'],
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button color', 'cryptronick'),
                'param_name' => 'btn_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6 no-top-padding',
            ),
            // Background color/gradient
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Background Customize Colors', 'cryptronick' ),
                'param_name'    => 'bg_color_type',
                'value'         => array(
                    esc_html__( 'Default', 'cryptronick' )      => 'def',
                    esc_html__( 'Color', 'cryptronick' )      => 'color',
                    esc_html__( 'Gradient', 'cryptronick' )     => 'gradient',
                ),
                'dependency' => array(
                    'element' => 'ib_type',
                    'value' => array('bordered','fill')
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),
            // background color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'cryptronick'),
                'param_name' => 'background_color',
                'value' => $theme_color,
                'description' => esc_html__('Select background color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Start Color', 'cryptronick'),
                'param_name' => 'background_gradient_start',
                'value' => $theme_gradient['from'],
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background End Color', 'cryptronick'),
                'param_name' => 'background_gradient_end',
                'value' => $theme_gradient['to'],
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Button Size', 'cryptronick' ),
                'param_name' => 'custom_buttom_size',
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Size', 'cryptronick'),
                'param_name' => 'button_size',
                'description' => esc_html__( 'Enter button size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'custom_buttom_size',
                    'value' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Video Popup Title Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for Video Popup title?', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_vpopup_title',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_vpopup_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_vpopup_title',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),
            // Icon Box content Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Video Popup Title Font Size', 'cryptronick'),
                'param_name' => 'title_size',
                'value' => '16',
                'description' => esc_html__( 'Enter Video Popup Title font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),

            
        ),


    ));

    class WPBakeryShortCode_bpt_Video_Popup extends WPBakeryShortCode { }

}