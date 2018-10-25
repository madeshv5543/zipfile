<?php

	include_once get_template_directory() . '/core/vc/templates/bpt_google_fonts_render.php';

	$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
	$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');

	$defaults = array(
		// General
		'ib_type' => 'default',
		'ib_layout' => 'top',
		'ib_align' => 'left ',
		'animation_class' => '',
		'item_el_class' => '',
        // Content
		'ib_title' => '',
		'ib_subtitle' => '',
		'ib_content' => '',
		'add_read_more' => false,
		'read_more_text' => esc_html__('Read More', 'cryptronick'),
		'link' => '',
		'add_read_more_offset' => false,
		'read_more_offset' => '',
		// Icon/Image
		'icon_type' => 'none',
		'icon_font_type' => 'type_fontawesome',
		'icon_fontawesome' => 'fa fa-adjust',
		'icon_flaticon' => '',
		'custom_icon_size' => '',
		'custom_icon_color' => false,
		'icon_color' => '#000000',
		'icon_color_hover' => '#000000',
		'thumbnail' => '',
		'custom_image_width' => '',
		'custom_image_height' => '',
		'add_number' => false,
		'icon_number' => '01',
		'number_pos' => 'left_top',
		// Icon/Image Background
		'custom_icon_bg_width' => '',
		'custom_icon_bg_height' => '',
		'custom_icon_bot_offset' => '',
		'custom_icon_side_offset' => '',
		'custom_icon_radius' => '',
		'border_width' => '',
		'custom_border_color' => false,
		'border_color' => '#000000',
		'border_color_hover' => '#000000',
		'bg_color_type' => 'def',
		'background_color' => '#000000',
		'background_color_hover' => '#000000',
		'background_gradient_start' => $theme_color,
		'background_gradient_end' => '#000000',
		'background_gradient_hover_start' => '#000000',
		'background_gradient_hover_end' => $theme_color,
		// Tile Background Colors
		'custom_tile_colors' => false,
		'tile_shadow' => true,
		'tile_content_color_hover' => '#ffffff',
		'tile_bg_color_type' => 'def',
		'tile_bg_color' => '#ffffff',
		'tile_bg_color_hover' => $theme_color,
		'tile_bg_gradient_start' => '#ffffff',
		'tile_bg_gradient_end' => '#ffffff',
		'tile_bg_gradient_hover_start' => $theme_gradient['from'],
		'tile_bg_gradient_hover_end' => $theme_gradient['to'],
		// Typography
		'title_tag' => 'h3',
		'title_size' => '',
		'title_weight' => '',
		'custom_title_color' => false,
		'title_color' => '#000000',
		'subtitle_tag' => 'span',
		'subtitle_size' => '',
		'custom_subtitle_color' => false,
		'subtitle_color' => '#000000',
		'content_tag' => 'div',
		'content_size' => '',
		'custom_content_color' => false,
		'content_color' => '#000000',
		'button_size' => '',
		'custom_button_color' => false,
		'button_color' => '#000000',
		'button_color_hover' => '#000000',
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$compile = $style = $infobox_id = $infobox_id_attr = $infobox_wrap_classes = $infobox_inner = $btn_attr = $icon_type_html = $animation_class = '';
	$infobox_icon = $infobox_title = $infobox_subtitle = $infobox_content = $infobox_button = $number_icon_html = '';

	// adding uniq id for infobox module
	if ((bool)$custom_title_color || (bool)$custom_subtitle_color || (bool)$custom_content_color || (bool)$custom_button_color || (bool)$custom_icon_color || (bool)$custom_border_color || (bool)$custom_tile_colors || $bg_color_type != 'def') {
		$infobox_id = uniqid( "cryptronick_infobox_" );
		$infobox_id_attr = 'id='.$infobox_id;
	}
	$background_gradient_start = !empty($background_gradient_start) ? esc_html($background_gradient_start) : 'transparent';
	$background_gradient_end = !empty($background_gradient_end) ? esc_html($background_gradient_end) : 'transparent';
	$background_gradient_hover_start = !empty($background_gradient_hover_start) ? esc_html($background_gradient_hover_start) : 'transparent';
	$background_gradient_hover_end = !empty($background_gradient_hover_end) ? esc_html($background_gradient_hover_end) : 'transparent';
	$tile_bg_gradient_start = !empty($tile_bg_gradient_start) ? esc_html($tile_bg_gradient_start) : 'transparent';
	$tile_bg_gradient_end = !empty($tile_bg_gradient_end) ? esc_html($tile_bg_gradient_end) : 'transparent';
	$tile_bg_gradient_hover_start = !empty($tile_bg_gradient_hover_start) ? esc_html($tile_bg_gradient_hover_start) : 'transparent';
	$tile_bg_gradient_hover_end = !empty($tile_bg_gradient_hover_end) ? esc_html($tile_bg_gradient_hover_end) : 'transparent';

	// custom infobox colors
	ob_start();
		if ((bool)$custom_title_color) {
			echo "#$infobox_id .infobox_title{
				color: ".(!empty($title_color) ? esc_html($title_color) : 'transparent').";
			}";
		}
		if ((bool)$custom_subtitle_color) {
			echo "#$infobox_id .infobox_subtitle{
				color: ".(!empty($subtitle_color) ? esc_html($subtitle_color) : 'transparent').";
			}";
		}
		if ((bool)$custom_content_color) {
			echo "#$infobox_id .infobox_content{
				color: ".(!empty($content_color) ? esc_html($content_color) : 'transparent').";
			}";
		}
		if ((bool)$custom_button_color) {
			echo "#$infobox_id .infobox_button{
				color: ".(!empty($button_color) ? esc_html($button_color) : 'transparent').";
			}";
			echo "#$infobox_id .infobox_button:hover{
				color: ".(!empty($button_color_hover) ? esc_html($button_color_hover) : 'transparent').";
			}";
		}
		if ((bool)$custom_icon_color) {
			echo "#$infobox_id .infobox_icon{
				color: ".(!empty($icon_color) ? esc_html($icon_color) : 'transparent').";
			}";
			echo "#$infobox_id:hover .infobox_icon{
				color: ".(!empty($icon_color_hover) ? esc_html($icon_color_hover) : 'transparent').";
			}";
		}
		if ((bool)$custom_border_color) {
			echo "#$infobox_id .infobox_icon_container{
				border-color: ".(!empty($border_color) ? esc_html($border_color) : 'transparent').";
			}";
			echo "#$infobox_id:hover .infobox_icon_container{
				border-color: ".(!empty($border_color_hover) ? esc_html($border_color_hover) : 'transparent').";
			}";
		}
		if ($bg_color_type == 'color') {
			echo "#$infobox_id .infobox_icon_container{
				background-color: ".(!empty($background_color) ? esc_html($background_color) : 'transparent').";
			}";
			echo "#$infobox_id:hover .infobox_icon_container{
				background-color: ".(!empty($background_color_hover) ? esc_html($background_color_hover) : 'transparent').";
			}";
		}
		if ($bg_color_type == 'gradient') {
			echo "#$infobox_id .infobox_icon_container:before{
				background: linear-gradient(90deg, $background_gradient_start, $background_gradient_end);
			}";
			echo "#$infobox_id .infobox_icon_container:after{
				background: linear-gradient(90deg, $background_gradient_hover_start, $background_gradient_hover_end);
			}";
		}
		if ((bool)$custom_tile_colors) {
			echo "#$infobox_id.type_tile:hover .infobox_title,
				#$infobox_id.type_tile:hover .infobox_subtitle,
				#$infobox_id.type_tile:hover .infobox_content{
				color: ".(!empty($tile_content_color_hover) ? esc_html($tile_content_color_hover) : 'transparent').";
			}";
		}
		if ($tile_bg_color_type == 'color') {
			echo "#$infobox_id.type_tile:before{
				background-color: ".(!empty($tile_bg_color) ? esc_html($tile_bg_color) : 'transparent').";
			}";
			echo "#$infobox_id.type_tile:after{
				background-color: ".(!empty($tile_bg_color_hover) ? esc_html($tile_bg_color_hover) : 'transparent').";
			}";
		}
		if ($tile_bg_color_type == 'gradient') {
			echo "#$infobox_id.type_tile:before{
				background: linear-gradient(90deg, $tile_bg_gradient_start, $tile_bg_gradient_end);
			}";
			echo "#$infobox_id.type_tile:after{
				background: linear-gradient(90deg, $tile_bg_gradient_hover_start, $tile_bg_gradient_hover_end);
			}";
		}
	$styles = ob_get_clean();
	Cryptronick_shortcode_css()->enqueue_cryptronick_css($styles);

	// Animation
	if (!empty($atts['css_animation'])) {
		$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
	}

	// infobox wrapper classes
	$infobox_wrap_classes .= ' type_'.$ib_type;
	$infobox_wrap_classes .= ' layout_'.$ib_layout;
	$infobox_wrap_classes .= ' infobox_alignment_'.$ib_align;
	$infobox_wrap_classes .= ($ib_type == 'tile' && (bool)$tile_shadow) ? ' tile_shadow' : '';
	$infobox_wrap_classes .= ($bg_color_type == 'gradient') ? ' infobox_bg_gradient' : '';
	$infobox_wrap_classes .= $animation_class;
	$infobox_wrap_classes .= !empty($item_el_class) ? ' '.$item_el_class : '';

	// Render Google Fonts
	$obj = new GoogleFontsRender();
	extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_title', 'google_fonts_subtitle', 'google_fonts_content', 'google_fonts_button') ) );
	$title_font = (!empty($styles_google_fonts_title)) ? esc_attr($styles_google_fonts_title) : '';
	$subtitle_font = (!empty($styles_google_fonts_subtitle)) ? esc_attr($styles_google_fonts_subtitle) : '';
	$content_font = (!empty($styles_google_fonts_content)) ? esc_attr($styles_google_fonts_content) : '';
	$button_font = (!empty($styles_google_fonts_button)) ? esc_attr($styles_google_fonts_button) : '';

	// font sizes
	$title_font_size = ($title_size != '') ? 'font-size:'.$title_size.'px; ' : '';
	$title_font_weight = ($title_weight != '') ? 'font-weight:'.$title_weight.'; ' : '';
	$subtitle_font_size = ($subtitle_size != '') ? 'font-size:'.$subtitle_size.'px; ' : '';
	$content_font_size = ($content_size != '') ? 'font-size:'.$content_size.'px; ' : '';
	$button_font_size = ($button_size != '') ? 'font-size:'.$button_size.'px; ' : '';
	$button_offset = ($add_read_more_offset != '') ? 'margin-top:'.$read_more_offset.'px; ' : '';

	// title, subtitle, content, button styles
	$title_styles = (!empty($title_font_size) || !empty($title_font) || !empty($title_font_weight)) ? ' style="'.esc_attr($title_font_size).esc_attr($title_font_weight).$title_font.'"' : '';
	$subtitle_styles = (!empty($subtitle_font_size) || !empty($subtitle_font)) ? ' style="'.esc_attr($subtitle_font_size).$subtitle_font.'"' : '';
	$content_styles = (!empty($content_font_size) || !empty($content_font)) ? ' style="'.esc_attr($content_font_size).$content_font.'"' : '';
	$button_styles = (!empty($button_font_size) || !empty($button_font) || !empty($button_offset)) ? ' style="'.esc_attr($button_font_size).$button_font.$button_offset.'"' : '';

	// read more button
	$link_temp = vc_build_link($link);
	$url = $link_temp['url'];
	$btn_title = $link_temp['title'];
	$target = $link_temp['target'];
	$btn_attr .= !empty($url) ? 'href="'.esc_url($url).'"' : 'href="#"';
	$btn_attr .= !empty($btn_title) ? " title='".esc_attr($btn_title)."'" : '';
	$btn_attr .= !empty($target) ? ' target="'.esc_attr($target).'"' : '';
	$btn_attr .= !empty($button_styles) ? $button_styles : '';
	$infobox_button .= $add_read_more ? '<a class="infobox_button button-read-more" '.$btn_attr.'>'.esc_html($read_more_text).'</a>' : '';

	// title output
	$infobox_title .= !empty($ib_title) ? '<'.esc_attr($title_tag).' class="infobox_title" '.$title_styles.'>'.wp_kses( $ib_title, array('br' => array()) ).'</'.esc_attr($title_tag).'>' : '';

	// subtitle output
	$infobox_subtitle .= !empty($ib_subtitle) ? '<'.esc_attr($subtitle_tag).' class="infobox_subtitle" '.$subtitle_styles.'>'.esc_html($ib_subtitle).'</'.esc_attr($subtitle_tag).'>' : '';

	// content output
	$infobox_content .= !empty($ib_content) ? '<'.esc_attr($content_tag).' class="infobox_content" '.$content_styles.'>'.esc_html($ib_content).'</'.esc_attr($content_tag).'>' : '';

	// Icon/Image output
	if ($icon_type != 'none') {
		if ($icon_type == 'font' && (!empty($icon_fontawesome) || !empty($icon_flaticon))) {
			if ($icon_font_type == 'type_fontawesome') {
				wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
				$icon_font = $icon_fontawesome;
			} else if($icon_font_type == 'type_flaticon'){
				wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
				$icon_font = $icon_flaticon;
			}
			$icon_size = ($custom_icon_size != '') ? ' style="font-size:'.(int)$custom_icon_size.'px;"' : '';
			$icon_type_html .= '<i class="infobox_icon '.esc_attr($icon_font).'" '.$icon_size.'></i>';
		} else if ($icon_type == 'image' && !empty($thumbnail)) {
			$featured_image = wp_get_attachment_image_src($thumbnail, 'full');
			$featured_image_url = $featured_image[0];
			$image_width_crop = ($custom_image_width != '') ? $custom_image_width*2 : '';
			$image_height_crop = ($custom_image_height != '') ? $custom_image_height*2 : '';
			$iconbox_image_src = ($custom_image_width != '' || $custom_image_height != '') ? (aq_resize($featured_image_url, $image_width_crop, $image_height_crop, true, true, true)) : $featured_image_url;
			$image_width = ($custom_image_width != '') ? 'width:'.(int)$custom_image_width.'px; ' : '';
			$image_height = ($custom_image_height != '') ? 'height:'.(int)$custom_image_height.'px;' : '';
			$iconbox_img_width_style = (!empty($image_width) || !empty($image_height))  ? ' style="'.$image_width.$image_height.'"' : '';
			$img_alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true);
			$icon_type_html .= '<div class="infobox_icon" '.(($custom_image_height != '') ? ' style="height:'.(int)$custom_image_height.'px;"' : '').'><img src="'.esc_url($iconbox_image_src).'" alt="'.(!empty($img_alt) ? $img_alt : '').'" '.$iconbox_img_width_style.' /></div>';
		}
		$number_icon_html .= ((bool)$add_number && $icon_number != '') ? '<span class="infobox_icon_number '.esc_attr($number_pos).'">'.$icon_number.'</span>' : '';
		$icon_bg_width = ($custom_icon_bg_width != '') ? 'width:'.(int)$custom_icon_bg_width.'px; ' : '';
		$icon_bg_height = ($custom_icon_bg_height != '') ? 'height:'.(int)$custom_icon_bg_height.'px; ' : '';
		$icon_bg_radius = ($custom_icon_radius != '') ? 'border-radius:'.(int)$custom_icon_radius.'px; ' : '';
		$icon_border_width = ($border_width != '') ? 'border-width:'.(int)$border_width.'px; ' : '';
		$icon_bg_style = (!empty($icon_bg_width) || !empty($icon_bg_height) || !empty($icon_bg_radius) || !empty($icon_border_width))  ? ' style="'.$icon_bg_width.$icon_bg_height.$icon_bg_radius.$icon_border_width.'"' : '';
		$icon_bot_offset = ($custom_icon_bot_offset != '') ? 'margin-bottom:'.$custom_icon_bot_offset.'px; ' : '';



		$icon_left_offset = ($custom_icon_side_offset != '' && ($ib_layout == 'left' || $ib_layout == 'top_left')) ? 'margin-right:'.$custom_icon_side_offset.'px; ' : '';
		$icon_right_offset = ($custom_icon_side_offset != '' && ($ib_layout == 'right' || $ib_layout == 'top_right')) ? 'margin-left:'.$custom_icon_side_offset.'px; ' : '';



		$icon_wrap_style = (!empty($icon_bot_offset) || !empty($icon_left_offset) || !empty($icon_right_offset))  ? ' style="'.$icon_bot_offset.$icon_left_offset.$icon_right_offset.'"' : '';
		$infobox_icon .= '<div class="infobox_icon_wrapper" '.$icon_wrap_style.'>';
			$infobox_icon .= '<div class="infobox_icon_container "'.$icon_bg_style.'>'.$icon_type_html.$number_icon_html.'</div>';
		$infobox_icon .= '</div>';
	}

	// switch layout
	switch ($ib_layout) {
		case 'top':
			$infobox_inner .= $infobox_icon;
			$infobox_inner .= $infobox_title;
			$infobox_inner .= $infobox_subtitle;
			$infobox_inner .= $infobox_content;
			$infobox_inner .= $infobox_button;
			break;
		case 'left':
		case 'right':
		case 'top_left':
		case 'top_right':
			$infobox_inner .= $infobox_icon;
			$infobox_inner .= '<div class="infobox_content_wrapper">';
			$infobox_inner .= $infobox_title;
			$infobox_inner .= $infobox_subtitle;
			$infobox_inner .= $infobox_content;
			$infobox_inner .= $infobox_button;
			$infobox_inner .= '</div>';
			break;
	}

	// render html
	$compile .= '<div '.esc_attr($infobox_id_attr).' class="cryptronick_module_infobox'.esc_attr($infobox_wrap_classes).'">';
		$compile .= $infobox_inner;
	$compile .= '</div>';

	echo sprintf("%s", $compile);

?>  
