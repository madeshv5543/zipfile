<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
if (function_exists('vc_map')) {
    // Add list item

    vc_map(array(
        'name' => esc_html__('Counter', 'cryptronick'),
        'base' => 'bpt_counter',
        'class' => 'cryptronick_counter',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_counter',
        'content_element' => true,
        'description' => esc_html__('Counter','cryptronick'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Counter Title', 'cryptronick'),
                'param_name' => 'count_title',
                'admin_label' => true,
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Counter Value Prefix', 'cryptronick'),
                'description' => esc_html__('Enter prefix before counter number', 'cryptronick'),
                'param_name' => 'count_prefix',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Counter Value', 'cryptronick'),
                'description' => esc_html__('Enter number without any special character', 'cryptronick'),
                'param_name' => 'count_value',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Counter Value Suffix', 'cryptronick'),
                'description' => esc_html__('Enter suffix after counter number', 'cryptronick'),
                'param_name' => 'count_suffix',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'cryptronick_dropdown',
                'heading' => esc_html__('Counter Type', 'cryptronick'),
                'param_name' => 'counter_type',
                'fields' => array(
                    'default' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/type_def.png',
                        'descr' => esc_html__('Default', 'cryptronick')),
                    'bordered' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/type_bordered.png',
                        'descr' => esc_html__('Bordered', 'cryptronick')),
                    'fill' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/type_fill.png',
                        'descr' => esc_html__('Fill', 'cryptronick')),
                ),
                'value' => 'default',
            ),
            array(
                'type' => 'cryptronick_dropdown',
                'heading' => esc_html__('Counter Layout', 'cryptronick'),
                'param_name' => 'counter_layout',
                'fields' => array(
                    'top' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/style_def.png',
                        'descr' => esc_html__('Top', 'cryptronick')),
                    'left' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/style_left.png',
                        'descr' => esc_html__('Left', 'cryptronick')),
                    'right' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/style_right.png',
                        'descr' => esc_html__('Right', 'cryptronick')),
                    'top_left' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/style_left_top.png',
                        'descr' => esc_html__('Top Left', 'cryptronick')),
                    'top_right' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/style_right_top.png',
                        'descr' => esc_html__('Top Right', 'cryptronick')),
                ),
                'value' => 'top',
                'dependency' => array(
                    'element' => 'counter_type',
                    'value' => array('default', 'bordered', 'fill')
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Alignment', 'cryptronick' ),
                'param_name'    => 'counter_align',
                'value'         => array(
                    esc_html__( 'Left', 'cryptronick' )      => 'left',
                    esc_html__( 'Right', 'cryptronick' )      => 'right',
                    esc_html__( 'Center', 'cryptronick' )     => 'center',
                ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
            // Counter Icon/Image heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Icon Type', 'cryptronick'),
                'param_name' => 'h_icon_type',
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Counter Icon/Image
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
                'value' => '#000000',
                'description' => esc_html__('Select icon color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Icon hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Hover Color', 'cryptronick'),
                'param_name' => 'icon_color_hover',
                'description' => esc_html__('Select icon hover color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),    
            // icon/image bg
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('For The Types with Icon Background', 'cryptronick'),
                'param_name' => 'h_icon_bg',
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Custom icon bg size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Background Width', 'cryptronick'),
                'param_name' => 'custom_icon_bg_width',
                'description' => esc_html__( 'Custom width in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Custom icon bg size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Background Height', 'cryptronick'),
                'param_name' => 'custom_icon_bg_height',
                'description' => esc_html__( 'Custom height in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Custom icon bg radius
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Border Radius', 'cryptronick'),
                'param_name' => 'custom_icon_radius',
                'description' => esc_html__( 'Custom radius in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'counter_type',
                    'value' => array('bordered','fill')
                ),
            ),   
            // icon/image border styles
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Border Styles', 'cryptronick'),
                'param_name' => 'h_border_styles',
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'counter_type',
                    'value' => 'bordered'
                ),
            ),
            // Custom icon border width
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Border Width', 'cryptronick'),
                'param_name' => 'border_width',
                'description' => esc_html__( 'Enter border width in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'counter_type',
                    'value' => 'bordered'
                ),
            ),
            // border color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Border Colors', 'cryptronick' ),
                'param_name' => 'custom_border_color',
                'description' => esc_html__( 'Select custom colors', 'cryptronick' ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'counter_type',
                    'value' => 'bordered'
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // border color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Border Color', 'cryptronick'),
                'param_name' => 'border_color',
                'value' => '#000000',
                'description' => esc_html__('Select border color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // border hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Border Hover Color', 'cryptronick'),
                'param_name' => 'border_color_hover',
                'description' => esc_html__('Select border hover color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ), 
            // icon/image bg styles
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Background Styles', 'cryptronick'),
                'param_name' => 'h_bg_styles',
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'counter_type',
                    'value' => array('bordered','fill')
                ),
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
                    'element' => 'counter_type',
                    'value' => array('bordered','fill')
                ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
            ),
            // background color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'cryptronick'),
                'param_name' => 'background_color',
                'value' => '#000000',
                'description' => esc_html__('Select background color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Hover Color', 'cryptronick'),
                'param_name' => 'background_color_hover',
                'description' => esc_html__('Select background hover color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ), 
            // background Gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Start Color', 'cryptronick'),
                'param_name' => 'background_gradient_start',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background End Color', 'cryptronick'),
                'param_name' => 'background_gradient_end',
                'value' => '#000000',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Hover Start Color', 'cryptronick'),
                'param_name' => 'background_gradient_hover_start',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Hover End Color', 'cryptronick'),
                'param_name' => 'background_gradient_hover_end',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // title styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Title Styles', 'cryptronick'),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Counter Title Tag', 'cryptronick' ),
                'param_name'    => 'title_tag',
                'value'         => array(
                    esc_html__( 'Div', 'cryptronick' )    => 'div',
                    esc_html__( 'H2', 'cryptronick' )    => 'h2',
                    esc_html__( 'H3', 'cryptronick' )    => 'h3',
                    esc_html__( 'H4', 'cryptronick' )    => 'h4',
                    esc_html__( 'H5', 'cryptronick' )    => 'h5',
                    esc_html__( 'H6', 'cryptronick' )    => 'h6',
                    esc_html__( 'Span', 'cryptronick' )    => 'span',
                ),
                'std' => 'div',
                'group'         => esc_html__( 'Styling', 'cryptronick' ),
                'description' => esc_html__( 'Choose your tag for counter title', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Counter Title Weight', 'cryptronick' ),
                'param_name'    => 'title_weight',
                'value'         => array(
                    esc_html__( 'Light', 'cryptronick' )    => '300',
                    esc_html__( 'Regular', 'cryptronick' )    => '400',
                    esc_html__( 'SemiBold', 'cryptronick' )    => '600',
                    esc_html__( 'Bold', 'cryptronick' )    => '700',
                ),
                'std' => '400',
                'group'         => esc_html__( 'Styling', 'cryptronick' ),
                'description' => esc_html__( 'Choose your Weight for counter title', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // title Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Size', 'cryptronick'),
                'param_name' => 'title_size',
                'value' => '',
                'description' => esc_html__( 'Enter Counter title font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Title Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for counter title', 'cryptronick' ),
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
            // title color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Title Color', 'cryptronick' ),
                'param_name' => 'custom_title_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'cryptronick'),
                'param_name' => 'title_color',
                'value' => '#000000',
                'description' => esc_html__('Select title color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // counter value styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Counter Value Styles', 'cryptronick'),
                'param_name' => 'h_count_value_styles',
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Counter Value Weight', 'cryptronick' ),
                'param_name'    => 'count_value_weight',
                'value'         => array(
                    esc_html__( 'Light', 'cryptronick' )    => '300',
                    esc_html__( 'Regular', 'cryptronick' )    => '400',
                    esc_html__( 'SemiBold', 'cryptronick' )    => '600',
                    esc_html__( 'Bold', 'cryptronick' )    => '700',
                ),
                'std' => '400',
                'group'         => esc_html__( 'Styling', 'cryptronick' ),
                'description' => esc_html__( 'Choose your Weight for counter value', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // counter value Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Counter Value Font Size', 'cryptronick'),
                'param_name' => 'count_value_size',
                'value' => '',
                'description' => esc_html__( 'Enter Counter counter value font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Counter Value Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for counter value', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_count_value',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_count_value',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_count_value',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),
            // counter value color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Counter Value Color', 'cryptronick' ),
                'param_name' => 'custom_count_value_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // counter value color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Counter Value Color', 'cryptronick'),
                'param_name' => 'count_value_color',
                'value' => '#000000',
                'description' => esc_html__('Select counter value color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_count_value_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_Counter extends WPBakeryShortCode {
        }
    }
}