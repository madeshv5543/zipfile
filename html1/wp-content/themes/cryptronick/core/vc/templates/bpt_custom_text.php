<?php
	include_once get_template_directory() . '/core/vc/templates/bpt_google_fonts_render.php';

	$main_font = Cryptronick_Theme_Helper::get_option('main-font');

	$defaults = array(
		'item_el_class' => '',
		'font_size' => (int)$main_font['font-size'],
		'text_color' => '',
		'use_theme_fonts' => false,
		'line_height' => '140',
		'responsive_font' => false,
		'font_size_sm_desctop' => '',
		'font_size_tablet' => '',
		'font_size_mobile' => '',

	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$compile = $custom_text_wrap_classes = $text_font = $text_css = $animation_class = '';

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_text') ) );

	if ( ! empty( $styles_google_fonts_text ) ) {
		$text_font = esc_attr( $styles_google_fonts_text );
	}

	// Font Size of Title
	if ($font_size != '') {
		$text_css = 'font-size:' . (int)$font_size . 'px; line-height:' . (int)$line_height . '%;';
	} 

	// Animation
	if (! empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	}

	// wrapper classes
	$custom_text_wrap_classes .= (bool)$use_theme_fonts ? 'custom_font' : '';
	$custom_text_wrap_classes .= ' '.$item_el_class;
	$custom_text_wrap_classes .= ' '.$animation_class;

	if (!empty($content)) {
		$compile .= '<div class="cryptronick_module_custom_text'.esc_attr($custom_text_wrap_classes).'" style="color:'.esc_attr($text_color).'; '.esc_attr($text_font) . esc_attr($text_css).'">';
		if ((bool)$responsive_font) {
			$compile .= !empty($font_size_sm_desctop) ? ' <div class="cryptronick_custom_text_font_desctop" style="font-size:'.(int)$font_size_sm_desctop.'px;line-height: ' . (int)$line_height . '%;">' : '';
			$compile .= !empty($font_size_tablet) ? ' <div class="cryptronick_custom_text_font_tablet" style="font-size:'.(int)$font_size_tablet.'px;line-height: ' . (int)$line_height . '%;">' : '';
			$compile .= !empty($font_size_mobile) ? ' <div class="cryptronick_custom_text_font_mobile" style="font-size:'.(int)$font_size_mobile.'px;line-height: ' . (int)$line_height . '%;">' : '';
		}
		$compile .= do_shortcode($content);
		if ((bool)$responsive_font) {
			$compile .= !empty($font_size_sm_desctop) ? ' </div>' : '';
			$compile .= !empty($font_size_tablet) ? ' </div>' : '';
			$compile .= !empty($font_size_mobile) ? ' </div>' : '';
		}
		$compile .= '</div>';
	}	

	echo Cryptronick_Theme_Helper::render_html($compile);		

?>  
