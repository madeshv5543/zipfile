<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}


if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__('Earth', 'cryptronick'),
        'base' => 'bpt_earth',
        'class' => 'cryptronick_spacing',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_earth',
        'content_element' => true,
        'description' => esc_html__('Earth moving','cryptronick'),
        'params' => array(
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Sphere', 'cryptronick'),
                'param_name' => 'figure_color',
                'value' => '#ffffff',
                'description' => esc_html__('Select sphere color', 'cryptronick'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Sphere Width', 'cryptronick'),
                'param_name' => 'width',
                'value' => '750',
                'description' => esc_html__( 'Enter size of sphere in px.', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'param_name' => 'add_second_sphere',                    
                'heading' => esc_html__( 'Add Inside Second Sphere', 'cryptronick' ),
            ),   
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_earth extends WPBakeryShortCode {
            
        }
    } 
}