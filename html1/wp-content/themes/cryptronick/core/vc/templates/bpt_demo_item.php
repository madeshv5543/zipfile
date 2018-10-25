<?php

	$defaults = array(
		// General
		'di_title' => '',
		'di_subtitle' => '',
		'di_image' => '',
		'coming_soon' => false,
		'add_button' => false,
		'di_button_title' => '',
		'di_link' => '',
		'item_el_class' => '',
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$compile = $btn_attr = $di_wrap_classes = '';

	// Animation
	if (!empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	}

	// wrapper classes
	$di_wrap_classes .= (bool)$coming_soon ? ' coming_soon' : '';
	$di_wrap_classes .= !empty($animation_class) ? ' '.$animation_class : '';
	$di_wrap_classes .= !empty($item_el_class) ? ' '.$item_el_class : '';

	// image src
	$featured_image = wp_get_attachment_image_src($di_image, 'full');

	// module alt
	$img_alt = get_post_meta($di_image, '_wp_attachment_image_alt', true);

	// link button
	$link_temp = vc_build_link($di_link);
	$url = $link_temp['url'];
	$btn_title = $link_temp['title'];
	$target = $link_temp['target'];
	$btn_attr .= !empty($url) ? 'href="'.esc_url($url).'"' : 'href="#"';
	$btn_attr .= !empty($btn_title) ? " title='".esc_attr($btn_title)."'" : '';
	$btn_attr .= !empty($target) ? ' target="'.esc_attr($target).'"' : '';

	// render html
	$compile .= '<div class="cryptronick_module_demo_item'.esc_attr($di_wrap_classes).'">';
		if (!empty($di_image)) {
			$compile .= '<div class="di_image-wrap">';
				$compile .= '<a class="di_image-link" '.$btn_attr.'><img src="'.($featured_image[0]).'" alt="'.(!empty($img_alt) ? $img_alt : '').'"></a>';
				$compile .= (bool)$add_button ? '<div class="di_button cryptronick_module_button button_gradient"><a class="button_size_large" '.$btn_attr.'>'.esc_html($di_button_title).'<span class="button_border_gradient"></span></a></div>' : '';
				$compile .= (bool)$coming_soon ? '<h5 class="di_label">'.esc_html__( 'Coming Soon', 'cryptronick' ).'</h5>' : '';
			$compile .= '</div>';
		}
		$compile .= '<div class="di_title-wrap">';
			$compile .= !empty($di_subtitle) ? '<h3 class="di_subtitle">'.esc_html($di_subtitle).'</h3>' : '';
			$compile .= !empty($di_title) ? '<a '.$btn_attr.'><h5 class="di_title">'.esc_html($di_title).'</h5></a>' : '';
		$compile .= '</div>';
	$compile .= '</div>';

	echo sprintf("%s", $compile);

?>