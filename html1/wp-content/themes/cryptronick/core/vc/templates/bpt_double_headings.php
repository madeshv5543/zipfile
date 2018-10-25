<?php
	include_once get_template_directory() . '/core/vc/templates/bpt_google_fonts_render.php';

	$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
	$header_font = Cryptronick_Theme_Helper::get_option('header-font');
	$main_font = Cryptronick_Theme_Helper::get_option('main-font');
	$h2_font = Cryptronick_Theme_Helper::get_option('h2-font');

	$defaults = array(
		// General
		'title' => '',
		'subtitle' => '',
		'align' => 'left',
		'sub_pos' => 'top',
		'item_el_class' => '',
		'title_color' => esc_attr($header_font['color']),
		'title_size' => esc_attr($h2_font['font-size']),
		'title_line_height' => '120',
		'title_weight' => esc_attr($h2_font['font-weight']),
		'responsive_font' => false,
		'font_size_sm_desctop' => '',
		'font_size_tablet' => '',
		'font_size_mobile' => '',
		'use_theme_fonts_title' => false,
		'subtitle_color' => $theme_color,
		'subtitle_size' => '18px',
		'subtitle_line_height' => '160',
		'subtitle_weight' => esc_attr($main_font['font-weight']),
		'use_theme_fonts_subtitle' => false,

	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$compile = $title_render = $subtitle_render = $dbl_head_wrap_classes = $title_styles = $animation_class = '';

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_title','google_fonts_subtitle') ) );
	$title_font_style = !empty($styles_google_fonts_title) ? esc_attr( $styles_google_fonts_title ) : '';
	$subtitle_font_style = !empty($styles_google_fonts_subtitle) ? esc_attr( $styles_google_fonts_subtitle ) : '';

	// title styles
	$title_size_style = !empty($title_size) ? 'font-size:' . (int)$title_size . 'px; ' : '';
	$title_line_height_style = !empty($title_line_height) ? 'line-height:' . (int)$title_line_height . '%; ' : '';
	$title_weight_style = !empty($title_weight) ? 'font-weight:' . (int)$title_weight . '; ' : '';
	$title_color_style = !empty($title_color) ? 'color:' . esc_attr($title_color) . '; ' : '';

	// Font Size of Title
	if (!empty($title_size_style) || !empty($title_line_height_style) || !empty($title_weight_style) || !empty($title_color_style) || !empty($title_font_style)) {
		$title_styles = 'style="'.$title_size_style.$title_line_height_style.$title_weight_style.$title_color_style.$title_font_style.'"';
	} 

	// subtitle styles
	$subtitle_size_style = !empty($subtitle_size) ? 'font-size:' . (int)$subtitle_size . 'px; ' : '';
	$subtitle_line_height_style = !empty($subtitle_line_height) ? 'line-height:' . (int)$subtitle_line_height . '%; ' : '';
	$subtitle_weight_style = !empty($subtitle_weight) ? 'font-weight:' . (int)$subtitle_weight . '; ' : '';
	$subtitle_color_style = !empty($subtitle_color) ? 'color:' . esc_attr($subtitle_color) . '; ' : '';

	// Font Size of subTitle
	if (!empty($subtitle_size_style) || !empty($subtitle_line_height_style) || !empty($subtitle_weight_style) || !empty($subtitle_color_style) || !empty($subtitle_font_style)) {
		$subtitle_styles = 'style="'.$subtitle_size_style.$subtitle_line_height_style.$subtitle_weight_style.$subtitle_color_style.$subtitle_font_style.'"';
	} 

	// Animation
	if (! empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	}

	// wrapper classes
	// $dbl_head_wrap_classes .= (bool)$use_theme_fonts_title ? 'custom_font' : '';
	$dbl_head_wrap_classes .= ' align-'.$align;
	$dbl_head_wrap_classes .= ' '.$item_el_class;
	$dbl_head_wrap_classes .= !empty($animation_class) ? ' '.$animation_class : '';

	if (!empty($title)) {
		$title_render .= '<div class="heading_title" '.$title_styles.'>';
		if ((bool)$responsive_font) {
			$title_render .= !empty($font_size_sm_desctop) ? '<div class="heading_title_desctop" style="font-size:'.(int)$font_size_sm_desctop.'px; line-height: ' . (int)$title_line_height . '%;">' : '';
			$title_render .= !empty($font_size_tablet) ? '<div class="heading_title_tablet" style="font-size:'.(int)$font_size_tablet.'px; line-height: ' . (int)$title_line_height . '%;">' : '';
			$title_render .= !empty($font_size_mobile) ? '<div class="heading_title_mobile" style="font-size:'.(int)$font_size_mobile.'px; line-height: ' . (int)$title_line_height . '%;">' : '';
		}
		$title_render .= esc_html($title);
		if ((bool)$responsive_font) {
			$title_render .= !empty($font_size_sm_desctop) ? '</div>' : '';
			$title_render .= !empty($font_size_tablet) ? '</div>' : '';
			$title_render .= !empty($font_size_mobile) ? '</div>' : '';
		}
		$title_render .= '</div>';
	}

	$subtitle_render .= !empty($subtitle) ? '<div class="heading_subtitle" '.$subtitle_styles.'>'.esc_html($subtitle).'</div>' : '';

	$compile .= '<div class="cryptronick_module_double_headings'.esc_attr($dbl_head_wrap_classes).'">';
		switch ($sub_pos) {
			case 'top':
				$compile .= $subtitle_render;
				$compile .= $title_render;
				break;
			case 'bottom':
				$compile .= $title_render;
				$compile .= $subtitle_render;
				break;
			default:
				$compile .= $subtitle_render;
				$compile .= $title_render;
				break;
		}
	$compile .= '</div>';

	echo Cryptronick_Theme_Helper::render_html($compile);		

?>  
