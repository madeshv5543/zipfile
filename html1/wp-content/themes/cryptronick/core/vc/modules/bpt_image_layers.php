<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Image Layers', 'cryptronick'),
        'base' => 'bpt_image_layers',
        'class' => 'cryptronick_image_layers',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_image_layers',
        'content_element' => true,
        'description' => esc_html__('Display Image Layers','cryptronick'),
        'params' => array(
            // image styles heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Layers Settings', 'cryptronick'),
                'param_name' => 'h_settings',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'cryptronick' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph', 'cryptronick' ),
                'params' => array(
                    array(
                        'type'          => 'attach_image',
                        'heading'       => esc_html__( 'Thumbnail', 'cryptronick' ),
                        'param_name'    => 'thumbnail',
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Top Offset', 'cryptronick' ),
                        'param_name'    => 'top_offset',
                        'edit_field_class' => 'vc_col-sm-6',
                        'description' => esc_html__( 'Enter offset in %, for example -100% or 100%', 'cryptronick' ),
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Left Offset', 'cryptronick' ),
                        'param_name'    => 'left_offset',
                        'edit_field_class' => 'vc_col-sm-6',
                        'description' => esc_html__( 'Enter offset in %, for example -100% or 100%', 'cryptronick' ),
                    ),          
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Image Animation', 'cryptronick' ),
                        'param_name'    => 'image_animation',
                        'edit_field_class' => 'vc_col-sm-6',
                        'value'         => array(
                            esc_html__( 'Fade In', 'cryptronick' )      => 'fade_in',
                            esc_html__( 'Slide Up', 'cryptronick' )      => 'slide_up',
                            esc_html__( 'Slide Down', 'cryptronick' )     => 'slide_down',
                            esc_html__( 'Slide Left', 'cryptronick' )     => 'slide_left',
                            esc_html__( 'Slide Right', 'cryptronick' )     => 'slide_right',
                            esc_html__( 'Slide Big Up', 'cryptronick' )      => 'slide_big_up',
                            esc_html__( 'Slide Big Down', 'cryptronick' )     => 'slide_big_down',
                            esc_html__( 'Slide Big Left', 'cryptronick' )     => 'slide_big_left',
                            esc_html__( 'Slide Big Right', 'cryptronick' )     => 'slide_big_right',
                            esc_html__( 'Slide Big Right', 'cryptronick' )     => 'slide_big_right',
                            esc_html__( 'Flip Horizontally', 'cryptronick' )     => 'flip_x',
                            esc_html__( 'Flip Vertically', 'cryptronick' )     => 'flip_y',
                            esc_html__( 'Zoom In', 'cryptronick' )     => 'zoom_in',
                        ),
                    ),         
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Image z-index', 'cryptronick' ),
                        'param_name'    => 'image_order',
                        'value'         => '1',
                        'edit_field_class' => 'vc_col-sm-6',
                    ),  
                ),
            ),
            // images interval
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Interval Images Appearing', 'cryptronick'),
                'param_name' => 'interval',
                'value' => '600',
                'description' => esc_html__( 'Enter interval in milliseconds', 'cryptronick' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Transition Speed', 'cryptronick'),
                'param_name' => 'transition',
                'value' => '800',
                'description' => esc_html__( 'Enter transition speed in milliseconds', 'cryptronick' ),
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'cryptronick' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to button.', 'cryptronick')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_Image_Layers extends WPBakeryShortCode {
        }
    }
}
