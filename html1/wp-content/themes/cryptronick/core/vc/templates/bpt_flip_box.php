<?php

	$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
	$header_font = Cryptronick_Theme_Helper::get_option('header-font');
	$main_font = Cryptronick_Theme_Helper::get_option('main-font');

	$defaults = array(
		// General
		'fb_dir' => 'flip_right',
		'fb_height' => '',
		'item_el_class' => '',
		// Front Side
		'front_bg_style' => 'front_color',
		'front_bg_color' => '#ffffff',
		'front_bg_image' => '',
		'add_shadow' => true,
		'front_logo_image' => '',
		'front_title' => '',
		'front_title_color' => $header_font['color'],
		'front_descr' => '',
		'front_descr_color' => $main_font['color'],
		// Back Side
		'back_bg_style' => 'back_color',
		'back_bg_color' => $theme_color,
		'back_bg_image' => '',
		'back_title' => '',
		'back_title_color' => '#ffffff',
		'back_descr' => '',
		'back_descr_color' => '#ffffff',
		'add_read_more' => false,
		'back_button_color' => '#ffffff',
		'read_more_text' => 'Read More',
		'link' => '',
		'add_icon_button' => false,
		'btn_icon_fontawesome' => 'fa fa-adjust',
		'btn_icon_position' => 'left',
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	if ((bool)$add_read_more) {
        // carousel options array
        $button_options_arr = array(
            'button_title' => $read_more_text,
            'link' => $link,
            'btn_icon_type' => (bool)$add_icon_button ? 'font' : '',
            'btn_icon_fontawesome' => $btn_icon_fontawesome,
            'btn_icon_position' => $btn_icon_position,
            'btn_customize' => 'color',
            'btn_text_color' => $back_button_color,
            'btn_border_color' => $back_button_color,
            'btn_bg_color' => 'transparent',
            'custom_icon_color' => true,
            'btn_icon_color' => $back_button_color,
        );

        // carousel options
        $button_options = array_map(function($k, $v) { return "$k=\"$v\" "; }, array_keys($button_options_arr), $button_options_arr);
        $button_options = implode('', $button_options);
    }

	$compile = $flipbox_wrap_classes = $flipbox_inner = $btn_attr = $animation_class = $flipbox_front = $flipbox_back = $front_styles = $back_styles = $flipbox_styles = '';

	// Animation
	if (!empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	}

	// flipbox wrapper classes
	$flipbox_wrap_classes .= ' type_'.$fb_dir;
	$flipbox_wrap_classes .= (bool)$add_shadow ? ' with_shadow' : '';
	$flipbox_wrap_classes .= $animation_class;
	$flipbox_wrap_classes .= !empty($item_el_class) ? ' '.$item_el_class : '';

	// Front Side styles
	if ($front_bg_style == 'front_color') {
		$front_styles .= 'style="background:'.esc_attr($front_bg_color).';"';
	} else if ($front_bg_style == 'front_image') {
		$front_image = wp_get_attachment_image_src($front_bg_image, 'full');
		$front_image_url = $front_image[0];
		$front_styles .= 'style="background-image: url('.esc_url($front_image_url).');"';
	}

	// Front side logo image
	$flipbox_front_logo = wp_get_attachment_image_src($front_logo_image, 'full');
	$img_alt = get_post_meta($front_logo_image, '_wp_attachment_image_alt', true);
	$front_logo_url = $flipbox_front_logo[0];

	// Front Side
	$flipbox_front .= '<div class="flipbox_front" '.$front_styles.'>';
		$flipbox_front .= !empty($front_logo_url) ? '<img class="flipbox_logo" src="'.(esc_url($front_logo_url)).'" alt="'.(!empty($img_alt) ? $img_alt : '').'" />' : '';
		$flipbox_front .= !empty($front_title) ? '<h5 class="flipbox_title" '.(!empty($front_title_color) ? 'style="color:'.esc_attr($front_title_color).';"' : '').'>'.(esc_html($front_title)).'</h5>' : '';
		$flipbox_front .= !empty($front_descr) ? '<div class="flipbox_descr" '.(!empty($front_descr_color) ? 'style="color:'.esc_attr($front_descr_color).';"' : '').'>'.(esc_html($front_descr)).'</div>' : '';
	$flipbox_front .= '</div>';

	// read more button
	$link_temp = vc_build_link($link);
	$url = $link_temp['url'];
	$btn_title = $link_temp['title'];
	$target = $link_temp['target'];
	$btn_attr .= !empty($url) ? 'href="'.esc_url($url).'"' : 'href="#"';
	$btn_attr .= !empty($btn_title) ? " title='".esc_attr($btn_title)."'" : '';
	$btn_attr .= !empty($target) ? ' target="'.esc_attr($target).'"' : '';

	// Back Side styles
	if ($back_bg_style == 'back_color') {
		$back_styles .= 'style="background:'.esc_attr($back_bg_color).';"';
	} else if ($back_bg_style == 'back_image') {
		$back_image = wp_get_attachment_image_src($back_bg_image, 'full');
		$back_image_url = $back_image[0];
		$back_styles .= 'style="background-image: url('.esc_url($back_image_url).');"';
	}

	// Back Side
	$flipbox_back .= '<div class="flipbox_back" '.$back_styles.'><div class="flipbox_back_content">';
		$flipbox_back .= !empty($back_title) ? '<h4 class="flipbox_title" '.(!empty($back_title_color) ? 'style="color:'.esc_attr($back_title_color).';"' : '').'>'.(esc_html($back_title)).'</h4>' : '';
		$flipbox_back .= !empty($back_descr) ? '<div class="flipbox_content" '.(!empty($back_descr_color) ? 'style="color:'.esc_attr($back_descr_color).';"' : '').'>'.(esc_html($back_descr)).'</div>' : '';
		$flipbox_back .= $add_read_more ? do_shortcode('[bpt_button '.$button_options.'][/bpt_button]') : '';
	$flipbox_back .= '</div></div>';

	// Flipbox Wrapper Styles
	$flipbox_height = ($fb_height != '') ? 'min-height: '.$fb_height.'px; ' : '';
	$flipbox_styles .= !empty($flipbox_height) ? 'style="'.$flipbox_height.'"' : '';

	// render html
	$compile .= '<div class="cryptronick_module_flipbox'.esc_attr($flipbox_wrap_classes).'">';
		$compile .= '<div class="flipbox_wrapper" '.$flipbox_styles.'>';
		$compile .= $flipbox_front;
		$compile .= $flipbox_back;
		$compile .= '</div>';
	$compile .= '</div>';

	echo sprintf("%s", $compile);

?>  
