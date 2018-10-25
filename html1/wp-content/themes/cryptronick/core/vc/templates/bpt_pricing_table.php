<?php

	include_once get_template_directory() . '/core/vc/templates/bpt_google_fonts_render.php';

	$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
	$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');

	$defaults = array(
		// General
		'pricing_title' => '',
		'pricing_cur' => '',
		'pricing_price' => '',
		'pricing_desc' => '',
		'recommend' => false,
		'recommend_text' => '',
		'item_el_class' => '',
		// Icon Section
		'icon_type' => 'none',
		'icon_font_type' => 'type_fontawesome',
		'icon_fontawesome' => 'fa fa-adjust',
		'icon_flaticon' => '',
		'custom_icon_size' => '',
		'custom_icon_color' => false,
		'icon_color' => '#ffffff',
		'thumbnail' => '',
		'custom_image_width' => '',
		'custom_image_height' => '',
		// Content
		'descr_text' => '',
		'button_title' => 'Choose Plan',
		'link' => '',
		'btn_customize' => 'def',
		'btn_text_color' => '#1b3452',
		'btn_text_color_hover' => '#ffffff',
		'btn_bg_color' => '#ffffff',
		'btn_bg_color_hover' => $theme_color,
		'btn_bg_gradient_start' => '#f8f9fd',
		'btn_bg_gradient_end' => '#f8f9fd',
		'btn_bg_gradient_start_hover' => $theme_color,
		'btn_bg_gradient_end_hover' => $theme_color,
		'btn_border_color' => $theme_color,
		'btn_border_color_hover' => $theme_color,
		'btn_border_gradient_start' => $theme_color,
		'btn_border_gradient_end' => $theme_color,
		'btn_border_gradient_start_hover' => $theme_color,
		'btn_border_gradient_end_hover' => $theme_color,
		// Header Background
		'header_customize' => 'def',
		'header_bg_color' => $theme_color,
		'header_bg_gradient_start' => $theme_gradient['from'],
		'header_bg_gradient_end' => $theme_gradient['to'],
		'bg_image' => '',
		// Typography
		'title_size' => '',
		'title_weight' => '',
		'custom_title_color' => false,
		'title_color' => '#ffffff',
		'price_size' => '',
		'custom_price_color' => false,
		'price_color' => '#ffffff',
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	if (!empty($button_title)) {
        // carousel options array
        $button_options_arr = array(
            'button_title' => $button_title,
            'button_size' => 'large',
            'link' => $link,
            'btn_customize' => $btn_customize,
            'btn_text_color' => $btn_text_color,
            'btn_text_color_hover' => $btn_text_color_hover,
            'btn_bg_color' => $btn_bg_color,
            'btn_bg_color_hover' => $btn_bg_color_hover,
            'btn_bg_gradient_start' => $btn_bg_gradient_start,
            'btn_bg_gradient_end' => $btn_bg_gradient_end,
            'btn_bg_gradient_start_hover' => $btn_bg_gradient_start_hover,
            'btn_bg_gradient_end_hover' => $btn_bg_gradient_end_hover,
            'btn_border_color' => $btn_border_color,
            'btn_border_color_hover' => $btn_border_color_hover,
            'btn_border_gradient_start' => $btn_border_gradient_start,
            'btn_border_gradient_end' => $btn_border_gradient_end,
            'btn_border_gradient_start_hover' => $btn_border_gradient_start_hover,
            'btn_border_gradient_end_hover' => $btn_border_gradient_end_hover,
        );

        // carousel options
        $button_options = array_map(function($k, $v) { return "$k=\"$v\" "; }, array_keys($button_options_arr), $button_options_arr);
        $button_options = implode('', $button_options);
    }

	$compile = $styles = $pricing_title_out = $pricing_price_out = $pricing_desc_out = $pricing_cur_out = $pricing_icon = $pricing_inner = $pricing_button = $icon_type_html = $pricing_content = $pricing_wrap_classes = $pricing_plan_id_attr = $recommend_out = '';

	// adding uniq id for pricing module
	if ((bool)$custom_icon_color || (bool)$custom_price_color || (bool)$custom_title_color || $header_customize != 'def') {
		$pricing_plan_id = uniqid( "cryptronick_pricing_plan_" );
		$pricing_plan_id_attr = 'id='.$pricing_plan_id;
	}

	// custom pricing colors
	ob_start();
		if ((bool)$custom_icon_color) {
			echo "#$pricing_plan_id .pricing_icon{
				color: ".(!empty($icon_color) ? esc_html($icon_color) : 'transparent').";
			}";
		}
		if ((bool)$custom_title_color) {
			echo "#$pricing_plan_id .pricing_title{
				color: ".(!empty($title_color) ? esc_html($title_color) : 'transparent').";
			}";
		}
		if ((bool)$custom_price_color) {
			echo "#$pricing_plan_id .pricing_price_wrap{
				color: ".(!empty($price_color) ? esc_html($price_color) : 'transparent').";
			}";
		}
		if ($header_customize == 'color') {
			echo "#$pricing_plan_id .pricing_header{
				background-color: ".(!empty($header_bg_color) ? esc_html($header_bg_color) : 'transparent').";
			}";
		}
		if ($header_customize == 'gradient') {
			echo "#$pricing_plan_id .pricing_header{
				background: linear-gradient(120deg, $header_bg_gradient_start, $header_bg_gradient_end);
			}";
		}
	$styles = ob_get_clean();
	Cryptronick_shortcode_css()->enqueue_cryptronick_css($styles);

	// Animation
	if (!empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	}

	// pricing wrapper classes
	$pricing_wrap_classes .= (bool)$recommend ? ' recommended' : '';
	$pricing_wrap_classes .= !empty($animation_class) ? $animation_class : '';
	$pricing_wrap_classes .= !empty($item_el_class) ? ' '.$item_el_class : '';

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_title') ) );
	$title_font = (!empty($styles_google_fonts_title)) ? esc_attr($styles_google_fonts_title) : '';
	
	// font sizes
	$title_font_size = ($title_size != '') ? 'font-size:'.$title_size.'px; ' : '';
	$price_font_size = ($price_size != '') ? 'font-size:'.$price_size.'px; ' : '';

	// title, price, price description styles
	$title_styles = (!empty($title_font_size) || !empty($title_font)) ? 'style="'.esc_attr($title_font_size).$title_font.'"' : '';
	$price_styles = !empty($price_font_size) ? 'style="'.esc_attr($price_font_size).'"' : '';

	// title output
	$pricing_title_out .= !empty($pricing_title) ? '<h4 class="pricing_title" '.$title_styles.'>'.esc_html($pricing_title).'</h4>' : '';

	// price output
	$pricing_price_out .= !empty($pricing_price) ? '<div class="pricing_price">'.esc_html($pricing_price).'</div>' : '';

	// price description output
	$pricing_desc_out .= !empty($pricing_desc) ? '<div class="pricing_desc">/'.esc_html($pricing_desc).'</div>' : '';

	// price currency output
	$pricing_cur_out .= !empty($pricing_cur) ? '<span class="pricing_cur">'.esc_html($pricing_cur).'</span>' : '';

	// Icon/Image output
	if ($icon_type != 'none') {
		if ($icon_type == 'font' && !empty($icon_fontawesome)) {

			if ($icon_font_type == 'type_fontawesome') {
				wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
				$icon_font = $icon_fontawesome;
			} else if($icon_font_type == 'type_flaticon'){
				wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
				$icon_font = $icon_flaticon;
			}

			$icon_size = ($custom_icon_size != '') ? 'style="font-size:'.(int)$custom_icon_size.'px;"' : '';
			$icon_type_html .= '<i class="pricing_icon '.esc_attr($icon_font).'" '.$icon_size.'></i>';
		} else if ($icon_type == 'image' && !empty($thumbnail)) {
			$featured_image = wp_get_attachment_image_src($thumbnail, 'full');
			$featured_image_url = $featured_image[0];
			$image_width_crop = ($custom_image_width != '') ? $custom_image_width*2 : '';
			$image_height_crop = ($custom_image_height != '') ? $custom_image_height*2 : '';
			$pricing_image_src = ($custom_image_width != '' || $custom_image_height != '') ? (aq_resize($featured_image_url, $image_width_crop, $image_height_crop, true, true, true)) : $featured_image_url;
			$image_width = ($custom_image_width != '') ? 'width:'.(int)$custom_image_width.'px; ' : '';
			$image_height = ($custom_image_height != '') ? 'height:'.(int)$custom_image_height.'px;' : '';
			$pricing_img_width_style = (!empty($image_width) || !empty($image_height))  ? 'style="'.$image_width.$image_height.'"' : '';
			$img_alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true);
			$icon_type_html .= '<div class="pricing_icon"><img src="'.esc_url($pricing_image_src).'" alt="'.(!empty($img_alt) ? $img_alt : '').'" '.$pricing_img_width_style.' /></div>';
		}
		$pricing_icon .= '<div class="pricing_icon_wrapper">';
			$pricing_icon .= '<div class="pricing_icon_container ">'.$icon_type_html.'</div>';
		$pricing_icon .= '</div>';
	}

	// pricing button
	$pricing_button .= !empty($button_title) ? do_shortcode('[bpt_button '.$button_options.'][/bpt_button]') : '';

	// pricing_desc_footer
	$header_image = wp_get_attachment_image_src($bg_image, 'full');
	$header_image_url = $header_image[0];
	$pricing_header_style = !empty($bg_image) ? 'style="background-image: url('.$header_image_url.')"' : '';

	// pricing_desc_footer
	$pricing_desc_footer = !empty($descr_text) ? esc_html($descr_text) : '';

	// pricing_content
	if ((bool)$recommend) {
		$recommend_out .= '<div class="pricing_recommend">';
			$recommend_out .= '<div class="pricing_recommend-icon flaticon-mark"></div>';
			$recommend_out .= !empty($recommend_text) ? '<div class="pricing_recommend-text">'.esc_html($recommend_text).'</div>' : '';
		$recommend_out .= '</div>';
	}

	// pricing_content
	$pricing_content .= !empty($content) ? do_shortcode($content) : '';

	$pricing_inner .= '<div class="pricing_header" '.$pricing_header_style.'>';
		$pricing_inner .= $pricing_icon;
		$pricing_inner .= $pricing_title_out;
		$pricing_inner .= '<div class="pricing_price_wrap" '.$price_styles.'>';
		$pricing_inner .= $pricing_cur_out;
		$pricing_inner .= $pricing_price_out;
		$pricing_inner .= $pricing_desc_out;
		$pricing_inner .= '</div>';
	$pricing_inner .= '</div>';
	$pricing_inner .= '<div class="pricing_content">';
		$pricing_inner .= $pricing_content;
	$pricing_inner .= '</div>';
	$pricing_inner .= '<div class="pricing_footer">';
		$pricing_inner .= $pricing_desc_footer;
		$pricing_inner .= $pricing_button;
		$pricing_inner .= $recommend_out;
	$pricing_inner .= '</div>';


	// render html
	$compile .= '<div '.esc_attr($pricing_plan_id_attr).' class="cryptronick_module_pricing_plan'.esc_attr($pricing_wrap_classes).'">';
		$compile .= '<div class="pricing_plan_wrap">';
			$compile .= $pricing_inner;
		$compile .= '</div>';
	$compile .= '</div>';

	echo sprintf("%s", $compile);

?>  
