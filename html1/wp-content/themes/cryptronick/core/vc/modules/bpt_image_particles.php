<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}


if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__('Image Particles', 'cryptronick'),
        'base' => 'bpt_image_particles',
        'class' => 'cryptronick_image_particles',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon',
        'content_element' => true,
        'description' => esc_html__('Image Particles Animation','cryptronick'),
        'params' => array(
            array(
                "type"          => "attach_image",
                "heading"       => esc_html__( 'Thumbnail', 'cryptronick' ),
                "param_name"    => "thumbnail",
                'edit_field_class' => 'vc_col-sm-12',
                'description' => esc_html__('Preferable to select the .png image','cryptronick'),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Image Max Width', 'cryptronick' ),
                "param_name"    => "img_width",
                'edit_field_class' => 'vc_col-sm-12',
                "value"         => "500px",
                'description' => esc_html__('Enter max-width of your image in pixels','cryptronick'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'cryptronick' ),
                'param_name' => 'img_alignment',
                'value'         => array(
                    esc_html__( 'Center', 'cryptronick' )     => 'center',
                    esc_html__( 'Left', 'cryptronick' )     => 'left',
                    esc_html__( 'Right', 'cryptronick' )   => 'right',
                ),
                'description' => esc_html__('Select image alignment.', 'cryptronick')
            ),  
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cryptronick')
            ),
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_image_particles extends WPBakeryShortCode {
            
        }
    } 
}
