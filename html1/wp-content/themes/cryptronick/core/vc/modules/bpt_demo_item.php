<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}


if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__('Demo Item', 'cryptronick'),
        'base' => 'bpt_demo_item',
        'class' => 'cryptronick_demo_item',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_demo',
        'content_element' => true,
        'description' => esc_html__('Demo Item','cryptronick'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'cryptronick'),
                'param_name' => 'di_title',
                'admin_label' => true,
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle', 'cryptronick'),
                'param_name' => 'di_subtitle',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Image', 'cryptronick'),
                'param_name' => 'di_image',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'cryptronick' ),
            ), 
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Coming Soon', 'cryptronick' ),
                'param_name' => 'coming_soon',
            ), 
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Button', 'cryptronick' ),
                'param_name' => 'add_button',
                'dependency' => array(
                    'element' => 'coming_soon',
                    "is_empty" => true
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Title', 'cryptronick'),
                'param_name' => 'di_button_title',
                'dependency' => array(
                    'element' => 'add_button',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'cryptronick' ),
                'param_name' => 'di_link',
                'description' => esc_html__('Add link to image.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'add_button',
                    'value' => 'true'
                ),
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
        class WPBakeryShortCode_bpt_Demo_Item extends WPBakeryShortCode {
            
        }
    } 
}
