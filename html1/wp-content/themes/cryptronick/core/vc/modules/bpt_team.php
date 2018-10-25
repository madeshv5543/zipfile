<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');
$header_font = Cryptronick_Theme_Helper::get_option('header-font');

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'bpt_team',
        'name' => esc_html__('Team', 'cryptronick'),
        'description' => esc_html__('Display team members', 'cryptronick'),
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_team',
        'params' => array(
            array(
                'type' => 'loop',
                'heading' => esc_html__('Team Items', 'cryptronick'),
                'param_name' => 'build_query',
                'settings' => array(
                    'size' => array('hidden' => false, 'value' => 4 * 3),
                    'order_by' => array('value' => 'date'),
                    'post_type' => array('value' => 'team', 'hidden' => true),
                    'categories' => array('hidden' => true),
                    'tags' => array('hidden' => true),
                ),
                'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'cryptronick')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items Per Line', 'cryptronick'),
                'param_name' => 'posts_per_line',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-4',
                'value' => array(
                    esc_html__('One', 'cryptronick') => '1',
                    esc_html__('Two', 'cryptronick') => '2',
                    esc_html__('Three', 'cryptronick') => '3',
                    esc_html__('Four', 'cryptronick') => '4',
                    esc_html__('Five', 'cryptronick') => '5',
                ),
                'std' => '4'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Team Info Alignment', 'cryptronick'),
                'param_name' => 'info_align',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-4',
                'value' => array(
                    esc_html__('Left', 'cryptronick') => 'left',
                    esc_html__('Right', 'cryptronick') => 'right',
                    esc_html__('Center', 'cryptronick') => 'center',
                ),
                'std' => 'center',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Grid Gap', 'cryptronick'),
                'param_name' => 'grid_gap',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-4',
                'value' => array(
                    esc_html__('0', 'cryptronick') => '0',
                    esc_html__('2', 'cryptronick') => '2',
                    esc_html__('4', 'cryptronick') => '4',
                    esc_html__('6', 'cryptronick') => '6',
                    esc_html__('10', 'cryptronick') => '10',
                    esc_html__('20', 'cryptronick') => '20',
                    esc_html__('30', 'cryptronick') => '30',
                ),
                'std' => '30',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Single Link', 'cryptronick' ),
                'param_name' => 'single_link',
                'edit_field_class' => 'vc_col-sm-4',
                'std' => 'true',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Shadow', 'cryptronick' ),
                'param_name' => 'add_shadow',
                'edit_field_class' => 'vc_col-sm-4',
                'std' => 'true',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Grayscale Filter', 'cryptronick' ),
                'param_name' => 'add_grayscale',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Hide Meta', 'cryptronick'),
                'param_name' => 'h_hide_meta',
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Hide Title', 'cryptronick' ),
                'param_name' => 'hide_title',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Hide Department', 'cryptronick' ),
                'param_name' => 'hide_department',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Hide Social Icons', 'cryptronick' ),
                'param_name' => 'hide_soc_icons',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Add Carousel for Team Items', 'cryptronick'),
                'param_name' => 'h_add_carousel',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                "group" => esc_html__( "Carousel", 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Carousel', 'cryptronick' ),
                'param_name' => 'use_carousel',
                'edit_field_class' => 'vc_col-sm-4',
                "group" => esc_html__( "Carousel", 'cryptronick' ),
            ),
            array(
                "type"          => "bpt_checkbox",
                'heading' => esc_html__( 'Autoplay', 'cryptronick' ),
                "param_name"    => "autoplay",
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Autoplay Speed', 'cryptronick' ),
                "param_name"    => "autoplay_speed",
                "dependency"    => array(
                    "element"   => "autoplay",
                    "value" => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-4',
                "value"         => "3000",
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            array(
                "type"          => "bpt_checkbox",
                'heading' => esc_html__( 'Multiple Items', 'cryptronick' ),
                "param_name"    => "multiple_items",
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            array(
                "type"          => "bpt_checkbox",
                'heading' => esc_html__( 'Scroll Items', 'cryptronick' ),
                "param_name"    => "scroll_items",
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            // carousel pagination heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Pagination Controls', 'cryptronick'),
                'param_name' => 'h_pag_controls',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'cryptronick' ),
                'param_name' => 'use_pagination',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
            ),
            array(
                'type' => 'cryptronick_dropdown',
                'heading' => esc_html__('Pagination Type', 'cryptronick'),
                'param_name' => 'pag_type',
                'fields' => array(
                    'circle' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/pag_circle.png',
                        'descr' => esc_html__('Circle', 'cryptronick')),
                    'square' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/pag_square.png',
                        'descr' => esc_html__('Square', 'cryptronick')),
                    'line' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/pag_line.png',
                        'descr' => esc_html__('Line', 'cryptronick')),
                    'line_circle' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/pag_line_circle.png',
                        'descr' => esc_html__('Line - Circle', 'cryptronick')),
                ),
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'value' => 'circle',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'cryptronick' ),
                'param_name' => 'pag_offset',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
                'description' => esc_html__( 'Enter pagination top offset in pixels.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'cryptronick' ),
                'param_name' => 'custom_pag_color',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Pagination Color', 'cryptronick'),
                'param_name' => 'pag_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // carousel arrows heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Arrows Controls', 'cryptronick'),
                'param_name' => 'h_arrow_control',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Arrows control', 'cryptronick' ),
                'param_name' => 'use_prev_next',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Arrows Color', 'cryptronick' ),
                'param_name' => 'custom_buttons_color',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Arrows Color', 'cryptronick'),
                'param_name' => 'buttons_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_buttons_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // carousel responsive heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Responsive', 'cryptronick'),
                'param_name' => 'h_resp',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'cryptronick' ),
                'param_name' => 'custom_resp',
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            // medium desktop
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Medium Desktop', 'cryptronick'),
                'param_name' => 'h_resp_medium',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'cryptronick' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'cryptronick' ),
                'param_name' => 'resp_medium_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            
            // tablets
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Tablets', 'cryptronick'),
                'param_name' => 'h_resp_tablets',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'cryptronick' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'cryptronick' ),
                'param_name' => 'resp_tablets_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            // mobile phones
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Mobile Phones', 'cryptronick'),
                'param_name' => 'h_resp_mobile',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'cryptronick' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'cryptronick' ),
                'param_name' => 'resp_mobile_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Background Styles', 'cryptronick'),
                'param_name' => 'h_bg_styles',
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'dependency' => array(
                    'element' => 'ib_type',
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
                    'element' => 'ib_type',
                    'value' => array('bordered','fill')
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
            ),
            // background color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'cryptronick'),
                'param_name' => 'background_color',
                'value' => '#00002b',
                'description' => esc_html__('Select background color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Hover Color', 'cryptronick'),
                'param_name' => 'background_color_hover',
                'value' => '#00002b',
                'description' => esc_html__('Select background hover color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ), 
            // background Gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Start Color', 'cryptronick'),
                'param_name' => 'background_gradient_start',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background End Color', 'cryptronick'),
                'param_name' => 'background_gradient_end',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Hover Start Color', 'cryptronick'),
                'param_name' => 'background_gradient_hover_start',
                'value' => $theme_gradient['from'],
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Hover End Color', 'cryptronick'),
                'param_name' => 'background_gradient_hover_end',
                'value' => $theme_gradient['to'],
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // title styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Title Colors', 'cryptronick'),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // title color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Title Color', 'cryptronick' ),
                'param_name' => 'custom_title_color',
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'cryptronick'),
                'param_name' => 'title_color',
                'value' => $header_font['color'],
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Hover Color', 'cryptronick'),
                'param_name' => 'title_hover_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // title styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Department Colors', 'cryptronick'),
                'param_name' => 'h_depart_styles',
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // title color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Color', 'cryptronick' ),
                'param_name' => 'custom_depart_color',
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Department Color', 'cryptronick'),
                'param_name' => 'depart_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_depart_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Department Hover Color', 'cryptronick'),
                'param_name' => 'depart_hover_color',
                'value' => 'rgba(255,255,255,0.8)',
                'dependency' => array(
                    'element' => 'custom_depart_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // title styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Social Icons Colors', 'cryptronick'),
                'param_name' => 'h_soc_styles',
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // title color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Color', 'cryptronick' ),
                'param_name' => 'custom_soc_color',
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Social Icons Color', 'cryptronick'),
                'param_name' => 'soc_color',
                'value' => '#b6c2db',
                'dependency' => array(
                    'element' => 'custom_soc_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Social Icons Hover Color', 'cryptronick'),
                'param_name' => 'soc_hover_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_soc_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // become a member
            // array(
            //     'type' => 'cryptronick_param_heading',
            //     'heading' => esc_html__('Become a Member Item', 'cryptronick'),
            //     'param_name' => 'h_become',
            //     'group' => esc_html__( 'Join Us', 'cryptronick' ),
            //     'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            //     'dependency' => array(
            //         'element' => 'under_image',
            //         "is_empty" => true
            //     ),
            // ),
            // array(
            //     'type' => 'bpt_checkbox',
            //     'heading' => esc_html__( 'Add Member Item', 'cryptronick' ),
            //     'param_name' => 'add_member',
            //     'edit_field_class' => 'vc_col-sm-12',
            //     'description' => esc_html__( 'Add to list of team members the last item "join us" with a link to action.', 'cryptronick' ),
            //     'group' => esc_html__( 'Join Us', 'cryptronick' ),
            //     'dependency' => array(
            //         'element' => 'under_image',
            //         "is_empty" => true
            //     ),
            // ),
            // array(
            //     'type' => 'attach_image',
            //     'heading' => esc_html__('Image', 'cryptronick'),
            //     'param_name' => 'member_image',
            //     'value' => '',
            //     'description' => esc_html__( 'Select image from media library.', 'cryptronick' ),
            //     'dependency' => array(
            //         'element' => 'add_member',
            //         'value' => 'true',
            //     ),
            //     'group' => esc_html__( 'Join Us', 'cryptronick' ),
            // ),
            // array(
            //     'type' => 'vc_link',
            //     'heading' => esc_html__( 'Link', 'cryptronick' ),
            //     'param_name' => 'member_link',
            //     'description' => esc_html__('Add link to member item.', 'cryptronick'),
            //     'dependency' => array(
            //         'element' => 'add_member',
            //         'value' => 'true',
            //     ),
            //     'group' => esc_html__( 'Join Us', 'cryptronick' ),
            // ),
        )
    ));

    class WPBakeryShortCode_bpt_Team extends WPBakeryShortCode
    {
    }
}