<?php
$defaults = array(
	'height' => '',
	'responsive_es' => false,
	'height_size_sm_desctop' => '',
	'height_tablet' => '',
	'height_mobile' => '',
);
$atts = vc_shortcode_attribute_parse( $defaults, $atts );

extract($atts);
$compile = '';
if (!empty($height) || $height == '0') {
	$compile .= '<div class="cryptronick_spacing '.($responsive_es == 'true' ? 'responsive' : '').'">';
	$compile .= '<div class="cryptronick_spacing-height cryptronick_spacing-height_default" style="height:'.(int)$height.'px;"></div>';
	if ($responsive_es == 'true') {
		$resposive_spacing = $height_size_sm_desctop || $height_size_sm_desctop == '0';
		$compile .= ($height_size_sm_desctop || $height_size_sm_desctop == '0') ? ' <div class="cryptronick_spacing-height cryptronick_spacing-height_desctop" style="height:'.(int)$height_size_sm_desctop.'px;"></div>' : '';
		$compile .= ($height_tablet || $height_tablet == '0') ? ' <div class="cryptronick_spacing-height cryptronick_spacing-height_tablet" style="height:'.(int)$height_tablet.'px;"></div>' : '';
		$compile .= ($height_mobile || $height_mobile == '0') ? ' <div class="cryptronick_spacing-height cryptronick_spacing-height_mobile" style="height:'.(int)$height_mobile.'px;"></div>' : '';
	}
	$compile .= '</div>';
}	
echo Cryptronick_Theme_Helper::render_html( $compile );

?>  
