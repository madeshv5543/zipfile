<?php

	include_once get_template_directory() . '/core/vc/templates/bpt_google_fonts_render.php';

	$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));

	$defaults = array(
		'count_title' => '',
		'count_prefix' => '',
		'count_value' => '',
		'count_suffix' => '',
		// General
		'counter_type' => 'default',
		'counter_layout' => 'top',
		'counter_align' => 'left ',
		'animation_class' => '',
		'item_el_class' => '',
		// Icon/Image
		'icon_type' => 'none',
		'icon_font_type' => 'type_fontawesome',
		'icon_fontawesome' => 'fa fa-adjust',
		'icon_flaticon' => '',
		'custom_icon_size' => '',
		'custom_icon_color' => false,
		'icon_color' => '#000000',
		'icon_color_hover' => '',
		'thumbnail' => '',
		'custom_image_width' => '',
		'custom_image_height' => '',
		// Icon/Image Background
		'custom_icon_bg_width' => '',
		'custom_icon_bg_height' => '',
		'custom_icon_radius' => '',
		'border_width' => '',
		'custom_border_color' => false,
		'border_color' => '#000000',
		'border_color_hover' => '',
		'bg_color_type' => 'def',
		'background_color' => '#000000',
		'background_color_hover' => '',
		'background_gradient_start' => $theme_color,
		'background_gradient_end' => '#000000',
		'background_gradient_hover_start' => '',
		'background_gradient_hover_end' => '',
		// Typography
		'title_tag' => 'div',
		'title_weight' => '400',
		'title_size' => '',
		'custom_title_color' => false,
		'title_color' => '#000000',
		'count_value_weight' => '400',
		'count_value_size' => '',
		'custom_count_value_color' => false,
		'count_value_color' => '#000000',

	);

	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);
	wp_enqueue_script('cryptronick-appear', get_template_directory_uri() . '/js/jquery.appear.js', array(), false, false);

	$compile = $style = $counter_id = $counter_id_attr = $counter_wrap_classes = $counter_inner = $icon_type_html = '';
	$counter_icon = $counter_title = $counter_value = '';

	// adding uniq id for counter module
	if ((bool)$custom_title_color || (bool)$custom_count_value_color || (bool)$custom_icon_color || (bool)$custom_border_color || $bg_color_type != 'def') {
		$counter_id = uniqid( "cryptronick_counter_" );
		$counter_id_attr = 'id='.$counter_id;
	}
	$background_gradient_start = !empty($background_gradient_start) ? esc_html($background_gradient_start) : 'transparent';
	$background_gradient_end = !empty($background_gradient_end) ? esc_html($background_gradient_end) : 'transparent';

	// custom counter colors
	ob_start();
		if ((bool)$custom_title_color) {
			echo "#$counter_id .counter_title{
				color: ".(!empty($title_color) ? esc_html($title_color) : 'transparent').";
			}";
		}
		if ((bool)$custom_count_value_color) {
			echo "#$counter_id .counter_value_wrap{
				color: ".(!empty($count_value_color) ? esc_html($count_value_color) : 'transparent').";
			}";
		}
		if ((bool)$custom_icon_color) {
			echo "#$counter_id .counter_icon{
				color: ".(!empty($icon_color) ? esc_html($icon_color) : 'transparent').";
			}";
			if (!empty($icon_color_hover)) {
				echo "#$counter_id:hover .counter_icon{
					color: ".(esc_html($icon_color_hover)).";
				}";
			}
		}
		if ((bool)$custom_border_color) {
			echo "#$counter_id .counter_icon_container{
				border-color: ".(!empty($border_color) ? esc_html($border_color) : 'transparent').";
			}";
			if (!empty($border_color_hover)) {
				echo "#$counter_id:hover .counter_icon_container{
					border-color: ".(esc_html($border_color_hover)).";
				}";
			}
		}
		if ($bg_color_type == 'color') {
			echo "#$counter_id .counter_icon_container{
				background-color: ".(!empty($background_color) ? esc_html($background_color) : 'transparent').";
			}";
			if (!empty($background_color_hover)) {
				echo "#$counter_id:hover .counter_icon_container{
					background-color: ".(esc_html($background_color_hover)).";
				}";
			}
		}
		if ($bg_color_type == 'gradient') {
			echo "#$counter_id .counter_icon_container:before{
				background: linear-gradient(90deg, $background_gradient_start, $background_gradient_end);
			}";
			if (!empty($background_gradient_hover_start) || !empty($background_gradient_hover_end)) {
				$background_gradient_hover_start = !empty($background_gradient_hover_start) ? esc_html($background_gradient_hover_start) : 'transparent';
				$background_gradient_hover_end = !empty($background_gradient_hover_end) ? esc_html($background_gradient_hover_end) : 'transparent';
				echo "#$counter_id:hover .counter_icon_container:before{
	                opacity: 0;
	                visibility: hidden;
				}";
				echo "#$counter_id .counter_icon_container:after{
					background: linear-gradient(90deg, $background_gradient_hover_start, $background_gradient_hover_end);
				}";
				echo "#$counter_id:hover .counter_icon_container:after{
	                opacity: 1;
	                visibility: visible;
				}";
			}
		}
	$styles = ob_get_clean();
	Cryptronick_shortcode_css()->enqueue_cryptronick_css($styles);

	// Animation
	if (!empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	}

	// counter wrapper classes
	$counter_wrap_classes .= ' type_'.$counter_type;
	$counter_wrap_classes .= ' layout_'.$counter_layout;
	$counter_wrap_classes .= ' counter_alignment_'.$counter_align;
	$counter_wrap_classes .= ($bg_color_type == 'gradient') ? ' counter_bg_gradient' : '';
	$counter_wrap_classes .= $animation_class;

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_title', 'google_fonts_count_value') ) );
	$title_font = (!empty($styles_google_fonts_title)) ? esc_attr($styles_google_fonts_title) : '';
	$count_value_font = (!empty($styles_google_fonts_count_value)) ? esc_attr($styles_google_fonts_count_value) : '';

	// font sizes
	$title_font_size = ($title_size != '') ? 'font-size:'.(int)$title_size.'px; ' : '';
	$count_value_font_size = ($count_value_size != '') ? 'font-size:'.(int)$count_value_size.'px; ' : '';

	// title, counter value styles
	$title_styles = ' style="font-weight:'.esc_attr($title_weight).'; '.esc_attr($title_font_size).$title_font.'"'; 
	$count_value_styles = ' style="font-weight:'.esc_attr($count_value_weight).'; '.esc_attr($count_value_font_size).$count_value_font.'"';

	// title output
	$counter_title .= !empty($count_title) ? '<'.esc_attr($title_tag).' class="counter_title" '.$title_styles.'>'.esc_html($count_title).'</'.esc_attr($title_tag).'>' : '';

	// counter value output
	$counter_value .= !empty($count_value) ? '<h2 class="counter_value_wrap" '.$count_value_styles.'>'.(!empty($count_prefix) ? '<span>'.esc_html($count_prefix).'</span>' : '').'<span class="counter_value">'.esc_html($count_value).'</span>'.(!empty($count_suffix) ? '<span>'.esc_html($count_suffix).'</span>' : '').'</h2>' : '';

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
			
			$icon_size = ($custom_icon_size != '') ? ' style="font-size:'.(int)$custom_icon_size.'px;"' : '';
			$icon_type_html .= '<i class="counter_icon '.esc_attr($icon_font).'" '.$icon_size.'></i>';
		} else if ($icon_type == 'image' && !empty($thumbnail)) {
			$featured_image = wp_get_attachment_image_src($thumbnail, 'full');
			$featured_image_url = $featured_image[0];
			$image_width_crop = ($custom_image_width != '') ? $custom_image_width*2 : '';
			$image_height_crop = ($custom_image_height != '') ? $custom_image_height*2 : '';
			$iconbox_image_src = ($custom_image_width != '' || $custom_image_height != '') ? (aq_resize($featured_image_url, $image_width_crop, $image_height_crop, true, true, true)) : $featured_image_url;
			$image_width = ($custom_image_width != '') ? 'width:'.(int)$custom_image_width.'px; ' : '';
			$image_height = ($custom_image_height != '') ? 'height:'.(int)$custom_image_height.'px;' : '';
			$iconbox_img_width_style = (!empty($image_width) || !empty($image_height))  ? ' style="'.$image_width.$image_height.'"' : '';
			$icon_type_html .= '<div class="counter_icon"><img src="'.esc_url($iconbox_image_src).'" alt="'.esc_attr($count_title).'" '.$iconbox_img_width_style.' /></div>';
		}
		$icon_bg_width = ($custom_icon_bg_width != '') ? 'width:'.(int)$custom_icon_bg_width.'px; ' : '';
		$icon_bg_height = ($custom_icon_bg_height != '') ? 'height:'.(int)$custom_icon_bg_height.'px; ' : '';
		$icon_bg_radius = ($custom_icon_radius != '') ? 'border-radius:'.(int)$custom_icon_radius.'px; ' : '';
		$icon_border_width = ($border_width != '') ? 'border-width:'.(int)$border_width.'px; ' : '';
		$icon_bg_style = (!empty($icon_bg_width) || !empty($icon_bg_height) || !empty($icon_bg_radius) || !empty($icon_border_width))  ? ' style="'.$icon_bg_width.$icon_bg_height.$icon_bg_radius.$icon_border_width.'"' : '';
		$counter_icon .= '<div class="counter_icon_wrapper">';
			$counter_icon .= '<div class="counter_icon_container "'.$icon_bg_style.'>'.$icon_type_html.'</div>';
		$counter_icon .= '</div>';
	}

	// switch layout
	switch ($counter_layout) {
		case 'top':
			$counter_inner .= $counter_icon;
			$counter_inner .= $counter_value;
			$counter_inner .= $counter_title;
			break;
		case 'left':
		case 'right':
		case 'top_left':
		case 'top_right':
			$counter_inner .= $counter_icon;
			$counter_inner .= '<div class="counter_content_wrapper">';
			$counter_inner .= $counter_value;
			$counter_inner .= $counter_title;
			$counter_inner .= '</div>';
			break;
	}

	// render html
	$compile .= '<div '.esc_attr($counter_id_attr).' class="cryptronick_module_counter'.esc_attr($counter_wrap_classes).'">';
		$compile .= $counter_inner;
	$compile .= '</div>';

	echo sprintf("%s", $compile);

?>
    
