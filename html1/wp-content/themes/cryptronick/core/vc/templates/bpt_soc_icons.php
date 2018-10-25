<?php

    $theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));

    $defaults = array(
        'values' => '',
        'icon_size' => '',
        'bg_size' => '',
        'border_radius' => '',
        'icons_pos' => 'left',
        'icon_gap' => '',
        'add_bg' => true,
        'item_el_class' => '',
    );

    $atts = vc_shortcode_attribute_parse($defaults, $atts);
    extract($atts);

    $compile = $content = $social_wrap_classes = $animation_class = $icon_colors = '';

    // Animation
    if (!empty($atts['css_animation'])) {
        $animation_class = $this->getCSSAnimation( $atts['css_animation'] );
    }

    // social wrapper classes
    $social_wrap_classes .= ' align-'.$icons_pos;
    $social_wrap_classes .= (bool)$add_bg ? ' with_bg' : '';
    $social_wrap_classes .= !empty($animation_class) ? ' '.$animation_class : '';
    $social_wrap_classes .= !empty($item_el_class) ? ' '.$item_el_class : '';

    $values = (array) vc_param_group_parse_atts( $values );
    $item_data = array();
    foreach ( $values as $data ) {
        $new_data = $data;
        $new_data['icon'] = isset( $data['icon'] ) ? $data['icon'] : '';
        $new_data['link'] = isset( $data['link'] ) ? $data['link'] : '#';
        $new_data['title'] = isset( $data['title'] ) ? $data['title'] : '';
        $new_data['new_tab'] = isset( $data['new_tab'] ) ? $data['new_tab'] : true;
        $new_data['custom_colors'] = isset( $data['custom_colors'] ) ? $data['custom_colors'] : false;
        $new_data['icon_color'] = isset( $data['icon_color'] ) ? $data['icon_color'] : '#ffffff';
        $new_data['icon_hover_color'] = isset( $data['icon_hover_color'] ) ? $data['icon_hover_color'] : $theme_color;
        $new_data['bg_color'] = isset( $data['bg_color'] ) ? $data['bg_color'] : $theme_color;
        $new_data['bg_hover_color'] = isset( $data['bg_hover_color'] ) ? $data['bg_hover_color'] : '#ffffff';

        $item_data[] = $new_data;
    }

    $icon_size_style = !empty($icon_size) ? 'font-size:'.$icon_size.'px; ' : '';
    $bg_size_style = (!empty($bg_size) && (bool)$add_bg) ? 'width:'.$bg_size.'px; height:'.$bg_size.'px; line-height:'.$bg_size.'px; ' : '';
    $border_radius_style = (!empty($border_radius) && (bool)$add_bg) ? 'border-radius:'.$border_radius.'px; ' : '';
    $icon_gap_style = !empty($icon_gap) ? 'margin-left:'.($icon_gap/2).'px; margin-right:'.($icon_gap/2).'px; margin-bottom:'.($icon_gap).'px; ' : '';

    $icon_style = (!empty($icon_size_style) || !empty($bg_size_style) || !empty($border_radius_style) || !empty($icon_gap_style)) ? 'style="'.$icon_size_style.$bg_size_style.$border_radius_style.$icon_gap_style.'"' : '';

    foreach ( $item_data as $item_d ) {
        $icon = $item_d['icon'];
        $title_tag = !empty( $item_d['title'] ) ? " title='".$item_d['title']."'" : "";
        $new_tab = !empty( $item_d['link'] ) && (bool)$item_d['new_tab'] ? "target='_blank'" : "";

        if ((bool)$item_d['custom_colors']) {
            $social_id = uniqid( "soc_icon_" );
            $social_attr = 'id='.$social_id;
        } else{
            $social_attr = '';
        }
        // custom social colors
        ob_start();
            if ((bool)$item_d['custom_colors']) {
                echo "#$social_id{
                    color: ".$item_d['icon_color'].";
                }";
                echo "#$social_id:hover{
                    color: ".$item_d['icon_hover_color'].";
                }";
                if ((bool)$add_bg) {
                    echo "#$social_id{
                        background: ".$item_d['bg_color'].";
                    }";
                    echo "#$social_id:hover{
                        background: ".$item_d['bg_hover_color'].";
                    }";
                }
            }
        $styles = ob_get_clean();
        Cryptronick_shortcode_css()->enqueue_cryptronick_css($styles);

        $content .= '<a '.$social_attr.' href="'.$item_d['link'].'" class="soc_icon '.$item_d['icon'].'" '.$icon_style.' '.$new_tab.' '.$title_tag.'></a>';

    }

    $icon_wrap_gap_style = !empty($icon_gap) ? 'style="margin-left:-'.($icon_gap/2).'px; margin-right:-'.($icon_gap/2).'px;"' : '';

    $compile .= '<div class="cryptronick_module_social clearfix'.esc_attr($social_wrap_classes).'" '.$icon_wrap_gap_style.'>';
        $compile .= $content;
    $compile .= '</div>';

    echo sprintf("%s", $compile);

?>