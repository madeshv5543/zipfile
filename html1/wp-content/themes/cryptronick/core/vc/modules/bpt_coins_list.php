<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}


if (function_exists('vc_map')) {
// Add list item
    $coins_array = array();
    $coins_list = Cryptronick_crypto_data::$coinslist;
    $coins_list = $coins_list->data;

    foreach ($coins_list as $key => $value) {
        $name = $value->name;
        $id = $value->id;
        $coins_array[$name] = $id;
    }

    vc_map(array(
        'name' => esc_html__('Coins List', 'cryptronick'),
        'base' => 'bpt_coins_list',
        'class' => 'cryptronick_coin_list',
        'icon' => 'bpt_ico-mod',
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'content_element' => true,
        'description' => esc_html__('Coin List','cryptronick'),
        'params' => array(
            array(
                'type' => 'cryptronick_dropdown',
                'heading' => esc_html__('Style', 'cryptronick'),
                'param_name' => 'coins_list_style',
                'fields' => array(
                    'scrolling_line' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/coin-scroll.png',
                        'descr' => esc_html__('Scrolling Line', 'cryptronick')),                   
                    'table' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/coin-table.png',
                        'descr' => esc_html__('Table', 'cryptronick')),
                    'big-lable' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/coin-label.png',
                        'descr' => esc_html__('Big Lable', 'cryptronick')),
                ),
                'value' => 'scrolling_line',
            ),
            array(
                'type'          => 'bpt_checkbox',
                'heading' => esc_html__( 'Show Coin Logo', 'cryptronick' ),
                'param_name'    => 'show_coin_logo',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'          => 'bpt_checkbox',
                'heading' => esc_html__( 'Show Changes 1h', 'cryptronick' ),
                'param_name'    => 'show_change_1h',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'          => 'bpt_checkbox',
                'heading' => esc_html__( 'Show Changes 24h', 'cryptronick' ),
                'param_name'    => 'show_change_24h',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'          => 'bpt_checkbox',
                'heading' => esc_html__( 'Show Changes 7d', 'cryptronick' ),
                'param_name'    => 'show_change_7d',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'          => 'bpt_checkbox',
                'heading' => esc_html__( 'Show Capitalization', 'cryptronick' ),
                'param_name'    => 'show_market_cap',
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type'          => 'checkbox',
                'heading' => esc_html__( 'Coins List', 'cryptronick' ),
                'param_name'    => 'coins_list',
                'edit_field_class' => 'vc_col-sm-12 check-list-width',
                'group' => esc_html__( 'Coins List', 'cryptronick' ),
                'value'       => $coins_array,
            ),
            array(
                'type'          => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Style', 'cryptronick' ),
                'param_name'    => 'custom_style',
                'group' => esc_html__( 'Style', 'cryptronick' ),
            ),
            // Text color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Text Color', 'cryptronick'),
                'param_name' => 'text_color',
                'value' => '#000000',
                'description' => esc_html__('Select text color', 'cryptronick'),
                'dependency' => array(
                    'element' => 'custom_style',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Style', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Lable Font Size', 'cryptronick'),
                'param_name' => 'lable_font_size',
                'value' => '16',
                'description' => esc_html__( 'Enter custom Font Size of lable.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'custom_style',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Style', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Text color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'cryptronick'),
                'param_name' => 'big_lable_color',
                'value' => '#ffeb3a',
                'description' => esc_html__('Select background color.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'coins_list_style',
                    'value' => array('big-lable', 'table')
                ),
                'group' => esc_html__( 'Style', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_bpt_coins_list extends WPBakeryShortCode {
            
        }
    } 
}
