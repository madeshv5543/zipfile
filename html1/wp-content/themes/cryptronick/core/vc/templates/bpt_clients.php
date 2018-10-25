<?php

    $defaults = array(
        // General
        'values' => '',
        'item_grid' => '4',
        'item_anim' => 'zoom',
        'item_el_class' => '',
        // Carousel
        'use_carousel' => false,
        'autoplay' => false,
        'autoplay_speed' => '3000',
        'custom_resp' => false,
        'resp_medium' => '1025',
        'resp_medium_slides' => '',
        'resp_tablets' => '800',
        'resp_tablets_slides' => '',
        'resp_mobile' => '480',
        'resp_mobile_slides' => '',
    );

    $atts = vc_shortcode_attribute_parse($defaults, $atts);
    extract($atts);

    $compile = $content = $clients_wrap_classes = $animation_class = '';

    if ((bool)$use_carousel) {
        // carousel options array
        $carousel_options_arr = array(
            'posts_per_line' => $item_grid,
            'autoplay_carousel' => $autoplay,
            'slider_speed' => $autoplay_speed,
            'use_pagination' => false,
            'custom_resp' => $custom_resp,
            'resp_medium' => $resp_medium,
            'resp_medium_slides' => $resp_medium_slides,
            'resp_tablets' => $resp_tablets,
            'resp_tablets_slides' => $resp_tablets_slides,
            'resp_mobile' => $resp_mobile,
            'resp_mobile_slides' => $resp_mobile_slides,
            'multiple_items' => true,
            'scroll_items' => true,
        );

        // carousel options
        $carousel_options = array_map(function($k, $v) { return "$k=\"$v\" "; }, array_keys($carousel_options_arr), $carousel_options_arr);
        $carousel_options = implode('', $carousel_options);

        wp_enqueue_script('cryptronick-slick', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);
    }

    // Animation
    if (!empty($atts['css_animation'])) {
        $animation_class = $this->getCSSAnimation( $atts['css_animation'] );
    }

    // clients wrapper classes
    $clients_wrap_classes .= !(bool)$use_carousel ? ' items-'.$item_grid : '';
    $clients_wrap_classes .= ' item_anim-'.$item_anim;
    $clients_wrap_classes .= !empty($animation_class) ? ' '.$animation_class : '';
    $clients_wrap_classes .= !empty($item_el_class) ? ' '.$item_el_class : '';

    $values = (array) vc_param_group_parse_atts( $values );
    $item_data = array();
    foreach ( $values as $data ) {
        $new_data = $data;
        $new_data['thumbnail'] = isset( $data['thumbnail'] ) ? $data['thumbnail'] : '';
        $new_data['hover_thumbnail'] = isset( $data['hover_thumbnail'] ) ? $data['hover_thumbnail'] : '';
        $new_data['add_link'] = isset( $data['add_link'] ) ? $data['add_link'] : '';
        $new_data['link'] = isset( $data['link'] ) ? $data['link'] : '#';

        $item_data[] = $new_data;
    }

    foreach ( $item_data as $item_d ) {
        $img_alt = get_post_meta($item_d['thumbnail'], '_wp_attachment_image_alt', true);
        $hover_img_alt = get_post_meta($item_d['hover_thumbnail'], '_wp_attachment_image_alt', true);
        $link_temp = vc_build_link($item_d['link']);
        $url = $link_temp['url'];
        $link_title = $link_temp['title'];
        $target = $link_temp['target'];
        $featured_image = wp_get_attachment_image_src($item_d['thumbnail'], 'full');
        $hover_image = wp_get_attachment_image_src($item_d['hover_thumbnail'], 'full');

        // image html
        $content .='<div class="clients_image">';
            $content .= (bool)$item_d['add_link'] ? '<a href="'.(!empty($url) ? $url : '#').'">' : '<div>';
                $content .= '<img class="main_image" src="'. $featured_image[0] .'" alt="'.(!empty($img_alt) ? $img_alt : '').'" />';
                $content .= ($item_anim == 'ex_images') ? '<img class="hover_image" src="'. $hover_image[0] .'" alt="'.(!empty($hover_img_alt) ? $hover_img_alt : '').'" />' : '';
            $content .= (bool)$item_d['add_link'] ? '</a>' : '</div>';
        $content .= '</div>';

    }

    $compile .= '<div class="cryptronick_module_clients clearfix'.esc_attr($clients_wrap_classes).'">';
        if ((bool)$use_carousel) {
            $compile .= do_shortcode('[bpt_carousel '.$carousel_options.']'.$content.'[/bpt_carousel]');
        } else{
            $compile .= $content;
        }
    $compile .= '</div>';

    echo sprintf("%s", $compile);

?>