<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $klb_particle_bg = $klb_row_color = $klb_responsive = $shape = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $css_animation = '';
$disable_element = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'vc_row',
	'wpb_row',
	//deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if($shape == 'shape4'){
$output .= '<style> .section_wave2 {background-image: url("'.get_template_directory_uri().'/assets/images/wave.png");}</style>';
}

if($shape == 'shape7'){
$output .= '<style> .section_wave {background-image: url("'.get_template_directory_uri().'/assets/images/banner_wave.png");}</style>';
}

if( $klb_responsive ) {
	$clean = preg_replace('/.vc_custom_/', '_vc_custom_', $klb_responsive) ;
	$output .= '<style> 
					@media (max-width: 767px) and (min-width: 320px){
						.vc_row.klb_xs'.esc_attr($clean).'
					}
				</style>';
}

$klbcss = '';
if($klb_responsive){
$klbcss .= 'klb_xs_'.vc_shortcode_custom_css_class( $klb_responsive );
}



if($particle_first_bg_color && $particle_second_bg_color){
	$klb_particle_bg .= 'style="background-image: linear-gradient(to bottom, '.$particle_first_bg_color.' 10%, '.$particle_second_bg_color.' 100%);"';
}elseif($particle_first_bg_color){
	$klb_particle_bg .= 'style="background:'.$particle_first_bg_color.';"';
}


if($first_bg_color && $second_bg_color && empty($activate_particle)){
	$klb_row_color .= 'style="background-image: linear-gradient(to bottom, '.$first_bg_color.' 10%, '.$second_bg_color.' 100%);"';
}

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array(
		'border',
		'background',
	) ) || $video_bg || $parallax
) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-parallax="scroll" data-image-src="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . ' '.esc_attr($klbcss).'"';

if($activate_particle){
	wp_enqueue_script('particles');
	wp_enqueue_script('cryptoking_particle');
	$output .= '<div class="klb-bg" '.$klb_particle_bg.'>';
	$output .= '<div id="banner_bg_effect" class="banner_effect"></div>';
}

if ( 'stretch_row' === $full_width ) { $output .= '<div class="container">'; }
if ( empty($full_width) ) { $output .= '<div class="container">'; }

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' '.$klb_row_color.'>';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';

if ( empty($full_width) ) { $output .= '</div>'; }
$output .= $after_output;
if ( 'stretch_row' === $full_width ) { $output .= '</div>'; }
if($activate_particle){ $output .= '</div>'; }

if($shape == 'shape1'){
	if(ot_get_option('cryptoking_skin_type') == 'dark'){
		$output .= '<div class="shape shap5"></div>';
	} else {
		$output .= '<div class="shape shap1"></div>';
	}
} elseif($shape == 'shape2'){
	if(ot_get_option('cryptoking_skin_type') == 'light'){
		$output .= '<div class="rounded_shape light_rounded_shape1"></div>';
		$output .= '<div class="rounded_shape light_rounded_shape2"></div>';
	} else {
		$output .= '<div class="rounded_shape rounded_shape1"></div>';
		$output .= '<div class="rounded_shape rounded_shape2"></div>';
	}

} elseif($shape == 'shape3'){
	if(ot_get_option('cryptoking_skin_type') == 'dark'){
		$output .= '<div class="shape shap5"></div>';
		$output .= '<div class="shape shap6"></div>';
	} else {
		$output .= '<div class="shape shap1"></div>';
		$output .= '<div class="shape shap2"></div>';
	}

} elseif($shape == 'shape4'){
$output .= '<div class="section_wave2"></div>';
} elseif($shape == 'shape5'){
	if(ot_get_option('cryptoking_skin_type') == 'light'){
		$output .= '<div class="rounded_shape light_rounded_shape1"></div>';
	}elseif(ot_get_option('cryptoking_skin_type') == 'dark'){
		$output .= '<div class="rounded_shape light_rounded_shape3"></div>';
	} else {
		$output .= '<div class="rounded_shape rounded_shape1"></div>';
	}
} elseif($shape == 'shape6'){
	if(ot_get_option('cryptoking_skin_type') == 'light'){
		$output .= '<div class="rounded_shape light_rounded_shape2"></div>';
	}elseif(ot_get_option('cryptoking_skin_type') == 'dark'){
		$output .= '<div class="rounded_shape light_rounded_shape4"></div>';
	} else {
		$output .= '<div class="rounded_shape rounded_shape2"></div>';
	}
} elseif($shape == 'shape7'){
$output .= '<div class="section_wave"></div>';
}
echo $output;