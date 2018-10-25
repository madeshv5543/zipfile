<?php

	include_once get_template_directory() . '/core/vc/templates/bpt_google_fonts_render.php';

	$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
	$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');

	$defaults = array(
		'button_title' => 'Button text',
		'link' => '',
		'button_size' => 'normal',
		'button_alignment' => 'inline',
		'css_animation' => '',
		'item_el_class' => '',
		'btn_bg_color' => $theme_color,
		'btn_text_color' => '#ffffff',
		'btn_border_style' => 'solid',
		'btn_border_width' => '1px',
		'btn_border_radius' => '30px',
		'btn_border_color' => $theme_color,
		'btn_font_size' => '',
		'btn_font_weight' => '',
		'btn_icon_type' => 'none',
		'btn_icon_fontawesome' => 'fa fa-adjust',
		'btn_image' => '',
		'btn_img_width' => '',
		'icon_font_size' => '',
		'btn_left_pad' => '',
		'btn_right_pad' => '',
		'btn_top_pad' => '',
		'btn_bottom_pad' => '',
		'btn_left_mar' => '',
		'btn_right_mar' => '',
		'btn_top_mar' => '',
		'btn_bottom_mar' => '',
		'custom_icon_color' => '',
		'btn_icon_color' => '#ffffff',
		'btn_icon_position' => 'left',
		'btn_bg_color_hover' => '#ffffff',
		'btn_text_color_hover' => $theme_color,
		'btn_border_color_hover' => $theme_color,
		'btn_icon_color_hover' => $theme_color,
		'btn_customize' => 'def',
		'btn_bg_gradient_start' => $theme_gradient['from'],
		'btn_bg_gradient_end' => $theme_gradient['to'],
		'btn_bg_gradient_start_hover' => $theme_gradient['to'],
		'btn_bg_gradient_end_hover' => $theme_gradient['from'],
		'btn_border_gradient_start' => $theme_gradient['from'],
		'btn_border_gradient_end' => $theme_gradient['to'],
		'btn_border_gradient_start_hover' => $theme_gradient['to'],
		'btn_border_gradient_end_hover' => $theme_gradient['from'],
	);

	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);
	$compile = '';
	$styles = $btn_classes = $btn_wrap_classes = $btn_attr = $animation_class = $button_id = $btn_styles = $btn_icon_content = $button_value_font = '';

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	$shortc = $this->shortcode;
	extract( $obj->getAttributes( $atts, $this, $shortc, array('google_fonts_button') ) );
	if ( ! empty( $styles_google_fonts_button ) ) {
		$button_value_font = esc_attr( $styles_google_fonts_button );
	} 
	// \Render Google Fonts
	if ($btn_customize != 'def' || (bool)$custom_icon_color) {
		$button_id = uniqid( "cryptronick_button_" );
	}
	ob_start();
	if ($btn_customize != 'def') {
		$btn_bg_gradient_start = !empty($btn_bg_gradient_start) ? esc_html($btn_bg_gradient_start) : 'transparent';
		$btn_bg_gradient_end = !empty($btn_bg_gradient_end) ? esc_html($btn_bg_gradient_end) : 'transparent';
		$btn_bg_gradient_start_hover = !empty($btn_bg_gradient_start_hover) ? esc_html($btn_bg_gradient_start_hover) : 'transparent';
		$btn_bg_gradient_end_hover = !empty($btn_bg_gradient_end_hover) ? esc_html($btn_bg_gradient_end_hover) : 'transparent';
		$btn_border_gradient_start = !empty($btn_border_gradient_start) ? esc_html($btn_border_gradient_start) : 'transparent';
		$btn_border_gradient_end = !empty($btn_border_gradient_end) ? esc_html($btn_border_gradient_end) : 'transparent';
		$btn_border_gradient_start_hover = !empty($btn_border_gradient_start_hover) ? esc_html($btn_border_gradient_start_hover) : 'transparent';
		$btn_border_gradient_end_hover = !empty($btn_border_gradient_end_hover) ? esc_html($btn_border_gradient_end_hover) : 'transparent';
		// button color
		echo "#$button_id a{
			color: ".(!empty($btn_text_color) ? esc_html($btn_text_color) : 'transparent').";
			background-color: ".(!empty($btn_bg_color) ? esc_html($btn_bg_color) : 'transparent').";
			border-color: ".(!empty($btn_border_color) ? esc_html($btn_border_color) : 'transparent').";
		}";
		echo "#$button_id a:hover{
			color: ".(!empty($btn_text_color_hover) ? esc_html($btn_text_color_hover) : 'transparent').";
			background-color: ".(!empty($btn_bg_color_hover) ? esc_html($btn_bg_color_hover) : 'transparent').";
			border-color: ".(!empty($btn_border_color_hover) ? esc_html($btn_border_color_hover) : 'transparent').";
		}";
		// button gradient
		echo "#$button_id.button_gradient a:before{
			background: linear-gradient(90deg, $btn_bg_gradient_start, $btn_bg_gradient_end);
		}";
		echo "#$button_id.button_gradient a:after{
			background: linear-gradient(90deg, $btn_bg_gradient_start_hover, $btn_bg_gradient_end_hover);
		}";
		echo "#$button_id.button_gradient a .button_border_gradient:before{
			background: linear-gradient(90deg, $btn_border_gradient_start, $btn_border_gradient_end);
		}";
		echo "#$button_id.button_gradient a .button_border_gradient:after{
			background: linear-gradient(90deg, $btn_border_gradient_start_hover, $btn_border_gradient_end_hover);
		}";
		echo "#$button_id.button_gradient a:before,
			#$button_id.button_gradient a:after{
			left: $btn_border_width;
			right: $btn_border_width;
			top: $btn_border_width;
			bottom: $btn_border_width;
		}";
		// \button gradient
	}
	if ((bool)$custom_icon_color) {
		// button icon color
		echo "#$button_id a .cryptronick_button_icon{
			color: ".(!empty($btn_icon_color) ? esc_html($btn_icon_color) : 'transparent').";
			transition: all 400ms;
		}";
		echo "#$button_id a:hover .cryptronick_button_icon{
			color: ".(!empty($btn_icon_color_hover) ? esc_html($btn_icon_color_hover) : 'transparent').";
		}";
	}
	$styles = ob_get_clean();
	Cryptronick_shortcode_css()->enqueue_cryptronick_css($styles);	
	// Link Settings
	$link_temp = vc_build_link($link);
	$url = $link_temp['url'];
	$btn_title = $link_temp['title'];
	$target = $link_temp['target'];
	// Animation
	if (!empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	}
	$btn_attr .= !empty($url) ? 'href="'.esc_url($url).'"' : 'href="#"';
	$btn_attr .= !empty($btn_title) ? " title='".esc_attr($btn_title)."'" : '';
	$btn_attr .= !empty($target) ? ' target="'.esc_attr($target).'"' : '';
	// button classes
	$btn_wrap_classes .= ' button_alignment_'.$button_alignment;
	$btn_wrap_classes .= ' button_'.$btn_customize;
	$btn_wrap_classes .= ($btn_icon_type != 'none') ? ' button_icon_'.$btn_icon_position : '';
	$btn_wrap_classes .= $animation_class;
	$btn_wrap_classes .= !empty($item_el_class) ? ' '.$item_el_class : '';
	// size & font-size
	$btn_classes .= "button_size_".$button_size;
	$btn_styles .= ($btn_font_size != '') ? 'font-size:'.(int)$btn_font_size.'px; ' : '';
	$btn_styles .= ($btn_font_weight != '') ? 'font-weight:'.(int)$btn_font_weight.'; ' : '';
	// border styles
	$btn_styles .= ($btn_border_radius != 'none') ? 'border-radius:'.$btn_border_radius.'; ' : '';
	$btn_styles .= ($btn_border_style != 'none') ? 'border-style:'.$btn_border_style.'; ' : '';
	$btn_styles .= ($btn_border_style != 'none') ? 'border-width:'.$btn_border_width.'; ' : '';
	// paddings
	$btn_styles .= ($btn_left_pad != '') ? 'padding-left:'.$btn_left_pad.'px; ' : '';
	$btn_styles .= ($btn_right_pad != '') ? 'padding-right:'.$btn_right_pad.'px; ' : '';
	$btn_styles .= ($btn_top_pad != '') ? 'padding-top:'.$btn_top_pad.'px; ' : '';
	$btn_styles .= ($btn_bottom_pad != '') ? 'padding-bottom:'.$btn_bottom_pad.'px; ' : '';
	// margins
	$btn_styles .= ($btn_left_mar != '') ? 'margin-left:'.$btn_left_mar.'px; ' : '';
	$btn_styles .= ($btn_right_mar != '') ? 'margin-right:'.$btn_right_mar.'px; ' : '';
	$btn_styles .= ($btn_top_mar != '') ? 'margin-top:'.$btn_top_mar.'px; ' : '';
	$btn_styles .= ($btn_bottom_mar != '') ? 'margin-bottom:'.$btn_bottom_mar.'px; ' : '';
	// google fonts
	$btn_styles .= $button_value_font;
	$btn_attr .= !empty($btn_styles) ? ' style="'.esc_attr($btn_styles).'"' : '';
	// button content
	if ($btn_icon_type == 'font') {
		// button icon(font)
		vc_icon_element_fonts_enqueue( 'fontawesome' );
		$btn_icon_style = ($icon_font_size != '') ? 'style="font-size:'.esc_attr($icon_font_size).'px;"' : '';
		$btn_icon_content = !empty($btn_icon_fontawesome) ? '<i class="cryptronick_button_icon '.esc_attr($btn_icon_fontawesome).'" '.$btn_icon_style.'></i>' : '';
	} else if ($btn_icon_type == 'image' && !empty($btn_image)){
		// button icon(image)
		$featured_image = wp_get_attachment_image_src($btn_image, 'full');
		$featured_image_url = $featured_image[0];
		$btn_image_src = ($btn_img_width != '') ? (aq_resize($featured_image_url, $btn_img_width*2, '', true, true, true)) : $featured_image_url;
		$btn_img_width_style = ($btn_img_width != '') ? 'style="width:'.esc_attr($btn_img_width).'px;"' : '';
		$btn_icon_content .= '<span class="cryptronick_button_icon"><img src="'.esc_url($btn_image_src).'" alt="'.esc_attr($button_title).'" '.$btn_img_width_style.' /></span>';
	}
	switch ($btn_icon_position) {
		case 'none':
			$button_content = esc_html($button_title);
			break;
		case 'left':
			$button_content = $btn_icon_content . esc_html($button_title);
			break;
		case 'right':
			$button_content = esc_html($button_title) . $btn_icon_content;
			break;
	}
	// button gradient
	if ($btn_customize == 'gradient') {
		$button_content .= '<span class="button_border_gradient"></span>';
	}
	// \button gradient

	?>
	<div <?php echo (($btn_customize != 'def' || (bool)$custom_icon_color) ? 'id="'.esc_attr($button_id).'"' : ''); ?> class="cryptronick_module_button<?php echo esc_attr($btn_wrap_classes); ?>">
		<a class="<?php echo esc_attr($btn_classes) ?>" <?php echo sprintf("%s", $btn_attr) ?> ><?php echo sprintf("%s", $button_content); ?></a>
	</div>
	<?php

	return;

?>
    
