<?php

    include_once get_template_directory() . '/core/vc/templates/bpt_google_fonts_render.php';

    $theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));

    $defaults = array(
        // General
        'item_type' => 'default',
        'item_grid' => '1',
        'item_align' => 'center',
        'item_el_class' => '',
        // Item
        'values' => '',
        'custom_img_width' => '',
        'custom_img_height' => '',
        'custom_img_radius' => '',
        // Carousel
        'use_carousel' => false,
        'autoplay' => false,
        'autoplay_speed' => '3000',
        'use_pagination' => true,
        'pag_type' => 'circle',
        'pag_offset' => '',
        'pag_align' => 'center',
        'custom_pag_color' => false,
        'pag_color' => $theme_color,
        'custom_resp' => false,
        'resp_medium' => '1025',
        'resp_medium_slides' => '',
        'resp_tablets' => '800',
        'resp_tablets_slides' => '',
        'resp_mobile' => '480',
        'resp_mobile_slides' => '',
        // Typography
        'quote_tag' => 'div',
        'quote_size' => '',
        'custom_quote_color' => false,
        'quote_color' => '#000000',
        'name_tag' => 'h3',
        'name_size' => '',
        'custom_name_color' => false,
        'name_color' => '#000000',
        'status_tag' => 'span',
        'status_size' => '',
        'custom_status_color' => false,
        'status_color' => '#000000',
    );

    $atts = vc_shortcode_attribute_parse($defaults, $atts);
    extract($atts);

    if ((bool)$use_carousel) {
        // carousel options array
        $carousel_options_arr = array(
            'posts_per_line' => $item_grid,
            'autoplay_carousel' => $autoplay,
            'slider_speed' => $autoplay_speed,
            'use_pagination' => $use_pagination,
            'pag_type' => $pag_type,
            'pag_offset' => $pag_offset,
            'pag_align' => $pag_align,
            'custom_pag_color' => $custom_pag_color,
            'pag_color' => $pag_color,
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

    $compile = $content = $style = $testimonials_id = $testimonials_attr = $testimonials_wrap_classes = $animation_class = '';
    $testimonials_image = $testimonials_name = $testimonials_status = $testimonials_quote = '';

    if ((bool)$custom_quote_color || (bool)$custom_name_color || (bool)$custom_status_color) {
        $testimonials_id = uniqid( "cryptronick_testimonials_" );
        $testimonials_attr = 'id='.$testimonials_id;
    }

    switch ($item_grid) {
        case '4':
            $col = 3;
            break;
        case '3':
            $col = 4;
            break;
        case '2':
            $col = 6;
            break;
        case '1':
            $col = 12;
            break;  
    }

    // custom testimonials colors
    ob_start();
        if ((bool)$custom_name_color) {
            echo "#$testimonials_id .testimonials_name{
                color: ".(!empty($name_color) ? esc_html($name_color) : 'transparent').";
            }";
        }
        if ((bool)$custom_quote_color) {
            echo "#$testimonials_id .testimonials_quote{
                color: ".(!empty($quote_color) ? esc_html($quote_color) : 'transparent').";
            }";
        }
        if ((bool)$custom_status_color) {
            echo "#$testimonials_id .testimonials_status{
                color: ".(!empty($status_color) ? esc_html($status_color) : 'transparent').";
            }";
        }
    $styles = ob_get_clean();
    Cryptronick_shortcode_css()->enqueue_cryptronick_css($styles);

    // Animation
    if (!empty($atts['css_animation'])) {
        $animation_class = $this->getCSSAnimation( $atts['css_animation'] );
    }

    // testimonials wrapper classes
    $testimonials_wrap_classes .= ' type_'.$item_type;
    $testimonials_wrap_classes .= ' item_alignment_'.$item_align;
    $testimonials_wrap_classes .= $animation_class;
    $testimonials_wrap_classes .= !empty($item_el_class) ? ' '.$item_el_class : '';

    // Render Google Fonts
    $obj = new GoogleFontsRender();
    extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_name', 'google_fonts_status', 'google_fonts_quote') ) );
    $name_font = (!empty($styles_google_fonts_name)) ? esc_attr($styles_google_fonts_name) : '';
    $status_font = (!empty($styles_google_fonts_status)) ? esc_attr($styles_google_fonts_status) : '';
    $quote_font = (!empty($styles_google_fonts_quote)) ? esc_attr($styles_google_fonts_quote) : '';

    // font sizes
    $name_font_size = ($name_size != '') ? 'font-size:'.(int)$name_size.'px; ' : '';
    $status_font_size = ($status_size != '') ? 'font-size:'.(int)$status_size.'px; ' : '';
    $quote_font_size = ($quote_size != '') ? 'font-size:'.(int)$quote_size.'px; ' : '';
    // image border radius
    $image_radius = ($custom_img_radius != '') ? 'border-radius:'.(int)$custom_img_radius.'px; ' : '';

    // name, status, quote styles
    $name_styles = (!empty($name_font_size) || !empty($name_font)) ? 'style="'.esc_attr($name_font_size).$name_font.'"' : '';
    $status_styles = (!empty($status_font_size) || !empty($status_font)) ? 'style="'.esc_attr($status_font_size).$status_font.'"' : '';
    $quote_styles = (!empty($quote_font_size) || !empty($quote_font)) ? 'style="'.esc_attr($quote_font_size).$quote_font.'"' : '';

    // image styles
    $image_width_crop = ($custom_img_width != '') ? $custom_img_width*2 : '140';
    $image_height_crop = ($custom_img_height != '') ? $custom_img_height*2 : '140';
    $image_width = ($custom_img_width != '') ? 'width:'.(int)$custom_img_width.'px; ' : 'width:70px; ';
    $image_height = ($custom_img_height != '') ? 'height:'.(int)$custom_img_height.'px; ' : 'height:70px; ';
    $testimonials_img_style = (!empty($image_width) || !empty($image_height) || !empty($image_radius))  ? 'style="'.$image_width.$image_height.$image_radius.'"' : '';
    // \image styles

    $values = (array) vc_param_group_parse_atts( $values );
    $item_data = array();
    foreach ( $values as $data ) {
        $new_data = $data;
        $new_data['thumbnail'] = isset( $data['thumbnail'] ) ? $data['thumbnail'] : '';
        $new_data['quote'] = isset( $data['quote'] ) ? $data['quote'] : '';
        $new_data['author_name'] = isset( $data['author_name'] ) ? $data['author_name'] : '';
        $new_data['author_status'] = isset( $data['author_status'] ) ? $data['author_status'] : '';

        $item_data[] = $new_data;
    }

    foreach ( $item_data as $item_d ) {
        // image styles
        $featured_image = wp_get_attachment_image_src($item_d['thumbnail'], 'full');
        $testimonials_image_src =  (aq_resize($featured_image[0], $image_width_crop, $image_height_crop, true, true, true));
        // image html
        $testimonials_image = '<div class="testimonials_image"><img src="'.esc_url($testimonials_image_src).'" alt="'.esc_attr($new_data['author_name']).'" '.$testimonials_img_style.' /></div>';
        // name html
        $testimonials_name = '<'.esc_attr($name_tag).' class="testimonials_name" '.$name_styles.'>'.esc_html($item_d['author_name']).'</'.esc_attr($name_tag).'>';
        // quote html
        $testimonials_quote = '<'.esc_attr($quote_tag).' class="testimonials_quote" '.$quote_styles.'>'.esc_html($item_d['quote']).'</'.esc_attr($quote_tag).'>';
        // status html
        $testimonials_status = '<'.esc_attr($status_tag).' class="testimonials_status" '.$status_styles.'>'.esc_html($item_d['author_status']).'</'.esc_attr($status_tag).'>';


        $content .= '<div class="testimonials_item'.(!(bool)$use_carousel ? " vc_col-md-".$col : '').'">';
            switch ($item_type) {
                case 'default':
                    $content .= $testimonials_image;
                    $content .= $testimonials_quote;
                    $content .= $testimonials_name;
                    $content .= $testimonials_status;
                    break;
                case 'author_top':
                    $content .= '<div class="testimonials_item_wrap">';
                        $content .= '<div class="testimonials_content_wrap">';
                            $content .= $testimonials_image;
                            $content .= '<div class="testimonials_name_wrap">';
                            $content .= $testimonials_name;
                            $content .= $testimonials_status;
                            $content .= '</div>';
                        $content .= '</div>';
                        $content .= $testimonials_quote;
                    $content .= '</div>';
                    break;
                case 'author_bottom':
                    $content .= $testimonials_quote;
                    $content .= '<div class="testimonials_content_wrap">';
                        $content .= $testimonials_image;
                        $content .= '<div class="testimonials_name_wrap">';
                        $content .= $testimonials_name;
                        $content .= $testimonials_status;
                        $content .= '</div>';
                    $content .= '</div>';
                    break;
            }
        $content .= '</div>';

    }

    $compile .= '<div '.esc_attr($testimonials_attr).' class="cryptronick_module_testimonials'.esc_attr($testimonials_wrap_classes).'">';
        if ((bool)$use_carousel) {
            $compile .= do_shortcode('[bpt_carousel '.$carousel_options.']'.$content.'[/bpt_carousel]');
        } else{
            $compile .= $content;
        }
    $compile .= '</div>';

    echo sprintf("%s", $compile);

?>