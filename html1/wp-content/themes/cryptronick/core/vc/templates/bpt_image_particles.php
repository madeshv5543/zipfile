<?php
$defaults = array(
	'thumbnail' => '',
	'img_width' => '500px',
	'img_alignment' => 'center',
	'item_el_class' => '',
);
$atts = vc_shortcode_attribute_parse( $defaults, $atts );
extract($atts);
$compile = $image_particles_data = $item_wrap_classes = $animation_class = '';
wp_enqueue_script('particler', get_template_directory_uri() . '/js/particler.js', array(), false, false);

$canvas_id = uniqid( "particles-image_" );

// Animation
if (!empty($atts['css_animation'])) {
	$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
}

$item_wrap_classes .= ' img_alignment_'.$img_alignment;
$item_wrap_classes .= $animation_class;
$item_wrap_classes .= !empty($item_el_class) ? ' '.$item_el_class : '';

$featured_image = wp_get_attachment_image_src($thumbnail, 'full');
$featured_image_url = $featured_image[0];

$image_particles_data .= !empty($canvas_id) ? "data-id='".esc_attr($canvas_id)."'" : '';
$image_particles_data .= !empty($featured_image_url) ? "data-img='".esc_url($featured_image_url)."'" : '';

$js_data = !empty($image_particles_data) ? $image_particles_data : '';

if (!empty($thumbnail)) {
	$compile .= '<div class="cryptronick_module_image_particles'.esc_attr($item_wrap_classes).'">';
		$compile .= '<div class="image_particles_data" '.$js_data.' style="max-width:'.(int)$img_width.'px;">';
			$compile .= '<canvas id="'.esc_attr($canvas_id).'" class="particles-image"></canvas>';
		$compile .= '</div>';
	$compile .= '</div>';
}

echo Cryptronick_Theme_Helper::render_html( $compile );