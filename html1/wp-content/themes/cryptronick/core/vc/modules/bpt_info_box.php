<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');

add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
    wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
}

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__('Info Box', 'cryptronick'),
        'base' => 'bpt_info_box',
        'class' => 'cryptronick_info_box',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_info_box',
        'content_element' => true,
        'description' => esc_html__('Info Box','cryptronick'),
        'params' => array(
            array(
                'type' => 'cryptronick_dropdown',
                'heading' => esc_html__('Info Box Type', 'cryptronick'),
                'param_name' => 'ib_type',
                'fields' => array(
                    'default' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/type_def.png',
                        'descr' => esc_html__('Default', 'cryptronick')),
                    'full_size' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/type_full_width.png',
                        'descr' => esc_html__('Full Size', 'cryptronick')),
                    'bordered' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/type_bordered.png',
                        'descr' => esc_html__('Bordered', 'cryptronick')),
                    'fill' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/type_fill.png',
                        'descr' => esc_html__('Fill', 'cryptronick')),
                    'tile' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/type_tile.png',
                        'descr' => esc_html__('Tile', 'cryptronick')),
                ),
                'value' => 'default',
            ),
            array(
                'type' => 'cryptronick_dropdown',
                'heading' => esc_html__('Info Box Layout', 'cryptronick'),
                'param_name' => 'ib_layout',
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
                    'element' => 'ib_type',
                    'value' => array('default', 'bordered', 'fill', 'tile')
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Alignment', 'cryptronick' ),
                'param_name'    => 'ib_align',
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
            // Info Box Content
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Info Box Title', 'cryptronick'),
                'param_name' => 'ib_title',
                'admin_label' => true,
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Info Box Subtitle', 'cryptronick'),
                'param_name' => 'ib_subtitle',
                'admin_label' => true,
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Info Box Text', 'cryptronick'),
                'param_name' => 'ib_content',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Read More Button', 'cryptronick' ),
                'param_name' => 'add_read_more',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Read More Button Text', 'cryptronick'),
                'param_name' => 'read_more_text',
                'value' => esc_html__('Read More', 'cryptronick'),
                'group' => esc_html__( 'Content', 'cryptronick' ),
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
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Top Offset', 'cryptronick' ),
                'param_name' => 'add_read_more_offset',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Top Offset', 'cryptronick'),
                'param_name' => 'read_more_offset',
                'value' => '',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'add_read_more_offset',
                    'value' => 'true'
                ),
                'description' => esc_html__('Add top offset to read more button in pixels.', 'cryptronick'),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            // Info Box Icon/Image heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Icon Type', 'cryptronick'),
                'param_name' => 'h_icon_type',
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Info Box Icon/Image
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
                    'type' => 'fontawesome',
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
                'value' => '#000000',
                'description' => esc_html__('Select icon hover color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // icon/image number
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Icon Number', 'cryptronick'),
                'param_name' => 'h_icon_number',
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('font','image'),
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Number', 'cryptronick' ),
                'param_name' => 'add_number',
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('font','image'),
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Icon Number', 'cryptronick'),
                'param_name' => 'icon_number',
                'value' => '01',
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'add_number',
                    'value' => 'true',
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading' => esc_html__('Number Position', 'cryptronick'),
                'param_name'    => 'number_pos',
                'value'         => array(
                    esc_html__( 'Left Top Corner', 'cryptronick' )      => 'left_top',
                    esc_html__( 'Right Top Corner', 'cryptronick' )      => 'right_top',
                    esc_html__( 'Left Bottom Corner', 'cryptronick' )     => 'left_bottom',
                    esc_html__( 'Right Bottom Corner', 'cryptronick' )     => 'right_bottom',
                ),
                'dependency' => array(
                    'element' => 'add_number',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Icon', 'cryptronick' ),
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
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Custom icon bg size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Background Height', 'cryptronick'),
                'param_name' => 'custom_icon_bg_height',
                'description' => esc_html__( 'Custom height in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Custom icon bg offsets
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Bottom Offset', 'cryptronick'),
                'param_name' => 'custom_icon_bot_offset',
                'description' => esc_html__( 'Custom offset in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),  
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Side Offset', 'cryptronick'),
                'param_name' => 'custom_icon_side_offset',
                'description' => esc_html__( 'It works only with layout left or right', 'cryptronick' ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'ib_layout',
                    'value' => array('left','right','top_left','top_right'),
                ),
            ),  
            // Custom icon bg radius
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Border Radius', 'cryptronick'),
                'param_name' => 'custom_icon_radius',
                'description' => esc_html__( 'Custom radius in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'ib_type',
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
                    'element' => 'ib_type',
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
                    'element' => 'ib_type',
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
                    'element' => 'ib_type',
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
                'value' => '#000000',
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
                'value' => '#000000',
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
                'value' => '#000000',
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
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Background Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // tile background
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Customize Tile Colors', 'cryptronick'),
                'param_name' => 'h_tile_colors',
                'group' => esc_html__( 'Tile Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'dependency' => array(
                    'element' => 'ib_type',
                    'value' => 'tile'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Colors', 'cryptronick' ),
                'param_name' => 'custom_tile_colors',
                'group' => esc_html__( 'Tile Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'ib_type',
                    'value' => 'tile'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Shadow', 'cryptronick' ),
                'param_name' => 'tile_shadow',
                'std' => 'true',
                'group' => esc_html__( 'Tile Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'ib_type',
                    'value' => 'tile'
                ),
            ),
            // tile hover content colors
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Tile Hover Content', 'cryptronick'),
                'param_name' => 'tile_content_color_hover',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_tile_colors',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Tile Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Background color/gradient
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Background Customize Colors', 'cryptronick' ),
                'param_name'    => 'tile_bg_color_type',
                'value'         => array(
                    esc_html__( 'Default', 'cryptronick' )      => 'def',
                    esc_html__( 'Color', 'cryptronick' )      => 'color',
                    esc_html__( 'Gradient', 'cryptronick' )     => 'gradient',
                ),
                'dependency' => array(
                    'element' => 'custom_tile_colors',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Tile Background', 'cryptronick' ),
            ),
            // background color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'cryptronick'),
                'param_name' => 'tile_bg_color',
                'value' => '#ffffff',
                'description' => esc_html__('Select background color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'tile_bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Tile Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Hover Color', 'cryptronick'),
                'param_name' => 'tile_bg_color_hover',
                'value' => $theme_color,
                'description' => esc_html__('Select background hover color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'tile_bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Tile Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ), 
            // background Gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Start Color', 'cryptronick'),
                'param_name' => 'tile_bg_gradient_start',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'tile_bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Tile Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background End Color', 'cryptronick'),
                'param_name' => 'tile_bg_gradient_end',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'tile_bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Tile Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Hover Start Color', 'cryptronick'),
                'param_name' => 'tile_bg_gradient_hover_start',
                'value' => $theme_gradient['from'],
                'dependency' => array(
                    'element' => 'tile_bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Tile Background', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // background Gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Hover End Color', 'cryptronick'),
                'param_name' => 'tile_bg_gradient_hover_end',
                'value' => $theme_gradient['to'],
                'dependency' => array(
                    'element' => 'tile_bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Tile Background', 'cryptronick' ),
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
                'heading'       => esc_html__( 'Title Tag', 'cryptronick' ),
                'param_name'    => 'title_tag',
                'value'         => array(
                    esc_html__( 'Span', 'cryptronick' )    => 'span',
                    esc_html__( 'Div', 'cryptronick' )    => 'div',
                    esc_html__( 'H2', 'cryptronick' )    => 'h2',
                    esc_html__( 'H3', 'cryptronick' )    => 'h3',
                    esc_html__( 'H4', 'cryptronick' )    => 'h4',
                    esc_html__( 'H5', 'cryptronick' )    => 'h5',
                    esc_html__( 'H6', 'cryptronick' )    => 'h6',
                ),
                'std' => 'h3',
                'group'         => esc_html__( 'Styling', 'cryptronick' ),
                'description' => esc_html__( 'Choose your tag for info box title', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // title Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Size', 'cryptronick'),
                'param_name' => 'title_size',
                'value' => '',
                'description' => esc_html__( 'Enter Info Box title font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // title Font Weight
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Weight', 'cryptronick'),
                'param_name' => 'title_weight',
                'value' => '',
                'description' => esc_html__( 'Enter Info Box title font-weight.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Title Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for info box title', 'cryptronick' ),
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
            // subtitle styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Subtitle Styles', 'cryptronick'),
                'param_name' => 'h_subtitle_styles',
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Subtitle Tag', 'cryptronick' ),
                'param_name'    => 'subtitle_tag',
                'value'         => array(
                    esc_html__( 'Span', 'cryptronick' )    => 'span',
                    esc_html__( 'Div', 'cryptronick' )    => 'div',
                    esc_html__( 'H2', 'cryptronick' )    => 'h2',
                    esc_html__( 'H3', 'cryptronick' )    => 'h3',
                    esc_html__( 'H4', 'cryptronick' )    => 'h4',
                    esc_html__( 'H5', 'cryptronick' )    => 'h5',
                    esc_html__( 'H6', 'cryptronick' )    => 'h6',
                ),
                'std' => 'span',
                'group'         => esc_html__( 'Styling', 'cryptronick' ),
                'description' => esc_html__( 'Choose your tag for info box subtitle', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // subtitle Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle Font Size', 'cryptronick'),
                'param_name' => 'subtitle_size',
                'value' => '',
                'description' => esc_html__( 'Enter Info Box subtitle font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Subtitle Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for info box subtitle', 'cryptronick' ),
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
            // subtitle color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Subtitle Color', 'cryptronick' ),
                'param_name' => 'custom_subtitle_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // subtitle color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Subtitle Color', 'cryptronick'),
                'param_name' => 'subtitle_color',
                'value' => '#000000',
                'description' => esc_html__('Select subtitle color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_subtitle_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // content styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Content Styles', 'cryptronick'),
                'param_name' => 'h_content_styles',
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Content Tag', 'cryptronick' ),
                'param_name'    => 'content_tag',
                'value'         => array(
                    esc_html__( 'Span', 'cryptronick' )    => 'span',
                    esc_html__( 'Div', 'cryptronick' )    => 'div',
                    esc_html__( 'H2', 'cryptronick' )    => 'h2',
                    esc_html__( 'H3', 'cryptronick' )    => 'h3',
                    esc_html__( 'H4', 'cryptronick' )    => 'h4',
                    esc_html__( 'H5', 'cryptronick' )    => 'h5',
                    esc_html__( 'H6', 'cryptronick' )    => 'h6',
                ),
                'std' => 'div',
                'group'         => esc_html__( 'Styling', 'cryptronick' ),
                'description' => esc_html__( 'Choose your tag for info box content', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // content Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Font Size', 'cryptronick'),
                'param_name' => 'content_size',
                'value' => '',
                'description' => esc_html__( 'Enter Info Box content font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Content Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for info box content', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_content',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_content',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_content',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),
            // content color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Content Color', 'cryptronick' ),
                'param_name' => 'custom_content_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // content color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Content Color', 'cryptronick'),
                'param_name' => 'content_color',
                'value' => '#000000',
                'description' => esc_html__('Select content color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_content_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // button styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Button Styles', 'cryptronick'),
                'param_name' => 'h_button_styles',
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            // button Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Font Size', 'cryptronick'),
                'param_name' => 'button_size',
                'value' => '',
                'description' => esc_html__( 'Enter Info Box button font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            // Button Fonts
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for info box button', 'cryptronick' ),
                'param_name' => 'use_theme_fonts_button',
                'description' => esc_html__( 'Customize font family', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
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
                'group' => esc_html__( 'Styling', 'cryptronick' ),
            ),
            // button color checkbox
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Button Color', 'cryptronick' ),
                'param_name' => 'custom_button_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            // button color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button Color', 'cryptronick'),
                'param_name' => 'button_color',
                'value' => '#000000',
                'description' => esc_html__('Select button color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_button_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // button hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button Hover Color', 'cryptronick'),
                'param_name' => 'button_color_hover',
                'value' => '#000000',
                'description' => esc_html__('Select button hover color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_button_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styling', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_info_box extends WPBakeryShortCode {
            
        }
    } 
}
