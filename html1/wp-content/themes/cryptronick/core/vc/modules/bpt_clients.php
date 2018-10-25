<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Clients', 'cryptronick'),
        'base' => 'bpt_clients',
        'class' => 'cryptronick_clients',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_clients',
        'content_element' => true,
        'description' => esc_html__('Display Clients','cryptronick'),
        'params' => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'cryptronick' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph - thumbnail, quote, author name and author status.', 'cryptronick' ),
                'params' => array(
                    array(
                        "type"          => "attach_image",
                        "heading"       => esc_html__( 'Thumbnail', 'cryptronick' ),
                        "param_name"    => "thumbnail",
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        "type"          => "attach_image",
                        "heading"       => esc_html__( 'Hover Thumbnail', 'cryptronick' ),
                        "param_name"    => "hover_thumbnail",
                        'edit_field_class' => 'vc_col-sm-6 no-top-padding',
                        'description' => esc_html__( 'Work only with Exchange Images animation.', 'cryptronick' ),
                    ),
                    array(
                        'type' => 'bpt_checkbox',
                        'heading' => esc_html__( 'Add Link', 'cryptronick' ),
                        'param_name' => 'add_link',
                        'edit_field_class' => 'vc_col-sm-12',
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Link', 'cryptronick' ),
                        'param_name' => 'link',
                        'description' => esc_html__('Add link to client image.', 'cryptronick'),
                        "dependency"    => array(
                            "element"   => "add_link",
                            "value" => 'true'
                        ),
                    ),
                ),
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Clients Grid', 'cryptronick' ),
                "param_name"    => "item_grid",
                "value"         => array(
                    esc_html__( 'One Column', 'cryptronick' )    => '1',
                    esc_html__( 'Two Columns', 'cryptronick' )   => '2',
                    esc_html__( 'Three Columns', 'cryptronick' ) => '3',
                    esc_html__( 'Four Columns', 'cryptronick' )  => '4',
                    esc_html__( 'Five Columns', 'cryptronick' )  => '5',
                    esc_html__( 'Six Columns', 'cryptronick' )  => '6',
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'std' => '4'        
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Clients Animation for each Image', 'cryptronick' ),
                "param_name"    => "item_anim",
                "value"         => array(
                    esc_html__( 'Zoom', 'cryptronick' )    => 'zoom',
                    esc_html__( 'Opacity', 'cryptronick' )    => 'opacity',
                    esc_html__( 'Grayscale', 'cryptronick' )   => 'grayscale',
                    esc_html__( 'Contrast', 'cryptronick' ) => 'contrast',
                    esc_html__( 'Blur', 'cryptronick' ) => 'blur',
                    esc_html__( 'Invert', 'cryptronick' ) => 'invert',
                    esc_html__( 'Exchange Images', 'cryptronick' ) => 'ex_images',
                ),       
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
            // carousel heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Add Carousel for Clients Items', 'cryptronick'),
                'param_name' => 'h_carousel',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                "type"          => "bpt_checkbox",
                'heading' => esc_html__( 'Use Carousel', 'cryptronick' ),
                "param_name"    => "use_carousel",
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
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
            // carousel pagination heading
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
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_Clients extends WPBakeryShortCode {
        }
    }
}
