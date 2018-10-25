<?php

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));

$defaults = array(
	//General
    'posts_per_line' => '1',
    'autoplay_carousel' => true,
    'slider_speed' => '3000',
    'scroll_items' => false,
	'multiple_items' => false,
	'adaptive_height' => false,
	'el_class' => '',
	// Navigation
	'use_pagination' => true,
	'pag_type' => 'circle',
	'pag_offset' => '',
	'pag_align' => 'center',
	'custom_pag_color' => false,
	'pag_color' => $theme_color,
	'use_prev_next' => false,
	'custom_buttons_color' => false,
	'buttons_color' => $theme_color,
	// Responsive
	'custom_resp' => false,
	'resp_medium' => '1025',
	'resp_medium_slides' => '',
	'resp_tablets' => '800',
	'resp_tablets_slides' => '',
	'resp_mobile' => '480',
	'resp_mobile_slides' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
wp_enqueue_script('cryptronick-slick', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);

$compile = $carousel_id_attr = $slick_settings = $carousel_wrap_classes = $animation_class = '';
if ((bool)$custom_pag_color || (bool)$custom_buttons_color || $pag_offset != '') {
	$carousel_id = uniqid( "cryptronick_carousel_" );
	$carousel_id_attr = 'id='.$carousel_id;
}

// custom carousel colors
ob_start();
	if ((bool)$custom_pag_color) {
		echo "#$carousel_id.pagination_circle .slick-dots li button,
		#$carousel_id.pagination_square .slick-dots li button{
			background: ".(!empty($pag_color) ? esc_html($pag_color) : 'transparent').";
		}";
		echo "#$carousel_id.pagination_line .slick-dots li button:before{
			background: ".(!empty($pag_color) ? esc_html($pag_color) : 'transparent').";
		}";
	}
	if ((bool)$custom_buttons_color) {
		echo "#$carousel_id .slick-arrow{
			border-color: ".(!empty($buttons_color) ? esc_html($buttons_color) : 'transparent').";
			color: ".(!empty($buttons_color) ? esc_html($buttons_color) : 'transparent').";
		}";
	}
	if ($pag_offset != '') {
		echo "#$carousel_id .slick-dots{
			margin-top: ".(int)$pag_offset."px;
		}";
	}
$styles = ob_get_clean();
Cryptronick_shortcode_css()->enqueue_cryptronick_css($styles);

// Animation
if (!empty($atts['css_animation'])) {
	$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
}

switch ($posts_per_line) {
	case '1':
		$responsive_medium = 1;
		$responsive_tablets = 1;
		$responsive_mobile = 1;
		break;
	case '2':
		$responsive_medium = 2;
		$responsive_tablets = 2;
		$responsive_mobile = 1;
		break;
	case '3':
		$responsive_medium = 3;
		$responsive_tablets = 2;
		$responsive_mobile = 1;
		break;
	case '4':
		$responsive_medium = 4;
		$responsive_tablets = 2;
		$responsive_mobile = 1;
		break;
	case '5':
		$responsive_medium = 4;
		$responsive_tablets = 2;
		$responsive_mobile = 1;
		break;
	case '6':
		$responsive_medium = 4;
		$responsive_tablets = 2;
		$responsive_mobile = 1;
		break;
	default:
		$responsive_medium = 1;
		$responsive_tablets = 1;
		$responsive_mobile = 1;
		break;
}
if ($custom_resp) {
	$responsive_medium = !empty($resp_medium_slides) ? (int)$resp_medium_slides : $responsive_medium;
	$responsive_tablets = !empty($resp_tablets_slides) ? (int)$resp_tablets_slides : $responsive_tablets;
	$responsive_mobile = !empty($resp_mobile_slides) ? (int)$resp_mobile_slides : $responsive_mobile;
}

$responsive_sltscrl_medium = $scroll_items ? 1 : $responsive_medium;
$responsive_sltscrl_tablets = $scroll_items ? 1 : $responsive_tablets;
$responsive_sltscrl_mobile = $scroll_items ? 1 : $responsive_mobile;

$slick_settings .= '"slidesToShow": '.$posts_per_line.',';
$slick_settings .= $scroll_items ? '"slidesToScroll": 1,' : '"slidesToScroll": '.$posts_per_line.',';
$slick_settings .= $autoplay_carousel ? '"autoplay": true,' : '"autoplay": false,';
$slick_settings .= '"autoplaySpeed": '.$slider_speed.',';
$slick_settings .= $multiple_items ? '"infinite": true,' : '"infinite": false,';
$slick_settings .= $use_prev_next ? '"arrows": true,' : '"arrows": false,';
$slick_settings .= $use_pagination ? '"dots": true,' : '"dots": false,';
$slick_settings .= $adaptive_height ? '"adaptiveHeight": true,' : '"adaptiveHeight": false,';
$slick_settings .= '"responsive": [{"breakpoint": '.(int)$resp_medium.',"settings": {"slidesToShow": '.esc_attr($responsive_medium).',"slidesToScroll": '.esc_attr($responsive_sltscrl_medium).'}},{"breakpoint": '.(int)$resp_tablets.', "settings": {"slidesToShow": '.esc_attr($responsive_tablets).', "slidesToScroll": '.esc_attr($responsive_sltscrl_tablets).'}}, {"breakpoint": '.(int)$resp_mobile.', "settings": { "slidesToShow": '.esc_attr($responsive_mobile).', "slidesToScroll": '.esc_attr($responsive_sltscrl_mobile).' } } ]';
$carousel_wrap_classes .= $use_pagination ? ' pagination_'.$pag_type : '';
$carousel_wrap_classes .= ' pag_align_'.$pag_align;
$carousel_wrap_classes .= $animation_class;
$carousel_wrap_classes .= !empty($el_class) ? ' '.$el_class : '';
?>

    <div <?php echo esc_attr($carousel_id_attr) ?> class="cryptronick_module_carousel<?php echo esc_attr($carousel_wrap_classes) ?>">
    	<div class="cryptronick_carousel_slick" data-slick='{<?php echo esc_attr($slick_settings); ?>}'>
            <?php echo do_shortcode($content); ?>
        </div>
    </div>

